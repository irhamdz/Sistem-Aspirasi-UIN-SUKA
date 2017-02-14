<h2>Agenda</h2>
<?php
$id=$this->session->userdata('data_agenda');
if($id['TGL_MULAI'] == $id['TGL_SELESAI']){
	$tanggal=$id['TGL_MULAI'];
}else{
	$tanggal=$id['TGL_MULAI']." sampai ".$id['TGL_SELESAI'];
}
?>
<div class="bs-callout bs-callout-warning">
	<p>Pada tanggal <?php echo $tanggal?> antara jam <?php echo $id['JAM_MULAI']?> sampai <?php echo $id['JAM_SELESAI']?>
		ruangan <?php echo $id['TEMPAT']?> sudah akan digunakan oleh:
	<p>
	<ol>
	<?php foreach($data_peminjam as $dp):?>
		<li><?php echo $dp['NAMA']?> pada tanggal <?php echo $dp['TGL_MULAI']?> sampai <?php echo $dp['TGL_SELESAI']?> untuk <?php echo $dp['KEPERLUAN']?></li>
	<?php endforeach?>
	</ol>
	<p>Apakah anda tetap akan memproses agenda ini?</p>
		
		
		
	<?php if(isset($id_agenda)){?>
		<a href="<?php echo site_url('admin/agenda/edit_proc/'.$id_agenda)?>" class="btn">Ya</a> <a href="<?php echo site_url('admin/agenda/add')?>" class="btn">Tidak</a>
	<?php }else{ ?>	
		<a href="<?php echo site_url('admin/agenda/add_proc')?>" class="btn btn-inverse btn-uin btn-small">Ya</a> <a href="<?php echo site_url('admin/agenda/add')?>" class="btn btn-inverse btn-uin btn-small">Tidak</a>
	<?php } ?>	
 </div>



