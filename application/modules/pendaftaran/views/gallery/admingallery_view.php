<script type="text/javascript">
$(document).ready(function(){
$(".delete").click(function(){
var message = "Yakin Mau Dihapus?";
if (confirm(message))
{
location.href=$(this).attr("href");
}
return false;
});
});
</script>
<h2>Album</h2>
<?php $i=0;?>
<div class="add" style="text-align:right; width:690px"><?php echo anchor('gallery/addgallery/'.$id_album,'Tambah'); ?></div><br/>
<table width="700" id="product-table">

<tr>
		<?php foreach ($gallery as $f): ?>
			
			<td align="center" style="width:200px; margin:3px;">
			<div style="margin:0 0 15px 80px;">
				<a href="<?php echo site_url('gallery/deletegallery/'.$f->id_album.'/'.$f->id_gallery); ?>" title="Hapus" class="delete icon_delete info-tooltip"></a>
			</div>
				<a href="<?php echo site_url('gallery/admingallery/'.$f->id_album);?>">
				<br/><img src="<?php echo base_url();?>files/gallery/<?php echo $f->id_album ?>/<?php echo $f->image ?>" width="200" />
				<br/><?php echo $f->nama_gallery?>
			</td>
		<?php 
		++$i;
		if($i%3==0){echo"</tr><tr>";}
		?>
		<?php endforeach ?>
</tr>
</table>

