<?php

$route['operator']	= 'sertifikasi/c00_operator';
$route['operator/(:any)']	= 'sertifikasi/c00_operator/$1';

$route['pendaftar']	= 'sertifikasi/c01_registrant';
$route['pendaftar/(:any)']	= 'sertifikasi/c01_registrant/$1';


$route['cetak']	= 'sertifikasi/cetak';
$route['cetak/(:any)']	= 'sertifikasi/cetak/$1';
?>