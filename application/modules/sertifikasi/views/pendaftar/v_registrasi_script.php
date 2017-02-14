<script type="text/javascript">

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}
function kabupaten_cari(inputString,param_lokasi,param_lokasi_balik,param_lokasi_tampil){
	if(inputString.length == 0) {
		$('#'+param_lokasi).fadeOut();
	} else {
		$('#'+param_lokasi+"Loading").html("&nbsp;<img src='<?=base_url("asset/img/loading.gif")?>'/>");
		$.ajax({
		type: "POST",
		cache:false,
		//url: "<?=site_url('registrasi/data_diri/kabupaten_cari')?>",
		data: {op:'kab_cari', katakunci: ""+inputString+"",lokasi_balik:""+param_lokasi_balik+"",lokasi:""+param_lokasi+"",lokasi_tampil:""+param_lokasi_tampil+""}
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
		url: "<?=site_url('registrasi/data_diri/propinsi_cari')?>",
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
/* hfd */
function OnChangeProp2(sel){
	$.ajax({
		//url 	: "<?php echo base_url() ?>data_pribadi_mahasiswa/data_diri/ajax_wilayah",
		type	: "POST",            
		data    : "aksi=prop&kd_prop="+sel.value,
		success: function(r){
			var obk = $.parseJSON(r);
			document.getElementById("kab2").innerHTML = obk['kab'];
			document.getElementById("kec2").innerHTML = '<option value="999999">KEC. LAINNYA</option>';
		}
	});
}

function OnChangeKab2(sel){
	$.ajax({
		//url 	: "<?php echo base_url() ?>data_pribadi_mahasiswa/data_diri/ajax_wilayah",
		type	: "POST",            
		data    : "aksi=kab&kd_kab="+sel.value,
		success: function(r){
			var obk = $.parseJSON(r);
			document.getElementById("kec2").innerHTML = obk['kec'];
		}
	});
}


</script>