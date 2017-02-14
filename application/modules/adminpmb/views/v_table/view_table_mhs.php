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
<?php
  echo "Jumlah : ".count($data_mhs);
?>
<h3 style="margin-bottom:10px;">Data Peserta PMB</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Lengkap</th>
      <th>Nomor Pendaftar</th>
      <th>Nomor Peserta</th>
      <th>Jalur Masuk</th>
      <th>Kondisi Kesehatan</th>
      <th width="150" valign="center">Proses</th>
    </tr>
  </thead>
  
  <tbody>
  <?php 
  $num=0; 
  if(!empty($data_mhs))
  {
  	foreach ($data_mhs as $data_masuk) 
  		{ 
      echo "<input type='hidden' id='jalur".$num."' value='".$data_masuk->kode_penawaran."'>";
  	  echo "<tr>";
      echo "<td>";  echo $num+=1;                echo "</td>";
      echo "<td>";  echo $data_masuk->nama_lengkap;         echo "</td>";
      echo "<td>";  echo $data_masuk->nomor_pendaftar;      echo "</td>";  
      echo "<td>";  echo $data_masuk->nomor_peserta;       
      echo "<br><button id='editno".$num."' class='btn btn-inverse btn-small' value='".$num."' type='button' onclick='edit_nomor(this)'> <span class='icon-white icon-edit'></span> Edit</button>";
      echo "</td>"; 
      echo "<td>";  echo $data_masuk->jalur_masuk;         echo "</td>"; 
      echo "<td>";  
      if(!empty($data_masuk->id_kesehatan))
      {
        echo $data_masuk->kondisi_kesehatan;
      }
      else
      {
        echo " Normal ";
      }
      echo "</td>"; 
      echo "<td>";
      ?>
      <button class='btn btn-inverse btn-small' type="button" onclick="window.open('http://admisi.uin-suka.ac.id/adminpmb/fpdf_c/ambil_data/<?php echo $data_masuk->nomor_pendaftar; ?>','_blank')"><span class='icon-white icon-print'></span> Kartu ujian</button>
      <hr>
      <button class='btn btn-inverse btn-small' type="button" id='ctc<?php echo $num; ?>' isi='<?php echo $num; ?>' onclick="view_contact(this)"><span class='icon-white icon-search'></span> Contact</button>
      <hr>
      <button class='btn btn-inverse btn-small' type="button" href="#" id='vrf<?php echo $num; ?>' isi='<?php echo $num; ?>' onclick="view_status(this)"><span class='icon-white icon-search'></span> Verifikasi</button>
      <hr>
     <button class='btn btn-inverse btn-uin btn-small' type='button' id='pilprod<?php echo $num; ?>' isi='<?php echo $num; ?>' value='<?php echo $data_masuk->nomor_pendaftar ?>' onclick='data_pil_prod(this)'> Pilihan Prodi</button>         
      </td>
      </tr>
      <tr id="nopes<?php echo $num; ?>" style="display:none;">
      <td></td>
      <td colspan="2">
     
          <select class="form-control input-md" style='width:150px;'  id="jadwal<?php echo $num; ?>" isi='<?php echo $num; ?>' onchange='cari_ruang(this)'>
          <option value=""> Jadwal </option>
          <?php
          if(!is_null($data_jadwal))
          {
            foreach ($data_jadwal as $jadwal) {
              echo "<option value='".$jadwal->kode_jadwal."'>".tanggal_hari(date_format(date_create($jadwal->tanggal),'d-m-Y'))."</option>";
            }
          }
          ?>
          </select>
          </td>
      <td colspan="2">
          <select class="form-control input-md"  id="ruang<?php echo $num; ?>" style='width:100px;' isi='<?php echo $num; ?>' onchange='cari_nomor(this)'>
          <option value=""> Ruang </option>

          </select>
    
      </td>
       <td colspan="2">
          <select class="form-control input-md"  id="nomor<?php echo $num; ?>" onchange='nomor_pes=this.value' style='width:180px;'>
          <option value=""> Nomor Peserta </option>

          </select>
    <input type="hidden" id="pen<?php echo $num; ?>" value='<?php echo $data_masuk->nomor_pendaftar; ?>'>
     <input type="hidden" id="jal<?php echo $num; ?>" value='<?php echo $data_masuk->kode_jalur; ?>'>
      </td>
      <td colspan="2">
        <button class="btn btn-inverse btn-small" id="btnSaveno<?php echo $num; ?>" value='<?php echo $num; ?>' onclick='ganti_nomor_peserta(this)' type="button"> Simpan</button>
        <button class="btn btn-inverse btn-small" id="btnCancelno<?php echo $num; ?>" onclick="$('#nopes'+<?php echo $num; ?>).slideUp('slow')" type="button"> Batal</button>
      </td>
      </tr>

      <tr id="contact<?php echo $num; ?>" style="display:none;">
      <td colspan="8">
         <?php echo "Hp : ".$data_masuk->nohp; ?>
        <hr>
         <?php echo "Email : ".$data_masuk->email; ?>
        <hr>
      </td>
      </tr>
      
      <tr id="prodipil<?php echo $num; ?>" style="display:none;">
      <td colspan="8">
        <div id="xxx<?php echo $num; ?>">
          
        </div>
      </td>
      </tr>


      <tr id="verifikasi<?php echo $num; ?>" style="display:none;">
      <td colspan="8">
         <?php echo "Terverifikasi : "; 
         if($data_masuk->status_simpan=='1')
         {
          echo "Terverifikasi ";
          echo "<button class='btn btn-inverse btn-small' id='cancel_verif".$num."' type='button' value='".$data_masuk->nomor_pendaftar."' onclick='batal_verifikasi(this.value)'> Batalkan Verifikasi</button>";
         }
         else
         {
          echo "Belum di verifikasi";
         }
         ?>
        <hr>
         <?php 
          if($data_masuk->status_simpan=='1')
         {
            echo "Tanggal verifikasi : ".tanggal_hari(date_format(date_create($data_masuk->tanggal),'d-m-Y')); 
         }
         else
         {
          echo "Tanggal verifikasi : -";
         }
          ?>
          

        <hr>
      </td>
      </tr>
      <?php
      } 
}
else
{
 echo '<tr><td colspan="8" align="center"></td></tr>      </tbody>';
}
  ?>

