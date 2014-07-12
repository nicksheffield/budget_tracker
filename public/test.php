<?php

$month = Date('n');
$year  = Date('Y');

if($month == 1){
	$month = 12;
	$year -= 1;
}else{
	$month -= 1;
}

echo $year.'-'.$month.'-'.Date('d H:i:s');