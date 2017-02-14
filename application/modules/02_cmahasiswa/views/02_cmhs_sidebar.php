<?php 
/* 02_CMHS SIDEBAR */
if($this->session->userdata('status') == 'pmb' || $this->session->userdata('status')=='s2' || $this->session->userdata('status')=='s3'): 
$data = explode("-", $this->security->xss_clean($this->uri->segment(2)));
//if($data[0]=='data'){
if($this->session->userdata('status')){

	$buka='buka';
}else{
	$buka='';
} 
echo '<li id="li-cmhs-menu" class="item"><a href="#cmhs-menu" class="item" name="ul-sub1-c"><span>Penerimaan Mahasiswa Baru</span></a>
	<div class="underline-menu"></div>
		<ol id="ol-cmhs-menu" class="'.$buka.'">';
		$menu='<li class="submenu">'.anchor(''.$this->session->userdata('status').'/data-pendaftar', 'Daftar Penerimaan Mahasiswa Baru', 'title=""').'</li>';
		$menu1='<li class="submenu">'.anchor(''.$this->session->userdata('status').'/data-pendaftar', 'Data Pribadi', 'title=""').'</li>';
		$menu2='<li class="submenu">'.anchor(''.$this->session->userdata('status').'/data-orang_tua', 'Data Orang Tua', 'title=""').'</li>';
		$menu3='<li class="submenu">'.anchor(''.$this->session->userdata('status').'/data-pilihan_jurusan', 'Pilihan Jalur & Jurusan', 'title=""').'</li>';
		$menu4='<li class="submenu">'.anchor(''.$this->session->userdata('status').'/data-prestasi_ekstra_kulikuler', 'Data Prestasi Ekstra kulikuler', 'title=""').'</li>';
		$menu5='<li class="submenu">'.anchor(''.$this->session->userdata('status').'/data-cetak_kartu_ujian', 'Cetak Kartu Ujian', 'title=""').'</li>';
		$menu6='<li class="submenu">'.anchor(''.$this->session->userdata('status').'/data-penelitian', 'Penelitian', 'title=""').'</li>';
		$menu7='<li class="submenu">'.anchor(''.$this->session->userdata('status').'/data-karya_tulis', 'Karya Tulis', 'title=""').'</li>';
		$menu8='<li class="submenu">'.anchor(''.$this->session->userdata('status').'/data-proposal_disertasi', 'Proposal Disertasi', 'title=""').'</li>';
		switch($this->session->userdata('jenis_penerimaan')){
				case 1: case 9: echo $menu; break;
				#case 2: echo $menu1.$menu3; break;
				case 2: echo $menu; break;
				case 4: case 5: case 8: echo $menu; break;
		}
echo '</ol></li>'; endif; ?>