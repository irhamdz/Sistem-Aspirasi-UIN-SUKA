<script>
$(document).ready(function() {
	$loader_gif = '<li style="text-align:center;"><img src="<?php echo asset_img_url('loading.gif'); ?>"></li>';
	$('#sia_front_p01').empty().append($loader_gif);
	$ajax01 = $.ajax({type: "POST", cache: false, dataType: "html", url: '<?php echo current_url(); ?>', 
			data: { kategori_hash: '<?php echo $this->s00_lib_siaenc->encrypt('100//'.rand(100,999)); ?>' } });
	$ajax01.done(function($d1){ $('#sia_front_p01').empty().append($d1); });
	$('#sia_front_p02').empty().append($loader_gif);
	$ajax02 = $.ajax({type: "POST", cache: false, dataType: "html", url: '<?php echo current_url(); ?>', 
			data: { kategori_hash: '<?php echo $this->s00_lib_siaenc->encrypt('105//'.rand(100,999)); ?>' } });
	$ajax02.done(function($d2){ $('#sia_front_p02').empty().append($d2); });
	$loader_gif = '<img src="<?php echo asset_img_url('loading.gif'); ?>">';
	$('#sia_front_p03').empty().append($loader_gif);
	$ajax03 = $.ajax({type: "POST", cache: false, dataType: "html", url: '<?php echo current_url(); ?>', 
			data: { kategori_hash: '<?php echo $this->s00_lib_siaenc->encrypt('110//'.rand(100,999)); ?>' } });
	$ajax03.done(function($d3){ $('#sia_front_p03').empty().append($d3); });
});
</script>	



<?php


?>