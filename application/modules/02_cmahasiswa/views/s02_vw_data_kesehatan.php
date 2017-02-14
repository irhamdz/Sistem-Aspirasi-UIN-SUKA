<?php
// $crumb="Riwayat Kesehatan";
// $crumbs = array(array('Beranda'=>base_url()),array($crumb=>''));
// $this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
echo "<div id='notif-upsbp'></div>";
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
				<b style="padding-bottom:10px">Riwayat Penyakit yang pernah dialami:</b><BR />
				<textarea class="form-control" style="width:500px;height:100px" name="TOP_RIWAYAT_KESEHATAN"><?php echo $kesehatan[0]->PMB_RIWAYAT_PENYAKIT  ?></textarea>
				<br />
				<?php 
				$sakit_saya=explode(" ",$kesehatan[0]->PMB_ID_JENIS_KESEHATAN);
				for($a=0; $a<count($sakit_saya); $a++){ 
					if($sakit_saya[$a]==1){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="1"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Normal<br />';
					}elseif($sakit_saya[$a]==2){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="2"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Daksa<br />';
					}elseif($sakit_saya[$a]==3){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="3"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Netra<br />';
					}elseif($sakit_saya[$a]==4){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="4"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Rungu<br />';
					}elseif($sakit_saya[$a]==5){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="5"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Wicara<br />';
					}elseif($sakit_saya[$a]==6){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="6"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Buta Warna Parsial<br />';
					}elseif($sakit_saya[$a]==7){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="7"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Buta Warna Total<br />';
					}elseif($sakit_saya[$a]==8){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="7"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span> Tuna Grahita<br />';
					}elseif($sakit_saya[$a]==99){
						echo '<input type="hidden" name="pmb1_kesehatan[]" value="7"  checked>
						<span style="font-family: Arial Unicode MS, Lucida Grande">&#10004;</span>'.$kesehatan[0]->LAINNYA.'<br />';
					}
				}	
?>	
<br />Beri Tanda Centang untuk merubah Status Difabel :<hr />
				<b>Kemampuan Fisik:</b><br>
					<div class='radio'><label><input type="radio" name="GLOBAL_MASTER_DIFABEL" value="NORMAL" onclick="close_box_difabel()"> Memililki Kemampuan Normal (sehat)</label></div>
					<div class='radio'><label><input id="radiolain" type="radio" name="GLOBAL_MASTER_DIFABEL" value="BERBEDA" onclick="open_box_difabel()"> Memiliki Kemampuan Berbeda (<i>Different Ability</i>)</label></div>
					<div class="col-xs-7"><div class="difabel_box" onclick="pilih_radio_100()" style="display: block;">
						<?php 
								echo "<div class='checkbox'><label><input type='checkbox' name='KD_DIFABEL[]' value='3' >TUNA NETRA</label></div>"; 
								echo "<div class='checkbox'><label><input type='checkbox' name='KD_DIFABEL[]' value='4' >TUNA RUNGU</label></div>"; 
								echo "<div class='checkbox'><label><input type='checkbox' name='KD_DIFABEL[]' value='5' >TUNA WICARA</label></div>"; 
								echo "<div class='checkbox'><label><input type='checkbox' name='KD_DIFABEL[]' value='2' >TUNA DAKSA</label></div>"; 
								echo "<div class='checkbox'><label><input type='checkbox' name='KD_DIFABEL[]' value='8' >TUNA GRAHITA</label></div>"; 
								echo "<div class='checkbox'><label><input id='buta_warna_parsial' type='checkbox' name='KD_DIFABEL[]'  type='checkbox' name='KD_DIFABEL[]' value='6' >BUTA WARNA PARSIAL</label></div>"; 
								echo "<div class='checkbox'><label><input id='buta_warna_total' onclick='pilih_buta_warna_total()' type='checkbox' name='KD_DIFABEL[]' value='7' >BUTA WARNA TOTAL</label></div>"; 
								echo "<div class='checkbox'><label><input type='checkbox' name='KD_DIFABEL[]' id='lainnyacek' onclick='checkbox_aksi()' value='99' >
										LAINNYA&nbsp;<input class='form-control' type='text' style='display: none;' id='KETERANGAN_DIFABEL' name='lainnya' value=''>";
										
						
						
							
							
							
							
						
						 ?>
							<?php /*
							<li><input type="checkbox" name="KD_DIFABEL[]" value="2">TUNA DAKSA</li>
							<li><input type="checkbox" name="KD_DIFABEL[]" value="3">TUNA NETRA</li>
							<li><input type="checkbox" name="KD_DIFABEL[]" value="4">TUNA RUNGU</li>
							<li><input type="checkbox" name="KD_DIFABEL[]" value="5">TUNA WICARA</li>
							<li><input type="checkbox" name="KD_DIFABEL[]" value="8">TUNA GRAHITA</li>
							<li><input id="buta_warna_parsial" type="checkbox" name="KD_DIFABEL[]" value="6">BUTA WARNA PARSIAL</li>
							<li><input id="buta_warna_total" onclick="pilih_buta_warna_total()" type="checkbox" name="KD_DIFABEL[]" value="7">BUTA WARNA TOTAL</li>
							<li><input type="checkbox" name="KD_DIFABEL[]" id="lainnyacek" ;="" onclick="checkbox_aksi()" value="99">LAINNYA&nbsp;<input type="text" style="display:none" id="KETERANGAN_DIFABEL" name="KETERANGAN_DIFABEL" value=""></li> */ ?>
						
					
					<?php /*
						<input type='hidden' name='TAHUN_DAFTAR' value='<?php echo $pendaftar[0]->PMB_TAHUN_PENDAFTARAN; ?>'/>
						<input type='hidden' name='GELOMBANG' value='<?php echo $pendaftar[0]->PMB_GELOMBANG_PENDAFTAR; ?>'/>
						*/ ?></div></div>
			</td>
		</tr>
		<tr>
			<td align='left' width='150'><input type="hidden" name="step" value="update_kesehatan"><a href='data-pendaftar' class="btn btn-small btn-inverse btn-uin-right"><< Sebelumnya</button></a></td>
			<td>&nbsp;</td>
			<td align='right'><?php echo form_submit('pmb1_data_kesehatan', 'Selanjutnya >>', 'class="btn-uin btn btn-inverse btn btn-small"'); ?></td>
		</tr>
	</tbody>
</table>
</form>
</div>