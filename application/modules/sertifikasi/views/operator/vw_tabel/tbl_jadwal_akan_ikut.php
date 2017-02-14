<script type="text/javascript">
$(function () {
    $(".aksi").click(function() {
    perr = $("#perr").val();
    id = $(this).attr('id');
    val = $(this).attr('isi');
	if(id == 'hps')
	{
		var r = confirm("Apakah Anda yakin akan membatalkan jadwal ICT?");
		if(r==false){
			return false;
		}

		else{
			$.ajax({type: 'post',dataType: 'html',data: {op: id, kd: val},})
			.done(function(x) {
				$("#notif-del").prepend(x);
				   setTimeout(function() {
						location.reload();
				   }, 2000);
			});  
		}
	}
  });
});

</script>
<div id="notif-del"></div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Periode</th>
      <th>Ruang</th>
      <th>Jam</th>
      <th>Kapasitas</th>
      <th>Proses</th>
    </tr>
  </thead>
  
  <tbody>
 <?php if(!isset($get_jadwal_ikut) or empty($get_jadwal_ikut)):
      	echo '<td colspan="6" align="center">DATA JADWAL UNTUK PERIODE INI BELUM ADA.</td>';
      else:
      	$i = 0;
      foreach ($get_jadwal_ikut as $key => $value): 
		$i++;
		?>
	<tr>
		<td align="center"><?php echo $i; ?>.</td>
		<td align="center"><?php echo str_replace('Hari','',$value['PER_NM']).', '.$value['PER_BULAN']; ?></td>
		<td align="center"><?php echo $value['NM_RUANG']; ?></td>
		<td align="center"><?php echo $value['SESI_MULAI']." - ".$value['SESI_SELESAI']; ?></td>
		<td align="center"><?php echo $value['TERISI']."/".$value['RU_KAP']; ?></td>
		<td align="center">
<?php
	$button = ($value['HAPUS'] == '1')? '<button id="hps" class="btn btn-small aksi" isi="'.$value['PREJ_KD'].'"><i class="icon-trash"></i> Hapus</button>' : '-';
	echo $button;
?>
	</td>
	</tr>
<?php endforeach;
	endif; ?>
      </tbody>
</table>