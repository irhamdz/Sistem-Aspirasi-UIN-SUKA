<script language="javascript">
$(function () {
    $("button").click(function() {
    
      

    id = $(this).attr('id');
    val = $(this).attr('isi');
   
    if(id == 'hpsjadwal')
    {
      var r = confirm("Apakah Anda yakin akan menghapus data jadwal ujian?");
      if (r)
      {
      $("#tbl-jadwal-ujian").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');

        $.ajax({
      type: 'post',
      url: "<?php echo base_url('adminpmb/input_data_c/delete_jadwal_ujian'); ?>",
      data: {'id': val},
      }).done(function(x) {
        $("#tbl-jadwal-ujian").load("<?php echo base_url('adminpmb/input_data_c/after_tranc_jadwal_ujian'); ?>");
      });
      }
      else
      {
        
      }
    }
   
  });
});

</script>
<style>
  .search-table{table-layout: fixed;}

.search-table-outter { overflow-x: scroll;margin-bottom: 20px;}
th, td {}
  #tab {
  width:830px;margin-bottom: 20px;
}
</style>
<div>
<h3 style="margin-bottom:10px;">Data Jadwal Ujian</h3>
<!--
Keterangan :
<br>
<table class="table table-bordered" style="width:250px;">
   <tr >
    <td style="background-color:#DC143C;" width="30px" height="30px">
      
    </td>
    <td>
       Jadwal ujian tidak aktif / telah lewat
    </td>
  </tr>
</table>
-->
<br>
<div class="search-table-outter wrapper">
  <table class="table table-bordered table-hover search-table inner" id="tab">
  <thead>
    <tr>
      <th valign="top" width="1">No.</th>
      <th valign="top" width="50">Proses</th>
      <th valign="top" width="40">Lokasi Ujian</th>
      <th valign="top" width="30">Jalur Masuk</th>
      <th valign="top" width="10">Gel.</th>
      <th valign="top" width="40">Tanggal Ujian</th>
      <th valign="top" width="20">Kuota</th>
      <th valign="top" width="40">Status</th>
      
    </tr>
  </thead>
  
  <tbody>
