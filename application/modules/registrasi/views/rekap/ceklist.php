
				
				<h3>Rekap Ceklist Berkas Registrasi</h3>
					<form method="post" action="<?php echo site_url('yudisium/penilaian/set_prodi')?>" class="form-horizontal" role="form">
						 <div class="form-group form-group-sm">
							<label class="col-sm-2 control-label" for="formGroupInputSmall">Program Studi</label>
							<div class="col-sm-6">
								<select name="prodi" id="prodi" class="form-control">
									<option value=""> --- PILIH PROGRAM STUDI --- </option>
									<?php foreach($prodi as $p): ?>
										<?php
											if($p->KODE_PROGRAM_STUDI==$kode_prodi){
												echo "<option value='".$p->KODE_PROGRAM_STUDI."' selected>".$p->PROGRAM_STUDI."</option>";
											}else{
											echo "<option value='".$p->KODE_PROGRAM_STUDI."'>".$p->PROGRAM_STUDI."</option>";
											}
										?>	
									<?php endforeach ?>
								</select>
							</div>
							<div style="clear:both"></div>
						</div>
					</form>	
					
						<?php if(isset($mhs) and !empty($mhs)){ ?>			
						<div style="font-weight:bold; text-align:right; margin:10px;">
							<a href="<?php echo site_url('registrasi/rekap/ceklist_xls'); ?>"class="btn-uin btn btn-inverse" >Download Excel</a>
						</div>
							<div style="overflow-x:auto">
								
							<table style="width:150%" class="table table-bordered table-hover">
								<tr>
									<th width="10px"><center>No</center></th>
									<th width="40px"><center>NIM</center></th>
									<th width="40px"><center>NAMA</center></th>
									<?php foreach($dokumen as $d){?>
									<td><?php echo $d->NAMA_SINGKAT ?></td>
									<?php } ?>
								</tr>	
								<?php $i=0 ?>
								<?php foreach($mhs as $m):?>
								<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><?php echo $m['NIM']?></td>
									<td><?php echo $m['NAMA']?></td>
									<?php foreach($dokumen as $d){?>
									<td style="text-align:center"> <?php if(isset($arr_ceklist[$m['NIM']][$d->KODE_DOKUMEN]) and $arr_ceklist[$m['NIM']][$d->KODE_DOKUMEN]) echo "<img src='".base_url()."asset/img/centang.png'/>"; ?></td>
									<?php } ?>
								</tr>
								<?php endforeach ?>
								
							</table>
						</div>

						<?php } ?>

	<script>

		$('#prodi').on('change', function() {
		  var prodi= this.value; 
		  window.location.href="<?php echo site_url('registrasi/rekap/set_prodi/ceklist')?>/"+prodi;
		});
		

	</script>