<?php

foreach ($maba as $data_maba){};

$jenis_tpa=array();
$jenis_ing=array();
$jenis_arab=array();
$jenis_indo=array();
if(!is_null($jenis_sertifikat1))
{
	foreach ($jenis_sertifikat1 as $js) {
		switch ($js->jenis_sertifikat) {
			case 'TPA':			
						array_push($jenis_tpa, $js);
				break;
			case 'BING':
					if(substr($kode_penawaran, 0,1)=='2' && $js->id_sertifikat=='SURAT_PERNYATAAN_3')
					{
						//dont do that wkwkwk
					}
					else
					{
						array_push($jenis_ing, $js);

					}
					
				break;
			case 'ARAB':
			if(substr($kode_penawaran, 0,1)=='2' && $js->id_sertifikat=='SURAT_PERNYATAAN_2')
					{
						//dont do that wkwkwk
					}
					else
					{
				array_push($jenis_arab, $js);
				}
				break;
			case 'INDO':
					array_push($jenis_indo, $js);	
				break;
	
		}

	}
}

$isi_tpa="";
$isi_ing="";
$isi_arab="";
$isi_indo="";
if(!is_null($detail_sertifikat))
{
	foreach ($detail_sertifikat as $ds) {
		switch ($ds->jenis_sertifikat) {
			case 'TPA':
				$isi_tpa= $ds->id_sertifikat;
				break;
			case 'BING':
				$isi_ing= $ds->id_sertifikat;
				break;
			case 'ARAB':
				$isi_arab= $ds->id_sertifikat;
				break;
			case 'INDO':
				$isi_indo= $ds->id_sertifikat;
				break;
	
		}
	}
}
$informasi="";
switch (substr($kode_penawaran, 0,1)) {
	case '2':
		$informasi="Silakan isi nilai sertifikasi dengan benar dan upload sertifikat. Pengisian TOEFL/TOAFL diijinkan salah satu atau keduanya.";
		break;
	case '3':
		$informasi="Jika anda tidak memiliki sertifikat, silakan isi nilai sertifikasi dengan isian 999 dan upload surat pernyataan jika belum pernah mengikuti ujian sertifikasi (TPA/TOEFL/TOAFL).";
		break;

}
?>
<br id="ganjel">
<div id="msg"></div> 
<div class="system-content-sia">
<form method="POST" id="data_sertifikasi" >
<div class="bs-callout bs-callout-info"><p>Tanda *) bermakna bahwa isian harus diisi. File sertifikat yang bisa diterima berformat JPG, JPEG, BMP, PDF. Pilih jenis sertifikat yang akan diupload pada kanan kolom.</p>
<p> <?php echo $informasi; ?> 
<?php
if(substr($kode_penawaran, 0,1)=='3'){
?>
<strong><u><a download href="http://admisi.uin-suka.ac.id/media/pengumuman/20160314_Surat%20pernyataan%20kesanggupan%20Skor%20TOEFL%20IELTS%20TOAFL%20S3.pdf">Download Surat Pernyataan</a></u></strong>
<?php
}
?>
</p></div> 
<table class="table table-nama" style="border: none; margin-bottom:2%; width: 100%;">
<input type="hidden" value="<?php echo $data_maba->nomor_pendaftar; ?>" name='nomor_pendaftar' id='nomor'>
	<tbody>
		<tr>
			<td colspan='3'><br /><strong>Data Sertifikasi</strong><br /></td>
		</tr>
		<tr id="NILAI_TPA" style="display:none;">
			<td >NILAI TPA / GRE / GMAT</td>
			<td><div class="col-xs-7"><input type="text" id="TPA" onkeypress="tampil_file_gre();return isNumberKey(event);" value="<?php echo $data_maba->nilai_gre; ?>" required class="form-control input-sm" name="nilai_gre" /></div> *)

			</td>
			<td>
				<?php

				$num=0;
				foreach ($jenis_tpa as $jt) {
						
					
							echo "<input type='radio' "; 
							
							
							if($isi_tpa == $jt->id_sertifikat)
							{
							echo " checked ";
							}
							
							echo " onchange='simpan_jenis(this)' isi='".$jt->jenis_sertifikat."' ids='".$jt->id_sertifikat."' name='tpa_cek' id='".$jt->id_sertifikat.$num."' value='".$data_maba->nomor_pendaftar."'> ".str_replace('1', '', (str_replace("_", " ", $jt->id_sertifikat)));
							echo "<br>";
		
				}
				?>

			<div class='reg-info'>
                Pilih jenis sertifikat yang anda miliki.
            </div>
			</td>
			
		</tr>
		<tr style="display:none;" id="ser_gre">
			<td >Scan Sertifikat TPA / GRE / GMAT
				<div class='reg-info'>
					Tipe file yang diizinkan jpg, jpeg dan pdf berukuran maksimum 1 MB
					</div>
			</td>
			<td><div class="col-xs-7"><input type="file" id="greInp"  /></div> *)
				<input type="hidden"  id="greOut" name="gre" />
			<input type="hidden" id="gre2" value="<?php if(!is_null($data_maba->sertifikat_gre)){echo $data_maba->sertifikat_gre;} ?>" name="gre2">
			<?php 
			if(strlen($data_maba->sertifikat_gre)>50)
				{
					echo "<a download href='".pg_unescape_bytea($data_maba->sertifikat_gre)."'>Sertifikat TPA </a>";
				}
			?>
			</td>
			
		</tr>
		<tr id="NILAI_TOAFL" style="display:none;">
			<td >KEMAMPUAN BERBAHASA ARAB</td>
			<td><div class="col-xs-7"><input type="text" id="ARAB" onkeypress="tampil_file_ikla(); return isNumberKey(event);" value="<?php echo $data_maba->nilai_toafl; ?>" required class="form-control input-sm" name="nilai_toafl" /></div> *)</td>
			<td>
				<?php
				
				foreach ($jenis_arab as $ja) {
					echo "<input type='radio' ";

					if($isi_arab == $ja->id_sertifikat)
						{
							echo " checked ";
						}

					echo " name='ikla_cek' isi='".$ja->jenis_sertifikat."' ids='".$ja->id_sertifikat."' onchange='simpan_jenis(this)' id='".$ja->id_sertifikat."' value='".$data_maba->nomor_pendaftar."'> ".str_replace('2', '', (str_replace("_", " ", $ja->id_sertifikat)));
					echo "<br>";
				}
				?>
				<div class='reg-info'>
                Pilih jenis sertifikat yang anda miliki.
            </div>
			</td>
		</tr>
		<tr style="display:none;" id="ser_ikla" >
			<td >Scan Sertifikat
				<div class='reg-info'>
					Tipe file yang diizinkan jpg, jpeg dan pdf berukuran maksimum 1 MB
					</div>
			</td>
			<td><div class="col-xs-7"><input type="file" id="toaflInp"  /></div> *)
				<input type="hidden"  id="toaflOut" name="toafl" />
			<input type="hidden" id="toafl2" value="<?php if(!is_null($data_maba->sertifikat_toafl)){echo $data_maba->sertifikat_toafl;} ?>" name="toafl2">
			<?php 
			if(strlen($data_maba->sertifikat_toafl)>50)
				{
					echo "<a download href='".pg_unescape_bytea($data_maba->sertifikat_toafl)."'>Sertifikat TOAFL </a>";
				}
			?>
			</td>
		</tr>
		<tr id="NILAI_TOEFL" style="display:none;">
			<td width=150 >KEMAMPUAN BERBAHASA INGGRIS</td>
			<td><div class="col-xs-7"><input type="text" id="BING" onkeypress="tampil_file_toefl(); return isNumberKey(event);" value="<?php echo $data_maba->nilai_toefl; ?>" required class="form-control input-sm" name="nilai_toefl" /></div> *)</td>
			<td>
				<?php
				
				foreach ($jenis_ing as $jto) {
					echo "<input type='radio' ";

					if($isi_ing == $jto->id_sertifikat)
						{
							echo " checked ";
						}

					echo " name='toefl_cek' onchange='simpan_jenis(this)' ids='".$jto->id_sertifikat."' isi='".$jto->jenis_sertifikat."' id='".$jto->id_sertifikat."' value='".$data_maba->nomor_pendaftar."'> ".str_replace('3', '', (str_replace("_", " ", $jto->id_sertifikat)));
					echo "<br>";
				}
				?>
				<div class='reg-info'>
                Pilih jenis sertifikat yang anda miliki.
            </div>
			</td>
		</tr>
		<tr style="display:none;" id="ser_toefl">
			<td >Scan Sertifikat
				<div class='reg-info'>
					Tipe file yang diizinkan jpg, jpeg dan pdf berukuran maksimum 1 MB
					</div>
			</td>
			<td><div class="col-xs-7"><input type="file" id="toeflInp"/></div> *)
				<input type="hidden"  id="toeflOut" name="toefl" />
			<input type="hidden" id="toefl2" value="<?php if(!is_null($data_maba->sertifikat_toefl)){echo $data_maba->sertifikat_toefl;} ?>" name="toefl2">
			<?php 
			if(strlen($data_maba->sertifikat_toefl)>50)
				{
					echo "<a download href='".pg_unescape_bytea($data_maba->sertifikat_toefl)."'>Sertifikat TOEFL </a>";
				}
			?>
			</td>
		</tr>
		<input type="hidden" id="d_s_penawaran" name="d_s_penawaran">
		<tr id="SCAN_KEPEMIMPINAN">
			<td >Sertifikat Kepemimpinan / Sertifikat Pendukung
				<div class='reg-info'>
					Tipe file yang diizinkan jpg, jpeg dan pdf berukuran maksimum 1 MB
					</div>
			</td>
			<td colspan="2"><div class="col-xs-7"><input type="file" id="penInp"/></div>
			<input type="hidden"  id="penOut" name="kepemimpinan">
			<input type="hidden" id='kepemimpinan2' value="<?php if(!is_null($data_maba->sertifikat_pendukung)){echo $data_maba->sertifikat_pendukung;} ?>" name="kepemimpinan2">
			<?php 
			if(strlen($data_maba->sertifikat_pendukung)>50)
				{
					echo "<a download href='".pg_unescape_bytea($data_maba->sertifikat_pendukung)."'>Sertifikat Pendukung </a>";
				}
			?>
			</td>
		</tr>
		<?php
		
		if(!is_null($warga_negara))
		{
			foreach ($warga_negara as $dari);
			echo "<input id='wn' type='hidden' name='wn' value='".$dari->warga_negara."'>";
			if($dari->warga_negara!='99')
			{

		?>
		<tr id="NILAI_WNA" style="display:none;">
			<td width=150 >KEMAMPUAN BERBAHASA INDONESIA</td>
			<td><div class="col-xs-7"><input type="text" id="INDO" onkeypress="return isNumberKey(event)" value='<?php echo $data_maba->nilai_bhs_indo; ?>' required class="form-control input-sm" name="nilai_indo" /></div> *)</td>
			<td>
				<?php
				foreach ($jenis_indo as $jind) {
					echo "<input type='radio' "; 

					if( $jind->id_sertifikat == $isi_indo)
						{
							echo "checked ";
						}

					echo " onchange='simpan_jenis(this)' ids='".$jind->id_sertifikat."' isi='".$jind->jenis_sertifikat."' name='wna_cek' id='".$jind->id_sertifikat."' value='".$data_maba->nomor_pendaftar."'> ".$jind->id_sertifikat;
					echo "<br>";
				}
			
				?>
				<div class='reg-info'>
                Pilih jenis sertifikat yang anda miliki.
            </div>
			</td>
		</tr>
		<tr id="WNA_SERTIFIKAT">
					<td class="reg-label">
					Sertifikat Menguasai Bahasa Indonesia (WNA)<br/>
					<div class='reg-info'>
					Tipe file yang diizinkan jpg, jpeg dan pdf berukuran maksimum 1 MB
					</div>
					</td>
					<td class="reg-input2"><div class="col-xs-7">
					<input type='file' id="wnaInp" required/>
					<input type='hidden' id="wnaOt"  name='wna' />
					<input type="hidden" id="wna2" name="wna2" value="<?php if(!is_null($data_maba->sertifikat_bhs_indo)){ echo $data_maba->sertifikat_bhs_indo; }?>">
					</div>*)
				<?php 
			if(strlen($data_maba->sertifikat_bhs_indo)>50)
				{
					echo "<a download href='".pg_unescape_bytea($data_maba->sertifikat_bhs_indo)."'>Sertifikat Bahasa Indonesia </a>";
				}
			?>
			</td>
			<td></td>
			</tr>
		<?php
	}
	else
	{
		echo "<input type='hidden' id='INDO' value='0' name='nilai_indo'>";
		echo "<input type='hidden' id='wnaOt'  value='' name='wna' />";
	}
}
		?>
	<!--
	<tr>
		<td>
			
		</td>
		<td>
			<button class="btn btn-inverse btn-uin" type="button" onclick="simpan_sertifikat()"> Simpan</button>
		</td>
	</tr>
	-->
	</tbody>
	</table>
	</form>
