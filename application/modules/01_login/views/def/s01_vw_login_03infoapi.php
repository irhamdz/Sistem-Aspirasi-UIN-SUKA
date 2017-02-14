		<!--
		<?php #print_r($data['api_peng']); print_r($data['api_agenda']); print_r($data['api_berita']); ?>
		-->
		<?php if(1<2): ?>
		<?php if($this->session->userdata('app') == 'login'): ?>
		<?php #print_r(); ?>
				<div id="system-content-4-kolom">
					<hr><div id="separate2"></div>
					
						<!-- Kolom Pengumuman -->	
					<div class="menu-kolom-besar">
						<h3 class="judul">Pengumuman</h3><br>
						<ul id="sia_front_p01" class="list-kolom">
							
							<?php if(1<1): ?>
							<?php $total = count($data['api_peng']);
							$d = $data['api_peng'];
							for($j = 0; $j < ($total); $j++): ?>
							<li class="home"><div class="title"><?php 
							$jd = $d[$j]['judul']; #preg_replace('/[^A-Za-z0-9_-\s]+/', '', $d[$j]['judul']);
							echo anchor($d[($j)]['url'], character_limiter($jd,40),'title="'.$jd.'"'); ?></div>
							<div class="pojok <?php echo strtolower($d[$j]['jenis']);?>"></div>
							<div class="underline-menu"></div></li>
							<?php endfor; ?>
							<?php endif; ?>
							
						</ul>
					</div>
					<!-- <?php #echo json_encode($data['api_peng']); ?>-->
		<!-- Kolom Berita -->	
					<div class="menu-kolom-besar">
						<h3 class="judul">Berita</h3><br>
						<ul id="sia_front_p02" class="list-kolom">
							
							<?php if(1<1): ?>
							<!-- to iterate #3 -->
							<?php $total = count($data['api_berita']);
							$d = $data['api_berita'];
							for($j = 0; $j < ($total); $j++): ?>
							<?php #foreach ($$data['api_berita'] as $d): ?>
							<li class="home"><div class="title"><?php 
							$jd = $d[$j]['judul']; #preg_replace('/[^A-Za-z0-9_-\s]+/', '', $d[$j]['judul']);
							echo anchor($d[$j]['url'], character_limiter($jd,40),'title="'.$jd.'"'); ?></div>
							<div class="pojok <?php echo strtolower($d[$j]['jenis']);?>"></div>
							<div class="underline-menu"></div></li>
							<?php endfor; #endforeach; ?>
							<!-- end iterate #3 -->
							<?php endif; ?>
							
						</ul>
					 
					<!--	<a class="button_org black" style="margin-left:10%" href="#"><i class="btn-uin"></i> Lainnya>></a> -->
					</div>
					
					<div class="menu-kolom-besar">
						<h3 class="judul">Agenda</h3><br>
						<div id="sia_front_p03" id="daftar-event">
							<?php if(2<2): ?>
							<?php $d = $data['api_agenda']; for($j = 0; $j < (count($data['api_agenda'])); $j++): ?>
							<!-- to iterate #1 -->
							<div class="dateblock">
								<?php if(1<2): 
								$tglfull = date('d/m/Y h:i:s',strtotime($d[$j]['tanggal']));
								$tgl1 = date_trans_foracle($tglfull, 1, '0 200 000', ' ');
								$tgl2 = date_trans_foracle($tglfull, 1, '0 030 000', ' ');
								?>
								<div class="day"><?php echo $tgl1; ?></div>
								<div class="month"><?php echo substr($tgl2,0,3); ?></div>
								<?php endif; ?>
							</div>
							<div class="datetext">
								<p class="col-title" style="text-align:left;"><?php echo anchor($d[$j]['url'],character_limiter($d[$j]['nama_agenda'],40),'title="'.$d[$j]['nama_agenda'].'"'); ?></p>
								<div class="divline-solid nopadtop"></div>
							</div>
							<div class="underline-menu"></div>
							<!-- end iterate #1 -->
							<?php endfor; ?>
							<?php endif; ?>
						</div>
						
					</div>
					
	

		<!-- Kolom Kuis -->	
					<div class="menu-kolom-besar">
						<img src="<?php echo base_url('asset/img/banner_uin_sementara.jpg'); ?>">
						<?php if(1<0): ?>
						<h3 class="judul">Kuis Kenali Kampusku</h3><br>
						<p>Dimanakah tempat ini ?</p>
						<img src="{QT1}" style="max-height:180px;">
						<div id="separate"></div>
						<?php endif; ?>
					</div>
					
					<div style="clear:both;"></div>
					
					<div class="menu-kolom-besar"><a class="btn-uin btn btn-inverse btn btn-small" style="float:right" href="http://www.uin-suka.ac.id/pengumuman/arsip"><i class="btn-uin"></i>Lainnya>></a></div>
					
					<div class="menu-kolom-besar"><a class="btn-uin btn btn-inverse btn btn-small" style="float:right" href="http://www.uin-suka.ac.id/berita/arsip"><i class="btn-uin"></i>Lainnya>></a></div>
					
					<!-- Tombol untuk kolom AGENDA -->
					<div class="menu-kolom-besar">&nbsp;
						<?php if(1<0): ?>
						<a class="btn-uin btn btn-inverse btn btn-small" style="float:right" href="#"><i class="btn-uin"></i>Lainnya>></a>
						<?php endif; ?>
					</div>
										
					<div class="menu-kolom-besar">
						<?php if(1<0): ?>
						<a class="btn-uin btn btn-inverse btn btn-small" style="float:right" href="#"><i class="btn-uin"></i>Jawab</a>
						<?php endif; ?>
					</div>
				</div>
			
			<?php endif; ?>
			<?php endif; ?>