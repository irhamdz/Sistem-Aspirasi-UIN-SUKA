	<?php 
	$arr_w0 = array(0 => 'Mata Kuliah', 1 => 'Dosen');
	$arr_w2 = array(0 => 'Dosen Dalam Program Studi', 1 => 'Dosen Luar Program Studi');
	$arr_w3 = array(0 => 'Dosen Tetap PNS', 1 => 'Dosen Luar Biasa');
	$arr_w1 = array();
	for($i = 0; $i < count($prodi); $i++){
		if(isset($prodi[$i])){
		// $arr_w1[$prodi[$i]['KD_PRODI']] = $prodi[$i]['NM_PRODI']; 
		$arr_w1[$prodi[$i]['KD_PRODI']] = $prodi[$i]['NM_PRODI_J']; 
		}
	}
	echo form_open($url_s0,array('name' => 'form_sia_mkdosen')); ?>
			<div class="form-group">
				<label for="sel_w0" class="col-sm-2 control-label">Jenis</label>
				<div class="col-sm-6">
					<?php echo form_dropdown('sel_w0', $arr_w0, $i_w0, 'class="form-control input-sm"'); ?>
				</div>
			</div>
				<div class="clear10"></div>	
			<div class="form-group">
				<label for="sel_w1" class="col-sm-2 control-label">Program Studi</label>
				<div class="col-sm-6">
					<?php echo form_dropdown('sel_w1', $arr_w1, $i_w1,'class="form-control input-sm"'); ?>
				</div>
			</div>
			<div class="clear10"></div>	
	<div id="area01">
		<?php if(isset($i_sel0)){ echo $i_sel0; } ?>
	</div>
	<?php echo form_close(); ?>
	<script>
	$(document).ready(function() {
		
		$('select[name=sel_w0]').change(function(){ show_02(); });
		$('select[name=sel_w1]').change(function(){ show_02(); });
		
		var $loader_text = '<br><center><img src="<?php echo base_url('asset/img/loading.gif'); ?>"><br>Harap menunggu</center><br>';
		var $init_js = <?php echo $init_js; ?>;
		var $ws0 = '<?php if($i_w0 != ''){ echo $i_w0; } else { echo '0'; } ?>';
		var $ws1 = '<?php if($i_w1 != ''){ echo $i_w1; } else { echo '0'; } ?>';
		var $ws2 = '<?php if($i_w2 != ''){ echo $i_w2; } else { echo '2'; } ?>';
		var $ws3 = '<?php if($i_w3 != ''){ echo $i_w3; } else { echo '2'; } ?>';
		var $ws4 = '<?php if($data['i_w4'] != ''){ echo $data['i_w4']; } else { echo '0'; } ?>';
		var $ws5 = '<?php if($data['i_w5'] != ''){ echo $data['i_w5']; } else { echo '0'; } ?>';
				
		function show_02(){
			var $kw0 	= $.trim($('select[name=sel_w0] option:selected').val());
			var $kw1 	= $.trim($('select[name=sel_w1] option:selected').val());
			
			$ws0		= $kw0;
			$ws1		= $kw1;
			
			if($('select[name=sel_w2]').length){ $ws2 = $.trim($('select[name=sel_w2] option:selected').val()); }
			if($('select[name=sel_w3]').length){ $ws3 = $.trim($('select[name=sel_w3] option:selected').val()); }
			if($('select[name=sel_w4]').length){ $ws4 = $.trim($('select[name=sel_w4] option:selected').val()); }
			if($('select[name=sel_w5]').length){ $ws5 = $.trim($('select[name=sel_w5] option:selected').val()); }
			
			$param = new Array(); $param['v_ws0'] = $ws0; $param['v_ws1'] = $ws1; $param['v_ws2'] = $ws2; 
			$param['v_ws3'] = $ws3; $param['v_ws4'] = $ws4; $param['v_ws5'] = $ws5; 
			console.log($param);
			
			//console.log($kw1+$kw0);
			if($kw0 != '' && $kw1 != ''){
				$ajax01 = $.ajax({ type: "POST", cache: false, dataType: "html", 
				data: {'v_ws0': $ws0, 'v_ws1': $ws1,'v_ws2': $ws2, 'v_ws3': $ws3,'v_ws4': $ws4,'v_ws5': $ws5}, 
				url: "<?php echo site_url($url_s0);?>", 
				beforeSend: function(){ $('#area01').html($loader_text); }
				});
				
				$ajax01.done(function(data){
					//console.log(data);
					$('#area01').html(data);
					
				});
								
			}
		}
		
		//if($init_js == 1){ show_02(); }
		
	});
	</script>