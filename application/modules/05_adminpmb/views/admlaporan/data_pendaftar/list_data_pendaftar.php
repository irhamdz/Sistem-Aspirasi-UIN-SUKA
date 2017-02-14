 <?php /* #print_r($daftar_peserta_belum_selesai); die();
if($this->uri->segment(3) > 1){
	$no = $this->uri->segment(3)+1;
}else{
	$no=1;
}
*/
?> 
<script type="text/javascript">
	$(function  () {
		
		$(".pajax").click(function() {
			hal = $(this).attr('id');
			gel = $("#GELOMBANG").val();
			thn = $("#TAHUN").val();
			status = $("#WARGANEGARA").val();
			//alert(gel);
			$.ajax({
			type: 'post',
			dataType: 'html',
			data: {tampil: 'sekarang', GELOMBANG : gel, TAHUN : thn, WARGANEGARA : status  ,page: hal},
			})
			.done(function(x) {
				$("#notif-upsbp").html(x);
			});	
		});
	})
</script>
<?php
#echo $pendaftar[0]->PMB_KD_JENIS_PENDAFTAR; die();
if(!isset($pendaftar) or empty($pendaftar)){

}else{
if($pendaftar[0]->PMB_KD_JENIS_PENDAFTAR==4 || $pendaftar[0]->PMB_KD_JENIS_PENDAFTAR==5 || $pendaftar[0]->PMB_KD_JENIS_PENDAFTAR==8){ 
echo "<a class='btn' href='".base_url()."adminpmb/admlaporan-download_xls/".$pendaftar[0]->PMB_TAHUN_PENDAFTARAN."/".$pendaftar[0]->PMB_GELOMBANG_PENDAFTAR."/".$warganegara."'>UNDUH DATA(.xls)</a><br /><br />";
}
}
?>
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='5%'>PIN</th>
					<th width='40%' align='left'>Nama Peserta</th>
					<th width='20%'>HP / Telpon</th>
					<?php 
					if(!isset($pendaftar) or empty($pendaftar)){

					}else{
					if($pendaftar[0]->PMB_KD_JENIS_PENDAFTAR==4 || $pendaftar[0]->PMB_KD_JENIS_PENDAFTAR==5 || $pendaftar[0]->PMB_KD_JENIS_PENDAFTAR==8){ ?>
						<th width='20%'>Download</th>
					<?php } } ?>
					
					
				</tr>
				<thead>
				<tbody>
			<?php
			if(!isset($pendaftar) or empty($pendaftar)){
				?>
					<tr>
						<td align='center' colspan=4>Data Pendaftar Kosong</td>
					</tr>
				<?php
			}else{
			$no=$nourut+1;
			foreach($pendaftar as $value){ 
				?>
					<tr>
						<td align='center'><?php echo $no; ?></td>
						<td align='center'><?php echo $value->PMB_PIN_PENDAFTAR; ?></td>
						<td><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
						<td align='center'><?php echo $value->PMB_TELP_PENDAFTAR; ?></td>
		
						<?php 
						if(!isset($pendaftar) or empty($pendaftar)){

						}else{
						if($value->PMB_KD_JENIS_PENDAFTAR==4 || $value->PMB_KD_JENIS_PENDAFTAR==5 || $value->PMB_KD_JENIS_PENDAFTAR==8){ ?>
						<td align='center'><a class='link-table' href='<?php echo base_url(); ?>disertasi/<?php echo $value->PMB_KD_JENIS_PENDAFTAR."/".$value->PMB_PIN_PENDAFTAR."-disertasi-".$value->PMB_KD_JENIS_PENDAFTAR.".pdf"; ?>'>Proposal</a></td>
						<?php }
						}	?>
					</tr>
				<?php $no++; 
				} 			
			}?>
			</tbody>
		</table>

<?php #echo $links; ?>

<div id="link-pagination"><?php 
echo $link;	
 ?></div>