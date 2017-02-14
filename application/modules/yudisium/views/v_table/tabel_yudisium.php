<?php

function jenis_kelamin($kode)
{
  $jk="";
  switch ($kode) {
    case 'L':
      $jk="Laki-laki";
      break;
    case 'P':
      $jk="Perempuan";
      break;
    default:
      $jk=$kode;
      break;
  }
  return $jk;
}

function lokasi_helper($lokasi)
{
	if(strlen($lokasi)<3)
	{
		return "LAINNYA";
	}
	else
	{
		return $lokasi;
	}
}

$p_grade=$grade;
$per_tahun=0;
$key_grade=0;
$per_tgl= date('d-m-Y');
$key=0;
if(!is_null($sarat))
{
  foreach ($sarat as $dasar) 
  {
    switch ($dasar->id_jenis) {//id jenis config
      case '1':
       $key_grade=$dasar->key;
        break; //usia dalam tahun
      case '2':
        $per_tahun=$dasar->isi;
        $key=$dasar->key;
        break;
      case '3': //usia pertanggal
        $per_tgl=$dasar->isi;
        break;
    }
   
  } 
}
$bts_usia=array('TGL'=>$per_tgl, 'USIA'=>$per_tahun, 'KEY'=>$key);

?>


<div>
Keterangan :
<br>
<table class="table table-bordered" style="width:250px;">
  <tr >
    <td style="background-color:#FFEDA0;" width="30px" height="30px">
      
    </td>
    <td>
       Usia SAMA dengan batas maksimal
    </td>
  </tr>
  <tr >
    <td style="background-color:#DC143C;" width="30px" height="30px">
      
    </td>
    <td>
       Tidak memenuhi prasyarat
    </td>
  </tr>
</table>
<br>
	<table class="table table-bordered">
  <thead>
   <tr>
   <td colspan="4" align="center">
   <h3 style="margin-bottom:10px;">FORM YUDISIUM</h3>
   </td>
    <td> 
    <?php if(!is_null($data_mhs)){ 

    ?>
    <!--<button class="btn btn-inverse btn-uin btn-small" type="button" onclick="simpan_nilai_yudisium()"> SIMPAN</button>-->
    JUMLAH
    <?php  } ?>
    </td>
    <td>

    
    <input type="text" class="form-control input-sm" disabled id="jml_terima" value="0" style="width:40px">
    </td>
  </tr>
  <tr>
    <td>
      NO
    </td>
    <td>
      NO PMB
    </td>
    <td>
      KETERANGAN
    </td>
    <td>
      RINCIAN NILAI
    </td>
    <td>
      TOTAL NILAI
    </td>
     <td>
      AKSI <hr><input type="checkbox" id="all_check" value="all" onchange="centang_semua(this)">  Pilih Semua 
    </td>
  </tr>
  </thead>
  <tbody>
  <?php
  $diterima=0;
