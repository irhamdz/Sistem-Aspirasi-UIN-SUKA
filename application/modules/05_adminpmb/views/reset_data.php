<?php
$crumbs = array(array('Beranda'=>base_url()),array('FORM >  Reset Data'=>''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
$url_base=base_url()."adminpmb"; 
?>
<div class="system-content-sia">
<table class="table table-bordered table-hover">
	<tbody>
		<tr>
			<th width=30>No</th>
			<th width=200 align=left>PIN</th>
			<th width=100>Nama Pendafatar</th>
			<th width=50>Status Kesehatan</th>
			<th width=100>Proses</th>
		</tr>
		
			<?php foreach($cek as $value){
					echo "<tr><td align=center>".$value->NO_."</td>";
					echo "<td>".$value->PMB_PIN_PENDAFTAR."</td>";
					echo "<td align=center>".$value->PMB_NAMA_LENGKAP_PENDAFTAR."</td>";
					echo "<td align=center>".$value->PMB_ID_JENIS_KESEHATAN."</td>";
					echo "<td align=center><a href='$url_base/tools-reset_data_peserta/pin/".$value->PMB_PIN_PENDAFTAR."' class='btn'><i class='icon-trash'></i> Hapus</a></td></tr>";
			} ?>
		
	</tbody>
</table>
	<?php #print_r($cek); ?>
</div>