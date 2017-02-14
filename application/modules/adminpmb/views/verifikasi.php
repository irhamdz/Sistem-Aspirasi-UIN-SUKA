<?php
$total=0;
if(!is_null($mhs))
{
	$no=0;
	foreach ($mhs as $jml_mhs){
		$no+=1;
		if($no%10==0)
		{
			$total+=1;
		}

	}
		if($no%10 != 0 && count($mhs)-$no < 10)
		{
			$total+=1;
		}

}



function get_image($data_uri)
{
	
	$data=pg_unescape_bytea($data_uri);
	$data_uri=str_replace('data:image/jpeg;base64,', '', $data);
	$foto=base64_decode($data_uri);
	$lagi=base64_encode($foto);
	$logo='@'.$lagi;
	return $logo;
		//
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta name="robots" content="noindex,nofollow" />
		<meta http-equiv="expires" content="mon, 22 jul 2002 11:12:01 gmt">
		<meta http-equiv="cache-control" content="no-cache">
		<title>Verifikasi</title>
		<link href="<?php echo base_url('asset/cetak_form_verifikasi.css'); ?>" rel="stylesheet" type="text/css"/>
	</head>
	<style type="text/css">
	#print{
		margin-left: 5px;
		margin-right: 2px;
	}
	</style>
<body id="print">
<br /><br />
<?php 
$num=0;
$page=0;
if(!is_null($mhs))
{

$head=true;
$foot=false;

foreach ($mhs as $value) {

$num+=1;
if($head)
{
$page+=1;
 ?>
<div id="headerprint">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr>
				<td width="100"><div align="center"><img src="<?php echo pg_unescape_bytea($kampus['logo']); ?>" width='60' align="middle"></div></td>
				<td><table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tbody>
							<tr>
								<td colspan="3"><span class="headerjudul">FORM VERIFIKASI PESERTA UJIAN TULIS <?php  ?>&nbsp;<?php echo $cover['tahun']; ?></span><br>
					<span class="headerlabel"><?php echo strtoupper($kampus['nama_unit']); ?>TA <?php echo $kampus['tahun_akademik']; ?></span>
								</td>
							</tr>
							<tr>
								<td><span class="headerlabel"> LOKASI </span></td>
								<td>:</td>
								<td><span class="headercontent"><?php echo strtoupper($cover['nama_gedung']); ?></span></td>
							</tr>
							<tr>
								<td><span class="headerlabel">RUANG </span></td>
								<td>:</td>
								<td><span class="headercontent"><?php echo strtoupper($cover['nama_ruang']); ?></span></td>
							</tr>
							<tr>
								<td width="70"><span class="headerlabel">KAPASITAS </span></td>
								<td width="10">:</td>
								<td><span class="headercontent"><?php echo $cover['kapasitas_ruang']; ?></span></td>
							</tr>
						</tbody>
					</table>
				</td>
		  </tr>
		</tbody>
	</table>
</div>
<div class="tabstat">
	<table border="0" width="100%" cellspacing="0" id="jadw">
		<tbody>
			<tr>
				<td width="30" align="center">No</td>
				<td width="70" align="center">No PMB</td>
				<td align="center">Nama</td>
				<td width="100" align="center">Data Diri &amp;<br>Kartu Peserta</td>
				<td width="100" align="center">FC Ijazah / SK Lulus (Th) [Sesuai/Tidak]</td>
				<td width="100" align="center">Identitas Diri (KTP/SIM/K.Pelajar)</td>
			</tr>
		</tbody>
	</table>
</div>
<?php 
} 
	if ($num % 10==0) 
	{
		$head=true;
		$foot=true;
	}
	else
	{
		$head=false;
		$foot=false;
	}
?>
<div class="tabstat">
	<table border="0" width="100%" cellspacing="0" id="jadw">
		<tbody>
		
			<tr>
				<td width="30" align="center"><?php echo $num;  ?></td>
				<td width="70" align="center"><?php echo $value->nomor_peserta; ?></td>
				<td align="center"><?php  echo $value->nama_lengkap; ?></td>
				<td width="100" align="center"></td>
				<td width="100" align="center"></td>
				<td width="116" align="center"></td>
			</tr>
	
		</tbody>
	</table>
</div>
 <?php 
if($foot)
{
?>
<div id="infohal"><i>Halaman <?php echo $page; ?> dari <?php echo $total ?></i></div><br><br>	
	<table border="0" cellpadding="1" cellspacing="2" width="100%">
		<tbody><tr>
			<td width="170" align="center"></td>
			<td width="350"></td>
			<td align="center"><?php echo $kampus['kota']; ?>, <?php echo $jadwal; ?><br>Petugas Verifikasi</td></tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><br><br><br><br></td>
			</tr>
			<tr>
				<td align="center"></td>
				<td></td>
				<td align="center">( _________________ )</td>
			</tr>
		</tbody>
	</table>
	<hr />

<?php
}
elseif($num==count($mhs))
{
	?>
	<div id="infohal"><i>Halaman <?php echo $page; ?> dari <?php echo $total ?></i></div><br><br>	
	<table border="0" cellpadding="1" cellspacing="2" width="100%">
		<tbody><tr>
			<td width="170" align="center"></td>
			<td width="350"></td>
			<td align="center"><?php echo $kampus['kota']; ?>, <?php echo $jadwal; ?><br>Petugas Verifikasi</td></tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><br><br><br><br></td>
			</tr>
			<tr>
				<td align="center"></td>
				<td></td>
				<td align="center">( _________________ )</td>
			</tr>
		</tbody>
	</table>
	<?php
}
if ($num % 10==0) 
	{
		$foot=true;
	}
	else
	{
		$foot=false;
	}
}
}
?>

</body>
</html>