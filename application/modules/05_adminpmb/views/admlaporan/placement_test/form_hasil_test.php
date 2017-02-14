<script>
$(function() {
$("form#fup_bp").submit(function() {
    var formData = new FormData($(this)[0]);
    //console.log(nim);
    $.ajax({
        url: 'admlaporan-placement_test',
        type: 'POST',
        data: formData,
        //async: false,
        cache: false,
        contentType: false,
        processData: false,
		dataType : 'html',
		beforeSend: function(){
				$("#tbl-rekap").html(	'<div id="separate"></div>'+
										'<center><img src="<?php echo base_url(); ?>asset/img/loading.gif"></center>'+
										'<div id="separate"></div>'+
										'<center><font size="2px">Harap menunggu</font></center>');
		},
		success: function(x){
			$("#tbl-rekap").html(x);
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
<h2>Placement Test</h2>
<?php
/* $crumbs = array(array('Beranda'=>base_url()),array('Placement Test' => 'adminpmb/admlaporan-placement_test'));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
 */#echo $tahun_awal;
?>

<div id="mn-periode">
<form method='POST' id='fup_bp' >
<table class="table table-hover">
	<table class="table table-hover">
	  <tbody>
	  <tr>
	    <td class="input-medium"><label style="margin-top:5px;">Soal</label></td>
	    <td><div class="col-xs-6">
			<select class="form-control input-sm" id="soal" name="soal" style="margin-bottom:0px;">
				<option value="001">Bahasa Arab</option>
				<option value="002">Bahasa Inggris</option>
			</select></div>
	    </td>
	  </tr>
	  <tr>
	    <td class="input-medium"><label style="margin-top:5px;">Tahun</label></td>
	    <td><div class="col-xs-4">
			<select class="form-control input-sm" id="thn" name="thn" style="margin-bottom:0px;">
				<option value="2014">2014</option>
			</select></div>
	    </td>
	  </tr>
	  <tr>
	    <td class="input-medium"><label style="margin-top:5px;">Fakultas </label></td>
	    <td><div class="col-xs-8">
			<select class="form-control input-sm" id="fak" name="fak" style="margin-bottom:0px;">
				<?php echo $dd_fak;?>
			</select></div>
	    </td>
	  </tr>
	  <tr>
			<td><input type='hidden' name='tampil' value='sekarang' /></td>
			<td><div class="col-xs-6"><input type='submit' value='Lihat' class='btn-uin btn btn-inverse btn btn-small' /></div></td>
		</tr>
<?php 
	   // <tr>
	    // <td class="input-medium"><strong>Prodi </strong></td>
	    // <td>
			// <select class="input-xlarge univ" id="prod" name="prod" style="margin-bottom:0px;"><?php echo $dd_prod;</select>	
	    // </td>
	  // </tr>
	  ?>
	  </tbody>
	</table>
</form>
</div>

<div id="tbl-rekap">
	<?php  $this->load->view('05_adminpmb/admlaporan/placement_test/table_hasil_test'); ?>
</div>