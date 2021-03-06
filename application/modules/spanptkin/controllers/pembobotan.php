<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembobotan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('lib_yudisium');
            $this->load->library('Webserv');
    }

	function index(){		
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Pembobotan', '/');
		if($_POST == null){
			$data['config']=$this->webserv->spanptkin('penilaian/get_config');
			$data['pembobotan']=$this->webserv->spanptkin('penilaian/get_bobot');
			#print_r($data['pembobotan']);
			$data['content']='spanptkin/pembobotan_view';
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
		}else{
			$bobot=$this->input->post('bobot');
			$nilai=$this->input->post('nilai');
			$postdata=array(
				'BOBOT'=>$bobot,
				'NILAI'=>$nilai,
			);
			$result=$this->webserv->spanptkin('penilaian/set_pembobotan',$postdata);
			if($result){
			$this->session->set_flashdata('message',array("success","Data pembobotan berhasil disimpan."));
			}else{
			$this->session->set_flashdata('message',array("error","Data gagal berhasil disimpan."));
			}
			redirect('spanptkin/pembobotan');
		}	
		
	}

	function set_putaran(){		
		if($_POST == null){
			redirect('spanptkin/pembobotan');
		}else{
			$putaran=$this->input->post('putaran');
			$postdata=array('PUTARAN'=>$putaran);
			$result=$this->webserv->spanptkin('penilaian/set_config',$postdata);
			if($result){
			$this->session->set_flashdata('message',array("success","Data pembobotan berhasil disimpan."));
			}else{
			$this->session->set_flashdata('message',array("error","Data gagal berhasil disimpan."));
			}
			redirect('spanptkin/pembobotan');
		}	
		
	}


	
}
