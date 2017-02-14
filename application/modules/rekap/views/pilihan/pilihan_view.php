<h2>Pilihan Program Studi</h2>

<?php $msg = $this->session->flashdata('message');?>
<?php if(isset($msg) and !empty($msg)):?>
	<div id="information" class="bs-callout bs-callout-info">
		<?php echo $this->session->flashdata('message');?>
	</div>
<?php endif ?>
<div class="text-right">
<a href="<?php echo site_url('snmptn/pilihan/impor')?>" id="add" class="btn btn-inverse btn-small aksi" style="color:#fff" ><i class="icon-edit icon-white">&nbsp;</i> Impor Excel</a>
</div>
<div class="clear10"></div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="5%">No.</th>
      <th width="15%">No. Pendaftaran</th>
      <th width="10%">Urutan PTN</th>
      <th width="10%">Urutan Prodi</th>
      <th width="10%">Kode Prodi</th>
      <th width="35%">Program Studi</th>
      <th width="15%">Diterima PTN Lain</th>
    </tr>
  </thead>
  <tbody>
      <?php if(!isset($pilihan) or empty($pilihan)):
      	echo '<td colspan="6" align="center">Belum ada data.</td>';
      else:
			$i = $offset;
		  foreach ($pilihan as $d): 
			$i++;
			?>
			<tr>
				<td align="center"><?php echo $i;?></td>
				<td><?php echo $d->nomor_pendaftaran; ?></td>
				<td><?php echo $d->urutan_ptn; ?></td>  
				<td><?php echo $d->urutan_program_studi; ?></td>
				<td><?php echo $d->kode_program_studi; ?></td>
				<td><?php echo $d->program_studi; ?></td>
				<td><?php echo $d->diterima_ptn_lain; ?></td>
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