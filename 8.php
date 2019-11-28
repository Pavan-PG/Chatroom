<html>
<head>
	<title>Calculator</title>
	</head>
	<body>
		<form method=post action="">
		<p>Value 1 : <input type="text" name="val1" id="val1"></p>
		<p>Value 2 : <input type="text" name="val2" id="val2"></p>
		<p>Answer : <input type="text" id="ans"></p>
		<input type="submit" name="sub" value="+">
		<input type="submit" name="sub" value="-">
		<input type="submit" name="sub" value="*">
		<input type="submit" name="sub" value="/">
	</form>
	</body>
</html>
<?php 
$val1=$_POST["val1"];
$val2=$_POST["val2"];
$opr=$_POST["sub"];
if($val1==""||$val2=="")
{
	echo "<script>alert('Please input both values');</script>";
}
else if(!is_numeric($val1)||(!is_numeric($val2)))
	{
	echo "<script>alert('Please enter proper values');</script>";
}
else if($opr=="+")
{
	echo "<script>document.getElementById('ans').value=".($val1+$val2)."</script>";
	echo "<script>document.getElementById('val1').value=".$val1."</script>";
	echo "<script>document.getElementById('val2').value=".$val2."</script>";
}
?>