if(!is_null($data_mhs))
{
  $num=0;
  foreach ($data_mhs as $mhs) {
    echo "<tr>";
    echo "<td>";
      echo $num+=1;
    echo "</td>";
    echo "<td>";
     echo $mhs->nomor_peserta;
     echo "<br>";
     echo $mhs->nama_lengkap;
    echo "</td>";
    echo "<td>";
      $jur="JURUSAN: ".$mhs->nama_jurusan;
      $kab="KABUPATEN : ".$mhs->nama_kabupaten;
       echo "NAMA SEKOLAH/PT : ";
              echo $mhs->nama_sekolah_pt;
              echo "<br>";
              echo "KAB : ".lokasi_helper($mhs->nama_kabupaten);
             echo "<br>";
              echo "PROP : ".lokasi_helper($mhs->nama_provinsi);
            
              if(!empty($mhs->nama_jurusan))
              {
                echo "<br>".$jur;
              }
               if(!empty($mhs->nama_kabupatena))
              {
                echo "<br>".$kab;
              }
              echo "<hr>";
              echo "AKREDITASI SEKOLAH/PT : ";
              echo $mhs->akreditasi;
              echo "<hr>";
              echo "<div ";  
              echo "style='background-color:".hitung_batas_umur($mhs->tanggal_lahir,$bts_usia['TGL'],$bts_usia['USIA'],$bts_usia['KEY'])."'";
              echo ">";
              echo "USIA : ";
              
              echo hitung_umur($mhs->tanggal_lahir);
              echo "</div>";
              echo "<hr>";
              echo "JENIS KELAMIN : ";
              if(strlen($mhs->jenis_kelamin)<2)
              {
                echo jenis_kelamin($mhs->jenis_kelamin);
              }
              else
              {
                echo $mhs->jenis_kelamin;
              }
              echo "<hr>";

        echo "<table>";//tombol
              echo "<tr>";
                echo "<td>";
                  echo "<button class='btn btn-inverse btn-uin btn-small' type='button' id='pres".$num."' value='".$mhs->nomor_pendaftar."' onclick='data_prestasi(this)'> Data Prestasi </button>";
                echo "</td>";
                echo "<td>";
                  echo " <button class='btn btn-inverse btn-uin btn-small' type='button' id='kes".$num."' value='".$mhs->nomor_pendaftar."' onclick='data_kesehatan(this)'> Data Kesehatan </button>";
                echo "</td>";
              echo "<tr>";
              echo "<tr>";
                echo "<td>";
                  echo " <button class='btn btn-inverse btn-uin btn-small' type='button' id='kel".$num."' value='".$mhs->nomor_pendaftar."' onclick='data_keluarga(this)' > Data Keluarga </button>";
                echo "</td>";
                echo "<td>";
                 echo " <button class='btn btn-inverse btn-uin btn-small' type='button' id='prod".$num."' value='".$mhs->nomor_pendaftar."' onclick='data_pil_prod(this)'> Pilihan Prodi</button>";
                echo "</td>";
              echo "<tr>";
              echo "</table>";

              echo "<br>";
              echo "<button id='tutup".$mhs->nomor_pendaftar."' style='display:none;' type='button' value='".$mhs->nomor_pendaftar."' onclick='tutup_pencarian(this)'>Tutup</button>";
              echo "<div id='pencarian".$mhs->nomor_pendaftar."' style='display:none;'></div>";
             

    echo "</td>";
    echo "<td>";
      $nilai=0;
    if($mhs->nilai_yudisium==-1)
              {
           		$nilai=0;
              	foreach ($pembobotan as $pb) {
              		echo "<table class='table table-bordered'>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>".strtoupper($pb->nama_pembobotan)."</strong>";
                  echo "</td>"; 
                  echo "<td>0</td>";
                  echo "</tr>";
                   echo "</table>";
              	}
              }
        
        if(!is_null($nilai_tes))
              {
               
              foreach ($nilai_tes as $tes)
              { 
                
            
     
      if($kode_jalur != '14' && $kode_jalur !='15')
      {		

                if($tes->nomor_pendaftar==$mhs->nomor_pendaftar)
                {
                
                  echo "<table class='table table-bordered'>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<a id='nmsub".$tes->id_tes.$tes->nomor_pendaftar."' tes='".$tes->id_tes."' isi='".$tes->nomor_pendaftar."' onclick='view_sub_tes(this)'><strong>".strtoupper($tes->nama_tes)."</strong></a>";
                  echo "</td>"; 
                  echo "<td>".round(($tes->nilai_tes/$tes->bobot)*100)."</td>";

                  echo "</tr>";
                  echo "</table>";
                  echo "<table id='sub".$tes->id_tes.$tes->nomor_pendaftar."' style='display:none;'></table>";
                
              }
              
              


      }
      else
      {
            if($tes->NOMOR_PENDAFTAR==$mhs->nomor_pendaftar)
                {
                $nilai+=$tes->NILAI_PERINGKAT_SEKOLAH;
                $nilai+=$tes->NILAI_MATA_PELAJARAN;
                $nilai+=$tes->NILAI_PERINGKAT_SISWA;
                $nilai+=$tes->NILAI_PRESTASI;
                $nilai+=$tes->NILAI_PEMINAT_MANDIRI;
                $nilai+=$tes->NILAI_UJIAN_NASIONAL;
                $nilai+=$tes->NILAI_SEBARAN_WILAYAH;
                $nilai+=$tes->NILAI_REKAM_JEJAK_ALUMNI;
                $nilai+=$tes->NILAI_RIWAYAT_SNMPTN;
                $nilai+=$tes->NILAI_RIWAYAT_SBMPTN;
                  echo "<table class='table table-bordered'>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>Nilai Peringkat Sekolah</strong>";
                  echo "</td>"; 
                  echo "<td>".$tes->NILAI_PERINGKAT_SEKOLAH."</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>Nilai Mata Pelajaran</strong>";
                  echo "</td>"; 
                  echo "<td>".$tes->NILAI_MATA_PELAJARAN."</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>Nilai Peringkat Siswa</strong>";
                  echo "</td>"; 
                  echo "<td>".$tes->NILAI_PERINGKAT_SISWA."</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>Nilai Prestasi</strong>";
                  echo "</td>"; 
                  echo "<td>".$tes->NILAI_PRESTASI."</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>Nilai Peminat Mandiri</strong>";
                  echo "</td>"; 
                  echo "<td>".$tes->NILAI_PEMINAT_MANDIRI."</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>Nilai UN</strong>";
                  echo "</td>"; 
                  echo "<td>".$tes->NILAI_UJIAN_NASIONAL."</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>Nilai Sebaran Wilayah</strong>";
                  echo "</td>"; 
                  echo "<td>".$tes->NILAI_SEBARAN_WILAYAH."</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>Nilai Rekam Jejak Alumni</strong>";
                  echo "</td>"; 
                  echo "<td>".$tes->NILAI_REKAM_JEJAK_ALUMNI."</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>Nilai Riwayat SNMPTN</strong>";
                  echo "</td>"; 
                  echo "<td>".$tes->NILAI_RIWAYAT_SNMPTN."</td>";
                  echo "</tr>";
                  echo "<tr>";
                  echo "<td width='300'>";
                  echo "<strong>Nilai Riwayat SBMPTN</strong>";
                  echo "</td>"; 
                  echo "<td>".$tes->NILAI_RIWAYAT_SBMPTN."</td>";
                  echo "</tr>";
                  echo "</table>";
                 
              }
      }
              }
            
      }

    echo "</td>";
    $nilai_akhir=$mhs->nilai_yudisium;
    if($nilai_akhir<1)
    {
      $nilai_akhir=$nilai;
    }
    echo "<td style='background-color:".grade_allowed($nilai_akhir,$p_grade)."'>";
    echo round($nilai_akhir);
    echo "</td>";
    echo "<td>";
    if(grade_allowed_nilai(round($mhs->nilai_yudisium),$p_grade,$key_grade))
    {
      echo "<input ";
              
                  if($mhs->diterima=='1')
                  {
                    echo "checked";
                    $diterima+=1;
                  }
             
              echo " onchange='terima_mhs(this)' name='cek[]' id='TR".$num."' isi='".$mhs->nomor_pendaftar."' kelas='".$mhs->id_kelas."' urut='".$mhs->urutan_prodi."' type='checkbox' value='1'>";
        
    }
    
    echo "</td>";
  echo "</tr> ";
  }
}

  ?>
  </tbody>
