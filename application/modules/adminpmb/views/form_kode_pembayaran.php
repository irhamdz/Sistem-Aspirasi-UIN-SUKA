<link rel="stylesheet" href="http://adab.uin-suka.ac.id/asset/bootstrap/css/bootstrap.css" type="text/css" media="screen" />
    
  <link href="http://static.uin-suka.ac.id/plugins/timepicker/css/bootstrap-timepicker.min.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
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
<h3 style="margin-bottom:10px;">Form Kode Pembayaran</h3>
	<table class="table table-hover">
		<?php echo form_open(base_url('adminpmb/input_data_c/kode_pembayaran_post'),array('name'=>'form_kode_pembayaran','method'=>'POST','class'=>'form-horizontal')); ?>
		<tr>
			<td>
				<h>Kode Bayar</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'kode_bayar','class'=>'form-control input-md')); ?>
			</td>
		</tr>

		<tr>
			<td>
				<h>Nama Pembayaran</h>
			</td>
			<td>
				<?php echo form_input(array('name'=>'nama_pembayaran','class'=>'form-control input-md')); ?>
			</td>
		</tr>
		<tr>
		<td></td>
			<td align="left">
				<?php echo form_submit(array('name'=>'btn_simpan_kode_bayar','value'=>'SIMPAN','class'=>'btn btn-inverse btn-uin btn-small')); ?>
			</td>
		</tr>
		<?php echo form_close(); ?>
		</table>
	
</div>
<div id="tbl-kode-pembayaran">
<?php
$this->load->view('v_table/view_table_kode_pembayaran');
?>
</div>