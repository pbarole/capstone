
<?php


$servername = "localhost";
$username = "root";
$password = "pbarole";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error)
 {
    die("Connection failed: " . $conn->connect_error);
} 
else
{
	$qr1="SELECT * from v order by ADDTIME(TAR,TLATENESS),addtime(TAR,Lateness);";
	$Time1;
	$Time2;
	$PF1;
	$PF2;
	$Ty1;
	$Ty2;
	$result1 = mysqli_query($conn, $qr1);
	
	echo "<table border=\"1 px\">";
	echo "<tr><th>NO</th><th>Name</th><th>Type</th><th>PF</th><th>DES</th><th>DEP</th><th>LATENESS</th><th>TAR</th><tr>";
	
	while($row = $result1->fetch_assoc()) 
	{
		$Time1=$row["TAR"]+$row["TLATENESS"];
		$Time2=$row["TAR"]+$row["Lateness"];
		$PF1=$row["TPF"];
		$PF2=$row["PF"];
		$Ty1=$row["TType"];
		$Ty2=$row["Type"];
		$t1=date_create($row["Lateness"],timezone_open("Europe/Oslo"));
		$t2=date_create($row["TLATENESS"],timezone_open("Europe/Oslo"));
		//echo $t2;
		$Start=date_sub($t1,date_interval_create_from_date_string("00:15:00"));;
		$End=date_add($t2,date_interval_create_from_date_string("00:15:00"));;
		$str1=date_format($Start,'Y-M-D H:i:s');
		$str2=date_format($End,'Y-M-D H:i:s');
	
	$qr2="SELECT NO,Name,PF,AR from CNB where(PF=".($PF1-1)." OR PF=".($PF1+1).") AND (addtime(AR,Lateness) between  Addtime(".$str1.",".$row["TAR"].")AND Addtime(".$str2.",".$row["TAR"]."));";
	$qr3="Update V SET TLATENESS=addtime(TLATENESS,\"00:15:00\") where TNO=".$row['TNO'].";";
	$qr4="Update V SET Lateness=addtime(Lateness,\"00:15:00\") where NO=".$row['NO'].";";
	$qr5="Update V SET TLATENESS=addtime(TLateness,\"00:25:00\") where TNO=".$row['TNO'].";";
	$qr6="Update V SET Lateness=addtime(Lateness,\"00:25:00\") where NO=".$row['NO'].";";
	$qr7="ISNULL(SELECT NO,Name,PF,AR from CNB where(PF=".($PF1-1)." OR PF=".($PF1+1).") AND (addtime(AR,Lateness) between  Addtime(".$str1.",".$row["TAR"].")AND Addtime(".$str2.",".$row["TAR"].")),0);";
	$qr8="Delete from V where TNO>0;";
	$qr9="select TNO,TNAME,TType,TPF,TDES,TDEP,TLATENESS,addtime(CNB.ar,TLATENESS) as NEW_AR from V join CNB on V.TNO=CNB.NO where TNO=";
	$qr11="select V.NO,V.Name,V.Type,V.PF,V.DES,V.DEP,V.Lateness,addtime(CNB.ar,V.Lateness) as NEW_AR from V join CNB on V.NO=CNB.NO where V.NO=";
	$result2 = mysqli_query($conn, $qr2);
	$result3=mysqli_query($conn,$qr7);
	
	
	
	
	if ($result3==0) 
	{
		if($Ty1>$Ty2)
		{
			$Time1=date_sub($t1,date_interval_create_from_date_string("00:15:00"));
			$str3=date_format($Time1,'Y-M-D H:i:s');
			
			mysqli_query($conn,$qr3);
			
			$qr10=$qr9.$row["TNO"];
			$result2=mysqli_query($conn,$qr10);
			$row2=$result2->fetch_assoc();
			if($result2)
			{
				echo "<tr><td>".$row["NO"]."</td><td>".$row["Name"]."</td><td>".$row["Type"]."</td><td>".$row["PF"]."</td><td>".$row["DES"]."</td><td>".$row["DEP"]."</td><td>".$row["Lateness"]."</td><td>".$row["TAR"]."</td></tr>";
				echo "<tr><td>".$row2["TNO"]."</td><td>".$row2["TNAME"]."</td><td>".$row2["TType"]."</td><td>".$row2["TPF"]."</td><td>".$row2["TDES"]."</td><td>".$row["TDEP"]."</td><td>".$row2["TLATENESS"]."</td><td>".$row2["NEW_AR"]."</td></tr>";				
				echo nl2br("update platform of train no.".$row["TNO"]);
			}	
		
		}
		else
		{
			if($Ty2>$Ty1)
			{
				$Time2=date_sub($t1,date_interval_create_from_date_string("00:15:00"));
				$str3=date_format($Time2,'Y-M-D H:i:s');
		
				
				$r=mysqli_query($conn,$qr4);
				$qr12=$qr11.$row["NO"];
			
			
			$result2=mysqli_query($conn,$qr12);
			
			$row2=$result2->fetch_assoc();
			if($result2)
			{
				echo "<tr><td>".$row["TNO"]."</td><td>".$row["TNAME"]."</td><td>".$row["TType"]."</td><td>".$row["TPF"]."</td><td>".$row["TDES"]."</td><td>".$row["TDEP"]."</td><td>".$row["TLATENESS"]."</td><td>".$row["TAR"]."</td></tr>";				
				echo "<tr><td>".$row2["NO"]."</td><td>".$row2["Name"]."</td><td>".$row2["Type"]."</td><td>".$row2["PF"]."</td><td>".$row2["DES"]."</td><td>".$row["DEP"]."</td><td>".$row2["Lateness"]."</td><td>".$row2["NEW_AR"]."</td></tr>";				
				echo nl2br("update platform of train no.".$row["NO"]);
			}
			
			}
			else
			{
				if($row["TLateness"]<$row["Lateness"])
				{
				 $Time1=date_sub($t1,date_interval_create_from_date_string("00:15:00"));
				 $str3=date_format($Time1,'Y-M-D H:i:s');
				 
				 $result2=mysqli_query($conn,$qr3);
				 
				 $qr10=$qr9.$row["TNO"];
			$result2=mysqli_query($conn,$qr10);
			$row2=$result2->fetch_assoc();
			if($result2)
			{
				echo "<tr><td>".$row["NO"]."</td><td>".$row["Name"]."</td><td>".$row["Type"]."</td><td>".$row["PF"]."</td><td>".$row["DES"]."</td><td>".$row["DEP"]."</td><td>".$row["Lateness"]."</td><td>".$row["TAR"]."</td></tr>";
				echo "<tr><td>".$row2["TNO"]."</td><td>".$row2["TNAME"]."</td><td>".$row2["TType"]."</td><td>".$row2["TPF"]."</td><td>".$row2["TDES"]."</td><td>".$row["TDEP"]."</td><td>".$row2["TLATENESS"]."</td><td>".$row2["NEW_AR"]."</td></tr>";				
				echo nl2br("update platform of train no.".$row["TNO"]);
			}
			

				}
				else
				{
				  $Time2=date_sub($t1,date_interval_create_from_date_string("00:15:00"));
				  $str3=date_format($Time2,'Y-M-D H:i:s');
				  
				  $result2->mysqli_query($conn,$qr4);
				  $result2=mysqli_query($conn,$qr12);
			
			$row2=$result2->fetch_assoc();
			if($result2)
			{
				echo "<tr><td>".$row["TNO"]."</td><td>".$row["TNAME"]."</td><td>".$row["TType"]."</td><td>".$row["TPF"]."</td><td>".$row["TDES"]."</td><td>".$row["TDEP"]."</td><td>".$row["TLATENESS"]."</td><td>".$row["TAR"]."</td></tr>";				
				echo "<tr><td>".$row2["NO"]."</td><td>".$row2["Name"]."</td><td>".$row2["Type"]."</td><td>".$row2["PF"]."</td><td>".$row2["DES"]."</td><td>".$row["DEP"]."</td><td>".$row2["Lateness"]."</td><td>".$row2["NEW_AR"]."</td></tr>";				
				echo nl2br("update platform of train no.".$row["NO"]);
			}
				}
			}
		}
	}
	else
	{
		$Time1=date_sub($t1,date_interval_create_from_date_string("00:25:00"));
		$str3=date_format($Time1,'Y-M-D H:i:s');
		echo "e   ".$str3;
		$result2->mysqli_query($conn,$qr5);
		$row=$result2->fetch_assoc();
		echo "<tr><td>".$row["TNO"]."</td><td>".$row["TNAME"]."</td><td>".$row["TType"]."</td><td>".$row["TPF"]."</td><td>".$row["TDES"]."</td><td>".$row["TDEP"]."</td><td>".$row["TLATENESS"]."</td><td>".$row["TAR"]."</td></tr";

		$Time2=date_sub($t1,date_interval_create_from_date_string("00:25:00"));
		$str3=date_format($Time2,'Y-M-D H:i:s');
		echo "a   ".$str3;
		$result2->mysqli_query($conn,$qr6);
		echo "<tr><td>".$row2["NO"]."</td><td>".$row2["Name"]."</td><td>".$row2["Type"]."</td><td>".$row2["PF"]."</td><td>".$row2["DES"]."</td><td>".$row["DEP"]."</td><td>".$row2["Lateness"]."</td><td>".$row2["NEW_AR"]."</td></tr>";				

	}
	
	}
	
	echo "<table border=\"1 px\">";
	echo "<tr><th>TNO</th><th>TName</th><th>TType</th><th>TPF</th><th>TDES</th><th>TDEP</th><th>TLATENESS</th><th>TT</th><th>TAR</th><th>NO</th><th>Name</th><th>Type</th><th>PF</th><th>DES</th><th>DEP</th><th>Lateness</th><th>Travel_Time</th></tr>";

	$result=mysqli_query($conn,$qr1);
	if (mysqli_num_rows($result) > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{									
			echo "<tr><td>".$row["TNO"]."</td><td>".$row["TNAME"]."</td><td>".$row["TType"]."</td><td>".$row["TPF"]."</td><td>".$row["TDES"]."</td><td>".$row["TDEP"]."</td><td>".$row["TLATENESS"]."</td><td>".$row["TT"]."</td><td>".$row["TAR"]."</td><td>".$row["NO"]."</td><td>".$row["Name"]."</td><td>".$row["Type"]."</td><td>".$row["PF"]."</td><td>".$row["DES"]."</td><td>".$row["DEP"]."</td><td>".$row["Lateness"]."</td><td>".$row["Travel_Time"]."</td></tr>";							
		}
	}
	echo "</table>";
	//echo "<table border=\"1 px\">";
	// echo "<tr><th>TNO</th><th>TName</th><th>TType</th><th>TPF</th><th>TDES</th><th>TDEP</th><th>TLATENESS</th><th>TT</th><th>TAR</th><th>NO</th><th>Name</th><th>Type</th><th>PF</th><th>DES</th><th>DEP</th><th>Lateness</th><th>Travel_Time</th></tr>";

	/*$result=mysqli_query($conn,$qr9);
	if (mysqli_num_rows($result) > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{									
			echo "<tr><td>".$row["TNO"]."</td><td>".$row["TNAME"]."</td><td>".$row["TType"]."</td><td>".$row["TPF"]."</td><td>".$row["TDES"]."</td><td>".$row["TDEP"]."</td><td>".$row["TLATENESS"]."</td><td>".$row["TT"]."</td><td>".$row["TAR"]."</td><td>".$row["NO"]."</td><td>".$row["Name"]."</td><td>".$row["Type"]."</td><td>".$row["PF"]."</td><td>".$row["DES"]."</td><td>".$row["DEP"]."</td><td>".$row["Lateness"]."</td><td>".$row["Travel_Time"]."</td></tr>";							
		}
	}
	echo "</table>";*/
	mysqli_query($conn,$qr8);
	}
	
	mysqli_close($conn);

?>
