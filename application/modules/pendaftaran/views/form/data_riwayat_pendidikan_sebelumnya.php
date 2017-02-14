<br id="ganjel">
<form action="#fokus" enctype="multipart/form-data" id="data_riwayat_pendidikan_sebelumnya" name="form_sakti" method="POST">
<input type="hidden" id="nomor" name="nomor_pendaftar" value="<?php echo $nomor_pendaftar; ?>" id="id_step_tujuan">
<style>
	thead th{
		text-transform: uppercase;
	}
	div.b128{
	    border-left: 1px black solid;
		height: 60px;
	}	
	table.tb128{
		border:1px solid;
		width:100px;
	}
	.add_tgl{
		width:80px;
	}
	td.reg-label{
		padding-right:20px;
		text-align:left;
		line-height:30px;
		vertical-align:top;
		width:180px;
	}
	td.reg-input{
		line-height:30px;
		vertical-align:top;
	}
	.reg-kolom-kanan{
		float:right;
		width:45%;
		text-align:right;
	}
	.reg-kolom-kiri{
		float:left;
		width:45%;
	}
	.ganjel{
		clear:both;
	}
	.ac_results ul {
		width: 100%;
		list-style-position: outside;
		list-style: none;
		padding: 0;
		margin: 0;
	}
	.ac_results li {
		margin: 0px;		
		cursor: default;
		display: block;
		font: menu;		
		overflow: hidden;
		display:block;
		padding: 3px 5px;
		cursor:pointer;
	}
	.ac_results li a{
		display:block;
		padding: 3px 5px;
	}
	.ac_results li:hover{
		background:#dedede;
	}
	.ac_results li.nope{
		cursor:auto;
	}
	.ac_results li.nope:hover{
		background:none;
	}
	.suggestionsBox{
		border:1px solid #cccccc;
		position:absolute;
		z-index:5;	
		width: 250px;
		padding:0px;
		background:#FFFFFF;
		margin-top:-5px;
		color:#333;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}
	.reg-info{
		font-size:11px;
		line-height:15px;
		margin-bottom:10px;
        color:#777777;
	}
	
	.error-message ul{
		text-align:left;
		padding:0px 15px 0px 15px;
	}
	.error-message{
		margin-bottom:5px;
	}
	a.link,a.link:visited  { text-decoration: underline;color:#333333}

	.bootstrap-datetimepicker-widget table td{
		font-size:12px;
		font-weight:normal;
	}
	.search-table{table-layout: fixed;}

.search-table-outter { overflow-x: scroll;margin-bottom: 20px;}
th, td {}
	.table {
  width:1200px;margin-bottom: 20px;
}
</style>
<br id="ganjel">
<br class="ganjel">
<div id="msg"></div> 
	<div class="search-table-outter wrapper">
	<table class="table table-bordered table-hover search-table inner">
		<thead>
			<tr>
				<th valign="top" style="text-align:center;width:30px">NO</th>
				<th valign="top" style="width:140px">AKSI</th>
                <th style="width:90px">IJAZAH</th>
				<th valign="top" style="width:75px">JENJANG</th>
				<th valign="top" style="width:200px">NAMA SEKOLAH</th>
				<th valign="top" style="width:100px">NPSN/KODE</th>
				<th valign="top" style="width:100px">NISN/NIM</th>
				<th valign="top" style="width:200px">JURUSAN</th>
				<th valign="top" style="width:100px">NO. IJASAH</th>
				<th valign="top" style="width:100px">THN. LULUS</th>
				<th valign="top" style="width:100px">UAN/IPK</th>
				<th valign="top" style="width:100px">STTB/IPK</th>				
				<th valign="top" style="width:200px">KETERANGAN</th>
				
			</tr>
		</thead>
		<tbody>
		<?php
		$num=0;
			if(!is_null($maba))
			{
				foreach ($maba as $data_maba) 
				{
					if(!is_null($data_maba->nisn))
					{
						echo "<tr>";
						echo "<td style='text-align:center'>"; echo $num+=1; echo "</td>";
						echo "<td align='center'><a onclick='hapus_pend()' href='#'><i class='icon-trash'></i> Hapus</a></td>";
						echo "<td style='text-align:center'>"; if(strlen($data_maba->ijazah)>20){ echo "<a href='".pg_unescape_bytea($data_maba->ijazah)."' download>Download</a>";} else{echo "Tidak ada";} echo "</td>";
						echo "<td style='text-align:center'>".$data_maba->nama_jenjang."</td>";
						echo "<td>".$data_maba->nama_sekolah."</td>";
						echo "<td style='text-align:center'>".$data_maba->npsn."</td>";
						echo "<td style='text-align:center'>".$data_maba->nisn."</td>";
						echo "<td style='text-align:center'>".$data_maba->nama_jurusan_sekolah."</td>";
						echo "<td style='text-align:center'>".$data_maba->nomor_ijazah."</td>";
						echo "<td style='text-align:center'>".$data_maba->tahun_lulus."</td>";
						echo "<td style='text-align:center'>".$data_maba->nilai_uan."</td>";
						echo "<td>".$data_maba->nilai_sttb."</td>";
						echo "<td>".$data_maba->keterangan."</td>";
						echo "</tr>";	
					}			
				}
			}

		?>
			
				</tbody>
	</table>
	</div>
	<a name="fokus"></a>
<table class="table-snippet">
	<tbody><tr>
			<td colspan='2'><strong>Data Riwayat Pendidikan Formal Sebelumnya</strong><br /></td>
		</tr>
	<tr id="JENJANG" style="display:none;">
		<td class="reg-label">Jenjang Pendidikan</td>
		<td class="reg-input">
		<select style="width:130px" name="KD_PEND" id="id_kd_pend" class="form-control input-sm">
			<option value="">Pilih Jenjang</option>
			<?php 
			if(!is_null($data_pendidikan))
			{
				foreach ($data_pendidikan as $pendidikan) {
					echo "<option value='".$pendidikan->id_jenjang."'>".$pendidikan->nama_jenjang."</option>";
					# code...
				}
			}
			?>
					
					</select>&nbsp;
		<span id="jenjang_detail">
					</span>
		*)
		</td>
	</tr>
	<!-- <tr>
		<td class="reg-label">Nama Sekolah / PT</td>
		<td class="reg-input">
			<input style='width:300px' type='text' class='inputx' id="NM_SEKOLAH" 
			name='NM_SEKOLAH' value=""/> 

			*)
		</td>
	</tr> -->
	<tr id="NM_SEKOLAH" style="display:none;">
		<td class="reg-label">Nama Sekolah</td>
		<td class="reg-input">
		<input type='text' class="form-control input-md" name='nama_sek2' autocomplete="off" id="nama_sek" style="width:300px" onkeyup="sekolah_cari(this.value,'suggestions2','kode_sekolah','nama_sek');return false;" onblur="hilangkan_ajax('suggestions2')"/>
			<!--<select name="NM_SEKOLAH" id="sekolah" class="form-control input-sm">
				<option value="">--</option>
				<?php
				foreach ($sekolah as $data_sekolah) {
					echo "<option value='".$data_sekolah->kode_sekolah."'>".$data_sekolah->nama_sekolah."</option>";
				}
				?>
			</select>-->
		<br><input type="text" name="nama_sek" id='nmx_sekolah' class="form-control input-md" style="display:none; width:300px" >*)
		<input type="hidden" readonly="" name="NM_SEKOLAH" id='kode_sekolah' class="form-control input-md">
			<span id="suggestions2Loading"></span>
			<div class="suggestionsBox" id="suggestions2" style="display: none"> 
			<div class="ac_results" style="background-color:#ddd;" align="center"> KLIK SALAH SATU </div>
				<div class="ac_results" id="suggestions2List"> &nbsp; </div>
			</div>
			
            <div class="reg-info">Silakan pilih Nama Sekolah/klik Nama Sekolah yang sesuai dengan Nama Sekolah asal anda (dari daftar yang muncul). Bagi yang tidak menemukan Nama Sekolah/PT asal, silakan ketik lalu pilih/klik <b>LAINNYA</b> yang muncul di bawah kolom isian Nama Sekolah/PT. </div>
		</td>
	</tr>
	<tr id="NPSN" style="display:none;">
		<td class="reg-label">NPSN/KODE PT</td>
		<td class="reg-input">
			<input type="text" maxlength="12" style="width:100px" name="NPSN" id="NPSN" class="form-control input-sm"> *)
		</td>
	</tr>
	<tr id="NISN" style="display:none;">
		<td class="reg-label">NISN/NIM</td>
		<td class="reg-input">
			<input type="text" maxlength="12" style="width:100px" name="NISN" id="NISN" class="form-control input-sm"> *)
             <div class="reg-info">Bagi yang tidak memiliki/mengetahui NISN/NIM, silakan diketik 9876543210.</div>
		</td>
	</tr>
	<tr id="JURUSAN" style="display:none;">
		<td class="reg-label">Jurusan</td>
		<td class="reg-input">
		<select name="JURUSAN" class="form-control input-sm" style="width:200px">
				<option value="">Pilih Jurusan</option>
				<?php
				if(!is_null($jurusan_sekolah))
				{
					foreach ($jurusan_sekolah as $jurusan) {
						echo "<option value='".$jurusan->id_jurusan_sekolah."'>".$jurusan->nama_jurusan_sekolah."</option>";
					}
				}

				?>
			</select>
		</td>
	</tr>
	<tr id="NO_IJAZAH" style="display:none;">
		<td class="reg-label">Nomor Ijazah</td>
		<td class="reg-input">
			<input style="width:300px" maxlength="50" type="text" class="form-control input-sm" name="NO_IJASAH_SMA" value="" id="JURUSAN">
		</td>
	</tr>
	<tr id="THN_MASUK" style="display:none;">
		<td class="reg-label">Tahun Masuk</td>
		<td class="reg-input">
			<!-- <input name='THN_LULUS' value="" onkeypress="return isNumberKey(event)" style='width:50px' maxlength='4' type='text' class='inputx' id="THN_LULUS"/> *)
			-->

			<select name="THN_MASUK" style="width:160px" class="form-control input-sm">
				<option value="0">Pilih Tahun Masuk</option>
				<?php 
					$year1=getdate();
					$tahun1=$year1['year'];
					//$tahun-=1;
					$i1=7;
					while ($i1>0) {
					$result1=$tahun1--;
					echo "<option value='".$result1."'>".$result1."</option>";
					$i1--;
					}
				?>				
									
								</select> *)
		</td>
	</tr>
	<tr id="THN_LULUS" style="display:none;">
		<td class="reg-label">Tahun Lulus</td>
		<td class="reg-input">
			<!-- <input name='THN_LULUS' value="" onkeypress="return isNumberKey(event)" style='width:50px' maxlength='4' type='text' class='inputx' id="THN_LULUS"/> *)
			-->

			<select name="THN_LULUS" style="width:160px" class="form-control input-sm">
				<option value="0">Pilih Tahun Lulus</option>
				<?php 
					$year=getdate();
					$tahun=$year['year'];
					//$tahun-=1;
					$i=$tahun_ijazah;
					while ($i>0) {
					$result=$tahun--;
					echo "<option value='".$result."'>".$result."</option>";
					$i--;
					}
				?>				
									
								</select> *)
		</td>
	</tr>

	<tr id="NILAI_UAN" style="display:none;">
		<td class="reg-label">Nilai UAN (Rata-rata) / IPK</td>
		<td class="reg-input">
			<input style="width:40px" maxlength="5" type="text" class="form-control input-sm" name="NEM" value="" id="NEM"> *)
			<div class="reg-info">format penulisan angka pecahan dengan menggunakan titik (contoh: 22.52). Jika tidak memiliki/mengetahui nilai UAN/IPK silakan diisi dengan 00.00</div>
		</td>
	</tr>
	<tr id="NILAI_STTB" style="display:none;">
		<td class="reg-label">Nilai STTB (Rata-rata) / IPK</td>
		<td class="reg-input">
			<input name="STTB" value="" style="width:40px" maxlength="5" type="text" class="form-control input-sm" id="STTB"> *) 
			<div class="reg-info">format penulisan angka pecahan dengan menggunakan titik (contoh: 22.52). Jika tidak memiliki/mengetahui nilai STTB/IPK silakan diisi dengan 00.00</div>
		</td>
	</tr>
    <tr id="SCAN_IJAZAH" style="display:none;">
		<td>Scan Ijazah
            <div class="reg-info">
                Tipe file yang diizinkan adalah gif, jpg, jpeg, png atau pdf dan berukuran maksimum 1 MB
            </div>
        </td>
		<td class="reg-input">
			<input type="file" id="ijazahInp" name="DOC_IJAZAH">
			<input type="hidden" name="DOC_IJAZAH_NAME" id="ijazahOut">
					</td>
	</tr>
	<tr id="KETERANGAN" style="display:none;">
		<td class="reg-label">Keterangan</td>
		<td class="reg-input">
			<textarea style="width:400px;height:100px" id="KETERANGAN" name="KETERANGAN" class="form-control input-sm"></textarea>
		</td>
	</tr>
	<tr id="BTN_RIWAYAT" style="display:none;">
		<td></td>
		<td class="reg-input">
			<input type="button" onclick="simpan_pend()" id="btn-pend" class="btn-uin btn btn-inverse" value="simpan riwayat pendidikan">
		</td>
	</tr>
	</tbody>
