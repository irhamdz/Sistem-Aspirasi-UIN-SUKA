<script language="javascript">
$(function () 
{
    $("button").click(function() 
    {

      $("#tabel-jadwal").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
             
      id = $(this).attr('id');
      val = $(this).attr('isi');
   
    if(id == 'lihat')
    {
      
      $.ajax(
          {
            type: 'POST',
            url: "<?php echo base_url('adminpmb/input_data_c/select_detail_jadwal_ujian'); ?>",
            data: {'id': val},
          }).done(function(x)
            {
               document.getElementById("tabel-jadwal").innerHTML = x;
            });
    }
    

  });
});

function clickambil(id)
{
  alert("Maintenance");
}

</script>
<div class="result_data">
<h3 style="margin-bottom:10px;">Data Penawaran Anda</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Jalur</th>
      <th>Tanggal</th>
      <th>Tahun</th>
      <th>Gel.</th>
      <th>Minat</th>
      <th>Jadwal</th>

    </tr>
  </thead>
 
  <tbody>
  <?php 
  $num=0;
  if(!is_null($detail_penawaran_jalur))
  { 
  	foreach ($detail_penawaran_jalur as $data_masuk) 
  	{	 
	  echo "<tr>";
      echo "<td>";  echo $num+=1; 								echo "</td>";
      echo "<td>";  echo $data_masuk->jalur_masuk; 				echo "</td>";
      echo "<td>";  echo $data_masuk->tanggal_mulai_daftar.' s.d '.$data_masuk->tanggal_selesai_daftar; 	echo "</td>";
      echo "<td>";  echo $data_masuk->tahun; 					echo "</td>";
      echo "<td>";  echo $data_masuk->gelombang;          echo "</td>";
      echo "<td>";  echo $data_masuk->nama_minat;          echo "</td>";
       ?>
      <td>  <button id="lihat" class="badge badge-warning" isi="<?php echo $data_masuk->kode_jalur; ?>">cek</button>
      </td>
      </tr>
      <?php
    }
  }
   else 
    {
    	echo '<td colspan="6" align="center">DATA PENAWARAN JALUR BELUM ADA.</td>      </tbody>';
    }
    
  ?>
  </tbody>
</table>
</div>
<div id="tabel-jadwal">
</div>