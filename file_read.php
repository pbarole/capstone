
<?php

$servername = "localhost";
$username = "root";
$password = "pbarole";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//UPLOADING THE TIME TABLE, THIS HAS TO BE DONE ONLY ONCE


$row = 1;
if (($handle = fopen("CNB.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
		$sql = "INSERT INTO CNB (NO,Name,Type,Zone,PF,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,src,ar,des,dep,lateness,Stoppage,Travel_Time)
VALUES(".$data[0].",'".$data[1]."','".$data[2]."','".$data[3]."',".$data[4].",".$data[5].",".$data[6].",".$data[7].",".$data[8].",".$data[9].",".$data[10].",".$data[11].",'".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."','".$data[18]."');";
        if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
		
		for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
   
}


$row = 1;
if (($handle = fopen("LKO.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
		$sql = "INSERT INTO LKO (NO,Name,Type,Zone,PF,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,src,ar,des,dep, lateness,Stoppage)
VALUES(".$data[0].",'".$data[1]."','".$data[2]."','".$data[3]."',".$data[4].",".$data[5].",".$data[6].",".$data[7].",".$data[8].",".$data[9].",".$data[10].",".$data[11].",'".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."');";
        if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
		
		for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }	
    fclose($handle);
}


$row = 1;
if (($handle = fopen("TDL.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
		$sql = "INSERT INTO TDL (NO,Name,Type,Zone,PF,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,src,ar,des,dep, lateness,Stoppage)
VALUES(".$data[0].",'".$data[1]."','".$data[2]."','".$data[3]."',".$data[4].",".$data[5].",".$data[6].",".$data[7].",".$data[8].",".$data[9].",".$data[10].",".$data[11].",'".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."');";
        if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
		
		for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }	
    fclose($handle);
}


$row = 1;
if (($handle = fopen("ALD.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
				$sql = "INSERT INTO ALD (NO,Name,Type,Zone,PF,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,src,ar,des,dep, lateness,Stoppage)
VALUES(".$data[0].",'".$data[1]."','".$data[2]."','".$data[3]."',".$data[4].",".$data[5].",".$data[6].",".$data[7].",".$data[8].",".$data[9].",".$data[10].",".$data[11].",'".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."');";

        if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
		
		for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }	
    fclose($handle);
}


$row = 1;
if (($handle = fopen("GKP.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
				$sql = "INSERT INTO GKP (NO,Name,Type,Zone,PF,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,src,ar,des,dep, lateness,Stoppage)
VALUES(".$data[0].",'".$data[1]."','".$data[2]."','".$data[3]."',".$data[4].",".$data[5].",".$data[6].",".$data[7].",".$data[8].",".$data[9].",".$data[10].",".$data[11].",'".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."');";

        if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
		
		for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }	
    fclose($handle);
}


$row = 1;
if (($handle = fopen("JHS.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
				$sql = "INSERT INTO JHS (NO,Name,Type,Zone,PF,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,src,ar,des,dep, lateness,Stoppage)
VALUES(".$data[0].",'".$data[1]."','".$data[2]."','".$data[3]."',".$data[4].",".$data[5].",".$data[6].",".$data[7].",".$data[8].",".$data[9].",".$data[10].",".$data[11].",'".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."');";

        if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
		
		for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }	
    fclose($handle);
}


//UPDATING THE LATENESS OF TRAINS, THIS HAS TO BE DONE IN REAL TIME 
else{
	
$row = 1;
	if (($handle = fopen("ALD.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
		
				$sql = "UPDATE ALD SET LATENESS='".$data[16]."' WHERE NO=".$data[0].";";
				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				echo $data[16] . "<br />\n";
				} 
				else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		}
		
        
    }
    fclose($handle);
	
$row = 1;
	if (($handle = fopen("CNB.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
		
				$sql = "UPDATE CNB SET LATENESS='".$data[16]."' WHERE NO=".$data[0].";";
				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				echo $data[16] . "<br />\n";
				} 
				else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		}
		
        
    }
    fclose($handle);

$row = 1;
	if (($handle = fopen("GKP.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
		
				$sql = "UPDATE GKP SET LATENESS='".$data[16]."' WHERE NO=".$data[0].";";
				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				echo $data[16] . "<br />\n";
				} 
				else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		}
		
        
    }
    fclose($handle);	

$row = 1;
	if (($handle = fopen("JHS.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
		
				$sql = "UPDATE JHS SET LATENESS='".$data[16]."' WHERE NO=".$data[0].";";
				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				echo $data[16] . "<br />\n";
				} 
				else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		}
		
        
    }
    fclose($handle);	
$row = 1;
	if (($handle = fopen("LKO.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
		
				$sql = "UPDATE LKO SET LATENESS='".$data[16]."' WHERE NO=".$data[0].";";
				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				echo $data[16] . "<br />\n";
				} 
				else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		}
		
        
    }
    fclose($handle);

$row = 1;
	if (($handle = fopen("TDl.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
		
				$sql = "UPDATE TDL SET LATENESS='".$data[16]."' WHERE NO=".$data[0].";";
				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				echo $data[16] . "<br />\n";
				} 
				else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		}
		
        
    }
    fclose($handle);	
	
}


$conn->close();
?>
