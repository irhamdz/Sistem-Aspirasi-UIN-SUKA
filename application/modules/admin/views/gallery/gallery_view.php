
	<script type="text/javascript" src="<?php echo base_url()?>asset/fancybox/lib/jquery-1.10.1.min.js"></script>
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="<?php echo base_url()?>asset/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url()?>asset/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>asset/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="<?php echo base_url()?>asset/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>


	<script type="text/javascript">
		$(document).ready(function() {

			$('.fancybox').fancybox();

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}

	</style>
	<?php foreach($album as $a){?>
	<h3><span><?php echo $a->nama_album?></span></h3>
	<?php } ?>
	<p>
		<?php foreach($gallery as $g){
			echo"	<a class='fancybox-buttons' data-fancybox-group='button' href='".base_url()."files/gallery/".$g->id_album."/$g->image'><img src='".base_url()."files/gallery/".$g->id_album."/$g->image' width='185' alt='' /></a>";
        }
		?>
	</p>

