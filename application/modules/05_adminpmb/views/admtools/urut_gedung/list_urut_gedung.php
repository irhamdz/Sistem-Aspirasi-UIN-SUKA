<table class="table table-bordered table-hover">
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='50%' align='left'>NAMA GEDUNG</th>
					<th width='5%'>JALUR</th>
					<th width='5%'>TAHUN</th>
					<th width='5%'>#</th>
				</tr>
				</thead>
				<tbody>
			<?php
			$no=1;
			foreach($urut_gedung as $value){ 
			?>
				<tr>
					<td align='center'><?php echo $no; ?></td>
					<td><?php echo $value->PMB_NAMA_GEDUNG; ?></td>
					<td align='center'><?php echo $value->PMB_JALUR_UJIAN; ?></td>
					<td align='center'><?php echo $TAHUN; ?></td>
					<td align='center'>
					<button id="hps" class="btn btn-small aksi" isi="<?php echo $value->PMB_ID_URUT_GEDUNG; ?>"><i class="icon-trash"></i></button>
					</td>
					
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