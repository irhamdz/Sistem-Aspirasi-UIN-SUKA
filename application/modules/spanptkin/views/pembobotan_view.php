
					<div class="content-value">
						
						<script type="text/javascript" charset="utf-8">
								
								 $(function() {
									$('.numeric').keyup(function() {
									 	$(this).val($(this).val().replace(/[^0-9]/, ''));
									});	
									
									$('.bobot').keyup(function() {
										var total=0;
										for(var i=1; i<=$('.bobot').length;i++){
											var bobot=parseInt($("#bobot"+i).val());
											total+=bobot;
										}
										$("#total").text('');
										$("#total").text(total);
									});
									
									$('.bjs').keyup(function() {
										var totalbjs=0;
										for(var i=1; i<=$('.bjs').length;i++){
											var bobot=parseInt($("#bjs"+i).val());
											totalbjs+=bobot;
										}
										$("#totalbjs").text('');
										$("#totalbjs").text(totalbjs);
									});
									
									$('.bks').keyup(function() {
										var totalbks=0;
										for(var i=1; i<=$('.bks').length;i++){
											var bobot=parseInt($("#bks"+i).val());
											totalbks+=bobot;
										}
										$("#totalbks").text('');
										$("#totalbks").text(totalbks);
									});
									
									$('.bas').keyup(function() {
										var totalbas=0;
										for(var i=1; i<=$('.bas').length;i++){
											var bobot=parseInt($("#bas"+i).val());
											totalbas+=bobot;
										}
										$("#totalbas").text('');
										$("#totalbas").text(totalbas);
									});
									
									$('.bkabs').keyup(function() {
										var totalbkabs=0;
										for(var i=1; i<=$('.bkabs').length;i++){
											var bobot=parseInt($("#bkabs"+i).val());
											totalbkabs+=bobot;
										}
										$("#totalbkabs").text('');
										$("#totalbkabs").text(totalbkabs);
									});
									
									$('.bprovs').keyup(function() {
										var totalbprovs=0;
										for(var i=1; i<=$('.bprovs').length;i++){
											var bobot=parseInt($("#bprovs"+i).val());
											totalbprovs+=bobot;
										}
										$("#totalbprovs").text('');
										$("#totalbprovs").text(totalbprovs);
									});
									
									/* VALIDASI SUBMIT */
									$("#bjsform").submit(function(){
										if(validateBjs())
											return true
										else
											return false;
									});
									
									function validateBjs(){
										var totalbjs=0;
										for(var i=1; i<=$('.bjs').length;i++){
											var bobot=parseInt($("#bjs"+i).val());
											totalbjs+=bobot;
										}
										if(totalbjs!=100){
											$("#bjs_msg").html("");
											$("#bjs_msg").html("<div class='msg_alert alert alert-error'>Total bobot harus 100%.</div>");
											return false;
										}else{
											$("#bjs_msg").html("");
											return true;
										}
									}
									
									$("#bksform").submit(function(){
										if(validateBks())
											return true
										else
											return false;
									});
									function validateBks(){
										var totalbks=0;
										for(var i=1; i<=$('.bks').length;i++){
											var bobot=parseInt($("#bks"+i).val());
											totalbks+=bobot;
										}
										if(totalbks!=100){
											$("#bks_msg").html("");
											$("#bks_msg").html("<div class='msg_alert alert alert-error'>Total bobot harus 100%.</div>");
											return false;
										}else{
											$("#bks_msg").html("");
											return true;
										}
									}
									
									$("#basform").submit(function(){
										if(validateBas())
											return true
										else
											return false;
									});
									function validateBas(){
										var totalbas=0;
										for(var i=1; i<=$('.bas').length;i++){
											var bobot=parseInt($("#bas"+i).val());
											totalbas+=bobot;
										}
										if(totalbas!=100){
											$("#bas_msg").html("");
											$("#bas_msg").html("<div class='msg_alert alert alert-error'>Total bobot harus 100%.</div>");
											return false;
										}else{
											$("#bas_msg").html("");
											return true;
										}
									}
									
									$("#bkabsform").submit(function(){
										if(validatebkabs())
											return true
										else
											return false;
									});
									function validatebkabs(){
										var totalbkabs=0;
										for(var i=1; i<=$('.bkabs').length;i++){
											var bobot=parseInt($("#bkabs"+i).val());
											totalbkabs+=bobot;
										}
										if(totalbkabs!=100){
											$("#bkabs_msg").html("");
											$("#bkabs_msg").html("<div class='msg_alert alert alert-error'>Total bobot harus 100%.</div>");
											return false;
										}else{
											$("#bkabs_msg").html("");
											return true;
										}
									}
									
									$("#bprovsform").submit(function(){
										if(validatebprovs())
											return true
										else
											return false;
									});
									function validatebprovs(){
										var totalbprovs=0;
										for(var i=1; i<=$('.bprovs').length;i++){
											var bobot=parseInt($("#bprovs"+i).val());
											totalbprovs+=bobot;
										}
										if(totalbprovs!=100){
											$("#bprovs_msg").html("");
											$("#bprovs_msg").html("<div class='msg_alert alert alert-error'>Total bobot harus 100%.</div>");
											return false;
										}else{
											$("#bprovs_msg").html("");
											return true;
										}
									}
									
								});
								$(function(){
									setTimeout('closing_msg()', 4000);
								})

								function closing_msg(){
									$(".bs-callout").slideUp();
								}
							</script>
							
						<?php $msg = $this->session->flashdata('message');?>
						<?php if(!empty($msg)):?>
							<div class="bs-callout bs-callout-<?php echo $msg[0]?>">
								<p><?php echo $msg[1]?></p>
							</div>
							
						<?php  endif;?>
				
						<div style="width:400px;">
							<div style="margin:20px 0;"><h3>SETTING PUTARAN (PILIHAN)</h3></div>
							<div id="bks_msg"></div>
							<form method="post" action="<?php echo site_url('spanptkin/pembobotan/set_putaran')?>">
							<input type="hidden" name="jenis_pembobotan" value="pembobotan kepemilikan sekolah" />
								<table class="table">
									<tr>
									<td>
									<?php 
										$putaran=$config->pilihan_aktif;
										
									?>
										<select name="putaran" class="form-control" style="width:60px">
										<?php 
										
										echo"<option value='0'> --- </option>";
										for($pt=1; $pt<=3;$pt++){
												if($pt==$putaran){
													echo"<option value='".$pt."' selected > ".$pt."</option>";
												}else{
													echo"<option value='".$pt."'> ".$pt."</option>";
												}
											}
										?>	
										</select>
									</td>
									<td><button type="submit" class="btn-uin btn btn-inverse">Simpan Setting Putaran</button></td>
									</tr>
								</table>
							</form>	
						</div>	
						<div style="width:400px;"><h3>PEMBOBOTAN</h3></div>
							<form method="post" action="">
							<input type="hidden" name="jenis_pembobotan" value="pembobotan" />
								<table class="table">
									<?php 
										$i=0 ;
										$total=0;
									?>
									<?php foreach($pembobotan as $p):
										$total+=$p->bobot;
									?>
									<?php ++$i ?>
									<tr>
										<td width="60%"><?php echo $p->nama_pembobotan ?></td>
										<td width="40%">
											<div class="input-group col-xs-4">
												<input id="bobot<?php echo $i; ?>" class="form-control numeric bobot"  style="text-align:right;" type="text" name="bobot[<?php echo $p->id_pembobotan ?>]" value="<?php echo $p->bobot ?>" maxlength="3" /> 
												<div class="input-group-addon">%</div>
											</div>
										</td>
									</tr>
									<?php endforeach ?>
									<tr>
										<td></td>
										<td><div style="width:70px; text-align:right;"><span style="margin-right:10px;" id="total"><?php echo $total ?></span> %</div></td>
									</tr>
								</table>
								<button type="submit" class="btn-uin btn btn-inverse btn">Simpan</button>	
							</form>	
						</div>						
					