<script type="text/javascript">
	var fak=0;
	function cari_kuliah(idkelas)
	{
		var nomor=$('#nomor').attr('value');
		var jalur=$('#jalur').attr('value');
		var penawaran=$('#penawaran').attr('value');
		var tahun=$('#tahun').attr('value');
				$.ajax({
				url: "<?php echo base_url('pendaftaran/form_control/lihat_kuliah') ?>",
				type: "POST",
				data: "id_kelas="+idkelas,
				success: function(kul)
				{
					
					$('#pilkul').html(kul);
					
				}
			});

		
			$.ajax({
			
			url : "<?php echo base_url('pendaftaran/form_control/req_prodi') ?>",
			type : "POST",
			data : "id_kelas="+idkelas+"&kode_jalur="+jalur+"&kode_penawaran="+penawaran+"&nomor_pendaftar="+nomor,
			success: function(reqprodi) {

				
				
				$('#jur').html(reqprodi);
				$('#jur_tr').slideDown('slow');
				
				
			}
		});	


	}

	function pilih_lokasi(jadwal)
	{
		var nomor1=$('#nomor').attr('value');
		var jalur=$('#jalur').val();
		if(jadwal.value != '')
		{

				
				$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/update_pilih_jadwal'); ?>",
						type	: "POST",            
						data: "nomor_pendaftar="+nomor1+"&kode_jadwal="+jadwal.value+"&kode_jalur="+jalur,
						success: function(x)
						{
							$('#jadwal').html(x);
							$('#jadwal').slideDown('slow');
							
						}
					});

		
		}
		else
		{
			$('#jadwal').slideUp('slow');
		}
	}


function pilih_prodi(pilprod) {
		// body...
var pilih=$('#'+pilprod.id).attr('value');
var index=pilprod.id;
var tahun=$('#tahun').attr('value');
var jenjang=$('#jenjang').attr('value');
var jalur=$('#jalur').attr('value');
var kelas_lagi=$('#kelas').attr('value');
var nomor=$('#nomor').attr('value');
var penawaran=$('#penawaran').attr('value');

if(kelas==null)
{
	kelas=kelas_lagi;
}

					$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/insert_piljur'); ?>",
						type	: "POST",            
						data: "pilih="+pilih+"&nomor_pendaftar="+nomor+"&jenjang="+jenjang+"&tahun="+tahun+"&jalur="+jalur+"&index="+index+"&id_kelas="+kelas_lagi+"&kode_penawaran="+penawaran,
						success: function(x)
						{
							
							$('#msg').html(x);
							
							var idloc=$('#siap').val();
							if(idloc=='0')
							{
								$('#'+pilprod.id).attr('value','');
							}
							else
							{
								if(jalur.substr(0,1)=='1')
								{
									var pilfak=$('#status_fak').val();
									if(pilfak==1)
									{
										$('#3').attr('value','');
										$('#3').attr('disabled',true);
										
									}
									else
									{
										$('#3').attr('disabled',false);
									}
									
								
								}
							}

							
					
						}
					});

cari_fakultas(pilih,index);

	}

function delete_prodi_3()
{
	var nomor=$('#nomor').val();
	$.ajax({
		url: "<?php echo base_url('pendaftaran/form_control/delete_pil_prod_post') ?>",
		type: "POST",
		data: "nomor_pendaftar="+nomor,
		success: function(ke3)
		{
			if(ke3==1)
			{
				document.getElementById('3').selectedIndex=0;
			}
		}
	});

}

function cari_fakultas(id_prodi,no)
{
	$.ajax({
		url: "<?php echo base_url('pendaftaran/daftar_mhs_c/cari_fakultas') ?>",
		type: "POST",
		data: "id_prodi="+id_prodi,
		success: function(fak)
		{
			$('#fakultas'+no).attr('value',fak);
		}
	});
}
</script>
<?php

	function tanggal_hari($tanggal){
	$tgl=explode("-",$tanggal);
	$info=date('w', mktime(0,0,0,$tgl[1],$tgl[0],$tgl[2]));
	switch($tgl[1]){
			case '01': $bulan= "Januari"; break;
			case '02': $bulan= "Februari"; break;
			case '03': $bulan= "Maret"; break;
			case '04': $bulan= "April"; break;
			case '05': $bulan= "Mei"; break;
			case '06': $bulan= "Juni"; break;
			case '07': $bulan= "Juli"; break;
			case '08': $bulan= "Agustus"; break;
			case '09': $bulan= "September"; break;
			case '10': $bulan= "Oktober"; break;
			case '11': $bulan= "November"; break;
			case '12': $bulan= "Desember"; break;
		};
		switch($info){
			case '0': $hari= "Minggu"; break;
			case '1': $hari= "Senin"; break;
			case '2': $hari= "Selasa"; break;
			case '3': $hari= "Rabu"; break;
			case '4': $hari= "Kamis"; break;
			case '5': $hari= "Jumat"; break;
			case '6': $hari= "Sabtu"; break;
		};
	$tampil_tanggal=$hari.", ".$tgl[0]." ".$bulan." ".$tgl[2];
	return $tampil_tanggal;
}


$piljad=array();
if(!is_null($ambil_jadwal))
{
	foreach ($ambil_jadwal as $jadwal_ambil) 
	{
		array_push($piljad, $jadwal_ambil->kode_jadwal);
	}
}
if(!is_null($penawaran_jalur))
{
	foreach ($penawaran_jalur as $jalur);
	$tahun=$jalur->tahun;
}

$ks=array();
//$jml_pil=array();
if(!is_null($maba))
{
	
	foreach ($maba as $data_maba) {
		array_push($ks, $data_maba->id_kelas);
		//array_push($jml_pil, $data_maba);
	}
}

