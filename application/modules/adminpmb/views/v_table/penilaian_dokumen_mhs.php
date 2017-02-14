<h3 style="margin-bottom:10px;">Dokumen Calon Mahasiswa Baru</h3>
<br id="ganjel">
<br class="ganjel">
<?php
function get_extendsion($uri)
{
  $img = explode(',', $uri);
  $ini =substr($img[0], 11);
  $type = explode(';', $ini);
  return $type[0];
}
$arr_nil=array();
if(!is_null($nilai))
{
  foreach ($nilai as $ni) {
    array_push($arr_nil, $ni);
  }
}

$tpa=array();
$arab=array();
$bing=array();
$indo=array();
$akre=array();
$ipk=array();
$karya=array();
$kepe=array();
$rekomen=array();
$disertasi=array();
$motiv=array();
if(!is_null($dt_sertifikat))
{
  foreach ($dt_sertifikat as $sr) {
   
    switch($sr->jenis_sertifikat)
    {

      case 'ARAB':
        # code...
      array_push($arab, $sr);
        break;
      case 'BING':
        # code...
      array_push($bing, $sr);
        break;
      case 'INDO':
        # code...
      array_push($indo, $sr);
        break;
      case 'TPA':
        # code...
      array_push($tpa, $sr);
        break;
    }

  }

}
$bobottpa=0;
$bobottoefl=0;
$bobottoafl=0;
$bobotindo=0;
$bobotipk=0;
$bobotprop=0;
$bobotreko=0;
$bobotpublikasi=0;
$bobotkp=0;
$bobotakre=0;
$bobotmotiv=0;
if(!is_null($bobot))
{
  foreach ($bobot as $bb) {

    switch ($bb->jenis_sertifikat) {
      case 'ARAB':
        # code...
      $bobottoafl=$bb->bobot;
      
        break;
      case 'BING':
        # code...
     $bobottoefl=$bb->bobot;
             break;
      case 'INDO':
        # code...
      $bobotindo=$bb->bobot;
      
        break;
      case 'TPA':
        # code...
     $bobottpa=$bb->bobot;
     
     break;
     case 'IPK':
        # code...
      $bobotipk=$bb->bobot;
      
        break;
      case 'DISERTASI':
        # code...
      $bobotprop=$bb->bobot;
      
        break;
    case 'KARYA_TULIS':
        # code...
      $bobotpublikasi=$bb->bobot;
     
        break;
    case 'KEPEMIMPINAN':
        # code...
      $bobotkp=$bb->bobot;
      
        break;
    case 'REKOMENDASI':
        # code...
      $bobotreko=$bb->bobot;
     
        break;
    case 'MOTIVASI':
        # code...
      $bobotmotiv=$bb->bobot;
     
        break;
    case 'AKREDITASI':
        # code...
      $bobotakre=$bb->bobot;
      array_push($akre, $bb);
        break;
    }
  }

}

