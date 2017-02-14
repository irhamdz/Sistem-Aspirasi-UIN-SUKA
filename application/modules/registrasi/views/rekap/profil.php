
				<?php //print_r($reg_jalur);?>
				<h3>Rekap Isi Data Profil Mahasiswa dan Verifikasi</h3>
					<form method="post" action="<?php //echo site_url('yudisium/penilaian/set_prodi')?>" class="form-horizontal" role="form">
						<div class="form-group form-group-sm">
							<label class="col-sm-2 control-label" for="formGroupInputSmall">Jalur</label>
							<div class="col-sm-6">
								<select name="jalur" id="jalur" class="form-control">
									<option value=""> --- PILIH JALUR --- </option>
									<?php foreach($reg_jalur as $j): ?>
										<?php
										
											 if($j['KD_JALUR']==$kd_jalur){
												echo "<option value='".$j['KD_JALUR']."' selected>".$j['NM_JALUR']."</option>";
											}else{
												echo "<option value='".$j['KD_JALUR']."'>".$j['NM_JALUR']."</option>";
											} 
										?>	
									<?php endforeach ?>
								</select>
							</div>
							<div style="clear:both"></div>
						</div>
						 <div class="form-group form-group-sm">
							<label class="col-sm-2 control-label" for="formGroupInputSmall">Tahun</label>
							<div class="col-sm-6">
								<select name="tahun" id="tahun" class="form-control">
									<option value=""> --- PILIH TAHUN --- </option>
									<?php for($t=date('Y'); $t>=2015; $t--): ?>
										<?php
										
											if($t==$tahun){
												echo "<option value='".$t."' selected>".$t."</option>";
											}else{
												echo "<option value='".$t."'>".$t."</option>";
											} 
										?>	
									<?php endfor ?>
								</select>
							</div>
							<div style="clear:both"></div>
						</div>
						 <div class="form-group form-group-sm">
							<label class="col-sm-2 control-label" for="formGroupInputSmall"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-inverse">Tampilkan</button>
							</div>
							<div style="clear:both"></div>
						</div>
						
					</form>	
					
						<?php if(isset($siswa) and !empty($siswa)){ ?>			
						<div style="font-weight:bold; text-align:right; margin:10px;">
							<a href="<?php echo site_url('registrasi/rekap/verifikasi_profil_xls'); ?>" target="_blank"class="btn-uin btn btn-inverse" >Export Excel</a>
						</div>
							<div style="overflow-x:auto">
								
							<table style="width:150%" class="table table-bordered table-hover">
								<tr>
									<th width="5%"><center>No</center></th>
									<th width="20%"><center>No. Pendaftaran</center></th>
									<th width="30%"><center>Nama</center></th>
									<th width="30%"><center>Program Studi</center></th>
									<th width="10%"><center>Isi DPM</center></th>
									<th width="10%"><center>Hadir</center></th>
									<th width="10%"><center>Lolos Verifikasi</center></th>
								</tr>	
								<?php $i=0 ?>
								<?php foreach($siswa as $d):?>
								<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><?php echo $d['NOMOR_PENDAFTARAN']?></td>
									<td><?php echo $d['NAMA_SISWA']?></td>
									<td><?php echo $d['PROGRAM_STUDI'];?></td>
									<td><?php echo $d['ISI_DPM'];?></td>
									<td><?php echo $d['HADIR']?></td>
									<td><?php echo $d['HASIL']?></td>
									
								</tr>
								<?php endforeach ?>
								
							</table>
						</div>

						<?php } ?>

	<script>
/* 
		$('#prodi').on('change', function() {
		  var prodi= this.value; 
		  window.location.href="<?php echo site_url('registrasi/rekap/set_prodi/verifikasi_rapor')?>/"+prodi;
		});
		 */

	</script>