<script type="text/javascript">

function simpan_sertifikat()
{

	$.ajax({
					url 	: "<?php echo base_url('adminpmb/daftar_mhs_c/data_sertifikasi2'); ?>",
					type	: "POST",            
					data: "nomor_pendaftar="+$('#nomor').val()+"&d_s_penawaran="+$('#d_s_penawaran').val()+
					"&nilai_toefl="+$('#BING').val()+"&nilai_toafl="+$('#ARAB').val()+"&nilai_indo="+$('#INDO').val()+
					"&wna="+$('#wnaOt').val()+"&wna2="+$('#wna2').val()+"&toefl="+$('#toeflOut').val()+"&toefl2="+$('#toefl2').val()+
					"&toafl="+$('#toaflOut').val()+"&toafl2="+$('#toafl2').val()+"&gre="+$('#greOut').val()+"&gre2="+$('#gre2').val()+
					"&nilai_gre="+$('#TPA').val()+"&kepemimpinan="+$('#penOut').val()+"&kepemimpinan2="+$('#kepemimpinan2').val()+
					"&wn="+$('#wn').val(),
					success: function(ser)
					{
						$('#msg').html(ser);
					}
			});

}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

$(document).ready(function(){

$('#d_s_penawaran').attr('value',$('#kode_penawaran').attr('value'));
	for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}
var tp=$('#TPA').val();
var toe=$('#BING').val();
var toa=$('#ARAB').val();
if(tp.length>0)
{
	tampil_file_gre();
};
if(toe.length>0)
{
	tampil_file_toefl();
};
if(toa.length>0)
{
	tampil_file_ikla();
};

});

