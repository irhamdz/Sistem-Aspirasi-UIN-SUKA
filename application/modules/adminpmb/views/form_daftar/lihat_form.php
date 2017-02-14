<?php 
echo "<input type='hidden' id='user' value='".$nomor_pendaftar."'>";
echo "<input type='hidden' id='jalur' value='".$kode_jalur."'>";
echo "<input type='hidden' id='kode_penawaran' value='".$kode_penawaran."'>";
?>
<link href="http://it.uin-suka.ac.id/asset/css/bootstrap-icon.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>
<link href="http://static.uin-suka.ac.id/plugins/datetimepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css"/>
<script href="http://static.uin-suka.ac.id/plugins/datetimepicker/js/bootstrap.min.js"></script>

 
<?php 

echo "<script type='text/javascript'>";
		echo "var data_item = [];";
		echo "var data_form = [];";
		echo "var menu_form = [];";
	foreach ($data_form_aktif as $aktif) {
		echo "data_item.push('".$aktif->nama_form."');";	
	}

		
	foreach ($data_grup_aktif as $formall) 
	{	
		echo "menu_form.push('".str_replace('_', ' ', strtoupper(str_replace('piljur','pilihan jurusan',str_replace('s2','',$formall->nama_grup_form))))."');";	
		
		echo "data_form.push('".$formall->nama_grup_form."');";	

	}
	echo "</script>";

?>
<style type="text/css">
	.reg-kolom-kanan{
		float:right;
		width:45%;
		text-align:right;
	}
	.reg-kolom-kiri{
		float:left;
		width:45%;
	}

</style>
<br>

<ul id="crumbs">
	<li>
		<a href="" onclick="form()">Beranda</a>
	</li>
	<li id="pos">
		
	</li>

</ul>

<br>
<div id="tombol">
		<div class='reg-kolom-kiri' id="back" style="display:none;">
			<input onclick='sebelumnya()' class='btn btn-small btn-inverse btn-uin-right' type='button' value='<< Sebelumnya'>
		</div>

		<div class='reg-kolom-kanan' id="next" style="display:none;">
			<input onclick="selanjutnya()" class="btn btn-small btn-inverse btn-uin" title="Dengan menekan selanjutnya data anda akan disimpan." type="button" value="Selanjutnya >>">
		</div>

	</div>

<div id="slide-form">
</div>
<div id="tombol2">
		<div class='reg-kolom-kiri' id="back2" style="display:none;">
			<input onclick='sebelumnya()' class='btn btn-small btn-inverse btn-uin-right' type='button' value='<< Sebelumnya'>
		</div>

		<div class='reg-kolom-kanan' id="next2" style="display:none;">
			<input onclick="selanjutnya()" class="btn btn-small btn-inverse btn-uin" title="Dengan menekan selanjutnya data anda akan disimpan." type="button" value="Selanjutnya >>">
		</div>

	</div>
<script type="text/javascript">

function tampil_posisi(i)
{		
		document.getElementById('pos').innerHTML=menu_form[i];

}
var position=0;	
var user=$('#user').attr('value');
var jalur=$('#jalur').attr('value');
	function selanjutnya () 
	{

		if(position < data_form.length)
		{ 
				$("#msg").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
				
			
				$.ajax(
				{
					url 	: "<?php echo base_url('adminpmb/daftar_mhs_c/"+data_form[position]+"'); ?>",
					type	: "POST",            
					data: $("#"+data_form[position]).serialize(),
					success: function(r)
					{
						
						document.getElementById('msg').innerHTML=r;
						
						if($('#hasil').attr('value')=='1')
						{ 
							position+=1;
							
							if((data_form[position]!='data_piljur') && (data_form[position]!='form_jadwal_ujian') && data_form[position] !='data_riwayat_pendidikan_sebelumnya')
							{
							
							$('#slide-form').load("<?php echo base_url('adminpmb/form_control/"+data_form[position]+"/"+user+"'); ?>");
							}
							else
							{ 
							$('#slide-form').load("<?php echo base_url('adminpmb/form_control/"+data_form[position]+"/"+user+"/"+jalur+"'); ?>");
							
							}
							
							$("#back").show();
							$("#back2").show();
							tampil_posisi(position);
							
						}
						
					}
				});
			
		}
		else if (position == data_form.length)
		{
				$("#slide-form").html('<br /><center><br />Form Terakhir</center>');
				$("#next").hide();
				$("#next2").hide();
		}
		
		
	}

	function sebelumnya()
	{
		
	
		
		if(position > 0)
		{
			
			$("#slide-form").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
			/*
			$.ajax(
				{
					url 	: "<?php echo base_url('adminpmb/daftar_mhs_c/"+data_form[position]+"'); ?>",
					type	: "POST",            
					data: $("#"+data_form[position]).serialize(),
					success: function(r)
					{
						
						document.getElementById("msg").innerHTML = r;
						*/
						position-=1;
						
						if((data_form[position]!='data_piljur') && (data_form[position]!='form_jadwal_ujian') && (data_form[position] !='data_riwayat_pendidikan_sebelumnya'))
						{
							$('#slide-form').load("<?php echo base_url('adminpmb/form_control/"+data_form[position]+"/"+user+"'); ?>");
						}
						else
						{
							$('#slide-form').load("<?php echo base_url('adminpmb/form_control/"+data_form[position]+"/"+user+"/"+jalur+"'); ?>");
						}
					

						$("#next").show();
						$("#next2").show();
						tampil_posisi(position);
						//document.getElementById('form').value=data_form[position];
					
					//}
				//});
		}
		else 
		{
			$("#slide-form").html('<br /><center><br /></center>');
			$("#back").hide();
			$("#back2").hide();
		}
	}

function form ()
{
	tampil_posisi(0);
	$("#next").show();
	$("#next2").show();
	
						if(data_form[position]!='data_piljur')
						{
							$('#slide-form').load("<?php echo base_url('adminpmb/form_control/"+data_form[0]+"/"+user+"'); ?>");
						}
						else
						{
							$('#slide-form').load("<?php echo base_url('adminpmb/form_control/"+data_form[0]+"/"+user+"/"+jalur+"'); ?>");
						}

}


</script>