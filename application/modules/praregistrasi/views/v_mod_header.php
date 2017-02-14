<style>
	.system-content-sia{
		padding-top:10px;
	}
	.reg-kolom-kanan{
		float:right;
		width:45%;
		text-align:right;
	}
	.add_tgl{
		width:80px;
	}
	.error-message{
		text-align:left;
		padding:10px;
		margin-bottom:10px;
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
	td.reg-label{
		padding-right:20px;
		text-align:left;
		line-height:30px;
		vertical-align:top;
		width:180px;
	}
	td.reg-input2{
		padding-left:30px;
		line-height:30px;
		vertical-align:top;
	}
	td.reg-input{
		line-height:30px;
		vertical-align:top;
	}
	
	.bootstrap-datetimepicker-widget table td{
		font-size:12px;
		font-weight:normal;
	}
</style>
<script type="text/javascript">
function NilaiRupiah(jumlah)  
{  
    var titik = ".";
    var nilai = new String(jumlah);  
    var pecah = [];  
    while(nilai.length > 3)  
    {  
        var asd = nilai.substr(nilai.length-3);  
        pecah.unshift(asd);  
        nilai = nilai.substr(0, nilai.length-3);  
    }  

    if(nilai.length > 0) { pecah.unshift(nilai); }  
    nilai = pecah.join(titik);
    return nilai;  
}
function tab_tujuan(step_tujuan){
	<?php 
	if(ereg("data_keluarga",uri_string())){
		?>
		var txt;
		var XID_GAJI_IBU = document.getElementById('ID_GAJI_IBU').value;
		var XID_GAJI_BAPAK = document.getElementById('ID_GAJI_BAPAK').value;
		var XID_GAJI_WALI = document.getElementById('ID_GAJI_WALI').value;
		if(parseInt(XID_GAJI_IBU) >= 0 || parseInt(XID_GAJI_BAPAK) >= 0 || parseInt(XID_GAJI_WALI) >= 0){
			var r = confirm("Apakah anda yakin dengan isian berikut:\n- Gaji Ibu: Rp."+NilaiRupiah(XID_GAJI_IBU)+"\n- Gaji Bapak: Rp."+NilaiRupiah(XID_GAJI_BAPAK)+"\n- Gaji Wali: Rp."+NilaiRupiah(XID_GAJI_WALI)+"\n");
			if (r == true) {
			    document.getElementById('id_step_tujuan').value=step_tujuan;
				document.forms["form_sakti"].submit();
			} 
		}else{
			document.getElementById('id_step_tujuan').value=step_tujuan;
			document.forms["form_sakti"].submit();
		}
		
		<?php
	}else{
	?>
		document.getElementById('id_step_tujuan').value=step_tujuan;
		document.forms["form_sakti"].submit();
	<?php } ?>

}
function tab_tujuan2(step_tujuan){
	document.getElementById('id_step_tujuan').value=step_tujuan;
	x=document.getElementById('id_step_tujuan').value;
	alert('jalankanxxx '+x);
	document.forms["form_sakti"].submit();
}
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}
function pendidikan_cari(param_kd_pend){
	var param_kd_pend;
	$.ajax({
		type: "POST",
		cache:false,
		url: "<?=site_url('praregistrasi/global_ajax/ajax_data_sekolah')?>",
		data: {KD_PEND: ""+param_kd_pend+""}
		}).done(function(data) {	
			$('#jenjang_detail').html("<img src='<?php echo base_url(); ?>asset/img/loading.gif'/>");
			if(data.length >0) {				
				$('#jenjang_detail').html(data);
			}else{
				$('#jenjang_detail').html('');
			}
		});
}
function kabupaten_cari(inputString,param_lokasi,param_lokasi_balik,param_lokasi_tampil){
	if(inputString.length == 0) {
		$('#'+param_lokasi).fadeOut();
	} else {
		$('#'+param_lokasi+"Loading").html("&nbsp;<img src='<?=base_url("asset/img/loading.gif")?>'/>");
		$.ajax({
		type: "POST",
		cache:false,
		url: "<?=site_url('praregistrasi/global_ajax/kabupaten_cari')?>",
		data: {katakunci: ""+inputString+"",lokasi_balik:""+param_lokasi_balik+"",lokasi:""+param_lokasi+"",lokasi_tampil:""+param_lokasi_tampil+""}
		}).done(function( data ) {
			if(data.length >0) {
				$('#'+param_lokasi).fadeIn();
				$('#'+param_lokasi+"List").html(data);
				$('#'+param_lokasi+"Loading").html(' ');
				//$('#nama_kabupaten').removeClass('load');
			}
		});
	}
}
function kabupaten_isi(lokasi,isi){
	//LOKASI 
	var explode=lokasi.split('#');
	var x=explode[0];
	var y=explode[1];
	var lokasi_tampil=explode[2];
	//ISI
	var isinya=isi.split("#");
	var kd=isinya[0];
	var nm=isinya[1];
	/////
	document.getElementById(lokasi_tampil).value=nm;
	document.getElementById(y).value=kd;	
	setTimeout("$('#"+x+"').fadeOut();", 600);
}
function hilangkan_ajax(param){
	setTimeout("$('#"+param+"').fadeOut();", 600);
}
function propinsi_isi(param_kd_kab){
	var param_kd_kab;
	$.ajax({
		type: "POST",
		cache:false,
		url: "<?=site_url('praregistrasi/global_ajax/propinsi_cari')?>",
		data: {kd_kab: ""+param_kd_kab+""}
		}).done(function( data ) {
			if(data.length >0) {
				var explode=data.split('#');
				var kd=explode[0];
				var nm=explode[1];
				document.getElementById('KD_PROP').value=kd;
				document.getElementById('NM_PROP').value=nm;
			}else{
				document.getElementById('KD_PROP').value='';
				document.getElementById('NM_PROP').value='';
			}
		});
	
}
function pekerjaan_pilih(KD_PEKERJAAN){
	if(KD_PEKERJAAN=='A')
		document.getElementById('ket').innerHTML='Golongan';
	else if(KD_PEKERJAAN=='C')
		document.getElementById('ket').innerHTML='Pangkat';
	else
		document.getElementById('ket').innerHTML='Keterangan';	
}
</script>
<?php
	$this->load->library('lib_reg_fungsi');
	echo $this->lib_reg_fungsi->identitas();
?>