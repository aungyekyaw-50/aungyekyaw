<?php 
	@session_start();
?>
<?php 
	
	$con = new mysqli("localhost","root","","sayakha");//connect to sql
	$con->set_charset('utf8');//mysqli_set_charset('$con','utf8') for procedure
	/*if(isset($con))
	{
		echo "ချိတ်ဆက်နိုင်ပါသည်";

	}else
	{
		echo "မချိတ်ဆက်နိုင်ပါ";
	}*/
	if(isset($_POST["array"]))
	{
		
		//echo "see";
		$array = $_POST["array"];
		$array1=json_decode($array,true);
		//echo $array2;
		$col = "";
		$val = "";
		$size=sizeof($array1);//to get array size length
		//echo $size;
		foreach ($array1 as $key => $value) {
			if ($key==$size-1) {    
				$comma="";
			}
			else{
				$comma=",";//to get comma
			}
			$col.=$array1[$key][1]."".$comma." ";
			$val.="'".$array1[$key][0]."'".$comma." ";
		}
		//echo "INSERT INTO tbl_product ($col) values($val)";
		$query = $con->prepare("INSERT INTO tbl_main ($col) values($val)");
		//echo "see";
		if($query->execute() == true)
 		{
 			echo "good";
 		}
	}
	
	if(isset($_POST["pdf"]))
	{
		/*$pdfTmp=$_FILES['pdf']['tmp_name'];
		$pdfName=$_FILES['pdf']['name'];
		echo $pdfName;
		echo $pdfTmp;
		move_uploaded_file($pdfTmp, "pdf/$pdfName");
			if ($key==$size-1) {    
				$comma="";
			}
			else{
				$comma=",";//to get comma
			}
			$col.=$array1[$key][1]."".$comma." ";
			$val.="'".$array1[$key][0]."'".$comma." ";
		}
		//echo "INSERT INTO tbl_product ($col) values($val)";
		$query = $con->prepare("INSERT INTO tbl_main ($col) values($val)");
		//echo "see";
		if($query->execute() == true)
 		{
 			echo ("good");
 			//header("Location:index_person.php");
 			
 		}*/
	}
	if(isset($_POST["x"]))
	{
		
		//echo "see";
		$query = $con->prepare("SELECT * from tbl_main order by main_id desc ");
		$query->execute();
		$result=$query->get_result();
		$row=$result->num_rows;
		if($row == 0)
		{
			echo "0";
		}else{
		while($row=$result->fetch_assoc())
			{	
				extract($row);
				$array[]=array($main_id,$date,$rank,$accept,$rankaccepted,$come,$place,$note);
			}
			echo json_encode($array);
		}/**/
	}
	if(isset($_POST["id"]))
	{
		$id=$_POST["id"];
		$array=json_decode($id);
		echo $array;
		$size=sizeof($array);
		//echo $size;
		$idnum="";
		foreach ($array as $key => $value) {
			if ($key==$size-1) {
				$or="";
			}
			else{
				$or="or";//to get or
			}
			$idnum.=" "."main_id=".$array[$key]." ".$or." ";
		}
		$query=$con->prepare("DELETE from tbl_main where $idnum");
		if($query->execute() == true)
		{	
			echo "successful";
			//header("Location:responsive_test.php");
		}
		else
		{
			echo "fail";
			
		}/**/
	}
	if(isset($_POST["hello"]))
	{
		//global $leftjoin;	
		$hello=$_POST["hello"];
		//echo $hello;
		$query=$con->prepare("select place,rank from tbl_main ");
		$query->execute();
		$result=$query->get_result();
		//echo $row;
		$data=array();
		//echo $data;
		foreach ($result as $row){
		  $data[] = $row;
		}
		print json_encode($data);/**/
	}
	if(isset($_POST["mainid"]))
	{
		$id1=$_POST["mainid"];
		//echo "select * from tbl_main where main_id=$id1";
		$query=$con->prepare("select * from tbl_main where main_id=?");
		$query->bind_param("i",$id1);
		$query->execute();
		$result=$query->get_result();
		$row=$result->fetch_assoc(); 
		extract($row);
		$array[]=array($main_id,$date,$rank,$accept,$rankaccepted,$come,$place,$note);
		echo json_encode($array);
	}
	if(isset($_POST["editarray"]))
	{
		$editarray=$_POST["editarray"];
		$array2=json_decode($editarray,true);
		$query=$con->prepare("update tbl_main set date='$array2[0]', rank='$array2[1]', accept='$array2[2]', rankaccepted='$array2[3]', come='$array2[4]', place='$array2[5]', note='$array2[6]' where main_id=$array2[7]");

		if($query->execute() == true)
		{	
			echo "successful";
			//header("Location:responsive_test.php");
		}
		else
		{
			echo "fail";
			
		}/**/
	}
	if(isset($_POST["login"])){
		//echo "see";
		$departMent=$_POST["department"];
		$userLevel=$_POST["userLevel"];
		$username=$_POST["userName"];
		$password=$_POST["passWord"];		
		//echo $departMent.''.$userLevel.''.$username.''.$password;
		$query=$con->prepare("SELECT * FROM tbl_user WHERE user_role=? AND user_name=? AND password=?");
		$query->bind_param("sss",$userLevel,$username,$password);
		$query->execute();
		$result=$query->get_result();
		$rowNum=$result->num_rows;
		if($rowNum>0){
			$row=$result->fetch_assoc();
			extract($row);
			
			$_SESSION["user_id"]=$user_id;
			$_SESSION["user_name"]=$username;
			$_SESSION["user_role"]=$userLevel;
			echo $user_role;
			
		}else{
				echo "incorrect";
		}		
	}
    if(isset($_GET["data"]))
	{
	    $tripout="";
		$printlisttt=explode("/",$_GET["data"]);
		$tripout.="<table>
					<thead>
						<th>စဉ်</th>
						<th>ရက်စွဲ</th>
						<th>လက်ခံတွေ့ဆုံသူ၏ရာထူး</th>
						<th>လက်ခံတွေ့ဆုံသည့်ပုဂ္ဂိုလ်</th>
						<th>ဧည့်သည်၏ရာထူး</th>
						<th>လာရောက်တွေ့ဆုံသည့်ပုဂ္ဂိုလ်</th>
						<th>နေရာ</th>
						<th>မှတ်ချက်</th>
					</thead>";
				$count=0;
				foreach($printlisttt as $printlistpval)
				{	
					
					$query=$con->prepare("select * from tbl_main where main_id=?");
					$query->bind_param('i',$printlistpval);
					$query->execute();
					$result=$query->get_result();
					$rowNum=$result->num_rows;	
					if($rowNum>0)

					{		
							$count++;
						while($row=$result->fetch_assoc())
							{		
								extract($row);
								$tripout.="<tr>
										<td>$count</td>
										<td>$date</td>
										<td>$rank</td>
										<td>$accept</td>
										<td>$rankaccepted</td>
										<td>$come</td>
										<td>$place</td>
										<td>$note</td>
									</tr>
									";
							}
					}	
				}
				$tripout.="</table>";
         header('Content-Type: application/vnd.ms-excel');  
		 header('Content-disposition: attachment; filename='.rand().'.xls');  
		 echo $tripout;  /* */                             
	}
	if(isset($_POST["table_data"]))
	{
		$tripout="";
		$tripout.="<table>
					<thead>
						<th>စဉ်</th>
						<th>ရက်စွဲ</th>
						<th>လက်ခံတွေ့ဆုံသူ၏ရာထူး</th>
						<th>လက်ခံတွေ့ဆုံသည့်ပုဂ္ဂိုလ်</th>
						<th>ဧည့်သည်၏ရာထူး</th>
						<th>လာရောက်တွေ့ဆုံသည့်ပုဂ္ဂိုလ်</th>
						<th>နေရာ</th>
						<th>မှတ်ချက်</th>
					</thead>";
				$count=0;
					$query=$con->prepare("select * from tbl_main");
					$query->bind_param('i',$printlistpval);
					$query->execute();
					$result=$query->get_result();
					$rowNum=$result->num_rows;	
					if($rowNum>0)

					{		
							$count++;
						while($row=$result->fetch_assoc())
							{		
								extract($row);
								$tripout.="<tr>
										<td>$count</td>
										<td>$date</td>
										<td>$rank</td>
										<td>$accept</td>
										<td>$rankaccepted</td>
										<td>$come</td>
										<td>$place</td>
										<td>$note</td>
									</tr>
									";
							}
					}	
				
				$tripout.="</table>";
         header('Content-Type: application/vnd.ms-excel');  
		 header('Content-disposition: attachment; filename='.rand().'.xls');  
		 echo $tripout;  /* */
	}
	if(isset($_POST["searching"]))
	{
		$d1=$_POST['d1'];
		$d2=$_POST['d2'];
		$rankto=$_POST['rankto'];
		$to=$_POST['to'];
		$rankfrom=$_POST['rankfrom'];
		$from=$_POST['from'];
		$place1=$_POST['place1'];
		$searchVal="";
		if ($d1 =="" && $d2=="" && $rankto == "" && $to == "" && $rankfrom == "" && $from =="" && $place1=="") 
		{
			echo "type u wanted to search..";
			
		}else
		{
			if(!empty($rankto))
				{
					$searchVal .=" where rank LIKE '%$rankto%'";
				}
				if ($to != "")
				{
					if($searchVal !="")
					{
						$searchVal.=" AND accept LIKE '%$to%'";
					}else
					{
						$searchVal .=" WHERE accept LIKE '%$to%'";
					}
				}
				if ($rankfrom != "")
				{
					if($searchVal !="")
					{
						$searchVal .=" AND rankaccepted LIKE '%$rankfrom%'";

					}else
					{
						$searchVal .=" WHERE rankaccepted LIKE '%$rankfrom%'";
					}
				}
				if($from != "")
				{
					if($searchVal !="")
					{
						$searchVal .=" AND come LIKE '%$from%'";
					}else
					{
						$searchVal .=" where come  LIKE '%$from%'";
					}

				}
				if($place1 != "")
				{
					if($searchVal !="")
					{
						$searchVal .=" AND place LIKE '%$place1%'";
						}else
					{
						$searchVal .=" where place LIKE '%$place1%'";
					}

				}
				if($d1 != "" && $d2 != "")
				{
				if($searchVal !="")
					{
						$searchVal .=" AND date between '$d1' AND '$d2'";
						
					}else
					{
						$searchVal .=" where date between '$d1' and '$d2'";
					}

				}
			$query=$con->query(' SELECT * FROM tbl_main '. $searchVal );
			$rowNum=$query->num_rows;
			echo "<table class='searchtbl' style='text-align:center;'>
					<tr>
						<th>စဉ်</th>
						<th>ရက်စွဲ</th>
						<th>လက်ခံတွေ့ဆုံသူ၏ရာထူး</th>
						<th>လက်ခံတွေ့ဆုံသည့်ပုဂ္ဂိုလ်</th>
						<th>လာရောက်တွေ့ဆုံသည့်ပုဂ္ဂိုလ်၏ရာထူး</th>
						<th>လာရောက်တွေ့ဆုံသည့်ပုဂ္ဂိုလ်</th>
						<th>နေရာ</th>
						
					</tr>";
			echo "<tbody>";
			if($rowNum > 0)
			{
				$no=1;
				while ($row=$query->fetch_assoc()) 
				{
					extract($row);
					
					echo "<tr main_id='$main_id'>
								<td>$no</td>
								<td>$date</td>
								<td>$rank</td>
								<td>$accept</td>
								<td>$rankaccepted</td>
								<td>$come</td>
								<td>$place</td>
							</tr>";
				$no++;
				}
				
			}
			else{
				
				echo "<tr><td colspan='7' style='color:#800000;font-size:16px;'>-$d1-$d2-$rankto-$to-$rankfrom-$from-$place1-အမည်ဖြင့်အချက်အလက်ဖြည့်သွင်းထားခြင်းမရှိပါ။</td></tr>";
				echo "</tbody>";
				echo  "</table>";
			}
		}	
	}
?>