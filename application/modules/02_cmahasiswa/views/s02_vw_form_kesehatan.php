<?php
// $crumb="Riwayat Kesehatan";
// $crumbs = array(array('Beranda'=>base_url()),array($crumb=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
#echo "<div id='notif-upsbp'></div>";
$id_user=$this->session->userdata('id_user');
$jenis=$this->session->userdata('jenis_penerimaan');
$url_base=base_url().$this->session->userdata('status');
?>
<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'data-actionform_kesehatan',
        type: 'POST',
        data: formData,
        //async: false,
        cache: false,
        contentType: false,
        processData: false,
		//dataType : 'html',
		dataType : 'json',
		// beforeSend: function(){
				// $("#notif-upsbp").html(	'<div id="separate"></div>'+
										// '<center><img src="<?php echo base_url(); ?>asset/img/loading.gif"></center>'+
										// '<div id="separate"></div>'+
										// '<center><font size="2px">Harap menunggu</font></center>');
		// },
		success: function(x){
			//var data = $.parseJSON(x);
			// console.log(x);
			$("#notif-upsbp").html(x.pesan);
			$('html, body').animate({ scrollTop: 0 }, 200);
			if(x.hasil == 'sukses'){
			window.setTimeout( function(){
				window.location = '<?php echo "$url_base/data-pendidikan_sebelumnya"; ?>';
			}, 1000);
			}
		}
    });
    return false;
        });
});

function pilih_radio_100(){
	x=document.getElementById('radiolain');
	x.checked='1';
}
function open_box_difabel(){
	$('.difabel_box').hide().slideDown('slow');
}
function close_box_difabel(){
	$('.difabel_box').slideUp('slow');
}
function checkbox_aksi(){
	x=document.getElementById('lainnyacek');
	y=document.getElementById('KETERANGAN_DIFABEL');
	if(x.checked){
		y.style.display='inline';
	}else{
		y.style.display='none';
	}
}
function pilih_buta_warna_total(){
	x=document.getElementById('buta_warna_parsial');
	y=document.getElementById('buta_warna_total');
	if(y.checked){
		x.checked='1';
	}
}
</script>
<div id='notif-upsbp'></div>
<div class="system-content-sia">
<form method='POST' id='fup_bp' >
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			<td colspan=3>
				<b style="padding-bottom:10px">Riwayat Penyakit yang pernah dialami:</b><br />
				<textarea class="form-control" style="width:500px;height:100px" name="TOP_RIWAYAT_KESEHATAN"></textarea>
				<br>
				<b>Kemampuan Fisik:</b><br>
					<div class='radio'><label><input type="radio" checked name="GLOBAL_MASTER_DIFABEL" value="NORMAL" onclick="close_box_difabel()"> Memililki Kemampuan Normal (sehat)</label></div>
					<div class='radio'><label><input id="radiolain" type="radio" name="GLOBAL_MASTER_DIFABEL" value="BERBEDA" onclick="open_box_difabel()"> Memiliki Kemampuan Berbeda (<i>Different Ability</i>)</label></div>
					<div class="col-xs-7">
					<div class="difabel_box" onclick="pilih_radio_100()" style="display: block;">
						
							<div class='checkbox'><label><input type="checkbox" name="KD_DIFABEL[]" value="3">TUNA NETRA</label></div>
							<div class='checkbox'><label><input type="checkbox" name="KD_DIFABEL[]" value="4">TUNA RUNGU</label></div>
							<div class='checkbox'><label><input type="checkbox" name="KD_DIFABEL[]" value="5">TUNA WICARA</label></div>
							<div class='checkbox'><label><input id='benrakosong' type="checkbox" name="KD_DIFABEL[]" value="2">TUNA DAKSA</label></div>
							<div class='checkbox'><label><input type="checkbox" name="KD_DIFABEL[]" value="8">TUNA GRAHITA</label></div>
							<div class='checkbox'><label><input id="buta_warna_parsial" type="checkbox" name="KD_DIFABEL[]" value="6">BUTA WARNA PARSIAL</label></div>
							<div class='checkbox'><label><input id="buta_warna_total" onclick="pilih_buta_warna_total()" type="checkbox" name="KD_DIFABEL[]" value="7">BUTA WARNA TOTAL</label></div>
							<li><input type="checkbox" name="KD_DIFABEL[]" id="lainnyacek" ;="" onclick="checkbox_aksi()" value="99">LAINNYA&nbsp;<input type="text" style="display:none" id="KETERANGAN_DIFABEL" name="KETERANGAN_DIFABEL" value=""></li>
						
					</div></div>
					<?php /*
						<input type='hidden' name='TAHUN_DAFTAR' value='<?php echo $pendaftar[0]->PMB_TAHUN_PENDAFTARAN; ?>'/>
						<input type='hidden' name='GELOMBANG' value='<?php echo $pendaftar[0]->PMB_GELOMBANG_PENDAFTAR; ?>'/>
						*/ ?>
			</td>
		</tr>
		<tr>
			<td align='left' width='150'><input type="hidden" name="step" value="insert_kesehatan"><a href='data-pendaftar' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td>&nbsp;</td>
			<td align='right'><?php echo form_submit('pmb1_data_kesehatan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
	</tbody>
</table>
</form>
</div>