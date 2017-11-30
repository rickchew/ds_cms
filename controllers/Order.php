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
        $this->load->library('form_validation');
    }
	public function index(){

		$q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'doc/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'doc/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'doc/index';
            $config['first_url'] = base_url() . 'doc/index';
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
        );

		$data['active_menu_id'] = '91';
        $this->load->view('order/index', $data);
	}
    public function test(){
        $this->load->model('doc_model');

        $data= $this->doc_model->getNextInv(1);
    }
}
