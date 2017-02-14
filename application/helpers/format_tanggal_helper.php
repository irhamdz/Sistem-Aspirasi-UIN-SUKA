<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('tgl_format'))
{
	function tgl_format($tgl,$i=1,$o=2){
		switch ($i){
			case 1:
				$tgl = gmdate($tgl, time()+60*60*8);
				 $art = explode("-",$tgl);
				return $art[2]."/".$art[1]."/".$art[0];
				break;
			case 2:
				switch ($o){
				case 1:
					$tgl = gmdate($tgl, time()+60*60*8);
					 $art = explode("/",$tgl);
					return $art[2]."-".$art[1]."-".$art[0];
					break;
				case 3:
					$tgl=tgl_format($tgl,2,1);
					$ubah = gmdate($tgl, time()+60*60*8);
					$pecah = explode("-",$ubah);
					$tanggal = $pecah[2];
					$bulan = bulan($pecah[1]);
					$tahun = $pecah[0];
					return (int)$tanggal.' '.$bulan.' '.$tahun;
					break;
				case 4:
					$tgl=tgl_format($tgl,2,1);
					$ubah = gmdate($tgl, time()+60*60*8);
					$pecah = explode("-",$ubah);
					$tgl = $pecah[2];
					$bln = $pecah[1];
					$thn = $pecah[0];
					$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
					$nama_hari = "";
					if($nama=="Sunday") {$nama_hari="Minggu";}
					else if($nama=="Monday") {$nama_hari="Senin";}
					else if($nama=="Tuesday") {$nama_hari="Selasa";}
					else if($nama=="Wednesday") {$nama_hari="Rabu";}
					else if($nama=="Thursday") {$nama_hari="Kamis";}
					else if($nama=="Friday") {$nama_hari="Jumat";}
					else if($nama=="Saturday") {$nama_hari="Sabtu";}
					return $nama_hari;
					break;
				}
				break;
		}
	}
}



if ( ! function_exists('tanggal_indonesia'))
{
	function tanggal_indonesia($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return (int)$tanggal.' '.$bulan.' '.$tahun;
	}
}
if ( ! function_exists('tgl_get_date'))
{
	function tgl_get_date($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal;
	}
}
if ( ! function_exists('tgl_get_month'))
{
	function tgl_get_month($tgl)
	{
		$ubah = gmdate($tgl, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $bulan;
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

if ( ! function_exists('nama_hari'))
{
	function nama_hari($tanggal)
	{
		$ubah = gmdate($tanggal, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Minggu";}
		else if($nama=="Monday") {$nama_hari="Senin";}
		else if($nama=="Tuesday") {$nama_hari="Selasa";}
		else if($nama=="Wednesday") {$nama_hari="Rabu";}
		else if($nama=="Thursday") {$nama_hari="Kamis";}
		else if($nama=="Friday") {$nama_hari="Jumat";}
		else if($nama=="Saturday") {$nama_hari="Sabtu";}
		return $nama_hari;
	}
}

if ( ! function_exists('hitung_mundur'))
{
	function hitung_mundur($wkt)
	{
		$waktu=array(	365*24*60*60	=> "tahun",
						30*24*60*60		=> "bulan",
						7*24*60*60		=> "minggu",
						24*60*60		=> "hari",
						60*60			=> "jam",
						60				=> "menit",
						1				=> "detik");

		$hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
		$hasil = array();
		if($hitung<5)
		{
			$hasil = 'kurang dari 5 detik yang lalu';
		}
		else
		{
			$stop = 0;
			foreach($waktu as $periode => $satuan)
			{
				if($stop>=6 || ($stop>0 && $periode<60)) break;
				$bagi = floor($hitung/$periode);
				if($bagi > 0)
				{
					$hasil[] = $bagi.' '.$satuan;
					$hitung -= $bagi*$periode;
					$stop++;
				}
				else if($stop>0) $stop++;
			}
			$hasil=implode(' ',$hasil).' yang lalu';
		}
		return $hasil;
	}
}

function mysql_date($date){
	list($hr,$bl,$th)=explode('/',$date);
	return $th.'-'.$bl.'-'.$hr;
}
function mysql_date2($date){
	list($hr,$bl,$th)=explode('-',$date);
	return $th.'-'.$bl.'-'.$hr;
}
function jquery_date($date){
	list($hr,$bl,$th)=explode('-',$date);
	return $hr.'/'.$bl.'/'.$th;
}


function tgl_periode($tgl1,$tgl2){
	list($date1,$time1)=explode(' ',$tgl1);
	list($hr1,$bl1,$th1)=explode('-',$date1);
	list($date2,$time2)=explode(' ',$tgl2);
	list($hr2,$bl2,$th2)=explode('-',$date2);
	if($th1==$th2){
		if($bl1==$bl2){
			if($hr1==$hr2){
				return (int)$hr1.' '.bulan($bl1).' '.$th1;
			}else{
				return (int)$hr1.' s.d '.(int)$hr2.' '.bulan($bl2).' '.$th2;
			}
		}else{
			return (int)$hr1.' '.bulan($bl1).' s.d '.(int)$hr2.' '.bulan($bl2).' '.$th2;
		}
	}else{
		return (int)$hr1.' '.bulan($bl1).' '.$th1.' s.d '.(int)$hr2.' '.bulan($bl2).' '.$th2;
	}	
}

function get_year($format,$tgl){
	$date = DateTime::createFromFormat($format,$tgl);
	return $date->format("Y");
}

function hitung_umur($tgllhr) {
	$tgllhr = DateTime::createFromFormat('d-m-Y', $tgllhr);
	$sekarang = DateTime::createFromFormat('d/m/Y', date('d/m/Y'));	
	$umursekarang=$tgllhr->diff($sekarang)->format('%Y Tahun %m Bulan %d Hari'); 
 return $umursekarang; 
 }