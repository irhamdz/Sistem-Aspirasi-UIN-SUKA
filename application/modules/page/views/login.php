<h2>Login</h2>
<br>
<div class="login-form">
	<form method="post" action="<?php echo site_url(/*'admin/validate'*/'/user')?>">		
		<div class="form-group">
			<input type="text" name="username" id="username" class="form-control" name="logu1" placeholder="Nama / Email">
		</div>
		<div class="form-group">
			<input type="password" name="password" id="password" class="form-control" name="logp1" placeholder="Password" >
		</div>
		<button type="submit" class="btn-uin btn btn-inverse btn btn-small" style="float:right;">Login</button>
		<br>
	</form>
</div>	
<br>				
<!-- echo site_url udah di route -->		
<div class="login-links">
	<div class="login-link">
		<a class="link-icon matakuliah" href="<?php echo site_url('page/daftar'); ?>" title="Daftar Sebagai Masyarakat">
		Daftar
		</a>
	</div>
	<div class="login-link">
		<a class="link-icon monitoring-surat" href="<?php echo site_url('page/history'); ?>" title="Cek Aspirasi">
		Cek Aspirasi
		</a>
	</div>
	<!-- <div class="login-link" class="login-link">
		<a class="link-icon pembayaran" href="<?php echo site_url('page/dokumen/pembayaran'); ?>" title="Panduan Aspirasi">
		Panduan Aspirasi
		</a>
	</div> -->
</div>