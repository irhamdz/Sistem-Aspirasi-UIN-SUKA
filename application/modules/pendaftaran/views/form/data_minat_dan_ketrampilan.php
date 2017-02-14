
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
	Apabila data minat & keterampilan tidak ada, maka isikan tulisan <b>TIDAK ADA</b> pada kolom Keterangan.
</div>
<strong>Data Minat dan Ketrampilan</strong>
<form action='' name='form_sakti' method='POST' id="data_minat_ketrampilan">
<table class="table-snippet">
	<tbody>
	<tr id="JENIS_MINAT" style="display:none;">
		<td class="reg-label">Jenis Minat & Keterampilan</td>
		<td class="reg-input">
			<select style='width:200px' required name='Jenis_Minat' class="form-control input-sm">
                                    <option  value=''>Jenis Minat</option>
                                        <?php
                                        if(!is_null($data_jenis_minat))
                                        {
                                        	foreach ($data_jenis_minat as $jenis_minat) {
                                        		echo "<option value='".$jenis_minat->jenis_minat."'>".$jenis_minat->nama_jenis."</option>";
                                        	}
                                        }

                                        ?>
                                </select>
		</td>
	</tr>
    <tr id="NAMA_MINAT" style="display:none;">
		<td class="reg-label">Nama Minat & Keterampilan</td>
		<td class="reg-input">
			<input style='width:250px' type='text' required name='NM_HOBI' class="form-control input-sm"/>
		</td>
	</tr>
    <tr id="KETERANGAN" style="display:none;">
		<td class="reg-label">Keterangan</td>		
        <td class="reg-input"><textarea style='width:300px;height:100px' id='KETERANGAN' name='KETERANGAN' class="form-control input-sm"></textarea>
        <input type="hidden" id="nomor" name="nomor_pendaftar" value="<?php echo $nomor_pendaftar; ?>">
        </td>		
	</tr>
    <tr id="BUTTON_KETRAMPILAN" style="display:none;">
		<td></td>
		<td class="reg-input"><input type='button' onclick="simpan_ketrampilan()" class='btn-uin btn btn-inverse' value='simpan minat & keterampilan'/></td>
	</tr>
	</tbody>
</table>
<br/>
<br class='ganjel'/></form>
 <table class="table table-bordered table-hover" style='text-align:center'>
    <thead>
        <tr><th>NO</th><th>JENIS MINAT & KETERAMPILAN</th><th>NAMA</th><th>KETERANGAN</th><th style='width:150px'>Aksi</th></tr>
    </thead>  
    <tbody>
    <?php
    $num=0;
    if(!is_null($maba))
    {
    	foreach ($maba as $data_maba)
    	 {

    		if(!is_null($data_maba->jenis_minat))
    		{
				echo "<tr>";
				echo "<td>"; echo $num+=1; echo "</td>";
				echo "<td>"; echo $data_maba->nama_jenis; echo "</td>";
				echo "<td>"; echo $data_maba->nama_minat; echo "</td>";
				echo "<td>"; echo $data_maba->keterangan; echo "</td>";
				echo "<td align='center'><a onclick='hapus_ketrampilan(".$data_maba->id_min_ket.")' href='#' class='btn'><i class='icon-trash'></i> Hapus</a></td>";
				echo "</tr>";
			}
    	}
	}
    ?>
            </tbody>
    </table>
<script type="text/javascript">
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}
var id=$('#nomor').attr('value');
	function simpan_ketrampilan()
	{

					$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/insert_minat'); ?>",
						type	: "POST",            
						data: $("#data_minat_ketrampilan").serialize(),
						success: function(x)
						{
							
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/data_minat_dan_ketrampilan/"+id+"'); ?>");
					
						}

					});

	}
	function hapus_ketrampilan(del)
	{

		$.ajax(
					{
						url 	: "<?php echo base_url('pendaftaran/form_control/hapus_minat'); ?>",
						type	: "POST",            
						data    : "id="+del,
						success: function(z)
						{
							
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/data_minat_dan_ketrampilan/"+id+"'); ?>");
						}

					});


	}
</script>