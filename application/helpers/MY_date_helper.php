<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function sia_rip_tags($string = ''){
	$string = preg_replace ('/<[^>]*>/', ' ', $string); 
    
    // ----- remove control characters ----- 
    $string = str_replace("\r", '', $string);    // --- replace with empty space
    $string = str_replace("\n", ' ', $string);   // --- replace with space
    $string = str_replace("\t", ' ', $string);   // --- replace with space
    
    // ----- remove multiple spaces ----- 
    $string = trim(preg_replace('/ {2,}/', ' ', $string));
    
    return $string; 
}

function sia_shorttolong_hari($jadwal){
	$trans = array('SEN' => 'Senin, ', 'SEL' => 'Selasa, ', 'RAB' => 'Rabu, ', 'KAM' => 'Kamis, ',
			'JUM' => 'Jum\'at, ', 'SAB' => 'Sabtu, ', 'MIN' => 'Minggu, ');
	return(implode('<br>',explode('#',strtr($jadwal, $trans))));
}

function strip_jadwal($jadwal){
		$str_ = chr(32).chr(32).chr(32);//.chr(44).chr(32).chr(32).'R:';
		$jadwal = str_replace($str_,' ',$jadwal);
		$str_ = chr(32).chr(32);//.chr(44).chr(32).chr(32).'R:';
		$jadwal = str_replace($str_,' ',$jadwal);
		$jadwal = str_replace(', - R:','',$jadwal);
		$jadwal = str_replace(' ,',',',$jadwal);
		$jadwal = str_replace(' ,','<br>',$jadwal);
		$jadwal = str_replace(', ','<br>',$jadwal);
		$jadwal = str_replace(',','<br>',$jadwal);
		return $jadwal;
	}

