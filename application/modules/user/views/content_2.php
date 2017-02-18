<div id="app_content">	
	<div class="clear10"></div>
	<div class="app-row">
		<div class="col-med-3">
			<?php $this->load->view('user/menu');?>
		</div>
		<div class="col-med-9">
			<div id="content-center">
				<?php echo $this->breadcrumb->output(); ?>
				<br>
				<?php $this->load->view($content);?>
			</div>
		</div>
		
	</div>
	<div class="clear20"></div>
</div>