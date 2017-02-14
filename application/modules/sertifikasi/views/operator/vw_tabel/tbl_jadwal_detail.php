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
    $(".aksi").click(function() {
    perr = $("#perr").val();
    id = $(this).attr('id');
    val = $(this).attr('isi');
	if(id == 'terima_lulus'){
		$("#f"+id).submit();
	}
	if(id == 'back_terisi'){
		$("#tbl-rekap").load('jadwal/'+perr);
	}
	if(id == 'print_presensi'){
		$("#f"+id).submit();
	}
	if(id == 'pindah'){
		 $.ajax({
          type: 'post',
          dataType: 'html',
          data: {op: id, isi: val},
        })
        .done(function(x) {
            $("#page_title").html('Pemindahan Peserta Ujian Sertifikasi ICT');
			$("#tbl-rekap").load('jadwal/'+perr);
        });
	}
  });
});

</script>

<?php 

if($kd_menu == 'jadwal'):
echo '<div id="mn-tombol" class="" style="margin-bottom: 10px;">
	<button id="back_terisi" class="btn btn-inverse btn-small aksi"><i class="icon-white icon-chevron-left"></i> Kembali</button>
	<!-- <button id="print_presensi" class="btn btn-inverse btn-small aksi"><i class="icon-white icon-print"></i> Cetak Presensi</button>
	<button id="print_seminar" class="btn btn-inverse btn-small aksi"><i class="icon-white icon-print"></i> Cetak Penerimaan Seminar Kit</button> -->
	<form action="'.base_url('uedu/cetak/form/presensi-peserta').'" target="_blank" method="post" id="fprint_presensi"><input type="hidden" name="kd" value="'.$get_jadwal['PREJ_KD'].'"></form>
	<form action="'.base_url('uedu/cetak/form/seminar').'" target="_blank" method="post" id="fprint_seminar"><input type="hidden" name="kd" value="'.$get_jadwal['PREJ_KD'].'"></form>
	</div>';
endif;

?>
<form method="post" name="fterima_lulus" id="fterima_lulus">
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="30px">No.</th>
      <th width="75px">No. Reg.</th>
      <th>Nama</th>
      <th>Tep. / HP</th>
      <th >Proses</th>
    </tr>
  </thead>
  
  <tbody>
 <?php if(!isset($get_peserta) or empty($get_peserta)):
      	echo '<td colspan="6" align="center">DATA PESERTA UNTUK JADWAL YANG DIPILIH BELUM ADA.</td>';
      else:
      	$i = 0;
      foreach ($get_peserta as $key => $value): 
		$i++;	?>
	<tr id="<?php echo $value['PRE_PIN'];?>"> 
		<td align="center"><?php echo $i; ?>.</td>
		<td align="center"><?php echo $value['PRE_USER']; ?></td>
		<td align="left"><?php echo $value['NAMA_F']; ?></td>
		<td align="left"><?php echo $value['TELP_MHS']; ?></td>
		<td align="center">
		<?php
		if($kd_menu == 'jadwal')
		{
			if($get_jadwal['MOVEABLE'] == '1'):
				echo '<button id="pindah" class="btn btn-inverse btn-small aksi" isi="'.$value['PRE_PIN'].'"><i class="icon-edit icon-white"></i> Pindah</button>';
			else:
				echo '-';
			endif;	
		}

		?>
		</td>
	</tr>
<?php endforeach;
	endif; ?>
      </tbody>
</table>
</form>