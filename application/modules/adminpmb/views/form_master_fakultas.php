<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <div>
    <br>
    <form id="form-fak" method="POST">
    	<h3>MASTER FAKULTAS</h3>
        <br>
    	<table>
    		<tr>
    			<td>
    			     KODE FAKULTAS
    			</td>
    			<td>
    				<input type="text" id="id_fakultas" name="id_fakultas" class="form-control input-md">
    			</td>
    		</tr>
    		<tr>
                <td>
                     NAMA FAKULTAS
                </td>
                <td>
                    <input type="text" id="nama_fakultas" name="nama_fakultas" class="form-control input-md">
                </td>
            </tr>
    		<tr>
    			<td>
    				
    			</td>
    			<td>
    				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_fakultas()" >Simpan</button>
    			</td>
    		</tr>
    	</table>
        </form>
    </div>
    <br>
    <br>
    <div id="data-fak">
    	<?php  $this->load->view('v_table/tabel_master_fakultas') ?>
    </div>
    <script type="text/javascript">
    function simpan_fakultas () {
        $.ajax({
            url: "<?php echo base_url('adminpmb/input_data_c/simpan_fakultas'); ?>",
            type: "POST",
            data: $('#form-fak').serialize(),
            success: function(df)
            {   
                $('#data-fak').html(df);
            }
        });
    }
    </script>