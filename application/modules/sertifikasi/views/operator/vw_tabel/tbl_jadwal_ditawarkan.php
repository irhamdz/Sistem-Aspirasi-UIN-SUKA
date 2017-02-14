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
 <?php if(!isset($get_jadwal) or empty($get_jadwal)):
      	echo '<td colspan="6" align="center">DATA JADWAL UNTUK PERIODE INI BELUM ADA.</td>';
      else:
      	$i = 0;
      foreach ($get_jadwal as $key => $value): 
		$i++;	?>
	<tr>
		<td align="center"><?php echo $i; ?>.</td>
		<td align="center"><?php echo $value['PER_NM'].", ".$value['PER_BULAN']; ?></td>
		<td align="center"><?php echo $value['NM_RUANG']; ?></td>
		<td align="center"><?php echo $value['SESI_MULAI']." - ".$value['SESI_SELESAI']. " WIB"; ?></td>
    <td align="center"><?php echo $value['TERISI']."/".$value['RU_KAP']; ?></td>
		<td align="center">
      <?php
      if($value['PENUH'] == '1' || $value['MOVEABLE'] == '0'):
        echo "-";
      else:
        echo '<button id="do_ambil" class="btn btn-small aksi" isi="'.$value['PREJ_KD'].'"><i class="icon-hand-up"></i> Ambil</button>';
      endif;
      ?>
    </td>
	</tr>
<?php endforeach;
	endif; ?>
      </tbody>
</table>

<script type="text/javascript">
$(function () {
  $(document).ajaxStart(function () {
        $("#tbl-rekap").html("<span style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img  src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
    });
  
  $(".aksi").click(function() {
    perr = $("#perr").val();
    id = $(this).attr('id');
    val = $(this).attr('isi');
  if(id == 'do_ambil')
  {
        $.ajax({
          type: 'post',
          dataType: 'json', 
          data: {op: id, kd: val},
        })
        .done(function(x) {
     $("#tbl-rekap").prepend(x.notif);
       setTimeout(function() {
        location.reload();
       }, 2000);
      
        });
  }
  });
});
</script> 