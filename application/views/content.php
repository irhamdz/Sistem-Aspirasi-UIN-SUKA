<div id="app_content">
	<?php	
	if($this->breadcrumb->output()){
	echo $this->breadcrumb->output(); 
	?>
	<div class="clear10"></div>
	<?php } ?>
	<div class="app-row">
		<div class="col-med-3">
			<nav class="accordion">
				<ol>
					<?php 
					$this->load->view('s00_vw_sidebar',	array('in_data' => $in_data));?>
					<?php if($this->session->userdata('id_user') != '' or $this->session->userdata('praregistrasi_nama')!=''){ ?>
					<li id="item-logout" class="item" style="margin-bottom:5%;">
						<a href="<?php echo site_url('logout'); ?>" class="item" name="ul-sub0-c"><span>Logout</span></a>
						<div class="underline-menu"></div>
					</li>
					<?php } ?>
				</ol>
			</nav>
		</div>
		 <?php #print_r($data);
		if(isset($jenis_kolom)=="3"){?>
		<div class="col-med-6">
		<?php }else{ ?>
		<div class="col-med-9">
		<?php } ?>
			<?php 
			#print_r($artikel);
			$this->load->view($content);?>
		</div>
		 <?php if(isset($jenis_kolom)=="3"){?>
		<div class="col-med-3">
			 <?php $this->load->view('00_share/def/a00_vw_pengumuman2013_r03'); ?> 
		</div>					
		<?php } ?>
		
	</div>
	<div class="clear20"></div>
	<div class="app-row">
	<?php if($data['app_category'] == '01_login'): ?>
				<?php  $this->load->view('01_login/def/s01_vw_login_04infopengumuman'); ?>
		<?php endif; ?>
	</div>
	
	
	
</div>