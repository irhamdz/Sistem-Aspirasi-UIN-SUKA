<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package		Service Web
 * @subpackage	Rest Server Website IT
 * @author		Daru Prasetyawan
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
//require APPPATH.'/libraries/REST_Controller.php';
require APPPATH.'/libraries/PHPExcel/IOFactory.php';


class Input_data_c extends CI_Controller
{

	function __construct() {
		parent::__construct();
		if($this->session->userdata('username')=='')
		{
			redirect(base_url());
		}

		$this->load->library('webserv');
		$this->load->library('lib_reg_fungsi','','profile');
		$this->load->helper('tanggal_lahir_helper');
		$this->load->helper('ruang_ujian_helper');
		$this->load->library('PHPExcel');
		
	}
	
	function index()
	{
		
	}

	function cari_ruang_ujian()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['tahun']=$this->input->post('tahun');
		$kirim=array('RUANG'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_ruang_ujian',$kirim);
		if($hasil)
		{
			echo '<select name="ruang" id="ruang" style="width:300px;" class="form-control input-md">';
			foreach ($hasil as $r) {
				echo "<option value='".$r->id_ruang."'>".$r->nama_gedung." : ".$r->nama_ruang."</option>";
			}
			echo "</select>";
		}

	}

	function load_jalur()
	{
		$data['jalur'] = $this->webserv->admisi('input_data/jalur',array());
		$this->load->view('v_table/jalur',$data);
	}

	function kab()
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
			