if(!is_null($normal_dokumen))
{
  foreach ($normal_dokumen as $nd) {
    switch ($nd->id_sertifikat) {
      case 'IPK':
        # code...
      array_push($ipk, $nd);

        break;
      case 'PUBLIKASI':
        # code...
      array_push($karya, $nd);
        break;
      case 'KEPEMIMPINAN':
        # code...
      array_push($kepe, $nd);
        break;
      case 'REKOMENDASI':
        # code...
      array_push($rekomen, $nd);
        break;
       case 'PROPOSAL':
        # code...
      array_push($disertasi, $nd);
        break;
      case 'MOTIVASI':
        # code...
      array_push($motiv, $nd);
        break;
    }
  }
}
?>
<h3>Klik pada <b>Nilai Sertifikat</b> untuk melihat sertifikat</h3>
	<table class="table table-bordered">
  <thead>
    <tr>
      <th width="1px">No.</th>
      <th width="10">PESERTA</th>
      <th width="30">DOKUMEN MAHASISWA</th>
      <th width="25">PENILAIAN</th>
    </tr>
  </thead>
  
  <tbody>
  <?php
  $num=0;
  if(!is_null($data_mhs))
  {
    foreach ($data_mhs as $mhs) {
      echo "<tr>";
      echo "<td>";
      echo $num+=1;
      echo "</td>";
      echo "<td>";
      echo $mhs->nama_lengkap;
      echo "<hr>";
      echo $mhs->nomor_peserta;
      echo"<hr>";
     //echo "<button class='btn btn-inverse btn-small' type='button' isi='".$num."' onclick='data_mahasiswa(this)' value='".$mhs->nomor_pendaftar."' id='data".$num."'><span class='icon-white icon-download'></span> Data Mahsiswa</button>";
     echo "<a class='print_data_mahasiswa' style='display:none;' value='".$mhs->nomor_pendaftar."' id='xxx".$mhs->nomor_pendaftar."'></a>";
    
      echo "</td>";
      echo "<td>";
      echo "Tahun Lulus : ".$mhs->tahun_ijazah;
      echo "<hr>";
      echo "IPK : ".$mhs->ipk;
      echo "<hr>";
      echo "Akreditasi : ".$mhs->akreditasi;
      echo "<hr>";
      echo "<button class='btn btn-inverse btn-small' type='button' isi='".$num."' onclick='ijasah(this)' value='".$mhs->nomor_pendaftar."' id='ijz".$num."'><span class='icon-white icon-search'></span> IJAZAH</button>";
      echo "<a class='tampil_file' style='display:none;' isi='ijazah-".$mhs->nomor_pendaftar.".' id='ij".$num."'></a>";
      echo " <button class='btn btn-inverse btn-small' type='button' isi='".$num."' onclick='trans(this)' value='".$mhs->nomor_pendaftar."' id='transkrip".$num."'><span class='icon-white icon-search'></span> TRANSKRIP</button>";
      echo "<a class='tampil_file' style='display:none;' isi='transkrip-".$mhs->nomor_pendaftar.".' id='tra".$num."'></a>";
      echo "<hr>";
      
      echo "<table>";
          echo "<tr>";
          echo "<td>";
          echo "Tes Potensi Akademik";
          echo "</td>";
          echo "<td>";
              echo "<a onclick='sertifikat(this)' href='#' akun='".$mhs->nomor_pendaftar."' id='tpa".$mhs->nomor_pendaftar."'>".$mhs->nilai_gre." </a>";
              if(count($tpa)>0)
              {
                foreach ($tpa as $tp) {
                  if($mhs->nomor_pendaftar==$tp->nomor_pendaftar)
                  {
                    echo "(".str_replace('_',' ',$tp->id_sertifikat).")";
                  }
                }
              }
              
              echo "<a class='tampil_file' isi='sertf-tpa-".$mhs->nomor_pendaftar.".' style='display:none;' id='2tpa".$mhs->nomor_pendaftar."'></a>";
          echo "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>";
          echo "Kemampuan Berbahasa Arab";
          echo "</td>";
          echo "<td>";
              echo "<a onclick='sertifikat(this)' href='#' akun='".$mhs->nomor_pendaftar."' id='toa".$mhs->nomor_pendaftar."'>".$mhs->nilai_toafl." </a>";
               if(count($arab)>0)
              {
                foreach ($arab as $rb) {
                  if($mhs->nomor_pendaftar==$rb->nomor_pendaftar)
                  {
                    echo "(".str_replace('_',' ',$rb->id_sertifikat).")";
                  }
                }
              }
              echo "<a class='tampil_file' isi='sertf-toafl-".$mhs->nomor_pendaftar.".' style='display:none;' id='2toa".$mhs->nomor_pendaftar."'></a>";
          echo "</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td>";
          echo "Kemampuan Berbahasa Inggris";
          echo "</td>";
          echo "<td>";
              echo "<a onclick='sertifikat(this)' href='#' akun='".$mhs->nomor_pendaftar."' id='toe".$mhs->nomor_pendaftar."'>".$mhs->nilai_toefl." </a>";
              if(count($bing)>0)
              {
                foreach ($bing as $bng) {
                  if($mhs->nomor_pendaftar==$bng->nomor_pendaftar)
                  {
                    echo "(".str_replace('_',' ',$bng->id_sertifikat).")";
                  }
                }
              }
              echo "<a class='tampil_file' isi='sertf-toefl-".$mhs->nomor_pendaftar.".' style='display:none;' id='2toe".$mhs->nomor_pendaftar."'></a>";
          
          echo "</td>";
          echo "</tr>";
          if(strlen($mhs->nilai_bhs_indo)>1)
          {

            echo "<tr>";
            echo "<td>";
            echo "Kemampuan Berbahasa Indonesia";
            echo "</td>";
            echo "<td>";

              echo "<a onclick='sertifikat(this)' href='#' akun='".$mhs->nomor_pendaftar."' id='indo".$mhs->nomor_pendaftar."'>".$mhs->nilai_bhs_indo." </a>";
               if(count($indo)>0)
              {
                foreach ($indo as $ind) {
                  if($mhs->nomor_pendaftar==$ind->nomor_pendaftar)
                  {
                    echo "(".str_replace('_',' ',$ind->id_sertifikat).")";
                  }
                }
              }
              echo "<a class='tampil_file' isi='sertf-indo-".$mhs->nomor_pendaftar.".' style='display:none;' id='2indo".$mhs->nomor_pendaftar."'></a>";
            echo "</td>";
            echo "</tr>";
        }
       
        echo "</tr>";
          echo "<tr>";
          echo "<td>";
          echo "Sertifikat Kepemimpinan";
          echo "</td>";
          echo "<td>";
              echo "<a onclick='sertifikat(this)' href='#' akun='".$mhs->nomor_pendaftar."' id='kp".$mhs->nomor_pendaftar."'>Lihat</a>";
              echo "<a class='tampil_file' isi='sertf-kepemimpinan-".$mhs->nomor_pendaftar.".' style='display:none;' id='2kp".$mhs->nomor_pendaftar."'></a>";
          echo "</td>";
          echo "</tr>";
        
        echo "</table>"; 
      echo "<hr>";

       echo "<button class='btn btn-inverse btn-small' type='button' isi='".$num."' onclick='publikasi(this)' value='".$mhs->nomor_pendaftar."' id='pub".$num."'><span class='icon-white icon-search'></span> PUBLIKASI</button>";
      echo "<a class='tampil_file' id='ini_karya' isi='publikasi-".$mhs->nomor_pendaftar."' style='display:none;'></a>";
      echo "<table id='pub2".$num."' class='table table-bordered' style='display:none;'></table>";
      
      echo " <button class='btn btn-inverse btn-small' type='button' isi='".$num."' onclick='rekomendasi(this)' value='".$mhs->nomor_pendaftar."' id='reko".$num."'><span class='icon-white icon-search'></span> REKOMENDASI</button>";
      echo "<a class='tampil_file' isi='rekomendasi-".$mhs->nomor_pendaftar.".' style='display:none;' id='rek".$num."'></a>"; 
      
      if($jalur=='3')
      {
      echo "<hr>";
          echo "PROPOSAL : <a onclick='proposal(this)' href='#' akun='".$mhs->nomor_pendaftar."' isi='".$num."' id='pr".$num."'>".$mhs->judul."</a>";
          echo "<a class='tampil_file' isi='".$mhs->judul.".' style='display:none;' id='pr2".$num."'></a>";
      }
      elseif($jalur=='2')
      {
        
      echo "<hr>";
           echo "PROPOSAL : <a onclick='proposal_tesis(this)' href='#' akun='".$mhs->nomor_pendaftar."' isi='".$num."' id='prt".$num."'>".$mhs->judul_tesis."</a><br>";
          echo "<a class='tampil_file' isi='".$mhs->judul_tesis.".' style='display:none;' id='prt2".$num."'> FILE PROPOSAL |</a>";
          echo "<a class='tampil_file' isi='".$mhs->judul_tesis.".' style='display:none;' id='prt3".$num."'> REKOMENDASI </a>";
          echo "<div id='proposal_s2".$num."' style:'display:none;'><input type='hidden' id='tesisnya".$mhs->nomor_pendaftar."'>";
          echo "<input type='hidden' id='rekomendasinya".$mhs->nomor_pendaftar."'></div>";
     }
      echo "</td>";
      echo "<td>";

      echo "<form id='form-".$mhs->nomor_pendaftar."'>";
      echo "<input type='hidden' name='user' value='".$mhs->nomor_pendaftar."'>";
      echo "<table>";
      echo "<tr>";
      echo "<td>";
      echo "IPK";
      echo "</td>";
      echo "<td>";
      echo "<input type='hidden' name='jenis[]' value='IPK'>";
            echo "<input type='text' name='ipk' value='".$mhs->ipk."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='bobotipk' value='".$bobotipk."' style='width:60px' class='form-control input-md'>";
             echo "<input type='hidden' name='normalipk' "; 
            if(count($ipk)>0)
              {
                foreach ($ipk as $nipk) {
                  
                    echo "value='".$nipk->normalisasi."'";
                  
                  
                }
              }
            echo " style='width:60px' class='form-control input-md'>";
  
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
      echo "AKREDITASI";
      echo "</td>";
      echo "<td>";
      echo "<input type='hidden' name='jenis[]' value='AKREDITASI'>";
            echo "<input type='text' name='akreditasi' style='width:60px' value='".$mhs->akreditasi."' class='form-control input-md'>";
            echo "<input type='hidden' name='bobotakre' value='".$bobotakre."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='normalakre' "; 
            if(count($akre)>0)
              {
                foreach ($akre as $ak) {
                  if(str_replace('AKREDITASI_', '', $ak->id_sertifikat)==$mhs->akreditasi)
                  {
                    echo "value='".$ak->normalisasi."'";
                  }
                  
                }
              }
            echo " style='width:60px' class='form-control input-md'>";
  
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
      echo "TES POTENSI AKADEMIK";
      echo "</td>";
      echo "<td>";
       echo "<input type='hidden' name='jenis[]' value='TPA'>";
              echo "<input type='text' name='tpa' value='".$mhs->nilai_gre."' style='width:60px' class='form-control input-md'>";
              echo "<input type='hidden' name='bobottpa' value='".$bobottpa."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='normaltpa' ";
            if(count($tpa)>0)
              {
                foreach ($tpa as $tpm) {
                  if($mhs->nomor_pendaftar==$tpm->nomor_pendaftar)
                  {
                    echo "value='".$tpm->normalisasi."'";
                  }

                }
              }
            echo " style='width:60px' class='form-control input-md'>";
    
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
      echo "BAHASA ARAB";
      echo "</td>";
      echo "<td>";
       echo "<input type='hidden' name='jenis[]' value='ARAB'>";
                echo "<input type='text' name='ikla' value='".$mhs->nilai_toafl."' style='width:60px' class='form-control input-md'>";
                echo "<input type='hidden' name='bobotikla' value='".$bobottoafl."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='normalikla' "; 
             if(count($arab)>0)
              {
                foreach ($arab as $rbm) {
                  if($mhs->nomor_pendaftar==$rbm->nomor_pendaftar)
                  {
                    echo "value='".$rbm->normalisasi."'";
                  }
                }
              }
            echo " style='width:60px' class='form-control input-md'>";
    
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
      echo "BAHASA INGGRIS";
      echo "</td>";
      echo "<td>";
       echo "<input type='hidden' name='jenis[]' value='BING'>";
            echo "<input type='text' name='toefl' value='".$mhs->nilai_toefl."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='bobottoefl' value='".$bobottoefl."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='normaltoefl' "; 
            if(count($bing)>0)
              {
                foreach ($bing as $bngm) {
                  if($mhs->nomor_pendaftar==$bngm->nomor_pendaftar)
                  {
                    echo "value='".$bngm->normalisasi."'";
                  }
                }
              }
            echo " style='width:60px' class='form-control input-md'>";
    
      echo "</td>";
      echo "</tr>";

       if(strlen($mhs->nilai_bhs_indo)>1)
        {

      echo "<tr>";
      echo "<td>";
      echo "BAHASA INDONESIA";
      echo "</td>";
      echo "<td>";
       echo "<input type='hidden' name='jenis[]' value='INDO'>";
            echo "<input type='text' name='indo' value='".$mhs->nilai_bhs_indo."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='bobotindo' value='".$bobotindo."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='normalindo' "; 
            if(count($indo)>0)
              {
                foreach ($indo as $ina) {
                  if($mhs->nomor_pendaftar==$ina->nomor_pendaftar)
                  {
                    echo "value='".$ina->normalisasi."'";
                  }
                }
              }
            echo " style='width:60px' class='form-control input-md'>";
    
      echo "</td>";
      echo "</tr>";

    }


      echo "<tr>";
      echo "<td>";
      echo "KEPEMIMPINAN";
      echo "</td>";
      echo "<td>";
       echo "<input type='hidden' name='jenis[]' value='KEPEMIMPINAN'>";
            echo "<input type='text' name='kepemimpinan' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='bobotkp' value='".$bobotkp."' style='width:60px' class='form-control input-md'>";
             echo "<input type='hidden' name='normalkp' "; 
            if(count($kepe)>0)
              {
                foreach ($kepe as $kep) {
                  
                    echo "value='".$kep->normalisasi."'";
                  
                  
                }
              }
            echo " style='width:60px' class='form-control input-md'>";
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
      echo "PUBLIKASI";
      echo "</td>";
      echo "<td>";
       echo "<input type='hidden' name='jenis[]' value='KARYA_TULIS'>";
            echo "<input type='text' name='publikasi' ";
            if(count($arr_nil)>0)
            {
              foreach ($arr_nil as $anil) {
                if($anil->jenis_sertifikat=='KARYA_TULIS' && $anil->nomor_pendaftar==$mhs->nomor_pendaftar)
                {
                  echo "value='".$anil->nilai."'";
                }
              }
            }
            echo " style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='bobotpb' value='".$bobotpublikasi."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='normalpb' "; 
            if(count($karya)>0)
              {
                foreach ($karya as $kar) {
                  
                    echo "value='".$kar->normalisasi."'";
                  
                  
                }
              }
            echo " style='width:60px' class='form-control input-md'>";
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
      echo "REKOMENDASI";
      echo "</td>";
      echo "<td>";
       echo "<input type='hidden' name='jenis[]' value='REKOMENDASI'>";
            echo "<input type='text' name='rekomendasi' ";
            if(count($arr_nil)>0)
            {
              foreach ($arr_nil as $anil) {
                if($anil->jenis_sertifikat=='REKOMENDASI' && $anil->nomor_pendaftar==$mhs->nomor_pendaftar)
                {
                  echo "value='".$anil->nilai."'";
                }
              }
            }
            echo " style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='bobotreko' value='".$bobotreko."' style='width:60px' class='form-control input-md'>";
             echo "<input type='hidden' name='normalreko' "; 
           
            if(count($rekomen)>0)
              {
                foreach ($rekomen as $rk) {
                  
                    echo "value='".$rk->normalisasi."'";
                  
                  
                }
              }
            echo " style='width:60px' class='form-control input-md'>";
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
      echo "PROPOSAL";
      echo "</td>";
      echo "<td>";
             echo "<input type='hidden' name='jenis[]' value='DISERTASI'>";
            echo "<input type='text' name='proposal' "; 
            if(count($arr_nil)>0)
            {
              foreach ($arr_nil as $anil) {
                if($anil->jenis_sertifikat=='DISERTASI' && $anil->nomor_pendaftar==$mhs->nomor_pendaftar)
                {
                  echo "value='".$anil->nilai."'";
                }
              }
            }
            echo " style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='bobotprop' value='".$bobotprop."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='normalprop' value='1' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='normalprop' "; 
            if(count($disertasi)>0)
              {
                foreach ($disertasi as $dis) {
                  
                    echo "value='".$dis->normalisasi."'";
                  
                  
                }
              }
            echo " style='width:60px' class='form-control input-md'>";
      echo "</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td>";
      echo "MOTIVASI";
      echo "</td>";
      echo "<td>";
             echo "<input type='hidden' name='jenis[]' value='MOTIVASI'>";
            echo "<input type='text' name='motiv' "; 
            if(count($arr_nil)>0)
            {
              foreach ($arr_nil as $anil) {
                if($anil->jenis_sertifikat=='MOTIVASI' && $anil->nomor_pendaftar==$mhs->nomor_pendaftar)
                {
                  echo "value='".$anil->nilai."'";
                }
              }
            }
            echo " style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='bobotmotiv' value='".$bobotmotiv."' style='width:60px' class='form-control input-md'>";
            echo "<input type='hidden' name='normalmotiv' "; 
            if(count($motiv)>0)
              {
                foreach ($motiv as $mot) {
                  
                    echo "value='".$mot->normalisasi."'";
                  
                  
                }
              }
            echo " style='width:60px' class='form-control input-md'>";
      echo "</td>";
      echo "</tr>";
      echo "</table>";
      echo "</form>";
      echo "<button class='btn btn-inverse btn-uin btn-small' type='button' id='btn-".$num."' value='".$mhs->nomor_pendaftar."' onclick='simpan_nilai_mhs(this)'> Simpan</button>";
      echo "</td>";
      echo "</tr>";

    }
  }
  
  ?>
  </tbody>
  </table>
