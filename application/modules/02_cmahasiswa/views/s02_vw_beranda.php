<?php
$nama_pendaftar=str_replace("#39;", "'", $pendaftar);
?>
<?php 

	// $crumbs = array(array('Beranda'=>base_url()));
	// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
	// $w_info 	= $this->session->flashdata('warning-info');
	// $w_type 	= $this->session->flashdata('warning-type'); 
?>

<div class="article-content">
	<div class="news-list">
		<?php $link = base_url().'informasi/liputan-detil/'.$liputan[0]->PG_SLUG.'.html'; ?>
		<div class="judul-artikel"><a href="<?php echo $link; ?>" class="" title="<?php echo $liputan[0]->PG_JUDUL; ?>"><?php echo $liputan[0]->PG_JUDUL; ?></a></div>
		<span class="tgl-post"><?php echo date_trans_foracle($liputan[0]->PG_TGLLOG_F,1,'1 231 111',' '); ?> WIB</span>
		<img class="thumb" src="<?php echo admisi_urlfoto($liputan[0]->URL_FOTO); ?>" title="<?php echo sia_rip_tags($liputan[0]->PG_JUDUL); ?>">
		<p class="isi" style="font-weight:normal">
			Mahasiswa yang telah melakukan pendaftaran beasiswa BI tahun 2014 untuk segera melengkapi persyaratan Surat Keterangan Tidak Mampu (SKTM) / Kartu Menuju Sejahtera (KMS) dari Kelurahan / Kepala Desa dengan mengetahui RT/RW sesuai KTP. Upload file hasil scan SKTM/KMS sampai tanggal 29 April 2014&#8230;		</p>
		<div style="clear:both"></div>
		<a class="btn-uin btn btn-inverse btn btn-small" href="<?php echo $link; ?>" style="margin: 0; float: right; color: #FFF;">Selengkapnya>></a>
		<div style="clear:both" style="margin-bottom:1%;"></div>
	</div>
</div>


