
<div>
<h3 style="margin-bottom:10px;">Nilai Portofolio</h3>
	<table class="table table-bordered">
  <thead>
  <tr>
    <td>
      NO
    </td>
    <td>
      NOMOR PESERTA
    </td>
    <td>
      KETERANGAN
    </td>
    <td width="250px">
      NILAI
    </td>
  </tr>
  </thead>
  <tbody>
    <?php
function umur($date)
{
  $from = new DateTime($date);
  $to   = new DateTime('today');
  return $from->diff($to)->y;
}    
    
if(!is_null($data_mhs))
{
  $num=0;
  foreach ($data_mhs as $mhs) {
   $num+=1;
              echo "<tr>";
              echo "<td>";
              echo $num;
              echo "</td>";
              echo "<td>";
              echo $mhs->nomor_peserta;

              echo "</td>";
              echo "<td>";
              echo "NAMA SEKOLAH/PT : ";
              echo $mhs->nama_pt;
              echo "<hr>";
              echo "AKREDITASI SEKOLAH/PT : ";
              echo $mhs->akreditasi;
              echo "<hr>";
              echo "UMUR : ";
              echo umur($mhs->tgl_lahir).' Tahun';
              echo "<hr>";
              echo "JENIS KELAMIN : ";
              echo $mhs->jenis_kelamin;
              echo "<hr>";
              echo "<button type='button' id='pres".$num."' value='".$mhs->nomor_pendaftar."' onclick='data_prestasi(this)'> Data Prestasi </button>";
              echo " <button type='button' id='kes".$num."' value='".$mhs->nomor_pendaftar."' onclick='data_kesehatan(this)'> Data Kesehatan </button>";
              echo " <button type='button' id='kel".$num."' value='".$mhs->nomor_pendaftar."' onclick='data_keluarga(this)' > Data Keluarga </button>";
              echo " <button type='button' id='prod".$num."' value='".$mhs->nomor_pendaftar."' onclick='data_pil_prod(this)'> Data Pilihan Prodi </button>";
              echo "<br>";
              echo "<br>";
              echo "<div id='pencarian".$mhs->nomor_pendaftar."' style='display:none;'></div>";
              echo "</td>";
              echo "<td>";
               $nilai_akhir=0;
               
              if(!is_null($data_nilai))
              {
               
                foreach ($data_nilai as $nil) {

                  if($nil->nomor_pendaftar==$mhs->nomor_pendaftar)
                  {
                     echo "<table width='250px'>";
                    echo "<tr>";
                    echo "<td>";
                    if($nil->jenis_sertifikat=='BING')
                      $nil->jenis_sertifikat='TOEFL';
                    echo "JENIS : ".str_replace('_',' ',$nil->jenis_sertifikat);
                    echo "<br>";
                    echo "NILAI :".$nil->nilai;
                    echo "<br>";
                    echo "BOBOT : ".$nil->bobot."%";
                    //echo "<br>";
                    //echo "NILAI DOKUMEN : <strong>".$nil->nilai_dokumen."</strong>";
                    //echo "<br>";
                    echo "<hr>";
                    echo "</td>";
                    echo "</tr>";
                    echo "</table>";
                    
                  }
                }
              }
            
              
              echo "</td>";
            echo "</tr>";
  }
}

    ?>
  </tbody>
</table></div>
</div>
<script type="text/javascript">
  function data_prestasi(pres)
  {
    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/data_prestasi'); ?>",
      type: "POST",
      data: "nomor_pendaftar="+pres.value,
      success: function (prestasi)
      {
        
        $('#pencarian'+pres.value).html(prestasi);
        $('#pencarian'+pres.value).slideDown('slow');

      }
    });

  }
  function data_kesehatan(kes)
  {
    $.ajax({
    	url: "<?php echo base_url('adminpmb/input_data_c/cari_data_kesehatan') ?>",
    	type: "POST",
    	data: "nomor_pendaftar="+kes.value,
    	success: function(kesehatan)
    	{
    		$('#pencarian'+kes.value).html(kesehatan);
        	$('#pencarian'+kes.value).slideDown('slow');
    	}
    });
  }
  function data_keluarga(kel)
  {
    $.ajax({
    	url: "<?php echo base_url('adminpmb/input_data_c/cari_data_keluarga') ?>",
    	type: "POST",
    	data: "nomor_pendaftar="+kel.value,
    	success: function(keluarga)
    	{
    		$('#pencarian'+kel.value).html(keluarga);
        	$('#pencarian'+kel.value).slideDown('slow');
    	}
    });
  }
  function data_pil_prod(prod)
  {
    $.ajax({
    	url: "<?php echo base_url('adminpmb/input_data_c/cari_pil_prod') ?>",
    	type: "POST",
    	data: "nomor_pendaftar="+prod.value,
    	success: function(prodi)
    	{
    		$('#pencarian'+prod.value).html(prodi);
        	$('#pencarian'+prod.value).slideDown('slow');
    	}
    });
  }
</script>