function fulltoday() {
	return strftime("%Y-%m-%d %H:%M:%S", mktime (date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
}

function fulltoday_foracle() {
	return strftime("%d-%m-%Y %H:%M:%S", mktime (date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
}
	//$date = '05-09-2013 14:10:05
	//5/SEPTEMBER/03 14:10
	//date_trans_foracle($date, 1, '0 232 110',' ')
	

function date_trans_bayar_unix($date){
	//0807 2013 0000 00
	$date1	= preg_replace("/[^0-9]/", "", $date);	
	$hr = substr($date1,0,2); if(substr($hr,0,1) == '0'){ $hr = substr($hr,1,1); }
	$bl = substr($date1,2,2); if(substr($bl,0,1) == '0'){ $bl = substr($bl,1,1); }
	$th = substr($date1,4,4);
	$jm = substr($date1,8,2); if(substr($jm,0,1) == '0'){ $jm = substr($jm,1,1); }
	$mt = substr($date1,10,2); if(substr($mt,0,1) == '0'){ $mt = substr($mt,1,1); }
	$dt = substr($date1,12,2); if(substr($dt,0,1) == '0'){ $dt = substr($dt,1,1); }
	return mktime(intval($jm), intval($mt), intval($dt), intval($bl), intval($hr), intval($th));
}

function date_trans_unix($fulldate = '01/01/1900 00:00:00'){
	return mktime(intval(substr($fulldate,11,2)), intval(substr($fulldate,14,2)), intval(substr($fulldate,17,2)), intval(ltrim(substr($fulldate,3,2),'0')), intval(ltrim(substr($fulldate,0,2),'0')), substr($fulldate,6,4));
}	

	
function date_trans_foracle($date, $type = 1, $format = '0 111 000', $separator = '-'){
	//translate date yang diterima oracle
	
	//$type	= 0, 1
	//0		= 01-JAN-2013
	//1		= 01-01-2013 00:00:00
	
	//[TANGGAL]								[JAM/MENIT/DETIK]
	//0 : no display						0 : no display
	//1 : (default) 01, 02, 03, ..., 31		1 : (default) 01, 02, 03, ... , 24
	//2 : 1, 2, 3, ..., 31					2 : 01, 02, 
	
	//[BULAN]
	//0, 1, 2 : sama
	//3 : JANUARI, FEBRUARI, ..., DESEMBER
	//4 : JAN, FEB, ... , DES
	
	//[TAHUN]
	//0 : no display
	//1 : 1990, 1991, ... , 2012
	//2 : 90, 91, 92, ..., 12

	//[NAMA HARI]
	//0 : no display
	//1 : SENIN, SELASA
	//2 : SEN, SEL, RAB
	//3 : SN, SL, RB
	
	$month01 	= array('JAN' => 0, 'FEB' => 1, 'MAR' => 2, 'APR' => 3, 'MAY' => 4, 'JUN' => 5,
						'JUL' => 6, 'AUG' => 7, 'SEP' => 8, 'OCT' => 9, 'NOV' => 10, 'DEC' => 11);
	$month1 = array('','Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
					'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$month2 = array('','Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 
					'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des');
	$hari1 = array('Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu');
		
	$hasil = ''; $arr_date = array('','','','','','','');
	if ($date == '') { return ''; }
	if ($type == 1){
	
		$d1 = substr($date,0,2); if (substr($d1,0,1) == 0){ $d1 = substr($d1,1,1); }; $d1 = (int)$d1;
		$d2 = substr($date,3,2); if (substr($d2,0,1) == 0){ $d2 = substr($d2,1,1); }; $d2 = (int)$d2;
		$d3 = substr($date,6,4); $d3 = (int)$d3;
		
		$hari_ = date('w',mktime(0,0,0,$d2,$d1,$d3));
		switch(substr($format,0,1)){ //nama hari
			case 0: $arr_date[0] = ''; break;
			case 1: $arr_date[0] = $hari1[$hari_].', '; break;
			#case 2: $arr_date[0] = $hari2[$hari_].', '; break;		
		}
		
		switch(substr($format,2,1)){ //tgl
			case 0: $arr_date[1] = ''; break;
			case 1: $arr_date[1] = substr($date,0,2); break;
			case 2: $arr_date[1] = substr($date,0,2); if (substr($arr_date[1],0,1) == 0){ $arr_date[1] = substr($arr_date[1],1,1); }; break;		
		}
		
		switch(substr($format,3,1)){ 
			case 0: $arr_date[2] = ''; break;
			case 1: $arr_date[2] = substr($date,3,2); break;
			case 2: $arr_date[2] = substr($date,3,2); if (substr($arr_date[2],0,1) == 0){ $arr_date[2] = substr($arr_date[2],1,1); }; break;		
			case 3: $arr_date[2] = substr($date,3,2); if(substr($arr_date[2],0,1) == '0') { $arr_date[2] = $arr_date[2][1]; } $arr_date[2] = strtr($arr_date[2], $month1); break;
			case 4: $arr_date[2] = substr($date,3,2); if(substr($arr_date[2],0,1) == '0') { $arr_date[2] = $arr_date[2][1]; } $arr_date[2] = strtr($arr_date[2], $month2); break;
		}
		
		switch(substr($format,4,1)){
			case 0: $arr_date[3] = ''; break;
			case 1: $arr_date[3] = substr($date,6,4); break;
			case 2: $arr_date[3] = substr($date,8,2); break;		
		}
		
		switch(substr($format,6,1)){
			case 0: $arr_date[4] = ''; break;
			case 1: $arr_date[4] = substr($date,11,2); break;
			case 2: $arr_date[4] = substr($date,11,2); if (substr($arr_date[4],0,1) == 0){ $arr_date[4] = substr($arr_date[4],1,1); }; break;		
		}
		
		switch(substr($format,7,1)){
			case 0: $arr_date[5] = ''; break;
			case 1: $arr_date[5] = substr($date,14,2); break;
			case 2: $arr_date[5] = substr($date,14,2); if (substr($arr_date[5],0,1) == 0){ $arr_date[5] = substr($arr_date[5],1,1); }; break;		
		}
		
		switch(substr($format,8,1)){
			case 0: $arr_date[6] = ''; break;
			case 1: $arr_date[6] = substr($date,17,2); break;
			case 2: $arr_date[6] = substr($date,17,2); if (substr($arr_date[6],0,1) == 0){ $arr_date[6] = substr($arr_date[6],1,1); }; break;		
		}
		
		$time_output = '';
		for($i = 4; $i < 7; $i++){ if ($arr_date[$i] != '') { $time_output .= ':'.$arr_date[$i]; }} $time_output = substr($time_output, 1, strlen($time_output)-1);
		//if (($arr_date[1] != '') && ($arr_date[2] != '') && ($arr_date[3] != '')) { 
		if(substr($format,0,4) == '0 00'){ $separator = ''; }
		$date_output = $arr_date[1].$separator.$arr_date[2].$separator.$arr_date[3]; 
		//} else { $date_output = ''; }
	
	}
	
	return trim($arr_date[0].$date_output.' '.$time_output);
}

function date_trans_day($str){
	$arr_ 	= array('MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY');
	$arr__	= array('SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUM\'AT', 'SABTU', 'MINGGU');
	
	return str_replace($arr_, $arr__, strtoupper($str));
}

function trans_month1($var){
	$month = '';
	switch ($var) {
		case "Januari": $month = '01';  break;
		case "Februari": $month = '02'; break;
		case "Maret": $month = '03'; break;
		case "April": $month = '04'; break;
		case "Mei": $month = '05'; break;
		case "Juni": $month = '06'; break;
		case "Juli": $month = '07'; break;
		case "Agustus": $month = '08'; break;
		case "September": $month = '09'; break;
		case "Oktober": $month = '10'; break;
		case "November": $month = '11'; break;
		case "Desember": $month = '12'; break;
	}
	return $month;
} 

function date_jquery_oracle($tanggal){ //02 Oktober 2010 to 10/02/2010
	$hasil = '';
	if (trim($tanggal) != ''){
		$pecah = explode(' ',$tanggal);//$tanggal.split(" ");
		$bulan = trans_month1($pecah[1]);
		$hasil = $bulan.'/'.$pecah[0].'/'.$pecah[2];
	}
	return $hasil;
}

if ( ! function_exists('tanggal_indo'))
{
	function tanggal_indo($tanggal)
	{
		$pecah = explode("-",$tanggal);
		$tgl = $pecah[0];
		$bln = bulan($pecah[1]);
		$thn = $pecah[2];

		return $tgl." ".$bln." ".$thn;
	}
}

if ( ! function_exists('tomdy'))
{
	function tomdy($tanggal)
	{
		$pecah = explode("-",$tanggal);
		$tgl = $pecah[0];
		$bln = $pecah[1];
		$thn = $pecah[2];
		return $bln."/".$tgl."/".$thn;
	}
}

if ( ! function_exists('toymd'))
{
	function toymd($tanggal)
	{
		$pecah = explode("-",$tanggal);
		$tgl = $pecah[0];
		$bln = $pecah[1];
		$thn = $pecah[2];
		return $thn."-".$bln."-".$tgl;
	}
}

if ( ! function_exists('tgl_indo_huruf'))
{
	function tgl_indo_huruf($tanggal)
	{
		$pecah=explode("-",$tanggal);
		$tgl=terbilang($pecah[0]);
		if($tgl=="se"){ $tgl="satu"; }
		$bln=bulan($pecah[1]);
		$thn=terbilang($pecah[2]);
		
		return $tgl ." bulan ". $bln ." tahun ". $thn;
	}
}

if ( ! function_exists('terbilang'))
{
	function terbilang($num) {
		$tdiv = array("","","ratus ","ribu ", "ratus ", "juta ", "ratus ","miliar ");
		$divs = array( 0,0,0,0,0,0,0);
		$pos = 0; // index into tdiv;
		// make num a string, and reverse it, because we run through it backwards
		// bikin num ke string dan dibalik, karena kita baca dari arah balik
		$num=strval(strrev(number_format($num,2,'.',''))); 
		$answer = ""; // mulai dari sini
		while (strlen($num)) {
			if ( strlen($num) == 1 || ($pos >2 && $pos % 2 == 1))  {
				$answer = doone(substr($num,0,1)) . $answer;
				$num= substr($num,1);
			} else {
				$answer = dotwo(substr($num,0,2)) . $answer;
				$num= substr($num,2);
				if ($pos < 2)
					$pos++;
			}
			if (substr($num,0,1) == '.') {
				if (! strlen($answer))
					$answer = "";
				$answer = "" . $answer . "";
				$num= substr($num,1);
				// kasih tanda "nol" jika tidak ada
				if (strlen($num) == 1 && $num == '0') {
					$answer = "" . $answer;
					$num= substr($num,1);
				}
			}
			// add separator
			if ($pos >= 2 && strlen($num)) {
				if (substr($num,0,1) != 0  || (strlen($num) >1 && substr($num,1,1) != 0
					&& $pos %2 == 1)  ) {
					// check for missed millions and thousands when doing hundreds
					// cek kalau ada yg lepas pada juta, ribu dan ratus
					if ( $pos == 4 || $pos == 6 ) {
						if ($divs[$pos -1] == 0)
							$answer = $tdiv[$pos -1 ] . $answer;
					}
					// standard
					$divs[$pos] = 1;
					$answer = $tdiv[$pos++] . $answer;
				} else {
					$pos++;
				}
			}
		}
		return strtolower($answer);
	}
	 
	function doone2($onestr) {
		$tsingle = array("","satu ","dua ","tiga ","empat ","lima ",
		"enam ","tujuh ","delapan ","sembilan ");
		   return strtolower($tsingle[$onestr]);
	}	
	 
	function doone($onestr) {
		$tsingle = array("","se","dua ","tiga ","empat ","lima ", "enam ","tujuh ","delapan ","sembilan ");
		   return strtolower($tsingle[$onestr]);
	}	
	 
	function dotwo($twostr) {
		$tdouble = array("","puluh ","dua puluh ","tiga puluh ","empat puluh ","lima puluh ", "enam puluh ","tujuh puluh ","delapan puluh ","sembilan puluh ");
		$teen = array("sepuluh ","sebelas ","dua belas ","tiga belas ","empat belas ","lima belas ", "enam belas ","tujuh belas ","delapan belas ","sembilan belas ");
		if ( substr($twostr,1,1) == '0') {
			$ret = doone2(substr($twostr,0,1));
		} else if (substr($twostr,1,1) == '1') {
			$ret = $teen[substr($twostr,0,1)];
		} else {
			$ret = $tdouble[substr($twostr,1,1)] . doone2(substr($twostr,0,1));
		}
		return strtolower($ret);
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


if ( ! function_exists('harine'))
{
	function harine($tanggal)
	{
		#tanggal : dd-mm-yyyy
		$pecah = explode("-",$tanggal);
		$tgl = $pecah[0];
		$bln = $pecah[1];
		$thn = $pecah[2];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$harine = "";
		if($nama=="Sunday") {$harine="Ahad";}
		else if($nama=="Monday") {$harine="Senin";}
		else if($nama=="Tuesday") {$harine="Selasa";}
		else if($nama=="Wednesday") {$harine="Rabu";}
		else if($nama=="Thursday") {$harine="Kamis";}
		else if($nama=="Friday") {$harine="Jum'at";}
		else if($nama=="Saturday") {$harine="Sabtu";}
		return $harine;
	}
}
if ( ! function_exists('tgl_mysql_orc'))
{
	function tgl_mysql_orc($tgl)
	{
		$pecah = explode("-",$tgl);
		$tanggal = $pecah[2];
		$bulan = $pecah[1];
		$tahun = $pecah[0];
		return $tanggal.'/'.$bulan.'/'.$tahun;
	}
}

/* End of file date_helper.php */
/* Location: ./system/helpers/date_helper.php */