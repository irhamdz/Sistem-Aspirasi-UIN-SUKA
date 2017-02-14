<?php
/**
* 
*/
class Cetak_pengumuman extends CI_Controller
{
	
	

	function __construct()
	{
		parent::__construct();
				$this->load->helper('tanggal_lahir_helper');
	}

	function index()
	{
		
	}

	function load_config_doc($doc)
	{
		$data['id_dokumen']=$doc;
		$kirim=array("DOC"=>$data);
		$hasil=$this->webserv->yudisium("yudisium/cari_setting_dokumen",$kirim);
		
		
		if($hasil)
		{
			return $hasil;
		}
	}

	function cari_data_yudisium($jalur,$gel,$penawaran,$tahun,$kelas,$prodi,$id_doc) {

		$data['kode_jalur']=$jalur;
		$data['gelombang']=$gel;
		$data['kode_penawaran']=$penawaran;
		$data['tahun']=$tahun;
		$data['id_kelas']=$kelas;
		$data['id_prodi']=$prodi;
		$kirim=array('YUDISIUM'=>$data);
		$hasil['data_mhs']=$this->webserv->yudisium('yudisium/cari_data_yudisium',$kirim);
		$hasil['prodi']=$this->webserv->yudisium('yudisium/cari_prodi',$kirim);
		if($hasil)
		{
			$hasil['data_lengkap_mhs']=$this->webserv->yudisium('yudisium/data_mhs',$kirim);
			$hasil['data_kelas']=$this->webserv->yudisium('yudisium/penawaran_kelas',$kelas);
			foreach ($hasil['prodi'] as $pr);
			$hasil['nama_prodi']=$pr->nama_prodi;
		
		$hasil['config']=$this->load_config_doc($id_doc);
		$hasil['tes']=$kirim;
		
		require_once('includes/pdf_report2/config/lang/eng.php');
		require_once('includes/pdf_report2/PUSTAKApdf.php');
		#init class
		$pdf = new PUSTAKApdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		#lebih lanjut lihat di {includes/pdf_report/SIApdf.php}
		$data = array('pdf_title' => 'YUDISIUM', 'pdf_margin' => array(20,20,20,20)); //margin = array(kiri, atas, kanan)
		$pdf->sia_set_properties($data);
		
		#set base font
	//	$pdf->SetFont('helvetica', '', 10);	
		#ukuran kertas milimiter
		$pdf->AddPage('P', array(210,297), false, false);
		$pdf->setPageOrientation('P',true,2);
		#tulis konten html ke PDF
		
		$html=$this->load->view('v_table/daftar_hasil_yudisium',$hasil,TRUE);
		
		$pdf->writeHTML($html, true, false, true, false, '');
		#finish pdf
		$pdf->lastPage();
		
		$pdf->Output('YUDISIUM-'.ceil(microtime(true)).'.pdf', 'I');
		//echo $html;
		}
		

	}
	

	function cari_data_yudisium_html($jalur,$gel,$penawaran,$tahun,$kelas,$prodi,$id_doc) {

		$data['kode_jalur']=$jalur;
		$data['gelombang']=$gel;
		$data['kode_penawaran']=$penawaran;
		$data['tahun']=$tahun;
		$data['id_kelas']=$kelas;
		$data['id_prodi']=$prodi;
		$kirim=array('YUDISIUM'=>$data);
		$hasil['data_mhs']=$this->webserv->yudisium('yudisium/cari_data_yudisium',$kirim);
		$hasil['prodi']=$this->webserv->yudisium('yudisium/cari_prodi',$kirim);
		if($hasil)
		{
			$hasil['data_lengkap_mhs']=$this->webserv->yudisium('yudisium/data_mhs',$kirim);
			$hasil['data_kelas']=$this->webserv->yudisium('yudisium/penawaran_kelas',$kelas);
			foreach ($hasil['prodi'] as $pr);
			$hasil['nama_prodi']=$pr->nama_prodi;
		
		$hasil['config']=$this->load_config_doc($id_doc);
		$hasil['tes']=$kirim;
		
		$html=$this->load->view('v_table/daftar_hasil_yudisium',$hasil,TRUE);
		
		echo $html;
		}
		

	}

	function cari_data_yudisium_excel($jalur,$gel,$penawaran,$tahun,$kelas,$prodi,$id_doc) {

		$data['kode_jalur']=$jalur;
		$data['gelombang']=$gel;
		$data['kode_penawaran']=$penawaran;
		$data['tahun']=$tahun;
		$data['id_kelas']=$kelas;
		$data['id_prodi']=$prodi;
		$kirim=array('YUDISIUM'=>$data);
		$hasil['data_mhs']=$this->webserv->yudisium('yudisium/cari_data_yudisium',$kirim);
		$hasil['prodi']=$this->webserv->yudisium('yudisium/cari_prodi',$kirim);
		if($hasil)
		{
			$hasil['data_lengkap_mhs']=$this->webserv->yudisium('yudisium/data_mhs',$kirim);
			$hasil['data_kelas']=$this->webserv->yudisium('yudisium/penawaran_kelas',$kelas);
			foreach ($hasil['prodi'] as $pr);
			$hasil['nama_prodi']=$pr->nama_prodi;
		
		$hasil['config']=$this->load_config_doc($id_doc);
		$hasil['tes']=$kirim;
		
		$html=$this->load->view('v_table/daftar_hasil_yudisium_xls',$hasil,TRUE);
		
		echo $html;
		}
		

	}

}