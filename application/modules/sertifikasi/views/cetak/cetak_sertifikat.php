<style>
h1{
	font-size: 6.8mm;
}
.ket_ttd{
	font-size: 4mm;
}

</style>

<table border="0">
<tr >
<span style="line-height: 2.8;">&nbsp;<br/></span>
	<td width="100%" colspan="6" align="right"><font size="10"><?php echo $det_pst['nomor'];?></font></td>
</tr>
<span style="line-height:2.28">&nbsp;<br/></span>
<tr align ="right">
	<td width="93%" colspan="5" ><h1 align="right"><?php echo STRTOUPPER($det_pst['jenis_sertifikat']); ?> TEKNOLOGI INFORMASI DAN KOMUNIKASI </h1></td>
</tr>

<tr>
	<td width="30%" colspan="2"></td>
	<td width="58.5%" colspan="2"><?php $this->load->view('cetak/det_mhs'); ?></td>
	<td width="11.5%"></td>
</tr>
<tr>
	<td colspan="2"></td>
	<td colspan="2"><?php $this->load->view('cetak/det_nilai'); ?></td>
	<td></td>
</tr>
<br/>
<br/>
<tr width="100%" class="ket_ttd">
	<td width="8.1%"><?php echo $det_pst['foto'];?></td>
	<td width="6.1%"></td>
	<td width="25%">
		<p><?php echo $det_unit2['UNIT_NMKAB2'].", ".date_trans_foracle($det_pst['tgl_sertifikat'], 1, '0 231 000',' ');?></p>
		<p><b><?php echo $det_unit['STR_NAMA_S1']." ".$det_unit['UNIT_NAMA_S2'];?></b></p>
		<br><br><br>
		<p><b><?php echo $det_unit['NM_PGW_F'];?></b></p>
		<p>NIP. <?php echo $det_unit['KD_PGW'];?></p>
	</td>
	<td width="26%">
	</td>
	
	<td width="23.7%"><?php $this->load->view('cetak/ket_nilai'); ?></td>
	<td width=""></td>
</tr>

</table>
