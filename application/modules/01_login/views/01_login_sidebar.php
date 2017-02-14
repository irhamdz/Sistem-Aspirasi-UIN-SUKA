<!-- <?php #echo strtotime('10-08-2000'); #echo t1_encode('09650017'); ?>-->
<?php
	error_reporting(0);
	$app_category = $in_data['app_category']; 
	if($app_category == '01_login'):
		// if($in_data['data']['menu_logon']):
		$this->load->view('01_login/def/s01_vw_login_01form',	array('in_data' => $in_data));
		// endif;
	else:
?>
	<?php /* tambah $this->session->userdata('praregistrasi_nama') => adi wirawan / 28/05/2014 */?>	
	<?php if($this->session->userdata('id_user') != '' or $this->session->userdata('praregistrasi_nama')!=''): ?>
			<?php if($this->session->userdata('status')): 
	?>
			<li>
				<?php 
				if($this->session->userdata('status') != 'staff'){ 
				if($this->session->userdata('status')=='matrikulasi'){
					$status="matrikulasi_ln";
					$foto=$this->session->userdata('pin');
					if($this->session->userdata('nama_pendaftar')=='-'){
						$nama='';
						$email=$this->session->userdata('id_user');
					}else{
						$nama=$this->session->userdata('nama_pendaftar');
						$email=$this->session->userdata('id_user');
					}
					
				}elseif($this->session->userdata('status')=='pmb'){
					$status=$this->session->userdata('status');
					if($this->session->userdata('gelombang')=='DEFAULT'){
						$foto="default";
					}else{
						if($this->session->userdata('jenis_penerimaan')==1){
						$foto=$this->session->userdata('id_user')."-foto-1";
						}elseif($this->session->userdata('jenis_penerimaan')==9){
						$foto=$this->session->userdata('id_user')."-foto-9";	
						}
					}
					if(empty($this->session->userdata('nama_pendaftar'))){
						$nama='';
						$email=$this->session->userdata('id_user');
					}else{
						$nama=$this->session->userdata('nama_pendaftar');
						$email=$this->session->userdata('id_user');
					}
				}elseif($this->session->userdata('status')=='s2'){
					$status=$this->session->userdata('status');
					
					if($this->session->userdata('gelombang')=='DEFAULT'){
						$foto="default";
					}else{
						$foto=$this->session->userdata('id_user')."-foto-2";
					}
					
					if(empty($this->session->userdata('nama_pendaftar'))){
						$nama='';
						$email=$this->session->userdata('id_user');
					}else{
						$nama=$this->session->userdata('nama_pendaftar');
						$email=$this->session->userdata('id_user');
					}
				}else{
					$jenis_penerimaan=$this->session->userdata('jenis_penerimaan');
					$status=$this->session->userdata('status');
					// $foto=$this->session->userdata('id_user')."-foto-3";
					
					if($this->session->userdata('gelombang')=='DEFAULT'){
						$foto="default";
					}else{
						$foto=$this->session->userdata('id_user')."-foto-".$jenis_penerimaan."";
					}
					
					if(empty($this->session->userdata('nama_pendaftar'))){
						$nama='';
						$email=$this->session->userdata('id_user');
					}else{
						$nama=$this->session->userdata('nama_pendaftar');
						$email=$this->session->userdata('id_user');
					}
					
				}
				// }elseif($this->session->userdata('status')=='s3'){
					// $status=$this->session->userdata('status');
					// $foto=$this->session->userdata('id_user')."-foto-3";
					// if(empty($this->session->userdata('nama_pendaftar'))){
						// $nama='';
						// $email=$this->session->userdata('id_user');
					// }else{
						// $nama=$this->session->userdata('nama_pendaftar');
						// $email=$this->session->userdata('id_user');
					// }
				// }
				
				?>
				<div class="sia-profile">		
					<img class="sia-profile-image" src="http://admisi.uin-suka.ac.id/img_pendaftar/<?php echo $status; ?>/<?php echo $this->session->userdata('TAHUN_BAYAR');?>/<?php echo $this->session->userdata('gelombang'); ?>/<?php echo $foto; ?>.jpg" />
						<h3><?php echo $nama; ?></h3>
						<b><?php echo $email; ?></b>
						<?php /* <p style="text-align:center; font-weight:bold;">19911128 000000 1 101</p>	 */ ?>
				</div>
				<?php }else{ 
						$vid = $this->session->userdata('id_user');
						if($this->session->userdata('status') == 'staff'):
							$nama = $this->session->userdata('username');
							$foto = 'http://static.uin-suka.ac.id/foto/pgw/980/'.tg_encode('FOTOAUTO#'.$vid.'#QL:80#WM:1#SZ:120').'.jpg';
						endif;
				
				
				?>
				
					<div class="sia-profile">		
						<img class="sia-profile-image" src="<?php echo $foto; ?>" alt="<?php echo $nama; ?> (<?php echo $vid; ?>)">
						<h2><?php echo $nama; ?></h2>
						<p style="text-align:center; font-weight:bold;"><?php echo sia_nip_staff($vid); ?></p>	
					</div>
		<?php } ?>
			</li>
			<?php endif; ?>
	<?php else: ?>
	<?php $this->load->view('01_login/def/s01_vw_login_01form', $in_data['data']); ?>
	<?php endif; ?>
	<?php endif; ?>
	
	