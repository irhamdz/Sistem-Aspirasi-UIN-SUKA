<?php
$cek=$this->lib_reg_fungsi->cek_kelengkapan($NO_TEST);
//echo "cek isi ".count($cek);
$base_url='praregistrasi';
//print_r($cek);
$urlnow=$this->uri->uri_string();
if($cek){
	?>
	<div class="bs-callout bs-callout-warning">
	<ol>
		<?php
		foreach($cek as $k => $v){
			if($k=='halaman2' and $urlnow=="$base_url/data_keluarga"){
				echo $v;
			}elseif($k=='halaman3' and $urlnow=="$base_url/data_ibu"){
				echo $v;
			}elseif($k=='halaman4' and $urlnow=="$base_url/data_bapak"){
				echo $v;
			}elseif($k=='halaman5' and $urlnow=="$base_url/data_wali"){
				echo $v;
			}elseif($k=='halaman6' and $urlnow=="$base_url/data_fisik"){
				echo $v;
			}elseif($k=='halaman7' and $urlnow=="$base_url/data_file"){
				echo $v;
			}else{				
				if($k=="halaman2"){
					?>
					<li><a href='<?php echo site_url("$base_url/data_keluarga") ?>'><u>Informasi Data Keluarga masih kurang</u> &raquo;</a></li>
					<?php
				}
				if($k=="halaman3"){
					?>
					<li><a href='<?php echo site_url("$base_url/data_ibu") ?>'><u>Informasi Data Ibu masih kurang</u> &raquo;</a></li>
					<?php
				}
				if($k=="halaman4"){
					?>
					<li><a href='<?php echo site_url("$base_url/data_bapak") ?>'><u>Informasi Data Bapak masih kurang</u> &raquo;</a></li>
					<?php
				}
				if($k=="halaman5"){
					?>
					<li><a href='<?php echo site_url("$base_url/data_wali") ?>'><u>Informasi Data Wali masih kurang</u> &raquo;</a></li>
					<?php
				}
				if($k=="halaman6"){
					?>
					<li><a href='<?php echo site_url("$base_url/data_fisik") ?>'><u>Informasi Data Fisik masih kurang</u> &raquo;</a></li>
					<?php
				}
				if($k=="halaman7"){
					?>
					<li><a href='<?php echo site_url("$base_url/data_file") ?>'><u>Informasi Data File masih kurang</u> &raquo;</a></li>
					<?php
				}
				
			}
		}
		?>
	</ol>
	</div>
	<?php
}else{
	?>
	<div class="bs-callout bs-callout-success">
		Terima kasih data yang anda masukkan sudah lengkap. Untuk selanjutnya silakan melihat pengumuman tarif & tata cara pembayaran 
		biaya pendidikan di laman dan tanggal yang sudah ditentukan dalam pengumuman.
		
		<!-- <a href='<?php echo site_url("$base_url/data_pdf") ?>' target='blank'><u>laman ini</u></a> -->
	</div>
	<?php
}
?>