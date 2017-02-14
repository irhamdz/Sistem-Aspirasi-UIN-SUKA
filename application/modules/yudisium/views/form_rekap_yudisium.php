<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  
<link rel="stylesheet" href="http://uin-suka.ac.id//asset/colorbox/colorbox.css" />
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    --><script src="http://uin-suka.ac.id//asset/colorbox/jquery.colorbox.js"></script>
	
<div>

<h3 style="margin-bottom:10px;">FORM YUDISIUM</h3>

<form id="nilai-form" method="POST" enctype="multipart/form-data">

	<table class="table table-hover">
	
		<tr id="ktg_jalur">
			<td>
				<h>Jalur PMB</h>
			</td>
			<td>
				<select name='kode_jalur' class="form-control input-md" id="pena" style="width:300px;" onchange="cari_gelombang(this.value)">
				<option value="">Pilih Jalur PMB</option>
				<?php
				foreach ($jalur_masuk as $valjalur) {
					echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
				}

				?>
				</select>
			</td>
			<input type="hidden" id="ptr" name="pilihan">
		</tr>
		<tr>
			<td>
				Gelombang
			</td>
			<td>
				<select class="form-control input-md" id='gelombang' name="gelombang" style="width:300px;">
					<option value=""> -- </option>
				</select>
			</td>
		</tr>
		<td>
			Tahun
		</td>
			<td>
				<select name='tahun' style="width:300px;" id="tahun" class="form-control input-sm" onchange="cari_kelas(this.value)">
				<option value=''> Pilih Tahun </option>
				<?php 
					$year=getdate();
					$tahun=$year['year'];
					$i=10;
					while ($i>0) {
					$result=$tahun--;
					echo "<option value='".$result."'>".$result."</option>";
					$i--;
					}
				?>						
								</select>
			</td>
		</tr>
		<tr>
			<td>
				Kelas
			</td>
			<td>
				<select id="kelas" name="kelas" class="form-control input-sm" style="width:300px;" onchange='cari_prodi(this.value)'> 
				<option value=""> -- </option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Program Studi
			</td>
			<td>
				<select id="prodi" name="prodi" class="form-control input-sm" style="width:300px;" onchange='id_prodi=this.value'> 
				<option value=""> -- </option>

				</select>
			</td>
		</tr>
		<tr id="ktg_jalur">
			<td>
				SK
			</td>
			<td>
			<select name="jenis" class="form-control input-md" style="width:300px;" id="jenis">
			<option value="">--</option>
				<?php
				if(!is_null($jenis_dokumen))
				{
					foreach ($jenis_dokumen as $doc) {
						echo "<option value='".$doc->id_dokumen."'>".$doc->nama_dokumen."</option>";
					}
				}
				?>
			</select>
			</td>
		</tr>	
		<tr>
		<td></td>
			<td>
				<button class="btn btn-inverse btn-uin btn-small" type="button" onclick="ambil_rekap_yudis()"> CARI</button>
			</td>
		</tr>
		</form>
		</table>
	
</div>

<table>
	<tr>
		<td>
			<button id="c_excel" class="btn btn-inverse btn-uin btn-small" onclick="cetak_excel()" disabled type="button">Cetak File Excel</button>
		</td>
		<td>
			<a href="javascript:;" id="print" onclick="cetak()"><button id="c_pdf" class="btn btn-inverse btn-uin btn-small" disabled type="button">Cetak File PDF</button></a>
		</td>
	</tr>
</table>
<br>
<style type="text/css">
	
</style>
<div id="data-yudi"></div>

<script type="text/javascript">

$(function(){
$(".rekap_yudis").colorbox({iframe:true, innerWidth:800, innerHeight:550, title: function(){
    var url2 = $(this).attr('href'); 
     var link2='<a href="' + url2 + '" download="Data_camaba.pdf" ><b>Download</b></a>';
    
    return link2;
}});  
})


function ambil_rekap_yudis()
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
	var kelas=$('#kelas').val();
	var prodi=$('#prodi').val();
	var id_doc=$('#jenis').val();
	var urlx= "<?php echo base_url('yudisium/cetak_pengumuman/cari_data_yudisium_html/"+kode_jalur+"/"+gelombang+"/"+kode_penawaran+"/"+tahun+"/"+kelas+"/"+id_prodi+"/"+id_doc+"'); ?>";	
	var urls= "<?php echo base_url('yudisium/cetak_pengumuman/cari_data_yudisium/"+kode_jalur+"/"+gelombang+"/"+kode_penawaran+"/"+tahun+"/"+kelas+"/"+id_prodi+"/"+id_doc+"'); ?>";	

	$("#rekap").attr('href',urls);
	$('#c_pdf').attr('disabled',false);
	$('#c_excel').attr('disabled',false);
$.ajax({
	url: urlx,
	type: "POST",
	success: function(xxx)
	{
		$('#data-yudi').html(xxx);
	}
});

}

function cetak_excel()
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
	var kelas=$('#kelas').val();
	var prodi=$('#prodi').val();
	var id_doc=$('#jenis').val();
	var urlx= "<?php echo base_url('yudisium/cetak_pengumuman/cari_data_yudisium_excel/"+kode_jalur+"/"+gelombang+"/"+kode_penawaran+"/"+tahun+"/"+kelas+"/"+id_prodi+"/"+id_doc+"'); ?>";	
	window.open(urlx,'_blank');
}


function cari_nomor(cn)
{
	$.ajax({
		url: "<?php echo base_url('yudisium/yudisium_c/cari_nomor') ?>",
		type: "POST",
		data: "id_dokumen="+cn,
		success: function(fn)
		{
			$('#nomor').html(fn);
		}
	});
}

function cari_gelombang(jal)
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_gelombang') ?>",
		type: "POST",
		data: "kode_jalur="+jal,
		success: function (seljal)
		{
			$('#gelombang').html(seljal);
		}
	});

	$('#tahun').get(0).selectedIndex = 0;
}


function cari_kelas(th)
{	
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;

	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_kelas') ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran,
		success: function(h)
		{
			$('#kelas').html(h);

		}
	});

	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/jumlah_penawaran_prodi') ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran+"&tahun="+th,
		success: function(jml)
		{
			$('#jml_tawar').attr('value',jml);

		}
	});

}


function cari_prodi(pr)
{
	var kode_jalur=$('#pena').val();
	var gelombang=$('#gelombang').val();
	var tahun=$('#tahun').val();
	var kode_penawaran=kode_jalur+gelombang+tahun;
	
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/prodi_kelas') ?>",
		type: "POST",
		data: "kode_penawaran="+kode_penawaran+"&kelas="+pr+"&tahun="+tahun,
		success: function(hx)
		{
		$('#prodi').html(hx);

		}
	});
}

function nWin() {
  var w = window.open();
  var html = $("#data-yudi").html();

    $(w.document.body).html(html);
}
function cetak(){
    $("#print").click(nWin);
}
</script>
