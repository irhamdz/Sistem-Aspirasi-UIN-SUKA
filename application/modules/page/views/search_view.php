<div  class="article-content">
	<?php if(isset($cari) and !empty($cari)){ ?>
		<?php foreach($cari as $d){ ?>
			<div class="news-list">
			<span class="tipe"><?php echo $d->tipe ?></span>
			<?php
				$url="";
				switch ($d->tipe) {
					case 'Berita':
						$url=site_url('page/berita/detail/'.$d->id.'/'.url_title(strtolower($d->judul)));
						break;
					case 'Kolom':
						$url=site_url('page/kolom/detail/'.$d->id.'/'.url_title(strtolower($d->judul)));
						break;
					case 'Agenda':
						$url=site_url('page/agenda/detail/'.$d->id.'/'.url_title(strtolower($d->judul)));
						break;
					case 'Pengumuman':
						$url=site_url('page/pengumuman/detail/'.$d->id.'/'.url_title(strtolower($d->judul)));
						break;
				}
				?>
				<div class="judul-artikel"><a href="<?php echo $url ?>"><?php echo $d->judul ?></a></div>
				<span class="tgl-post"><?php echo nama_hari($d->tgl_posting).', '.tanggal_indonesia($d->tgl_posting).' '.$d->jam_posting ?> WIB <span class="page_counter">Dilihat :  <?php echo $d->counter ?> kali</span></span>
				
				</div>
			<?php } ?>
		<?php }else{ ?>
			<span class="tgl-post" style="text-align:center">Data tidak ditemukan</span>
		
		<?php } ?>
		<div class="cleaner_h20"></div>
		<div class="pagination">
		<?php
		echo $this->pagination->create_links();
		?>
		</div>
</div>