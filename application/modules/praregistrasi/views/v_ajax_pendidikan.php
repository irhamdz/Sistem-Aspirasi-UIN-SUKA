<?php
if(count($hasil)>0){
	echo "<select name='KD_SEKOLAH_ASAl' style='width:300px'>";
}
$selected='';
foreach($hasil as $key => $val){
	$KD_SEKOLAH=$val['KD_SEKOLAH'];
	$NM_SEKOLAH=$val['NM_SEKOLAH'];
	if($KD_SEKOLAH_ASAL){
		if($KD_SEKOLAH_ASAL==$KD_SEKOLAH){
			$selected="selected";
		}else{
			$selected='';
		}
	}
	?>
	<option <?php echo $selected; ?> value='<?php echo $KD_SEKOLAH ?>'><?php echo $NM_SEKOLAH ?></option>
	<?php
}
if(count($hasil)>0){
	echo "</select>";
}
?>