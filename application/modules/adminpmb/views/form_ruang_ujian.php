<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <script src="<?php echo base_url('asset/js/jquery.table2excel.js');?>"></script>
    <script type="text/javascript">
        $(document).ready(function () { 
            $('#jm,#js').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });


    
        });

    </script>
	<style>
	div.cx td, div.cx table{
		border: 1px solid black;
		text-align: center;
	}
	.day{
		font-size:14px;
	}
	</style>
   <link href="http://static.uin-suka.ac.id/plugins/datepicker/css/datepicker.css" rel="stylesheet">

    <script src="http://static.uin-suka.ac.id/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<div>
<h3 style="margin-bottom:10px;">Form Ruang Ujian</h3>
<?php
	if(!is_null($gelombang))
	{
			foreach ($gelombang as $gel);
			$dagel=$gel->gelombang;
	}

?>
	<table class="table table-hover">
	
		<form method="POST" id="form-ruang-ujian">
		<tr>
			<td>
				<h>ID URUT GEDUNG</h>
			</td>
			<td>
			<select name="id_gedung" id="gedung" onchange="changeGedung(this)" class="form-control input-md">
			<option value="">Pilih Gedung</option>
				<?php 
				foreach ($data_gedung as $valgdg) {
				echo "<option value='".$valgdg->id_gedung."'>".$valgdg->nama_gedung."</option>";
				}

				?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>
				<h>ID RUANG</h>
			</td>
			<td>
			<div>
				<select name="id_ruang" class="form-control input-md" id="ruang" required>
					<option value="">Pilih Ruang</option>
				</select>
			</div>	
			
				
			</td>
		</tr>

		<tr>
			<td>
				<h>KAPASITAS RUANG</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'kapasitas_ruang','class'=>'form-control input-md' , 'id'=>'jml')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<h>KODE JALUR</h>
			</td>
			<td>
			<select name="kode_jalur" class="form-control input-md" onchange="ambil_jadwalnya(this.value);  cek_nomor(this.value);">
				<option value="">Pilih Jalur</option>
				<?php
					foreach ($jalur_masuk as $valjalur) {
						echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
					}
				?>
			</select>
				
			</td>
		</tr>
		<tr>
			<td>
				<h>NO UJIAN AWAL</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'no_ujian_awal','class'=>'form-control input-md', 'id'=>'noawal')); ?>
			</td>
		</tr>
		<tr>
			<td>
				<h>NO UJAIN AKHIR</h>
			</td>
			<td>
				<input type="text" name="no_ujian_akhir" id="noakhir"  class="form-control input-md" onchange="validate_jml(this)">
			</td>
		</tr>
		<tr>
			<td>
				<h>STATUS RUANG UJIAN</h>
			</td>
			
				<td>
			<div class="radio">
  				<label>
    				<input type="radio" name="status_ruang_ujian" id="optionsRadios1" value="1">
    				Aktif
  				</label>
			</div>
			<div class="radio">
  				<label>
    				<input type="radio" name="status_ruang_ujian" id="optionsRadios2" value="0" checked>
    				Tidak aktif
  				</label>
			</div>
			</td>
		</tr>
		<tr>
			<td>JENIS RUANG</td>
			<td>
				<select name="khusus" class="form-control input-md">
					<option value="0">Umum</option>
					<option value="1">Khusus</option>
				</select>
			</td>
		</tr>
		<tr>
		<td>
			TAHUN RUANG UJIAN
		</td>
			<td>
				<select name='tahun_ruang_ujian' id="tahun" class="form-control input-md">
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
				<h>GELOMBANG</h>
			</td>
			<td>
			<div>
				<input type="text" name="gelombang" class="form-control input-md">
			</div>	
			</td>
		</tr>
		<tr>
			<td>
				<h>JADWAL</h>
			</td>
			<td>
			<select name="kode_jadwal" id="jadwal_jalur" class="form-control input-md">
				<option value="">Pilih Jadwal</option>
				
			</select>
			</td>

		</tr>
		<tr>
			<td colspan='2'>
				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_ruang()" >Simpan</button>
			</td>
		</tr>
		<?php echo form_close(); ?>
		</table>
		
	<!--<label>Download Form Excel
		<input type="checkbox" id="cekupload" onclick="open_upload()">
		</label>-->
	
<div id='upload_div' style="display:none;">
		<form method="POST" enctype="multipart/form-data" id="upload-xl">
		<table>
		<tr>
			<td>
				<h>PILIH GEDUNG</h>
			</td>
			<td>
			<select name="id_gedung_UP" id="gedung_UP" class="form-control input-md" onchange="tampil_ruang(this.value)">
			<option value=""> Pilih Gedung </option>
				<?php 
				foreach ($data_gedung as $valgdg) {
				echo "<option value='".$valgdg->id_gedung."'>".$valgdg->nama_gedung."</option>";
				}

				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<h>KODE JALUR</h>
			</td>
			<td>
			<select name="kode_jalur" id="kode_jalur_xl" class="form-control input-md" onchange="ambil_jadwalnya_xl(this.value)">
				<option value="">Pilih Jalur</option>
				<?php
					foreach ($jalur_masuk as $valjalur) {
						echo "<option value='".$valjalur->kode_jalur."'>".$valjalur->jalur_masuk."</option>";
					}
				?>
			</select>
				
			</td>
		</tr>
		<tr>
			<td>
				<h>JADWAL</h>
			</td>
			<td>
			<select name="kode_jadwal" id="jadwal_jalur_xl" class="form-control input-md">
				<option value="">Pilih Jadwal</option>
				
			</select>
			</td>

		</tr>
		<tr>
		<td>
			Tahun
		</td>
			<td>
				<select name='tahun' id="tahun" class="form-control input-md">
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
		<tr id="data-ruang-format" style="display:none;">
		<td>
			Ruang
		</td>
			<td>
				<table>
				<tr id="centang-ruang">
					
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				<a style="display:none" id="download_format"></a>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="buat_format()" id="uploadXL">Download Format</button>
			</td>
		</tr>
			
		</table>
