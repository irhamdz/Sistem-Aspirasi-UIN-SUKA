		<div id="system-content">	
			<div class="topline-content"></div>
			<div class="margin-contentmenu">
				<ul class="content-submenu">				
					<a href="<?php echo site_url('login/logout'); ?>"><li id="tab">Logout</li></a>
					<a href="<?php echo site_url('prestasi/penilaian'); ?>"><li id="tab">Penilaian</li></a>
				</ul>					
			</div>
			<div id="content-space">
				<div>
					<div class="content-value">
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
										
						<div style="font-weight:bold; margin:10px 0;">Program Studi : <?php echo $this->session->userdata('prodi'); ?></div>
						<form method="post" action="">
							<table style="width:940px" class="table table-bordered table-hover">
								<tr>
									<th width="10px"><center>No</center></th>
									<th><center>No Pendaftaran</center></th>
									<th><center>Nama Siswa</center></th>
									<th><center>Prestasi</center></th>
									<th width="35px"><center>Nilai</center></th>
								</tr>	
								<?php $i=0 ?>
								<?php foreach($siswa as $s):?>
								<input type="hidden" name="nomor_pendaftaran[]" value="<?php echo $s->nomor_pendaftaran ?>" />
								<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><?php echo $s->nomor_pendaftaran ?></td>
									<td><?php echo $s->nama_siswa ?></td>
									<td>
										
									</td>
									<td><center>
										<select name="nilai[]" style="width:60px; margin:0">
											<?php 
												if($s->nilai_prestasi>0){
													echo"<option value='".$s->nilai_prestasi."' >".$s->nilai_prestasi."</option>";
												}
											?>
													<option value='0' >0</option>
													<option value='0.5' >0.5</option>
													<option value='1' >1</option>
													<option value='1.5' >1.5</option>
													<option value='2' >2</option>
													<option value='2.5' >2.5</option>
													<option value='3' >3</option>
													<option value='3.5' >3.5</option>
													<option value='4' >4</option>
													<option value='4.5' >4.5</option>
													<option value='5' >5</option>
													<option value='5.5' >5.5</option>
													<option value='6' >6</option>
													<option value='6.5' >6.5</option>
													<option value='7' >7</option>
													<option value='7.5' >7.5</option>
													<option value='8' >8</option>
													<option value='8.5' >8.5</option>
													<option value='9' >9</option>
													<option value='9.5' >9.5</option>
													<option value='10' >10</option>
										</select>
									</center></td>
								</tr>
								<?php endforeach ?>
								
							</table>
							<button type="submit" class="btn btn-primary" style="font-size:14px">Simpan Nilai Non Akademik</button>
						</form>		
					</div>					
				</div>				
			</div>
		</div>
	</div>