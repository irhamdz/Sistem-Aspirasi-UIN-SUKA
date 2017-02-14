<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package		Service Web
 * @subpackage	Rest Server Website IT
 * @author		Daru Prasetyawan
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
//require APPPATH.'/libraries/REST_Controller.php';

class Yudisium_c extends CI_Controller
{

	function __construct() {
		parent::__construct();
		if($this->session->userdata('username')=='')
		{
			redirect(base_url());
		}
		$this->load->library('PHPExcel');
		$this->load->library('webserv');
		$this->load->helper('tanggal_lahir_helper');
		$this->load->library('it00_lib_auth','','auth');
		$this->api 		= $this->s00_lib_api;
	}
	
	function index()
	{
		
	}

	function putaran_spanptkin()
	{
		$hasil=$this->webserv->yudisium('yudisium/get_putaran_span',array());
		foreach ($hasil as $p);
		echo $p->pilihan_aktif;
	}

	function putaran_snmptn()
	{
		$hasil=$this->webserv->yudisium('yudisium/get_putaran',array());
		foreach ($hasil as $p);
		echo $p->pilihan_aktif;
	}

	function prodi_snmptn()
	{
		$data['nip']=$this->input->post('nip');
		$data['kode_jalur']=$this->input->post('jalur');
		$data['tahun']=$this->input->post('tahun');
		$kirim=array('PRODI'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/admin_prodi_snmptn',$kirim);
		if($hasil)
		{
			
			echo "<select name='prodi' id='prodi' style='width:200px;' class='form-control input-sm' onchange='id_prodi=this.value'>";
			echo "<option value=''> Pilih Prodi </option>";	
				foreach ($hasil as $p) {
					echo "<option value='".$p->kode_program_studi."'>".$p->nama_prodi."</option>";	
						
								}				
			echo "</select>";

		}
	}

	function prodi_spanptkin()
	{
		$data['nip']=$this->input->post('nip');
		$data['kode_jalur']=$this->input->post('jalur');
		$data['tahun']=$this->input->post('tahun');
		$kirim=array('PRODI'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/admin_prodi_spanptkin',$kirim);
		if(!is_null($hasil))
		{
			
			echo "<select name='prodi' id='prodi' style='width:200px;' class='form-control input-sm' onchange='id_prodi=this.value'>";
			echo "<option value=''> Pilih Prodi </option>";	
				foreach ($hasil as $p) {
					echo "<option value='".$p->kode_program_studi."'>".$p->nama_prodi."</option>";	
						
								}				
			echo "</select>";

		}

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
			case '11': $bulan= "November"; break;
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

	function cari_jadwal()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');//jalur+gelombang
		$data['tahun']=$this->input->post('tahun');
		$cari_jadwal=array('CARI_JADWAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_jadwal_ujian_portofolio',$cari_jadwal);
		if($hasil)
		{
			$temp="";
			echo "<select name='kode_jadwal' style='width:300px;'onchange='jadwal_porto=this.value' class='form-control input-md'>";
			echo "<option value=''>Pilih Jadwal</option>";
			foreach ($hasil as $jadwal) {
				if($temp != $jadwal->tanggal)
				{
					echo "<option value='".$jadwal->kode_jadwal."'>".$this->tanggal_hari(date_format(date_create($jadwal->tanggal),'d-m-Y'))."</option>";				
				}
			$temp=$jadwal->tanggal;
			}
			echo "</select>";

		}
		
	}

	function cari_nilai_snmptn()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']='1';
		$data['tahun']=$this->input->post('tahun');
		$data['pilihan']=$this->input->post('pilihan');//hilangkan komennya
		$data['id_prodi']=$this->input->post('prodi');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		$kirim=array("SNMPTN"=>$data);
		
				$hasil['kode_jalur']='14';
				$hasil['tahun']=$this->input->post('tahun');
				$hasil['id_kelas']='0';
				$hasil['id_prodi']=$this->input->post('prodi');
				$hasil['pilihan']=$this->input->post('pilihan');
				$hasil['gelombang']='1';
		if($this->cek_tanggal_yudisium($data['kode_penawaran'])=='1')
		{
			$hasil['yudis']=$this->webserv->yudisium('yudisium/sarat_yudisium',$kirim);
			$hasil['data_mhs']=$this->webserv->yudisium('yudisium/data_mhs_yudsium_snmptn',$kirim);
			$hasil2['grade']=$this->webserv->yudisium('yudisium/grade_prodi_snmptn',$kirim);
			if($hasil)
			{
			$prasyarat=array();
				if($hasil['yudis'])
				{
					if(!is_null($hasil['yudis']))
					{
						foreach ($hasil['yudis'] as $srt)
						{
							array_push($prasyarat, $srt);
							if($srt->id_jenis=='4')
							{
								$tgl_yudisium=explode('#', $srt->isi);
							}
						}
					}
				}
			$grade=0;
				if(!is_null($hasil2['grade']))
				{
					foreach ($hasil2['grade'] as $gp) {
						$grade=$gp->nilai_grade;
					}
				}
			$hasil['tes']=$this->webserv->yudisium('yudisium/nilai_yudisium_snmptn',$kirim);
			$nilai=array();
			$tes=array();
			$nilai_tes=array();
			if(!is_null($hasil['tes']))
			{
				foreach ($hasil['tes'] as $nt) {
					$nilai=array('NOMOR_PENDAFTAR'=>$nt->nomor_pendaftar,'NILAI_PERINGKAT_SEKOLAH'=>round($nt->nilai_peringkat_sekolah),
						'NILAI_MATA_PELAJARAN'=>round($nt->nilai_mata_pelajaran),'NILAI_PERINGKAT_SISWA'=>round($nt->nilai_peringkat_siswa),
						'NILAI_PRESTASI'=>round($nt->nilai_prestasi),'NILAI_PEMINAT_MANDIRI'=>round($nt->nilai_peminat_mandiri),'NILAI_UJIAN_NASIONAL'=>round($nt->nilai_ujian_nasional),
						'NILAI_SEBARAN_WILAYAH'=>round($nt->nilai_sebaran_wilayah),'NILAI_REKAM_JEJAK_ALUMNI'=>round($nt->nilai_rekam_jejak_alumni),
						'NILAI_RIWAYAT_SNMPTN'=>round($nt->nilai_riwayat_snmptn),'NILAI_RIWAYAT_SBMPTN'=>round($nt->nilai_riwayat_sbmptn));
					array_push($nilai_tes, $nilai);
				}
			}
	
			$hasil['nilai_tes']=json_decode(json_encode($nilai_tes));
			$hasil['grade']=$grade;
			$hasil['sarat']=$prasyarat;
			$this->load->view('v_table/tabel_yudisium',$hasil);
		}
		}
		else
		{
				$info="BUKAN MASA YUDISIUM";
				$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
				echo $pesan;
		}

		
	}

	function cari_nilai_spanptkin()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']='1';
		$data['tahun']=$this->input->post('tahun');
		$data['pilihan']=$this->input->post('pilihan');
		$data['id_prodi']=$this->input->post('prodi');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		$kirim=array("SPANPTKIN"=>$data);
		
				$hasil['kode_jalur']='15';
				$hasil['tahun']=$this->input->post('tahun');
				$hasil['id_kelas']='0';
				$hasil['id_prodi']=$this->input->post('prodi');
				$hasil['pilihan']=$this->input->post('pilihan');
				$hasil['gelombang']='1';
		if($this->cek_tanggal_yudisium($data['kode_penawaran'])=='1')
		{
			$hasil['yudis']=$this->webserv->yudisium('yudisium/sarat_yudisium',$kirim);
			$hasil['data_mhs']=$this->webserv->yudisium('yudisium/data_mhs_yudsium_spanptkin',$kirim);
			$hasil2['grade']=$this->webserv->yudisium('yudisium/grade_prodi_spanptkin',$kirim);
			if($hasil)
			{
			$prasyarat=array();
				if($hasil['yudis'])
				{
					if(!is_null($hasil['yudis']))
					{
						foreach ($hasil['yudis'] as $srt) {
							array_push($prasyarat, $srt);
						}
					}
				}
			$grade=0;
				if(!is_null($hasil2['grade']))
				{
					foreach ($hasil2['grade'] as $gp) {
						$grade=$gp->nilai_grade;
					}
				}
			$hasil['tes']=$this->webserv->yudisium('yudisium/nilai_yudisium_spanptkin',$kirim);
			$nilai=array();
			$tes=array();
			$nilai_tes=array();
			if(!is_null($hasil['tes']))
			{
				foreach ($hasil['tes'] as $nt) {
					$nilai=array('NOMOR_PENDAFTAR'=>$nt->nomor_pendaftar,'NILAI_PERINGKAT_SEKOLAH'=>round($nt->nilai_peringkat_sekolah),
						'NILAI_MATA_PELAJARAN'=>round($nt->nilai_mata_pelajaran),'NILAI_PERINGKAT_SISWA'=>round($nt->nilai_peringkat_siswa),
						'NILAI_PRESTASI'=>round($nt->nilai_prestasi),'NILAI_PEMINAT_MANDIRI'=>round($nt->nilai_peminat_mandiri),'NILAI_UJIAN_NASIONAL'=>round($nt->nilai_ujian_nasional),
						'NILAI_SEBARAN_WILAYAH'=>round($nt->nilai_sebaran_wilayah),'NILAI_REKAM_JEJAK_ALUMNI'=>round($nt->nilai_rekam_jejak_alumni),
						'NILAI_RIWAYAT_SNMPTN'=>round($nt->nilai_riwayat_snmptn),'NILAI_RIWAYAT_SBMPTN'=>round($nt->nilai_riwayat_sbmptn));
					array_push($nilai_tes, $nilai);
				}
			}
	
			$hasil['nilai_tes']=json_decode(json_encode($nilai_tes));
			$hasil['grade']=$grade;
			$hasil['sarat']=$prasyarat;
			$this->load->view('v_table/tabel_yudisium',$hasil);
			}
		}
		else
		{
				$info="BUKAN MASA YUDISIUM";
				$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
				echo $pesan;
		}

		
	}


