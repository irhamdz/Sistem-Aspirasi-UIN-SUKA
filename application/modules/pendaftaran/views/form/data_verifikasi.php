<?php
$eror_kode=array();
foreach ($data_diri as $dadir);
foreach ($data_kesehatan as $dakes);

if(!is_null($data_pendidikan))
{
	foreach ($data_pendidikan as $pd);
}

if(!is_null($pendidikan_terakhir))
{
	foreach ($pendidikan_terakhir as $pdt);
}

if(!is_null($data_piljur))
	{
		foreach ($data_piljur as $cek_jenjang);
		$jenjang=$cek_jenjang->nama_jenjang;
	}
else
{
	array_push($eror_kode, 2);
}


if(is_null($pendidikan_terakhir) && ($jenjang=='S1' || $jenjang=='D1' || $jenjang=='D3'))
{
	array_push($eror_kode, 1);
}

if(!is_null($pilih_jadwal))
{
	foreach ($pilih_jadwal as $jadwal);
}
else
{
	array_push($eror_kode, 3);
}
if($jenjang=='S1' || $jenjang=='D1' || $jenjang=='D2' || $jenjang=='D3' || $jenjang=='D4')
{
	$nama_pend='Nama Sekolah';
	$nama_sekolah='Jurusan';
	$nilai='Nilai STTB';
	if(!is_null($pendidikan_terakhir))
	{
	$isi1=$pdt->nama_sekolah;
	$isi2=$pdt->nama_jurusan_sekolah;
	$isi3=$pdt->nilai_sttb;	
	}
	else
	{
		$isi1='-';
		$isi2='-';
		$isi3='-';	
	}

}
else
{
	$nama_pend='Nama Pendidikan';
	$nama_sekolah='Nama Perguruan Tinggi';
	$nilai='IPK';
	$isi1=$pd->nama_pendidikan;
	$isi2=$pd->nama_pt;
	$isi3=$pd->ipk;
}

if(!is_null($tawar))
{
	foreach ($tawar as $ditawarkan);
}
$foto=pg_unescape_bytea($dadir->foto);
?>
<br id="ganjel">
<div class="system-content-sia" id="VERIFIKASI">
<?php
if(count($eror_kode)>0)
{
	for ($i=0; $i < count($eror_kode); $i++) { 
		echo "<br>".cek_data_kurang($eror_kode[$i],$ditawarkan->kode_jalur,$nomor_pendaftar);
	}
}

?>
<form id="data_verifikasi" method="post" id='verifikasi'>

<input type="hidden" name="nomor_pendaftar" id="nomor" value="<?php echo $nomor_pendaftar; ?>">
<input type="hidden" name="kode_jadwal" id="jadwal" value="<?php echo $jadwal->kode_jadwal; ?>">

