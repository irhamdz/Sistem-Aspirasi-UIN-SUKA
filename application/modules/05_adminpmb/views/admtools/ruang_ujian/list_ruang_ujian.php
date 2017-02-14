<table class="table table-bordered table-hover">
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='40%' align='left'>NAMA GEDUNG</th>
					<th width='20%' align='center'>NAMA RUANG</th>
					<th width='5%' align='center'>KPS.</th>
					<th width='10%' align='center'>NO AWAL</th>
					<th width='10%' align='center'>NO AKHIR</th>
					<th width='5%'>#</th>
				</tr>
				</thead>
				<tbody>
			<?php
			$no=1;
			foreach($ruang_ujian as $value){ 
			?>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td><?php echo $value->PMB_NAMA_GEDUNG; ?></td>
					<td align='center'><?php echo $value->PMB_NAMA_RUANG; ?></td>
					<td align='center'><?php echo $value->PMB_KAPASITAS_RUANG; ?></td>
					<td align='center'><?php echo $value->PMB_NO_UJIAN_AWAL; ?></td>
					<td align='center'><?php echo $value->PMB_NO_UJIAN_AKHIR; ?></td>
					<td align='center'><button id="hps" class="btn btn-small aksi" isi="<?php echo $value->PMB_ID_RUANG_UJIAN; ?>"><i class="icon-trash"></i></button></td>
				</tr>
			<?php $no++; 
			} ?>
			</tbody>
		</table>
<script type="text/javascript">
$(function () {
    $(".aksi").click(function() {
    jalur = $("#GELOMBANG").val();
    tahun = $("#TAHUN").val();
    id = $(this).attr('id');
    val = $(this).attr('isi');
	//alert(val);
    if(id == 'hps')
    {
      var r = confirm("Apakah Anda yakin akan menghapus data ini?");
      if(r==false)
      {
        //$("#tbl-rekap").load('periode/'+bln[1]);
      }

      else{
        $.ajax({
          type: 'post',
          dataType: 'html',
          data: {op: id, kd: val, thn:tahun, jal: jalur},
        })
        .done(function(x) {
            //$("#tbl-rekap").load('periode/'+bln[1]);
			$.ajax({type: 'post', dataType: 'html', data: {tampil: 'sekarang', GELOMBANG: jalur, TAHUN:tahun},}).done(function(x){$("#notif-upsbp").html(x);});
		});
	  }
	}
	});
});

</script>