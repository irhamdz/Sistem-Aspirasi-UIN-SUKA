
<link href="http://localhost/st/lib/style_slide.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://localhost/st/lib/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="http://localhost/st/lib/jquery.tools.js"></script>							
		
							<div class="top">
								
								
								<div class="scrollable">
								<div class="items">
								
<?php foreach ($slide as $s){ ?>
	<div class="item">
		<div class="top_img"><img src="<?php echo base_url().'files/photo/'.$s->image; ?>" height="220"></div>
		<div class="top_right">
         <div class="banner-text">
              <h3><?php echo $s->judul; ?></h3>
              <p><?php echo $s->deskripsi;?></p>
         </div>
		</div>
	</div>
<?php } ?>
								</div> <!-- items -->
							</div> <!-- scrollable -->
							 <!-- create automatically the point dor the navigation depending on the numbers of items -->		   
							  
								<div style="clear: both"></div>					
											
							</div> 
     <div id="templatemo_main">
		<div class="main_top">
			<div class="navi"></div>
			
		</div>