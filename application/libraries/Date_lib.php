<?php

  class Date_lib
  {
	function format_mysql_date($tgl){
		$matches = explode("/", $tgl);
		$tgl = $matches[2] . '-' . $matches[1] . '-' . $matches[0];
		return($tgl);
	}

	function format_jquery_date($tgl){
		$matches = explode("-", $tgl);
		$tgl = $matches[2] . '/' . $matches[1] . '/' . $matches[0];
		return($tgl);
	}


	function format_indonesia_date($tgl){
		$matches = explode("-", $tgl);
		$arr_bulan=array('01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$tgl = $matches[2] . ' ' . $arr_bulan[$matches[1]] . ' ' . $matches[0];
		return($tgl);
	}

  }