if(!is_null($kelas))
{
	foreach ($kelas as $hitkel);
}

$jmlh=array();
$jumlah=0;
if(!is_null($jumlah_penawaran))
{
	foreach ($jumlah_penawaran as $jml) {
		$jumlah=$jml->jumlah_penawaran;
		
	}
}

if(substr($kode_jalur, 0,1)=='1')
{
	$data_fakultas=array();
	if(!is_null($ambil_fakultas))
	{
		foreach ($ambil_fakultas as $fak) {
			array_push($data_fakultas, $fak->id_fakultas);
		}
	};

}

if(count($faculty)>1)
{
	echo '<script type="text/javascript">';
		if($faculty[0]==$faculty[1])
		{
			
			echo 'fak="1";';
			echo "$('#3').attr('disabled',true);";
		
		}
		else
		{
			
			echo 'fak="0";';
			echo "$('#3').attr('disabled',false);";
			
		}
	echo '</script>';
};
$a=0;

?>
<br id="ganjel">
<div id='msg'></div>
<form method="POST" id="data_piljur">
<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div>
<input type="hidden" name="kode_jalur" id="jalur" value="<?php echo $kode_jalur; ?>">
<input type="hidden" id="penawaran" value="<?php echo $kode_penawaran; ?>">
<input type="hidden" name="nomor_pendaftar" id="nomor" value="<?php echo $nomor_pendaftar; ?>">
<input type="hidden" id="tahun" value="<?php echo $tahun; ?>">
<table class="table table-nama">
<?php 

 if(count($kelas) > 1) { ?>
	<tr>
		<td>
			<strong>Pilih Kelas</strong>
		</td>
		<td> <font id="pilkul"></font><div class="col-xs-9">
			<select name="kelas" onchange="cari_kuliah(this.value)" class="form-control input-sm">
				<option value="">--</option>
				<?php
				if(!is_null($kelas))
				{
					foreach ($kelas as $kls) {
						echo "<option ";
						if(count($ks)>0)
						{
							if($ks[0]==$kls->id_kelas)
							{
							echo "selected";
							}
						}
						
						echo " value='".$kls->id_kelas."'>".$kls->nama_kelas."</option>";	
						}
				}
				?>
			</select>

			</div>
		</td>
	</tr>
<?php  }
elseif(count($kelas)=='1')
{

$pilih=array();
$kelas2=array();
if(!is_null($maba))
{
	foreach ($maba as $data_maba) {
		array_push($pilih, $data_maba->id_prodi);
		array_push($kelas2, $data_maba->id_kelas);
	}
}

 for($i=1; $i<=$jumlah; $i++){ ?>

	<tr>
		<td>
		<br>
		<strong >Pilihan Jurusan <?php echo $i; ?></strong></td>
		<td>
		<select name='pilihan[]' id="<?php echo $i; ?>" onchange='pilih_prodi(this)' class="form-control input-sm">
		<option value="">Pilih Program Studi</option>
		<?php
			foreach ($penawaran_prodi as $prodi) {
				echo "<option "; 
							
						if(count($pilih)-($i-1) > 0 ){if($pilih[$i-1]==$prodi->id_prodi && $kelas2[0]==$prodi->id_kelas){echo " selected ";}} 

				echo " value='".$prodi->id_prodi."'>".$prodi->nama_prodi."</option>";
			}
			
		?>
			
			</select>
			<input type="hidden" id="jenjang" value="<?php if(!is_null($penawaran_prodi)){echo $prodi->id_jenjang;} ?>">
			<input type="hidden" id="kelas" value="<?php if(!is_null($penawaran_prodi)){echo $prodi->id_kelas;} ?>">
			<input type="hidden" id="fakultas<?php echo $i; ?>" name="fakultas[]" value="<?php if(substr($kode_jalur, 0,1)=='1' && $i<=count($data_fakultas)){ echo $data_fakultas[$a];} $a+=1; ?>">
		
		</td>
	</tr>
	<?php }

	} 

 ?>
	<tr id="jur_tr" style="display:none;">
	<td>
		
	</td>
	<td id="jur">
		
	</td>

	</tr>
		<tr id="LOKASI">
		<td><strong>Pilih Lokasi Ujian</strong></td>
		<td>
		<select name="lokasi_ujian" onchange="pilih_lokasi(this)" class="form-control input-sm" id="lokasi">
			<option value="">Pilih Lokasi</option>
			<?php
			if(!is_null($data_jadwal))
			{
				$temp="";
				
				foreach ($data_jadwal as $jadwal) {
				if($temp!=$jadwal->kode_jadwal)
					{
						
						echo "<option "; if(count($piljad)>0){if($piljad[0]==$jadwal->kode_jadwal){echo " selected ";}} echo " value='".$jadwal->kode_jadwal."'>".$jadwal->lokasi_ujian.' '.tanggal_hari(date_format(date_create($jadwal->tanggal),'d-m-Y')).' Pukul: '.$jadwal->jam_mulai."</option>";
					$temp=$jadwal->kode_jadwal;
					}

				
				}
			}

			?>
		</select>
		
		</td>
	</tr>
</table>
</form>
<div id="jadwal">

</div>
<script type="text/javascript">
$(document).ready(function(){

var valkel=<?php echo $ks[0]; ?>;
var hikel=<?php echo count($kelas); ?>;

	if(valkel!='' && hikel > 1)
	{
		cari_kuliah(valkel);
		$('#jur_tr').show();

	}
	else
	{
		$('#jur_tr').hide();
	};
	
	if(fak==1)
	{
		delete_prodi_3();
	}

});

</script>