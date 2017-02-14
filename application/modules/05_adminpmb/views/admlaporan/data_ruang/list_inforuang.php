<div class="system-content-sia">
<strong>Keterangan :</strong>
<table style="margin: 5px 0 30px 0;">
		<tbody>
		<tr>
		<td style=""><span style="display:block; background-color: #FEF7B7; width:20px; height:20px; border:1px solid #666;"></span></td>
		<td style="">&nbsp; : Belum Terisi Penuh / Kosong</td>
		</tr>
		<tr><td colspan="2" style="height:10px;"></td></tr>
		<tr>
		<td style=""><span style="display:block; background-color: #F5A9A9; width:20px; height:20px; border:1px solid #666;"></span></td>
		<td style="">&nbsp; : Melebihi Kapasitas</td>
		</tr>
	</tbody></table>
			<?php
			$PMB_NAMA_GEDUNG_TEMP="";
			$NO_GEDUNG=0;
			$kapasitas_semua=0;
			$kapasitas_terisi=0;
			foreach($informasi_ruang_ujian as $value){
				
				$kapasitas_semua = $kapasitas_semua + $value->PMB_KAPASITAS_RUANG;
				$kapasitas_terisi = $kapasitas_terisi + $value->TERISI;
				#$terisi=$value->TERISI;
				if($value->TERISI==0){
					$color="#FEF7B7";
				}elseif($value->TERISI < $value->PMB_KAPASITAS_RUANG){
					$color="#FEF7B7";
				}elseif($value->TERISI > $value->PMB_KAPASITAS_RUANG){
					$color="#F5A9A9";
				}else{
					$color="";
				}
				
				$jalur=$value->PMB_KD_JALUR;
					switch($jalur){ 
								  case 10: $jenis=1; $gel=10; break; // gel 1 s2
								  case 11: $jenis=1; $gel=11; break; // gel 2 s2
								  case 20: $jenis=2; $gel=20; break; // gel 2 s2
								  case 21: $jenis=2; $gel=21; break; // gel 2 s2
								  case 22: $jenis=2; $gel=22; break; // gel 2 s2
								  case 40: $jenis=4; $gel=40; break; // gel 2 s2
								  case 50: $jenis=5; $gel=50; break; // gel 2 s2
								  case 80: $jenis=8; $gel=80; break; // gel 2 s2
								}
					
				switch($jalur){ 
						  // case 10: case 11:
							// $nomer_awal=$value->PMB_NO_UJIAN_AWAL;
							// if (($nomer_awal>=0)&&($nomer_awal<10)) 
									// $no_awal = "00000$value->PMB_NO_UJIAN_AWAL"; //00001 - 00009
							// elseif (($nomer_awal>=10)&&($nomer_awal<100)) 
									// $no_awal = "0000$value->PMB_NO_UJIAN_AWAL"; // 00010 - 00099
							// elseif (($nomer_awal>=100)&&($nomer_awal<1000))
									// $no_awal = "000$value->PMB_NO_UJIAN_AWAL"; // 00100 - 99999
							// elseif (($nomer_awal>=1000)&&($nomer_awal<10000))
									// $no_awal = "00$value->PMB_NO_UJIAN_AWAL"; // 00100 - 99999
							// elseif ($nomer_awal>=10000) $nomer_awal = "";
									
							// $nomer_akhir=$value->PMB_NO_UJIAN_AKHIR;
							// if (($nomer_akhir>=0)&&($nomer_akhir<10)) 
									// $no_akhir = "00000$value->PMB_NO_UJIAN_AKHIR"; //00001 - 00009
							// elseif (($nomer_akhir>=10)&&($nomer_akhir<100)) 
									// $no_akhir = "0000$value->PMB_NO_UJIAN_AKHIR"; // 00010 - 00099
							// elseif (($nomer_akhir>=100)&&($nomer_akhir<1000))
									// $no_akhir = "000$value->PMB_NO_UJIAN_AKHIR"; // 00100 - 99999
							// elseif (($nomer_akhir>=1000)&&($nomer_akhir<10000))
									// $no_akhir = "00$value->PMB_NO_UJIAN_AKHIR"; // 00100 - 99999
							// elseif ($nomer_akhir>=10000) $nomer_akhir = "";
						  // break; 
						  // case 20: case 21: case 40: case 50: case 80:
							// $nomer_awal=$value->PMB_NO_UJIAN_AWAL;
							// if (($nomer_awal>=0)&&($nomer_awal<10)) 
									// $no_awal = "0000$value->PMB_NO_UJIAN_AWAL"; //00001 - 00009
							// elseif (($nomer_awal>=10)&&($nomer_awal<100)) 
									// $no_awal = "000$value->PMB_NO_UJIAN_AWAL"; // 00010 - 00099
							// elseif (($nomer_awal>=100)&&($nomer_awal<1000))
									// $no_awal = "00$value->PMB_NO_UJIAN_AWAL"; // 00100 - 99999
							// elseif ($nomer_awal>=1000) $nomer_awal = "";
									
							
							// $nomer_akhir=$value->PMB_NO_UJIAN_AKHIR;
							// if (($nomer_akhir>=0)&&($nomer_akhir<10)) 
									// $no_akhir = "0000$value->PMB_NO_UJIAN_AKHIR"; //00001 - 00009
							// elseif (($nomer_akhir>=10)&&($nomer_akhir<100)) 
									// $no_akhir = "000$value->PMB_NO_UJIAN_AKHIR"; // 00010 - 00099
							// elseif (($nomer_akhir>=100)&&($nomer_akhir<1000))
									// $no_akhir = "00$value->PMB_NO_UJIAN_AKHIR"; // 00100 - 99999
							// elseif ($nomer_akhir>=1000) $nomer_akhir = "";
						  // break; 
						  case 10: case 11: case 20: case 21:case 22: case 40: case 50: case 80:
							$nomer_awal=$value->PMB_NO_UJIAN_AWAL;
							if (($nomer_awal>=0)&&($nomer_awal<10)) 
									$no_awal = "0000$value->PMB_NO_UJIAN_AWAL"; //00001 - 00009
							elseif (($nomer_awal>=10)&&($nomer_awal<100)) 
									$no_awal = "000$value->PMB_NO_UJIAN_AWAL"; // 00010 - 00099
							elseif (($nomer_awal>=100)&&($nomer_awal<1000))
									$no_awal = "00$value->PMB_NO_UJIAN_AWAL"; // 00100 - 99999
							elseif ($nomer_awal>=1000) //$nomer_awal =$value->PMB_NO_UJIAN_AWAL;							
									$no_awal = "0$value->PMB_NO_UJIAN_AWAL"; // 001000 - 99999
							$nomer_akhir=$value->PMB_NO_UJIAN_AKHIR;
							if (($nomer_akhir>=0)&&($nomer_akhir<10)) 
									$no_akhir = "0000$value->PMB_NO_UJIAN_AKHIR"; //00001 - 00009
							elseif (($nomer_akhir>=10)&&($nomer_akhir<100)) 
									$no_akhir = "000$value->PMB_NO_UJIAN_AKHIR"; // 00010 - 00099
							elseif (($nomer_akhir>=100)&&($nomer_akhir<1000))
									$no_akhir = "00$value->PMB_NO_UJIAN_AKHIR"; // 00100 - 99999
							elseif ($nomer_akhir>=1000) $nomer_akhir = "";
							$no_akhir = "0$value->PMB_NO_UJIAN_AKHIR"; // 00100 - 99999
						  break; 
					}
					
					$ta=15;
					if($value->TERISI==0){
						$PMB_NAMA_GEDUNG=str_replace("&#39;","", $value->PMB_NAMA_GEDUNG);
						$no_aw = 0;
						$no_ak = 0;
					}else{
						$no_aw = $ta."".$jenis."".$gel."".$no_awal;
						$no_ak = $ta."".$jenis."".$gel."".$no_akhir;
						$no_ak = $no_aw+$value->TERISI;
						$no_ak = $no_ak-1;
						$PMB_NAMA_GEDUNG=str_replace("&#39;","", $value->PMB_NAMA_GEDUNG);
					}
					
					if($PMB_NAMA_GEDUNG!=$PMB_NAMA_GEDUNG_TEMP){
						$PMB_NAMA_GEDUNG_TEMP=$PMB_NAMA_GEDUNG;
						$NO_GEDUNG++;
?>
						<table class='table table-bordered table-hover'><thead>
						<tr>
							<th><h3><?php echo $NO_GEDUNG; ?>.</h3></th>
							<td colspan=4><h3><?php echo $PMB_NAMA_GEDUNG; ?></h3></td>
						</tr>
						<tr>
							<th width='5%'>NO</th>
							<th align='left' width='20%'>NAMA RUANG</th>
							<th width='10%'>KAPASITAS</th>
							<th width='10%'>TERISI</th>
							<th width='25%'>NO PESERTA</th>
						</tr>
						</thead>
<?php
					}
?>
				<tr bgcolor='<?php echo $color; ?>'>
					<td align='center' ><?php echo $value->NO_; ?>.</td>	
					<td align='left'><?php echo $value->NAMA_RUANG; ?></td>
					<td align='center'><?php echo $value->PMB_KAPASITAS_RUANG; ?></td>
					<td align='center' ><?php echo $value->TERISI; ?></td>
					<td align='center'  ><?php echo $no_aw." - ".$no_ak; ?></td>
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