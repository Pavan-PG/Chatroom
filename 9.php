<?php
$statesArray=[];
$states="Mississippi Alabama Texas Massachusetts Kansas";
$states1=explode(' ', $states);
foreach($states1 as $i => $value)
{
	print("STATES[$i]=".$value);
	print("\n");
}
$counts=0;
print("\n");
foreach($states1 as $state)
{
	if(preg_match('/xas$/',($state)))
		$statesArray[$counts++]=$state;
}
foreach($states1 as $state)
{
	if(preg_match('/^k.*s$/i',($state)))
		$statesArray[$counts++]=$state;
}
foreach($states1 as $state)
{
	if(preg_match('/^M.*s$/',($state)))
		$statesArray[$counts++]=$state;
}
foreach($states1 as $state)
{
	if(preg_match('/a$/',($state)))
		$statesArray[$counts++]=$state;
}
foreach($statesArray as $i => $value)
{
	print("STATES[$i]=".$value);
	print("\n");
}
?>