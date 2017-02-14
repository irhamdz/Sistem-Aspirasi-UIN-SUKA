<div class='bs-callout bs-callout-info'>Untuk merubah status ruang ujian cukup dengan mengganti pada kolom Status Ruang Ujian <b>TANPA KLIK SIMPAN</b><br>
Untuk mereset kapasistas ruang dan nomor peserta silakan isi sesuai ketentuan dan <b>KLIK TOMBOL SIMPAN</b>
</div>
<?php  
  $arr_no=array();
  $var=0;
 if(!is_null($data_ruang_ujian))
  {
    
    foreach ($data_ruang_ujian as $k => $d) 
      { 
      array_push($arr_no, array('before'=>$d->no_ujian_akhir,'after'=>$d->no_ujian_awal));
          
      }
  }

?>
<script language="javascript">
$(function () {
    $("button").click(function() {
    
    id = $(this).attr('id');
    val = $(this).attr('isi');
   
    if(id == 'hps')
    {
      var r = confirm("Apakah Anda yakin akan menghapus data ruang ujian?");
      if (r)
      {
        var jalur=$(this).val();
        var kode_jadwal=$(this).attr('jd');
      $("#table-ruang-ujian").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
    
        $.ajax({
      type: 'post',
      url: "<?php echo base_url('adminpmb/input_data_c/delete_ruang_ujian'); ?>",
      data: "id="+val+"&kode_jalur="+jalur+"&kode_jadwal="+kode_jadwal,
      }).done(function(x) { 
        $('#table-ruang-ujian').html(x)
      });

      }
      else //cancel delete
      {
        
      }
    }
    else if(id == 'edit')
    {
      
    }
   
  });
});

</script>
<style>
  .search-table{table-layout: fixed;}

