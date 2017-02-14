<h3><span>Kegiatan</span></h3>
<ul>
<?php foreach ($gallery as $f): ?>
	<li><a title="<?php echo $f->nama_album ?>" href="<?php echo site_url('gallery/index/'.$f->id_album) ?>"><img src="<?php echo base_url();?>files/gallery/<?php echo $f->image ?>" width="100" /></li>
	<?php endforeach ?>
</ul>