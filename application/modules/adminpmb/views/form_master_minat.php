<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <div>
    	<h3>FORM MASTER MINAT</h3>
    	<table>
            <tr>
                <td>
                    KODE MINAT
                </td>
                <td>
                    <input type="text" id="kode_minat" name="kode_minat" class="form-control input-md">
                </td>
            </tr>
    		<tr>
    			<td>
    				NAMA MINAT
    			</td>
    			<td>
    				<input type="text" id="nama_minat" name="nama_minat" class="form-control input-md">
    			</td>
    		</tr>
    		
    		<tr>
    			<td>
    				
    			</td>
    			<td>
    				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_minat()" >Simpan</button>
    			</td>
    		</tr>

    	</table>
    </div>
    <br>
    <div class="bs-callout bs-callout-info"><p>Penginputan minat baru harus memperhatikan kode minat. kesamaan akan mengupdate minat yang telah ada.</p></div>
  
    <div id="data-minat">
    	<?php  $this->load->view('v_table/tabel_master_minat') ?>
    </div>
    <script type="text/javascript">
    function simpan_minat (sm) {
        $.ajax({
            url: "<?php echo base_url('adminpmb/input_data_c/simpan_minat'); ?>",
            type: "POST",
            data: "nama_minat="+$('#nama_minat').val()+"&kode_minat="+$('#kode_minat').val(),
            success: function(min)
            {
                $('#data-minat').html(min);
            }
        });
    }
    </script>