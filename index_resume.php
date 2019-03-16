<?php
	require_once("../rdb.php");
	$sql1 = "SELECT * FROM userresumeinfo " 	.
		"WHERE resumeID = 1 " 			. 
		"ORDER BY resumeID ASC"; 
	$result1 = mysqli_query($conn,$sql1);
	
	$sql2 = "SELECT * FROM applicantexperience "		.
		"WHERE sectiontype = 'SUMMARY'"; 
	$result2 = mysqli_query($conn,$sql2);

	$sql3 = "SELECT * FROM applicantexperience "		.
		"WHERE sectiontype = 'experience' and public = 1 order by infoid asc"; 
	$result3 = mysqli_query($conn,$sql3);


	$sql4 = "SELECT * FROM applicantexperience "	.
		"WHERE sectiontype = 'skills'"	.
		"ORDER BY infoID ASC"; 		 
	$result4 = mysqli_query($conn,$sql4);

	$sql5 = "SELECT * FROM applicantexperience "	.
		"WHERE sectiontype = 'education'"	.
		"ORDER BY infoID ASC"; 		 
	$result5 = mysqli_query($conn,$sql5);


	$sql = "SELECT * FROM applicantexperience "	.
		"WHERE sectiontype = 'project' AND public = 1 "	.
		"ORDER BY rank ASC"; 		 
	$result = mysqli_query($conn,$sql);

?>

<html>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Dosis:300,400,600,700&amp;lang=en" />
	<head>
		<style>
			body {
				background-color: rgb(255,255,250); 
				font-family: 'Dosis', helvetica, arial, sans-serif; 
				font-size: 14px; 
				line-height: 1.0;		
			}
			
			table { 
				border-collapse: collapse;
			}

			tr { 
				border: none; 
			}
			
			td.yesBorderright 	{ 
				border-right: 1px solid grey;
				width:100px;
			}
			td.yesBorderrightButtom { 
				border-right: 1px solid grey;
				border-bottom: 1px solid grey; 
				width:80px; 
			}
			td.yesBorderBottom { 
				border-bottom: 1px solid grey;
				width:580px;
			}
			td.yesBorderLeft{ 
				border-left: 1px solid grey; 
				width:580px;
			}
		
			ul {
				padding-left: 12px;
					margin: 0px;
			}
		</style>
	</head>

	<body>
	
	<table CELLPADDING=15">
	<?php while($row = mysqli_fetch_array($result1)) { ?>
	<tr  VALIGN=TOP>
		<td class="yesBorderrightButtom">
			<div><b><?php echo $row["applicantName"];?></b></div>
		</td>
		<td class="yesBorderBottom">	
			<div class="col1">
				<?php echo $row["personalInfo"] . "&nbsp; &nbsp;"; ?> 
			</div>
			</td>
	  </tr>
	<?php } ?>

	<?php while($row = mysqli_fetch_array($result2)) { ?>
	<tr  VALIGN=TOP>
		<td class="yesBorderright">
			<div><b>SUMMARY</b></div>
		</td>
		<td class="yesBorderLeft">	
			<div class="col1"> 
				<?php
					$i = 0;
					$str = $row["describework"];	 
					$arr = explode("\n", $str);
					foreach($arr as $value) {
						echo  $value . "<br/>";
						$i++;
					}
				?> 
			</div>
		</td>
	</tr>
	<?php } ?>

	<?php $x = 0; while($row = mysqli_fetch_array($result3)) { ?> 
	<tr VALIGN=TOP>
		<td class="yesBorderright">
			<div><b>
				<?php 
					if($x == 0){
						echo "EXPERIENCE";
					}
				?>
			</b></div> 
		</td>	
		<td>
			<div><b><?php 	echo $row["companyName" ];  ?></b>&nbsp; &nbsp;<?php echo $row["datesworked"]; ?> 
				<br/>
				<?php 
					$i = 0;
					$str = $row["describework"]; 
					$arr = explode("\n", $str);
					echo $arr[0];
					echo "<ul>";
					foreach($arr as $value) {
						if($i == 0) {
							$i++;
						}
						else {
							echo "<li type=\"circle\">" . $value . "<br/>";
							$i++;
						}
					}
					echo "</ul>";
				?> 
			</div>
		</td>
	</tr> <?php $x++; } ?>
	
	<?php while($row = mysqli_fetch_array($result4)) { ?>
	<tr  VALIGN=TOP>
		<td class="yesBorderright">
			<div><b>SKILLS</b></div>
		</td>
		<td class="yesBorderLeft">	
			<div class="col1"> <?php echo str_replace("\n" , "<div></div>" , $row["describework"]); ?> </div>
		</td>	
	</tr>
	<?php } ?>


	<?php while($row = mysqli_fetch_array($result5)) { ?>
	<tr  VALIGN=TOP>
		<td class="yesBorderright">
			<div><b>EDUCATION</b></div>
		</td>
		<td class="yesBorderLeft" style=>	
		<div class="col1"><?php echo str_replace("\n" , "<p>" , $row["describework"]); ?> </div>
		</td>	
	</tr>
	<?php } ?>
	</table>

	</body>
</html>
