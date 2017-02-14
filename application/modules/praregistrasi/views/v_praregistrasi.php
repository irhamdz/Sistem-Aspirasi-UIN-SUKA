<?php 
	$this->load->view('v_mod_header');
	$param=array('Cek Data'=>site_url('praregistrasi/praregistrasi'));
	$this->lib_reg_fungsi->crumb($param);
?>
<div class="system-content-sia">
<link href="http://static.uin-suka.ac.id/css/progtracker.css" rel="stylesheet" type="text/css"/>
<?php
	echo $isi;
	$this->load->view("praregistrasi/v_mod_registrasi_tombol",$TOMBOL);
	?>
</form>
</div>