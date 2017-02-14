<script type="text/javascript">
$(function () {
    $(".aksi").click(function() {
    perr = $("#perr").val();
    id = $(this).attr('id');
    val = $(this).attr('isi');
    if(id == 'hps')
    {
      var r = confirm("Apakah Anda yakin akan menghapus data jadwal?");
      if(r==false)
      {
        return false;
      }

      else{
        $.ajax({
          type: 'post',
          dataType: 'html',
          data: {op: id, kd: val},
        })
        .done(function(x) {
            $("#tbl-rekap").load('penjadwalan/'+perr);
        });  
      }
    }
  });
});

</script>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Jadwal</th>
      <th>Kapasitas</th>
      <th>Proses</th>
    </tr>
  </thead>
  
  <tbody>
 <?php if(!isset($get_jadwal) or empty($get_jadwal)):
      	echo '<td colspan="4" align="center">DATA JADWAL UNTUK PERIODE INI BELUM ADA.</td>';
      else:
      	$i = 0;
      foreach ($get_jadwal as $key => $value): 
		$i++;	?>
	<tr>
		<td align="center"><?php echo $i; ?>.</td>
    <td align="center"><?php echo $value['NM_RUANG']." (".$value['SESI_MULAI']." - ".$value['SESI_SELESAI'].")"; ?></td>
    <td align="center"><?php echo $value['TERISI']."/".$value['RU_KAP']; ?></td>
		<td align="center">
			<button id="hps" class="btn btn-inverse btn-small aksi" isi="<?php echo $value['PREJ_KD']; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
		</td>	
	</tr>
<?php endforeach;
	endif; ?>
      </tbody>
</table>