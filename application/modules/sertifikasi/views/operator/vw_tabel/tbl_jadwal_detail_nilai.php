<div id="jad-detail" class="bs-callout bs-callout-info" style="margin-top:20px;">
<table class="table table-nama" style="margin-bottom:0px;">
	<tbody>
	<tr>
		<td><strong>Tanggal</strong></td>
		<td>: <?php echo $get_jadwal['PER_NM'].", ".$get_jadwal['PER_BULAN']; ?></td>
		<td><strong>Kapasitas</strong></td>
		<td>: <?php echo $get_jadwal['TERISI']."/".$get_jadwal['RU_KAP']; ?></td>
	</tr>
	<tr>
		<td><strong>Ruang</strong></td>
		<td>: <?php echo $get_jadwal['NM_RUANG'].' ('.$get_jadwal['SESI_MULAI'].' - '.$get_jadwal['SESI_SELESAI'].')'; ?></td>

	</tr>
	</tbody>
</table>
</div>


<script type="text/javascript">
$(function () {
	$("form#finput_nilai").submit(function(){
		var formData = new FormData($(this)[0]);
		$("#notif").html("");
		$.ajax({
			type: 'POST',
			data: formData,
			cache: false,
			contentType: false,
			dataType: 'html',
			processData: false
		})
		.done(function(x) {
			// alert(x);
			$("#tbl-rekap").load("nilai/det-<?php echo $kd_jad; ?>",function(){
				$("#notif").html(x);
				$("#div_periode").hide();
			});
		});		
		return false;
	});
	
   $(".aksi").click(function() {
    perr = $("#perr").val();
    id = $(this).attr('id');
    val = $(this).attr('isi');
	if(id == 'back_nilai'){
		$("#tbl-rekap").load('nilai/'+perr,function(){
			$("#div_periode").show();
			$("#notif").html("");
		});
	}
	
	if(id == 'back_lihatnilai'){
		$("#tbl-rekap").load('lihatnilai/'+perr,function(){
			$("#div_periode").show();
			$("#notif").html("");
		});
	}
	else if(id == 'input_nilai'){
		$("#f"+id).submit();
		//alert("f"+id);
	}
  });

});

function minmax(value, min, max) 
{
    if(parseFloat(value) < 0 || (value == '')) 
        return 0; 
    else if(parseFloat(value) > 100) 
        return 100; 
    else return value;
}

    
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode > 47 && charCode < 58 ) || (charCode == 44 || charCode == 46))
		return true;
    else
        return false;
}

</script>


<div id="mn-tombol" class="" style="margin-bottom: 10px;">
	<?php if($kd_menu == 'nilai'): ?>
		<button id="back_nilai" class="btn btn-inverse btn-small aksi"><i class="icon-white icon-chevron-left"></i> Kembali</button>
		<button id="input_nilai" class="btn btn-inverse btn-small aksi"><i class="icon-white icon-hdd"></i> Input Nilai</button>
		<button id="download_nilai" download = "nilai.xls" class="btn btn-inverse btn-small aksi" onClick="window.location.href='download_xls/nilai/<?php echo $kd_jad; ?>'"><i class="icon-white icon-download"></i> Download Nilai</button>
	<?php elseif($kd_menu == 'lihatnilai'): ?>
		<button id="back_lihatnilai" class="btn btn-inverse btn-small aksi"><i class="icon-white icon-chevron-left"></i> Kembali</button>
	<?php endif; ?>
</div>

<h2>Daftar Nama Peserta ICT</h2>

<form method="post" name="finput_nilai" id="finput_nilai">
<input type="hidden" name="op" value="saveNilai">
<table class="table table-bordered">
	<tr>
		<th rowspan="2">No.</th>
		<th rowspan="2">No. Reg.</th>
		<th rowspan="2">Nama</th>
		<th colspan="5">Nilai</th>
	</tr>
	<tr>
		<th>Ms. Word</th>
		<th>Ms. Excel</th>
		<th>Ms. PowerPoint</th>
		<th>Internet</th>
		<th>Total</th>
	</tr>
 <?php if(!isset($get_peserta) or empty($get_peserta)):
      	echo '<td colspan="8" align="center">DATA PESERTA UNTUK JADWAL YANG DIPILIH BELUM ADA.</td>';
      else:
		$i = 0;
			foreach ($get_peserta as $key => $value):
				$i++;
				$nim = $value['PRE_USER'];
				$nama = $value['NAMA_F'];
				$web = "-";
				$word = $value['NIL_W'];
				$excel = $value['NIL_E'];
				$ppt = $value['NIL_P'];
				$internet = $value['NIL_I'];
				$nil_angka = $value['NIL_ANGKA'];
				$nil_huruf = $value['NIL_HURUF'];
				$kd_pst = $value['PRE_PIN'];
				
 	?>
	<tr>
		<td align="center"><?php echo $i;?>.<input type="hidden" name="user[<?php echo $kd_pst;?>][URUT]" value="<?php echo $i;?>"></td>
		<td align="center"><?php echo $nim;?></td>
		<td style="padding-left: 10px;"><?php echo $nama;?></td>
		<td align="center">
			<?php if($kd_menu == 'nilai'): ?>
			<input
				style="width:35px; margin-bottom:0px; text-align:right;"
				onkeypress="return isNumberKey(this.value);"
				onkeyup="this.value=minmax(this.value,0,100)"
				type="text"
				name="user[<?php echo $kd_pst;?>][NIL_W]"
				value="<?php echo $word;?>" />
			<?php elseif($kd_menu == 'lihatnilai'): ?>
			<?php echo $word;?>
			<?php endif; ?>
		</td>
		<td align="center">
			<?php if($kd_menu == 'nilai'): ?>
			<input
				style="width:35px; margin-bottom:0px; text-align:right;"
				onkeypress="return isNumberKey(this.value);"
				onkeyup="this.value=minmax(this.value,0,100)"
				type="text"
				name="user[<?php echo $kd_pst;?>][NIL_E]"
				value="<?php echo $excel;?>" />
			<?php elseif($kd_menu == 'lihatnilai'): ?>
			<?php echo $excel;?>
			<?php endif; ?>				
		</td>
		<td align="center">
			<?php if($kd_menu == 'nilai'): ?>
			<input 
				style="width:35px; margin-bottom:0px; text-align:right;"
				onkeypress="return isNumberKey(this.value);"
				onkeyup="this.value=minmax(this.value,0,100)"
				type="text"
				name="user[<?php echo $kd_pst;?>][NIL_P]"
				value="<?php echo $ppt;?>" />
			<?php elseif($kd_menu == 'lihatnilai'): ?>
			<?php echo $ppt;?>
			<?php endif; ?>				
		</td>
		<td align="center">
			<?php if($kd_menu == 'nilai'): ?>
			<input
				style="width:35px; margin-bottom:0px; text-align:right;"
				onkeypress="return isNumberKey(this.value);"
				onkeyup="this.value=minmax(this.value,0,100)"
				type="text"
				name="user[<?php echo $kd_pst;?>][NIL_I]"
				value="<?php echo $internet;?>" />
			<?php elseif($kd_menu == 'lihatnilai'): ?>
			<?php echo $internet;?>
			<?php endif; ?>				
		</td>		
		<td align="center"><?php echo $nil_angka;?></td>
	</tr>
	<?php 
		endforeach;
		endif;
	?>
</table>

</form>