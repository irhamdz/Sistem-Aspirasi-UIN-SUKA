<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
	Author		: @shotozuro
	Created		: 13:13 07/11/2014
*/

class It00_lib_output {
	
	function output_display($vw = '',$dt=''){
		$CI =& get_instance();
		
		$data['content']= $vw;
		$data['arr'] = $dt;
		$CI->load->view('layout/header',$data);
		$CI->load->view('layout/content');
		$CI->load->view('layout/footer');
	}
	
	function output_crumbs($data = array(), $output = true, $id = 'crumbs'){
		$hasil 	= '<ul id="'.$id.'">';
		foreach($data as $d){ foreach($d as $k1 => $v1){
			if ($v1 != ''){
				$hasil .= '<li>'.anchor($v1, $k1, 'title="'.$k1.'"').'</li>';
			} else {
				$hasil .= '<li>'.$k1.'</li>';
			}
		}}
		$hasil 	.= '</ul>';
		#echo $hasil;
		if($output){ echo $hasil; } else { return $hasil; }
	}	
}

#enf of file 