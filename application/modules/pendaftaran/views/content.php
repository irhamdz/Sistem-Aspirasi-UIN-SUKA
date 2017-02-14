<?php
			$this->load->view('page/header');
		?>
			
			<div id="app_content">
			
				</ul>
				<div class="clear10"></div>
				<div class="app-row">
					<div class="col-med-3">
						<?php $this->load->view('pendaftaran/menu');?>
					</div>
					<div class="col-med-9">
						<?php $this->load->view($content);?>
					</div>
					
				</div>
				<div class="clear20"></div>
			</div>
<?php
$this->load->view('page/footer');
?>