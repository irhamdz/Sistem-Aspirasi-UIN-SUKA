<?php
$urut=0;
echo "<ul>";
foreach($isi as $key => $val){
	$urut++;
	if($urut>10){
		break;
	}
	$nilai=$val['SEKOLAH_NPSN']."#".$val['SEKOLAH_NAMA'];
	?>
	<li onclick="npsn_isi('<?php echo $lokasi ?>','<?php echo $nilai;?>')">		
		<?php echo $val['SEKOLAH_NAMA']?>		
	</li>
	<?php
	
}
if($urut<1){
	?>
	<li class='nope'>Data tidak ditemukan...</li>
	<?php
}
echo "</ul>";
?>