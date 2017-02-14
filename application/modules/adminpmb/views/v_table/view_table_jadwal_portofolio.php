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
      case '11': $bulan= "November"; break;
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
?>
<div>

<h3 style="margin-bottom:10px;">Data Jadwal Portofolio</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th width="10">No.</th>
      <th width="50">Tanggal</th>
      <th width="80">Jalur</th>
      <th width="100">Tanggal Mulai Verifikasi</th>
      <th width="100">Tanggal Akhir Verifikasi</th>
      <th width="150" valign="center">Proses</th>
    </tr>
  </thead>
  
  <tbody>
  <?php 
  $num=0; 
  if(!empty($jadwal))
  {
  	foreach ($jadwal as $data_masuk) 
  		{ 
  	  echo "<tr>";
      echo "<td>";  echo $num+=1;                echo "</td>";
      echo "<td>";  echo tanggal_hari(date_format(date_create($data_masuk->tanggal),'d-m-Y'));         echo "</td>";
       echo "<td>"; 
       echo $data_masuk->jalur_masuk;
      echo "</td>"; 
      echo "<td id='font_verif1".$num."'>";  echo tanggal_hari(date_format(date_create($data_masuk->mulai_verifikasi),'d-m-Y'))."<br>";    
      echo date_format(date_create($data_masuk->mulai_verifikasi),'H:i');
      echo "</td>";

      echo "<td id='tgl_verif1".$num."' style='display:none;'><input type='date' id='verifikasi1".$num."' onchange='tgl_mulai=this.value' class='form-control' value='".date_format(date_create($data_masuk->mulai_verifikasi),'Y-m-d')."'>"; 
      echo "<input type='time' id='time_verif1".$num."' onchange='jam_mulai=this.value' class='form-control' value='".date_format(date_create($data_masuk->mulai_verifikasi),'H:i:s')."'></td>";
      
      echo "</td>";
      echo "<td id='font_verif2".$num."'>";  echo tanggal_hari(date_format(date_create($data_masuk->selesai_verifikasi),'d-m-Y'))."<br>"; 
      echo date_format(date_create($data_masuk->selesai_verifikasi),'H:i');
      echo "</td>";  

      echo "<td id='tgl_verif2".$num."' style='display:none;'><input type='date' id='verifikasi2".$num."' onchange='tgl_selesai=this.value' class='form-control' value='".date_format(date_create($data_masuk->selesai_verifikasi),'Y-m-d')."'>"; 
      echo "<input type='time' id='time_verif2".$num."' onchange='jam_selesai=this.value' class='form-control' value='".date_format(date_create($data_masuk->selesai_verifikasi),'H:i:s')."'></td>";
     

      echo "<td id='btnaksi".$num."'>"; 
      ?>
      <button class='btn btn-inverse btn-small aksi' type="button" onclick="edit_j_p('<?php echo $num; ?>')" id="edit<?php echo $num; ?>" value="<?php echo $data_masuk->id_detail; ?>"><i class='icon-edit icon-white'></i> Edit</button>
      <button class='btn btn-inverse btn-small aksi' type="button" onclick="hapus_j_p('<?php echo $num; ?>')" id="hps<?php echo $num; ?>" isi='<?php echo $data_masuk->kode_penawaran; ?>' value="<?php echo $data_masuk->id_detail; ?>"><i class='icon-trash icon-white'></i> Delete</button>
      
      <?php

      echo "</td>"; 
       echo "<td id='btnproses".$num."' style='display:none;'>"; 
      ?>
      <button class='btn btn-inverse btn-small aksi' type="button" onclick="simpan_j_p('<?php echo $num; ?>')" id="simpan<?php echo $num; ?>" isi='<?php echo $data_masuk->kode_penawaran; ?>' value="<?php echo $data_masuk->id_detail; ?>"> Simpan</button>
      <button class='btn btn-inverse btn-small aksi' type="button" onclick="batal_j_p('<?php echo $num; ?>')" id="batal<?php echo $num; ?>" > Batal</button>
      
      <?php

      echo "</td>";       
      echo "</tr>";

     }
  }
     ?>
     
</table></div>
</div>
<div>
</div>
<script type="text/javascript">
  function edit_j_p(no_edit)
  {
    $('#btnaksi'+no_edit).hide();
    $('#font_verif1'+no_edit).hide();
     $('#font_verif2'+no_edit).hide();
    $('#btnproses'+no_edit).slideDown('slow');
    $('#tgl_verif1'+no_edit).slideDown('slow');
    $('#tgl_verif2'+no_edit).slideDown('slow');
  }
  function hapus_j_p(no_hapus)
  {
    var kode_penawaran=$('#hps'+no_hapus).attr('isi');
    var kode_jadwal=$('#hps'+no_hapus).attr('value');
    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/hapus_jadwal_portofolio'); ?>",
      type: "POST",
      data: "kode_jadwal="+kode_jadwal+"&kode_penawaran="+kode_penawaran,
      success: function(ok_hapus)
      {
        $('#tbl-jadwal-portofolio').html(ok_hapus);
      }
    });
  }
var tgl_mulai;
var tgl_selesai;
var jam_mulai;
var jam_selesai;
  function simpan_j_p(no_simpan)
  {
      var kode_penawaran=$('#simpan'+no_simpan).attr('isi');
      var kode_jadwal=$('#simpan'+no_simpan).attr('value');
        if(!tgl_mulai)
        {
        tgl_mulai=$('#verifikasi1'+no_simpan).attr('value');
        }
        if(!tgl_selesai)
        {
        tgl_selesai=$('#verifikasi2'+no_simpan).attr('value');
        }
        if(!jam_mulai)
        {
          jam_mulai=$('#time_verif1'+no_simpan).attr('value');
        }
        if(!jam_selesai)
        {
        jam_selesai=$('#time_verif2'+no_simpan).attr('value');
        }
      $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/edit_jadwal_portofolio'); ?>",
      type: "POST",
      data: "kode_jadwal="+kode_jadwal+"&kode_penawaran="+kode_penawaran+"&mulai_verifikasi="+tgl_mulai+"&selesai_verifikasi="+tgl_selesai+"&jam_mulai="+jam_mulai+"&jam_selesai="+jam_selesai,
      success: function(ok_update)
      {
        $('#tbl-jadwal-portofolio').html(ok_update);
        
      }
    });

  }
  function batal_j_p(no_batal)
  {
     $('#btnproses'+no_batal).hide();
     $('#tgl_verif1'+no_batal).hide();
     $('#tgl_verif2'+no_batal).hide();
     $('#font_verif1'+no_batal).slideDown('slow');
     $('#font_verif2'+no_batal).slideDown('slow');
     $('#btnaksi'+no_batal).slideDown('slow');
  }

</script>