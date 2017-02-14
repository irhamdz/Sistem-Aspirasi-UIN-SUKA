<?php

/**
* 
*/
class Daftar_mhs_c extends CI_Controller
{
	
	private $nomor_tersedia=array();

	function __construct()
	{
		parent::__construct();
		$this->load->library('webserv');
		$this->load->library("lib_wilayah_fungsi", '', 'wilayah');
		$this->api 		= $this->s00_lib_api;
		if($this->session->userdata('username')=='')
		{
			redirect(base_url());
		}
		
	}

	function index()
	{
		
	}

	

	function curr_number($kode_jalur,$kode_jadwal)
	{
		$data['kode_jalur']=$kode_jalur;
		$data['kode_jadwal']=$kode_jadwal;
		$kirim_jalur=array('CEK_NOMOR'=>$data);
		$no=$this->webserv->admisi('pendaftaran/nomor_peserta',$kirim_jalur);
		if(!is_null($no))
		{
			foreach ($no as $n);
			return array('nomor_peserta'=>$n->nomor_peserta,'id_ruang'=>$n->id_ruang);
		}
		else
		{
			return array();
		}
	}

	function curr_number_khusus($kode_jalur,$kode_jadwal)
	{
		$data['kode_jalur']=$kode_jalur;
		$data['kode_jadwal']=$kode_jadwal;
		$kirim_jalur=array('CEK_NOMOR'=>$data);
		$no=$this->webserv->admisi('pendaftaran/nomor_peserta_khusus',$kirim_jalur);
		if(!is_null($no))
		{
			foreach ($no as $n);
			return array('nomor_peserta'=>$n->nomor_peserta,'id_ruang'=>$n->id_ruang);
		}
		else
		{
			return array();
		}
	}

	function buat_nomor($thn,$jalur,$gel)
	{
	
			$data['urut']=substr($thn, 2,2).$jalur.$gel;	
			return $data['urut'];
	}

	function cek_ruang_ada($hasil)
	{
		if(!is_null($hasil))
		{
			foreach ($hasil as $ok);
			return $ok->ada;
		}
	}
/*
	function verifikasi_manual($kode_jalur,$gelombang,$tahun,$jadwal,$nomor_pendaftar)
	{
		
		$data['kode_jalur']=$kode_jalur;
		$data['tahun']=$tahun;
		$data['gelombang']=$gelombang;
		$data['kode_jadwal']=$jadwal;
		$is_ruang=array('RUANG_CEK'=>$data);
		$cek_ruang_tawar=$this->webserv->admisi('pendaftaran/cek_ruang_tawar',$is_ruang);
		
		$is_oke=$this->cek_ruang_ada($cek_ruang_tawar);

if($is_oke=='t') //ruang sudah diset
{
		$data['nomor_pendaftar']=$nomor_pendaftar;
		$nomor_pendaftar=array('VERIF_DATA_DIRI'=>$data);
		$difable=$this->webserv->admisi('data_form/verifikasi_kemampuan_berbeda',$nomor_pendaftar);

		$insert_data=array('VERIFIKASI'=>$data);
		$hasil=$this->webserv->admisi('pendaftaran/verifikasi',$insert_data);
		if($hasil)
		{
			if(count($difable) > 0)
			{	
				$nomor['nomor_peserta']=$this->curr_number_khusus($data['kode_jalur'],$data['kode_jadwal']);
			}
			else
			{
				$nomor['nomor_peserta']=$this->curr_number($data['kode_jalur'],$data['kode_jadwal']);
			};

			
			
			$nomor['nomor_pendaftar']=$data['nomor_pendaftar'];
			$nomor['kode_penawaran']=$kode_jalur.$gelombang.$tahun;
			
			//$tgl=array('TGL_VER'=>$nomor);
			//$tgl_verifi=$this->webserv->admisi('pendaftaran/insert_histori_verifikasi',$tgl);

			$cek_ruang=array('AMBIL_RUANG'=>$nomor);
			$ruang=$this->webserv->admisi('pendaftaran/ruang_ujian_kosong',$cek_ruang);
			if($ruang)
			{
				foreach ($ruang as $find_ruang) 
				{
					$id_ruang=$find_ruang->id_ruang;
				}
				$nomor['id_ruang']=$id_ruang;
				$masukan=array('VERIFIKASI'=>$nomor);
				$masuk=$this->webserv->admisi('pendaftaran/insert_ruang_ujian',$masukan);
				echo "BERHASIL";
			}
			else
			{
				echo "gagal";
			}
			
	}
	}

	

	}
*/

