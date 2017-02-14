<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('format_tanggal');
		$this->load->helper('text_manipulation');
		$this->load->library('pagination');
		$this->load->model('page/page_model');
	}
 
	function index($page=0)
	{
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Pengumuman','/');
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$per_page=10;
		$cfg=$this->webserv->admisi('announcement/total_row');
		$config['base_url'] = site_url('page/pengumuman/index/');
		$config['total_rows'] = $cfg->total;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$limit=$offset+$per_page;
		$data['offset']=$offset;
		$data['pengumuman'] = $this->webserv->admisi('announcement/announcement_list',array('LIMIT'=>$limit,'OFFSET'=>$offset));
		$data['content']="page/pengumuman/arsip_view";
		$this->load->view('page/header',$data);
		$this->load->view('page/content');
		$this->load->view('page/footer');
	}
   
   
	public function detail($id=0){
		$data['pop'] = $this->webserv->admisi('announcement/popular_announcement');	
		$p = $this->webserv->admisi('announcement/announcement_detil',array('ID'=>$id));
		$this->breadcrumb->append_crumb('Beranda', base_url());
		$this->breadcrumb->append_crumb('Pengumuman', site_url('page/pengumuman'));
		$this->breadcrumb->append_crumb(substr($p->judul,0,130).' ...', '/');
		$data['title']=$p->judul;
	
		$count= $this->webserv->admisi('announcement/add_counter',array('ID'=>$id));		
		$arr_filter=array();
		$arr_filter=related_text($p->judul);	
		$data['rec'] = $this->webserv->admisi('announcement/related_announcement',
					array('ID'=>$id,
					'RELATED'=>$arr_filter)
		);	
	
		if(count($p)>0){	
			$data['d']=$this->webserv->admisi('announcement/announcement_detil',array('ID'=>$id));
			set_time_limit(0); 
			if($p->url!=null){
				redirect($p->url);
			}else{
				
				$arf=explode(".",$p->nama_file);
				$ext= strtolower(end($arf));
				$arr_ext=array('pdf','jpg');
				if(in_array($ext,$arr_ext)){
					$data['ext']=$ext;
				}
					$data['filetype']=$ext;
				$data['content']="page/pengumuman/detail_view";
				$this->load->view('page/header',$data);
				$this->load->view('page/content');
				$this->load->view('page/footer');
				
			}	
		}else{
		redirect(base_url());
	  }
   }
	   
	function download($id=0){
		$p = $this->webserv->admisi('announcement/announcement_detil',array('ID'=>$id));
		$this->output_file("./media/pengumuman/".$p->NAMA_FILE,''.$p->NAMA_FILE.''); 
		
	}
	 
   function feed(){  
		$data['feed_name'] = 'Pengumuman';  
		$data['encoding'] = 'utf-8';  
		$data['feed_url'] = site_url('page/pengumuman/feed');
		$data['feed_description'] = 'UIN Sunan Kalijaga Yogyakarta';  
		$data['page_language'] = 'en-en';  
		$data['pengumuman'] = $this->webserv->admisi('announcement/announcement_list',array('LIMIT'=>20,'OFFSET'=>0));
		header("Content-Type: application/rss+xml");  
		$this->load->view('pengumuman/rss_pengumuman', $data);  
	}
	
		
	function output_file($file, $name, $mime_type=''){
	 /*
	 This function takes a path to a file to output ($file),  the filename that the browser will see ($name) and  the MIME type of the file ($mime_type, optional).
	 */
	 
	 //Check the file premission
	 if(!is_readable($file)) die('File not found or inaccessible!');
	 
	 $size = filesize($file);
	 $name = rawurldecode($name);
	 
	 /* Figure out the MIME type | Check in array */
	 $known_mime_types=array(
		"pdf" => "application/pdf",
		"txt" => "text/plain",
		"html" => "text/html",
		"htm" => "text/html",
		"exe" => "application/octet-stream",
		"zip" => "application/zip",
		"doc" => "application/msword",
		"xls" => "application/vnd.ms-excel",
		"ppt" => "application/vnd.ms-powerpoint",
		"gif" => "image/gif",
		"png" => "image/png",
		"jpeg"=> "image/jpg",
		"jpg" =>  "image/jpg",
		"php" => "text/plain"
	 );
	 
	 if($mime_type==''){
		 $file_extension = strtolower(substr(strrchr($file,"."),1));
		 if(array_key_exists($file_extension, $known_mime_types)){
			$mime_type=$known_mime_types[$file_extension];
		 } else {
			$mime_type="application/force-download";
		 };
	 };
	 
	 //turn off output buffering to decrease cpu usage
	 @ob_end_clean(); 
	 
	 // required for IE, otherwise Content-Disposition may be ignored
	 if(ini_get('zlib.output_compression'))
	  ini_set('zlib.output_compression', 'Off');
	 
	 header('Content-Type: ' . $mime_type);
	 header('Content-Disposition: attachment; filename="'.$name.'"');
	 header("Content-Transfer-Encoding: binary");
	 header('Accept-Ranges: bytes');
	 
	 /* The three lines below basically make the 
		download non-cacheable */
	 header("Cache-control: private");
	 header('Pragma: private');
	 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	 
	 // multipart-download and download resuming support
	 if(isset($_SERVER['HTTP_RANGE']))
	 {
		list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
		list($range) = explode(",",$range,2);
		list($range, $range_end) = explode("-", $range);
		$range=intval($range);
		if(!$range_end) {
			$range_end=$size-1;
		} else {
			$range_end=intval($range_end);
		}
		/*
		------------------------------------------------------------------------------------------------------
		//This application is developed by www.webinfopedia.com
		//visit www.webinfopedia.com for PHP,Mysql,html5 and Designing tutorials for FREE!!!
		------------------------------------------------------------------------------------------------------
		*/
		$new_length = $range_end-$range+1;
		header("HTTP/1.1 206 Partial Content");
		header("Content-Length: $new_length");
		header("Content-Range: bytes $range-$range_end/$size");
	 } else {
		$new_length=$size;
		header("Content-Length: ".$size);
	 }
	 
	 /* Will output the file itself */
	 $chunksize = 1*(1024*1024); //you may want to change this
	 $bytes_send = 0;
	 if ($file = fopen($file, 'r'))
	 {
		if(isset($_SERVER['HTTP_RANGE']))
		fseek($file, $range);
	 
		while(!feof($file) && 
			(!connection_aborted()) && 
			($bytes_send<$new_length)
			  )
		{
			$buffer = fread($file, $chunksize);
			print($buffer); //echo($buffer); // can also possible
			flush();
			$bytes_send += strlen($buffer);
		}
	 fclose($file);
	 } else
	 //If no permissiion
	 die('Error - can not open file.');
	 //die
	die();
	}


	
}
 
/* End of file pengumuman.php */
