<style>
  .search-table{table-layout: fixed;}

.search-table-outter { overflow-x: scroll;margin-bottom: 20px;}
th, td {}
  #tab {
  width:1450px;margin-bottom: 20px;
}
</style>
<h3 style="margin-bottom:10px;">Data Penawaran</h3>
<br id="ganjel">
<br class="ganjel">
<div class="search-table-outter wrapper">
	<table class="table table-bordered table-hover search-table inner" id="tab">
  <thead>
    <tr>
      <th valign="top" width="30">No.</th>
      <th valign="top" width="150">Nama Jalur</th>
      <th valign="top" width="160">Tanggal Mulai</th>
      <th valign="top" width="160">Tanggal Selesai</th>
      <th valign="top" width="160">Tanggal Mulai Bayar</th>
      <th valign="top" width="160">Tanggal Selesai Bayar</th>
      <th valign="top" width="50">Tahun</th>
      <th valign="top" width="70">Kode Bayar</th>
      <th valign="top" width="30">Gel.</th>
      <th valign="top" width="70">Status</th>
      <th valign="top" width="70">Kuota</th>
      <th valign="top" width="230">Proses</th>
    </tr>
  </thead>
 
  <tbody>
  <?php 
  $num=0;
  if(!is_null($data_jalur_masuk))
  { 
  	foreach ($data_jalur_masuk as $data_masuk) 
  	{	 
	  echo "<tr>";
      echo "<td>";  echo $num+=1; 								echo "</td>";
      echo "<td>";  echo $data_masuk->jalur_masuk; 				echo "</td>";
      echo "<td>"; 
     
      echo "<div id='tgl_dftr1".$num."' style='display:none;'><input type='date' id='dftr1".$num."' class='form-control' value='".date_format(date_create($data_masuk->tanggal_mulai_daftar),'Y-m-d')."'>"; 
      echo "<input type='time' id='time_dftr1".$num."' class='form-control' value='".date_format(date_create($data_masuk->tanggal_mulai_daftar),'H:i:s')."'></div>"; 
      echo "<font id='font_dftr1".$num."'>".date_format(date_create($data_masuk->tanggal_mulai_daftar),'d-m-Y H:i:s')."</font>";
       	echo "</td>";
      
      echo "<td>";  
      echo "<div id='tgl_dftr2".$num."' style='display:none;'><input type='date' id='dftr2".$num."' class='form-control' value='".date_format(date_create($data_masuk->tanggal_selesai_daftar),'Y-m-d')."'>"; 
      echo "<input type='time' id='time_dftr2".$num."' class='form-control' value='".date_format(date_create($data_masuk->tanggal_selesai_daftar),'H:i:s')."'></div>";
      echo "<font id='font_dftr2".$num."'>".date_format(date_create($data_masuk->tanggal_selesai_daftar),'d-m-Y H:i:s')."</font>"; 	
      echo "</td>";
      
      echo "<td>"; 
      echo "<div id='tgl_bayar1".$num."' style='display:none;'><input type='date' id='byr1".$num."' class='form-control' value='".date_format(date_create($data_masuk->tanggal_mulai_bayar),'Y-m-d')."'>"; 
      echo "<input type='time' id='time_bayar1".$num."' class='form-control' value='".date_format(date_create($data_masuk->tanggal_mulai_bayar),'H:i:s')."'></div>";
      
      echo "<font id='font_bayar1".$num."'>".date_format(date_create($data_masuk->tanggal_mulai_bayar),'d-m-Y H:i:s')."</font>";  
      echo "</td>";

      echo "<td>"; 
      echo "<div id='tgl_bayar2".$num."' style='display:none;'><input type='date' id='byr2".$num."' class='form-control' value='".date_format(date_create($data_masuk->tanggal_selesai_bayar),'Y-m-d')."'>"; 
      echo "<input type='time' id='time_bayar2".$num."' class='form-control' value='".date_format(date_create($data_masuk->tanggal_selesai_bayar),'H:i:s')."'></div>";
      echo "<font id='font_bayar2".$num."'>".date_format(date_create($data_masuk->tanggal_selesai_bayar),'d-m-Y H:i:s')."</font>";
      echo "</td>";
      
      echo "<td>";  echo $data_masuk->tahun;   echo "</td>";
      echo "<td>";  
      echo "<input type='text' style='display:none;' class='form-control' id='kode_bayar".$num."' value='".$data_masuk->kode_bayar."'>";
      echo "<font id='bayar".$num."'>".$data_masuk->kode_bayar."</font>";         	 	  

      echo "</td>";
      echo "<td>";  echo $data_masuk->gelombang;          		  echo "</td>";
      echo "<td>"; 
      if((Date('Y-m-d H:i:s') > date_format(date_create($data_masuk->tanggal_mulai_daftar),'Y-m-d H:i:s')) && (Date('Y-m-d H:i:s') < date_format(date_create($data_masuk->tanggal_selesai_daftar),'Y-m-d H:i:s')))
          {
                    echo " Aktif ";
          }
          else
          {
                   echo " Tidak Aktif ";
          }
      echo "</td>";
      /*
      echo "<td id='form-keterangan".$num."' colspan='10' style='display:none'>";
      echo "<textarea id='ket".$num."'>".$data_masuk->keterangan."</textarea>";
      
      echo "</td>";
      */
      echo "<td>";  echo "<font id='editkuota".$num."'>".$data_masuk->kuota."</font>";     echo "<input type='text' id='kuota".$num."' class='form-control' style='display:none;' value='".$data_masuk->kuota."'>";        echo "</td>";
      echo "<td id='proses2".$num."' style='display:none'>";
      ?>
      <button class="btn btn-inverse btn-small aksi" type="button" value="<?php echo $num;?>" id="simpan<?php echo $num; ?>" isi="<?php echo $data_masuk->kode_penawaran; ?>" onclick='update_penawaran(this)'> Simpan</button>
      <button class="btn btn-inverse btn-small aksi" type="button" value="<?php echo $num;?>" id="kelas_edit<?php echo $num; ?>" onclick='tampil_kelas(this)'> Kelas & Minat</button>
      <!--<button class="btn btn-inverse btn-small aksi" type="button" value="<?php echo $num;?>" id="ket_edit<?php echo $num; ?>" onclick='tampil_ket(this)'> Keterangan</button>
      --><button class="btn btn-inverse btn-small aksi" type="button" value="<?php echo $num;?>" id="batal<?php echo $num; ?>" onclick='batal(this)'> Batal</button>
     
      <?php
      echo "</td>";
      echo "<td id='proses1".$num."'>";
    ?>
      <button id="edit<?php echo $num;?>" value="<?php echo $num; ?>" onclick='edit_status(this)' class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_penawaran; ?>"><i class="icon-edit icon-white"></i> Edit</button>
   
      <button id="hps<?php echo $num;?>" value="<?php echo $num;?>" onclick='hps_pen_jalur(this)' class="btn btn-inverse btn-small aksi" isi="<?php echo $data_masuk->kode_penawaran; ?>"><i class="icon-trash icon-white"></i> Hapus</button>
      <?php
      echo "</td>";
      echo "</tr>";

      echo "<tr id='kelas-form".$num."' style='display:none;'>";
      echo "<td colspan='12' align='center'>";


      if(!is_null($data_kelas))
      {
        $no_kelas=0;
        foreach ($data_kelas as $dakel) {
        $no_kelas+=1;
        echo strtoupper($dakel->nama_kelas);
        echo " <input type='checkbox' ";
        if(!is_null($data_kelas_jalur))
        {
          foreach ($data_kelas_jalur as $keljur) {
            if($keljur->kode_penawaran==$data_masuk->kode_penawaran && $keljur->kode_kelas==$dakel->kode_kelas)
            {
              echo "checked";
            }
          }
        }
        echo " id='kelas".$num.$no_kelas."' isi='".$data_masuk->kode_penawaran."' value='".$dakel->kode_kelas."' onchange='update_kelas_jalur(this)'><br>";
        }
      }
     
      echo "<hr>";

      if(!is_null($data_minat))
      {
        $num_minat=0;
        foreach ($data_minat as $damin) {
        $num_minat+=1;
        echo $damin->nama_minat;
        echo " <input type='checkbox' id='cekminat".$num_minat.$num."' no='".$num_minat."' urut='".$num."' isi='".$data_masuk->kode_penawaran."' onchange='simpan_minat_update(this)'"; 
          if(!is_null($data_minat_jalur))
          {
            foreach ($data_minat_jalur as $minjalur) {
              if($minjalur->kode_penawaran==$data_masuk->kode_penawaran && $minjalur->kode_minat==$damin->kode_minat)
              {
                echo "checked";
              }
            }
          }
        echo"  value='".$damin->kode_minat."'>";
        echo "<input type='text' id='jmlminat".$num_minat.$num."' placeholder='Jumlah Penawaran' ";
        if(!is_null($data_minat_jalur))
          {
            foreach ($data_minat_jalur as $minjalur2) {
              if($minjalur2->kode_penawaran==$data_masuk->kode_penawaran && $minjalur2->kode_minat==$damin->kode_minat)
              {
                echo "value='".$minjalur2->jumlah_penawaran."'";
              }
            }
          }
        echo " class='form-control' style='width:150px;'>";
        }

        echo "</td>";
      }

   
      echo "</tr>";
      echo "<tr>";
    }
  }
   else 
    {
    	echo '<td colspan="12" align="center">DATA PENAWARAN JALUR BELUM ADA.</td>      </tbody>';
    }
    
  ?>
  </table>
  </div>
  <a name="fokus"></a>
  </div>
  <script type="text/javascript">

