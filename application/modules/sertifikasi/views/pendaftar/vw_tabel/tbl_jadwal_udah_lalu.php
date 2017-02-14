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
		$i++;
		?>
	<tr>
		<td align="center"><?php echo $i; ?>.</td>
		<td align="center"><?php echo str_replace('Hari','',$value['PER_NM']).', '.$value['PER_BULAN']; ?></td>
		<td align="center"><?php echo $value['NM_RUANG']; ?></td>
		<td align="center"><?php echo $value['SESI_MULAI']." - ".$value['SESI_SELESAI']; ?></td>
		<td align="center"><?php echo $value['TERISI']."/".$value['RU_KAP']; ?></td>
		<td align="center"> - </td>
	</tr>
<?php endforeach;
	endif; ?>
      </tbody>
</table>