	function cari_pil_prod()
	{
		$data['nomor_pendaftar']=$this->input->post("nomor_pendaftar");
		$kirim=array('PILPROD'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_pilihan_jurusan',$kirim);
		$yudi=$this->webserv->admisi('penilaian/cari_mhs',$kirim);
		
		if($hasil)
		{
			if(!is_null($hasil))
				{
				echo "<table class='table table-bordered table-hover'>";				
				foreach ($hasil as $p) {
					echo "<tr>";
					echo "<td>";
					echo "Pilihan ".$p->pilihan;
					echo "</td>";
					echo "<td>";
					echo $p->nama_prodi;
					echo "</td>";
					echo "<td>";
					echo $p->nama_kelas;
					echo "</td>";
                echo "</tr>";
				}
				echo "</tbody>";
			echo "</table>";
			}
		}
	
		
	}

	function update_footer()
	{
		$data['id_footer']=$this->input->post('id_footer');
		$data['nip']=$this->input->post('nip');
		$data['nama']=$this->input->post('nama');
		$data['jabatan1']=$this->input->post('jabatan1');
		$data['jabatan2']=$this->input->post('jabatan2');
		$data['tanggal']=$this->input->post('tanggal');
		$kirim=array('FOOTER'=>$data);
		
		$hasil=$this->webserv->yudisium('yudisium/update_footer',$kirim);
		if($hasil)
		{
			echo "Berhasil.";
		}
		else
		{
			echo "Gagal.";
		}

	}

	function cari_pegawai()
	{
		$kd_pgw=$this->input->post('nip');
		$parameter = array('api_kode' => 2001, 'api_subkode' => 2, 'api_search' => array($kd_pgw));
		$pegawai = $this->api->get_api_json(URL_API_SIMPEG.'/simpeg_mix/data_search', 'POST', $parameter);
		$hasil=array('NAMA'=>$pegawai[0]['GELAR_DEPAN'].' '.$pegawai[0]['GELAR_DEPAN_NA'].' '.$pegawai[0]['NM_PGW'].' '.$pegawai[0]['GELAR_BELAKANG'],'NIP'=>$pegawai[0]['NIP']);
		echo "<table class='table table-hovered'>";
		echo "<thead>";
		echo "<tr>";
			echo "<td>";
			echo "NIP";
			echo "</td>";
			echo "<td>";
			echo "NAMA";
			echo "</td>";
			echo "<td>";
			echo "#";
			echo "</td>";
		echo "</tr>";
		echo "</thead>";
			echo "<tbody>";
		echo "<tr>";
			echo "<td>";
			echo $hasil['NIP'];
			echo "</td>";
			echo "<td>";
			echo $hasil['NAMA'];
			echo "</td>";
			echo "<td>";
			echo "<button type='button' class='btn btn-inverse btn-small' onclick='pilih_pegawai(this)' id='".$hasil['NIP']."' value='".$hasil['NAMA']."'> Pilih</button>";
			echo "</td>";
		echo "</tr>";
		echo "</tbody>";
		echo "</table>";
	}

	function cari_petugas()
	{
		$kd_pgw=str_replace(" ", "", $this->input->post('nip'));
		$parameter = array('api_kode' => 2001, 'api_subkode' => 2, 'api_search' => array($kd_pgw));
		$pegawai = $this->api->get_api_json(URL_API_SIMPEG.'/simpeg_mix/data_search', 'POST', $parameter);
		if(count($pegawai)>0)
		{	
			$hasil=array('NAMA'=>$pegawai[0]['GELAR_DEPAN'].' '.$pegawai[0]['GELAR_DEPAN_NA'].' '.$pegawai[0]['NM_PGW'].' '.$pegawai[0]['GELAR_BELAKANG'],'NIP'=>$pegawai[0]['KD_PGW']);
				
				$info="NIP ATAS NAMA : ".$hasil['NAMA'];
				$pesan = "<div id='msg' class='bs-callout bs-callout-success'>".$info."</div>";
				$pesan .= "<div id='msg' class='bs-callout bs-callout-info'>CENTANG PROGRAM STUDI YANG DIIJINKAN<input type='hidden' id='hasil' value='1'></div>";
				
				echo $pesan;
		}
		else
		{
				$info="NIP TIDAK DITEMUKAN";
				$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
				echo $pesan;
		}
	}

	function update_header()
	{
		$data['id_header']=$this->input->post('id_header');
		$data['tahun']=$this->input->post('tahun');
		$data['unit']=$this->input->post('unit');
		$kirim=array('HEADER'=>$data);
		
		$hasil=$this->webserv->yudisium('yudisium/update_header',$kirim);
		if($hasil)
		{
			echo "Berhasil.";
		}
		else
		{
			echo "Gagal.";
		}
		
	}

	function view_sub_tes()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['id_tes']=$this->input->post('id_tes');
		$kirim=array('CARI_SUB'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/nilai_sub_tes',$kirim);
		if(!is_null($hasil))
		{
			echo "<table >";
                  echo "<tr>";
                  echo "<td>";
                  echo "<B>SUB TES</B>";
                  echo "</td>";
                  echo "<td>";
                  echo "<B>NILAI</B>";
                  echo "</td>";
                  echo "</tr>"; 
               
			foreach ($hasil as $tes) 
			{
					echo "<tr>";
                    echo "<td>";
                    echo $tes->nama_sub;
                    echo "</td>";
                    echo "<td>";
                    echo $tes->nilai;
                    echo "</td>";
                     echo "</tr>";
			}
			
                echo "</tr>";
                echo "</table>";
		}
	}

	function update_nomor_doc()
	{
		$data['id_dokumen']=$this->input->post('id_dokumen');
		$data['nomor']=$this->input->post('nomor');

		$kirim=array('DOC'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/update_nomor_doc',$kirim);
		if($hasil)
		{
			echo "1";
		}
		else
		{
			echo "Dokumen gagal diupdate.";
		}
	}

	function cari_setting_dokumen()
	{
		
		$data['id_dokumen']=$this->input->post('id_dokumen');
		$data['nomor']=$this->input->post('nomor');
		$kirim=array("DOC"=>$data);
		$hasil['data_dokumen']=$this->webserv->yudisium("yudisium/cari_setting_dokumen",$kirim);
		$hasil['logo_doc']=$this->webserv->yudisium("yudisium/cari_logo_dokumen",$kirim);
		if($hasil)
		{
			$this->load->view("v_table/tabel_setting_dokumen",$hasil);
		}
		else
		{
			echo "GAGAL";
		}
		
	}

	function request_grade_prodi()
	{
		$data['data_prodi'] = $this->webserv->yudisium('yudisium/prodi',array());
		$this->load->view('v_table/tabel_grade_prodi',$data);
	}

function delete_config()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['id_jenis']=$this->input->post('id_jenis');
		$data['key']=$this->input->post('key');
		$kirim=array('CONF'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/delete_conf',$kirim);
		if($hasil)
		{
			$this->load_config();

		}
	
	}

	function update_config()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$jalur=substr($data['kode_penawaran'], 0,2);
		$data['id_jenis']=$this->input->post('id_jenis');
		$data['key']=$this->input->post('key');
		$data['val']=$this->input->post('val');
		$data['id_prodi']=$this->input->post('id_prodi');
		
		$kirim=array('CONF'=>$data);
		$fungsi="";
		switch ($jalur) {
			case '14':
				$fungsi="simpan_grade_snmptn";
				break;
			case '15':
				$fungsi="simpan_grade_spanptkin";
				break;
			default:
				$fungsi="simpan_grade_prodi";
				break;
		}
		if($data['id_jenis']=='1')
		{
			$prodi=$this->webserv->yudisium('yudisium/'.$fungsi,$kirim);
		}
		$hasil=$this->webserv->yudisium('yudisium/simpan_conf',$kirim);
		if($hasil)
		{
			$this->load_config();

		}
	
	}



	function cari_nomor()
	{
		$data['id_dokumen']=$this->input->post('id_dokumen');
		$kirim=array('NOMOR'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/cari_nomor',$kirim);
		if(!is_null($hasil))
		{
			echo '<select name="nomor" id="nomor" class="form-control input-md">';
			foreach ($hasil as $no) {
				echo "<option value='".$no->nomor."'>".$no->nomor." ".$no->keterangan."</option>";
			}
			echo "</select>";
		}
		else
		{
			print_r($kirim);
		}
	}

	function rekap_diterima_prodi()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		//$data['id_kelas']=$this->input->post('id_kelas');
		$kirim=array('YUDISIUM'=>$data);
		$hasil['fakultas']=$this->webserv->yudisium('yudisium/fakultas',$kirim);
		$hasil['terima']=$this->webserv->yudisium('yudisium/rekap_yudisium_prodi',$kirim);
		$hasil['terima_kelas']=$this->webserv->yudisium('yudisium/rekap_yudisium_prodi_kelas',$kirim);
		if($hasil)
		{
			$this->load->view('v_table/tabel_rekap_yudisium_prodi',$hasil);
		}
	}

	function rekap_nilai_yudisium()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array('YUDISIUM'=>$data);
		$hasil['rekap_nilai']=$this->webserv->yudisium('yudisium/rekap_nilai_yudisium',$kirim);
		if($hasil)
		{
			$this->load->view('v_table/tabel_rekap_nilai_yudisium',$hasil);
		}
	}

