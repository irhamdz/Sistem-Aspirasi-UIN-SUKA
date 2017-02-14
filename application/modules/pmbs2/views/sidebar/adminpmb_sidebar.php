<?php
$data = $this->security->xss_clean($this->uri->segment(1));
		$buka = ($data == 'adminpmb')? 'buka':'';
?>
		<li id="li-adminpmb" class="item">
			<a href="#adminpmb" class="item"><span>Admin PMB</span></a>
			<div class="underline-menu"></div>
				<ol id="ol-adminpmb" class="<?php echo $buka;?>" style="">
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_penawaran_jalur'); ?>">Penawaran Jalur</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_ruang'); ?>">Ruang</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/form_jadwal_ujian'); ?>">Jadwal Ujian</a>
				</li>
				</ol>
		</li>