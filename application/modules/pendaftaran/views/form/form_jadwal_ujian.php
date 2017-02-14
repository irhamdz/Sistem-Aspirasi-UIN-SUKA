<?php
foreach ($ambil_jadwal as $data_maba);
 $jadwalku=$data_maba->kode_jadwal;
?>
<br id="ganjel">
<div class="system-content-sia">
<div class="bs-callout bs-callout-info">Pilih jadwal ujian anda dengan mengklik tombol Pilih.</div> 
<div class="bs-callout bs-callout-warning">Batalkan jadwal dahulu untuk memilih ulang.</div> 
<table class="table table-bordered">
  <thead>
   <tr>
      <td colspan='8'><br /><strong>Data Jadwal Ujian</strong><br /></td>
    </tr>
    <tr>
      <th>No.</th>
      <th>Hari</th>
      <th>Tanggal</th>
      <th>Lokasi</th>
      <th>Jam Mulai</th>
      <th>Jam Selesai</th>
      <th>Jalur Masuk</th>
      <th>Proses</th>
    </tr>
  </thead>
  <input type="hidden" value="<?php echo $nomor_pendaftar; ?>" id='pendaftar' name='nomor_pendaftar' >
  <input type="hidden" value="<?php echo $kode_jalur; ?>" id='jalur' name='kode_jalur' >
  <tbody>
<?php 
	$num=0; 
  if(!is_null($data_jadwal))
  {
  	foreach ($data_jadwal as $data_masuk) 
  	{ 
      echo "<tr>";
      echo "<td><div class='col-xs-7'>";  echo $num+=1;                 echo "</div></td>";
      echo "<td><div class='col-xs-7'>";  echo $data_masuk->hari;         echo "</div></td>";
      echo "<td><div class='col-xs-7'>";  echo $data_masuk->tanggal_ujian;        echo "</div></td>";
       echo "<td><div class='col-xs-7'>";  echo $data_masuk->lokasi_ujian;        echo "</div></td>";
      echo "<td><div class='col-xs-7'>";  echo $data_masuk->jam_mulai_ujian;   echo "</div></td>";
      echo "<td><div class='col-xs-7'>";  echo $data_masuk->jam_selesai_ujian;   echo "</div></td>";
      echo "<td><div class='col-xs-7'>";  echo $data_masuk->jalur_masuk;   echo "</div></td>";
      
      if((!is_null($jadwalku)) && ($jadwalku==$data_masuk->kode_jadwal))
      {
      
      echo " <td><div class='col-xs-7'><button id='pilbatal' onclick='batal_jadwal()' class='btn btn-inverse btn-small aksi'><i class='icon-check icon-white'></i> Batal</button></div></td>";
  	 }
     if( (!is_null($jadwalku)) && $jadwalku!=$data_masuk->kode_jadwal)
      {
      
      echo " <td><div class='col-xs-7'></div></td>";
     }
     else if(is_null($jadwalku))
     {
    
       echo " <td><div class='col-xs-7'><button id='pilambil' onclick='pilih_jadwal(".$data_masuk->kode_jadwal.")' class='btn btn-inverse btn-small aksi'><i class='icon-check icon-white'></i> Pilih</button></div></td>";
      
     }
    }
  }
  else
  {
 	echo '<td colspan="8" align="center">DATA JADWAL UNTUK PERIODE INI BELUM ADA.</td>      </tbody>';
  }
 ?>
</table>
</div>
<script type="text/javascript">
   
    var nomor=$('#pendaftar').attr('value');
    var jalur=$('#jalur').attr('value');
   

  function pilih_jadwal (isi1) {
    $.ajax(
          {
            url   : "<?php echo base_url('pendaftaran/form_control/update_pilih_jadwal'); ?>",
            type  : "POST",            
            data: "nomor_pendaftar="+nomor+"&kode_jadwal="+isi1,
            success: function(x)
            {
              
              $('#slide-form').load("<?php echo base_url('pendaftaran/form_control/form_jadwal_ujian/"+nomor+"/"+jalur+"'); ?>");
          
            }

          });

  }

  function batal_jadwal()
  {
   
    $.ajax(
          {
            url   : "<?php echo base_url('pendaftaran/form_control/batal_pilih_jadwal'); ?>",
            type  : "POST",            
            data: "nomor_pendaftar="+nomor,
            success: function(w)
            {

              $('#slide-form').load("<?php echo base_url('pendaftaran/form_control/form_jadwal_ujian/"+nomor+"/"+jalur+"'); ?>");
          
            }

          });
  }
</script>