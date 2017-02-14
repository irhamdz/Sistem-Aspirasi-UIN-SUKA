<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_model extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}
	function validate(){
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('membership');
		
		if($query->num_rows == 1)
		{
			return true;
		}
	}
	function get_page($id)
	{
		$q = $this->db->query("select * from page where id_page='".$id."'");
		return $q->result();
	}
	function get_pengumuman($id)
	{
		$q = $this->db->query("select * from pengumuman where id_pengumuman='".$id."'");
		return $q->result();
	}
	function get_berita($id)
	{
		$q = $this->db->query("select * from berita where id_berita='".$id."'");
		return $q->result();
	}
	function get_liputan($id)
	{
		$q = $this->db->query("select * from liputan where id_liputan='".$id."'");
		return $q->result();
	}
	function get_agenda($id)
	{
		$q = $this->db->query("select * from agenda where id_agenda='".$id."'");
		return $q->result();
	}
	function get_album($id)
	{
		$q = $this->db->query("select * from album where id_album='".$id."'");
		return $q->result();
	}
	function get_album_last(){
		$q = "SELECT * FROM album ORDER BY id_album desc LIMIT 0,1";
			$query = $this->db->query($q);
			return $query->result();
	}
	function insert_album($data){
			$this->db->insert('album', $data);
	}
	public function select_album($limit,$offset,$filter=array()){
		$page=$offset;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
	
		$tot_hal = $this->db->query("select * from album");
		$config['base_url'] = site_url('admin/gallery/album/');
		$config['total_rows'] = $tot_hal->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$this->pagination->initialize($config);

		return $w = $this->db->query("select * from album order by id_album DESC limit ".$offset.", ".$limit."");
	}
	
	function get_slide($id)
	{
		$q = $this->db->query("select * from slide where id_slide='".$id."'");
		return $q->result();
	}
	function get_kolom($id)
	{
		$q = $this->db->query("select * from kolom where id_kolom='".$id."'");
		return $q->result();
	}
	function get_unit($id)
	{
		$q = $this->db->query("select * from unit where id_unit='".$id."'");
		return $q->result();
	}
	function get_dokumen($id)
	{
		$q = $this->db->query("select * from dokumen where id_dokumen='".$id."'");
		return $q->result();
	}
	function get_api($url, $output='json', $postorget='GET', $parameter){ 
	#$api_url = 'http://service.uin-suka.ac.id/servsiasuper/index.php/simar_public/'.$url.'/'.$output; 
	$api_url = 'http://service2.uin-suka.ac.id/servaset/simar_public/'.$url.'/'.$output; 
	$hasil = null; 
	if ($postorget == 'POST'){
	$hasil = $this->curl->simple_post($api_url, $parameter); 
	} else { 
	$hasil = $this->curl->simple_get($api_url); 
	} 
	return json_decode($hasil, TRUE); 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
