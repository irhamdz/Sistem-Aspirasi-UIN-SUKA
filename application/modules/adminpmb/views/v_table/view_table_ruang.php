<script language="javascript">
$(function () {
    $("button").click(function() {
    
    
    id = $(this).attr('id');
    val = $(this).attr('isi');
    no=$(this).val();

    if(id == 'hps')
    {
      var r = confirm("Apakah Anda yakin akan menghapus data ruang?");
      if (r)
      {
      $("#table-ruang").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
    
      $.ajax({
      type: 'post',
      url: "<?php echo base_url('adminpmb/input_data_c/delete_ruang'); ?>",
      data: {'id': val},
      }).done(function(x) { 
        $('#table-ruang').load("<?php echo base_url('adminpmb/input_data_c/after_tranc_ruang'); ?>");
      });
      }
      else
      {
        
      }
    }
    else if(id == 'edit')
    {
      $('#awal'+no).hide();
      $('#nru'+no).hide();
      $('#valru'+no).slideDown('slow');
      $('#edit'+no).slideDown('slow');

    }
   
  });
});

</script>
<div>
<h3 style="margin-bottom:10px;">Data Ruangan</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Gedung</th>
      <th>Kode Ruang</th>
      <th>Nama Ruang</th>
      <th>Status Ruang</th>
      <th width="200">Proses</th>
    </tr>
  </thead>
  
  <tbody>
  <?php 
  $num=0; 
  
  if(!is_null($data_ruang))
  {
  	foreach ($data_ruang as $data_masuk) 
  		{ 
  	  echo "<tr>";
      echo "<td>";  echo $num+=1;                echo "</td>";
      echo "<td>";  echo $data_masuk->nama_gedung;         echo "</td>";
      echo "<td>";  echo $data_masuk->id_ruang;         echo "</td>";
      echo "<td>";  
      echo "<font id='nru".$num."'>".$data_masuk->nama_ruang."</font>";         
      echo "<input class='form-control tm2' width='100px' type='text' style='display:none;' id='valru".$num."' value='".$data_masuk->nama_ruang."'>";
      echo "</td>";  
      echo "<td>"; 
      ?>
      <select name="status" class='form-control tm2' id="status<?php echo $num; ?>">
      <option value="0" <?php if($data_masuk->status_ruang=='0'){ echo " selected "; } ?> >Tidak Tersedia</option>
      <option value="1" <?php if($data_masuk->status_ruang=='1'){ echo " selected "; } ?> >Tersedia</option>
      
      </select>
      </td>
      <td id="awal<?php echo $num; ?>">  <button id="edit" class="btn btn-inverse btn-small aksi" value="<?php echo $num; ?>" isi="<?php echo $data_masuk->id_ruang; ?>"><i class="icon-edit icon-white"></i> Edit</button>
            <button id="hps" class="btn btn-inverse btn-small aksi" value="<?php echo $num; ?>" isi="<?php echo $data_masuk->id_ruang; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
      </td>
      <td style='display:none;' id="edit<?php echo $num; ?>">  
      <button id="smpn<?php echo $num; ?>"  class="btn btn-inverse btn-small aksi" value="<?php echo $num; ?>" isi="<?php echo $data_masuk->id_ruang; ?>" onclick='update_ruang(this)'> Simpan</button>
      <button id="btl<?php echo $num; ?>"  class="btn btn-inverse btn-small aksi" value="<?php echo $num; ?>" isi="<?php echo $data_masuk->id_ruang; ?>" onclick='btl_ruang(this)'> Batal</button>
  
      </td>
    </tr>

  <?php 
} 
}
else
{
 echo '<td colspan="5" align="center">DATA RUANG BELUM ADA.</td>      </tbody>';
}
  ?>

</table></div>
</div>
<script type="text/javascript">
  function update_ruang(ur)
  {
    var id_ruang=$('#'+ur.id).attr('isi');
   var no=ur.value;
    var nama_ruang=$('#valru'+no).val();
    var status=$('#status'+no).val();

    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/update_ruang') ?>",
      type: "POST",
      data: "id_ruang="+id_ruang+"&nama_ruang="+nama_ruang+"&status="+status,
      success: function(uri)
      {
        $('#table-ruang').html(uri);
      }

    });

  }

  function btl_ruang(bt)
  {
    var no=bt.value;
          $('#valru'+no).hide();
      $('#edit'+no).hide();
      $('#awal'+no).slideDown('slow');
      $('#nru'+no).slideDown('slow');
  }
</script>