.search-table-outter { overflow-x: scroll;margin-bottom: 20px;}
th, td {}
  #tab {
  width:1200px;margin-bottom: 20px;
}
</style>
<div class="search-table-outter wrapper">
  <table class="table table-bordered table-hover search-table inner" id="tab">
      <thead>
      <tr>
        <th width="50" valign="top">No.</th>
        <th valign="top">Nama Gedung</th>
        <th valign="top">Nama Ruang</th>
        <th valign="top">Kapasitas Ruang</th>
        <th width="70" valign="top">Terisi</th>
        <th valign="top">No Ujian Awal/Akhir</th>
        <th valign="top">Jalur Masuk</th>
        <th valign="top">Jenis Ruang</th>
        <th valign="top">Status Ruang Ujian</th>
        <th valign="top" width="170">Proses</th>
      </tr>
      </thead>
  
  <tbody>
  <?php 
  $num=0; 
  $temp1=0;
  $temp2=0;
  if(!is_null($data_ruang_ujian))
  {
  	foreach ($data_ruang_ujian as $key => $data_masuk) 
  		{ 
          $temp1=$key;
          $temp2=$key;
          echo "<tr>";
          echo "<td>";  echo $num+=1;                echo "</td>";
          echo "<td>";  echo $data_masuk->nama_gedung;         echo "</td>";
          echo "<td>";  echo $data_masuk->nama_ruang;         echo "</td>"; 
          echo "<td>";  echo "<font id='kap".$num."'>".$data_masuk->kapasitas_ruang."</font>";  
          
          echo "<input type='text' style='display:none;' class='form-control input-md' before='"; 
          $temp1-=1;
          if(array_key_exists($temp1, $arr_no))
          {
            echo $arr_no[$temp1]['before'];
          }
          else
          {
            echo "0";
          }
       
          echo "' "; echo " next='";
          $temp2+=1;
          if(array_key_exists($temp2, $arr_no))
          {
            echo $arr_no[$temp2]['after'];
          }
          else
          {
            echo "0";
          }
        
          echo "' isi='".$num."' terisi='".$data_masuk->sisa."' kapas_awal='".$data_masuk->kapasitas_ruang."' onkeyup='isi_kapas(this)' id='kapasitas".$num."' value='".$data_masuk->kapasitas_ruang."'>";
          
          echo "</td>";
          echo "<td>";  echo $data_masuk->sisa;         echo "</td>";
          echo "<td>";  echo "<font id='akhir".$num."'>".$data_masuk->no_ujian_awal.' s.d '.$data_masuk->no_ujian_akhir."</font>"; 
          
          echo "<input type='text' style='display:none;' readonly='' class='form-control input-md' id='awal1".$num."' value='".$data_masuk->no_ujian_awal."'>";
          echo "<input type='text' style='display:none;' readonly='' class='form-control input-md' id='awal2".$num."' value='".$data_masuk->no_ujian_akhir."'>";
          
          echo "</td>";
          echo "<td>";  echo $data_masuk->jalur_masuk;         echo "</td>";
          echo "<input type='hidden' class='form-control input-md' id='max".$num."' value='".$data_masuk->no_ujian_akhir."'>";
          
          echo "<td>";  echo "<font id='editjenis1".$num."'>".get_jenis_ruang($data_masuk->khusus)."</font>";         
          echo "<input type='hidden' id='penawaran".$num."' value='".$data_masuk->kode_penawaran."'>";
           echo "<select style='display:none;' class='form-control input-md' id='editjenis2".$num."'>";
          echo "<option "; if($data_masuk->khusus=='0'){echo " selected ";} echo " value='0'>Umum</option>";
          echo "<option "; if($data_masuk->khusus=='1'){echo " selected ";} echo " value='1'>Khusus</option>";
          echo "</select>";
          echo "</td>";
          echo "<td>";  if($data_masuk->status_ruang_ujian=='1')
                        {
                          echo "<font id='aktif".$num."'>Aktif</font>";
                        }
                        else
                        {
                          echo "<font id='aktif".$num."'>Tidak aktif</font>";
                        }
          echo "<select style='display:none;' class='form-control input-md' ruang='".$data_masuk->id_ruang."' jalur='".$data_masuk->kode_jalur."' jadwal='".$data_masuk->kode_jadwal."' nomor='".$num."' id='editstatusx".$num."' onchange='update_status_ruang(this)'>";
          echo "<option "; if($data_masuk->status_ruang_ujian=='1'){echo " selected ";} echo " value='1'>Aktif</option>";
          echo "<option "; if($data_masuk->status_ruang_ujian=='0'){echo " selected ";} echo " value='0'>Tidak aktif</option>";
          echo "</select>";
          echo "</td>";
         
      ?>
      
      <td id="btn-aksi<?php echo $num; ?>">  <button id="edit<?php echo $num; ?>" class="btn btn-inverse btn-small aksi" isi='<?php echo $num; ?>' onclick='edit_ruang(this)'><i class="icon-edit icon-white"></i> Edit</button>
            <button id="hps" class="btn btn-inverse btn-small aksi" value="<?php echo $data_masuk->kode_jalur; ?>" jd="<?php echo $data_masuk->kode_jadwal; ?>" isi="<?php echo $data_masuk->id_ruang; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
      </td>
      <td style="display:none" id="btn-edit<?php echo $num; ?>">

      <button class="btn btn-inverse btn-small aksi" id="<?php echo $num; ?>" type="button" onclick="batal_ru(this.id)"> Batal</button>
      <button class="btn btn-inverse btn-small aksi" id="simpan<?php echo $num; ?>" nomor='<?php echo $num; ?>' ruang="<?php echo $data_masuk->id_ruang?>" jalur="<?php echo $data_masuk->kode_jalur?>" jadwal="<?php echo $data_masuk->kode_jadwal; ?>" type="button" onclick="simpan_ru(this)"> Simpan</button>
    
      </td>
    </tr>

  <?php 
} 
}
else
{
 echo '<td colspan="9" align="center">DATA RUANG BELUM ADA.</td>      </tbody>';
}

  ?>

</table>
 </div>
  <a name="fokus"></a>
</div>
<script type="text/javascript">
  function edit_ruang(edru)
  {
    var no=$('#'+edru.id).attr('isi');
  $('#btn-aksi'+no).hide();
  $('#editstatusx'+no).slideDown('slow');
  $('#aktif'+no).hide();
  $('#btn-edit'+no).show();
  $('#editjenis1'+no).hide();
  $('#kap'+no).hide();
  $('#akhir'+no).hide();
  $('#editjenis2'+no).slideDown('slow');
  $('#kapasitas'+no).slideDown('slow');
  $('#awal1'+no).slideDown('slow');
  $('#awal2'+no).slideDown('slow');
  }

  function batal_ru(no)
  {
    
    $('#editjenis2'+no).hide();
    $('#editjenis1'+no).slideDown('slow');
    $('#editstatusx'+no).hide();
    $('#btn-edit'+no).hide();
    $('#aktif'+no).slideDown('slow');
    $('#kap'+no).slideDown('slow');
    $('#btn-aksi'+no).slideDown('slow');
    $('#kapasitas'+no).hide();
    $('#awal1'+no).hide();
    $('#awal2'+no).hide();
    $('#akhir'+no).slideDown('slow');
  }

  function simpan_ru(simru)
  {
    $("#pesan").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
    $('#pesan').show();
    var nomer=$('#'+simru.id).attr('nomor'); 
    var statusru=$('#editstatusx'+nomer).val();
    var ruang=$('#'+simru.id).attr('ruang');
    var jadwal=$('#'+simru.id).attr('jadwal');
    var jalur=$('#'+simru.id).attr('jalur');
    var jenis=$('#editjenis2'+nomer).val();
    var kapas=$('#kapasitas'+nomer).val();
    var awal=$('#awal1'+nomer).val();
    var akhir=$('#awal2'+nomer).val();
    var kode_penawaran=$('#penawaran'+nomer).val();
    var tahun=$('#tahun').val();
    var gel=$('#gelombang').val();


   $.ajax({
    url   : "<?php echo base_url('adminpmb/input_data_c/update_status_ruang_ujian'); ?>",
    type  : "POST",            
    data    : "tahun="+tahun+"&gelombang="+gel+"&kapasitas="+kapas+"&awal="+awal+"&akhir="+akhir+"&kode_penawaran="+kode_penawaran+"&id_ruang="+ruang+"&kode_jadwal="+jadwal+"&kode_jalur="+jalur+"&status="+statusru+"&jenis="+jenis,
    success: function(newtab){
      $('#pesan').hide();
      $('#table-ruang-ujian').html(newtab); 
      
    }
  });


  }


