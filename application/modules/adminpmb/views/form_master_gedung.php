<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <div>
    <br>
    	<h3>MASTER GEDUNG</h3>
        <br>
    	<table>
        <form method="POST" id="form-gedung">
        <tr>
                <td>
                     KODE GEDUNG
                </td>
                <td>
                    <input type="text" id="kode" name="kode" class="form-control input-md">
                </td>
            </tr>
    		<tr>
    			<td>
    			     NAMA GEDUNG
    			</td>
    			<td>
    				<input type="text" id="nama" name="nama" class="form-control input-md">
    			</td>
    		</tr>
            <tr>
                <td>
                     STATUS GEDUNG
                </td>
                <td>
                    <select class="form-control input-md" name="status">
                        <option value="1">TERSEDIA</option>
                        <option value="0">TIDAK TERSEDIA</option>
                    </select>
                </td>
            </tr>
    		
    		<tr>
    			<td>
    				
    			</td>
    			<td>
    				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_gedung()" >Simpan</button>
    			</td>
    		</tr>

    	</table></form>
    </div>
    <br>
    <div class="bs-callout bs-callout-info"><p>Penginputan gedung baru harus memperhatikan kode gedung. kesamaan akan mengupdate gedung yang telah ada.</p></div>
  
    <div id="data-gedung">
    	<?php  $this->load->view('v_table/tabel_master_gedung') ?>
    </div>
    <script type="text/javascript">
    function simpan_gedung () {
         $("#data-gedung").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
        
        $.ajax({
            url: "<?php echo base_url('adminpmb/input_data_c/simpan_gedung'); ?>",
            type: "POST",
            data: $('#form-gedung').serialize(),
            success: function(dg)
            {   
                $('#data-gedung').html(dg);
            }
        });
    }
    </script>