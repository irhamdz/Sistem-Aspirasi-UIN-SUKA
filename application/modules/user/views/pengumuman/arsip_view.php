
<div  class="article-content">
	<?php foreach($pengumuman as $d){ ?>
		<div class="news-list">
			<div class="judul-artikel">
			<?php
				if($d->nama_file!=null){
					echo"<a href='".base_url('page/pengumuman/detail/'.$d->id_pengumuman.'/'.url_title(strtolower($d->judul)))."'>".$d->judul."</a>";
				}else{						
					echo"<a href='".$d->url."' target='_blank'>".$d->judul."</a>";
				}
			  
			 ?>
				 
			</div>
			<span class="tgl-post"><?php echo nama_hari($d->tgl_posting).', '.tanggal_indonesia($d->tgl_posting).' '.$d->jam_posting ?> WIB <span class="page_counter">dilihat :  <?php echo $d->counter ?> kali</span></span>
			<div class="clear10"></div>
			
		</div>
		<?php } ?>
	<div class="pagination">
		<?php
		echo $this->pagination->create_links();
		?>
	</div>
</div>