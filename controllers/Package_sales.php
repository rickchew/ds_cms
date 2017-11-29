<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_sales extends CI_Controller {

	public function index(){
		$this->load->model('products_model');
		$this->load->model('members_model');


		$data['product'] = $this->products_model->get_all_non_service();
		$data['service'] = $this->products_model->get_all_is_service();
		$data['customers'] = $this->members_model->get_all();


		$data['active_menu_id'] = '91';
		$this->load->view('package_sales/index',$data);
	}
}