<?php
/**
* 
*/
class Data_mhs extends CI_Controller
{
	

	function __construct()
	{
		parent::__construct();
		$this->load->library('webserv');
		
	}

	function index()
	{
		
	}


	function cetak_data_mhs($no, $p) {
		
		//$datax['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		//$datax['kode_penawaran']=$this->input->post('kode_penawaran');
		$datax['nomor_pendaftar']=$no;
		$datax['kode_penawaran']=$p;

		$kirim=array('MHS'=>$datax);
		$data_mhs['diri']=$this->webserv->admisi('data_portofolio/data_diri',$kirim);
		$data_mhs['ibu']=$this->webserv->admisi('data_portofolio/data_ibu',$kirim);
		$data_mhs['ayah']=$this->webserv->admisi('data_portofolio/data_ayah',$kirim);
		$data_mhs['pkj']=$this->webserv->admisi('data_portofolio/data_pekerjaan_mhs',$kirim);
		$data_mhs['sehat']=$this->webserv->admisi('data_portofolio/data_kesehatan_mhs',$kirim);
		$data_mhs['difable']=$this->webserv->admisi('data_portofolio/data_mhs_difable',$kirim);
		$jalur="0";
		switch (substr($datax['kode_penawaran'], 0,1)) {
			case '1':
				# code...
			$jalur="data_dokumen_s1";
			$jal=1;
				break;
			case '2':
			$jalur="data_dokumen_s2";
			$jal=2;
				break;
			case '3':
			$jalur="data_dokumen_s2";
			$jal=3;
				break;
		}
		
		$data_mhs['dokumen']=$this->webserv->admisi('data_portofolio/'.$jalur,$kirim);
		$data_mhs['jalur']=$jal;
		$data_mhs['prestasi']=$this->webserv->admisi('data_portofolio/data_prestasi',$kirim);
		$data_mhs['karya']=$this->webserv->admisi('data_portofolio/data_publikasi',$kirim);
		$data_mhs['proposal']=$this->webserv->admisi('data_portofolio/data_proposal',$kirim);
		$data_mhs['piljur']=$this->webserv->admisi('data_portofolio/data_pilihan_jurusan',$kirim);

		
		require_once('includes/pdf_report2/config/lang/eng.php');
		require_once('includes/pdf_report2/PUSTAKApdf.php');
		#init class
		$pdf = new PUSTAKApdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		#lebih lanjut lihat di {includes/pdf_report/SIApdf.php}
		$data = array('pdf_title' => 'Album Ujian', 'pdf_margin' => array(20,20,20,20)); //margin = array(kiri, atas, kanan)
		$pdf->sia_set_properties($data);
		
		#set base font
		$pdf->SetFont('helvetica', '', 10);	
		#ukuran kertas milimiter
		$pdf->AddPage('P', array(210,297), false, false);
		$pdf->setPageOrientation('P',true,2);
		#tulis konten html ke PDF
		#$html = "halo";
	

		$html=$this->load->view('data_mhs_lengkap',$data_mhs,TRUE);

		$pdf->WriteHTML($html, true, false, true, false, '');
		#finish pdf
		$pdf->lastPage();
		
		$pdf->Output('Data_mahasiswa'.ceil(microtime(true)).'.pdf', 'I');
		//echo $html;
		
	}
	
}