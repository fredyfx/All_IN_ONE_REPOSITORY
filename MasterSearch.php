<?php require'connection.php' ?>



<?php
$keysql1 = $keysql2=$keysql3= $state = $dept= $country=NULL;
$keysql1where=$keysql2where=$keysql3where=$keysql4where=$keysql5where=$keysql6where=$keysql7where=$keysql8where=$keysql9where=NULL;
$keysql10where=$keysql11where=$keysql12where=NULL;
$nationality=$color=$specs=$gender=$smoke=$alcohol=$category=$marital=$tambacco=NULL;
$address=$country=$city= NULL;
$count =1;
$flag1=$flag2=$flag5= $flag6=$flag8=$flag9=$flag10=$flag11=$flag12=FALSE;
//var_dump($_POST);
if(isset($_POST['submit'])){

	//starting line of queries
	$mainsql = NULL;
	$mainsql = "SELECT emp_fname,emp_lname FROM employees";
	$keysql2 =" LEFT JOIN emp_address ON employees.id = emp_address.id ";
	$keysql3= " LEFT JOIN emp_other ON employees.emp_code = emp_other.emp_code ";
	$keysql4 = " LEFT JOIN departments ON employees.dep_id = departments.id "; //for department table
	$keysql5 = " LEFT JOIN emp_bank ON employees.emp_code = emp_bank.emp_code ";
	$keysql6 = " LEFT JOIN emp_qualification ON employees.emp_code = emp_qualification.emp_code ";
	$keysql7 = " LEFT JOIN emp_contact ON employees.emp_code = emp_contact.emp_code ";
	$keysql8 = " LEFT JOIN emp_physical ON employees.emp_code = emp_physical.emp_code ";
	$keysql9 = " LEFT JOIN emp_professional ON employees.emp_code = emp_professional.emp_code ";
	$keysql10 = " LEFT JOIN emp_professional_record ON employees.emp_code = emp_professional_record.emp_code ";
	$keysql11 = " LEFT JOIN emp_reference ON employees.emp_code = emp_reference.emp_code ";
	$keysql12 = " LEFT JOIN emp_varification ON employees.emp_code = emp_varification.emp_code ";
	//search by varification
	//criminalciviloffense
    if(!empty($_POST['criminal'])){
		$flag12 = TRUE;
		$criminal = $_POST['criminal'];
		$keysql12where .= "  emp_varification.criminal_civil_offense LIKE '%$criminal%' AND ";
	} 

	//phone_sp
    if(!empty($_POST['phonesp'])){
		$flag12 = TRUE;
		$phonesp = $_POST['phonesp'];
		$keysql12where .= "  emp_varification.phone_sp LIKE '%$phonesp%' AND ";
	} 

	//officesp
    if(!empty($_POST['officesp'])){
		$flag12 = TRUE;
		$officesp = $_POST['officesp'];
		$keysql12where .= "  emp_varification.sp_office LIKE '%$officesp%' AND ";
	} 

	//chech for flag criinal
	if($flag12==TRUE){
		$mainsql .= $keysql12;
	}

	//search for reference table
	// search by comapny_name
	if(!empty($_POST['cname'])){
		$flag11 = TRUE;
		$cname = $_POST['cname'];
		$keysql11where .= "  emp_reference.company_name LIKE '%$cname%' AND ";
	} 

	// search by referer name
	if(!empty($_POST['refname'])){
		$flag11 = TRUE;
		$refname = $_POST['refname'];
		$keysql11where .= "  emp_reference.name LIKE '%$refname%' AND ";
	} 

	// search by pos
	if(!empty($_POST['refpos'])){
		$flag11 = TRUE;
		$refpos = $_POST['refpos'];
		$keysql11where .= "  emp_reference.position LIKE '%$refpos%' AND ";
	} 

	// search by pos
	if(!empty($_POST['refcode'])){
		$flag11 = TRUE;
		$refcode = $_POST['refcode'];
		$keysql11where .= "  emp_reference.reference_code LIKE '%$refcode%' AND ";
	} 

	//flag check for emp_reference
	if($flag11==TRUE){
		$mainsql .= $keysql11;
	}



	//search for emp_professional_record
	//search by by payscale
	if(!empty($_POST['payscale'])){
		$flag10 = TRUE;
		$payscale = $_POST['payscale'];
		$keysql10where .= "  emp_professional_record.pay_scale = '$payscale' AND ";
	} 

	//search by by designation
	if(!empty($_POST['designation'])){
		$flag10 = TRUE;
		$designation = $_POST['designation'];
		$keysql10where .= "  emp_professional_record.designation LIKE '%$designation%' AND ";
	} 

	//search by by end_period
	if(!empty($_POST['endp1']) && !empty($_POST['endp2'])){
		$flag10 = TRUE;
		$endp1 = $_POST['endp1'];
		$endp2 = $_POST['endp2'];
		$keysql10where .= "  emp_professional_record.end_period BETWEEN ($endp2 AND $endp1) AND ";
	} 

	//search by by start_period
	if(!empty($_POST['startp1']) && !empty($_POST['startp2'])){
		$flag10 = TRUE;
		$startp1 = $_POST['startp1'];
		$startp2 = $_POST['startp2'];
		$keysql10where .= "  emp_professional_record.start_period BETWEEN ($startp2 AND $startp1) AND ";
	} 

	//search by by organization name
	if(!empty($_POST['orgname'])){
		$flag10 = TRUE;
		$orgname = $_POST['orgname'];
		$keysql10where .= "  emp_professional_record.organization_name LIKE '%$orgname%' AND ";
	} 
	//flag check for emp_professional_record
	if($flag10==TRUE){
		$mainsql .= $keysql10;
	}



	//search for emp_professional
	//search by institute name
	if(!empty($_POST['institute'])){
		$flag9 = TRUE;
		$institute = $_POST['institute'];
		$keysql9where .= "  emp_professional.institute_name LIKE '%$institute%' AND ";
	} 
	//search by exam name
	if(!empty($_POST['examname'])){
		$flag9 = TRUE;
		$examname = $_POST['examname'];
		$keysql9where .= "  emp_professional.exam_name LIKE '%$examname%' AND ";
	} 

	//search by marks
	if(!empty($_POST['pmarks'])){
		$flag9 = TRUE;
		$pmarks = $_POST['pmarks'];
		$keysql9where .= "  emp_professional.marks = '$pmarks' AND ";
	} 

	//search by yop
	if(!empty($_POST['pyop'])){
		$flag9 = TRUE;
		$pyop = $_POST['pyop'];
		$keysql9where .= "  emp_professional.yop = '$pyop' AND ";
	} 
	//flag check for emp_professional
	if($flag9==TRUE){
		$mainsql.=$keysql9;
	}




	//for emp_physical table
	//search by height
	if(!empty($_POST['height'])){
		$flag8 = TRUE;
		$height = $_POST['height'];
		$keysql8where .= "  emp_physical.height = '$height' AND ";
	} 
	
	//search by weight
	if(!empty($_POST['weight'])){
		$flag8 = TRUE;
		$weight = $_POST['weight'];
		$keysql8where .= "  emp_physical.weight = '$weight' AND ";
	} 
	
	//search by extra
	if(!empty($_POST['extra'])){
		$flag8 = TRUE;
		$extra = $_POST['extra'];
		$keysql8where .= "  emp_physical.extra LIKE '%$extra%' AND ";
	} 
	//flag check for emp_physical
	if($flag8==TRUE){
		$mainsql .= $keysql8;
	}

	//for emp_contact table
	//search by mobile number
	if(!empty($_POST['mobile'])){
		$mainsql.=$keysql7;
		$mobile = $_POST['mobile'];
		$keysql7where .= "  (emp_contact.main LIKE '%$mobile%' OR emp_contact.first LIKE '%$mobile%' OR emp_contact.second LIKE '%$mobile%' ) AND ";
	} 



	//for emp_qualification
	//search by marks
	if(!empty($_POST['marks'])){
		$flag6 = TRUE;
		$marks = $_POST['marks'];
		$keysql6where .= "  emp_qualification.marks ='$marks' AND ";
	} 

	//search by subject
	if(!empty($_POST['subject'])){
		$flag6 = TRUE;
		$subject = $_POST['subject'];
		$keysql6where .= "  emp_qualification.subject ='$subject' AND ";
	} 

	//search by school
	if(!empty($_POST['school'])){
		$flag6 = TRUE;
		$school = $_POST['school'];
		$keysql6where .= "  emp_qualification.school ='$school' AND ";
	} 
	//search by qualification
	if(!empty($_POST['quali'])){
		$flag6 = TRUE;
		$quali = $_POST['quali'];
		$keysql6where .= "  emp_qualification.qualification ='$quali' AND ";
	} 
	//search by yop
	if(!empty($_POST['yop'])){
		$flag6 = TRUE;
		$yop = $_POST['yop'];
		$keysql6where .= "  emp_qualification.yop ='$yop' AND ";
	} 

	//search by pass
	if(!empty($_POST['pass'])){
		$flag6 = TRUE;
		$pass = $_POST['pass'];
		$keysql6where .= "  emp_qualification.pass ='$pass' AND ";
	} 

	//flag check for emp_qualification
	if($flag6==TRUE){
		$mainsql .= $keysql6;
	}



	//emp_bank
	//search by bank name
	if(!empty($_POST['bankname'])){
		$flag5 = TRUE;
		$bankname = $_POST['bankname'];
		$keysql5where .= "  emp_bank.bank_name LIKE '$bankname%' AND ";
	} 

	//search by acc
	if(!empty($_POST['acc'])){
		$flag5 = TRUE;
		$acc = $_POST['acc'];
		$keysql5where.= " emp_bank.account_no ='$acc' AND ";
	} 




	//search by ifsc
	if(!empty($_POST['ifsc'])){
		$flag5 = TRUE;
		$ifsc = $_POST['ifsc'];
		$keysql5where.= " emp_bank.ifsc ='$ifsc' AND ";
	} 


	//do for emp_bank
	if($flag5==TRUE){
		$mainsql .= $keysql5;
	}	


	//post for emp_address
	//search by  city
	if(!empty($_POST['city'])){
		$flag1 = TRUE;
		$city = $_POST['city'];
		$keysql2where .= "  emp_address.p_city ='$city' AND ";
	} 

	//search by state
	if(!empty($_POST['state'])){
		$flag1 = TRUE;
		$state = $_POST['state'];
		$keysql2where.= " emp_address.p_state ='$state' AND ";
	} 


	//search by address
	if(!empty($_POST['address'])){
		$flag1 = TRUE;
		$address = $_POST['address'];
		$keysql2where.= "  emp_address.p_address ='$address' AND ";
		
		} 

	//bycountry
	if(!empty($_POST['country'])){
		$flag1 = TRUE;
		$country = $_POST['country'];
		$keysql2where.= "  emp_address.p_country ='$country ' AND ";
		
		} 
	//do for emp_address
	if($flag1==TRUE){
		$mainsql .= $keysql2;
	} 

	//search by dept
	if(!empty($_POST['dept'])){

		$dept = $_POST['dept'];
		$mainsql .=$keysql4;
		$keysql4where .= "  departments.department='$dept' AND ";
	}

	//emp_other table
	//by gender
	if(isset($_POST['gender'])){
		$gender = $_POST['gender'];
		$flag2 = TRUE;
		$keysql3where.= " emp_other.gender='$gender' AND ";
	} 

	//by category
	if(isset($_POST['category'])){
		
		$category = $_POST['category'];
		if(!$category){
			$keysql3where.='';
		} else{
			$flag2=TRUE;
		$keysql3where.= "  emp_other.category='$category' AND";
			}
	} 

	//by tambacco
	if(isset($_POST['tombacco'])){
		$flag2=TRUE;
		$tombacco = $_POST['tombacco'];
		$keysql3where.= " emp_other.tobacco='$tombacco' AND ";
	} 

	//by alcohol
	if(isset($_POST['alcohol'])){
		$flag2=TRUE;
		$alcohol = $_POST['alcohol'];
		$keysql3where.= " emp_other.alcohol='$alcohol'  AND ";
	} 

	//by smoke
	if(isset($_POST['smoke'])){
		$flag2=TRUE;
		$smoke = $_POST['smoke'];
		$keysql3where.= "  emp_other.smoke='$smoke' AND ";
	}

	//by nationality
	if(isset($_POST['nationality'])){
		$flag2=TRUE;
		$nationality = $_POST['nationality'];
		$keysql3where.= "  emp_other.nationality='$nationality' AND ";
	} 

	//by marital
	if(isset($_POST['marital'])){
		$flag2=TRUE;
		$marital = $_POST['marital'];
		$keysql3where.= "  emp_other.marital='$marital' AND";
	} 

	//by color
	if(isset($_POST['color'])){
		$flag2=TRUE;
		$color = $_POST['color'];
		$keysql3where.= " emp_other.color='$color' AND";
	} 
	//by specs
	if(isset($_POST['specs'])){
		$flag2=TRUE;
		$specs = $_POST['specs'];
		$keysql3where.= "  emp_other.specs='$specs' AND";
	} 

	if($flag2==TRUE){
		$mainsql.=$keysql3;
	}

	//search by name
	if(!empty($_POST['key'])){
		$key = $_POST['key'];
		$keysql1where.= " (emp_fname LIKE '%$key%' OR emp_lname LIKE '%$key%') AND ";

	} 
	
	if(!empty($_POST['empcode'])){
		$empcode = $_POST['empcode'];
		$keysql1where.= " emp_code LIKE '%$empcode%'  AND ";

	} 

	//search by doj
	if(!empty($_POST['doj1']) && !empty($_POST['doj2'])){

		$doj1 = $_POST['doj1'];
		$doj2 = $_POST['doj2'];
		$keysql1where.= " emp_doj BETWEEN ($doj2 AND $doj1) AND ";
	} 

	//search by date of  leaving
	if(!empty($_POST['dol1']) && !empty($_POST['dol2'])){

		$dol1 = $_POST['dol1'];
		$dol2 = $_POST['dol2'];
		$keysql1where.= " emp_dol BETWEEN ($dol2 AND $dol1) AND ";
	} 
	
	//do something
	$mainsql.=" where";
	$mainsql.=$keysql1where;
	$mainsql.=$keysql2where;
	$mainsql.=$keysql3where;
	$mainsql.=$keysql4where;
	$mainsql.=$keysql5where;
	$mainsql.=$keysql6where;
	$mainsql.=$keysql7where;
	$mainsql.=$keysql8where;
	$mainsql.=$keysql9where;
	$mainsql.=$keysql10where;
	$mainsql .= $keysql11where;
	$mainsql .= $keysql12where;
	$mainsql.=' TRUE';
	try{ 
		
		//echo $mainsql.'<br/>';



			$query=$db->prepare($mainsql);
			//$query->bindParam(':key', $key, PDO::PARAM_STR);
			$query->execute();
			if($query->rowCount()>0) {
				while($row=$query->fetchObject())
			 	{
					//its getting data in line.And its an object
        			echo $count.".  ".$row->emp_fname."   ".$row->emp_lname."<br>";
        			$count++;
   			 	}
			} else{

				echo'NO RECORDS IN DATABASE FOR THIS QUERY';
			}

	
		}catch(PDOException  $e ){
			echo "Error: ".$e;
		} 
		
	

}
?>
