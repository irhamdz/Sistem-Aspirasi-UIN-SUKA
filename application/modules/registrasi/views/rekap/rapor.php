
				<?php //print_r($prodi);?>
				<h3>Rekap Ceklist Berkas Registrasi</h3>
					<form method="post" action="<?php //echo site_url('yudisium/penilaian/set_prodi')?>" class="form-horizontal" role="form">
						 <div class="form-group form-group-sm">
							<label class="col-sm-2 control-label" for="formGroupInputSmall">Program Studi</label>
							<div class="col-sm-6">
								<select name="prodi" id="prodi" class="form-control">
									<option value=""> --- PILIH PROGRAM STUDI --- </option>
									<?php foreach($prodi as $p): ?>
										<?php
											if($p['KODE_PROGRAM_STUDI']==$kode_prodi){
												echo "<option value='".$p['KODE_PROGRAM_STUDI']."' selected>".$p['PROGRAM_STUDI']."</option>";
											}else{
											echo "<option value='".$p['KODE_PROGRAM_STUDI']."'>".$p['PROGRAM_STUDI']."</option>";
											}
										?>	
									<?php endforeach ?>
								</select>
							</div>
							<div style="clear:both"></div>
						</div>
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
					
						<?php if(isset($ver_nilai) and !empty($ver_nilai)){ ?>			
						<div style="font-weight:bold; text-align:right; margin:10px;">
							<a href="<?php echo site_url('registrasi/rekap/cetak_verifikasi_rapor'); ?>" target="_blank"class="btn-uin btn btn-inverse" >Cetak</a>
						</div>
							<div style="overflow-x:auto">
								
							<table style="width:150%" class="table table-bordered table-hover">
								<tr>
									<th width="5%" rowspan="2"><center>No</center></th>
									<th width="10%" rowspan="2"><center>No. Pendaftaran</center></th>
									<th width="20%" rowspan="2"><center>Nama</center></th>
									<th width="30%" colspan="2"><center>Perbedaan Nilai</center></th>
									<th width="35%" rowspan="2"><center>Keterangan</center></th>
								</tr>
								<tr>								
									<th><center>Semester</center></th>
									<th ><center>Mata Pelajaran</center></th>
								</tr>	
								<?php $i=0 ?>
								<?php foreach($ver_nilai as $d):?>
								<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><?php echo $d['NOMOR_PENDAFTARAN']?></td>
									<td><?php echo $d['NAMA_SISWA']?></td>
									<td><?php echo $d['SEMESTER']+($d['TINGKAT']-10)*2;?></td>
									<td><?php echo $d['MATA_PELAJARAN']?></td>
									<td><?php echo $d['KETERANGAN']?></td>
									
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