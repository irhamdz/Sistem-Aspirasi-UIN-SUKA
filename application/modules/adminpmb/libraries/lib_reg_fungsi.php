<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class lib_reg_fungsi {
	function cek_awal_depan(){
		$CI=&get_instance();
        error_reporting(0);
		if(empty($this->session_nisn()) or empty($this->session_no_test())){
			header("location:".site_url()."");
		}
	}
	function cek_awal(){
		$CI=&get_instance();
		//cek sesi sebelumnya/////
		$this->cek_awal_depan();//
        $KD_JALUR=$CI->session->userdata('praregistrasi_jalur');       
		//////////////////////////
		$masa_isi=json_decode($this->get_masa_isi(),true);
		$NISN=$this->session_nisn();
        $NO_TEST=$this->session_no_test();
        //////////////////
        $dispen=json_decode($this->get_dispen($NO_TEST),true);
        $DISPEN=$dispen['DISPEN_BOLEH_AKSES'];
        ///////////////////
        $data_mahasiswa = json_decode($this->get_data_siswa($NO_TEST),true);
		if(($data_mahasiswa['VERIFIED']=='1' or $masa_isi['allow_isi']!='1') && $DISPEN=='FALSE'){
			header("location:praregistrasi");
		}else{
            $ARR_DATA=array(
                'KD_JALUR'=>$CI->session->userdata('praregistrasi_jalur'),
                'NAMA'=>$this->session_nama(),
                'NISN'=>trim($CI->session->userdata('nisn')),
                'NO_TEST'=>trim($CI->session->userdata('nomor_pendaftaran')),                
            );
            $isi=$this->post_data_global($ARR_DATA);
        }
	}
	function identitas(){
        $CI=&get_instance();
		echo "Nama Pengguna : ".$this->session_nama()."<br/><br/>";
	}
	function session_nisn(){
		$CI=&get_instance();
		return trim($CI->session->userdata('nisn'));
		//return 'x';
	}	
	function session_no_test(){
		$CI=&get_instance();
		return trim($CI->session->userdata('nomor_pendaftaran'));
	}
	function session_nama(){
		$CI=&get_instance();
		return strtoupper($CI->session->userdata('praregistrasi_nama'));
	}
	function format_bytes($a_bytes)
	{
		if ($a_bytes < 1024) {
			return $a_bytes .' B';
		} elseif ($a_bytes < 1048576) {
			return round($a_bytes / 1024, 2) .' KB';
		} elseif ($a_bytes < 1073741824) {
			return round($a_bytes / 1048576, 2) . ' MB';
		} elseif ($a_bytes < 1099511627776) {
			 return round($a_bytes / 1073741824, 2) . ' GB';
		} elseif ($a_bytes < 1125899906842624) {
			 return round($a_bytes / 1099511627776, 2) .' TB';
		} elseif ($a_bytes < 1152921504606846976) {
			 return round($a_bytes / 1125899906842624, 2) .' PB';
		 } elseif ($a_bytes < 1180591620717411303424) {
			 return round($a_bytes / 1152921504606846976, 2) .' EB';
		 } elseif ($a_bytes < 1208925819614629174706176) {
			 return round($a_bytes / 1180591620717411303424, 2) .' ZB';
		 } else {
			 return round($a_bytes / 1208925819614629174706176, 2) .' YB';
		 }
	}
	function dokumen_lokasi(){
		return 'praregistrasi_data';
	}
	function cek_kelengkapan($nim){
		$CI=&get_instance();
		//$nim=$CI->session->userdata('id_user');
		//////////////////////////////
		$data_mhs_nim=$this->get_data_siswa($nim);
		$data_mhs_nim=json_decode($data_mhs_nim,true);
		/*
		UNTUK HALAMAN 1
		HALAMAN DATA DIRI
		*/
		$err3='';$err5='';$err7='';
		$err2='';$err4='';$err6='';$err8='';
		$err9='';
		$kurang='';		
		$kurang_hal2=0;
		$kurang_hal3=0;
		$kurang_hal4=0;
		$kurang_hal5=0;
		$kurang_hal6=0;
		$kurang_hal7=0;
		$kurang_hal8=0;
		$kurang_hal9=0;		
		////////////////
		if(!isset($data_mhs_nim['GAJI_IBU'])){
			$kurang_hal2=1;
			$err2=$err2."<li>Besar gaji ibu belum diisi.</li>";
			$kurang['halaman2']=$err2;
		}
		if(!isset($data_mhs_nim['GAJI_BAPAK'])){
			$kurang_hal2=1;
			$err2=$err2."<li>Besar gaji bapak belum diisi.</li>";
			$kurang['halaman2']=$err2;
		}
		if(!isset($data_mhs_nim['GAJI_WALI'])){
			$kurang_hal2=1;
			$err2=$err2."<li>Besar gaji wali belum diisi.</li>";
			$kurang['halaman2']=$err2;
		}
		/*
		Untuk Halaman 3
		HALAMAN DATA IBU
		*/
		if(empty($data_mhs_nim['NM_IBU_KANDUNG'])){
			$kurang_hal3=1;
			$err3=$err3."<li>Nama ibu kandung belum diisi.</li>";
			$kurang['halaman3']=$err3;
		}
		if(empty($data_mhs_nim['KERJA_IBU_DETAIL'])){
			$kurang_hal3=1;
			$err3=$err3."<li>Kerja ibu belum diisi.</li>";
			$kurang['halaman3']=$err3;
		}
		/*
		Untuk Halaman 4
		HALAMAN DATA BAPAK
		*/
		if(empty($data_mhs_nim['NM_BPK_KANDUNG'])){
			$kurang_hal4=1;
			$err4=$err4."<li>Nama bapak belum diisi.</li>";
			$kurang['halaman4']=$err4;
		}
		if(empty($data_mhs_nim['KERJA_BPK_DETAIL']) && $data_mhs_nim['NM_BPK_KANDUNG'] 
			&& strtoupper($data_mhs_nim['NM_BPK_KANDUNG'])!='TIDAK ADA'){
			$kurang_hal4=1;
			$err4=$err4."<li>Kerja bapak belum diisi.</li>";
			$kurang['halaman4']=$err4;
		}
		/* untuk HALAMAN wali 5
		HALAMAN WALI
		*/
		if(empty($data_mhs_nim['NM_WALI'])){
			$kurang_hal5=1;
			$err5=$err5."<li>Nama wali belum diisi.</li>";
			$kurang['halaman5']=$err5;
		}
		/*
		untuk halaman fisik 6
		*/
		if(!isset($data_mhs_nim['JUM_KENDARAAN_RODA2']) or !isset($data_mhs_nim['JUM_KENDARAAN_RODA4']) 
			or !isset($data_mhs_nim['LUAS_TANAH_ORTU']) or !isset($data_mhs_nim['DAYA_LISTRIK_ORTU']) 
			or !isset($data_mhs_nim['PEMBAYARAN_PBB_AKHIR']) or !isset($data_mhs_nim['PEMBAYARAN_LISTRIK_AKHIR'])){
			$kurang_hal6=1;
			$err6=$err6."<li>Data fisik belum terisi secara lengkap.</li>";
			$kurang['halaman6']=$err6;
		}
		/* untuk halaman upload 7 */
		/* penghasila wali pilihan */
		/* kartu miskin pilihan */
		if((empty($data_mhs_nim['DOC_PENGHASILAN_IBU']) and empty($data_mhs_nim['DOC_PENGHASILAN_BPK']) and empty($data_mhs_nim['DOC_PENGHASILAN_WALI'])) 
			or empty($data_mhs_nim['DOC_PBB']) 
			or empty($data_mhs_nim['DOC_REK_LISTRIK']) or empty($data_mhs_nim['DOC_KK'])){
			$kurang_hal7=1;
			$err7=$err7."<li>Data upload dokumen belum terisi secara lengkap.</li>";
			$kurang['halaman7']=$err7;
		}
		return $kurang;
	}
	function dokumen_upload($id_data_diri,$field_name,$field_value){
		$this->ci=&get_instance();
		$file_name=$_FILES[$field_name]['name'];
		$file_value=$_FILES[$field_name]['tmp_name'];
		$allowed_size='1024000';
		$allowed_size_label='1 MB';
		$location=$this->dokumen_lokasi();
		$allowed_ext=array('gif','jpg','jpeg','pdf','GIF','JPG','JPEG','PDF');
		$allowed_ext_label="gif, jpg, jpeg atau pdf";
		////////////
		if($file_name){
			$info = pathinfo($file_name);
			$ext=$info['extension'];
			if(!in_array(strtoupper($ext),$allowed_ext)){
				$err=$err."<li>file $file_name punya tipe $ext, extensi yang diperbolehkan adalah : $allowed_ext_label</li>";
			}
			if(filesize($file_value)>$allowed_size){
				$err=$err."<li>file $file_name punya ukuran ".$this->format_bytes(filesize($file_value)).",".
				" ukuran file yang diijinkan tidak boleh lebih dari $allowed_size_label</li>";
			}
		}
		if(empty($err) and $field_value){
				$file_name_fix=$field_value;
		}
		if($err){
			return $err;
		}
		if(empty($err) and $file_name){
			$id_data_diri=strtoupper($id_data_diri);
			$file_name_fix=$id_data_diri.$field_name.".".$ext;	
			$newname="$location/".$file_name_fix;
			@unlink("$location/$field_value");
			$hasil=copy($file_value,$newname);				
		}
		return $file_name_fix;
	}

	function dokumen_upload_service($no_test,$field_name,$kolom){
		$this->ci=&get_instance();
		$file_name=$_FILES[$field_name]['name'];
		$file_value=$_FILES[$field_name]['tmp_name'];
		$allowed_size='1024000';
		$allowed_size_label='1 MB';
		$location=$this->dokumen_lokasi();
		$allowed_ext=array('gif','jpg','jpeg','pdf','GIF','JPG','JPEG','PDF');
		$allowed_ext_label="gif, jpg, jpeg atau pdf";
		////////////
		if($file_name){
			$info = pathinfo($file_name);
			$ext=$info['extension'];
			if(!in_array(strtoupper($ext),$allowed_ext)){
				$err=$err."<li>file $file_name punya tipe $ext, extensi yang diperbolehkan adalah : $allowed_ext_label</li>";
			}
			if(filesize($file_value)>$allowed_size){
				$err=$err."<li>file $file_name punya ukuran ".$this->format_bytes(filesize($file_value)).",".
				" ukuran file yang diijinkan tidak boleh lebih dari $allowed_size_label</li>";
			}
		}
		if(empty($err) and $field_value){
				$file_name_fix=$field_value;
		}
		if($err){
			return $err;
		}
		if(empty($err) and $file_name){
			$max_length = '150';
			if(strlen($file_name)>$max_length){
				$nama_filenya = str_replace(".$ext","",$file_name);
				$file_name = substr($nama_filenya,0,$max_length).".".$ext;
			}
			$isi_file = base64_encode(file_get_contents("$file_value"));
			$file_name = strtolower($file_name);
			$ARR_DATA_X=array(
			    'no_test'=> "$no_test",
			    'file_nama'=> "$file_name",
			    'file' => "$isi_file",
			    'kolom' => "$kolom"
			);				
        	$hasil = $this->post_upload_data($ARR_DATA_X);	
		}
		return $file_name_fix;
	}

	function url_api_sia(){
		return "http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/";
	}
	function petix($string){
		error_reporting(0);
		$string=ereg_replace("'","''",$string);
		return $string;
	}
	function bersihkan($string){
		$string =@htmlspecialchars($string);
		$string =@ereg_replace("\n","<br/>",$string);
		$string=$this->petix($string);
		return $string;
	}
	function crumb($arr_param){
		$CI=&get_instance();
		$data['arr_param']=$arr_param;
		$CI->load->view("v_mod_crumb",$data);
	}
	function rupiah($angka)
	{
	$rupiah="";
	$rp=strlen($angka);
	while ($rp>3)
	{
	$rupiah = ".". substr($angka,-3). $rupiah;
	$s=strlen($angka) - 3;
	$angka=substr($angka,0,$s);
	$rp=strlen($angka);
	}
	$rupiah = "" . $angka . $rupiah . "";
	return $rupiah;
	}
	function api_bayar($url,$post,$method){
		$CI =& get_instance();
		$username='sia';
		$password='ais';
		//////////////
		if(strtoupper($method)=='POST'){			
			$postdata = http_build_query($post);
			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header' => 'Content-type: application/x-www-form-urlencoded' . "\r\n"
					.'Content-Length: ' . strlen($postdata) . "\r\n",
					'content' => $postdata
				)
			);
			if($username && $password)
			{
				$opts['http']['header'] = ("Authorization: Basic " . base64_encode("$username:$password"));
			}
			
			$context = stream_context_create($opts);
			$hasil=file_get_contents($url, false, $context);
			return $hasil;
		}else{
			foreach($post as $key=>$value){
				$isi=$isi."/".$key."/$value/";
			}			
			$url=$url.$isi;
			$context = stream_context_create(array(
				'http' => array(
					'header'  => "Authorization: Basic " . base64_encode("$username:$password")
				)
			));	
			
			$hasil=file_get_contents($url, false, $context);
			return $hasil;
		}
	}
	function api_admisi($url,$post,$method){
		////////////////
        error_reporting(0);
		$username='admisi11';
		$password='42m151';
			//////////////
		if(strtoupper($method)=='POST'){			
			$postdata = http_build_query($post);
			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header' => 'Content-type: application/x-www-form-urlencoded' . "\r\n"
					.'Content-Length: ' . strlen($postdata) . "\r\n",
					'content' => $postdata
				)
			);
			if($username && $password)
			{
				$opts['http']['header'] = ("Authorization: Basic " . base64_encode("$username:$password"));
			}
			
			$context = stream_context_create($opts);
			$hasil=file_get_contents($url, false, $context);
			return $hasil;
		}else{
			$isi='';
			/*if($post){
				foreach($post as $key=>$value){
					$isi=$isi."/".$key."/$value/";
				}	
			}		*/
			$url=$url.$isi;
			$context = stream_context_create(array(
				'http' => array(
					'header'  => "Authorization: Basic " . base64_encode("$username:$password")
				)
			));	
			$hasil=file_get_contents($url, false, $context);
			return $hasil;
		}
	}
	//DATA SISWA
	function get_dispen($nomor_pendaftaran){
		$API_URL="http://service.uin-suka.ac.id/servadmisi/index.php/praregistrasi/d_mahasiswa/get_dispen/?no=$nomor_pendaftaran";
        $hasil=$this->api_admisi($API_URL,array(),'GET');
		return $hasil;
	}

	function tes($kj){
        $CI=&get_instance();
        $KD_JALUR=$kj;
		$API_URL="http://service.uin-suka.ac.id/servadmisi/index.php/praregistrasi/d_mahasiswa/get_masa_isi/?KD_JALUR=$KD_JALUR";
        $hasil=$this->api_admisi($API_URL,array(),'GET');
		return $hasil;
	}

	function get_masa_isi(){
        $CI=&get_instance();
        $KD_JALUR=$CI->session->userdata('praregistrasi_jalur');
		$API_URL="http://service.uin-suka.ac.id/servadmisi/index.php/praregistrasi/d_mahasiswa/get_masa_isi/?KD_JALUR=$KD_JALUR";
        $hasil=$this->api_admisi($API_URL,array(),'GET');
		return $hasil;
	}
	function get_masa_isi_value(){
        $CI=&get_instance();
        $KD_JALUR=$CI->session->userdata('praregistrasi_jalur');
		$API_URL="http://service.uin-suka.ac.id/servadmisi/index.php/praregistrasi/d_mahasiswa/get_masa_isi_value/?KD_JALUR=$KD_JALUR";
        $hasil=$this->api_admisi($API_URL,array(),'GET');
		return $hasil;
	}
	function post_data_keluarga($ARR_DATA){
		$API_URL="http://service.uin-suka.ac.id/servadmisi/index.php/praregistrasi/d_mahasiswa/post_data_keluarga";
        $hasil=$this->api_admisi($API_URL,$ARR_DATA,'POST');
		return $hasil;
	}
	function post_data_global($ARR_DATA){
        $CI=&get_instance();
        $ARR_DATA2=array(
            'KD_JALUR'=>$CI->session->userdata('praregistrasi_jalur'),
        );
        //array_push($ARR_DATA,$ARR_DATA2);    
		$API_URL="http://service.uin-suka.ac.id/servadmisi/index.php/praregistrasi/d_mahasiswa/post_data_global";
        $hasil=$this->api_admisi($API_URL,$ARR_DATA,'POST');
		return $hasil;
	}
	function post_upload_data($ARR_DATA){
        $CI=&get_instance();
        //array_push($ARR_DATA,$ARR_DATA2);    
		$API_URL="http://service.uin-suka.ac.id/servadmisi/index.php/praregistrasi/d_mahasiswa/post_upload_data";
        $hasil=$this->api_admisi($API_URL,$ARR_DATA,'POST');
		return $hasil;
	}
	function get_uploaded_data($ARR_DATA){
		$CI=&get_instance();
        //array_push($ARR_DATA,$ARR_DATA2);    
        foreach($ARR_DATA as $k => $v){
        	$xx[] = "$k=$v";
        }
        $param = implode("&",$xx);
		$API_URL="http://service.uin-suka.ac.id/servadmisi/index.php/praregistrasi/d_mahasiswa/get_uploaded_data?$param";
        $hasil=$this->api_admisi($API_URL,$ARR_DATA,'GET');
		return $hasil;
	}
	function get_data_siswa($NO_TEST){
		$API_URL="http://service.uin-suka.ac.id/servadmisi/index.php/praregistrasi/d_mahasiswa/get_data_siswa?NO_TEST=$NO_TEST";
		$hasil=$this->api_admisi($API_URL,array(),'GET');
		return $hasil;
	}

	function post_jadwal_profile($ARR_DATA){
        $CI=&get_instance();
		$API_URL="http://service.uin-suka.ac.id/servadmisi/praregistrasi/post_jadwal_pengisian";
        $hasil=$this->api_admisi($API_URL,$ARR_DATA,'POST');
		return $hasil;
	}
	function get_jadwal_profile(){
		$API_URL="http://service.uin-suka.ac.id/servadmisi/praregistrasi/get_jadwal_pengisian_daftar";
		$hasil=$this->api_admisi($API_URL,array(),'GET');
		return $hasil;
	}

	//DATA PENDIDIKAN
	function data_pendidikan(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json($this->url_api_sia().'sia_master/data_view', 'POST', 
				array('api_kode'=>10000, 'api_subkode' => 1));	
		return $isi2;
	}
	//DATA PEKERJAAN
	function data_pekerjaan(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json($this->url_api_sia().'sia_master/data_view', 'POST', 
				array('api_kode'=>1001, 'api_subkode' => 1));	
		return $isi2;
	}
	function pekerjaan_label($posting){
		if($posting=='A' or empty($posting)){
			$keterangan='Golongan';
		}elseif($posting=='C'){
			$keterangan='Pangkat';
		}else{
			$keterangan='Keterangan';
		}
		return $keterangan;
	}
	//DATA AGAMA
	function data_agama(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json($this->url_api_sia().'sia_master/data_view', 'POST', 
				array('api_kode'=>1000, 'api_subkode' => 1));	
		return $isi2;
	}
	//DATA NEGARA
	function data_negara(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json($this->url_api_sia().'sia_master/data_view', 'POST', 
				array('api_kode'=>11001, 'api_subkode' => 2));	
		return $isi2;
	}
	//DATA KABUPATEN
	function data_kabupaten($katakunci){
		$CI=&get_instance();
		$data1	= array($katakunci);	
		$isi2	= $CI->s00_lib_api->get_api_json($this->url_api_sia().'sia_master/data_search', 'POST', 
					array('api_kode'=>12000, 'api_subkode' => 3, 'api_search' => $data1));
		return $isi2;
	}
	function data_kabupaten_detail($KD_KAB){
		$CI=&get_instance();
		if($KD_KAB){
			$data1	= array($KD_KAB);	
			$isi2	= $CI->s00_lib_api->get_api_json($this->url_api_sia().'sia_master/data_search', 'POST', 
						array('api_kode'=>12000, 'api_subkode' => 2, 'api_search' => $data1));
			return $isi2[0];
		}
	}
	//DATA PROPINSI
	function data_propinsi_detail($KD_PROP){
		$CI=&get_instance();
		if($KD_PROP){
			$data1	= array($KD_PROP);	
			$isi2	= $CI->s00_lib_api->get_api_json($this->url_api_sia().'sia_master/data_search', 'POST', 
						array('api_kode'=>11000, 'api_subkode' => 1, 'api_search' => $data1));
			return $isi2[0];
		}
	}
}