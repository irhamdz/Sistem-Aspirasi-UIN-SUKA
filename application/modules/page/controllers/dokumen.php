<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dokumen extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('format_tanggal');
		$this->load->library('pagination');
		$this->load->model('page/page_model');
	}
 
   public function jadwal($uri=0){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Jadwal & Brosur PMB', '/');
		$data['jadwal'] = $this->webserv->admisi('document/get_document',array('ID'=>1));
		$data['brosur'] = $this->webserv->admisi('document/get_document',array('ID'=>2));
		$data['content']="page/dokumen/jadwal_view";
		$this->load->view('page/header',$data);
		$this->load->view('page/content_2');
		$this->load->view('page/footer');
		
   }

   public function pembayaran($uri=0){
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Panduan dan Tarif Pembayaran', '/');
		$data['panduan'] = $this->webserv->admisi('document/get_document',array('ID'=>3));
		$data['tarif'] = $this->webserv->admisi('document/get_document',array('ID'=>4));
		$data['content']="page/dokumen/bayar_view";
		$this->load->view('page/header',$data);
		$this->load->view('page/content_2');
		$this->load->view('page/footer');
		
   }

	function docfile($id='',$url=""){
		$data= $this->webserv->admisi('document/docfile',array('ID'=>$id));
		$file_isi = $data->file;
		$file_nama = $data->nama_histori;
		if($file_nama){
			header("Content-Type: application/pdf");
			flush();
			echo base64_decode($file_isi);
			exit;
		}else{
			echo "Thanks for landing captain!";
		} 
	} 

	function sourcefile($id='',$url=""){
		$this->load->helper('file');
		$data= $this->webserv->admisi('document/sourcefile',array('ID'=>$id));
		$file_isi = $data->file_sumber;
		$file_nama = $data->nama_file_sumber;
		$mime = get_mime_by_extension($file_nama);
		if($file_nama){
			header("Content-Type: ".$mime);
			flush();
			echo base64_decode($file_isi);
			exit;
		}else{
			echo "Thanks for landing captain!";
		} 
	}
 
}
 
/* End of file dokumen.php */
