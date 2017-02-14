<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class lib_reg_fungsi {
	function cek_awal(){
	   error_reporting(0);
		$CI=&get_instance();
        
		$nim=$CI->session->userdata('id_user');
		$CI->session->set_userdata('app','registrasi');
        ini_set('upload_max_file_size','320M');
        ini_set('post_max_size','380M');
        ini_set('memory_limit','400M');
        ini_set('max_execution_time', 800000000);
		//yang boleh melakukan akses siapa saja
		/* if($nim!='10651025'){
			redirect('');
		} */
	}
	function master_label_data($tgl){
		$CI=&get_instance();
		$data_mahasiswa=$this->data_mhs_nim($CI->session->userdata('id_user'));
		$kd_prodi = $data_mahasiswa[0]['KD_PRODI'];
		$hasil = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_sistem/data_search', 'POST', 
		array('api_kode'=>101006, 'api_subkode' => 1, 'api_search' => array($tgl,$kd_prodi)));
		return $hasil;
	}
    function cek_tgl($data){
    	//if (date('d/m/Y', strtotime($data)) == $data) {
        	return true;
	    //} else {
	    //    return false;
	   // }
    }
    function cek_jalur($nim){
        $CI=&get_instance();       
        //////////////////////////////
        $url="http://service.uin-suka.ac.id/servsibayar/index.php/data/md_mahasiswa/mahasiswa_jalur/nim/$nim/format/json";
        $hasil=json_decode($this->api_sibayar($url,'GET',''),true);
        $x['KD_JALUR']=$hasil['KD_JAUR'];
        $x['NM_JALUR']=$hasil['NM_JALUR'];
        return $x;
    }
	function get_data_siswa($NO_TEST){
		$API_URL="http://service.uin-suka.ac.id/servsiasuper/index.php/praregistrasi/d_mahasiswa/get_data_siswa_no_test?NO_TEST=$NO_TEST";
		$hasil=$this->api_admisi($API_URL,array(),'GET');
		return json_decode($hasil,true);
	}
    function get_foto($nim,$jenis){
		$CI=&get_instance();
		$hasil = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
		array('api_kode'=>26000, 'api_subkode' => 11, 'api_datapost' => array($nim,$jenis)));
		return $hasil;
	}
    function file_update_akta($nim,$file,$filename){
        $CI=&get_instance();
		$hasil = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
		array('api_kode'=>26000, 'api_subkode' => 22, 'api_datapost' => array('AKTA_KELAHIRAN', $nim, base64_encode(file_get_contents($file)), $filename)));
		return $hasil;
    }
    function file_get_akta($nim){
        $CI=&get_instance();
        $hasil = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
		array('api_kode'=>26000, 'api_subkode' => 38, 'api_search' => array($nim,'AKTA_KELAHIRAN')));
		return $hasil;
    }
    function file_update_ijazah($nim,$kd_jenis_pend,$file,$filename){
        $CI=&get_instance();
		$hasil = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
		array('api_kode'=>27000,'api_subkode' => 3, 'api_datapost' => array('IJAZAH', $nim, $kd_jenis_pend,base64_encode(file_get_contents($file)), $filename)));
		return $hasil;
        /*$arr_data = array('IJAZAH', '10651025', 'K', $blob1, 'TESTERIJAZ-inicontohfilepdf.pdf'); $aksi = $this->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', array('api_kode'=>27000, 'api_subkode' => 3, 'api_datapost' => $arr_data));*/
    }
    function file_get_ijazah($nim,$kd_jenis_pend){
        $CI=&get_instance();
        $hasil = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
		array('api_kode'=>27000, 'api_subkode' => 4, 'api_search' => array($nim,$kd_jenis_pend,'IJAZAH')));
		return $hasil;
    }
    function foto($jenis){
        $CI=&get_instance();
        $nim=$CI->session->userdata('id_user');
        $file="http://akademik.uin-suka.ac.id/foto/mahasiswa/jenis/$jenis/$nim.jpg";
        $file_default='http://akademik.uin-suka.ac.id/asset/img/blankperson.jpg';
		$ukuran=strlen(file_get_contents($file));
		$data_foto=$this->get_foto($nim,$jenis);
		echo "<!-- uuran $ukuran  $file";
		print_r($data_foto);
		echo "-->";
       // if($ukuran){
            $isi_file="$file";
        //}else{
        //    $isi_file="$file_default";
       // }
        return "<img width='100' src='$isi_file'/>";
    }
	function api_admisi($url,$post,$method){
		////////////////
		$username='sia';
		$password='ais253';
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
			if($post){
				foreach($post as $key=>$value){
					$isi=$isi."/".$key."/$value/";
				}	
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
    function api_sibayar($url,$post,$method){
        $CI=&get_instance();
		////////////////
        $username = $CI->config->item('bayar_name');
		$password = $CI->config->item('bayar_pass');
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
			if($post){
				foreach($post as $key=>$value){
					$isi=$isi."/".$key."/$value/";
				}	
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
    function update_npsn($nim, $kd_sekolah, $nm_pt, $kd_sekolah_npsn, $nm_sekolah_npsn_lain){		
		$CI=&get_instance();
        $arr_data = array($nim, $kd_sekolah, $nm_pt, $kd_sekolah_npsn, $nm_sekolah_npsn_lain);
		$aksi = $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
		array('api_kode'=>26000, 'api_subkode' => 21, 'api_datapost' => $arr_data));
		return $aksi;
	}
    function ambil_data_sekolah_akhir($nim){ //asfar
        $CI=&get_instance();
		$data_pendidikan_riwayat=$this->data_pendidikan_ambil($nim);	
		$arr_jenjang_minim=$this->jenjang_minim();
		foreach($data_pendidikan_riwayat as $key => $val){
			 $KD_PEND=$val['KD_PEND'];
			 $NIMNYA=$CI->session->userdata('id_user');
			 if(in_array($KD_PEND,$arr_jenjang_minim)){
				return $val;                
                break;
			 }
		}		
    }
    function ambil_data_sekolah_akhir2($nim,$jenjang){ //asfar
        $CI=&get_instance();
		$data_pendidikan_riwayat=$this->data_pendidikan_ambil($nim);	
		$arr_jenjang_minim=$this->jenjang_minim2($jenjang);
		foreach($data_pendidikan_riwayat as $key => $val){
			 $KD_PEND=$val['KD_PEND'];
			 //$NIMNYA=$CI->session->userdata('id_user');
			 if(in_array($KD_PEND,$arr_jenjang_minim)){
				return $val;                
                break;
			 }
		}		
    }
	function update_kd_sekolah($nim){
		$CI=&get_instance();
		$data_pendidikan_riwayat=$this->data_pendidikan_ambil($nim);	
		$arr_jenjang_minim=$this->jenjang_minim();
		foreach($data_pendidikan_riwayat as $key => $val){
			 $KD_PEND=$val['KD_PEND'];
			 $NIMNYA=$CI->session->userdata('id_user');
			 if(in_array($KD_PEND,$arr_jenjang_minim)){
				$NIM=$nim;
				$KD_SEKOLAH_ASAL=$val['KD_SEKOLAH_ASAL'];
				$NM_PT=$val['NM_SEKOLAH'];
				$JURUSAN_SMA=$val['JURUSAN'];
				$NO_IJASAH_SMA=$val['NO_IJASAH_SMA'];
				$THN_LULUS_SMA=$val['THN_LULUS'];
				$NILAI_SMA=$val['NEM'];
				$PEND_KD_PEND=$val['KD_PEND'];
				$PEND_STTB=(int)$val['STTB'];
				$PEND_KETERANGAN=$val['KETERANGAN'];
                $NM_SEKOLAH_ASAL=$val['NM_SEKOLAH'];
				$x=$this->data_pendidikan_ambil_tertinggi($nim);
				$PEND_ID_RIWAYAT=$x['ID_RIWAYAT'];
                $NPSN=$val['NPSN'];
                //DATA LAIN LAIN
                $DATA_MHS=$this->data_mhs_nim($nim);
                $KD_SEKOLAH_ASAL_LAIN=$DATA_MHS[0]['KD_SEKOLAH_ASAL'];
                if($KD_SEKOLAH_ASAL_LAIN && !$KD_SEKOLAH_ASAL){
                	$KD_SEKOLAH_ASAL = $KD_SEKOLAH_ASAL_LAIN;
                }

				//update di D_MAHASISWA
                
                $data_post=array("$NIM","$TGL_MASUK","$KD_MASUK","$KD_JALUR","$SEMESTER_AWAL","$KD_SEKOLAH_ASAL","$JURUSAN_SMA",
				"$NO_IJASAH_SMA","$NILAI_SMA","$THN_LULUS_SMA","$ASAL_PT","$NM_PT","$ASAL_PRODI","$SKS_DIAKUI","$BATAS_STUDI",
				"$STATUS","$PEND_KD_PEND","$PEND_KETERANGAN","$PEND_STTB","$PEND_ID_RIWAYAT");
				$updatex=$this->data_lain_update($data_post);	
				$update_npsn=$this->update_npsn($NIM, $KD_SEKOLAH_ASAL, $NM_PT, $NPSN, $NM_SEKOLAH_ASAL);
				break;
			 	
			 }
		}		
	}
    function jenjang_minim3(){
        $CI=&get_instance();	
		//echo "jenjang $jenjang";
		$jenjang=$this->kd_data_pendidikan();
		switch($jenjang){
			//S3
			case 'A':$arr_syarat=array('B');break;
			//S2
			case 'B':$arr_syarat=array('C');break;
			//S1
			case 'C':$arr_syarat=array('D','E','K');break;
			//D4
			case 'D':$arr_syarat=array('E');break;
			//D3
			case 'E':$arr_syarat=array('F');break;
			//PROFESI
			case 'J':$arr_syarat=array('C','D');break;
		}
		return $arr_syarat;
    }
	function jenjang_minim(){
		$CI=&get_instance();	
		//echo "jenjang $jenjang";
		$jenjang=$this->kd_data_pendidikan();
		switch($jenjang){
			//S3
			case 'A':$arr_syarat=array('B');break;
			//S2
			case 'B':$arr_syarat=array('C','D');break;
			//S1
			case 'C':$arr_syarat=array('D','E','F','G','K');break;
			//D4
			case 'D':$arr_syarat=array('E','F','G','K');break;
			//D3
			case 'E':$arr_syarat=array('F','G','K');break;
			//PROFESI
			case 'J':$arr_syarat=array('C','D');break;
		}
		return $arr_syarat;
	}
    function jenjang_minim2($jenjang){
		$CI=&get_instance();	
		//echo "jenjang $jenjang";
		//$jenjang=$this->kd_data_pendidikan();
		switch($jenjang){
			//S3
			case 'A':$arr_syarat=array('B');break;
			//S2
			case 'B':$arr_syarat=array('C','D');break;
			//S1
			case 'C':$arr_syarat=array('D','E','F','G','K');break;
			//D4
			case 'D':$arr_syarat=array('E','F','G','K');break;
			//D3
			case 'E':$arr_syarat=array('F','G','K');break;
			//PROFESI
			case 'J':$arr_syarat=array('C','D');break;
		}
		return $arr_syarat;
	}
	function cek_syarat(){
		//cek yang boleh melakukan pengisian dengan syarat yang ada
		$CI=&get_instance();
		$nim=$CI->session->userdata('id_user');
		$CI->session->set_userdata('app','registrasi');
		/* if($nim!='10651025'){
			redirect('');
		} */
		//syarat pengisian REGISTRASI
		if(($CI->session->userdata('mhs_jenjang') == "D3") OR 
		($CI->session->userdata('mhs_jenjang') == "S1") OR 
		($CI->session->userdata('mhs_jenjang') == "S2") OR 
		($CI->session->userdata('mhs_jenjang') == "S3")){
			$STATUS['JENJANG']='1';
		}else{
			$STATUS['JENJANG']='0';
		}
		if(strtoupper($CI->session->userdata('mhs_status'))=='AKTIF' or strtoupper($CI->session->userdata('mhs_status'))=='CUTI'){ //add 08/08/2014
			$STATUS['AKTIF']='1';
		}else{
			$STATUS['AKTIF']='0';
		}
		//backdoor
		$STATUS['AKTIF']='1';
		$STATUS['JENJANG']='1';
		return $STATUS;
	}
	function cek(){
		$CI=&get_instance();
		$nim=$CI->session->userdata('id_user');
		$CI->session->set_userdata('app','registrasi');
		//yang boleh melakukan akses siapa saja
		if($nim!='10651025'){
			//redirect('');
		} 
		$link=$CI->lib_reg_fungsi->base_url();
		$syarat=$this->cek_syarat();
		if(in_array('0',$syarat)){
			redirect("$link/cek");
		}
	}
    function is_pasca(){
        $CI=&get_instance();
        $jenjang=strtoupper($CI->session->userdata('mhs_jenjang'));
        $status='false';
        if($jenjang=='S2' or $jenjang=='S3'){
            $status='true';
        }
        return $status;
        
    }



	function cek_kelengkapan($nim){
		$CI=&get_instance();
		//$nim=$CI->session->userdata('id_user');
		//////////////////////////////
		$data_mhs_nim=$this->data_mhs_nim($nim);
		$data_mhs_nim=$data_mhs_nim[0];
		$data_rumah=$this->data_rumah_ambil($nim);
        $data_lokasi_pendidikan=$this->data_mahasiswa_lokasi_pendidikan_ambil($nim);
        $data_hobi=$this->data_hobi_ambil($nim);
		//print_r($data_mhs_nim);
		/*
		UNTUK HALAMAN 1
		HALAMAN DATA DIRI
		*/
		$err1='';$err3='';$err5='';$err7='';
		$err2='';$err4='';$err6='';$err8='';
		$err9='';$err10='';$err11='';$err12='';$err13='';$err14='';
		$kurang='';
		$kurang_hal1=0;
		$kurang_hal2=0;
		$kurang_hal10=0;
        $kurang_hal12=0;
		$kurang_hal3=0;
		$kurang_hal4=0;
		$kurang_hal5=0;
		$kurang_hal6=0;
		$kurang_hal11=0;
		$kurang_hal7=0;
		$kurang_hal8=0;
        $kurang_hal13=0;
		$kurang_hal9=0;
		$kurang_hal14='';
		if(empty($data_mhs_nim['TMP_LAHIR'])){
			$kurang_hal1=1;
			$err1=$err1."<li>Tempat lahir belum terisikan.</li>";
			$kurang['halaman1']=$err1;
		}
		if(empty($data_mhs_nim['KD_KAB_LAHIR'])){
			$kurang_hal1=1;
			$err1=$err1."<li>Kabupaten lahir belum diisi.</li>";
			$kurang['halaman1']=$err1;
		}
		if(empty($data_mhs_nim['TGL_LAHIR'])){
			$kurang_hal1=1;
			$err1=$err1."<li>Tanggal lahir belum diisi.</li>";
			$kurang['halaman1']=$err1;
		}
		if(empty($data_mhs_nim['ALAMAT_MHS'])){
			$kurang_hal1=1;
			$err1=$err1."<li>Alamat mahasiswa belum diisi.</li>";
			$kurang['halaman1']=$err1;
		}
		if(empty($data_mhs_nim['RT'])){
			$kurang_hal1=1;
			$err1=$err1."<li>Nomor RT mahasiswa belum diisi.</li>";
			$kurang['halaman1']=$err1;
		}
		if(empty($data_mhs_nim['RW_MHS'])){
			$kurang_hal1=1;
			$err1=$err1."<li>Nomor RW mahasiswa belum diisi.</li>";
			$kurang['halaman1']=$err1;
		}
		if(empty($data_mhs_nim['DESA'])){
			$kurang_hal1=1;
			$err1=$err1."<li>Desa mahasiswa belum diisi.</li>";
			$kurang['halaman1']=$err1;
		}
		if(empty($data_mhs_nim['NM_KEC'])){
			/*$kurang_hal1=1;
			$err1=$err1."<li>Kecamatan mahasiswa belum diisi.</li>";
			$kurang['halaman1']=$err1;*/
		}
		if(empty($data_mhs_nim['KD_KAB'])){
			$kurang_hal1=1;
			$err1=$err1."<li>Alamat kabupaten mahasiswa belum diisi.</li>";
			$kurang['halaman1']=$err1;
		}
		if(empty($data_mhs_nim['HP_MHS'])){
			$kurang_hal1=1;
			$err1=$err1."<li>Nomor HP mahasiswa belum diisi.</li>";
			$kurang['halaman1']=$err1;
		}
        if(empty($data_mhs_nim['TINGGI'])){
			$kurang_hal2=1;
			$err1=$err1."<li>Tinggi badan mahasiswa belum diisi.</li>";
			$kurang['halaman1']=$err1;
		}
		if(empty($data_mhs_nim['BERAT'])){
			$kurang_hal1=1;
			$err1=$err1."<li>Berat badan mahasiswa belum diisi.</li>";
			$kurang['halaman1']=$err1;
		}
		/* 
		UNTUK HALAMAN 2
		HALAMAN FISIK KELUARGA
		*/		
        if($this->is_pasca()!='true'){//SELAIN PASCA
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
        }
		/* untuk halaman 10
		HALAMAN DATA RUMAH
		*/
        if($this->is_pasca()!='true'){//SELAIN PASCA
            if(empty($data_rumah)){
                $kurang_hal10=1;
                $err10=$err10."<li>Data rumah belum selesai diisi.</li>";
                $kurang['halaman10']=$err10;
            }
            if($this->is_pasca()=='true'){$kurang['halaman10']='';}///UNTUK PASCA SAJA LEWAT
            /* untuk halaman 12 
            HALAMAN DATA LOKASI PENDIDIKAN */
            if(empty($data_lokasi_pendidikan)){
                $kurang_hal12=1;
                $err12=$err12."<li>Data rencana hidup di lokasi pendidikan belum selesai diisi.</li>";
                $kurang['halaman12']=$err12;
            }
        }
		/*
		Untuk Halaman 3
		HALAMAN DATA IBU
		*/
        if($this->is_pasca()!='true'){//SELAIN PASCA
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
        }
		/*
		Untuk Halaman 4
		HALAMAN DATA BAPAK
		*/
        if($this->is_pasca()!='true'){//SELAIN PASCA
            if(empty($data_mhs_nim['NM_BPK_KANDUNG'])){
                $kurang_hal4=1;
                $err4=$err4."<li>Nama bapak belum diisi.</li>";
                $kurang['halaman4']=$err4;
            }
            if(empty($data_mhs_nim['KERJA_BPK_DETAIL']) && $data_mhs_nim['NM_BPK_KANDUNG']!='TIDAK ADA'){
                $kurang_hal4=1;
                $err4=$err4."<li>Kerja bapak belum diisi.</li>";
                $kurang['halaman4']=$err4;
            }
        }
		/* untuk HALAMAN wali 5
		HALAMAN WALI
		*/
        if($this->is_pasca()!='true'){//SELAIN PASCA
            if(empty($data_mhs_nim['NM_WALI'])){
                $kurang_hal5=1;
                $err5=$err5."<li>Nama wali belum diisi.</li>";
                $kurang['halaman5']=$err5;
            }
        }
		/*
		untuk Halaman 6
		DATA PENDIDIKAN
		*/
		$data_pendidikan=$this->data_pendidikan_ambil($nim);
		if(count($data_pendidikan)<1){
			$kurang_hal6=1;
			$err6=$err6."<li>Data pendidikan belum diisi.</li>";
			$kurang['halaman6']=$err6;
		}
		/*
		untuk Halaman 6+
		DATA NILAI PENDIDIKAN
		*/
        if($this->is_pasca()!='true'){//SELAIN PASCA
            $data_nilai_pend=$this->data_riwayat_nilai_pendidikan_ambil_all($nim);
            if(empty($data_nilai_pend)){
                $kurang_hal11=1;
                $err11=$err11."<li>Data nilai pendidikan belum diisi.</li>";
                $kurang['halaman11']=$err11;
            }
        }
		/* untuk Halaman 7
		untuk halaman 8
		Data organisasi
		*/
        if($this->is_pasca()!='true'){//SELAIN PASCA
            $data_organisasi=$this->data_organisasi_ambil($nim);
            if(count($data_organisasi)<1){
                $kurang_hal7=1;
                $err7=$err7."<li>Data organisasi belum diisi.</li>";
                $kurang['halaman7']=$err7;
            }
        }
		/* 
		untuk Halaman 8
		data Prestasi
		*/
        if($this->is_pasca()!='true'){//SELAIN PASCA
            $data_prestasi=$this->data_prestasi_ambil($nim);
            if(count($data_prestasi)<1){
                $kurang_hal8=1;
                $err8=$err8."<li>Data prestasi belum diisi.</li>";
                $kurang['halaman8']=$err8;
            }
        }
        /* 
		untuk Halaman 9
		data Kegiatan
		*/
        if($this->is_pasca()!='true'){//SELAIN PASCA
            $data_kegiatan=$this->data_kegiatan_ambil($nim);
            if(count($data_kegiatan)<1){
                $kurang_hal14=1;
                $err14=$err14."<li>Data kegiatan belum diisi.</li>";
                $kurang['halaman14']=$err14;
            }
        }
        /* untuk halaman 13
        data hobi
        */
        if($this->is_pasca()!='true'){//SELAIN PASCA
            if(count($data_hobi)<1){
                $kurang_hal13=1;
                $err13=$err13."<li>Data hobi & ketrampilan belum diisi.</li>";
                $kurang['halaman13']=$err13;
            }
        }
		/*
		untuk halaman 9
		data kesehatan
		*/
		$riwayat_kesehatan=$this->data_kesehatan_ambil($nim);
		if(count($riwayat_kesehatan)<1){
			$kurang_hal9=1;
			$err9=$err9."<li>Data kesehatan belum diisi.</li>";
			$kurang['halaman9']=$err9;
		}
		return $kurang;
	}
	 function current_url()
	{
	   $ci=& get_instance();	   
	   $return = site_url()."".$ci->uri->uri_string();
	   if(count($_GET) > 0)
	   {
		  $get =  array();
		  foreach($_GET as $key => $val)
		  {
			 $get[] = $key.'='.$val;
		  }
		  $return .= '?'.implode('&',$get);
	   }
	   return $return;
	}  
	function header($nama_step,$link_step){
		$CI=&get_instance();
        if($CI->session->userdata('status') == "mhs"){
            $label="Isi Data Pribadi Mahasiswa";
        }elseif($CI->session->userdata('status') == "wali"){
            $label="Lihat Data Pribadi Mahasiswa";
        }
		$CI->s00_lib_output->output_info_mhs();
		$CI->load->library("registrasi/lib_reg_fungsi");
		$link=$CI->lib_reg_fungsi->base_url();
		$crumbs = array(
		array('Data Pribadi Mahasiswa' => "$link"),
		array("$label" => "$link/cek"),
		array("$nama_step" => "$link/$link_step"),
		);
		$CI->s00_lib_output->output_crumbs($crumbs);
	}
	function base_url(){
		return "data_pribadi_mahasiswa";
	}
	function data_mhs_nim($nim){
		$CI=&get_instance();
		$data1	= array($nim);
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
				array('api_kode'=>26000, 'api_subkode' => 7, 'api_search' => $data1));
		$CI->session->set_userdata('SESSION_NO_TEST',$isi[0]['NO_TEST']);
		return $isi;
	}
	function data_mhs_semester($nim){
		$CI=&get_instance();
		$data1	= array($nim);
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_krs/data_search', 'POST', 
				array('api_kode'=>63000, 'api_subkode' => 11, 'api_search' => $data1));
		return $isi;
	}
	function data_prodi($kd_prodi){
		$CI=&get_instance();
		$data2	= array($kd_prodi);	
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
				array('api_kode'=>19000, 'api_subkode' => 4, 'api_search' => $data2));	
		return $isi2;
	}
	//DATA PERINGKAT
	function data_peringkat_juara(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>36001, 'api_subkode' => 1));	
		return $isi2;
	}
	function data_peringkat_juara_detail($KD_PERINGKAT){
		$CI=&get_instance();
		if($KD_PERINGKAT){
			$data1	= array($KD_PERINGKAT);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
						array('api_kode'=>36001, 'api_subkode' => 1, 'api_search' => $data1));
			return $isi2[0];
		}
	}
    //DATA MASTER KEPEMILIKAN
    function data_master_kepemilikan(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1007, 'api_subkode' => 1));	
		return $isi2;
	}
    //DATA MASTER MCK
    function data_master_mck(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1008, 'api_subkode' => 1));	
		return $isi2;
	}
    //DATA MASTER SUMBER LISTRIK
    function data_master_sumber_listrik(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1006, 'api_subkode' => 1));	
		return $isi2;
	}
    //DATA MASTER TEMPAT TINGGAL
    function data_master_tempat_tinggal(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1004, 'api_subkode' => 1));	
		return $isi2;
	}
    //DATA MASTER TRANSPORTASI
    function data_master_transportasi(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1005, 'api_subkode' => 1));	
		return $isi2;
	}
	//DATA JENIS KEJUARAAN
	function data_master_kejuaraan_jenis(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>36003, 'api_subkode' => 1));	
		return $isi2;
	}
	function data_master_kejuaraan_jenis_detail($KD_JENIS){
		$CI=&get_instance();
		if($KD_JENIS){
			$data1	= array($KD_JENIS);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
						array('api_kode'=>36003, 'api_subkode' => 1, 'api_search' => $data1));
			return $isi2[0];
		}
	}
	//DATA GROUP KEJUARAAN
	function data_kejuaraan_group($KD_GROUP){
		$CI=&get_instance();
		$data2	= array($KD_GROUP);	
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
				array('api_kode'=>36002, 'api_subkode' => 1, 'api_search' => $data2));	
		return $isi2[0]['NM_GROUP'];
	}
    //DATA KEUANGAN
    function data_keuangan_keluarga_isi($ARR_DATA){
        $CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27008, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		return $isi;
    }
    function data_keuangan_keluarga_ambil($nim){
        $CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27008, 'api_subkode' =>1, 'api_search' => array($nim)));
		return $isi;
    }
    ///HOBI
    function data_hobi_group_list(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1009, 'api_subkode' => 1));	
		return $isi2;
	}
    function data_hobi_group_value($KD_GROUP){
        $CI=&get_instance();
        $data=$this->data_hobi_group_list();
        foreach($data as $k => $v){
            if($v['KD_GROUP']==$KD_GROUP){
                return $v['NM_GROUP'];
                break;
            }
        }
    }
    
    function data_hobi_isi($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27007, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
    function data_hobi_edit($NIM,$ID_RIWAYAT){
        $CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27007, 'api_subkode' =>3, 'api_search' => array($NIM,$ID_RIWAYAT)));
		return $isi;
    }
	function data_hobi_delete($NIM,$ID_RIWAYAT){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27007, 'api_subkode' =>2, 'api_datapost' => array($NIM,$ID_RIWAYAT)));
		return $isi;
	}
	function data_hobi_ambil($NIM){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27007, 'api_subkode' =>1, 'api_search' => array($NIM)));
		return $isi;
	}
	//DATA JENIS KEJUARAAN
	function data_jenis_kejuaraan(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1000, 'api_subkode' => 1));	
		return $isi2;
	}
    //DATA BAHAN BAHAN
    function md_bahan($param){
        $CI=&get_instance();
        switch($param){
            case 'atap':$subkode='1';break;
            case 'dinding':$subkode='2';break;
            case 'lantai':$subkode='3';break;
        }
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1010, 'api_subkode' => $subkode));	
		return $isi2;
    }
	//DATA SUMBER AIR
	function data_sumber_air_list(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1003, 'api_subkode' => 1));
		return $isi2;
	}	
    function data_pemilikan_list(){
        return $isi2;
	}	
	//DATA DIFABEL
	function data_difabel(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1002, 'api_subkode' => 1));
		return $isi2;
	}
	//DATA AGAMA
	function data_agama(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1000, 'api_subkode' => 1));	
		return $isi2;
	}
	//DATA SEKOLAH
	function data_sekolah(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>14000, 'api_subkode' => 2));	
		return $isi2;
	}
	function data_sekolah2($KD_PEND){
		
		$CI=&get_instance();
		$data1	= array($KD_PEND);	
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
				array('api_kode'=>14000, 'api_subkode' => 4, 'api_search' => $data1));	
		return $isi2;
	}
	//DATA PEKERJAAN
	function data_pekerjaan(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1001, 'api_subkode' => 1));	
		return $isi2;
	}
	//DATA NEGARA
	function data_negara(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>11001, 'api_subkode' => 2));	
		return $isi2;
	}
	//DATA KABUPATEN
	function data_kabupaten($katakunci){
		$CI=&get_instance();
		$data1	= array($katakunci);	
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
					array('api_kode'=>12000, 'api_subkode' => 3, 'api_search' => $data1));
		return $isi2;
	}
	function data_kabupaten_detail($KD_KAB){
		$CI=&get_instance();
		if($KD_KAB){
			$data1	= array($KD_KAB);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
						array('api_kode'=>12000, 'api_subkode' => 2, 'api_search' => $data1));
			return $isi2[0];
		}
	}
	function data_kabupaten_list($KD_PROP){
		$CI=&get_instance();
		if($KD_PROP){
			$data1	= array($KD_PROP);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
						array('api_kode'=>12000, 'api_subkode' => 4, 'api_search' => array($KD_PROP)));
			return $isi2;
		}
	}
	//DATA KECAMATAN 
	function data_kecamatan_list($KD_KAB){
		$CI=&get_instance();
		if($KD_KAB){
			$data1	= array($KD_KAB);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
						array('api_kode'=>13000, 'api_subkode' => 4, 'api_search' => array($KD_KAB)));
			return $isi2;
		}
	}
	//DATA PROPINSI
	function data_propinsi_detail($KD_PROP){
		$CI=&get_instance();
		if($KD_PROP){
			$data1	= array($KD_PROP);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
						array('api_kode'=>11000, 'api_subkode' => 1, 'api_search' => $data1));
			return $isi2[0];
		}
	}
	function data_propinsi_list(){
		$CI=&get_instance();
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
						array('api_kode'=>11000, 'api_subkode' => 1, 'api_search' =>array()));
			return $isi2;
	}
    //UPDATE DATA RENCANA HIDUP di LOKASI PENDIDIKAN
	function data_mahasiswa_lokasi_pendidikan_update($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27006, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
    function data_mahasiswa_lokasi_pendidikan_ambil($nim){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27006, 'api_subkode' =>1, 'api_search' => array($nim)));
		return $isi;
	}
	//UPDATE DATA MAHASISWA
	function data_mahasiswa_riwayat_update($nim,$array_data_baru){
		$CI=&get_instance();
		$id_aplikasi='registrasi2013';
		$id_eksekutor='SISTEM';
		$ARR_DATA=array($nim, $id_aplikasi, $id_eksekutor, $array_data_baru);
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>26004, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
    function data_mahasiswa_pekerjaan_update($nim,$alamat,$email,$telepon,$fax,$rt,$rw,$desa,$kd_prop,$kd_kab,$kd_kec,$kdpos){
        $CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>26000, 'api_subkode' =>25, 'api_datapost' => array($nim,$alamat,$email,$telepon,$fax,$rt,$rw,$desa,$kd_prop,$kd_kab,$kd_kec,$kdpos)));
		return $isi;
    }
	function data_mahasiswa_update($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>26000, 'api_subkode' =>19, 'api_datapost' => $ARR_DATA));
		return $isi;
		
	}
	function data_keluarga_update($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>26000, 'api_subkode' =>5, 'api_datapost' => $ARR_DATA));
		return $isi;
		
	}
	function data_lain_update($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>26000, 'api_subkode' =>9, 'api_datapost' => $ARR_DATA));
		return $isi;
		
	}
	function data_ibu_update($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>26000, 'api_subkode' =>6, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	function data_bapak_update($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>26000, 'api_subkode' =>7, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	function data_wali_update($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>26000, 'api_subkode' =>8, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	function data_kesehatan_ambil($NIM){
		$CI=&get_instance();
		if($NIM){
			$data1	= array($NIM);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27001, 'api_subkode' => 2, 'api_search' => $data1));
			return $isi2;
		}
	}
	//NPSN
	function data_npsn_cari($katakunci){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
				array('api_kode'=>14001, 'api_subkode' => 100,'api_search'=>array($katakunci)));	
		return $isi2;
	}
    function data_npsn_cari2($katakunci,$kd_pend){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_search', 'POST', 
				array('api_kode'=>14001, 'api_subkode' => 101,'api_search'=>array($katakunci,$kd_pend)));	
		return $isi2;
	}
	//DATA RIWAYAT PENDIDIKAN
	function data_pendidikan_ambil($NIM){
		$CI=&get_instance();
		if($NIM){
			$data1	= array($NIM);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27000, 'api_subkode' => 2, 'api_search' => $data1));
			return $isi2;
		}
	}
	function data_pendidikan_ambil_edit($NIM,$ID_RIWAYAT){
		$CI=&get_instance();
		$data=$this->data_pendidikan_ambil($NIM);
		foreach($data as $key => $val){
			if($val['ID_RIWAYAT']==$ID_RIWAYAT){
				$fix['KD_PEND']=$val['KD_PEND'];
				$fix['NM_PEND']=$val['NM_PEND'];
				$fix['NM_SEKOLAH']=$val['NM_SEKOLAH'];
				$fix['JURUSAN']=$val['JURUSAN'];
				$fix['THN_LULUS']=$val['THN_LULUS'];
				$fix['NEM']=$val['NEM'];
				$fix['STTB']=$val['STTB'];
                $fix['NISN']=$val['NISN'];
                $fix['NPSN']=$val['NPSN'];
				$fix['KETERANGAN']=$val['KETERANGAN'];
				$fix['ID_RIWAYAT']=$val['ID_RIWAYAT'];
				$fix['KD_SEKOLAH_ASAL']=$val['KD_SEKOLAH_ASAL'];
				$fix['NO_IJASAH_SMA']=$val['NO_IJASAH_SMA'];
				return $fix;
				break;
			}else{
				continue;
			}
		}
	}
	function data_pendidikan_ambil_tertinggi($NIM){
		$CI=&get_instance();
		$data=$this->data_pendidikan_ambil($NIM);
		echo "<!--";
		print_r($data);
		echo "-->";
		$temp='';
		foreach($data as $key => $val){
			$KD_SEKOLAH_ASAL=$val['KD_SEKOLAH_ASAL'];
			if($KD_SEKOLAH_ASAL > $temp){
				$fix['KD_PEND']=$val['KD_PEND'];
				$fix['NM_PEND']=$val['NM_PEND'];
				$fix['NM_SEKOLAH']=$val['NM_SEKOLAH'];
				$fix['JURUSAN']=$val['JURUSAN'];
				$fix['THN_LULUS']=$val['THN_LULUS'];
				$fix['NEM']=$val['NEM'];
				$fix['STTB']=$val['STTB'];
				$fix['KETERANGAN']=$val['KETERANGAN'];
				$fix['ID_RIWAYAT']=$val['ID_RIWAYAT'];
				$fix['KD_SEKOLAH_ASAL']=$val['KD_SEKOLAH_ASAL'];
				$fix['NO_IJASAH_SMA']=$val['NO_IJASAH_SMA'];
				//
				$temp=$KD_SEKOLAH_ASAL;
			}
		}
		return $fix;
	}
	function data_pendidikan(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>10000, 'api_subkode' => 1));	
		return $isi2;
	}
	function kd_data_pendidikan(){
		$CI=&get_instance();
		$jenjang=strtoupper($CI->session->userdata('mhs_jenjang'));
		$data=$this->data_pendidikan();
		foreach($data as $key => $val){
			$NM_PEND=$val['NM_PEND'];
			$KD_PEND=$val['KD_PEND'];
			$NM_PEND=strtoupper($NM_PEND);
			$KD_PEND=strtoupper($KD_PEND);
			if(trim($NM_PEND)==trim($jenjang)){
				$pilihan=$KD_PEND;
				break;
			}
		}
		return $pilihan;
	}
	//upload
	function dokumen_upload($field_name){
		$this->ci=&get_instance();
		$file_name=$_FILES[$field_name]['name'];
		$file_value=$_FILES[$field_name]['tmp_name'];
		$allowed_size='1024000';
		$allowed_size_label='1 MB';
		//$location=$this->dokumen_lokasi();
		$allowed_ext=array('gif','jpg','jpeg','png','pdf','GIF','JPG','JPEG','PNG','PDF');
		$allowed_ext_label="gif, jpg, jpeg, png atau pdf";
		////////////
		if($file_name){
			$info = pathinfo($file_name);
			$ext=$info['extension'];
			if(!in_array(strtoupper($ext),$allowed_ext)){
				$err=$err."<li>file $file_name punya tipe $ext, extensi yang diperbolehkan adalah : $allowed_ext_label</li>";
			}
			//echo filesize($file_value)." - ".$allowed_size;
			
			if(filesize($file_value)>$allowed_size){
				//$err=$err."<li>file $file_name punya ukuran ".$this->format_bytes(filesize($file_value)).",".
				//" ukuran file yang diijinkan tidak boleh lebih dari $allowed_size_label</li>";
				$err=$err."<li>Ukuran file $file_name tidak diperbolehkan lebih dari $allowed_size_label</li>";
			}
			
		}
		if($err){
			return $err;
		}
	}
    //DATA KELUARGA FILE AMBIL
    /* jenis		= 'IBU', 'BAPAK', 'WALI', 'MISKIN' */
    function data_keluarga_file_ambil($jenis,$nim){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27005, 'api_subkode' =>2, 'api_search' => array($nim,$jenis)));
		return $isi;
	}
    function data_keluarga_file_isi($jenis,$nim,$file_berkas,$nama_berkas){
		$CI=&get_instance();
		$file_berkas	= base64_encode(file_get_contents($file_berkas));
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
			array('api_kode'=>27005, 'api_subkode' =>1, 'api_datapost' =>array($jenis,$nim,$file_berkas,$nama_berkas)));
		return $isi;
	}
	///DATA SUMBER AIR MASUKKAN
	function data_rumah_isi($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27002, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	function data_rumah_file_ambil($jenis,$nim){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27002, 'api_subkode' =>3, 'api_search' => array($nim,$jenis)));
		return $isi;
	}
	function data_rumah_file_isi($jenis,$nim,$file_berkas,$nama_berkas){
		$CI=&get_instance();
		$file_berkas	= base64_encode(file_get_contents($file_berkas));
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
			array('api_kode'=>27002, 'api_subkode' =>4, 'api_datapost' =>array($jenis,$nim,$file_berkas,$nama_berkas)));
		return $isi;
	}
	function data_rumah_ambil($NIM){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27002, 'api_subkode' =>1, 'api_search' => array($NIM)));
		return $isi;
	}
	function data_rumah_air_isi($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27003, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	function data_rumah_air_delete($NIM){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27003, 'api_subkode' =>2, 'api_datapost' => array($NIM)));
		return $isi;
	}
	function data_rumah_air_ambil($NIM){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27003, 'api_subkode' =>1, 'api_search' => array($NIM)));
		return $isi;
	}
	///////////////////////////////////
	function data_riwayat_kesehatan_isi($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27001, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	function data_riwayat_kesehatan_delete($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27001, 'api_subkode' =>2, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	//////////////////////////////////////
	function data_riwayat_pendidikan_isi($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27000, 'api_subkode' =>12, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	function data_riwayat_nilai_pendidikan_isi($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27004, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	function data_riwayat_nilai_pendidikan_ambil_all($NIM){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27004, 'api_subkode' =>1, 'api_search' => array($NIM)));
		return $isi;
	}
	function data_riwayat_nilai_pendidikan_ambil($NIM,$KD_PEND){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27004, 'api_subkode' =>2, 'api_search' => array($NIM,$KD_PEND)));
		return $isi;
	}
	function data_riwayat_nilai_pendidikan_edit($NIM,$ID_RIWAYAT){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>27004, 'api_subkode' =>4, 'api_search' => array($NIM,$ID_RIWAYAT)));
		return $isi;
	}

	function data_riwayat_pendidikan_delete($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27000, 'api_subkode' =>2, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	function data_riwayat_nilai_pendidikan_delete($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>27004, 'api_subkode' =>4, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	//DATA PRESTASI
	function data_prestasi_isi($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>37000, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
    function data_prestasi_isi_file($nim,$id_riwayat,$file,$filename){
        $CI=&get_instance();
        $file=base64_encode(file_get_contents($file));
        $ARR_DATA=array('SERTIF_LOMBA',$nim,$id_riwayat,$file,$filename);
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>37000, 'api_subkode' =>4, 'api_datapost' => $ARR_DATA));
		return $isi;
    }
    function data_prestasi_ambil_file($nim,$id_riwayat){
        $CI=&get_instance();
        $data1	= array($nim,$id_riwayat);	
        $isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>37000, 'api_subkode' => 5, 'api_search' => $data1));
        return $isi2;
    }
	function data_prestasi_ambil($NIM){
		$CI=&get_instance();
		if($NIM){
			$data1	= array($NIM);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>37000, 'api_subkode' => 2, 'api_search' => $data1));
			return $isi2;
		}
	}
	function data_prestasi_ambil_edit($NIM,$ID_RIWAYAT){
		$CI=&get_instance();
		$data=$this->data_prestasi_ambil($NIM);
		foreach($data as $key => $val){
			if($val['ID_RIWAYAT']==$ID_RIWAYAT){
				$fix['ID_RIWAYAT']=$val['ID_RIWAYAT'];
				$fix['NM_PRESTASI']=$val['NM_PRESTASI'];
				$fix['NM_PEMBERI']=$val['NM_PEMBERI'];
				$fix['BIDANG']=$val['BIDANG'];
				$fix['THN_BERI']=$val['THN_BERI'];
				$fix['KETERANGAN']=$val['KETERANGAN'];
				$fix['KD_PERINGKAT']=$val['KD_PERINGKAT'];
				$fix['KD_JENIS']=$val['KD_JENIS'];
				$fix['JUARA_KE']=$val['JUARA_KE'];
				$fix['TIPE_KOMPETISI']=$val['TIPE_KOMPETISI'];
                /////
                $fix['NM_LOMBA']=$val['NM_LOMBA'];
                $fix['NM_LOMBA2']=$val['NM_LOMBA2'];
                $fix['NM_LOMBA3']=$val['NM_LOMBA3'];
                $fix['NM_PENY_LOMBA']=$val['NM_PENY_LOMBA'];
                $fix['NM_PENY_LOMBA2']=$val['NM_PENY_LOMBA2'];
                $fix['NM_PENY_LOMBA3']=$val['NM_PENY_LOMBA3'];
        $fix['TGL_MULAI_LOMBA']=str_replace("-","/",str_replace(" 00:00:00","",$val['TGL_MULAI_LOMBA_F']));;
        $fix['TGL_AKHIR_LOMBA']=str_replace("-","/",str_replace(" 00:00:00","",$val['TGL_AKHIR_LOMBA_F']));
                $fix['NO_SERTIF_LOMBA']=$val['NO_SERTIF_LOMBA'];
                $fix['DOC_SERTIF_LOMBA_NAME']=$val['DOC_SERTIF_LOMBA_NAME'];
				return $fix;
				break;
			}else{
				continue;
			}
		}
	}
	function data_prestasi_delete($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>37000, 'api_subkode' =>2, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	//DATA KEGIATAN
	function data_jenis_kegiatan(){
		$CI=&get_instance();
		$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_master/data_view', 'POST', 
				array('api_kode'=>1011, 'api_subkode' => 1));	
		return $isi2;
	}
	function get_jenis_kegiatan($KD_JENIS){
		foreach($this->data_jenis_kegiatan() as $k => $v){
			if($v['KD_JENIS']==$KD_JENIS){
				return $v['NM_JENIS'];
				break;
			}
		}
	}
	function data_kegiatan_isi($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>36001, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	function data_kegiatan_ambil($NIM){
		$CI=&get_instance();
		if($NIM){
			$data1	= array($NIM);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>36001, 'api_subkode' => 2, 'api_search' => $data1));
			return $isi2;
		}
	}
	function data_kegiatan_isi_file($nim,$id_riwayat,$file,$filename){
        $CI=&get_instance();
        $file=base64_encode(file_get_contents($file));
        $ARR_DATA=array('SERTIF_LOMBA',$nim,$id_riwayat,$file,$filename);
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>36001, 'api_subkode' =>4, 'api_datapost' => $ARR_DATA));
		return $isi;
    }
    function data_kegiatan_ambil_file($nim,$id_riwayat){
        $CI=&get_instance();
        $data1	= array($nim,$id_riwayat);	
        $isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>36001, 'api_subkode' => 5, 'api_search' => $data1));
        return $isi2;
    }
    function data_kegiatan_ambil_edit($NIM,$ID_RIWAYAT){
		$CI=&get_instance();
		$data=$this->data_kegiatan_ambil($NIM);
		foreach($data as $key => $val){
			if($val['ID_RIWAYAT']==$ID_RIWAYAT){		
				$val['TGL_MULAI_KEGIATAN']=str_replace("-","/",str_replace(" 00:00:00","",$val['TGL_MULAI_KEGIATAN_F']));;
       	 		$val['TGL_AKHIR_KEGIATAN']=str_replace("-","/",str_replace(" 00:00:00","",$val['TGL_AKHIR_KEGIATAN_F']));		
				return $val;
				break;
			}else{
				continue;
			}
		}
	}
	function data_kegiatan_delete($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>36001, 'api_subkode' =>2, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	//DATA ORGANISASI
	function data_organisasi_isi($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>36000, 'api_subkode' =>1, 'api_datapost' => $ARR_DATA));
		//print_r($ARR_DATA);
		return $isi;
	}
	function data_organisasi_ambil($NIM){
		$CI=&get_instance();
		if($NIM){
			$data1	= array($NIM);	
			$isi2	= $CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_search', 'POST', 
						array('api_kode'=>36000, 'api_subkode' => 2, 'api_search' => $data1));
			
			return $isi2;
		}
	}	
	function data_organisasi_ambil_edit($NIM,$ID_RIWAYAT){
		$CI=&get_instance();
		$data=$this->data_organisasi_ambil($NIM);

		foreach($data as $key => $val){
			if($val['ID_RIWAYAT']==$ID_RIWAYAT){
				$fix['ID_RIWAYAT']=$val['ID_RIWAYAT'];
				$fix['NM_ORGANISASI']=$val['NM_ORGANISASI'];
				$fix['NM_ORGANISASI2']=$val['NM_ORGANISASI2'];
				$fix['NM_ORGANISASI3']=$val['NM_ORGANISASI3'];
				$fix['BID_ORGANISASI']=$val['BID_ORGANISASI'];
				$fix['BID_ORGANISASI2']=$val['BID_ORGANISASI2'];
				$fix['BID_ORGANISASI3']=$val['BID_ORGANISASI3'];
				$fix['THN_MASUK']=$val['THN_MASUK'];
				$fix['LAMA']=$val['LAMA'];
				$fix['JABATAN']=$val['JABATAN'];
				$fix['KETERANGAN']=$val['KETERANGAN'];
				$fix['TGL_MULAI']=$val['TGL_MULAI'];
				$fix['TGL_AKHIR']=$val['TGL_AKHIR'];
				return $fix;
				break;
			}else{
				continue;
			}
		}
	}
	function data_organisasi_delete($ARR_DATA){
		$CI=&get_instance();
		$isi=$CI->s00_lib_api->get_api_json(URL_API_SIA.'sia_mahasiswa/data_procedure', 'POST', 
						array('api_kode'=>36000, 'api_subkode' =>2, 'api_datapost' => $ARR_DATA));
		return $isi;
	}
	//COMMON FUNCTION
	function petix($string){
		error_reporting(0);
        //$string=ereg_replace("'","''",$string);
		$string=ereg_replace("'","'",$string);
		return $string;
	}
	function bersihkan($string){
		$string =@htmlspecialchars($string);
		$string =@ereg_replace("\n","<br/>",$string);
		$string=$this->petix($string);
		return $string;
	}
	function asli($string){
		$string =@ereg_replace("<br/>","\n",$string);
		$string=$this->petix($string);
		return $string;
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
	function bar128($text) {				
		$char128asc=' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';					
		$char128wid = array(
			'212222','222122','222221','121223','121322','131222','122213','122312','132212','221213', // 0-9 
			'221312','231212','112232','122132','122231','113222','123122','123221','223211','221132', // 10-19 
			'221231','213212','223112','312131','311222','321122','321221','312212','322112','322211', // 20-29 			
			'212123','212321','232121','111323','131123','131321','112313','132113','132311','211313', // 30-39 
			'231113','231311','112133','112331','132131','113123','113321','133121','313121','211331', // 40-49 
			'231131','213113','213311','213131','311123','311321','331121','312113','312311','332111', // 50-59 
			'314111','221411','431111','111224','111422','121124','121421','141122','141221','112214', // 60-69 
			'112412','122114','122411','142112','142211','241211','221114','413111','241112','134111', // 70-79 
			'111242','121142','121241','114212','124112','124211','411212','421112','421211','212141', // 80-89 
			'214121','412121','111143','111341','131141','114113','114311','411113','411311','113141', // 90-99
			'114131','311141','411131','211412','211214','211232','23311120'   );
		// Part 1, make list of widths
	  //global $char128asc,$char128wid;				
	  $w = $char128wid[$sum = 104];							// START symbol
	  $onChar=1;
	  for($x=0;$x<strlen($text);$x++)								// GO THRU TEXT GET LETTERS
	    if (!( ($pos = strpos($char128asc,$text[$x])) === false )){	// SKIP NOT FOUND CHARS
		  $w.= $char128wid[$pos];
		  $sum += $onChar++ * $pos;
		}					
	  $w.= $char128wid[ $sum % 103 ].$char128wid[106];  		//Check Code, then END
	$jum=0;	 					 						//Part 2, Write rows
	  $html="<table class=\"tb128\" cellpadding=\"0\" cellspacing=\"0\"><tr>";				
	  for($x=0;$x<strlen($w);$x+=2) {  						// code 128 widths: black border, then white space
		$html .= "<td valign=\"top\" style=\"width:5px\"><div class=\"b128\" style=\"border-left-width:{$w[$x]};width:{$w[$x+1]}\"></div></td>";	
		$jum=$jum+1;
	  }

	  return "$html</tr><tr><td  colspan=\"$jum\" align=\"center\"><b>$text</b></td></tr></table>";		
	}
}