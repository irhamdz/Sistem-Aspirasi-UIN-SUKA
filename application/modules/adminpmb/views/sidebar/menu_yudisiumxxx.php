<?php
$data = $this->security->xss_clean($this->uri->segment(1));
		$buka = ($data == 'adminpmb_yudisium')? 'buka':'';
?>
		<li id="li-adminpmb_yudisium" class="item">
			<a href="#adminpmb_yudisium" class="item"><span>Admin Yudisium</span></a>
			<div class="underline-menu"></div>
				<ol id="ol-adminpmb_yudisium" class="<?php echo $buka;?>" style="">
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/setting_yudisium'); ?>">Setting Putaran Yudisium</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/setting_grade_yudisium'); ?>">Setting Grade Yudisium</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/yudisium_c/setting_usia_yudisium'); ?>">Setting Usia</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/nilai_ujian_pmb'); ?>">Form Yudisium</a>
				</li>
				<li class="submenu">
					<a href="<?php echo base_url('adminpmb/input_data_c/hasil_yudisium'); ?>">Rekap Hasil Yudisium</a>
				</li>
				</ol>

		</li>