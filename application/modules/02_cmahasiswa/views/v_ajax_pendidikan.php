<?php
// PRINT_R($KD_PEND);
if(count($hasil)>0){
	echo "<select class='form-control input-sm'  name='KD_PEND' >";
}
$selected='';
foreach($hasil as $key => $val){
	$KD_SEKOLAH=$val['KD_SEKOLAH'];
	$NM_SEKOLAH=$val['NM_SEKOLAH'];
	if($KD_PEND){
		if($KD_PEND==$KD_SEKOLAH){
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