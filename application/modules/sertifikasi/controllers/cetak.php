<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cetak extends CI_Controller {

    public function __construct() {
        parent::__construct();
		//$this->api_sia = $this->s00_lib_api;
		$this->api = $this->s00_lib_api;
		$this->load->library('it00_lib','','lib_basic');
    }

    public function index($view = '', $arr = '') {
		require_once('includes/pdf_report/config/lang/eng.php');
		require_once('includes/pdf_report/ICTpdf.php');
		
		#init class
		$pdf = new ICTpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		#lebih lanjut lihat di {includes/pdf_report/SIApdf.php}
		$data = array('pdf_title' => 'Judule PDF', 'pdf_margin' => array(25,5,10,5)); //margin = array(kiri, atas, kanan)
		$pdf->sia_set_properties($data);

		#ukuran kertas milimiter
		$pdf->AddPage('L', array(297,210), false, false);
		$pdf->setPageOrientation('L',true,2);
		$img_file = $arr['det_unit']['TTD'];
		$pdf->Image($img_file, 77, 177, 27.5,20, '','','',true,300,'');
		#tulis konten html ke PDF
		$html = $this->load->view($view,$arr,TRUE);
		// $html = $this->load->view('cetak/surat_bebas_pustaka/vw_surat_bebas_pustaka',array('hai' => 'hai'),TRUE);
		$pdf->writeHTML($html, true, false, true, false, '');
		#finish pdf

		$pdf->lastPage();
		$pdf->Output('sertifikat-'.ceil(microtime(true)).'.pdf', 'I');
	}

	function form()
	{
		if($this->input->post('op') == 'sertifikat-ict'){
			$kd_pst = $this->input->post('kd_pst');
			$dt_cetak = $this->init_surat('sertifikat',$kd_pst);
			$cet_ke = $this->input->post('kerr');
			if($dt_cetak){
				$det_banycet = $this->lib_basic->select_row('T_BANYCET', array('PRE_USER' => $kd_pst,'BC_KE' => $cet_ke));
				if($det_banycet == TRUE){
					#UPDATE
					$this->lib_basic->update('T_BANYCET',array('BC_KE' => $cet_ke, 'BC_TGL' => time()),array('BC_KE' => $cet_ke, 'PRE_USER' => $kd_pst));
				}
				else{
					#INSERT
					$aksi = $this->lib_basic->insert('T_BANYCET',array('PRE_USER' => $kd_pst, 'BC_KE' => $cet_ke, 'BC_TGL' => time()));
					//print_r($aksi); die();
				}
				$this->index('cetak/cetak_sertifikat',$dt_cetak);
				// print_r($dt_cetak); die();
			}else{	echo "Data tidak dapat ditampilkan."; }				
		}else{	echo "ERROR CODE: 750P0N";	}		
	}

	function convert_nil2hrf($nil){
		if (($nil>85)&&($nil<101)) return "A";
		elseif (($nil>70)&&($nil<86)) return "B";
		elseif (($nil>55)&&($nil<71)) return "C";
		elseif (($nil>40)&&($nil<56)) return "D";
		elseif (($nil>=0)&&($nil<41)) return "E";
		else return "-";
	}
	
	function convert_nil2harkat($nil){
		if (($nil>85)&&($nil<101)) return "Sangat Memuaskan";
		elseif (($nil>70)&&($nil<86)) return "Memuaskan";
		elseif (($nil>55)&&($nil<71)) return "Cukup";
		elseif (($nil>40)&&($nil<56)) return "Kurang";
		elseif (($nil>=0)&&($nil<41)) return "Sangat Kurang";
		else return "-";
	}
	private function init_surat($op='',$kd_pst='')
	{
		if($op == 'sertifikat')
		{
			$get_det_pst = $this->lib_basic->get_jadwal('jad_detail_pst',$kd_pst);
			if($get_det_pst){
				$kd_thn = date('Y');
				$kd_smt = $this->session->userdata('kd_smt');
				$tgl  = date('d/m/Y',strtotime($get_det_pst['PER_UJI']));
				$dt_unit = $this->lib_basic->get_data_unit('kepala',$tgl);
				$dt_unit2 = $this->lib_basic->get_data_unit('unit',$tgl);
				$data_mhs = $this->lib_basic->get_data_reg($get_det_pst['PRE_USER']);
				//generateNomor_Surat
				//$kd_jur = $dt_mhs[0]['KD_JURUSAN'];
				$kd_jur = "00";

				#$get_det_pst['tgl_ujian']  = date('d/m/Y',strtotime($get_det_pst['PER_UJI']));
				$get_det_pst['tgl_sertifikat'] = date('d/m/Y');
				$get_det_pst['nomor'] = $this->nomor_surat($kd_pst,$kd_jur,$kd_thn);
				//$get_det_pst['nomor'] = "UIN.02/L.5/PP.00.9/.b.".$kd_jur."/".$kd_thn; 
				$jenis = ($get_det_pst['PER_TIPE'] == '2')? 'UJIAN SERTIFIKASI' : 'TRAINING';
				$get_det_pst['jenis_sertifikat'] = $jenis;
				$get_det_pst['foto'] = '<img src="'.base_url('cetak/foto_peserta/'.$get_det_pst['PRE_PIN']).'">';
				//$get_det_unit = ($dt_unit == true)? $dt_unit[0] : array('NM_PGW_F'=>'Belum ditentukan','KD_PGW' => 'Belum ditentukan');
				if($dt_unit){
					$get_det_unit = $dt_unit[0];
					$get_det_unit['TTD'] = base_url()."cetak/convert_jpg2png/".$dt_unit[0]['KD_PGW'];
				}else{
					$get_det_unit = array('NM_PGW_F'=>'Belum ditentukan','KD_PGW' => 'Belum ditentukan','TTD' => 'Belum ditentukan');
				}

				#detail nilai
				$det_nilai = array(
					'NIL_W' => array('Microsoft Word', $get_det_pst['NIL_W'], $this->convert_nil2hrf($get_det_pst['NIL_W'])),
					'NIL_E' => array('Microsoft Excel', $get_det_pst['NIL_E'], $this->convert_nil2hrf($get_det_pst['NIL_E'])),
					'NIL_P' => array('Microsoft Power Point', $get_det_pst['NIL_P'], $this->convert_nil2hrf($get_det_pst['NIL_P'])),
					'NIL_I' => array('Internet', $get_det_pst['NIL_I'], $this->convert_nil2hrf($get_det_pst['NIL_I'])),
					'NIL_ANGKA' => array('Total Nilai', $get_det_pst['NIL_ANGKA'], $this->convert_nil2hrf($get_det_pst['NIL_ANGKA']), $this->convert_nil2harkat($get_det_pst['NIL_ANGKA'])),
				);
				$m = array(
						'det_mhs' => $data_mhs[0],
						'det_pst' => $get_det_pst,
						'det_unit' => $get_det_unit,
						'det_unit2' => $dt_unit2[0],
						'det_nilai' => $det_nilai,
						);
				 //print_r($m); die();
				return $m;
				//echo "Ddd"; die();
			}

			else{
				return false;
			}
		}
	}

	function foto_peserta($pin='')
	{
		$get_foto = $this->lib_basic->getBlob($pin);
		$foto1 = base64_decode($get_foto[0]['FOTO']);
		$n1 = substr($foto1, -200);
		$n2  = substr($foto1, 0, strlen($foto1) - 200);
		header("Content-type: image/jpeg");
		echo base64_decode($n1.$n2);
		//return $foto;
	}
	
	function convert_jpg2png($nip){
		$url = $this->lib_basic->tf_encode('FOTOTTD#'.$nip.'#QL:100#WM:0#SZ:300');
		$img_url = "http://static.uin-suka.ac.id/foto/pgw/980/".$url.".jpg";
		$image = imagecreatefromjpeg($img_url);
		$img_blend = imagealphablending($image, true);
		$transparentcolour = imagecolorallocate($image, 255,255,255);
		$xx = imagecolortransparent($image, $transparentcolour);
		
		header( 'Content-Type: image/png' );
		imagepng( $image, null, 1 );
	}

	function nomor_surat($kd_pst,$kd_jur,$thn){
		/* nomor auto increment */
		$get_nomor = $this->lib_basic->select_row('LOG_SURAT',array('PRE_USER' => $kd_pst));
		if($get_nomor == false){
			$increment = $this->lib_basic->nomor_urut_sertifikat();
			$no_surat = 'UIN-02/L3/PP.00.9/'.$kd_jur.'.'.$increment.'/'.$thn;
			$arr = array(
					'PRE_USER' => $kd_pst, 			'NO_SURAT' => $no_surat,
					'PERIHAL'=>'SERTIFIKAT ICT',	'TGL_SURATX0X' => 'SYSDATE',
					'OPERATOR' => $this->session->userdata('username'),
					'KD_UNIT' => 'UN01010',			'KD_SUB_SURAT' => 'ST01');
			$this->lib_basic->insert('LOG_SURAT',$arr);
			$get_nomor = $this->lib_basic->select_row('LOG_SURAT',array('PRE_USER' => $kd_pst));
			//print_r($get_nomor); die();
		}
		return $get_nomor['NO_SURAT'];
		
	}

	function nomor_surat2($thn,$smt){
		$tgl = '01/11/2014'; #thn 2014 smt 1
		$tgl1 = '01/09/'.$thn;
		$thn = "";
		$kd_jur = "50";
		$no_urut = "5";
		//$thn = date('Y')+1;
		$token = ($smt == '1')?'0':'1';
		$n = 1455 + intval($token) + ((intval($thn) - 2014) * 2);
		echo "UIN.02/L5/PP.00.9/".$n.".b.".$kd_jur.".".$no_urut."/".$thn;
	}

}