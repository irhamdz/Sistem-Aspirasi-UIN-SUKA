			<div id="app_content">
				<div class="app-row">
					<div class="col-med-3">
						<?php $this->load->view('user/menu');?>
					</div>
					<div class="col-med-9" style="margin-bottom: 35%">
						<div id="content-center">
						<?php echo $this->breadcrumb->output(); ?>
						<br>
						<?php $this->load->view('user/salam');	?>
						</div>
					</div>	
				</div>										
			</div>
			<div class="clear20"></div>
	