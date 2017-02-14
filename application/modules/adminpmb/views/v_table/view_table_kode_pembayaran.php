<script language="javascript">

function edit_bayar(thisedit)
{
      var nomor=$('#'+thisedit.id).attr('value');
      $('#nama'+nomor).show();
      $('#kode2'+nomor).show();
      $('#kd'+nomor).hide();
      $('#nm'+nomor).hide();
      $('#up'+nomor).show();
      $('#edit'+nomor).hide();
      $('#hps'+nomor).hide();
      $('#up'+nomor).show();
      

}

function hapus_bayar(thishps)
{
  var val=$('#'+thishps.id).attr('isi');
    var r = confirm("Apakah Anda yakin akan menghapus Kode Pembayaran?");
      if (r)
      {
        $("#tbl-kode-pembayaran").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');

        $.ajax(
        {
          type: 'post',
          url: "<?php echo base_url('adminpmb/input_data_c/delete_kode_pembayaran'); ?>",
          data: "id="+val,
          success: function()
          {
            $("#tbl-kode-pembayaran").load("<?php echo base_url('adminpmb/input_data_c/after_tranc_kode_pembayaran'); ?>");
          }
        });
      }
}

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
      echo "<td>";  echo "<font id='nm".$num."'>".$data_masuk->nama_pembayaran."</font>";  echo "<input type='text' id='nama".$num."' style='display:none;' class='form-control input-md' onchange='set_nama(this.value)' name='nama_pembayaran' value='".$data_masuk->nama_pembayaran."'>";       echo "</td>";  
      echo "<td>";  echo "<font id='kd".$num."'>".$data_masuk->kode_bayar."</font>";;      echo "<input type='text' id='kode2".$num."' style='display:none;' class='form-control input-md' name='kode_bayar' onchange='set_new(this.value)' value='".$data_masuk->kode_bayar."'";    echo "</td>";
       ?>
      <td>  <button id="edit<?php echo $num; ?>" onclick="edit_bayar(this)" class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_bayar; ?>" value='<?php echo $num; ?>'><i class="icon-edit icon-white"></i> Edit</button>
            <button id="hps<?php echo $num; ?>" onclick="hapus_bayar(this)" class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_bayar; ?>" value='<?php echo $num; ?>'><i class="icon-trash icon-white"></i> Hapus</button>
            <button style="display:none;" class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_bayar; ?>" id="up<?php echo $num; ?>" nomor='<?php echo $num; ?>' onclick="update_bayar(this)">Simpan</button>
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
<script type="text/javascript">
var kode2='';
 var nama='';
function set_new(kn)
{
  kode2=kn;
}

function set_nama(n)
{
  nama=n;
}

  function update_bayar(upd)
  {
    var noe=$('#'+upd.id).attr('nomor');
    var kode=$('#'+upd.id).attr('isi');
    var nama2=$('#nama'+noe).attr('value');
    
    if(kode2==''){kode2=kode;}
    if(nama==''){nama=nama2;}

  //$("#tbl-kode-pembayaran").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');

   
     $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/update_bayar'); ?>",
      type: "POST",
      data: "kode_bayar2="+kode2+"&kode_bayar1="+kode+"&nama_pembayaran="+nama,
      success: function(upbayar)
      {
        
        $("#tbl-kode-pembayaran").html(upbayar);
     

      }
    });


}



</script>