<?php
	// print_r($in_data); die();
	/* $username=$this->session->userdata('id_user');
		$arr_dekan=array('dekan.fadib','dekan.fsh','dekan.fishum','dekan.febi');
		if( in_array($username,$arr_dekan)){
		$this->session->set_userdata('jabatan','AAZ006');
		} */
	$app_category = $in_data['app_category']; #unset($in_data['app_category']);
	$this->load->view('01_login/01_login_sidebar', $in_data);
	$allow='AAZ001#AAZ002#AAZ003#AAZ004#AAZ005#AAZ006#AAZF09#POU001#REG002#REG004';
	$jbt = $this->session->userdata('jabatan');
	//print_r($jbt);
	
		 
    $who = array_intersect(explode("#",$jbt),explode("#",$allow));
	//echo $who[1];
	
    $stat = count($who) > 0 ? TRUE : FALSE;
    if($stat){
    	$arr_allow=explode('#',$allow);
    	//$arr_jabat=explode("#",$jbt);
    	$arr_menu=array(
    			'1'=>'04_staff/04_staff_sidebar',
    			'2'=>'05_adminpmb/sidebar/adminlaporan_sidebar',
    			'3'=>'05_adminpmb/sidebar/admintools_sidebar',
    			'4'=>'05_adminpmb/sidebar/admluarnegeri_sidebar',
    			// '5'=>'05_adminpmb/s05_tools_adminpmb_sidebar',
    			// '6'=>'05_adminpmb/s05_laporan_adminpmb_sidebar',
    			'5'=>'snmptn/sidebar/snmptn_sidebar',
    			'6'=>'spanptkin/sidebar/spanptkin_sidebar',
    			'7'=>'yudisium/sidebar/yudisium_sidebar',
    			'8'=>'registrasi/sidebar/registrasi_sidebar',
    			'9'=>'admin/sidebar/admin_informasi_sidebar',
    			//'8'=>'spanptain/sidebar/spanptain_sidebar'
    	);
    	$arr_access['AAZ001']=array(1,2,3,4,5,6,8,9);
    	$arr_access['AAZ002']=array(1,2,3,4,5,6,8,9);
    	$arr_access['AAZ003']=array(1,2,3);
    	$arr_access['AAZ004']=array(1,2,3,7);
    	$arr_access['AAZ005']=array(1,2,3,7);
    	$arr_access['POU001']=array(1,2,3);	
    	$arr_access['AAZ006']=array(7);	
    	$arr_access['AAZF09']=array(2,3);	
    	$arr_access['REG002']=array(6);	
    	$arr_access['REG004']=array(8);	
    	//$menu_access=array_unique(array_merge($arr_access['AAZ005'],$arr_access['POU001']));
    	$menu_access=array();
    	foreach($who as $w){
    		$menu_access=array_unique(array_merge($menu_access,$arr_access[$w]));
    	}
	   foreach($menu_access as $m){
			$this->load->view($arr_menu[$m], $in_data);
	   }
    
	/*	if($who[1]!='AAZ006'){
			$this->load->view('04_staff/04_staff_sidebar', $in_data);
			$this->load->view('05_adminpmb/sidebar/adminlaporan_sidebar', $in_data);
			$this->load->view('05_adminpmb/sidebar/admintools_sidebar', $in_data);
			$this->load->view('05_adminpmb/sidebar/admluarnegeri_sidebar', $in_data);
			// $this->load->view('05_adminpmb/s05_tools_adminpmb_sidebar', $in_data);
			// $this->load->view('05_adminpmb/s05_laporan_adminpmb_sidebar', $in_data);
			$this->load->view('registrasi/sidebar/registrasi_sidebar', $in_data);
		}else{
			$this->load->view('yudisium/sidebar/yudisium_sidebar', $in_data);
		}*/
	}
	
	//other APP SIDEBAR
	$jenis=$this->session->userdata('status');
	switch($jenis){
		case 'matrikulasi' : $this->load->view('matrikulasi_ln/sidebar/matrikulasi_ln_sidebar', $in_data);break;
		default 		   : $this->load->view('02_cmahasiswa/02_cmhs_sidebar', $in_data); break;
	}
	
	
	
	
		
?>