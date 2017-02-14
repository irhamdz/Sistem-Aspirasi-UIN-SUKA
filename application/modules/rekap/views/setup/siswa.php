		<div id="system-content">
					<div class="content-value">
				<div style="margin:20px 0; "><h3>Cari Mahasiswa</h3></div>
					<form method="post" action="">
					<div style="font-weight:bold; margin:10px 0;">	Nama :
							<input  type="text" name="nama"  />
							
						</select>
					</div>
					</form>	
						<?php if(isset($siswa)){?>
								<table class="table table-bordered table-hover">
								<tr>
									<th width="4%"><center>No</center></th>
									<th width="35%"><center>Nama</center></th>
									<th width="8%"><center>No Pendaftaran</center></th>
									<th width="8%"><center>NISN</center></th>
									<th width="5%"><center>Tgl Lahir</center></th>
								</tr>	
							<?php $i=0; ?>	
							<?php 
								foreach($siswa as $s){ ?>
									<tr>
										<td><?php echo ++$i?></td>
										<td><?php echo $s['NAMA_SISWA'] ?></td>
										<td><?php echo $s['NOMOR_PENDAFTARAN'] ?></td>
										<td><?php echo $s['NISN'] ?></td>
										<td><?php echo $s['TGL_LAHIR'] ?></td>
									</tr>
							<?php	}
							?>
							<?php }?>
						</table>			
								
				</div>	
		</div>