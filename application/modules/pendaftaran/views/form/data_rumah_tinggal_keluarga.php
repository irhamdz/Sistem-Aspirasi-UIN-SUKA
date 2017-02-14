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
<script type="text/javascript">
	function pilih_sumber_air(air)
	{

		if(air!='E')
		{
			$('#label_ket_air').hide();

		}
		else
		{
			$('#label_ket_air').show();
			
		}
	}

	function pilih_sumber_listrik(id) 
	{
		if(id!='99')
		{
			$('#label_ket_listrik').hide();
		}
		else
		{
			$('#label_ket_listrik').show();
		}
	}

	function pilih_sumber_mck(id)
	{
		if(id!='99')
		{
			$('#label_ket_mck').hide();
		}
		else
		{
			$('#label_ket_mck').show();
		}
	}

	function pilih_bahan_atap(id)
	{
		if(id!='99')
		{
			$('#label_ket_atap').hide();
		}
		else
		{
			$('#label_ket_atap').show();
		}
	}

	function pilih_bahan_dinding(id)
	{
		if(id!='99')
		{
			$('#label_ket_dinding').hide();
		}
		else
		{
			$('#label_ket_dinding').show();
		}
	}

	function pilih_bahan_lantai(id)
	{
		if(id!='99')
		{
			$('#label_ket_lantai').hide();
		}
		else
		{
			$('#label_ket_lantai').show();
		}
	}
</script>
<br id="ganjel">
<div id="msg"></div> 
<form action="" method="post" enctype="multipart/form-data" name='form_sakti' id="data_rumah_tinggal_keluarga">
<input type='hidden' name='nomor_pendaftar' value="<?php echo $nomor_pendaftar; ?>" />
	<div class="bs-callout bs-callout-info">
	Tanda *) bermakna bahwa kolom wajib diisi.<br/>
    Pada bagian ini anda wajib meng-<i>upload</i>:
    <ol>
        <li>File <i>scan</i> Foto Rumah Tampak Depan</li>
        <li>File <i>scan</i> bukti Pembayaran PBB, PLN, PDAM, TELKOM dan internet. 
	Apabila anda tidak memiliki dokumen yang diminta, mohon membuat <b>Surat Pernyataan Tidak Berlangganan</b> (misalnya: surat pernyataan tidak berlangganan air dan/atau telepon dan/atau internet). Surat pernyataan silakan dibuat sendiri dan ditanda tangani oleh orang tua/wali atau mahasiswa yang bersangkutan (atas nama orang tua/wali).</li>
    </ol>
