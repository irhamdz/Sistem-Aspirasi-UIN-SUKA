<style type="text/css" media="print,screen" >
body{
font-family:Arial;
font-size:12px;
}
table{
font-size:12px;
border-collapse:collapse;
}
table td {
	border:1px solid black;
	padding:5px;
}
th {
	border:1px solid black;
	border-top:2px solid black;
	padding:5px;
color:black;
}
thead {
	display:table-header-group;
}
tbody {
	display:table-row-group;
}
</style>
					<p style="font-weight:bold;">
						Lampiran: I <br/>
						Keputusan Rektor UIN Sunan Kalijaga Yogyakarta<br/>
						Nomor: <?php echo $config->sk_rektor?><br/>
						Tentang Penerimaan Calon Mahasiswa Baru Jalur SNMPTN Tahun Akademik <?php echo $config->ta?><br/>
						UIN Sunan Kalijaga Yogyakarta<br/>

					</p>
					<div class="content-value">

						<div style="font-weight:bold; margin:10px 0;">Program Studi :	<?php echo $p->program_studi ?></div>
						
							<table style="width:640px" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th width="5%"><center>No</center></th>
									<th width="20%"><center>No Pendaftaran</center></th>
									<th width="75%"><center>Nama</center></th>
								</tr>	
								</thead>
								<tbody>
								<?php $i=0; ?>	
								<?php 
									if($siswa !=null){
									foreach($siswa as $s){ 
								?>
									<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><center><?php echo $s->nomor_pendaftaran ?></center> </td>
									<td><?php echo str_replace("#39;","'",$s->nama_siswa) ?></td>
									</tr>
								<?php } } ?>	
							</tbody>
							</table>
					</div>	
					<div style="margin-left:420px; display:hidden; margin-top:30px; width:230px;">
					Yogyakarta, <?php echo $config->tgl_yudisium?><br/>
					Rektor<br/>
					<br/><br/><br/>
					<?php echo $config->rektor?><br/>
					NIP. <?php echo $config->nip_rektor?> 
					</div>
				