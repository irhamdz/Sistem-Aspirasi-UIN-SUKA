<?php
$nomor="";
$nama_doc="";
$mentri="";
$unit="";
$alamat="";
$telp="";
$email="";
$tgl="";
$nip="";
$nama="";
$jabatan="";
$ta="";

if(!is_null($logo_doc))
{
	foreach ($logo_doc as $lg);
	$logo=pg_unescape_bytea($lg->logo);
}

if(!is_null($data_dokumen))
{
	foreach ($data_dokumen as $dk);
		$nomor=$dk->nomor;
		$nama_doc=$dk->keterangan;
		$mentri=$dk->kementrian;
		$unit=$dk->unit;
		$alamat=$dk->alamat;
		$telp=$dk->telp;
		$email=$dk->email;
		$tgl=$dk->tanggal;
		$nip=$dk->nip;
		$nama=$dk->nama;
		$jabatan=$dk->jabatan;
		$ta=$dk->tahun;
		$id_header=$dk->id_header;
		$id_footer=$dk->id_footer;
}

?>
<div id="config">
<img src="<?php echo $logo; ?>" width="100px" class="sia-profile">
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					NOMOR SURAT
				</td>
				<td>
					NAMA DOKUMEN
				</td>
				<td width="100">
					#
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<font id="nomor3"><?php echo $nomor; ?></font>
					<input type="hidden" id="nomor" class="form-control input-md" value="<?php if(!is_null($data_dokumen)){ echo $dk->nomor; }?>">
					<input type="text" id="nomor2" style="display:none;" class="form-control input-md" value="<?php if(!is_null($data_dokumen)){ echo $dk->nomor; }?>">
			
				</td>
				<td>
					<font id="id_dokumen3"><?php echo $nama_doc." ".$ta; ?></font>
					<input type="hidden" id="id_dokumen" class="form-control input-md" value="<?php if(!is_null($data_dokumen)){ echo $dk->id_dokumen; }?>">

				</td>
				<td width="100">
					<button class="btn btn-inverse btn-uin btn-small" type="button" id="edit_doc" onclick="edit_dokumen()"> EDIT</button>
					<button class="btn btn-inverse btn-uin btn-small" style="display:none;" id="simpan_doc" type="button" onclick="simpan_dokumen('<?php if(!is_null($data_dokumen)){ echo $dk->id_dokumen; } else{echo "0";}?>')"> SIMPAN</button>
				</td>
			</tr>
		</tbody>
	</table>
	
	<br>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					KEMENTRIAN
				</td>
				<td>
					NAMA UNIT
				</td>
				<td>
					ALAMAT
				</td>
				<td>
					TELP
				</td>
				<td>
					EMAIL
				</td>
				<td>
					TAHUN AKADEMIK
				</td>
				<td width="100">
					#
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<?php echo $mentri; ?>
				</td>
				<td>
					
				<font id="unit"><?php echo $unit; ?></font>
					<input type="text" class="form-control input-md" style="display:none" id="unit2" value="<?php echo $unit; ?>">
			
				</td>
				<td>
					<?php echo $alamat; ?>
				</td>
				<td>
					<?php echo $telp; ?>
				</td>
				<td>
					<?php echo $email; ?>
				</td>
				<td>
					<font id="ta"><?php echo $ta; ?></font>
					<input type="text" class="form-control input-md" style="display:none" id="ta2" value="<?php echo $ta; ?>">
				</td>
				<td width="100">
					<button class="btn btn-inverse btn-uin btn-small" type="button" id="edit_h" onclick="edit_header()"> EDIT</button>
					<button class="btn btn-inverse btn-uin btn-small" style="display:none" type="button" id="simpan_h" onclick="simpan_header('<?php echo $id_header; ?>')"> SIMPAN</button>
			
				</td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>
					TANGGAL
				</td>
				<td>
					NIP
				</td>
				<td>
					NAMA PEJABAT
				</td>
				<td>
					JABATAN
				</td>
				<td width="100">
					#
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					
				<font id="tanggal"><?php if(strlen($tgl)>0){echo tanggal_indonesia($tgl);} ?></font>
					<input type="text" class="form-control input-md" style="display:none" id="tanggal2" placeholder='dd/mm/yyyy' value="<?php if(strlen($tgl)>0){echo tgl_format($tgl);} ?>">
			
				</td>
				<td>
					
					<font id="nip"><?php echo $nip; ?></font>
					<div class="input-group" style="display:none" id="cari_nip" onclick="cari_pegawai()">
					<input type="text" class="form-control input-md" id="nip2" style="width:200px" value="<?php echo $nip; ?>">
					<span class="input-group-addon add-on" style="width:40px"><i class="icon-search"></i>
				</div>
				</td>
				<td>
					
					<font id="nama"><?php echo $nama; ?></font>
					<input type="text" class="form-control input-md" style="display:none" id="nama2" value="<?php echo $nama; ?>">
			
				</td>
				<td>
					
				<font id="jabatan" title="<?php echo $jabatan; ?>"><?php echo str_replace('_',' ',$jabatan); ?></font>
				<select class="form-control input-md" id="jabatan2" style="display:none">
					<option <?php if($jabatan=='Ketua'){echo " selected ";} ?> value="Ketua"> Ketua </option>
					<option <?php if($jabatan=='Rektor'){echo " selected ";} ?> value="Rektor"> Rektor </option>
					<option <?php if($jabatan=='Staf'){echo " selected ";} ?> value="Staf"> Staf </option>
				</select>
				
				</td>
				<td width="100">
					<button class="btn btn-inverse btn-uin btn-small" id="edit_f" type="button" onclick="edit_footer()"> EDIT</button>
					<button class="btn btn-inverse btn-uin btn-small" id="simpan_f" style="display:none;" type="button" onclick="simpan_footer('<?php echo $id_footer; ?>')"> SIMPAN</button>
				
				</td>
			</tr>
		</tbody>
	</table>
	<div id="tb-pgw"></div>