<script type="text/javascript">

   $(function ()
    {

      $(".tampil_file").colorbox({iframe:true, innerWidth:800, innerHeight:550, title: function(){
    var url = $(this).attr('href');
    var f=$(this).attr('isi')+$(this).attr('title');
    var dwn;
    var link;
    if(url.length < 50)
    {
      dwn="File tidak ditemukan";
      url="#";
      link='<a href="' + url + '"><b>'+dwn+'</b></a>';
    }
    else
    {
      dwn="Download";
      link='<a href="' + url + '" download="'+f+'" ><b>'+dwn+'</b></a>';
    }
    return link;
}});  



$(".print_data_mahasiswa").colorbox({iframe:true, innerWidth:800, innerHeight:550, title: function(){
    var url2 = $(this).attr('href');
    var nomor_pendaftar=$(this).attr('value');
     
     var link2='<a href="' + url2 + '" download="Data_camaba_'+nomor_pendaftar+'.pdf" ><b>Download</b></a>';
    
    return link2;
}}); 

    })

function data_mahasiswa(dms)
{
	var nomor_pendaftar=dms.value;
	var no=$('#'+dms.id).attr('isi');
	var kode_penawaran=<?php echo $kode_penawaran; ?>;

		$('#xxx'+nomor_pendaftar).attr("href","<?php echo base_url('adminpmb/data_mhs/cetak_data_mhs/"+nomor_pendaftar+"/"+kode_penawaran+"') ?>");
		$('#xxx'+nomor_pendaftar).attr('value',nomor_pendaftar)
		$('#xxx'+nomor_pendaftar).click();

}