function edit_status(eja)
{
  var no=$('#'+eja.id).attr('value');
  $('#proses1'+no).hide();
  $('#proses2'+no).slideDown('slow');

  $('#font_dftr1'+no).hide();
  $('#tgl_dftr1'+no).slideDown('slow');
  $('#font_dftr2'+no).hide();
  $('#tgl_dftr2'+no).slideDown('slow');
  $('#font_bayar1'+no).hide();
  $('#tgl_bayar1'+no).slideDown('slow');
  $('#font_bayar2'+no).hide();
  $('#tgl_bayar2'+no).slideDown('slow');
  $('#bayar'+no).hide();
  $('#kode_bayar'+no).slideDown('slow');

  $('#editkuota'+no).hide();
  $('#kuota'+no).slideDown('slow');
}

function batal(btl)
{
var num=btl.value;
  $('#proses1'+num).show();
  $('#proses2'+num).hide();
  $('#editkuota'+num).show();
  $('#kuota'+num).hide();

  $('#tgl_dftr1'+num).hide();
  $('#font_dftr1'+num).show();
  
  $('#tgl_dftr2'+num).hide();
  $('#font_dftr2'+num).show();
  
  $('#tgl_bayar1'+num).hide();
  $('#font_bayar1'+num).show();
 
  $('#tgl_bayar2'+num).hide();
  $('#font_bayar2'+num).show();
 
  $('#kode_bayar'+num).hide();
  $('#bayar'+num).show();
  $('#kelas-form'+num).hide();

}

