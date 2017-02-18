
<div  class="article-content">						
	<div class="judul-artikel">
	<a href="<?php echo site_url('page/halaman/detail/'.$d->ID_HALAMAN.'/'.url_title(strtolower($d->JUDUL))) ?>"><?php echo $d->JUDUL ?></a>
	</div>
	<div class="clear20"></div>
	<?php if($d->FOTO !=null){?>
	<img src="<?php echo base_url().'media/images/'.$d->FOTO ?>" />
	<?php } ?>
			
	<div class="isi" style="font-weight:normal">
	<?php 
		$isi=preg_replace('/<p align="center">(&nbsp;|[\s\p{Z}\p{C}\x85\xA0\x{0085}\x{00A0}\x{FFFD}]+)*<\/p>/iu',"",htmlspecialchars_decode($d->ISI_HALAMAN));
		$isi=preg_replace('/<p>(&nbsp;|[\s\p{Z}\p{C}\x85\xA0\x{0085}\x{00A0}\x{FFFD}]+)*<\/p>/iu',"",$isi);
		$isi=preg_replace('/(&nbsp;)*/iu',"",$isi);
		echo html_entity_decode($isi);
	?>
	</div>

</div>

