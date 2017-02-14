<script language="javascript">
$(function () {
    $("button").click(function() {
    
      
    id = $(this).attr('id');
    val = $(this).attr('isi');
   
    if(id == 'hps')
    {
      var r = confirm("Apakah Anda yakin akan menghapus Kode Pembayaran?");
      if (r)
      {
      $("#tbl-kode-pembayaran").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');

        $.ajax({
      type: 'post',
      url: "<?php echo base_url('adminpmb/input_data_c/delete_kode_pembayaran'); ?>",
      data: {'id': val},
      }).done(function(x) {
       $("#tbl-kode-pembayaran").load("<?php echo base_url('adminpmb/input_data_c/after_tranc_kode_pembayaran'); ?>");
      });
      }
      else
      {
        
      }
    }
    else if(id == 'edit')
    {
      
    }
   
  });
});

</script>
<div>
<h3 style="margin-bottom:10px;">Data Kode Pembayaran</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Jalur PMB</th>
      <th>Kode Bayar</th>
      <th>Proses</th>
    </tr>
  </thead>
  
  <tbody>
  <?php 
  $num=0; 
  
  if(!is_null($data_kode_pembayaran))
  {
  	foreach ($data_kode_pembayaran as $data_masuk) 
  		{ 
  	  echo "<tr>";
      echo "<td>";  echo $num+=1;                echo "</td>";
      echo "<td>";  echo $data_masuk->nama_pembayaran;         echo "</td>";  
      echo "<td>";  echo $data_masuk->kode_bayar;         echo "</td>";
      ?>
      <td>  <button id="edit" class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_bayar; ?>"><i class="icon-edit icon-white"></i> Edit</button>
            <button id="hps" class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_bayar; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
      </td>
    </tr>

  <?php 
    } 
}
else
{
 echo '<td colspan="5" align="center">DATA KODE PEMBAYARAN BELUM ADA.</td>      </tbody>';
}
  ?>

</table></div>
</div>