</table>
</div>
<input type="hidden" id="jml_terima2" value="<?php echo $diterima ?>">
<form id="form-yudisium" method="POST">
<input type="hidden" id="kode_jalur" name="kode_jalur" value="<?php echo $kode_jalur ?>">
<input type="hidden" name="gelombang" value="<?php echo $gelombang ?>">
<input type="hidden" name="tahun" value="<?php echo $tahun ?>">
<input type="hidden" name="urut" value="<?php echo $pilihan ?>">
<input type="hidden" name="id_prodi" value="<?php echo $id_prodi ?>">
<input type="hidden" name="id_kelas" value="<?php echo $id_kelas ?>">
</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('#jml_terima').attr('value',"<?php echo $diterima; ?>");
});
var jml2="<?php echo $diterima; ?>";
  function data_prestasi(pres)
  {
    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/data_prestasi'); ?>",
      type: "POST",
      data: "nomor_pendaftar="+pres.value,
      success: function (prestasi)
      {
        
        $('#pencarian'+pres.value).html(prestasi);
        $('#pencarian'+pres.value).slideDown('slow');
        $('#tutup'+pres.value).slideDown('slow');
      }
    });

  }
  function data_kesehatan(kes)
  {
    $.ajax({
    	url: "<?php echo base_url('adminpmb/input_data_c/cari_data_kesehatan') ?>",
    	type: "POST",
    	data: "nomor_pendaftar="+kes.value,
    	success: function(kesehatan)
    	{
    		$('#pencarian'+kes.value).html(kesehatan);
        	$('#pencarian'+kes.value).slideDown('slow');
          $('#tutup'+kes.value).slideDown('slow');
    	}
    });
  }
  function data_keluarga(kel)
  {
    $.ajax({
    	url: "<?php echo base_url('adminpmb/input_data_c/cari_data_keluarga') ?>",
    	type: "POST",
    	data: "nomor_pendaftar="+kel.value,
    	success: function(keluarga)
    	{
    		$('#pencarian'+kel.value).html(keluarga);
        	$('#pencarian'+kel.value).slideDown('slow');
          $('#tutup'+kel.value).slideDown('slow');
    	}
    });
  }
  function data_pil_prod(prod)
  {
    
        $.ajax({
        url: "<?php echo base_url('yudisium/yudisium_c/cari_pil_prod') ?>",
        type: "POST",
        data: "nomor_pendaftar="+prod.value,
        success: function(prodi)
        {
        $('#pencarian'+prod.value).html(prodi);
        $('#pencarian'+prod.value).slideDown('slow');
        $('#tutup'+prod.value).slideDown('slow');
        }
        });

  }

  function view_sub_tes(sub)
  {
  	var nomor=$('#'+sub.id).attr('isi');
    var tes=$('#'+sub.id).attr('tes');

    var x= document.getElementById('sub'+tes+nomor).style.display;
    if(x == 'none')
    {
      $.ajax({
        url: "<?php echo base_url('yudisium/yudisium_c/view_sub_tes') ?>",
        type: "POST",
        data: "nomor_pendaftar="+nomor+"&id_tes="+tes,
        success: function(data_sub)
        {
          
          $('#sub'+tes+nomor).html(data_sub);
          $('#sub'+tes+nomor).slideDown('slow');

        }
        });
     
    }
    else
    {
      $('#sub'+tes+nomor).hide();
    }

  }
  function tutup_pencarian(tp)
  {
    $('#pencarian'+tp.value).slideUp('slow');
    $('#'+tp.id).slideUp('slow');
  }


  function batal_yudisium(no,prod,kls,urut)
  {
    var kode_jalur=$('#kode_jalur').val();
     $.ajax({
      url: "<?php echo base_url('yudisium/yudisium_c/batal_yudisiumkan') ?>",
      type: "POST",
      data: "nomor_pendaftar="+no+"&id_prodi="+prod+"&id_kelas="+kls+"&urut="+urut+"&kode_jalur="+kode_jalur,
      success: function(mes)
      {
        //alert(mes);
      }
    });

  }
 
   function terima_semua_mhs()
  {
    
    $.ajax({
      url: "<?php echo base_url('yudisium/yudisium_c/yudisiumkan_semua') ?>",
      type: "POST",
      data: $('#form-yudisium').serialize(),
      success: function(mes)
      {
        //alert(mes);
      }
    });
  }

  function terima_mhs_ini(no,prod,kls,urut)
  {
    var kode_jalur=$('#kode_jalur').val();
      $.ajax({
        url: "<?php echo base_url('yudisium/yudisium_c/yudisiumkan') ?>",
        type: "POST",
        data: "nomor_pendaftar="+no+"&id_prodi="+prod+"&id_kelas="+kls+"&urut="+urut+"&kode_jalur="+kode_jalur,
        success: function(mes)
        {
          //alert(mes);
        }
      });
    
  }
 

