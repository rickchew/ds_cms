<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_sales extends CI_Controller {

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
		$this->load->model('doc_model');
		$paymentJson = $this->input->post('hiddenMethod');
		$paymentJson = json_decode($paymentJson);

		print_r($this->input->post());
		/*----------------------------

				MAIN DOC SAVE

		------------------------------*/
		$mainArr['pos_doc_date'] = date('Y-m-d H:i:s');
		$mainArr['pos_doc_date_created'] = date('Y-m-d H:i:s');
		$mainArr['pos_doc_payment_wo_gst'] = $this->input->post('paymentAmt');
		$mainArr['pos_doc_payment_gst'] = $this->input->post('paymentGst');
		$mainArr['pos_doc_payment_total'] = $this->input->post('paymentTotal');
		$mainArr['pos_doc_customer_id'] = $this->input->post('membersID');
		$mainArr['pos_doc_branch_id'] = $this->input->post('outletID');
		$mainArr['pos_doc_type_id'] = 1 ; //INVOICE

		$mainID = $this->doc_model->save_main($mainArr);
		/*
		$mainArr['paymentAmt'] = '';
		$mainArr['paymentAmt'] = '';
		$mainArr['paymentAmt'] = '';*/




		/*----------------------------

				CHILD DOC REARRAGE ARRAY AND SAVE

		------------------------------*/

		print_r($this->input->post());
		$totalItem = count($this->input->post('subItem'));
		$itemArr = array();
		$tmpArr = array();
		for($i=0;$i<$totalItem;$i++){
			//echo $i."<br>";
			$tmpArr['subItem'] = $this->input->post('subItem')[$i];
			$tmpArr['subAmt'] = $this->input->post('subAmt')[$i];
			$tmpArr = array(
				'pos_doc_id' => $mainID, //Parent DOC Here
				'pos_doc_child_product_qty' => $this->input->post('subItem')[$i], 
				'pos_doc_child_product_price' => $this->input->post('subAmt')[$i],
				'pos_doc_child_product_taken' => $this->input->post('subTaken')[$i],
				'pos_doc_child_product_price' => $this->input->post('subPrice')[$i],
				'pos_doc_child_product_id' => $this->input->post('productID')[$i],
			);

			array_push($itemArr,$tmpArr);
		}
		$this->doc_model->batch_save_child($itemArr);




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
				$tmpArr['pos_payment_doc_id'] = $mainID; // SETTING PARENT DOC ID HERE
				if($tmpArr['pos_payment_amt']>0){
					//IF PAYMENT METHOD GOT VALUE THEN SAVE
					array_push($paymentArr,$tmpArr);
				}
				
				$x=0;
				$tmpArr = array();
				//echo "<hr>";
			}
		}
		/*---------------------------

		PAYMENT ARRAY REARRAGE END ->>> $paymentArr is ready to batch insert

		----------------------------*/
		$this->payment_model->batch_save($paymentArr);

		redirect('cash_sales/details/'.$mainID);
		
	}
	function details($id){
		$this->load->model('doc_model');

		$data['docs'] = $this->doc_model->getDocByID($id);
		$data['child'] = $this->doc_model->getChildByID($id);

		$this->load->view('cash_sales/details',$data);
	}
}