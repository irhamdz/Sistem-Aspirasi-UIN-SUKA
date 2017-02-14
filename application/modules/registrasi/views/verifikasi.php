	<link rel="stylesheet" href="http://uin-suka.ac.id//asset/colorbox/colorbox.css" />
		<script src="http://uin-suka.ac.id//asset/colorbox/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				$(".doc").colorbox({ iframe:true, width:"75%", height:"95%", opacity:0.5 });
				$(".ket").colorbox({iframe:true, innerWidth:400, innerHeight:200});

				
			});
			
			$(function(){
				setTimeout('closing_msg()', 4000);
			})

			function closing_msg(){
				$(".bs-callout").slideUp();
			}
			
		</script>	
				<div class="content-value">
				<div style="margin:20px 0; "><h3>Verifikasi Mahasiswa</h3></div>
					<div class="clear20"></div>
					<?php $msg = $this->session->flashdata('message');?>
					<?php if(!empty($msg)):?>
						<div class="bs-callout bs-callout-<?php echo $msg[0]?>">
							<p><?php echo $msg[1]?></p>
						</div>
						
					<?php  endif;?>
			
					
					<form method="post" action="">					
					 <div class="form-group form-group-sm">
							<label for="nomor" class="col-sm-3 control-label">Nomor Pendaftaran : </label>
							<div class="col-sm-4">
							<input id="nomor" type="text" name="nomor" value="<?php if(isset($np)) echo $np?>" class="form-control" />
							</div>
							<div class="col-sm-3">
								<button type="submit" class="btn  btn-sm btn-primary" style="margin-top:-2px;">Tampilkan</button>
							</div>
					<div class="clear20"></div>
					</div>
					</form>	
					<?php if(isset($siswa) and !empty($siswa)){?>
					<div class="row">
					<div class="col-sm-3 col-md-3"><b>Nama</b></div><div class="col-sm-9 col-md-9"><?php echo $siswa[0]->nama_siswa?></div>
					<div class="col-sm-3 col-md-3"><b>Jurusan</b></div><div class="col-sm-9 col-md-9"> <?php echo $siswa[0]->jurusan?></div>
					<div class="col-sm-3 col-md-3"><b>Asal Sekolah</b></div><div class="col-sm-9 col-md-9"> <?php echo $siswa[0]->nama_sekolah?></div>
					<div class="col-sm-3 col-md-3"><b>Akreditasi Sekolah</b></div><div class="col-sm-9 col-md-9"> <?php if($siswa[0]->akreditasi_sekolah)echo $siswa[0]->akreditasi_sekolah; else echo"-";?></div>
					<div class="col-sm-3 col-md-3"><b>Kabupaten</b></div><div class="col-sm-9 col-md-9"> <?php echo $siswa[0]->nama_kabupaten?></div>
					<div class="col-sm-3 col-md-3"><b>Provinsi</b></div><div class="col-sm-9 col-md-9"> <?php echo $siswa[0]->nama_provinsi?></div>
					</div><br><br>
					<?php } ?>
					
					<?php //print_r($nilai_rapor);?></pre>
					<?php if(isset($nilai_rapor) and !empty($nilai_rapor)){?>
						<h4>NILAI RAPOR</h4><br>
						<?php $sm=0;?>
						<?php foreach($nilai_rapor as $kelas=>$arr_smt){ ?>	
							<?php foreach($arr_smt as $smt=>$nilai){?>
								<b>Semester ke <?php echo ++$sm?> (Kelas <?php echo $kelas?> Semester <?php echo $smt?>)</b><br>
							<table style="width:100%" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th width="5px"><center>No</center></th>
									<th width="55px"><center>Mata Pelajaran</center></th>
									<th width="15px"><center>Nilai</center></th>
									<th width="15px"><center>KKM</center></th>
									<th width="20px"><center>Aksi</center></th>
								</tr>
								</thead>	
								<tbody>
								<?php $i=0 ?>
								<?php foreach($nilai as $n):?>
								<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><?php echo $n->mata_pelajaran?></td>
									<td style="text-align:right"><?php echo $n->nilai?></td>
									<td style="text-align:right"><?php echo $n->kkm?></td>
									<td style="text-align:center">
										<div class="btn-group">
										<?php
										 	$href=site_url('registrasi/verifikasi_rapor/'.$np.'/'.$kelas.'/'.$smt.'/'.$n->kode_mata_pelajaran);
											if(isset($ver_rapor[$kelas][$smt][$n->kode_mata_pelajaran])){ 
													$vr=$ver_rapor[$kelas][$smt][$n->kode_mata_pelajaran];
													$href=site_url('registrasi/verifikasi_rapor/'.$np.'/'.$kelas.'/'.$smt.'/'.$n->kode_mata_pelajaran);
													$href2=site_url('registrasi/keterangan_nilai/'.$np.'/'.$kelas.'/'.$smt.'/'.$n->kode_mata_pelajaran);
													if($vr=='1'){
											?>
												  <button formaction="<?php echo $href.'/1'?>" class="sesuai btn  btn-sm btn-success">Sesuai</button>
												  <button href="<?php echo $href2; ?>" formaction="<?php echo $href.'/0'?>" class="ket tidak_sesuai btn  btn-sm btn-default">Tidak Sesuai</button>
												<?php }else { ?>
												  <button formaction="<?php echo $href.'/1'?>"  class="sesuai btn  btn-sm btn  btn-sm btn-default">Sesuai</button>
												  <button href="<?php echo $href2; ?>" formaction="<?php echo $href.'/0'?>" class="ket tidak_sesuai btn  btn-sm btn-danger">Tidak Sesuai</button>
												<?php	} ?>
										<?php }else{ ?>
											  <button formaction="<?php echo $href.'/1'?>" type="button" class="sesuai btn  btn-sm btn  btn-sm btn-default">Sesuai</button>
											  <button href="<?php echo $href2; ?>" formaction="<?php echo $href.'/0'?>" type="button" class="ket tidak_sesuai btn  btn-sm btn-default">Tidak Sesuai</button>
										<?php	}   ?>
									</td>
								</tr>
								<?php endforeach ?>
								</tbody>
							</table>
								
							<?php } ?>
						<?php } ?>		
					<?php } ?>


					<?php if(isset($arr_prestasi)and !empty($arr_prestasi)){ ?>
						<h4>SERTIFIKAT PRESTASI</h4><br>
							<table style="width:100%" class="table table-bordered table-hover">
								<tr>
									<th width="10%"><center>No</center></th>
									<th><center>Dokumen</center></th>
									<th width="25%"><center>Status</center></th>
								</tr>	
												
						<?php $i=0;?>
							<?php foreach($arr_prestasi as $ap){?>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									<?php if($ap->file_sertifikat!=null):?>
									<a class="doc"  href="<?php echo base_url('media/snmptn/'.$ap->nomor_pendaftaran.'/Prestasi/'.$ap->file_sertifikat); ?>" > 
										<span style="text-decoration:underline"><?php echo $ap->jenis_prestasi.' - '.$ap->jenjang_prestasi?></span>
									</a>
									<?php else: ?>
										<span><?php echo $ap->jenis_prestasi.' - '.$ap->jenjang_prestasi?></span>
									<?php endif ?>
									
									</td>
									<td style="text-align:center">
										<span id="<?php echo $ap->file_sertifikat?>">
										<?php 
										/*if(isset($arr_prestasi_reg[$ap->id_prestasi])){
											if($arr_prestasi_reg[$ap->id_prestasi]==1){
												echo"<span class='label label-success'>Sesuai</span>";
											}else if($arr_prestasi_reg[$ap->id_prestasi]==0){
												echo"<span class='label label-danger'>Tidak Sesuai</span>";
											}		
										}
										
										if(isset($arr_prestasi_reg[$ap['FILE_SERTIFIKAT']])){
											if($arr_prestasi_reg[$ap['FILE_SERTIFIKAT']]==1){
												echo"<span class='label label-success'>Sesuai</span>";
											}else if($arr_prestasi_reg[$ap['FILE_SERTIFIKAT']]==0){
												echo"<span class='label label-danger'>Tidak Sesuai</span>";
											}		
										}*/
										?>
										<?php
											$href=site_url('registrasi/verifikasi_prestasi/'.$np.'/'.$ap->id_prestasi);
										 	if(isset($arr_prestasi_reg[$ap->id_prestasi])){
													$vr=$arr_prestasi_reg[$ap->id_prestasi];
													$href=site_url('registrasi/verifikasi_prestasi/'.$ap->id_prestasi);
													$href2=site_url('registrasi/keterangan_prestasi/'.$np.'/'.$ap->id_prestasi);
												if($vr=='1'){
											?>
												  <button formaction="<?php echo $href.'/1'?>" class="sesuai btn  btn-sm btn-success">Sesuai</button>
												  <button href="<?php echo $href2; ?>" formaction="<?php echo $href.'/0'?>" class="ket tidak_sesuai btn  btn-sm btn-default">Tidak Sesuai</button>
												<?php }else { ?>
												  <a formaction="<?php echo $href.'/1'?>"  class="sesuai btn  btn-sm btn  btn-sm btn-default">Sesuai</a>
												  <button href="<?php echo $href2; ?>" formaction="<?php echo $href.'/0'?>" class="ket tidak_sesuai btn  btn-sm btn-danger">Tidak Sesuai</button>
												<?php	} ?>
										<?php }else{ ?>
											  <a formaction="<?php echo $href.'/1'?>" type="button" class="sesuai btn  btn-sm btn  btn-sm btn-default">Sesuai</a>
											  <button href="<?php echo $href2; ?>" formaction="<?php echo $href.'/0'?>" type="button" class="ket tidak_sesuai btn  btn-sm btn-default">Tidak Sesuai</button>
										<?php	}   ?>
									</td>
								</tr>
							<?php } ?>
							</table>
						<?php } ?>

					<?php
					
					if(isset($profil) and !empty($profil)){?>
						<form method="post" action="<?php echo site_url('registrasi/verifikasi_profil')?>">
						<h4>DOKUMEN PROFIL MAHASISWA</h4><br>
							<table style="width:100%" class="table table-bordered table-hover">
								<tr>
									<th width="5%"><center>No</center></th>
									<th width="55%"><center>Dokumen</center></th>
									<th width="20%"><center>Data</center></th>
									<th width="20%"><center>Aksi</center></th>
								</tr>	
												
						<?php $i=0;?>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									<a class="doc"  href="<?php echo site_url('registrasi/document/'.$profil['NO_TEST'].'/1'); ?>" > 
										<span style="text-decoration:underline"><?php echo "Penghasilan Ibu";?></span>
									</a>
									</td>
									<td><?php echo number_format($profil['GAJI_IBU'],0,",",".")?></td>
									<td style="text-align:center">
										<input name="gaji_ibu" id="<?php echo $profil['NO_TEST']?>_DOC_PENGHASILAN_IBU" value="" class="form-control input-sm"/>
									</td>
								</tr>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									<a class="doc"  href="<?php echo site_url('registrasi/document/'.$profil['NO_TEST'].'/2'); ?>" > 
										<span style="text-decoration:underline">Penghasilan Bapak</span>
									</a>
									</td>
									<td><?php echo number_format($profil['GAJI_BAPAK'],0,",",".")?></td>
									<td style="text-align:center">
										<input name="gaji_bapak" id="<?php echo $profil['NO_TEST']?>_DOC_PENGHASILAN_BPK" value="" class="form-control input-sm"/>
									</td>
								</tr>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									<a class="doc"  href="<?php echo site_url('registrasi/document/'.$profil['NO_TEST'].'/3'); ?>" > 
										<span style="text-decoration:underline">Penghasilan Wali</span>
									</a>
									</td>
									<td><?php echo number_format($profil['GAJI_WALI'],0,",",".")?></td>
									<td style="text-align:center">
										<input name="gaji_wali" id="<?php echo $profil['NO_TEST']?>_DOC_PENGHASILAN_WALI" value="" class="form-control input-sm"/>
									</td>
								</tr>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									<a class="doc"  href="<?php echo site_url('registrasi/document/'.$profil['NO_TEST'].'/4'); ?>" > 
										<span style="text-decoration:underline">Luas Tanah Orang Tua</span>
									</a>
									</td>
									<td><?php echo number_format($profil['LUAS_TANAH_ORTU'],0,",",".")?></td>
									<td style="text-align:center">
										<input name="luas_tanah_ortu" id="<?php echo $profil['NO_TEST']?>_DOC_PBB" value="" class="form-control input-sm"/>
									</td>
								</tr>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									<a class="doc"  href="<?php echo site_url('registrasi/document/'.$profil['NO_TEST'].'/4'); ?>" > 
										<span style="text-decoration:underline">Pembayaran PBB Terakhir</span>
									</a>
									</td>
									<td><?php echo number_format($profil['PEMBAYARAN_PBB_AKHIR'],0,",",".")?></td>
									<td style="text-align:center">
										<input name="pembayaran_pbb" id="<?php echo $profil['NO_TEST']?>_DOC_PBB2" value="" class="form-control input-sm"/>
									</td>
								</tr>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									<a class="doc"  href="<?php echo site_url('registrasi/document/'.$profil['NO_TEST'].'/5'); ?>" > 
										<span style="text-decoration:underline">Daya Listrik</span>
									</a>
									</td>
									<td><?php echo number_format($profil['DAYA_LISTRIK_ORTU'],0,",",".")?></td>
									<td style="text-align:center">
										<input name="daya_listrik_ortu" id="<?php echo $profil['NO_TEST']?>_DOC_REK_LISTRIK" value="" class="form-control input-sm"/>
									</td>
								</tr>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									<a class="doc"  href="<?php echo site_url('registrasi/document/'.$profil['NO_TEST'].'/5'); ?>" > 
										<span style="text-decoration:underline">Pembayaran Listrik Terakhir</span>
									</a>
									</td>
									<td><?php echo number_format($profil['PEMBAYARAN_LISTRIK_AKHIR'],0,",",".")?></td>
									<td style="text-align:center">
										<input name="pembayaran_listrik" id="<?php echo $profil['NO_TEST']?>_DOC_REK_LISTRIK2" value="" class="form-control input-sm"/>
									</td>
								</tr>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									<a class="doc"  href="<?php echo site_url('registrasi/document/'.$profil['NO_TEST'].'/6'); ?>" > 
										<span style="text-decoration:underline"><?php echo "Jumlah Tanggungan"; ?></span>
									</a>
									</td>
									<td><?php echo $profil['JUM_TANGGUNGAN']?></td>
									<td style="text-align:center">
										<input name="jum_tanggungan" id="<?php echo $profil['NO_TEST']?>_DOC_KK" value="" class="form-control input-sm"/>
									</td>
								</tr>
								<?php	if(isset($profil['DOC_KARTU_MISKIN']) and !empty($profil['DOC_KARTU_MISKIN'])){?>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									<a class="doc"  href="<?php echo site_url('registrasi/document/'.$profil['NO_TEST'].'/7'); ?>" > 
										<span style="text-decoration:underline"><?php echo "KARU MISKIN"; ?></span>
									</a>
									</td>
									<td><?php //echo $profil['GAJI_BAPAK']?></td>
									<td style="text-align:center">
										<span id="<?php echo $profil['NO_TEST']?>_DOC_KARTU_MISKIN">
										</span>
									</td>
								</tr>
								<?php } ?>
								<tr>
									<td><center><?php echo ++$i?></center></td>
									<td>
									Keterangan
									</td>
									<td colspan="2">
									<textarea name="ket_profil" class="form-control input-sm"><?php if($ket['KETERANGAN']!=null) echo $ket['KETERANGAN'] ?></textarea>
									</td>
								</tr>
								
							</table>
							<input type="hidden" name="np" value="<?php echo $np ?>"/>
							<button type="submit" class="btn-uin btn btn-inverse btn btn-small">Simpan</button> 
							</form>	
							<?php } ?>

					
				</div>	
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