function tampil_file_toefl()
{
	$('#ser_toefl').slideDown('slow');
}

function tampil_file_ikla()
{
		$('#ser_ikla').slideDown('slow');
}

function tampil_file_gre()
{
	$('#ser_gre').slideDown('slow');
}	

function readURLTOE(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
         	$('#toeflOut').attr('value', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#toeflInp").change(function(){

	if(this.files[0].size/1024/1024 <= 1)
	{

    readURLTOE(this);
	}
	else
	{
		alert("Ukuran file terlalu besar.");
		$('#toeflInp').attr('value',null);
	}   
});

function readURLKP(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
         	$('#penOut').attr('value', e.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#penInp").change(function(){

    if(this.files[0].size/1024/1024 <= 1)
	{

     readURLKP(this);
	}
	else
	{
		alert("Ukuran file terlalu besar.");
		$('#penInp').attr('value',null);
	} 
   
});

function readURLTOA(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
         	$('#toaflOut').attr('value', e.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#toaflInp").change(function(){

	
    
     if(this.files[0].size/1024/1024 <= 1)
	{
		readURLTOA(this);
 
	}
	else
	{
		alert("Ukuran file terlalu besar.");
		$('#toaflInp').attr('value',null);
	} 

   
});

function readURLGRE(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
         	$('#greOut').attr('value', e.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#greInp").change(function(){

	
    
     if(this.files[0].size/1024/1024 <= 1)
	{
		readURLGRE(this);
	}
	else
	{
		alert("Ukuran file terlalu besar.");
		$('#greInp').attr('value',null);
	} 
   
});

