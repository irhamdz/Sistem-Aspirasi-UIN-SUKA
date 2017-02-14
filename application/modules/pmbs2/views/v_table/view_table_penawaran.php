<script language="javascript">
$(function () {
    $("button").click(function() {
    
    id = $(this).attr('id');
    val = $(this).attr('isi');
   
    if(id == 'hps')
    {
      var r = confirm("Apakah Anda yakin akan menghapus data penawaran jalur?");
      if (r)
      {
      
  			$.ajax({
			type: 'post',
			url: "<?php echo base_url('adminpmb/input_data_c/delete_penawaran_jalur'); ?>",
			data: {'id': val},
			}).done(function(x) {

				  $("#tbl-penawaran").load("<?php echo base_url('adminpmb/input_data_c/after_tranc_penawaran_jalur'); ?>");
          $("#information").html('Data Berhasil dihapus.')
			});
      }
      else
      {
        
      }
    }
    else if(id == 'edit')
    {
      
    }
   
  });
});

</script>
<div class="result_data">
<h3 style="margin-bottom:10px;">Data Penawaran</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Kode Jalur</th>
      <th>Nama Jalur</th>
      <th>Tanggal Mulai</th>
      <th>Tanggal Selesai</th>
      <th>Tahun</th>
      <th>Proses</th>
    </tr>
  </thead>
 
  <tbody>
  <?php 
  $num=0;
  if(!is_null($data_jalur_masuk))
  { 
  	foreach ($data_jalur_masuk as $data_masuk) 
  	{	 
	  echo "<tr>";
      echo "<td>";  echo $num+=1; 								echo "</td>";
      echo "<td>";  echo $data_masuk->kode_jalur; 				echo "</td>";
      echo "<td>";  echo $data_masuk->jalur_masuk; 				echo "</td>";
      echo "<td>";  echo $data_masuk->tanggal_mulai_daftar; 	echo "</td>";
      echo "<td>";  echo $data_masuk->tanggal_selesai_daftar; 	echo "</td>";
      echo "<td>";  echo $data_masuk->tahun; 					echo "</td>";
      echo "<td>";
    ?>
    <button id="edit" class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_penawaran; ?>"><i class="icon-edit icon-white"></i> Edit</button>
    <button id="hps" class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_penawaran; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
    <?php
      echo "</td>";
      echo "</tr>";
    }
  }
   else 
    {
    	echo '<td colspan="8" align="center">DATA PENAWARAN JALUR BELUM ADA.</td>      </tbody>';
    }
    
  ?>
</table></div>

</div>