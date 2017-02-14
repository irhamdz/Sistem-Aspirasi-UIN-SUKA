
<h3 style="margin-bottom:10px;">Data Jadwal Ujian</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Tanggal</th>
      <th>Jam Mulai</th>
      <th>Jam Selesai</th>
      <th>Acara</th>
    </tr>
  </thead>
  
  <tbody>
<?php
function tanggal_hari($tanggal){
  $tgl=explode("-",$tanggal);
  $info=date('w', mktime(0,0,0,$tgl[1],$tgl[0],$tgl[2]));
  switch($tgl[1]){
      case '01': $bulan= "Januari"; break;
      case '02': $bulan= "Februari"; break;
      case '03': $bulan= "Maret"; break;
      case '04': $bulan= "April"; break;
      case '05': $bulan= "Mei"; break;
      case '06': $bulan= "Juni"; break;
      case '07': $bulan= "Juli"; break;
      case '08': $bulan= "Agustus"; break;
      case '09': $bulan= "September"; break;
      case '10': $bulan= "Oktober"; break;
      case '11': $bulan= "November"; break;
      case '12': $bulan= "Desember"; break;
    };
    switch($info){
      case '0': $hari= "Minggu"; break;
      case '1': $hari= "Senin"; break;
      case '2': $hari= "Selasa"; break;
      case '3': $hari= "Rabu"; break;
      case '4': $hari= "Kamis"; break;
      case '5': $hari= "Jumat"; break;
      case '6': $hari= "Sabtu"; break;
    };
  $tampil_tanggal=$hari.", ".$tgl[0]." ".$bulan." ".$tgl[2];
  return $tampil_tanggal;
}

	$num=0; 
  if(!is_null($data_jadwal))
  {
  	foreach ($data_jadwal as $data_masuk) 
  	{ 
      echo "<tr>";
      echo "<td>";  echo $num+=1;                 echo "</td>";
      echo "<td>";  echo tanggal_hari(date_format(date_create($data_masuk->tanggal),'d-m-Y'));        echo "</td>";
      echo "<td>";  echo $data_masuk->jam_mulai;   echo "</td>";
      echo "<td>";  echo $data_masuk->jam_selesai;   echo "</td>";
      echo "<td>";  echo $data_masuk->nama_tes;   echo "</td>";
  	}
  }
  else
  {
 	echo '<td colspan="7" align="center">DATA JADWAL UNTUK PERIODE INI BELUM ADA.</td>      </tbody>';
  }
 ?>

</table></div>