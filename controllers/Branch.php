<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Branch extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Branch_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'branch/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'branch/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'branch/index.html';
            $config['first_url'] = base_url() . 'branch/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Branch_model->total_rows($q);
        $branch = $this->Branch_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'branch_data' => $branch,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('branch/ds_branch_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Branch_model->get_by_id($id);
        if ($row) {
            $data = array(
		'ds_branch_id' => $row->ds_branch_id,
		'ds_branch_name' => $row->ds_branch_name,
		'ds_branch_code' => $row->ds_branch_code,
	    );
            $this->load->view('branch/ds_branch_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('branch'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('branch/create_action'),
	    'ds_branch_id' => set_value('ds_branch_id'),
	    'ds_branch_name' => set_value('ds_branch_name'),
	    'ds_branch_code' => set_value('ds_branch_code'),
	);
        $this->load->view('branch/ds_branch_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ds_branch_name' => $this->input->post('ds_branch_name',TRUE),
		'ds_branch_code' => $this->input->post('ds_branch_code',TRUE),
	    );

            $this->Branch_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('branch'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Branch_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('branch/update_action'),
		'ds_branch_id' => set_value('ds_branch_id', $row->ds_branch_id),
		'ds_branch_name' => set_value('ds_branch_name', $row->ds_branch_name),
		'ds_branch_code' => set_value('ds_branch_code', $row->ds_branch_code),
	    );
            $this->load->view('branch/ds_branch_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('branch'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('ds_branch_id', TRUE));
        } else {
            $data = array(
		'ds_branch_name' => $this->input->post('ds_branch_name',TRUE),
		'ds_branch_code' => $this->input->post('ds_branch_code',TRUE),
	    );

            $this->Branch_model->update($this->input->post('ds_branch_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('branch'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Branch_model->get_by_id($id);

        if ($row) {
            $this->Branch_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('branch'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('branch'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ds_branch_name', 'ds branch name', 'trim|required');
	$this->form_validation->set_rules('ds_branch_code', 'ds branch code', 'trim|required');

	$this->form_validation->set_rules('ds_branch_id', 'ds_branch_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Branch.php */
/* Location: ./application/controllers/Branch.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-11-22 09:28:41 */
/* http://harviacode.com */