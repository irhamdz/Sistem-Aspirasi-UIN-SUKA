<?php 
$jumlah=0;

if(!is_null($jumlah_penawaran))
{
	foreach ($jumlah_penawaran as $jml) {
		$jumlah=$jml->jumlah_penawaran;
	}
}

if(!is_null($penawaran_jalur))
{
	foreach ($penawaran_jalur as $jalur);
	$tahun=$jalur->tahun;
}
$pilih=array();
if(!is_null($maba))
{
	
	foreach ($maba as $data_maba) {
		array_push($pilih, $data_maba->id_prodi);
	}
}

$piljad=array();
if(!is_null($ambil_jadwal))
{
	foreach ($ambil_jadwal as $jadwal_ambil) 
	{
		array_push($piljad, $jadwal_ambil->kode_jadwal);
	}
}
 ?>

<br id="ganjel">
<div id='msg'></div>
<form method="POST" id="data_piljur">
<div class="bs-callout bs-callout-info">Tanda *) bermakna bahwa isian harus diisi.</div>
<table class="table table-nama">
	<tr>
		<td align="center" colspan='2'><strong>Jumlah Penawaran Prodi Anda <?php echo $jumlah; ?>.</strong><br /><br /></td>
		<input type="hidden" id="nomor" value="<?php echo $nomor_pendaftar; ?>" name='nomor_pendaftar'>
		<input type="hidden" id="jalur" value="<?php echo $kode_jalur; ?>">
		<input type="hidden" id="tahun" value="<?php echo $tahun; ?>">

	</tr>
	<?php for($i=1; $i<=$jumlah; $i++){ ?>
	<tr>
		<td><strong>Pilihan Jurusan <?php echo $i; ?></strong></td>
		<td><div class="col-xs-9"><select name='pilihan[]' id="<?php echo $i; ?>" onchange='pilih_prodi(this)' class="form-control input-sm" >
		<option value="">Pilih Program Studi</option>
		<?php
			foreach ($penawaran_prodi as $prodi) {
				echo "<option "; if(count($pilih)-($i-1) > 0 ){if($pilih[$i-1]==$prodi->id_prodi){echo "selected";}} echo " value='".$prodi->id_prodi."'>".$prodi->nama_prodi"</option>";
			}
			
		?>
			
			</select></div> *)
		</td>
		
	</tr>
	<input type="text" id="jenjang" value="<?php echo $prodi->id_jenjang;?>"> 
	<?php } ?>

	<tr id="LOKASI" style="display:none;">
		<td><strong>Pilih Lokasi Ujian</strong></td>
		<td><div class="col-xs-9">
		<select name="lokasi_ujian" onchange="pilih_lokasi(this)" class="form-control input-sm" id="lokasi">
			<option value="">Pilih Lokasi</option>
			<?php
			if(!is_null($data_jadwal))
			{
				foreach ($data_jadwal as $jadwal) {
					echo "<option "; if(count($piljad)>0){if($piljad[0]==$jadwal->kode_jadwal){echo " selected ";}} echo " value='".$jadwal->kode_jadwal."'>".$jadwal->lokasi_ujian.' '.date_format(date_create($jadwal->tanggal),'d-m-Y')."</option>";
				}
			}

			?>
		</select>
			</div> *)
		</td>
	</tr>
</table>
<?php } ?>
</form>
<div id="jadwal">

</div>
<script type="text/javascript">
$(document).ready(function(){
	
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    
    	}


});
var nomor=$('#nomor').attr('value');
function pilih_prodi (pilprod) {
		// body...
var pilih=$('#'+pilprod.id).attr('value');
var index=pilprod.id;
var tahun=$('#tahun').attr('value');
var jenjang=$('#jenjang').attr('value');
var jalur=$('#jalur').attr('value');

					$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/insert_piljur'); ?>",
						type	: "POST",            
						data: "pilih="+pilih+"&nomor_pendaftar="+nomor+"&jenjang="+jenjang+"&tahun="+tahun+"&jalur="+jalur+"&index="+index,
						success: function(x)
						{
							
							$('#msg').html(x);
							
							var idloc=$('#siap').attr('value');
							if(idloc=='0')
							{
								$('#'+pilprod.id).attr('value','');
								
							}
					
						}
					});

	}

	function pilih_lokasi(jadwal)
	{
		if(jadwal.value != '')
		{

				
				$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/update_pilih_jadwal'); ?>",
						type	: "POST",            
						data: "nomor_pendaftar="+nomor+"&kode_jadwal="+jadwal.value,
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
</script>