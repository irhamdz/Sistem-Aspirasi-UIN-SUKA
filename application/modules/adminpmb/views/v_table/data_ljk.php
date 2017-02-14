<h3 style="margin-bottom:10px;">HASIL SCAN LJK</h3>
<br class="ganjel">
<?php
if(!is_null($LJK))
  { 
    $eror_nopes=0;
    $eror_kode=0;
    $eror_jawab=0;
    foreach ($LJK as $jwb1) {
      if(strlen(str_replace(' ','',$jwb1['nomor_peserta'])) != '10')
      {
        $eror_nopes++;
      };
      if(strlen(str_replace(' ','',$jwb1['kode_soal'])) < '2')
      {
        $eror_kode++;
      };
      if(strlen($jwb1['jawaban']) != $JML)
      {
        $eror_jawab++;
      }
    }
  }
?>
<table>
  <tr>
    <td style='background-color:#CC3333;' width="20">
      
    </td>
    <td>
      Kesalahan Nomor Peserta <?php echo $eror_nopes; ?>
    </td>
  </tr>
  <tr>
    <td style='background-color:#FFFF99;' width="20">
      
    </td>
    <td>
      Kesalahan Kode Soal <?php echo $eror_kode; ?>
    </td>
  </tr>
  <tr>
    <td style='background-color:#DDD;' width="20">
      
    </td>
    <td>
      Kesalahan Jumlah Jawaban <?php echo $eror_jawab; ?>
    </td>
  </tr>
  <tr>
    <td>
      
    </td>
    <td>
      Total Data <?php echo count($LJK); ?>
    </td>
  </tr>
  <tr>
    <td>
      
    </td>
    <td>
      <button class='btn btn-inverse btn-small' type="button" onclick="simpan_ljk()">Simpan LJK</button>
    </td>
  </tr>
  <br class="ganjel">
</table>
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="5">No.</th>
      <th width="40">NOMOR PESERTA</th>
      <th width="50">KODE SOAL</th>
      <th width="100">JAWABAN</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $num=0;
  if(!is_null($LJK))
  { 

    foreach ($LJK as $key => $jwb) {
  
      echo "<tr";
      if(strlen(str_replace(' ','',$jwb['nomor_peserta'])) != '10')
      {
        echo " style='background-color:#CC3333;' ";
       
      };
      if(strlen(str_replace(' ','',$jwb['kode_soal'])) < '2')
      {
        echo " style='background-color:#FFFF99;' ";
       
      };
      if(strlen($jwb1['jawaban']) != $JML)
      {
        echo " style='background-color:#DDD;' ";
      }
      echo ">";
      echo "<td>";  
      echo $num+=1;
      echo "</td>";
       echo "<td>";
       echo "<font id='no1".$jwb['nomor_peserta']."'>".$jwb['nomor_peserta']."</font>";
       echo "</td>";
       echo "<td>";
       echo "<font id='ko1".$jwb['nomor_peserta']."'>".$jwb['kode_soal']."</font>"; 
          echo "</td>";
       echo "<td>";
       $j=str_split($jwb['jawaban']);
       $isi=0;
       $kosong=0;
       for ($i=0; $i < count($j); $i++) { 
         if($j[$i]==' ' || $j[$i]=='')
         {
          $kosong+=1;
         }
         else
         {
          $isi+=1;
         }
       }

       echo "DIJAWAB : ".$isi;
       echo "<br>";
       echo "KOSONG : ".$kosong;
       
      echo "</td>";
      echo "</tr>";
    }

  }

  ?>
  </tbody>
  
  </table>
  </div>
<script type="text/javascript">
function simpan_ljk () {
  
  $.ajax({
    url: "<?php echo base_url('adminpmb/input_data_c/simpan_ljk') ?>",
    type: "POST",
    data: $('#ljk-form').serialize(),
    success: function(ljk_simpan)
    {
      alert(ljk_simpan);
    }
  });
}
  </script>
