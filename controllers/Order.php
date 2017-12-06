<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
        parent::__construct();
        $this->load->model('Doc_model');
        $this->load->model('branch_model');
        $this->load->library('form_validation');
    }
	public function index(){

		$q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'order/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'order/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'order/index';
            $config['first_url'] = base_url() . 'order/index';
        }
		$config['attributes'] = array('class' => 'page-link');
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Doc_model->total_rows($q);
        $doc = $this->Doc_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'doc_data' => $doc,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'branch_list' => $this->branch_model->get_all(),
        );

		$data['active_menu_id'] = '91';
        $this->load->view('order/index', $data);
	}
    public function order_details($id){
        $this->load->model('doc_model');

        $data['docs'] = $this->doc_model->getDocByID($id);
        $data['child'] = $this->doc_model->getChildByID($id);
        $data['inv'] = $this->doc_model->getInv($id);

        //print_r($data);
        $this->load->view('order/order_details',$data);
    }
    public function order_update($order_id){
        $this->load->model('doc_model');

        print_r($this->input->post());

        $totalItem = count($this->input->post('childId'));

        //print_r($totalItem);
        $itemArr = array();
        $tmpArr = array();
        echo $this->input->post('childId')[0];
        
        for($i=0;$i<$totalItem;$i++){
            $tmpArr = array(
                'pos_doc_child_id' => $this->input->post('childId')[$i],
                'pos_doc_child_product_qty' => $this->input->post('childQty')[$i], // Quantity
                'pos_doc_child_product_total_price' => $this->input->post('proPirce')[$i], // This is total Price
                'pos_doc_child_product_price' => $this->input->post('proPirce')[$i]/$this->input->post('childQty')[$i],
                'pos_doc_child_pv_used' =>$this->input->post('proPV')[$i],

                //'pos_doc_child_product_qty' => $this->input->post('subItem')[$i], 
                //'pos_doc_child_product_price' => $this->input->post('subAmt')[$i],
                //'pos_doc_child_product_taken' => $this->input->post('subTaken')[$i],
                //'pos_doc_child_product_price' => $this->input->post('subPrice')[$i],
                //'pos_doc_child_product_id' => $this->input->post('productID')[$i],
            );
            array_push($itemArr,$tmpArr);
        }
        $this->doc_model->batch_update_child($order_id,$itemArr);

        redirect('order/order_details/'.$order_id);
        //print_r($itemArr);
    }
    public function manual_invoice(){
        $this->load->model('members_model');
        $this->load->model('doc_model');

        $data['inv'] = $this->doc_model->getNextInv($this->session->userdata('outlet_id'),'8');
        $data['customers'] = $this->members_model->get_all();
        $data['action'] = site_url('members/create_action/order/manual_invoice');

        $this->load->view('order/manual_invoice',$data);
    }
    public function manual_create(){
        $this->load->model('doc_model');

        //print_r($this->input->post());

        /*----------------------------

                MAIN DOC SAVE

        ------------------------------*/
        $mainArr['pos_doc_date'] = date('Y-m-d H:i:s');
        $mainArr['pos_doc_date_created'] = date('Y-m-d H:i:s');
        $mainArr['pos_doc_payment_wo_gst'] = $this->input->post('docType') == 2 ? 0:$this->input->post('paymentAmt');
        $mainArr['pos_doc_payment_gst'] = $this->input->post('docType') == 2 ? 0:$this->input->post('paymentGst');
        $mainArr['pos_doc_payment_total'] = $this->input->post('docType') == 2 ? 0:$this->input->post('paymentTotal');
        $mainArr['pos_doc_customer_id'] = $this->input->post('membersID');
        $mainArr['pos_doc_branch_id'] = $this->input->post('outletID');
        $mainArr['pos_doc_type_id'] = $this->input->post('docType');
        $mainArr['pos_doc_is_package'] =  $this->input->post('docType') == 2 ? 1:null;
        $mainArr['pos_doc_quote_price'] = isset($orderJson[0]->value) ? $orderJson[0]->value:0;
        $mainArr['pos_doc_pv_given'] = isset($orderJson[1]->value) ? $orderJson[1]->value:0;
        $mainArr['pos_doc_note'] =  $this->input->post('salesNote');
        $mainArr['pos_doc_order_id'] = $this->input->post('orderID') ? $this->input->post('orderID'):0;
        
        //$mainArr['pos_doc_quote_price'] = 

        $mainID = $this->doc_model->save_main($mainArr);
        /*
        $mainArr['paymentAmt'] = '';
        $mainArr['paymentAmt'] = '';
        $mainArr['paymentAmt'] = '';*/




        /*----------------------------

                CHILD DOC REARRAGE ARRAY AND SAVE

        ------------------------------*/
        $this->output->enable_profiler(true);
        //print_r($totalItem);
        $totalItem = count($this->input->post('subItem'));
        $itemArr = array();
        $tmpArr = array();
        $strLen = 0;
        for($i=0;$i<10;$i++){
            //echo $i."<br>";
            //echo strlen($this->input->post('subItem')[$i])."<hr>";
            $strLen = strlen($this->input->post('subItem')[$i]);
            if($strLen > 1){

            //$tmpArr['subItem'] = $this->input->post('subItem')[$i];
            //$tmpArr['subAmt'] = $this->input->post('subAmt')[$i];
            $tmpArr = array(
                'pos_doc_id' => $mainID, //Parent DOC Here
                'pos_doc_child_product_qty' => 0, 
                'pos_doc_child_product_total_price' => $this->input->post('subAmt')[$i],
                'pos_doc_child_product_taken' => 0, //ZERO taken if order
                'pos_doc_child_product_price' => 0,
                'pos_doc_child_product_id' => 0,
                'pos_doc_child_description' => $this->input->post('subItem')[$i],
                //'pos_doc_child_product_total_price' =>

            );
            array_push($itemArr,$tmpArr);
            }
            $strLen = 0;

        }
        //print_r($itemArr);
        $this->doc_model->batch_save_child($itemArr);

        redirect('cash_sales/details/'.$mainID);
    }
    /*
    public function test(){
        $this->load->model('doc_model');

        $data= $this->doc_model->getNextInv(1);
    }*/
}
