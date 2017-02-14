<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <div>
    	<h3>Data Jalur</h3>
    	<table>
    		<tr>
    			<td>
    				KODE JALUR
    			</td>
    			<td>
    				<input type="text" id="kode_jalur" name="kode_jalur" class="form-control input-md">
    			</td>
    		</tr>
    		<tr>
    			<td>
    				NAMA JALUR
    			</td>
    			<td>
    				<input type="text" id="nama_jalur" name="kode_jalur" class="form-control input-md">
    			</td>
    		</tr>
    		<tr>
			<td>
				<h>JENJANG</h>
			</td>
			<td>
			<select name="jenjang" class="form-control input-md" id="jenjang">
				<option value="">Pilih Jenjang</option>
				<?php
					foreach ($data_jenjang as $j) {
						echo "<option value='".$j->id_jenjang."'>".$j->nama_jenjang."</option>";
					}
				?>
			</select>
				
			</td>
		</tr>
        <tr>
            <td>
                KETERANGAN
            </td>
            <td>
                <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
            </td>
        </tr>
    		<tr>
    			<td>
    				
    			</td>
    			<td>
    				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_jalur()" >Simpan</button>
    			</td>
    		</tr>

    	</table>
    </div>
    <br>
    <br>
    <div id="data-jalur">
    	<?php  $this->load->view('v_table/jalur') ?>
    </div>
    <br>
    <br><!--
    <form id="finput" name="finput" method="post" class=" form-horizontal" action="<?php echo base_url('adminpmb/input_data_c/kab') ?>" enctype="multipart/form-data">

            <input id="file" name="file"  type="file" />
            <button class="btn btn-inverse btn-uin btn-small" type="submit">Simpan</button>
                    
  </form>-->
    <script type="text/javascript">
    function simpan_jalur () {
    	$("#data-jalur").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
	
    	var kode_jalur=$('#kode_jalur').val();
    	var nama=$('#nama_jalur').val();
    	var jenjang=$('#jenjang').val();
        var ket=$('#keterangan').val();
    	$.ajax({
    		url: "<?php echo base_url('adminpmb/input_data_c/simpan_jalur') ?>",
    		type: "POST",
    		data: "kode_jalur="+kode_jalur+"&nama_jalur="+nama+"&jenjang="+jenjang+"&keterangan="+ket,
    		success: function(ok)
    		{
    			$('#data-jalur').html(ok);
    		}
    	});
    }
    </script>