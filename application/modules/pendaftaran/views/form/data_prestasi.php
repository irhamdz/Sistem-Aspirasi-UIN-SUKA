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
<br>
<div id="msg"></div> 
<div class="search-table-outter wrapper">
	<table class="table table-bordered table-hover search-table inner">
		<thead>
			<tr>
				<th valign="top" style="text-align:center;width:30px">NO</th>
				<th valign="top" style="width:140px">NAMA PERLOMBAAN</th>
                <th style="width:90px">JUARA</th>
				<th valign="top" style="width:200px">JENIS KOMPETISI</th>
				<th valign="top" style="width:200px">TINGKAT</th>
				<th valign="top" style="width:100px">JENIS KEJUARAAN</th>
				<th valign="top" style="width:100px">TAHUN</th>
				<th valign="top" style="width:200px">PENYELENGGARA</th>
				<th valign="top" style="width:100px">WAKTU</th>
				<th valign="top" style="width:100px">NO SERTIFIKAT</th>
				<th valign="top" style="width:100px">SERTIFIKAT</th>
				<th valign="top" style="width:100px">KETERANGAN</th>				
				<th valign="top" style="width:200px">PROSES</th>
				
			</tr>
		</thead>
		<tbody>
		<?php
		$num=0;
		if(!is_null($maba))
		{
			foreach ($maba as $data_maba) {
				if(!is_null($data_maba->nama_perlombaan)){
				echo "<tr>";
				echo "<td>";
				echo $num+=1;
				echo "</td>";
				echo "<td>";
				echo $data_maba->nama_perlombaan;
				echo "</td>";
				echo "<td>";
				echo $data_maba->juara_ke;
				echo "</td>";
				echo "<td>";
				echo $data_maba->nama_kompetisi;
				echo "</td>";
				echo "<td>";
				echo $data_maba->nama_tingkat;
				echo "</td>";
				echo "<td>";
				echo $data_maba->nama_jenis;
				echo "</td>";
				echo "<td>";
				echo $data_maba->tahun_penghargaan;
				echo "</td>";
				echo "<td>";
				echo $data_maba->nama_penyelenggara;
				echo "</td>";
				echo "<td>";
				echo $data_maba->tanggal_mulai.' s.d '.$data_maba->tanggal_selesai;
				echo "</td>";
				echo "<td>";
				echo $data_maba->nomor_sertifikat;
				echo "</td>";
				echo "<td>";
				$pdf=pg_unescape_bytea($data_maba->sertifikat);
				if(strlen($data_maba->sertifikat)> 10){echo "<a download href='".$pdf."'>Download</a>";}else{echo "Tidak ada sertifikat.";}
				echo "</td>";
				echo "<td>";
				echo $data_maba->keterangan;
				echo "</td>";
				echo "<td align='center'><a onclick='hapus_pres(".$data_maba->id_prestasi.")' href='#' class='btn'><i class='icon-trash'></i> Hapus</a></td>";
				echo "</tr>";
			}
		}

		}
		?>

		</tbody>
		</table>
		</div>
		<a name="fokus"></a>
<div class="bs-callout bs-callout-info">
	Jika tidak ada prestasi silakan tulis <B>Tidak Ada</B> pada kolom Nama Prestasi.