function readURLWNA(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#wnaOt').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#wnaInp").change(function(){

	
    
     if(this.files[0].size/1024/1024 <= 1)
	{
		readURLWNA(this);
	}
	else
	{
		alert("Ukuran file terlalu besar.");
		$('#penInp').attr('value',null);
	} 
   
});

function showing_upload(who_am_i)
{
	switch(who_am_i)
	{
		case 'TPA':
		$('#ser_gre').show();
		break;
		case 'ARAB':
		$('#ser_ikla').show();
		break;
		case 'BING':
		$('#ser_toefl').show();
		break;
		case 'INDO':
		$('#WNA_SERTIFIKAT').show();
		break;
	}

}


function simpan_jenis(sjt)
{
	
	var jenissertifikat=$('#'+sjt.id).attr('isi');
	var id_sertifikat=$('#'+sjt.id).attr('ids');
	
	showing_upload(jenissertifikat);

	$.ajax({
		url: "<?php echo base_url('adminpmb/form_control/detail_sertifikat'); ?>",
		type: "POST",
		data: "nomor_pendaftar="+sjt.value+"&id_sertifikat="+id_sertifikat+"&jenis_sertifikat="+jenissertifikat,
		success: function(jentpa){
			
			$('#'+jenissertifikat).attr('disabled',false);
			
			if(sjt.id=='PERNYATAAN_TOAFL' || sjt.id=='PERNYATAAN_TOEFL')
			{
				alert('UPLOAD SURAT PERNYATAAN! ISIAN NILAI ISI DENGAN 999');
			};
			if(sjt.id=='PERNYATAAN_TOEFL')
			{
				$('#BING').attr('value','999');

			};
			if(sjt.id=='PERNYATAAN_TOAFL')
			{
				$('#ARAB').attr('value','999');
			}

		}
	});
//alert($('#data_sertifikasi').serialize());
}


	</script>