	function verifikasi()
	{
		
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$is_ruang=array('RUANG_CEK'=>$data);
		$cek_ruang_tawar=$this->webserv->admisi('pendaftaran/cek_ruang_tawar',$is_ruang);
		
		$is_oke=$this->cek_ruang_ada($cek_ruang_tawar);

if($is_oke=='t') //ruang sudah diset
{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$nomor_pendaftar=array('VERIF_DATA_DIRI'=>$data);
		$difable=$this->webserv->admisi('data_form/verifikasi_kemampuan_berbeda',$nomor_pendaftar);

			if(count($difable) > 0)
			{	
				$arr_no=$this->curr_number_khusus($data['kode_jalur'],$data['kode_jadwal']);
				if(count($arr_no)>0)
				{
					$nomor['nomor_peserta']=$arr_no['nomor_peserta'];
					$nomor['id_ruang']=$arr_no['id_ruang'];
				}
			}
			else
			{
				$arr_no=$this->curr_number($data['kode_jalur'],$data['kode_jadwal']);
				if(count($arr_no)>0)
				{
					$nomor['nomor_peserta']=$arr_no['nomor_peserta'];
					$nomor['id_ruang']=$arr_no['id_ruang'];
				}
			};

	if(count($arr_no)>0)
	{
			
			$nomor['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
			$nomor['kode_penawaran']=$this->input->post('kode_penawaran');
			
				$masukan=array('VERIFIKASI'=>$nomor);
				$masuk=$this->webserv->admisi('pendaftaran/insert_ruang_ujian',$masukan);
				if($masuk)
				{
					$tgl=array('TGL_VER'=>$nomor);
					$tgl_verifi=$this->webserv->admisi('pendaftaran/insert_histori_verifikasi',$tgl);
					$insert_data=array('VERIFIKASI'=>$data);
					$hasil=$this->webserv->admisi('pendaftaran/verifikasi',$insert_data);
					echo "1";
				}
				else
				{
					echo "<div class='bs-callout bs-callout-error'>VERIFIKASI GAGAL PERIKSA KONEKSI INTERNET ANDA</div>"; 
				}
				
			
			
	
	}
	else 
	{
		echo "<div class='bs-callout bs-callout-error'>RUANG UJIAN TELAH PENUH SILAKAN HUBUNGI ADMISI UIN SUNAN KALIJAGA</div>"; 
				
	}
}
else
{	
	echo "<div class='bs-callout bs-callout-error'>RUANG UJIAN JALUR ANDA BELUM DISETTING SILAKAN HUBUNGI ADMISI UIN SUNAN KALIJAGA</div>"; 
		
				
}
		
}

	function data_pesantren()
	{
		$info="DATA PESANTREN BERHASIL DIPERBAHARUI";
		$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
		echo $pesan;
	}

	function data_pesantren2()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['nama_pesantren']=$this->input->post('NM_PESANTREN');
		$data['nspp']=$this->input->post('KD_NSPP');
		$data['no_santri']=$this->input->post('NO_SANTRI');
		$data['jurusan']=$this->input->post('JURUSAN');
		$data['no_ijazah']=$this->input->post('NO_IJASAH');
		$data['tahun_masuk']=$this->input->post('THN_MASUK');
		$data['tahun_lulus']=$this->input->post('THN_LULUS');
		$data['nilai_sertifikat']=$this->input->post('NILAI');
		$data['ijazah']=$this->input->post('DOC_IJAZAH_NAME');
		$data['keterangan']=$this->input->post('KETERANGAN');
		$kirim=array('PESANTREN'=>$data);
		$hasil=$this->webserv->admisi('pendaftaran/simpan_riwayat_pesantren',$kirim);
		if($hasil)
		{
						
						
						$kirim=array('CARI_DATA_DIRI'=>$data);
						$data['data_pesantren']=$this->webserv->admisi('data_form/data_pesantren',$kirim);
						$info="DATA PESANTREN BERHASIL DISIMPAN";
						$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."</div>";
						echo $pesan;
						$this->load->view("v_table/table_pesantren",$data);
						

		}
			else
		{
					
						$info="DATA PESANTREN GAGAL DISIMPAN";
						$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."</div>";
						echo $pesan;
		}
		
	}	

	function data_diri()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor');
		$data['status_simpan']='0';
		$data['nama_lengkap']=str_replace("'", "''", $this->input->post('nama_lengkap'));
		$data['gelar_depan']=$this->input->post('gelar_depan');
		$data['gelar_belakang']=$this->input->post('gelar_belakang');
		$data['gelar_depan_na']=$this->input->post('gelar_depan_na');
		$data['gelar_belakang_na']=$this->input->post('gelar_belakang_na');
		$data['alamat_lengkap']=str_replace("'", "''", $this->input->post('alamat_saat_ini'));
		$data['tempat_lahir']=str_replace("'", "''", $this->input->post('tempat_lahir'));
		$data['tgl_lahir']=$this->input->post('tgl_lahir');
		$data['telp']=$this->input->post('telp');
		$data['nohp']=$this->input->post('hp');
		$data['id_agama']=$this->input->post('pmb1_agama');
		$data['jenis_kelamin']=$this->input->post('jenis_kelamin');
		$data['gol_darah']=$this->input->post('gol_darah');
		$data['kabupaten_lahir']=str_replace("'", "''", $this->input->post('kab_lahir'));
		$data['no_ktp']=$this->input->post('ktp_passport');
		$data['kode_provinsi']=$this->input->post('provinsi_saat_ini');
		$data['kode_kabupaten']=$this->input->post('kabupaten_saat_ini');
		$data['kode_kecamatan']=$this->input->post('kecamatan_saat_ini');
		$data['kelurahan']=str_replace("'", "''", $this->input->post('desa_saat_ini'));
		$data['rt']=$this->input->post('rt_saat_ini');
		$data['rw']=$this->input->post('rw_saat_ini');
		$data['kode_pos']=$this->input->post('kode_pos_saat_ini');
		$data['warga_negara']=$this->input->post('warga_negara');
		$data['negara_asal']=$this->input->post('negara_asal');
		$data['tinggi_badan']=$this->input->post('tinggi_bdn');
		$data['berat_badan']=$this->input->post('berat_bdn');
		$data['tanggal_akhir_ktp']=$this->input->post('tgl_akhir_ktp_pas');
		$data['alamat_asal']=str_replace("'", "''", $this->input->post('alamat_asal'));
		$data['rt_asal']=$this->input->post('rt_asal');
		$data['rw_asal']=$this->input->post('rw_asal');
		$data['kode_provinsi_asal']=$this->input->post('kd_prop');
		$data['kode_kabupaten_asal']=$this->input->post('kabupaten_asal');
		$data['kode_kecamatan_asal']=$this->input->post('kecamatan_asal');
		$data['kelurahan_asal']=str_replace("'", "''", $this->input->post('desa_asal'));
		$data['kode_pos_asal']=$this->input->post('kode_pos_asal');
		if($this->input->post('wna')!='')
		{
			$data['sertifikat_wna']=$this->input->post('wna');
		}
		else
		{
			$data['sertifikat_wna']=$this->input->post('wna2');
		}

		$data['website']=$this->input->post('web');
		$data['email']=$this->input->post('email');
		$data['facebook']=$this->input->post('fb');
		$data['twitter']=$this->input->post('twitter');
		$data['blog']=$this->input->post('blog');

		if($this->input->post('foto') != '')
		{
			
			$data['foto']=$this->input->post('foto');
			
		}
		else
		{
			
			$data['foto']=$this->input->post('foto2');
		};
		
