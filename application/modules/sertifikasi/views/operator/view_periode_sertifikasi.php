<script type="text/javascript">
$(function() {
//var nowTemp = new Date();
	var tgl = $("#dp3").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'disabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');
	
//	$("#dp3").datepicker();

	$(document).ajaxStart(function () {
        $("#tbl-rekap").append("<span style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img  src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
    });

	$("form#finput").submit(function() {
	    var formData = new FormData($(this)[0]);
	    //var nim = $("input[name='nim']").val();
	    $.ajax({
	        type: 'POST',
	        data: formData,
	        async: false,
	        cache: false,
	        contentType: false,
	       	dataType: 'html',
	        processData: false
	    })
	    .done(function(x) {
			$("#notif").html(x);
		    setTimeout(function() {
		      location.reload();
		    }, 500);
		});
	    
	    return false;
	});

  $(".perr").change(function() {
    id = $(this).attr('id');
    val = $(this).val();
    
     if(id == 'tarr'){
      $.ajax({
        type: 'POST',
        dataType: 'html',
        data : {op: id, kd:val,},
      })
      .done(function(x) {
        $("#berr").html(x);
        $("#tbl-rekap").html('');
      });
    }  
    if(id == 'berr')
    {
      $.ajax({
      type: 'post',
      dataType: 'html',
      data: {op: id, berr: val},
      })
      .done(function(x) {
        $("#tbl-rekap").html(x);
      }); 
    }
  });


});

</script>
 
<h2>Pengaturan Periode ICT</h2>
<?php
	$crumbs = array(
				array('Training & Sertifikasi' => 'training/admin'),
				array('ICT' => '#'),
				array('Atur Periode ICT' =>'toec/sertifikasi/periode'),
			);
	$this->it00_lib_output->output_crumbs($crumbs);
?>

<div id="" class="" style="margin-bottom: 10px; margin-top:15px;">
	<h3 style="margin-bottom: 10px;">Form Penambahan Periode ICT</h3>
	<form name="finput" id="finput" method="post" class="form-horizontal" action="" style="margin-bottom:0px;">
	<input name="op" type="hidden" value="tmbh">
	  <table class=" table-condensed">
	  <tbody>
	  <tr>
	    <td class="input-sm col-md-3">Tanggal</td>
	    <td>
			   <div class="input-group date" id="dp3" data-date="" data-date-format="dd-mm-yyyy">
						<input class="form-control" size="16" type="text" value="" name="tanggal" readonly>
						<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
				</div>
		</td>	 
	  </tr>
	  <tr></tr>

	  <tr>
	    <td></td>
	    <td><button type="submit" class="btn btn-inverse btn-uin btn-sm">Tambah Periode</button></td>
	  </tr>
	</tbody>
	</table>
	</form>
</div>
<h3 style="margin-bottom: 10px;">Daftar Periode ICT</h3>
<div id="notif"></div>
<div id="periode">
	<?php $this->load->view('sertifikasi/vw_dropdown/dd_thn_bln');  ?>
</div>

<div id="tbl-rekap">
	<?php $this->load->view('sertifikasi/operator/vw_tabel/tbl_periode');?>
</div>