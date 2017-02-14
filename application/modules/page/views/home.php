			<div id="app_content">
				<div class="app-row">
					<div class="col-med-3">
					<?php $this->load->view('page/login');?>
					</div>
					<div class="col-med-9">
						<div class="app-blog">
							
						<?php $msg = $this->session->flashdata('message');?>
						<?php if(!empty($msg)):?>
							<div class="bs-callout bs-callout-error">
								<p><?php echo $msg[1]?></p>
							</div>
							
						<?php  endif;?>
						</div>
					</div>	
				</div>										
			</div>
		<?php	
	