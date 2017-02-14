<?php

/**
* 
*/
class Form_control extends CI_Controller
{
	

	function __construct()
	{
		parent::__construct();
		$this->load->library('webserv');
		$this->load->library("lib_wilayah_fungsi", '', 'wilayah');
		$this->api= $this->s00_lib_api;
		if($this->session->userdata('username')=='')
		{
			redirect(base_url());
		}
	}

	function index()
	{
		
	}

	function lihat_kuliah()
	{
		$data['id_kelas']=$this->input->post('id_kelas');
		$kirim=array('KULIAH'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_kuliah',$kirim);
		if(!is_null($hasil))
		{
			foreach ($hasil as $k);
			echo "<font id='pilkul'> ".$k->keterangan." </font>";

		}
		else
		{
			echo "<font id='pilkul'></font>";
		}
	}

	function hapus_riwayat()
	{
		$data['id_riwayat']=$this->input->post('id_riwayat');
		$d['nomor_pendaftar']=$this->input->post('nomor_pendaftar');

		$kirim=array('PESANTREN'=>$data);
		$hasil=$this->webserv->admisi('data_form/hapus_riwayat_pesantren',$kirim);
		if($hasil)
		{
			$kirim=array('CARI_DATA_DIRI'=>$d);
			$x['data_pesantren']=$this->webserv->admisi('data_form/data_pesantren',$kirim);
			$this->load->view('v_table/table_pesantren',$x);
		}
	}

	function cari_pesantren()
	{
		$search=$this->input->post('cari');
		$url="http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search";
		$data=array('api_kode'=>1012, 'api_subkode' => 2 ,'api_search' => array($search));
        $arr_pes = $this->api->get_api_json($url, 'POST', $data);
       	if(!is_null($arr_pes))
       	{
       		foreach ($arr_pes as $ap) {
       			echo '<div class="ac_results" id="'.$ap['NSPP'].'" nama="'.$ap['NM_PESANTREN'].'" onclick="pilih_pes(this)">'.$ap['NM_PESANTREN'].'</div>';
       		}
       	}
       	else
       	{
       		echo '<div class="ac_results" id="00" nama="LAINNYA">data tidak ditemukan</div>';
       
       	}

	}

	function cari_sekolah()
	{
		$data['cari']=strtoupper($this->input->post('cari'));
		$kirim=array('SEKOLAH'=>$data);
		$arr_sek=$this->webserv->admisi("data_form/cari_sekolah",$kirim);
		if(!is_null($arr_sek))
		{
       		foreach ($arr_sek as $apx) {
       			echo '<div class="ac_results" id="'.$apx->kode_sekolah.'" nama="'.$apx->nama_sekolah.'" onclick="pilih_sek(this)">'.$apx->nama_sekolah.'</div>';
       		}
       	}
       	else
       	{
       		echo '<div class="ac_results" id="00" nama="LAINNYA">data tidak ditemukan</div>';
       
       	}

	}


	 function ajax_wilayah(){
        if($this->input->post('aksi') == 'prop'){
            $kd_prop = $this->input->post('kd_prop');
            
            $arrkab = $this->api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST',
            array('api_kode'=>12000, 'api_subkode' => 4 ,'api_search' => array($kd_prop)));
            
            if(!empty($arrkab)){
                $select_kab = '';
                foreach($arrkab as $idx => $ab){
                    if(substr($ab['NM_KAB'],0,12) == 'KAB. LAINNYA'){
                        $KD_KAB_LAIN=$ab['KD_KAB'];
                        continue;
                    }
                    $select_kab .= '<option value="'.$ab['KD_KAB'].'">'.$ab['NM_KAB'].'</option>';
                }
                $select_kab=$select_kab.'<option value="'.$KD_KAB_LAIN.'">KABUPATEN LAINNYA</option>';
            }else{ $select_kab  = '<option value="0">-</option>'; }
            
            echo json_encode(array('kab' => $select_kab));
        }elseif($this->input->post('aksi') == 'kab'){
            $kd_kab = $this->input->post('kd_kab');
            
            $arrkec = $this->api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search', 'POST',
            array('api_kode'=>13000, 'api_subkode' => 4 ,'api_search' => array($kd_kab)));
            
            $select_kec = '';
            foreach($arrkec as $idx => $ab){
                $select_kec .= '<option value="'.$ab['KD_KEC'].'">'.strtoupper($ab['NM_KEC']).'</option>';
            }
            $select_kec.='<option value="0">KEC. LAINNYA</option>';
            echo json_encode(array('kec' => $select_kec));
        }else{
            redirect('data-pendaftar');
        }
    }
	function input_form()
	{
		$data['data_form_aktif'] = $this->webserv->admisi('data_form/form',array());
		$data['content']="form_daftar/input_form";
		$this->load->view('page/header',$data);
		$this->load->view('pendaftaran/content');
		$this->load->view('page/footer');
	}


	function lihat_kartu_ujian()
	{
		$id=$this->input->post('nomor_pendaftar');
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('VERIF_DATA_DIRI'=>$nomor);
		$data['data_diri']=$this->webserv->admisi('data_form/verifikasi_data_diri',$nomor_pendaftar);
		$data['data_piljur']=$this->webserv->admisi('data_form/verifikasi_pilihan_jurusan',$nomor_pendaftar);
		$data['tawar']=$this->webserv->admisi('data_form/jalur_tawar',$nomor_pendaftar);
		$data['ruang']=$this->webserv->admisi('data_form/cari_ruang_peserta',$nomor_pendaftar);
		$data['lokasi']=$this->webserv->admisi('data_form/ruang_ujian',$nomor_pendaftar);
		$data['jadwal']=$this->webserv->admisi('data_form/jadwal_pilih',$nomor_pendaftar);
		$data['pend']=$this->webserv->admisi('data_form/verifikasi_data_riwayat_pendidikan_s2',$nomor_pendaftar);

		$this->load->view('form_daftar/kartu_ujian',$data);
		
	}

	function setting_grup_form()
	{
		$data['data_grup_form'] = $this->webserv->admisi('data_form/grup_form',array());
		$data['content']="form/table_grup_form";
		$this->load->view('page/header',$data);
		$this->load->view('pendaftaran/content');
		$this->load->view('page/footer');
	}

	function tampil_data_form($id)
	{
		$data['pilih_grup']=$id;
		$data['data_form_aktif'] = $this->webserv->admisi('data_form/form',array());
		$this->load->view('form_daftar/form_grup',$data);
	}
