<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function sia_button_icon($tipe, $aurl, $atxt, $aother){
	
}


function sia_is_nip_pns($nip){
	$is_pns = 1;
	if(strlen(trim($nip)) == 18){ $nip1 = sia_nip_staff($nip); } 
	else { $nip1 = preg_replace("/[^0-9A-Z]/", "", strtoupper($nip)); }
		
	if(strlen($nip1) == 21){
		if(substr($nip1,9,4) == '0000'){ $is_pns = 0; }
		else {
			$chr1 = preg_replace("/[^A-Z]/", "", strtoupper($nip1));
			if($chr1 != ''){ $is_pns = 0; }
		}
	} else { $is_pns = 0; }
	return $is_pns;
}

function sia_urlfoto($url = ''){
	$url = str_replace('http://service.uin-suka.ac.id/servsiasuper/foto',base_url('foto'),$url);
	$url = str_replace('http://service.uin-suka.ac.id/servsiasuper/index.php/foto',base_url('foto'),$url);
	return $url;
}

function sia_comment($data1 = array()){
	echo '<!--'; print_r($data1); echo '-->';
}

function sia_daftar_timajar($txt1, $case = false, $hidedlb = false, $link = false, $nipbreak = false){
	if($case){ $txt1 = strtoupper($txt1); }
	if($nipbreak){ $nipbreak1 = '<br>'; } else { $nipbreak1 = ''; }
	$txt11 = explode('#',$txt1);
	$hasil = '';
	
	#print_r($txt11 );
	#$hasil = '<ol style="margin-left: 20px; ">';
	foreach($txt11 as $n1){
		$n11 	= explode('+', $n1);
		$mode 	= 0;
		#$hasil .= '<li>'.$n11[1].' ('.$n11[0].')'.'</li>';
		if($hidedlb){
		if(strlen(trim($n11[0])) != 18){ $mode = 0;
		} else { if(!$link){ $mode = 1; } else { $mode = 2; } }
		} else { if(!$link){ $mode = 1; } else { $mode = 2; } }
		
		switch($mode){
			case 0:
			$hasil .= ''.$n11[1].'<br>'; break;
			case 1:
			$hasil .= ''.$n11[1].' '.$nipbreak1.'('.sia_nip_staff($n11[0]).')'.'<br>'; break;
			case 2:
			$nip1 = preg_replace("/[^A-Z0-9]/", "", sia_nip_staff($n11[0]));
			$url1 = str_replace('%LINK%',t1_encode($nip1),$link);
			$ttt1 = 'title="lihat daftar kelas yang diampu oleh dosen '.$n11[1].'" class="link"';
			$hasil .= ''.$n11[1].' ('.anchor($url1,sia_nip_staff($n11[0]),$ttt1).')'.'<br>';
			break;
		}
		
	}
	#$hasil .= '</ol>'; 
	return trim($hasil,'<br>');
}

function sia_nip_staff($nip = ''){
	if(strlen(trim($nip)) == 18){
		$nip = preg_replace("/[^A-Z0-9]/", "", strtoupper($nip));
		return substr($nip,0,8).' '.substr($nip,8,6).' '.substr($nip,14,1).' '.substr($nip,15,3);
	} else { return $nip; }
}

function sia_nip_staff_kd($nip = '', $kd1 = ''){
	$nip = preg_replace("/[^A-Z0-9]/", "", strtoupper(trim($nip)));
	$kd1 = preg_replace("/[^A-Z0-9]/", "", strtoupper(trim($kd1)));
	
	if($nip != ''){
		return sia_nip_staff($nip);
	} else {
		return sia_nip_staff($kd1);
	}
}

