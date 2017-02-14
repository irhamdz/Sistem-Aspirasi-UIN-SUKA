
<script language="javascript">

</script>
<br id="ganjel">
<br class="ganjel">
<div class="search-table-outter wrapper">
	<table class="table table-bordered">
  <thead>
  <tr>
  </tr>
    <tr>
      <th width="5">NO</th>
      <th>GEDUNG</th>
      <th width="60">
        RUANG
      </th>
      <th width="30">KAPASITAS</th>
      <th width="20">TERISI</th>
      <th width="200">NO PESERTA</th>
      <th width="10">CETAK ALBUM UJIAN</th>
      <th width="10">CETAK FORM VERIFIKASI</th>
    </tr>
  </thead>
  <?php

  $num=0;
  if(!is_null($data_presensi))
  {
    foreach ($data_presensi as $presensi) {
      echo "<tr>";
      echo "<td align='center'>";  
        echo $num+=1;
      echo "</td>";
       echo "<td align='center'>";
       echo $presensi->nama_gedung;
        echo "</td>";
        echo "<td>";
       echo $presensi->nama_ruang;
      echo "</td>";
       echo "<td align='center'>";
       echo $presensi->kapasitas_ruang;
      echo "</td>";
       echo "<td align='center'>";
       echo $presensi->jml;
      echo "</td>";
       echo "<td align='center'>";
       echo $presensi->awal.' - '.$presensi->akhir;
      echo "</td>";
       echo "<td align='center'>";
       echo "<button class='btn' isi='".$num."' id='".$presensi->kode_jalur."' value='".$presensi->id_ruang."' onclick='cetak_album(this)' ><i class='glyphicon glyphicon-print'></i></button>";
      echo "</td>";
       echo "<td align='center'>";
       echo "<button class='btn' isi='".$num."' id='".$presensi->kode_jalur."' value='".$presensi->id_ruang."' onclick='cetak_verifikasi(this)'><i class='glyphicon glyphicon-print'></i></button>";
      echo "</td>";
      echo "<input type='hidden' id='jal".$num."' value='".$presensi->kode_penawaran."'>";
      echo "<input type='hidden' id='ruang".$num."' value='".$presensi->id_ruang."'>";
      echo "</tr>";
    }

  }

  ?>
  <tbody>
  
  </table>
  </div>
  </div>

<script type="text/javascript">

function cetak_album (al)
{
var num=$('#'+al.id).attr('isi');
var kode_penawaran=$('#jal'+num).attr('value');
    window.open("<?php echo base_url('adminpmb/album/cetak_album_ujian/"+kode_penawaran+"/"+al.value+"/"+jadwal+"') ?>",'_blank');
}

function cetak_verifikasi(ver)
{
var no=$('#'+ver.id).attr('isi');
var kode_penawaran=$('#jal'+no).attr('value');
var id_ruang=$('#ruang'+no).attr('value');

    window.open("<?php echo base_url('adminpmb/verifikasi_c/cetak_verifikasi/"+kode_penawaran+"/"+ver.value+"/"+jadwal+"') ?>",'_blank');
}

  </script>