		<script type="text/javascript" src="<?php echo base_url($this->config->item('app_dir_asset_js').'jquery.cookie.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url($this->config->item('app_dir_asset_js').'dynatree.js'); ?>"></script>
		<script type="text/javascript">
		$(function(){
		
		function tmp_embed_siteurl($teks){
			$url1 = '<?php echo site_url('informasi/ajax01/')?>/';
			return $url1+$teks;
		}
		
		// ARSIP LIPUTAN
		$("#sia-blog_area-ajaxarsip-1").dynatree({
			autoFocus: false, icon:false,
			initAjax: {
				url: "<?php echo site_url('informasi/ajax01/'.t1_encode('1701#1'))?>"
				},

			onActivate: function(node) {
			node.find('li').attr('data',"addClass: 'ws-wrap'");
				if(node.data.find('a').attr('href')){
					window.open(node.data.href, node.data.target);
				}
				$("#echoActive").text("" + node + " (" + node.getKeyPath()+ ")");
			},
			
			onLazyRead: function(node){ console.log(node.getKeyPath());
			var key=node.getKeyPath().split('/'); 
				$url2 = tmp_embed_siteurl(key[2]); console.log($url2);
				node.appendAjax({
					url: $url2,
					debugLazyDelay: 250
				});
			}
		});
		
		$("#sia-blog_area-ajaxarsip-2").dynatree({
			autoFocus: false, icon:false,
			initAjax: {
				url: "<?php echo site_url('informasi/ajax01/'.t1_encode('1702#1'))?>"
				},

			onActivate: function(node) {
			node.find('li').attr('data',"addClass: 'ws-wrap'");
				if(node.data.find('a').attr('href')){
					window.open(node.data.href, node.data.target);
				}
				$("#echoActive").text("" + node + " (" + node.getKeyPath()+ ")");
			},
			
			onLazyRead: function(node){ console.log(node.getKeyPath());
			var key=node.getKeyPath().split('/'); 
				$url2 = tmp_embed_siteurl(key[2]); console.log($url2);
				node.appendAjax({
					url: $url2,
					debugLazyDelay: 250
				});
			}
		});
		
		$("#sia-blog_area-ajaxarsip-3").dynatree({
			autoFocus: false, icon:false,
			initAjax: {
				url: "<?php echo site_url('informasi/ajax01/'.t1_encode('1703#1'))?>"
				},

			onActivate: function(node) {
			node.find('li').attr('data',"addClass: 'ws-wrap'");
				if(node.data.find('a').attr('href')){
					window.open(node.data.href, node.data.target);
				}
				$("#echoActive").text("" + node + " (" + node.getKeyPath()+ ")");
			},
			
			onLazyRead: function(node){ console.log(node.getKeyPath());
			var key=node.getKeyPath().split('/'); 
				$url2 = tmp_embed_siteurl(key[2]); console.log($url2);
				node.appendAjax({
					url: $url2,
					debugLazyDelay: 250
				});
			}
		});
		
		$("#sia-blog_area-ajaxarsip-4").dynatree({
			autoFocus: false, icon:false,
			initAjax: {
				url: "<?php echo site_url('informasi/ajax01/'.t1_encode('1704#1'))?>"
				},

			onActivate: function(node) {
			node.find('li').attr('data',"addClass: 'ws-wrap'");
				if(node.data.find('a').attr('href')){
					window.open(node.data.href, node.data.target);
				}
				$("#echoActive").text("" + node + " (" + node.getKeyPath()+ ")");
			},
			
			onLazyRead: function(node){ console.log(node.getKeyPath());
			var key=node.getKeyPath().split('/'); 
				$url2 = tmp_embed_siteurl(key[2]); console.log($url2);
				node.appendAjax({
					url: $url2,
					debugLazyDelay: 250
				});
			}
		});
		
		$("#sia-blog_area-ajaxarsip-5").dynatree({
			autoFocus: false, icon:false,
			initAjax: {
				url: "<?php echo site_url('informasi/ajax01/'.t1_encode('1705#1'))?>"
				},

			onActivate: function(node) {
			node.find('li').attr('data',"addClass: 'ws-wrap'");
				if(node.data.find('a').attr('href')){
					window.open(node.data.href, node.data.target);
				}
				$("#echoActive").text("" + node + " (" + node.getKeyPath()+ ")");
			},
			
			onLazyRead: function(node){ console.log(node.getKeyPath());
			var key=node.getKeyPath().split('/'); 
				$url2 = tmp_embed_siteurl(key[2]); console.log($url2);
				node.appendAjax({
					url: $url2,
					debugLazyDelay: 250
				});
			}
		});
		
		});
		</script>
		<?php if($this->session->userdata('id_user') != '198606252012111KKKx'): ?>

		<div class="bg-sidebar">
		<div class="head-sidebar">Arsip Liputan</div>
			<div id="sia-blog_area-ajaxarsip-1"></div>
			<div class="cleaner_h10"></div>	
		</div>
		
		<div class="bg-sidebar">
		<div class="head-sidebar">Arsip Pengumuman</div>
			<div id="sia-blog_area-ajaxarsip-2"></div>
			<div class="cleaner_h10"></div>	
		</div>
		
		<div class="bg-sidebar">
		<div class="head-sidebar">Arsip Berita</div>
			<div id="sia-blog_area-ajaxarsip-3"></div>
			<div class="cleaner_h10"></div>	
		</div>
		
		<div class="bg-sidebar">
		<div class="head-sidebar">Arsip Agenda</div>
			<div id="sia-blog_area-ajaxarsip-4"></div>
			<div class="cleaner_h10"></div>	
		</div>
		
		<div class="bg-sidebar">
		<div class="head-sidebar">Arsip Kolom</div>
			<div id="sia-blog_area-ajaxarsip-5"></div>
			<div class="cleaner_h10"></div>	
		</div>
		<?php endif; ?>		