<?php
function kapasitas_ruang($arr,$isi)
{
	$max=max($arr);
	if(trim($max)==trim($isi))
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function get_jenis_ruang($id)
{
  switch ($id) {
    case '1':
      return "Khusus";
      break;
    case '0':
      return "Umum";
      break;
    
  }
}