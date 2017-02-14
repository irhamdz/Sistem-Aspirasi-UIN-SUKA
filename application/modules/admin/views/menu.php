<nav class="accordion"><br>
	<ol>
    <?php if($this->session->userdata('status') == 'staff'): 
        $data = $this->security->xss_clean($this->uri->segment(1));
        $buka = ($data == 'admin')? 'buka':'';
    

        ?>
		
<?php

    $vid = $this->session->userdata('username');
    if($this->session->userdata('status') == 'staff'):
 
    $foto = 'http://static.uin-suka.ac.id/foto/pgw/980/'.tg_encode('FOTOAUTO#'.$vid.'#QL:80#WM:1#SZ:120').'.jpg';
     
    endif;
   
?>
                                
                    <div class="sia-profile">       
                        <img class="sia-profile-image" src="<?php echo $foto; ?>" alt="">
                        <h2><?php 
                       echo $this->session->userdata('gelar')['GELAR_DEPAN'].' '.$this->session->userdata('gelar')['GELAR_DEPAN_NA'].' '.$this->session->userdata('gelar')['NM_PGW'].' '.$this->session->userdata('gelar')['GELAR_BELAKANG'].' '.$this->session->userdata('gelar')['GELAR_BELAKANG_NA'];
                        ?></h2>
                        <p style="text-align:center; font-weight:bold;"><?php  echo sia_nip_staff($this->session->userdata('username')); ?></p>   
                    </div>
                    </li>

		</li>
		
		<li id="li-staffberita" class="item">
			<a href="#staffberita" class="item"><span>Admin Informasi</span></a>
			<div class="underline-menu"></div>
				<ol id="ol-staffberita" class="<?php echo $buka;?>" style="">
					<li class="submenu"><a href="<?php echo base_url('admin/page');?>" title="Tambah, ubah, atau hapus pengumuman">Halaman Statis</a></li>
					<li class="submenu"><a href="<?php echo base_url('admin/liputan');?>" title="Tambah, ubah, atau hapus liputan">Liputan</a></li>
					<li class="submenu"><a href="<?php echo base_url('admin/pengumuman');?>" title="Tambah, ubah, atau hapus pengumuman">Pengumuman</a></li>
					<li class="submenu"><a href="<?php echo base_url('admin/berita');?>" title="Tambah, ubah, atau hapus berita">Berita</a></li>
					<li class="submenu"><a href="<?php echo base_url('admin/agenda');?>" title="Tambah, ubah, atau hapus agenda">Agenda</a></li>
					<li class="submenu"><a href="<?php echo base_url('admin/kolom');?>" title="Tambah, ubah, atau hapus kolom">Kolom</a></li>
					<li class="submenu"><a href="<?php echo base_url('admin/dokumen');?>" title="Tambah, ubah, atau hapus dokumen">Dokumen</a></li>
				</ol>
		</li>
		<?php //$this->load->view('registrasi/sidebar/registrasi_sidebar'); ?>
		<?php endif;?>
<?php
$allow='AAZ001#AAZ002#AAZ005#AAZ006#REG004';
	$jbt = $this->session->userdata('jabatan');		 
    $who = array_intersect($jbt,explode("#",$allow));
    	$arr_allow=explode('#',$allow);
    	//$arr_jabat=explode("#",$jbt);
    	$arr_menu=array(
    			//'1'=>'04_staff/04_staff_sidebar',
    			'2'=>'adminpmb/sidebar/adminpmb_sidebar',
    			'3'=>'05_adminpmb/sidebar/admintools_sidebar',
    			'4'=>'05_adminpmb/sidebar/admluarnegeri_sidebar',
    			// '5'=>'05_adminpmb/s05_tools_adminpmb_sidebar',
    			// '6'=>'05_adminpmb/s05_laporan_adminpmb_sidebar',
    			'5'=>'snmptn/sidebar/snmptn_sidebar',
    			'6'=>'spanptkin/sidebar/spanptkin_sidebar',
                '7'=>'adminpmb/sidebar/adminpmb_laporan',
    			//'7'=>'snmptn/sidebar/yudisium_sidebar',
    			'8'=>'registrasi/sidebar/registrasi_sidebar',
    			'9'=>'admin/sidebar/admin_informasi_sidebar',
                '10'=>'adminpmb/sidebar/adminpmb_penilaian',
                '11'=>'yudisium/yudisium_sidebar/menu_yudisium',
                '12'=>'registrasi/sidebar/registrasi_sidebar',
                '13'=>'rekap/sidebar/rekap_sidebar',
    			//'8'=>'spanptain/sidebar/spanptain_sidebar'
    	);
    	$arr_access['AAZ001']=array(2,7,10,11,5,6,8,13);
    	$arr_access['AAZ002']=array(7);
    	// $arr_access['AAZ003']=array(1,2,3);
    	// $arr_access['AAZ004']=array(1,2,3,7);
    	$arr_access['AAZ005']=array(5);
    	// $arr_access['POU001']=array(1,2,3);	
    	$arr_access['AAZ006']=array(5,6,11);	
    	// $arr_access['AAZF09']=array(2,3);	
    	 //$arr_access['REG002']=array(6);	
    	$arr_access['REG004']=array(8);	
    	//$menu_access=array_unique(array_merge($arr_access['AAZ005'],$arr_access['POU001']));
    	$menu_access=array();
    	foreach($who as $w){
    		$menu_access=array_unique(array_merge($menu_access,$arr_access[$w]));
    	}
	   foreach($menu_access as $m){
		  $this->load->view($arr_menu[$m]);
	   }
?>	   


            <div class="underline-menu"></div>
                    <ol id="ol-menu-admininformasi" class=""></ol></li>                                    
                    <li id="item-logout" class="item" style="margin-bottom:5%;">
                         <a href="<?php echo base_url('logout');?>" class="item"><span>Logout</span>
                        </a>
                        <div class="underline-menu"></div>
                    </li>
	</ol>

</nav>