function simpan_nilai_mhs (iam) 
{
  $.ajax({
    url: "<?php echo base_url('adminpmb/input_data_c/simpan_nilai_mhs'); ?>",
    type: "POST",
    data: $('#form-'+iam.value).serialize(),
    success: function(bhs_nilai)
    { 
      alert(bhs_nilai);
    }
  });
 
}

function sertifikat(ser)
{
  var nomor_pendaftar=$('#'+ser.id).attr('akun');
  var link;
  var ktg;
  switch(ser.id)
  {
  case 'tpa'+nomor_pendaftar :
    
    link="2tpa"+nomor_pendaftar;
    ktg="sertifikat_gre";

  break;
  case 'toa'+nomor_pendaftar :
    
    link="2toa"+nomor_pendaftar;
    ktg="sertifikat_toafl";
  
  break;
  case 'toe'+nomor_pendaftar :
    
    link="2toe"+nomor_pendaftar;
    ktg="sertifikat_toefl";

  break;
  case 'indo'+nomor_pendaftar :
    
    link="2indo"+nomor_pendaftar;
    ktg="sertifikat_bhs_indo";

  break;
  case 'kp'+nomor_pendaftar :
    
    link="2kp"+nomor_pendaftar;
    ktg="sertifikat_pendukung";

  break;
}

    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/lihat_sertifikat'); ?>",
      type: "POST",
      data: "nomor_pendaftar="+nomor_pendaftar+"&pencarian="+ktg,
      success: function(sertifikat_cuy)
      {
       $('#'+link).attr('href',sertifikat_cuy);
       var extd="<?php get_extendsion("+sertifikat_cuy+") ?>";
        $('#'+link).attr('title',extd);
       $('#'+link).click();
      } 
    });

}


