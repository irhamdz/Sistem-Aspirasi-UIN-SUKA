<h2>Jadwal ICT yang Ditawarkan</h2>
<?php
	$crumbs = array(
				array('Training & Sertifikasi' => 'training/admin'),
				array('ICT' => '#'),
				array('Jadwal ICT' =>'toec/sertifikasi/jadwalditawarkan'),
			);
	$this->it00_lib_output->output_crumbs($crumbs);
?>
<div id="notif" class="bs-callout bs-callout-info">
	Berikut adalah daftar jadwal ICT yang ditawarkan.
</div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Periode</th>
      <th>Ruang</th>
      <th>Jam</th>
      <th>Kapasitas</th>
    </tr>
  </thead>
  
  <tbody>
 <?php if(!isset($get_jadwal) or empty($get_jadwal)):
      	echo '<td colspan="5" align="center">Data jadwal untuk periode ini belum ada.</td>';
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
	</tr>
<?php endforeach;
	endif; ?>
      </tbody>
</table>