function sia_cek_dosenpns($nip = ''){
		if(strlen(trim($nip)) == 18){
			$nip1 = sia_nip_staff($nip);	
		} else {
			$nip1 = preg_replace("/[^0-9A-Z]/", "", strtoupper($nip));
		}
		
		if(strlen($nip1) == 21){
			if(substr($nip1,9,4) == '0000'){ return false; }
			else {
				$chr1 = preg_replace("/[^A-Z]/", "", strtoupper($nip1));
				if($chr1 != ''){ return false; } else { return true; }
			}
		} else { return false; }
}

function sia_numbertoroman($num){
     // Make sure that we only use the integer portion of the value
     $n = intval($num);
     $result = '';
 
     // Declare a lookup array that we will use to traverse the number:
     $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
     'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
     'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
 
     foreach ($lookup as $roman => $value) 
     {
         // Determine the number of matches
         $matches = intval($n / $value);
 
         // Store that many characters
         $result .= str_repeat($roman, $matches);
 
         // Substract that from the number
         $n = $n % $value;
     }
 
     // The Roman numeral should be built, return it
     return $result;
}

function sia_number_to_words($number) {
    
    $hyphen      = '-';
    $conjunction = ' dan ';
    $separator   = ', ';
    $negative    = 'negatif ';
    $decimal     = ' titik ';
    $dictionary  = array(
        0                   => 'nol',
        1                   => 'Satu',
        2                   => 'Dua',
        3                   => 'Tiga',
        4                   => 'Empat',
        5                   => 'Lima',
        6                   => 'Enam',
        7                   => 'Tujuh',
        8                   => 'Delapan',
        9                   => 'Sembilan',
        10                  => 'Sepuluh',
        11                  => 'Sebelas',
        12                  => 'Dua belas',
        13                  => 'Tiga belas',
        14                  => 'Empat belas',
        15                  => 'Lima belas',
        16                  => 'Enam belas',
        17                  => 'Tujuh belas',
        18                  => 'Delapan belas',
        19                  => 'Sembilan belas',
        20                  => 'Dua puluh',
        30                  => 'Tiga puluh',
        40                  => 'Empat puluh',
        50                  => 'Lima puluh',
        60                  => 'Enam puluh',
        70                  => 'Tujuh puluh',
        80                  => 'Delapan puluh',
        90                  => 'Sembilan puluh',
        100                 => 'Seratus',
        1000                => 'Seribu',
        1000000             => 'Seratus ribu',
        1000000000          => 'Satu triliyun',
        1000000000000       => 'Satu biliyun',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number)) {
        return false;
    }
    
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    
    $string = $fraction = null;
    
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    
    return $string;
}

function subsub2($in, $arr){ $hasil = true; foreach($arr as $r) { if ($in == $r): $hasil = false; break; endif; } return $hasil; }
function krs_encode($str){ $hasil = '';
	for($i = 0; $i < strlen($str); $i++){
		switch($i){
			case 0: case 1: case 5: case 3:
			$hasil .= chr(ord($str[$i])+17); break;
			case 4: case 2: case 6: case 7:
			$hasil .= chr(ord($str[$i])+50); break;
			case 8: case 10: case 12: case 13:
			$hasil .= chr(ord($str[$i])+20); break;
			case 9: case 11: case 14: case 15:
			$hasil .= chr(ord($str[$i])+55); break;
			case 16: case 18: case 20:
			$hasil .= chr(ord($str[$i])+22); break;
			case 17: case 19:
			$hasil .= chr(ord($str[$i])+51); break;
		}
	} return $hasil;
}

function krs_decode($str){ $hasil = '';
	for($i = 0; $i < strlen($str); $i++){
		switch($i){
			case 0: case 1: case 5: case 3:
			$hasil .= chr(ord($str[$i])-17); break;
			case 4: case 2: case 6: case 7:
			$hasil .= chr(ord($str[$i])-50); break;
			case 8: case 10: case 12: case 13:
			$hasil .= chr(ord($str[$i])-20); break;
			case 9: case 11: case 14: case 15:
			$hasil .= chr(ord($str[$i])-55); break;
			case 16: case 18: case 20:
			$hasil .= chr(ord($str[$i])-22); break;
			case 17: case 19:
			$hasil .= chr(ord($str[$i])-51); break;
		}
	} return $hasil;
}

