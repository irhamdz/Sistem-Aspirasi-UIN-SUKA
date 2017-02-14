<div id="content-center">
<h2>Album</h2>
<br/>
<?php $i=0;?>
<div style="text-align:right; margin:10px;">
<a href="<?php echo site_url('admin/gallery/add') ?>" class="button orange">Tambah</a>
</div>
<table width="600">
<tr>
			<?php foreach($album->result() as $f): ?>
			
			<td valign="top" align="center" style="width:180px; margin:3px;">
				<a class="album" href="<?php echo site_url('admin/gallery/pictures/'.$f->id_album) ?>" >
				<img src="<?php echo base_url();?>media/gallery/<?php echo $f->image ?>" width="180" />
				<br/><?php echo $f->nama_album ?>
				</a>
				<br/>
				<br/>
			</td>
		<?php 
		++$i;
		if($i%4==0){echo"</tr><tr>";}
		?>
		<?php endforeach ?>
</tr>
</table>
	<div class="pagination">
	<?php
	echo $this->pagination->create_links();
	?>
</div>
</div>