	if($this->input->post('akta') != '')
		{
			
			$data['akta_kelahiran']=$this->input->post('akta');
		}
		else
		{
		
			$data['akta_kelahiran']=$this->input->post('akta2');	
		}

		
		$kerja['nomor_pendaftar']=$this->input->post('nomor');		
		$kerja['nama_pekerjaan']=str_replace("'", "''", $this->input->post('pekerjaan_mhs'));
		$kerja['alamat']=str_replace("'", "''", $this->input->post('alamat_kerja'));
		$kerja['rt']=$this->input->post('rt_kerja');
		$kerja['rw']=$this->input->post('rw_kerja');
		$kerja['kode_kelurahan']=str_replace("'", "''", $this->input->post('desa_kerja'));
		$kerja['kode_provinsi']=$this->input->post('provinsi_kerja');
		$kerja['kode_kabupaten']=$this->input->post('kabupaten_kerja');
		$kerja['kode_kecamatan']=$this->input->post('kecamatan_kerja');
		$kerja['kode_pos']=$this->input->post('kode_pos_kerja');
		$kerja['telp']=$this->input->post('telp_kerja');
		$kerja['fax']=$this->input->post('fax_kerja');
		$kerja['email']=$this->input->post('email_kerja');
		
				$insert_data=array('UPDATE_PK'=>$kerja);
				$pekerjaan=$this->webserv->admisi('pendaftaran/pekerjaan_mahasiswa',$insert_data);
				
				$kirim=array('SEND_DATA_DIRI'=>$data);
				$hasil=$this->webserv->admisi('pendaftaran/data_diri',$kirim);
				
