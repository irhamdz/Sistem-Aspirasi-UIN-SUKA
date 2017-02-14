<style type="text/css">
.det_nilai td{
	text-align: center;
	font-size: 4mm;
}
.det_nilai tr{
	line-height: 1.7;
}
</style>
<table class="det_nilai" border="0.2px">
<tr>
	<td width="10%" rowspan="2"><span style="line-height: 0.1;">&nbsp;<br/></span>No.</td>
	<td width="50%" rowspan="2"><span style="line-height: 0.1;">&nbsp;<br/></span>Materi</td>
	<td width="40%" colspan="2">Nilai</td>
</tr>
<tr>
	<td>Angka</td>
	<td>Huruf</td>
</tr>
<?php 
$i = 1;
foreach($det_nilai as $key => $value):

?>
<tr>
	<td width="10%"><?php echo $i++;?>.</td>
	<td width="50%" align="left">  <?php echo $value[0];?></td>
	<td width="20%"><?php echo $value[1];?></td>
	<td width="20%"><?php echo $value[2];?></td>
</tr>

<?php endforeach;?>

<tr>
	<td colspan="2" align="left"> Predikat Kelulusan</td>
	<td colspan="2"><?php echo $det_nilai['NIL_ANGKA'][3] ;?></td>
</tr>
</table>