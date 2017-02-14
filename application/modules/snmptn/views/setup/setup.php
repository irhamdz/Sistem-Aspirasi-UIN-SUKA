		<div id="system-content">	
			<div id="content-space">
				<div style="width:70%;">
					<div class="content-value">
														
						<div style="margin:20px 0; margin-top:40px;"><h3>SET UP PENILAIAN</h3></div>
							<?php $a = $this->session->flashdata('message');?>
							<?php if($a!=null):?>
								<div class="msg_alert alert alert-info">
									<?php echo $a[1]?>
								</div>
								
							<?php  endif;?>
						
							<form method="post" action="">
							<input type="hidden" name="jenis_pembobotan" value="pembobotan" />
								<table style="width:940px" class="table">
									<?php 
										$i=0 ;
										$total=0;
									?>
									<?php foreach($pembobotan as $p):
										$total+=$p->BOBOT;
									?>
									<?php ++$i ?>
									<tr>
										<td><?php echo $p->NAMA_PEMBOBOTAN ?></td>
										<td><?php echo $p->BOBOT ?> %</td>
										<td>
										<?php if($p->LOCKED==0){?>
											<a href="<?php echo site_url('yudisium/setup/lock_'.strtolower($p->KODE_NILAI))?>" class="btn btn-primary">Kunci</a>
										<?php }else{ ?>
											<a href="#" class="btn btn-warning btn-disable">Terkunci</a>
										<?php } ?>
										</td>
									</tr>
									<?php endforeach ?>
									<tr>
										<td> </td>
										<td><span id="total"><?php echo $total ?></span> %</td>
									</tr>
								</table>
								<button type="submit" class="btn btn-primary" style="font-size:14px">Simpan</button>	
							</form>	
						</div>						
					
					</div>					
				</div>				
			</div>
		</div>
	</div>
	
	