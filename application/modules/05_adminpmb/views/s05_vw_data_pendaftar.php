<?php
$crumbs = array(array('Beranda'=>base_url()),array('Data Pendaftar' => ''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
#echo $data_pendaftar[0]->PMB_NO_UJIAN_PENDAFTAR;
#print_r($data_pendaftar);
?>
<div class="system-content-sia">
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width=30px>NO</th>
					<th width='90px'>No PMB</th>
					<th width='90px'>PIN</th>
					<th align='left'>Nama Pendaftar</th>
					<th>Telp./HP</th>
				</tr>
				<thead>
				<tbody>
			<?php $no=1; foreach($data_pendaftar as $value){ ?>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td align='center'><?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?></td>
					<td align='center'><?php echo $value->PMB_PIN_PENDAFTAR; ?></td>
					<td><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
					<td align='center'><?php echo $value->PMB_TELP_PENDAFTAR; ?></td>
				</tr>
			<?php $no++; } ?>
			</tbody>
		</table>
</div>