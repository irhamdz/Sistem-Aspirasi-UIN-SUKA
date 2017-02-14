	<?php 
		$w_info 	= $this->session->flashdata('warning-info');
		$w_type 	= $this->session->flashdata('warning-type');
		$v_nim 		= $this->session->userdata('id_user');
	?>
		
	<h1>
	Assalamu'alaikum!<br>
	Selamat <?php echo ucwords(sia_msg_salam()); ?> <?php echo $this->session->userdata('dosen_nama'); ?></h1>
	<hr class="normal">
	<h3><?php echo $data['datax']['app_text']; ?></h3>
	<span style="color:#A4884A;">Anda terakhir login pada hari <?php 
		echo date_trans_foracle($data['log_portal'][0]['LOG_TGL_PREV_F'],1,'1 231 111',' '); ?> WIB | total login: <?php echo $data['log_portal'][0]['LOG_COUNT']; ?> kali</span>
	
	<br><br><?php $this->s00_lib_output->output_crumbs($data['crumbs']); ?>
	
	<?php $this->load->view('00_share/def/a00_vw_pengumuman2013_r01', array('data' => $data)); ?>