function t1_encode($kd_kelas, $enckey = ''){ $hasil = ''; #return $kd_kelas;
		if ($enckey == ''){ $str 	= 'XpRo0etfOK4MINSlwFZsng3bAdac5_UEmQzv2YBTH8CVh7j6iL9kPD1JWyuqGxr#-.:/ *='; } else { $str = $enckey; }
		
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
	
	
	#return $str;
	/* $t_arr 	= array('f','d','X','Z','i', 'U','r','L','z','W');
	$yt		= array('ZwcfiTdXpUYrzoLMWFna','LzhMYQFnawcfdXZiTpUr','iTpUewcfdKzoMnZLYWFa');
	$t = 0; for($i = 0; $i < strlen($str); $i++){
		$t = $t + (int)$str[$i]; }
	$t5 = fmod($t,10); $t1 = $t_arr[$t5]; $hasil .= $t1;
	
	for($i = 0; $i < strlen($str); $i++){
		$r = fmod($i,3); $s = intval($str[$i]);
		$hasil .= substr($yt[$r], ($s+$t5), 1);
	} return $hasil; */
}

function t1_decode($kd_enc, $enckey = ''){ $hasil = '';  #return $kd_enc;
		if ($enckey == ''){ $str 	= 'XpRo0etfOK4MINSlwFZsng3bAdac5_UEmQzv2YBTH8CVh7j6iL9kPD1JWyuqGxr#-.:/ *='; } else { $str = $enckey; }
		
		$arr_e = array();  $arr_e1 = array(); $arr_r = array(); $arr_r1 = array();
		for($j = 0; $j < strlen($str); $j++){
			$j_ = $j; if ($j_ < 10) { $j_ = '0'.$j_; }
			$arr_e1[$j] = substr($str,$j,1);
			$arr_e[$j_] = substr($str,$j,1);
			$arr_r1[substr($str,$j,1)] = $j;
			$arr_r[substr($str,$j,1)] = $j_;
		}
		
		$uniq = substr($kd_enc,0,1);
		$hash = hash('sha256', $kd_enc.date('his')); for($j = 0; $j < 1000; $j++){ $hash = hash('sha256', $hash); }
		$kd_dec = $hash;
		
		if(!isset($arr_r1[$uniq])){ return $hash; }#$kd_dec; }
		else { 
		$ur = $arr_r1[$uniq]; #return $arr_r1['!'];
		
		#if(fmod(strlen($kd_enc),2) == 0){ 
		$kd_dec = '';
		for($i = 1; $i < strlen($kd_enc); $i++){
			$angka = substr($kd_enc,$i,2);
			if (substr($angka,0,1) == '0') { $angka = substr($angka,1,1); }
			$angka_ = (int)$angka - $ur;
			if(isset($arr_e1[$angka_])){
				$kd_dec .= $arr_e1[$angka_];
				$i= $i+2;
			} else { return $hash; break; }
		}#}
		return $kd_dec;}
	
	/* return $str;
	$t_arr 	= array('f','d','X','Z','i', 'U','r','L','z','W');
	$yt		= array('ZwcfiTdXpUYrzoLMWFna','LzhMYQFnawcfdXZiTpUr','iTpUewcfdKzoMnZLYWFa');
	
	#$t_arr = array('g' => 0,'H' => 1,'L' => 2,'k' => 3,'q' => 4, 'w' => 5,'F' => 6,'Z' => 7,'V' => 8,'i' => 9);
	$t = 0; for($i = 0; $i < count($t_arr); $i++){
		if ($str[0] == $t_arr[$i]) { $t = $i; break;} }
	#$t1 = $t_arr[fmod($t,10)]; $hasil .= $t1;
	
	$str = substr($str,1,strlen($str)-1);
	
	#return $t.$str;
	for($i = 0; $i < strlen($str); $i++){
		$r = fmod($i,3); $s = $str[$i];
		$hasil .= strpos($yt[$r],$s)-$t;
	} return $hasil; */
}

