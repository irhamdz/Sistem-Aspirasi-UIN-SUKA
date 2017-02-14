<h2>Data Pendaftar</h2>
<?php
// $crumbs = array(array('Beranda'=>base_url()),array('Statistik Pendaftar Detail' => '#'));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
// #echo $tahun_awal;
?>
<div class="system-content-sia">
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='5%'>PIN</th>
					<th width='40%' align='left'>Nama Peserta</th>
					<th width='20%'>HP / Telpon</th>
				</tr>
				<thead>
				<tbody>
			<?php
			$no=1;
			if(isset($SIAPA)){
			foreach($SIAPA as $value){ 
				?>
					<tr>
						<td align='center'><?php echo $no; ?></td>
						<td align='center'><?php echo $value->PMB_PIN_PENDAFTAR; ?></td>
						<td><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
						<td align='center'><?php echo $value->PMB_TELP_PENDAFTAR; ?></td>
					</tr>
				<?php $no++; 
				} 			
			}
			?>
			</tbody>
		</table>