</form>
		<tr>
			<td>
				Upload Excel
			</td>
			<td>
				<input type="file" id="xlINP" name="inputXL">
				<input type="hidden" id="xlOUT" name="xlPath">
			</td>
		</tr>
		<tr>
			<td>
				
			</td>
			<td>
				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="baca_excel()" id="bacaXL"> Upload</button>
			</td>
		</tr>
		
</div>
<table id="cetak-format"></table>
</div>
<form id="form-upload" method="POST">
<div id="tes" style="display:none;"></div>
</form>
<br>
<br>

<script language="javascript">

$("#xlINP").change(function(){

	
   // readURL(this);
   printTable(this);
   
});

function printTable(input) {
     
        var reader = new FileReader();
        reader.readAsText(input.files[0]);
      	reader.onload = function(event)
      	{
        	var isi = event.target.result;
    		var data = $.isi.toArrays(isi);
    		alert(data);
    	}
}

function baca_excel()
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/baca_excel') ?>",
		type: "POST",
		data: $('#form-upload').serialize(),
		success: function(hasil)
		{
			alert(hasil);
		}
	});
}




var kode_penawaran;

function buat_format()
{
	var nama_file=$("#id_gedung_UP option:selected").text();
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/buat_format') ?>",
		type: "POST",
		data: $('#upload-xl').serialize(),
		success: function(xl)
		{
			var ex=$('#cetak-format').html(xl);
		
			//window.open('data:application/vnd.ms-excel,'+a.html());
			ex.table2excel({});

		}
	});
}



function tampil_ruang(id_gedung)
{
	$.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cari_ruang') ?>",
		type: "POST",
		data: "id_gedung="+id_gedung,
		success: function(gr)
		{
			$('#centang-ruang').html(gr);
			$('#data-ruang-format').slideDown('slow');
		}
	});
}

function pilih_nama(i)
{
	if($('#'+i.id).prop('checked'))
	{
		$('#nama'+i.id).attr('disabled',false);
	}
}

function open_upload()
{

	if($('#cekupload').prop('checked'))
	{	
		$('#upload_div').slideDown('slow');

	}
	else
	{
		$('#upload_div').slideUp('slow');
	}
	
}


function simpan_ruang()
{
	$("#table-ruang-ujian").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
				
	$.ajax({
			url:"<?php echo base_url('adminpmb/input_data_c/ruang_ujian_post') ?>",
			type:"POST",
			data:$('#form-ruang-ujian').serialize(),
			success : function(sv)
			{
				
				$('#table-ruang-ujian').html(sv);
				
			}
	});
}

function upload()
{
	
	$.ajax({
			url:"<?php echo base_url('adminpmb/input_data_c/upload_ruang_ujian') ?>",
			type:"POST",
			data:$('#upload-xl').serialize(),
			success : function(up)
			{
				//alert(up);
			}
	});

}



function changeGedung(id)
{
	//$("#ruang").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
             	
	$.ajax({
		url 	: "<?php echo base_url('adminpmb/input_data_c/select_detail_ruang'); ?>",
		type	: "POST",            
		data    : "id="+id.value,
		success: function(r){
			//var obk = $.parseJSON(r);
		
			document.getElementById("ruang").innerHTML = r;
		}
	});
}


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#xlOUT').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}


function ambil_jadwalnya (ini_jalur) {
	$.ajax({
		url : "<?php echo base_url('adminpmb/input_data_c/cari_detail_jadwal') ?>",
		type: "POST",
		data: "kode_jalur="+ini_jalur,
		success: function (isi) {
			$('#jadwal_jalur').html(isi);
		}
	});
}
function ambil_jadwalnya_xl(ini_jalur) {
	$.ajax({
		url : "<?php echo base_url('adminpmb/input_data_c/cari_detail_jadwal') ?>",
		type: "POST",
		data: "kode_jalur="+ini_jalur,
		success: function (isi) {
			$('#jadwal_jalur_xl').html(isi);
		}
	});
}

function cek_nomor(kdj)
{
	$('#noawal').attr('value',null);
	$('#noakhir').attr('value',null);
	var kuota=$('#jml').val();
	
	 $.ajax({
		url: "<?php echo base_url('adminpmb/input_data_c/cek_nomor') ?>",
		type: "POST",
		data: "kode_jalur="+kdj,
		success: function(nx)
		{
			var isi=parseInt(nx)+parseInt(kuota-1);	
			$('#noawal').attr('value',parseInt(nx));
			$('#noakhir').attr('value',isi);
		}
	});
	
}
</script>
