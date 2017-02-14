<script language="javascript">

</script>

<h3 style="margin-bottom:10px;">Data Peserta PMB DIFABLE.</h3>
<br id="ganjel">
<br class="ganjel">

<div class="search-table-outter wrapper">
	<table class="table table-bordered table-hover search-table inner" id="tab">
  <thead>
    <tr>
      <th valign="top" width="5">No.</th>
      <th valign="top" width="25">KONDISI KESEHATAN</th>
      <th valign="top" width="25">JUMLAH</th>
      <th valign="top" width="25">#</th>
    </tr>
  </thead>
  <?php

   
  $num=0;
  $jml=0;
  if(!is_null($data_mhs))
  {
    foreach ($data_mhs as $mhs) {
      $jml+=$mhs->jumlah;
      echo "<tr>";
      echo "<td>";  
      echo $num+=1;
      echo "</td>";
      echo "<td>";
      echo "<strong>".$mhs->kondisi_kesehatan."</strong>";
      echo "</td>";
      echo "<td>";
      echo "<strong>".$mhs->jumlah."</strong>";
      echo "</td>";
      echo "<td>";
      echo "<button type='button' class='btn btn-inverse btn-small' value='".$mhs->id_kesehatan."' onclick='lihat_mhs_dif(this.value)'> Lihat</button>";
      echo "</td>";
      echo "<tr>";
    }
    echo "<tr>";
    echo "<td align='right' colspan='2'>";
    echo "<strong>TOTAL</strong>";
    echo "</td>";
    echo "<td colspan='2'>";
    echo $jml;
    echo "</td>";
    echo "</tr>";
  }
  ?>
  <tbody>
  
  </table>
  </div>
  <table class="table table-bordered" id="mhs_dif" style="display:none;"></table>
  </div>
<script type="text/javascript">
function  lihat_mhs_dif(idk) {
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#th').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
  $.ajax({
    url: "<?php echo base_url('adminpmb/input_data_c/lihat_mhs_dif'); ?>",
    type: "POST",
    data: "id_kesehatan="+idk+"&kode_penawaran="+kode_penawaran,
    success: function(dk)
    {
      $('#mhs_dif').html(dk);
      $('#mhs_dif').slideDown('slow'); 
    }
  });
}
  </script>
