<?php
$crumbs = array(array('Beranda'=>base_url()),array('Data Calon Istri' => ''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
$no=1;
?>
<div class="system-content-sia">
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='10%'>PIN</th>
					<th width='40%' align='left'>Nama Kandidat</th>
					<th width='20%'>HP / Telpon</th>
				</tr>
				<thead>
				<tbody>
			<?php foreach($daftar_calon_istri as $value){ ?>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td align='center'><?php echo anchor('adminpmb/laporan-detail_calon_mahasiswa/'.$value->PMB_PIN_PENDAFTAR.'', ''.$value->PMB_PIN_PENDAFTAR.'', 'class=link-table title=""'); ?></td>
					<td><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
					<td align='center'><?php echo $value->PMB_TELP_PENDAFTAR; ?></td>
				</tr>
			<?php $no++; } ?>
			</tbody>
		</table>
</div>