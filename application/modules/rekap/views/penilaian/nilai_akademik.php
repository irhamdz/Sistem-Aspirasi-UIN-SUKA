
				<div style="margin:20px 0; "><h3>NILAI AKADEMIK</h3></div>
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
										
								
					<div style="margin:20px 0;">
						<div id="bas_msg"></div>
						<form id="basform" method="post" action=""  class="form-inline">
						<input type="hidden" name="jenis_pembobotan" value="pembobotan akreditasi sekolah" />
							<?php 
						//	print_r($bobot);
							if(!empty($bobot)):
							foreach ($bobot as $jenjang=>$bna):?>
								<h4><?php echo $jenjang;?></h4>
								<?php foreach ($bna as $jurusan=>$bnj):?>
									<?php echo $jurusan;?>
									
									<table class="table table-bordered">
										<tr>
										<?php 
										
										foreach($bna[$jurusan] as $b){
											echo"<td>".$b->mata_pelajaran."</td>";
										}
										?>
										<td></td>
										</tr>
										<tr>
										<?php
										$tb=0;
										foreach($bna[$jurusan] as $b){
											$tb+=$b->bobot;
										?>
											<td>
												<div class="form-group has-feedback">
												<input type="text" class="numeric bas form-control"  name="nilai[<?php echo $jenjang; ?>][<?php echo $jurusan; ?>][<?php echo $b->kode_mata_pelajaran; ?>]" value="<?php echo $b->bobot; ?>" maxlength="3"  style="width:80px;">
												<span class=" form-control-feedback" aria-hidden="true">%</span>
											  </div>
											<?php } ?>
											<td><?php echo $tb?> %</td>
										</tr>
									</table>
								<?php endforeach ?>
							<?php endforeach ?>
							<?php endif ?>
							<button type="submit" class="btn btn-primary" style="font-size:14px">Simpan</button>	
						</form>	
					</div>
						<form method="post" action="">
							<table style="width:740px;" class="table table-bordered table-hover">
								<tr>
									<th width="5%"><center>No</center></th>
									<th width="20%"><center>No Pendaftaran</center></th>
									<th width="65%"><center>Nama Siswa</center></th>
									<th width="10%"><center>Nilai</center></th>
								</tr>	
								<?php $i=0 ?>
								<?php if(isset($siswa) and !empty($siswa)):?>
								<?php foreach($siswa as $s):?>
									<tr>
										<td><?php echo ++$i;?></td>
										<td><?php echo $s->nomor_pendaftaran;?></td>
										<td><?php echo $s->nama_siswa;?></td>
										<td><?php echo round(str_replace(',','.',$s->nilai),2);?></td>
									</tr>
								<?php endforeach?>		
								<?php endif?>		
							</table>
						</form>		
<script>
$('#prodi').on('change', function() {
  var prodi= this.value; 
  window.location.href="<?php echo site_url('snmptn/penilaian/set_prodi/nilai_akademik')?>/"+prodi;
});


</script>	