function terima_mhs(tm)
{

  var nopen=$('#'+tm.id).attr('isi');
  var id_prodi=$('#prodi').val();
  var id_kelas=$('#'+tm.id).attr('kelas');
  var urut=$('#'+tm.id).attr('urut');
  
  if($('#'+tm.id).prop('checked'))
  {
    
			
      $('#penawaran'+nopen).attr('disabled',false);
			$('#kelas'+nopen).attr('disabled',false);
			$('#prodi'+nopen).attr('disabled',false);
			$('#nomor_pendaftar'+nopen).attr('disabled',false);
			$('#nilai'+nopen).attr('disabled',false);
			$('#tes'+nopen).attr('disabled',false);
			$('#pendaftartes'+nopen).attr('disabled',false);
			$('#akhir'+nopen).attr('disabled',false);
      $('#jenjang'+nopen).attr('disabled',false);
     
     terima_mhs_ini(nopen,id_prodi,id_kelas,urut);
      jml2++;  
  }
  else
  {
    
    
     	$('#penawaran'+nopen).attr('disabled',true);
		$('#kelas'+nopen).attr('disabled',true);
		$('#prodi'+nopen).attr('disabled',true);
		$('#nomor_pendaftar'+nopen).attr('disabled',true);
		$('#nilai'+nopen).attr('disabled',true);
		$('#tes'+nopen).attr('disabled',true);
		$('#pendaftartes'+nopen).attr('disabled',true);
		$('#akhir'+nopen).attr('disabled',true);
    $('#jenjang'+nopen).attr('disabled',true);
    
    batal_yudisium(nopen,id_prodi,id_kelas,urut);
    jml2--;
  }

  $('#jml_terima').attr('value',jml2);

}