</table></div>
</div>
<div>
</div>
<script type="text/javascript">
  var jadwal,ruang,nomor_pes;
  function view_contact(no){
   var nomor=$('#'+no.id).attr('isi');
    
    $('#contact'+nomor).slideDown('slow');
    
  
     }
  function view_status(num)
  {
     var nomor2=$('#'+num.id).attr('isi');
    $('#verifikasi'+nomor2).slideDown('slow');
  
     
  }

  function edit_nomor(nps)
  {
   
   $('#nopes'+nps.value).slideDown('slow'); 
  }

  function cari_ruang(caru)
  {
    jadwal=caru.value;
    var no=$('#'+caru.id).attr('isi');
    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/cari_ruang_edit'); ?>",
      type: "POST",
      data: "kode_jadwal="+caru.value+"&kode_penawaran="+$('#jalur'+no).val(),
      success: function(hasru){
        $('#ruang'+no).html(hasru);
      }
    });
  }

  function cari_nomor(cano)
  {
    ruang=cano.value;
    var no=$('#'+cano.id).attr('isi');
    
    var kode_jalur=$('#jal'+no).attr('value');

    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/cari_nomor_peserta_edit'); ?>",
      type: "POST",
      data: "kode_jadwal="+jadwal+"&id_ruang="+cano.value+"&kode_jalur="+kode_jalur,
      success: function(hasno){
      
        $('#nomor'+no).html(hasno);
       
      }
    });

  }

  function ganti_nomor_peserta(update_nomor_peserta)
  {
    var nomor_pendaftar=$('#pen'+update_nomor_peserta.value).attr('value');

    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/update_nomor_peserta'); ?>",
      type: "POST",
      data: "id_ruang="+ruang+"&nomor_pendaftar="+nomor_pendaftar+"&nomor_peserta="+nomor_pes+"&kode_jadwal="+jadwal,
      success: function(upnoper){
        alert(upnoper);
      }

    });

  }

function batal_verifikasi(nomor_pendaftar)
{
  var x=confirm('Apakah anda akan membatalkan verifikasi ini ?');
  if(x)
  {
   $.ajax({
    url: "<?php echo base_url('adminpmb/input_data_c/batal_verifikasi'); ?>",
    type: "POST",
    data: "nomor_pendaftar="+nomor_pendaftar,
    success: function (horeeee){
      alert(horeeee);
    }
   });
  
}
}

function data_pil_prod(prod)
  {
     var no=$('#'+prod.id).attr('isi');
     
        $.ajax({
        url: "<?php echo base_url('adminpmb/input_data_c/cari_pil_prod') ?>",
        type: "POST",
        data: "nomor_pendaftar="+prod.value,
        success: function(prodi)
        {
        $('#xxx'+no).html(prodi);
        $('#prodipil'+no).slideDown('slow');
       
        }
        });


  }

</script>