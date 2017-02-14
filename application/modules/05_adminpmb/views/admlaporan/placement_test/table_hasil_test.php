<form method='POST' id='fup_bp' action='admlaporan-placement_test' >
<?php if(isset($get_mhs) && !empty($get_mhs) && isset($opt) && !empty($opt)): ?>
	<input type="hidden" name="fak" value="<?php echo $opt['fak']; ?>" />
	<input type="hidden" name="thn" value="<?php echo $opt['thn']; ?>" />
	<input type="hidden" name="soal" value="<?php echo $opt['soal']; ?>" />
	<input type='hidden' name='tampil' value='sekarang' />
	<input type='hidden' name='download' value='sekarang' />
<div id="mn-tombol" class="" style="margin-bottom: 10px;">
	<button id="terima_lulus" class="btn btn-inverse btn-small aksi"><i class="icon-white icon-ok"></i> Download</button>
</div>
</form>
<?php endif; ?>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="30px">No.</th>
      <th width="100px">NIM</th>
      <th>Nama</th>
	  <th>NILAI</th>
    </tr>
  </thead>
  <tbody>
  <?php
	
    if(!isset($get_mhs) or empty($get_mhs)):
      echo '<td colspan="5" align="center">Data mahasiswa baru tidak ditemukan.</td>';
    else:
  	 $i = 0;
		#echo "<pre>"; print_r($get_mhs); echo "</pre>";
     foreach ($get_mhs as $key => $value):
     $i++;
	 
  ?>
    <tr>
      <td align="center"><?php echo $i;?>.</td>
      <td align="center"><?php echo $value['NIM'];?></td>
      <td><?php echo $value['NAMA'];?></td>
      <td align="center"><?php echo round($value['NILAI_TES'],2);?></td>
    </tr>    
  <?php
     endforeach;
    endif;
  ?>
  </tbody>
</table>