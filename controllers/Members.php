<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Members extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Members_model');
        $this->load->library('form_validation');
    }

    public function index(){
    	//print_r($this->session->all_userdata());
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'members/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'members/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'members/index';
            $config['first_url'] = base_url() . 'members/index';
        }
        //$config['anchor_class'] = 'class="page-link"';
		//$config['attributes'] = array('class' => 'page-link');
		$config['attributes'] = array('class' => 'page-link');

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Members_model->total_rows($q);

        $members = $this->Members_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'members_data' => $members,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['active_menu_id'] = '86';
        $this->load->view('members/mod_clients_list', $data);
    }

    public function read($id){
    	//$this->output->enable_profiler(true);
    	$this->load->model('doc_model');
    	$row = $this->Members_model->get_by_id($id);
    	$docs_inv = $this->doc_model->get_limit_data(100, $start = 0, $q = NULL,$member_id = $id);

    	if ($row) {
                $data = array(
				'mod_clients_id' => $row->mod_clients_id,
				'mod_clients_fullname' => $row->mod_clients_fullname,
				'mod_clients_fullname_zh' => $row->mod_clients_fullname_zh,
				'mod_clients_nric' => $row->mod_clients_nric,
				'mod_clients_email' => $row->mod_clients_email,
				'mod_clients_occupation' => $row->mod_clients_occupation,
				'mod_clients_marital_status' => $row->mod_clients_marital_status,
				'mod_clients_gender' => $row->mod_clients_gender,
				'mod_clients_nationality' => $row->mod_clients_nationality,
				'mod_clients_birthday' => $row->mod_clients_birthday,
				'mod_clients_contact_1' => $row->mod_clients_contact_1,
				'mod_clients_contact_2' => $row->mod_clients_contact_2,
				'mod_clients_attr_1' => $row->mod_clients_attr_1,
				'mod_clients_attr_2' => $row->mod_clients_attr_2,
				'mod_clients_address' => $row->mod_clients_address,
				'mod_clients_address_country' => $row->mod_clients_address_country,
				'mod_clients_address_state' => $row->mod_clients_address_state,
				//'col_05' => $row->col_05,
				//'col_17' => $row->col_17,
				//'col_21' => $row->col_21,
				//'col_24' => $row->col_24,
				//'col_25' => $row->col_25,
				'mod_clients_passport' => $row->mod_clients_passport,
				'mod_clients_place_of_birth' => $row->mod_clients_place_of_birth,
			
	    	);
            $data['docs_inv'] = $docs_inv;
            $data['active_menu_id'] = '86';
    		$this->load->view('members/read',$data);
        }else {
            $this->session->set_flashdata('error_message', 'Record Not Found');
            redirect(site_url('members'));
        }
    	
    }
    public function read_($id) 
    {
        $row = $this->Members_model->get_by_id($id);
        if ($row) {
            $data = array(
		'mod_clients_id' => $row->mod_clients_id,
		'mod_clients_fullname' => $row->mod_clients_fullname,
		'mod_clients_fullname_zh' => $row->mod_clients_fullname_zh,
		'mod_clients_nric' => $row->mod_clients_nric,
		'mod_clients_email' => $row->mod_clients_email,
		'mod_clients_occupation' => $row->mod_clients_occupation,
		'mod_clients_marital_status' => $row->mod_clients_marital_status,
		'mod_clients_gender' => $row->mod_clients_gender,
		'mod_clients_nationality' => $row->mod_clients_nationality,
		'mod_clients_birthday' => $row->mod_clients_birthday,
		'mod_clients_contact_1' => $row->mod_clients_contact_1,
		'mod_clients_contact_2' => $row->mod_clients_contact_2,
		'mod_clients_attr_1' => $row->mod_clients_attr_1,
		'mod_clients_attr_2' => $row->mod_clients_attr_2,
		'mod_clients_address' => $row->mod_clients_address,
		'mod_clients_address_country' => $row->mod_clients_address_country,
		'mod_clients_address_state' => $row->mod_clients_address_state,
		'col_05' => $row->col_05,
		'col_17' => $row->col_17,
		'col_21' => $row->col_21,
		'col_24' => $row->col_24,
		'col_25' => $row->col_25,
		'mod_clients_passport' => $row->mod_clients_passport,
		'mod_clients_place_of_birth' => $row->mod_clients_place_of_birth,
	    );
            $this->load->view('members/mod_clients_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('members'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('members/create_action'),
	    'mod_clients_id' => set_value('mod_clients_id'),
	    'mod_clients_fullname' => set_value('mod_clients_fullname'),
	    'mod_clients_fullname_zh' => set_value('mod_clients_fullname_zh'),
	    'mod_clients_nric' => set_value('mod_clients_nric'),
	    'mod_clients_email' => set_value('mod_clients_email'),
	    'mod_clients_occupation' => set_value('mod_clients_occupation'),
	    'mod_clients_marital_status' => set_value('mod_clients_marital_status'),
	    'mod_clients_gender' => set_value('mod_clients_gender'),
	    'mod_clients_nationality' => set_value('mod_clients_nationality'),
	    'mod_clients_birthday' => set_value('mod_clients_birthday'),
	    'mod_clients_contact_1' => set_value('mod_clients_contact_1'),
	    'mod_clients_contact_2' => set_value('mod_clients_contact_2'),
	    'mod_clients_attr_1' => set_value('mod_clients_attr_1'),
	    'mod_clients_attr_2' => set_value('mod_clients_attr_2'),
	    'mod_clients_address' => set_value('mod_clients_address'),
	    'mod_clients_address_country' => set_value('mod_clients_address_country'),
	    'mod_clients_address_state' => set_value('mod_clients_address_state'),
	    'col_05' => set_value('col_05'),
	    'col_17' => set_value('col_17'),
	    'col_21' => set_value('col_21'),
	    'col_24' => set_value('col_24'),
	    'col_25' => set_value('col_25'),
	    'mod_clients_passport' => set_value('mod_clients_passport'),
	    'mod_clients_place_of_birth' => set_value('mod_clients_place_of_birth'),
	);
        $this->load->view('members/mod_clients_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'mod_clients_fullname' => $this->input->post('mod_clients_fullname',TRUE),
		'mod_clients_fullname_zh' => $this->input->post('mod_clients_fullname_zh',TRUE),
		'mod_clients_nric' => $this->input->post('mod_clients_nric',TRUE),
		'mod_clients_email' => $this->input->post('mod_clients_email',TRUE),
		'mod_clients_occupation' => $this->input->post('mod_clients_occupation',TRUE),
		'mod_clients_marital_status' => $this->input->post('mod_clients_marital_status',TRUE),
		'mod_clients_gender' => $this->input->post('mod_clients_gender',TRUE),
		'mod_clients_nationality' => $this->input->post('mod_clients_nationality',TRUE),
		'mod_clients_birthday' => $this->input->post('mod_clients_birthday',TRUE),
		'mod_clients_contact_1' => $this->input->post('mod_clients_contact_1',TRUE),
		'mod_clients_contact_2' => $this->input->post('mod_clients_contact_2',TRUE),
		'mod_clients_attr_1' => $this->input->post('mod_clients_attr_1',TRUE),
		'mod_clients_attr_2' => $this->input->post('mod_clients_attr_2',TRUE),
		'mod_clients_address' => $this->input->post('mod_clients_address',TRUE),
		'mod_clients_address_country' => $this->input->post('mod_clients_address_country',TRUE),
		'mod_clients_address_state' => $this->input->post('mod_clients_address_state',TRUE),
		'col_05' => $this->input->post('col_05',TRUE),
		'col_17' => $this->input->post('col_17',TRUE),
		'col_21' => $this->input->post('col_21',TRUE),
		'col_24' => $this->input->post('col_24',TRUE),
		'col_25' => $this->input->post('col_25',TRUE),
		'mod_clients_passport' => $this->input->post('mod_clients_passport',TRUE),
		'mod_clients_place_of_birth' => $this->input->post('mod_clients_place_of_birth',TRUE),
	    );

            $this->Members_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('members'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Members_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('members/update_action'),
		'mod_clients_id' => set_value('mod_clients_id', $row->mod_clients_id),
		'mod_clients_fullname' => set_value('mod_clients_fullname', $row->mod_clients_fullname),
		'mod_clients_fullname_zh' => set_value('mod_clients_fullname_zh', $row->mod_clients_fullname_zh),
		'mod_clients_nric' => set_value('mod_clients_nric', $row->mod_clients_nric),
		'mod_clients_email' => set_value('mod_clients_email', $row->mod_clients_email),
		'mod_clients_occupation' => set_value('mod_clients_occupation', $row->mod_clients_occupation),
		'mod_clients_marital_status' => set_value('mod_clients_marital_status', $row->mod_clients_marital_status),
		'mod_clients_gender' => set_value('mod_clients_gender', $row->mod_clients_gender),
		'mod_clients_nationality' => set_value('mod_clients_nationality', $row->mod_clients_nationality),
		'mod_clients_birthday' => set_value('mod_clients_birthday', $row->mod_clients_birthday),
		'mod_clients_contact_1' => set_value('mod_clients_contact_1', $row->mod_clients_contact_1),
		'mod_clients_contact_2' => set_value('mod_clients_contact_2', $row->mod_clients_contact_2),
		'mod_clients_attr_1' => set_value('mod_clients_attr_1', $row->mod_clients_attr_1),
		'mod_clients_attr_2' => set_value('mod_clients_attr_2', $row->mod_clients_attr_2),
		'mod_clients_address' => set_value('mod_clients_address', $row->mod_clients_address),
		'mod_clients_address_country' => set_value('mod_clients_address_country', $row->mod_clients_address_country),
		'mod_clients_address_state' => set_value('mod_clients_address_state', $row->mod_clients_address_state),
		'col_05' => set_value('col_05', $row->col_05),
		'col_17' => set_value('col_17', $row->col_17),
		'col_21' => set_value('col_21', $row->col_21),
		'col_24' => set_value('col_24', $row->col_24),
		'col_25' => set_value('col_25', $row->col_25),
		'mod_clients_passport' => set_value('mod_clients_passport', $row->mod_clients_passport),
		'mod_clients_place_of_birth' => set_value('mod_clients_place_of_birth', $row->mod_clients_place_of_birth),
	    );
            $this->load->view('members/mod_clients_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('members'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('mod_clients_id', TRUE));
        } else {
            $data = array(
		'mod_clients_fullname' => $this->input->post('mod_clients_fullname',TRUE),
		'mod_clients_fullname_zh' => $this->input->post('mod_clients_fullname_zh',TRUE),
		'mod_clients_nric' => $this->input->post('mod_clients_nric',TRUE),
		'mod_clients_email' => $this->input->post('mod_clients_email',TRUE),
		'mod_clients_occupation' => $this->input->post('mod_clients_occupation',TRUE),
		'mod_clients_marital_status' => $this->input->post('mod_clients_marital_status',TRUE),
		'mod_clients_gender' => $this->input->post('mod_clients_gender',TRUE),
		'mod_clients_nationality' => $this->input->post('mod_clients_nationality',TRUE),
		'mod_clients_birthday' => $this->input->post('mod_clients_birthday',TRUE),
		'mod_clients_contact_1' => $this->input->post('mod_clients_contact_1',TRUE),
		'mod_clients_contact_2' => $this->input->post('mod_clients_contact_2',TRUE),
		'mod_clients_attr_1' => $this->input->post('mod_clients_attr_1',TRUE),
		'mod_clients_attr_2' => $this->input->post('mod_clients_attr_2',TRUE),
		'mod_clients_address' => $this->input->post('mod_clients_address',TRUE),
		'mod_clients_address_country' => $this->input->post('mod_clients_address_country',TRUE),
		'mod_clients_address_state' => $this->input->post('mod_clients_address_state',TRUE),
		//'col_05' => $this->input->post('col_05',TRUE),
		//'col_17' => $this->input->post('col_17',TRUE),
		//'col_21' => $this->input->post('col_21',TRUE),
		//'col_24' => $this->input->post('col_24',TRUE),
		//'col_25' => $this->input->post('col_25',TRUE),
		'mod_clients_passport' => $this->input->post('mod_clients_passport',TRUE),
		'mod_clients_place_of_birth' => $this->input->post('mod_clients_place_of_birth',TRUE),
	    );

            $this->Members_model->update($this->input->post('mod_clients_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('members'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Members_model->get_by_id($id);

        if ($row) {
            $this->Members_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('members'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('members'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('mod_clients_fullname', 'mod clients fullname', 'trim|required');
	$this->form_validation->set_rules('mod_clients_fullname_zh', 'mod clients fullname zh', 'trim');
	$this->form_validation->set_rules('mod_clients_nric', 'mod clients nric', 'trim|required');
	$this->form_validation->set_rules('mod_clients_email', 'mod clients email', 'trim');
	$this->form_validation->set_rules('mod_clients_occupation', 'mod clients occupation', 'trim');
	$this->form_validation->set_rules('mod_clients_marital_status', 'mod clients marital status', 'trim');
	$this->form_validation->set_rules('mod_clients_gender', 'mod clients gender', 'trim');
	$this->form_validation->set_rules('mod_clients_nationality', 'mod clients nationality', 'trim');
	$this->form_validation->set_rules('mod_clients_birthday', 'mod clients birthday', 'trim');
	$this->form_validation->set_rules('mod_clients_contact_1', 'mod clients contact 1', 'trim|required');
	$this->form_validation->set_rules('mod_clients_contact_2', 'mod clients contact 2', 'trim');
	$this->form_validation->set_rules('mod_clients_attr_1', 'mod clients attr 1', 'trim|required');
	$this->form_validation->set_rules('mod_clients_attr_2', 'mod clients attr 2', 'trim|required');
	$this->form_validation->set_rules('mod_clients_address', 'mod clients address', 'trim');
	$this->form_validation->set_rules('mod_clients_address_country', 'mod clients address country', 'trim');
	$this->form_validation->set_rules('mod_clients_address_state', 'mod clients address state', 'trim');
	$this->form_validation->set_rules('col_05', 'col 05', 'trim');
	$this->form_validation->set_rules('col_17', 'col 17', 'trim');
	$this->form_validation->set_rules('col_21', 'col 21', 'trim');
	$this->form_validation->set_rules('col_24', 'col 24', 'trim');
	$this->form_validation->set_rules('col_25', 'col 25', 'trim');
	$this->form_validation->set_rules('mod_clients_passport', 'mod clients passport', 'trim');
	$this->form_validation->set_rules('mod_clients_place_of_birth', 'mod clients place of birth', 'trim');

	$this->form_validation->set_rules('mod_clients_id', 'mod_clients_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function check_ic($nric=null){
		$this->load->model('members_model');

		$result = $this->members_model->checkExistedIC($nric);

		header('Content-type: application/json');
		echo json_encode($result);
	}

}

/* End of file Members.php */
/* Location: ./application/controllers/Members.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-22 20:47:24 */
/* http://harviacode.com */