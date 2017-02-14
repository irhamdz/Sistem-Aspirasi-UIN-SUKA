<?php
$crumbs = array(array('Beranda'=>base_url()),array('FORM >  Cek Data'=>''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
?>
<div class="system-content-sia">
<form action='tools-cekdata' method='POST'>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan='3'><br /><strong>Cek Data</strong><br /></td>
		</tr>
		<tr>
			<td>PIN PENDAFTAR</td>
			<td>:</td>
			<td><input type="text"  class="required" name="pin" /> *)</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><input type="radio" name="jc" value='diri' /> Data Diri <br /><input type="radio" name="jc" value='kes' /> Kesehatan</td>
		</tr>
		<tr>
			<td align='left'></td>
			<td></td>
			<td><?php echo form_submit('cek', 'CEK DATA', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
	</tbody>
	</table>
	<?php print_r($cek); ?>
</div>


