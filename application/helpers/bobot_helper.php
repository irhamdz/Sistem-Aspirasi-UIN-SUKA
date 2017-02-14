<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('grade_allowed'))
{
	function grade_allowed($nilai,$wajib)
	{
		$warna=array();
		$warna[1]="#DC143C";
		if($nilai < $wajib)
		{
			return $warna[1];
		}
	}

	function grade_allowed_nilai($nilai,$wajib,$key)
	{
		switch ($key) {
			case '>':
				if($nilai > $wajib)
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
			case '<':
				if($nilai < $wajib)
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
			case '=':
				if($nilai == $wajib)
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
			case '>=':
				if($nilai >= $wajib)
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
			case '<=':
				if($nilai <= $wajib)
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
		}
		
	}
}