</div>
<table class="table-snippet">
	<tbody>
	<tr>
			<td colspan='2'><strong>Data Rumah Tinggal Keluarga</strong><br /></td>
	</tr>
	<tr id="KEPEMILIKAN" style="display:none;">
		<td class="reg-label" style="width:260px">Kepemilikan</td>
		<td class="reg-input">
			<select name='KD_PEMILIKAN' style='width:150px' class="form-control input-sm">
				                    	<option value="">Jenis Kepemilikan</option>
                                        <?php
                                        if(!is_null($data_kepemilikan_rumah))
                                        {
                                        	foreach ($data_kepemilikan_rumah as $jkr) {
                                        		echo "<option "; if($data_maba->id_kepemilikan==$jkr->id_kepemilikan){echo "selected";} echo " value='".$jkr->id_kepemilikan."'>".$jkr->kepemilikan."</option>";
                                        	}
                                        }
                                        ?>

                    			</select>
		</td>
	</tr>
	<tr id="TAHUN" style="display:none;">
		<td class="reg-label">Tahun Perolehan</td>
		<td class="reg-input">
			<select name='TAHUN_PEROLEHAN' id="th" style='width:100px' class="form-control input-sm">
				<option value=''>-</option>
				<?php 
					$year=getdate();
					$tahun=$year['year'];
					$i=100;
					while ($i>0) {
					$result=$tahun--;
					echo "<option "; if($data_maba->tahun_peroleh==$result){echo "selected";} echo " value='".$result."'>".$result."</option>";
					$i--;
					}
				?>						
								</select>
		</td>
	</tr>
	<tr id="LISTRIK" style="display:none;">
		<td class="reg-label">Sumber Listrik</td>
		<td class="reg-input">
			<select name='KD_SUMBER_LISTRIK' onchange='pilih_sumber_listrik(this.value)' style='width:150px' class="form-control input-sm">
                                    <option value="">Pilih Sumber Listrik</option>
                                       <?php 
                                       if(!is_null($data_sumber_listrik))
                                       {
                                       	foreach ($data_sumber_listrik as $dsl) 
                                       	{
                                       		echo "<option "; if($data_maba->id_sumber==$dsl->id_sumber){echo "selected";} echo " value='".$dsl->id_sumber."'>".$dsl->sumber."</option>";
                                       	}
                                       }
                                       ?>
                    			</select><span  style='display:none' id='label_ket_listrik'> Keterangan <input class="form-control input-sm" value="<?php echo $data_maba->ket_listrik; ?>" id="ket_air" type='text' name='SUMBER_LISTRIK_KETERANGAN'/></span>
		</td>
	</tr>	
    <tr id="DAYA" style="display:none;">
		<td class="reg-label">Daya Listrik (KVA/watt)</td>
		<td class="reg-input">
			<input type='text' maxlength='5' maxsize='5' value="<?php echo $data_maba->daya_listrik; ?>" class="form-control input-sm" name='DAYA_LISTRIK' style='width:100px'/> 
		</td>
	</tr>
    
	<tr id="TANAH" style="display:none;">
		<td class="reg-label">Luas Tanah (m&sup2;)</td>
		<td class="reg-input">
			<input type='text' maxlength='10' maxsize='10' value="<?php echo $data_maba->luas_tanah; ?>" class="form-control input-sm" name='LUAS_TANAH' style='width:100px'/> 
		</td>
	</tr>	
	<tr id="BANGUNAN" style="display:none;">
		<td class="reg-label">Luas Bangunan (m&sup2;)</td>
		<td class="reg-input">
			<input type='text' maxlength='10' maxsize='10' value="<?php echo $data_maba->luas_bangunan; ?>" class="form-control input-sm" name='LUAS_BANGUNAN' style='width:100px'/> 
		</td>
	</tr>	
    <tr id="NJOP" style="display:none;">
		<td class="reg-label">NJOP (Rp./m&sup2;)</td>
		<td class="reg-input">
			<input type='text' maxlength='10' maxsize='5' value="<?php echo $data_maba->njop; ?>" name='NJOP' class="form-control input-sm" style='width:100px'/> 
		</td>
	</tr>
	<tr id="MCK" style="display:none;">
		<td class="reg-label">Mandi Cuci Kakus</td>
		<td class="reg-input">
			<select name='MCK' style='width:230px' class="form-control input-sm" onchange='pilih_sumber_mck(this.value)'>
                <option value=''>Jenis MCK</option>
                                    <?php  
							if(!is_null($data_jenis_mck))
							{
								foreach ($data_jenis_mck as $djm) {
									echo "<option "; if($data_maba->id_mck==$djm->id_mck){echo "selected";} echo " value='".$djm->id_mck."'>".$djm->jenis_mck."</option>";
								}
							}
							?>
                    			</select><span  style='display:none' id='label_ket_mck'> Keterangan <input type='text' value="<?php echo $data_maba->ket_mck; ?>" class="form-control input-sm" style='width:100px' name='MCK_KETERANGAN' /></span>
		</td>
	</tr>	
	<tr id="AIR" style="display:none;">
		<td class="reg-label">Sumber Air</td>
		<td class="reg-input">            
            <select style='width:200px' name='KD_SUMBER_AIR' class="form-control input-sm" onchange="pilih_sumber_air(this.value)">
                <option value=''>Pilih Sumber Air</option>
							<?php  
							if(!is_null($data_sumber_air))
							{
								foreach ($data_sumber_air as $dsa) {
									echo "<option "; if($data_maba->id_sumber_air==$dsa->id_sumber_air){echo "selected";} echo " value='".$dsa->id_sumber_air."'>".$dsa->jenis_air."</option>";
								}
							}
							?>
				            </select>
            
            <span style='display:none;' id='label_ket_air'>Keterangan <input class="form-control input-sm" style='width:100px;' value="<?php echo $data_maba->ket_air; ?>" name='KETERANGAN_SUMBER_AIR' type='text'/></span>           
		</td>
	</tr>
    <tr id="ATAP" style="display:none;">
		<td class="reg-label">Bahan Atap</td>
		<td class="reg-input">
			<select style='width:150px' name='KD_BAHAN_ATAP' class="form-control input-sm" onchange='pilih_bahan_atap(this.value)'>
                <option value=''>Pilih Bahan Atap</option>
                                    <?php
                                    if(!is_null($data_bahan_atap))
                                    {
                                    	foreach ($data_bahan_atap as $dba) {
                                    		echo "<option "; if($data_maba->id_bahan_atap==$dba->id_bahan_atap){echo "selected";} echo " value='".$dba->id_bahan_atap."'>".$dba->nama_bahan."</option>";
                                    		# code...
                                    	}
                                    }

                                    ?>
                    			</select><span  style='display:none' id='label_ket_atap'> Keterangan <input type='text' value="<?php echo $data_maba->ket_atap; ?>" class="form-control input-sm" style='width:100px' name='BAHAN_ATAP_KETERANGAN'/></span>
		</td>
	</tr>
    <tr id="DINDING" style="display:none;">
		<td class="reg-label">Bahan Dinding</td>
		<td class="reg-input">
			<select style='width:150px' name='KD_BAHAN_DINDING' class="form-control input-sm" onchange='pilih_bahan_dinding(this.value)'>
                <option value=''>Pilih Bahan Dinding</option>
                                   <?php
                                    if(!is_null($data_bahan_dinding))
                                    {
                                    	foreach ($data_bahan_dinding as $dbd) {
                                    		echo "<option "; if($data_maba->id_bahan_dinding==$dbd->id_bahan_dinding){echo "selected";} echo " value='".$dbd->id_bahan_dinding."'>".$dbd->nama_bahan_dinding."</option>";
                                    		# code...
                                    	}
                                    }

                                    ?>
                    			</select><span  style='display:none' id='label_ket_dinding'> Keterangan <input type='text' value="<?php echo $data_maba->ket_dinding; ?>" class="form-control input-sm" style='width:100px' name='BAHAN_DINDING_KETERANGAN'/></span>
		</td>
	</tr>
	<tr id="LANTAI" style="display:none;">
		<td class="reg-label">Bahan Lantai</td>
		<td class="reg-input">

			<select style='width:150px' name='KD_BAHAN_LANTAI' class="form-control input-sm" onchange='pilih_bahan_lantai(this.value)'>
                <option value=''>Pilih Bahan Lantai</option>
                                    <?php
                                    if(!is_null($data_bahan_lantai))
                                    {
                                    	foreach ($data_bahan_lantai as $dbl) {
                                    		echo "<option "; if($data_maba->id_bahan_lantai==$dbl->id_bahan_lantai){echo " selected ";} echo " value='".$dbl->id_bahan_lantai."'>".$dbl->nama_bahan."</option>";
                                    		# code...
                                    	}
                                    }

                                    ?>
                    			</select>

                    			<span  style='display:none' id='label_ket_lantai'> Keterangan 
                    			<input type='text' class="form-control input-sm" value="<?php echo $data_maba->ket_lantai; ?>" style='width:100px' name='BAHAN_LANTAI_KETERANGAN'/>
                    			</span>
		</td>
	</tr>
	<tr id="JARAK_KOTA" style="display:none;">
		<td class="reg-label">Jarak dari Pusat Kota (Km)</td>

		<td class="reg-input">
			<input type='text' maxlength='10' value="<?php echo $data_maba->jarak_pusat_kota; ?>" maxsize='10' name='JARAK_DARI_KOTA' class="form-control input-sm" style='width:100px'/> 
		</td>
	</tr>	
	<tr id="JUMLAH_ORANG" style="display:none;">
		<td class="reg-label">Jumlah Orang Tinggal (orang)</td>
		<td class="reg-input">
			<input type='text' maxlength='5' maxsize='5' value="<?php echo $data_maba->jumlah_orang_tinggal; ?>" name='JUMLAH_ORG_TINGGAL' class="form-control input-sm" style='width:50px'/> 
		</td>
	</tr>
    <tr id="PBB" style="display:none;">
		<td class="reg-label">Nominal Pembayaran PBB (Rp./ tahun)</td>
		<td class="reg-input">
			<input type='text' maxlength='14' maxsize='5' value="<?php echo $data_maba->pbb; ?>" name='NOMINAL_PBB' class="form-control input-sm" style='width:100px'/> 
		</td>
	</tr>
    <tr id="PLN" style="display:none;">
		<td class="reg-label">Nominal Pembayaran PLN (Rp./ bulan)</td>
		<td class="reg-input">
			<input type='text' maxlength='14' maxsize='5' value="<?php echo $data_maba->pln; ?>" name='NOMINAL_PLN' class="form-control input-sm" style='width:100px'/> 
		</td>
	</tr>
    <tr id="PDAM" style="display:none;">
		<td class="reg-label">Nominal Pembayaran PDAM (Rp./ bulan)</td>
		<td class="reg-input">
			<input type='text' maxlength='14' maxsize='5' value="<?php echo $data_maba->pdam; ?>" name='NOMINAL_PDAM' class="form-control input-sm" style='width:100px'/> 
		</td>
	</tr>
    <tr id="TELKOM" style="display:none;">
		<td class="reg-label">Nominal Pembayaran TELKOM (Rp./ bulan)</td>
		<td class="reg-input">
			<input type='text' maxlength='14' maxsize='5' value="<?php echo $data_maba->telkom; ?>" name='NOMINAL_TELP' class="form-control input-sm" style='width:100px'/> 
		</td>
	</tr>
    <tr id="INTERNET" style="display:none;">
		<td class="reg-label">Nominal Pembayaran Internet (Rp./ bulan)</td>
		<td class="reg-input">
			<input type='text' maxlength='14' maxsize='5' value="<?php echo $data_maba->internet; ?>" name='NOMINAL_INTERNET' class="form-control input-sm" style='width:100px'/> 
		</td>
	</tr>
    <tr id="FOTO" style="display:none;">
		<td class="reg-label">Scan Foto Rumah Tampak Depan
            <div class='reg-info'>
                Tipe file yang diizinkan adalah gif, jpg, jpeg, png dan berukuran maksimum 1 MB
            </div>
        </td>
		<td class="reg-input">
			<input type='file' id="fotoInp" name='DOC_FOTO_RUMAH'/>
			<input type='hidden' id="fotoOut" name='DOC_FOTO_RUMAH_NAME'/>
			<input type='hidden' name='DOC_FOTO_RUMAH_NAME2' value='<?php if(!is_null($data_maba->foto_rumah)){echo $data_maba->foto_rumah;} ?>'/>
			
			<?php if(!is_null($data_maba->foto_rumah)){?>
			<a download href='<?php pg_unescape_bytea(echo $data_maba->foto_rumah); ?>'>
					<input type='button' class='btn btn-small btn-inverse' value='Download'/>
				</a>                <div class='reg-info'>
			     Anda sudah pernah meng-<i>upload</i> file Scan Bukti Pembayaran Internet. Apabila anda ingin memperbaharui, silakan <i>upload</i> file Foto Rumah Tampak Depan terbaru.
			     </div>
			    <?php }?>
                		</td>
	</tr>
    <tr id="SCAN_PBB" style="display:none;">
		<td class="reg-label">
            Scan Bukti Pembayaran PBB
            <div class='reg-info'>
                Tipe file yang diizinkan adalah gif, jpg, jpeg, png dan berukuran maksimum 1 MB
            </div>
        </td>
		<td class="reg-input">
			<input type='file' id="pbbInp" name='DOC_PBB'/>
			<input type='hidden' id="pbbOut" name='DOC_PBB_NAME'/>
			<input type='hidden' name='DOC_PBB_NAME2' value='<?php if(!is_null($data_maba->bukti_pembayaran_pbb)){echo $data_maba->bukti_pembayaran_pbb;} ?>'/>
			

			<?php if(!is_null($data_maba->bukti_pembayaran_pbb)){?>
			<a download href='<?php echo pg_unescape_bytea($data_maba->bukti_pembayaran_pbb); ?>'>
					<input type='button' class='btn btn-small btn-inverse' value='Download'/>
				</a>                 <div class='reg-info'>
			     Anda sudah pernah meng-<i>upload</i> file Scan Bukti Pembayaran PBB. Apabila anda ingin memperbaharui, silakan <i>upload</i> file Scan Bukti Pembayaran PBB terbaru.
			     </div>
			     <?php }?>
                		</td>
	</tr>
    <tr id="SCAN_PLN" style="display:none;">
		<td class="reg-label">Scan Bukti Pembayaran PLN
            <div class='reg-info'>
                Tipe file yang diizinkan adalah gif, jpg, jpeg, png dan berukuran maksimum 1 MB
            </div>
        </td>
		<td class="reg-input">
			<input type='file' id="plnIn" name='DOC_PLN'/>
			<input type='hidden' id="plnOut" name='DOC_PLN_NAME'/>
			<input type='hidden' name='DOC_PLN_NAME2' value='<?php if(!is_null($data_maba->bukti_pembayaran_pln)){echo $data_maba->bukti_pembayaran_pln;} ?>'/>
			<?php if(!is_null($data_maba->bukti_pembayaran_pln)){ ?>
			<a download href='<?php echo pg_unescape_bytea($data_maba->bukti_pembayaran_pln); ?>'>
					<input type='button' class='btn btn-small btn-inverse' value='Download'/>
				</a>                 <div class='reg-info'>
			     Anda sudah pernah meng-<i>upload</i> file Scan Bukti Pembayaran PLN. Apabila anda ingin memperbaharui, silakan <i>upload</i> file Scan Bukti Pembayaran PLN terbaru.
			     </div>
			     <?php } ?>
                		</td>
	</tr>
	<tr id="SCAN_PDAM" style="display:none;">
		<td class="reg-label">Scan Bukti Pembayaran PDAM
            <div class='reg-info'>
                Tipe file yang diizinkan adalah gif, jpg, jpeg, png dan berukuran maksimum 1 MB
            </div>
        </td>
		<td class="reg-input">
			<input type='file' id="pdamIn" name='DOC_AIR'/>
			<input type='hidden' id="pdamOut" name='DOC_AIR_NAME'/>
			<input type='hidden' name='DOC_AIR_NAME2' value='<?php if(!is_null($data_maba->bukti_pembayaran_pdam)){echo $data_maba->bukti_pembayaran_pdam;} ?>'/>
			
			<?php if(!is_null($data_maba->bukti_pembayaran_pdam)){?>
			<a download href='<?php echo pg_unescape_bytea($data_maba->bukti_pembayaran_pdam); ?>'>
					<input type='button' class='btn btn-small btn-inverse' value='Download'/>
				</a>                <div class='reg-info'>
			     Anda sudah pernah meng-<i>upload</i> file Scan Bukti Pembayaran PDAM. Apabila anda ingin memperbaharui, silakan <i>upload</i> file Scan Bukti Pembayaran PDAM terbaru.
			     </div>
			    <?php } ?>
                		</td>
	</tr>
	<tr id="SCAN_TELKOM" style="display:none;">
		<td class="reg-label">Scan Bukti Pembayaran TELKOM
            <div class='reg-info'>
                Tipe file yang diizinkan adalah gif, jpg, jpeg, png dan berukuran maksimum 1 MB
            </div>
        </td>
		<td class="reg-input">
			<input type='file' id="telkomInp" name='DOC_TELP'/>
			<input type='hidden' id="telkomOut" name='DOC_TELP_NAME'/>
			<input type='hidden' name='DOC_TELP_NAME2' value='<?php if(!is_null($data_maba->bukti_pembayaran_telkom)){echo $data_maba->bukti_pembayaran_telkom;} ?>'/>

			<?php if(!is_null($data_maba->bukti_pembayaran_telkom)){?>
			<a download href='<?php echo pg_unescape_bytea($data_maba->bukti_pembayaran_telkom); ?>'>
					<input type='button' class='btn btn-small btn-inverse' value='Download'/>
				</a>                <div class='reg-info'>
			     Anda sudah pernah meng-<i>upload</i> file Scan Bukti Pembayaran TELKOM. Apabila anda ingin memperbaharui, silakan <i>upload</i> file Scan Bukti Pembayaran TELKOM terbaru.
			     </div>
			     <?php }?>
                		</td>
	</tr>
	<tr id="SCAN_INTERNET" style="display:none;">
		<td class="reg-label">Scan Bukti Pembayaran Internet
            <div class='reg-info'>
                Tipe file yang diizinkan adalah gif, jpg, jpeg, png dan berukuran maksimum 1 MB
            </div>
        </td>
		<td class="reg-input">
			<input type='file' id="internetInp" name='DOC_INTERNET'/>
			<input type='hidden' id="internetOut" name='DOC_INTERNET_NAME'/>
			<input type='hidden' name='DOC_INTERNET_NAME2' value='<?php if(!is_null($data_maba->bukti_pembayaran_internet)){echo $data_maba->bukti_pembayaran_internet;} ?>'/>
			<?php if(!is_null($data_maba->bukti_pembayaran_internet)){ ?>
			<a download href='<?php echo pg_unescape_bytea($data_maba->bukti_pembayaran_internet); ?>'>
					<input type='button' class='btn btn-small btn-inverse' value='Download'/>
				</a>                <div class='reg-info'>
			     Anda sudah pernah meng-<i>upload</i> file Scan Bukti Pembayaran Internet. Apabila anda ingin memperbaharui, silakan <i>upload</i> file Scan Bukti Pembayaran Internet terbaru.
			     </div>
			     <?php } ?>
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
	function readURLFOTO(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#fotoOut').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

function readURLPBB(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#pbbOut').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}
function readURLPLN(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#plnOut').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}
function readURLPDAM(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#pdamOut').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}
function readURLTELKOM(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#telkomOut').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

function readURLINT(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (akta) {
         	$('#internetOut').attr('value', akta.target.result);	  
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#fotoInp").change(function(){

	
    readURLFOTO(this);
   
});

$("#pbbInp").change(function(){

	
    readURLPBB(this);
   
});
$("#plnIn").change(function(){

	
    readURLPLN(this);
   
});
$("#pdamIn").change(function(){

	
    readURLPDAM(this);
   
});
$("#internetInp").change(function(){

	
    readURLINT(this);
   
});
$("#telkomInp").change(function(){

	
    readURLTELKOM(this);
   
});
</script>