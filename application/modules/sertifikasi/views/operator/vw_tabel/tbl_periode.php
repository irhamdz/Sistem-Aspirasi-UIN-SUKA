<script type="text/javascript">
$(function () {
    $(".aksi").click(function() {
    berr = $("#berr").val();
    id = $(this).attr('id');
    val = $(this).attr('isi');
    bln = berr.split("#");
    if(id == 'hps')
    {
      var r = confirm("Apakah Anda yakin akan menghapus data periode?");
      if(r==false)
      {
        $("#tbl-rekap").load('periode/'+berr);
      }

      else{
        $.ajax({
          type: 'post',
          dataType: 'html',
          data: {op: id, kd: val},
        })
        .done(function(x) {
            $("#tbl-rekap").load('periode/'+berr);
        });  
      }
    }
    if(id == 'simpan'){

      $.ajax({type: 'post',dataType: 'html',data: {op: id, kd: val, val: $("#mn_tawar").val()},})
      .done(function(x) {
          $("#tbl-rekap").load('periode/'+berr);
        });
    }
    if(id == 'edit')
    {
      $("#tbl-rekap").load('periode/'+berr+'/'+val);
    }
  });
});

</script>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Hari</th>
      <th>Tanggal</th>
      <th>Penawaran</th>
      <th>Proses</th>
    </tr>
  </thead>
  <tbody>
      <?php if(!isset($get_periode) or empty($get_periode)):
      	echo '<td colspan="6" align="center">Data periode bulan ini belum ada.</td>';
      else:
      	$i = 0;
      foreach ($get_periode as $key => $value): 
		$i++;
		$tawar = $value['NM_TAWAR'];
    $aaa = ($value['PER_TAWAR'] == '0')? 'selected' : '';
      	?>
      	<tr>
      		<td align="center"><?php echo $i;?>.</td>
      		<td><?php echo $value['PER_NM']; ?></td>
      		<td><?php echo $value['PER_BULAN']; ?></td>
          <?php if(isset($kd_per) && ($value['PER_KD']) == $kd_per): ?>
            <td class="input-medium" align="center">
              <select name="mn_tawar" id="mn_tawar" class="form-control input-md" style="margin-bottom:0px;"><option value="1">Ditawarkan</option><option value="0" <?php echo $aaa; ?> >Tidak Ditawarkan</option></select>
              <td class="input-md"><button id="simpan" class="btn btn-inverse btn-small aksi" isi="<?php echo $value['PER_KD']; ?>"><i class="icon-trash icon-white"></i> Simpan</button></td>
            </td>
          <?php else: ?>
      		  <td ><?php echo $tawar; ?></td>
            <td class="input-medium">
      		  <button id="edit" class="btn btn-inverse btn-small aksi" isi="<?php echo $value['PER_KD']; ?>"><i class="icon-edit icon-white"></i> Edit</button>
            <button id="hps" class="btn btn-inverse btn-small aksi" isi="<?php echo $value['PER_KD']; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
            </td>
          <?php endif;?>
      	</tr>
      <?php endforeach; ?>
      <?php endif; ?>
  </tbody>
</table>