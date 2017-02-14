		<div id="content-space">
				<h3>Barcode Scan</h3>
					<form method="post" action="" class="form-horizontal" role="form">
						 <div class="form-group form-group-sm">
							<label class="col-sm-1 control-label" for="formGroupInputSmall">NIM : </label>
							<div class="col-sm-4">
									<input  type="text" name="nim" class="form-control"  />
							</div>
							<div style="clear:both"></div>
						</div>
					</form>	
					
					
						<?php $a = $this->session->flashdata('message');?>
						<?php if($a!=null):?>
							<?php if(isset($a['NIM'])){?>
								<div class="msg_alert alert alert-info">
									<table>
										<tr><td width="30%">Nama </td><td width="5%">:</td><td width="65%"><?php echo $a['NAMA']?></td></tr>
										<tr><td>NIM </td><td>:</td><td><?php echo $a['NIM']?></td></tr>
									</table>	
								</div>
								
								<script type="text/javascript" charset="utf-8">
									$(function(){
										setTimeout('closing_msg()', 20000)
									})

									function closing_msg(){
										$(".msg_alert").slideUp();
									}
								</script>
							<?php }else if($a['error']){ ?>
								<div class="msg_alert alert alert-error">
									<p>Data tidak ditemukan</p>	
								</div>
								
								<script type="text/javascript" charset="utf-8">
									$(function(){
										setTimeout('closing_msg()', 20000)
									})

									function closing_msg(){
										$(".msg_alert").slideUp();
									}
								</script>
							
							<?php } ?>	
						<?php  endif;?>
								
				</div>	