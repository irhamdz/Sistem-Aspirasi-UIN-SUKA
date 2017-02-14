<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <div>
    	<h3>MASTER PROGRAM STUDI</h3>
        <form method="POST" id="form-prodi">
    	<table>
        <tr>
                <td>
                    KODE PROGRAM STUDI
                </td>
                <td>
                    <input type="text" id="id_prodi" name="id_prodi" class="form-control input-md">
                </td>
            </tr>
    		<tr>
    			<td>
    				NAMA PROGRAM STUDI
    			</td>
    			<td>
    				<input type="text" id="nama_prodi" name="nama_prodi" class="form-control input-md">
    			</td>
    		</tr>
            <tr>
            <td>
                <h>FAKULTAS</h>
            </td>
            <td>
            <select name="id_fakultas" class="form-control input-md" id="id_fakultas">
                <option value="">Pilih Fakultas</option>
                <?php
                    foreach ($data_fakultas as $f) {
                        echo "<option value='".$f->id_fakultas."'>".$f->nama_fakultas."</option>";
                    }
                ?>
            </select>
                
            </td>
        </tr>
        <tr>
            <td>
                <h>MINAT</h>
            </td>
            <td>
            <select name="id_minat" class="form-control input-md" id="id_minat">
                <option value="">Pilih Minat</option>
                <?php
                    foreach ($data_minat as $m) {
                        echo "<option value='".$m->kode_minat."'>".$m->nama_minat."</option>";
                    }
                ?>
            </select>
                
            </td>
        </tr>
    		<tr>
			<td>
				<h>JENJANG</h>
			</td>
			<td>
			<select name="id_jenjang" class="form-control input-md" id="id_jenjang">
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
    				
    			</td>
    			<td>
    				<button class='btn btn-inverse btn-uin btn-small' type="button" onclick="simpan_prodi()" >Simpan</button>
    			</td>
    		</tr>

    	</table></form>
    </div>
    <br>
        <div class="bs-callout bs-callout-info"><p>Penginputan proggram studi baru harus memperhatikan kode program studi. kesamaan akan mengupdate program studi yang telah ada.</p></div>
    <div id="data-prodi">
    	<?php $this->load->view('v_table/tabel_master_prodi'); ?>
    </div>
    <script type="text/javascript">
    
    function simpan_prodi () {
        $("#data-prodi").html('<br /><center><img src="http://akademik.uin-suka.ac.id/asset/img/loading.gif"><br />Harap menunggu</center>');
                
        $.ajax({
            url: "<?php echo base_url('adminpmb/input_data_c/eksekusi_update') ?>",
            type: "POST",
            data: $("#form-prodi").serialize(),
            success: function(sp)
            {
                $('#data-prodi').html(sp);
            }
        });
    }

    </script>