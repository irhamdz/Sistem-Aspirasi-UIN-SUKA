<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table class="table table-bordered table-hover" width=100%>
			<tbody>
				<thead>
				<tr>
					<th width='10%'>NOMOR UJIAN</th>
					<th width='30%' align='left'>NAMA PESERTA</th>
					<th width='30%' align='left'>JENIS KELAMIN</th>
					<th width='5%'>RAW_MD</th>
					<th width='5%'>MD</th>
					<th width='5%'>RAW_A</th>
					<th width='5%'>A</th>
					<th width='5%'>RAW_B</th>
					<th width='5%'>B</th>
					<th width='5%'>RAW_C</th>
					<th width='5%'>C</th>
					<th width='5%'>RAW_E</th>
					<th width='5%'>E</th>
					<th width='5%'>RAW_F</th>
					<th width='5%'>F</th>
					<th width='5%'>RAW_G</th>
					<th width='5%'>G</th>
					<th width='5%'>RAW_H</th>
					<th width='5%'>H</th>
					<th width='5%'>RAW_I</th>
					<th width='5%'>I</th>
					<th width='5%'>RAW_L</th>
					<th width='5%'>L</th>
					<th width='5%'>RAW_M</th>
					<th width='5%'>M</th>
					<th width='5%'>RAW_N</th>
					<th width='5%'>N</th>
					<th width='5%'>RAW_O</th>
					<th width='5%'>O</th>
					<th width='5%'>RAW_Q1</th>
					<th width='5%'>Q1</th>
					<th width='5%'>RAW_Q2</th>
					<th width='5%'>Q2</th>
					<th width='5%'>RAW_Q3</th>
					<th width='5%'>Q3</th>
					<th width='5%'>RAW_Q4</th>
					<th width='5%'>Q4</th>
					
				</tr>
				</thead>
				<tbody>
				<?php 
				$no=1;
				foreach($kepribadian as $value){ 
				if($value->PMB_JENIS_KELAMIN_PENDAFTAR==1){
					$KELAMIN='PEREMPUAN';
				}else{
					$KELAMIN='LAKI-LAKI';
				}
				?>
					<tr>
						<td align='center' align='center'><?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?></td>
						<td align='left'><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
						<td align='left'><?php echo $KELAMIN; ?></td>
						<td align='center'><?php echo $value->R_MD; ?></td>
						<td align='center'><?php echo $value->MD; ?></td>
						<td align='center'><?php echo $value->R_A; ?></td>
						<td align='center'><?php echo $value->A; ?></td>
						<td align='center'><?php echo $value->R_B; ?></td>
						<td align='center'><?php echo $value->B; ?></td>
						<td align='center'><?php echo $value->R_C; ?></td>
						<td align='center'><?php echo $value->C; ?></td>
						<td align='center'><?php echo $value->R_E; ?></td>
						<td align='center'><?php echo $value->E; ?></td>
						<td align='center'><?php echo $value->R_F; ?></td>
						<td align='center'><?php echo $value->F; ?></td>
						<td align='center'><?php echo $value->R_G; ?></td>
						<td align='center'><?php echo $value->G; ?></td>
						<td align='center'><?php echo $value->R_H; ?></td>
						<td align='center'><?php echo $value->H; ?></td>
						<td align='center'><?php echo $value->R_I; ?></td>
						<td align='center'><?php echo $value->I; ?></td>
						<td align='center'><?php echo $value->R_L; ?></td>
						<td align='center'><?php echo $value->L; ?></td>
						<td align='center'><?php echo $value->R_M; ?></td>
						<td align='center'><?php echo $value->M; ?></td>
						<td align='center'><?php echo $value->R_N; ?></td>
						<td align='center'><?php echo $value->N; ?></td>
						<td align='center'><?php echo $value->R_O; ?></td>
						<td align='center'><?php echo $value->O; ?></td>
						<td align='center'><?php echo $value->R_Q1; ?></td>
						<td align='center'><?php echo $value->Q1; ?></td>
						<td align='center'><?php echo $value->R_Q2; ?></td>
						<td align='center'><?php echo $value->Q2; ?></td>
						<td align='center'><?php echo $value->R_Q3; ?></td>
						<td align='center'><?php echo $value->Q3; ?></td>
						<td align='center'><?php echo $value->R_Q4; ?></td>
						<td align='center'><?php echo $value->Q4; ?></td>
					</tr>
				<?php
				$no ++; } 			
				?>
				</tbody>
				
</table>