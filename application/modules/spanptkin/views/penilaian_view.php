<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=Nilai_mapel_".str_replace(' ','_',$this->session->userdata('prodi')).".xls"); 
?>
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
						<?php $mapel=$this->db->query("SELECT kode,mata_pelajaran from jenis_mata_pelajaran where kode not like '%0%' and kode not like '%1%' order by kode asc")->result(); 
				
						?>				
						<div style="font-weight:bold; margin:10px 0;">Program Studi : <?php echo $this->session->userdata('prodi'); ?></div>
					
							<table border="1" style="width:940px" class="table table-bordered table-hover">
								<tr>
									<th width="10px"><center>No</center></th>
									<th><center>No Pendaftaran</center></th>
									<th><center>Nama Siswa</center></th>
									<?php 
										foreach($mapel as $mp){
												echo"<th><center>".$mp->mata_pelajaran."</center></th>";
										}	
									?>
									
								</tr>	
								<?php $i=0 ?>
								<?php foreach($siswa as $s):?>
								<input type="hidden" name="nomor_pendaftaran[]" value="<?php echo $s->nomor_pendaftaran ?>" />
								<tr>
									<td><center><?php echo ++$i ?></center></td>
									<td><?php echo $s->nomor_pendaftaran ?></td>
									<td><?php echo $s->nama_siswa ?></td>
									
										<?php
											
											foreach($mapel as $mp){
											$nilai=$this->db->query("SELECT kode_mata_pelajaran, sum(nilai)/5 as nilai FROM `nilai2` 
											where  kode_mata_pelajaran='".$mp->kode."' and nomor_pendaftaran='".$s->nomor_pendaftaran."'")->result();
												foreach($nilai as $n){
												echo"<td>".$n->nilai."</td>";
												}
											}			
										// $nilai=$this->db->select('*')->from('prestasi')->where(array('nomor_pendaftaran'=>$s->nomor_pendaftaran))->get();
											// echo"<ul>";
											// foreach($prestasi->result() as $p){
												// echo"<li>".$p->jenis_prestasi."( <a href='".base_url()."dokumen/Prestasi_Siswa/".$p->file_sertifikat."' style='color:#229944' target='_blank' >".$p->id_prestasi."</a> ) - ".$p->jenjang_prestasi."</li>";
											// }
											// echo"</ul>";
										
										
										?>
									
									
								</tr>
								<?php endforeach ?>
								
							</table>
						