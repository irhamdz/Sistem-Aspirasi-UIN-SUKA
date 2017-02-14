		<div id="system-content">	
			<div class="topline-content"></div>
			<?php $this->load->view('yudisium/topmenu_view'); ?>
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
									<th width="35px"><center>Nilai</center></th>
								</tr>	
								<?php $i=0 ?>
								<?php foreach($nilai as $n):?>
								<input type="hidden" name="nomor_pendaftaran[]" value="<?php echo $n->nomor_pendaftaran ?>" />
								<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><?php echo $n->nomor_pendaftaran ?></td>
									<td><center><input style="width:60px; text-align:right" type="text" name="nilai[<?php echo $n->nomor_pendaftaran ?>]" value="<?php echo round($n->nilai,4) ?>" readonly /></center></td>
								</tr>
								<?php endforeach ?>
								
							</table>
							<button type="submit" class="btn btn-primary" style="font-size:14px">Update Nilai Ranking</button>
						</form>		
					</div>					
				</div>				
			</div>
		</div>
	</div>