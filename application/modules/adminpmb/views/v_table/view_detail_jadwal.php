<div>
<div id="pesan_detail"></div>
<h3 style="margin-bottom:10px;">Detail Jadwal <?php echo $nama_jalur; ?></h3>
<input type="hidden" id="nama_jalur" value="<?php echo $nama_jalur; ?>">
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Tanggal</th>
      <th>Nama Tes</th>
      <th>Jam Mulai</th>
      <th>Jam Selesai</th>
      <th>Proses</th>
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
  
  if(!is_null($detail_jadwal))
  {
  	foreach ($detail_jadwal as $data_masuk) 
  		{ 
  	  echo "<tr>";
      echo "<td>";  echo $num+=1;                echo "</td>";
      echo "<td>";  echo tanggal_hari(date_format(date_create($data_masuk->tanggal),'d-m-Y'));        
      ?>
      <div class="input-group date" data-date="" style='display:none;' id="ltgl<?php echo $num ?>" style="width:100px" data-date-format="dd-mm-yyyy" onclick="datepic(this)" >
          <input class="form-control" size="16" type="text" value="" id="tgl<?php echo $num ?>" readonly="">
          <span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
        </div>

      <?php
      echo "</td>";  
      
      echo "<td>"; echo "<font id='ltes".$num."'>".$data_masuk->nama_tes."</font>"; 
      ?>
      <select id="tes<?php echo $num; ?>" style='display:none;' class="edit form-control input-md test">
            <option value=""> -- </option>
            <?php

            if(!is_null($data_tes))
            {
              foreach ($data_tes as $dtes) {
                echo "<option ";
                if($dtes->id_tes==$data_masuk->id_tes)
                {
                  echo " selected ";
                }
                echo " value='".$dtes->id_tes."'>".$dtes->nama_tes."</option>";
              }
            }
            ?>
          </select>
      <?php
      echo "</td>";
      echo "<td>"; echo "<font id='lmul".$num."'>".$data_masuk->jam_mulai."</font>"; 
      ?>
      <input type="time" id="mulai<?php echo $num; ?>" style='display:none;' class="edit form-control tm1" >
      <?php
      echo "</td>";
      echo "<td>"; echo "<font id='lsel".$num."'>".$data_masuk->jam_selesai."</font>"; 
      ?>
      <input type="time" id="selesai<?php echo $num; ?>" style='display:none;' class="edit form-control tm1" >
      <?php
      echo "</td>";
      echo "<input type='hidden' id='jadu".$num."' value='".$data_masuk->kode_jadwal."'>";

      ?>
     
      <td id="aksi<?php echo $num;?>"> 
      <button id="<?php echo $num;?>" class="btn btn-inverse btn-small aksi" value="<?php echo $data_masuk->id_detail ?>" onclick='edit_detail(this)'><i class="icon-edit icon-white"></i> Edit</button>
      <?php echo " "; ?>
      <button id="hps<?php echo $num;?>" class="btn btn-inverse btn-small aksi" isi='<?php echo $num; ?>' value="<?php echo $data_masuk->id_detail ?>" onclick='hapus_detail(this)'><i class="icon-trash icon-white"></i> Hapus</button>
      </td>
      <td id="update<?php echo $num ?>" style="display:none;">
        <button class="btn btn-inverse" id='blabla<?php echo $num ?>' type="button" value="<?php echo $data_masuk->id_detail ?>" isi='<?php echo $num; ?>' onclick="update_detail_jadwal(this)">Simpan</button>
        <button class="btn btn-inverse" type="button" value="<?php echo $num ?>" onclick="batal_update(this)">Batal</button>
     
      </td>
    </tr>

  <?php 
    } 
}
else
{
 echo '<td colspan="6" align="center">DATA DETAIL JADWAL KOSONG.</td>      </tbody>';
}
  ?>
<input type="hidden" id="nm_jal" value="<?php echo $nama_jalur; ?>">
</table></div>
</div>
<script type="text/javascript">
  function hapus_detail (id_detail) {

    var no=$('#'+id_detail.id).attr('isi');
    var kodjad=$('#jadu'+no).attr('value');
    var nama_jal=$('#nm_jal').attr('value');

    var y = confirm("Apakah Anda yakin akan menghapus detil jadwal ujian <?php echo $nama_jalur; ?>?");
    if(y)
    {
        $.ajax({

          url: "<?php echo base_url('adminpmb/input_data_c/hapus_detail_jadwal'); ?>",
          type: "POST",
          data: "id_detail="+id_detail.value+"&kode_jadwal="+kodjad+"&nama_jalur="+nama_jal,
          success: function(detil){
     $('#tbl-detil').html(detil);
          }
    });
    }
    

  }

  function edit_detail(ed)
  {
    var no=ed.id;
    $('#tes'+no).slideDown('slow');
    $('#mulai'+no).slideDown('slow');
     $('#selesai'+no).slideDown('slow');
     $('#ltgl'+no).slideDown('slow');
     $('#ltes'+no).slideUp('slow');
     $('#lmul'+no).slideUp('slow');
     $('#lsel'+no).slideUp('slow');
     $('#aksi'+no).slideUp('slow');
     $('#update'+no).slideDown('slow');
  }

  function batal_update(x)
  {
var no=x.value;
    $('#tes'+no).slideUp('slow');
    $('#mulai'+no).slideUp('slow');
     $('#ltgl'+no).slideUp('slow');
     $('#selesai'+no).slideUp('slow');
     $('#ltes'+no).slideDown('slow');
     $('#lmul'+no).slideDown('slow');
     $('#lsel'+no).slideDown('slow');
     $('#update'+no).slideUp('slow');
     $('#aksi'+no).slideDown('slow');
  }

  function update_detail_jadwal(udj)
  {
    var id=udj.value;
    var no=$('#'+udj.id).attr('isi');
    var tes=$('#tes'+no).val();
    var mu=$('#mulai'+no).val();
    var sel=$('#selesai'+no).val();
    var tgl=$('#tgl'+no).val();
    
    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/update_detail_jadwal') ?>",
      type: "POST",
      data: "tes="+tes+"&mulai="+mu+"&selesai="+sel+"&id_detail="+id+"&tgl="+tgl,
      success: function(sup)
      {
       $('#pesan_detail').html(sup);
       load_lagi(no)
      }
    });

  }

  function load_lagi(no)
  {
    var kode_jadwal=$('#jadu'+no).val();
    var nama_jalur=$('#nama_jalur').val();
    $.ajax({
              url : "<?php echo base_url('adminpmb/input_data_c/lihat_detail_jadwal') ?>",
              type: "POST",
              data: "kode_jadwal="+kode_jadwal+"&nama_jalur="+nama_jalur,
              success: function(det_jadwal){
                $('#tbl-detil').html(det_jadwal);
              }

    });
  }
</script>