<?php 
 
 function tanggal_hari($tanggal){
  $tgl=explode("-",$tanggal);
  $info=date('w', mktime(0,0,0,$tgl[1],$tgl[0],$tgl[2]));
  switch($tgl[1]){
      case '01': $bulan= "Januari"; break;
      case '02': $bulan= "Februari"; break;
      case '03': $bulan= "Maret"; break;
      case '04': $bulan= "April"; break;
      case '05': $bulan= "Mei"; break;
      case '06': $bulan= "Juni"; break;
      case '07': $bulan= "Juli"; break;
      case '08': $bulan= "Agustus"; break;
      case '09': $bulan= "September"; break;
      case '10': $bulan= "Oktober"; break;
      case '11': $bulan= "Nopember"; break;
      case '12': $bulan= "Desember"; break;
    };
    switch($info){
      case '0': $hari= "Minggu"; break;
      case '1': $hari= "Senin"; break;
      case '2': $hari= "Selasa"; break;
      case '3': $hari= "Rabu"; break;
      case '4': $hari= "Kamis"; break;
      case '5': $hari= "Jumat"; break;
      case '6': $hari= "Sabtu"; break;
    };
  $tampil_tanggal=$hari.", ".$tgl[0]." ".$bulan." ".$tgl[2];
  return $tampil_tanggal;
}
	$num=0; 
  if(!is_null($data_jadwal))
  {
  	foreach ($data_jadwal as $data_masuk) 
  	{ 
      $num+=1;
      $warna="";
      if(!is_null($detail_jadwal))
      {
        foreach ($detail_jadwal as $dj) 
        {
          
         if($data_masuk->kode_jadwal==$dj->kode_jadwal)
         {
          switch (get_hari(date_format(date_create($dj->tanggal),'Y-m-d'))) {
            case '0':
              $warna="#DC143C";
              break;
            default :
              $warna="#FFF";
              break;
          }
             } 
        
        }
      }
      echo "<tr>";// style='background-color:".$warna."'>";
      echo "<td>";  echo $num; 
      echo "</td>";
       echo " <td><button id='edit".$num."' value='".$data_masuk->kode_jalur."' no='".$num."' onclick='edit_jadwal(this)' class='btn btn-inverse btn-small aksi' isi='".$data_masuk->kode_jadwal."'><i class='icon-search icon-white'></i> Detil</button>";
       echo " <button id='hpsjadwal' class='btn btn-inverse btn-small aksi' isi='".$data_masuk->kode_jadwal."'><i class='icon-trash icon-white'></i> Hapus</button>  </td>";
      echo "<td>";  echo $data_masuk->lokasi_ujian;   echo "</td>";
      echo "<td>";  echo $data_masuk->jalur_masuk;   echo "</td>";
       echo "<td>";  echo $data_masuk->gelombang;  echo "</td>";
     	echo "<td>";  
     	if(!empty($data_masuk->tanggal))
     	{
     	echo tanggal_hari(date_format(date_create($data_masuk->tanggal),'d-m-Y'));  
     }
     	echo "</td>";
      echo "<td>";  echo "<font id='kuota".$num."'>".$data_masuk->kuota_jadwal."</font>";
      echo "<input type='text' style='display:none;' class='form-control' id='kuota2".$num."' value='".$data_masuk->kuota_jadwal."'>"; 
      //  echo "<button type='button' id='btn_kuota".$num."' no='".$num."' value='".$data_masuk->kode_jadwal."' onclick='edit_kuota(this)' class='btn btn-inverse aksi'> Kuota</button>";
       // echo "<button type='button' style='display:none;' id='btl_kuota".$num."' no='".$num."' value='".$num."' onclick='batal(this)' class='btn btn-inverse aksi'> Batal</button>";
      
      echo "</td>";
     
      echo "<td>";  
      echo "<select id='".$data_masuk->kode_jadwal."' onchange='update_status_jadwal(this)' class='form-control input-md'>";
      echo "<option "; if($data_masuk->status=='1'){echo " selected ";} echo " value='1'>Aktif</option>";
      echo "<option "; if($data_masuk->status=='0'){echo " selected ";} echo "value='0'>Tidak Aktif</option>";
      echo "</select>";
      echo "</td>";
      echo "<input type='hidden' id='nomor".$num."' value='".$data_masuk->jalur_masuk." Gelombang ".$data_masuk->gelombang."'>";
    }
  }
  else
  {
 	echo '<td colspan="8" align="center">DATA JADWAL UNTUK PERIODE INI BELUM ADA.</td>      </tbody>';
  }
 ?>

</table>
  </div>
  <a name="fokus"></a></div>
</div>

<script type="text/javascript">
var nama;
function nama_jal(nm)
{
  nama=nm;
  return nama_jalur=nm;
}
  function edit_jadwal(jdwl)
  {
    
    var no=$('#'+jdwl.id).attr('no');
    var nama_jalur=nama_jal($('#nomor'+no).attr('value'));
    var kode_jadwal=$('#'+jdwl.id).attr('isi');
    var kode_jalur=$('#'+jdwl.id).attr('value');
 
    $('#tbh-dtl').slideDown('slow');
    $('#bla').attr('value',kode_jadwal);

    $.ajax({
              url : "<?php echo base_url('adminpmb/input_data_c/lihat_detail_jadwal') ?>",
              type: "POST",
              data: "kode_jadwal="+kode_jadwal+"&nama_jalur="+nama_jalur,
              success: function(det_jadwal){
                $('#tbl-detil').html(det_jadwal);
              }

    });
    alert("Edit detail jadwal "+nama_jalur+" diatas tabel.");
  }

  function update_status_jadwal(stj)
  {
    var x=confirm("Apakah anda yakin akan mengubah status jadwal?");
    if(x)
    {
      $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/update_status_jadwal'); ?>",
      data: "status="+stj.value+"&kode_jadwal="+stj.id,
      type: "POST",
      success: function(okj)
      {
        alert(okj);
      }
      });
    }
  }

  function edit_kuota(th)
  {

    var no=$('#'+th.id).attr('no');
    $('#btl_kuota'+no).slideDown('slow');
    $('#kuota'+no).hide();
    $('#kuota2'+no).slideDown('slow');
  
  }

</script>