</div><script type="text/javascript">
function edit_header()
{
	$('#ta').hide();
	$('#edit_h').hide();
	$('#unit').hide();
	$('#unit2').slideDown('slow');
	$('#ta2').slideDown('slow');
	$('#simpan_h').slideDown('slow');
}

function simpan_header(id)
{
	var tahun=$('#ta2').val();
	var unit=$('#unit2').val();
	$('#ta2').hide();
	$('#unit2').hide();
	$('#simpan_h').hide();
	$('#ta').slideDown('slow');
	$('#edit_h').slideDown('slow');
	$('#unit').slideDown('slow');
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/update_header') ?>",
		type: "POST",
		data: "id_header="+id+"&tahun="+tahun+"&unit="+unit,
		success: function(bla)
		{
			$('#cari_doc').click();
		}
	});
}

	function edit_dokumen () {
		
		$('#nomor3').hide();
		$('#edit_doc').hide();
		$('#simpan_doc').slideDown('slow');
		
		$('#nomor2').slideDown('slow');
	}

	function simpan_dokumen (id_doc) 
	{
		var nomor=$('#nomor2').val();
		var nomor_kunci=$('#nomor').attr('value');
		
		if(id_doc != '0')
		{
			$.ajax({
			url: "<?php echo base_url('yudisium/yudisium_c/update_nomor_doc') ?>",
			type: "POST",
			data: "id_dokumen="+id_doc+"&nomor="+nomor,
			success: function(ok)
			{
				if(ok=='1')
				{
				
					$('#cari_doc').click();
				}
				else
				{
					alert(ok);
				}
				
			}
			});
		}
		
	}

	function pilih_pegawai(PG)
	{
		
		//$('#nip2').attr('value',PG.id);
		$('#nama2').attr('value',PG.value);
	}

	function cari_pegawai()
	{
		var nip=$('#nip2').val();
		$.ajax({
			url: "<?php echo base_url('yudisium/yudisium_c/cari_pegawai') ?>",
			type: "POST",
			data: "nip="+nip,
			success: function(x)
			{
				$('#tb-pgw').html(x);
			}
		});
	}

	function edit_footer()
	{
		$('#nip').hide();
		$('#nama').hide();
		$('#jabatan').hide();
		$('#edit_f').hide();
		$('#tanggal').hide()
		$('#cari_nip').slideDown('slow');
		$('#nama2').slideDown('slow');
		$('#jabatan2').slideDown('slow');
		$('#simpan_f').slideDown('slow');
		$('#tanggal2').slideDown('slow');
	}

	function simpan_footer(id_f)
	{
		var nip=$('#nip2').val();
		var nama=$('#nama2').val();
		var jabatan2=$('#jabatan2').val();
		var jabatan1=$('#jabatan').attr('title');
		var tanggal=$('#tanggal2').val();

		$.ajax({
			url: "<?php echo base_url('yudisium/yudisium_c/update_footer') ?>",
			type: "POST",
			data: "id_footer="+id_f+"&nip="+nip+"&nama="+nama+"&jabatan1="+jabatan1+"&jabatan2="+jabatan2+"&tanggal="+tanggal,
			success: function(uf)
			{
				$('#cari_doc').click();
				//alert(uf);
			}
		});
	}
</script>