		<div id="system-content">	
			<div id="content-space">
				<div>
					<h3>Daftar Pendaftar</h3>
					<div class="clear20"></div>
				
					<div class="content-value">
						<?php if(isset($a)):?>
							<div class="msg_alert alert alert-info">
								<?php echo $a ?>
							</div>
							
							<script type="text/javascript" charset="utf-8">
								$(function(){
									setTimeout('closing_msg()', 4000)
								})

								function closing_msg(){
									$(".msg_alert").slideUp();
								}
							</script>
						<?php  endif;?>
						
					
									
							<table class="table table-bordered table-hover">
								<tr>
									<th width="5%"><center>No</center></th>
									<th width="40%"><center>Prodi</center></th>
									<th width="20%"><center>Pil 1</center></th>
									<th width="20%"><center>Pil 2</center></th>
									<th width="20%"><center>Pil 3</center></th>
								</tr>	
							<?php $i=0; ?>	
							<?php 
							$pil1=0;
							$pil2=0;
							$pil3=0;
								if($arr_prodi !=null){
								foreach($arr_prodi as $prodi => $arr_pilihan){ 
									$class=""
								
							?>
								<tr class="<?php echo $class ?>">
								<td><?php echo ++$i ?></td>
								<td><?php echo $prodi ?></td>
								<td><?php if(isset($arr_pilihan['1']['PEMINAT'])) echo $arr_pilihan['1']['PEMINAT'] ?></td>
								<td><?php if(isset($arr_pilihan['2']['PEMINAT'])) echo $arr_pilihan['2']['PEMINAT'] ?></td>
								<td><?php if(isset($arr_pilihan['3']['PEMINAT'])) echo $arr_pilihan['3']['PEMINAT'] ?></td>
								</tr>
							<?php 
								$pil1+=$arr_pilihan['1']['PEMINAT'];
								$pil2+=$arr_pilihan['2']['PEMINAT'];
								$pil3+=$arr_pilihan['3']['PEMINAT'];
							} ?>
							
								<tr class="<?php echo $class ?>">
								<td></td>
								<td></td>
								<td><?php echo $pil1 ?></td>
								<td><?php  echo $pil2 ?></td>
								<td><?php echo $pil3 ?></td>
								</tr>
							<?php }else{ ?>
									<tr><td colspan='5'><center>Tidak ada data yang ditemukan</center></td></tr>	
									
							<?php } ?>		
							</table>
					</div>					
				</div>				
			</div>
		</div>
	</div>
	<script>

		$('#prodi').on('change', function() {
		  var prodi= this.value; 
		  window.location.href="<?php echo site_url('yudisium/set_prodi/index')?>/"+prodi;
		});

		var countChecked = function() {
		var n = $( ".check_diterima:checked" ).length;
			$(".check_counter").text(n);
		};
		countChecked();
		$( ".check_diterima" ).on( "click", countChecked );
		
		

		$(".select_all").click(function()	{
			var checked_status = this.checked;
			$(".check_diterima").each(function()
			{
				this.checked = checked_status;
			});
			n = $( ".check_diterima:checked" ).length;
			$(".check_counter").text(n);
		
		});			

	</script>
		