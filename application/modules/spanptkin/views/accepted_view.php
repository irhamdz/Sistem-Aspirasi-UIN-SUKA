		<div id="system-content">	
			<div id="content-space">
				<div>
					<div style="font-weight:bold; margin:10px 0;"><h3>Daftar Peserta Diterima </h3></div>
				
						
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
						<div style="font-weight:bold; text-align:right; margin:10px;">
							<a href="<?php echo site_url('spanptkin/yudisium/sk_yudisium/'); ?>"class="btn-uin btn btn-inverse" target="_blank">Cetak SK Yudisium</a>
							<a href="<?php echo site_url('spanptkin/yudisium/sk_rektor/'); ?>" class="btn-uin btn btn-inverse" style="color:#fff; font-size:14px" target="_blank">Cetak SK Rektor</a>
						</div>
						<form method="post" action="">
							<table class="table table-bordered table-hover">
								<tr>
									<th width="5%"><center>No</center></th>
									<th width="20%"><center>No Pendaftaran</center></th>
									<th width="75%"><center>Nama Siswa</center></th>
								</tr>	
							<?php $i=0; ?>	
							<?php 
								if($siswa !=null){
								foreach($siswa as $s){ 
							?>
								<tr>
								<td><center><?php echo ++$i ?></center></td>
								<td><center><?php echo $s->nomor_pendaftaran ?></center> </td>
									<td><?php echo str_replace("#39;","'",$s->nama_siswa) ?></td>
								<tr>
							<?php } }else{ ?>
									<tr><td colspan='5'><center>Tidak ada data yang ditemukan</center></td></tr>	
									
							<?php } ?>		
							</table>
						</form>			
					
						
					</div>					
				</div>				
			</div>
		</div>
	</div>
	<script>

		$('#prodi').on('change', function() {
		  var prodi= this.value; 
		  window.location.href="<?php echo site_url('spanptkin/yudisium/set_prodi/accepted')?>/"+prodi;
		});
	</script>
		