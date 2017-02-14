<?php
if(!is_null($foto))
{
	foreach ($foto as $user_foto);
	
}
?>
<div id="home-s2">
<nav class="accordion">
	<ol>
	<li>
				<div class="sia-profile">		
					<img class="sia-profile-image" id="FP" src="<?php if(!is_null($foto)){echo pg_unescape_bytea($user_foto->foto);} ?>" />
						<strong><h3><?php 
						if(!is_null($foto))
						{
							echo $user_foto->nama_lengkap;
						}
						else
						{
							echo $this->session->userdata('username'); 
						}
						?></h3></strong>
						<br>
						<b>
							<?php
							if(!is_null($foto))
						{
							echo $this->session->userdata('username'); 
						}
						else
						{
							echo $this->session->userdata('pin_pmb'); 
						}
							?>
						</b>
							</div>
							</li>
							<input type="hidden" id="user" value="<?php echo $this->session->userdata('username'); ?>">
							<input type="hidden" id="jalur" value="<?php echo $kode_jalur ?>">
		<li id="item-logout" class="item" style="margin-bottom:5%;">
			<a href="<?php echo base_url('logout');?>" class="item"><span>Logout</span>
			</a>
			<div  style="width:100%" class="underline-menu"></div>
		</li>
		<?php

        $data = $this->security->xss_clean($this->uri->segment(1));
        $buka = ($data == 'pendaftaran')? 'buka':'';

        
        ?>
		<li id="li-staffberita" class="item">
			<a href="#staffberita" class="item"><span>Penerimaan Mahasiswa</span></a>
			<div class="underline-menu"></div>
				<ol id="ol-staffberita" class="<?php echo $buka;?>">
                 <li class="submenu">
                 <?php
                 if(!is_null($status_simpan))
                 {
                 	foreach ($status_simpan as $status) {
                 		$hanya_cetak=$status->status_simpan;
                 	}
                 	if($hanya_cetak != '1')
                 	{
                 		echo '<a href="#" onclick="form()">Daftar Penerimaan Mahasiswa Baru</a>';
                 	}
                 	else
                 	{
                 		echo "<a href='#' onclick='hanya_cetak1()'>Cetak Kartu Ujian</a>";
                 	}
                 }

                 ?>
					</li>
                </ol>
		</li>
		
	</ol>
</nav>
</div>
<br id="ganjel">
<script type="text/javascript">
var user=$('#user').attr('value');
function form ()
{
	
	tampil_posisi(0);
	$("#next").show();
	$("#next2").show();
	
						if(data_form[position]!='data_piljur')
						{
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/"+data_form[0]+"/"+user+"'); ?>");
						}
						else
						{
							$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/"+data_form[0]+"/"+user+"/"+jalur+"'); ?>");
						}
}

function hanya_cetak1()
{
	$('#slide-form').load("<?php echo base_url('pendaftaran/form_control/hanya_cetak/"+user+"'); ?>");
						
}
</script>