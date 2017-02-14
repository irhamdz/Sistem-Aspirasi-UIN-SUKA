<?php
/**
* 
*/
class Verifikasi_c extends CI_Controller
{
	
	

	function __construct()
	{
		parent::__construct();
		$this->load->library('webserv');
	}

	function index()
	{
		
	}


	function cetak_verifikasi($pen,$ru,$jd) {
		
		$data['kode_penawaran']=$pen;
		$data['id_ruang']=$ru;
		$data['kode_jadwal']=$jd;
		$kirim=array('DATA_ALBUM'=>$data);
		$hasil=$this->webserv->admisi('cetak/cetak_cover_album',$kirim);
		$cetak_data=array();
		foreach ($hasil as $album) {
			$cetak_data['cover']=(array)$album;
		}
		$al=array('tahun'=>$album->tahun,'kode_penawaran'=>$pen);
		$cari=array('ALBUM'=>$al);
		$data_sampul=$this->webserv->admisi('input_data/album',$cari);
		if(!is_null($data_sampul))
		{
			foreach ($data_sampul as $sampul) {
			$cetak_data['cover']+= (array)$sampul;
			}
		}
		
		$jadwal=array('CARI_TANGGAL'=>$data);
		$tgl="";
		$hasjad=$this->webserv->admisi('input_data/cari_detail_jadwal',$jadwal);
		if($hasjad)
		{
			foreach ($hasjad as $hj) {
				$tgl=$hj->tanggal;
			}
		}
		$cetak_data['jadwal']=$this->tanggal_hari(date_format(date_create($tgl),'d-m-Y'));
		
		$this->data_uin=$this->webserv->admisi('data_form/data_uin2',array());
		if(!is_null($this->data_uin))
		{
			foreach ($this->data_uin as $du)
			{
				$cetak_data['kampus']= (array)$du;
			} 
			
		}
		$mhs['kode_penawaran']=$pen;
		$mhs['id_ruang']=$ru;
		$mhs['kode_jadwal']=$jd;
		$kirim=array('DATA_MHS'=>$mhs);
		$hasil_mhs=$this->webserv->admisi('cetak/cetak_album',$kirim);
		$cetak_data['mhs']=$hasil_mhs;

		require_once('includes/pdf_report2/config/lang/eng.php');
		require_once('includes/pdf_report2/PUSTAKApdf.php');
		#init class
		$pdf = new PUSTAKApdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		#lebih lanjut lihat di {includes/pdf_report/SIApdf.php}
		$data = array('pdf_title' => 'Album Ujian', 'pdf_margin' => array(20,20,20,20)); //margin = array(kiri, atas, kanan)
		$pdf->sia_set_properties($data);
		
		#set base font
	//$pdf->SetFont('helvetica', '', 10);	
		#ukuran kertas milimiter
	//	$pdf->AddPage('P', array(210,297), false, false);
	//	$pdf->setPageOrientation('P',true,2);
		#tulis konten html ke PDF
		#$html = "halo";
		

		$html=$this->load->view('verifikasi',$cetak_data,TRUE);
		
	//	$pdf->writeHTML($html, true, false, true, false, '');
		#finish pdf
	//$pdf->lastPage();
		
	//$pdf->Output('album-'.ceil(microtime(true)).'.pdf', 'I');
echo $html;
	} 

function tanggal_hari($tanggal){
	$tgl=explode("-",$tanggal);
	$info=date('w', mktime(0,0,0,$tgl[1],$tgl[0],$tgl[2]));
	switch($tgl[1]){
			case '01': $bulan= "Januari"; break;
			case '02': $bulan= "Februari"; break;
			case '03': $bulan= "Maret"; break;
			case '04': $bulan= "April"; break;
			case '05': $bulan= "Mei"; break;
			case '06': $bulan= "Juni"; break;
			case '07': $bulan= "Juli"; break;
			case '08': $bulan= "Agustus"; break;
			case '09': $bulan= "September"; break;
			case '10': $bulan= "Oktober"; break;
			case '11': $bulan= "Nopember"; break;
			case '12': $bulan= "Desember"; break;
		};
		switch($info){
			case '0': $hari= "Minggu"; break;
			case '1': $hari= "Senin"; break;
			case '2': $hari= "Selasa"; break;
			case '3': $hari= "Rabu"; break;
			case '4': $hari= "Kamis"; break;
			case '5': $hari= "Jumat"; break;
			case '6': $hari= "Sabtu"; break;
		};
	$tampil_tanggal=$hari.", ".$tgl[0]." ".$bulan." ".$tgl[2];
	return $tampil_tanggal;
}
	
}