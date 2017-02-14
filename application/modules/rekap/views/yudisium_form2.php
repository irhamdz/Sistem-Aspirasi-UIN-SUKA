		<div id="system-content">	
			<div class="topline-content"></div>
			<div class="margin-contentmenu">
				<ul class="content-submenu">							
					<a href="<?php echo site_url('login/logout'); ?>"><li id="tab">Logout</li></a>
					</ul>					
			</div>
			<div style="clear:both;"></div>
			<div id="content-space">
				<div>
					<div style="font-weight:bold; margin:10px 0;"><h3>Daftar Peserta SNMPTN 2013</h3></div>
					<div style="font-weight:bold; margin:10px 0;">Pilihan <?php echo $pilihan ?></div>
				
				
					<div class="content-value">
						<?php if($a!=null):?>
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
						
						
						<form method="post" action="">
						<div style="font-weight:bold; margin:10px 0;">	Program Studi :
							<select name="prodi" style="margin-top:10px; width:320px">
								<?php foreach($prodi as $p): ?>
									<?php
										if($p->kode_prodi==$kode_prodi){
											echo "<option value='".$p->kode_prodi."' selected>".$p->prodi."</option>";
										}else{
										echo "<option value='".$p->kode_prodi."'>".$p->prodi."</option>";
										}
									?>	
								<?php endforeach ?>
							</select>
							<button type="submit" class="btn btn-primary" style="font-size:14px">Tampilkan</button>
							</div>
						</form>			
						<div style="font-weight:bold; text-align:right; margin:10px;">
							Terpilih : <span class="check_counter"></span>
							<span style="margin-left:20px"><input id="select_all" class="select_all" type="checkbox" /> <label style="display:inline;font-size:12px" for="select_all"> Pilih Semua</label></span>
							</div>
						<form method="post" action="">
							<table style="width:940px" class="table table-bordered table-hover">
								<tr>
									<th width="5%"><center>No</center></th>
									<th width="10%"><center>No Pendaftaran</center></th>
									<th width="50%"><center>Sekolah</center></th>
									<th width="10%"><center>Nilai</center></th>
									<th width="5%"><center>Diterima</center></th>
								</tr>	
							<?php $i=0; ?>	
							<?php 
								if($siswa !=null){
								foreach($siswa as $s){ 
							?>
								<tr>
								<td><center><?php echo ++$i ?></center></td>
								<td><center><input type="hidden" name="np[]" value="<?php echo $s->nomor_pendaftaran ?>" /><?php echo $s->nomor_pendaftaran ?></center> </td>
								<td>
									<ul>
									<li><b><?php echo $s->nama_sekolah ?></b></li>
									<li>Akreditasi : <?php echo $s->akreditasi_sekolah ?></li>
									<li>Kepemilikan : <?php echo $s->kepemilikan ?></li>
									<li>Jurusan : <?php echo $s->jurusan ?></li>
									</ul>
								</td>
								<td><center><?php echo $s->nilai_yudisium ?> </center></td>
								<td><center>
								<?php if($s->diterima =='1'){ ?>
									<input type="checkbox" name="diterima_<?php echo $s->nomor_pendaftaran ?>" class="check_diterima" value="1" checked />
								<?php }else{ ?>
									<input type="checkbox" name="diterima_<?php echo $s->nomor_pendaftaran ?>" class="check_diterima" value="1" />
								<?php } ?>
								
								</center></td>
							<?php } } ?>	
							</table>
							<input type="hidden" name="prodi"  value=<?php echo $kode_prodi?> />
							<button type="submit" class="btn btn-primary" style="font-size:14px">Simpan Data</button>
						</form>			
					
						
					</div>					
				</div>				
			</div>
		</div>
	</div>
	<script>

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
		