			if ($row == 1) //headernya gk usah
			{
		
				$header[$row][$column] = $data_value;//header disini
			}
			else
			{
				//$arr_data[$row][$column] = $data_value;
				array_push($data, $data_value);
			}
		}
		//send the data in an array format
		//$data['header'] = $header;
		$ok=0;
		$kirim=array_chunk($data, 5);
		foreach ($kirim as $k) {
		
			$d['kode_kab']=$k[0];
			$d['kode_prov']=$k[1];
			//$d['nama']=$k[2];
			//$d['ket']=$k[3];
			//$d['ep']=$k[4];
		$kir=array('KAB'=>$d);
		//$hasil=$this->webserv->admisi('input_data/simpan_kab',$kir);
		//if(!$hasil)
		//{
			//$ok+=1;
		//}
		print_r($kir);
		
		}
		echo "EROR : ".$ok;
	}

	function cek_nomor()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$kirim=array('NO'=>$data);
		$hasil=$this->webserv->admisi('input_data/cek_nomor_peserta',$kirim);
		if($hasil)
		{
			foreach($hasil as $h);
			echo $h->akhir;
		}
	}

	function cari_nomor()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['id_ruang']=$this->input->post('ruang');
		$kirim=array('NO'=>$data);
		$hasil['nomor']=$this->webserv->admisi('input_data/cari_nomor',$kirim);
		if($hasil)
		{
			$this->load->view('v_table/tabel_master_nomor',$hasil);
		}
	}

	function hapus_jalur()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$kirim=array('HAPUS'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_jalur',$kirim);
		if($hasil)
		{
			echo '<div class="bs-callout bs-callout-success"><p>JALUR BERHASIL DI HAPUS</p></div>';
		}
		else
		{
			echo '<div class="bs-callout bs-callout-error"><p>JALUR TIDAK DAPAT DIHAPUS.</p></div>';
		}
		$this->load_jalur();
	}

	function simpan_jalur()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['nama_jalur']=$this->input->post('nama_jalur');
		$data['jenjang']=$this->input->post('jenjang');
		$data['ket']=$this->input->post('keterangan');
		$kirim=array('JALUR'=>$data);
		$hasil=$this->webserv->admisi('input_data/simpan_jalur',$kirim);
		if($hasil)
		{
			$this->load_jalur();
		}
	}

	function verifikasi()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('VERIF'=>$data);
		$hasil=$this->webserv->admisi('input_data/pilih_jadwal',$kirim);
		if($hasil)
		{
			foreach ($hasil as $h);
			$kode_jalur=substr($h->kode_penawaran, 0,2);
			$gelombang=substr($h->kode_penawaran, 2,1);
			$tahun=substr($h->kode_penawaran, 3,4);

		echo base_url('pendaftaran/daftar_mhs_c/verifikasi_manual/'.$kode_jalur.'/'.$gelombang.'/'.$tahun.'/'.$h->kode_jadwal.'/'.$data['nomor_pendaftar'].'');
		
		}
		else
		{
			echo "0";	
		}
	}

	function setting_subtes()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Setting Subtes', ' ');
		$data['data_sub']= $this->webserv->admisi('input_data/data_master_sub_tes',array());
		$data['content']="form_tambah_subtes";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}


	function form_pendaftaran()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Pendaftaran', ' ');	
		$data['content']="form_pendaftaran";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function hapus_sub()
	{
		$data['id_sub']=$this->input->post('id_sub');
		$kirim=array('SUB'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_sub',$kirim);
		if($hasil)
		{
			$da['data_sub']= $this->webserv->admisi('input_data/data_master_sub_tes',array());
		
			$this->load->view('v_table/table_sub',$da);
		}
		else
		{
			$da['data_sub']= $this->webserv->admisi('input_data/data_master_sub_tes',array());
		
			$this->load->view('v_table/table_sub',$da);
		}
	}

	function master_nomor()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Nomor Peserta Ujian', ' ');	
		$data['jalur_masuk']=$this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_master_nomor";	
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function simpan_sub()
	{
		$data['nama_sub']=$this->input->post('nama_sub');
		$kirim=array('SUB'=>$data);
		$hasil=$this->webserv->admisi('input_data/simpan_sub',$kirim);
		if($hasil)
		{
			$da['data_sub']= $this->webserv->admisi('input_data/data_master_sub_tes',array());
		
			$this->load->view('v_table/table_sub',$da);
		}
		else
		{
			echo "Data gagal disimpan";
		}
	}


	function input_nilai()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Input Nilai', ' ');
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		$data['data_tes']= $this->webserv->admisi('input_data/nama_tes',array());
		$data['content']="form_tambah_nilai.php";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function simpan_nilai()
	{
		$this->load->library('PHPExcel');
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
			
			if ($row == 1) //headernya gk usah
			{
		
				$header[$row][$column] = $data_value;//header disini
			}
			else
			{
				//$arr_data[$row][$column] = $data_value;
				array_push($data, $data_value);
			}
		}
		//send the data in an array format
		//$data['header'] = $header;
		
		$kirim=array_chunk($data, 3);//split perbaris
		$da['kode_jalur']=$this->input->post('kode_jalur');
		$da['gelombang']=$this->input->post('gelombang');
		$da['tahun']=$this->input->post('tahun');
		$da['kode_penawaran']=$da['kode_jalur'].$da['gelombang'].$da['tahun'];
		$da['id_tes']=$this->input->post('id_tes');
		$da['id_sub']=$this->input->post('sub_tes');
		$da['bobot']=$this->input->post('bobot');
		$error=0;
		foreach ($kirim as $k) {
			$da['nomor_peserta']=$k[0];
			$da['nilai']=$k[1];//nilai dikalikan bobot per
			$da['kode_soal']=$k[2];
			$kirim=array("NILAI"=>$da);
			$hasil=$this->webserv->admisi('penilaian/simpan_nilai',$kirim);
			if(!$hasil)
			{
				$error+=1;
			}
		}
		$info="DATA TELAH DISIMPAN. JUMALAH EROR: ".$error;
		$this->session->set_flashdata('message', $info);
		redirect(base_url('adminpmb/input_data_c/input_nilai'));
		
	}

	function cari_subtes()
	{
		$data['id_tes']=$this->input->post('id_tes');
		$kirim=array('SUBTES'=>$data);
		$hasil=$this->webserv->admisi('input_data/detail_sub_tes',$kirim);
		if(!is_null($hasil))
		{
			echo '<select name="sub_tes" class="form-control input-md" id="sub_tes" style="width:300px;">';
			foreach ($hasil as $h) {
				echo "<option value='".$h->id_sub."'>".$h->nama_sub."</option>";
			}
			echo "</select>";
		}
	}

	function verifikasikan()
	{
		$data['jalur'] = $this->webserv->admisi('input_data/jalur',array());
		$data['content']="verifikasi_manual.php";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function cari_mahasiswa_lagi()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('CARI'=>$data);
		$hasil['data_mhs']=$this->webserv->admisi('input_data/cari_mhs_pindah',$kirim);
		if($hasil)
		{
			$this->load->view('v_table/tabel_rekap_bermasalah',$hasil);
		}
	}

	function cari_log()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('CARI'=>$data);
		$hasil['mhs']=$this->webserv->admisi('input_data/cari_data_bermasalah',$kirim);
		if($hasil)
		{
			$this->load->view('v_table/log_eror',$hasil);
		}
	}

	function pindah_ruang()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Data Pindah Ruang Ujian', ' ');	
		$data['mhs']=$this->webserv->admisi('input_data/tampil_data_bermasalah',array());
		$data['content']="form_pindah_ruang";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function master_jalur()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Master Jalur', ' ');	

		$data['data_jenjang'] = $this->webserv->admisi('input_data/data_jenjang',array());
		$data['jalur'] = $this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_master_jalur";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}
	
	function generate_kode_ruang($data=array())
	{	
		$id_ruang="";
		$id_gedung="";
		$kode_jalur="";
		$kode_jadwal="";
		
		foreach ($data as $key => $v) {
			
			for ($i=0; $i < count($v); $i++) { 
				$arr=explode("/", $v[$i]);
					$data2['id_ruang']=$arr[0];
					$data2['id_gedung']=$arr[1];
					$data2['kode_jalur']=$arr[2];
					$data2['kode_jadwal']=$arr[3];
			}
			
		}
		
		

	}

	function baca_excel()
	{
		$kode=$this->input->post('kode');
		$array_kode['kode']=array();
		for ($i=0; $i < count($kode); $i++) { 
			array_push($array_kode['kode'], $kode[$i]);
		}
		$kursi=$this->input->post('kursi');
		$array_kursi['kapasitas']=array();
		for ($i=0; $i < count($kursi); $i++) { 
			array_push($array_kursi['kapasitas'], $kursi[$i]);
		}

		$awal=$this->input->post('awal');
		$array_awal['no_awal']=array();
		for ($i=0; $i < count($awal); $i++) { 
			
			array_push($array_awal['no_awal'], $awal[$i]);
		}

		$akhir=$this->input->post('akhir');
		$array_akhir['no_akhir']=array();
		for ($i=0; $i < count($akhir); $i++) { 
			array_push($array_akhir['no_akhir'], $akhir[$i]);
		}

		$data=array_merge($array_kode,$array_kursi,$array_awal,$array_akhir);
		$has=$this->generate_kode_ruang($array_kode);
		print_r($array_kode);
	}

	function buat_format()
	{
		$data['id_gedung']=$this->input->post('id_gedung_UP');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['ruang']=$this->input->post('ruang');
		$data['tahun']=$this->input->post('tahun');
		$data['nama_ruang']=$this->input->post('nama_ruang');
		$data['kode_format']=$data['id_gedung']."/".$data['kode_jalur']."/".$data['kode_jadwal']."/".$data['tahun'];
		$hasil['format']=(json_decode(json_encode($data)));
		
		$this->load->view('v_table/format_excel_ruang',$hasil);
	}

	function cari_ruang()
	{
		$data['id_gedung']=$this->input->post('id_gedung');
		$kirim=array('RUANG'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_ruang',$kirim);
		if(!is_null($hasil))
		{
			foreach ($hasil as $r) {
				echo "<tr>";
				echo "<td>";
				echo "<input type='checkbox' name='ruang[]' id='".$r->id_ruang."' value='".$r->id_ruang."' onchange='pilih_nama(this)'>";
				echo "</td>";
				echo "<td>";
				echo $r->nama_ruang;
				echo "<input type='hidden' name='nama_ruang[]' disabled id='nama".$r->id_ruang."' value='".$r->nama_ruang."'>";
				echo "</td>";
				echo "</tr>";
			}
		}
	}


	function hapus_catatan()
	{
		$data['id_catatan']=$this->input->post('id_catatan');
		$p=$this->input->post('kode_penawaran');
		$kirim=array('HAPUS'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_catatan',$kirim);
		if($hasil)
		{
			$this->lihat_catatan2($p);
		}
		else
		{
			echo "Gagal";
		}
	}

	function update_catatan()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['cat']=$this->input->post('catatan');
		$data['id']=$this->input->post('id_catatan');
		$kirim=array('CT'=>$data);
		
		$hasil=$this->webserv->admisi('input_data/update_catatan',$kirim);
		if($hasil)
		{
			$this->lihat_catatan2($data['kode_penawaran']);
		}
		else
		{
			echo "Gagal";
		}
			
	}

	function simpan_ct_baru()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['cat']=$this->input->post('ct');
		$kirim=array('CT'=>$data);
		
		$hasil=$this->webserv->admisi('input_data/simpan_catatan',$kirim);
		if($hasil)
		{
			$this->lihat_catatan2($data['kode_penawaran']);
		}
		else
		{
			echo "Gagal";
		}
		
	}

	function lihat_catatan2($P)
	{
		$data['kode_penawaran']=$P;
		$kirim=array("CATATAN"=>$data);
		$hasil=$this->webserv->admisi("input_data/lihat_catatan",$kirim);
		if(!is_null($hasil))
		{	
			$num=0;
			echo "<br><table class='table table-bordered'>";
			echo "<thead>";
			echo "<tr>";
				echo "<td>";
				echo "NO";
				echo "</td>";
				echo "<td>";
				echo "Catatan";
				echo "</td>";
				echo "<td>";
				echo "#";
				echo "</td>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			foreach ($hasil as $dc) {
			echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo "<font id='tp".$num."'>".$dc->note."</font>";
				echo "<textarea class='form-control input-md' style='display:none;' id='ct".$num."' rows='5'>".$dc->note."</textarea>";
				echo "</td>";
				echo "<td>";
				echo "<button type='button' class='btn btn-inverse btn-small' id='ed".$num."' no='".$num."' value='".$dc->id_catatan."' onclick='edit_catatan(this)'> Edit</button>";
				echo "<button type='button' class='btn btn-inverse btn-small' style='display:none;' id='smp".$num."' no='".$num."' value='".$dc->id_catatan."' onclick='simpan_catatan(this)'> Simpan</button>";
				echo " <button type='button' class='btn btn-inverse btn-small' style='display:none;' id='btl".$num."' no='".$num."' value='".$dc->id_catatan."' onclick='batal_catatan(".$num.")'> Batal</button>";
				echo " <button type='button' class='btn btn-inverse btn-small' id='hp".$num."' no='".$num."' value='".$dc->id_catatan."' onclick='hapus_catatan(this)'> Hapus</button>";
				echo "</td>";
			echo "</tr>";	
			}
			echo "</tbody>";
		}
		else
		{
			echo "Tidak ada data untuk ditampilkan.";

		}
	}

	function jadwal_pengisian_profile()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Jadwal Pengisian Data Profile', ' ');
		$data['jadwal']=json_decode($this->profile->get_jadwal_profile());
		$data['jalur'] = $this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_setting_pengisian_profile";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function tes($kj)
	{
		$hasil=json_decode($this->profile->tes($kj));
		print_r($hasil);
	}

	function load_jadwal_profile()
	{
		$data['jadwal']=json_decode($this->profile->get_jadwal_profile());
		$this->load->view('v_table/view_table_jadwal_profile',$data);
	}

	function simpan_jadwal_pengisisan_profile()
	{
		$kode_jalur=$this->input->post('kode_jalur');
		$tgl_mul=$this->input->post('tgl_mulai').":00";
		$tgl_sel=$this->input->post('tgl_selesai').":00";
		$ket=$this->input->post('keterangan');
		$parameter = array('kd_jalur'=>$kode_jalur, 'tgl_mulai'=>$tgl_mul,'tgl_akhir'=>$tgl_sel,'keterangan'=>$ket);
		$hasil=$this->profile->post_jadwal_profile($parameter);
		$OUT=json_decode($hasil);
		$this->load_jadwal_profile();

	}


	function hapus_prodi()
	{
		$data['id_prodi']=$this->input->post('id_prodi');
		$kirim=array("PRODI"=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_prodi',$kirim);
		if($hasil)
		{
			$d['data_prodi']=$this->webserv->admisi('input_data/data_program_studi',array());
			$this->load->view('v_table/tabel_master_prodi',$d);
		}
		else{
			echo "GAGAL";
		}
	}

	function eksekusi_update()
	{
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['nama_prodi']=$this->input->post('nama_prodi');
		$data['id_fakultas']=$this->input->post('id_fakultas');
		$data['id_jenjang']=$this->input->post('id_jenjang');
		$data['id_minat']=$this->input->post('id_minat');
		$kirim=array("PRODI"=>$data);
		$hasil=$this->webserv->admisi('input_data/simpan_prodi',$kirim);
		if($hasil)
		{
			$d['data_prodi']=$this->webserv->admisi('input_data/data_program_studi',array());
			$this->load->view('v_table/tabel_master_prodi',$d);
		}
		else{
			echo "GAGAL";
		}
	}
		
	function master_prodi()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Master Prodi', ' ');	

		$data['data_prodi']=$this->webserv->admisi('input_data/data_program_studi',array());
		$data['data_fakultas']=$this->webserv->admisi('input_data/data_fakultas',array());
		$data['data_minat']=$this->webserv->admisi('input_data/minat',array());
		$data['data_jenjang']=$this->webserv->admisi('input_data/data_jenjang',array());
		$data['content']="form_master_prodi";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');

	}
		function simpan_fakultas()
	{
		$data['id_fakultas']=$this->input->post('id_fakultas');
		$data['nama_fakultas']=$this->input->post('nama_fakultas');
		$kirim=array('FAK'=>$data);
		$hasil=$this->webserv->admisi('input_data/simpan_fakultas',$kirim);
		if($hasil)
		{
			$d['data_fakultas']=$this->webserv->admisi('input_data/data_fakultas',array());
			$this->load->view('v_table/tabel_master_fakultas',$d);
		}
	}

	function hapus_fakultas()
	{
		$data['id_fakultas']=$this->input->post('id_fakultas');
		$kirim=array('FAK'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_fakultas',$kirim);
		if($hasil)
		{
			$d['data_fakultas']=$this->webserv->admisi('input_data/data_fakultas',array());
			$this->load->view('v_table/tabel_master_fakultas',$d);
		}
	}

	function master_fakultas()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Master Fakultas', ' ');	

		$data['data_fakultas']=$this->webserv->admisi('input_data/data_fakultas',array());
		$data['content']="form_master_fakultas";	
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

		function master_tes()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Master Tes', ' ');	
		$data['data_tes']=$this->webserv->admisi('input_data/nama_tes',array());
		$data['content']="form_master_tes";	
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function simpan_tes()
	{
		$data['kode']=$this->input->post('kode');
		$data['nama']=$this->input->post('nama');
		$kirim=array('TES'=>$data);
		$hasil=$this->webserv->admisi('input_data/simpan_tes',$kirim);
		if($hasil)
		{
			$d['data_tes']=$this->webserv->admisi('input_data/nama_tes',array());
			$this->load->view('v_table/tabel_master_tes',$d);
		}
		else
		{
			echo "GAGAL";
		}
	}

	function hapus_tes()
	{
		$data['kode']=$this->input->post('id_tes');
		$kirim=array('TES'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_tes',$kirim);
		if($hasil)
		{
			$d['data_tes']=$this->webserv->admisi('input_data/nama_tes',array());
			$this->load->view('v_table/tabel_master_tes',$d);
		}
		else
		{
			echo "GAGAL";
		}
	}

	function hapus_kelas()
	{
		$data['kode_kelas']=$this->input->post('kode_kelas');
		$kirim=array('KELAS'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_kelas',$kirim);
		if($hasil)
		{
			$d['data_kelas']=$this->webserv->admisi('input_data/data_kelas',array());
			$this->load->view('v_table/tabel_master_kelas',$d);
		}
		else
		{
			echo "GAGAL";
		}
	}

	function simpan_kelas()
	{
		$data['nama_kelas']=$this->input->post('nama_kelas');
		$kirim=array('KELAS'=>$data);
		$hasil=$this->webserv->admisi('input_data/simpan_kelas',$kirim);
		if($hasil)
		{
			$d['data_kelas']=$this->webserv->admisi('input_data/data_kelas',array());
			$this->load->view('v_table/tabel_master_kelas',$d);
		}
		else
		{
			echo "GAGAL";
		}
	}

	function master_kelas()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Master Kelas', ' ');	

		$data['data_kelas']=$this->webserv->admisi('input_data/data_kelas',array());
		$data['content']="form_master_kelas";	
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');

	}

	function hapus_minat()
	{
		$data['kode_minat']=$this->input->post('kode_minat');
		$kirim=array('MINAT'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_minat',$kirim);
		if($hasil)
		{
			$d['data_minat']=$this->webserv->admisi('input_data/minat',array());
			$this->load->view('v_table/tabel_master_minat',$d);
		}
		else
		{
			echo "GAGAL";
		}
	}

	function simpan_minat()
	{
		$data['nama_minat']=$this->input->post('nama_minat');
		$data['kode_minat']=$this->input->post('kode_minat');
		$kirim=array('MINAT'=>$data);
		$hasil=$this->webserv->admisi('input_data/simpan_minat',$kirim);
		if($hasil)
		{
			$d['data_minat']=$this->webserv->admisi('input_data/minat',array());
			$this->load->view('v_table/tabel_master_minat',$d);
		}
		else
		{
			echo "GAGAL";
		}
	}

	function master_minat()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Master Minat', ' ');	
		$data['data_minat']=$this->webserv->admisi('input_data/minat',array());
		$data['content']="form_master_minat";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');

	}

	function hapus_gedung()
	{
		$data['kode']=$this->input->post('kode');
		$kirim=array('GEDUNG'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_gedung',$kirim);
		if($hasil)
		{
			$d['data_gedung']=$this->webserv->admisi('input_data/data_gedung',array());
			$this->load->view('v_table/tabel_master_gedung',$d);
		}
		else
		{
			echo "GAGAL";
		}
	}

	function simpan_gedung()
	{
		$data['kode']=$this->input->post('kode');
		$data['nama']=$this->input->post('nama');
		$data['status']=$this->input->post('status');
		$kirim=array('GEDUNG'=>$data);
		$hasil=$this->webserv->admisi('input_data/simpan_gedung',$kirim);
		if($hasil)
		{
			$d['data_gedung']=$this->webserv->admisi('input_data/data_gedung',array());
			$this->load->view('v_table/tabel_master_gedung',$d);
		}
	}

	function master_gedung()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Master Gedung', ' ');	
		$data['data_gedung']=$this->webserv->admisi('input_data/data_gedung',array());
		$data['content']="form_master_gedung";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');

	}

	function form_penilaian_dokumen()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Penilaian Dokumen', ' ');
		$data['jalur'] = $this->webserv->admisi('input_data/jalur',array());
		$data['content']="setting_form_nilai_doc";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	
	}

	function help($no)//kalau gk bisa download
	{
		$data['nomor_pendaftar']=$no;
		$kirim=array('GAK_BISA'=>$data);
		$hasil=$this->webserv->admisi('input_data/data',$kirim);
		if($hasil)
		{
			foreach ($hasil as $h);
			//header('Content-Type: Image/jpeg');
			//echo pg_unescape_bytea($h->sertifikat_toefl);
			echo "<img src='".pg_unescape_bytea($h->sertifikat_toefl)."'>";
		}
	}

	function help_prodi($id)
	{
		$data['id_prodi']=$id;
		$data['nama']="Hukum Tata Negara";
		$kirim=array('HELP'=>$data);
		$hasil=$this->webserv->admisi('input_data/update_master_prodi',$kirim);
		if($hasil)
		{
			print_r($hasil);
		}
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

	function batal_yudisiumkan()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['id_kelas']=$this->input->post('id_kelas');
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('YUDISIUM'=>$data);
		$hasil=$this->webserv->admisi('penilaian/batal_yudisium',$kirim);
		if($hasil)
		{
			echo "Berhasil dibatalkan.";
		}
	}

	function yudisiumkan()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['id_kelas']=$this->input->post('id_kelas');
		$data['hasil']=$this->input->post('hasil');
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('YUDISIUM'=>$data);
		$hasil=$this->webserv->admisi('penilaian/yudisiumkan',$kirim);
		if($hasil)
		{
			echo "Berhasil diupdate";
		}
		else
		{
			print_r($kirim);
		}
	}

	function koreksi($jawab, $kunci, $bobot, $subtes)
	{

		$benar=0;
		$salah=0;
		$kosong=0;
		$bot_benar=0;
		$bot_salah=0;
		$bot_kosong=0;
		$temp="";
		$tempsub="";
		
		foreach($bobot as $b)
		{
			$bot_benar=$b->benar;
			$bot_salah=$b->salah;
			$bot_kosong=$b->kosong;
		}


		foreach ($jawab as $jwb) 
		{

			if($temp != $jwb->nomor_peserta)
			{
				$temp=$jwb->nomor_peserta;
				$benar=0;
				$salah=0;
				$kosong=0;
				$no_benar=array();
				$no_salah=array();
				$no_kosong=array();
			}

					foreach ($kunci as $key => $kun);
					$nilai=str_split($jwb->jawaban);
					$key=str_split($kun->kunci);
					//echo $jwb->nomor_peserta." JUMLAH: ".strlen($jwb->jawaban)." KUNCI: ".strlen($kun->kunci)."<br>";
					
					
					for ($i=0; $i < count($key); $i++) 
					{ 
						
							if($nilai[$i]==$key[$i] || $key[$i]=='X' && strlen(str_replace(' ','',$nilai[$i])) > 0) //X=BONUS
							{
								
								$benar+=1;
								array_push($no_benar, $i+1);
								
							}
							elseif(strlen(str_replace(' ','',$nilai[$i])) > 0 && $nilai[$i]!=$key[$i])
							{
								$salah+=1;
								array_push($no_salah, $i+1);
							}
							elseif(strlen(str_replace(' ','',$nilai[$i])) < 1)
							{
								$kosong+=1;
								array_push($no_kosong, $i+1);
							};

							
					}
					
				$nilai_akhir=array('BENAR'=>$no_benar,'SALAH'=>$no_salah, 'KOSONG'=>$no_kosong);
				$nil=$this->cek_sub_tes($subtes,$nilai_akhir,$bobot);		
			
		$output[]=array('NOMOR_PESERTA'=>$temp, "JUMLAH_BENAR"=>$benar, "JUMLAH_SALAH"=>$salah, "JUMLAH_KOSONG"=>$kosong,"PENILAIAN"=>$nil);
		
	}	
		
		

		return $output;
	}



	function cek_sub_tes($subtes, $nilai, $bobot)
	{
		$tempsub="";
		foreach($bobot as $b)
		{
			$bot_benar=$b->benar;
			$bot_salah=$b->salah;
			$bot_kosong=$b->kosong;
		}
				foreach ($subtes as $sub) 
				{
					if($tempsub != str_replace(' ','_',$sub->nama_sub))
					{
						$tempsub=str_replace(' ','_',$sub->nama_sub);
					}
						
					$array_sub[]=array('NAMA_SUB'=>$tempsub,'NO_AWAL'=>$sub->no_awal, 'NO_AKHIR'=>$sub->no_akhir,'BOBOT'=>$sub->bobot_normal,'BENAR'=>$sub->benar,'SALAH'=>$sub->salah,'KOSONG'=>$sub->kosong);
					$nilai_sub[''.$tempsub.'']['BENAR']=array();
					$nilai_sub[''.$tempsub.'']['SALAH']=array();
					$nilai_sub[''.$tempsub.'']['KOSONG']=array();
					$nilai_sub[''.$tempsub.'']['HASIL']=array();
					$hasil[''.$tempsub.'']=array();
				}
				
				for ($i=0; $i < count($nilai['BENAR']); $i++)
				{ 
					foreach ($array_sub as $key => $sub) {
						if(($nilai['BENAR'][$i] >= $array_sub[$key]['NO_AWAL']) && ($nilai['BENAR'][$i] <= $array_sub[$key]['NO_AKHIR']))
						{
							array_push($nilai_sub[''.$array_sub[$key]['NAMA_SUB'].'']['BENAR'],$nilai['BENAR'][$i]);
						}
					}
				}
				for ($i=0; $i < count($nilai['SALAH']); $i++)
				{ 
					foreach ($array_sub as $key => $sub) {
						if(($nilai['SALAH'][$i] >= $array_sub[$key]['NO_AWAL']) && ($nilai['SALAH'][$i] <= $array_sub[$key]['NO_AKHIR']))
						{
							array_push($nilai_sub[''.$array_sub[$key]['NAMA_SUB'].'']['SALAH'],$nilai['SALAH'][$i]);
						}
					}
				}
				for ($i=0; $i < count($nilai['KOSONG']); $i++)
				{ 
					foreach ($array_sub as $key => $sub) {
						if(($nilai['KOSONG'][$i] >= $array_sub[$key]['NO_AWAL']) && ($nilai['KOSONG'][$i] <= $array_sub[$key]['NO_AKHIR']))
						{
							array_push($nilai_sub[''.$array_sub[$key]['NAMA_SUB'].'']['KOSONG'],$nilai['KOSONG'][$i]);
						}
					}
				}
				
				foreach ($array_sub as $keys => $val) {

					$bb=count($nilai_sub[''.$array_sub[$keys]['NAMA_SUB'].'']['BENAR'])* $array_sub[$keys]['BENAR'];//3
					$bs=count($nilai_sub[''.$array_sub[$keys]['NAMA_SUB'].'']['SALAH'])* $array_sub[$keys]['SALAH'];//-1
					$bk=count($nilai_sub[''.$array_sub[$keys]['NAMA_SUB'].'']['KOSONG'])* $array_sub[$keys]['KOSONG'];//0
					
					$jml=($array_sub[$keys]['NO_AKHIR'] - $array_sub[$keys]['NO_AWAL']);//JUMLAH ITEM
					$has=$bb+$bs+$bk; //NILAI PEROLEH
					//$has_prod=round($this->normalisasi_nilai($has,$jml,$bot_benar, $bot_salah)*$array_sub[$keys]['BOBOT']);//NORMALISASI DAN BOBOT
					array_push($nilai_sub[''.$array_sub[$keys]['NAMA_SUB'].'']['HASIL'],$has);
				}
				
				foreach ($array_sub as $ki => $va) {
					foreach ($nilai_sub[''.$array_sub[$ki]['NAMA_SUB'].'']['HASIL'] as $k => $v) {
						$bingung=$v;
					}
					
					array_push($hasil[''.$array_sub[$ki]['NAMA_SUB'].''],$bingung);
				}
	
				

			return $hasil;
			

	}

	function normalisasi_nilai($nilai, $item, $benar, $salah)
	{
	
		return (($nilai-($item*$salah))/(($item*$benar)-($item*$salah)))*1;
	}

	function tampil_hasil($subtes,$arr)
	{
		if(!is_null($arr))
		{
			echo "<table class='table table-bordered table-hover'>";
			echo "<tr>";
				echo "<td>";
				echo "NO";
				echo "</td>";
				echo "<td>";
				echo "NOMOR PESERTA";
				echo "</td>";
				echo "<td>";
				echo "NILAI TES PERBOBOT";
				echo "</td>";
				echo "<td>";
				echo "NILAI TOTAL";
				echo "</td>";
				echo "</tr>";
			$no=0;
			foreach ($arr as $k => $v) {
				echo "<tr>";
				echo "<td>";
				echo $no+=1;
				echo "</td>";
				echo "<td>";
				echo $arr[$k]['NOMOR_PESERTA'];
				
				echo "</td>";
				echo "<td>";
				foreach ($subtes as $key => $val) {
					$nsub=str_replace(" ", "_", $val->nama_sub);
					echo $val->nama_sub. " : ".($arr[$k]['PENILAIAN'][$nsub][0])."<br>";
				}

				echo "</td>";
				echo "<td>";
				$total=0;
				foreach($arr[$k]['PENILAIAN'] as $key => $nil)
				{
					$total+=$nil[0];

				}
				echo $total;
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	}

	function tampil_hasil_koreksi($arr, $subtes, $data)//untuk disimpan
	{
		$isi=array();
		if(!is_null($arr))
		{
			$no=0;
			foreach ($arr as $k => $v) 
			{
				foreach ($subtes as $key => $val) 
				{
					$nmsub=str_replace(" ", "_", $val->nama_sub);
					$isi[]=array('nomor_peserta'=>$arr[$k]['NOMOR_PESERTA'],'id_sub'=>$val->id_sub,'nilai_sub'=>$arr[$k]['PENILAIAN'][$nmsub][0],'kode_penawaran'=>$data['kode_penawaran'],'id_tes'=>$data['id_tes'],'kode_soal'=>$data['kode_soal'],'bobot'=>$val->bobot_normal);
				
				}

			}
			
		}

		$data=array_chunk($isi, 100);
		foreach ($data as $key => $value) {
			
			$kirim=array('LJK'=>$data[$key]);
			$hasil=$this->webserv->admisi('penilaian/simpan_koreksi',$kirim);
			
		}
	if(!$hasil)
	{
		print_r($hasil);
	}
		$this->tampil_hasil($subtes,$arr);//tampilkan
	}


	function get_koreksi()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		
		$data['kode_soal']=$this->input->post('kode_soal');
		$data['id_tes']=$this->input->post('id_tes');
		$kirim=array("KOREKSI"=>$data);
		$jawaban=$this->webserv->admisi('penilaian/ambil_jawaban',$kirim);
		$kunci=$this->webserv->admisi('penilaian/ambil_kunci',$kirim);
		$bobot=$this->webserv->admisi('penilaian/cari_bobot',$kirim);
		$subtes=$this->webserv->admisi('penilaian/sub_tes',$kirim);
		if(!is_null($kunci) && !is_null($bobot) && !is_null($subtes))
		{

			if($jawaban)
			{
				if(!is_null($jawaban)>0)
				{
				
					$nilai=$this->koreksi($jawaban,$kunci,$bobot,$subtes);
					$this->tampil_hasil_koreksi($nilai,$subtes,$data);
					

				}
			}
			else
			{
				echo "Ljk belum di scan";
			}
		}
		else{
			echo "Data belum disetting";
		}
			
	}

	function cari_nilai()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		
		$kirim=array('CARI'=>$data);
		$hasil['nilai']=$this->webserv->admisi('penilaian/lihat_nilai',$kirim);
		if($hasil)
		{
			$this->load->view('v_table/table_nilai_akhir',$hasil);
			
		}

	}

	function pindah_data_ke_yudisium()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		
		$kirim=array('PINDAH'=>$data);
		$hasil3=$this->webserv->admisi('penilaian/pindah_data_diri',$kirim);
		$hasil=$this->webserv->admisi('penilaian/pindah_data',$kirim);
		$hasil2=$this->webserv->admisi('penilaian/pindah_nilai',$kirim);
		
			echo '<div class="bs-callout bs-callout-success"><p>DATA BERHASIL DIEXPORT</p></div>';
		
		
	}

	function koreksi_dokumen_ljk()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Koreksi Dokumen LJK', ' ');
		$data['sub_tes']=$this->webserv->admisi('input_data/data_sub_tes',array());
		$data['data_sub']=$this->webserv->admisi('input_data/data_master_sub_tes',array());
		$data['data_tes']= $this->webserv->admisi('input_data/nama_tes',array());
		$data['jalur_masuk']=$this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_koreksi_ljk";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');	
	}

	function export_nilai()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Export Nilai Yudisium', ' ');
		$data['sub_tes']=$this->webserv->admisi('input_data/data_sub_tes',array());
		$data['data_sub']=$this->webserv->admisi('input_data/data_master_sub_tes',array());
		$data['data_tes']= $this->webserv->admisi('input_data/nama_tes',array());
		$data['jalur_masuk']=$this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_export_nilai";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');	
	}

	function data_prestasi()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array("PRESTASI"=>$data);
		$hasil=$this->webserv->admisi('input_data/data_prestasi',$kirim);
		if($hasil)
		{
			echo "<table class='table table-bordered table-hover'>";
			echo "<thead>";
			echo "<tr>";
			echo "<td>";
			echo "NO";
			echo "</td>";
			echo "<td>";
			echo "JENIS";
			echo "</td>";
			echo "<td>";
			echo "JUARA";
			echo "</td>";
			echo "<td>";
			echo "TINGKAT";
			echo "</td>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
				$num=0;
				foreach ($hasil as $hs) {
					if(strlen($hs->nama_jenis)>2)
					{

					echo "<tr>";
					echo "<td>";
					echo $num+=1;
					echo "</td>";
					echo "<td>";
					echo $hs->nama_jenis;
					echo "</td>";
					echo "<td>";
					echo $hs->juara_ke;
					echo "</td>";
					echo "<td>";
					echo $hs->nama_tingkat;
					echo "</td>";
					echo "</tr>";
					
					}
					else
					{
						echo "<tr align='center'>";
						echo "<td colspan='4'>";
						echo "Tidak ada.";
						echo "</td>";
						echo "</tr>";
						
					}

			}
			
		}
		else
		{
			echo "<table class='table table-bordered table-hover'>";
			echo "<thead>";
			echo "<tr>";
			echo "<td>";
			echo "NO";
			echo "</td>";
			echo "<td>";
			echo "JENIS";
			echo "</td>";
			echo "<td>";
			echo "JUARA";
			echo "</td>";
			echo "<td>";
			echo "TINGKAT";
			echo "</td>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
						echo "<tr>";
						echo "<td colspan='4' align='center'>";
						echo "Tidak ada.";
						echo "</td>";
						echo "</tr>";
		}
			echo "</tbody>";
			echo "</table>";
	}


	function simpan_bobot_sub()
	{
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['id_sub']=$this->input->post('id_sub');
		$data['bobot_prodi']=$this->input->post('bobot_pil');
		$kirim=array("SIMPAN"=>$data);
		$hasil=$this->webserv->admisi('input_data/simpan_bobot_sub',$kirim);
		if($hasil)
		{
			$has['bobot_prodi']=$this->webserv->admisi('input_data/data_bobot_prodi',array());
			$this->load->view('v_table/bobot_soal',$has);
		}
		else
		{
			echo "Gagal";
		}
	}

	function simpan_ljk()
	{
		$ljk=$this->input->post('datfile');
		$data['tahun']=$this->input->post('tahun');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		$data['id_tes']=$this->input->post('jenis_tes');
		$kirim=array('JML'=>$data);
		$jml_soal=$this->webserv->admisi('penilaian/cari_jumlah',$kirim);
		$JML=0;
		if(!is_null($jml_soal))
		{
			foreach ($jml_soal as $js);
			$JML=$js->jumlah_soal;
		}
		$fh = fopen($ljk, "rb");
		$lju=array();
		while (!feof($fh)) {
			$line = fgets($fh);

			if(strlen(str_replace(' ','',substr($line,40,10))) == '10' && strlen(str_replace(' ','',substr($line,50,3))) > '2')
      		{
				$lju[]=array(
					'kode_soal'=>substr($line,50,3),
					'nomor_peserta'=>str_replace(' ','',substr($line,40,10)),
					'jawaban'=>substr($line,81,$JML),//ketemu
					'kode_penawaran'=>$data['kode_penawaran'],
					'id_tes'=>$data['id_tes']
				);
			}
		}

		$kirim=array_chunk($lju, 200);
		
		foreach($kirim as $key => $val){ 
			
			$nilai=array('LJU'=>$kirim[$key]);
			
			$hasil=$this->webserv->admisi('penilaian/simpan_jawaban_tes',$nilai);
			if($hasil)
			{
			
			}

		}
		
		echo "Data tersimpan";
	}

	function read_ljk()
	{
		$ljk=$this->input->post('datfile');
		$data['tahun']=$this->input->post('tahun');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		$data['id_tes']=$this->input->post('jenis_tes');
		$kirim=array('JML'=>$data);
		$jml_soal=$this->webserv->admisi('penilaian/cari_jumlah',$kirim);
		$JML=0;
		if(!is_null($jml_soal))
		{
			foreach ($jml_soal as $js);
			$JML=$js->jumlah_soal;
		}
		//$isi=file_get_contents($data['ljk']);
		$fh = fopen($ljk, "rb");
		$lju=array();
		while (!feof($fh)) {
			$line = fgets($fh);
			
				
				$lju[]=array(
					'kode_soal'=>substr($line,50,3),
					'nomor_peserta'=>str_replace(' ','',substr($line,40,10)),
					'jawaban'=>substr($line,81,$JML)
				);
			
				
			
		}
		$hasil['JML']=$JML;
		$hasil['LJK']=$lju;
		$this->load->view('v_table/data_ljk',$hasil);
	}

	function cari_kode_soal()
	{
		$data['id_tes']=$this->input->post('id_tes');
		$kirim=array('KODE'=>$data);
		$hasil=$this->webserv->admisi('penilaian/cari_kode_soal',$kirim);
		if($hasil)
		{
			if(!is_null($hasil))
			{
				echo "<select class='form-control input-md' name='kode_soal'  id='kode_soal'>";
				echo "<option value=''> -- </option>";
				foreach ($hasil as $kode) {
					echo "<option value='".$kode->kode_soal."'>".$kode->kode_soal."</option>";
					# code...
				}
				echo "</select>";
			}
		}


	}

	function cari_gelombang()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$kirim=array('GELOMBANG'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_gelombang',$kirim);
		if($hasil)
		{
			if(!is_null($hasil))
			{
				echo '<select class="form-control input-md" id="gelombang" name="gelombang">';
					
				
				foreach ($hasil as $has) {
				echo "<option value='".$has->gelombang."'> Gelombang ".$has->gelombang."</option>";
				}
				echo "</select>";
			}
		}
	}

	


	function kelola_dokumen_ljk()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Scan Dokumen LJK', ' ');
		$data['jalur_masuk']=$this->webserv->admisi('input_data/jalur',array());
		$data['data_tes']= $this->webserv->admisi('input_data/nama_tes',array());
		
		$data['content']="form_kelola_dokumen_ljk";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function load_setting_nilai()
	{
		$data['sub_tes']=$this->webserv->admisi('input_data/ data_sub_tes',array());
		$data['data_set_nilai']=$this->webserv->admisi('input_data/data_setting_nilai',array());
		$this->load->view('v_table/setting_nilai',$data);
	}

	function update_sub_tes()
	{
		$data['id_tes']=$this->input->post('id_tes');
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['b']=$this->input->post('benar');
		$data['s']=$this->input->post('salah');
		$data['t']=$this->input->post('kosong');
		$kirim=array('UPDATE_SUB'=>$data);
		
		$hasil=$this->webserv->admisi('input_data/update_sub_tes',$kirim);
		if($hasil)
		{
			$this->load_setting_nilai();
		}
		else
		{
			echo "Gagal";
		}
		
	}

	function validate_bobot($array)
	{
		if(array_sum($array) != 100)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}

	function simpan_setting_nilai()
	{
		$data['id_tes']=$this->input->post('tes');
		
		$data['b']=$this->input->post('benar');
		$data['s']=$this->input->post('salah');
		$data['t']=$this->input->post('kosong');
		$data['id_sub']=$this->input->post('sub_tes');
		$data['awal']=$this->input->post('awal');
		$data['akhir']=$this->input->post('akhir');
		$data['bobot']=$this->input->post('bobot');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		$kirim=array('NILAI'=>$data);
		
		$is_valid=$this->validate_bobot($data['bobot']);
		switch ($is_valid) {
			case '1':
				
						$hasil=$this->webserv->admisi('input_data/simpan_setting_nilai',$kirim);
						if($hasil)
						{
							$this->load_setting_nilai();
						}
				
				break;
			case '0':
						$info="JUMLAH BOBOT TIDAK SAMA DENGAN 100 %. ULANGI INPUT!";
						$pesan = "<div id='msg' class='bs-callout bs-callout-error'>".$info."</div>";
						echo $pesan;
				break;
		}
		
		
		
	}

	function update_kunci()
	{
		$data['id_tes']=$this->input->post('id_tes');
		$data['kode_soal']=$this->input->post('kode_soal');
		$data['jumlah_soal']=$this->input->post('jumlah_soal');
		$data['kunci']=str_replace(' ','',strtoupper($this->input->post('kunci')));
		
		if(strlen($data['kunci']) > $data['jumlah_soal'])
		{
			echo "KUNCI MELEBIHI JUMLAH SOAL";
		}
		else
		{
			$kirim=array("KUNCI"=>$data);
			$hasil=$this->webserv->admisi('input_data/update_kunci',$kirim);
			if($hasil)
			{
				$x['data_kunci']= $this->webserv->admisi('input_data/data_kunci',array());
				$this->load->view('v_table/table_kunci',$x);
			}
		}
		
	}

	function simpan_kunci()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['id_tes']=$this->input->post('id_tes');
		$data['kode_soal']=$this->input->post('kode_soal');
		$data['jumlah_soal']=$this->input->post('jml_soal');
		$data['kunci']=str_replace(' ','',strtoupper($this->input->post('kunci')));
		if(strlen($data['kunci']) > $data['jumlah_soal'])
		{
			echo "KUNCI MELEBIHI JUMLAH SOAL";
		}
		else
		{
			$kirim=array("KUNCI"=>$data);
			$hasil=$this->webserv->admisi('input_data/insert_kunci',$kirim);
			if($hasil)
			{
				$d['data_kunci']= $this->webserv->admisi('input_data/data_kunci',array());
				$d['data_tes']= $this->webserv->admisi('input_data/nama_tes',array());
				$this->load->view('v_table/table_kunci',$d);
			}
		}
	}

	function hapus_kunci()
	{
		$data['id_tes']=$this->input->post('id_tes');
		$data['kode_soal']=$this->input->post('kode_soal');
		
			$kirim=array("KUNCI"=>$data);
			$hasil=$this->webserv->admisi('input_data/hapus_kunci',$kirim);
			if($hasil)
			{
				$d['data_kunci']= $this->webserv->admisi('input_data/data_kunci',array());
				$d['data_tes']= $this->webserv->admisi('input_data/nama_tes',array());
				$this->load->view('v_table/table_kunci',$d);
			}
			
		
	}

	function setting_kunci()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Setting Kunci Jawaban', ' ');
		$data['data_kunci']= $this->webserv->admisi('input_data/data_kunci',array());
		$data['data_tes']= $this->webserv->admisi('input_data/nama_tes',array());
		$data['jalur_masuk']=$this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_kunci_jawaban";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function penilaian_dokumen_portofolio()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Penilaian Dokumen Portofolio', ' ');
		$data['normal_dokumen'] = $this->webserv->admisi('input_data/data_normalisasi_dokumen',array());
		$data['jalur_masuk']=$this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_penilaian_dokumen";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function setting_penilaian()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Setting Penilaian Ujian Tertulis', ' ');
		$data['sub_tes']=$this->webserv->admisi('input_data/data_sub_tes',array());
		$data['data_sub']=$this->webserv->admisi('input_data/data_master_sub_tes',array());
		$data['data_set_nilai']=$this->webserv->admisi('input_data/data_setting_nilai',array());
		$data['data_tes']= $this->webserv->admisi('input_data/nama_tes',array());
		$data['jalur_masuk']=$this->webserv->admisi('input_data/data_penawaran_jalur_all',array());
		$data['bobot_prodi']=$this->webserv->admisi('input_data/data_bobot_prodi',array());
		$data['content']="form_setting_penilaian";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function hapus_sub_tes()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['id_tes']=$this->input->post('tes');
		$kirim=array('TES'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_sub_tes',$kirim);
		$hasil2=$this->webserv->admisi('input_data/hapus_settingtes',$kirim);
		if($hasil && $hasil2)
		{	
			$da['data_sub']=$this->webserv->admisi('input_data/data_master_sub_tes',array());
			$da['sub_tes']=$this->webserv->admisi('input_data/data_sub_tes',array());
			$da['data_set_nilai']=$this->webserv->admisi('input_data/data_setting_nilai',array());
			$da['jalur_masuk']=$this->webserv->admisi('input_data/data_penawaran_jalur_all',array());
			$da['bobot_prodi']=$this->webserv->admisi('input_data/data_bobot_prodi',array());
			$da['data_tes']= $this->webserv->admisi('input_data/nama_tes',array());
			$this->load->view('v_table/setting_nilai',$da);
		}
	}

	function hapus_bobot_sub()
	{
		$data['id_sub']=$this->input->post('id_sub');
		$data['id_prodi']=$this->input->post('id_prodi');
		$kirim=array('HAPUS'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_bobot_sub',$kirim);
		if($hasil)
		{	
			
			$has['bobot_prodi']=$this->webserv->admisi('input_data/data_bobot_prodi',array());
			$this->load->view('v_table/bobot_soal',$has);

		}
	}

	function tambah_agenda()
	{
		$data['tema']=$this->input->post('agenda');
		$data['tahun']=$this->input->post('tahun');
		$kirim=array('AGENDA'=>$data);
		$hasil=$this->webserv->admisi('input_data/tambah_agenda',$kirim);
		if($hasil)
		{
			echo "Berhasil. Refresh halaman ini.";
		}
		else
		{
			echo "GAGAL";
		}
	}

	function tambah_unit()
	{
		$data['kementrian']=$this->input->post('mentri');
		$data['nama_unit']=$this->input->post('nama');
		$data['alamat']=$this->input->post('alamat');
		$data['telp']=$this->input->post('telp');
		$data['email']=$this->input->post('email');
		$data['kota']=$this->input->post('kota');
		$kirim=array('UNIT'=>$data);
		$hasil=$this->webserv->admisi('input_data/tambah_unit',$kirim);
		if($hasil)
		{
			echo "Berhasil. Refresh halaman ini.";
		}
		else
		{
			echo "GAGAL";
		}
	}

	function simpan_logo()
	{
		$data['logo']=$this->input->post('foto');
		$data['tgl_aktif']=$this->input->post('tanggal_mulai');
		$data['tgl_nonaktif']=$this->input->post('tanggal_selesai');
		$kirim=array('LOGO'=>$data);
	
		$hasil=$this->webserv->admisi('input_data/simpan_logo',$kirim);
		if($hasil)
		{
			//$data['data_logo']=$this->webserv->admisi('input_data/data_logo',array());
			echo "Berhasil. Refresh kembali halaman ini.";
		}
		else
		{
			echo "Gagal";
		}
		
	}

	function cari_logo()
	{
		$data['id_logo']=$this->input->post('id_logo');
		$kirim=array('LOGO'=>$data);
		
		$hasil=$this->webserv->admisi('input_data/cari_data_logo',$kirim);
		if($hasil)
		{
			foreach($hasil as $hs);
			echo pg_unescape_bytea($hs->logo);
		}
		
	}

	function lihat_catatan()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array("CATATAN"=>$data);
		$hasil=$this->webserv->admisi("input_data/lihat_catatan",$kirim);
		if(!is_null($hasil))
		{	
			$num=0;
			echo "<br><table class='table table-bordered'>";
			echo "<thead>";
			echo "<tr>";
				echo "<td>";
				echo "NO";
				echo "</td>";
				echo "<td>";
				echo "Catatan";
				echo "</td>";
				echo "<td>";
				echo "#";
				echo "</td>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			foreach ($hasil as $dc) {
			echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo "<font id='tp".$num."'>".$dc->note."</font>";
				echo "<textarea class='form-control input-md' style='display:none;' id='ct".$num."' rows='5'>".$dc->note."</textarea>";
				echo "</td>";
				echo "<td>";
				echo "<button type='button' class='btn btn-inverse btn-small' id='ed".$num."' no='".$num."' value='".$dc->id_catatan."' onclick='edit_catatan(this)'> Edit</button>";
				echo "<button type='button' class='btn btn-inverse btn-small' style='display:none;' id='smp".$num."' no='".$num."' value='".$dc->id_catatan."' onclick='simpan_catatan(this)'> Simpan</button>";
				echo " <button type='button' class='btn btn-inverse btn-small' style='display:none;' id='btl".$num."' no='".$num."' value='".$dc->id_catatan."' onclick='batal_catatan(".$num.")'> Batal</button>";
				echo " <button type='button' class='btn btn-inverse btn-small' id='hp".$num."' no='".$num."' value='".$dc->id_catatan."' onclick='hapus_catatan(this)'> Hapus</button>";
				echo "</td>";
			echo "</tr>";	
			}
			echo "</tbody>";
		}
		else
		{
			echo "Tidak ada data untuk ditampilkan.";

		}
	}

	function setting_unit()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Setting Kartu Ujian', ' ');	
		$data['data_logo']=$this->webserv->admisi('input_data/data_logo',array());
		$data['data_unit']=$this->webserv->admisi('input_data/data_unit',array());
		$data['agenda_unit']=$this->webserv->admisi('input_data/data_agenda_unit',array());
		$data['unit']=$this->webserv->admisi('input_data/data_unit_disimpan',array());
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_setting_unit";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function jumlah_bayar($TGL_MULAI,$TGL_AKHIR,$KODE_BAYAR){
	// function jumlah_bayar(){
		$USERNAME = 'admis1';
		$PASSWORD = 'admi511';
				////JUMLAH BAYAR
		//http://service2.uin-suka.ac.id/servsibayar/index.php/data/pmb/pmb_list/format/json/f/cari/get_kode_prefix/VAR_KD_PEMBAYARAN/get_tgl_mulai/01-01-2016/get_tgl_akhir/16-03-2016
		$URL_TOTAL_BAYAR = "http://service2.uin-suka.ac.id/servsibayar/index.php/data/pmb/pmb_list/format/json/f/cari/get_kode_prefix/$KODE_BAYAR/get_tgl_mulai/$TGL_MULAI/get_tgl_akhir/$TGL_AKHIR";
		//$URL_TOTAL_BAYAR = "http://service2.uin-suka.ac.id/servsibayar/index.php/data/pmb/pmb_jenis_jumlah/$JENIS_PMB/$GEL/TGL_MULAI/$TGL_MULAI/TGL_AKHIR/$TGL_AKHIR/format/json";
		
				#echo $URL_TOTAL_BAYAR; die();
				 $CONTEXT = stream_context_create(
					array(
						'http' => array(
								'method' => 'GET',
								'header' => "Authorization: Basic " . base64_encode("$USERNAME:$PASSWORD")
							)
					));
				$gropo3 = @file_get_contents($URL_TOTAL_BAYAR,false,$CONTEXT);
				$data['jumlah_bayar'] = json_decode($gropo3,true);
				
		return count($data['jumlah_bayar']);
	}

	function update_status_jadwal()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['status']=$this->input->post('status');
		$kirim=array('UPDATE_STATUS'=>$data);
		$hasil=$this->webserv->admisi('input_data/update_status_jadwal',$kirim);
		if($hasil)
		{
			echo "Jadwal berhasil diupdate";
		}
		else
		{
			echo "Jadwal gagal diupdate!";
		}
	}

	function cari_detail_jadwal2()
		{
			$data['kode_penawaran']=$this->input->post('kode_penawaran');
			$kirim=array('DETAIL_JADWAL_UJIAN'=>$data);
			
			$hasil=$this->webserv->admisi('input_data/detail_jadwal_ujian3',$kirim);
			if($hasil)
			{
				if(!is_null($hasil))
				{
					echo "<select name='kode_jadwal' class='form-control input-md'>";
					echo "<option value=''>Pilih Jadwal</option>";
					$temp=0;
					foreach ($hasil as $dajad) {
						if($temp!=$dajad->kode_jadwal)
						{
						echo "<option value='".$dajad->kode_jadwal."'>"." Tanggal ".$this->tanggal_hari(date_format(date_create($dajad->tanggal),'d-m-Y'))."</option>";
						$temp=$dajad->kode_jadwal;
						}

					}
					echo "</select>";
				}
			}
			
		
		}

	function cari_detail_jadwal()
		{
			$data['kode_jalur']=$this->input->post('kode_jalur');
			$kirim=array('DETAIL_JADWAL_UJIAN'=>$data);
			
			$hasil=$this->webserv->admisi('input_data/detail_jadwal_ujian2',$kirim);
			if($hasil)
			{
				if(!is_null($hasil))
				{
					echo "<select name='kode_jadwal' class='form-control input-md'>";
					echo "<option value=''>Pilih Jadwal</option>";
					foreach ($hasil as $dajad) {
						echo "<option value='".$dajad->kode_jadwal."'>".$dajad->jalur_masuk." Gelombang ".$dajad->gelombang." Tanggal ".$this->tanggal_hari(date_format(date_create($dajad->tanggal),'d-m-Y'))."</option>";
					}
					echo "</select>";
				}
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

function hapus_jadwal_portofolio()
{
	$data['kode_penawaran']=$this->input->post('kode_penawaran');
	$data['kode_jadwal']=$this->input->post('kode_jadwal');
	$kirim=array('HAPUS_JADWAL'=>$data);
	$hasil=$this->webserv->admisi('input_data/hapus_jadwal_portofolio',$kirim);
	if($hasil)
	{
		$this->tampil_jadwal_portofolio();
	}
	else
	{
		echo "Gagal";
	}
}
	function tampil_jadwal_portofolio()
	{
		$data['jadwal']=$this->webserv->admisi('input_data/data_jadwal_portofolio',array());
		$this->load->view('v_table/view_table_jadwal_portofolio',$data);
	}

	function edit_jadwal_portofolio()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$tgl_mulai=$this->input->post('mulai_verifikasi');
		$tgl_selesai=$this->input->post('selesai_verifikasi');
		$jam_mulai=$this->input->post('jam_mulai');
		$jam_selesai=$this->input->post('jam_selesai');
		$data['mulai_verifikasi']=$tgl_mulai.' '.$jam_mulai;
		$data['selesai_verifikasi']=$tgl_selesai.' '.$jam_selesai;
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array('UPDATE_JADWAL'=>$data);
		
		$hasil=$this->webserv->admisi('input_data/update_jadwal_portofolio',$kirim);
		if($hasil)
		{
			$this->tampil_jadwal_portofolio();
			
		}
	
	}

	function insert_jadwal_porto()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$tgl_mulai=$this->input->post('mulai_verifikasi');
		$tgl_selesai=$this->input->post('akhir_verifikasi');
		$jam_mulai=$this->input->post('jam_mulai');
		$jam_selesai=$this->input->post('jam_selesai');
		$data['mulai_verifikasi']=$tgl_mulai.' '.$jam_mulai.':00';
		$data['selesai_verifikasi']=$tgl_selesai.' '.$jam_selesai.':00';
		$data['kode_penawaran']=$this->input->post('kode_jalur');
		$kirim=array('SIMPAN_JADWAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/insert_jadwal_portofolio',$kirim);
		if($hasil)
		{
			$this->tampil_jadwal_portofolio();
		}
		
	}

	function cari_jadwal_portofolio2()
	{
		$data['kode_jalur']=substr($this->input->post('kode_jalur'),0,3);
		$data['tahun']=$this->input->post('tahun');
		$cari_jadwal=array('CARI_JADWAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_jadwal_ujian_portofolio',$cari_jadwal);
		if($hasil)
		{
			$temp="";
			echo "<select name='kode_jadwal' style='width:300px;'onchange='jadwal_porto=this.value' class='form-control input-md'>";
			echo "<option value=''>Pilih Jadwal</option>";
			foreach ($hasil as $jadwal) {
				if($temp != $jadwal->kode_jadwal)
				{
					echo "<option value='".$jadwal->kode_jadwal."'>".$this->tanggal_hari(date_format(date_create($jadwal->tanggal),'d-m-Y'))."</option>";				
				}
			$temp=$jadwal->kode_jadwal;
			}
			echo "</select>";

		}
		
	}

	function cari_jadwal_portofolio()
	{
		$data['kode_jalur']=substr($this->input->post('kode_jalur'),0,3);
		$data['tahun']=$this->input->post('tahun');
		$cari_jadwal=array('CARI_JADWAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_jadwal_ujian_portofolio',$cari_jadwal);
		if($hasil)
		{
			
			echo "<select name='kode_jadwal' onchange='jadwal_porto=this.value' class='form-control input-md'>";
			echo "<option value=''>Pilih Jadwal</option>";
			foreach ($hasil as $jadwal) {
			echo "<option value='".$jadwal->id_detail."'>".$this->tanggal_hari(date_format(date_create($jadwal->tanggal),'d-m-Y'))."</option>";				
			}
			echo "</select>";

		}
		
	}

	function cari_peserta_portofolio()
	{
		$data['kode_jalur']=substr($this->input->post('kode_jalur'),0,3);
		$data['tahun']=$this->input->post('tahun');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$cari_jadwal=array('CARI_JADWAL'=>$data);
		$hasil['data_mhs']=$this->webserv->admisi('input_data/jadwal_peserta_portofolio',$cari_jadwal);
		if($hasil)
		{
			$this->load->view('v_table/portofolio_mhs',$hasil);

		}
		else
		{
			echo "Data tidak ditemukan!";
		}
		
	}


	function jadwal_peserta_portofolio()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Peserta Portofolio', ' ');	
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/data_penawaran_jalur_cek',array());
		$data['content']="form_jadwal_peserta_portofolio";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function jadwal_portofolio()
	{

		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Jadwal Portofolio', ' ');	
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/data_penawaran_jalur_cek',array());
		$data['jadwal']=$this->webserv->admisi('input_data/data_jadwal_portofolio',array());
		$data['content']="form_jadwal_portofolio";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	
	}

	function simpan_setting_nilai_dokumen()
	{
		$data['bobot']=$this->input->post('bobot');
		$data['kolom']=$this->input->post('kolom');
		$data['id_ser']=$this->input->post('kolom2');
		$data['isi']=$this->input->post('isi');
		$kirim_bobot=array('UPDATE_BOBOT'=>$data);
		$bobot=$this->webserv->admisi('input_data/update_bobot_dokumen',$kirim_bobot);
		if($bobot)
		{
			echo "Bobot Berhasil, ";
		}
		else
		{
			echo "Bobot Gagal, ";
		};
		if(count($data['isi'])>0)
		{
			$kirim=array("UPDATE_NORMAL"=>$data);
			$normal=$this->webserv->admisi('input_data/update_normal_dokumen',$kirim);
			if($normal)
			{
				echo "Normalisasi Berhasil.";
			}
			else
			{
				echo "Normalisasi Gagal.";
			}
		}
		
		
	}

	function penilaian_dokumen()
	{

		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Setting Penilaian Dokumen', ' ');
		$data['normal_dokumen'] = $this->webserv->admisi('input_data/data_normalisasi_dokumen',array());
		
		$data['content']="form_setting_penilaian_dokumen";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	
	}

	function lihat_ijazah()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('IJAZAH'=>$data);
		$hasil=$this->webserv->admisi('input_data/lihat_ijazah',$kirim);
		if($hasil)
		{
			foreach ($hasil as $hs);
			$file=str_replace('invalid', 'application', pg_unescape_bytea($hs->ijazah));
			echo $file;
			
		}

	}

	function lihat_transkrip()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('TRANSKRIP'=>$data);
		$hasil=$this->webserv->admisi('input_data/lihat_transkrip',$kirim);
		if($hasil)
		{
			foreach ($hasil as $hs);
			$file=str_replace('invalid', 'application', pg_unescape_bytea($hs->transkrip));
			echo $file;
		
		}
	}

	function lihat_sertifikat()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$data['pencarian']=$this->input->post('pencarian');
		$kirim=array('SERTIFIKAT'=>$data);
		$hasil=$this->webserv->admisi('input_data/lihat_sertifikat',$kirim);
		
		if($hasil)
		{
			foreach ($hasil as $hs);
			echo pg_unescape_bytea($hs->$data['pencarian']);
		}


	}



	function file_publikasi($nomor_pendaftar)
	{
		$data['nomor_pendaftar']=$nomor_pendaftar;
		$kirim=array('PUBLIKASI'=>$data);
		$hasil=$this->webserv->admisi('input_data/lihat_publikasi',$kirim);
		
		if($hasil)
		{
			foreach ($hasil as $h);//hanya file terakhir jadi satu-satu
			

					header('Content-type: application/pdf');
					echo file_get_contents(pg_unescape_bytea($h->upload_karya));
					
			
			
		}

					
	}


				
	

	function lihat_publikasi()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('PUBLIKASI'=>$data);
		$hasil=$this->webserv->admisi('input_data/lihat_publikasi',$kirim);
		
		if($hasil)
		{
			$num=0;
			
			echo "<table class='table table-bordered'>";
			echo "<thead><tr>";
			echo "<td>";
			echo "No";
			echo "</td>";
			echo "<td>";
			echo "Judul";
			echo "</td>";
			echo "</tr></thead>";
			echo "<tbody>";
			foreach ($hasil as $hs)
			{
				if(strlen($hs->upload_karya)>50)
				{
					echo "<tr>";
					echo "<td>";
						echo $num+=1;
					echo "</td>";
					echo "<td>";
						echo "<a id='".$hs->id_karya."' isi='".pg_unescape_bytea($hs->upload_karya)."' title='".$hs->judul."' onclick='file_publikasi(this)'>".$hs->judul."</a>";
						
					echo "</td>";
					echo "</tr>";
				}
			}
			echo "</tbody>";
			echo "</table>";
			
		}


	}

	function lihat_rekomendasi()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('REKOMENDASI'=>$data);
		$hasil=$this->webserv->admisi('input_data/lihat_rekomendasi',$kirim);
		
		if($hasil)
		{
			foreach ($hasil as $hs);
			if(strlen($hs->rekomendasi)>20)
			{
				echo pg_unescape_bytea($hs->rekomendasi);

			}
			else
			{
				echo "0";
			}
		}


	}

	function lihat_proposal()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('PROPOSAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/lihat_proposal',$kirim);
		
		if($hasil)
		{
			foreach ($hasil as $hs);
			$file=str_replace('invalid', 'application', pg_unescape_bytea($hs->file_disertasi));
			echo $file;
		}


	}

	function lihat_proposal_tesis()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('PROPOSAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/lihat_proposal_tesis',$kirim);
		
		if($hasil)
		{
			foreach ($hasil as $hs);
			
			$file=str_replace('invalid', 'application', pg_unescape_bytea($hs->file_tesis));
			$reko=str_replace('invalid', 'application', pg_unescape_bytea($hs->rekomendasi));
			echo "<input type='hidden' id='tesisnya".$data['nomor_pendaftar']."' value='".$file."'>";
			echo "<input type='hidden' id='rekomendasinya".$data['nomor_pendaftar']."' value='".$reko."'>";
		}


	}

	function cari_mhs()
	{
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$kirim=array('MHS'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_mhs_prodi',$kirim);
		$kelas=$this->webserv->admisi('input_data/cari_kelas_prodi',$kirim);
		if(!is_null($hasil))
		{
			$nu=0;
			echo "<table border='1'>";
			echo "<thead>";
			echo "<tr>";
			echo "<td>";
				echo "NO";
				echo "</td>";
				echo "<td>";
				echo "NAMA";
				echo "</td>";
				echo "<td>";
				echo "HP";
				echo "</td>";
				echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			foreach ($hasil as $h) {
				echo "<tr>";
				echo "<td>";
				echo $nu+=1;
				echo "</td>";
				echo "<td>";
				echo $h->nama_lengkap;
				echo "</td>";
				echo "<td>";
				echo $h->nohp;
				echo "</td>";
				echo "<tr>";
			}
			echo "<tr>";
			echo "<td>";
			echo "</td>";
			echo "<td colspan='2'>";
			echo "<hr>";
			if(!is_null($kelas))
			{
				
				foreach ($kelas as $k) {
					echo "<strong>".$k->nama_kelas." Jumlah: ".$k->jml."</strong><br>";
				}
			}
			echo "</td>";
			echo "</tr>";
			echo "</tbody>";
			echo "</table>";
		}
	}

	function cari_dokumen()
	{
		$penawaran=$this->input->post('kode_penawaran');
		$data['kode_jalur']=substr($penawaran, 0,3);
		$data['tahun']=$this->input->post('tahun');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$kirim=array('CARI_MHS'=>$data);
		$hasil['dt_sertifikat']=$this->webserv->admisi('input_data/detail_sertifikat',$kirim);
		$isi="";
		switch (substr($penawaran,0,1)) {
			case '1':
				$isi="cari_dokumen_s1";
				break;
			case '2':
				$isi="cari_dokumen_s2";
				break;
			case '3':
				$isi="cari_dokumen_s2";
				break;
			
		}
		$hasil['data_mhs']=$this->webserv->admisi('input_data/'.$isi,$kirim);
		$hasil['jalur']=substr($penawaran,0,1);
		if($hasil)
		{
			$this->load->view('v_table/daftar_dokumen_mhs',$hasil);//
			
		}
	}

	function hitung_nilai($NILAI,$BOBOT,$NORMAL)
	{
		if(strlen($NILAI)<1 || $NILAI=='999')
			{$NILAI=0;}
		if(strlen($BOBOT)<1)
			{$BOBOT=1;}
		if(strlen($NORMAL)<1)
			{$NORMAL=1;}

		return (($NILAI*$NORMAL)*($BOBOT/100));
	}


	function simpan_nilai_mhs()
	{

		$data['nomor_pendaftar']=$this->input->post('user');
		//$data['jenis_sertifikat']=$this->input->post('jenis');

		if(strlen($this->input->post('indo')>0))
		{
			$indo['0']=$this->input->post('indo');
			$indo['1']=$this->input->post('bobotindo');
			$indo['2']=$this->input->post('normalindo');
			$indo['3']=$this->hitung_nilai($indo['0'],$indo['1'],$indo['2']);
			$indo['4']="INDO";
		}

		$ipk['0']=$this->input->post('ipk');
		$ipk['1']=$this->input->post('bobotipk');
		$ipk['2']=$this->input->post('normalipk');
		$ipk['3']=$this->hitung_nilai($ipk['0'],$ipk['1'],$ipk['2']);
		$ipk['4']="IPK";

		$motiv['0']=$this->input->post('motiv');
		$motiv['1']=$this->input->post('bobotmotiv');
		$motiv['2']=$this->input->post('normalmotiv');
		$motiv['3']=$this->hitung_nilai($motiv['0'],$motiv['1'],$motiv['2']);
		$motiv['4']="MOTIVASI";

		$akre['0']=$this->input->post('akreditasi');
		$akre['1']=$this->input->post('bobotakre');
		$akre['2']=$this->input->post('normalakre');
		$akre['3']=($akre['2']*($akre['1']/100));
		$akre['4']="AKREDITASI";

		$tpa['0']=$this->input->post('tpa');
		$tpa['1']=$this->input->post('bobottpa');
		$tpa['2']=$this->input->post('normaltpa');
		$tpa['3']=$this->hitung_nilai($tpa['0'],$tpa['1'],$tpa['2']);
		$tpa['4']="TPA";

		if(str_replace(' ', '', $this->input->post('ikla')) == '999')
		{
			$arab['0']='0';
		}
		else
		{
			$arab['0']=$this->input->post('ikla');
		}
		$arab['1']=$this->input->post('bobotikla');
		$arab['2']=$this->input->post('normalikla');

		if(str_replace(' ', '', $this->input->post('toefl')) == '999')
		{
			$ing['0']='0';
		}
		else
		{
			$ing['0']=$this->input->post('toefl');
		}
		$ing['1']=$this->input->post('bobottoefl');
		$ing['2']=$this->input->post('normaltoefl');

		$kp['0']=$this->input->post('kepemimpinan');
		$kp['1']=$this->input->post('bobotkp');
		$kp['2']=$this->input->post('normalkp');
		$kp['3']=$this->hitung_nilai($kp['0'],$kp['1'],$kp['2']);
		$kp['4']="KEPEMIMPINAN";

		$pub['0']=$this->input->post('publikasi');
		$pub['1']=$this->input->post('bobotpb');
		$pub['2']=$this->input->post('normalpb');
		$pub['3']=$this->hitung_nilai($pub['0'],$pub['1'],$pub['2']);
		$pub['4']="KARYA_TULIS";

		$reko['0']=$this->input->post('rekomendasi');
		$reko['1']=$this->input->post('bobotreko');
		$reko['2']=$this->input->post('normalreko');
		$reko['3']=$this->hitung_nilai($reko['0'],$reko['1'],$reko['2']);
		$reko['4']="REKOMENDASI";

		$prop['0']=$this->input->post('proposal');
		$prop['1']=$this->input->post('bobotprop');
		$prop['2']=$this->input->post('normalprop');
		$prop['3']=$this->hitung_nilai($prop['0'],$prop['1'],$prop['2']);
		$prop['4']="DISERTASI";

		$ikla=$this->hitung_nilai($arab['0'],$arab['1'],$arab['2']);
		$toefl=$this->hitung_nilai($ing['0'],$ing['1'],$ing['2']);
		
		$data['IPK']=$ipk;
		$data['AKREDITASI']=$akre;
		$data['KEPEMIMPINAN']=$kp;
		$data['KARYA_TULIS']=$pub;
		$data['REKOMENDASI']=$reko;
		$data['DISERTASI']=$prop;
		$data['TPA']=$tpa;
		$data['MOTIVASI']=$motiv;
		
		if(strlen($this->input->post('indo')>0))
		{
			$data['INDO']=$indo;
		}

		if($ikla >= $toefl)
			{
				$arab['3']=$ikla;
				$arab['4']="ARAB";
				$data['ARAB']=$arab;
				//$data['jenis_sertifikat'] = array_merge(array_diff($data['jenis_sertifikat'], array("BING")));
			}
		elseif($ikla < $toefl)
		{
				$ing['3']=$toefl;
				$ing['4']="BING";
				$data['BING']=$ing;
				//$data['jenis_sertifikat'] = array_merge(array_diff($data['jenis_sertifikat'], array("ARAB")));
			}
		
		$kirim=array('DATA_DOC'=>$data);
		$hasil=$this->webserv->admisi('input_data/penilaian_dokumen',$kirim);
		if($hasil)
		{
			echo "Berhasil";
		}
		else
		{
			echo "Gagal";
		}
	}

	function cari_nilai_dokumen()
	{
		$penawaran=$this->input->post('kode_penawaran');
		$data['kode_jalur']=substr($penawaran, 0,3);
		$data['tahun']=$this->input->post('tahun');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$kirim=array('CARI_MHS'=>$data);
		$hasil['dt_sertifikat']=$this->webserv->admisi('input_data/detail_sertifikat',$kirim);
		$hasil['bobot']=$this->webserv->admisi('input_data/data_normalisasi_dokumen',array());

		$isi="";
		switch (substr($penawaran,0,1)) {
			case '1':
				$isi="cari_dokumen_s1";
				break;
			case '2':
				$isi="cari_dokumen_s2";
				break;
			case '3':
				$isi="cari_dokumen_s2";
				break;
			
		}
		$hasil['data_mhs']=$this->webserv->admisi('input_data/'.$isi,$kirim);
		$hasil['jalur']=substr($penawaran,0,1);
		$hasil['normal_dokumen'] = $this->webserv->admisi('input_data/data_normalisasi_dokumen',array());
		$hasil['nilai'] = $this->webserv->admisi('input_data/data_nilai_portofolio',array());
		$hasil['kode_penawaran']=$penawaran;
		if($hasil)
		{
			$this->load->view('v_table/penilaian_dokumen_mhs',$hasil);//
			
		}

	}

	function cari_nilai_porto()
	{
		$penawaran=$this->input->post('kode_penawaran');
		$data['kode_penawaran']=substr($penawaran, 0,3);
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_jalur']=substr($penawaran, 0,3);
		$data['tahun']=$this->input->post('tahun');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$kirim=array('CARI_MHS'=>$data);
		$hasil['data_nilai']=$this->webserv->admisi('input_data/data_nilai_portofolio_mhs',$kirim);
		if($hasil)
		{
			switch (substr($data['kode_penawaran'],0,1)) {
			case '1':
				$isi="cari_dokumen_s1";
				break;
			case '2':
				$isi="cari_dokumen_s2";
				break;
			case '3':
				$isi="cari_dokumen_s2";
				break;
			
		}
			$hasil['data_mhs']=$this->webserv->admisi('input_data/'.$isi,$kirim);
			$this->load->view('v_table/view_table_nilai_portofolio',$hasil);
			
		}
		
	}
	

	function rekap_penilaian_portofolio()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Rekap Penilaian Portofolio', ' ');
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		
		$data['content']="form_data_nilai_portofolio";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function dokumen()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Dokumen Pendaftar', ' ');
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		
		$data['content']="form_dokumen_mhs";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	
	}

	function lihat_mhs_dif()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['id_kesehatan']=$this->input->post('id_kesehatan');
		$kirim=array('DATA'=>$data);
		$hasil=$this->webserv->admisi('input_data/lihat_mhs_dif',$kirim);
		if(!is_null($hasil))
		{
			$num=0;
			echo "<table class='table table-bordered'>";
			echo "<thead>";
			echo "<tr>";
				echo "<td>";
				echo "NO";
				echo "</td>";
				echo "<td>";
				echo "NOMOR / NAMA";
				echo "</td>";
				echo "<td>";
				echo "HP";
				echo "</td>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			foreach ($hasil as $h) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo "<strong>".$h->nomor_pendaftar."</strong>";
				echo "<br>";
				echo $h->nama_lengkap;
				echo "</td>";
				echo "<td>";
				echo $h->nohp;
				echo "</td>";
			echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
		}

	}

	function cari_difable()
	{
		$data['jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$data['jalur'].$data['gelombang'];
		$kirim=array('CARI_MHS'=>$data);
		$hasil['data_mhs']=$this->webserv->admisi('input_data/cari_berdasar_difable',$kirim);
		if($hasil)
		{
			$this->load->view('v_table/tabel_jml_mhs_difable',$hasil);//
			
		}
	}

	function cari_prodi()
	{
		$data['kode_jalur']=substr($this->input->post('kode_jalur'),0,3);
		$data['tahun']=$this->input->post('tahun');
		$kirim=array('DETAIL_PRODI'=>$data);
		$hasil=$this->webserv->admisi('input_data/detail_penawaran_prodi2',$kirim);
		if($hasil)
		{
			
			echo "<select name='prodi' id='prodi' style='width:200px;' class='form-control input-sm' onchange='id_prodi=this.value'>";
			echo "<option value=''> Pilih Prodi </option>";	
				foreach ($hasil as $p) {
					echo "<option value='".$p->id_prodi."'>".$p->nama_prodi."</option>";	
						
								}				
			echo "</select>";

		}
	}

	function prodi_kelas()
	{
		$data['kode_penawaran']=substr($this->input->post('kode_penawaran'),0,3);
		$data['tahun']=$this->input->post('tahun');
		$data['id_kelas']=$this->input->post('kelas');
		$kirim=array('DETAIL_PRODI'=>$data);
		$hasil=$this->webserv->admisi('input_data/yudisium_prodi',$kirim);
		
		if($hasil)
		{
			
			echo "<select name='prodi' id='prodi' style='width:200px;' class='form-control input-sm' onchange='id_prodi=this.value'>";
			echo "<option value=''> Pilih Prodi </option>";	
				foreach ($hasil as $p) {
					echo "<option value='".$p->id_prodi."'>".$p->nama_prodi."</option>";	
						
								}				
			echo "</select>";

		}


	}

	function bobot_prodi()
	{
		$data['kode_jalur']=substr($this->input->post('kode_jalur'),0,3);
		$data['tahun']=$this->input->post('tahun');
		$kirim=array('DETAIL_PRODI'=>$data);
		$hasil=$this->webserv->admisi('input_data/detail_penawaran_prodi2',$kirim);
		if($hasil)
		{
			
			echo "<select name='prodi' id='prodi' style='width:200px;' class='form-control input-sm' onchange='id_prodi=this.value'>";
			echo "<option value=''> Pilih Prodi </option>";	
				foreach ($hasil as $p) {
					echo "<option value='".$p->id_prodi."'>".$p->nama_prodi."</option>";	
						
								}				
			echo "</select>";

		}
	}

	function berdasar_prodi()
	{
		$data['jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_jalur']=$data['jalur'].$data['gelombang'];
		$kirim=array('CARI_MHS'=>$data);
		$hasil['data_prodi']=$this->webserv->admisi('input_data/cari_berdasar_prodi',$kirim);
		if($hasil)
		{
			$this->load->view('v_table/tabel_jml_mhs_prodi',$hasil);//
			
		}
	}

	function berdasar_jalur()
	{
		$data['jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_jalur']=$data['jalur'].$data['gelombang'];
		$kirim=array('CARI_MHS'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_berdasar_jalur',$kirim);
		if($hasil)
		{
			$num=0;
			echo "Jumlah :".count($hasil);
			echo "<br><br>";
			echo "<table class='table table-bordered'>";
			echo "<thead><tr>";
			echo "<td>";
			echo "No";
			echo "</td>";
			echo "<td>";
			echo "Nomor Pendaftar";
			echo "</td>";
			echo "<td>";
			echo "Nomor Peserta";
			echo "</td>";
			echo "<td>";
			echo "Nama Lengkap";
			echo "</td>";
			echo "</tr></thead>";
			echo "<tbody>";
			foreach ($hasil as $mhs) {
				echo "<tr>";
			echo "<td>";
			echo $num+=1;
			echo "</td>";
			echo "<td>";
			echo $mhs->nomor_pendaftar;
			echo "</td>";
			echo "<td>";
			echo $mhs->nomor_peserta;
			echo "</td>";
			echo "<td>";
			if(strlen($mhs->nama_lengkap)<3 )
			{
				echo "Belum diisi";
			}
			else
			{
				echo $mhs->nama_lengkap;
			}
			
			echo "</td>";
			echo "</tr>";
			}
			echo "</tbody>";
		
		echo "</table>";
			
		}
	}

	function belum_piljur()
	{
		$data['kode_penawaran']=$this->input->post('nama');
		$data['key']=$this->input->post('index');
		$kirim=array('CARI_DATA'=>$data);
		switch ($data['key']) {
			case '1':
				$hasil=$this->webserv->admisi('input_data/mhs_blm_piljur',$kirim);
				break;
			case '2':
				$hasil=$this->webserv->admisi('input_data/mhs_blm_verifikasi',$kirim);
				break;
			case '3':
				$hasil=$this->webserv->admisi('input_data/mhs_sdh_semua',$kirim);
				break;
		}
		
		if($hasil)
		{
			$num=0;
			echo "<table class='table table-bordered table-hover'>";
			echo "<thead><tr>";
			echo "<td>";
			echo "No";
			echo "</td>";
			echo "<td>";
			echo "Nomor Pendaftar";
			echo "</td>";
			echo "<td>";
			echo "Nama Lengkap";
			echo "</td>";
			echo "<td>";
			echo "HP";
			echo "</td>";
			echo "<td>";
			echo "VERIFIKASI";
			echo "</td>";
			echo "</tr></thead>";
			echo "<tbody>";
			foreach ($hasil as $mhs) {
				echo "<tr>";
			echo "<td>";
			echo $num+=1;
			echo "</td>";
			echo "<td>";
			echo $mhs->nomor_pendaftar;
			echo "</td>";
			echo "<td>";
			echo $mhs->nama_lengkap;
			echo "</td>";
			echo "<td>";
			echo $mhs->nohp;
			echo "</td>";
			echo "<td>";
			echo date_format(date_create($mhs->tanggal),'d-m-Y');
			echo "</td>";
			echo "</tr>";
			}
			echo "</tbody>";
		
		echo "</table>";
		}
	}

	function nomor_duplikat()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Data Nomor Ganda', ' ');	
		$data['jalur']=$this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_nomor_ganda";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function cari_duplikat()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		$kirim=array('CARI'=>$data);
		$hasil['duplikat']=$this->webserv->admisi('input_data/cari_nomor_duplikat',$kirim);

		if($hasil)
		{
			$this->load->view('v_table/tabel_nomor_duplikat',$hasil);
			
		}

	}

	function cari_statistik()
	{
	
		$data['jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_jalur']=$data['jalur'].$data['gelombang'];
		$cari=array('CARI_DATA'=>$data);
		$hasil['data_mhs']=$this->webserv->admisi('input_data/statistik',$cari);
		
		if($hasil)
		{
			$kode_bayar="";
			$tgl_mulai="";
			$tgl_selesai="";
			$data['kode_penawaran']=$data['kode_jalur'].$data['tahun'];
			$kirim=array('CARI_DATA'=>$data);
			$penawaran=$this->webserv->admisi('input_data/cari_penawaran_jalur',$kirim);
			if($penawaran)
			{
				foreach ($penawaran as $dapen);

					$kode_bayar=$dapen->kode_bayar;
					$tgl_mulai=date_format(date_create($dapen->tanggal_mulai_daftar),'d-m-Y');
					$tgl_selesai=date_format(date_create($dapen->tanggal_selesai_daftar),'d-m-Y');
					$hasil['jumlah_bayar']=$this->jumlah_bayar($tgl_mulai,$tgl_selesai,$kode_bayar);
			}
		
			$this->load->view('v_table/statistik',$hasil);
			
		}
		

	}

	function rekap_peserta()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Rekap Peserta', ' ');
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		$data['data_jenjang'] = $this->webserv->admisi('input_data/data_jenjang',array());
	
		$data['content']="form_rekap_mhs";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	
function update_nomor_peserta()
{

	$data['id_ruang']=$this->input->post('id_ruang');
	$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
	$data['nomor_peserta']=$this->input->post('nomor_peserta');
	$data['kode_jadwal']=$this->input->post('kode_jadwal');
	$kirim=array('UPDATE_NOMOR_PESERTA'=>$data);
	
	$hasil=$this->webserv->admisi('input_data/update_nomor_peserta',$kirim);
	if($hasil)
	{
		echo "Nomor Peserta BERHASIL diupdate";

	}
	else
	{
		echo "Nomor Peserta GAGAL diupdate";
	}

}

	function ganti_nomor_peserta()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['id_ruang']=$this->input->post('id_ruang');
		$data['num']=$this->input->post('num');
		$kirim=array('CEK_NOMOR'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_nomor_peserta',$kirim);
		if($hasil)
		{
			if(!is_null($hasil))
			{	
				echo '<select class="form-control" id="nomor'.$data['num'].'">';	
				foreach ($hasil as $hasno) {
					echo "<option value='".$hasno->nomor_peserta."'>".$hasno->nomor_peserta."</option>";
				}
				echo "</select>";
				
			}

		}
		
	}

	function cari_nomor_peserta_edit()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['id_ruang']=$this->input->post('id_ruang');
		$kirim=array('CEK_NOMOR'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_nomor_peserta',$kirim);
		if($hasil)
		{
			if(!is_null($hasil))
			{	
				echo "<select class='form-control input-md' style='width:100px;' onchange='nomor_pes=this.value' id='nomor<?php echo $num; ?>'><option value=''> Nomor Peserta </option>";
					
				foreach ($hasil as $hasno) {
					echo "<option value='".$hasno->nomor_peserta."'>".$hasno->nomor_peserta; 
					echo "</option>";
				}
				echo "</select>";
				
			}

		}
		
	}

	function cari_ruang_edit()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array('GRUP_JADWAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_jadwal_ruang',$kirim);
		if($hasil)
		{
			if(!is_null($hasil))
			{	
				echo "<select class='form-control input-md' style='width:100px;'  id='ruang<?php echo $num; ?>' isi='<?php echo $num; ?>' onchange='cari_nomor(this)'><option value=''> Ruang </option>";
					
				foreach ($hasil as $hasjad) {
					echo "<option value='".$hasjad->id_ruang."'>".$hasjad->nama_ruang; 
					if($hasjad->khusus=='1')
						echo " (Ruang Khusus)";
					echo "</option>";
				}
				echo "</select>";
			}
		}
	}

	function batal_verifikasi()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('BATAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/batal_verifikasi',$kirim);
		if($hasil)
		{
			echo "Verifikasi telah dibatalkan. silakan hubungi mahasiswa untuk verifikasi ulang!";
		}
		else
		{
			echo "GAGAL membatalkan verifikasi!";
		}
	}
	function cari_mahasiswa()
	{
		
		$data['ktg']=$this->input->post('pencarian');
		switch ($data['ktg']) {
			case 'warga_negara':
									$data['value']=$this->input->post('negara');
									if($this->input->post('key')=='1')
									{
									$data['key']='1';
									}
									else
									{
									$data['key']='0';
									}
									$cari=array('CARI_MHS'=>$data);
									$hasil['data_mhs']=$this->webserv->admisi('input_data/cari_mahasiswa',$cari);
									$hasil['data_jadwal']=array();
				break;
			case 'kode_penawaran':

									$data['jalur']=$this->input->post('dicari');
									$data['gelombang']=$this->input->post('gelombang');
									$data['value']=$data['jalur'].$data['gelombang'];
									$kode_pen['kode_penawaran']=$data['value'];
									$kode_pen['tahun']=$this->input->post('tahun');
									$cari_jadwal=array('CARI_JADWAL'=>$kode_pen);
									$cari_saja=array('CARI_MHS'=>$kode_pen);
									$hasil['data_mhs']=$this->webserv->admisi('input_data/cari_negara_mahasiswa',$cari_saja);
									$hasil['data_jadwal']=$this->webserv->admisi('input_data/cari_jadwal_ujian_penawaran',$cari_jadwal);
								
				break;
			case 'nomor_pendaftar':
									$data['value']=$this->input->post('dicari');
									$cari=array('CARI_MHS'=>$data);
									$hasil['data_mhs']=$this->webserv->admisi('input_data/cari_mahasiswa',$cari);

				break;
			case 'nomor_peserta':
			$data['value']=$this->input->post('dicari');
									$cari=array('CARI_MHS'=>$data);
									$hasil['data_mhs']=$this->webserv->admisi('input_data/cari_mahasiswa',$cari);
				break;
			case 'nama_lengkap':
									$data['value']=$this->input->post('dicari');
									$cari=array('CARI_MHS'=>$data);
									$hasil['data_mhs']=$this->webserv->admisi('input_data/cari_mahasiswa',$cari);
									
				break;
			
		}
		$this->load->view('v_table/view_table_mhs',$hasil);
	}

	function data_maba_all()
	{

		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Peserta PMB', ' ');
		$data['jalur'] = $this->webserv->admisi('input_data/jalur',array());
		$data['data_negara'] = $this->webserv->admisi('data_form/negara',array());
		$data['content']="form_nomor_peserta";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');

	}

	function update_ruang()
	{
		$data['id_ruang']=$this->input->post('id_ruang');
		$data['nama_ruang']=$this->input->post('nama_ruang');
		$data['status_ruang']=$this->input->post('status');

		$kirim=array('UPDATE_RUANG'=>$data);
		
		$result=$this->webserv->admisi('input_data/update_ruang',$kirim);
		if($result)
		{
			
			$this->after_tranc_ruang();

		}
		else
		{
			echo "Update gagal. Refresh Halaman!";
		}
		
	}

	function update_status_ruang_ujian()
	{
		$data['id_ruang']=$this->input->post('id_ruang');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['status_ruang']=$this->input->post('status');
		$data['jenis']=$this->input->post('jenis');
		$data['kapasitas']=$this->input->post('kapasitas');
		$data['no_ujian_awal']=$this->input->post('awal');
		$data['no_ujian_akhir']=$this->input->post('akhir');
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['nomor_peserta']=$this->buat_nomor($data['tahun'],$data['kode_jalur'],$data['gelombang']);
		$kirim=array('UPDATE_RUANG'=>$data);
		
		$result=$this->webserv->admisi('input_data/reset_ruang_ujian',$kirim);
		if($result)
		{
			$kir=array('INSERT_DATA'=>$data);
			$this->webserv->admisi('input_data/buat_nomor',$kir);
			$X=array('GRUP_JADWAL'=>$data);
			$hasil['data_ruang_ujian'] = $this->webserv->admisi('input_data/cari_jadwal_ruang',$X);
			
			$hasil['data_jadwal'] = $this->webserv->admisi('input_data/data_jadwal',array());
			echo "<div class='bs-callout bs-callout-success'>RUANG UJIAN DAN NOMOR BERHASIL DIUPDATE</div>";
			$this->load->view('v_table/view_table_ruang_ujian',$hasil);
		}
		else
		{
			$X=array('GRUP_JADWAL'=>$data);
			$hasil['data_ruang_ujian'] = $this->webserv->admisi('input_data/cari_jadwal_ruang',$X);
			
			$hasil['data_jadwal'] = $this->webserv->admisi('input_data/data_jadwal',array());
			echo "<div class='bs-callout bs-callout-error'>RUANG UJIAN DAN NOMOR GAGAL DIUPDATE</div>";
			$this->load->view('v_table/view_table_ruang_ujian',$hasil);
		}
		
	
	}

	function update_status_ruang_ujian2()
	{
		$data['id_ruang']=$this->input->post('id_ruang');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['status_ruang']=$this->input->post('status');
		$data['jenis']=$this->input->post('jenis');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array('UPDATE_RUANG'=>$data);
		
		$result=$this->webserv->admisi('input_data/update_status_ruang_ujian',$kirim);
		if($result)
		{
			echo "<div class='bs-callout bs-callout-success'>STATUS RUANG BERHASIL DIUPDATE</div>";
			$X=array('GRUP_JADWAL'=>$data);
			$hasil['data_ruang_ujian'] = $this->webserv->admisi('input_data/cari_jadwal_ruang',$X);
			
			$hasil['data_jadwal'] = $this->webserv->admisi('input_data/jadwal_ujian',array());
			$this->load->view('v_table/view_table_ruang_ujian',$hasil);
		}
		else
		{
			echo "<div class='bs-callout bs-callout-error'>STATUS RUANG GAGAL DIUPDATE</div>";
			$X=array('GRUP_JADWAL'=>$data);
			$hasil['data_ruang_ujian'] = $this->webserv->admisi('input_data/cari_jadwal_ruang',$X);
			
			$hasil['data_jadwal'] = $this->webserv->admisi('input_data/jadwal_ujian',array());
			$this->load->view('v_table/view_table_ruang_ujian',$hasil);
		}
	
	}

	function update_kuota_penawaran()
	{
		$tanggal_mulai_daftar=$this->input->post('tanggal_mulai_daftar');
		$jam_mulai_daftar=$this->input->post('jam_daftar1');
		$tanggal_selesai_daftar=$this->input->post('tanggal_selesai_daftar');
		$jam_selesai_daftar=$this->input->post('jam_daftar2');
		$tanggal_mulai_bayar=$this->input->post('tanggal_mulai_bayar');
		$jam_mulai_bayar=$this->input->post('jam_bayar1');
		$tanggal_selesai_bayar=$this->input->post('tanggal_selesai_bayar');
		$jam_selesai_bayar=$this->input->post('jam_bayar2');

		$tgl_mul_daf=$tanggal_mulai_daftar.' '.$jam_mulai_daftar;
		$tgl_sel_daf=$tanggal_selesai_daftar.' '.$jam_selesai_daftar;
		$tgl_mul_bay=$tanggal_mulai_bayar.' '.$jam_mulai_bayar;
		$tgl_sel_bay=$tanggal_selesai_bayar.' '.$jam_selesai_bayar;

		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['kuota']=$this->input->post('kuota');
		$data['kode_bayar']=$this->input->post('kode_bayar');
		$data['tanggal_mulai_daftar']=$tgl_mul_daf;
		$data['tanggal_selesai_daftar']=$tgl_sel_daf;
		$data['tanggal_mulai_bayar']=$tgl_mul_bay;
		$data['tanggal_selesai_bayar']=$tgl_sel_bay;


		
		$insert_data=array('UPDATE_KUOTA'=>$data);
		
		$hasil=$this->webserv->admisi('input_data/update_kuota_penawaran',$insert_data);
		if($hasil)
		{

			$data2['data_jalur_masuk'] = $this->webserv->admisi('input_data/data_penawaran_jalur_cek',array());
			$this->load->view("v_table/view_table_penawaran",$data2);
			
		}

	}

	function hapus_detail_jadwal()
	{
		$data['id_detail']=$this->input->post('id_detail');
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['nama_jalur']=$this->input->post('nama_jalur');
		$kirim=array('HAPUS_DETAIL_JADWAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_detail_jadwal',$kirim);
		if($hasil)
		{
			$this->lihat_detail_jadwal_hapus($data['kode_jadwal'],$data['nama_jalur']);
		}
		else
		{
			$this->lihat_detail_jadwal_hapus($data['kode_jadwal'],$data['nama_jalur']);		
		}
		
	}

	function lihat_detail_jadwal_hapus($jd,$jal)
	{
		$data['kode_jadwal']=$jd;
		$kirim=array('DETAIL_JADWAL'=>$data);
		$hasil['nama_jalur']=$jal;

		$hasil['detail_jadwal']=$this->webserv->admisi('input_data/lihat_detail_jadwal',$kirim);
		if($hasil)
		{
			$this->load->view('v_table/view_detail_jadwal',$hasil);
		}
		
	}

	function lihat_detail_jadwal()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$kirim=array('DETAIL_JADWAL'=>$data);
		$hasil['nama_jalur']=$this->input->post('nama_jalur');
		$hasil['detail_jadwal']=$this->webserv->admisi('input_data/lihat_detail_jadwal',$kirim);
		if($hasil)
		{
			$hasil['data_tes']=$this->webserv->admisi('input_data/nama_tes',array());
			$this->load->view('v_table/view_detail_jadwal',$hasil);
		}
		
	}

	function update_detail_jadwal()
	{
		$data['tes']=$this->input->post('tes');
		$data['tgl']=str_replace("/", "-", $this->input->post('tgl'));
		$data['mulai']=$this->input->post('mulai');
		$data['selesai']=$this->input->post('selesai');
		$data['id_detail']=$this->input->post('id_detail');
		$kirim=array('JADWAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/update_detail_jadwal',$kirim);
		if($hasil)
		{
			echo "<div class='bs-callout bs-callout-success'>DETAIL JADWAL BERHASIL DIUPDATE</div>";
		}
		else{
			echo "<div class='bs-callout bs-callout-error'>DETAIL JADWAL GAGAL DIUPDATE</div>";
		
		}

	}

	function insert_detail_jadwal()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['tanggal']=$this->input->post('dt');
		$data['nama_jalur']=$this->input->post('nama_jalur');
		$data['jam_mulai']=$this->input->post('tm1');
		$data['jam_selesai']=$this->input->post('tm2');
		$data['id_tes']=$this->input->post('tes');
		$data['total']=count($this->input->post('dt'));
		$insert_data=array('KASIH_DETAIL'=>$data);
		$hasil=$this->webserv->admisi('input_data/tambah_detail_jadwal',$insert_data);
		if($hasil)
		{
			$this->lihat_detail_jadwal_hapus($data['kode_jadwal'],$data['nama_jalur']);
		}
		else
		{
			$this->lihat_detail_jadwal_hapus($data['kode_jadwal'],$data['nama_jalur']);
		}

	}

	function jadwal_edit()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$kirim=array('EDIT_JADWAL'=>$data);

		$hasil['jadwal_edit']=$this->webserv->admisi('input_data/edit_jadwal',$kirim);
		$this->load->view('form_jadwal_ujian',$hasil);
	}

	function rekap_jalur_jk()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		$kirim=array('REKAP'=>$data);
		$hasil['mhs_jk']=$this->webserv->admisi('input_data/rekap_jalur_jk',$kirim);
		
		$this->load->view('v_table/rekap_per_jk',$hasil);
		
		
	}

	function rekap_jalur_kab()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		$kirim=array('REKAP'=>$data);
		$hasil['mhs_kab']=$this->webserv->admisi('input_data/rekap_jalur_perkabupaten',$kirim);
		
			$this->load->view('v_table/rekap_per_kabupaten',$hasil);
		
		
	}

	function rekap_jalur_sekolah()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];
		$kirim=array('REKAP'=>$data);
		$hasil['data_sek']=$this->webserv->admisi('input_data/rekap_jalur_sekolah',$kirim);
		
			$this->load->view('v_table/tabel_rekap_peserta_sekolah',$hasil);
			
	}

	function login_lagi()
	{
		$data['nomor_pendaftar']=$this->input->post("nomor_pendaftar");
		$kirim=array('OKE'=>$data);
		$hasil=$this->webserv->admisi('input_data/login_lagi',$kirim);
		if($hasil)
		{
			echo "<div class='bs-callout bs-callout-success'>PROSES BERHASIL SILAKAN HUBUNGI PENDAFTAR UNTUK ISI DATA LAGI</div>";
		}
		else{
			echo "<div class='bs-callout bs-callout-error'>TERJADI KEGAGALAN PROSES</div>";
		
		}	
	}

	function selidiki()
	{
		$datax['nomor_pendaftar']=$this->input->post("nomor_pendaftar");
		$kirim=array('CEK'=>$datax);
		$data['data_diri']=$this->webserv->admisi('input_data/cek_data_diri',$kirim);
		$data['jalur']=$this->webserv->admisi('input_data/cek_jalur',$kirim);
		$data['data_pendidikan']=$this->webserv->admisi('input_data/cek_pendidikan',$kirim);
		$data['jadwal']=$this->webserv->admisi('input_data/cek_jadwal',$kirim);
		$data['pilprod']=$this->webserv->admisi('input_data/cek_pilprod',$kirim);
		$data['kesehatan']=$this->webserv->admisi('input_data/cek_kesehatan',$kirim);
		$data['nomor']=$this->webserv->admisi('input_data/cek_nomor',$kirim);
		$this->load->view('v_table/tabel_cek_salah',$data);
	}

	function masalah()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Masalah Cetak Kartu', ' ');	
		$data['content']="form_masalah_kartu";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function rekap_peserta_sekolah()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Peserta Sekolah', ' ');
		$data['jalur']=$this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_rekap_sekolah";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function rekap_peserta_jk()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Peserta Gender', ' ');
		$data['jalur']=$this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_rekap_jenis_kelamin";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function rekap_peserta_kabupaten()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Peserta Perkabupaten', ' ');
		$data['jalur']=$this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_rekap_perkabupaten";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function form_detail_jadwal()
	{
		
		$data['data_jadwal'] = $this->webserv->admisi('input_data/jadwal_ujian',array());
		
		$data['content']="form_detail_jadwal";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function cari_rekap_kelas()
	{
		$data['jalur']=$this->input->post('kode_jalur');
		$data['tahun']=$this->input->post('tahun');
		$data['gelombang']=$this->input->post('gelombang');
		$data['kode_penawaran']=$data['jalur'].$data['gelombang'];
		$kirim=array('CARI_KELAS'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_rekap_kelas',$kirim);
		if($hasil)
		{
			$num=0;
			echo "<table class='table table-bordered table-hover'>";
			echo "<thead>";
			echo "<tr>";
			echo "<td>";
			echo "NO";
			echo "</td>";
			echo "<td>";
			echo "KELAS";
			echo "</td>";
			echo "<td>";
			echo "JUMLAH PESERTA";
			echo "</td>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			foreach ($hasil as $kls) 
			{
		
					echo "<tr>";
					echo "<td>";
					echo $num+=1;
					echo "</td>";
					echo "<td>";
					echo strtoupper($kls->nama_kelas);
					echo "</td>";
					echo "<td>";
					echo "<strong>".$kls->jml."</strong>";
					echo "</td>";
					echo "</tr>";
				
			}
			echo "</tbody>";
			echo "</table>";
		}
		else
		{
			echo "<table class='table table-bordered table-hover'>";
			echo "<thead>";
			echo "<tr>";
			echo "<td>";
			echo "NO";
			echo "</td>";
			echo "<td>";
			echo "KELAS";
			echo "</td>";
			echo "<td>";
			echo "JUMLAH PESERTA";
			echo "</td>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			
					echo "<tr>";
					echo "<td colspan='3' align='center'>";
					echo "Data TIDAK ditemukan";
					echo "</td>";
					echo "</tr>";	
				
			
			echo "</tbody>";
			echo "</table>";
		}

	}


	function cari_kelas()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$insert_data=array('CARI_KELAS'=>$data);
		$hasil=$this->webserv->admisi('input_data/kelas',$insert_data);
		if($hasil)
		{
			$item="<select name='kelas' id='k' class='form-control input-md' onchange='ambil_data(this)'>";
			$item.="<option value=''>Kelas</option>";
			foreach ($hasil as $kelas) {
				$item.="<option value='".$kelas->id_kelas."'>".$kelas->nama_kelas."</option>";
			}
			$item.="</select>";
			echo $item;
		}
	}

	function insert_sarat_jalur()
	{
		$data['kode_prasyarat']=$this->input->post('sarat');
		$data['skor']=array_slice(array_filter($this->input->post('skor')),0);
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['jumlah']=count($data['skor']);
		$insert_data=array('SARAT_JALUR'=>$data);

		$hasil=$this->webserv->admisi('input_data/insert_sarat_jalur',$insert_data);
		if($hasil)
		{
			echo "Berhasil";
		}
		

	}

	function hapus_prasyarat_jalur()
	{
		$data['kode_prasyarat_jalur']=$this->input->post('kode_prasyarat_jalur');
		$kirim=array('HAPUS'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_prasyarat_jalur',$kirim);
		if($hasil)
		{
			echo "Berhasil";
		}
		else
		{
			echo "gagal";
		}
	}

	function lihat_prasyarat_jalur()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kode=array('LIHAT_SARAT'=>$data);
		$data['prasyarat']=$this->webserv->admisi('input_data/lihat_prasyarat_jalur',$kode);
		$this->load->view('v_table/view_tb_pras_jalur',$data);
	}

	function hapus_prasyarat_jurusan()
	{
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['id_jurusan_sekolah']=$this->input->post('id_jurusan_sekolah');
		$kirim=array('HAPUS_SARJUR'=>$data);
		$hasil=$this->webserv->admisi('input_data/hapus_prasyarat_jurusan',$kirim);
		if ($hasil) {
			echo "Berhasil";

		}
		else
		{
			echo "Gagal";
		}
	

	}

	function insert_prasyarat_jurusan()
	{
		$data['id_prodi']=$this->input->post('id_prodi');
		$data['id_jurusan_sekolah']=$this->input->post('id_jurusan_sekolah');
		$data['kode_minat']=$this->input->post('kode_minat');
		$kirim=array('SIMPAN_SARJUR'=>$data);
		$hasil=$this->webserv->admisi('input_data/simpan_prasyarat_jurusan',$kirim);
		if ($hasil) {
			echo "Berhasil";
		}
		else
		{
			echo "Gagal";
		}
	}

	function cari_prodi_jur()
	{
		$data['id_jenjang']=$this->input->post('id_jenjang');
		$data['kode_minat']=$this->input->post('kode_minat');

		$kirim=array('JENJANG_PRODI'=>$data);
		
		$hasil['data_prodi']=$this->webserv->admisi('input_data/data_jenjang_penawaran_prodi',$kirim);
		if($hasil)
		{
			$hasil['data_jurusan'] = $this->webserv->admisi('input_data/data_jurusan_sekolah',array());
			$hasil['data_sarat'] = $this->webserv->admisi('input_data/data_prasyarat_jurusan',array());
			
			$this->load->view('v_table/view_prodi_jurusan',$hasil);
		}
	}
	function prasyarat()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Setting Prasyarat Pendaftaran', ' ');	
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/data_penawaran_jalur_all',array());
		$data['data_prasyarat'] = $this->webserv->admisi('input_data/data_master_prasyarat',array());
		$data['data_minat'] = $this->webserv->admisi('input_data/minat',array());
		$data['data_jenjang'] = $this->webserv->admisi('input_data/data_jenjang',array());
		
		$data['content']="form_prasyarat";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function update_bayar()
	{
		$data['kode_bayar1']=$this->input->post('kode_bayar1');
		$data['kode_bayar2']=$this->input->post('kode_bayar2');
		$data['nama_pembayaran']=$this->input->post('nama_pembayaran');

		$kirim_data=array('UPDATE_BAYAR'=>$data);
		
		$hasil=$this->webserv->admisi('input_data/update_kode_bayar',$kirim_data);
		if($hasil)
		{
			$this->after_tranc_kode_pembayaran();

		}
		else
		{
			echo "Gagal!";
		}

	}
/*
	function load_data_mhs()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$cari=array('DATA_MHS'=>$data);
		$hasil['data_presensi']=$this->webserv->admisi('input_data/data_mhs',$cari);
		if($hasil)
		{
			$this->load->view('v_table/daftar_mhs',$hasil);
		}
		else
		{
			echo "gagal";
		}
	}
	
	function daftar_mahasiswa()
	{
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		$data['ruang_ujian'] = $this->webserv->admisi('input_data/ruang_ujian',array());
		
		$data['content']="form_data_mhs";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');	
	}
*/

	function cari_jadwal_ujian()
	{
		$data['kode_jalur']=substr($this->input->post('kode_jalur'),0,3);
		$data['tahun']=$this->input->post('tahun');
		$kirim=array('CARI_JADWAL'=>$data);
		$hasil=$this->webserv->admisi('input_data/cari_jadwal_ujian',$kirim);
		if($hasil)
		{
			
			echo "<td id='td-jadwal'><select name='kode_jadwal' style='width:300px;' id='jadwal' class='form-control input-md' onchange='jadwal=this.value; cari_ruang();'>";
				echo "<option value=''>Pilih Jadwal Ujian</option>";
				if(!is_null($hasil))
				{
					$temp=0;
					foreach ($hasil as $has) {
						if($temp != $has->kode_jadwal)
						{
							echo "<option value='".$has->kode_jadwal."'>".$this->tanggal_hari(date_format(date_create($has->tanggal),'d-m-Y'))."</option>";
						$temp=$has->kode_jadwal;
						}
					}
				}
			echo "</select></td>";
			

		}
		
			
	}

	function cari_data_keluarga()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array("KELUARGA"=>$data);
		$hasil['data_ayah']=$this->webserv->admisi('input_data/data_ayah',$kirim);
		$hasil['data_ibu']=$this->webserv->admisi('input_data/data_ibu',$kirim);
		if ($hasil) {
			
			if(!is_null($hasil['data_ayah']))
			{
			
			echo "<table class='table table-bordered table-hover'>";
			echo "<tbody>";
				foreach ($hasil['data_ayah'] as $ayah);
					echo "<tr>";
					echo "<td>";
					echo "Nama Lengkap Ayah";
					echo "</td>";
					echo "<td>";
					echo $ayah->nama_lengkap_ayah;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "Status Ayah";
					echo "</td>";
					echo "<td>";
					echo $ayah->nama_status;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "Pekerjaan Ayah";
					echo "</td>";
					echo "<td>";
					echo $ayah->nama_pekerjaan;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "Gaji Ayah";
					echo "</td>";
					echo "<td>";
					echo $ayah->gaji_ayah;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "Golongan Ayah";
					echo "</td>";
					echo "<td>";
					echo $ayah->golongan_ayah;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "Agama Ayah";
					echo "</td>";
					echo "<td>";
					echo $ayah->nama_agama;
					echo "</td>";
					echo "</tr>";
			
			}
			if(!is_null($hasil['data_ibu']))
			{
				foreach ($hasil['data_ibu'] as $ibu) {
					echo "<tr>";
					echo "<td>";
					echo "Nama Lengkap Ibu";
					echo "</td>";
					echo "<td>";
					echo $ibu->nama_lengkap_ibu;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "Status Ibu";
					echo "</td>";
					echo "<td>";
					echo $ibu->nama_status;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "Pekerjaan Ibu";
					echo "</td>";
					echo "<td>";
					echo $ibu->nama_pekerjaan;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "Gaji Ibu";
					echo "</td>";
					echo "<td>";
					echo $ibu->gaji_ibu;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "Golongan Ibu";
					echo "</td>";
					echo "<td>";
					echo $ibu->golongan_ibu;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>";
					echo "Agama Ibu";
					echo "</td>";
					echo "<td>";
					echo $ibu->nama_agama;
					echo "</td>";
					echo "</tr>";
				}
			}
			echo "</tbody>";
			echo "</table>";
		
		}

	}

	
	function presensi_mahasiswa()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Data Album Presensi Mahasiswa', ' ');
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		
		$data['content']="form_presensi";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function load_presensi()
	{
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$data['gelombang']=$this->input->post('gelombang');
		$data['tahun']=$this->input->post('tahun');
		$data['kode_penawaran']=$data['kode_jalur'].$data['gelombang'].$data['tahun'];//jalur dan gelombang
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$cari=array('ALBUM'=>$data);
		$hasil['data_presensi']=$this->webserv->admisi('input_data/album',$cari);
		if($hasil)
		{
			$this->load->view('v_table/presensi_mhs',$hasil);

		}
		
		
	}

	function upload_ruang_ujian()
	{	
		$dataxl=array();
		$gedung['id_gedung']=$this->input->post('id_gedung_UP');
		$this->Excel_reader->read($this->input->post('xlPath'));
		$data = $this->excel_reader->sheets[0] ;

		for($i=0; $i<count($data); $i++)
		{
						if($data['cells'][$i][1] == '') break;
                            $dataxl[$i-1]['nama_ruang'] = $data['cells'][$i][1];
                            $dataxl[$i-1]['kapasitas_ruang'] = $data['cells'][$i][2];
                    
		}
		print_r($dataxl);
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

	function hapus_penawaran_jurusan()
	{
		$kode_penawaran=$this->input->post('kode_penawaran');
		$kode_prodi=$this->input->post('id_prodi');
		$minat=$this->input->post('kode_minat');
		$kelas=$this->input->post('id_kelas');

		$insert_data=array(
		'kode_penawaran'=>$kode_penawaran,
		'id_prodi'=>$kode_prodi,
		'kode_minat'=>$minat,
		'id_kelas'=>$kelas);

		$data=array('HAPUS_DATA'=>$insert_data);
		
		$hasil=$this->webserv->admisi('input_data/delete_penawaran_prodi',$data);
		if($hasil)
		{
					//$this->session->set_flashdata('message', 'Data berhasil disimpan.');
					//redirect('adminpmb/input_data_c/form_penawaran_jurusan');
			echo "Program Studi dihapus.";

		}
		

	}

	function simpan_penawaran_jurusan()
	{
		$kode_penawaran=$this->input->post('kode_penawaran');
		$kode_prodi=$this->input->post('id_prodi');
		$minat=$this->input->post('kode_minat');
		$kelas=$this->input->post('id_kelas');

		$insert_data=array(
		'kode_penawaran'=>$kode_penawaran,
		'id_prodi'=>$kode_prodi,
		'kode_minat'=>$minat,
		'id_kelas'=>$kelas);

		$data=array('INSERT_DATA'=>$insert_data);

		$hasil=$this->webserv->admisi('input_data/insert_penawaran_prodi',$data);
		if($hasil)
		{
					//$this->session->set_flashdata('message', 'Data berhasil disimpan.');
					//redirect('adminpmb/input_data_c/form_penawaran_jurusan');
			echo "Program Studi ditambahkan.";
		}
	}

	function form_penawaran_jurusan()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Penawaran Jurusan', ' ');	
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		$data['data_minat']=$this->input->post('input_data/minat',array());
		$data['content']="form_penawaran_jurusan";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function cari_data_kesehatan()
	{
		$data['nomor_pendaftar']=$this->input->post('nomor_pendaftar');
		$kirim=array('KESEHATAN'=>$data);
		$hasil['kesehatan']=$this->webserv->admisi('input_data/data_kesehatan',$kirim);
		$hasil['difable']=$this->webserv->admisi('input_data/data_difable',$kirim);
		if($hasil)
		{
			echo "<table class='table table-bordered table-hover'>";
			echo "<thead>";
			echo "<tr>";
			echo "<td>";
			echo "NO";
			echo "</td>";
			echo "<td>";
			echo "JENIS";
			echo "</td>";
			echo "<td>";
			echo "KONDISI";
			echo "</td>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
			$num=0;
			if(!is_null($hasil['kesehatan']))
			{
				foreach ($hasil['kesehatan'] as $kes) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo "Riwayat Penyakit ";
				echo "</td>";
				echo "<td>";
				echo $kes->riwayat_penyakit;
				echo "</td>";
				echo "</tr>";
			}
			}
			
			if(!is_null($hasil['difable']))
			{
				foreach ($hasil['difable'] as $dif) {
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo "Kemampuan Berbeda ";
				echo "</td>";
				echo "<td>";
				echo $kes->kondisi_kesehatan;
				echo "</td>";
				echo "</tr>";
			}	
			}
			
			echo "</tbody>";
			echo "</table>";
		}
	}

	function cek_minat_prodi()
	{
		$data['data_prodi'] = $this->webserv->admisi('input_data/view_prodi',array());
		$data['kesehatan']= $this->webserv->admisi('input_data/data_kemampuan_berbeda',array());
		$penawaran['kode_penawaran']=$this->input->post('kode_penawaran');
		$penawaran['id_kelas']=$this->input->post('id_kelas');
		$insert_data=array('CEK_JURUSAN'=>$penawaran);

		$data['pen_prodi'] = $this->webserv->admisi('input_data/data_penawaran_prodi_jalur',$insert_data);


		if($data)
		{
			$this->load->view('jurusan',$data);
		
		}
	}

	function delete_prasyarat_prodi()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['id_kesehatan']=$this->input->post('id_kesehatan');
		$data['id_prodi']=$this->input->post('id_prodi');

		$kirim=array('DELETE_SAR_PROD'=>$data);
	
		$hasil=$this->webserv->admisi('input_data/delete_sarat_kes',$kirim);
		if($hasil)
		{
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal";
		}


	}

	function simpan_prasyarat_prodi()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['id_kesehatan']=$this->input->post('id_kesehatan');
		$data['id_prodi']=$this->input->post('id_prodi');

		$kirim=array('SIMPAN_SAR_PROD'=>$data);
	
		$hasil=$this->webserv->admisi('input_data/simpan_sarat_kes',$kirim);
		if($hasil)
		{
			echo "Berhasil!";
		}
		else
		{
			echo "Gagal";
		}


	}

	function tambah_prasyarat_prodi()
	{
		
		$data['kesehatan']= $this->webserv->admisi('input_data/data_kemampuan_berbeda',array());
		$penawaran['kode_penawaran']=$this->input->post('kode_penawaran');
		$penawaran['id_kelas']=$this->input->post('id_kelas');
		$insert_data=array('CEK_JURUSAN'=>$penawaran);

		$data['data_prodi'] = $this->webserv->admisi('input_data/data_penawaran_prodi_jalur',$insert_data);
		$data['data_sarat'] = $this->webserv->admisi('input_data/data_sarat_kesehatan',$insert_data);

		if($data)
		{
			$this->load->view('jurusan_kes',$data);
		
		}
	}

	function form_kode_pembayaran()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Kode Pembayaran', ' ');	

		$data['data_kode_pembayaran'] = $this->webserv->admisi('input_data/data_kode_pembayaran',array());
		$data['content']="form_kode_pembayaran";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function tampil_grup_form()
	{
		$data['grup_form']=$this->webserv->admisi('data_form/admin_grup_form',array());
		$data['form_item']=$this->webserv->admisi('data_form/form',array());
		$kode['kode_jalur']=$this->input->post('kode_jalur');
		$kirim_data=array('CARI_DATA_GRUP'=>$kode);
		$data['data_grup'] = $this->webserv->admisi('data_form/ambil_detail_grup_form',$kirim_data);
		$data['pilih_form']=$this->webserv->admisi('data_form/ambil_grup_form',$kirim_data);
		
		if($data)
		{
			
			$this->load->view('v_table/view_grup_form',$data);
		}
	}

	function insert_minat_jalur()
	{
		$data['kode_minat']=$this->input->post('kode_minat');
		$data['jumlah_penawaran']=$this->input->post('jumlah_penawaran');
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array('UPDATE_MINAT'=>$data);
		$hasil=$this->webserv->admisi('input_data/update_minat_jalur',$kirim);
		if($hasil)
		{
			echo "Minat BERHASIL diupdate";

		}
		else
		{
			echo "Minat GAGAL diupdate";
		}
		
	}

	function delete_minat_jalur()
	{
		$data['kode_minat']=$this->input->post('kode_minat');
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array('DELETE_MINAT'=>$data);
		$hasil=$this->webserv->admisi('input_data/delete_minat_jalur',$kirim);
		if($hasil)
		{
			echo "Minat BERHASIL dihapus";

		}
		else
		{
			echo "Minat GAGAL dihapus";
		}
		
	}

	function update_kelas_jalur()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['kode_kelas']=$this->input->post('kode_kelas');

		$kirim=array('UPDATE_KELAS'=>$data);
		$hasil=$this->webserv->admisi('input_data/insert_kelas_jalur',$kirim);
		if($hasil)
		{
			echo "Kelas ditambahkan";
		}
		else
		{
			echo "Gagal menambahkan kelas";
		}
	}

	function delete_kelas_jalur()
	{
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$data['kode_kelas']=$this->input->post('kode_kelas');

		$kirim=array('DELETE_KELAS'=>$data);
		$hasil=$this->webserv->admisi('input_data/delete_kelas_jalur',$kirim);
		if($hasil)
		{
			echo "Kelas dihapus";
		}
		else
		{
			echo "Kelas gagal dihapus";
		}
	}

	function form_penawaran_jalur()
	{	

		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Penawaran Jalur', ' ');	
		$data['data_minat'] = $this->webserv->admisi('input_data/minat',array());
		$data['data_minat_jalur'] = $this->webserv->admisi('input_data/data_minat_jalur',array());
		$data['data_kelas'] = $this->webserv->admisi('input_data/data_kelas',array());
		$data['data_kelas_jalur'] = $this->webserv->admisi('input_data/data_kelas_jalur',array());
		$data['data_kode_pembayaran'] = $this->webserv->admisi('input_data/data_kode_pembayaran',array());
		$data['data_jalur_masuk'] = $this->webserv->admisi('input_data/data_penawaran_jalur_cek',array());
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_penawaran_jalur";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function after_tranc_penawaran_jalur()
	{
		$data['data_jalur_masuk'] = $this->webserv->admisi('input_data/data_penawaran_jalur_cek',array());
		$data['data_kelas_jalur'] = $this->webserv->admisi('input_data/data_kelas_jalur',array());
		$data['data_minat_jalur'] = $this->webserv->admisi('input_data/data_minat_jalur',array());
		
		$this->load->view("v_table/view_table_penawaran",$data);
		
	}

	function after_tranc_kode_pembayaran()
	{
		$data['data_kode_pembayaran'] = $this->webserv->admisi('input_data/data_kode_pembayaran',array());
		$this->load->view("v_table/view_table_kode_pembayaran",$data);
		
	}

	function after_tranc_ruang_ujian()
	{
		$data['data_ruang_ujian'] = $this->webserv->admisi('input_data/ruang_ujian',array());
		$this->load->view("v_table/view_table_ruang_ujian",$data);
		
	}

	function after_tranc_ruang()
	{
		$data['data_ruang'] = $this->webserv->admisi('input_data/ruang',array());
		$this->load->view("v_table/view_table_ruang",$data);
		
	}

	function after_tranc_jadwal_ujian()
	{
		$data['data_jadwal'] = $this->webserv->admisi('input_data/jadwal_ujian',array());
		$data['detail_jadwal'] = $this->webserv->admisi('input_data/detail_jadwal',array());
		$this->load->view("v_table/view_table_jadwal_ujian",$data);
		
	}

	function form_ruang()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Ruang', ' ');	
		$data['data_ruang'] = $this->webserv->admisi('input_data/ruang',array());
		$data['nama_gedung'] = $this->webserv->admisi('input_data/gedung',array());
		$data['content']="form_ruang";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');

	}

	
	function form_ruang_ujian()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Penambahan Ruang Ujian', ' ');	
		$data['gelombang'] = $this->webserv->admisi('input_data/data_gelombang_jalur',array());
		$data['data_gedung'] = $this->webserv->admisi('input_data/gedung',array());
		$data['data_ruang_ujian'] = $this->webserv->admisi('input_data/ruang_ujian',array());
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		$data['jalur_masuk2'] = $this->webserv->admisi('input_data/data_penawaran_jalur_all',array());
		$data['content']="form_ruang_ujian";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function form_lihat_ruang_ujian()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Data Ruang Ujian', ' ');	
		$data['data_ruang_ujian'] = $this->webserv->admisi('input_data/ruang_ujian',array());
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_lihat_ruang_ujian";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function setting_grup_form()
	{

		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Setting Group Form', ' ');	
		$data['data_grup_form'] = $this->webserv->admisi('data_form/grup_form_admin',array());
		$data['jalur']=$this->webserv->admisi('data_form/jalur',array());
		$data['content']="form/table_grup_form";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');
	}

	function hapus_item_form()
	{

		$data['kode_form']=$this->input->post('kode_form');
		$data['kode_grup_form']=$this->input->post('kode_grup_form');
		$data['kode_jalur']=$this->input->post('kode_jalur');
		$form=array('HAPUS_FORM'=>$data);
		$hasil=$this->webserv->admisi('data_form/hapus_jalur_form',$form);
		
		if($hasil)
		{
			$this->after_grup_form_set($data['kode_jalur']);
		}
		else
		{
			echo "gagal";
		}
	}

	function after_grup_form_set($kode_jalur)
	{
		$data['grup_form']=$this->webserv->admisi('data_form/admin_grup_form',array());
		$data['form_item']=$this->webserv->admisi('data_form/form',array());
		$kode['kode_jalur']=$kode_jalur;
		$kirim_data=array('CARI_DATA_GRUP'=>$kode);
		$data['data_grup'] = $this->webserv->admisi('data_form/ambil_detail_grup_form',$kirim_data);
		$data['pilih_form']=$this->webserv->admisi('data_form/ambil_grup_form',$kirim_data);
		
		if($data)
		{
			
			$this->load->view('v_table/view_grup_form',$data);
		}
	}


	function insert_grup_jalur()
	{
		$data['kode_grup_form']=$this->input->post('kode_grup_form');
		$data['kode_form']=$this->input->post('kode_form');
		$data['kode_jalur']=$this->input->post('kode_jalur');

		$insert_data=array('INSERT_DATA'=>$data);
		$hasil=$this->webserv->admisi('data_form/insert_grup_jalur_form',$insert_data);
		if($hasil)
		{
			$this->after_grup_form_set($data['kode_jalur']);
		}
		else
		{
			echo "gagal";
		}
	}

	function delete_grup_jalur()
	{
		$data['kode_grup_form']=$this->input->post('kode_grup_form');
		$data['kode_form']=$this->input->post('kode_form');
		$data['kode_jalur']=$this->input->post('kode_jalur');

		$insert_data=array('DELETE_SAJA'=>$data);
		$hasil=$this->webserv->admisi('data_form/delete_grup_jalur_form',$insert_data);
		
	}

	function delete_grup_form()
	{

		$nomor['kode_grup_form']=$this->input->post('kode_grup_form');
		$nomor['kode_jalur']=$this->input->post('kode_jalur');
		
		$data=array('DELETE_GRUP'=>$nomor);
		
		$hasil=$this->webserv->admisi('data_form/delete_grup_form',$data);
		if($hasil)
		{
			$this->after_grup_form_set($nomor['kode_jalur']);
		}
		else
		{
			echo "gagal";
		}
		
	}



	function form_jadwal_ujian()
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Form Jadwal Ujian', ' ');	
		$data['data_jadwal'] = $this->webserv->admisi('input_data/jadwal_ujian',array());
		$data['data_tes']= $this->webserv->admisi('input_data/nama_tes',array());
		$data['detail_jadwal'] = $this->webserv->admisi('input_data/detail_jadwal',array());
		$data['jalur_masuk'] = $this->webserv->admisi('input_data/jalur',array());
		$data['content']="form_jadwal_ujian";
		$this->load->view('page/header',$data);
		$this->load->view('admin/content');
		$this->load->view('page/footer');

		
	}

	function kode_pembayaran_post()
	{
		$id_bayar=$this->input->post('kode_bayar');
		$nama_bayar=$this->input->post('nama_pembayaran');
		
		$insert_data=array(
			'kode_bayar'=>$id_bayar,
			'nama_pembayaran'=>$nama_bayar);

				$data=array('INSERT_DATA'=>$insert_data);
			
				$hasil=$this->webserv->admisi('input_data/insert_kode_pembayaran',$data);
				if($hasil)
				{
					
					redirect('adminpmb/input_data_c/form_kode_pembayaran');
				}
				
		}

	function ruang_post()
	{
		$id_ruang=$this->input->post('id_ruang');
		$id_gedung=$this->input->post('id_gedung');
		$nama_ruang=$this->input->post('nama_ruang');
		$status_ruang=$this->input->post('status_ruang');
		
		$insert_data=array(
			'id_ruang'=>$id_ruang,
			'id_gedung'=>$id_gedung,
			'nama_ruang'=>$nama_ruang,
			'status_ruang'=>$status_ruang);

				$data=array('INSERT_DATA'=>$insert_data);
			
				$hasil=$this->webserv->admisi('input_data/insert_ruang',$data);
				if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil disimpan.');
					redirect('adminpmb/input_data_c/form_ruang');
				}
				
		}

	function buat_nomor($thn,$jalur,$gel)
	{
	
			$data['urut']=substr($thn, 2,2).$jalur.$gel;	
			return $data['urut'];
	}

	function ruang_ujian_grup()
	{
		$data['kode_jadwal']=$this->input->post('kode_jadwal');
		$data['kode_penawaran']=$this->input->post('kode_penawaran');
		$kirim=array('GRUP_JADWAL'=>$data);
		$hasil['data_ruang_ujian']=$this->webserv->admisi('input_data/cari_jadwal_ruang',$kirim);
		//$hasil['data_jadwal'] = $this->webserv->admisi('input_data/jadwal_ujian',array());
		$this->load->view('v_table/view_table_ruang_ujian',$hasil);

	}

	function ruang_ujian_post()
	{
		$gelombang=$this->input->post('gelombang');
		$id_ruang=$this->input->post('id_ruang');
		$id_urut_gedung=$this->input->post('id_gedung');
		$kapasitas_ruang=$this->input->post('kapasitas_ruang');
		$no_ujian_awal=$this->input->post('no_ujian_awal');
		$no_ujian_akhir=$this->input->post('no_ujian_akhir');
		$kode_jalur=$this->input->post('kode_jalur');
		$status_ruang_ujian=$this->input->post('status_ruang_ujian');
		$tahun_ruang_ujian=$this->input->post('tahun_ruang_ujian');
		$kode_jadwal=$this->input->post('kode_jadwal');
		$head_nomor=$this->buat_nomor($tahun_ruang_ujian,$kode_jalur,$gelombang);
		$khusus=$this->input->post('khusus');
		$insert_data=array(
			'id_ruang'=>$id_ruang,
			'id_urut_gedung'=>$id_urut_gedung,
			'kapasitas_ruang'=>$kapasitas_ruang,
			'no_ujian_awal'=>$no_ujian_awal,
			'no_ujian_akhir'=>$no_ujian_akhir,
			'kode_jalur'=>$kode_jalur,
			'status_ruang_ujian'=>$status_ruang_ujian,
			'tahun_ruang_ujian'=>$tahun_ruang_ujian,
			'kode_jadwal'=>$kode_jadwal,
			'nomor_peserta'=>$head_nomor,
			'status_penuh'=>'0',
			'khusus'=>$khusus
			);

	
				$data=array('INSERT_DATA'=>$insert_data);
			
				$hasil=$this->webserv->admisi('input_data/insert_ruang_ujian',$data);
			
				if($hasil)
				{
					$this->webserv->admisi('input_data/buat_nomor',$data);
					echo '<div class="bs-callout bs-callout-success"><p>DATA BERHASIL DISIMPAN</p></div>';
				}
				else
				{
					echo '<div class="bs-callout bs-callout-error"><p>DATA GAGAL DISIMPAN</p></div>';
			
				}

				
			
		}

	function jadwal_ujian_post()
	{
		$hari=$this->input->post('hari');
		$tanggal_ujian=$this->input->post('tanggal_ujian');
		$lokasi_ujian=$this->input->post('lokasi_ujian');
		$jam_mulai_ujian=$this->input->post('jam_mulai_ujian');
		$jam_selesai_ujian=$this->input->post('jam_selesai_ujian');
		$jalur=$this->input->post('kode_jalur');
		$gel=$this->input->post('gelombang');
		$tahun=$this->input->post('tahun');
		$kode_penawaran=$jalur.$gel.$tahun;
		$pengumuman=$this->input->post('pengumuman');
		$kuota=$this->input->post('kuota');
		$insert_data=array(
			'lokasi_ujian'=>$lokasi_ujian,
			'kode_penawaran'=>$kode_penawaran,
			'pengumuman'=>$pengumuman,
			'kuota'=>$kuota
			);

				$data=array('INSERT_DATA'=>$insert_data);
			
				$hasil=$this->webserv->admisi('input_data/insert_jadwal_ujian',$data);
				if($hasil)
				{
					$this->after_tranc_jadwal_ujian();
				}
				else
				{
					$this->after_tranc_jadwal_ujian();
				}
				
			
	}

	function penawaran_jalur_post()
	{
					$kode_jalur=$this->input->post('jalur_masuk');
					$tahun=$this->input->post('tahun');
					$tanggal_mulai_daftar=$this->input->post('tanggal_mulai_daftar');
					$tanggal_selesai_daftar=$this->input->post('tanggal_selesai_daftar');
					$jam_mulai_daftar=$this->input->post('jam_mulai_daftar').':00';
					$jam_selesai_daftar=$this->input->post('jam_selesai_daftar').':00';
					$jam_mulai_bayar=$this->input->post('jam_mulai_bayar').':00';
					$jam_selesai_bayar=$this->input->post('jam_selesai_bayar').':00';
					$gelombang=$this->input->post('gelombang');
					$kode_bayar=$this->input->post('kode_pembayaran');
					$tanggal_mulai_bayar=$this->input->post('tanggal_mulai_bayar');
					$tanggal_selesai_bayar=$this->input->post('tanggal_selesai_bayar');
					$kuota=$this->input->post('kuota');
					$ket=$this->input->post('keterangan');
					
					$tgl_mul_daf=$tanggal_mulai_daftar.' '.$jam_mulai_daftar;
					$tgl_sel_daf=$tanggal_selesai_daftar.' '.$jam_selesai_daftar;
					$tgl_mul_bay=$tanggal_mulai_bayar.' '.$jam_mulai_bayar;
					$tgl_sel_bay=$tanggal_selesai_bayar.' '.$jam_selesai_bayar;
					
					$minat=$this->input->post('minat');
					$jumlah=array_slice(array_filter($this->input->post('jum')),0);
					$kelas=$this->input->post('kelas');
					$jmlkel=count($this->input->post('kelas'));

					$insert_data=array(
					'kode_jalur'=>$kode_jalur,
					'tahun'=>$tahun,
					'tanggal_mulai_daftar'=>$tgl_mul_daf,
					'tanggal_selesai_daftar'=>$tgl_sel_daf,
					'kode_bayar'=>$kode_bayar,
					'gelombang'=>$gelombang,
					'tanggal_mulai_bayar'=>$tgl_mul_bay,
					'tanggal_selesai_bayar'=>$tgl_sel_bay,
					'minat'=>$minat,
					'jumlah'=>$jumlah,
					'kode_kelas'=>$kelas,
					'kuota'=>$kuota,
					'ket'=>$ket
					);
					
					$data=array('INSERT_DATA'=>$insert_data);
					
					
					
					$hasil=$this->webserv->admisi('input_data/insert_penawaran_jalur',$data);
					
					
					if($hasil)
					{
					$this->load->view('form_penawaran_jalur');
						
					
					}
					
					
		}

		function delete_penawaran_jalur()
		{
			$id=$this->input->post('id');

			$id_hapus=array('kode_penawaran'=>$id);

			$data=array('HAPUS_DATA'=>$id_hapus);

			$hasil=$this->webserv->admisi('input_data/delete_penawaran_jalur',$data);
			
				{
					
					echo $this->after_tranc_penawaran_jalur();
				}
		}	

		function delete_ruang()
		{
			$id=$this->input->post('id');

			$id_hapus=array('id_ruang'=>$id);

			$data=array('HAPUS_DATA'=>$id_hapus);
			
			$hasil=$this->webserv->admisi('input_data/delete_ruang',$data);
				if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil dihapus.');
					redirect('adminpmb/input_data_c/form_ruang');
					
				}
		}	

		function delete_jadwal_ujian()
		{
			$id=$this->input->post('id');

			$id_hapus=array('kode_jadwal'=>$id);

			$data=array('HAPUS_DATA'=>$id_hapus);
			
			$hasil=$this->webserv->admisi('input_data/delete_jadwal_ujian',$data);
				if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil dihapus.');
					redirect('adminpmb/input_data_c/form_jadwal_ujian');
					
				}
		}	


		function select_detail_ruang()
		{
			$id=$this->input->post('id');

			$id_gedung=array('id_gedung'=>$id);

			$data=array('DETAIL_RUANG'=>$id_gedung);
			
			$hasil['data_ruang']=$this->webserv->admisi('input_data/detail_ruang',$data);
			
			
			$this->load->view("detail_ruang",$hasil);
		
		}	

		function select_detail_jadwal_ujian()
		{
			$id=$this->input->post('id');

			$id_jadwal=array('kode_jalur'=>$id);

			$data=array('DETAIL_JADWAL_UJIAN'=>$id_jadwal);
			
			$hasil['data_jadwal_ujian']=$this->webserv->admisi('input_data/detail_jadwal_ujian',$data);
			
			$this->load->view("v_penawaran_pmb/jadwal_penawaran",$hasil);
		
		}

		function delete_kode_pembayaran()
		{
			$id=$this->input->post('id');

			$id_hapus=array('kode_bayar'=>$id);

			$data=array('HAPUS_DATA'=>$id_hapus);
			
			$hasil=$this->webserv->admisi('input_data/delete_kode_pembayaran',$data);
				if($hasil)
				{
					$this->session->set_flashdata('message', 'Data berhasil dihapus.');
					redirect('adminpmb/input_data_c/form_kode_pembayaran');
					
				}
		}

		function delete_ruang_ujian()
		{
			$data['id_ruang']=$this->input->post('id');
			$data['kode_jalur']=$this->input->post('kode_jalur');
			$data['kode_jadwal']=$this->input->post('kode_jadwal');
			$kirim=array('HAPUS_NOMOR'=>$data);
			$nopes=$this->webserv->admisi('input_data/delete_nomor_peserta',$kirim);
			if($nopes)
			{

						
						$kirim2=array('HAPUS_DATA'=>$data);
						
						$hasil=$this->webserv->admisi('input_data/delete_ruang_ujian',$kirim2);
						if($hasil)
						{
						$this->after_tranc_ruang_ujian();
						
						}
				

			}

			
		}
}