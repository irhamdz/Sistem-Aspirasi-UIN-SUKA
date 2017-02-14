<script language="javascript">

</script>

<h3 style="margin-bottom:10px;">Data Jumlah Peminat Prodi.</h3>
<br id="ganjel">
<br class="ganjel">

<div class="search-table-outter wrapper">
	<table class="table table-bordered table-hover search-table inner" id="tab">
  <thead>
    <tr>
      <th valign="top" width="5">No.</th>
      <th valign="top" width="25">Nama Prodi</th>
      <th valign="top" width="25">Kelas</th>
      <th valign="top" width="25">Pilihan 1</th>
      <th valign="top" width="50">Pilihan 2</th>
      <th valign="top" width="60">Pilihan 3</th>
      <th valign="top" width="60">Pilihan 4</th>
      <th valign="top" width="60">Jumlah </th>
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
  $total=0;
  $jml_p1=0;
  $jml_p2=0;
  $jml_p3=0;
  $jml_p4=0;
  if(!is_null($data_prodi))
  {
    foreach ($data_prodi as $prodi) {
      if(strlen($prodi->jml)>0)
      {
        $total+=$prodi->jml;
      }

      echo "<tr>";
      echo "<td>";  
        echo $num+=1;
      echo "</td>";
       echo "<td>";
       echo "<strong>".$prodi->nama_prodi."</strong>";
      echo "</td>";
        echo "<td>";
       echo "<strong>".$prodi->nama_kelas."</strong>";
      echo "</td>";
       echo "<td>";
       if(strlen($prodi->pil1)<1)
       {
       echo "0";
       }
       else
       {
        echo $prodi->pil1;
        $jml_p1+=$prodi->pil1;
       }
       
      echo "</td>";
      echo "<td>";
      if(strlen($prodi->pil2)<1)
       {
        echo "0";
       }
       else
       {
       echo $prodi->pil2;
       $jml_p2+=$prodi->pil2;
     }
      echo "</td>";
       echo "<td>";
       if(strlen($prodi->pil3)<1)
       {
        echo "0";
       }
       else
       {
       echo $prodi->pil3;
       $jml_p3+=$prodi->pil3;
     }
      echo "</td>";
       echo "<td>";
       if(strlen($prodi->pil4)<1)
       {
        echo "0";
       }
       else
       {
       echo $prodi->pil4;
       $jml_p4+=$prodi->pil4;
     }
      echo "</td>";
      echo "<td>";
      if(strlen($prodi->jml)<1)
       {
        echo "<strong>0</strong>";
       }
       else
       {
       echo "<a id='".$prodi->id_prodi."' nomor='".$num."' jalur='".$prodi->kode_jalur."' onclick='lihat_mhs(this)'><strong>".$prodi->jml."</strong></a>";
     
     }
      echo "</td>";
      echo "</tr>";

      ?>
      <tr id="contactx<?php echo $num; ?>" style='display:none;'>
      <td colspan="7">
      <table id="contact<?php echo $num; ?>"></table>
      </td>
      </tr>
      <?php
    }
    echo "<tr>";
      echo "<td colspan='3' align='right'>";
      echo "Jumlah :";
      echo "</td>";
      echo "<td>";
      echo "<strong>".$jml_p1."</strong>";
      echo "</td>";
      echo "<td>";
      echo "<strong>".$jml_p2."</strong>";
      echo "</td>";
      echo "<td>";
      echo  "<strong>".$jml_p3."</strong>";
      echo "</td>";
      echo "<td>";
      echo  "<strong>".$jml_p4."</strong>";
      echo "</td>";
      echo "<td>";
      echo "<strong>".$total."</strong>";
       echo "</td>";
      echo "</tr>";

  }

  ?>
  <tbody>
  
  </table>
  </div>
  </div>
<script type="text/javascript">
function lihat_mhs(idp)
{
  var no=$('#'+idp.id).attr('nomor');
  var kode_jalur=$('#'+idp.id).attr('jalur');
  $.ajax({
    url: "<?php echo base_url('adminpmb/input_data_c/cari_mhs') ?>",
    type: "POST",
    data: "id_prodi="+idp.id+"&kode_jalur="+kode_jalur,
    success: function(xx)
    {
      $('#contact'+no).html(xx);
      $('#contactx'+no).slideDown('slow');

    }
  });
}
  </script>

