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
<br id="ganjel">
</br>
<div id="msg"></div> 
<form action='' method="post" enctype="multipart/form-data" name='form_sakti' id="data_rencana_hidup">
<input type='hidden' name='nomor_pendaftar'  value="<?php echo $nomor_pendaftar; ?>" />
<br class='ganjel'/>
	<table class="table-snippet">
	<tbody>
	<tr>
			<td colspan='2'><strong>Data Rencana Hidup</strong><br /></td>
		</tr>
	<tr id="REN_TINGGAL" style="display:none;">
		<td class="reg-label" style='width:230px'>Rencana Tinggal</td>
		<td class="reg-input">
			<select name='KD_TEMPAT_TINGGAL' onchange='pilih_rencana_tinggal(this.value)' class="form-control input-sm">
                <option >-</option>
                            	<option <?php if($data_maba->rencana_tinggal=='RUMAH ORANG TUA/WALI'){echo "selected";} ?> value='RUMAH ORANG TUA/WALI'>RUMAH ORANG TUA/WALI</option>
                                <option <?php if($data_maba->rencana_tinggal=='KOS'){echo "selected";} ?> value='KOS'>KOS</option>
                                <option <?php if($data_maba->rencana_tinggal=='SEWA RUMAH'){echo "selected";} ?> value='SEWA RUMAH'>SEWA RUMAH</option>
                                <option <?php if($data_maba->rencana_tinggal=='ASRAMA'){echo "selected";} ?> value='ASRAMA'>ASRAMA</option>
                                <option <?php if($data_maba->rencana_tinggal=='PESANTREN'){echo "selected";} ?> value='PESANTREN'>PESANTREN</option>
                                <option <?php if($data_maba->rencana_tinggal=='99'){echo "selected";} ?> value='99'>LAINNYA</option>
                            </select><span style='display:none;' id='label1'> Keterangan <input type='text' value="<?php echo $data_maba->keterangan_tinggal; ?>" class="form-control input-sm" name='KETERANGAN_TEMPAT_TINGGAL'/></span>
		</td>
	</tr>
    <tr id="DUKUNGAN" style="display:none;">
		<td class="reg-label">Dukungan Keluarga</td>
		<td class="reg-input">
			<select style='width:80px' onchange='pilih_nominal_dukungan(this.value)' name='DUKUNGAN_KEUANGAN' class="form-control input-sm">
                <option >-</option>
                <option <?php if($data_maba->dukungan_keluarga=='1'){echo "selected";} ?> value='1'>Ya</option>
                <option <?php if($data_maba->dukungan_keluarga=='0'){echo "selected";} ?> value='0'>Tidak</option>
            </select>
                        <span style='display:none;' id='label2'> Nominal (Rp./bulan):<input type='text' value="<?php echo $data_maba->jumlah_dukungan; ?>" class="form-control input-sm" name='NOMINAL_DUKUNGAN_KEUANGAN' /></span>
		</td>
	</tr>
    <tr id="TRANS_ASAL" style="display:none;">
		<td class="reg-label">Transportasi Dari dan Ke Tempat Asal</td>
		<td class="reg-input">
			<select style='width:220px' onchange='pilih_transportasi_daerah(this.value)' class="form-control input-sm" name='KD_TRANSPORT_DAERAH'>
                <option >-</option>
                                    <option <?php if($data_maba->transportasi_tempat_asal=='PESAWAT'){echo "selected";} ?> value='PESAWAT'>PESAWAT</option>
                                        <option <?php if($data_maba->transportasi_tempat_asal=='KAPAL'){echo "selected";} ?> value='KAPAL'>KAPAL</option>
                                        <option <?php if($data_maba->transportasi_tempat_asal=='KENDARAAN DARAT'){echo "selected";} ?> value='KENDARAAN DARAT'>KENDARAAN DARAT</option>
                                        <option <?php if($data_maba->transportasi_tempat_asal=='99'){echo "selected";} ?> value='99'>LAINNYA</option>
                                </select>
                        <span style='display:none;' id='label3'> Keterangan <input type='text' value="<?php echo $data_maba->keterangan_trans_asal; ?>" class="form-control input-sm" name='KETERANGAN_TRANSPORT_DAERAH' /></span>
		</td>
	</tr>
    <tr id="TRANS_HARIAN" style="display:none;">
		<td class="reg-label">Transportasi Harian</td>
		<td class="reg-input">
			<select style='width:220' onchange='pilih_transportasi_harian(this.value)' class="form-control input-sm" name='KD_TRANSPORT_HARIAN'>
                <option >-</option>
                                    <option <?php if($data_maba->transportasi_harian=='SEPEDA'){echo "selected";} ?> value='SEPEDA'>SEPEDA</option>
                                        <option <?php if($data_maba->transportasi_harian=='MOTOR'){echo "selected";} ?> value='MOTOR'>MOTOR</option>
                                        <option <?php if($data_maba->transportasi_harian=='MOBIL'){echo "selected";} ?> value='MOBIL'>MOBIL</option>
                                        <option <?php if($data_maba->transportasi_harian=='KENDARAAN UMUM'){echo "selected";} ?> value='KENDARAAN UMUM'>KENDARAAN UMUM</option>
                                        <option <?php if($data_maba->transportasi_harian=='JALAN KAKI'){echo "selected";} ?> value='JALAN KAKI'>JALAN KAKI</option>
                                        <option <?php if($data_maba->transportasi_harian=='BECAK'){echo "selected";} ?> value='BECAK'>BECAK</option>
                                        <option <?php if($data_maba->transportasi_harian=='99'){echo "selected";} ?> value='99'>LAINNYA</option>
                                </select>
                        <span style='display:none;' id='label4'> Keterangan <input type='text' value="<?php echo $data_maba->keterangan_trans_harian; ?>" class="form-control input-sm" name='KETERANGAN_TRANSPORT_HARIAN' /></span>
		</td>
	</tr>
	</tbody>
</table>
<br class='ganjel'/></form>
<script type="text/javascript">
for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}
	function pilih_transportasi_harian(x) 
	{
		if(x=='99')
		{
			$('#label4').show();
		}
		else
		{
			$('#label4').hide();
		}
	}
	function pilih_transportasi_daerah(y)
	{
		if(y=='99')
		{
			$('#label3').show();
		}
		else
		{
			$('#label3').hide();
		}
	}
	function pilih_nominal_dukungan(z)
	{
		if(z=='1')
		{
			$('#label2').show();
		}
		else
		{
			$('#label2').hide();
		}
	}
	function pilih_rencana_tinggal(a)
	{
		if(a=='99')
		{
			$('#label1').show();
		}
		else
		{
			$('#label1').hide();
		}
	}
	</script>