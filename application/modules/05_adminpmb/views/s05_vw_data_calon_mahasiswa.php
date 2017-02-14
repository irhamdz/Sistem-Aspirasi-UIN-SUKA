<?php
#print_r($data_pendaftar_terverifikasi);
$crumbs = array(array('Beranda'=>base_url()),array('Data Calon Mahasiswa' => ''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
#echo $data_pendaftar[0]->PMB_NO_UJIAN_PENDAFTAR;
#print_r($data_pendaftar);
if($this->uri->segment(3) > 1){
	$no = $this->uri->segment(3)+1;
}else{
	$no=1;
}

?>
<div class="system-content-sia">
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='10%'>PIN</th>
					<th width='40%' align='left'>Nama Pendaftar</th>
					<th width='20%'>HP / Telpon</th>
				</tr>
				<thead>
				<tbody>
			<?php foreach($data_cmhs as $value){ ?>
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
<?php echo $links; ?>