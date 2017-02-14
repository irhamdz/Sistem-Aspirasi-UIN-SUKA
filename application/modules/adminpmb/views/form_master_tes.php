<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <div>
    <br><form id="form-tes" method="POST">
    	<h3>MASTER TES</h3>
        <br>
    	<table>
    		<tr>
    			<td>
    			     KODE TES
    			</td>
    			<td>
    				<input type="text" id="kode" name="kode" class="form-control input-md">
    			</td>
    		</tr>
            <tr>
                <td>
                     NAMA TES
                </td>
                <td>
                    <input type="text" id="nama" name="nama" class="form-control input-md">
                </td>
            </tr>
    		
    		<tr>
    			<td>
    				
    			</td>
    			<td>
    				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_tes()" >Simpan</button>
    			</td>
    		</tr>

    	</table></form>
        <div class="bs-callout bs-callout-info"><p>KODE TES TERKAIT DENGAN KODE TES CBT DAN YUDISIUM</p></div>
    </div>
    <br>
    <div id="data-tes">
    	<?php  $this->load->view('v_table/tabel_master_tes') ?>
    </div>
    <script type="text/javascript">
    function simpan_tes (sk) {
        $("#data-tes").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
        
        $.ajax({
            url: "<?php echo base_url('adminpmb/input_data_c/simpan_tes'); ?>",
            type: "POST",
            data: $('#form-tes').serialize(),
            success: function(dk)
            {   
                $('#data-tes').html(dk);
            }
        });
    }
    </script>