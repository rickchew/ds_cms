<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_sales extends CI_Controller {

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
	public function index(){
		$this->load->model('products_model');
		$this->load->model('members_model');


		$data['product'] = $this->products_model->get_all();
		$data['customers'] = $this->members_model->get_all();


		$data['active_menu_id'] = '91';
		$this->load->view('cash_sales/index',$data);
	}
	public function create_action(){
		$this->load->model('payment_model');
		$paymentJson = $this->input->post('hiddenMethod');
		$paymentJson = json_decode($paymentJson);


		/*----------------------------

				MAIN DOC SAVE

		------------------------------*/

		print_r($this->input->post());




		/*---------------------------

		PAYMENT ARRAY REARRANGE START

		----------------------------*/
		$paymentArr = array();
		$tmpArr = array();
		$strReplace = null;
		$x = 0;

		foreach($paymentJson as $val){
			
			if($val->name=="methodID[]"){
				$strReplace = "pos_payment_method_id";
			}elseif($val->name=="methodRemark[]"){
				$strReplace = "pos_payment_remark";
			}elseif($val->name=="methodAmt[]"){
				$strReplace = "pos_payment_amt";
			}else{
				$strReplace = null;
			}


			$tmpArr[$strReplace] = $val->value;

			$x++;
			if($x==3){
				$tmpArr['pos_payment_doc_id'] = 1; // SETTING PARENT DOC ID HERE
				if($tmpArr['pos_payment_amt']>0){
					//IF PAYMENT METHOD GOT VALUE THEN SAVE
					array_push($paymentArr,$tmpArr);
				}
				
				$x=0;
				$tmpArr = array();
				echo "<hr>";
			}
		}
		/*---------------------------

		PAYMENT ARRAY REARRAGE END ->>> $paymentArr is ready to batch insert

		----------------------------*/
		$this->payment_model->batch_save($paymentArr);
		
	}
}