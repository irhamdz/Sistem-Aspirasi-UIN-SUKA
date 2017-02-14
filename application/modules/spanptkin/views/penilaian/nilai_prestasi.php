
				<div style="margin:20px 0; "><h3>NILAI PRESTASI NON AKADEMIK</h3></div>
				<form class="form-inline" method="post" action="">
				  <div class="form-group">
					<label for="prodi">Program Studi &nbsp;&nbsp;&nbsp;</label>
					<select name="prodi" id="prodi" class="form-control input-sm">
							<option value="" >PILIH PROGRAM STUDI</option>
							<?php foreach($prodi as $p): ?>
								<?php
									if($p->kode_program_studi==$kode_prodi){
										echo "<option value='".$p->kode_program_studi."' selected>".$p->program_studi."</option>";
									}else{
									echo "<option value='".$p->kode_program_studi."'>".$p->program_studi."</option>";
									}
								?>	
							<?php endforeach ?>
						</select>
				  </div>
				</form>
				<br>
					<?php $a = $this->session->flashdata('message');?>
					<?php if($a!=null):?>
						<div class="msg_alert alert alert-info">
							<?php echo $a[1]?>
						</div>
						
						<script type="text/javascript" charset="utf-8">
							$(function(){
								setTimeout('closing_msg()', 4000)
							})

							function closing_msg(){
								$(".msg_alert").slideUp();
							}
						</script>
					<?php  endif;?>
				<br>
					
						<form method="post" action="">
							<table class="table table-bordered table-hover">
								<tr>
									<th width="5%"><center>No</center></th>
									<th width="10%"><center>No Pendaftaran</center></th>
									<th width="25%"><center>Nama Siswa</center></th>
									<th width="45%"><center>Prestasi</center></th>
									<th width="5%"><center>Nilai</center></th>
								</tr>	
								<?php $i=0 ?>
								<?php foreach($siswa as $s):?>
								<?php if(!empty($s['PRESTASI'])){?>
								<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><?php echo $s['NOMOR_PENDAFTARAN'] ?></td>
									<td><?php echo $s['NAMA_SISWA'] ?></td>
									<td><?php
											if(!empty($s['PRESTASI'])){
												foreach($s['PRESTASI'] as $p){
													echo "<span style='font-size:12px;'>".$p->jenis_prestasi;
													echo " (<a style='color:green' href='".base_url('media/snmptn/'.$s['NOMOR_PENDAFTARAN'].'/Prestasi/'.$p->file_sertifikat)."' target='_blank'>".$p->id_prestasi."</a>)";
													echo " - ".$p->jenjang_prestasi."</span>";
													echo"<br>";
												}
											}	
										?>
									</td>
									<td><center>
										<input type="text"  name="nilai[<?php echo $s['NOMOR_PENDAFTARAN'] ?>]" class="num form-control input-sm" style="width:60px; margin:0; text-align:right" max= "10" min= "0" value="<?php echo $s['NILAI_PRESTASI']/10?>" onkeypress="return isNumberKey(event)"/>
										<?php /*<select name="nilai[<?php echo $s['NOMOR_PENDAFTARAN'] ?>]" class="form-control input-sm" style="width:60px; margin:0">
											<?php 
												for($j=0;$j<=10;$j+=0.5){
													if(($s['NILAI_PRESTASI']/10)==$j){
														echo"<option value='".($s['NILAI_PRESTASI']/10)."' selected >".$j."</option>";
													}else{
														echo"<option value='".$j."' >".$j."</option>";
													}
												}
											?>	
										</select>*/?>
									</td>
								</tr>
								<?php } ?>
								<?php endforeach ?>
								
							</table>
							<button type="submit" class="btn btn-primary" style="font-size:14px">Simpan Nilai Non Akademik</button>
						</form>	
<script>
$(function () {
   $( ".num" ).keyup(function() {
      var max = parseInt($(this).attr('max'));
      var min = parseInt($(this).attr('min'));
      if ($(this).val() > max)
      {
          alert('Nilai yang anda inputkan melebihi nilai maksimal');
		   $(this).val(min);
      }
      else if ($(this).val() < min)
      {
          alert('Nilai yang anda inputkan kurang dari nilai minimal');
		   $(this).val(min);
      }       
    }); 
});

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
    return true;
}

$('#prodi').on('change', function() {
  var prodi= this.value; 
  window.location.href="<?php echo site_url('snmptn/penilaian/set_prodi/nilai_prestasi')?>/"+prodi;
});</script>	