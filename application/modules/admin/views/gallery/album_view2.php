<h2>Album</h2>
<?php $i=0;?>
<table width="600" id="product-table">
<tr>
		<?php foreach ($gallery as $f): ?>
			
			<td valign="top" align="center" style="width:180px; margin:3px;">
				<a class="album" href="<?php echo site_url('gallery/index/'.$f->id_album) ?>" >
				<img src="<?php echo base_url();?>files/gallery/<?php echo $f->image ?>" width="180" />
				<br/><?php echo $f->nama_album ?>
				</a>
				<br/>
				<br/>
			</td>
		<?php 
		++$i;
		if($i%3==0){echo"</tr><tr>";}
		?>
		<?php endforeach ?>
</tr>
</table>
<div><?php echo $this->pagination->create_links(); ?></div>
<style>
a.album{
color:#333;
font-weight:normal;
}
</style>