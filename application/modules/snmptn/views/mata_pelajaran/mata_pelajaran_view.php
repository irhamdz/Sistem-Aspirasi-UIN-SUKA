<h2>Daftar Mata Pelajaran</h2>

<?php $msg = $this->session->flashdata('message');?>
<?php if(isset($msg) and !empty($msg)):?>
	<div id="information" class="bs-callout bs-callout-info">
		<?php echo $this->session->flashdata('message');?>
	</div>
<?php endif ?>
<div class="text-right">
<a href="<?php echo site_url('snmptn/mata_pelajaran/impor')?>" id="add" class="btn btn-inverse btn-small aksi" style="color:#fff" ><i class="icon-edit icon-white">&nbsp;</i> Impor Excel</a>
</div>
<div class="clear10"></div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="5%">No.</th>
      <th width="20%">Kode Mata Pelajaran</th>
      <th width="70%">Mata Pelajaran</th>
    </tr>
  </thead>
  <tbody>
      <?php if(!isset($mata_pelajaran) or empty($mata_pelajaran)):
      	echo '<td colspan="6" align="center">Belum ada data.</td>';
      else:
			$i = $offset;
		  foreach ($mata_pelajaran as $d): 
			$i++;
			?>
			<tr>
				<td align="center"><?php echo $i;?></td>
				<td><?php echo $d->kode_mata_pelajaran; ?></td>
				<td><?php echo $d->mata_pelajaran; ?></td>
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