				if($hasil)
				{
					
					$foto_ok=0;
					$akta_ok=0;
					$v['nomor_pendaftar']=$this->input->post('nomor');
					$valid=array('MHS'=>$v);
					$is_foto=$this->webserv->admisi('data_form/cari_foto',$valid);
					$is_akta=$this->webserv->admisi('data_form/cari_akta',$valid);
					if(!is_null($is_foto))
					{
					foreach ($is_foto as $f);
					$foto_ok=strlen($f->ada);
					
					}
					if(!is_null($is_akta))
					{
					foreach ($is_akta as $a);
					$akta_ok=strlen($a->ada);
					
					};
					if($foto_ok > 20)
					{
						
						$info="DATA DIRI ANDA BERHASIL DISIMPAN";
						$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
					

					}
					else
					{
					
						$info="UPLOAD FOTO DAN AKTA KELAHIRAN ANDA";
						$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
				
					}
				
				}	
				else
				{
				$info="DATA DIRI ANDA TIDAK DAPAT DISIMPAN";
				$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
				
				};
		
	
		echo $pesan;

		

		
	}

	function data_keluarga()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['anak']=$this->input->post('ANAK_KE');
		$data['jumlah_saudara']=$this->input->post('JUM_SAUDARA');
		$data['tanggungan_orang_tua']=$this->input->post('JUM_TANGGUNGAN');
		$data['gaji_ibu']=$this->input->post('GAJI_IBU');
		$data['jumlah_tabungan_ibu']=$this->input->post('JUM_TABUNGAN_IBU');
		$data['jumlah_hutang_ibu']=$this->input->post('JUM_HUTANG_IBU');
		$data['cicilan_hutang_ibu']=$this->input->post('CICILAN_HUTANG_IBU');
		$data['jumlah_piutang_ibu']=$this->input->post('JUM_PIUTANG_IBU');
		$data['cicilan_piutang_ibu']=$this->input->post('CICILAN_PIUTANG_IBU');
		$data['gaji_ayah']=$this->input->post('GAJI_BAPAK');
		$data['jumlah_tabungan_ayah']=$this->input->post('JUM_TABUNGAN_BPK');
		$data['jumlah_hutang_ayah']=$this->input->post('JUM_HUTANG_BPK');
		$data['cicilan_hutang_ayah']=$this->input->post('CICILAN_HUTANG_BPK');
		$data['jumlah_piutang_ayah']=$this->input->post('JUM_PIUTANG_BPK');
		$data['cicilan_piutang_ayah']=$this->input->post('CICILAN_PIUTANG_BPK');
		$data['gaji_wali']=$this->input->post('GAJI_WALI');
		$data['jumlah_tabungan_wali']=$this->input->post('JUM_TABUNGAN_WALI');
		$data['jumlah_hutang_wali']=$this->input->post('JUM_HUTANG_WALI');
		$data['cicilan_hutang_wali']=$this->input->post('CICILAN_HUTANG_WALI');
		$data['jumlah_piutang_wali']=$this->input->post('JUM_PIUTANG_WALI');
		$data['cicilan_piutang_wali']=$this->input->post('CICILAN_PIUTANG_WALI');
		$data['kartu_keluarga']=$this->input->post('DOC_KK_NAME');
		$data['surat_keterangan_penghasilan_ibu']=$this->input->post('DOC_PENGHASILAN_IBU_NAME');
		$data['surat_keterangan_penghasilan_ayah']=$this->input->post('DOC_PENGHASILAN_BPK_NAME');
		$data['surat_keterangan_penghasilan_wali']=$this->input->post('DOC_PENGHASILAN_WALI_NAME');
		$data['kartu_miskin']=$this->input->post('DOC_KARTU_MISKIN_NAME');
		$data['status_perkawinan']=$this->input->post('STATUS_KAWIN');
		$data['nama_suami_istri']=$this->input->post('NM_PASANGAN');
		$data['keterangan']=$this->input->post('KETERANGAN');
		

		$insert_data=array('UPDATE_DATA_KEL'=>$data);
		$hasil=$this->webserv->admisi('pendaftaran/data_keluarga',$insert_data);
		if($hasil)
		{

			$info="DATA KELUARGA ANDA BERHASIL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			
		}
		else
		{
			$info="DATA KELUARGA ANDA GAGAL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			
		}
		echo $pesan;
		

	}

	function data_ibu()
	{
		$data['nama_lengkap_ibu']=str_replace("'", "''", $this->input->post('NM_IBU_KANDUNG'));
		$data['status_ibu']=$this->input->post('KD_STATUS_IBU');
		$data['tempat_lahir_ibu']=$this->input->post('TMP_LAHIR_IBU');
		$data['tanggal_lahir_ibu']=$this->input->post('tgl_lahir_Ibu');
		$data['id_agama_ibu']=$this->input->post('KD_AGAMA_IBU');
		$data['id_jenjang_pendidikan_ibu']=$this->input->post('KD_PEND_IBU');
		$data['pekerjaan_ibu']=str_replace("'", "''", $this->input->post('KD_KERJA_IBU'));
		$data['golongan_ibu']=$this->input->post('KERJA_IBU_DETAIL');//golongan
		$data['alamat_lengkap_ibu']=str_replace("'", "''", $this->input->post('ALAMAT_IBU'));
		$data['rt_ibu']=$this->input->post('RT_IBU');
		$data['rw_ibu']=$this->input->post('RW_IBU');
		$data['desa_ibu']=str_replace("'", "''",$this->input->post('DESA_IBU'));
		$data['prop_ibu']=$this->input->post('KD_PROP_IBU');
		$data['kab_ibu']=$this->input->post('KD_KAB_IBU');
		$data['kec_ibu']=$this->input->post('KD_KEC_IBU');
		$data['id_negara_ibu']=$this->input->post('KD_NEGARA_IBU');
		$data['kode_pos_ibu']=$this->input->post('KODE_POS_IBU');
		$data['telp_ibu']=$this->input->post('TELP_IBU');
		$data['nohp_ibu']=$this->input->post('HP_IBU');
		$data['email_ibu']=$this->input->post('EMAIL_IBU');
		$data['status_simpan']='0';
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		
		$insert_data=array('UPDATE_IBU'=>$data);
		$hasil=$this->webserv->admisi('pendaftaran/data_ibu',$insert_data);
		if($hasil)
		{

			$info="DATA IBU ANDA BERHASIL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			
		}
		else
		{
			$info="DATA IBU ANDA GAGAL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			
		}
		echo $pesan;

		
	}

	function data_bapak()
	{
		$data['nama_lengkap_ayah']=str_replace("'", "''", $this->input->post('NM_BPK_KANDUNG'));
		$data['status_ayah']=$this->input->post('KD_STATUS_BPK');
		$data['tempat_lahir_ayah']=str_replace("'", "''", $this->input->post('TMP_LAHIR_BPK'));
		$data['tanggal_lahir_ayah']=$this->input->post('tgl_lahir_ayah');
		$data['id_agama_ayah']=$this->input->post('KD_AGAMA_BPK');
		$data['id_jenjang_pendidikan_ayah']=$this->input->post('KD_PEND_BPK');
		$data['pekerjaan_ayah']=str_replace("'", "''", $this->input->post('KD_KERJA_BPK'));
		$data['golongan_ayah']=$this->input->post('KERJA_BPK_DETAIL');//golongan
		$data['alamat_lengkap_ayah']=str_replace("'", "''", $this->input->post('ALAMAT_BPK'));
		$data['rt_ayah']=$this->input->post('RT_BPK');
		$data['rw_ayah']=$this->input->post('RW_BPK');
		$data['desa_ayah']=str_replace("'", "''", $this->input->post('DESA_BPK'));
		$data['prop_ayah']=$this->input->post('KD_PROP_BPK');
		$data['kab_ayah']=$this->input->post('KD_KAB_BPK');
		$data['kec_ayah']=$this->input->post('KD_KEC_BPK');
		$data['id_negara_ayah']=$this->input->post('KD_NEGARA_BPK');
		$data['kode_pos_ayah']=$this->input->post('KODE_POS_BPK');
		$data['telp_ayah']=$this->input->post('TELP_BPK');
		$data['nohp_ayah']=$this->input->post('HP_BPK');
		$data['email_ayah']=str_replace("'", "''", $this->input->post('EMAIL_BPK'));
		$data['status_simpan']='0';
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		
		$insert_data=array('UPDATE_AYAH'=>$data);
		$hasil=$this->webserv->admisi('pendaftaran/data_ayah',$insert_data);
		if($hasil)
		{

			$info="DATA AYAH ANDA BERHASIL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			
		}
		else
		{
			$info="DATA AYAH ANDA GAGAL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			
		}
		echo $pesan;
		
	}

	function data_kegiatan()
	{
		$data['nama_kegiatan']=$this->input->post('NM_KEGIATAN');
		$data['nama_penyelenggara']=$this->input->post('NM_PENY_KEGIATAN');
		$data['tanggal_mulai']=$this->input->post('tgl_mulai_keg');
		$data['tanggal_selesai']=$this->input->post('tgl_selesai_keg');
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['id_kegiatan']=$this->input->post('KD_JENIS_KEGIATAN');
		$data['keterangan_jenis']=$this->input->post('KETERANGAN_JENIS_KEGIATAN');
		$data['no_bukti_sertifikat']=$this->input->post('NO_SERTIF_KEGIATAN');
		$data['sertifikat_kegiatan']=$this->input->post('DOC_SERTIF_KEGIATAN_NAME');
		$data['keterangan']=$this->input->post('KETERANGAN');

		$insert_data=array('UPDATE_KEGIATAN'=>$data);

		$hasil=$this->webserv->admisi('pendaftaran/data_kegiatan',$insert_data);

		if($hasil)
		{

			$info="DATA KEGIATAN ANDA BERHASIL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			
		}
		else
		{
			$info="DATA KEGIATAN ANDA GAGAL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			
		}
		echo $pesan;
		
	}

	function data_kesehatan()
	{
		$data['riwayat']=$this->input->post('TOP_RIWAYAT_KESEHATAN');
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');

		$insert_data=array('UPDATE_RIWAYAT_SAKIT'=>$data);
		$hasil=$this->webserv->admisi('pendaftaran/update_kesehatan',$insert_data);
		if($hasil)
		{

			$info="DATA RIWAYAT KESEHATAN BERHASIL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			
		}
		else
		{
			$info="DATA RIWAYAT KESEHATAN GAGAL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			
		}
		echo $pesan;
	}

	function batal_kemampuan_berbeda()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['id_kesehatan']=$this->input->post('id');
		$insert_data=array('DELETE_DIFABLE'=>$data);

		$hasil=$this->webserv->admisi('pendaftaran/batal_difable',$insert_data);
		
		
	}

	function kemampuan_berbeda()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['id_kesehatan']=$this->input->post('id');
		$insert_data=array('INSERT_DIFABLE'=>$data);

		$hasil=$this->webserv->admisi('pendaftaran/data_difable',$insert_data);
		
		
	}

	function data_kontak_darurat()
	{
		$data['nama_dihubungi']=$this->input->post('NM_KONTAK');
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['hubungan']=$this->input->post('TIPE_HUBUNGAN');
		$data['telp']=$this->input->post('TELP');
		$data['hp']=$this->input->post('HP');
		$data['alamat']=$this->input->post('ALAMAT');
		$data['rt']=$this->input->post('RT');
		$data['rw']=$this->input->post('RW');
		$data['kelurahan']=$this->input->post('DESA');
		$data['kode_provinsi']=$this->input->post('KD_PROP');
		$data['kode_kabupaten']=$this->input->post('KD_KAB');
		$data['kode_kecamatan']=$this->input->post('KD_KEC');
		$data['kode_negara']=$this->input->post('KD_NEGARA');
		$data['kode_pos']=$this->input->post('KODE_POS');
		$data['keterangan_hubungan']=$this->input->post('KETERANGAN_TIPE_HUBUNGAN');
		if($this->input->post('KD_PROP')=='')
		{
			$data['kode_provinsi']='0';
		};
		if($this->input->post('KD_KAB')=='')
		{
			$data['kode_kabupaten']='0';
		};
		if($this->input->post('KD_PROP')=='')
		{
			$data['kode_provinsi']='0';
		};
		if($this->input->post('KD_KEC')=='')
		{
			$data['kode_kecamatan']='0';
		};
		if($this->input->post('KD_NEGARA')=='')
		{
			$data['kode_negara']='0';
		};

		$insert_data=array('KONTAK_DARURAT'=>$data);

		$hasil=$this->webserv->admisi('pendaftaran/kontak_darurat',$insert_data);

		$info="DATA KONTAK DARURAT BERHASIL PERBAHARUI";
		$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			
		
		
		echo $pesan;
	
	}
	function data_minat_dan_ketrampilan()
	{

			$info="DATA MINAT DAN KETRAMPILAN BERHASIL DIPERBAHARUI";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			echo $pesan;
	}

	function data_organisasi()
	{

			$info="DATA ORGANISASI BERHASIL DIPERBAHARUI";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			echo $pesan;
	}

	function data_prestasi()
	{

			$info="DATA PRESTASI BERHASIL DIPERBAHARUI";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			echo $pesan;
	}

	function data_proposal_tesis()
	{

		$id=$this->input->post('nomor_pendaftar');
		$data=array('nomor_pendaftar'=>$id);
		$kirim=array('CARI_DATA_DIRI'=>$data);
		
		$hasil=$this->webserv->admisi('data_form/cari_tesis',$kirim);

		if($hasil)
		{
			foreach($hasil as $jml)
			{
				$ada=$jml->ada;
			}
			if($ada=='1')
			{
				$info="DATA TESIS BERHASIL DIPERBAHARUI";
				$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			}
			else if($ada=='0')
			{
				$info="DATA TESIS GAGAL DIPERBAHARUI ISI TESIS ANDA";
				$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			}	
		}
		
		echo $pesan;

				
	}

	function data_rencana_hidup()
	{

			$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
			$data['rencana_tinggal']=$this->input->post('KD_TEMPAT_TINGGAL');
			$data['dukungan_keluarga']=$this->input->post('DUKUNGAN_KEUANGAN');
			$data['transportasi_tempat_asal']=$this->input->post('KD_TRANSPORT_DAERAH');
			$data['transportasi_harian']=$this->input->post('KD_TRANSPORT_HARIAN');
			$data['keterangan_tinggal']=$this->input->post('KETERANGAN_TEMPAT_TINGGAL');
			$data['jumlah_dukungan']=$this->input->post('NOMINAL_DUKUNGAN_KEUANGAN');
			$data['keterangan_trans_asal']=$this->input->post('KETERANGAN_TRANSPORT_DAERAH');
			$data['keterangan_trans_harian']=$this->input->post('KETERANGAN_TRANSPORT_HARIAN');

			$insert_data=array('RENCANA_HIDUP'=>$data);
			
			$hasil=$this->webserv->admisi('pendaftaran/insert_rencana_hidup',$insert_data);
			
			if($hasil)
			{
			
			$info="DATA RENCANA HIDUP BERHASIL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			
			}
			else
			{
			$info="DATA RENCANA HIDUP GAGAL DISIMPAN";
			$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			
			}
			echo $pesan;
			
	}

	function data_riwayat_nilai_pendidikan_formal()
	{
		$info="DATA RIWAYAT BERHASIL DIPERBAHARUI";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			echo $pesan;	
	}

	function data_rumah_tinggal_keluarga()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['id_kepemilikan']=$this->input->post('KD_PEMILIKAN');
		$data['tahun_peroleh']=$this->input->post('TAHUN_PEROLEHAN');
		$data['id_sumber']=$this->input->post('KD_SUMBER_LISTRIK');
		$data['daya_listrik']=$this->input->post('DAYA_LISTRIK');
		$data['luas_tanah']=$this->input->post('LUAS_TANAH');
		$data['luas_bangunan']=$this->input->post('LUAS_BANGUNAN');
		$data['njop']=$this->input->post('NJOP');
		$data['id_mck']=$this->input->post('MCK');
		$data['id_sumber_air']=$this->input->post('KD_SUMBER_AIR');
		$data['id_bahan_atap']=$this->input->post('KD_BAHAN_ATAP');
		$data['id_bahan_dinding']=$this->input->post('KD_BAHAN_DINDING');
		$data['id_bahan_lantai']=$this->input->post('KD_BAHAN_LANTAI');
		$data['jarak_pusat_kota']=$this->input->post('JARAK_DARI_KOTA');
		$data['jumlah_orang_tinggal']=$this->input->post('JUMLAH_ORG_TINGGAL');
		$data['pbb']=$this->input->post('NOMINAL_PBB');
		$data['pln']=$this->input->post('NOMINAL_PLN');
		$data['pdam']=$this->input->post('NOMINAL_PDAM');
		$data['telkom']=$this->input->post('NOMINAL_TELP');
		$data['internet']=$this->input->post('NOMINAL_INTERNET');

		if($this->input->post('DOC_FOTO_RUMAH_NAME')!='')
		{
			$data['foto_rumah']=$this->input->post('DOC_FOTO_RUMAH_NAME');
		}
		else
		{
			$data['foto_rumah']=$this->input->post('DOC_FOTO_RUMAH_NAME2');
		}

		if($this->input->post('DOC_PBB_NAME')!='')
		{
			$data['bukti_pembayaran_pbb']=$this->input->post('DOC_PBB_NAME');
		}
		else
		{
			$data['bukti_pembayaran_pbb']=$this->input->post('DOC_PBB_NAME2');
		
		};
		if($this->input->post('DOC_PLN_NAME')!='')
		{
			$data['bukti_pembayaran_pln']=$this->input->post('DOC_PLN_NAME');
		}
		else
		{
			$data['bukti_pembayaran_pln']=$this->input->post('DOC_PLN_NAME2');
		};

		if($this->input->post('DOC_AIR_NAME')!='')
		{
			$data['bukti_pembayaran_pdam']=$this->input->post('DOC_AIR_NAME');
		}
		else
		{
			$data['bukti_pembayaran_pdam']=$this->input->post('DOC_AIR_NAME2');
		};
		if($this->input->post('DOC_TELP_NAME')!='')
		{
			$data['bukti_pembayaran_telkom']=$this->input->post('DOC_TELP_NAME');
		}
		else
		{
			$data['bukti_pembayaran_telkom']=$this->input->post('DOC_TELP_NAME2');
		};
		if($this->input->post('DOC_INTERNET_NAME')!='')
		{
			$data['bukti_pembayaran_internet']=$this->input->post('DOC_INTERNET_NAME');
		}
		else
		{
			$data['bukti_pembayaran_internet']=$this->input->post('DOC_INTERNET_NAME2');
		}
		
		$data['ket_listrik']=$this->input->post('SUMBER_LISTRIK_KETERANGAN');
		$data['ket_mck']=$this->input->post('MCK_KETERANGAN');
		$data['ket_air']=$this->input->post('KETERANGAN_SUMBER_AIR');
		$data['ket_atap']=$this->input->post('BAHAN_ATAP_KETERANGAN');
		$data['ket_dinding']=$this->input->post('BAHAN_DINDING_KETERANGAN');
		$data['ket_lantai']=$this->input->post('BAHAN_LANTAI_KETERANGAN');

		$insert_data=array('UPDATE_RUMAH'=>$data);
		$hasil=$this->webserv->admisi('pendaftaran/update_rumah',$insert_data);

		if($hasil)
		{

		$info="DATA RUMAH TINGGAL KELUARGA BERHASIL DIPERBAHARUI";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			
		}
		else
		{
			$info="DATA RUMAH TINGGAL KELUARGA GAGAL DIPERBAHARUI";
			$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			
		}
		echo $pesan;
	}

	function data_wali()
	{
		if($this->input->post('TMP_LAHIR_WALI')!='' && $this->input->post('TMP_LAHIR_WALI')!='-')
		{
			$data['status_simpan_wali']='0';
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['nama_wali']=str_replace("'", "''",$this->input->post('NM_WALI'));
		$data['tempat_lahir']=str_replace("'", "''", $this->input->post('TMP_LAHIR_WALI'));
		$data['tanggal_lahir']=$this->input->post('tgl_lahir_wali');
		$data['id_agama']=$this->input->post('KD_AGAMA_WALI');
		$data['id_jenjang']=$this->input->post('KD_PEND_WALI');
		$data['id_pekerjaan']=$this->input->post('KD_KERJA_WALI');
		$data['golongan']=$this->input->post('KERJA_WALI_DETAIL');//goll
		$data['alamat']=str_replace("'", "''", $this->input->post('ALAMAT_WALI'));
		$data['rt']=$this->input->post('RT_WALI');
		$data['rw']=$this->input->post('RW_WALI');
		$data['kelurahan']=str_replace("'", "''", $this->input->post('DESA_WALI'));
		$data['kode_provinsi']=$this->input->post('KD_PROP_WALI');
		$data['kode_kabupaten']=$this->input->post('KD_KAB_WALI');
		$data['kode_kecamatan']=$this->input->post('KD_KEC_WALI');
		$data['kode_negara']=$this->input->post('KD_NEGARA_WALI');
		$data['kode_pos']=$this->input->post('KODE_POS_WALI');
		$data['telp']=$this->input->post('TELP_WALI');
		$data['hp']=$this->input->post('HP_WALI');
		$data['email']=str_replace("'", "''", $this->input->post('EMAIL_WALI'));
		$data['status_wali']=$this->input->post('KD_STATUS_WALI');
		$data['keterangan']=$this->input->post('STATUS_WALI');//ket
		}

		else
		{
		$data['status_simpan_wali']='0';
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['nama_wali']=$this->input->post('NM_WALI');
		$data['tempat_lahir']='-';
		$data['tanggal_lahir']=date('d/m/Y');
		$data['id_agama']='0';
		$data['id_jenjang']='0';
		$data['id_pekerjaan']='0';
		$data['golongan']='-';
		$data['alamat']='-';
		$data['rt']='0';
		$data['rw']='0';
		$data['kelurahan']='-';
		$data['kode_provinsi']='0';
		$data['kode_kabupaten']='0';
		$data['kode_kecamatan']='0';
		$data['kode_negara']='0';
		$data['kode_pos']='-';
		$data['telp']='-';
		$data['hp']='-';
		$data['email']='-';
		$data['status_wali']='-';
		$data['keterangan']='-';
		}
		

		$insert_data=array('UPDATE_WALI'=>$data);
		$hasil=$this->webserv->admisi('pendaftaran/update_wali',$insert_data);

		if($hasil)
		{

		$info="DATA WALI BERHASIL DIPERBAHARUI";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			
		}
		else
		{
			$info="DATA WALI GAGAL DIPERBAHARUI";
			$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			
		}
		echo $pesan;
	}

	function data_riwayat_pendidikan_sebelumnya()
	{
			$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
			
			$cek_data=array('CEK_PENDIDIKAN'=>$data);
			
			$hasil=$this->webserv->admisi('data_form/cek_pendidikan',$cek_data);
			
			if($hasil)
			{
				foreach ($hasil as $jml);
				
				
						if($jml->ada > 0)
						{
						
							$info="DATA PENDIDIKAN BERHASIL DIPERBAHARUI";
							$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
							echo $pesan;
						}
						else
						{
							$info="ANDA HARUS MEMASUKKAN RIWAYAT PENDIDIKAN TERAKHIR";
							$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
							echo $pesan;
						}
	
						
							
				
					
					
			}
			else
			{
				
							$info="PENGECEKAN DATA RIWAYAT PENDIDIKAN GAGAL";
							$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
							echo $pesan;
			}
			
			
		
	}

	function riwayat_pendidikan_s2()
	{
		$data['kode_penawaran']=$this->input->post('r_p_s2_penawaran');
		$data['kode_prasyarat']='IPK';
		$cek_pras=array('CEK_PRASYARAT_JALUR'=>$data);
		$hasil_prasyarat=$this->webserv->admisi('pendaftaran/cek_prasyarat_jalur',$cek_pras);
		$ipk_sarat=0;
		if($hasil_prasyarat){
			if(!is_null($hasil_prasyarat))
			{
				foreach ($hasil_prasyarat as $haspra) {
					$ipk_sarat=$haspra->skor;
				}
			}
		}


		$data['ipk']=$this->input->post('pmb1_ipk');
		if($data['ipk'] >= $ipk_sarat)
		{
				$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
				$data['id_pendidikan']=$this->input->post('pmb1_lulusan_dari');
				$data['pend_lain']=$this->input->post('lulusan_lain');
				$data['nama_pt']=str_replace("'", "''", $this->input->post('pmb1_nama_pt'));
				$data['tahun_ijazah']=$this->input->post('pmb1_tahun_ijazah');
				$data['akreditasi']=$this->input->post('akreditasi');
				$data['status_simpan']='0';
				if($this->input->post('ijazah')!='')
				{
				$data['ijazah']=$this->input->post('ijazah');
				}
				else
				{
				$data['ijazah']=$this->input->post('ijazah2');
				};

				if($this->input->post('tr')!='')
				{
				$data['trans']=$this->input->post('tr');
				}
				else
				{
				$data['trans']=$this->input->post('tr2');
				};

				if(!empty($data['ijazah']) && !empty($data['trans']))
				{
					if(!empty($data['akreditasi']))
					{
					
						$insert_data=array('UPDATE_PEND_S2'=>$data);
						$hasil=$this->webserv->admisi('pendaftaran/update_pend_s2',$insert_data);
						
						if($hasil)
						{
						
						$info="DATA RIWAYAT PENDIDIKAN BERHASIL DIPERBAHARUI";
						$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
						

						}
						else
						{
						$info="DATA RIWAYAT PENDIDIKAN GAGAL DIPERBAHARUI";
						$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
						
						}

					}
					else
					{
						$info="AKREDITASI BELUM DIISI";
						$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
					
					}
				}
				else
				{
					$info="UPLOAD IJAZAH DAN TRANSKRIP NILAI ANDA";
					$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
					
				}
				
				
		}
		else
		{
				$info="ANDA TIDAK MEMENUHI PRASYARAT.";
				$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
					
		}
			echo $pesan;
	
	}
	function data_penelitian()
	{
		$jalur=$this->input->post('pjalur');
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['judul']=$this->input->post('judul_penelitian');
		$data['status']=$this->input->post('kedudukan');
		$data['tahun']=$this->input->post('tahun_penelitian');
		$data['sponsor']=$this->input->post('sponsor');
			if(str_replace(" ","",$data['judul']) != '' && str_replace(" ","",$data['tahun']) != '')
			{
					if($this->input->post('rekomendasi')!='')
					{
					$data['rekomendasi']=$this->input->post('rekomendasi');
					}
					else
					{
					$data['rekomendasi']=$this->input->post('rekomendasi2');
					}
					
					
					$insert_data=array('UPDATE_PENELITIAN'=>$data);
					$hasil=$this->webserv->admisi('pendaftaran/update_penelitian',$insert_data);
					
					if($hasil)
					{
					
					$info="DATA PENELITIAN BERHASIL DIPERBAHARUI";
					$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
					
					}
					else
					{
					$info="DATA PENELITIAN GAGAL DIPERBAHARUI";
					$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
					
					}
				
		}
		else
		{
					$info="DATA PENELITIAN GAGAL DIPERBAHARUI";
					$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
					
		}
		echo $pesan;
		
	}
	function data_karya_tulis()
	{

		$info="DATA BERHASIL DIPERBAHARUI";
			$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			echo $pesan;	
	}

	function data_disertasi()
	{
		$id=$this->input->post('nomor_pendaftar');
		$data=array('nomor_pendaftar'=>$id);
		$insert_data=array('CEK_DISERTASI'=>$data);
		
		$hasil=$this->webserv->admisi('pendaftaran/cek_disertasi',$insert_data);

		if($hasil)
		{
			foreach($hasil as $jml)
			{
				$ada=$jml->ada;
			}
			if($ada=='1')
			{
				$info="DATA DISERTASI BERHASIL DIPERBAHARUI";
				$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
			}
			else if($ada=='0')
			{
				$info="DATA DISERTASI GAGAL DIPERBAHARUI ISI DISERTASI ANDA";
				$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			}	
		}
		
		echo $pesan;

				
	}

	function cari_fakultas()
	{
		$data['pilihan']=$this->input->post('id_prodi');
		$kirim=array('CEK_FAK'=>$data);
		$hasil=$this->webserv->admisi('data_form/cek_fakultas',$kirim);
		if(!is_null($hasil))
		{
			foreach ($hasil as $f);
			echo $f->id_fakultas;
		}
	}

	function delete_pil_prod($NO)
	{
		$data['nomor_pendaftar']=$NO;
		$data['pilihan']='3';
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

	function data_piljur()
	{
		$lokasi=$this->input->post('lokasi_ujian');
		$pilihan=$this->input->post('pilihan');
		$fak=$this->input->post('fakultas');
		$nomor=$this->input->post('nomor_pendaftar');
		$jalur=substr($this->input->post('kode_jalur'),0,1);
		$data['nomor_pendaftar']=$nomor;
		$kirim=array('JADWAL'=>$data);
		$ok=0;
		$cek=$this->webserv->admisi('data_form/cek_pilih_jadwal',$kirim);
		if(!is_null($cek))
		{
			foreach ($cek as $c);
			$ok=$c->jml;
		}
		if($lokasi=='' || $ok == '0')
		{
			$info="ANDA HARUS MEMILIH LOKASI UJIAN DULU";
			$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			echo $pesan;
		}
		else 
		{	
			
			$erorIndex=array();
				for($i=0; $i<count($pilihan); $i++)
				{
					
					if($pilihan[$i]=='')
					{
						
						array_push($erorIndex, $i+1);
					}
				}

				if(count($erorIndex) > 0)
					{
						
						$info="PILIHAN PROGRAM STUDI BELUM PENUH";
						$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
						echo $pesan;
					}
					else
					{
						if($jalur=='1')//jalur s1
						{
							$is_same=array_unique($fak); 
							if(count($is_same)=='1' || count($is_same)=='2')
							{
								$this->delete_pil_prod($nomor);
							}
						}

						$d['nomor_pendaftar']=$nomor;
						$kirim2=array('CEK'=>$d);
						$prod=$this->webserv->admisi('pendaftaran/cek_pilprod',$kirim2);
						if($prod)
						{
							foreach ($prod as $pp);
							if($pp->jml > 0)
							{
								$info="PILIHAN PROGRAM STUDI BERHASIL";
								$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
						
							}
							else
							{
								$info="PILIHAN PROGRAM STUDI BELUM TERSIMPAN";
								$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
						
							}
						}
						else
						{
								$info="PILIHAN PROGRAM STUDI BELUM TERSIMPAN";
								$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
						
						}
						echo $pesan;
					}
				
		}		
		
		
		
	}

	function data_sertifikasi()
	{
		
			$data['kode_penawaran']=$this->input->post('d_s_penawaran');
			$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
			$data['nilai_toefl']=$this->input->post('nilai_toefl');
			$data['nilai_toafl']=$this->input->post('nilai_toafl');

			$data['nilai_bhs_indo']=$this->input->post('nilai_indo');

		//cek kode sarat yang aktif
	
		$cek_pras=array('CEK_PRASYARAT_JALUR'=>$data);
		$hasil_prasyarat=$this->webserv->admisi('pendaftaran/cek_prasyarat_jalur2',$cek_pras);
		
		$kode_sarat=array();
		$result=array();
		$hasil_sarat=array();
		if($hasil_prasyarat){
			if(!is_null($hasil_prasyarat))
			{
				foreach ($hasil_prasyarat as $hasTOE)
				{
					array_push($kode_sarat, $hasTOE->kode_prasyarat);
				}
			}
		}
		$TOEFL=0;
		$TOAFL=0;
		$TPA=0;
		
		for($i=0; $i<count($kode_sarat); $i++)
		{
			if($kode_sarat[$i]=='TOEFL' || $kode_sarat[$i]=='TOAFL' || $kode_sarat[$i]=='TPA')
			{
				$data_['kode_penawaran']=$this->input->post('d_s_penawaran');
				$data_['kode_prasyarat']=$kode_sarat[$i];
				$cek_data=array('CEK_PRASYARAT_JALUR'=>$data_);
				$result=$this->webserv->admisi('pendaftaran/cek_prasyarat_jalur',$cek_data);
				if($result)
				{
					if(!is_null($result))
					{
						foreach ($result as $rest) 
						{
							
							if($kode_sarat[$i]=='TOEFL')
							{
								$TOEFL=$rest->skor;
							}
							elseif($kode_sarat[$i]=='TOAFL')
							{
								$TOAFL=$rest->skor;
							}
							elseif($kode_sarat[$i]=='TPA')
							{
								$TPA=$rest->skor;	
							}
							
						}
					}

				}
				
			}

		}


		if(strlen($this->input->post('nilai_toefl')) > 0 || strlen($this->input->post('nilai_toafl')) > 0)
		{

			if($this->input->post('wna')!=''){ $data['sertifikat_bhs_indo']=$this->input->post('wna');}
			else{$data['sertifikat_bhs_indo']=$this->input->post('wna2');};


			if($this->input->post('toefl')!=''){$data['sertifikat_toefl']=$this->input->post('toefl');}
			else{$data['sertifikat_toefl']=$this->input->post('toefl2');};
			

			if($this->input->post('toafl')!='')
			{ $data['sertifikat_toafl']=$this->input->post('toafl');}
			else	
			{$data['sertifikat_toafl']=$this->input->post('toafl2');};
			
			if($this->input->post('gre')!='')
			{$data['sertifikat_gre']=$this->input->post('gre');}
			else	
			{$data['sertifikat_gre']=$this->input->post('gre2');};
			

			$data['nilai_gre']=$this->input->post('nilai_gre');
			
			
			if($this->input->post('kepemimpinan')!='')
			{
			$data['sertifikat_pendukung']=$this->input->post('kepemimpinan');
			}
			else
			{
			$data['sertifikat_pendukung']=$this->input->post('kepemimpinan2');
			};
			
			//if($data['nilai_gre']>=$TPA)
			//{
				//if($data['nilai_toafl']>=$TOAFL || $data['nilai_toefl']>=$TOEFL)
				//{
					
					if(strlen($data['sertifikat_toafl']) > 10 || strlen($data['sertifikat_toefl'])>10)
					{
							if($this->input->post('wn')!='99' && !empty($this->input->post('wn')))
							{
								if(strlen($data['sertifikat_bhs_indo'])>50)
								{
									$insert_data=array('UPDATE_SERTIFIKAT'=>$data);
									$hasil=$this->webserv->admisi('pendaftaran/update_sertifikat',$insert_data);
									
									if($hasil)
									{
									
									$info="DATA SERTIFIKASI BERHASIL DIPERBAHARUI";
									$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
									
									}
									else
									{
									$info="DATA SERTIFIKASI GAGAL DIPERBAHARUI";
									$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
									
									}
								}
								else
								{
									$info="UPLOAD SERTIFIKAT KEMAMPUAN BERBAHASA INDONESIA";
									$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
									
								};
							}
							else
							{
								$update_data=array('UPDATE_SERTIFIKAT'=>$data);
								$hasil2=$this->webserv->admisi('pendaftaran/update_sertifikat',$update_data);
								
								if($hasil2)
								{
							
								$info="DATA SERTIFIKASI BERHASIL DIPERBAHARUI";
								$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."<input type='hidden' id='hasil' value='1'></div>";
								
								}
								else
								{
								$info= print_r($update_data);//"DATA SERTIFIKASI GAGAL DIPERBAHARUI";
								$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
								
								};	
							};
						
						}
						else
						{
							$info="UPLOAD SERTIFIKAT ANDA";
							$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' serti='1' id='hasil' value='0'></div>";
			
						};

					//}
			
				
				

		}
		else
		{
			$info="ANDA HARUS MENGISI FORM DENGAN BENAR";
			$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
			
		}
	
		
		

	echo $pesan;
								
	}



}