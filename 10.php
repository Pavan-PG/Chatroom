<!DOCTYPE html>
<html>
<head><title>Selection Sort</title>
</head>
<style type="text/css">
	table,tr,td{
		margin:auto;
		top:20px;
		border:2px solid black;
		background-color: cyan;
	}
	h3{
		text-align: center;
	}
</style>
<body>
	<?php
		$a=array();
		$b=array();
		$c=array();
		$sql="SELECT * from student";
		$conn=mysqli_connect("localhost","root","","weblab");
		$result=$conn->query($sql);
		if($conn->connect_error)
		{
			die("Connection failed : ".connect_error);
		}
		else
		{
			if($result->num_rows>0){
				echo "<h3>BEFORE SORTING</h3>";
				echo "<table>";
				echo "<tr><td>USN</td><td>NAME</td><td>ADDRESS</td></tr>";
				while($row=$result->fetch_assoc())
				{
					echo "<tr><td>".$row['usn']."</td><td>".$row['name']."</td><td>".$row['address']."</td></tr>";
					array_push($a, $row['usn']);
				}
				echo "</table>";
				for($i=0;$i<count($a)-1;$i++)
				{
					for($j=$i+1;$j<count($a);$j++)
					{
						if($a[$j]<$a[$i])
						{
							$temp=$a[$j];
							$a[$j]=$a[$i];
							$a[$i]=$temp;
						}
					}
				}
				$result=$conn->query($sql);
				$i=0;
				while($row=$result->fetch_assoc())
				{
					if($row['usn']==$a[$i])
					{
						array_push($b, $row['name']);
						array_push($c, $row['address']);
					}
					$i+=1;
				}
				echo "<h3>AFTER SORTING</h3>";
				echo "<table>";
				echo "<tr><td>USN</td><td>NAME</td><td>ADDRESS</td></tr>";
				for($i=0;$i<count($a);$i++)
				{
					echo "<tr><td>".$a[$i]."</td><td>".$b[$i]."</td><td>".$c[$i]."</td></tr>";
				}
				echo "</table>";
			}
			else
			{
				echo "<h3>No records found in database</h3>";
			}
		}
	?>
</body>
</html>