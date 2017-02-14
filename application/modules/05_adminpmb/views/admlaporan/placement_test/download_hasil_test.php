<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Placement-Test.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<html xmlns:x="urn:schemas-microsoft-com:office:excel">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<style type="text/css">
	.num {
	  <!--- mso-number-format:"0\.00"; -->
	  mso-number-format:"General";
	}
	.text{
	  mso-number-format:"\@";/*force text*/
	}
	</style>
    <!--[if gte mso 9]>
    <xml>
    <x:ExcelWorkbook>
    <x:ExcelWorksheets>
	
    <x:ExcelWorksheet>
    <x:Name>Placement Test</x:Name>
    <x:WorksheetOptions>
    <x:Panes>
    </x:Panes>
    </x:WorksheetOptions>
    </x:ExcelWorksheet>
	
    </x:ExcelWorksheets>
    </x:ExcelWorkbook>
    </xml>
    <![endif]-->
  </head>
<?php if(isset($get_mhs) && !empty($get_mhs) && isset($opt) && !empty($opt)): ?>
<?php endif; ?>
<body>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="30px">No.</th>
      <th width="100px">NIM</th>
      <th>NAMA</th>
	  <th>NILAI</th>
      <th>PRODI</th>
      <th>FAKULTAS</th>
      <th>JENIS MAKUL</th>
    </tr>
  </thead>
  <tbody>
  <?php
    if(!isset($get_mhs) or empty($get_mhs)):
      echo '<td colspan="5" align="center">Data mahasiswa baru tidak ditemukan.</td>';
    else:
  	 $i = 0;
		#echo "<pre>"; print_r($get_mhs); echo "</pre>";
     foreach ($get_mhs as $key => $value):
     $i++;
	 if($value['KODE_SOAL']=='001'){
		$soal='Bahasa Arab';
	 }elseif($value['KODE_SOAL']=='002'){
	 	$soal='Bahasa Inggris';
	 }else{
		$soal=$value['KODE_SOAL'];
	 }
	  if($value['NILAI_TES']=='BELUM TES'){
		$nilai='-';
	 }else{
	 	$nilai=round($value['NILAI_TES'],2);
	 }
  ?>
    <tr>
      <td align="center"><?php echo $i;?>.</td>
      <td align="center"><?php echo $value['NIM'];?></td>
      <td><?php echo $value['NAMA'];?></td>
      <td align="center" class="num"><?php echo $nilai;?></td>
      <td align="center"><?php echo $value['NM_PRODI'];?></td>
      <td align="center"><?php echo $value['NM_FAK'];?></td>
      <td align="center"><?php echo $soal;?></td>
    </tr>    
  <?php
     endforeach;
    endif;
  ?>
  </tbody>
</table></body></html>