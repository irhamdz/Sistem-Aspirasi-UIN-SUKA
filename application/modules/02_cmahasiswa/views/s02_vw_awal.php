<h1>Assalamu'alikum!<br /><?php echo 'Selamat '.ucwords(sia_msg_salam()).' '.$this->session->userdata('id_user'); ?></strong></h1>
<hr class='normal'>
<div class="system-content-sia">
<?php 
	$crumbs = array(array('Beranda'=>base_url()));
	$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
	$w_info 	= $this->session->flashdata('warning-info');
	$w_type 	= $this->session->flashdata('warning-type'); 
	if($w_info != ''): ?>
		<div id="error_msg">
		<p><?php echo $w_info; ?></p><p></p>
		</div>
<?php endif; ?>
<div class="sia-blog_area-konten">
<?php $this->load->view('02_cmahasiswa/02_vw_step_by_step'); ?>
</div>
<div class="sia-blog_area-arsip">
		<?php $this->load->view('00_share/def/a00_vw_pengumuman2013_r03'); ?>
	</div>
</div>