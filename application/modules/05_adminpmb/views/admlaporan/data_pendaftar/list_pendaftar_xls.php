<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='5%'>NOMOR PMB</th>
					<th width='40%' align='left'>Nama Peserta</th>
					<th width='20%'>HP / Telpon</th>
					<th width='20%'>JUDUL</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				$no=1;
				foreach($download as $value){ 
				?>
					<tr>
						<td align='center'><?php echo $no; ?></td>
						<td align='center'><?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?></td>
						<td><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
						<td align='center'><?php echo $value->PMB_TELP_PENDAFTAR; ?></td>
						<td><?php echo $value->PMB_JUDUL_DISERTASI; ?></td>
					</tr>
				<?php $no++; 
				} 			
				?>
				</tbody>
				
</table>