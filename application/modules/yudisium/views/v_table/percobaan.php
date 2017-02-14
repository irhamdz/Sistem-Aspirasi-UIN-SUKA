
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<link href="<?php echo base_url('asset/style_album_ujian_1.css'); ?>" rel="stylesheet" type="text/css"/><?php
$jml=0;
if(!is_null($data_mhs))
{
  $jml=count($data_mhs);
}

?>

<?php

if(!is_null($data_kelas))
{

  foreach ($data_kelas as $kls) 
  {
    ?>
      <table class="tabelpesertaborder" border="0" cellpadding="2" cellspacing="0" width="230px">
        <tr>
          <td style="width:30%;">
          	<br />
            <b>JALUR</b>
            <br/>
            <b>FAKULTAS</b>
            <br/>
            <b>PROGRAM STUDI</b>
            <br/>
            <b>KELAS</b>
          </td>
          <td style="width:70%;">
            <br />
            <b><?php if(!is_null($data_kelas)){ echo strtoupper($kls->jalur_masuk);?> GELOMBANG <?php echo substr($kls->kode_penawaran,2,1); ?> TAHUN <?php echo $kls->tahun; } ?></b>
            <br />
            <b><?php if(!is_null($data_kelas)) { echo strtoupper($kls->nama_fakultas); }?></b>
            <br />
            <b><?php if(!is_null($data_kelas)) { echo strtoupper($kls->nama_prodi); ?> JENJANG <?php echo strtoupper($kls->nama_jenjang); } ?></b>
            <br />
            <b><?php if(!is_null($data_kelas)) { echo strtoupper($kls->nama_kelas); }?> </b>
          </td>
        </tr>
        <tr>
          <td  align="center">
          <?php
        if(!is_null($data_mhs))
        {
          ?>
          <table class="tabelpesertaborder" border="0.5" cellpadding="2" cellspacing="0" width="220px">
          <tr>
              <td> 
                NO
              </td>
                  <td> 
                NO PMB
                </td>
                  <td> 
                NAMA
                </td>
                </tr>
      
          <?php
          $num=0;
          foreach ($data_mhs as $mhs) 
          {
            ?>
          
            <?php
            if($kls->id_kelas == $mhs->id_kelas && $mhs->id_prodi==$kls->id_prodi)
            {
              if(!is_null($data_lengkap_mhs))
              {
                foreach ($data_lengkap_mhs as $Lmhs) 
                {
                  if($mhs->nomor_pendaftar==$Lmhs->nomor_pendaftar)
                  {
                    ?>
                     <tr>
                     <td> 
                     <?php if(!is_null($data_mhs)) echo $num+=1; ?>
                     </td>  
                     <td>  
                     <b><?php if(!is_null($data_mhs)) echo $Lmhs->nomor_peserta; ?> </b>
                     </td>
                     <td>  
                     <?php if(!is_null($data_mhs)) echo $Lmhs->nama_lengkap; ?>
                     </td>
                     </tr>
                     <?php
                  } 
                }
              }
            }
            ?>
           
            <?php
          }
          ?>
          </table>
          <?php
        }
?>
   </td>
  </tr>
</table>
  <br />
  <br />
<?php
  }
}
  ?>