</div>
<form action="" method="post" enctype="multipart/form-data" id="data_prestasi" name="form_sakti">
<input type="hidden" name="nomor_pendaftar" value="<?php echo $nomor_pendaftar; ?>" id="nomor">
<table class="table-snippet">
	<tbody>
	<tr>
			<td colspan='2'><strong>Data Prestasi</strong><br /></td>
		</tr>
	<tr id="NM_PRES" style="display:none;">
		<td class="reg-label" style="width:275px">Nama Prestasi</td>
		<td class="reg-input">
			<input type="text" class="form-control input-sm" maxlength="256" maxsize="256" id="nama_lomba" name="NM_LOMBA" style="width:350px"> *)
			<div class="reg-info">
                Nama Perlombaan dalam bahasa Indonesia
            </div>
		</td>
	</tr>
	<tr id="JUARA" style="display:none;">
		<td class="reg-label">Juara Ke</td>
		<td class="reg-input">
			<!-- <input style='width:50px' type='text' class='inputx' id="JUARA_KE" onkeypress="return isNumberKey(event)" name='JUARA_KE' value=''/> -->
			<select name="JUARA_KE" class="form-control input-sm">
				<option  value="">-Pilih Juara-</option>
				<option  value="1">1</option>
				<option  value="2">2</option>
				<option value="3">3</option>
				<option value="4">4 (HARAPAN 1)</option>
				<option value="5">5 (HARAPAN 2)</option>
				<option   value="6">6 (HARAPAN 3)</option>
				<option  value="7">LAINNYA</option>
			</select> *)
		</td>
	</tr>
	<tr id="JENIS_KOM" style="display:none;">
		<td class="reg-label">Jenis Kompetisi</td>
		<td class="reg-input">
			<select name="TIPE_KOMPETISI" class="form-control input-sm">
				<option  value="0">-Pilih Jenis Kompetisi-</option>
				<option  value="P">PERORANGAN</option>
				<option value="R">BEREGU/GROUP/KELOMPOK</option>
				<option  value="L">LAINNYA</option>
			</select> *)
		</td>
	</tr>	
	<tr id="TINGKAT" style="display:none;">
		<td class="reg-label">Tingkat Kejuaraan</td>
		<td class="reg-input">
			<select name="KD_PERINGKAT" class="form-control input-sm">
				<option value="0">-Pilih Tingkat Kejuaraan-</option>
							<option  value="01">INTERNASIONAL</option>
								<option  value="02">NASIONAL</option>
								<option  value="03">PROVINSI</option>
								<option  value="04">KABUPATEN</option>
								<option  value="05">KECAMATAN</option>
								<option  value="06">DESA/KELURAHAN</option>
								<option  value="07">LAINNYA</option>
							</select> *)
		</td>
	</tr>
	<tr id="JENIS_KEJ" style="display:none;">
		<td class="reg-label">Jenis Kejuaraan</td>
		<td class="reg-input">
			<select name="KD_JENIS" style="width:400px" class="form-control input-sm" onchange="tahfidz_pilih(this.value,'1024')">
				<option value="0">-Pilih Jenis Kejuaraan-</option>
							<?php
							if(!is_null($jenis_kejuaraan))
							{
								foreach ($jenis_kejuaraan as $jenis) {
									echo "<option value='".$jenis->id_jenis."'>".$jenis->nama_jenis."</>";
								}
							}

							?>
							</select> *)
			<br>
			<span id="abnormal_ket" style="display:none">Jumlah Juz <input value="" type="text" name="KETERANGAN_1"></span>
		</td>
	</tr>
	<tr id="TAHUN" style="display:none;">
		<td class="reg-label">Tahun Penghargaan</td>
		<td class="reg-input">
			<select name='THN_BERI' id="th" style='width:100px' class="form-control input-sm">
				<option value=''>-</option>
				<?php 
					$year=getdate();
					$tahun=$year['year'];
					$i=100;
					while ($i>0) {
					$result=$tahun--;
					echo "<option value='".$result."'>".$result."</option>";
					$i--;
					}
				?>						
								</select>
		</td>
	</tr>	
    <tr id="PENYELENGGARA" style="display:none;">
		<td class="reg-label">Nama Penyelenggara Perlombaan</td>
		<td class="reg-input">
			<input type="text" class="form-control input-sm" maxlength="128" maxsize="128" name="NM_PENY_LOMBA" style="width:250px"> *)
			<div class="reg-info">
                Nama Penyelenggara Perlombaan dalam bahasa Indonesia
            </div>
		</td>
	</tr>
    <tr id="WAKTU" style="display:none;">
       <td class="reg-label">Waktu Kegiatan</td>
		<td class="reg-input">
			Tanggal Mulai<div class="input-group date" id="tgl_mulai_pres1" data-date="" data-date-format="dd-mm-yyyy" >
					<input class="form-control" size="16" type="text" name="tgl_mulai" class="form-control input-sm" >
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div>
		  
          	Tanggal Selesai<div class="input-group date" id="tgl_selesai_pres2" data-date="" data-date-format="dd-mm-yyyy" >
					<input class="form-control" size="16" type="text"  name="tgl_selesai" class="form-control input-sm" >
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div>
          
		  <script type="text/javascript">
		  $(function() 
	{
    var tgl_pres1 = $("#tgl_mulai_pres1").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl_pres1.hide();
	}).data('datepicker');

	$(function() 
	{
    var tgl_pres2 = $("#tgl_selesai_pres2").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl_pres2.hide();
	}).data('datepicker');

	});

	});
		</script>
		</td>
		</td>
    </tr>
    <tr id="NO_SERT" style="display:none;">
		<td class="reg-label">Nomor Sertifikat Bukti Prestasi Perlombaan</td>
		<td class="reg-input">
			<input type="text" class="form-control input-sm" maxlength="128" maxsize="128" name="NO_SERTIF_LOMBA" style="width:250px"> 
		</td>
	</tr>
    <tr id="SERTIFIKAT" style="display:none;">
        <td class="reg-label">
            Upload Sertifikat Bukti Prestasi Perlombaan<br>
            <div class="reg-info">
                Tipe file yang diizinkan adalah gif, jpg, jpeg, png dan pdf berukuran maksimum 400 KB
            </div>
        </td>
		<td class="reg-input">
			<input type="file" id="serInp" name="DOC_SERTIF_LOMBA">
            <input type="hidden" id="serOut" name="DOC_SERTIF_LOMBA_NAME" value="">
					</td>
    </tr>
	<tr id="KETERANGAN" style="display:none;">
		<td class="reg-label">
			<span id="norm_ket_label">
			Keterangan
			</span>
		</td>
		<td class="reg-input">
			<span id="norm_ket_isi">
			<textarea id="KETERANGAN" style="width:300px;height:100px"  name="KETERANGAN_2" class="form-control input-sm"></textarea>
			</span>
		</td>
	</tr>
	<tr id="BTN_PRES" style="display:none;">
		<td></td>
		<td class="reg-input">
			<input type="button" onclick="simpan_prestasi()" id="tbl-pres" class="btn-uin btn btn-inverse" value="simpan prestasi">
		</td>
	</tr>
	</tbody>
</table>
<br class="ganjel"></form>
<script type="text/javascript">
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}

var id=$('#nomor').attr('value');
function hapus_pres(id_hapus)
{
			$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/hapus_prestasi'); ?>",
						type	: "POST",            
						data: "id="+id_hapus,
						success: function(i)
						{
							
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/data_prestasi/"+id+"'); ?>");
							
						}

					});
}

function simpan_prestasi()
{
		
		$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/insert_prestasi'); ?>",
						type	: "POST",            
						data: $("#data_prestasi").serialize(),
						success: function(j)
						{
							
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/data_prestasi/"+id+"'); ?>");
							$('#nama_lomba').attr('value','');

						}

					});
	
}


	function readURLpres(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (ser) {
         	$('#serOut').attr('value', ser.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#serInp").change(function(){
/*

if(this.files[0].type == 'image/jpg' || 'image/png' || 'image/jpeg'|| 'image/bmp' || 'image/gif')
{
	*/
	if(this.files[0].size / 1024 < 500)
	{
		

		readURLpres(this);
	}
	else
	{
		alert("File terlalu besar!");
		$('#serInp').value='';
	}
/*}
else
{
	alert("Tipe file salah!");
   
 }  
 
  */ 
});

</script>