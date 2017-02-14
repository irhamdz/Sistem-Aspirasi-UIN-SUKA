<script type="text/javascript">
	$(document).ready(function(){

for(var i=0; i<data_item.length; i++)
    	{
    		
    		$('#'+data_item[i]).show();
    	}
});
</script>
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
</style>
<br id="ganjel">
<br id="ganjel">
<div id="msg"></div> 
<div id="data-pesantren">
	<?php $this->load->view('v_table/table_pesantren'); ?>
</div>
<div class="bs-callout bs-callout-info">
	Apabila data pesantren tidak ada, maka tekan tombol Selanjutnya.
</div>
<form id="form-pesantren" method="POST">
<table class="table-snippet">
	<tbody>
	<input type="hidden" id="nomor_pendaftar" name="nomor_pendaftar" value="<?php echo $nomor_pendaftar ?>">
	<tr id="NAMA_PESANTREN" style="display:none;">
		<td class="reg-label">Nama Pesantren</td>
		<td class="reg-input">
			<input type='text' class="form-control input-md" name='NM_PESANTREN' autocomplete="off" class='inputx' id="nm_pesantren" value='' style="width:300px" onkeyup="pesantren_cari(this.value,'suggestions2','KD_NSPP','nm_pesantren');return false;" onblur="hilangkan_ajax('suggestions2')"/>
			<span id='suggestions2Loading'></span>
			<div class="suggestionsBox" id="suggestions2" style="display: none"> 
				<div class="ac_results" id="suggestions2List"> &nbsp; </div>
			</div>
			*)
            <div class='reg-info'>Silakan ketik Nama Pesantren lalu pilih/klik Nama Pesantren yang sesuai dengan Nama Pesantren anda (dari daftar yang muncul). Bagi yang tidak menemukan Nama Pesantren, silakan ketik lain lain lalu pilih/klik LAIN LAIN yang muncul di bawah kolom isian Nama Pesantren. </div>
		</td>
	</tr>
	<tr id="NSPP" style="display:none;">
		<td class="reg-label">NSPP</td>
		<td class="reg-input">
			<input type='text' class="form-control input-md" maxlength='12' style='width:100px' name='KD_NSPP' id='KD_NSPP' value=''/> *)
		</td>
	</tr>
	<tr id="NOMOR_SANTRI" style="display:none;">
		<td class="reg-label">Nomor Santri</td>
		<td class="reg-input">
			<input type='text' class="form-control input-md" maxlength='12' style='width:100px' name='NO_SANTRI' id='NO_SANTRI' value=''/>
             <div class='reg-info'>Bagi yang tidak memiliki Nomor Santri, silakan diketik 9876543210.</div>
		</td>
	</tr>
	<tr id="JURUSAN" style="display:none;">
		<td class="reg-label">Jurusan</td>
		<td class="reg-input">
			<input style='width:300px' class="form-control input-md" type='text' class='inputx' name='JURUSAN' value="" id="JURUSAN1"/>
		</td>
	</tr>
	<tr id="NOMOR_SERTIFIKAT" style="display:none;">
		<td class="reg-label">Nomor Sertifikat</td>
		<td class="reg-input">
			<input style='width:300px' class="form-control input-md" id="no_ijazah" maxlength='50' type='text' class='inputx' name='NO_IJASAH' value=""/>
		</td>
	</tr>
	<tr id="TAHUN_MASUK" style="display:none;">
		<td class="reg-label">Tahun Masuk</td>
		<td class="reg-input">
			<!-- <input name='THN_LULUS' value="" onkeypress="return isNumberKey(event)" style='width:50px' maxlength='4' type='text' class='inputx' id="THN_LULUS"/> *)
			-->
			<select name='THN_MASUK' class="form-control input-md" id="thn_masuk" style='width:160px'>
				<option value='0'>-Pilih Tahun Masuk-</option>
					<?php 
					$year=getdate();
					$tahun=$year['year'];
					$i=30;
					while ($i>0) {
					$result=$tahun--;
					echo "<option value='".$result."'>".$result."</option>";
					$i--;
					}
				?>		
								</select> *)
		</td>
	</tr>
	<tr id="TAHUN_LULUS" style="display:none;">
		<td class="reg-label">Tahun Lulus</td>
		<td class="reg-input">
			<!-- <input name='THN_LULUS' value="" onkeypress="return isNumberKey(event)" style='width:50px' maxlength='4' type='text' class='inputx' id="THN_LULUS"/> *)
			-->
			<select name='THN_LULUS' class="form-control input-md" id="thn_lulus" style='width:160px'>
				<option value='0'>-Pilih Tahun Lulus-</option>
				<?php 
					$year2=getdate();
					$tahun2=$year2['year'];
					$i2=30;
					while ($i2>0) {
					$result2=$tahun2--;
					echo "<option value='".$result2."'>".$result2."</option>";
					$i2--;
					}
				?>				
								</select> *)
		</td>
	</tr>
	<tr id="NILAI_SERTIFIKAT" style="display:none;">
		<td class="reg-label">Nilai Sertifikat (Rata-rata)</td>
		<td class="reg-input">
			<input style='width:40px' class="form-control input-md" maxlength='5' type='text' class='inputx' name='NILAI' value="" id="NILAI"/>
			<div class='reg-info'>format penulisan angka pecahan dengan menggunakan titik (contoh: 22.52). Jika tidak memiliki/mengetahui nilai Sertifikat silakan diisi dengan 00.00</div>
		</td>
	</tr>
    <tr id="IJAZAH" style="display:none;">
		<td>Scan Sertifikat
            <div class='reg-info'>
                Tipe file yang diizinkan adalah gif, jpg, jpeg, png atau pdf dan berukuran maksimum 1 MB
            </div>
        </td>
		<td class="reg-input">
			<input type='file' id="ijzInp" name='DOC_IJAZAH'/>
			<input type='hidden' id="ijzOut" name='DOC_IJAZAH_NAME' value=''/>
					</td>
	</tr>
	<tr id="KETERANGAN" style="display:none;">
		<td class="reg-label">Keterangan</td>
		<td class="reg-input">
			<textarea style='width:400px;height:100px' class="form-control input-md" id='KETERANGAN' name='KETERANGAN' class='inputx'></textarea>
		</td>
	</tr>
	<tr id="BTN_SIMPAN_PESANTREN" style="display:none;">
		<td></td>
		<td class="reg-input">
			<input type='button' onclick="simpan_pesantren()" class='btn-uin btn btn-inverse' value='simpan riwayat pesantren'/>
				</td>
	</tr>
	</tbody>
