<?php $tdy = date('m').date('Y'); 
		$str1t = '<strong>(Selengkapnya)</strong>';
		#print_r($data); 
		
		function url_feed($teks){
			$teks1 = $teks;
			$teks1 = str_replace('/-','/',$teks1);
			#$teks1 = str_replace('/-','/',$teks1);
			#$teks1 = str_replace('.html','',$teks1);
			return $teks1;
			//echo url_feed(str_replace('%LINK%','pengumuman',$data['url_d9']));
		}
		
		function url_feed2($cat, $link){
			$teks1 = $link;
			$teks1 = str_replace('feed',$cat, $teks1);
			$teks1 = str_replace('/-%LINK%.html','', $teks1);
			return $teks1;
		}
		?>
<div class="col-med-3">
	<div class="dis">
		<div class="judul-kolom">
			<a class="rss" href="<?php echo url_feed2('pengumuman', $url_d9); ?>" target="_blank">&nbsp;</a>
			Pengumuman
		</div>
		<div class="list-artikel">
			<?php 
			if($pengumuman2['p2'] == FALSE){
				echo "<span class='tgl-post'>Belum ada pengumuman.</span>";
			}else{ ?>
			<ul>
				<?php foreach($pengumuman2['p2'] as $d): ?>
						<li>
							<?php
							$panjang_judul=strlen($d['PN_JUDUL']);
							 // echo $panjang_judul; die();
							if($panjang_judul>=62){
								$judul = substr($d['PN_JUDUL'], 0, 62)."..."; 
							}else{
								$judul=$d['PN_JUDUL'];
							}
							#echo anchor($d['PN_URL'],$d['PN_JUDUL'],'class="highyellow" title="'.sia_rip_tags($d['PN_JUDUL']).'"');
							$link1 = str_replace('%LINK%',$d['PN_SLUG'], str_replace('/-','/',$url_d10)); echo anchor($link1,$judul,'class="highyellow" title="'.sia_rip_tags($d['PN_JUDUL']).'"');							?>
						</li>
				<?php endforeach; ?>
				</ul>
		<?php } ?>
		</div>	
	</div>	
	<a class="btn-uin btn btn-inverse btn btn-small" style="float:right" href="<?php echo url_feed(str_replace('%LINK%','1',$url_d5)); ?>"><i class="btn-uin"></i>Lainnya &gt;&gt;</a> 
</div>
<div class="col-med-3">
	<div class="dis">
		<div class="judul-kolom">
			<a class="rss" href="<?php echo url_feed2('berita', $url_d9); ?>" target="_blank">&nbsp;</a>
			Berita
		</div>
		<?php foreach($pengumuman2['p3'] as $d): ?>
					<div class="judul-artikel">
					<?php $link1 = str_replace('%LINK%',$d['PN_SLUG'], str_replace('/-','/',$url_d1)); echo anchor($link1,$d['PN_JUDUL'],'class="highyellow" title="'.sia_rip_tags($d['PN_JUDUL']).'"'); ?>
					</div>
					<span class="tgl-post"><?php echo date_trans_foracle($d['PN_TGLLOG_F'],1,'1 231 111',' '); ?> WIB</span>
					<?php if($d['STATUS_FOTO'] == 1): $ctxt = 160; ?>
					<img src="<?php echo admisi_urlfoto($d['URL_FOTO']); ?>" alt="<?php echo $d['PN_JUDUL']; ?>" style="width:90px; margin:0 5px 5px 0; float:left">
					<?php else: $ctxt = 250; endif; ?>
				
					<p class="isi">
						<?php echo character_limiter(sia_rip_tags(base64_decode($d['PN_ISI'])),$ctxt); ?>
						<?php echo anchor($link1,$str1t,'class="highyellow" title="'.sia_rip_tags($d['PN_JUDUL']).'"'); ?>
					</p>
		<?php endforeach; ?>
	</div>
	<a class="btn-uin btn btn-inverse btn btn-small" style="float:right" href="<?php echo url_feed(str_replace('%LINK%','1',$url_d6)); ?>"><i class="btn-uin"></i>Lainnya &gt;&gt;</a> 
