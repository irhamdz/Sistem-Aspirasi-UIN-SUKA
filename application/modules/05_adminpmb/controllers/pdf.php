<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cetak extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->api_sia = $this->s00_lib_api;
		$this->load->library('p01_lib_basic','','lib_basic');

    }

    public function index($view = '', $arr = '') {
		require_once('includes/pdf_report/config/lang/eng.php');
		require_once('includes/pdf_report/PUSTAKApdf.php');
		
		#init class
		$pdf = new PUSTAKApdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		#lebih lanjut lihat di {includes/pdf_report/SIApdf.php}
		$data = array('pdf_title' => 'Judule PDF', 'pdf_margin' => array(20,20,20,20)); //margin = array(kiri, atas, kanan)
		$pdf->sia_set_properties($data);
		
		#set base font
	//	$pdf->SetFont('helvetica', '', 10);

			
		#ukuran kertas milimiter
		$pdf->AddPage('P', array(210,297), false, false);
		$pdf->setPageOrientation('P',true,2);
		#tulis konten html ke PDF
		$html = $this->load->view($view,$arr,TRUE);
		// $html = $this->load->view('cetak/surat_bebas_pustaka/vw_surat_bebas_pustaka',array('hai' => 'hai'),TRUE);
		$pdf->writeHTML($html, true, false, true, false, '');

		#finish pdf
		$pdf->lastPage();
		$pdf->Output('sertifikat-'.ceil(microtime(true)).'.pdf', 'I');
	}

	function form($op = null)
	{
		if($op == 'surat-bebaspustaka')
		{
			$nim = $this->input->post('nim');
			$dt_cetak = $this->init_surat('surat_bp',$nim);
			if($dt_cetak)
			{
				$this->index('cetak/surat_bebas_pustaka/vw_surat_bebas_pustaka',$dt_cetak);
			}
			else
			{
				echo "Data tidak dapat ditampilkan.";		
			}
		}
		elseif($op == 'surat-bukti-ta')
		{
			$nim = $this->input->post('nim');
			$dt_cetak = $this->init_surat('bukti_ta',$nim);
			if($dt_cetak)
			{
				$this->index('cetak/surat_bukti_penyerahan_ta/vw_surat_bukti_ta',$dt_cetak);
			}
			else
			{
				echo "Data tidak dapat ditampilkan.";		
			}
		}
		else
		{
			echo "ERROR CODE: 750P0N";
		}		
	}

	private function init_surat($op='',$nim='')
	{
		$dt_mhs = $this->lib_basic->get_data_mhs($nim);
	
		if($op == 'surat_bp')
		{
			if($dt_mhs){
				$dt_bp = $this->lib_basic->get_pustaka('pustaka',$nim);
				$date_bp  = date('d/m/Y',strtotime($dt_bp['tgl_bebas_pustaka']));
				$dt_bp['tgl_surat'] = date_trans_foracle($date_bp,1,'0 231 111',' ');
				$nip = str_replace(" ","",$this->session->userdata('id_user'));
				$dt_peg = $this->lib_basic->get_data_pegawai($nip);
				$dt_op = ($dt_peg == TRUE)? array('nama' => $dt_peg[0]['NM_DOSEN_F'], 'nip' => $nip) : false;
				$m = array(
						'mhs' => $dt_mhs[0],
						'bp' => $dt_bp,
						'op' => $dt_op,
						);
				return $m;	
			}

			else{
				return false;
			}			
		}
		elseif ($op == 'bukti_ta')
		{
			if($dt_mhs){
				$dt_bebas = $this->lib_basic->get_data_bebas($nim);
				$date_penyerahan  = date('d/m/Y',strtotime($dt_bebas['HARDCOPY_TGL']));
				$dt_bebas['tgl_surat'] = date_trans_foracle($date_penyerahan,1,'0 231 111',' ');
				$nip = str_replace(" ","",$this->session->userdata('id_user'));
				$dt_peg = $this->lib_basic->get_data_pegawai($nip);
				$dt_op = ($dt_peg == TRUE)? array('nama' => $dt_peg[0]['NM_DOSEN_F'], 'nip' => $nip) : false;
				$m = array(
						'mhs' => $dt_mhs[0],
						'bukti_ta' => $dt_bebas,
						'op' => $dt_op,
						);
				return $m;
			}

			else{
				return false;
			}
		}
	}

	function view($op='')
	{
		if($op == 'pdf')
		{
			//$nim = $this->input->post('nim');
			$url = $this->input->post('url');
			if($url){
				$msg = '<iframe src="http://docs.google.com/viewer?url='.$link.'&amp;embedded=true"  width="100%" style="border: none; margin-bottom:10px;"></iframe>';
				echo json_encode($msg);
			}
			else{
				$msg = '<iframe src="https://docs.google.com/viewer?url=http://pustaka.uin-suka.ac.id/uplottt/1/09650050_RINGKAS.pdf&amp;embedded=true"  style="border: none; margin-bottom:10px;"></iframe>';
				echo $msg;
			}

			
			/*$dt_cetak = $this->init_surat('surat_bp',$nim);
			if($dt_cetak)
			{
				$this->index('cetak/surat_bebas_pustaka/vw_surat_bebas_pustaka',$dt_cetak);
			}
			else
			{
				;
			}*/
		}	
	}
		
}

//$this->load->view('file',$data,true); == '<b>bold</b>';
//false == echo '<b>bold</b>'