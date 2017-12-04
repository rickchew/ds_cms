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
        $this->load->view('order/manual_invoice');
    }
    /*
    public function test(){
        $this->load->model('doc_model');

        $data= $this->doc_model->getNextInv(1);
    }*/
}
