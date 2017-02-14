<?php
function get_image($data_uri)
{
	
	$data=pg_unescape_bytea($data_uri);
	$data_uri=str_replace('data:image/jpeg;base64,', '', $data);
	$foto=base64_decode($data_uri);
	$lagi=base64_encode($foto);
	$logo='@'.$lagi;
	return $logo;
		//
}
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<link href="<?php echo base_url('asset/style_album_ujian_1.css'); ?>" rel="stylesheet" type="text/css"/>
<h3>Data Diri</h3>
  <table cellspacing="0" cellpadding="1" border="0.5px">
    <tbody>
    <?php
    if(!is_null($diri))
    {
      $no_diri=0;
      foreach ($diri as $d);
      
          echo '<tr>';
          echo '<td width="100px">';
          echo "Nama ";
          echo "</td>";
          echo '<td width="100px">';
          echo $d->nama_lengkap;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Jenis Kelamin ";
          echo "</td>";
          echo "<td>";
          echo $d->jenis_kelamin;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Tanggal Lahir ";
          echo "</td>";
          echo "<td>";
          echo tanggal_hari(date_format(date_create($d->tgl_lahir),'d-m-Y'));
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Agama ";
          echo "</td>";
          echo "<td>";
          echo $d->nama_agama;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Telp/Hp ";
          echo "</td>";
          echo "<td>";
          echo $d->telp.' / '.$d->nohp;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Alamat ";
          echo "</td>";
          echo "<td>";
          echo $d->alamat_lengkap;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Warga Negara ";
          echo "</td>";
          echo "<td>";
          echo $d->nama_negara;
          echo "</td>";
          echo "</tr>";

          
        
      }
      ?>
    </tbody>
  </table> 
  <h3>Data Orang Tua</h3>
  <table cellspacing="0" cellpadding="1" border="0.5px">
    <tbody>
    <?php
    if(!is_null($ibu) && !is_null($ayah))
    {
      $no_ortu=0;
      foreach ($ibu as $ibux);
        echo "<tr>";
          echo "<td>";
          echo "Nama Ibu";
          echo "</td>";
          echo "<td>";
          echo  $ibux->nama_lengkap_ibu;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Status Ibu";
          echo "</td>";
          echo "<td>";
          echo  $ibux->nama_status;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Alamat";
          echo "</td>";
          echo "<td>";
          echo  $ibux->alamat_lengkap_ibu;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Pekerjaan";
          echo "</td>";
          echo "<td>";
          echo  $ibux->nama_pekerjaan;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Golongan";
          echo "</td>";
          echo "<td>";
          echo  $ibux->golongan_ibu;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Agama";
          echo "</td>";
          echo "<td>";
          echo  $ibux->nama_agama;
          echo "</td>";
          echo "</tr>";
      
      foreach ($ayah as $ay);
        echo "<tr>";
        
          echo "<td>";
          echo "Nama Ayah";
          echo "</td>";
          echo "<td>";
          echo  $ay->nama_lengkap_ayah;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Status Ayah";
          echo "</td>";
          echo "<td>";
          echo  $ay->nama_status;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Alamat";
          echo "</td>";
          echo "<td>";
          echo  $ay->alamat_lengkap_ayah;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Pekerjaan Ayah";
          echo "</td>";
          echo "<td>";
          echo  $ay->nama_pekerjaan;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Golongan";
          echo "</td>";
          echo "<td>";
          echo  $ay->golongan_ayah;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Agama";
          echo "</td>";
          echo "<td>";
          echo  $ay->nama_agama;
          echo "</td>";
          echo "</tr>";
      
    }
    ?>
    </tbody>
  </table>

  <h3>Pekerjaan Mahasiswa</h3>
  <table cellspacing="0" cellpadding="1" border="0.5px">
    <tbody>
    <?php
    if(!is_null($pkj))
    {
      $no_pkj=0;
      foreach ($pkj as $pk);
        
          echo "<tr>";
          echo "<td>";
          echo "Nama Pekerjaan";
          echo "</td>";
          echo "<td>";
          if(strlen($pk->nama_pekerjaan)>0)
          {
            echo  $pk->nama_pekerjaan;
          }
          else
          {
            echo "-";
          }
          echo "</td>";
          echo "</tr>";
      
    }
    ?>
    </tbody>
  </table>
  <h3>Kesehatan Mahasiswa</h3>
  <table cellspacing="0" cellpadding="1" border="0.5px">
    <tbody>
    <?php
    if(!is_null($sehat))
    {
      $no_sehat=0;
      foreach ($sehat as $s);
        echo "<tr>";
          echo "<td>";
          echo "Riwayat Kesehatan";
          echo "</td>";
          echo "<td>";
          if(strlen($s->riwayat_penyakit)>0)
          {
            echo  $s->riwayat_penyakit;
          }
          else
          {
            echo "-";
          }
          echo "</td>";
          echo "</tr>";
      
    }

    if(!is_null($difable))
    {
      $no_dif=0;
      foreach ($difable as $dif) {
        echo "<tr>";
          echo "<td>";
          echo "Kemampuan Berbeda ";
          echo "</td>";
          echo "<td>";
          if(count($dif)>0)
          {
            echo $dif->kondisi_kesehatan;
          }
          else
          {
            echo "Normal";
          }
          echo "</td>";
          echo "</tr>";
      }
    }

    ?>
    </tbody>
  </table>
