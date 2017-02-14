<?php
if(!is_null($data_jadwal_ujian))
  {
    foreach ($data_jadwal_ujian as $data_jalur) 
    { 
        $jalur=$data_jalur->jalur_masuk;
    }
  }
?>
<h3 style="margin-bottom:10px;">Jadwal <?php if(!is_null($data_jadwal_ujian)){ echo $jalur; } else {echo "Tidak Tersedia";}?></h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Tanggal</th>
      <th>Jam</th>
      <th>Gedung</th>
      <th>Ruang</th>
      <th>Status</th>
      <th>Pilih</th>
    </tr>
  </thead>
  
  <tbody>
<?php 
  $num=0; 
  if(!is_null($data_jadwal_ujian))
  {
    foreach ($data_jadwal_ujian as $data_masuk) 
    { 
      echo "<tr>";
      echo "<td>";  echo $num+=1;                 echo "</td>";
      echo "<td>";  echo $data_masuk->hari.' '.$data_masuk->tanggal_ujian;         echo "</td>";
      echo "<td>";  echo $data_masuk->jam_mulai_ujian.' s.d '.$data_masuk->jam_selesai_ujian;   echo "</td>";
      echo "<td>";  echo $data_masuk->nama_gedung;   echo "</td>";
      echo "<td>";  echo $data_masuk->nama_ruang;   echo "</td>";
      echo "<td>";  

        if($data_masuk->status_ruang_ujian == 1) {echo "Tersedia";}else{ echo "Penuh";} 


      echo "</td>";
       
      echo "<td>"; 

        if($data_masuk->status_ruang_ujian == 1) { ?>
          <button id="ambil" onclick="clickambil(this)" class='badge badge-warning' isi='<?php echo $data_masuk->id_ruang_ujian; ?>'>Ambil</button>
        
        <?php 
    } 
      echo "</td>";
    }
  }
  else
  {
  echo '<td colspan="7" align="center">DATA JADWAL UNTUK JALUR INI BELUM TERSEDIA.</td>      </tbody>';
  }
 ?>

</table>