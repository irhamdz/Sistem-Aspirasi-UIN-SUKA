<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

    <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    --><script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://static.uin-suka.ac.id/plugins/timepicker/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function () { 
            $('#jm,#js').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false,
                defaultTime: false
            });
        });
    </script>
	<style>
	.day{
		font-size:14px;
	}
	</style>
   <link href="http://static.uin-suka.ac.id/plugins/datepicker/css/datepicker.css" rel="stylesheet">

    <script src="http://static.uin-suka.ac.id/plugins/datepicker/js/bootstrap-datepicker.js"></script>
	
<div>
<h3 style="margin-bottom:10px;">Form Ruang</h3>
	<table class="table table-hover">
		<?php echo form_open(base_url('adminpmb/input_data_c/ruang_post'),array('name'=>'form_ruang','method'=>'POST','class'=>'form-horizontal')); ?>
		<tr>
			<td>
				<h>ID Ruang</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'id_ruang','class'=>'form-control input-md')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>ID Gedung</h>
			</td>
			<td>
				<select name='id_gedung' class="form-control input-md">
				<option> Pilih Gedung</option>
				<?php
				foreach ($nama_gedung as $valgdg) {
					echo "<option value='".$valgdg->id_gedung."'>".$valgdg->nama_gedung."</option>";
				}

				?>
			</td>
		</tr>

		<tr>
			<td>
				<h>Nama Ruang</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'nama_ruang','class'=>'form-control input-md')); ?>
			</td>
		</tr>
		
		<tr>
			<td>
				<h>Status Ruang</h>
			</td>
			<td>
			<div class="radio">
  				<label>
    				<input type="radio" name="status_ruang" id="optionsRadios1" value="1" checked>
    				Tersedia
  				</label>
			</div>
			<div class="radio">
  				<label>
    				<input type="radio" name="status_ruang" id="optionsRadios2" value="0">
    				Penuh
  				</label>
			</div>
			</td>
		</tr>

		<tr>
		<td></td>
			<td align="left">
				<?php echo form_submit(array('name'=>'btn_simpan_ruang','value'=>'SIMPAN','class'=>'btn btn-inverse btn-uin btn-small')); ?>
			</td>
		</tr>
		<?php echo form_close(); ?>
		</table>
	
</div>
<div id="table-ruang">
<?php
$this->load->view('v_table/view_table_ruang');
?>
</div>