<h3>Prestasi Mahasiswa</h3>
  <?php
  if(count($prestasi)<1)
  {
    echo "Tidak Ada.";
  }
  else
  {
  ?>
  <table cellspacing="0" cellpadding="1" border="0.5px">
    <tbody>
    <?php
    if(!is_null($prestasi))
    {
      $no_pr=0;
      foreach ($prestasi as $pr) {
        
          echo "<tr>";
          echo "<td>";
          echo "Nama Perlombaan";
          echo "</td>";
          echo "<td>";
          echo $pr->nama_perlombaan;
          echo "</td>";
          echo "</tr>";
          
          echo "<tr>";

          echo "<td>";
          echo "Juara";
          echo "</td>";
          echo "<td>";
          echo $pr->juara_ke;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
      
          echo "<td>";
          echo "Nama Jenis Perlombaan";
          echo "</td>";
          echo "<td>";
          echo $pr->nama_jenis;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Tingkat";
          echo "</td>";
          echo "<td>";
          echo $pr->nama_tingkat;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Nama Penyelenggara";
          echo "</td>";
          echo "<td>";
          echo $pr->nama_penyelenggara;
          echo "</td>";
          echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
    }
  }
    ?>
  <br>
  <h3>Riwayat Pendidikan</h3>
  <table cellspacing="0" cellpadding="1" border="0.5px">
    <tbody>
    <?php
    if(!is_null($dokumen))
    {
      $no_doc=0;
      foreach ($dokumen as $doc);
        if($jalur == '3' || $jalur=='2')
        {
          echo "<tr>";
          echo "<td>";
          echo "Nama Perguruan Tinggi";
          echo "</td>";
          echo "<td>";
          echo  $doc->nama_pt;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Akreditasi";
          echo "</td>";
          echo "<td>";
          echo  $doc->akreditasi;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "IPK";
          echo "</td>";
          echo "<td>";
          echo  $doc->ipk;
          echo "</td>";
          echo "</tr>";

          echo "<tr>";
          echo "<td>";
          echo "Tahun Lulus";
          echo "</td>";
          echo "<td>";
          echo  $doc->tahun_ijazah;
          echo "</td>";
          echo "</tr>";
        
          }

      
    }

    ?>
    </tbody>
  </table>
  <br>
<?php if($jalur != '1'){ ?>
<h3>Karya Tulis</h3>
  <table cellspacing="0" cellpadding="1" border="0.5px">
    <?php
    echo "<thead>";
        echo "<tr>";
          echo '<th width="20px" >';
          echo "No";
          echo "</th>";
          echo '<th width="100px">';
          echo "Judul";
          echo "</th>";
          echo "</tr>";
        echo "</thead>";
  echo "<tbody>";   
    if(!is_null($karya))
    { 

$no_kar=0;
      foreach ($karya as $kar) {
        if(strlen($kar->judul)>5)
        {
            echo "<tr>";
            echo '<td width="20px">';
            echo $no_kar+=1;
            echo "</td>";
            echo '<td width="100px">';
            echo $kar->judul;
            echo "</td>";
            echo "</tr>";
          
        }
      }
    }
echo "</tbody>";
    ?>
    
  </table>
  <?php } ?>
<br>
<?php if($jalur != '1'){ ?>
  <h3>Proposal Penelitian</h3>
  <table cellspacing="0" cellpadding="1" border="0.5px">
    <tbody>
    <?php
    if(!is_null($proposal))
    {
      foreach ($proposal as $prp) {
        
          echo "<tr>";
          echo "<td>";
          echo "Judul Proposal Disertasi";
          echo "</td>";
          echo "<td>";
          echo $prp->judul;
          echo "</td>";
          echo "</tr>";
      }
    }
    ?>
    </tbody>
  </table>
  <?php } ?>
<br>
<h3>Pilihan Jurusan</h3>
  <table cellspacing="0" cellpadding="1" border="0.5px">
    <tbody>
    <?php
    if(!is_null($piljur))
    {

      foreach ($piljur as $jur) {
        
          echo "<tr>";
          echo '<td width="20px">';
          echo "Pilihan ". $jur->pilihan;
          echo "</td>";
          echo '<td width="100px">';
          echo $jur->nama_prodi.' Jenjang : '.$jur->nama_jenjang;
          echo "</td>";
          echo '<td width="25px">';
          echo $jur->nama_kelas;
          echo "</td>";
          echo "</tr>";
      }
    }
    ?>
    </tbody>
  </table>
	<!--
<br /><br />
 <table class="none" cellpadding="2" cellspacing="0" width="240px">
 <tr><td align="right"><i>Halaman  dari </i></td></tr></table>
  <br />
 <br />
 <br />
-->