function sia_search_array($arr = array(), $key_search, $key_get, $target){	
	$get = '';
	foreach($arr as $arr_){ if($arr_[$key_search] == $target) { $get = $arr_[$key_get]; break; }} return $get;
}

function sia_ta_select($arr = array(), $bottom, $top){	
	$hasil = array();
	foreach($arr as $arr_){ 
		if(((int)$arr_['KD_TA'] >= (int)$bottom) && ((int)$arr_['KD_TA'] <= (int)$top)){
			$hasil[$arr_['KD_TA']] = $arr_['TA'];
		}
	} return $hasil;
}

		function sia_trans_status_absen($kode){
			switch($kode){
				case 'H': return 'HADIR'; break;
				case 'S': return 'SAKIT'; break;
				case 'I': return 'IJIN'; break;
				case 'D': return 'DISPENSASI'; break;
				case 'B': return 'BOLOS'; break;
				case 'L': return 'LAIN-LAIN'; break;
				default: return '-'; break;
			}
		}
		function sia_trans_status_absen_color($kode){
			switch($kode){
				case 'H': return 'FFF'; break;
				case 'S': return 'FFC'; break;
				case 'I': return 'CFF'; break;
				case 'D': return 'CFC'; break;
				case 'B': return 'FCC'; break;
				case 'L': return 'CCC'; break;
				default: return 'FFF'; break;
				
				/* case 'H': return 'FFF'; break;
				case 'S': return 'A4884A7'; break;
				case 'I': return '87CEEB'; break;
				case 'D': return '9ACD32'; break;
				case 'B': return 'CC0000'; break;
				case 'L': return 'C0C0C0'; break; */
				default: return 'FFF'; break;
			}
		}
		
