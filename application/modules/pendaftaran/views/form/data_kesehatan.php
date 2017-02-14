	<?php
	$dif=array();
	if(!is_null($maba))
	{
	foreach ($maba as $data_maba);
	}
	if(!is_null($difable))
	{
	foreach ($difable as $data_difable){
		array_push($dif, $data_difable->id_kesehatan);
	}
	}
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
<br>
<div id="msg"></div> 
	<form action='' name='form_sakti' method='POST' id="data_kesehatan">
	<input type="hidden" name="nomor_pendaftar" id="nomor" value="<?php echo $nomor_pendaftar; ?>">
<b style='padding-bottom:10px'>Riwayat Penyakit yang pernah dialami:</b>
<table>
<tr id="RIWAYAT" style="display:none;"><td>
<textarea style='width:500px;height:100px' name='TOP_RIWAYAT_KESEHATAN' id="riwayat" class="form-control input-sm"><?php  echo $data_maba->riwayat_penyakit;?></textarea>
</td></tr>
<br/>
<tr id="FISIK" style="display:none;">
<td>
<b>Kemampuan Fisik:</b><br/>
<input type='hidden' name='id_step_tujuan' id='id_step_tujuan'/>
	<input type='radio' onchange="cek_normal(this)" id="1" name='global_master_difabel' <?php  if(count($dif)<1){echo " checked ";} ?> /> Memililki Kemampuan Normal (sehat)<br/>
	<input type='radio' onchange="cek_normal(this)" id="0" name='global_master_difabel' <?php  if(count($dif)>0){echo " checked ";} ?> /> Memiliki Kemampuan Berbeda (<i>Different Ability</i>)
	<div class="difabel_box" id="box" <?php  if(count($dif)<1){echo " style='display:none;' ";} ?> >
		<?php
		
			foreach ($kesehatan as $kelainan) {

				echo "<div class='checkbox'>";
				echo "<label><input type='checkbox' "; 
				
				
				for($i=0; $i<count($dif); $i++)
				{
					if($dif[$i]==$kelainan->id_kesehatan){echo "checked";}
				}


				echo " onchange='simpan_difable(this)' id='".$kelainan->id_kesehatan."' name='KD_DIFABEL' value='".$kelainan->id_kesehatan."'>".$kelainan->kondisi_kesehatan."</label>";
				echo "</div>";
				
			}
		?>
	
	</div><br/>
</td>
</tr>
</table>
</form>
<br class='ganjel'/></form>
<script type="text/javascript">
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}

function simpan_difable(dif)
{
	var nomor=$('#nomor').attr('value');

	if($("#"+dif.id).is(':checked'))
	{

		
			$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/daftar_mhs_c/kemampuan_berbeda'); ?>",
						type	: "POST",            
						data    : "nomor_pendaftar="+nomor+"&id="+dif.value,
						success: function(de)
						{
							
							
						}

					});
			
	}
	else
	{
		$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/daftar_mhs_c/batal_kemampuan_berbeda'); ?>",
						type	: "POST",            
						data    : "nomor_pendaftar="+nomor+"&id="+dif.value,
						success: function(da)
						{
							
							
						}

					});
	}
}


function cek_normal(n)
{
	var cek=n.id;
	if($('#'+cek).is(':checked'))
	{
		if(cek=='1')
		{
			$('#box').slideUp('slow');
			//alert('hide');
		}
		else
		{
			$('#box').slideDown('slow');
			//alert('show');
		}
	}
}
</script>