/*
	function lihat_form()
	{
		$data['data_grup_aktif'] = $this->webserv->admisi('data_form/grup_form',array());
		$data['content']="form/lihat_form";
		$this->load->view('pendaftaran/content',$data);
	}
*/
	function hapus_riwayat_pendidikan()
	{
		$id=$this->input->post('id');
		$data['nomor_pendaftar']=$id;
		$insert_data=array('DELETE_RIWAYAT_PENDIDIKAN'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_riwayat_pendidikan',$insert_data);
		if($hasil)
		{
			echo "ok";
		}	
	}

	function hapus_karya_tulis()
	{
		$id=$this->input->post('id');
		$data['id_karya']=$id;
		$insert_data=array('DELETE_KARYA_TULIS'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_karya_tulis',$insert_data);
		if($hasil)
		{
			echo "ok";
		}	
	}

	function insert_karya_tulis()
	{
		$data['judul']=$this->input->post('judul_karya_tulis');
		$data['penerbit']=$this->input->post('penerbit');
		$data['tahun']=$this->input->post('tahun_karya_tulis');
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['upload_karya']=$this->input->post('tulisan');
		$insert_data=array('INSERT_DATA'=>$data);

		$hasil=$this->webserv->admisi('data_form/insert_karya_tulis',$insert_data);
			if($hasil)
				{
					echo "ok";
				}	
	}

	function insert_riwayat_pendidikan()
	{
		
		$data['jenjang']=$this->input->post('KD_PEND');
		$data['nama_sekolah']=str_replace("'", "''", $this->input->post('NM_SEKOLAH'));//KODE SEKOLAH
		$data['npsn']=$this->input->post('NPSN');
		$data['nisn']=$this->input->post('NISN');
		$data['jurusan']=$this->input->post('JURUSAN');
		$data['no_ijazah']=$this->input->post('NO_IJASAH_SMA');
		$data['tahun_lulus']=$this->input->post('THN_LULUS');
		$data['tahun_masuk']=$this->input->post('THN_MASUK');
		$data['uan']=$this->input->post('NEM');
		$data['sttb']=$this->input->post('STTB');
		$data['ijazah']=$this->input->post('DOC_IJAZAH_NAME');
		$data['keterangan']=$this->input->post('KETERANGAN');
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['nama']=$this->input->post('nama_sek');//REAL NAMA
		$insert_data=array('INSERT_DATA'=>$data);

		$hasil=$this->webserv->admisi('data_form/insert_riwayat_pend',$insert_data);
			if($hasil)
				{
					echo "ok";
				}
				else
				{
					echo "gagal";
				}

	}

	function hapus_disertasi()
	{
		$id=$this->input->post('id');
		$data['nomor_pendaftar']=$id;
		$insert_data=array('DELETE_DISERTASI'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_disertasi',$insert_data);
		if($hasil)
		{
			echo "ok";
		}	
	}

	function hapus_tesis()
	{
		$id=$this->input->post('id');
		$data['nomor_pendaftar']=$id;
		$insert_data=array('DELETE_TESIS'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_tesis',$insert_data);
		if($hasil)
		{
			echo "ok";
		}	
	}

	function insert_tesis()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['judul']=$this->input->post('judul_tesis');
		$data['tesis']=$this->input->post('tesis');
		$data['rekomendasi']=$this->input->post('rekomendasi');

		$insert_data=array('INSERT_DATA'=>$data);

		$hasil=$this->webserv->admisi('data_form/insert_tesis',$insert_data);
			if($hasil)
				{
					echo "ok";
				}
	}

	function insert_disertasi()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['judul']=$this->input->post('judul_disertasi');
		$data['disertasi']=$this->input->post('disertasi');

		$insert_data=array('INSERT_DATA'=>$data);

		$hasil=$this->webserv->admisi('data_form/insert_disertasi',$insert_data);
			if($hasil)
				{
					echo "ok";
				}
	}

	function insert_riwayat_nilai()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['pendidikan']=$this->input->post('KD_PEND');
		$data['semester']=$this->input->post('SEMESTER');
		$data['rangking']=$this->input->post('SISWA_RANKING');
		$data['raport']=$this->input->post('NILAI_RAPORT');
		$data['jumlah']=$this->input->post('SISWA_JUMLAH');
		$data['kkm']=$this->input->post('NILAI_KKM');
		if($data['rangking']=='')
		{
			$data['rangking']='0';
		};
		if($data['jumlah']=='')
		{
			$data['jumlah']='0';
		}
		$insert_data=array('INSERT_DATA'=>$data);

		$hasil=$this->webserv->admisi('data_form/insert_riwayat_nilai',$insert_data);
			if($hasil)
				{
					echo "ok";
				}

	}

	function hapus_riwayat_nilai()
	{
		$id=$this->input->post('id');
		$data['id_riwayat']=$id;
		$insert_data=array('DELETE_RIWAYAT_NILAI'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_riwayat_nilai',$insert_data);
		if($hasil)
		{
			echo "ok";
		}	
	}

	function insert_organisasi()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['nama_organisasi']=$this->input->post('NM_ORGANISASI');
		$data['bidang_organisasi']=$this->input->post('BID_ORGANISASI');
		$data['waktu']=$this->input->post('tgl_mulai').' s.d '.$this->input->post('tgl_selesai');
		$data['jabatan']=$this->input->post('JABATAN');
		$data['keterangan']=$this->input->post('KETERANGAN');
		
		$insert_data=array('INSERT_DATA'=>$data);

		$hasil=$this->webserv->admisi('data_form/insert_organisasi',$insert_data);
			if($hasil)
				{
					echo "ok";
				}
	}

	function hapus_organisasi()
	{
		$id=$this->input->post('id');
		$data['id_organisasi']=$id;
		$insert_data=array('DELETE_ORGANISASI'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_organisasi',$insert_data);
		if($hasil)
		{
			echo "ok";
		}	
	}

	function hapus_pil_prod()
	{
		$id=$this->input->post('id');
		$data['id_piljur']=$id;
		$hapus_data=array('DELETE_PILJUR'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_piljur',$hapus_data);
		if($hasil)
		{
			echo "ok";
		}	
	}

	function hapus_prestasi()
	{
		$data['id_prestasi']=$this->input->post('id');
		$insert_data=array('HAPUS_PRESTASI'=>$data);
		$hasil=$this->webserv->admisi('pendaftaran/hapus_prestasi',$insert_data);
		if($hasil)
		{

			$info="DATA DIFABLE BERHASIL DIBATALKAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."</div>";
			
		}
		else
		{
			$info="DATA DIFABLE GAGAL DIBATALKAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-warning'>".$info."</div>";
			
		}
		echo $pesan;
	}

	function insert_prestasi()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['nama_perlombaan']=$this->input->post('NM_LOMBA');
		$data['juara_ke']=$this->input->post('JUARA_KE');
		$data['jenis_kompetisi']=$this->input->post('TIPE_KOMPETISI');
		$data['tingkat_kejuaraan']=$this->input->post('KD_PERINGKAT');
		$data['jenis_kejuaraan']=$this->input->post('KD_JENIS');
		$data['keterangan_jenis']=$this->input->post('KETERANGAN_1');
		$data['tahun_penghargaan']=$this->input->post('THN_BERI');
		$data['nama_penyelenggara']=$this->input->post('NM_PENY_LOMBA');
		$data['tanggal_mulai']=$this->input->post('tgl_mulai');
		$data['tanggal_selesai']=$this->input->post('tgl_selesai');
		$data['nomor_sertifikat']=$this->input->post('NO_SERTIF_LOMBA');
		if(strtoupper($data['nama_perlombaan'])=='TIDAK ADA')
		{
			$data['juara_ke']="0";
			$data['jenis_kompetisi']="L";
			$data['tingkat_kejuaraan']="-";
			$data['jenis_kejuaraan']="1025";
			$data['keterangan_jenis']="-";
			$data['tahun_penghargaan']="-";
			$data['nama_penyelenggara']="-";
			$data['tanggal_mulai']=null;
			$data['tanggal_selesai']=null;
		}
		if(!is_null($this->input->post('DOC_SERTIF_LOMBA_NAME')))
		{
			$sert=$this->input->post('DOC_SERTIF_LOMBA_NAME');
		}
		else
		{
			$sert="";
		}
		$data['sertifikat']=$sert;
		$data['keterangan']=$this->input->post('KETERANGAN_2');

		$insert_data=array('INSERT_PRESTASI'=>$data);
		$hasil=$this->webserv->admisi('pendaftaran/insert_prestasi',$insert_data);
		if($hasil)
		{

			$info="DATA PRESTASI BERHASIL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."</div>";
			
		}
		else
		{
			$info="DATA PRESTASI GAGAL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-warning'>".$info."</div>";
			
		}
		echo $pesan;
		
	}

	function delete_pil_prod($NO,$PILIH)
	{
		$data['nomor_pendaftar']=$NO;
		$data['pilihan']=$PILIH;
		$kirim=array('HAPUS'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_piljur_ke3',$kirim);
		if($hasil)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function delete_pil_prod_post()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['pilihan']="3";
		$kirim=array('HAPUS'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_piljur_ke3',$kirim);
		if($hasil)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}

	function insert_piljur()
	{
		$res=array();
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['id_prodi']=$this->input->post('pilih');
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		
		$id_kesehatan=array();
		$hasil_kesehatan=array();

		$kirim_sarat=array('CEK_SARAT_KES'=>$data);
		$cari_sarat=$this->webserv->admisi('input_data/cek_sarat_kesehatan',$kirim_sarat);
		if(!is_null($cari_sarat))
		{
			foreach ($cari_sarat as $value) {
				array_push($id_kesehatan, $value->id_kesehatan);
			}
		}

		$ambil_difable=array('CEK_DIFABLE'=>$data);
		$data_difable=$this->webserv->admisi('input_data/cek_difable',$ambil_difable);
		if(!is_null($data_difable))
		{
			foreach ($data_difable as $dadif) {
				array_push($hasil_kesehatan, $dadif->id_kesehatan);
			}
		}

		$result=array();
		if(count($hasil_kesehatan)>0 && count($cari_sarat)>0)
		{
			$result = array_intersect($id_kesehatan, $hasil_kesehatan);
		}

				$data['kode_penawaran']=$this->input->post('kode_penawaran');
				$data['pilihan']=$this->input->post('pilih');
				
				
					$data['id_kelas']=$this->input->post('id_kelas');	
				
				
				$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
				$data['jenjang']=$this->input->post('jenjang');
				$data['tahun']=$this->input->post('tahun');
				$data['kode_jalur']=$this->input->post('jalur');
				$data['status']='0';
				$data['pilih']=$this->input->post('index');

		if(count($result) < 1)
		{
				$res=array();
				if(substr($data['kode_jalur'], 0,1)=='1')//s1
					{
						$cek_fak=array('CEK_FAK'=>$data);
						$myfak=array();
						$calonfak=array();
						$fak=$this->webserv->admisi('data_form/cek_fakultas',$cek_fak);
						$ambilfak=$this->webserv->admisi('data_form/cek_fakultas_piljur',$cek_fak);
						if($fak)
						{
							
							foreach ($fak as $dafak1);
								$calonfak=(array) $dafak1->id_fakultas;
							//5
						}
						if(!is_null($ambilfak))
						{
							
							foreach ($ambilfak as $dafak2);
								$myfak=(array) $dafak2->id_fakultas;
							//5,6
						}

						$res=array_intersect($calonfak, $myfak);
						if(count($res) > 0)
						{
								$insert_data=array('INSERT_DATA'=>$data);
								$hasil=$this->webserv->admisi('data_form/insert_piljur',$insert_data);
								if($hasil)
								{
									echo "<div id='msg' class='bs-callout bs-callout-info'><strong>Anda sudah mengambil Program Studi dalam Fakultas yang sama. Anda hanya di ijinkan 2 pilihan.</strong><br/>";
									echo "Untuk memilih 3 Program Studi silakan pilih Prodi pada Fakultas yang berbeda.</font><input type='hidden' id='status_fak' value='1'></div>";
									$this->delete_pil_prod($data['nomor_pendaftar'],'3');
								}
								else
								{
									echo "<div id='msg' class='bs-callout bs-callout-error'><strong>Gagal : Pada Pilihan ke ".$data['pilih']."</strong><br/>";
									echo "Anda Tidak diijinkan menginputkan Program Studi yang sama.</font><input type='hidden' id='siap' value='0'></div>";
								}
							
							
						}
						elseif(count($res) < 1)
						{
							$insert_data=array('INSERT_DATA'=>$data);
							$hasil=$this->webserv->admisi('data_form/insert_piljur',$insert_data);
							if($hasil)
							{
							echo "<div id='msg' class='bs-callout bs-callout-success'><strong>Pilihan Prodi ke ".$data['pilih']." berhasil.</strong><br/>";
							echo "Silahkan isi form selanjutnya..</font><input type='hidden' id='siap' value='1'><input type='hidden' id='status_fak' value='0'></div>";
							}
							else
							{
							echo "<div id='msg' class='bs-callout bs-callout-error'><strong>Gagal : Pada Pilihan ke ".$data['pilih']."</strong><br/>";
							echo "Anda Tidak diijinkan menginputkan Program Studi yang sama.</font><input type='hidden' id='siap' value='0'></div>";
							}
						}
					}
				elseif(substr($data['kode_jalur'], 0,1)=='2' || substr($data['kode_jalur'], 0,1)=='3')//s2-s3
				{
					$insert_data=array('INSERT_DATA'=>$data);
					$hasil=$this->webserv->admisi('data_form/insert_piljur',$insert_data);
					if($hasil)
					{
						echo "<div id='msg' class='bs-callout bs-callout-success'><strong>Pilihan Prodi ke ".$data['pilih']." berhasil.</strong><br/>";
						echo "Silahkan isi form selanjutnya..</font><input type='hidden' id='siap' value='1'></div>";
					}
					else
					{
						echo "<div id='msg' class='bs-callout bs-callout-error'><strong>Gagal : Pada Pilihan ke ".$data['pilih']."</strong><br/>";
						echo "Anda Tidak diijinkan menginputkan Program Studi yang sama.</font><input type='hidden' id='siap' value='0'></div>";
					}
				}
				
				
		}
		else
		{
			echo "<div id='msg' class='bs-callout bs-callout-error'><strong>Gagal : Pada Pilihan ke ".$data['pilih']."</strong><br/>";
			echo "Anda tidak memenuhi prasyarat.</font><input type='hidden' id='siap' value='0'></div>";
			
		}
	
	
	}

	function update_pilih_jadwal()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$insert_data=array('INSERT_DATA'=>$data);
		if($data['kode_jalur']=='11')
		{
			$jml=0;
			$kuota=$this->webserv->admisi('data_form/cek_kuota_jadwal',$insert_data);
			if(!is_null($kuota))
			{
				foreach ($kuota as $k);
					$jml=$k->jml;
				if($jml > 0)
				{
						$hasil=$this->webserv->admisi('data_form/update_pilih_jadwal',$insert_data);
						if($hasil)
						{
						$jadwal=array('CARI_JADWAL'=>$data);
						
						$hasil_jadwal['data_jadwal']=$this->webserv->admisi('data_form/jadwal_ujian',$jadwal);
						if($hasil_jadwal)
						{
							$info="JADWAL BERHASIL DIPILIH";
							$pesan = "<div id='jadwal' class='bs-callout bs-callout-success'>".$info."</div>";
							echo $pesan;
							$this->load->view('v_table/view_table_jadwal_ujian_admin',$hasil_jadwal);
						}
						}
				}
				else
				{
					//$aktifkan_baru=$this->webserv->admisi('data_form/aktifkan_jadwal',$insert_data); aktifkan otomatis

					$info="JADWAL TELAH PENUH. SILAKAN MENGHUBUNGI ADMISI UNTUK PENAMBAHAN KUOTA JADWAL";
					$pesan = "<div id='jadwal' class='bs-callout bs-callout-error'>".$info."</div>";
					echo $pesan;
					
				}
			}
		}
		else
		{	
			$hasil=$this->webserv->admisi('data_form/update_pilih_jadwal',$insert_data);
			if($hasil)
				{
					$jadwal=array('CARI_JADWAL'=>$data);
					
					$hasil_jadwal['data_jadwal']=$this->webserv->admisi('data_form/jadwal_ujian',$jadwal);
					if($hasil_jadwal)
					{
						$info="JADWAL BERHASIL DIPILIH";
						$pesan = "<div id='jadwal' class='bs-callout bs-callout-success'>".$info."</div>";
						echo $pesan;
						echo $this->load->view('v_table/view_table_jadwal_ujian_admin',$hasil_jadwal);
					}
				}
		}

	}





	function insert_minat()
	{
		$data['jenis_minat']=$this->input->post('Jenis_Minat');
		$data['nama_minat']=$this->input->post('NM_HOBI');
		$data['keterangan']=$this->input->post('KETERANGAN');
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');

		$insert_data=array('INSERT_DATA'=>$data);

		$hasil=$this->webserv->admisi('data_form/insert_data_minat',$insert_data);
			if($hasil)
				{
					echo "ok";
				}

	}

	function hapus_minat()
	{
		$id=$this->input->post('id');
		$data['id_min_ket']=$id;
		$insert_data=array('DELETE_MINAT'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_minat',$insert_data);
		if($hasil)
		{
			echo "ok";
		}	
	}

	function simpan_setting_grup_form()
    {
    	$kode_grup=$this->input->post('kode_grup');
    	$kode_form=$this->input->post('nama_form');
    	$id_grup=$kode_grup;
    	if(count($kode_grup) > count($kode_form))
    	{
    		$kurang=(count($kode_grup)-(count($kode_grup) - count($kode_form)));
    		$id_grup=array_splice($kode_grup,0,$kurang);
    	}
 		//print_r($id_grup);
 		//print_r($kode_form);

 		
    	$data=array('DATA_GRUP'=>$id_grup,'DATA_FORM'=>$kode_form);
    	//print_r(json_encode($data));
 		
    	//print_r(json_encode($data));
    	$hasil=$this->webserv->admisi('data_form/insert_setting_grup_form',$data);
    	
			if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil disimpan.');
					redirect('adminpmb/form_control/setting_grup_form');
				}
    }

	function simpan_data_form()
	{
		$kode_form=$this->input->post('kode_form');
		$nama_form=$this->input->post('nama_form');
		$status_form=$this->input->post('status_form');
		
		$insert_data=array(
			'kode_form'=>$kode_form,
			'nama_form'=>$nama_form,
			'status_form'=>$status_form
			);

				$data=array('INSERT_DATA'=>$insert_data);
			
			$hasil=$this->webserv->admisi('data_form/insert_data_form',$data);
			if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil disimpan.');
					redirect('adminpmb/form_control/input_form');
				}
	}

	function cari_grup($nama)
	{
		$cari=array('nama_grup_form'=>$nama);
		$kirim=array('CARI_GRUP'=>$cari);
		$data=$this->webserv->admisi('data_form/grup_id',$kirim);
		foreach ($data as $kode) {
			return $kode->kode_grup_form;
		}

	}

	function data_pesantren($id)
	{
		
		$data['nomor_pendaftar']=$id;
		$kirim=array('CARI_DATA_DIRI'=>$data);
		$data['data_pesantren']=$this->webserv->admisi('data_form/data_pesantren',$kirim);
		$this->load->view("form_daftar/data_pesantren",$data);
	}


	function data_diri($id)
	{ 
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/detail_data_diri',$nomor_pendaftar);
		$data['pekerjaan']=$this->webserv->admisi('data_form/detail_pekerjaan_mahasiswa',$nomor_pendaftar);
		$data['data_negara'] = $this->webserv->admisi('data_form/negara',array());
		$data['data_provinsi'] = $this->webserv->admisi('data_form/provinsi',array());
		$data['data_kabupaten'] = $this->webserv->admisi('data_form/kabupaten',array());
		
		$data['data_agama'] = $this->webserv->admisi('data_form/agama',array());
		$data['nomor_pendaftar']=$id;
		$grup=$this->cari_grup('data_diri');
		$ambil_grup=array('kode_grup_form'=>$grup);
		$kode_grup=array('FORM_AKTIF'=>$ambil_grup);
		$data['item_form_aktif'] = $this->webserv->admisi('data_form/form_item',$kode_grup);

		$this->load->view("form_daftar/data_diri",$data);
		
	}

	function data_keluarga($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/detail_data_keluarga',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/data_keluarga",$data);
	}

	function data_ibu($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/detail_data_orang_tua',$nomor_pendaftar);

		$data['data_negara'] = $this->webserv->admisi('data_form/negara',array());
		$data['data_pk_ortu'] = $this->webserv->admisi('data_form/pekerjaan_orang_tua',array());
		$data['data_provinsi'] = $this->webserv->admisi('data_form/provinsi',array());
		$data['data_agama'] = $this->webserv->admisi('data_form/agama',array());
		$data['data_pendidikan'] = $this->webserv->admisi('data_form/jenjang',array());
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/data_ibu",$data);
	}
	function data_bapak($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/detail_data_orang_tua',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;

		$data['data_negara'] = $this->webserv->admisi('data_form/negara',array());
		$data['data_pk_ortu'] = $this->webserv->admisi('data_form/pekerjaan_orang_tua',array());
		$data['data_provinsi'] = $this->webserv->admisi('data_form/provinsi',array());
		$data['data_agama'] = $this->webserv->admisi('data_form/agama',array());
		$data['data_pendidikan'] = $this->webserv->admisi('data_form/jenjang',array());
		$this->load->view("form_daftar/data_bapak",$data);

	}
	function data_kesehatan($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/detail_kesehatan_mahasiswa',$nomor_pendaftar);
		$data['kesehatan']=$this->webserv->admisi('data_form/data_kesehatan',$nomor_pendaftar);
		$data['difable']=$this->webserv->admisi('data_form/detail_kemampuan_berbeda',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/data_kesehatan",$data);
	}

	function detail_sertifikat()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['id_sertifikat']=$this->input->post('id_sertifikat');
		$data['jenis_sertifikat']=$this->input->post('jenis_sertifikat');
		$kirim=array('DET_SERTIFIKAT'=>$data);
		$hasil=$this->webserv->admisi('data_form/simpan_detail_sertifikat',$kirim);
		
	}

	function data_sertifikasi($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$penawaran=$this->webserv->admisi('data_form/cari_penawaran_mhs',$nomor_pendaftar);
		foreach ($penawaran as $kdp);
		$data['kode_penawaran']=$kdp->kode_penawaran;
		$data['maba']=$this->webserv->admisi('data_form/data_sertifikasi',$nomor_pendaftar);
		$data['jenis_sertifikat1']= $this->webserv->admisi('data_form/jenis_sertifikat',array());
		$kirim=array('PENDAFTAR'=>$nomor);
		$data['warga_negara']=$this->webserv->admisi('data_form/warga_negara',$kirim);
		
		$data['detail_sertifikat']= $this->webserv->admisi('data_form/data_detail_sertifikat',$nomor_pendaftar);
		$this->load->view("form_daftar/data_sertifikasi",$data);
	}

	function data_prestasi($id)
	{

		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/prestasi_lomba_mahasiswa',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$data['jenis_kejuaraan']=$this->webserv->admisi('data_form/jenis_kejuaraan',$nomor_pendaftar);
		$this->load->view("form_daftar/data_prestasi",$data);
	}
	
	function data_minat_dan_ketrampilan($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/detail_minat_ketrampilan',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$data['data_jenis_minat'] = $this->webserv->admisi('data_form/jenis_minat',array());
		$this->load->view("form_daftar/data_minat_dan_ketrampilan",$data);
	}
	function data_wali($id)
	{

		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/data_wali',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;

		$data['data_negara'] = $this->webserv->admisi('data_form/negara',array());
		$data['data_pk_ortu'] = $this->webserv->admisi('data_form/pekerjaan_orang_tua',array());
		$data['data_provinsi'] = $this->webserv->admisi('data_form/provinsi',array());
		$data['data_agama'] = $this->webserv->admisi('data_form/agama',array());
		$data['data_pendidikan'] = $this->webserv->admisi('data_form/jenjang',array());
		$this->load->view("form_daftar/data_wali",$data);
	}
	function data_kegiatan($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/detail_data_kegiatan',$nomor_pendaftar);

		$data['nomor_pendaftar']=$id;
		$data['data_kegiatan'] = $this->webserv->admisi('data_form/kegiatan',array());
		$this->load->view("form_daftar/data_kegiatan",$data);
	}
	function data_rumah_tinggal_keluarga($id)
	{

		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/rumah_tinggal_keluarga',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$data['data_kepemilikan_rumah'] = $this->webserv->admisi('data_form/kepemilikan_rumah',array());
		$data['data_sumber_air'] = $this->webserv->admisi('data_form/sumber_air',array());
		$data['data_bahan_atap'] = $this->webserv->admisi('data_form/bahan_atap',array());
		$data['data_bahan_lantai'] = $this->webserv->admisi('data_form/bahan_lantai',array());
		$data['data_bahan_dinding'] = $this->webserv->admisi('data_form/bahan_dinding',array());
		$data['data_sumber_listrik'] = $this->webserv->admisi('data_form/sumber_listrik',array());
		$data['data_jenis_mck'] = $this->webserv->admisi('data_form/jenis_mck',array());
		$this->load->view("form_daftar/data_rumah_tinggal_keluarga",$data);
	}
	function data_organisasi($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/detail_organisasi',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/data_organisasi",$data);
	}
	function data_riwayat_nilai_pendidikan_formal($id)
	{

		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/riwayat_nilai_pendidikan_formal',$nomor_pendaftar);

		$data['nomor_pendaftar']=$id;
		$data['data_pendidikan'] = $this->webserv->admisi('data_form/jenjang',array());
		$this->load->view("form_daftar/data_riwayat_nilai_pendidikan_formal",$data);
	}
	function data_kontak_darurat($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/detail_kontak_darurat',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$data['data_negara'] = $this->webserv->admisi('data_form/negara',array());
		$data['data_provinsi'] = $this->webserv->admisi('data_form/provinsi',array());
		$this->load->view("form_daftar/data_kontak_darurat",$data);
	}
	function data_rencana_hidup($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/rencana_hidup',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/data_rencana_hidup",$data);
	}
	function riwayat_pendidikan_s2($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/data_riwayat_pendidikan_s2',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$data['riwayat_pendidikan_s2'] = $this->webserv->admisi('data_form/riwayat_pendidikan_s2',array());
		$this->load->view("form_daftar/riwayat_pendidikan_s2",$data);
	}

	function data_penelitian($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/data_penelitian',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/data_penelitian",$data);
	}

	function form_jadwal_ujian($id,$jal)
	{
		$jalur=array('kode_jalur'=>$jal);
		$kode_jalur=array('DATA_JADWAL'=>$jalur);

		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('AMBIL_JADWAL'=>$nomor);

		$data['data_jadwal']=$this->webserv->admisi('data_form/data_jadwal_ujian',$kode_jalur);
		$data['ambil_jadwal']=$this->webserv->admisi('data_form/data_ambil_jadwal',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$data['kode_jalur']=$jal;
		$this->load->view("form_daftar/form_jadwal_ujian",$data);
	}

	function data_karya_tulis($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/data_karya_tulis',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/data_karya_tulis",$data);
	}

	function hanya_cetak($id)
	{
		$data['nomor_pendaftar']=$id;
		$nomor=array('nomor_pendaftar'=>$id);

		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['pendidikan_terakhir']=$this->webserv->admisi('data_form/pendidikan_terakhir',$nomor_pendaftar);
		

		$nomor_pendaftar=array('VERIF_DATA_DIRI'=>$nomor);
		$data['data_diri']=$this->webserv->admisi('data_form/verifikasi_data_diri',$nomor_pendaftar);
		$data['data_kesehatan']=$this->webserv->admisi('data_form/verifikasi_data_kesehatan',$nomor_pendaftar);
		$data['data_kemampuan_berbeda']=$this->webserv->admisi('data_form/verifikasi_kemampuan_berbeda',$nomor_pendaftar);
		$data['data_pendidikan']=$this->webserv->admisi('data_form/verifikasi_data_riwayat_pendidikan_s2',$nomor_pendaftar);
		$data['data_piljur']=$this->webserv->admisi('data_form/verifikasi_pilihan_jurusan',$nomor_pendaftar);
		$data['tawar']=$this->webserv->admisi('data_form/jalur_tawar',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/hanya_cetak",$data);
	}


	function data_verifikasi($id)
	{
		$data['nomor_pendaftar']=$id;
		$nomor=array('nomor_pendaftar'=>$id);

		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['pendidikan_terakhir']=$this->webserv->admisi('data_form/pendidikan_terakhir',$nomor_pendaftar);
		
		$nomor_pendaftar=array('VERIF_DATA_DIRI'=>$nomor);
		$data['pilih_jadwal']=$this->webserv->admisi('data_form/jadwal_pilih',$nomor_pendaftar);

		$nomor_pendaftar=array('VERIF_DATA_DIRI'=>$nomor);
		$data['data_diri']=$this->webserv->admisi('data_form/verifikasi_data_diri',$nomor_pendaftar);
		$data['data_kesehatan']=$this->webserv->admisi('data_form/verifikasi_data_kesehatan',$nomor_pendaftar);
		$data['data_kemampuan_berbeda']=$this->webserv->admisi('data_form/verifikasi_kemampuan_berbeda',$nomor_pendaftar);
		$data['data_pendidikan']=$this->webserv->admisi('data_form/verifikasi_data_riwayat_pendidikan_s2',$nomor_pendaftar);
		$data['data_piljur']=$this->webserv->admisi('data_form/verifikasi_pilihan_jurusan',$nomor_pendaftar);
		$data['tawar']=$this->webserv->admisi('data_form/jalur_tawar',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/data_verifikasi",$data);
	}

function req_prodi_2($kelas,$jalur,$kode_penawaran,$nomor_pendaftar)
	{
		$isi['id_kelas']=$kelas;
		$isi['kode_jalur']=$jalur;
		$isi['kode_penawaran']=$kode_penawaran;
		$isi['nomor_pendaftar']=$nomor_pendaftar;

		$cari_prodi=array('REQUEST_PRODI'=>$isi);
		$data['penawaran_prodi'] = $this->webserv->admisi('data_form/detail_penawaran_prodi',$cari_prodi);

		switch (substr($isi['kode_jalur'], 0,1)) {
/* S1 */	case '1':
						echo "S1";	
				break;
/* S2 */	case '2':
						$kode_jalur1=array('REQUEST_JUMLAH'=>$isi);
						$data['jumlah_penawaran'] = $this->webserv->admisi('data_form/jumlah_penawaran_prodi',$kode_jalur1);
						
						return $data;
				break;
/* S3 */	case '3':
						$kode_jalur1=array('REQUEST_JUMLAH'=>$isi);
						$data['jumlah_penawaran'] = $this->webserv->admisi('data_form/jumlah_penawaran_prodi',$kode_jalur1);
						
						
						return $data;
						
				break;
		}

	}



	function req_prodi()
	{
		$isi['id_kelas']=$this->input->post('id_kelas');
		$isi['kode_jalur']=$this->input->post('kode_jalur');
		$isi['kode_penawaran']=$this->input->post('kode_penawaran');
		$isi['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		
			switch (substr($isi['kode_jalur'], 0,1)) {
/* S1 */	case '1':
						$cari_prodi=array('REQUEST_PRODI'=>$isi);
						$data['penawaran_prodi'] = $this->webserv->admisi('data_form/detail_penawaran_prodi_s1',$cari_prodi);

						$kode_jalur1=array('REQUEST_JUMLAH'=>$isi);
						$data['jumlah_penawaran'] = $this->webserv->admisi('data_form/jumlah_penawaran_prodi',$kode_jalur1);
						
						$cek_fak=array('CEK_FAK'=>$isi);
						$data['ambil_fakultas']=$this->webserv->admisi('data_form/cek_fakultas_piljur',$cek_fak);
						
						$kode_jalur=array('REQUEST_PRODI'=>$isi);
						$data['penawaran_jalur']=$this->webserv->admisi('data_form/detail_penawaran_jalur_admin',$kode_jalur);
						$nomor=array('nomor_pendaftar'=>$isi['nomor_pendaftar']);
						$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
						$data['maba']=$this->webserv->admisi('data_form/pilih_prodi',$nomor_pendaftar);
						$data['ambil_jadwal']=$this->webserv->admisi('data_form/data_ambil_jadwal',$nomor_pendaftar);
						$jalur_jadwal=array('DATA_JADWAL'=>$isi['kode_jalur']);
						$data['data_jadwal']=$this->webserv->admisi('data_form/data_jadwal_ujian',$jalur_jadwal);
						$data['nomor_pendaftar']=$isi['nomor_pendaftar'];
						$data['kode_jalur']=$isi['kode_jalur'];
						$this->load->view('form_daftar/jurusan',$data);

				break;
/* S2 */	case '2':
						$cari_prodi=array('REQUEST_PRODI'=>$isi);
						$data['penawaran_prodi'] = $this->webserv->admisi('data_form/detail_penawaran_prodi',$cari_prodi);

						$kode_jalur1=array('REQUEST_JUMLAH'=>$isi);
						$data['jumlah_penawaran'] = $this->webserv->admisi('data_form/jumlah_penawaran_prodi',$kode_jalur1);

						$kode_jalur=array('REQUEST_PRODI'=>$isi);
						$data['penawaran_jalur']=$this->webserv->admisi('data_form/detail_penawaran_jalur_admin',$kode_jalur);
						$nomor=array('nomor_pendaftar'=>$isi['nomor_pendaftar']);
						$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
						$data['maba']=$this->webserv->admisi('data_form/pilih_prodi',$nomor_pendaftar);
						$data['ambil_jadwal']=$this->webserv->admisi('data_form/data_ambil_jadwal',$nomor_pendaftar);
						$jalur_jadwal=array('DATA_JADWAL'=>$isi['kode_jalur']);
						$data['data_jadwal']=$this->webserv->admisi('data_form/data_jadwal_ujian',$jalur_jadwal);
						$data['nomor_pendaftar']=$isi['nomor_pendaftar'];
						$data['kode_jalur']=$isi['kode_jalur'];
						$this->load->view('form_daftar/jurusan',$data);
				break;
/* S3 */	case '3':
						$cari_prodi=array('REQUEST_PRODI'=>$isi);
						$data['penawaran_prodi'] = $this->webserv->admisi('data_form/detail_penawaran_prodi',$cari_prodi);
		

						$kode_jalur1=array('REQUEST_JUMLAH'=>$isi);
						$data['jumlah_penawaran'] = $this->webserv->admisi('data_form/jumlah_penawaran_prodi',$kode_jalur1);
						$kode_jalur=array('REQUEST_PRODI'=>$isi);
						$data['penawaran_jalur']=$this->webserv->admisi('data_form/detail_penawaran_jalur_admin',$kode_jalur);
						$nomor=array('nomor_pendaftar'=>$isi['nomor_pendaftar']);
						$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
						$data['maba']=$this->webserv->admisi('data_form/pilih_prodi',$nomor_pendaftar);
						$data['ambil_jadwal']=$this->webserv->admisi('data_form/data_ambil_jadwal',$nomor_pendaftar);
						$jalur_jadwal=array('DATA_JADWAL'=>$isi['kode_jalur']);
						$data['data_jadwal']=$this->webserv->admisi('data_form/data_jadwal_ujian',$jalur_jadwal);
						$data['nomor_pendaftar']=$isi['nomor_pendaftar'];
						$data['kode_jalur']=$isi['kode_jalur'];
						
						$this->load->view('form_daftar/jurusan',$data);
				break;
			
		}

	}

	
	function data_piljur($id,$jal)
	{
		$jalur['kode_jalur']=$jal;
		$nomor['nomor_pendaftar']=$id;
		$kode_jalur=array('REQUEST_PRODI'=>$jalur);
		$kode_penawaran=$this->webserv->admisi('data_form/detail_penawaran_jalur_admin',$kode_jalur);

		if($kode_penawaran)
		{
			if(!is_null($kode_penawaran))
			{
				foreach ($kode_penawaran as $penawaran) {
					$datapen=$penawaran->kode_penawaran;
				}
			}
		}
		$data['kode_jalur']=$jal;	
		$data['nomor_pendaftar']=$id;
		$pen['kode_penawaran']=$datapen;
		$data['kode_penawaran']=$datapen;
		$kode_jalur=array('REQUEST_PRODI'=>$data);
		$data['penawaran_jalur']=$this->webserv->admisi('data_form/detail_penawaran_jalur_admin',$kode_jalur);
						
		$kirim_id=array('CARI_KELAS'=>$pen);
		$data['kelas']=$this->webserv->admisi('input_data/kelas',$kirim_id);
		$jml_kel=0;
		if(!is_null($data['kelas']))
		{
			foreach ($data['kelas'] as $dakel) {
				$jml_kel=count($dakel);
			}
		}
		if($jml_kel=='1')
		{
						$isi['id_kelas']=$dakel->id_kelas;
						$isi['kode_jalur']=$jal;
						$isi['kode_penawaran']=$datapen;
						$isi['nomor_pendaftar']=$id;
						
						$penprod['id_kelas']=$dakel->id_kelas;
						$penprod['kode_jalur']=$jal;
						$penprod['nomor_pendaftar']=$id;
						switch (substr($isi['kode_jalur'], 0,1)) {
						/* S1 */	case '1':

	
						$cek_fak=array('CEK_FAK'=>$isi);
						$data['ambil_fakultas']=$this->webserv->admisi('data_form/cek_fakultas_piljur',$cek_fak);
						
						$cari_prodi=array('REQUEST_PRODI'=>$penprod);
						$data['penawaran_prodi'] = $this->webserv->admisi('data_form/detail_penawaran_prodi_s1',$cari_prodi);
						
						$kode_jalur1=array('REQUEST_JUMLAH'=>$isi);
						$data['jumlah_penawaran'] = $this->webserv->admisi('data_form/jumlah_penawaran_prodi',$kode_jalur1);
						
						break;
						/* S2 */	case '2':
						$cari_prodi=array('REQUEST_PRODI'=>$penprod);
						$data['penawaran_prodi'] = $this->webserv->admisi('data_form/detail_penawaran_prodi',$cari_prodi);
						
						$kode_jalur1=array('REQUEST_JUMLAH'=>$isi);
						$data['jumlah_penawaran'] = $this->webserv->admisi('data_form/jumlah_penawaran_prodi',$kode_jalur1);
				
						break;
						/* S3 */	case '3':
						$cari_prodi=array('REQUEST_PRODI'=>$penprod);
						$data['penawaran_prodi'] = $this->webserv->admisi('data_form/detail_penawaran_prodi',$cari_prodi);
						
						$kode_jalur1=array('REQUEST_JUMLAH'=>$isi);
						$data['jumlah_penawaran'] = $this->webserv->admisi('data_form/jumlah_penawaran_prodi',$kode_jalur1);
						break;
						}
		}
		

		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$data);
		$cek_fak=array('CEK_FAK'=>$data);
		$faku=array();
		$hasil_fak=$this->webserv->admisi('data_form/cek_fakultas_piljur',$cek_fak);
		if(!is_null($hasil_fak))
		{
			foreach ($hasil_fak as $fk) {
				array_push($faku, $fk->id_fakultas);
			}
		}
		$data['faculty']=$faku;
		
		$data['maba']=$this->webserv->admisi('data_form/pilih_prodi',$nomor_pendaftar);
		$data['ambil_jadwal']=$this->webserv->admisi('data_form/data_ambil_jadwal',$nomor_pendaftar);
						

		$jalur_jadwal=array('DATA_JADWAL'=>$jalur);
		$data['data_jadwal']=$this->webserv->admisi('data_form/detil_jadwal_tes',$jalur_jadwal);	
		
		$this->load->view('form_daftar/data_kelas_piljur',$data);
	}

	function data_disertasi($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/judul_disertasi',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/data_disertasi",$data);
	}

	function data_proposal_tesis($id)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/judul_tesis',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;
		$this->load->view("form_daftar/data_proposal_tesis",$data);
	}


	function cek_disertasi()
	{
		$id=$this->input->post('id');
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data=$this->webserv->admisi('data_form/judul_disertasi',$nomor_pendaftar);
		if(!is_null($data))
		{
			echo "1";
		}
		else
		{
			echo "0";
		}

	}
	function cek_tesis()
	{
		$id=$this->input->post('id');
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data=$this->webserv->admisi('data_form/judul_tesis',$nomor_pendaftar);
		if(!is_null($data))
		{
			echo "1";
		}
		else
		{
			echo "0";
		}

	}

	function data_riwayat_pendidikan_sebelumnya($id,$jalur)
	{
		$nomor=array('nomor_pendaftar'=>$id);
		$nomor_pendaftar=array('CARI_DATA_DIRI'=>$nomor);
		$data['maba']=$this->webserv->admisi('data_form/pendidikan_terakhir',$nomor_pendaftar);
		$data['nomor_pendaftar']=$id;

		$sarat['kode_jalur']=$jalur;
		$sarat['kode_prasyarat']='TAHUN';
		$cek_pras=array('CEK_PRASYARAT_JALUR'=>$sarat);
		$hasil_prasyarat=$this->webserv->admisi('pendaftaran/cek_prasyarat_jalur_tahun',$cek_pras);
		$tahun=0;
		if($hasil_prasyarat){
			if(!is_null($hasil_prasyarat))
			{
				foreach ($hasil_prasyarat as $haspra);
				$tahun=$haspra->skor;
			}
		}
		$data['tahun_ijazah']=$tahun;
		$data['sekolah']=$this->webserv->admisi('data_form/sekolah',array());
		$data['data_pendidikan'] = $this->webserv->admisi('data_form/jenjang_sma',array());
		$data['jurusan_sekolah'] = $this->webserv->admisi('data_form/jurusan_sekolah',array());
		
		$this->load->view("form_daftar/data_riwayat_pendidikan_sebelumnya",$data);
	}
}