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
<div id="msg"></div> 
<div class="bs-callout bs-callout-info">Untuk riwayat jenjang S1 Keatas kosongkan kolom rangking dan jumlah siswa.</div>
<form action="#" name="form_sakti" id="data_riwayat_nilai_pendidikan_formal" method="POST">
<input type="hidden" id="nomor" name="nomor_pendaftar" value="<?php echo $nomor_pendaftar; ?>">
</br>
	<table class="table table-bordered table-hover" style="text-align:center">
			<thead>
			<tr>
				<th>Jenjang</th><th>Semester</th><th>Urutan Ranking</th>
				<th>Jumlah Siswa</th><th>Rerata Nilai/IPK</th><th>Rerata KKM</th>
				<th style="width:150px">Aksi</th>
			</tr>
			</thead>
			<tbody>
			<?php
			if(!is_null($maba))
			{
				foreach ($maba as $data_maba) {
					if(!is_null($data_maba->semester))
					{
						echo "<tr>";
						echo "<td>";echo $data_maba->nama_jenjang;echo "</td>";
						echo "<td>";echo $data_maba->semester;echo "</td>";
						echo "<td>";echo $data_maba->rangking;echo "</td>";
						echo "<td>";echo $data_maba->jumlah_siswa;echo "</td>";
						echo "<td>";echo $data_maba->nilai_raport;echo "</td>";
						echo "<td>";echo $data_maba->nilai_kkm;echo "</td>";
						echo "<td align='center'><a onclick='hapus_nilai_riwayat(".$data_maba->id_riwayat.")' href='#' class='btn'><i class='icon-trash'></i> Hapus</a></td>";
						echo "</tr>";
					}
				}
			}

			?>
							
			</tbody>
				</table>
	
<a name="fokus"></a>
<table class="table-snippet">
	<tbody>
	<tr>
			<td colspan='2'><strong>Data Riwayat Nilai Pendidikan Formal</strong><br /></td>
		</tr>
	<tr id="JENJANG_PEND" style="display:none;">
		<td class="reg-label">Jenjang Pendidikan</td>
		<td class="reg-input">
		<select style="width:130px" name="KD_PEND" class="form-control input-sm">
			<option value="">-Pilih Jenjang-</option>
					<?php 
					if(!is_null($data_pendidikan))
					{
						foreach ($data_pendidikan as $pendidikan) {
							echo "<option value='".$pendidikan->id_jenjang."'>".$pendidikan->nama_jenjang."</option>";
						}
					}
					?>
					</select>
		</td>
	
	</tr><tr id="SEMESTER" style="display:none;">
		<td class="reg-label">Semester</td>
		<td class="reg-input">
			<select name="SEMESTER" style="width:120px" class="form-control input-sm">
				<option value="">-</option>
									<option value="1">Semester 1</option>
										<option value="2">Semester 2</option>
										<option value="3">Semester 3</option>
										<option value="4">Semester 4</option>
										<option value="5">Semester 5</option>
										<option value="6">Semester 6</option>
										<option value="7">Semester 7</option>
										<option value="8">Semester 8</option>
										<option value="9">Semester 9</option>
										<option value="10">Semester 10</option>
										<option value="11">Semester 11</option>
										<option value="12">Semester 12</option>
										<option value="13">Semester 13</option>
										<option value="14">Semester 14</option>
								</select>
		</td>
	</tr>
	<tr id="RANGKING" style="display:none;">
		<td class="reg-label">Ranking</td>
		<td class="reg-input">
			Urutan <input maxlength="5" type="text" name="SISWA_RANKING" class="form-control input-sm" style="width:50px"> / Jumlah Siswa <input maxlength="5" type="text" class="form-control input-sm" name="SISWA_JUMLAH" style="width:50px"> 
		</td>
	</tr>
	<tr id="TRANS_NILAI" style="display:none;">
		<td class="reg-label">Raport/Transkrip Nilai</td>
		<td class="reg-input">
			Rerata Nilai/IPK <input maxlength="5" type="text" class="form-control input-sm" id="ipk" name="NILAI_RAPORT" style="width:50px"> / Rerata KKM <input type="text" maxlength="5" class="form-control input-sm" name="NILAI_KKM" style="width:50px"> 
		<div class='reg-info'>
		Contoh penulisan Nilai/IPK 3.00/8.0
		</div>
		</td>
		
	</tr>
	<tr id="BUTTON_RIWAYAT" style="display:none;">
		<td></td>
		<td class="reg-input"><input type="button" onclick="simpan_nilai_riwayat()" class="btn-uin btn btn-inverse" value="simpan nilai pendidikan"></td>
	</tr>
	</tbody>
</table>
<input type="hidden" name="ID_RIWAYAT_HIDDEN">
<br class="ganjel"></form>
<script type="text/javascript">


for(var i=0; i<data_item.length; i++)
    	{
    		$('#'+data_item[i]).show();
    	
    	}


var id=$('#nomor').attr('value');
	function simpan_nilai_riwayat()
	{
		var ipk=$('#ipk').val();
		
		var ipk_res=ipk.replace(",",".");
		$('#ipk').val(ipk_res);

					$.ajax(
					{
						url 	: "<?php echo base_url('adminpmb/form_control/insert_riwayat_nilai'); ?>",
						type	: "POST",            
						data: $("#data_riwayat_nilai_pendidikan_formal").serialize(),
						success: function(x)
						{
							
							$('#slide-form').load("<?php echo base_url('adminpmb/form_control/data_riwayat_nilai_pendidikan_formal/"+id+"'); ?>");
					
						}

					});


	}
	function hapus_nilai_riwayat(ri)
	{
			$.ajax(
					{
						url 	: "<?php echo base_url('adminpmb/form_control/hapus_riwayat_nilai'); ?>",
						type	: "POST",            
						data    : "id="+ri,
						success: function(z)
						{
							
							$('#slide-form').load("<?php echo base_url('adminpmb/form_control/data_riwayat_nilai_pendidikan_formal/"+id+"'); ?>");
						}

					});
	}

</script>