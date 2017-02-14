<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian_model extends CI_Model {
	  	
	function nilai_akreditasi(){
		$p=$this->db->query("SELECT PILIHAN_AKTIF,PT_AKTIF FROM CONFIG WHERE ID_CONFIG='1'")->row();
		$data['pilihan']=$pilihan=$p->PILIHAN_AKTIF;
		$ptn=$p->PT_AKTIF;
			$aks=$this->db->get('BOBOT_AKREDITASI_SEKOLAH')->result();
			$data['bobot_akreditasi_sekolah']=$aks;
			$arr_aks=array();
			foreach($aks as $a){
				$arr_aks[$a->AKREDITASI_SEKOLAH]=$a->NILAI_AKREDITASI_SEKOLAH;
			}
			
			$jurusan=$this->db->query("SELECT ID_JURUSAN,AKREDITASI,NILAI_AKREDITASI FROM JURUSAN_SEKOLAH")
						->result();
			$arr_aj=array();			
			foreach($jurusan as $j){
				$arr_aj[$j->ID_JURUSAN]=$j->AKREDITASI;
			}	
						
			$nakreditasi=$this->db->query("SELECT SISWA.NOMOR_PENDAFTARAN, NAMA_SISWA,JURUSAN_SEKOLAH.KODE_JURUSAN,SISWA.ID_JURUSAN, 
								SEKOLAH2.AKREDITASI_SEKOLAH,SEKOLAH2.JENIS_SEKOLAH FROM SISWA LEFT JOIN 
								JURUSAN_SEKOLAH ON JURUSAN_SEKOLAH.ID_JURUSAN=SISWA.ID_JURUSAN
								LEFT JOIN SEKOLAH2 ON SEKOLAH2.NPSN=SISWA.NPSN_SEKOLAH 
								LEFT JOIN ( 
								SELECT DISTINCT NOMOR_PENDAFTARAN,URUTAN_PTN FROM PILIHAN ) PILIHAN ON PILIHAN.NOMOR_PENDAFTARAN=SISWA.NOMOR_PENDAFTARAN WHERE  URUTAN_PTN='".$ptn."'
								ORDER BY SISWA.NOMOR_PENDAFTARAN ASC
								")
								->result();
			$arr_na=array();					
			foreach($nakreditasi as $na){
				if($na->AKREDITASI_SEKOLAH!=NULL){
					$akreditasi=$na->AKREDITASI_SEKOLAH;
				}else{
					$akreditasi=$arr_aj[$na->ID_JURUSAN];
				}
				if($akreditasi!=null){
					$nilai_akreditasi=$arr_aks[$akreditasi];
				}else{
					$nilai_akreditasi=$arr_aks['D'];
				}
				$arr_na[]=array('NOMOR_PENDAFTARAN'=>$na->NOMOR_PENDAFTARAN,
								'NAMA_SISWA'=>$na->NAMA_SISWA,
								'AKREDITASI'=>$akreditasi,
								'NILAI_AKREDITASI'=>$nilai_akreditasi );
			}
		return $arr_na;
	}
	
	function bobot_akreditasi_sekolah(){
		return $aks=$this->db->get('BOBOT_AKREDITASI_SEKOLAH')->result();
			
	}		
	
}
