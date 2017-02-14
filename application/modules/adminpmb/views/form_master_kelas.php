<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <div>
    <br>
    	<h3>MASTER KELAS</h3>
        <br>
    	<table>
    		<tr>
    			<td>
    			     NAMA KELAS
    			</td>
    			<td>
    				<input type="text" id="kelas" name="kelas" class="form-control input-md">
    			</td>
    		</tr>
    		
    		<tr>
    			<td>
    				
    			</td>
    			<td>
    				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_kelas()" >Simpan</button>
    			</td>
    		</tr>

    	</table>
    </div>
    <br>
    <br>
    <div id="data-kelas">
    	<?php  $this->load->view('v_table/tabel_master_kelas') ?>
    </div>
    <script type="text/javascript">
    function simpan_kelas (sk) {
        $.ajax({
            url: "<?php echo base_url('adminpmb/input_data_c/simpan_kelas'); ?>",
            type: "POST",
            data: "nama_kelas="+$('#kelas').val(),
            success: function(dk)
            {   
                $('#data-kelas').html(dk);
            }
        });
    }
    </script>