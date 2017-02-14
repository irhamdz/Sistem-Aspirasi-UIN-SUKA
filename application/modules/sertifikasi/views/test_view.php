<table class="table table-bordered">

<?php
echo $passing;
	$i=0;
	foreach($dt_jadwal as $key => $value):
	$i++; ?>
<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $value['PREJ_KD']; ?></td>
	<td><?php echo $value['PER_BULAN']; ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php $this->load->view('pendaftaran/test_view2'); ?>