</table>
<input type="hidden" name="ID_RIWAYAT_HIDDEN" value="">
<br class="ganjel"></form>
</div>
<script type="text/javascript">

function cek_kode(xxx)
{
	if(xxx=='30')
	{
		$('#suggestions2').fadeOut();
		$('#nama_sek2').attr('value',null);
		alert("Masukkan nama sekolah anda di kolom NAMA SEKOLAH");
		$('#nmx_sekolah').slideDown('slow');
		$('#nmx_sekolah').attr('value',null);
		$('#nmx_sekolah').focus();
	}
}


$(document).ready(function(){

	for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();   	
    	}
});


var data=$('#download-foto').attr('value');


function readURLPEND(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
         	$('#ijazahOut').attr('value', e.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#ijazahInp").change(function(){

	if((this.files[0].size/1024/1024) < 1 )
		{
    		readURLPEND(this);
		}
		else
		{

			alert('Ukuran file yang diijinkan maksimal <1 Mb. Ulangi Upload!');
			$("#ijazahInp").attr('value',null);
		
		}
   
});



var id=$('#nomor').attr('value');
	function simpan_pend()
	{
		$("#msg").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
		document.getElementById('msg').scrollIntoView();
		var cek_ada=<?php echo $num ?>;
		var sekolah=$('#nmx_sekolah').val();
		var ijazah=$('#ijazahOut').val();
		var kode_sekolah=$('#kode_sekolah').val();
		if(cek_ada < 1 && sekolah.length > 0 && kode_sekolah.length >0)
		{

			$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/insert_riwayat_pendidikan'); ?>",
						type	: "POST",            
						data: $("#data_riwayat_pendidikan_sebelumnya").serialize(),
						success: function(x)
						{
							
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/data_riwayat_pendidikan_sebelumnya/"+id+"/"+jalur+"'); ?>");
							$('#msg').html("<div id='msg' class='bs-callout bs-callout-success'>DATA RIWAYAT PENDIDIKAN BERHASIL DISIMPAN.</div>");
							$('#next').slideDown('slow');
						}

					});
		}
		else
		{
			$('#msg').html("<div id='msg' class='bs-callout bs-callout-error'>ISI DATA RIWAYAT PENDIDIKAN DENGAN BENAR.</div>");
			$('#next').hide();
			$('#next2').hide();
		}
					

	}
	function hapus_pend()
	{
		$("#msg").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
		document.getElementById('msg').scrollIntoView();
			$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/hapus_riwayat_pendidikan'); ?>",
						type	: "POST",            
						data    : "id="+id,
						success: function(z)
						{
							
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/data_riwayat_pendidikan_sebelumnya/"+id+"/"+jalur+"'); ?>");
					
						}

					});
	}

function sekolah_cari(inputString,param_lokasi,param_lokasi_balik,param_lokasi_tampil){
	if(inputString.length == 0) {
		$('#'+param_lokasi).fadeOut();
	} else {
		$('#'+param_lokasi+"Loading").html("&nbsp;<img src='http://akademik.uin-suka.ac.id/asset/img/loading.gif'/>");
		$.ajax({
		type: "POST",
		cache:false,
		url: "<?php echo base_url('pendaftaran/form_control/cari_sekolah') ?>",
		data: "cari="+inputString,
		}).done(function( data ) {
			if(data.length >0) {
				
				$('#'+param_lokasi).fadeIn();
				$('#'+param_lokasi+"List").html(data);
				$('#'+param_lokasi+"Loading").html(' ');


			}


			
		});
	}
	
}

function pilih_sek(pp)
{
	var kode=pp.id;
	var nama=$('#'+pp.id).attr('nama');
	$('#nama_sek').attr('value',nama);
	$('#kode_sekolah').attr('value',kode);
	$('#nmx_sekolah').attr('value',nama);
	cek_kode(kode);
	$('#suggestions2').fadeOut();
}
</script>