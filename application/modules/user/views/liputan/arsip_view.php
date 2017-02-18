<div  class="article-content">
	<?php foreach($liputan as $b){ ?>
						
		<div class="news-list">
			<div class="judul-artikel">
			<a href="<?php echo site_url('page/liputan/detail/'.$b->id_liputan.'/'.url_title(strtolower($b->judul))) ?>"><?php echo $b->judul ?></a>
			</div>
			<span class="tgl-post"><?php echo nama_hari($b->tgl_posting).', '.tanggal_indonesia($b->tgl_posting).' '.$b->jam_posting ?> WIB <span class="page_counter">dilihat :  <?php echo $b->counter ?> kali</span></span>
			<?php if($b->foto !=null){?>
			<img class="thumb" src="<?php echo base_url().'media/news/'.$b->foto ?>" />
			<?php } ?>
			<div class="isi" style="font-weight:normal">
			<?php
			$isi=preg_replace('/<p align="center">(&nbsp;|[\s\p{Z}\p{C}\x85\xA0\x{0085}\x{00A0}\x{FFFD}]+)*<\/p>/iu',"",htmlspecialchars_decode($b->isi_liputan));
			$isi=preg_replace('/<p>(&nbsp;|[\s\p{Z}\p{C}\x85\xA0\x{0085}\x{00A0}\x{FFFD}]+)*<\/p>/iu',"",$isi);
			$isi=preg_replace('/(&nbsp;)*/iu',"",$isi);
			echo substr(strip_tags(html_entity_decode($isi)),0,300)?>....
			</div>
			<div style="clear:both"></div>
			<a class="btn-uin btn btn-inverse btn btn-small" style="float:right"  href="<?php echo site_url('page/liputan/detail/'.$b->id_liputan.'/'.url_title(strtolower($b->judul))) ?>"><i class="btn-uin"></i>Selengkapnya >></a> 
			<div style="clear:both"></div>
		</div>
	<?php } ?>

	<div class="pagination">
		<?php
		echo $this->pagination->create_links();
		?>
	</div>
</div>