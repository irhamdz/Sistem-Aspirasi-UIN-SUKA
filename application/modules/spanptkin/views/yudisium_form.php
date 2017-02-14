
   <script>
		$(document).ready(function() {
			$('#datatable').dataTable({
					bFilter: false, bInfo: false,
					"fnDrawCallback": function ( oSettings ) {
						var that = this;
						if ( oSettings.bSorted || oSettings.bFiltered )
						{
							this.$('td:first-child', {"filter":"applied"}).each( function (i) {
								that.fnUpdate( i+1, this.parentNode, 0, false, false );
							} );
						}
						var n = $( ".check_diterima:checked" ).length;
						$(".check_counter").text(n);
					},
					"aaSorting": [[ 6, "desc" ]],
					"aoColumnDefs": [
						{ "bSortable": false, "aTargets": [ 0 ] }
					],
                "bPaginate": false
            }
			);
		} );
		$(function(){
			setTimeout('closing_msg()', 4000);
		})

		function closing_msg(){
			$(".bs-callout").slideUp();
		}
		</script>
<style>
table.table_info td{border:none;}
</style>		
		
				<h3>Daftar Pendaftar Pilihan <?php echo $pilihan ?></h3>
				<form class="form-inline" method="post" action="">
				  <div class="form-group">
					<label for="prodi">Program Studi &nbsp;&nbsp;&nbsp;</label>
					<select name="prodi" id="prodi" class="form-control input-sm">
							<option value="" >PILIH PROGRAM STUDI</option>
							<?php foreach($prodi as $p): ?>
								<?php
									if($p->kode_program_studi==$kode_prodi){
										echo "<option value='".$p->kode_program_studi."' selected>".$p->program_studi."</option>";
									}else{
									echo "<option value='".$p->kode_program_studi."'>".$p->program_studi."</option>";
									}
								?>	
							<?php endforeach ?>
						</select>
				  </div>
				</form>
				<br>
					<?php $a = $this->session->flashdata('message');?>
					<?php if($a!=null):?>
						<div class="msg_alert alert alert-info">
							<?php echo $a[1]?>
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
				<br>
					<?php if(isset($siswa) and !empty($siswa)){ ?>		
					<?php //print_r($siswa);?>		
						<div style="font-weight:bold; text-align:right; margin:10px;">
							Terpilih : <span class="check_counter"></span>
							<span style="margin-left:20px"><input id="select_all" class="select_all" type="checkbox" /> <label style="display:inline;font-size:12px" for="select_all"> Pilih Semua</label></span>
						</div>
						<form method="post" action="">
							<table id="datatable" class="table table-bordered table-hover">
								<tr>
									<th width="4%"><center>No</center></th>
									<th width="8%"><center>No Pendaftaran</center></th>
									<th width="32%"><center>Keterangan</center></th>
									<th width="23%"><center>Komponen Nilai</center></th>
									<th width="8%"><center>Nilai</center></th>
									<th width="5%"><center>Diterima</center></th>
								</tr>	
							<?php $i=0; ?>	
							<?php 
								if(!empty($siswa)){
								foreach($siswa as $s){ 
								$class="";
								
							/* 	if(hitung_umur($s['TGL_LAHIR'])>20){
										$class="info";
								}else if($s['KELULUSAN']=="LULUS"){
									$class="";
								}else if($s['KELULUSAN']=="TIDAK LULUS"){	
									$class="error";
								}else{
									$class="warning";
								}
								if( $s['JUMLAH_NILAI_DIBAWAH_KKM']>0){	
									$class="error";
								} */
							?>
								<tr class="<?php echo $class ?>">
								<td><center><?php echo ++$i ?></center></td>
								<td><center><?php echo $s->nomor_pendaftaran ?></center> </td>
								<td>
								<table class="table_info">
									<tr><td>Asal Sekolah</td><td>:</td><td><?php echo $s->nama_sekolah ?></td></tr>
									<tr><td>Akreditasi</td><td>:</td><td><?php echo $s->akreditasi_sekolah ?></td></tr>
									<tr><td>Jurusan</td><td>:</td><td><?php echo $s->jurusan ?></td></tr>
									<!--<tr><td>Usia</td><td>:</td><td><?php echo hitung_umur($s->tgl_lahir)?></td></tr>-->
									<tr><td>Kabupaten</td><td>:</td><td><?php echo $s->nama_kabupaten ?></td></tr>
								</table>
									<?php if(!empty($prestasi[$s->nomor_pendaftaran])){?>
										<div>
										<b>Prestasi :</b><br>
										<?php
										//print_r($prestasi);
												foreach($prestasi[$s->nomor_pendaftaran] as $p){
													echo "<span style='font-size:12px;'>".$p->jenis_prestasi;
													echo " (<a style='color:green' href='".base_url('media/spanptkin/'.$s->nomor_pendaftaran.'/Prestasi/'.$p->file_sertifikat)."' target='_blank'>".$p->id_prestasi."</a>)";
													echo " - ".$p->jenjang_prestasi."</span>";
													echo"<br>";
												}
												
											}	
									echo"</div>";
									?>
								</td>
								<td>
								
									Akademik (Rapor) : <?php echo round(str_replace(',','.',$s->nilai_mapel),2) ?><br>
									Pendukung Akademik : <?php echo round(str_replace(',','.',$s->nilai_prestasi),2) ?><br>
									Peringkat Sekolah : <?php echo round(str_replace(',','.',$s->nilai_peringkat_sekolah),2) ?><br>
									Peminat Mandiri : <?php echo round(str_replace(',','.',$s->nilai_peminat_mandiri),2) ?><br>
									Rekam Jejak Alumni : <?php echo round(str_replace(',','.',$s->nilai_rekam_jejak_alumni),2) ?><br>
									Aksesibilitas 3T : <?php echo round(str_replace(',','.',$s->nilai_sebaran_wilayah),2) ?>
								
										<br>
										
									</td>
								<td><center><?php echo round(str_replace(',','.',$s->total_nilai),2) ?> </center></td>
								<td><center>
								<?php if($s->diterima =='1'){ ?>
									<input type="checkbox" name="diterima[<?php echo $s->nomor_pendaftaran ?>]" class="check_diterima" value="1" checked />
								<?php }else{ ?>
									<input type="checkbox" name="diterima[<?php echo $s->nomor_pendaftaran ?>]" class="check_diterima" value="1" />
								<?php } ?>
								
								</center></td>
							<?php } }else{ ?>
									<tr><td colspan='5'><center>Tidak ada data yang ditemukan</center></td></tr>	
									
							<?php } ?>		
							</table>
							<input type="hidden" name="prodi"  value=<?php echo $kode_prodi?> />
							<button type="submit" class="btn btn-primary" style="font-size:14px">Simpan Data</button>
						</form>	
							<?php } ?>	
					
	<script>

		$('#prodi').on('change', function() {
		  var prodi= this.value; 
		  window.location.href="<?php echo site_url('spanptkin/yudisium/set_prodi/index')?>/"+prodi;
		});
		
		var n = $( ".check_diterima:checked" ).length;
			$(".check_counter").text(n);
	
		$(document).on('click', '.check_diterima', function () {
			var n = $( ".check_diterima:checked" ).length;
			$(".check_counter").text(n);
		});
		

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
		