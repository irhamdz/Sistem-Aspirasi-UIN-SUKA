<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class It00_lib{

	function dump_session(){
		$CI =& get_instance();
		print_r($CI->session->all_userdata());
	}
	
	function cek_allowed($allow='')
	{
		$CI =& get_instance();
		$jbt = $CI->session->userdata('jabatan');
		if($jbt)
		{
			$who = array_intersect(explode("#",$jbt),explode("#",$allow));
			$stat = count($who) > 0 ? TRUE : FALSE;	
		}
		else
		{
			$stat = FALSE;
		}
		return $stat;
	}

	#api_photo
	function tf_encode($kd_kelas){
		$hasil = ''; #return $kd_kelas;
		$str 	= 'sng3bAdac5UEmQzv2YBTH8CVh7jXpRo0etfOK4MINSlwFZ6iL9kPD1JWyuqGxr#-.:/';
		$arr_e = array();  $arr_e1 = array(); $arr_r = array(); $arr_r1 = array();
		for($j = 0; $j < strlen($str); $j++){
			$j_ = $j; if ($j_ < 10) { $j_ = '0'.$j_; }
			$arr_e1[$j] = substr($str,$j,1);
			$arr_e[$j_] = substr($str,$j,1);
			$arr_r1[substr($str,$j,1)] = $j;
			$arr_r[substr($str,$j,1)] = $j_;
		}
		
		$total = 0;
		for($i = 0; $i < strlen($kd_kelas); $i++){
			$total = (int)substr($kd_kelas,$i,1) + $total; 
		} $u = fmod($total,10);
		
		$kd_enc = $arr_e1[$u];
		for($i = 0; $i < strlen($kd_kelas); $i++){
			$k = ($arr_r1[substr($kd_kelas,$i,1)]+$u); if($k < 10) { $k = '0'.$k; }
			$kd_enc .= ''.$k.rand(0,9); 
		} return $kd_enc;
	}

	function cek_foto($pre_pin='')
	{
		$CI =& get_instance();
		$parameter = array(	'api_kode' => 1500,'api_subkode' => 1,'api_search' => array($pre_pin) );
		$data = $CI->s00_lib_api->get_api_json(URL_API_IT.'it_basic/foto','POST',$parameter);
		return $data;
	}

	function api_foto($jenisfoto,$something,$nim,$tipe)
	{
		/*
			b.	QL: 100, selain 100 bisa antara 0-100. Ini kualitas foto
			c.	WM: 1, artinya dikasih watermark, kalau WM: 0 itu tanpa watermark
			d.	SZ: 300, artiny adalah resize ukuran foto jadi 300 piksel
		*/
		#ket : 
		#$jenisfoto = pgw -> FOTOMASUK,FOTOLAIN1, FOTOLAIN2, FOTOPENSIUN, FOTODAFTAR, FOTOTTD, FOTORANDOM, FOTOAUTO,FOTOTTD
		#$jenisfoto = mhs -> FOTO1, FOTO2, FOTOKKN, FOTOWISUDA, FOTOPMB, FOTORANDOM, FOTOAUTO
		#$something = pgw/mhs
		#$tipe = pdf/html

		switch ($tipe) {
			case 'html': $kode = '990';	break;
			case 'pdf': $kode = '980'; break;
			default: $kode='';	break;
		}

		$url = $this->tf_encode($jenisfoto.'#'.$nim.'#QL:100#WM:0#SZ:300');		
		$xx = '<img class="'.strtolower($jenisfoto).'" src="http://static.uin-suka.ac.id/foto/'.$something.'/'.$kode.'/'.$url.'.jpg">';

		return $xx;
	}

	function get_data_region($something='',$val1=null,$val2=null)
	{
		$CI =& get_instance();
		switch ($something) {
			case 'negara':		
				$parameter = array(	'api_kode' => 11001,'api_subkode' => 2);
				$data = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', $parameter);
				break;

			case 'provinsi':	
				$parameter = array(	'api_kode' => 11000,'api_subkode' => 1);
				$data = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', $parameter);
				break;

			case 'kabupaten': 
				$parameter = array(	'api_kode' => 12000,'api_subkode' => 4,'api_search' => array($val1));
				$data = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', $parameter);
				break;

			case 'kecamatan':
				$parameter = array(	'api_kode' => 13000,'api_subkode' => 4,'api_search' => array($val1));
				$data = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', $parameter);
				break;
			
			default:
				$parameter = '';
				$data = false;
				break;
		}
		return $data;
	}


	function cek_lengkap($data){
		$err1 = '';
		$st = true;
    	if(empty($data['NAMA'])){
			$err1=$err1."<li>Nama belum terisikan.</li>";
			$st = false;
		} 
		if(empty($data['TMP_LAHIR'])){
			$err1=$err1."<li>Tempat lahir belum terisikan.</li>";
			$st = false;
		}
		if(empty($data['KD_KAB_LAHIR'])){
			$err1=$err1."<li>Kabupaten lahir belum diisi.</li>";
			$st = false;
		}
		if(empty($data['TGL_LAHIR'])){
			$err1=$err1."<li>Tanggal lahir belum diisi.</li>";
			$st = false;
		}
		if(empty($data['ALAMAT_MHS'])){
			$err1=$err1."<li>Alamat mahasiswa belum diisi.</li>";
			$st = false;
		}
		if(empty($data['RT_MHS'])){
			$err1=$err1."<li>Nomor RT mahasiswa belum diisi.</li>";
			$st = false;
		}
		if(empty($data['RW_MHS'])){
			$err1=$err1."<li>Nomor RW mahasiswa belum diisi.</li>";
			$st = false;
		}
		if(empty($data['DESA'])){
			$err1=$err1."<li>Desa mahasiswa belum diisi.</li>";
			$st = false;
		}
		if(empty($data['KD_KAB'])){
			$err1=$err1."<li>Alamat kabupaten mahasiswa belum diisi.</li>";
			$st = false;
		}
		if(empty($data['TELP_MHS'])){
			$err1=$err1."<li>Nomor Telp/HP mahasiswa belum diisi.</li>";
			$st = false;
		}
		
		return $hasil = array('status' => $st,'msg' => $err1);
    }

	function get_data_religion()
	{
		$CI =& get_instance();
		$parameter = array(	'api_kode' => 1000,'api_subkode' => 1);
		$data = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', $parameter);
#		sia_master/data_view, 2000/1
		return $data;

#sia_master/data_search, 2000/1, api_search = array(kd_agama)
	}	

	function get_data_unit($tipe,$tgl)
	{
		/* ini dicatet:
		1. kepala ptipd = ST000100
		2. kepala pbba = 654321BF
		3. kepala perpus = 654321BD*/
		$CI =& get_instance();
		if($tipe == 'kepala'){
			$parameter = array('api_kode' => 1121, 'api_subkode' => 9, 'api_search' => array($tgl,'ST000100','1'));
			$data = $CI->s00_lib_api->get_api_json(URL_API_SIMPEG.'simpeg_mix/data_search', 'POST', $parameter);
		}elseif($tipe == 'unit'){
			$parameter = array('api_kode' => 1901, 'api_subkode' => 2, 'api_search' => array($tgl,'UN01006'));
			$data = $CI->s00_lib_api->get_api_json(URL_API_SIMPEG.'simpeg_mix/data_search', 'POST', $parameter);
		}else{
			$data = false;
		}
		return $data;
	}


	function get_date_now()
	{
		$CI =& get_instance();
		$data = $data = $CI->s00_lib_api->get_api_json(URL_API_IT.'ict_basic/get_date_now','POST',array('api_kode' => 1500, 'api_subkode' => 1));	
		return $data;
	}

	function cek_bentrok($tipe,$arr)
	{
		$CI =& get_instance();
		$parameter = array(	'api_kode' => 1500,'api_subkode' => 1,'api_search'=> array($tipe,$arr)); #periode, hari, ruang, jam_mulai, jam_selesai		
		$data = $CI->s00_lib_api->get_api_json(URL_API_IT.'it_basic/cek_bentrok','POST',$parameter);	
		return $data;
	}

	function cek_bentrok_lain($nim,$tgl_mulai,$tgl_selesai)
	{
		$CI =& get_instance();
		$data = $CI->s00_lib_api->get_api_json(
				URL_API_SIA.'sia_krs/data_procedure','POST',
				array('api_kode' => 64000,'api_subkode' => 52,'api_datapost' => array($nim,$tgl_mulai,$tgl_selesai)));	
		return $data;
		/*	format tanggal = DD/MM/YYYY HH24:MI:SS
			trus ntar cek print_r kolom ":hasil"
			contoh: '09650021','01/10/2010 05:00:00','01/10/2010 10:00:00'*/
	}

	function get_periode($something='',$tipe='',$val1=null,$val2=null)
	{
		$CI =& get_instance();
		switch ($something) {
			case 'thn':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 1,'api_search'=> array($tipe));
				break;
			case 'ta':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 2,'api_search'=> array($tipe));
				break;
			case 'bln_thn':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 3,'api_search'=> array($tipe,$val1));
				break;
			case 'bln_ta':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 4,'api_search'=> array($tipe,$val1));
				break;
			case 'tgl_thnbln':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 5,'api_search'=> array($tipe,$val1,$val2));
				break;
			case 'tgl_tabln':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 6,'api_search'=> array($tipe,$val1,$val2));
				break;
			case 'tawar':
				$parameter = array(	'api_kode' => 1600,'api_subkode' => 1,'api_search'=> array($tipe,$val1));
				break;
			case 'tgl_thnbln_histori':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 11,'api_search'=> array($tipe,$val1,$val2));
				break;
			default:
				$parameter = '';
				break;
		}
		if(! $parameter){
			$data = '';
		}
		else
		{
			$data = $CI->s00_lib_api->get_api(URL_API_IT.'it_basic/get_periode','POST',$parameter);	
		}
		return json_decode($data, true);
	}


	function get_jadwal($something='',$val='',$val2=null,$val3=null)
	{
		$CI =& get_instance();
		switch($something){
			case 'jad_terisi':
				$val2 = (!isset($val2) or empty($val2))? '0': $val2; #hari
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 1,'api_search'=> array($val,$val2));
				break;
			case 'jad_detail':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 2,'api_search'=> array($val));
				break;
			case 'jad_diambil':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 3,'api_search'=> array($val,$val2,$val3));
				break;
			case 'tawar':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 4,'api_search'=> array($val));
				break;
			case 'udah_daftar':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 5,'api_search'=> array($val,$val2,$val3)); #tipe #nim #kd_bayar
				break;
			case 'jad_detail_pst':
				$parameter = array(	'api_kode' => 1500,'api_subkode' => 6,'api_search'=> array($val)); #kd_peserta
				break;
			case 'jad_histori':
				$parameter = array(	'api_kode' => 1600,'api_subkode' => 1,'api_search'=> array($val,$val2,$val3)); #tipe #thn #bln
				break;
			default:
				$parameter = '';
				break;
		}
		if(! $parameter){
			$data = '';
		}
		else
		{
			$data = $CI->s00_lib_api->get_api(URL_API_IT.'it_basic/get_jadwal','POST',$parameter);
		}
		return json_decode($data, true);
	}

	function get_data_reg($pin)
	{
		$CI =& get_instance();
		$data = $CI->s00_lib_api->get_api_json(	URL_API_IT.'it_basic/get_pendaftar','POST',	array(	'api_kode' => 1500,'api_subkode'=> 1,'api_search' => array($pin)));	
		//print_r($data); 
		return $data;
	}
	
	function get_data_smt_mhs($nim)
	{
		$CI =& get_instance();
		$krs = $CI->api->get_api_json(URL_API_SIA.'sia_krs/data_search', 'POST',
                array('api_kode'=>63000, 'api_subkode' => 15, 'api_search' => array($nim)));
		$smt = count($krs);
		return $smt;
	}
		
	function get_data_pegawai($nip)
	{
		$CI =& get_instance();
		$parameter = array('api_kode' => 2001, 'api_subkode' => 2, 'api_search' => array($nip));
		$data = $CI->s00_lib_api->get_api_json('http://service.uin-suka.ac.id/servsiasuper/simpeg_public/simpeg_mix/data_search', 'POST', $parameter);
		return $data;
	}

	function getBlob($pin)
	{		
		$CI =& get_instance();
		$data = $CI->s00_lib_api->get_api_json(
					URL_API_IT.'it_basic/getBlob',
					'POST',
					array(	'api_kode' 		=> 1500,
							'api_subkode' 	=> 1,
							'api_search' 	=> array($pin))
					);
		return $data;
	}	

	function insertBlob($table,$arr,$where)
	{		
		$CI =& get_instance();
		$data = $CI->s00_lib_api->get_api_json(
					URL_API_IT.'it_basic/insertBlob',
					'POST',
					array(	'api_kode' 		=> 1500,
							'api_subkode' 	=> 1,
							'api_search' 	=> array($table,$arr,$where))
					);
		return $data;
	}	

	function select($table='',$order= null, $where = null)
	{
		$CI =& get_instance();
		if (empty($where))
		{
			$subkode = 1;
			$search = array($table,$order);
		}
		else
		{
			$subkode = 2;
			$search = array($table,$order,$where);
		}
		$data = $CI->s00_lib_api->get_api_json(
			 	URL_API_IT.'it_basic/select',
				'POST',
				array(	'api_kode' 		=> 1500,
						'api_subkode' 	=> $subkode,
						'api_search' 	=> $search)
				);
		// print_r($data); 
		return $data;
	}

	 function select_row($table,$wh)
	{
		$CI =& get_instance();
		#$wh = array('KD_BP' => 1);
		$data = $CI->s00_lib_api->get_api_json(
			 	URL_API_IT.'it_basic/select',
				'POST',
				array(	'api_kode' 		=> 1500,
						'api_subkode' 	=> 3,
						'api_search' 	=> array($table,$wh))
				);
		// print_r($data);
		return $data;
	}

	 function insert($table,$where)
	{		
		$CI =& get_instance();
		$data = $CI->s00_lib_api->get_api_json(
					URL_API_IT.'it_basic/insert',
					'POST',
					array(	'api_kode' 		=> 1500,
							'api_subkode' 	=> 1,
							'api_search' 	=> array($table,$where))
					);
		return $data;
	}

	 function delete($table,$where)
	{
		$CI =& get_instance();
		$data = $CI->s00_lib_api->get_api_json(
					URL_API_IT.'it_basic/delete',
					'POST',
					array(	'api_kode' 		=> 1500,
							'api_subkode' 	=> 1,
							'api_search' 	=> array($table,$where))
					);
		return $data;
	}

	 function update($table,$arr,$where)
	{
		$CI =& get_instance();
		$data = $CI->s00_lib_api->get_api_json(
					URL_API_IT.'it_basic/update',
					'POST',
					array(	'api_kode' 		=> 1500,
							'api_subkode' 	=> 1,
							'api_search' 	=> array($table,$arr,$where))
					);
		return $data;
	}

	#SERTIFIKAT
	function nomor_urut_sertifikat(){
		$CI =& get_instance();
		$data = $CI->s00_lib_api->get_api_json(
			 	URL_API_IT.'it_basic/sertifikat',
				'POST',
				array(	'api_kode' 		=> 1500,
						'api_subkode' 	=> 1,
					)
				);
		return $data;
	}
	
	
	function mm_to_month($var)
	{
		$month = '';
		switch ($var) {

			case "01": $month = 'Januari';  break;
			case "02": $month = 'Februari'; break;
			case "03": $month = 'Maret'; break;
			case "04": $month = 'April'; break;
			case "05": $month = 'Mei'; break;
			case "06": $month = 'Juni'; break;
			case "07": $month = 'Juli'; break;
			case "08": $month = 'Agustus'; break;
			case "09": $month = 'September'; break;
			case "10": $month = 'Oktober'; break;
			case "11": $month = 'November'; break;
			case "12": $month = 'Desember'; break;
		}
		return $month;
	}	
}