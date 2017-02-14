<table id="cetak-format">
<thead>
<tr>
<th>NO</th><th>KODE</th><th>RUANG</th><th>JUMLAH_KURSI</th><th>NOMOR_AWAL</th><th>NOMOR_AKHIR</th><th>JENIS</th>
</tr>
</thead>
<tbody>
	<?php
	$num=0;
	if(!is_null($format)){
		for ($i=0; $i < count($format->ruang); $i++) { ?>
		<tr>
		<td><?php echo $num+=1;?></td>
		<td><?php echo $format->ruang[$i].'/'.$format->kode_format;?></td>
		<td><?php echo $format->nama_ruang[$i]; ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
	<?php } } ?>
</tbody>
</table>