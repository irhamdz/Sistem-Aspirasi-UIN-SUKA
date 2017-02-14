<script type="text/javascript">
	$(function () {
		$(document).ajaxStart(function () {
			$("#tbl-rekap").html("<span style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img  src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
		});
		
		$(".univ").change(function() {
			id = $(this).attr('id');
			val = $(this).val();
			//perr = $("#perr").val();
		if(id == 'fak'){
		//alert(val);
			$.ajax({
				type: 'post',
				dataType: 'html',
				url: 'admlaporan-inputanggota',
				data: {op: id, val: val},
			})
			.done(function(x) {
				// $("#prod").html(x);
				// $("#tbl-rekap").load('admlaporan-inputanggota/'+$("#prod").val());
				$("#tbl-rekap").load('admlaporan-inputanggota/'+$("#fak").val());
			}); 
		}

		// if(id == 'prod'){
				// $("#tbl-rekap").load('admlaporan-inputanggota/'+$("#prod").val());
		// }

		});
	});
</script>
<h2>Placement Test</h2>
<?php
$crumbs = array(array('Beranda'=>base_url()),array('Placement Test' => 'adminpmb/admlaporan-data_pendaftar'));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";
#echo $tahun_awal;
?>
<div id="mn-periode">
	<table class="table table-hover">
	  <tbody>
	  <tr>
	    <td class="input-medium"><strong>Soal</strong></td>
	    <td>
			<select class="input-xxlarge univ" id="soal" name="soal" style="margin-bottom:0px;">
				<option value="001">Bahasa Arab</option>
				<option value="002">Bahasa Inggris</option>
			</select>
	    </td>
	  </tr>
	  <tr>
	    <td class="input-medium"><strong>Tahun</strong></td>
	    <td>
			<select class="input-xxlarge univ" id="thn" name="thn" style="margin-bottom:0px;">
				<option value="2014">2014</option>
			</select>
	    </td>
	  </tr>
	  <tr>
	    <td class="input-medium"><strong>Fakultas </strong></td>
	    <td>
			<select class="input-xxlarge univ" id="fak" name="fak" style="margin-bottom:0px;">
				<?php echo $dd_fak;?>
			</select>
	    </td>
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
</div>

<div id="tbl-rekap">
	<?php  $this->load->view('05_adminpmb/admlaporan/placement_test/table_hasil_test'); ?>
</div>