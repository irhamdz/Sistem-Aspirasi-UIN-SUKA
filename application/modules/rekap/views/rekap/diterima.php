<div id="system-content">	
	<div id="content-space">
		<div style="font-weight:bold; margin:10px 0;"><h3>JUMLAH DITERIMA PROGRAM STUDI </h3></div>
			<?php if(isset($diterima) and !empty($diterima)){ ?>
			<?php foreach($diterima as $fakultas=>$arr_prodi){ ?>
				<h3><?php echo $fakultas ?></h3>
				<table style="width:600px" class="table table-bordered table-hover">
					<tr>
						<th width="64%"><center>Jurusan/Program Studi</center></th>
						<th width="12%"><center>Pilihan 1</center></th>
						<th width="12%"><center>Pilihan 2</center></th>
						<th width="12%"><center>Jumlah</center></th>
					</tr>	
					<?php foreach($arr_prodi as $prodi=>$arr_diterima){?>
						<tr>
							<td><?php echo $prodi ?></td>
							
					<?php $jp=@$arr_diterima->{1}->jumlah+@$arr_diterima->{2}->jumlah+@$arr_diterima->{3}->jumlah; ?>
					
						<td style="text-align:right"><?php if(!empty($arr_diterima->{1}->jumlah)) echo $arr_diterima->{1}->jumlah; else echo '0' ?></td>
						<td style="text-align:right"><?php if(!empty($arr_diterima->{2}->jumlah)) echo $arr_diterima->{2}->jumlah; else echo '0' ?></td>
						
						<td style="text-align:right"><?php echo $jp ?></td>
						</tr>
					<?php } ?>
				</table>	
				<?php } ?>
				<?php } ?>
	</div>	
</div>			

