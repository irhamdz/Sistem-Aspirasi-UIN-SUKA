<style type="text/css" media="print,screen" >
@page {
size:8.27in 11.69in; 
margin:.5in .5in .5in .5in; 
mso-header-margin:.5in; 
mso-footer-margin:.5in; 
mso-paper-source:0;
}

body{
font-family:Arial;
font-size:12px;
}
.table{
font-size:12px;
border-collapse:collapse;
}
.table td {
	border:1px solid black;
	padding:5px;
}
.table th {
	border:1px solid black;
	border-top:2px solid black;
	padding:5px;
color:black;
}
.thead {
	display:table-header-group;
}
tbody {
	display:table-row-group;
}
</style>
<?php 
	foreach($unit as $u){} //print_r($unit);;
?>		
<div style="width:650px; margin-top:-10px" >
	<table width="100%" style=" border-style:none">
	<tr>
		<td><img src="<?php echo pg_unescape_bytea($u->logo)?>" width="60"/><td>
		<td style="vertical-align:top; text-align:center">
			<div><?php echo $u->kementrian?></div>
			<div style="margin:0 150px;"><?php echo $u->nama_unit?></div>
			<div style="font-size:10px; margin-top:5px; "><i>ALamat : <?php echo $u->alamat?>, Telp. <?php echo $u->telp?></i></div>
		</td>
	<tr>
	</table><hr/><br>
					<p style="font-weight:bold; text-align:center">
						REKAPITULASI HASIL VERIFIKASI SNMPTN 2016 <br/>
					</p><br>
					<div class="content-value">

						<div style="font-weight:bold; margin:15px 0;">Program Studi :	<?php echo $p->program_studi ?></div>
						<p>Perbedaan Data</p>	
						<?php if(isset($ver_nilai) and !empty($ver_nilai)){ ?>			
								
							<table style="width:650px" class="table table-bordered table-hover">
								<tr>
									<th width="5%" rowspan="2"><center>No</center></th>
									<th width="10%" rowspan="2"><center>No. Pendaftaran</center></th>
									<th width="20%" rowspan="2"><center>Nama</center></th>
									<th width="30%" colspan="2"><center>Perbedaan Nilai</center></th>
									<th width="35%" rowspan="2"><center>Keterangan</center></th>
								</tr>
								<tr>								
									<th><center>Semester</center></th>
									<th ><center>Mata Pelajaran</center></th>
								</tr>	
								<?php $i=0 ?>
								<?php foreach($ver_nilai as $d):?>
								<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><?php echo $d['NOMOR_PENDAFTARAN']?></td>
									<td><?php echo $d['NAMA_SISWA']?></td>
									<td><?php echo $d['SEMESTER']+($d['TINGKAT']-10)*2;?></td>
									<td><?php echo $d['MATA_PELAJARAN']?></td>
									<td><?php echo $d['KETERANGAN']?></td>
									
								</tr>
								<?php endforeach ?>
								
							</table>

						<?php } ?>
					</div>	
					<div style="margin-left:420px; display:hidden; margin-top:30px; width:230px;">
					Yogyakarta, 31 Mei 2016<?php //echo $config->tgl_yudisium?><br/>
					Verifikator<br/>
					<br/><br/><br/>
					<?php //echo $config->rektor?><br/>
					______________________ <?php //echo $config->nip_rektor?> 
					</div>
				</div>