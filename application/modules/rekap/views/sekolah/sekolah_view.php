<h2>Daftar Sekolah</h2>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group form-group-sm">
		<label class="col-sm-2 control-label" for="formGroupInputSmall">Nama Sekolah</label>
		<div class="col-sm-4">
			<input name="nama_sekolah" id="nama_sekolah" class="form-control"/>
				
		</div>
		<div style="clear:both"></div>
	</div>
	 <div class="form-group form-group-sm">
		<label class="col-sm-2 control-label" for="formGroupInputSmall"></label>
		<div class="col-sm-6">
			<button type="submit" class="btn btn-inverse">Cari</button>
		</div>
		<div style="clear:both"></div>
	</div>						
</form>	
<?php $msg = $this->session->flashdata('message');?>
<?php if(isset($msg) and !empty($msg)):?>
	<div id="information" class="bs-callout bs-callout-info">
		<?php echo $this->session->flashdata('message');?>
	</div>
<?php endif ?>
<div class="text-right">
<a href="<?php echo site_url('snmptn/sekolah/impor')?>" id="add" class="btn btn-inverse btn-small aksi" style="color:#fff" ><i class="icon-edit icon-white">&nbsp;</i> Impor Excel</a>
</div>
<div class="clear10"></div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="5%">No.</th>
      <th width="10%">NPSN</th>
      <th width="35%">Nama Sekolah</th>
      <th width="25%">Kabupaten/Kota</th>
      <th width="25%">Provinsi</th>
    </tr>
  </thead>
  <tbody>
      <?php if(!isset($sekolah) or empty($sekolah)):
      	echo '<td colspan="6" align="center">Belum ada data.</td>';
      else:
			$i = $offset;
		  foreach ($sekolah as $d): 
			$i++;
			?>
			<tr>
				<td align="center"><?php echo $i;?></td>
				<td><a href="<?php echo site_url('snmptn/sekolah/detail_sekolah/'.$d->npsn)?>" class="detail"><u><?php echo $d->npsn ?></u></a></td>
				<td><?php echo $d->nama_sekolah; ?></td>
				<td><?php echo $d->nama_kabupaten; ?></td>  
				<td><?php echo $d->nama_provinsi; ?></td>           
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