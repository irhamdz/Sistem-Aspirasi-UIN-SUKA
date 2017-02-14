<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=document_name.xls");
$mentri="";
$kampus="";
$alamat="";
$email="";
$telp="";
$tahun_akademik="";
$tanggal_dokumen="";
$pejabat="";
$jabatan="";
$no_doc="";
$log="";
$nip="";
$keterangan="";

if(!is_null($config))
{
  foreach ($config as $cf);
    $no_doc=$cf->nomor;
    $mentri=$cf->kementrian;
    $kampus=$cf->unit;
    $alamat=$cf->alamat;
    $email=$cf->email;
    $telp=$cf->telp;
    $tahun_akademik=$cf->tahun;
    $tanggal_dokumen=$cf->tanggal;
    $pejabat=$cf->nama;
    $jabatan=$cf->jabatan;
    $nip=$cf->nip;
    $keterangan=$cf->keterangan;
    $nama_doc=$cf->nama_dokumen;
}

/*
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
*/
?>

<link href="<?php echo base_url('asset/style_album_ujian_1.css'); ?>" rel="stylesheet" type="text/css"/>
<style type="text/css">
  .tb_cetak {
    border: 1px solid black;
}
.tr_cetak {
    border: 1px solid black;
    padding: 5px;
    color: black;
}
.td_cetak {
    border: 1px solid black;
    padding: 5px;

}
</style>
<?php
$jml=0;
if(!is_null($data_mhs))
{
  $jml=count($data_mhs);
}

?>

      <b>Lampiran:</b><br/>
   
      <b><?php echo $nama_doc; ?></b><br/>
   
      <b>Nomor: <?php echo $no_doc; ?></b><br/>
    
      <b><?php echo $keterangan; ?></b><br/>
    
      <b><?php echo strtoupper($kampus); ?></b><br/>

      <div style="font-weight:bold; margin:10px 0;">Program Studi : <?php echo $nama_prodi; ?></div>
      <br/>
              <table class="table table-bordered">
              <thead>
                <tr >
                  <td class="td_cetak" width="50"><b>No</b></td>
                  <td class="td_cetak" width="90"><b>No Peserta PMB</b></td>
                  <td class="td_cetak" width="100"><b>Nama</b></td>
                </tr> 
              </thead>
              <tbody>
                  <?php $num=0; if(!is_null($data_mhs)){
                    foreach ($data_mhs as $mhs) {
                     ?>
                   
                  <tr >
                  <td class="td_cetak" width="50"><?php  echo $num+=1; ?></td>
                  <td class="td_cetak" width="90"><?php echo $mhs->nomor_peserta; ?></td>
                  <td class="td_cetak" width="100"><?php echo $mhs->nama_lengkap; ?></td>
                  </tr>
                  <?php 
                   }
                  }
                     ?>
                 </tbody>
                  </table>

<br/>
<br/>

  	<table align="right">
		<tbody><tr>
			<td align="center"></td>
			<td></td>
			<td align="center">Yogyakarta, <?php echo tanggal_indonesia($tanggal_dokumen); ?><br><?php echo str_replace('_', ' ', $jabatan);?>,</td></tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center"><br><br><br><br></td>
			</tr>
			<tr>
				<td align="center"></td>
				<td></td>
				<td align="center"><?php echo $pejabat;?></td>
			</tr>
			<tr>
				<td align="center"></td>
				<td></td>
				<td align="center"><u>NIP: <?php echo $nip;?></u></td>
			</tr>
		</tbody>
	</table>