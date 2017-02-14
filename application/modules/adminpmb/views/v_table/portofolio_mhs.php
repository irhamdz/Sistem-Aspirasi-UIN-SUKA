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

?>
<br id="ganjel">
<br class="ganjel">
<div class="search-table-outter wrapper">
	<table class="table table-bordered">
  <thead>

    <tr>
      <th width="5" align="center">NO</th>
      <th width="50" align="center">NOMOR UJIAN</th>
      <th width="30" align="center">NAMA PESERTA</th>
      <th width="10" align="center">TANGGAL VERIFIKASI</th>
      <th width="20" align="center">TANGGAL UJIAN</th>
      
    </tr>
  </thead>
  <?php
  $num=0;
  if(!is_null($data_mhs))
  {
    foreach ($data_mhs as $damas) {
      echo "<tr>";
      echo "<td align='center'>";  
        echo $num+=1;
      echo "</td>";
       echo "<td align='center'>";
       echo $damas->nomor_peserta;
      echo "</td>";
       echo "<td align='center'>";
       echo $damas->nama_lengkap;
      echo "</td>";
       echo "<td>";
       echo tanggal_hari(date_format(date_create($damas->tanggal_verifikasi),'d-m-Y'));
      echo "</td>";
       echo "<td>";
       echo tanggal_hari(date_format(date_create($damas->tanggal),'d-m-Y'));
      echo "</td>";
      echo "</tr>";
    }

  }

  ?>
  <tbody>
  
  </table>
  </div>
  </div>
<script type="text/javascript">

  </script>