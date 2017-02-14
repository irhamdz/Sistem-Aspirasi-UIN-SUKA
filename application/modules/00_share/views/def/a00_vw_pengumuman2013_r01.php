	<div class="article-content">
	<?php //sia_comment($pengumuman1); #
	// echo print_r($pengumuman1);  
	
	foreach($pengumuman1 as $d1): $d = $d1[0]; ?>
	<div class="news-list">
		<div class="judul-artikel"><?php 
			$link = str_replace('/-','/',$url_d1);
			$link = str_replace('%LINK%',$d['PG_SLUG'],$link);
			echo anchor($link,$d['PG_JUDUL'],'class="" title="'.sia_rip_tags($d['PG_JUDUL']).'"'); 
			?></div>
		<span class="tgl-post"><?php echo date_trans_foracle($d['PG_TGLLOG_F'],1,'1 231 111',' '); ?> WIB
		<div class="page_counter">Dilihat : <?php echo $d['PG_LIHAT']?> Kali</div></span>
		<img class="thumb" src="<?php echo admisi_urlfoto($d['URL_FOTO']); ?>" alt="<?php echo $d['PG_JUDUL']; ?>">
		<p class="isi" style="font-weight:normal">
			<?php echo character_limiter(sia_rip_tags($d['PG_ISI']),300); ?>
		</p>
		<div style="clear:both"></div>
		<a class="btn-uin btn btn-inverse btn btn-small" href="<?php echo site_url($link); ?>" style="margin: 0; float: right; color: #FFF;">Selengkapnya>></a>
		<div style="clear:both" style="margin-bottom:1%;"></div>
	</div><div style="height:9px;"></div>
	<?php endforeach; ?>
	
	</div>

			