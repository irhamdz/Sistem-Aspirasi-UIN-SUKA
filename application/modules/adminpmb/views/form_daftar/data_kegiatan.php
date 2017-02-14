<?php
foreach ($maba as $data_maba);
?>
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
<br class='ganjel'/>
<div id="msg"></div> 
	<div class="bs-callout bs-callout-info">
	Apabila data kegiatan tidak ada, maka isikan tulisan <b>TIDAK ADA</b> pada kolom Keterangan.
</div>
<form action="" method="post" enctype="multipart/form-data" name='form_sakti' id="data_kegiatan">
<input type='hidden' name='nomor_pendaftar' value="<?php echo $nomor_pendaftar; ?>" />
<table class="table-snippet">
	<tbody>
		<tr>
			<td colspan='2'><strong>Data Kegiatan</strong><br /></td>
		</tr>
	<tr id="NM_KEGIATAN" style="display:none;">
		<td class="reg-label" style="width:200px">Nama Kegiatan</td>
		<td class="reg-input">
			<input style='width:300px' type='text' value="<?php echo $data_maba->nama_kegiatan; ?>" class="form-control input-sm" id="NM_KEGIATAN" name='NM_KEGIATAN' /> *)
			<div class='reg-info'>
                Nama Kegiatan dalam bahasa Indonesia
            </div>
		</td>
	</tr>
	<tr id="PENYELENGGARA" style="display:none;">
		<td class="reg-label">Nama Penyelenggara Kegiatan</td>
		<td class="reg-input">
			<input style='width:300px' type='text' value="<?php echo $data_maba->nama_penyelenggara; ?>" class="form-control input-sm" name='NM_PENY_KEGIATAN' id="NM_PENY_KEGIATAN"/> *)
			<div class='reg-info'>
                Nama Penyelenggara Kegiatan dalam bahasa Indonesia
            </div>
		</td>
	</tr>
	<tr id="WAKTU" style="display:none;">
        <td class="reg-label">Waktu Kegiatan</td>
		<td class="reg-input">
			Tanggal Mulai<div class="input-group date" id="tgl_mulai" data-date="" data-date-format="dd-mm-yyyy" >
					<input class="form-control" size="16" type="text" value="<?php if(!is_null($data_maba)) {echo date('d/m/Y',strtotime($data_maba->tanggal_mulai));} ?>" name="tgl_mulai_keg" class="form-control input-sm" >
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div>
		  
          	Tanggal Selesai<div class="input-group date" id="tgl_selesai" data-date="" data-date-format="dd-mm-yyyy" >
					<input class="form-control" size="16" type="text" value="<?php if(!is_null($data_maba)) {echo date('d/m/Y',strtotime($data_maba->tanggal_selesai));} ?>" name="tgl_selesai_keg" class="form-control input-sm" >
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div>
          
		  <script type="text/javascript">
		  $(function() 
	{
    var tgl1 = $("#tgl_mulai").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl1.hide();
	}).data('datepicker');

	$(function() 
	{
    var tgl = $("#tgl_selesai").datepicker({
		format : 'dd/mm/yyyy',
		onRender: function(date) {
			return date.valueOf() < new Date().valueOf() ? 'enabled' : '';
		}
	}).on('changeDate', function(ev) {
		tgl.hide();
	}).data('datepicker');

	});

	});
		</script>
		</td>
    </tr>
    <tr id="JENIS" style="display:none;">
		<td class="reg-label">Jenis Kegiatan</td>
		<td class="reg-input">
			<select style='width:150px' name='KD_JENIS_KEGIATAN' onchange='pilih_jenis_kegiatan(this)' class="form-control input-sm">
									<option  value=''>Pilih Kegiatan</option>
									<?php
										if(!is_null($data_kegiatan))
										{
											foreach ($data_kegiatan as $kegiatan) {
												echo "<option "; if($data_maba->id_kegiatan==$kegiatan->id_kegiatan){echo "selected";} echo " value='".$kegiatan->id_kegiatan."'>".$kegiatan->nama_kegiatan."</option>";
											}
										}
									?>
										
								</select>
			<span  style='display:none' id='label_ket_jenis_kegiatan'> Keterangan <input type='text' value="<?php echo $data_maba->keterangan_jenis; ?>" style='width:200px' class="form-control input-sm" maxlength='128' name='KETERANGAN_JENIS_KEGIATAN'/></span>
        </td>
	</tr>
    <tr id="NO_SERTIFIKAT" style="display:none;">
		<td class="reg-label">Nomor Sertifikat Bukti Kegiatan</td>
		<td class="reg-input">
			<input style='width:300px' type='text' value="<?php echo $data_maba->no_bukti_sertifikat; ?>" class="form-control input-sm" name='NO_SERTIF_KEGIATAN' id="NO_SERTIF_KEGIATAN"/>
		</td>
	</tr>
    <tr id="SERTIFIKAT" style="display:none;">
        <td class="reg-label">
            Upload Sertifikat Bukti Kegiatan<br/>
            <div class='reg-info'>
                Tipe file yang diizinkan adalah gif, jpg, jpeg, png atau pdf dan berukuran maksimum 1 MB
            </div>
        </td>
		<td class="reg-input">
			<input type='file' id="sertInp" />
            <input type='hidden' id="sertOut" name='DOC_SERTIF_KEGIATAN_NAME' value='<?php if(!is_null($data_maba->sertifikat_kegiatan)){echo $data_maba->sertifikat_kegiatan;} ?>'/>
					</td>
    </tr>
	<tr id="KETERANGAN" style="display:none;">
		<td class="reg-label">Keterangan</td>
		<td class="reg-input"><textarea style='width:300px;height:100px' id='KETERANGAN' name='KETERANGAN' class="form-control input-sm"><?php echo $data_maba->keterangan; ?></textarea></td>
	</tr>
	</tbody>
</table>
<input type='hidden' name='ID_RIWAYAT_HIDDEN' value=''/>
<br/>
<br/>
<br class='ganjel'/></form>
<script type="text/javascript">
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}
    	

	function readURLSK(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (ser) {
         	$('#sertOut').attr('value', ser.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#sertInp").change(function(){

	
    readURLSK(this);
   
});

function pilih_jenis_kegiatan(val)
{

	if(val.value=='5')
	{
		$('#label_ket_jenis_kegiatan').show();
	}
	else
	{
		$('#label_ket_jenis_kegiatan').hide();
	}
}
</script>