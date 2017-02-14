<?php
		$w_info 	= $this->session->flashdata('warning-info');
		$w_type 	= $this->session->flashdata('warning-type');
	?>
	<?php if($w_info != ''): ?>
	
		<div class="bs-callout bs-callout-error">
		<p style=""><?php echo $w_info; #echo strtoupper($w_info); ?>.</p>
		</div>
	<?php endif; ?>
	
	<?php# print_r($data); ?>
	
	<?php //PENGUMUMAN UPDATE DINAMIS, 09/11/2013 ?>
			
	<div class="clear"></div>
	<?php 
	#$this->load->view('00_share/def/a00_vw_pengumuman2013');
	// print_r($data);
		// print_r($pengumuman1[0]); die();
	 $this->load->view('00_share/def/a00_vw_pengumuman2013', array('data' => $pengumuman1[0], 'urlx' => $url_d0)); 
	?>
	<div class="clear"></div>
	
	<?php if(1<1): ?>
	<div style="float:left; width: 320px;  margin-right:10px;">
	<img src="<?php echo sia_urlfoto($pengumuman1[0]['URL_FOTO']); ?>" alt="<?php echo $pengumuman1[0]['PG_JUDUL']; ?>" title="<?php echo $pengumuman1[0]['PG_JUDUL']; ?>" style="width: 320px;">
	</div>
	<div style="float:left; width: 380px;">
		<h3 style="judul-01"><span><?php echo $pengumuman1[0]['PG_JUDUL']; ?></span></h3>
		<small style="font-weight:bold; font-style:italic;"><?php echo date_trans_foracle($pengumuman1[0]['PG_TGLLOG_F'],1,'1 131 110',' '); ?> WIB</small><br><br>
		<?php echo $pengumuman1[0]['PG_ISI']; ?>
	</div>
	
	
	<div style="float:left; width: 320px;  margin-right:10px;">
	<img src="<?php echo base_url('asset/img/02loginphoto.jpg'); ?>" alt="selamat datang di SUKAdemia" title="selamat datang di SUKAdemia" style="width: 320px;">
	</div>
	<div style="float:left; width: 380px;">
		<h2 style="margin-top:0;"><span>Pendaftaran Wisuda Periode I 2013/2014</span></h2>
		<ol>
		<li style="margin-bottom:3px;">Pendaftaran Wisuda Periode I 2013/2014 dibuka pada tanggal <strong>1-14 November 2013</strong>.</li> 
		<li style="margin-bottom:3px;">Sebelum melakukan pembayaran biaya wisuda di bank, pastikan semua syarat pembayaran wisuda telah terpenuhi.</li> 
		<li style="margin-bottom:3px;">Untuk melakukan pengecekan persyaratan pembayaran biaya wisuda, silakan <em>login</em> di laman ini kemudian pilih menu Wisuda.</li> 
		<li style="margin-bottom:3px;">Jika Anda telah berhasil melakukan pembayaran, lanjutkan dengan melakukan proses pendaftaran wisuda secara <em>online</em> melalui laman ini.</li> 
		</ol>
	</div>
	<?php endif; ?>
	<?php //endif; ?>
	