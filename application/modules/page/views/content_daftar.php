<div id="app_content">	
	<div class="clear10"></div>
	<?php echo $this->breadcrumb->output(); ?>
	<div class="app-row">
		<br>	
		<div class="col-med-3">
			<?php $this->load->view($content);?>
		</div>
		<!-- <div class="col-med-9">
			<div id="content-center">
				<div class="col-med-4">
				<?php $this->load->view($content);?>
				</div>
			</div>
		</div> -->
		
	</div>
	<div class="clear20"></div>
</div>