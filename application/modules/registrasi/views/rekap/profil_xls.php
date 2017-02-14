<?php  
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Rekap_Isi_Data_Profil_Mahasiswa_dan_Verifikasi.xls");
?>
<h3>Rekap Isi Data Profil Mahasiswa dan Verifikasi<br>
Jalur <?php echo $jalur[0]['NM_JALUR']?> Tahun <?php echo $tahun?></h3><br>
		
	
		<?php if(isset($siswa) and !empty($siswa)){ ?>			
		
			<table border="1" width="650" class="table table-bordered table-hover">
				<tr>
					<th width="5%"><center>No</center></th>
					<th width="20%"><center>No. Pendaftaran</center></th>
					<th width="25%"><center>Nama</center></th>
					<th width="25%"><center>Program Studi</center></th>
					<th width="25%"><center>Asal Sekolah</center></th>
					<th width="25%"><center>Kab/Kota</center></th>
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
					<td><?php echo $d['NAMA_SEKOLAH'];?></td>
					<td><?php echo $d['NAMA_KABUPATEN'];?></td>
					<td><?php echo $d['ISI_DPM'];?></td>
					<td><?php echo $d['HADIR']?></td>
					<td><?php echo $d['HASIL']?></td>
					
				</tr>
				<?php endforeach ?>
				
			</table>

		<?php } ?>