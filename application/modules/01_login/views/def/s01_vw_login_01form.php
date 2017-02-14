<?php
	#setcookie('cap001', t1_encode($this->_000_text_captcha()), time()+60);
	
	$cr_u 	= rand(100,300)."#^PXUNAME";
	$cr_p	= rand(200,400).")/PXUPASS";
	
	$en1 = @openssl_encrypt($cr_u, 'des-cbc', ENCRYPT_KEY01);
	$en2 = @openssl_encrypt($cr_p, 'des-cbc', ENCRYPT_KEY01);
?>	
<?php
	#setcookie('cap001', t1_encode($this->_000_text_captcha()), time()+60);
	
	$cr_u 	= rand(100,300)."#^PXUNAME";
	$cr_p	= rand(200,400).")/PXUPASS";
	
	$en1 = @openssl_encrypt($cr_u, 'des-cbc', ENCRYPT_KEY01);
	$en2 = @openssl_encrypt($cr_p, 'des-cbc', ENCRYPT_KEY01);
	$l1 = $this->s00_lib_sh_menu->build_url_stt('m0b1','informasi');
	$l2 = $this->s00_lib_sh_menu->build_url_stt('m0b2','informasi');
	$l3 = $this->s00_lib_sh_menu->build_url_stt('m0b3','informasi');
	
?>	
		<h2>Login</h2>
		<br>
		<div class="login-form">
				<form method="post" action="<?php echo site_url('open_login'); ?>">		
					<div class="form-group">
						<input type="text"  id="username" class="form-control" name="logu1" placeholder="Username">
						<span style="color:red;"><?php echo form_error('username'); ?></span>
					</div>
					<div class="form-group">
						<input type="password" id="password" class="form-control" name="logp1" placeholder="Password" >
						<span style="color:red;"><?php echo form_error('password'); ?></span>
					</div>
					<button type="submit" class="btn-uin btn btn-inverse btn btn-small" style="float:right;">Login</button><br>
				</form>
			</div>
		<br>
		<div class="login-links">
			<div class="login-link">
				<a class="link-icon kalender" href="<?php echo base_url().$l1; ?>" title="Jadwal &amp; Pedoman PMB">
				Jadual &amp; Brosur PMB
				</a>
			</div>
			<div class="login-link">
				<a class="link-icon matakuliah" href="<?php echo base_url().$l2; ?>" title="Jadwal &amp; Pedoman PMB">
				Mata Kuliah &amp; Dosen
				</a>
			</div>
			<div class="login-link" class="login-link">
				<a class="link-icon pembayaran" href="<?php echo base_url().$l3; ?>" title="Jadwal &amp; Pedoman PMB">
				Panduan &amp; Tarif Pembayaran
				</a>
			</div>
		</div>
		<br />
		<br />
		<br />
		<br />
		<br />
		<?PHP /* <div class="login-links">
			<div class='bs-callout bs-callout-success'>
			<b style="font-size:11px; margin-left:5px;">Petunjuk Pendaftaran</b><hr />
			<p align="justify" style="font-size:11px; margin-left:5px;">Pendaftaran dapat dilakukan dengan cara :</p>
			<ol style="font-size:11px; margin-left:5px;">
				<li style="padding:0;" align="justify">1. Membayar biaya pendaftaran di bank sesui petunjuk pada <a href="/informasi/awal-petunjuk-pembayaran.html">tautan berikut</a>.</li>
				<li style="padding:0;" align="justify">2. Login ke halaman ini menggunakan KODE dan PIN yang diterakan pada bukti pembayaran</li>
			</ol>
			<br />
			<b style="font-size:11px; margin-left:5px;">Admission Procedure</b><hr />
			<p align="justify" style="font-size:11px; margin-left:5px;">Please enter your email address in the <b>username column</b> and click login. We will send a username and password to your email. You can use the username & password to login to this website and fill the admission form</p>
			</div>
		</div> */ ?>
		<?php /*
		<div class="login-links">
			<div class='bs-callout bs-callout-success'>
			<b style="font-size:11px; margin-left:5px;">Petunjuk Pendaftaran</b><br />
			<b style="font-size:11px; margin-left:5px;"><i>Admission Procedure</i></b><hr />
			<p align="justify" style="font-size:11px; margin-left:5px;">Informasi pendaftaran bagi Warga Negera Indonesia (WNI) bisa dilihat padata <a href="/informasi/awal-petunjuk-pembayaran.html"><u><b>tautan berikut</b></u></a></p>
			
			<p align="justify" style="font-size:11px; margin-left:5px;"><i>Admission procedure for non-Indonesian citizen can be <a href="/informasi/awal-petunjuk-pembayaran.html"><u><b>found here</b></u></a></i></p>
			</div>
		</div>
		*/ ?>
		<?php /*
		<div class="login-links" style="">
			
			<div class="login-link">
				<?php
					#$l1 = '';
					$l1 = $this->s00_lib_sh_menu->build_url_stt('m0b1','informasi');
					$t0 = 'Jadual &amp; Brosur PMB';
					$t1 = '<div class="link-icon jadwal-pmb">'.$t0.'</div>';
					echo anchor($l1,$t1,'title="'.$t0.'"');
				?>
			</div>
			<div class="login-link">
				<?php
					$l1 = $this->s00_lib_sh_menu->build_url_stt('m0b2','informasi');
					$t0 = 'Mata Kuliah &amp; Dosen';
					$t1 = '<div class="link-icon matakuliah">'.$t0.'</div>';
					echo anchor($l1,$t1,'title="'.$t0.'"');
				?>
			</div>
			<div class="login-link">
				<?php
					$l1 = $this->s00_lib_sh_menu->build_url_stt('m0b3','informasi');
					$t0 = 'Panduan &amp; Tarif Pembayaran';
					$t1 = '<div class="link-icon pembayaran">'.$t0.'</div>';
					echo anchor($l1,$t1,'title="'.$t0.'"');
				?>
			</div>
		</div>
		*/ ?>
		
		<div class="ganjel"></div>






















