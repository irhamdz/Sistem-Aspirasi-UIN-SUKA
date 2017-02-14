<div class="system-content-sia">
<table class="table table-bordered table-hover">
	
<?php 
	#echo $status_tampil;
	SWITCH($status_tampil){
		case 'JUMLAH_BAYAR':
				#echo "<pre>"; PRINT_R($jumlah_bayar); echo "</pre>"; 
				echo "<tr>
						<th width=150>TANGGAL MULAI</th>
						<td>".$tanggal['AWAL']."</td>
					  </tr>
					  <tr>
						<th>TANGGAL AKHIR</th>
						<td>".$tanggal['AKHIR']."</td>
					  </tr>
					  <tr>
						<th>JUMLAH BAYAR</th>
						<td>".$jumlah_bayar['JUMLAH']." Orang</td>
					  </tr>";
		break;
		case 'JUMLAH_LOGIN':
				#echo "<pre>"; PRINT_R($jumlah_login); echo "</pre>"; 
				echo "<tr>
						<th width=150>TANGGAL MULAI</th>
						<td>".$tanggal['AWAL']."</td>
					  </tr>
					  <tr>
						<th>TANGGAL AKHIR</th>
						<td>".$tanggal['AKHIR']."</td>
					  </tr>
					  <tr>
						<th>TOTAL LOGIN</th>
						<td>".$jumlah_login[0]->TOTAL_LOGIN." Orang</td>
					  </tr>";
		break;
		case 'JUMLAH_LOGIN_BELUM_ISI_DATA':
				#echo "<pre>"; PRINT_R($jumlah_login_belum_isi_data); echo "</pre>";
				echo "<tr>
						<th width=150>TANGGAL MULAI</th>
						<td>".$tanggal['AWAL']."</td>
					  </tr>
					  <tr>
						<th>TANGGAL AKHIR</th>
						<td>".$tanggal['AKHIR']."</td>
					  </tr>
					  <tr>
						<th>LOGIN, BELUM ISI DATA</th>
						<td>".$jumlah_login_belum_isi_data[0]->TOTAL_LOGIN_BELUM_ISI." Orang</td>
					  </tr>"; 
		break;
		case 'STATISTIK_PENDAFTAR':
				#echo "<pre>"; PRINT_R($statistik_pendaftar); echo "</pre>"; 
				echo "
				<thead>
				<tr>
					<th width='5%'>NO</th>
					<th width='10%'>PIN</th>
					<th width='40%' align='left'>NAMA PENDAFTAR</th>
					<th width='20%'>EMAIL</th>
					<th width='20%'>KONTAK</th>
				</tr>
				</thead>";
				$no=1;
				if(empty($statistik_pendaftar)){
					echo "
							<tbody>
							<tr>
								<td colspan='5' align='center' width='5%'>Tidak Ditemukan.</td>
							</tr>
							</tbody>";
				}else{
					foreach($statistik_pendaftar as $value){ 
						echo "
						<tbody>
						<tr>
							<td align='center' width='5%'>".$no."</td>
							<td width='10%'>".$value->PMB_PIN_PENDAFTAR."</td>
							<td width='40%' align='left'>".$value->PMB_NAMA_LENGKAP_PENDAFTAR."</td>
							<td width='20%'>".$value->PMB_EMAIL_PENDAFTAR."</td>
							<td width='20%' align='center'>".$value->PMB_TELP_PENDAFTAR."</td>
						</tr>
						</tbody>";
						$no++;
					}
				}
		break;
	}
?>
</table>
</div>