	function cari_mahasiswa()
	{
		$data['nomor']=$this->input->post('nomor');
		$kirim=array('MHS'=>$data);
		$hasil['mhs']=$this->webserv->yudisium('yudisium/cari_mahasiswa_diterima',$kirim);
		$hasil['prodi']=$this->webserv->yudisium('yudisium/cari_prodi_pilihan',$kirim);
		if($hasil)
		{
			$this->load->view('v_table/data_mahasiswa',$hasil);
			
		}
	}

	function simpan_yudisium()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['id_kelas']=$this->input->post('id_kelas');
		$data['pilihan']=$this->input->post('pilihan');
		$kirim=array('OKE'=>$data);
		
		$hasil=$this->webserv->yudisium('yudisium/simpan_yudisium_lain',$kirim);
		if($hasil)
		{
			$hasil2=$this->webserv->yudisium('yudisium/simpan_data_yudisium',$kirim);
			if($hasil2)
			{
				echo "<div id='msg' class='bs-callout bs-callout-success'>Data Yudisium Berhasil Disimpan</div>";
			}
			else
			{
				echo "<div id='msg' class='bs-callout bs-callout-error'>Data Yudisium Gagal Disimpan</div>";
			}
			
		}
		else
		{
			echo "<div id='msg' class='bs-callout bs-callout-error'>Data Diri Gagal Disimpan</div>";
		}
		

	}

	function import_xl()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Import Hasil Data Excel', ' ');
		$data['jalur_masuk'] = $this->webserv->yudisium('yudisium/jalur',array());
		$data['content']="form_import_excel";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function import_data_excel()
    {
        $file_excel =$_FILES['file']['tmp_name'];
        $objPHPExcel = PHPExcel_IOFactory::load($file_excel);
        $data=array();
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        //extract to a PHP readable array format
        foreach ($cell_collection as $cell) 
        {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
            $jika_date = $objPHPExcel->getActiveSheet()->getCell($cell);
            if ($row == 1) //headernya gk usah
            {
        
                $header[$row][$column] = $data_value;//header disini
            }
            else
            {
                //$arr_data[$row][$column] = $data_value;
					if(PHPExcel_Shared_Date::isDateTime($jika_date)) {//JIKA FORMAT CELL DATE
						$data_value = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($data_value)); 
					}
                array_push($data, $data_value);
            }
        }
        //send the data in an array format
        //$data['header'] = $header;
        $success=0;
        $eror=0;
        $st=0;
    if(count($data)>0)
    {
        $kirim=array_chunk($data, 11);
        foreach ($kirim as $k) {
        	$datax['nomor']=$k[0];
        	$datax['nama']=$k[1];
        	$datax['jk']=$k[2];
        	$datax['kode_jalur']=$k[3];
        	$datax['gelombang']=$k[4];
        	$datax['tahun']=$k[5];
        	$datax['tgl']=$k[6];
        	$datax['sekolah']=$k[7];
        	$datax['urut']=$k[8];
        	$datax['kode_prodi']=$k[9];
        	if($k[10]>1)
        	{
        		$st='1';
        	}
        	else
        	{
        		$st=$k[10];
        	}
        	$datax['status']=$st;
        $okey=array('IMPORT'=>$datax);
       
        $hasil=$this->webserv->yudisium('yudisium/import_form_excel',$okey);
            if($hasil)
            {
                $success+=1;
            }
            else
            {
                $eror+=1;
            }
          
            
        }
        $div1="<div class='bs-callout bs-callout-success'>";
        $div2="</div>";
        $info="Jumlah data tersimpan: ".$success.". Jumlah Gagal : ".$eror;
    }
    else
    {
    	$div1="<div class='bs-callout bs-callout-error'>";
        $div2="</div>";
        $info="Jumlah data tersimpan: ".$success.". Jumlah Gagal : ".$eror;
    }
        
        $this->session->set_flashdata('message', $div1.$info.$div2);
        redirect(base_url('yudisium/yudisium_c/import_xl'));
        
    }

	function download_excel($jalur,$gel,$tahun)
    {
      
        $objPHPExcel = new PHPExcel();
 
            //set Sheet yang akan diolah 
            $objPHPExcel->setActiveSheetIndex(0)
                    //mengisikan value pada tiap-tiap cell, A1 itu alamat cellnya 
                    //Hello merupakan isinya
                                        ->setCellValue('A1', 'NOMOR PMB')
                                        ->setCellValue('B1', 'NAMA LENGKAP')
                                        ->setCellValue('C1', 'JENIS KELAMIN (L/P)')
                                        ->setCellValue('D1', 'KODE JALUR')
                                        ->setCellValue('E1', 'GELOMBANG')
                                        ->setCellValue('F1', 'TAHUN')
                                        ->setCellValue('G1', 'TANGGAL LAHIR (YYYY-MM-DD)')
                                        ->setCellValue('H1', 'NAMA SEKOLAH')
                                        ->setCellValue('I1', 'PILIHAN PRODI')
                                        ->setCellValue('J1', 'KODE PRODI')
                                        ->setCellValue('K1', 'STATUS (TERIMA=1 TIDAK=0)')
                                        ->setCellValue('D2', $jalur)
                                        ->setCellValue('E2', $gel)
                                        ->setCellValue('F2', $tahun);
                                        
            //set title pada sheet (me rename nama sheet)
            $objPHPExcel->getActiveSheet()->setTitle('FormatUploadDataYudisium');
 
            //mulai menyimpan excel format xlsx, kalau ingin xls ganti Excel2007 menjadi Excel5          
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
            //sesuaikan headernya 
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            //ubah nama file saat diunduh
            header('Content-Disposition: attachment;filename="FORMAT_UPLOAD_DATA_YUDISIUM'.Date('d-m-Y').'.xlsx"');
            //unduh file
            $objWriter->save("php://output");
        
    }

	function input_hasil_lain()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Import Hasil Yudisium Lain', ' ');
		$data['jalur_masuk'] = $this->webserv->yudisium('yudisium/jalur',array());
		$data['content']="form_hasil_lain";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function import_nilai()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		$kirim=array('IMPORT'=>$data);
		$hasil1=$this->webserv->yudisium('yudisium/import_data_diri',$kirim);
		if($hasil1)
		{
			$hasil2=$this->webserv->yudisium('yudisium/yudisiumkan_perjalur',$kirim);
			if($hasil2)
			{
				
				$hasil3=$this->webserv->yudisium('yudisium/import_nilai',$kirim);
				if($hasil3)
				{
					echo "<div id='msg' class='bs-callout bs-callout-success'>IMPORT BERHASIL</div>";
				}
				else
				{
					echo "<div id='msg' class='bs-callout bs-callout-error'>GAGAL IMPORT NILAI</div>";
			
				}
				
			}
			else
			{
				echo "<div id='msg' class='bs-callout bs-callout-error'>GAGAL IMPORT DATA YUDISIUM</div>";
			
			}
		}
		else
		{
			echo "<div id='msg' class='bs-callout bs-callout-error'>GAGAL IMPORT DATA DIRI</div>";
			
		}

	}

	function import_tes_cbt()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Import Nilai Tes CBT', ' ');
		$data['jalur_masuk'] = $this->webserv->yudisium('yudisium/jalur',array());
		$data['content']="import_nilai_cbt";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	
	}

	function rekap_nilai()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Rekap Nilai Yudisium', ' ');
		$data['jalur_masuk'] = $this->webserv->yudisium('yudisium/jalur',array());
		$data['content']="form_rekap_nilai";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	
	}

	function diterima_yudisium()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Rekap Diterima Yudisium', ' ');
		$data['jalur_masuk'] = $this->webserv->yudisium('yudisium/jalur',array());
		$data['jenis_dokumen'] = $this->webserv->yudisium('yudisium/jenis_dokumen',array());
		$data['content']="form_diterima_yudisium";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function setting_admin_yudisium()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Setting Admin Yudisium', ' ');
		$data['jalur_masuk'] = $this->webserv->yudisium('yudisium/jalur',array());
		$data['content']="form_config_admin";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function setting_prodi()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Setting Program Studi', ' ');
		$data['data_prodi'] = $this->webserv->yudisium('yudisium/data_prodi',array());
		$data['content']="form_setting_prodi";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function setting_prodi_yudisium()
	{
		$data['snmptn']=$this->input->post('snmptn');
		$data['span']=$this->input->post('span');
		$data['prodi']=$this->input->post('prodi');
		$kirim=array('PRODI'=>$data);
		
		$hasil=$this->webserv->yudisium('yudisium/setting_prodi',$kirim);
		if($hasil)
		{
			echo "Berhasil.";
		}
		else
		{
			echo "Gagal.";
		}

		
	}

	function setting_dokumen_yudisium()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Setting Dokumen Yudisium', ' ');
		$data['jenis_dokumen'] = $this->webserv->yudisium('yudisium/jenis_dokumen',array());
		$data['content']="form_setting_dokumen";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function prodi_yudisium()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['kelas']=$this->input->post('kelas');
		$data['nip']=str_replace(" ", "", $this->input->post('nip'));
		$kirim=array('PRODI'=>$data);
		$fungsi="";
		switch ($data['kode_jalur']) {
			case '14':
				$fungsi="prodi_snmptn";
				break;
			case '15':
				$fungsi="prodi_spanptkin";
				break;
			default:
				$fungsi="prodi_mandiri";
				$kirim=array('PRODI'=>$data);
				break;
		}
		$prodi=$this->webserv->yudisium('yudisium/petugas_yudisium',$kirim);
		$hasil=$this->webserv->yudisium('yudisium/'.$fungsi,$kirim);
		if(!is_null($hasil))
		{
			
			foreach ($hasil as $h) {
				switch ($data['kode_jalur']) {
				case '14':
				echo "<input type='checkbox' ";

				if(!is_null($prodi)){
					foreach ($prodi as $p) {
						
						if($p->kode_program_studi==$h->kode_program_studi)
						{
							echo " checked ";
						}
						
					}
				}
				echo " onchange='tambah_akses(this)' id='".$h->kode_program_studi."' value='".$h->kode_fakultas."'> ".$h->program_studi."</br>";
			
				break;
				case '15':
				echo "<input type='checkbox' ";
				
				if(!is_null($prodi)){
					foreach ($prodi as $p) {

						if($p->kode_program_studi==$h->kode_program_studi)
						{
							echo " checked ";
						}
						
					}
				}
				echo "onchange='tambah_akses(this)' id='".$h->kode_program_studi."' value='".$h->kode_fakultas."'> ".$h->program_studi."</br>";
					
				break;
				default:

				echo "<input type='checkbox' ";
				if(!is_null($prodi)){
					foreach ($prodi as $p) {

						
						if($p->kode_program_studi==$h->id_prodi)
						{
							echo " checked ";
						}
						}
				}
				echo " onchange='tambah_akses(this)' id='".$h->id_prodi."' value='".$h->id_fakultas."'> ".$h->nama_prodi."</br>";
					
					
				break;
			}
		}
			
		}

	}

	function simpan_admin()
	{
		$data['nip']=$this->input->post('NIP');
		$data['prodi']=$this->input->post('prodi');
		$data['fakultas']=$this->input->post('fakultas');
		$data['jalur']=$this->input->post('jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['kelas']=$this->input->post('kelas');
		$kirim=array('ADMIN'=>$data);
		
		$hasil=$this->webserv->yudisium('yudisium/simpan_admin',$kirim);
		if($hasil)
		{
			echo "Berhasil";
		}
		else
		{
			echo "Gagal";
		}
		
	}

	function delete_admin()
	{
		$data['nip']=$this->input->post('NIP');
		$data['prodi']=$this->input->post('prodi');
		$data['fakultas']=$this->input->post('fakultas');
		$kirim=array('ADMIN'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/delete_admin',$kirim);
		if($hasil)
		{
			echo "Berhasil";
		}
		else
		{
			echo "Gagal";
		}
	}

	function prodi_jalur()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$jalur=substr($data['kode_penawaran'], 0,2);
		$kirim=array('DETAIL_PRODI'=>$data);
		$hasil=$this->webserv->admisi('yudisium/yudisium_prodi',$kirim);
		
		if($hasil)
		{
			foreach ($hasil as $p) 
			{
				$isi="";
				switch ($jalur) {
					case '14':
						$isi=$p->prodi_snmptn;
						break;
					case '15':
						$isi=$p->prodi_span_ptkin;
						break;
					
					default:
						$isi=$p->id_prodi;
						break;
				}
				echo "<input type='hidden' name='id_prodi[]' value='".$isi."'>";	
						
			}				
			
		}


	}

	function update_grade_prodi()
	{
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['val']=$this->input->post('val');
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array('CONF'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/update_grade_prodi',$kirim);
		if($hasil)
		{
			echo "Berhasil.";
		}
		
	}

	function simpan_conf()
	{
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		if($data['kode_jalur']=='14' || $data['kode_jalur']=='15')//snmptn & spanptkin
		{
			$data['gelombang']='1';
		};
		
		$data['tahun']=$this->input->post('tahun');
		$data['id_jenis']=$this->input->post('jenis');
		$data['key']=$this->input->post('keys');
		
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		if($data['id_jenis']=='4')//tanggal yudisium
		{
			$data['tanggal_mulai']=$this->input->post('tanggal_mulai')." ".$this->input->post('jam_mulai').":00";
		$data['tanggal_selesai']=$this->input->post('tanggal_selesai')." ".$this->input->post('jam_selesai').":00";
		
			$data['val']=$data['tanggal_mulai'].'#'.$data['tanggal_selesai'];
		}
		else
		{
			$data['val']=$this->input->post('valu');
		}
		$kirim=array('CONF'=>$data);
		if($data['id_jenis']=='1')//prodi
		{
			$fungsi="";
			switch ($data['kode_jalur']) {
				case '14':
					$fungsi="simpan_grade_prodi_snmptn";
					break;
				case '15':
					$fungsi="simpan_grade_prodi_spanptkin";
					break;
				default:
					$fungsi="simpan_grade_prodi";
					break;
			}
			$prodi=$this->webserv->yudisium('yudisium/'.$fungsi,$kirim);
		}
		$hasil=$this->webserv->yudisium('yudisium/simpan_conf',$kirim);
		if($hasil)
		{
			$this->load_config();
		}
		else
		{
			echo "gagal";
		}
		
	}
	
	function load_config()
	{
		$data['jalur_masuk'] = $this->webserv->yudisium('yudisium/jalur',array());
		$data['data_config'] = $this->webserv->yudisium('yudisium/conf_yudisium',array());
		$data['jenis_config'] = $this->webserv->yudisium('yudisium/jenis_conf',array());
		$data['key_config'] = $this->webserv->yudisium('yudisium/key_conf',array());
		
		$data['data_config'] = $this->webserv->yudisium('yudisium/conf_yudisium',array());
		$this->load->view('v_table/tabel_configurasi',$data);
	}

	function setting_config_yudisium()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Configurai Yudisium', ' ');
		$data['jalur_masuk'] = $this->webserv->yudisium('yudisium/jalur',array());
		$data['data_config'] = $this->webserv->yudisium('yudisium/conf_yudisium',array());
		$data['jenis_config'] = $this->webserv->yudisium('yudisium/jenis_conf',array());
		$data['key_config'] = $this->webserv->yudisium('yudisium/key_conf',array());
		$data['data_prodi'] = $this->webserv->yudisium('yudisium/prodi',array());
		$data['content']="form_config_yudisium";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');	
	}

	function hasil_yudisium()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Hasil Yudisium', ' ');
		$data['jalur_masuk'] = $this->webserv->yudisium('yudisium/jalur',array());
		$data['jenis_dokumen'] = $this->webserv->yudisium('yudisium/jenis_dokumen',array());
		$data['content']="form_rekap_yudisium";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');	
	}

	function jumlah_penawaran_prodi()
	{
		$data['kode_penawaran']=substr($this->input->post('kode_penawaran'), 0,3);
		$data['tahun']=$this->input->post('tahun');

		$kirim=array("CEK_MINAT"=>$data);
		$hasil=$this->webserv->admisi('input_data/jumlah_penawaran_prodi',$kirim);
		if($hasil)
		{
			if(!is_null($hasil))
			{
				foreach ($hasil as $jml);
				echo $jml->jumlah_penawaran;
			}
			else
			{
				echo 0;
			}
			
		}	
		
	}


	function nilai_ujian_pmb()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Yudisium', ' ');
		$data['jalur_masuk']=$this->webserv->yudisium('yudisium/jalur',array());
		$data['data_tes']= $this->webserv->yudisium('input_data/nama_tes',array());
		
		$data['content']="form_nilai_ujian";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