function update_penawaran(uppen)
{
  var kode_penawaran=$('#'+uppen.id).attr('isi');
  var num=uppen.value;
  var kuota=$('#kuota'+num).attr('value');
  var tgl_dftr1=$('#dftr1'+num).attr('value');
  var tgl_dftr2=$('#dftr2'+num).attr('value');
  var tgl_bayar1=$('#byr1'+num).attr('value');
  var tgl_bayar2=$('#byr2'+num).attr('value');
  var tm_dftar1=$('#time_dftr1'+num).attr('value');
  var tm_dftar2=$('#time_dftr2'+num).attr('value');
  var tm_bayar1=$('#time_bayar1'+num).attr('value');
  var tm_bayar2=$('#time_bayar2'+num).attr('value');
  var kode_bayar=$('#kode_bayar'+num).attr('value');

  $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/update_kuota_penawaran') ?>",
      type:"POST",
      data: "kode_penawaran="+kode_penawaran+"&kuota="+kuota+"&tanggal_mulai_daftar="+tgl_dftr1+"&jam_daftar1="+tm_dftar1+"&tanggal_selesai_daftar="+tgl_dftr2+"&jam_daftar2="+tm_dftar2+"&tanggal_mulai_bayar="+tgl_bayar1+"&jam_bayar1="+tm_bayar1+"&tanggal_selesai_bayar="+tgl_bayar2+"&jam_bayar2="+tm_bayar2+"&kode_bayar="+kode_bayar,

      success: function(hasupdate){
        
        $('#tbl-penawaran').html(hasupdate);
       
      
      }

    });



}

