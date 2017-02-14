
<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'admluarnegeri-list_pendaftar_detail',
        type: 'POST',
        data: formData,
        //async: false,
        cache: false,
        contentType: false,
        processData: false,
		dataType : 'html',
		beforeSend: function(){
				$("#notif-dua").html(	'<div id="separate"></div>'+
										'<center><img src="<?php echo base_url(); ?>asset/img/loading.gif"></center>'+
										'<div id="separate"></div>'+
										'<center><font size="2px">Harap menunggu</font></center>');
		},
		success: function(x){
			$("#notif-dua").html(x);
			$('html, body').animate({ scrollTop: 0 }, 200);
		}
    });
    /* .done(function(x) {
        //var data = $.parseJSON(x);
        //console.log(data);
		
        $("#notif-upsbp").html(x);
		$('html, body').animate({ scrollTop: 0 }, 200);
    }); */
 
    return false;
        });
});
</script>
<div id='notif-dua'></div>
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='10%'>NO. REG</th>
					<th width='20%' align='left'>NAMA PESERTA</th>
					<th width='10%'><center>BUKTI PEMBAYARAN</center></th>
					<th width='10%' colspan=3><center>AKSI</center></th>
				</tr>
				<thead>
				<tbody>
			<?php
			if(!isset($pendaftar) or empty($pendaftar)){
				?>
					<tr>
						<td align='center' colspan=8>Data Pendaftar Kosong</td>
					</tr>
				<?php
			}else{
			$no=1;
			foreach($pendaftar as $value){ 
				?>
					<tr>
						<td align='center'><?php echo $no; ?></td>
						<td><?php if($value->PMB_STATUS_SIMPAN_PENDAFTAR==2){ ?>
								<?php if($value->PMB_NO_UJIAN_PENDAFTAR==''){ ?>
									Data Belum Dikonfirmasi
								<?php }else{ ?>
									<?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?>
								<?php } ?>
							<?php }else{ ?>
									Data Belum Lengkap
							<?php } ?></td>
						<td><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
						<td align='center'>
							<?php if($value->PMB_STATUS_SIMPAN_PENDAFTAR==2){ ?>
								<a href="<?php echo base_url("payment")."/2015/".$value->PMB_PIN_PENDAFTAR."-PAYMENT-.jpg"; ?>">Lihat</a>
							<?php }else{ ?>
								Data Belum Lengkap
							<?php } ?>
						</td>
						<td align='center'>
						<?php if($value->PMB_STATUS_SIMPAN_PENDAFTAR==2){ 
								if($value->PMB_NO_UJIAN_PENDAFTAR==''){ ?>
						<form method="POST" id='fup_bp'><input type="hidden" name="nama" value="<?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR;?>" /><input type="hidden" name="email" value="<?php echo $value->PMB_EMAIL_PENDAFTAR;?>" /><input type="hidden" name="PMB_PIN_PENDAFTAR" value="<?php echo $value->PMB_PIN_PENDAFTAR;?>" /><input type="submit" class="btn btn-small btn-inverse btn-uin-right" value="Konfirmasi" name="ACT" /></form> 
						<?php }else{
								echo "Sudah Dikonfirmasi";
							}
						}elseif($value->PMB_STATUS_SIMPAN_PENDAFTAR==3){ 
							echo "<font color='red'>Pendaftaran Gagal</font>";
						
						}else{?>
						Data Belum Lengkap
						<?php } ?>
						</td>
						<td align='center'>
						<?php if($value->PMB_STATUS_SIMPAN_PENDAFTAR==2 || $value->PMB_STATUS_SIMPAN_PENDAFTAR==1){ ?>
						<?php 	if($value->PMB_NO_UJIAN_PENDAFTAR==''){ ?>
									<form method="POST" id='fup_bp'><input type="hidden" name="nama" value="<?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR;?>" /><input type="hidden" name="email" value="<?php echo $value->PMB_EMAIL_PENDAFTAR;?>" /><input type="hidden" name="PMB_PIN_PENDAFTAR" value="<?php echo $value->PMB_PIN_PENDAFTAR;?>" /><input type="submit" class="btn btn-small btn-inverse btn-uin-right" value="Konfirmasi Gagal" name="ACT" /></form> 
						<?php 	}else{
									echo "Sudah Dikonfirmasi";
								}?>
						<?php }elseif($value->PMB_STATUS_SIMPAN_PENDAFTAR==3){ 
								echo "<font color='red'>Pendaftaran Gagal</font>";
							}else{
								echo "Sudah Dikonfirmasi";
							}
							?>
						</td>
						<td align='center'>
						<?php if($value->PMB_STATUS_SIMPAN_PENDAFTAR==2){ ?>
						<form method="POST" id='fup_bp'><input type="hidden" name="email" value="<?php echo $value->PMB_EMAIL_PENDAFTAR;?>" /><input type="hidden" name="PMB_PIN_PENDAFTAR" value="<?php echo $value->PMB_PIN_PENDAFTAR;?>" /><input type="submit" class="btn btn-small btn-inverse btn-uin-right" value="Detail" name="ACT" /></form>
							<?php }elseif($value->PMB_STATUS_SIMPAN_PENDAFTAR==3){ 
							echo "<font color='red'>Pendaftaran Gagal</font>";
							
							}else{ ?>
								Data Belum Lengkap
							<?php } ?>
						</td>
						
					</tr>
				<?php $no++; 
				} 			
			}?>
			</tbody>
		</table>