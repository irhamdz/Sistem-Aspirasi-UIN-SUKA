<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
/*
1=2014-12-31
2=31/12/2014
*/
if ( ! function_exists('tgl_format'))
{
	function tgl_format($tgl,$i=1,$o=2){
		switch ($i){
			case 1:
				switch($o){
					case 2:
						$tgl = gmdate($tgl, time()+60*60*8);
						$art = explode("-",$tgl);
						return $art[2]."/".$art[1]."/".$art[0];
						break;
					case 3:	
						$tgl = gmdate($tgl, time()+60*60*8);
						 $art = explode("-",$tgl);
						return (int)$art[2]." ".bulan((int)$art[1])." ".$art[0];
						break;
				}
			case 2:
				$tgl = gmdate($tgl, time()+60*60*8);
				 $art = explode("/",$tgl);
				return $art[2]."-".$art[1]."-".$art[0];
				break;
				
		}
	}
}

if ( ! function_exists('tgl_range'))
{
	function tgl_range($tgl1,$tgl2,$sp){
		$art1 = explode(" ",$tgl1);
		$art2 = explode(" ",$tgl2);
		if($art1[2]==$art2[2]){
			if($art1[1]==$art2[1]){
				if($art1[0]==$art2[0]){
				$tgl=$art1[0]." ".$art1[1]." ".$art1[2];
				}else{
					$tgl=$art1[0].$sp.$art2[0]." ".$art2[1]." ".$art2[2];
				}
			}else{
				$tgl=$art1[0]." ".$art1[1].$sp.$art2[0]." ".$art2[1]." ".$art2[2];
			}
		}else{
			$tgl=$art1[0]." ".$art1[1]." ".$art1[2].$sp.$art2[0]." ".$art2[1]." ".$art2[2];
		}
		return $tgl;
	}
}

if ( ! function_exists('bulan'))
{
	function bulan($bln)
	{
		switch ($bln){
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

function hitung_batas_umur($tgllhr,$tglbatas,$th, $key) {

if(strlen($tglbatas)<1)
{
	$tgl=Date('Y-m-d');
}
else
{
	$tgl=date_format(date_create($tglbatas),'Y-m-d');
};
if(validateDate($tgllhr, 'Y-m-d'))
{

	$tgllhr = new DateTime($tgllhr);
	$sekarang = new DateTime($tgl);	
	$tahun=$tgllhr->diff($sekarang)->format('%Y');
	$bulan=$tgllhr->diff($sekarang)->format('%m'); 
	$hari=$tgllhr->diff($sekarang)->format('%d');
	$hasil=array("TAHUN"=>$tahun,"BULAN"=>$bulan,"HARI"=>$hari);

 return warna_tgl($hasil,$th,$key); 
}
 }

function get_hari($tgl)//sisa hari
{
	
	if(Date('Y-m-d H:i:s') > date_format(date_create($tgl),'Y-m-d H:i:s'))
	{
		return 0;
	}
	else
	{
		return 1;
	}
}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function hitung_umur($tgllhr) {
	if(validateDate($tgllhr, 'Y-m-d'))
	{
	$tgllhr       = new DateTime($tgllhr);
	$sekarang     = new DateTime(date('Y-m-d')); 
	$umursekarang =$tgllhr->diff($sekarang)->format('%Y Tahun %m Bulan %d Hari'); 
	}
	else
	{
		$umursekarang=$tgllhr;
	}
 return $umursekarang; 
 }

function warna_tgl($hasil=array(),$th,$key)
{
	$warna=array();

	$warna[0]="#FFEDA0"; //warning
	$warna[1]="#FFF"; //allowed
	$warna[2]="#DC143C"; //not allowed

	if($hasil['TAHUN'] == $th)
	{
		return $warna[0];
	};

	switch ($key) {
		case '>':
					if($hasil['TAHUN'] > $th)
					{
						return $warna[1];
					}
					else
					{
						return $warna[2];
					}
	
			break;
		case '<':
					if($hasil['TAHUN'] < $th)
					{
						return $warna[1];
					}
					else
					{
						return $warna[2];
					}
			break;
		case '=':
					if($hasil['TAHUN'] == $th)
					{
						return $warna[1];
					}
					else
					{
						return $warna[2];
					}
			break;
	}

}