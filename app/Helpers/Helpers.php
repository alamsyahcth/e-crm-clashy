<?php

function currency($number) {
	
	$currency = "Rp " . number_format($number,2,',','.');
	return $currency;
 
}

function getDateFormat($date) {

  $month = array(
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember',
  );

  $break = explode('-', $date);

  return $break[2].' '.$month[ (int)$break[1] ].' '.$break[0];
	
}