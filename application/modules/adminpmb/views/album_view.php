<?php
$total=1;
$nopes=array();

if(!is_null($mhs))
{
	$no=0;
	foreach ($mhs as $keynomhs => $jml_mhs){
		if($no % 20==1)
		{
			array_push($nopes,$mhs[$no-1]->nomor_peserta);
			
		}
		$no+=1;
		if($no%5==0)
		{
			$total+=1;
		};
		
	}
	array_push($nopes,$mhs[$no-1]->nomor_peserta);	
	$nopes[0]=null;
	$nopes=array_slice(array_filter($nopes), 0);
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<link href="<?php echo base_url('asset/style_album_ujian_1.css'); ?>" rel="stylesheet" type="text/css"/>
<?php 
$num=0;
$page=0;
if(!is_null($mhs))
{
$kapas=count($mhs);
$head=true;
$foot=false;
$cov=0;
foreach ($mhs as $keymhs => $maha) {
$num+=1;
if($head)
{
$page+=1;
if($num==0 || $num % 20==1)
{

 ?>
 <div id="coverprint">
<table cellpadding="4" cellspacing="4" width="100%">
<tbody>
  <tr><td><div align="center"><img src="<?php echo get_image($kampus['logo']); ?>" width="40"></div></td></tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
		  <tr><td align="center"><span class="big2"><h1>ALBUM BUKTI HADIR PESERTA UJIAN TULIS</h1></span></td></tr>
		  <tr><td align="center"><h3>TAHUN <?php echo $cover['tahun']; ?></h3></td></tr>
		  <tr><td align="center"><h3><?php echo strtoupper($kampus['nama_unit']); ?></h3></td></tr>
		  <tr><td align="center"><h2><?php echo strtoupper($kampus['kota']); ?></h2></td></tr>
		  <tr><td></td></tr>
		  <tr>
			  <td align="center">
				<table class="tabelpesertaborder_cover" align="center" border="0" cellpadding="2" cellspacing="0" width="220px">
					<tbody>
						<tr>
							<td align="center"><h2>KODE RUANG : <?php echo $cover['nama_ruang']; ?></h2></td>
						</tr>
					</tbody>
				</table> 
				  <br /><br />
				<table class="tabelpesertaborder_cover" border="0" cellpadding="1" cellspacing="0" width="464px">
			  <tbody>
			  <tr align="left">
				<td width="60px"><h3>LOKASI </h3></td>
				<td width="5px">:</td>
				<td><h3><?php echo $cover['nama_gedung']; ?></h3></td>
			  </tr>
			  <tr  align="left">
				<td valign="top"><h3>RUANG </h3></td>
				<td valign="top">:</td>
				<td><h3><?php echo $cover['nama_ruang']; ?></h3></td>
			  </tr>
			  <tr  align="left">
				<td valign="top"><h3>ALAMAT</h3></td>
				<td valign="top">:</td>
				<td><h3><?php echo strtoupper($kampus['alamat']); ?></h3></td>
			  </tr >
			  <tr  align="left">
				<td valign="top"><h3>TANGGAL</h3></td>
				<td valign="top">:</td>
				<td><h3><?php 
				if(!is_null($jadwal))
				{
					foreach ($jadwal as $jd) {
						echo tanggal_indonesia($jd->tanggal)."<br>";
					}
				}
				?></h3></td>
			  </tr>
			  <tr  align="left">
				<td valign="top"><h3>NOMOR</h3></td>
				<td valign="top">:</td>
				<td><h3><?php echo $maha->nomor_peserta.' s/d '.$nopes[$cov];?></h3></td>
			  </tr>
			  <tr  align="left">
				<td valign="top"><h3>JUMLAH PESERTA</h3></td>
				<td valign="top">:</td>
						<td><h3><?php echo $cover['jml'];  $cov+=1; ?></h3></td>
			  </tr>
			</tbody></table>
			  </td>
			  
		  </tr>
		   <tr><td></td></tr> <tr><td></td></tr> <tr><td></td></tr>
		</tbody>
	</table>
</div>
<?php
}
?>
<table class="tabelpesertaborder" border="0" cellpadding="2" cellspacing="0" width="420px">
<tbody>
  <tr>
    <td width="30" height="30" align="center"><img src="<?php echo get_image($kampus['logo']); ?>" width="20px"></td>
    <td>
	<table width="100%">
      <tbody>
		<tr>
			<td colspan="3"><strong>ALBUM BUKTI HADIR PESERTA UJIAN TULIS <?php echo $cover['tahun']; ?><br /></strong></td>
        </tr>
		<tr>
			<td width="20">SEKTOR</td>
			<td width="3">:</td>
			<td width="120"><?php echo strtoupper($kampus['nama_unit']); ?></td>
        </tr>
		<tr>
			<td>LOKASI</td>
			<td>:</td>
			<td><?php echo $cover['nama_gedung']; ?></td>
        </tr>
		<tr>
			<td>RUANG</td>
			<td>:</td>
			<td><?php echo $cover['nama_ruang']; ?></td>
        </tr>
    </tbody>
	</table>
	</td>
  </tr>
</tbody></table>
<?php
}//header
	
	if ($num % 5==0) 
	{
		$head=true;
		$foot=true;
	}
	else
	{
		$foot=false;
		$head=false;
	}

?>


<table class="tabelpesertaborder" border="0" cellpadding="2" cellspacing="0" width="300px">
      <tbody>
		<tr>
			<td style="height:60px !important;" width="40" border="0"><img src="<?php echo get_image($maha->foto); ?>" width="40px"></td>
			<td width="130px"><br /><br />
				<table>
				   <tr>
                <td width="50">NAMA URUT</td>
                <td width="5">:</td>
                <td width="80" align="left"><?php echo $num; ?></td>
              </tr>
				   <tr>
                <td>NOMOR PESERTA</td>
                <td>:</td>
                <td><?php echo $maha->nomor_peserta; ?></td>
              </tr>
				<tr>
					<td >NAMA PESERTA</td>
					<td >:</td>
					<td><?php echo $maha->nama_lengkap; ?></td>
				</tr>
				<tr>
                <td>KEBUTUHAN KHUSUS</td>
                <td>:</td>
                <td><?php if(empty($maha->id_kesehatan)){echo "Normal";}else{echo $maha->kondisi_kesehatan;} ?></td>
              </tr>
              <tr>
                <td >ASAL SEKOLAH</td>
                <td >:</td>
                <td ><?php echo $maha->nama_pt; ?></td>
              </tr>
               <tr>
                <td >TAHUN IJAZAH</td>
                <td >:</td>
                <td ><?php echo $maha->tahun_ijazah; ?></td>
              </tr>
				</table>
			</td>
			<td width="70">
                        <table class="tabelpesertaborder"  border="0" cellpadding="2" cellspacing="0">
						<tbody>
							<tr>
								<td align="center" width="32">TANDA TANGAN<br /><br /><br /><br /><br /><br />SESI 1</td>
								<td align="center"  width="32">TANDA TANGAN<br /><br /><br /><br /><br /><br />SESI 2</td>
							</tr>
							<tr>
								<td align="center">TANDA TANGAN<br /><br /><br /><br /><br /><br />SESI 3</td>
								<td align="center">TANDA TANGAN<br /><br /><br /><br /><br /><br />SESI 4</td>
							</tr>
						</tbody>
						</table>
            
			</td>
		</tr>
   </tbody>
 </table>
<?php
if($foot)
{
?>

<br /><br />
 <table class="none" cellpadding="2" cellspacing="0" width="240px">
 <tr><td align="right"><i>Halaman <?php echo $page; ?> dari <?php echo $total; ?></i></td></tr></table>
  <br />
 <br />
 <br />
 <?php
 if ($num % 5==0) 
	{
		$foot=true;
	}
	else
	{
		$foot=false;
	}
}

}
}
 ?>