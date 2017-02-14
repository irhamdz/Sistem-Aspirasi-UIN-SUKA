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
										
						<form method="post" action="">
							<input type="hidden" name="s" value=""/>
							<button type="submit" class="btn btn-primary" style="font-size:14px">Update Nilai Kumulatif</button>
						</form>		
					</div>					
				</div>				
			</div>
		</div>
	</div>