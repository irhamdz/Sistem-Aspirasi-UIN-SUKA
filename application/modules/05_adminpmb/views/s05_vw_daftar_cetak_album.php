<?php
$crumbs = array(array('Beranda'=>base_url()),array('Informasi Ruang Ujian' => ''));
$this->s00_lib_output->output_crumbs($crumbs); echo "<br/>";

?>
<div class="system-content-sia">
<table class="table table-bordered table-hover">
			<tbody>
				<thead>
				<tr>
					<th>1.</th>
					<td colspan=4><?php echo $informasi_ruang_ujian[0]->PMB_NAMA_GEDUNG; ?></td>
				</tr>
				<tr>
					<th width='5%'>NO</th>
					<th align='left' width='20%'>Nama Ruang</th>
					<th width='10%'>Kapasitas</th>
					<th width='10%'>Terisi</th>
					<th width='20%'>Cetak Album Ujian</th>
					<th width='20%'>Cetak Form Verifikasi</th>
				</tr>

				<thead>
				<tbody>
			<?php
			$kapasitas_semua=0;
			$kapasitas_terisi=0;
			foreach($informasi_ruang_ujian as $value){
			
				$kapasitas_semua = $kapasitas_semua + $value->PMB_KAPASITAS_RUANG;
				$kapasitas_terisi = $kapasitas_terisi + $value->TERISI;
				
				$jalur=$value->PMB_JALUR_UJIAN;
					switch($jalur){ 
								  case 20: $jenis=2; $gel=1; break; // gel 1 s2
								  case 21: $jenis=2; $gel=2; break; // gel 2 s2
								}
					
					$nomer_awal=$value->PMB_NO_UJIAN_AWAL;
					if (($nomer_awal>=0)&&($nomer_awal<10)) 
							$no_awal = "0000$value->PMB_NO_UJIAN_AWAL"; //00001 - 00009
					elseif (($nomer_awal>=10)&&($nomer_awal<100)) 
							$no_awal = "000$value->PMB_NO_UJIAN_AWAL"; // 00010 - 00099
					elseif (($nomer_awal>=100)&&($nomer_awal<1000))
							$no_awal = "00$value->PMB_NO_UJIAN_AWAL"; // 00100 - 99999
					elseif ($nomer_awal>=1000) 
							$nomer_awal = "";
							
					
					$nomer_akhir=$value->PMB_NO_UJIAN_AKHIR;
					if (($nomer_akhir>=0)&&($nomer_akhir<10)) 
							$no_akhir = "0000$value->PMB_NO_UJIAN_AKHIR"; //00001 - 00009
					elseif (($nomer_akhir>=10)&&($nomer_akhir<100)) 
							$no_akhir = "000$value->PMB_NO_UJIAN_AKHIR"; // 00010 - 00099
					elseif (($nomer_akhir>=100)&&($nomer_akhir<1000))
							$no_akhir = "00$value->PMB_NO_UJIAN_AKHIR"; // 00100 - 99999
					elseif ($nomer_akhir>=1000) 
							$nomer_akhir = "";
					
					$ta=14;
					if($value->TERISI==0){
					$cetak="<a class='btn' href='#' title='Belum Terisi'><i class='icon-print'></i><a>";
					$cetak_cover="<a class='btn' href='#' title='Cetak Cover Album Ujian'><i class='icon-print'></i><a>";
					$no_aw = 0;
					$no_ak = 0;
					}else{
					
					$no_aw = $ta."".$jenis."".$gel."".$no_awal;
					$no_ak = $ta."".$jenis."".$gel."".$no_akhir;
					$no_ak = $no_aw+$value->TERISI;
					$no_ak = $no_ak-1;
					$cetak_cover="<a class='btn' href='/adminpmb/tools-cetak_cover_ujian/ruang-$value->PMB_ID_RUANG-$value->PMB_KAPASITAS_RUANG-$value->TERISI-$no_aw-$no_ak-$value->NAMA_RUANG-$value->PMB_NAMA_GEDUNG' title='Cetak Cover Album Ujian'><i class='icon-print'></i><a>";
					$cetak="<a class='btn' href='/adminpmb/tools-cetak_album_ujian/ruang-$value->PMB_ID_RUANG-$value->PMB_KAPASITAS_RUANG-$value->TERISI-$no_aw-$no_ak-$value->NAMA_RUANG-$value->PMB_NAMA_GEDUNG' title='Cetak Album Ujian'><i class='icon-print'></i><a>";
					$cetak_form_verifikasi="<a class='btn' href='/adminpmb/tools-cetak_form_verifikasi_ujian/ruang-$value->PMB_ID_RUANG-$value->PMB_KAPASITAS_RUANG-$value->TERISI-$no_aw-$no_ak-$value->NAMA_RUANG-$value->PMB_NAMA_GEDUNG' title='Cetak Form Verifikasi Ujian'><i class='icon-print'></i><a>";
					}
					
					
			?>
				<tr>
					<td align='center'><?php echo $value->NO_; ?></td>
					<td align='left'>R. <?php echo $value->NAMA_RUANG; ?></td>
					<td align='center'><?php echo $value->PMB_KAPASITAS_RUANG; ?></td>
					<td align='center'><?php echo $value->TERISI; ?></td>
					<td align='center'><?php echo $cetak; ?></td>
					<td align='center'><?php echo $cetak_form_verifikasi; ?></td>
				</tr>
			<?php } ?>
				</tr>
			</tbody>
		</table>
		<table width=100%>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td align='right'><b>
							Kapasitas:  <?php echo $kapasitas_semua; ?><br />
							Terisi:   <?php echo $kapasitas_terisi; ?><br /> 
							Sisa:   <?php $sisa=$kapasitas_semua-$kapasitas_terisi; echo $sisa; ?>
					</b>
					</td>
			</tr>
		</table>
</div>