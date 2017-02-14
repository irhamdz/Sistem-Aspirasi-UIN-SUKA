
<?php 
	
	echo "<script type='text/javascript'>";
		echo "var data_form = [];";
	foreach ($data_form_aktif as $formall) 
	{	
		echo "data_form.push('".$formall->nama_form."');";	
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
<br id="ganjel">
<div id="tombol">
<div class='reg-kolom-kiri' id="back">
</div>
<div class='reg-kolom-kanan' id="next">
<input onclick="selanjutnya()" class="btn btn-small btn-inverse btn-uin" type="button" value="Selanjutnya >>">
</div>
</div>
<div id="slide-form">
</div>


<script type="text/javascript">

	var position=-1;
	function selanjutnya () 
	{
		
		if(position < data_form.length)
		{
			position+=1;
			$('#slide-form').load("<?php echo base_url('adminpmb/form_control/"+data_form[position]+"'); ?>");
			
            document.getElementById("back").innerHTML="<input onclick='sebelumnya()' class='btn btn-small btn-inverse btn-uin-right' type='button' value='<< Sebelumnya'>";

		}
		else
		{
			document.getElementById("next").innerHTML="<input onclick='selanjutnya()' class='btn btn-small btn-inverse btn-uin' type='hidden' value='Selanjutnya >>'>";
        
		}
		
	}

	function sebelumnya()
	{
		
		if(position > 0)
		{
			position-=1;
			$('#slide-form').load("<?php echo base_url('adminpmb/form_control/"+data_form[position]+"'); ?>");
			document.getElementById("next").innerHTML="<input onclick='selanjutnya()' class='btn btn-small btn-inverse btn-uin' type='button' value='Selanjutnya >>'>";
        	
		}
		else
		{
			document.getElementById("back").innerHTML="<input onclick='sebelumnya()' class='btn btn-small btn-inverse btn-uin-right' type='hidden' value='<< Sebelumnya'>";

		}
	}
</script>