</table>
</form>
<script type="text/javascript">

function hilangkan_ajax(param){
	setTimeout("$('#"+param+"').fadeOut();", 600);
}

function validasi_pes()
{
	var nama=$('#nm_pesantren').val();
	var nspp=$('#KD_NSPP').val();
	var no_santri=$('#NO_SANTRI').val();
	var jurusan=$('#JURUSAN1').val();
	var no_ijazah=$('#no_ijazah').val();
	var thn_masuk=$('#thn_masuk').val();
	var thn_lulus=$('#thn_lulus').val();
	var nilai=$('#NILAI').val();
	var ijz=$('#ijzOut').val();

	var eror="0";

	if(nama.length==0)
	{
		eror="* Nama Pesantren Tidak Boleh Kosong";
		
	};

	if(nspp.length==0)
	{
		eror="\n* NSPP Tidak Boleh Kosong";
		
	};
	if(no_santri.length==0)
	{
		eror="\n* Nomor Santri Tidak Boleh Kosong";
	};
	/*
	if(jurusan.length==0)
	{
		eror="\n* Masukan Jurusan Anda";
	};
	if(no_ijazah.length==0)
	{
		eror="\n* Nomor Ijazah Tidak Boleh Kosong";
	};
	*/
	if(thn_masuk.length==0)
	{
		eror="\n* Tahun Masuk Tidak Boleh Kosong";
	};
	if(thn_lulus.length==0)
	{
		eror="\n* Tahun Lulus Tidak Boleh Kosong";
	};
	if(nilai.length==0)
	{
		eror="\n* Nilai Tidak Boleh Kosong";
	};
	/*
	if(ijz.length==0)
	{
		eror="\n* Upload Ijazah/Sertifikat Anda";
	};
	*/

	return eror;
}

function simpan_pesantren()
{
	
	if(validasi_pes()=='0')	
	{
		$.ajax({
			url : "<?php echo base_url('adminpmb/daftar_mhs_c/data_pesantren2') ?>",
			type: "POST",
			data: $('#form-pesantren').serialize(),
			success: function(mes)
			{
				$('#data-pesantren').html(mes);
			}
		});
	}
	else
	{
		alert(validasi_pes());
	}

}

function readURLSER(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (ijz) {
         	$('#ijzOut').attr('value', ijz.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#ijzInp").change(function(){

		
		if((this.files[0].size/1024) <= 200 && (this.files[0].size/1024) >= 50 )
		{
			readURLSER(this);
		}
		else
		{
			alert('Ukuran foto yang diijinkan 50kb - 200kb. Ulangi Upload!');
			$("#ijzInp").attr('value',null);
		}
		
    
   
});

//http://service.uin-suka.ac.id/servsiasuper/index.php/sia_public/sia_master/data_search

	function pesantren_cari(inputString,param_lokasi,param_lokasi_balik,param_lokasi_tampil){
	if(inputString.length == 0) {
		$('#'+param_lokasi).fadeOut();
	} else {
		$('#'+param_lokasi+"Loading").html("&nbsp;<img src='http://akademik.uin-suka.ac.id/asset/img/loading.gif'/>");
		$.ajax({
		type: "POST",
		cache:false,
		url: "<?php echo base_url('adminpmb/form_control/cari_pesantren') ?>",
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

function pilih_pes(pp)
{
	var nspp=pp.id;
	var nama=$('#'+pp.id).attr('nama');
	$('#nm_pesantren').attr('value',nama);
	$('#KD_NSPP').attr('value',nspp);
}

function hapus_pes(idr)
{
	var no=$('#nomor_pendaftar').val();
	$.ajax({
		url: "<?php echo base_url('adminpmb/form_control/hapus_riwayat') ?>",
		type: "POST",
		data: "id_riwayat="+idr+"&nomor_pendaftar="+no,
		success: function(s)
		{
			$('#data-pesantren').html(s);
		}
	});
}
</script>