function setting_grade_yudisium()
	{
		$data['jalur_masuk']=$this->webserv->yudisium('yudisium/jalur',array());
		$data['data_tes']= $this->webserv->yudisium('input_data/nama_tes',array());
		$data['content']="form_setting_grade";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');		
	}

function setting_tes()
{
		$data['data_tes']= $this->webserv->yudisium('yudisium/tes_yudisium',array());
		$data['content']="form_master_tes";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');	
}

function hapus_tes()
	{
		$data['kode']=$this->input->post('id_tes');
		$kirim=array('TES'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/hapus_tes',$kirim);
		if($hasil)
		{
			$d['data_tes']=$this->webserv->yudisium('yudisium/tes_yudisium',array());
			$this->load->view('v_table/tabel_master_tes',$d);
		}
		else
		{
			echo "GAGAL";
		}
	}

function simpan_tes()
	{
		$data['kode']=$this->input->post('kode');
		$data['nama']=$this->input->post('nama');
		$kirim=array('TES'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/simpan_tes',$kirim);
		if($hasil)
		{
			$d['data_tes']=$this->webserv->yudisium('yudisium/tes_yudisium',array());
			$this->load->view('v_table/tabel_master_tes',$d);
		}
		else
		{
			echo "GAGAL";
		}
	}

function setting_yudisium()
	{	
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Setting Yudisium', ' ');
		$data['jalur_masuk']=$this->webserv->yudisium('input_data/data_penawaran_jalur_cek',array());
		$data['data_tes']= $this->webserv->yudisium('yudisium/tes_yudisium',array());
		$data['content']="form_tambah_item_bobot";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');	
	}
function update_grade()
{
	$data['kode_jalur']=$this->input->post('kode_jalur');
	$data['gelombang']=$this->input->post('gelombang');
	$data['tahun']=$this->input->post('tahun');
	$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
	$data['nilai']=$this->input->post('grade');
	$kirim=array("GRADE"=>$data);
	$hasil=$this->webserv->yudisium('yudisium/update_grade',$kirim);
	if($hasil)
	{
		echo "Berhasil.";
	}
	else{
		echo "Grade gagal diupdate!";
	}
}



function cari_grade()
{
	$data['kode_jalur']=$this->input->post('kode_jalur');
	$data['gelombang']=$this->input->post('gelombang');
	$data['tahun']=$this->input->post('tahun');
	$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
	$kirim=array("GRADE"=>$data);
	$hasil=$this->webserv->yudisium('yudisium/cari_grade',$kirim);
	if(!is_null($hasil))
	{
		foreach ($hasil as $has);
		echo $has->nilai_grade;
	}
	else
	{
		echo "0";
	}

}


function cari_usia()
{
	$data['kode_jalur']=$this->input->post('kode_jalur');
	$data['gelombang']=$this->input->post('gelombang');
	$data['tahun']=$this->input->post('tahun');
	$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
	$kirim=array("USIA"=>$data);
	$hasil=$this->webserv->yudisium('yudisium/cari_usia',$kirim);
	if(!is_null($hasil))
	{
		foreach ($hasil as $has);
		echo "<input type='hidden' id='usia2' value='".$has->usia."'>";
		echo "<input type='hidden' id='tgl2' value='".$has->tanggal."'>";
	}
	else
	{
		echo "0";
	}

}


function cari_data_yudisium()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['tahun']=$this->input->post('tahun');
		$kirim=array('YUDISIUM'=>$data);
		$kelas=array('KELAS'=>$data);
		$hasil['data_mhs']=$this->webserv->yudisium('yudisium/cari_data_yudisium',$kirim);
		if($hasil)
		{
			$hasil['data_lengkap_mhs']=$this->webserv->yudisium('yudisium/data_mhs',$kirim);
			$hasil['data_kelas']=$this->webserv->yudisium('yudisium/penawaran_kelas',$kelas);
			$this->load->view('v_table/daftar_hasil_yudisium',$hasil);
		}
		
	}

	function cari_kelas_fokus()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$insert_data=array('CARI_KELAS'=>$data);
		$kirim=array('PUTARAN'=>$data);
		$fokus=$this->webserv->yudisium('yudisium/data_putaran',$kirim);
		$hasil=$this->webserv->yudisium('input_data/kelas',$insert_data);
		if($hasil)
		{
			if(!is_null($fokus))
			{
				foreach ($fokus as $kls);
			}

			echo "<select name='kelas' id='k' class='form-control input-md' onchange='ambil_data(this.value)'>";
			echo "<option value=''>Kelas</option>";
			foreach ($hasil as $kelas) {
				echo "<option "; 
			if(!is_null($fokus))
			{
				if($kelas->id_kelas==$kls->id_kelas)
				{
					echo " selected ";
				}
			}
				echo " value='".$kelas->id_kelas."'>".$kelas->nama_kelas."</option>";
			}
			echo "</select>";
			
		}
	}

	function cari_putaran2()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['id_kelas']=$this->input->post('id_kelas');
		$kirim=array('PUTARAN'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/data_putaran2',$kirim);
		if($hasil)
		{
			if(!is_null($hasil))
			{
				foreach ($hasil as $ptr);
				echo $ptr->pilihan;	
			}
		}
	}

	function cari_putaran3()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['id_kelas']=$this->input->post('id_kelas');
		$kirim=array('PUTARAN'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/jumlah_putaran',$kirim);
		$fokus=$this->webserv->yudisium('yudisium/data_putaran2',$kirim);
		if($hasil)
		{
			if(!is_null($hasil))
			{
				
				foreach ($hasil as $ptr);

					echo "<select class='form-control input-md' name='putaran' id='putaran'>";
					echo "<option value=''> Putaran </option>";
					for ($i=1; $i <= $ptr->jumlah_penawaran; $i++) { 
					
					echo "<option ";
					if(!is_null($fokus))
					{
						foreach ($fokus as $p);
							if($i==$p->pilihan)
							{
								echo " selected ";
							}
						
					}
					echo " value='".$i."'> ".$i." </option>";
					
					}
					
					echo "</select>";
			
		
			}
		}
	}


	function cari_putaran()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array('PUTARAN'=>$data);
		$fokus=$this->webserv->yudisium('yudisium/data_putaran',$kirim);
		$hasil=$this->webserv->yudisium('yudisium/jumlah_putaran',$kirim);
		if($hasil)
		{
			if(!is_null($hasil))
			{
				foreach ($hasil as $ptr);

					echo "<select class='form-control input-md' name='putaran' id='putaran'>";
					echo "<option value=''> Putaran </option>";
					for ($i=1; $i <= $ptr->jumlah_penawaran; $i++) { 
					
					echo "<option ";
					if(!is_null($fokus))
					{
						foreach ($fokus as $p);
						if($i==$p->pilihan)
						{
							echo " selected ";
						}
					}
					echo " value='".$i."'> ".$i." </option>";
					
					}
					
					echo "</select>";
				
			}
			else
			{
				echo "0";
			}
		}
		else
		{
				echo "0";
		}
	}

	function setting_putaran()
	{
		if(array_sum($this->input->post('bobotx'))=='100')
		{
			$data['pilihan']=$this->input->post('putaran');
			$data['kode_penawaran']=$this->input->post('kode_penawaran');
			$data['id_kelas']=$this->input->post('kelas');
			$kirim=array('PUTARAN'=>$data);
			$hasil=$this->webserv->yudisium('yudisium/simpan_setting_putaran',$kirim);
			if($hasil)
			{
				echo "Berhasil";
			}
			else
			{
				echo "gagal";
			}
		}
		else
		{
			echo "Bobot tidak valid.";
		}
		
	}

	function cari_pembobotan()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array('PUTARAN'=>$data);
	
		$hasil['pembobotan']=$this->webserv->yudisium('yudisium/data_pembobotan',$kirim);
		if($hasil)	
		{
			$this->load->view('form_pembobotan',$hasil);
		}

	}

	function tambah_item_bobot()
	{
		
			
			$data['nama_pembobotan']=array_filter($this->input->post('nama'));
			$data['bobot']=array_filter($this->input->post('bobot'));
			$data['kode']=array_filter($this->input->post('kode'));
			$data['status']=array_filter($this->input->post('status'));
			$data['kode_penawaran']=array_filter($this->input->post('kode_penawaran'));
			$kirim=array('BOBOT'=>$data);
			
			$hasil=$this->webserv->yudisium('yudisium/simpan_bobot',$kirim);
			if($hasil)
			{
			echo "Berhasil";
			
			}
			else
			{
			echo "gagal";
			};

	}

	function setting_usia_yudisium()
	{
		$data['jalur_masuk']=$this->webserv->yudisium('yudisium/jalur',array());
		$data['content']="form_setting_usia";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');	
	}

	function simpan_hasil_yudisium()
	{
		
				
				$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
				$data['nomor_pendaftartes']=$this->input->post('nomor_pendaftartes');
				$data['jenis_tes']=$this->input->post('jenis_tes');
				$data['nilai_tes']=$this->input->post('nilai_tes');
				$data['kode_penawaran']=$this->input->post('kode_penawaran');
				$data['id_kelas']=$this->input->post('kelas');
				$data['id_prodi']=$this->input->post('prodi');
				$data['pilihan']=$this->input->post('pilih');
				$data['id_jenjang']=$this->input->post('jenjang');
				$data['tahun']=$this->input->post('tahun');
				$data['gelombang']=$this->input->post('gelombang');
				$data['kode_jalur']=$this->input->post('kode_jalur');
					$kirim=array("YUDISIUM"=>$data);
					
					$hasil=$this->webserv->yudisium('yudisium/simpan_hasil_yudisium',$kirim);
					if($hasil)
					{
					echo "Berhasil";
					}
					else
					{
					echo "gagal";
					}
		
	}

	function batal_yudisium()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('YUDISIUM'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/batal_yudisium',$kirim);
		if($hasil)
		{
			echo "Pembatalan Berhasil.";
		}
		else
		{
			echo "Pembatalan gagal.";
		}
	}

	function yudisiumkan()
	{
		$kode_jalur=$this->input->post('kode_jalur');
		$fungsi="";
		switch ($kode_jalur) {
			case '14':
				$fungsi="terima_snmptn";
				break;
			case '15':
				$fungsi="terima_spanptkin";
				break;
			
			default:
				$fungsi="terima_mhs";
				break;
		}

		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['id_kelas']=$this->input->post('id_kelas');
		$data['urut']=$this->input->post('urut');
		$kirim=array('TERIMA'=>$data);
		
		$hasil=$this->webserv->yudisium('yudisium/'.$fungsi,$kirim);
		if($hasil)
		{
			echo " Mahasiswa Berhasil diterima.";
		}
		else
		{
			echo "Gagal menerima Mahasiswa.";
		}
		
	}

	function prodi_kelas()
	{
		$data['nip']=$this->input->post('nip');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['kelas']=$this->input->post('kelas');
		$kirim=array('DETAIL_PRODI'=>$data);
		$hasil=$this->webserv->admisi('yudisium/yudisium_prodi',$kirim);
		
		if($hasil)
		{
			
			echo "<select name='prodi' id='prodi' style='width:200px;' class='form-control input-sm' onchange='id_prodi=this.value'>";
			echo "<option value=''> Pilih Prodi </option>";	
				foreach ($hasil as $p) {
					echo "<option value='".$p->kode_program_studi."'>".$p->nama_prodi."</option>";	
						
								}				
			echo "</select>";

		}



	}

	function yudisiumkan_semua()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$fungsi="";

		switch ($data['kode_jalur']) {
			case '14':
				$fungsi="terima_semua_snmptn";
				break;
			case '15':
				$fungsi="terima_semua_span";
				break;
			
			default:
				$fungsi="terima_semua_mhs";
				break;
		}
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['id_kelas']=$this->input->post('id_kelas');
		$data['urut']=$this->input->post('urut');
		$data['bobot']=$this->input->post('bobot');
		$kirim=array('TERIMA'=>$data);
		
		$hasil=$this->webserv->yudisium('yudisium/'.$fungsi,$kirim);
		if($hasil)
		{
			echo " Mahasiswa Berhasil diterima.";
		}
		else
		{
			echo "Gagal menerima Mahasiswa.";
		}
		
	}

