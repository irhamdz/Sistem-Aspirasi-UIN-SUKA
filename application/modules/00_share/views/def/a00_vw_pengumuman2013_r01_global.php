<?php
	// $this->s00_lib_output->output_crumbs($data['crumbs']); ?>
	<?php #sia_comment($pengumuman1); 
	// echo print_r($pengumuman1); die();
	?>
	<div class="article-content">
				<?php foreach($pengumuman1 as $d1): $d = $d1; ?>
				<div class="news-list">
					<div class="judul-artikel"><?php 
						$link = str_replace('/-','/',$url_d1);
						$link = str_replace('%LINK%',$d[$col_sfx.'SLUG'],$link);
						// if($kat1 == 2):
						// $link = $d[$col_sfx.'URL'];
						// endif;
						#echo $kat1;
						if($kat1==4): #sigit
						$judul_agenda = explode('#', $d[$col_sfx.'JUDUL']);
						$judul_agenda = $judul_agenda[0];
						echo anchor($link,$judul_agenda,'class="" title="'.sia_rip_tags($judul_agenda).'"'); 
						else:
							
							
								echo anchor($link,$d[$col_sfx.'JUDUL'],'class="" title="'.sia_rip_tags($d[$col_sfx.'JUDUL']).'"'); 
							
						endif;
						?>
					</div>
					<div class="tgl-post"><?php echo date_trans_foracle($d[$col_sfx.'TGLLOG_F'],1,'1 231 111',' '); ?> WIB
					<div class="page_counter">Dilihat : <?php echo $d[$col_sfx.'LIHAT']?> Kali</div></div>
					<?php if($kat1==4): ?>
					<table>
						<tbody>
							<tr><td><div style="margin-top:5px;">Hari</div></td><td><div style="margin-top:5px;">&nbsp;:&nbsp;</div></td><td><div style="margin-top:5px;"><?php #sigit
									$hari = date_trans_foracle($d[$col_sfx.'TGLASL_F'],1,'1 231 111',' ');
									$hari = explode(',', $hari);
									echo $hari[0];
									?></div></td></tr>
							<tr><td><div style="margin-top:5px;">Tanggal</div></td><td><div style="margin-top:5px;">&nbsp;:&nbsp;</div></td><td><div style="margin-top:5px;"><?php 
									$tanggal_mulai = date_trans_foracle($d[$col_sfx.'TGLASL_F'],1,'1 231 111',' ');
									$tanggal_mulai = explode(' ', $tanggal_mulai);
									$tanggal_akhir = explode('#', $d[$col_sfx.'JUDUL']);
									$tanggal_akhir = date_trans_foracle($tanggal_akhir[1],1,'1 231 111',' ');
									$tanggal_akhir = explode(' ', $tanggal_akhir);
									echo $tanggal_mulai[1].' '.$tanggal_mulai[2].' '.$tanggal_mulai[3].' s.d. '.$tanggal_akhir[1].' '.$tanggal_akhir[2].' '.$tanggal_akhir[3];
									?></div></td></tr>
							<tr><td><div style="margin-top:5px;">Jam</div></td><td><div style="margin-top:5px;">&nbsp;:&nbsp;</div></td><td><div style="margin-top:5px;"><?php 
									$jam_mulai = $d[$col_sfx.'TGLASL_F'];
									$jam_mulai = explode(' ', $jam_mulai);
									$jam_mulai = explode(':',$jam_mulai[1]);
									$jam_mulai = $jam_mulai[0].':'.$jam_mulai[1].':00';
									
									$jam_akhir = explode('#', $d[$col_sfx.'JUDUL']);
									$jam_akhir = explode(' ', $jam_akhir[1]);
									echo $jam_mulai.' s.d. '.$jam_akhir[1].':00 WIB';
									?></div></td></tr>
							<tr><td><div style="margin-top:5px;">Tempat</div></td><td><div style="margin-top:5px;">&nbsp;:&nbsp;</div></td><td><div style="margin-top:5px;"><?php
										$tempat = explode('#', $d[$col_sfx.'JUDUL']);
										$tempat = $tempat[2];
										echo $tempat;
									?></div></td></tr>
						</tbody>
					</table>
					<?php else: ?>
					<?php if($kat1 != 1): ?>
					<?php if($d['SIZE_FOTO'] > 0): ?>
					<img class="thumb" src="<?php echo admisi_urlfoto($d['URL_FOTO']); ?>" alt="<?php echo $d[$col_sfx.'JUDUL']; ?>">
					<?php endif; ?>
					<?php else: ?>
					<img  class="thumb" src="<?php echo admisi_urlfoto($d['URL_FOTO']); ?>" alt="<?php echo $d[$col_sfx.'JUDUL']; ?>">
					<?php endif; ?>
					<p class="isi" style="font-weight:normal">
						<?php echo character_limiter(sia_rip_tags($d[$col_sfx.'ISI']),300); ?>
					</p>
					<?php endif; ?>
					<div style="clear:both"></div>
					<?php if($kat1==2): #sigit -> if informasi=pengumuman tombol download else selengkapnya?>
					<?php if(1>10): ?><a class="btn-uin btn btn-inverse btn btn-small" href="<?php echo $link; ?>" style="margin: 0; float: right; color: #FFF;">Download>></a> <?php endif; ?>
					<?php else: ?>
					<a class="btn-uin btn btn-inverse btn btn-small" href="<?php echo site_url($link); ?>" style="margin: 0; float: right; color: #FFF;">Selengkapnya>></a>
					<?php endif; ?>
					<div style="clear:both" style="margin-bottom:1%;"></div>
					</div>
				<?php endforeach; ?>
		
	</div>
		<div class="pagination"><?php echo $pagination; ?></div>
		
		 <?php #$this->load->view('00_share/def/a00_vw_pengumuman2013_r03',array('data' => $data)); ?>
		
	<div class="ganjel"></div>