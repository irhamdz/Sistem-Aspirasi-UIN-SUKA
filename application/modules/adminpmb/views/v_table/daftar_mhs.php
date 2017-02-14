<script language="javascript">

</script>
<style>
  .search-table{table-layout: fixed;}

.search-table-outter { overflow-x: scroll;margin-bottom: 20px;}
th, td {}
  #tab {
  width:1200px;margin-bottom: 20px;
}
</style>
<h3 style="margin-bottom:10px;">Data Calon Mahasiswa Baru</h3>
<br id="ganjel">
<br class="ganjel">
<div class="search-table-outter wrapper">
	<table class="table table-bordered table-hover search-table inner" id="tab">
  <thead>
    <tr>
      <th valign="top" width="5">No.</th>
      <th valign="top" width="25">Nomor Ujian</th>
      <th valign="top" width="50">Nama</th>
      <th valign="top" width="60">Jalur</th>
      <th valign="top" width="60">Gedung</th>
      <th valign="top" width="10">Ruang Ujian</th>
      <th valign="top" width="50">Tanggal Ujian</th>
      <th valign="top" width="70">Proses</th>
    </tr>
  </thead>
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
  if(!is_null($data_presensi))
  {
    foreach ($data_presensi as $presensi) {
      echo "<tr>";
      echo "<td>";  
        echo $num+=1;
      echo "</td>";
       echo "<td>";
       echo $presensi->nomor_peserta;
      echo "</td>";
       echo "<td>";
       echo $presensi->nama_lengkap;
      echo "</td>";
       echo "<td>";
       echo $presensi->jalur_masuk;
      echo "</td>";
       echo "<td>";
       echo $presensi->nama_gedung;
      echo "</td>";
       echo "<td>";
       echo $presensi->nama_ruang;
      echo "</td>";
       echo "<td>";
       echo tanggal_hari(date('d-m-Y',strtotime($presensi->tanggal_ujian)));
      echo "</td>";
      echo "<td>";
       echo "<button class='btn btn-inverse btn-uin btn-small'>Detail</button> ";
       echo "<button class='btn btn-inverse btn-uin btn-small' value='".$presensi->nomor_pendaftar."' onclick='cetak_kartu(this.value)'>Cetak Kartu</button>";
     
      echo "</td>";
      echo "</tr>";
    }

  }

  ?>
  <tbody>
  
  </table>
  </div>
  <a name="fokus"></a>
  </div>
<script type="text/javascript">
function cetak_kartu(saya)
{
  window.open("http://admisi.uin-suka.ac.id/adminpmb/fpdf_c/ambil_data/"+saya);
}
  </script>
