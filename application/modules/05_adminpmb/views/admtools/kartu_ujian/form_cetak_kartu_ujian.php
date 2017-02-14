<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'admtools-kartu_ujian/lihat',
        type: 'POST',
        data: formData,
        //async: false,
        cache: false,
        contentType: false,
        processData: false,
		dataType : 'html',
		beforeSend: function(){
				$("#notif-upsbp").html(	'<div id="separate"></div>'+
										'<center><img src="<?php echo base_url(); ?>asset/img/loading.gif"></center>'+
										'<div id="separate"></div>'+
										'<center><font size="2px">Harap menunggu</font></center>');
		},
		success: function(x){
			$("#notif-upsbp").html(x);
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
<h2>Kartu Ujian</h2>
<?php
/* $crumbs = array(array('Beranda'=>base_url()),array('Kartu Ujian' => 'adminpmb/admtools-kartu_ujian'));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>"; */
?>
<div class="system-content-sia">
<form action='admtools-kartu_ujian/lihat' method='POST' id='fup_bp' >
<table class="table table-hover">
	<tbody>
		<tr>
			<td><label style="margin-top:5px;">Kata Kunci</label></td>
			<td><div class="col-xs-8"><input type='text' name='kunci' style="margin-bottom:0;" class="form-control input-sm" /><input type='hidden' name='lihat' value='sekarang' /></td>
		</tr>
		<tr>
			<td><label style="margin-top:5px;">Berdasarkan</label></td>
			<td>	
					<div class="radio">
					  <label>
						<input type='radio' name='jenis_lihat' value='1' style="margin-bottom:0;" />PIN Peserta
					  </label>
					</div>
					<div class="radio">
					  <label>
					<input type='radio' name='jenis_lihat' value='2' style="margin-bottom:0;" />No. Peserta
					  </label>
					</div>
					<div class="radio">
					  <label>
					<input type='radio' name='jenis_lihat' value='3' style="margin-bottom:0;" />Nama Peserta<br />
					  </label>
					</div>
			</td>
		</tr>
		<tr>
			<td><input type='hidden' name='lihat' value='saiki' /></td>
			<td><div class="col-xs-6"><input type='submit' name='lihat' value='Lihat' class='btn-uin btn btn-inverse btn btn-small' /></div></td>
		</tr>
	</tbody>
</table>
</form>
<div id='notif-upsbp'></div>
</div>