</div>
<div class="col-med-3">
	<div class="dis">	
		<div class="judul-kolom">
			<a class="rss" href="<?php echo url_feed2('agenda', $url_d9); ?>" target="_blank">&nbsp;</a>
			Agenda
		</div>
		<?php 
			// echo "<pre>"; 
			// print_r($pengumuman2['p4'][0]['PN_SLUG']); 
			// $OK=count($pengumuman2['p4']);
			// ECHO $OK;
			
			// echo "</pre>"; 
			
			if($pengumuman2['p4'] == FALSE){
					echo "<span class=tgl-post>Belum ada agenda.</span>";
			}else{
				// print_r($pengumuman2['p4']); die();
				foreach($pengumuman2['p4'] as $d):
				
					$ambil_tgl_akhir = explode('#', $d['PN_JUDUL']); #sigit
					$date_exp     = $ambil_tgl_akhir[1];
					$date_exp    = explode(" ",$date_exp); 
					$expiry       = $date_exp[0];
					$today        = date("d-m-Y");
					$todaysDate   = strtotime($today);
					$judul_agenda = explode('#', $d['PN_JUDUL']);
					$expiryDate   = strtotime($expiry);
					// echo $todaysDate;
					// echo "---";
					// echo $expiry;
					// echo "-----<br />";
					
						if($expiryDate>=$todaysDate){
						?><div id="daftar-event">
									<div class="dateblock">
										<div class="day"><?php echo date_trans_foracle($d['PN_TGLASL_F'],1,'0 200 000',' '); ?></div>
										<div class="month"><?php echo date_trans_foracle($d['PN_TGLASL_F'],1,'0 040 000',' '); ?></div>
									</div>
									<div class="datetext">
										<p class="col-title"><?php $link1 = str_replace('%LINK%',$d['PN_SLUG'], str_replace('/-','/',$url_d2));
											echo anchor($link1,$judul_agenda[0],'class="highyellow" title="'.sia_rip_tags($judul_agenda[0]).'"'); ?></p>
									</div>
									<div class="underline-menu"></div>
								</div>
							<?php
					}else{
						// $kosong="<div id='daftar-event'><span class=tgl-post>Belum ada agenda.</span></div>";
					}
				
				endforeach; 
				
			} 
				// if(isset($kosong)){
					// echo $kosong;
					// echo $kosong;
				// }else{
				
				// }
		 ?>
	</div>	
	<a class="btn-uin btn btn-inverse btn btn-small" style="float:right" href="<?php echo url_feed(str_replace('%LINK%','1',$url_d7)); ?>"><i class="btn-uin"></i>Lainnya &gt;&gt;</a> 
</div>
<div class="col-med-3">
	<div class="dis">
		<div class="judul-kolom">
			<a class="rss" href="<?php echo url_feed2('kolom', $url_d9); ?>" target="_blank">&nbsp;</a>
			Kolom
		</div>	
		<?php foreach($pengumuman2['p5'] as $d): ?>		
			<div class="judul-artikel">
				<?php 
						$link1 = str_replace('%LINK%',$d['PN_SLUG'], str_replace('/-','/',$url_d3));
						echo anchor($link1,$d['PN_JUDUL'],'class="highyellow" title="'.sia_rip_tags($d['PN_JUDUL']).'"'); ?>
			</div>
			<span class="tgl-post"><?php echo date_trans_foracle($d['PN_TGLLOG_F'],1,'1 231 111',' '); ?> WIB</span>
			<?php if($d['STATUS_FOTO'] == 1): $ctxt = 150; ?>
						<img src="<?php echo admisi_urlfoto($d['URL_FOTO']); ?>" alt="<?php echo $d['PN_JUDUL']; ?>" style="width:90px;float:left;margin:15px 7px 7px 0;">
			<?php else: $ctxt = 250; endif;  ?>
			<div class="isi">
				<?php echo character_limiter(sia_rip_tags(base64_decode($d['PN_ISI'])),$ctxt); ?>
				<?php echo anchor($link1,$str1t,'class="highyellow" title="'.sia_rip_tags($d['PN_JUDUL']).'"'); ?>
			</div>		
			<?php endforeach; ?>						
	</div>
	<a class="btn-uin btn btn-inverse btn btn-small" style="float:right" href="<?php echo url_feed(str_replace('%LINK%','1',$url_d8)); ?>"><i class="btn-uin"></i>Lainnya &gt;&gt;</a> 

</div>