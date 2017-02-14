	<?php #sia_comment($data); ?>
	
	<table class="table table-nama" style="border: none; margin-bottom:2%;">
	<tbody>
	<tr><td class="table-nama-id">NIP</td>
	<td>: <?php echo sia_nip_staff_kd($data['log_portal']['data'][':nip'], $this->session->userdata('id_user')); ?></td></tr>
	
	<tr><td class="table-nama-id">Nama Dosen</td>
	<td>: <?php echo $data['log_portal']['data'][':nama']; ?></td></tr>
	
	<tr><td class="table-nama-id">Program Studi</td>
	<td>: <?php echo $data['log_portal']['data'][':nm_prodi']; ?></td></tr>
		
	<tr><td class="table-nama-id" style="width:175px;">Terakhir Login</td>
	<td>: 
	<?php echo date_trans_foracle($data['log_portal']['data'][':log_tgl'],1,'1 231 111',' '); ?> WIB | total login : <?php echo $data['log_portal']['data'][':log_count']; ?> kali
	</td></tr>
	
	</tbody>
	</table>