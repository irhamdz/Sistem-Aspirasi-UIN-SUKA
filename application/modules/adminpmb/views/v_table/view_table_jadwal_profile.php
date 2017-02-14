<h3 style="margin-bottom:10px;">Data Jadwal Pengisian Profile</h3>
<br>
  <table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="top" width="1">No.</th>
      <th valign="top" width="40">Jalur</th>
      <th valign="top" width="40">Tanggal Mulai</th>
      <th valign="top" width="40">Tanggal Selesai</th>
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
      case '11': $bulan= "Nopember"; break;
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
  if(!is_null($jadwal))
  {

  	foreach ($jadwal as $data_masuk) 
  	{ 
      $num+=1;
      
      echo "<tr>";
      echo "<td>";  echo $num; echo "</td>";
       echo "<td>"; echo $data_masuk->KETERANGAN;  echo "</td>";
       echo "<td>";  echo $data_masuk->TGL_MULAI;   echo "</td>";
      echo "<td>";  echo $data_masuk->TGL_AKHIR; echo "</td>";
   }
   
  }
  else
  {
 	echo '<td colspan="8" align="center">DATA JADWAL UNTUK PERIODE INI BELUM ADA.</td>      </tbody>';
  }
 ?>

</table>
<script type="text/javascript">

</script>