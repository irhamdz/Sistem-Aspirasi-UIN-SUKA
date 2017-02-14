<?php		
	$v_nama		= $this->session->userdata('mhs_nama');
	$v_prodi	= $this->session->userdata('mhs_nm_prodi');
		
	switch($this->session->userdata('app')){
		case 'akademikmhs': $buka = 'buka'; $buka1 = ''; break;
		case 'bayarmhs': $buka1 = 'buka'; $buka = ''; break;
		default: $buka = ''; $buka1 = ''; break;
	}
	
	switch($this->session->userdata('status')){
		case 'mhs': 	
			$this->s00_lib_sh_menu->set_var('url_link','mahasiswa'); 
			$urlb1 = $this->s00_lib_sh_menu->build_url_stt('mmb4','pembayaran'); 
		break;
		case 'wali': 	
			$this->s00_lib_sh_menu->set_var('url_link','wali'); 
			$urlb1 = $this->s00_lib_sh_menu->build_url_stt('mmb5','pembayaran'); 
		break;
		default:		$urlb1 = '#'; $libmenu = 'lain'; break;
	}
?>		
		<li id="li-mhspembayaran" class="item">
			<a href="<?php echo site_url($urlb1); ?>" class="item"><span>Pembayaran</span></a>
		<div class="underline-menu"></div>
			<ol id="ol-mhspembayaran" class="<?php echo $buka1; ?>" style="">
				<?php
					$this->s00_lib_sh_menu->build_sidebar('mmb6', $v_nama);
					$this->s00_lib_sh_menu->build_sidebar('mmb1', $v_nama);
					$this->s00_lib_sh_menu->build_sidebar('mmb2', $v_nama);
				?>
			</ol>
		</li>	
		
		<li id="li-akademik" class="item">
			<a href="<?php echo site_url($this->s00_lib_sh_menu->url_link); ?>#akademik" class="item"><span>Perkuliahan</span></a>
		<div class="underline-menu"></div>
			<ol id="ol-akademik" class="<?php echo $buka; ?>" style="">
				<?php
					$this->s00_lib_sh_menu->build_sidebar('mmds', $v_prodi);
					$this->s00_lib_sh_menu->build_sidebar('mmkk', $v_prodi);
					#if($data['cek_smt'][0]['KD_SMT'] == '3'){
					#sidebar_url($submenu_02mhs_2013, 'mi3', $v_nama);
					#} else {
					if($this->session->userdata('status') == 'mhs'){
					$this->s00_lib_sh_menu->build_sidebar('mmi1', $v_nama);
					}
					$this->s00_lib_sh_menu->build_sidebar('mmi2', $v_nama);
					$this->s00_lib_sh_menu->build_sidebar('mmk1', $v_nama);
					$this->s00_lib_sh_menu->build_sidebar('mmk2', $v_nama);
					$this->s00_lib_sh_menu->build_sidebar('mmk3', $v_nama);
					$this->s00_lib_sh_menu->build_sidebar('mmp3', $v_nama);
					$this->s00_lib_sh_menu->build_sidebar('mmp4', $v_nama);
					$this->s00_lib_sh_menu->build_sidebar('mmp1', $v_nama);
					$this->s00_lib_sh_menu->build_sidebar('mmp2', $v_nama);
				?>
			</ol>
		</li>	