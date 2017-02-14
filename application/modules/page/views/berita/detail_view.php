	<script type="text/javascript">
		//GOOGLE
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = '<?php echo base_url()?>asset/social-media/google-platform.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
	</script>
	<script>
		//TWITTER
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="<?php echo base_url()?>asset/social-media/twitter-platform.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
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
		 facebookJS.src = '<?php echo base_url()?>asset/social-media/facebook-platform.js';
		 // Insert the Facebook JS SDK into the DOM
		 firstScriptElement.parentNode.insertBefore(facebookJS, firstScriptElement);
	   }());
	  
	</script>
				

<div  class="article-content">						
	<div class="judul-artikel">
	<a href="<?php echo site_url('page/berita/detail/'.$d->id_berita.'/'.url_title(strtolower($d->judul))) ?>"><?php echo $d->judul ?></a>
	</div>
	<span class="tgl-post"><?php echo nama_hari(substr($d->tgl_posting,0,10)).', '.tanggal_indonesia(substr($d->tgl_posting,0,10)).' '.substr($d->tgl_posting,11,8) ?> WIB <span class="page_counter">Dilihat :  <?php echo $d->counter ?> kali</span></span>
	
	<div class="social-sharing">
		<div class="social-button google">
			<div class="g-plus" data-annotation="bubble" data-action="share"></div>
		</div>
		<div class="social-button facebook">
			<div class="fb-share-button" data-href="<?php echo site_url('page/berita/detail/'.$d->id_berita.'/'.url_title(strtolower($d->judul))) ?>" data-type="button_count"></div>
		</div>
		<div class="social-button twitter">
			<a href="https://twitter.com/share" class="twitter-share-button" data-related="jasoncosta" data-lang="en" data-size="small" data-count="horizontal">Tweet</a>
		</div>	
		<div style="clear:both;"></div>	
	</div>
	
	<?php if($d->foto !=null){?>
	<img src="<?php echo base_url().'media/news/'.$d->foto ?>" />
	<?php } ?>
			
	<div class="isi" style="font-weight:normal">
	<?php 
		$isi=preg_replace('/<p align="center">(&nbsp;|[\s\p{Z}\p{C}\x85\xA0\x{0085}\x{00A0}\x{FFFD}]+)*<\/p>/iu',"",htmlspecialchars_decode($d->isi_berita));
		$isi=preg_replace('/<p>(&nbsp;|[\s\p{Z}\p{C}\x85\xA0\x{0085}\x{00A0}\x{FFFD}]+)*<\/p>/iu',"",$isi);
		$isi=preg_replace('/(&nbsp;)*/iu',"",$isi);
		echo html_entity_decode($isi);
	?>
	</div>

	<div class="fb-like" data-href="<?php echo site_url('page/berita/detail/'.$d->id_berita.'/'.url_title(strtolower($d->judul))) ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
		<div class="related-article left">
		<h4>Berita Terkait</h4>
		<?php if(!empty($rec)):?>
		<?php //print_r($rec);?>
		<ul>
		<?php
		foreach($rec as $r){?>
			<li>
			<a href="<?php echo site_url('page/berita/detail/'.$r->id_berita.'/'.url_title(strtolower($r->judul))) ?>">
			<span class="tgl-post"><?php echo nama_hari($r->tgl_posting).', '.tanggal_indonesia($r->tgl_posting).' '.$r->jam_posting ?> WIB</span>
			<?php echo $r->judul ?></a></li>
		<?php } ?>
		</ul>
		<?php endif?>
	</div>
		<div class="related-article right">
		<h4>Berita Terpopuler</h4>
		<?php if(!empty($pop)):?>
		<ul>
		<?php
		foreach($pop as $r){?>
			<li><a href="<?php echo site_url('page/berita/detail/'.$r->id_berita.'/'.url_title(strtolower($r->judul))) ?>">
			<span class="tgl-post"><?php echo nama_hari(substr($r->tgl_posting,0,10)).', '.tanggal_indonesia(substr($r->tgl_posting,0,10)).' '.$r->jam_posting ?> WIB</span>
			<?php echo $r->judul ?></a></li>
		<?php } ?>
		</ul>
		<?php endif?>
	</div>
</div>