function centang_semua(cs)
{
  var jml="<?php echo $num; ?>";
  if($('#all_check').prop('checked'))
  {
    jml2=0;
    for(var i=1; i<=jml; i++)
    {
        if($('#TR'+i).prop('disabled')==false)
        {
         $('#TR'+i).prop('checked',true);

          jml2+=1;
        }
     
    }
    $('.terima').attr('disabled',false);
    terima_semua_mhs();
  }
  else
  {
    jml2=0;
    for(var i=1; i<=jml; i++)
    {
      $('#TR'+i).prop('checked',false);
    }
    $('.terima').attr('disabled',true);
  }
  $('#jml_terima').attr('value',jml2);

}


function simpan_nilai_yudisium()
{
  var kode_jalur=$('#pena').val();
  var tahun=$('#tahun').val();
  var gelombang=$('#gelombang').val();
  if(jml2 > 0)
  {

	 $.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/simpan_hasil_yudisium') ?>",
		type: "POST",
		data: $('#form-yudisium').serialize()+"&tahun="+tahun+"&gelombang="+gelombang+"&kode_jalur="+kode_jalur,
		success : function(sn)
		{
			//alert(sn);
		}
	 });
  }
  else
  {
   // alert("Belum ada mahasiswa yang diterima.");
  }

}
</script>