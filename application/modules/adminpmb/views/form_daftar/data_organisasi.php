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
<br class="ganjel">
<div id="msg"></div> 
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th valign='top' style='text-align:center;width:30px'>NO</th>
				<th valign='top' style='width:30px'>NAMA ORGANISASI</th>
				<th valign='top' style='width:100px'>BIDANG ORGANISASI</th>
				<th>WAKTU ORGANISASI</th>
				<th valign='top'>JABATAN</th>
				<th valign='top' style='width:200px'>KETERANGAN</th>
				<th valign='top' style='width:165px'>AKSI</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$num=0;
		if(!is_null($maba))
		{
			foreach ($maba as $data_maba)
			 {
			 	if(!is_null($data_maba->nama_organisasi))
			 	{
						echo "<tr>";
						echo "<td style='text-align:center'>";echo $num+=1; echo "</td>";
						echo "<td>".$data_maba->nama_organisasi."</td>";
						echo "<td>".$data_maba->bidang_organisasi."</td>";
						echo "<td>".$data_maba->waktu_organisasi."</td>";
						echo "<td>".$data_maba->jabatan."</td>";
						echo "<td>".$data_maba->keterangan."</td>";
						echo "<td align='center'><a onclick='hapus_org(".$data_maba->id_organisasi.")' href='#' class='btn'><i class='icon-trash'></i> Hapus</a></td>";
						echo "</tr>";
			 	}
				
			}
		}
		
		?>
				</tbody>
	</table>
	<a name='fokus'></a>
<form action='' name='form_sakti' id="data_organisasi" method='POST'>
 <input type="hidden" id="nomor" name="nomor_pendaftar" value="<?php echo $nomor_pendaftar; ?>">
<table class="table-snippet">
	<tbody>
	<tr>
			<td colspan='2'><strong>Data Organisasi</strong><br /></td>
		</tr>
	<tr id="NM_ORG" style="display:none;">
		<td class="reg-label">Nama Organisasi</td>
		<td class="reg-input">
			<input style='width:300px' type='text' id="NM_ORGANISASI" name='NM_ORGANISASI'class="form-control input-sm"/> *)
			<div class='reg-info'>
                Nama Organisasi dalam bahasa Indonesia
            </div>
		</td>
	</tr>
	<tr id="BIDANG" style="display:none;">
		<td class="reg-label">Bidang Kerja Organisasi</td>
		<td class="reg-input">
			<input style='width:300px' type='text' class="form-control input-sm" name='BID_ORGANISASI' id="BID_ORGANISASI"/> *)
			<div class='reg-info'>
                Nama Bidang Kerja Organisasi dalam bahasa Indonesia
            </div>
		</td>
	</tr>
	<tr id="WAKTU" style="display:none;">
        <td class="reg-label">Waktu Kegiatan</td>
		<td class="reg-input">
			Tanggal Mulai<div class="input-group date" id="tgl_mulai" data-date="" data-date-format="dd-mm-yyyy" >
					<input class="form-control" size="16" type="text" name="tgl_mulai" class="form-control input-sm" >
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div>
		  
          	Tanggal Selesai<div class="input-group date" id="tgl_selesai" data-date="" data-date-format="dd-mm-yyyy" >
					<input class="form-control" size="16" type="text" name="tgl_selesai" class="form-control input-sm" >
					<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
					</div> *)
          
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
	<tr id="JABATAN" style="display:none;">
		<td class="reg-label">Jabatan Organisasi</td>
		<td class="reg-input"><input style='width:300px' type='text' class="form-control input-sm" id="JABATAN" name='JABATAN' /> *)</td>
	</tr>
	<tr id="KETERANGAN" style="display:none;">
		<td class="reg-label">Keterangan</td>
		<td class="reg-input"><textarea style='width:300px;height:100px' id='KETERANGAN' name='KETERANGAN' class="form-control input-sm"></textarea></td>
	</tr>
	<tr id="BTN_ORG" style="display:none;">
		<td></td>
		<td class="reg-input"><input type='button' onclick="simpan_org()" class='btn-uin btn btn-inverse' value='simpan riwayat organisasi'/></td>
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
var id=$('#nomor').attr('value');
	function simpan_org()
	{

					$.ajax(
					{
						url 	: "<?php echo base_url('adminpmb/form_control/insert_organisasi'); ?>",
						type	: "POST",            
						data: $("#data_organisasi").serialize(),
						success: function(x)
						{
							
							$('#slide-form').load("<?php echo base_url('adminpmb/form_control/data_organisasi/"+id+"'); ?>");
					
						}

					});

	}
	function hapus_org(org)
	{
			$.ajax(
					{
						url 	: "<?php echo base_url('adminpmb/form_control/hapus_organisasi'); ?>",
						type	: "POST",            
						data    : "id="+org,
						success: function(z)
						{
							
							$('#slide-form').load("<?php echo base_url('adminpmb/form_control/data_organisasi/"+id+"'); ?>");
						}

					});
	}

</script>