function hps_pen_jalur(hj)
{
  
  var nohps=$('#'+hj.id).attr('value');

   var val = $('#'+hj.id).attr('isi');  

    var r = confirm("Apakah Anda yakin akan menghapus data penawaran jalur?");
      if (r)
      {
            $("#tbl-penawaran").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
             
            $.ajax(
              {
              url: "<?php echo base_url('adminpmb/input_data_c/delete_penawaran_jalur'); ?>",
              type: "POST",
              data: "id="+val,
              success:function(xxx)
              {
              
              $("#tbl-penawaran").html(xxx);
             
            }

          });


    }
}

function tampil_kelas(edit_kelas)
{
  $('#kelas-form'+edit_kelas.value).slideDown('slow');
}

function update_kelas_jalur(up_kj)
{
  var kode_penawaran=$('#'+up_kj.id).attr('isi');
  var kode_kelas=up_kj.value;

  if($('#'+up_kj.id).prop('checked'))
  {

    $.ajax(
    {
      url: "<?php echo base_url('adminpmb/input_data_c/update_kelas_jalur'); ?>",
      type: "POST",
      data: "kode_penawaran="+kode_penawaran+"&kode_kelas="+kode_kelas,
      success: function(upsuc){
        alert(upsuc);
      }
    }
    );

  }
  else
  {
    
    $.ajax(
    {
      url: "<?php echo base_url('adminpmb/input_data_c/delete_kelas_jalur'); ?>",
      type: "POST",
      data: "kode_penawaran="+kode_penawaran+"&kode_kelas="+kode_kelas,
      success: function(delsuc){
        alert(delsuc);
      }
    }
    );
  
  }
}

function simpan_minat_update(form_minat_edit)
{
  
  var no=$('#'+form_minat_edit.id).attr('no');
  var urut=$('#'+form_minat_edit.id).attr('urut');
  var kode_penawaran=$('#'+form_minat_edit.id).attr('isi');
  var kode_minat=form_minat_edit.value;
  var jumlah=$('#jmlminat'+no+urut).attr('value');

  if($('#'+form_minat_edit.id).prop('checked'))
  {
    if(jumlah.length > 0)
    {
        

        $.ajax({
        url: "<?php echo base_url('adminpmb/input_data_c/insert_minat_jalur'); ?>",
        type: "POST",
        data: "kode_penawaran="+kode_penawaran+"&kode_minat="+kode_minat+"&jumlah_penawaran="+jumlah,
        success: function(minatnya){
        alert(minatnya);
        }
        });
    }
    else
    {
      alert('Jumlah penawaran kosong. Isi dulu!');
      $('#'+form_minat_edit.id).attr('checked',false);

    }
    
  } 
  else
  {
    $('#jmlminat'+no+urut).attr('value',null);

     $.ajax({
        url: "<?php echo base_url('adminpmb/input_data_c/delete_minat_jalur'); ?>",
        type: "POST",
        data: "kode_penawaran="+kode_penawaran+"&kode_minat="+kode_minat,
        success: function(hpsminatnya){
        alert(hpsminatnya);
        }
        });
  }



}
  </script>



