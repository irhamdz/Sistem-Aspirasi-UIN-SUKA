<div>
<h3 style="margin-bottom:10px;">Data Penawaran Prodi</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Jalur Masuk</th>
      <th>Nama Fakultas</th>
      <th>Program Studi</th>
      <th>Jenjang</th>
      <th>Jumlah Penawaran</th>
      <th>Proses</th>
    </tr>
  </thead>
  
  <tbody>
  <?php 
  $num=0; 
  
  if(!is_null($data_penawaran_prodi))
  {
  	foreach ($data_penawaran_prodi as $data_masuk) 
  		{ 
  	  echo "<tr>";
      echo "<td>";  echo $num+=1;                echo "</td>";
      echo "<td>";  echo $data_masuk->jalur_masuk;         echo "</td>";
      echo "<td>";  echo $data_masuk->nama_fakultas;         echo "</td>";  
       echo "<td>";  echo $data_masuk->nama_prodi;         echo "</td>";  
        echo "<td>";  echo $data_masuk->nama_jenjang;         echo "</td>";  
         echo "<td>";  echo $data_masuk->jumlah_penawaran;         echo "</td>";  
      ?>
      <td>  <button id="edit" class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_penawaran_jurusan; ?>"><i class="icon-edit icon-white"></i> Edit</button>
            <button id="hps_prodi<?php echo $num; ?>" value='<?php echo $num; ?>' onclick='hapus_prodi(this)' class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_penawaran_jurusan; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
      </td>
    </tr>

  <?php 
} 
}
else
{
 echo '<td colspan="7" align="center">DATA RUANG BELUM ADA.</td>      </tbody>';
}
  ?>

</table></div>
</div>
<script type="text/javascript">
  function hapus_prodi (hps_prod) {
    var kode_penawaran_jurusan=$('#'+hps_prod.id).attr('isi');

    $.ajax({
      url:"<?php echo base_url('adminpmb/input_data_c/delete_pend_prod'); ?>",
      type:"POST",
      data: "kode="+kode_penawaran_jurusan,
      success: function(prod_hap){
        alert(prod_hap);
      }
    });
  }
</script>