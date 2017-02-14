<?php
		$data = $this->security->xss_clean($this->uri->segment(1));
		$buka = ($data == 'pendaftaran')? 'buka':'';
?>
		<li id="li-adminpmb" class="item">
			<a href="#adminpmb" class="item"><span>PMB</span></a>
			<div class="underline-menu"></div>
				<ol id="ol-adminpmb" class="<?php echo $buka;?>" style="">
				<li class="submenu">

				<a href="<?php echo base_url('pendaftaran/form_control/lihat_form'); ?>">Daftar Penerimaan Mahasiswa Baru</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('pendaftaran/form_control/'); ?>">Program Studi</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('pendaftaran/form_control/'); ?>">Jadwal</a>
				</li>
				</ol>
		</li>