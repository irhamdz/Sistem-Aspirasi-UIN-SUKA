<script type="text/javascript">
$(function () {
    $(".aksi").click(function() {
    perr = $("#perr").val();
    id = $(this).attr('id');
    val = $(this).attr('isi');
    if(id == 'hps')
    {
      var r = confirm("Apakah Anda yakin akan menghapus data ruang?");
      if(r==false)
      {
        $("#tbl-rekap").load('ruang/'+perr);
      }

      else{
        $.ajax({
          type: 'post',
          dataType: 'html',
          data: {op: id, kd: val},
        })
        .done(function(x) {
            $("#tbl-rekap").load('ruang/'+perr);
        });  
      }
    }
    if(id == 'simpan'){

      $.ajax({type: 'post',dataType: 'html',data: {op: id, kd: val, val: $("#mn_kap").val()},})
      .done(function(x) {
          $("#tbl-rekap").load('ruang/'+perr);
        });
    }
    if(id == 'edit')
    {
      $("#tbl-rekap").load('ruang/'+perr+'/'+val);
    }
  });
});

</script>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Ruang</th>
      <th>Keterangan</th>
      <th>Kapasitas</th>
      <th>Proses</th>
    </tr>
  </thead>
  
  <tbody>
 <?php if(!isset($get_ruang) or empty($get_ruang)):
      	echo '<td colspan="6" align="center">Data ruang untuk periode ini belum ada.</td>';
      else:
      	$i = 0;
      foreach ($get_ruang as $key => $value): 
		$i++;	?>
	<tr>
		<td align="center"><?php echo $i; ?>.</td>
		<td align="center"><?php echo $value['KD_RUANG']; ?></td>
		<td><?php echo $value['RU_KET']; ?></td>

		<?php if(isset($kd_ru) && ($value['RU_KD']) == $kd_ru): ?>
            <td class="col-md-3" align="center">
              <input name="mn_kap" id="mn_kap" class="form-control" type="text" style="margin-bottom:0px; text-align:center;" value="<?php echo $value['RU_KAP']; ?>">
              <td class="col-md-3"><button id="simpan" class="btn btn-inverse btn-small aksi" isi="<?php echo $value['RU_KD']; ?>"><i class="icon-hdd icon-white"></i> Simpan</button></td>
            </td>
          <?php else: ?>
      		  <td align="center"><?php echo $value['RU_KAP']; ?></td>
            <td class="input-medium">
              <button id="edit" class="btn btn-inverse btn-small aksi" isi="<?php echo $value['RU_KD']; ?>"><i class="icon-edit icon-white"></i> Edit</button>
              <button id="hps" class="btn btn-inverse btn-small aksi" isi="<?php echo $value['RU_KD']; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
      		  </td>
          <?php endif;?>		
	</tr>
<?php endforeach;
	endif; ?>
      </tbody>
</table>