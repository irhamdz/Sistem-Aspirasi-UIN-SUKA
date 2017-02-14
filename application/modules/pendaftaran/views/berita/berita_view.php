<h2>Daftar Berita</h2>
<?php $msg = $this->session->flashdata('message');?>
<?php if(isset($msg) and !empty($msg)):?>
	<div id="information" class="bs-callout bs-callout-info">
		<?php echo $this->session->flashdata('message');?>
	</div>
<?php endif ?>
<div class="text-right">
<a href="<?php echo site_url('admin/berita/add')?>" id="add" class="btn btn-inverse btn-small aksi" style="color:#fff" ><i class="icon-edit icon-white">&nbsp;</i> Tambah</a>
</div>
<div class="clear10"></div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="5%">No.</th>
      <th width="60%">Judul</th>
      <th width="15%">Tanggal</th>
      <th width="20%">Proses</th>
    </tr>
  </thead>
  <tbody>
      <?php if(!isset($berita) or empty($berita)):
      	echo '<td colspan="6" align="center">Belum ada data.</td>';
      else:
      	$i = 0;
      foreach ($berita as $d): 
		$i++;
      	?>
      	<tr>
      		<td align="center"><?php echo $i;?>.</td>
      		<td><?php echo $d->JUDUL ?></td>
      		<td><?php echo $d->TGL_POSTING; ?></td>
            <td class="input-medium">
				<a id="edit" class="btn btn-inverse btn-small aksi" href="<?php echo site_url('admin/berita/edit/'.$d->ID_BERITA); ?>" style="color:#fff"><i class="icon-edit icon-white"></i> Edit</a>
				<a id="hps" class="btn btn-inverse btn-small aksi"  href="<?php echo site_url('admin/berita/delete/'.$d->ID_BERITA); ?>" style="color:#fff"><i class="icon-trash icon-white"></i> Hapus</a>
            </td>
      	</tr>
      <?php endforeach; ?>
      <?php endif; ?>
  </tbody>
</table>

<script>
	$(function(){
		setTimeout('closing_msg()', 4000);
	})

	function closing_msg(){
		$(".bs-callout").slideUp();
	}
</script>