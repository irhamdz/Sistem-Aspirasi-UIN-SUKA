
			<div id="app_content">
				<?php echo $this->breadcrumb->output(); ?>
				<div class="app-row">
					<div class="col-med-3">
						<?php $this->load->view('admin/menu');?>
					</div>
					<div class="col-med-9">
						<?php $this->load->view($content);?>
					</div>
					
				</div>
				<div class="clear20"></div>
			</div>