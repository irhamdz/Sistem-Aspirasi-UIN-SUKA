	 <?php //print_r($artikel); die();?>
	<script type="text/javascript">
		//GOOGLE
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'http://uin-suka.ac.id/asset/social-media/google-platform.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
	</script>
	<script>
		//TWITTER
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="http://uin-suka.ac.id/asset/social-media/twitter-platform.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
	</script>
	<script>
		//FACEBOOK
		window.fbAsyncInit = function() {
			FB.init({
				  appId      : 'YOUR_APP_ID',                        // App ID from the app dashboard
				  status     : true,                                 // Check Facebook Login status
				  xfbml      : true                                  // Look for social plugins on the page
			});
		};
	  (function(){
		 // If we've already installed the SDK, we're done
		 if (document.getElementById('facebook-jssdk')) {return;}
		 // Get the first script element, which we'll use to find the parent node
		 var firstScriptElement = document.getElementsByTagName('script')[0];
		 // Create a new script element and set its id
		 var facebookJS = document.createElement('script'); 
		 facebookJS.id = 'facebook-jssdk';
		 // Set the new script's source to the source of the Facebook JS SDK
		 facebookJS.src = 'http://uin-suka.ac.id/asset/social-media/facebook-platform.js';
		 // Insert the Facebook JS SDK into the DOM
		 firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
	   }());
	</script>
	<?php 
	$acak = md5(date('s')); 
	$kat1 = explode('#',$tk_kat1);
	#sigit -> detail pengumuman
	$kondisi_url = explode("-", $this->security->xss_clean($this->uri->segment(2)));
	$judul_arsip = ucfirst($kondisi_url[0]);
	$data['artikel']=$artikel;
	foreach($data['artikel'] as $d):
			if($kat1[0]==4):
				$judul_informasi = explode('#', $d[$col_sfx.'JUDUL']);
				$judul_informasi = $judul_informasi[0];
			else:
				$judul_informasi = $d[$col_sfx.'JUDUL'];
			endif;
	endforeach;
	// echo "<ul id='crumbs'><li><a href='".base_url()."beranda' title='Beranda'>Beranda</a></li><li><a href='".base_url()."informasi/".$kondisi_url[0]."-arsip/1.html' title='".$judul_arsip."'>".$judul_arsip."</a></li><li>".$judul_informasi."</li></ul>";
	
	#$this->s00_lib_output->output_crumbs($data['crumbs']); 
	?>
	<?php #echo print_r($data); 
	foreach($data['artikel'] as $d): ?>
	<?php 
			$judul="";
			if($kat1[0]==4): #sigit
			$judul_agenda = explode('#', $d[$col_sfx.'JUDUL']);
			$judul_agenda = $judul_agenda[0];
			$judul=$judul_agenda; 
			else:
			$judul=$d[$col_sfx.'JUDUL'];
			
			endif;
			?>
	<div class="article-content">
		<div class="judul-artikel"><a href="#"><?php echo $judul; ?></a></div>
		<div class="tgl-post">
					<?php echo date_trans_foracle($d[$col_sfx.'TGLLOG_F'],1,'1 231 111',' '); ?> WIB
					<div class="page_counter">Dilihat : <?php echo $d[$col_sfx.'LIHAT']; ?> kali</div>
				</div>
		<div class="ganjel"></div>
		<div class="social-sharing">
					<div class="social-button google" style="margin-right: 2px;">
						<div class="g-plus" data-annotation="bubble" data-action="share"></div>
					</div>
					<div class="social-button facebook" style="margin-right: 5px;">
						<div class="fb-share-button" data-href="<?php echo current_url(); ?>" data-type="button_count"></div>
					</div>
					<div class="social-button twitter">
						<a href="https://twitter.com/share" class="twitter-share-button" data-related="jasoncosta" data-lang="en" data-size="small" data-count="horizontal">Tweet</a>
					</div>	
		</div>
		
		<?php if($kat1[0] !== '4'){ ?>
				<?php if($d['STATUS_FOTO'] == 1): ?>
					<img src="<?php echo admisi_urlfoto($d['URL_FOTO']); ?>" alt="<?php echo $d[$col_sfx.'JUDUL']; ?>" class="news-img-000">
				<?php endif; ?>
		<?php } ?>
			<div class="news-content-000 uniqcl-<?php echo str_shuffle($acak); ?>">
			<?php if($kat1[0] == '4'): ?>
			<div class="isi">
			<table width="100%">
					<tbody>
						<tr>
							<td><div style="margin-top:5px;">Hari</div></td>
							<td><div style="margin-top:5px;">:</div></td>
							<td><div style="margin-top:5px;"><?php #sigit
										$hari = date_trans_foracle($d[$col_sfx.'TGLASL_F'],1,'1 231 111',' ');
										$hari = explode(',', $hari); echo $hari[0];?>
								</div>
							</td>
						</tr>
						<tr>
							<td><div style="margin-top:5px;">Tanggal</div></td>
							<td><div style="margin-top:5px;">:</div></td>
							<td><div style="margin-top:5px;"><?php 
									$tanggal_mulai = date_trans_foracle($d[$col_sfx.'TGLASL_F'],1,'1 231 111',' ');
									$tanggal_mulai = explode(' ', $tanggal_mulai);
									$tanggal_akhir = explode('#', $d[$col_sfx.'JUDUL']);
									$tanggal_akhir = date_trans_foracle($tanggal_akhir[1],1,'1 231 111',' ');
									$tanggal_akhir = explode(' ', $tanggal_akhir);
									echo $tanggal_mulai[1].' '.$tanggal_mulai[2].' '.$tanggal_mulai[3].' s.d. '.$tanggal_akhir[1].' '.$tanggal_akhir[2].' '.$tanggal_akhir[3];?>
								</div>
							</td>
						</tr>
						<tr>
							<td><div style="margin-top:5px;">Jam</div></td>
							<td><div style="margin-top:5px;">:</div></td>
							<td><div style="margin-top:5px;"><?php 
										$jam_mulai = $d[$col_sfx.'TGLASL_F'];
										$jam_mulai = explode(' ', $jam_mulai);
										$jam_mulai = explode(':',$jam_mulai[1]);
										$jam_mulai = $jam_mulai[0].':'.$jam_mulai[1].':00';
										
										$jam_akhir = explode('#', $d[$col_sfx.'JUDUL']);
										$jam_akhir = explode(' ', $jam_akhir[1]);
										echo $jam_mulai.' s.d. '.$jam_akhir[1].':00 WIB';?>
								</div>
							</td>
						</tr>
						<tr>
							<td><div style="margin-top:5px;">Tempat</div></td>
							<td><div style="margin-top:5px;">:</div></td>
							<td><div style="margin-top:5px;"><?php
									$tempat = explode('#', $d[$col_sfx.'JUDUL']);
									$tempat = $tempat[2];
									echo $tempat;?>
								</div>
							</td>
						</tr>
						<tr>
							<td valign="top"><div style="margin-top:5px;">Deskripsi</div></td>
							<td valign="top"><div style="margin-top:5px;"> : </div></td>
							<td><div style="margin-top:5px;">-</div></td>
						</tr>									
						<tr>
							<td colspan="3"><div style="margin-top:5px;">				
								<?php if($d['STATUS_FOTO'] == 1): ?>
									<img src="<?php echo admisi_urlfoto($d['URL_FOTO']); ?>" alt="<?php echo $d[$col_sfx.'JUDUL']; ?>" class="news-img-000">
									<?php endif; ?>
								</div>
							</td>
						</tr>				
					</tbody>
			</table>
			</div>
			<?php else: ?>
			<?php if($d['PN_KAT1']==2){ #ayar
					echo "<br /><br />";
					// echo "<div>pengumuman</div>"; 
					// echo $d['PN_KAT1'];
					$url=explode('/',$d['PN_URL']);
					$url=$url[2];
					if($url=="admisi.uin-suka.ac.id"){ ?>
						<iframe width="100%" height="500" src="<?php echo $d['PN_URL']; ?>">
							<html>
								<body marginwidth="0" marginheight="0" style="background-color: rgb(38,38,38)">
									<embed width="100%" height="100%" name="plugin" src="<?php echo $d['PN_URL']; ?>" type="application/pdf">
								</body>
							</html>
						</iframe>
						<a class="btn-uin btn btn-inverse btn btn-small" style="float:right" href="<?php echo $d['PN_URL']; ?>"><i class="btn-uin"></i>Download</a>
					<?php }else{ ?>
							<?php redirect($d['PN_URL']);?>
					<?php } ?>
					
					<?php
			}else{ ?>
			<?php echo base64_decode($d[$col_sfx.'ISI']); }?>
			<?php endif; ?>
		</div>
		<div style="clear:both"></div>
		<div class="fb-like" data-href="<?php echo current_url(); ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
		<?php  if(1<10): 

		 //print_r($artikel_terkait); die(); ?>	
			<div class="related-article left">
				<?php if(!empty($artikel_terkait)){ #sigit ?>
					<h4><?php echo $tk_kat2; ?> Terkait</h4>
					<ul><?php 
							// print_r($artikel_terkait);
							foreach($artikel_terkait as $d):
							if($kat1[0]==4):$link_terkait = explode('#', $d[$col_sfx.'JUDUL']);$link_terkait = $link_terkait[0];else: $link_terkait = $d[$col_sfx.'JUDUL'];endif;
								if($link_terkait!==$judul_informasi){
										echo "<li>"; ?><?php echo "<a href='".base_url()."informasi/".$this->security->xss_clean($this->uri->segment(2))."/".$d[$col_sfx.'SLUG'].".html'>"; ?>
										<div class="tgl-post"><?php echo date_trans_foracle($d[$col_sfx.'TGLLOG_F'],1,'1 231 111',' '); ?> WIB</div>
										<?php echo $link_terkait; ?></a></li><?php 
								}
							endforeach;?>		
					</ul>
				<?php }else{  ?>
						<h4><?php echo $tk_kat2." Terkait"; ?> </h4>
				<?php } ?>
			</div>
			<div class="related-article right">
			<?php #print_r($artikel_populer); 
			if(!empty($artikel_populer)){ #sigit ?>
				<h4><?php echo $tk_kat2; ?> Terpopuler</h4>
				<ul><?php 
						// print_r($artikel_populer);
						foreach($artikel_populer as $d):
							if($kat1[0]==4):
								$link_terkait = explode('#', $d[$col_sfx.'JUDUL']);
								$link_terkait = $link_terkait[0];
							else:
								$link_terkait = $d[$col_sfx.'JUDUL'];
							endif;
						// if($link_terkait!==$judul_informasi){
							echo "<li>"; ?>
							<?php echo "<a href='".base_url()."informasi/".$this->security->xss_clean($this->uri->segment(2))."/".$d[$col_sfx.'SLUG'].".html'>"; ?>
							<div class="tgl-post"><?php echo date_trans_foracle($d[$col_sfx.'TGLLOG_F'],1,'1 231 111',' '); ?> WIB</div>
							<?php echo $link_terkait; ?></a>
							</li>
							<?php //}
						endforeach;?>		
				</ul>
			<?php }else{?>
					<h4><?php echo $tk_kat2." Populer"; ?> </h4>
			<?php } ?>
			</div>
		<?php endif;  ?>
	</div>
	<?php endforeach; ?>
		 <?php #$this->load->view('00_share/def/a00_vw_pengumuman2013_r03',array('data' => $data)); ?>
	
	<div class="ganjel"></div>