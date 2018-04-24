


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
      //echo nl2br("\nSchedule loaded");
	  
        if(isset($_POST['day']) AND $_POST['Time']){
            //echo nl2br("Checking conflicts");
			
			 $day=$_POST['day'];
				echo $day;
		$Time=$_POST['Time'];
				//echo nl2br(\n $Time);
				//$qr1="drop view V1;";
				$qr="SELECT DISTINCT t1.NO as TNO,t1.Name as TName,t1.Type as TType,t1.PF as TPF,t1.des as TDES, t1.dep as TDEP,t1.lateness as TLATENESS,t1.Travel_Time as TT ,ADDTIME(t1.ar,t1.lateness) as TAR,t2.NO,t2.Name,t2.Type,t2.PF,t2.des,t2.dep,t2.Lateness, t2.Travel_Time FROM CNB AS t1 JOIN CNB AS t2 ON  t1.PF=t2.PF AND t1.".$day."=t2.".$day." AND ADDTIME(t1.ar,t1.lateness) BETWEEN ADDTIME(t2.ar,t2.lateness) AND ADDTIME(t2.dep,t2.lateness)AND t1.NO!=t2.NO AND ADDTIME(t1.ar,t1.lateness) BETWEEN convert(\"".$Time."\",TIME) AND ADDTIME(convert(\"".$Time."\",TIME),convert(\"00:30:00\",TIME));";
				$qr2="Create OR Replace view V1 as SELECT DISTINCT t1.NO as TNO,t1.Name as TName,t1.Type as TType,t1.PF as TPF,t1.des as TDES, t1.dep as TDEP,t1.lateness as TLATENESS,t1.Travel_Time as TT ,ADDTIME(t1.ar,t1.lateness) as TAR,t2.NO,t2.Name,t2.Type,t2.PF,t2.des,t2.dep,t2.Lateness, t2.Travel_Time FROM CNB AS t1 JOIN CNB AS t2 ON  t1.PF=t2.PF AND t1.".$day."=t2.".$day." AND ADDTIME(t1.ar,t1.lateness) BETWEEN ADDTIME(t2.ar,t2.lateness) AND ADDTIME(t2.dep,t2.lateness)AND t1.NO!=t2.NO AND ADDTIME(t1.ar,t1.lateness) BETWEEN convert(\"".$Time."\",TIME) AND ADDTIME(convert(\"".$Time."\",TIME),convert(\"00:30:00\",TIME));";
				$qr3="CREATE TABLE V  AS (SELECT * V1);";
				$qr4="Insert into V (SELECT DISTINCT t1.NO,t1.Name,t1.Type,t1.P,t1.des, t1.dep,t1.lateness,t1.Travel_Time,ADDTIME(t1.ar,t1.lateness),t2.NO,t2.Name,t2.Type,t2.PF,t2.des,t2.dep,t2.Lateness, t2.Travel_Time FROM CNB AS t1 JOIN CNB AS t2 ON  t1.PF=t2.PF AND t1.".$day."=t2.".$day." AND ADDTIME(t1.ar,t1.lateness) BETWEEN ADDTIME(t2.ar,t2.lateness) AND ADDTIME(t2.dep,t2.lateness)AND t1.NO!=t2.NO AND ADDTIME(t1.ar,t1.lateness) BETWEEN convert(\"".$Time."\",TIME) AND ADDTIME(convert(\"".$Time."\",TIME),convert(\"00:30:00\",TIME)));";
				$qr5="Insert into V (SELECT * from V1);";
				if($conn->query($qr)==TRUE)
				{
					//echo nl2br("\n query executed\n");
					//mysqli_query($conn,$qr1);
					$result = mysqli_query($conn, $qr);
					mysqli_query($conn,$qr2);
						if (mysqli_num_rows($result) > 0) 
						{
							// output data of each row
							echo "<table border=\"1 px\">";
							echo "<tr><th>TNO</th><th>TName</th><th>TType</th><th>TPF</th><th>TDES</th><th>TDEP</th><th>TLATENESS</th><th>TT</th><th>TAR</th><th>NO</th><th>Name</th><th>Type</th><th>PF</th><th>DES</th><th>DEP</th><th>Lateness</th><th>Travel_Time</th></tr>";
							// output data of each row
								while($row = $result->fetch_assoc()) 
								{
									
								echo "<tr><td>".$row["TNO"]."</td><td>".$row["TName"]."</td><td>".$row["TType"]."</td><td>".$row["TPF"]."</td><td>".$row["TDES"]."</td><td>".$row["TDEP"]."</td><td>".$row["TLATENESS"]."</td><td>".$row["TT"]."</td><td>".$row["TAR"]."</td><td>".$row["NO"]."</td><td>".$row["Name"]."</td><td>".$row["Type"]."</td><td>".$row["PF"]."</td><td>".$row["des"]."</td><td>".$row["dep"]."</td><td>".$row["Lateness"]."</td><td>".$row["Travel_Time"]."</td></tr>";							
								   mysqli_query($conn,$qr4);								
								 
								 
								  //$t2=date_create($row["TLATENESS"],timezone_open("Europe/Oslo"));
								 
								 
								}
								/*	$i=0;
								 while ($fieldinfo=mysqli_fetch_field($result))
									{
									echo $i."	".$fieldinfo->name."<br>";
									 $i++;
									}
									*/
								echo "</table>";
								
								echo "<html><body><form method=\"get\" action= \"/capstone/new_schedule.php\"><button name=\"resolve\" type=\"submit\">Resolve conflict</button></form></br></body></html>";
						
								
								
								
						} 
						else 
						{
						echo nl2br("\n0 results");
						}
						
				}
				else
				{
					echo nl2br("\nquery failed");
				}
			
			
			
		}
        else 
		{
			echo nl2br("\n Nothing to Show");
        }
		mysqli_query($conn,$qr3);
		mysqli_query($conn,$qr5);
		mysqli_close($conn);
		echo "<a href=\"/capstone/conflict.html\"> New search </a>";
		
		
    ?>
     
	
