<?php
print"<h3>REFRESH PAGE</h3>";
$fname="counter.txt";
$file=fopen($fname,"r");
$hits=fscanf($file, "%d");
fclose($file);
$file=fopen($fname, "w");
$hits[0]++;
fprintf($file, "%d", $hits[0]);
fclose($file);
print("Total number of views : ".$hits[0]);
?>