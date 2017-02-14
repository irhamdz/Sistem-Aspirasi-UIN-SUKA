<script language="javascript">

</script>
<div>
<h3 style="margin-bottom:10px;">Data Ruangan</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Kode Prasyarat</th>
      <th>Nama Prasyarat</th>
      <th>Nilai Minimal</th>
      <th>Proses</th>
    </tr>
  </thead>
  
  <tbody>
  <?php 
  $num=0; 
  
  if(!is_null($prasyarat))
  {
  	foreach ($prasyarat as $data_masuk) 
  		{ 
  	  echo "<tr>";
      echo "<td>";  echo $num+=1;                echo "</td>";
      echo "<td>";  echo $data_masuk->kode_prasyarat;         echo "</td>";
      echo "<td>";  echo $data_masuk->nama_prasyarat;         echo "</td>";  
      echo "<td>";  echo "<font id='skor".$num."'>".$data_masuk->skor."</font>"; echo "<input type='text' style='display:none;' id='skoredit".$num."' class='form-control input-md' value='".$data_masuk->skor."'> ";  echo "</td>";
      ?>
      <td>   <button id="hps<?php echo $num; ?>" isi="<?php echo $data_masuk->kode_penawaran; ?>" class="btn btn-inverse btn-small aksi" onclick="hapus_prasyarat_jalur(this)" value="<?php echo $data_masuk->kode_prasyarat_jalur; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
      </td>
    </tr>

  <?php 
} 
}
else
{
 echo '<td colspan="5" align="center">DATA SYARAT BELUM ADA.</td>      </tbody>';
}
  ?>

</table></div>
</div>
<script type="text/javascript">
  function hapus_prasyarat_jalur (sar) {
    var kode_penawaran=$('#'+sar.id).attr('isi');
   $.ajax({
    url: "<?php echo base_url('adminpmb/input_data_c/hapus_prasyarat_jalur') ?>",
    type: "POST",
    data: "kode_prasyarat_jalur="+sar.value,
    success: function(oke)
    {
      alert(oke);
      change_penawaran(kode_penawaran);
    }
   });
  }
</script>