function trans(tr)
{
  var no=$('#'+tr.id).attr('isi');
    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/lihat_transkrip'); ?>",
      type: "POST",
      data: "nomor_pendaftar="+tr.value,
      success: function(tras)
      {
       $('#tra'+no).attr('href',tras);
       var extd="<?php get_extendsion("+tras+") ?>";
        $('#tra'+no).attr('title',extd);
       $('#tra'+no).click();
      } 
    });
}

  function ijasah(ij)
  {
    var no=$('#'+ij.id).attr('isi');
    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/lihat_ijazah'); ?>",
      type: "POST",
      data: "nomor_pendaftar="+ij.value,
      success: function(ija)
      {
       $('#ij'+no).attr('href',ija);
       var extd="<?php get_extendsion("+ija+") ?>";
       $('#ij'+no).attr('title',extd);
       $('#ij'+no).click();
      } 
    });
  }

  function proposal(prop)
  {
    var no=$('#'+prop.id).attr('isi');
    var nomor_pendaftar=$('#'+prop.id).attr('akun');
    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/lihat_proposal'); ?>",
      type: "POST",
      data: "nomor_pendaftar="+nomor_pendaftar,
      success: function(prp){
       
       	$('#pr2'+no).attr('href',prp);
        var extd="<?php get_extendsion("+prp+") ?>";
        $('#pr2'+no).attr('title',extd);
        $('#pr2'+no).click();
      }

    });

  }

  function proposal_tesis(prop)
  {
     var no=$('#'+prop.id).attr('isi');
    var nomor_pendaftar=$('#'+prop.id).attr('akun');

    $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/lihat_proposal_tesis'); ?>",
      type: "POST",
      data: "nomor_pendaftar="+nomor_pendaftar,
      success: function(prp){
       
         $('#proposal_s2'+no).html(prp);
        var tesis= $('#tesisnya'+nomor_pendaftar).val();
        var rekomen=$('#rekomendasinya'+nomor_pendaftar).val();
         
         $('#prt2'+no).attr('href',tesis);
        var extd="<?php get_extendsion("+tesis+") ?>";
        $('#prt2'+no).attr('title',extd);

         $('#prt3'+no).attr('href',rekomen);
        var extd2="<?php get_extendsion("+rekomen+") ?>";
        $('#prt3'+no).attr('title',extd2);

        $('#prt2'+no).slideDown('slow');
        $('#prt3'+no).slideDown('slow');

      }

    });

  }

  function publikasi(pb)
  {
      
    var no=$('#'+pb.id).attr('isi');
    $('#pub2'+no).slideDown('slow');
    $("#pub2"+no).html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
    
     $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/lihat_publikasi'); ?>",
      type: "POST",
      data: "nomor_pendaftar="+pb.value,
      success: function(pub)
      {
        $('#pub2'+no).hide();
        $('#pub2'+no).html(pub);
        $('#pub2'+no).slideDown('slow');
      }
    });

  }

  function rekomendasi(rek)
  {
    
    var no=$('#'+rek.id).attr('isi');
   
     $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/lihat_rekomendasi'); ?>",
      type: "POST",
      data: "nomor_pendaftar="+rek.value,
      success: function(reko)
      {
        if(reko != '0')
        {
           $('#rek'+no).attr('href',reko);
           var extd="<?php get_extendsion("+reko+") ?>";
        $('#rek'+no).attr('title',extd);
           $('#rek'+no).click();
        }
        else
        {
          alert("Tidak memiliki dokumen rekomendasi.");
        }
      }
    });


  }

  function file_publikasi(fp)
  {
   
   var isi=$('#'+fp.id).attr('isi');
   $('#ini_karya').attr('href',isi);
   var file=$('#ini_karya').attr('href');
   
   $('#ini_karya').attr('href',isi);
   var extd="pdf";
   
   $('#ini_karya').attr('title',extd);
  $('#ini_karya').click();


  }
</script>