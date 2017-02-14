
				<div style="margin:20px 0; "><h3>TOTAL NILAI SISWA</h3></div>
					<form class="form-inline" method="post" action="">
				  <div class="form-group">
					<label for="prodi">Program Studi &nbsp;&nbsp;&nbsp;</label>
					<select name="prodi" id="prodi" class="form-control input-sm">
							<option value="" >PILIH PROGRAM STUDI</option>
							<?php foreach($prodi as $p): ?>
								<?php
									if($p->kode_program_studi==$kode_prodi){
										echo "<option value='".$p->kode_program_studi."' selected>".$p->program_studi."</option>";
									}else{
									echo "<option value='".$p->kode_program_studi."'>".$p->program_studi."</option>";
									}
								?>	
							<?php endforeach ?>
						</select>
				  </div>
				</form>
				<br>
					<?php $a = $this->session->flashdata('message');?>
					<?php if($a!=null):?>
						<div class="msg_alert alert alert-info">
							<?php echo $a[1]?>
						</div>
						
						<script type="text/javascript" charset="utf-8">
							$(function(){
								setTimeout('closing_msg()', 4000)
							})

							function closing_msg(){
								$(".msg_alert").slideUp();
							}
						</script>
					<?php  endif;?>
				<br>
						
						<div style=" width:740px; height:700px; overflow: scroll;">
							<table style="width:640px;" class="table table-bordered table-hover">
								<tr>
									<th width="3%"><center>No</center></th>
									<th width="35%"><center>Nama Siswa<br>(Nomor Pendaftaran)</center></th>
									<th width="7%" style="font-size:11px;"><center>Total Nilai</center></th>
									<th width="7%" style="font-size:11px;"><center>Akademik<br>(<?php echo $b['nilai_mapel']?> %) </center></th>
									<th width="7%" style="font-size:11px;"><center>Pendukung Akademik<br>(<?php echo $b['nilai_prestasi']?> %)</center></th>
									<th width="7%" style="font-size:11px;"><center>Peringkat Siswa<br>(<?php echo $b['nilai_peringkat_siswa']?> %)</center></th>
									<th width="7%" style="font-size:11px;"><center>SNMPTN Sekolah<br>(<?php echo $b['nilai_riwayat_snmptn']?> %)</center></th>
									<th width="7%" style="font-size:11px;"><center>SBMPTN Sekolah<br>(<?php echo $b['nilai_riwayat_sbmptn']?> %)</center></th>
									<th width="7%" style="font-size:11px;"><center>Peringkat Sekolah<br>(<?php echo $b['nilai_peringkat_sekolah']?> %)</center></th>
									<th width="7%" style="font-size:11px;"><center>Rekam Jejak Alumni<br>(<?php echo $b['nilai_rekam_jejak_alumni']?> %)</center></th>
									<th width="7%" style="font-size:11px;"><center>Aksesibilitas 3T<br>(<?php echo $b['nilai_sebaran_wilayah']?> %)</center></th>
								</tr>	
								<?php $i=0 ?>
								<?php foreach($siswa as $s):?>
									<tr>
										<td><?php echo ++$i;?></td>
										<td><?php echo $s->nama_siswa."<br>".$s->nomor_pendaftaran;?></td>
										<td style="text-align:right"><?php echo round(str_replace(',','.',$s->total_nilai),2);?></td>
										<td style="text-align:right"><?php echo round(str_replace(',','.',$s->nilai_mapel),2);?></td>
										<td style="text-align:right"><?php echo round(str_replace(',','.',$s->nilai_prestasi),2);?></td>
										<td style="text-align:right"><?php echo round(str_replace(',','.',$s->nilai_ranking),2);?></td>
										<td style="text-align:right"><?php echo round(str_replace(',','.',$s->nilai_riwayat_snmptn),2);?></td>
										<td style="text-align:right"><?php echo round(str_replace(',','.',$s->nilai_riwayat_sbmptn),2);?></td>
										<td style="text-align:right"><?php echo round(str_replace(',','.',$s->nilai_peringkat_sekolah),2);?></td>
										<td style="text-align:right"><?php echo round(str_replace(',','.',$s->nilai_rekam_jejak_alumni),2);?></td>
										<td style="text-align:right"><?php echo round(str_replace(',','.',$s->nilai_sebaran_wilayah),2);?></td>
									</tr>
								<?php endforeach?>		
							</table>	
							</div>
<script>
$('#prodi').on('change', function() {
  var prodi= this.value; 
  window.location.href="<?php echo site_url('snmptn/penilaian/set_prodi/nilai_yudisium')?>/"+prodi;
});


</script>	