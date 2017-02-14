<h3 style="margin-bottom:10px;">Dokumen Calon Mahasiswa Baru. Klik pada <b>Nilai Sertifikat</b> untuk melihat sertifikat.</h3>
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

$tpa=array();
$arab=array();
$bing=array();
$indo=array();
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
?>
	<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="top" width="5">No.</th>
      <th valign="top" width="50">PESERTA</th>
      <th valign="top" width="100">DOKUMEN PMB</th>
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
      echo $mhs->nomor_peserta;
      echo "<hr>";
      echo $mhs->nama_lengkap;
      echo "</td>";
      echo "<td>";
      echo "Tahun Lulus : ".$mhs->tahun_ijazah;
      echo "<hr>";
      echo "IPK : ".$mhs->ipk;
      echo "<hr>";
      echo "Akreditasi : ".$mhs->akreditasi;
      echo "<hr>";
      echo "<button class='btn btn-inverse btn-small' type='button' isi='".$num."' onclick='ijasah(this)' value='".$mhs->nomor_pendaftar."' id='ijz".$num."'><span class='icon-white icon-search'></span> IJAZAH</button>";
      echo "<a class='tampil_file' isi='ijazah-".$mhs->nomor_pendaftar.".' style='display:none;' id='ij".$num."'></a>";
      echo " <button class='btn btn-inverse btn-small' type='button' isi='".$num."' onclick='trans(this)' value='".$mhs->nomor_pendaftar."' id='transkrip".$num."'><span class='icon-white icon-search'></span> TRANSKRIP</button>";
      echo "<a class='tampil_file' isi='transkrip-".$mhs->nomor_pendaftar.".' style='display:none;' id='tra".$num."'></a>";
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
                    echo "[".str_replace('1','',str_replace('_',' ',$tp->id_sertifikat))."]";
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
                    echo "[".str_replace('2','',str_replace('_',' ',$rb->id_sertifikat))."]";
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
                    echo "[".str_replace('3','',str_replace('_',' ',$bng->id_sertifikat))."]";
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
      echo "<table id='pub2".$num."' class='table table-bordered'></table>";
      echo "<a class='tampil_file' id='ini_karya' isi='publikasi-".$mhs->nomor_pendaftar."' style='display:none;'></a>";
      
      echo "<button class='btn btn-inverse btn-small' type='button' isi='".$num."' onclick='rekomendasi(this)' value='".$mhs->nomor_pendaftar."' id='reko".$num."'><span class='icon-white icon-search'></span> REKOMENDASI</button>";
      echo "<a class='tampil_file' isi='rekomendasi-".$mhs->nomor_pendaftar.".' style='display:none;' id='rek".$num."'></a>";
      echo "<hr>";
       if($jalur=='3')
      {
     
          echo "PROPOSAL: <a onclick='proposal(this)' href='#' akun='".$mhs->nomor_pendaftar."' isi='".$num."' id='pr".$num."'>".$mhs->judul."</a>";
          echo "<a class='tampil_file' isi='".$mhs->judul.".' style='display:none;' id='pr2".$num."'></a>";
  
      }
      
       if($jalur=='2')
      {
      
          echo "PROPOSAL : <a onclick='proposal_tesis(this)' href='#' akun='".$mhs->nomor_pendaftar."' isi='".$num."' id='prt".$num."'>".$mhs->judul_tesis."</a><br>";
          echo "<a class='tampil_file' isi='".$mhs->judul_tesis.".' style='display:none;' id='prt2".$num."'> FILE PROPOSAL |</a>";
          echo "<a class='tampil_file' isi='".$mhs->judul_tesis.".' style='display:none;' id='prt3".$num."'> REKOMENDASI </a>";
          echo "<div id='proposal_s2".$num."' style:'display:none;'><input type='hidden' id='tesisnya".$mhs->nomor_pendaftar."'>";
          echo "<input type='hidden' id='rekomendasinya".$mhs->nomor_pendaftar."'></div>";
      }
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
    })

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

  function publikasi(pb)
  {
    
    var no=$('#'+pb.id).attr('isi');

    $("#pub2"+no).html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
      
     $.ajax({
      url: "<?php echo base_url('adminpmb/input_data_c/lihat_publikasi'); ?>",
      type: "POST",
      data: "nomor_pendaftar="+pb.value,
      success: function(pub)
      {
        $('#pub2'+no).html(pub);
       
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
       /*
        $('#prt2'+no).attr('href',prp);
        var extd="<?php get_extendsion("+prp+") ?>";
        $('#prt2'+no).attr('title',extd);
        $('#prt2'+no).click();
        */
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
   var extd="<?php get_extendsion("+isi+") ?>";
   $('#ini_karya').attr('title',extd);
   $('#ini_karya').click();
  }
</script>