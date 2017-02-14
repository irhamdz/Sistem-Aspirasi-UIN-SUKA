<script type="text/javascript">
$(function() {
	$(document).ajaxStart(function () {
        $("#tbl-rekap").append("<span style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img  src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
    });

	$("form#finput").submit(function() {
	    var formData = new FormData($(this)[0]);
	    var perr = $("#perr").val();
	    //console.log(formData);
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
			$("#error-msg").html(x);
		    setTimeout(function() {
		     $("#tbl-rekap").load('ruang/'+perr);
		    	$("#error-msg").html("");
		    }, 500);
		});
	    
	    return false;
	});

  $(".perr").change(function() {
    id = $(this).attr('id');
    val = $(this).val();
    if(id == 'perr')
    {
      $.ajax({
      type: 'post',
      dataType: 'html',
      data: {op: id, kd: val},
      })
      .done(function(x) {
        $("#tbl-rekap").html(x);
      }); 
    }
  });


});
</script>
 
<h2>Pengaturan Ruang Ujian Sertifikasi ICT</h2>
<?php
	$crumbs = array(
				array('Training & Sertifikasi' => 'training/admin'),
				array('ICT' => '#'),
				array('Atur Ruang Sertifikasi' =>'toec/sertifikasi/ruang'),
			);
	$this->it00_lib_output->output_crumbs($crumbs);
?>
<div id="mn-tambah-ruang">
	<div id="notif" class="bs-callout bs-callout-info">Silakan isi terlebih dahulu data ruang. Kemudian klik tombol <b>Tambah</b> untuk menambahkan data ruang.</div>
	<h3 style="margin-bottom:10px;">Form Penambahan Ruang Ujian Sertifikasi ICT</h3>
	 <form id="finput" name="finput" method="post" class=" form-horizontal" action="">
	 <input name="op" type="hidden" value="tmbh">
	<div id="periode"><?php $this->load->view('sertifikasi/vw_dropdown/dd_periode_sr');  ?></div>
	<div id="">
		<table name="tinput" id="tinput" class="table table-hover" >
	    <tbody><tr>
	        <td class="col-md-2">Ruang</td>
	        <td>
	          <select name="ruu" id="ruu" class="form-control input-md" >
	          <?php echo $dd_ruang; ?>
	          </select>
	        </td>
	      </tr>
	      <tr>
	        <td class="">Kapasitas</td>
	        <td><input id="kap" name="kap" class="form-control input-md" type="text" value="0" ></td>
	      </tr>
	      <tr>
	        <td class="">Keterangan</td>
	        <td><input id="ket" name="ket" class="form-control input-md" type="text"></td>
	      </tr>
	      <tr>
	        <td class=""></td>
	        <td><button class="btn btn-inverse btn-uin btn-small">Tambah</button> <span style="font-weight:bold;" id="error-msg"></span></td>
	      </tr>
	  
	  </tbody></table>
	  </div>
	  </form>
</div>
<h3 style="margin-bottom:10px;">Daftar Ruang Ujian Sertifikasi ICT</h3>
<div id="tbl-rekap">
	<?php $this->load->view('sertifikasi/operator/vw_tabel/tbl_ruang'); ?>
</div>