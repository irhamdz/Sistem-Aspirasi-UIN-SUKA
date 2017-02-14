<?php
$urut=0;
echo "<ul>";
foreach($isi as $key => $val){
	$urut++;
	if($urut>10){
		break;
	}
	$nilai=$val['KD_KAB']."#".$val['NM_KAB'];
	?>
	<li onclick="kabupaten_isi('<?php echo $lokasi ?>','<?php echo $nilai;?>');<?php if($propinsi=='1'){?>propinsi_isi('<?php echo $val['KD_KAB']?>');<?php }?>">		
		<?php echo $val['NM_KAB']?>		
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