<script type="text/javascript">
$(document).ready(function(){
$(".delete").click(function(){
var message = "Yakin Mau Dihapus, Bro?";
if (confirm(message))
{
location.href=$(this).attr("href");
}
return false;
});
});
</script>
<h2>Slide</h2>
<?php $i=$offset; ?>
<div class="add" style="text-align:right; width:690px"><?php echo anchor('slide/addslide','Tambah'); ?></div><br/>
<table width="700" id="product-table">
<tr>
	<th width="2%" class="table-header-check">No</th>
	<th width="28%" class="table-header-repeat line-left">Judul</th>
	<th width="35%" class="table-header-repeat line-left">Deskripsi</th>
	<th width="15%" class="table-header-repeat line-left">Image</th>
	<th width="8%" class="table-header-repeat line-left">Status</th>
	<th width="12%" class="table-header-options line-left">Aksi</th>
	</tr>
		<?php foreach ($slide as $f): ?>
		<tr>
			<td><?php echo ++$i ?></td>
			<td align="left"><?php echo $f->judul ?></td>
			<td align="left"><?php echo $f->deskripsi ?></td>
			<td align="center"><img src="<?php echo base_url();?>files/photo/<?php echo $f->image ?>" width="80" /></td>
			<td align="center"><?php echo $f->active ?></td>
			<td>
			<a href="<?php echo site_url('slide/editslide/'.$f->id_slide); ?>" title="Edit" class="icon_edit info-tooltip"></a>
			<a href="<?php echo site_url('slide/deleteslide/'.$f->id_slide); ?>" title="Hapus" class="delete icon_delete info-tooltip"></a>
			</td>
		</tr>
		<?php endforeach ?>
</tr>
</table>
<div><?php echo $this->pagination->create_links(); ?></div>


