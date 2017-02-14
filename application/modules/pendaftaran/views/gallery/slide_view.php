

<div id="featured">
			<ul class="ui-tabs-nav">
			<?php
			foreach($slide as $s){
				$j++;
				echo"<li class='ui-tabs-nav-item' >
				<a href='#fragment-".$j."'>
				<img src='".base_url()."/files/photo/small_".$s->image."'  />
				<span>$s->judul</span></a></li>";
				}
			?>	
			</ul>
			<?php
			
			foreach($slide as $s){
			$i++;
			echo"<div id='fragment-".$i."' class='ui-tabs-panel' style=''>";
			echo"<img src='".base_url()."/files/photo/".$s->image."'  />
				<div class='info'>
					<h2><b>$s->judul</b></h2>
					<p>$s->deskripsi</p>"; ?>
				</div>
			</div>
<?php } ?>
		
    
		</div> 