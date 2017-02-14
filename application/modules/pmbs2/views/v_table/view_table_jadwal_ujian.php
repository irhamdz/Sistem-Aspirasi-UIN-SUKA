<script language="javascript">
$(function () {
    $("button").click(function() {
    
    id = $(this).attr('id');
    val = $(this).attr('isi');
   
    if(id == 'hps')
    {
      var r = confirm("Apakah Anda yakin akan menghapus data jadwal ujian?");
      if (r)
      {
      
        $.ajax({
      type: 'post',
      url: "<?php echo base_url('adminpmb/input_data_c/delete_jadwal_ujian'); ?>",
      data: {'id': val},
      }).done(function(x) {
        alert('Data berhasil dihapus. Maaf belum terRefresh.');
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
<h3 style="margin-bottom:10px;">Data Jadwal Ujian</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Hari</th>
      <th>Tanggal</th>
      <th>Jam Mulai</th>
      <th>Jam Selesai</th>
      <th>Jalur Masuk</th>
      <th>Proses</th>
    </tr>
  </thead>
  
  <tbody>
<?php 
	$num=0; 
  if(!is_null($data_jadwal))
  {
  	foreach ($data_jadwal as $data_masuk) 
  	{ 
      echo "<tr>";
      echo "<td>";  echo $num+=1;                 echo "</td>";
      echo "<td>";  echo $data_masuk->hari;         echo "</td>";
      echo "<td>";  echo $data_masuk->tanggal_ujian;        echo "</td>";
      echo "<td>";  echo $data_masuk->jam_mulai_ujian;   echo "</td>";
      echo "<td>";  echo $data_masuk->jam_selesai_ujian;   echo "</td>";
      echo "<td>";  echo $data_masuk->jalur_masuk;   echo "</td>";

      echo "<td><button id='edit' class='btn btn-inverse btn-small aksi' isi='".$data_masuk->kode_jadwal."'><i class='icon-edit icon-white'></i> Edit</button>";
      echo " <button id='hps' class='btn btn-inverse btn-small aksi' isi='".$data_masuk->kode_jadwal."'><i class='icon-trash icon-white'></i> Hapus</button></td>";
  	}
  }
  else
  {
 	echo '<td colspan="7" align="center">DATA JADWAL UNTUK PERIODE INI BELUM ADA.</td>      </tbody>';
  }
 ?>

</table></div>
</div>