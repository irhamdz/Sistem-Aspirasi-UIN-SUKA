<script language="javascript">
$(function () {
    $("button").click(function() {
    
    id = $(this).attr('id');
    val = $(this).attr('isi');
   
    if(id == 'hps')
    {
      var r = confirm("Apakah Anda yakin akan menghapus data ruang ujian?");
      if (r)
      {
      $("#table-ruang-ujian").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
    
        $.ajax({
      type: 'post',
      url: "<?php echo base_url('adminpmb/input_data_c/delete_ruang_ujian'); ?>",
      data: {'id': val},
      }).done(function(x) { 
        $('#table-ruang-ujian').load("<?php echo base_url('adminpmb/input_data_c/after_tranc_ruang_ujian'); ?>");
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
<div>
<h3 style="margin-bottom:10px;">Data Ruangan Ujian</h3>
	<table class="table table-bordered">
      <thead>
      <tr>
        <th>No.</th>
        <th>Nama Gedung</th>
        <th>Nama Ruang</th>
        <th>No urut Gedung</th>
        <th>Kapasitas Ruang</th>
        <th>No Ujian Awal/Akhir</th>
        <th>Jalur Masuk</th>
        <th>Status Ruang Ujian</th>
        <th>Proses</th>
      </tr>
      </thead>
  
  <tbody>
  <?php 
  $num=0; 
  
  if(!is_null($data_ruang_ujian))
  {
  	foreach ($data_ruang_ujian as $data_masuk) 
  		{ 
          echo "<tr>";
          echo "<td>";  echo $num+=1;                echo "</td>";
          echo "<td>";  echo $data_masuk->nama_gedung;         echo "</td>";
          echo "<td>";  echo $data_masuk->nama_ruang;         echo "</td>"; 
          echo "<td>";  echo $data_masuk->id_urut_gedung;         echo "</td>";
          echo "<td>";  echo $data_masuk->kapasitas_ruang;         echo "</td>";
          echo "<td>";  echo $data_masuk->no_ujian_awal.' / '.$data_masuk->no_ujian_akhir;         echo "</td>";
          echo "<td>";  echo $data_masuk->jalur_masuk;         echo "</td>"; 
          echo "<td>"; 
      if($data_masuk->status_ruang_ujian=='1'){ echo "Tersedia"; } else{echo "Kosong";} ?> 
      </td>
      <td>  <button id="edit" class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->id_ruang_ujian; ?>"><i class="icon-edit icon-white"></i> Edit</button>
            <button id="hps" class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->id_ruang_ujian; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
      </td>
    </tr>

  <?php 
} 
}
else
{
 echo '<td colspan="9" align="center">DATA RUANG BELUM ADA.</td>      </tbody>';
}
  ?>

</table></div>
</div>