<?php if(isset($kd_menu) && in_array($kd_menu,array('jadwal','lihatnilai','nilai'))): 

?>
<script type="text/javascript">
$(function () {
	$(document).ajaxStart(function () {
        $("#tbl-rekap").html("<span style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img  src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
    });

    $(".aksi").click(function() {
    perr = $("#perr").val();
    id = $(this).attr('id');
    val = $(this).attr('isi');
	if(id == 'det_terisi')
	{
		//$("#tbl-rekap").load('jadwal/'+perr+'/'+val);
		$.ajax({
          type: 'post',
          dataType: 'html',
          data: {op: id, kd: val, perr: perr},
        })
		.done(function(x) {
            $("#tbl-rekap").html(x);
        });		
	}

	else if(id == 'do_pindah'){
        $.ajax({
          type: 'post',
          dataType: 'html',
          data: {op: id, kd: val},
        })
        .done(function(x) {
            $("#page_title").html('Jadwal Ujian Sertifikasi yang Telah Terisi');
            $("#tbl-rekap").load('jadwal/'+perr+'/'+val);
        });
	}
	else if(id == 'batal_pindah'){
	    $.ajax({ type: 'post', dataType: 'html', data: {op: id}, })
        .done(function(x) {
            $("#page_title").html('Jadwal Ujian Sertifikasi yang Telah Terisi');
            $("#tbl-rekap").load('jadwal/'+perr);
        });
	}
	//isi nilai
	else if(id == 'det_nilai'){
		$("#tbl-rekap").load('nilai/det-'+val,function(){
			$("#div_periode").hide();
		});
	}
	else if(id == 'det_lihatnilai'){
		$("#tbl-rekap").load('lihatnilai/det-'+val,function(){
			$("#div_periode").hide();
		});
	}		
  });
});
</script>

<?php else: #untuk mahasiswa ?>
<script type="text/javascript">
$(function () {
	$(document).ajaxStart(function () {
        $("#tbl-rekap").html("<span style='background-color: white; position: relative; z-index:1; text-align:center;'><center><img  src='http://pustaka.uin-suka.ac.id/asset/img/loading.gif'></img><br>Harap menunggu...</center></span>");
    });
	
    $(".aksi").click(function() {
    perr = $("#perr").val();
    id = $(this).attr('id');
    val = $(this).attr('isi');
	if(id == 'do_ambil')
	{
        $.ajax({
          type: 'post',
          dataType: 'json', 
          data: {op: id, kd: val},
        })
        .done(function(x) {
		  $("#tbl-rekap").prepend(x.notif);
		  //alert(x);
		   setTimeout(function() {
				location.reload();
		   }, 2000);
			
        });
	}
	if(id == 'hapus')
	{
		var r = confirm("Apakah Anda yakin akan membatalkan jadwal Ujian Sertifikasi?");
		if(r==false){ $("#tbl-rekap").load('jadwalplacement');	}

		else{
			$.ajax({type: 'post',dataType: 'html',data: {op: id, kd: val},})
			.done(function(x) {
				$("#tbl-rekap").load('jadwalplacement');
			});  
		}
	}
  });
});
</script>	
<?php endif; ?>
<div style="margin-bottom: 10px;">
<?php 
	if( $this->session->userdata('ict_pst_sr') ){
		echo '<button id="batal_pindah" class="btn btn-danger btn-small aksi" isi=""><i class="icon-remove icon-white"></i> Batal Pindah</button>';
	}
?>
</div>
<div id = "ccc">
</div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Ruang</th>
      <th>Jam</th>
      <th>Kapasitas</th>
      <th>Proses</th>
    </tr>
  </thead>
  
  <tbody>
 <?php if(!isset($get_jadwal) or empty($get_jadwal)):
      	echo '<td colspan="5" align="center">Data jadwal untuk periode ini belum ada.</td>';
      else:
      	$i = 0;
      foreach ($get_jadwal as $key => $value): 
		$i++;	?>
	<tr>
		<td align="center"><?php echo $i; ?>.</td>
		<td align="center"><?php echo $value['NM_RUANG']; ?></td>
		<td align="center"><?php echo $value['SESI_MULAI']." - ".$value['SESI_SELESAI']; ?></td>
		<td align="center"><?php echo $value['TERISI']."/".$value['RU_KAP']; ?></td>
		<td align="center">
<?php
if(!isset($kd_menu))
{
	echo "-";
}else{
	if($kd_menu == 'jadwal'){
		if(! $this->session->userdata('ict_pst_sr') ){
			echo '<button id="det_terisi" class="btn btn-inverse btn-small aksi" isi="'.$value['PREJ_KD'].'"><i class="icon-zoom-in icon-white"></i> Lihat Detail</button>';
		}
		else{
			if($value['PENUH'] == '1' || $value['MOVEABLE'] == '0'):
				echo '-';
			else:
				echo '<button id="do_pindah" class="btn btn-inverse btn-small aksi" isi="'.$value['PREJ_KD'].'"><i class="icon-ok icon-white"></i> Memindahkan</button>';
			endif;
		}
	}
	elseif($kd_menu == 'nilai')
	{
		echo '<button id="det_nilai" class="btn btn-inverse  btn-small aksi" isi="'.$value['PREJ_KD'].'"><i class="icon-white icon-pencil"></i> Isi Nilai</button>';
	}	
	elseif ($kd_menu == 'lihatnilai') {
		echo '<button id="det_lihatnilai" class="btn btn-inverse  btn-small aksi" isi="'.$value['PREJ_KD'].'"><i class="icon-white icon-zoom-in"></i> Lihat Nilai</button>';
	}	
	elseif($kd_menu == 'mhs')
	{
		if($subkode_menu == 'ambil'):
			if($value['PENUH'] == '1' || $value['MOVEABLE'] == '0'):
				echo "-";
			else:
				echo '<button id="do_ambil" class="btn btn-inverse btn-small aksi" isi="'.$value['PREJ_KD'].'"><i class="icon-white icon-hand-up"></i> Ambil</button>';
			endif;
		elseif($subkode_menu == 'hapus'): echo '<button id="hapus" class="btn btn-small aksi" isi="'.$value['PREJ_KD'].'"><i class="icon-trash"></i> Hapus</button>';
		else: echo '-';
		endif;
	}
	else { echo "-"; }
}
?>
	</td>
	</tr>
<?php endforeach;
	endif; ?>
      </tbody>
</table>

<?php
#keterangan

/*
	ADMIN
	meluluskan > input ke siprus
	jadwal > detail jadwal, pindah peserta
	
	MHS
	mhs->ambil > mengambil jadwal
	mhs->hapus > mencancel jadwal
*/

?>