<h2>Daftar Jurusan Sekolah</h2>

<?php $msg = $this->session->flashdata('message');?>
<?php if(isset($msg) and !empty($msg)):?>
	<div id="information" class="bs-callout bs-callout-info">
		<?php echo $this->session->flashdata('message');?>
	</div>
<?php endif ?>
<div class="text-right">
<a href="<?php echo site_url('snmptn/jurusan_sekolah/impor')?>" id="add" class="btn btn-inverse btn-small aksi" style="color:#fff" ><i class="icon-edit icon-white">&nbsp;</i> Impor Excel</a>
</div>
<div class="clear10"></div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="5%">No.</th>
      <th width="15%">ID Jurusan</th>
      <th width="20%">NPSN Sekolah</th>
      <th width="15%">Masa Studi</th>
      <th width="20%">Kode Jurusan</th>
      <th width="10%">Akreditasi</th>
      <th width="25%">Nila Akreditasi</th>
    </tr>
  </thead>
  <tbody>
      <?php if(!isset($jurusan_sekolah) or empty($jurusan_sekolah)):
      	echo '<td colspan="6" align="center">Belum ada data.</td>';
      else:
			$i = $offset;
		  foreach ($jurusan_sekolah as $d): 
			$i++;
			?>
			<tr>
				<td align="center"><?php echo $i;?></td>
				<td><?php echo $d->id_jurusan; ?></td>
				<td><?php echo $d->npsn_sekolah; ?></td>
				<td><?php echo $d->masa_studi; ?></td>
				<td><?php echo $d->kode_jurusan; ?></td>
				<td><?php echo $d->akreditasi; ?></td>
				<td><?php echo $d->nilai_akreditasi; ?></td>
			</tr>
		  <?php endforeach; ?>
      <?php endif; ?>
  </tbody>
</table>

<div class="pagination">
	<?php
	echo $this->pagination->create_links();
	?>
</div>

<script>
	$(document).ready(function(){
		$(".detail").colorbox({iframe:true, innerWidth:500, innerHeight:500});					
	});
	$(function(){
		setTimeout('closing_msg()', 4000);
	})

	function closing_msg(){
		$("bs-callout").slideUp();
	}
</script>