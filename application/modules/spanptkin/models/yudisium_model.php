<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yudisium_model extends CI_Model {
	  	
	function set_config(){
		$query=$this->db->get('CONFIG');
		return $query->result();
	
	} 	
	function rekap_peminat($ptn=0){
				$peminat=$this->db->query("SELECT PROGRAM_STUDI.PROGRAM_STUDI,URUTAN_PROGRAM_STUDI,COUNT(PILIHAN.KODE_PROGRAM_STUDI) JUMLAH FROM PILIHAN 
									LEFT JOIN PROGRAM_STUDI ON PROGRAM_STUDI.KODE_PROGRAM_STUDI=PILIHAN.KODE_PROGRAM_STUDI 
									WHERE PILIHAN.URUTAN_PTN='".$ptn."'
									GROUP BY PROGRAM_STUDI.PROGRAM_STUDI,URUTAN_PROGRAM_STUDI 
									ORDER BY PROGRAM_STUDI.PROGRAM_STUDI,URUTAN_PROGRAM_STUDI  ASC")->result_array();
			$arr_peminat=array();
			foreach($peminat as $p){
				if(!isset($arr_peminat[$p['PROGRAM_STUDI']])) {
					$arr_peminat[$p['PROGRAM_STUDI']] = array();
				}
				$arr_peminat[$p['PROGRAM_STUDI']][] = $p;
			}	
			return $arr_peminat;
	}	
	function diterima_ptn_lain(){
				$peminat=$this->db->query("SELECT PROGRAM_STUDI.PROGRAM_STUDI,COUNT(PILIHAN.KODE_PROGRAM_STUDI) JUMLAH FROM PILIHAN 
									LEFT JOIN PROGRAM_STUDI ON PROGRAM_STUDI.KODE_PROGRAM_STUDI=PILIHAN.KODE_PROGRAM_STUDI 
									WHERE DITERIMA_PTN_LAIN='1'
									GROUP BY PROGRAM_STUDI.PROGRAM_STUDI
									ORDER BY PROGRAM_STUDI.PROGRAM_STUDI  ASC")->result_array();
			$arr_peminat=array();
			foreach($peminat as $p){
				if(!isset($arr_peminat[$p['PROGRAM_STUDI']])) {
					$arr_peminat[$p['PROGRAM_STUDI']] = array();
				}
				$arr_peminat[$p['PROGRAM_STUDI']][] = $p;
			}	
			return $arr_peminat;
	}
	
	function rekap_nilai($ptn=0){
			$bobot=$this->db->get('PEMBOBOTAN')->result_array();
			foreach($bobot as $b){
				$bobot[$b['KODE_NILAI']]=$b['BOBOT'];
			}
			$nilai=$this->db->query("SELECT PROGRAM_STUDI,URUTAN_PROGRAM_STUDI,COUNT(SELISIH_KUADRAT), SUM(SELISIH_KUADRAT) ,
				MAX(TOTAL_NILAI) MAKSIMAL, MIN(TOTAL_NILAI) MINIMAL,AVG(TOTAL_NILAI) RERATA,
				SQRT(SUM(SELISIH_KUADRAT)/COUNT(SELISIH_KUADRAT)) SD FROM (
				SELECT TN.NOMOR_PENDAFTARAN,TN.KODE_PROGRAM_STUDI,TN.URUTAN_PROGRAM_STUDI,TN.TOTAL_NILAI,RN.JML,RN.RERATA,
				POWER((TN.TOTAL_NILAI-RN.RERATA),2) SELISIH_KUADRAT FROM(
				SELECT NILAI_YUDISIUM.NOMOR_PENDAFTARAN,NILAI_YUDISIUM.KODE_PROGRAM_STUDI,NILAI_YUDISIUM.URUTAN_PROGRAM_STUDI,
				(
						(NILAI_YUDISIUM.NILAI_TPA*".$bobot['NILAI_TPA'].")+
						(NILAI_DIRASAH*".$bobot['NILAI_DIRASAH'].")+
						(NILAI_BAHASA*".$bobot['NILAI_BAHASA']."))/100 TOTAL_NILAI 
				FROM NILAI_YUDISIUM
				WHERE URUTAN_PTN='".$ptn."'
				
				) TN
				LEFT JOIN (
				SELECT KODE_PROGRAM_STUDI,URUTAN_PROGRAM_STUDI, RERATA,JML FROM(
				SELECT KODE_PROGRAM_STUDI,URUTAN_PROGRAM_STUDI,COUNT(NILAI_YUDISIUM.NOMOR_PENDAFTARAN) JML,
				AVG(( (NILAI_YUDISIUM.NILAI_TPA*".$bobot['NILAI_TPA'].")+
						(NILAI_DIRASAH*".$bobot['NILAI_DIRASAH'].")+
						(NILAI_BAHASA*".$bobot['NILAI_BAHASA']."))/100) RERATA 
				FROM NILAI_YUDISIUM
				WHERE URUTAN_PTN='".$ptn."'
			
				GROUP BY KODE_PROGRAM_STUDI,URUTAN_PROGRAM_STUDI
				)
				)RN
				ON TN.KODE_PROGRAM_STUDI=RN.KODE_PROGRAM_STUDI
				AND TN.URUTAN_PROGRAM_STUDI=RN.URUTAN_PROGRAM_STUDI
				)SQ
				LEFT JOIN PROGRAM_STUDI ON PROGRAM_STUDI.KODE_PROGRAM_STUDI=SQ.KODE_PROGRAM_STUDI
				GROUP BY PROGRAM_STUDI,SQ.URUTAN_PROGRAM_STUDI
				ORDER BY PROGRAM_STUDI,URUTAN_PROGRAM_STUDI ASC")->result_array();
			$arr_nilai=array();
			foreach($nilai as $p){
				if(!isset($arr_nilai[$p['PROGRAM_STUDI']])) {
					$arr_nilai[$p['PROGRAM_STUDI']] = array();
				}
				$arr_nilai[$p['PROGRAM_STUDI']][] = $p;
			}	
			return $arr_nilai;
	}
	
	function rekap_diterima($ptn=0){
			$diterima=$this->db->query("SELECT FAKULTAS.NAMA_FAKULTAS,PROGRAM_STUDI.PROGRAM_STUDI,NILAI_YUDISIUM.URUTAN_PROGRAM_STUDI,COUNT(NILAI_YUDISIUM.NOMOR_PENDAFTARAN) JUMLAH FROM NILAI_YUDISIUM
									RIGHT JOIN PROGRAM_STUDI ON PROGRAM_STUDI.KODE_PROGRAM_STUDI = NILAI_YUDISIUM.KODE_PROGRAM_STUDI
									RIGHT JOIN FAKULTAS ON PROGRAM_STUDI.KODE_FAKULTAS = FAKULTAS.KODE_FAKULTAS
									WHERE NILAI_YUDISIUM.DITERIMA='1' AND URUTAN_PTN='".$ptn."'
									GROUP BY FAKULTAS.NAMA_FAKULTAS,PROGRAM_STUDI.PROGRAM_STUDI,NILAI_YUDISIUM.URUTAN_PROGRAM_STUDI
									ORDER BY URUTAN_PROGRAM_STUDI ASC
								")->result_array();
			$arr_diterima=array();
			foreach($diterima as $p){
				if(!isset($arr_diterima[$p['NAMA_FAKULTAS']])) {
					$arr_diterima[$p['NAMA_FAKULTAS']] = array();
				}
				
				 
				if(!isset($arr_diterima[$p['NAMA_FAKULTAS']][$p['PROGRAM_STUDI']][$p['URUTAN_PROGRAM_STUDI']])) {
					$arr_diterima[$p['NAMA_FAKULTAS']][$p['PROGRAM_STUDI']][$p['URUTAN_PROGRAM_STUDI']] = array();
				}
				 
				if(!isset($arr_diterima[$p['NAMA_FAKULTAS']][$p['PROGRAM_STUDI']][$p['URUTAN_PROGRAM_STUDI']])) {
					$arr_diterima[$p['NAMA_FAKULTAS']][$p['PROGRAM_STUDI']][$p['URUTAN_PROGRAM_STUDI']] = array();
				}
				 $arr_diterima[$p['NAMA_FAKULTAS']][$p['PROGRAM_STUDI']][$p['URUTAN_PROGRAM_STUDI']] = $p;
			}			
			return $arr_diterima;
	}
	function rekap_jenis_kelamin($ptn=0){
			$query=$this->db->query("SELECT JENIS_KELAMIN,COUNT(SISWA.KODE_JENIS_KELAMIN) AS JUMLAH FROM SISWA 
									LEFT JOIN JENIS_KELAMIN ON JENIS_KELAMIN.KODE_JENIS_KELAMIN=SISWA.KODE_JENIS_KELAMIN
									LEFT JOIN (
									SELECT DISTINCT NOMOR_PENDAFTARAN,URUTAN_PTN FROM PILIHAN
									) PILIHAN
									ON PILIHAN.NOMOR_PENDAFTARAN=SISWA.NOMOR_PENDAFTARAN
									WHERE URUTAN_PTN='".$ptn."'
									GROUP BY JENIS_KELAMIN")->result_array();		
									
			return $query;
	}
	function rekap_kabupaten($ptn=0){
			$query=$this->db->query("SELECT SEKOLAH.NAMA_KABUPATEN,SEKOLAH.NAMA_PROVINSI,COUNT(SISWA.NOMOR_PENDAFTARAN) JUMLAH FROM SISWA 
												LEFT JOIN SEKOLAH ON SEKOLAH.NPSN=SISWA.NPSN_SEKOLAH 
									LEFT JOIN (
									SELECT DISTINCT NOMOR_PENDAFTARAN,URUTAN_PTN FROM PILIHAN
									) PILIHAN
									ON PILIHAN.NOMOR_PENDAFTARAN=SISWA.NOMOR_PENDAFTARAN
									WHERE URUTAN_PTN='".$ptn."'
									GROUP BY KODE_PROVINSI,NAMA_PROVINSI,KODE_KABUPATEN,NAMA_KABUPATEN 
									ORDER BY KODE_PROVINSI,KODE_KABUPATEN ASC")->result_array();
			return $query;
	}
	function rekap_provinsi($ptn=0){
			$query=$this->db->query("SELECT SEKOLAH.NAMA_PROVINSI,COUNT(SISWA.NOMOR_PENDAFTARAN) JUMLAH FROM SISWA 
									LEFT JOIN SEKOLAH ON SEKOLAH.NPSN=SISWA.NPSN_SEKOLAH 
									LEFT JOIN (
									SELECT DISTINCT NOMOR_PENDAFTARAN,URUTAN_PTN FROM PILIHAN
									) PILIHAN
									ON PILIHAN.NOMOR_PENDAFTARAN=SISWA.NOMOR_PENDAFTARAN
									WHERE URUTAN_PTN='".$ptn."'
									GROUP BY KODE_PROVINSI,NAMA_PROVINSI ORDER BY KODE_PROVINSI 
									")->result_array();	
			return $query;
	}
}