<div class="bs-callout bs-callout-info">Verifikasi Data Anda. Dengan klik verifikasi anda tidak dapat mengubah data diri anda. anda dapat mencetak kartu ujian saja.</div>
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
	<tbody>
		<tr>
			
			<td align="center" colspan="2">
				<img src="<?php echo $foto; ?>" class="sia-profile-image">
			</td>
		</tr>
		<tr>
		<td>Biodata Pribadi</td>
		<td>
			<table class="table table-nama">
				<tr>
					<td>
						Nama
					</td>
					<td>
						<?php echo $dadir->gelar_depan.' '.$dadir->gelar_depan_na.' '.$dadir->nama_lengkap.' '.$dadir->gelar_belakang.' '.$dadir->gelar_belakang_na; ?>
					</td>
				</tr>
				<tr>
					<td>
						Alamat
					</td>
					<td>
						<?php echo $dadir->alamat_lengkap; ?>
					</td>
				</tr>
				<tr>
					<td>
						Kode Pos
					</td>
					<td>
						<?php echo $dadir->kode_pos; ?>
					</td>
				</tr>
				<tr>
					<td>
						Warga Negara
					</td>
					<td>
						<?php echo $dadir->nama_negara; ?>
					</td>
				</tr>
				<tr>
					<td>
						Tempat Lahir
					</td>
					<td>
						<?php echo $dadir->tempat_lahir; ?>
					</td>
				</tr>
				<tr>
					<td>
						Tanggal Lahir
					</td>
					<td>
						<?php echo date('d/m/Y',strtotime($dadir->tgl_lahir)); ?>
					</td>
				</tr>
				<tr>
					<td>
						Telp
					</td>
					<td>
						<?php echo $dadir->telp; ?>
					</td>
				</tr>
				<tr>
					<td>
						Hp
					</td>
					<td>
						<?php echo $dadir->nohp; ?>
					</td>
				</tr>
				<tr>
					<td>
						Agama
					</td>
					<td>
						<?php echo $dadir->nama_agama; ?>
					</td>
				</tr>
				<tr>
					<td>
						Nomor KTP
					</td>
					<td>
						<?php echo $dadir->no_ktp; ?>
					</td>
				</tr>
				<tr>
					<td>
						Email
					</td>
					<td>
						<?php echo $dadir->email; ?>
					</td>
				</tr>
				<!--
				<tr>
					<td>
						Golongan Darah
					</td>
					<td>
						<?php //echo $dadir->gol_darah; ?>
					</td>
				</tr>
				<tr>
					<td>
						Tinggi Badan
					</td>
					<td>
						<?php// echo $dadir->tinggi_badan; ?>
					</td>
				</tr>
				<tr>
					<td>
						Berat Badan
					</td>
					<td>
						<?php// echo $dadir->berat_badan; ?>
					</td>
				</tr>
				-->
				<tr>
					<td>
						Jenis Kelamin
					</td>
					<td>
						<?php if($dadir->jenis_kelamin=='L'){echo "LAKI-LAKI";}else{echo "PEREMPUAN";} ?>
					</td>
				</tr>
				<tr>
					<td>
						Nama Ibu
					</td>
					<td>
						<?php echo $dadir->nama_lengkap_ibu; ?>
					</td>
				</tr>
				<tr>
					<td>
						Nama Ayah
					</td>
					<td>
						<?php echo $dadir->nama_lengkap_ayah; ?>
					</td>
				</tr>

			</table>
			</td>
		</tr>
		<tr>
		<td>Data Kesehatan</td>
		
			
					<td>
						<?php echo $dakes->riwayat_penyakit; ?>
					</td>
			
		
		</tr>
		<tr>
		<td>Kemampuan Berbeda</td>
		<td>
			

				<?php 
				$difa="";
				if(!is_null($data_kemampuan_berbeda))
				{
				foreach ($data_kemampuan_berbeda as $dadif){
					
					 $difa .= $dadif->kondisi_kesehatan.', ';
				}
				echo $difa;
				}
				else
				{
					echo "Normal";
				}
				?>
		</td>
		</tr>
		<tr>
			<td>Pendidikan Sebelumnya</td>
			<td>
				<table class="table table-nama">
					<tr>
						<td><?php echo $nama_pend; ?></td>
						<td><?php echo $isi1;?></td>
					</tr>
					<tr>
						<td><?php echo $nama_sekolah; ?></td>
						<td><?php echo $isi2; ?></td>
					</tr>
					<tr>
						<td><?php echo $nilai; ?></td>
						<td><?php echo $isi3; ?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>Pilihan Jurusan</td>
			<td>
				<table class="table table-nama">
					<?php  
					$num=0;
					if(!is_null($data_piljur))
					{
						foreach ($data_piljur as $jurusan)
						 {
						 	//echo str_pad($num, 5, "0", STR_PAD_LEFT);
						 	echo "<br>";
							echo "<tr>";
							echo "<td>";
							echo "Pilihan ".$jurusan->pilihan;
							echo "</td>";
							echo "<td>";
							echo $jurusan->nama_prodi;
							echo "</td>";
							echo "</tr>";
						}
						echo "<tr>";
						echo "<td>";
						echo "Jenjang Pendidikan";
						echo "</td>";
						echo "<td>";
						echo $jurusan->nama_jenjang;
						echo "</td>";
						echo "</tr>";
					}
					?>
				</table>
			</td>

		</tr>

	<input type="hidden" name="tahun" id="tahun" value="<?php echo $ditawarkan->tahun; ?>">
	<input type="hidden" name="kode_jalur" id="jalur" value="<?php echo $ditawarkan->kode_jalur; ?>">
	<input type="hidden" name="gelombang" id="gelombang" value="<?php echo $ditawarkan->gelombang; ?>">
	<input type="hidden" name="penawaran" id="penawaran" value="<?php echo $ditawarkan->kode_penawaran; ?>">
		<tr>
			<td colspan="2" align="center">
			<?php if(count($eror_kode)<1){
			?>
				<input type="button" id="btn-verifikasi" onclick="simpan_verifikasi()" class="btn-uin btn btn-inverse" value="<< Verifikasi Data >>">
				<a href="" id="link_kartu" style="display:none" target="_blank"><button class="btn btn-uin btn-inverse" type="button">DOWNLOAD KARTU UJIAN</button></a>

				<?php }
			else
			{
				echo "<div class='bs-callout bs-callout-error'>";
				echo "TERDAPAT DATA YANG BELUM DIISI";
				echo "</div>";	
			}
			?>
			</td>
		</tr>
		
	</tbody>
	</table>
	<div id="psn"></div>
</form>

<script type="text/javascript">

function validasi_verifikasi()
{
	var pd="<?php echo count($data_pendidikan)+count($pendidikan_terakhir); ?>";
	var jd="<?php echo count($pilih_jadwal); ?>";
	var pp="<?php echo count($data_piljur); ?>";

	if(pd < 1)
	{
		return "Pendidikan terakhir anda belum disimpan dengan benar.";
	};
	if(jd < 1)
	{
		return "Lokasi ujian belum dipilih.";
	};
	if(pp < 1)
	{
		return "Program studi belum dipilih.";
	};
	if(pd > 0 && jd > 0 && pp > 0)
	{
		return 1;
	}

}

	function simpan_verifikasi () {
		var nomor=$('#nomor').attr('value');
		var tahun=$('#tahun').attr('value');
		var jalur=$('#jalur').attr('value');
		var gel=$('#gelombang').attr('value');
		var pen=$('#penawaran').attr('value');
		var jd=$('#jadwal').attr('value');
		var foto="<?php echo $dadir->foto; ?>";
		if(foto=='')
		{
			alert('Foto anda masih kosong. Silakan upload foto untuk mencetak kartu ujian anda!');
		}
		else
		{
			if(validasi_verifikasi()==1)
			{
				$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/daftar_mhs_c/verifikasi'); ?>",
						type	: "POST",            
						data: "nomor_pendaftar="+nomor+"&tahun="+tahun+"&kode_jalur="+jalur+"&gelombang="+gel+"&kode_penawaran="+pen+"&kode_jadwal="+jd,
						success: function(verif)
						{
								var cetak="<?php echo base_url('adminpmb/fpdf_c/ambil_data/'.$nomor_pendaftar) ?>";
								if(verif=='1')
								{
									$('#btn-verifikasi').hide();
									$('#link_kartu').attr('href',cetak);
									$('#link_kartu').slideDown('slow');
									
								}
								else
								{
									$('#psn').html(verif);	
								}
								
								
						}
					});
			}
			else
			{
				alert(validasi_verifikasi());
			}
		}
				
	}
function load_ulang(xyz)
{
	$('#slide-form').load(xyz);
}
</script>