<?php
$crumbs = array(array('Beranda'=>base_url()),array('Data Pendaftar Luar Negeri' => ''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
$no=1;
?>
<div class="system-content-sia">
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='10%'>NO PMB</th>
					<th width='40%' align='left'>Nama Pendaftar</th>
					<th width='20%'>ASAL</th>
					<th width='20%'>HP / Telpon</th>
				</tr>
				<thead>
				<tbody>
			<?php foreach($data_ln as $value){ ?>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td align='center'><?php echo anchor('adminpmb/laporan-detail_calon_mahasiswa_s1d3/'.$value->PMB_PIN_PENDAFTAR.'', ''.$value->PMB_NO_UJIAN_PENDAFTAR.'', 'class=link-table title=""'); ?></td>
					<td><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
					<td><?php echo $value->PMB_TEMPAT_LAHIR_PENDAFTAR; ?></td>
					<td align='center'><?php echo $value->PMB_TELP_PENDAFTAR; ?></td>
				</tr>
			<?php $no++; } ?>
			</tbody>
		</table>
</div>