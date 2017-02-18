<div id="content-center">
		<div class="article-title">Jadwal & Brosur PMB</div>
		<div class="clear10"></div>
		<?php if(!empty($jadwal)):?>
		<?php foreach($jadwal as $id=>$j):?>
			<?php if($id==0){?>
				<div class="judul-artikel"><?php echo $j->nama_histori?></div>
				<iframe width="100%" height="500" src="<?php echo site_url('page/dokumen/docfile/'.$j->id_histori_dokumen)?>" ></iframe>
				<?php if($j->nama_file_sumber!=null):?>
				 <a class="btn-uin btn btn-inverse btn btn-small" style="float:right; margin-left:5px"  href="<?php echo site_url('page/dokumen/sourcefile/'.$j->id_histori_dokumen.'/'.$j->nama_histori)?>"><i class="btn-uin"></i>Download File Sumber</a> 				 
				<?php endif ?>
				<a class="btn-uin btn btn-inverse btn btn-small" style="float:right"  href="<?php echo site_url('page/dokumen/docfile/'.$j->id_histori_dokumen.'/'.$j->nama_histori)?>"><i class="btn-uin"></i>Download PDF</a>
				<div class="clear10"></div>
			<?php }else{ ?>
				<p>
				<?php echo $j->nama_histori ?> <a href="<?php echo site_url('page/dokumen/docfile/'.$j->id_histori_dokumen.'/'.$j->nama_histori)?>" target="_blank">[ Download PDF]</a>
				<?php if($j->nama_file_sumber!=null):?>
				 <a style=" margin-left:5px"  href="<?php echo site_url('page/dokumen/sourcefile/'.$j->id_histori_dokumen.'/'.$j->nama_histori)?>"> [ Download File Sumber ]</a> 				 
				<?php endif ?>
				</p>
			
			<?php } ?>
		<?php endforeach ?>
		<?php endif ?>
		
		<div class="clear20"></div>
		<?php if(!empty($brosur)):?>
		<?php foreach($brosur as $id=>$d):?>
			<?php if($id==0){?>
				<div class="judul-artikel"><?php echo $d->nama_histori?></div>
				<iframe width="100%" height="500" src="<?php echo site_url('page/dokumen/docfile/'.$d->id_histori_dokumen)?>" ></iframe>
				<div class="clear10"></div>
				<?php if($j->nama_file_sumber!=null):?>
				<a class="btn-uin btn btn-inverse btn btn-small" style="float:right; margin-left:5px"  href="<?php echo site_url('page/dokumen/sourcefile/'.$j->id_histori_dokumen.'/'.$j->nama_histori)?>"><i class="btn-uin"></i>Download File Sumber</a> 				 
				<?php endif ?>
				<a class="btn-uin btn btn-inverse btn btn-small" style="float:right"  href="<?php echo site_url('page/dokumen/docfile/'.$d->id_histori_dokumen.'/'.$d->nama_histori)?>"><i class="btn-uin"></i>Download PDF</a>
				<div class="clear10"></div>
			<?php }else{ ?>
				<p>
				<?php echo $d->nama_histori ?> <a href="<?php echo site_url('page/dokumen/docfile/'.$d->id_histori_dokumen.'/'.$d->nama_histori)?>" target="_blank">[ Download PDF]</a>
				<?php if($j->nama_file_sumber!=null):?>
				 <a style=" margin-left:5px"  href="<?php echo site_url('page/dokumen/sourcefile/'.$d->id_histori_dokumen.'/'.$d->nama_histori)?>"> [ Download File Sumber ]</a> 				 
				<?php endif ?>
				</p>
			
			
			<?php } ?>
		<?php endforeach ?>
		<?php endif ?>
</div>
