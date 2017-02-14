<?php

$pilih1=array();
$kelas1=array();
if(!is_null($maba))
{
	foreach ($maba as $data_maba) {
		array_push($pilih1, $data_maba->id_prodi);
		array_push($kelas1, $data_maba->id_kelas);
	}
}
$jumlah=0;
$a=0;
if(!is_null($jumlah_penawaran))
{
	foreach ($jumlah_penawaran as $jml) {
		$jumlah=$jml->jumlah_penawaran;
	}
}

 for($i=1; $i<=$jumlah; $i++){ ?>

	<tr>
		<td>
		<br>
		<strong>Pilihan Jurusan <?php echo $i; ?></strong></td>
		<td>
		<select name='pilihan[]' id="<?php echo $i; ?>" onchange='pilih_prodi(this)' class="form-control input-sm" >
		<option value="">Pilih Program Studi</option>
		<?php
			foreach ($penawaran_prodi as $prodi) {
				echo "<option "; 
							
						if(count($pilih1)-($i-1) > 0 ){if($pilih1[$i-1]==$prodi->id_prodi && $kelas1[0]==$prodi->id_kelas){echo " selected ";}} 

				echo " value='".$prodi->id_prodi."'>".$prodi->nama_prodi."</option>";
			}
			
		?>
			
			</select> *)
			<input type="hidden" id="jenjang" value="<?php if(!is_null($penawaran_prodi)){echo $prodi->id_jenjang;} ?>">
			<input type="hidden" id="kelas" value="<?php if(!is_null($penawaran_prodi)){echo $prodi->id_kelas;} ?>">
			<input type="hidden" id="fakultas<?php echo $i; ?>" name="fakultas[]" value="<?php if(substr($kode_jalur, 0,1)=='1' && $i<=count($data_fakultas)){ echo $data_fakultas[$a];} $a+=1; ?>">
			</td>
	</tr>
	<?php } ?>
