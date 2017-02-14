				<h3>CEKLIST DOKUMEN REGISTRASI</h3>
					<div class="clear10"></div>
					<form method="post" action="">
					<div class="clear20"></div>
					 <div class="form-group form-group-sm">
							<label class="col-sm-1 control-label" for="formGroupInputSmall">NIM : </label>
							<div class="col-sm-4">
									<input  type="text" name="nim"  class="form-control"  />
							</div>
							<div class="col-sm-3">
								<button type="submit" class="btn btn-primary" style="margin-top:-2px;">Tampilkan</button>
							</div>
					<div class="clear20"></div>
						</div>
					</form>	
					<br>
					<?php if(isset($mhs) and !empty($mhs)){?>
					<b>Nama :</b> <?php echo $mhs[0]['NAMA']?><br>
					<b>NIM  :</b> <?php echo $mhs[0]['NIM']?>
					<br><br><br>
					<?php } ?>
					
				
					<?php if(isset($dokumen)and !empty($dokumen)){?>
							<table style="width:100%" class="table table-bordered table-hover">
								<tr>
									<th width="5%"><center>No</center></th>
									<th><center>Dokumen</center></th>
									<th width="25%"><center>Status</center></th>
								</tr>	
												
						<?php $i=0;?>
							<?php foreach($dokumen as $d){?>
								<tr>
									<td><?php echo ++$i?></td>
									<td>
									<?php echo $d['NAMA_DOKUMEN']?>
									</a>
									</td>
									<td style="text-align:center">
										<div class="btn-group">
											<?php $href=site_url('registrasi/cek_dokumen_registrasi/'.$nim.'/'.$d['KODE_DOKUMEN']); ?>
											<?php 
											
												if(isset($arr_ceklist[$d['KODE_DOKUMEN']])){
													if($arr_ceklist[$d['KODE_DOKUMEN']]=='1'){
											?>	
													  <button type="button" formaction="<?php echo $href.'/1'?>" type="button" class="sesuai btn btn-success">Ada</button>
													  <button type="button" formaction="<?php echo $href.'/0'?>" type="button" class="tidak_sesuai btn btn-default">Tidak Ada</button>
													<?php
													}else{
													?>
														<button type="button" formaction="<?php echo $href.'/1'?>" type="button" class="sesuai btn btn-default">Ada</button>
														<button type="button" formaction="<?php echo $href.'/0'?>" type="button" class="tidak_sesuai btn btn-danger">Tidak Ada</button>
													<?php }?>
													
										<?php
											//echo $arr_ceklist[$d['KODE_DOKUMEN']];
										}else{
												?>
											  <button type="button" formaction="<?php echo $href.'/1'?>" type="button" class="sesuai btn btn-default">Ada</button>
											  <button type="button" formaction="<?php echo $href.'/0'?>" type="button" class="tidak_sesuai btn btn-default">Tidak Ada</button>
										<?php } ?>
										
										</div>
									
									</td>
								</tr>
							<?php } ?>
							</table>
						<?php } ?>

	

				
<script type="text/javascript" charset="utf-8">

	$(document).on('click', '.sesuai', function () {
	var btn=$(this);
       
	//alert( $(this).attr('formaction'));
		$.ajax
		({		
		  type: "GET",
		  url: $(this).attr('formaction'),
		  dataType: 'json',
		  async: false,
		  success: function (data){
			btn.removeClass("btn-default");
			btn.addClass("btn-success");
			btn.next().removeClass("btn-danger");
			btn.next().addClass("btn-default");
		  }
		});
	} );

	$(document).on('click', '.tidak_sesuai', function () {
	var btn=$(this);
	
		$.ajax
		({		
		  type: "GET",
		  url: $(this).attr('formaction'),
		  dataType: 'json',
		  async: false,
		  success: function (data){
			btn.removeClass("btn-default");
			btn.addClass("btn-danger");
			btn.prev().removeClass("btn-success");
			btn.prev().addClass("btn-default");
		  }
		});
	} );

</script>








