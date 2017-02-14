<?php $crumbs = array(array('<<'=>$error['current_page']),array('Kembali Ke Halaman Sebelumnya'=>'')); $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>"; ?>
<div class="sia-blog_area-konten">
	<div class="bs-callout bs-callout-error">
	<?php
		#print_r($error);
		$tt 	= explode('ORA',$error['message']);
		$error 	= substr($tt[1],6,$tt[1]-0);
		$error 	= str_replace('MAAF, ','',$error);
		$error 	= str_replace('MAAF','',$error);
		$error	= 'MAAF '.$this->session->userdata('id_user').',<br />'.$error;
				
		echo $error.'.';
	?>
	</div>
</div>
<div class="sia-blog_area-arsip"><?php $this->load->view('00_share/def/a00_vw_pengumuman2013_r03'); ?></div>