function update_status_ruang(simru)
{
  $("#pesan").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
    $('#pesan').show();
   
  var nomer=$('#'+simru.id).attr('nomor'); 
    var statusru=$('#editstatusx'+nomer).val();
    var ruang=$('#'+simru.id).attr('ruang');
    var jadwal=$('#'+simru.id).attr('jadwal');
    var jalur=$('#'+simru.id).attr('jalur');
    var jenis=$('#editjenis2'+nomer).val();
    var kapas=$('#kapasitas'+nomer).val();
    var awal=$('#awal1'+nomer).val();
    var akhir=$('#awal2'+nomer).val();
    var kode_penawaran=$('#penawaran'+nomer).val();
    var tahun=$('#tahun').val();
    var gel=$('#gelombang').val();

   $.ajax({
    url   : "<?php echo base_url('adminpmb/input_data_c/update_status_ruang_ujian2'); ?>",
    type  : "POST",            
    data    : "tahun="+tahun+"&gelombang="+gel+"&kapasitas="+kapas+"&awal="+awal+"&akhir="+akhir+"&kode_penawaran="+kode_penawaran+"&id_ruang="+ruang+"&kode_jadwal="+jadwal+"&kode_jalur="+jalur+"&status="+statusru+"&jenis="+jenis,
    success: function(newtab){
      $('#pesan').hide();
      $('#table-ruang-ujian').html(newtab); 
      
    }
  });

}

function isi_kapas(ik)
{
  var no=$('#'+ik.id).attr('isi');
  var last=parseInt($('#'+ik.id).attr('kapas_awal'));
  var next=parseInt($('#'+ik.id).attr('next'));// nomor diruang selanjutnya
  var before=parseInt($('#'+ik.id).attr('before'));// nomor diruang selanjutnya
  var terisi=parseInt($('#'+ik.id).attr('terisi'));
  var isi=ik.value;
  var awal=$('#awal1'+no).val();
  var direction = ik.value > last;
  
  if (direction && terisi < 1)//jika menambah kapasistas dan ruangan masih kosong
  { 
    var akhir=buat_nomor(isi,awal);

        if(parseInt(next) != 0)
         {
          if(parseInt(akhir)<parseInt(next))
            {
              $('#awal2'+no).attr('value',akhir);
            }
          else
            {
              alert("Kapasitas yang anda masukkan melebihi batas maksimal yaitu "+parseInt(next));
            };
          }
          else
          {
            $('#awal2'+no).attr('value',akhir);

          };
  
  }
  else if(terisi < 1)//jika mengurangi kapasistas dan ruangan masih kosong
  {
      var akhir=buat_nomor(isi,awal);

      if(parseInt(before) != 0)
      {
          if(parseInt(akhir)>parseInt(before))
            {
              $('#awal2'+no).attr('value',akhir);
            }
          else
            {
              alert("Kapasitas yang anda masukkan telah digunakan diruang sebelumnya yaitu "+before);
            };
      }
      else
      {
        $('#awal2'+no).attr('value',akhir);
        
      }
  }
  else if(terisi>0)
  {
    alert("Kapasitas tidak diijinkan untuk dirubah karena terdapat nomor yang telah diambil peserta!");
  } 

}

function buat_nomor(jumlah,awal)
{
  return parseInt(awal)+parseInt(jumlah-1);
}

</script>