function sia_flash_message($all_aksi = array()){
	if(!empty($all_aksi)){ foreach($all_aksi as $aksi){
		$pesan1 = ''; $pesan2 = ''; $okfalse = '';
		
		if(!isset($aksi['precond'])){ $aksi['precond'] = true; }
		
		if(intval($aksi['result']) == 1) { $okfalse = 'BERHASIL'; } else { 
			$okfalse = 'GAGAL'; 
			if($aksi['name'] == 'P_INPUT_DETAIL_KRS'){
				$tt = explode('ORA',$aksi['error']['message']);
				$pesan2 = substr($tt[1],8,(strlen($tt[1])-9));
				//$pesan2 = '';
			}
		}
		$okfalse = '<strong>'.$okfalse.'</strong>';
		
		switch($aksi['name']){
			case 'P_INPUT_DETAIL_KRS': 				
				$pesan1 = 'INPUT MATA KULIAH <strong>'.$aksi['nm_mk'].'</strong> KE DALAM KRS '.$okfalse.'.'; 
				$pesan2 .= ''; 
				break;
			case 'RE_INPUT_DETAIL_KRS': 				
				$pesan1 = 'INPUT ULANG MATA KULIAH <strong>'.$aksi['nm_mk'].'</strong> KE DALAM KRS '.$okfalse.'.'; 
				$pesan2 = ''; 
				break;
			case 'P_DEL_DETAIL_KRS': 				
				$pesan1 = 'MATA KULIAH <strong>'.$aksi['nm_mk'].'</strong> '.$okfalse.' DIHAPUS DARI KRS SEMESTER INI.'; 
				$pesan2 .= ''; 
				break;
				
			case 'P_UBAH_LARANG_KRS_PWALI': 		
				$pesan1 = $okfalse.' MENCABUT LARANGAN AMBIL MATA KULIAH <strong>'.$aksi['nm_mk'].'</strong>.'; 
				$pesan2 = 'MAHASISWA DAPAT MENGAMBIL MATA KULIAH INI DI KRS SEMESTER INI.';
				break;
			case 'M_LARANG_AMBIL': 		
				$pesan1 = $okfalse.' MELARANG MAHASISWA MENGAMBIL MATA KULIAH <strong>'.$aksi['nm_mk'].'</strong>.'; 
				$pesan2 = 'MAHASISWA TIDAK DAPAT MENGAMBIL MATA KULIAH INI DI KRS SEMESTER INI.';
				break;
			case 'M_SARAN_MK': 		
				$pesan1 = 'MATA KULIAH <strong>'.$aksi['nm_mk'].'</strong> '.$okfalse.' DISARANKAN.'; 
				$pesan2 = 'MATA KULIAH INI ADA DI KRS MAHASISWA.';
				break;
			case 'M_BATAL_SARAN_MK': 		
				$pesan1 = 'MATA KULIAH <strong>'.$aksi['nm_mk'].'</strong> '.$okfalse.' BATAL DISARANKAN.'; 
				$pesan2 = 'MATA KULIAH INI SUDAH DIHAPUS DARI KRS MAHASISWA.';
				break;
				
			
		}
		
		if($aksi['precond']){
			if($aksi['result']) { $st1 = 'success'; } else { $st1 = 'error'; }
			echo '<div class="bs-callout bs-callout-'.$st1.'">'.trim($pesan1.'<br>'.$pesan2).'</div>';
		}
	}}
}

	function sia_msg_salam(){
		$jam = date('H');
		switch($jam){
			case 19: case 20: case 21: case 22: case 23:
			case 0: case 1: case 2: 
				return 'malam'; break;
			case 3: case 4: case 5: case 6: case 7:
			case 8: case 9: 
				return 'pagi'; break;
			case 10: case 11: case 12: case 13: case 14:
				return 'siang'; break;
			case 15: case 16: case 17: case 18:
				return 'sore'; break;
		}
	}
	function sia_msg_kelamin($klm=''){
		#$klm = $this->session->userdata('mhs_kelamin');
		switch($klm){
			case 'LAKI-LAKI': return ' Sdr. '; break;
			case 'PEREMPUAN': return ' Sdri. '; break;
			default: return ' '; break;
		}
	}
	
	if ( ! function_exists('tgl_indo'))
	{
		function tgl_indo($tgl)
		{
			$tgl1=date('Y-m-d',$tgl);
			$jam=date('H:i',$tgl);
			$ubah = gmdate($tgl1, time()+60*60*8);
			$pecah = explode("-",$ubah);
			$tanggal = $pecah[2];
			$bulan = bulan($pecah[1]);
			$tahun = $pecah[0];
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam.' WIB';
		}
		function tgl_indo_short($tgl)
		{
			#Format tanggal harus sudah dalam bentuk date("Y-m-d")
			$tgl1		= $tgl;			
			$ubah 		= gmdate($tgl1, time()+60*60*8);
			$pecah 		= explode("-",$ubah);
			$tanggal 	= $pecah[2];
			$bulan 		= bulan($pecah[1]);
			$tahun 		= $pecah[0];
			return $tanggal.' '.$bulan.' '.$tahun;
		}
	}
	
	if ( ! function_exists('bulan'))
	{
		function bulan($bln)
		{
			switch ($bln)
			{
				case 1:
					return "Januari";
					break;
				case 2:
					return "Februari";
					break;
				case 3:
					return "Maret";
					break;
				case 4:
					return "April";
					break;
				case 5:
					return "Mei";
					break;
				case 6:
					return "Juni";
					break;
				case 7:
					return "Juli";
					break;
				case 8:
					return "Agustus";
					break;
				case 9:
					return "September";
					break;
				case 10:
					return "Oktober";
					break;
				case 11:
					return "November";
					break;
				case 12:
					return "Desember";
					break;
			}
		}
	}

/* End of file sia_helper.php */
/* Location: ./system/helpers/date_helper.php */