
				
		
					
					
							<div style="overflow-x:auto">
								
							<table style="width:150%" class="table table-bordered table-hover">
								<tr>
									<th width="10px"><center>No</center></th>
									<th width="40px"><center>NIM</center></th>
									<th width="40px"><center>NAMA</center></th>
									<?php foreach($dokumen as $d){?>
									<td><?php echo $d['NAMA_SINGKAT'] ?></td>
									<?php } ?>
								</tr>	
								<?php $i=0 ?>
								<?php foreach($mhs as $m):?>
								<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><?php echo $m['NIM']?></td>
									<td><?php echo $m['NAMA']?></td>
									<?php foreach($dokumen as $d){?>
									<td style="text-align:center"> <?php if(isset($arr_ceklist[$m['NIM']][$d['KODE_DOKUMEN']]) and $arr_ceklist[$m['NIM']][$d['KODE_DOKUMEN']]) echo "<img src='".base_url()."asset/img/centang.png'/>"; ?></td>
									<?php } ?>
								</tr>
								<?php endforeach ?>
								
							</table>
						</div>



	<script>

		$('#prodi').on('change', function() {
		  var prodi= this.value; 
		  window.location.href="<?php echo site_url('registrasi/rekap/set_prodi/ceklist')?>/"+prodi;
		});
		

	</script>