function batal_yudisiumkan()
	{

		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$fungsi="";

		switch ($data['kode_jalur']) {
			case '14':
				$fungsi="batalkan_snmptn";
				break;
			case '15':
				$fungsi="batalkan_span";
				break;
			
			default:
				$fungsi="batal_terima_mhs";
				break;
		}
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['id_kelas']=$this->input->post('id_kelas');
		$data['urut']=$this->input->post('urut');
		$kirim=array('BATAL_TERIMA'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/'.$fungsi,$kirim);
		if($hasil)
		{
			echo "Mahasiswa dibatalkan.";
		}
		else
		{
			echo "Gagal membatalkan Mahasiswa.";
		}
	}

	function format_tgl($tgl)
	{
		$tanggal=new DateTime(str_replace("/", "-", $tgl));
		$dt=date_format($tanggal,'Y-m-d H:i:s');
		return $dt;
	}

	function cek_tanggal_yudisium($kode_penawaran)
	{
		$data['kode_penawaran']=$kode_penawaran;
		$kirim=array('TGL'=>$data);
		$hasil=$this->webserv->yudisium('yudisium/tgl_yudisium',$kirim);
		if(!is_null($hasil))
		{
			foreach ($hasil as $sarat);
			$tgl_yudisium=explode('#', $sarat->tgl);

				if(count($tgl_yudisium)>1)
				{
					$tgl_mulai=$this->format_tgl($tgl_yudisium[0]);
					$tgl_selesai=$this->format_tgl($tgl_yudisium[1]);
					if(Date('Y-m-d H:i:s') >= $tgl_mulai && Date('Y-m-d H:i:s') <= $tgl_selesai)
					{
						return 1;
					}
					else
					{
						return 0;
					}

				}
				else
				{
					return 0;
				}
				
		}
		else
		{
			return 0;
		}


	}

	function cari_nilai_pmb()
	{
		$kode_jalur=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['id_kelas']=$this->input->post('kelas');
		$data['id_prodi']=$this->input->post('prodi');
		$data['pilihan']=$this->input->post('pilihan');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$this->input->post('kode_jalur').$data['gelombang'];//kode jalur+gelombang
		$data['kode_jalur']=$kode_jalur;
		$data['urutan_prodi']=$this->input->post('pilihan');
		$data['penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		//print_r($this->cek_tanggal_yudisium('1212016'));die();
		//kode_jalur=12&pilihan=1&gelombang=1&tahun=2016&kode_jadwal=&kelas=9&prodi=35
		if($this->cek_tanggal_yudisium($data['penawaran'])=='1')
		{
			//print_r($_POST);
			$kirim=array('CARI_MHS'=>$data);
			$hasil['nilai_tes']=$this->webserv->yudisium('yudisium/nilai_tes_yudisium',$kirim);
			$hasil['data_mhs']=$this->webserv->yudisium('yudisium/data_mhs_yudisium',$kirim);
			
		
			if($hasil)
			{
				
				$d['kode_penawaran']=$data['kode_penawaran'].$data['tahun']; //jalur+gelombang+tahun
				$d['id_prodi']=$data['id_prodi'];
				$kirim=array("GRADE"=>$d);
				$kir=array('PUTARAN'=>$d);
				$hasil['pembobotan']=$this->webserv->yudisium('yudisium/data_pembobotan',$kir);
				$hasil['pilihan']=$this->input->post('pilihan');
				$hasil['yudis']=$this->webserv->yudisium('yudisium/sarat_yudisium',$kirim);
				$hasil2['grade']=$this->webserv->yudisium('yudisium/grade_prodi',$kirim);

				$prasyarat=array();
				
				if($hasil['yudis'])
				{

					if(!is_null($hasil['yudis']))
					{
						foreach ($hasil['yudis'] as $srt) {
							array_push($prasyarat, $srt);
							
						}
					}
				}
				
		
				$grade=0;
				if(!is_null($hasil2['grade']))
				{
					foreach ($hasil2['grade'] as $gp) {
						$grade=$gp->nilai_grade;
					}
				}
				
				$hasil['tahun']=$this->input->post('tahun');
				$hasil['id_kelas']=$this->input->post('kelas');
				$hasil['id_prodi']=$this->input->post('prodi');
				$hasil['pilihan']=$this->input->post('pilihan');
				$hasil['kode_jalur']=$kode_jalur;
				$hasil['gelombang']=$this->input->post('gelombang');
				$hasil['grade']=$grade;
				$hasil['sarat']=$prasyarat;
				$this->load->view('v_table/tabel_yudisium',$hasil);
			
			}; 
		
		}
		else
		{
				$info="BUKAN MASA YUDISIUM";
				$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."<input type='hidden' id='hasil' value='0'></div>";
				echo $pesan;
		}

		
		
	}

}