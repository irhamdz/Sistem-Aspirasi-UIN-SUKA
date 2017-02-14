<style type="text/css">
.det_mhs td{
	text-align: left;
	font-size: 4.2mm;	
}

p.det_mhs {
	font-size: 4.5mm;	
}

.det_mhs tr{
	line-height: 1.5;
}
</style>
<br/>
<br/>
<p align="center" class="det_mhs">diberikan kepada</p>
<br/>
<br/>
<table class="det_mhs" border="0">
<tr>
	<td width="21%">Nama</td>
	<td width="70%">: <?php echo strtoupper($det_mhs['NAMA']);?></td>
</tr>
<tr>
	<td>No. Registrasi</td>
	<td>: <?php echo strtoupper($det_mhs['PRE_USER']);?></td>
</tr>
<tr>
	<td>Tempat, Tanggal Lahir</td>
	<td>: <?php echo $det_mhs['TMP_LAHIR'].", ".date_trans_foracle($det_mhs['TGL_LAHIR'], 1, '0 231 000',' '); ?></td>
</tr>
<tr>
	<td>Dengan Nilai</td>
	<td>:</td>
</tr>
</table>
<br />