<?php if(!empty($kepribadian)){ ?>
<a class='btn' href='http://admisi.uin-suka.ac.id/adminpmb/admlaporan-hasil_kepribadian/download/<?php echo $TAHUN; ?>/<?php echo $GELOMBANG; ?>'><i class='icon-download'></i> Download</a><br /><br /> 
<?php } ?>
<table class="table table-bordered table-hover" width=100%>
			<tbody>
				<thead>
				<tr>
					<th width='10%' ROWSPAN='2'>NOMOR UJIAN</th>
					<th width='30%' ROWSPAN='2' align='left'>Nama Peserta</th>
					<th colspan='17'>HASIL</th>
				</tr>
				<tr>
					<th width=''>MD</th>
					<th width=''>A</th>
					<th width=''>B</th>
					<th width=''>C</th>
					<th width=''>E</th>
					<th width=''>F</th>
					<th width=''>G</th>
					<th width=''>H</th>
					<th width=''>I</th>
					<th width=''>L</th>
					<th width=''>M</th>
					<th width=''>N</th>
					<th width=''>O</th>
					<th width=''>Q1</th>
					<th width=''>Q2</th>
					<th width=''>Q3</th>
					<th width=''>Q4</th>
					
				</tr>
				</thead>
				<tbody>
				<?php 
				$no=1;
				foreach($kepribadian as $value){ 
				?>
					<tr>
						<td align='center' align='center'><?php echo $value->PMB_NO_UJIAN_PENDAFTAR; ?></td>
						<td align='left'><?php echo $value->PMB_NAMA_LENGKAP_PENDAFTAR; ?></td>
						<td align='center'><?php echo $value->MD; ?></td>
						<td align='center'><?php echo $value->A; ?></td>
						<td align='center'><?php echo $value->B; ?></td>
						<td align='center'><?php echo $value->C; ?></td>
						<td align='center'><?php echo $value->E; ?></td>
						<td align='center'><?php echo $value->F; ?></td>
						<td align='center'><?php echo $value->G; ?></td>
						<td align='center'><?php echo $value->H; ?></td>
						<td align='center'><?php echo $value->I; ?></td>
						<td align='center'><?php echo $value->L; ?></td>
						<td align='center'><?php echo $value->M; ?></td>
						<td align='center'><?php echo $value->N; ?></td>
						<td align='center'><?php echo $value->O; ?></td>
						<td align='center'><?php echo $value->Q1; ?></td>
						<td align='center'><?php echo $value->Q3; ?></td>
						<td align='center'><?php echo $value->Q3; ?></td>
						<td align='center'><?php echo $value->Q4; ?></td>
					</tr>
				<?php $no++; 
				} 			
				?>
				</tbody>
				
</table>