<h2>Pendaftar</h2>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group form-group-sm">
		<label class="col-sm-2 control-label" for="formGroupInputSmall">Tahun</label>
		<div class="col-sm-3">
			<select name="tahun" id="tahun" class="form-control">
				<option value=""> --- PILIH TAHUN --- </option>
				<?php for($t=date('Y'); $t>=2015; $t--): ?>
					<?php
					
						if($t==$tahun){
							echo "<option value='".$t."' selected>".$t."</option>";
						}else{
							echo "<option value='".$t."'>".$t."</option>";
						} 
					?>	
				<?php endfor ?>
			</select>
		</div>
		<div style="clear:both"></div>
	</div>
	 <div class="form-group form-group-sm">
		<label class="col-sm-2 control-label" for="formGroupInputSmall"></label>
		<div class="col-sm-6">
			<button type="submit" class="btn btn-inverse">Tampilkan</button>
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
<a href="<?php echo site_url('snmptn/siswa/impor')?>" id="add" class="btn btn-inverse btn-small aksi" style="color:#fff" ><i class="icon-edit icon-white">&nbsp;</i> Impor Excel</a>
</div>
<div class="clear10"></div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="5%">No</th>
      <th width="15%">No. Pendaftaran</th>
      <th width="30%">Nama</th>
      <th width="18%">Tgl. Lahir</th>
      <th width="32%">Asal Sekolah</th>
    </tr>
  </thead>
  <tbody>
      <?php if(!isset($siswa) or empty($siswa)):
      	echo '<td colspan="6" align="center">Belum ada data.</td>';
      else:
			$i =$offset;
		  foreach ($siswa as $d): 
			$i++;
			?>
			<tr>
				<td align="center"><?php echo $i;?></td>
				<td><a href="<?php echo site_url('snmptn/siswa/detail_siswa/'.$d->nomor_pendaftaran)?>" class="detail"><u><?php echo $d->nomor_pendaftaran ?></u></a></td>
				<td><?php echo $d->nama_siswa; ?></td>
				<td><?php echo tanggal_indonesia($d->tanggal_lahir); ?></td>   
				<td><?php echo $d->nama_sekolah; ?></td>        
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
		$(".detail").colorbox({iframe:true, innerWidth:600, innerHeight:750});					
	});
	$(function(){
		setTimeout('closing_msg()', 4000);
	})

	function closing_msg(){
		$("bs-callout").slideUp();
	}
</script>