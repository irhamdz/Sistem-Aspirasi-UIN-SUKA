<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian extends CI_Controller {
    public function __construct(){
            parent::__construct();
            $this->load->library('lib_yudisium');
            $this->load->library('Webserv');
          //  $this->load->library('s00_lib_api');
			$data=$this->session->all_userdata();
			/* if(!isset($data['id_user'])){
					redirect(base_url());
			}	 */
    }
	
	function set_prodi($url="",$prodi=""){
		$this->session->set_userdata(array('kd_prodi'=>$prodi));
		redirect('spanptkin/penilaian/'.$url);
	}
	
/*== PEHITUNGAN NILAI AKREDITASI ==*/
	function nilai_akreditasi(){
		if($_POST == null){
			$data['bobot_akreditasi_sekolah']=$this->penilaian_model->bobot_akreditasi_sekolah();
			$data['na']=$this->penilaian_model->nilai_akreditasi();
			$this->load->view('admin/header',$data);					
			$this->load->view('admin/menu');				
			$this->load->view('yudisium/penilaian/nilai_akreditasi');
			$this->load->view('admin/footer');
		}else{
			$bas=$this->input->post('bas');
			foreach($bas as $akreditasi=>$nilai){
				$this->db->where('AKREDITASI_SEKOLAH',$akreditasi)
						->update('BOBOT_AKREDITASI_SEKOLAH',array('NILAI_AKREDITASI_SEKOLAH'=>$nilai));
			}
			$na=$this->penilaian_model->nilai_akreditasi();
			foreach($na as $na){
				$this->db->where(array('NOMOR_PENDAFTARAN'=>$na['NOMOR_PENDAFTARAN']))
					->update('NILAI_YUDISIUM',array('NILAI_AKREDITASI'=>$na['NILAI_AKREDITASI']));

			}
			$this->session->set_flashdata('message',array("error","Data nakreditasi sekolah berhasil disimpan."));
			redirect('yudisium/penilaian/nilai_akreditasi');
		}	
	} 	
/*== PEHITUNGAN PERINGKAT SEKOLAH ==*/
	function nilai_peringkat_sekolah(){
		$dp=$this->webserv->spanptkin('penilaian/get_prodi');
		$data['prodi']=$dp;
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		$p=$this->webserv->spanptkin('penilaian/get_putaran');
		$data['pilihan']=$pilihan=$p->pilihan_aktif;
		$ptn=$p->pt_aktif;	
		//print_r($arr_na);
		if($_POST == null){
			$arr_na=$this->webserv->spanptkin('penilaian/get_peringkat_sekolah',array('KD_PRODI'=>$kd_prodi,'PTN'=>$ptn));
			$data['na']=$arr_na;
			$data['content']='spanptkin/penilaian/nilai_peringkat_sekolah';
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
		}else{
			$rs=$this->lib_yudisium->api_yudisium('spanptkin/yudisium/set_peringkat_sekolah',array('KD_PRODI'=>$kd_prodi,'PTN'=>$ptn));
			//print_r($rs);
			$this->session->set_flashdata('message',array("error","Data nilai peringkat siswa berhasil disimpan."));
			redirect('spanptkin/penilaian/nilai_peringkat_sekolah');
		}	
			
	} 
	/*==PERHITUNGAN NILAI PERINGKAT SISWA ==*/
	function nilai_peringkat_siswa(){
		$p=$this->db->query("SELECT PILIHAN_AKTIF,PT_AKTIF FROM CONFIG WHERE ID_CONFIG='1'")->row();
		$data['pilihan']=$pilihan=$p->PILIHAN_AKTIF;
		$ptn=$p->PT_AKTIF;
		if($_POST == null){
			$data['siswa']=$this->db->query("SELECT SISWA.NOMOR_PENDAFTARAN,NAMA_SISWA,NILAI FROM(
									SELECT RANKING_SISWA.NOMOR_PENDAFTARAN,
									  ((AVG((JUMLAH_SISWA_SEKOLAH-RANKING_SEKOLAH)/JUMLAH_SISWA_SEKOLAH*100))+
									   (AVG((JUMLAH_SISWA_SEKOLAH-RANKING_SEKOLAH_UN)/JUMLAH_SISWA_SEKOLAH*100))+
									   (AVG((JUMLAH_SISWA_JURUSAN-RANKING_JURUSAN)/JUMLAH_SISWA_JURUSAN*100))+
									   (AVG((JUMLAH_SISWA_JURUSAN-RANKING_JURUSAN_UN)/JUMLAH_SISWA_JURUSAN*100)))/4 NILAI
									   FROM RANKING_SISWA
									WHERE RANKING_SISWA.RANKING_SEKOLAH > 0
									GROUP BY NOMOR_PENDAFTARAN) RS
									RIGHT JOIN SISWA ON SISWA.NOMOR_PENDAFTARAN = RS.NOMOR_PENDAFTARAN
									LEFT JOIN (
									SELECT DISTINCT NOMOR_PENDAFTARAN,URUTAN_PTN FROM PILIHAN
									) PILIHAN
									ON PILIHAN.NOMOR_PENDAFTARAN=SISWA.NOMOR_PENDAFTARAN
									WHERE URUTAN_PTN='".$ptn."'
									ORDER BY NOMOR_PENDAFTARAN ASC" )->result_array();
			$this->load->view('admin/header',$data);					
			$this->load->view('admin/menu');				
			$this->load->view('yudisium/penilaian/nilai_peringkat_siswa');
			$this->load->view('admin/footer');
		}else{
			$rs=$this->db->query("UPDATE NILAI_YUDISIUM AA SET AA.NILAI_RANKING=(
							SELECT NILAI FROM (
							SELECT SISWA.NOMOR_PENDAFTARAN,NAMA_SISWA,NILAI FROM(
									SELECT RANKING_SISWA.NOMOR_PENDAFTARAN,
									  ((AVG((JUMLAH_SISWA_SEKOLAH-RANKING_SEKOLAH)/JUMLAH_SISWA_SEKOLAH*100))+
									   (AVG((JUMLAH_SISWA_SEKOLAH-RANKING_SEKOLAH_UN)/JUMLAH_SISWA_SEKOLAH*100))+
									   (AVG((JUMLAH_SISWA_JURUSAN-RANKING_JURUSAN)/JUMLAH_SISWA_JURUSAN*100))+
									   (AVG((JUMLAH_SISWA_JURUSAN-RANKING_JURUSAN_UN)/JUMLAH_SISWA_JURUSAN*100)))/4 NILAI
									   FROM RANKING_SISWA
									WHERE RANKING_SISWA.RANKING_SEKOLAH > 0
									GROUP BY NOMOR_PENDAFTARAN) RS
									RIGHT JOIN SISWA ON SISWA.NOMOR_PENDAFTARAN = RS.NOMOR_PENDAFTARAN
									LEFT JOIN (
									SELECT DISTINCT NOMOR_PENDAFTARAN,URUTAN_PTN FROM PILIHAN
									) PILIHAN
									ON PILIHAN.NOMOR_PENDAFTARAN=SISWA.NOMOR_PENDAFTARAN
									WHERE URUTAN_PTN='".$ptn."'
									ORDER BY NOMOR_PENDAFTARAN ASC
							   ) BB
							   WHERE AA.NOMOR_PENDAFTARAN=BB.NOMOR_PENDAFTARAN
							   )");
			if($rs){				   
				$this->session->set_flashdata('message',array("error","Data nilai peringkat siswa berhasil disimpan."));
				redirect('yudisium/penilaian/nilai_peringkat_siswa');
			}
		}	
	} 
	
/*== PEHITUNGAN NILAI AKADEMIK ==*/	
	function nilai_akademik(){
		$dp=$this->webserv->spanptkin('penilaian/get_prodi');
		$data['prodi']=$dp;
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		$p=$this->webserv->spanptkin('penilaian/get_putaran');
		$data['pilihan']=$pilihan=$p->pilihan_aktif;
		$ptn=$p->pt_aktif;	
		if($_POST == null){
			$postdata=array(
					'KD_PRODI'=>$kd_prodi,
					'PTN'=>$ptn
			);
			$data['siswa']=$this->webserv->spanptkin('penilaian/get_nilai_akademik',$postdata);
			//print_r($data['siswa']);die();
			$bobot=$this->webserv->spanptkin('penilaian/get_bobot_mata_pelajaran',array('KD_PRODI'=>$kd_prodi));
			//print_r($bobot);die();
			$arr_bobot=array();
			if(!empty($bobot)){
				foreach($bobot as $p){
					if(!isset($arr_bobot[$p->kode_jenjang])) {
						$arr_bobot[$p->kode_jenjang] = array();
					}
					
					 
					if(!isset($arr_bobot[$p->kode_jenjang][$p->kode_nilai_jurusan])) {
						$arr_bobot[$p->kode_jenjang][$p->kode_nilai_jurusan] = array();
					}
					$arr_bobot[$p->kode_jenjang][$p->kode_nilai_jurusan][] = $p;
				} 
			}
			$data['bobot']=$arr_bobot;
			$data['content']='spanptkin/penilaian/nilai_akademik';
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
			//$this->load->view('s00_vw_all', $data);
		}else{
			$nilai=$this->input->post('nilai');		
			#print_r($nilai);die();
			
			$bobot=$this->webserv->spanptkin('penilaian/set_bobot_mata_pelajaran',array('KD_PRODI'=>$kd_prodi,'NILAI'=>$nilai));
			#print_r($bobot);die();
			$rs=$this->webserv->spanptkin('penilaian/set_nilai_akademik',array('KD_PRODI'=>$kd_prodi,'PTN'=>$ptn));
			#if($rs){
				$this->session->set_flashdata('message',array("error","Data nilai mata pelajaran berhasil disimpan."));
				redirect('spanptkin/penilaian/nilai_akademik');
			#}	
		}	
	} 

/*== PEHITUNGAN NILAI PRESTASI ==*/	
	function nilai_prestasi(){	
		$dp=$this->webserv->spanptkin('penilaian/get_prodi');
		$data['prodi']=$dp;
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		$p=$this->webserv->spanptkin('penilaian/get_putaran');
		$data['pilihan']=$pilihan=$p->pilihan_aktif;
		$ptn=$p->pt_aktif;	
		if($_POST == null){
			$prestasi=$this->webserv->spanptkin('penilaian/get_prestasi');
			#print_r($prestasi);die();
			$arr_prestasi=array();
			foreach($prestasi as $p){
				if(!isset($arr_prestasi[$p->nomor_pendaftaran])) {
					$arr_prestasi[$p->nomor_pendaftaran] = array();
				}

				 $arr_prestasi[$p->nomor_pendaftaran][] = $p;
			}
			$postdata=array(
					'KD_PRODI'=>$kd_prodi,
					'PTN'=>$ptn
			);
			$data['siswa']=$siswa=$this->webserv->spanptkin('penilaian/get_siswa_prodi',$postdata);
			$arr_siswa=array();		
			if(!empty($siswa)){			
				foreach($siswa as $s){
					@$prestasi=$arr_prestasi[$s->nomor_pendaftaran];
					$arr_siswa[]=array('NOMOR_PENDAFTARAN'=>$s->nomor_pendaftaran,
									'NAMA_SISWA'=>$s->nama_siswa,
									'PRESTASI'=>$prestasi,
									'NILAI_PRESTASI'=>$s->nilai_prestasi
								);
				}
			}	
			#print_r($arr_siswa);die();
			$data['siswa']=$arr_siswa;
			$data['content']='spanptkin/penilaian/nilai_prestasi';
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
		//	$this->load->view('page/footer');
		}else{
			$nilai=$this->input->post('nilai');
			$postdata=array(
					'KD_PRODI'=>$kd_prodi,
					'PTN'=>$ptn,
					'NILAI'=>$nilai
			);
			$data=$this->webserv->spanptkin('penilaian/set_nilai_prestasi',$postdata);
			if($data){
				$this->session->set_flashdata('message',array("error","Data nilai prestasi non akademik berhasil disimpan."));
				redirect('spanptkin/penilaian/nilai_prestasi');
			}
		}	
	} 

/*== PEHITUNGAN NILAI RIWAYAT SNMPTN ==*/
	function nilai_riwayat_spanptkin(){
		if($_POST == null){			
			$data['nilai']=$this->lib_yudisium->api_yudisium('spanptkin/yudisium/get_riwayat_spanptkin');
			$data['content']='spanptkin/penilaian/nilai_riwayat_spanptkin';
			$this->load->view('s00_vw_all', $data);
		}else{			   
			$data=$this->lib_yudisium->api_yudisium('spanptkin/yudisium/set_riwayat_spanptkin');
			print_r($data);die();
			$this->session->set_flashdata('message',array("error","Data nilai riwayat SNMPTN disimpan."));
			//redirect('spanptkin/penilaian/nilai_riwayat_spanptkin');
		}	
			
	} 
	
/*== PEHITUNGAN NILAI UN ==*/	
	function nilai_un(){
		$data['prodi']=$this->db->query("SELECT DISTINCT KODE_PROGRAM_STUDI,PROGRAM_STUDI FROM PILIHAN ORDER BY PROGRAM_STUDI ASC")->result();
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		if($_POST == null){
			$prestasi=$this->db->get('PRESTASI')->result_array();
			$arr_prestasi=array();
			foreach($prestasi as $p){
				if(!isset($arr_prestasi[$p['NOMOR_PENDAFTARAN']])) {
					$arr_prestasi[$p['NOMOR_PENDAFTARAN']] = array();
				}

				 $arr_prestasi[$p['NOMOR_PENDAFTARAN']][] = $p;
			}
			$siswa=$this->db->query("SELECT SISWA.NOMOR_PENDAFTARAN, NAMA_SISWA,PILIHAN.NILAI_PRESTASI FROM PILIHAN
								LEFT JOIN SISWA ON PILIHAN.NOMOR_PENDAFTARAN=SISWA.NOMOR_PENDAFTARAN
								WHERE PILIHAN.KODE_PROGRAM_STUDI='".$kd_prodi."'")
								->result();
			$arr_siswa=array();					
			foreach($siswa as $s){
				@$prestasi=$arr_prestasi[$s->NOMOR_PENDAFTARAN];
				$arr_siswa[]=array('NOMOR_PENDAFTARAN'=>$s->NOMOR_PENDAFTARAN,
								'NAMA_SISWA'=>$s->NAMA_SISWA,
								'PRESTASI'=>$prestasi,
								'NILAI_PRESTASI'=>$s->NILAI_PRESTASI
							);
			}
			$data['siswa']=$arr_siswa;
			$this->load->view('admin/header',$data);					
			$this->load->view('admin/menu');				
			$this->load->view('yudisium/penilaian/nilai_prestasi');
			$this->load->view('admin/footer');
		}else{
			$nilai=$this->input->post('nilai');
			
				$this->db->query("UPDATE NILAI_YUDISIUM AA SET AA.NILAI_UN=(
								SELECT BB.NILAI_UN FROM(
								SELECT NOMOR_PENDAFTARAN,KODE_PROGRAM_STUDI, SUM(BOBOT_NILAI) NILAI_UN FROM(
								SELECT PILIHAN.NOMOR_PENDAFTARAN,PILIHAN.KODE_PROGRAM_STUDI,PILIHAN.URUTAN_PROGRAM_STUDI,NILAI_UN.KODE_MATA_PELAJARAN,NILAI,BOBOT_NILAI_MATA_PELAJARAN.BOBOT,
								(NILAI*BOBOT/10) AS BOBOT_NILAI
								FROM NILAI_UN
								RIGHT JOIN PILIHAN ON PILIHAN.NOMOR_PENDAFTARAN = NILAI_UN.NOMOR_PENDAFTARAN
								LEFT JOIN JURUSAN_SISWA ON NILAI_UN.NOMOR_PENDAFTARAN = JURUSAN_SISWA.NOMOR_PENDAFTARAN
								LEFT JOIN BOBOT_NILAI_MATA_PELAJARAN ON NILAI_UN.KODE_MATA_PELAJARAN = BOBOT_NILAI_MATA_PELAJARAN.KODE_MATA_PELAJARAN
								AND PILIHAN.KODE_PROGRAM_STUDI=BOBOT_NILAI_MATA_PELAJARAN.KODE_PROGRAM_STUDI
								AND JURUSAN_SISWA.KODE_JURUSAN=BOBOT_NILAI_MATA_PELAJARAN.KODE_NILAI_JURUSAN
								)
								GROUP BY NOMOR_PENDAFTARAN,KODE_PROGRAM_STUDI
								) BB
								WHERE AA.NOMOR_PENDAFTARAN=BB.NOMOR_PENDAFTARAN
								AND AA.KODE_PROGRAM_STUDI=BB.KODE_PROGRAM_STUDI
								)");
			
			$this->session->set_flashdata('message',array("error","Data nilai prestasi non akademik berhasil disimpan."));
			redirect('yudisium/penilaian/nilai_prestasi');
		}	
	} 

	
/*== PEHITUNGAN NILAI SEBARAN WILAYAH ==*/
	function nilai_sebaran_wilayah(){
		if($_POST == null){
			$aks=$this->db->get('BOBOT_SEBARAN_WILAYAH')->result();
			$data['bobot_akreditasi_sekolah']=$aks;
			$arr_aks=array();
			foreach($aks as $a){
				$arr_aks[$a->SEBARAN_WILAYAH]=$a->BOBOT;
			}
			
			$sw=$this->db->query("SELECT SISWA.NOMOR_PENDAFTARAN,SISWA.NAMA_SISWA, SEKOLAH.KODE_PROVINSI,NAMA_PROVINSI,SEBARAN_WILAYAH.ID_SEBARAN_WILAYAH,BOBOT_SEBARAN_WILAYAH.BOBOT 
								FROM SISWA
								LEFT JOIN SEKOLAH ON SISWA.NPSN_SEKOLAH=SEKOLAH.NPSN
								LEFT JOIN SEBARAN_WILAYAH ON SEKOLAH.KODE_PROVINSI=SEBARAN_WILAYAH.KODE_PROVINSI
								LEFT JOIN BOBOT_SEBARAN_WILAYAH ON SEBARAN_WILAYAH.ID_SEBARAN_WILAYAH = BOBOT_SEBARAN_WILAYAH.ID_SEBARAN_WILAYAH
								ORDER BY SISWA.NOMOR_PENDAFTARAN ASC
								")
								->result_array();
			$data['siswa']=$sw;
			$this->load->view('admin/header',$data);					
			$this->load->view('admin/menu');				
			$this->load->view('yudisium/penilaian/nilai_sebaran_wilayah');
			$this->load->view('admin/footer');
		}else{
			$bas=$this->input->post('bas');
			foreach($bas as $akreditasi=>$nilai){
				$this->db->where('ID_SEBARAN_WILAYAH',$akreditasi)
						->update('BOBOT_SEBARAN_WILAYAH',array('BOBOT'=>$nilai));
			}
			$rs=$this->db->query("UPDATE NILAI_YUDISIUM AA SET AA.NILAI_SEBARAN_WILAYAH=(
							  SELECT BOBOT FROM (
								  SELECT SISWA.NOMOR_PENDAFTARAN,SISWA.NAMA_SISWA, SEKOLAH.KODE_PROVINSI,NAMA_PROVINSI,SEBARAN_WILAYAH.ID_SEBARAN_WILAYAH,BOBOT_SEBARAN_WILAYAH.BOBOT 
								  FROM SISWA
								  LEFT JOIN SEKOLAH ON SISWA.NPSN_SEKOLAH=SEKOLAH.NPSN
								  LEFT JOIN SEBARAN_WILAYAH ON SEKOLAH.KODE_PROVINSI=SEBARAN_WILAYAH.KODE_PROVINSI
								  LEFT JOIN BOBOT_SEBARAN_WILAYAH ON SEBARAN_WILAYAH.ID_SEBARAN_WILAYAH = BOBOT_SEBARAN_WILAYAH.ID_SEBARAN_WILAYAH
								  ORDER BY SISWA.NOMOR_PENDAFTARAN ASC
							  )BB
							  WHERE AA.NOMOR_PENDAFTARAN=BB.NOMOR_PENDAFTARAN
							)");
			if($rs){				
				$this->session->set_flashdata('message',array("error","Data nilai sebaran wilayah berhasil disimpan."));
				redirect('yudisium/penilaian/nilai_sebaran_wilayah');
			}	
		}	
	} 
		
/*== NILAI YUDISIUM ==*/	
	function nilai_yudisium(){
		
		 $kd_prodi=$this->session->userdata('kd_prodi');
		 $username=$this->session->userdata('id_user');
			
		
		$dp=$this->lib_yudisium->api_yudisium('spanptkin/yudisium/get_prodi');
		$data['prodi']=$dp;
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		$p=$this->lib_yudisium->api_yudisium('spanptkin/pembobotan/get_putaran');
		$data['pilihan']=$pilihan=$p->pilihan_aktif;
		$ptn=$p->pt_aktif;	
						
			$bobot=$this->webserv->spanptkin('penilaian/get_bobot');
				foreach($bobot as $b){
					$bobot2[$b->kode_nilai]=$b->bobot;
				}
				$data['b']=$bobot2;
		if($_POST == null){
				$jbt = $this->session->userdata('jabatan');
				if($jbt=='AAZ006'){
				$dp=$this->webserv->spanptkin('penilaian/get_prodi',array('ID_USER'=>$username));
				}else{
				$dp=$this->webserv->spanptkin('penilaian/get_prodi');					
				}	
				$data['prodi']=$dp;
				$arp=array();
				foreach($dp as $dp){
					$arp[$dp->kode_program_studi]=$dp;
				}	
				if(isset($kd_prodi)and $kd_prodi!=null){
			
					$kd_prodi=$this->session->userdata('kd_prodi');
					$data['kode_prodi']=$kd_prodi;
					/*========================*/
				/* 	$prestasi=$this->lib_yudisium->api_yudisium('spanptkin/yudisium/get_prestasi');
					$arr_prestasi=array();
					foreach($prestasi as $p){
						if(!isset($arr_prestasi[$p->NOMOR_PENDAFTARAN])) {
							$arr_prestasi[$p->NOMOR_PENDAFTARAN] = array();
						}

						 $arr_prestasi[$p->NOMOR_PENDAFTARAN][] = $p;
					}
					$data['prestasi']=$arr_prestasi; */
					$postdata=array(
						'TAHUN'=>'2016',
						'KD_PRODI'=>$kd_prodi,
						'PILIHAN'=>$pilihan
					);
					$data['siswa']=$this->webserv->spanptkin('penilaian/get_nilai_yudisium',$postdata);
				}
			$data['content']='spanptkin/penilaian/nilai_yudisium';
			$this->load->view('admin/header',$data);
			$this->load->view('admin/content');
		}
	} 

	function nilai_yudisium2(){
		
		 $kd_prodi=$this->session->userdata('kd_prodi');
		 $username=$this->session->userdata('id_user');
			
		
		$dp=$this->lib_yudisium->api_yudisium('spanptkin/yudisium/get_prodi');
		$data['prodi']=$dp;
		$kd_prodi=$this->session->userdata('kd_prodi');
		$data['kode_prodi']=$kd_prodi;
		$p=$this->lib_yudisium->api_yudisium('spanptkin/pembobotan/get_putaran');
		$data['pilihan']=$pilihan=$p->PILIHAN_AKTIF;
		$ptn=$p->PT_AKTIF;	
						
				$bobot=$this->lib_yudisium->api_yudisium('spanptkin/yudisium/get_pembobotan');
				foreach($bobot as $b){
					$bobot2[$b->KODE_NILAI]=$b->BOBOT;
				}
				$data['b']=$bobot2;
		if($_POST == null){
				$dp=$this->lib_yudisium->api_yudisium('spanptkin/yudisium/get_prodi');
				$data['prodi']=$dp;
				$arp=array();
				foreach($dp as $dp){
					$arp[$dp->KODE_PROGRAM_STUDI]=$dp;
				}	
				if(isset($kd_prodi)and $kd_prodi!=null){
			
				$kd_prodi=$this->session->userdata('kd_prodi');
				$data['kode_prodi']=$kd_prodi;
				/*========================*/
				$prestasi=$this->lib_yudisium->api_yudisium('spanptkin/yudisium/get_prestasi');
				$arr_prestasi=array();
				foreach($prestasi as $p){
					if(!isset($arr_prestasi[$p->NOMOR_PENDAFTARAN])) {
						$arr_prestasi[$p->NOMOR_PENDAFTARAN] = array();
					}

					 $arr_prestasi[$p->NOMOR_PENDAFTARAN][] = $p;
				}
				$data['prestasi']=$arr_prestasi;
				$postdata=array(
					'TAHUN'=>2015,
					'KD_PRODI'=>$kd_prodi,
					'PILIHAN'=>$pilihan
				);
				$data['siswa']=$this->lib_yudisium->api_yudisium('spanptkin/yudisium/get_nilai_yudisium',$postdata);
				}
			$data['content']='spanptkin/penilaian/nilai_yudisium';
				$this->load->view('s00_vw_all', $data);
		}
	} 

	
}
