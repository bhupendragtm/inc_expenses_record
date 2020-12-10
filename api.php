<?php
error_reporting(1);
header("Content-Type: application/json");
header("Expires: 0");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
require('conn.php');
$response = array();
$db = new Database();
$db->connect();

/* 	API methods
	API Written By Thulo Technology Pvt.Ltd
	For Thulo IMS
	Permission: Select, Insert & Update Only
	Last Updated Date: 2020: 04: 02
	------------------
	1.  get_businessdetailbyuid()
	2.  add_businesswithuser()
	3.  update_business()
	4.  get_userbybusinessid()
	5.  add_userbybusiness()
	6.  update_user()
	7.  update_userpassword()
	8.  get_salesbydate()
	9.  add_sales()
	10. update_sales()
	11. get_salesbybillno()
	12. get_salesbybillname()
	13. get_purchasebydate()
	14. add_purchase()
	15. update_purchases()
	16. get_sellsbybillno()
	17. searchpurchasebybillname()
	18. get_totalsalesandpurchasebetweendates()
	19. get_totalprofilterfromdates()
	20. get_totalpurchase()
	21. get_totalsales()
	22. add_history()
    23. get_history()
    24. get_historyofbusinessfromadmin()
    25. add_businesswithuser()
    26. check_login()
    27. delete_user()
    28. get_userdetailbyuid()
    29. get_salesbydatebybusiness()
	30. get_salesbyid()
	31. get_purchasebyid()
	32. get_salesbycatrgory()
	33. get_purchasebycategory()


	*/

// 1. get_businessdetailbyuid()
if(isset($_POST['access_key']) && isset($_POST['get_businessdetailbyuid']) && isset($_POST['u_id'])){
		/*	Parameters to be passed
		1. access_key
		2. get_businessdetailbyuid
		3. u_id
	*/
	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

	$u_id=$_POST['u_id'];

	$sql = "SELECT b_id, b_name, b_email, b_establishengdate, b_regnumber, b_pan, b_address, b_phone, b_numberofstaff, b_isadded, b_logo, b_isupdated, b_remarks FROM business, users WHERE business.b_id = users.business_id AND users.u_id ='$u_id';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['b_id'] = $row['b_id'];
			$tempRow['b_name'] = $row['b_name'];
			$tempRow['b_email'] = $row['b_email'];
			$tempRow['b_website'] = $row['b_website'];
			$tempRow['b_establishengdate'] = $row['b_establishengdate'];
			$tempRow['b_regnumber'] = $row['b_regnumber'];
			$tempRow['b_pan'] = $row['b_pan'];
			$tempRow['b_address'] = $row['b_address'];
			$tempRow['b_phone'] = $row['b_phone'];
			$tempRow['b_numberofstaff'] = $row['b_numberofstaff'];
			$tempRow['b_isadded'] = $row['b_isadded'];
			$tempRow['b_logo'] = $row['b_logo'];
			$tempRow['b_isupdated'] = $row['b_isupdated'];
			$tempRow['b_remarks'] = $row['b_remarks'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//2.  add_businesswithuser()
if(isset($_POST['access_key']) &&
 isset($_POST['add_businesswithuser']) &&
 isset($_POST['b_name']) &&
 isset($_POST['b_phone']) &&
 isset($_POST['u_fname']) &&
 isset($_POST['u_lname']) &&
 isset($_POST['u_name']) &&
 isset($_POST['u_email']) &&
 isset($_POST['u_password'])

){
	/*	Parameters to be passed
		1. access_key
		2. add_businesswithuser
		3. b_name
		4. b_phone
		5. u_fname
		6. u_lname
		7. u_name
		8. u_email
		9. u_password
	*/
	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$u_name = $_POST['u_name'];

$sql = "SELECT u_id FROM users WHERE u_name='$u_name';";
$db->sql($sql);
$res = $db->getResult();
if(empty($res)){
		// Self Code
		$bname  = $_POST['b_name'];
		$bphone = $_POST['b_phone'];
	
	
	$sql = "INSERT INTO business(b_name, b_phone, b_website, b_establishengdate, b_address,  b_numberofstaff, b_isadded, b_logo, b_remarks) VALUES ('$bname', '$bphone', 'N/A','N/A','N/A','2000-01-01','N/A','N/A','N/A'); ";
	$db->sql($sql);
	//$res = $db->getResult();
	$sql = "SELECT LAST_INSERT_ID() as b_id;";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$lastid = $row['b_id'];
			//echo $lastid;
	
			$data2 = array(
				'u_fname' => $_POST['u_fname'],
				'u_lname' => $_POST['u_lname'],
				'u_name' => $_POST['u_name'],
				'u_email' => $_POST['u_email'],
				'u_status' => 'Registered',
				'u_role' => 'Admin',
				'u_contact' => $bphone,
				'business_id' => $lastid,
				'u_password' => $_POST['u_password'],
				'u_password2' => 'N/A',
				'u_remarks' => 'N/A',
				'u_image' => 'N/A',
				'u_isdeleted' => '0',
				'u_isdeactivated' => '0'
			);
			$result =  $db->insert('users',$data2);

			if($result){
				$response['error'] = "false";
				$response['message'] = "Your Business is Successfully Registered. Now You Can Login.";
				print_r(json_encode($response));
				return true;
			}else {
				$response['error'] = "true";
				$response['message'] = "Failed to add data";
				print_r(json_encode($response));
				return false;
				}
			}
		}	
}else{
		$response['error'] = "true";
		$response['message'] = "Username is not available. Try using different username.";
		print_r(json_encode($response));

	}

}

// 3. update_business()
if(isset($_POST['access_key']) &&
 isset($_POST['update_business']) &&
 isset($_POST['b_id']) &&
 isset($_POST['b_name']) &&
 isset($_POST['b_email']) &&
 isset($_POST['b_website']) &&
 isset($_POST['b_phone']) &&
 isset($_POST['b_establishengdate']) &&
 isset($_POST['b_pan']) &&
 isset($_POST['b_numberofstaff']) &&
 isset($_POST['b_address']) &&
 isset($_POST['b_remarks'])
){
	/*	Parameters to be passed
		1. access_key
		2. update_customerstatus
		3. b_id
		4. b_name
		5. b_email
		6. b_website
		7. b_phone
		8. b_establishengdate
		9. b_pan
		10. b_numberofstaff
		11. b_address
		12. b_remarks
	*/

	$b_id = $_POST['b_id'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	// Self Code
	$data = array(
		'b_name' => $_POST['b_name'],
		'b_email' => $_POST['b_email'],
		'b_website' => $_POST['b_website'],
		'b_establishengdate' => $_POST['b_establishengdate'],
		'b_pan' => $_POST['b_pan'],
		'b_phone' => $_POST['b_phone'],
		'b_numberofstaff' => $_POST['b_numberofstaff'],
		'b_address' => $_POST['b_address'],
		'b_remarks' => $_POST['b_remarks']
	);

	$result =  $db->update('business',$data,"b_id='$b_id'");
	if($result){
		$response['error'] = "false";
		$response['message'] = "Business Updated.";
		print_r(json_encode($response));
		return true;
	}else {
		$response['error'] = "true";
		$response['message'] = "Failed to update data";
		print_r(json_encode($response));
		return false;
	}

}

// 4. get_userbybusinessid()
if(isset($_POST['access_key']) &&
   isset($_POST['get_userbybusinessid']) &&
   isset($_POST['business_id'])){
	/*	Parameters to be passed
		1. access_key
		2. get_userbybusinessid
		3. business_id
	*/
	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

	$b_id=$_POST['business_id'];

	$sql = "SELECT u_id, u_fname, u_lname, u_name, u_email, u_status, u_regdate, u_lastlogin, u_role, u_contact, u_remarks, u_isadded, u_isupdated, u_isdeactivated, u_isdeleted FROM users WHERE business_id='$b_id' AND u_isdeleted = '0';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['u_id'] = $row['u_id'];
			$tempRow['u_fname'] = $row['u_fname'];
			$tempRow['u_lname'] = $row['u_lname'];
			$tempRow['u_name'] = $row['u_name'];
			$tempRow['u_email'] = $row['u_email'];
			$tempRow['u_status'] = $row['u_status'];
			$tempRow['u_regdate'] = $row['u_regdate'];
			$tempRow['u_lastlogin'] = $row['u_lastlogin'];
			$tempRow['u_role'] = $row['u_role'];
			$tempRow['u_contact'] = $row['u_contact'];
			$tempRow['u_remarks'] = $row['u_remarks'];
			$tempRow['u_isdeactivated'] = $row['u_isdeactivated'];
			$tempRow['u_isdeleted'] = $row['u_isdeleted'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}


//5.  add_userbybusiness()
if(isset($_POST['access_key']) &&
   isset($_POST['add_userbybusiness']) &&
   isset($_POST['u_fname']) &&
   isset($_POST['u_lname']) &&
   isset($_POST['u_name']) &&
   isset($_POST['u_password']) &&
   isset($_POST['u_email']) &&
   isset($_POST['u_role']) &&
   isset($_POST['u_contact']) &&
   isset($_POST['u_remarks']) &&
   isset($_POST['business_id']))
{
	/*	Parameters to be passed
		1. access_key
		2. add_userbybusiness
		3. u_fname
		4. u_lname
		5. u_name
		6. u_password
		7. u_email
		8. u_role
		9.u_contact
		10.u_remarks
		11.business_id
	*/
	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	// Self Code
	$u_name = $_POST['u_name'];

	$sql = "SELECT u_id FROM users WHERE u_name='$u_name';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){

	$data = array(
		'u_fname' => $_POST['u_fname'],
		'u_lname' => $_POST['u_lname'],
		'u_name' => $_POST['u_name'],
		'u_password' => $_POST['u_password'],
		'u_email' => $_POST['u_email'],
		'u_role' => $_POST['u_role'],
		'u_contact' => $_POST['u_contact'],
		'u_remarks' => $_POST['u_remarks'],
		'business_id' => $_POST['business_id'],
		'u_isdeleted' => '0',
		'u_isdeactivated' => '0'
	);
	$result =  $db->insert('users',$data);
	if($result){
		$response['error'] = "false";
		$response['message'] = "User is Added Successfully.";
		print_r(json_encode($response));
		return true;
	}else {
		$response['error'] = "true";
		$response['message'] = "Failed to Add User.";
		print_r(json_encode($response));
		return false;
	}
	}else{
		$response['error'] = "true";
		$response['message'] = "Username is not available. Try using different username.";
		print_r(json_encode($response));
	}
}

// 6. update_user()

if(isset($_POST['access_key']) &&
   isset($_POST['update_user']) &&
   isset($_POST['u_id']) &&
   isset($_POST['u_fname']) &&
   isset($_POST['u_lname']) &&
   isset($_POST['u_name']) &&
   isset($_POST['u_password']) &&
   isset($_POST['u_status']) &&
   isset($_POST['u_role']) &&
   isset($_POST['u_email']) &&
   isset($_POST['u_contact']) &&
   isset($_POST['u_remarks']))
{
	/*	Parameters to be passed
		1. access_key
		2. update_user
		3. u_id
		4. u_fname
		5. u_lname
		6. u_name
		7. u_password
		8. u_status
		9. u_role
		10. u_email
		11. u_contact
		12. u_remarks
	*/
	$u_id = $_POST['u_id'];


	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	// Self Code
	$data = array(
		'u_fname' => $_POST['u_fname'],
		'u_lname' => $_POST['u_lname'],
		'u_name' => $_POST['u_name'],
		'u_email' => $_POST['u_email'],
		'u_status' => $_POST['u_status'],
		'u_role' => $_POST['u_role'],
		'u_contact' => $_POST['u_contact'],
		'u_password' => $_POST['u_password'],
		'u_remarks' => $_POST['u_remarks']
	);

	$result =  $db->update('users',$data,"u_id='$u_id'");
	if($result){
		$response['error'] = "false";
		$response['message'] = "Data updated Successfully";
		print_r(json_encode($response));
		return true;
	}
	else
	 {
		$response['error'] = "true";
		$response['message'] = "Failed to update data";
		print_r(json_encode($response));
		return false;
	}



}


//8.  get_salesbydate()
if(isset($_POST['access_key']) &&
   isset($_POST['get_salesbydate']) &&
   isset($_POST['s_date1']) && 
   isset($_POST['s_date2']) && 
   isset($_POST['s_userid']))
{
	/*	Parameters to be passed
		1. access_key
		2. get_salesbydate
		3. s_date1
		4. s_date2
		5. s_userid
	*/
	$date1 = $_POST['s_date1'];
	$date2 = $_POST['s_date2'];
	$userid = $_POST['s_userid'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = "SELECT s_id, s_name, s_phone, s_billno, s_category, s_status, s_amount, s_vatamount, s_remarks, s_isadded, s_isupdated, s_userid FROM sales JOIN users ON sales.s_userid = users.u_id JOIN business ON users.business_id = business.b_id AND business.b_id = (SELECT business_id FROM users WHERE u_id ='$userid') AND s_date BETWEEN '$date1' AND '$date2';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['s_id'] = $row['s_id'];
			$tempRow['s_name'] = $row['s_name'];
			$tempRow['s_phone'] = $row['s_phone'];
			$tempRow['s_billno'] = $row['s_billno'];
			$tempRow['s_category'] = $row['s_category'];
			$tempRow['s_status'] = $row['s_status'];
			$tempRow['s_amount'] = $row['s_amount'];
			$tempRow['s_vatamount'] = $row['s_vatamount'];
			$tempRow['s_remarks'] = $row['s_remarks'];
			$tempRow['s_isadded'] = $row['s_isadded'];
			$tempRow['s_isupdated'] = $row['s_isupdated'];
			$tempRow['s_userid'] = $row['s_userid'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//9.  add_sales()
if(isset($_POST['access_key']) &&
   isset($_POST['add_sales']) &&
   isset($_POST['s_name']) && 
   isset($_POST['s_phone']) && 
   isset($_POST['s_billno']) && 
   isset($_POST['s_category']) && 
   isset($_POST['s_status']) && 
   isset($_POST['s_date']) && 
   isset($_POST['s_amount']) && 
   isset($_POST['s_vatamount']) && 
   isset($_POST['s_remarks']) && 
   isset($_POST['s_userid']))
{
	{
		/*
			1. access_key
			2. add_sales
			3. s_name
			4. s_phone
			5. s_billno
			6. s_category
			7. s_status
			8. s_date
			9. s_amount
			10.s_vatamount
			11.s_remarks
			12.s_userid
		*/
		if($access_key != $_POST['access_key']){
			$response['error'] = "true";
			$response['message'] = "Invalid Access Key";
			print_r(json_encode($response));
			return false;
		}
		// Self Code
	
		$data = array(
			's_name' => $_POST['s_name'],
			's_phone' => $_POST['s_phone'],
			's_billno' => $_POST['s_billno'],
			's_category' => $_POST['s_category'],
			's_status' => $_POST['s_status'],
			's_date' => $_POST['s_date'],
			's_amount' => $_POST['s_amount'],
			's_vatamount' => $_POST['s_vatamount'],
			's_remarks' => $_POST['s_remarks'],
			's_userid' => $_POST['s_userid'],
			's_isdeleted' => '0'
		);
		$result =  $db->insert('sales',$data);
		if($result){
			$response['error'] = "false";
			$response['message'] = "Your Sales is Added successfully.";
			print_r(json_encode($response));
			return true;
		}else {
			$response['error'] = "true";
			$response['message'] = "Failed to add data";
			print_r(json_encode($response));
			return false;
		}
	}
	
}

// 10. update_sales()
if(isset($_POST['access_key']) &&
   isset($_POST['update_sales']) &&
   isset($_POST['s_name']) && 
   isset($_POST['s_phone']) && 
   isset($_POST['s_billno']) && 
   isset($_POST['s_category']) && 
   isset($_POST['s_status']) && 
   isset($_POST['s_date']) && 
   isset($_POST['s_amount']) && 
   isset($_POST['s_vatamount']) && 
   isset($_POST['s_remarks'])
){
	/*	Parameters to be passed
		1. access_key
		2. update_sales
		3. s_name
		4. s_phone
		5. s_billno
		6. s_category
		7. s_status
		8. s_date
		9. s_amount
		10. s_vatamount
		11. s_remarks
	*/

	$s_id = $_POST['s_id'];
	//$c_status = $_POST['c_status'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	// Self Code
	$data = array(
		's_name' => $_POST['s_name'],
		's_billno' => $_POST['s_billno'],
		's_phone' => $_POST['s_phone'],
		's_billno' => $_POST['s_billno'],
		's_category' => $_POST['s_category'],
		's_status' => $_POST['s_status'],
		's_date' => $_POST['s_date'],
		's_amount' => $_POST['s_amount'],
		's_vatamount' => $_POST['s_vatamount'],
		's_remarks' => $_POST['s_remarks']
	);

	$result =  $db->update('sales',$data,"s_id='$s_id'");
	if($result){
		$response['error'] = "false";
		$response['message'] = "Your Sales is Updated Successfully.";
		print_r(json_encode($response));
		return true;
	}else {
		$response['error'] = "true";
		$response['message'] = "Failed to update data";
		print_r(json_encode($response));
		return false;
	}

}

//11.  get_salesbybillno()
if(isset($_POST['access_key']) &&
   isset($_POST['get_salesbybillno']) &&
   isset($_POST['s_billno']))
{
	/*	Parameters to be passed
		1. access_key
		2. get_salesbybillno
		3. s_billno
	*/
	$billno = $_POST['s_billno'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT s_name, s_phone, s_billno, s_category, s_status, s_date, s_amount, s_vatamount, s_remarks, s_isadded, s_isupdated, s_userid FROM sales WHERE s_billno = '$billno';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['s_name'] = $row['s_name'];
			$tempRow['s_phone'] = $row['s_phone'];
			$tempRow['s_billno'] = $row['s_billno'];
			$tempRow['s_category'] = $row['s_category'];
			$tempRow['s_status'] = $row['s_status'];
			$tempRow['s_date'] = $row['s_date'];
			$tempRow['s_amount'] = $row['s_amount'];
			$tempRow['s_vatamount'] = $row['s_vatamount'];
			$tempRow['s_remarks'] = $row['s_remarks'];
			$tempRow['s_isadded'] = $row['s_isadded'];
			$tempRow['s_isupdated'] = $row['s_isupdated'];
			$tempRow['s_userid'] = $row['s_userid'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//12.  get_salesbybillname()
if(isset($_POST['access_key']) &&
 isset($_POST['get_salesbybillname']) &&
  isset($_POST['s_name']))
{
	/*	Parameters to be passed
		1. access_key
		2. get_salesbybillname
		3. s_name
	*/
	$s_name = $_POST['s_name'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT s_id, s_name, s_phone, s_name, s_category, s_status, s_date, s_amount, s_vatamount, s_remarks, s_isadded, s_isupdated, s_isdeleted, s_userid FROM sales WHERE s_name LIKE '%$s_name%';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['s_id'] = $row['s_id'];
			$tempRow['s_name'] = $row['s_name'];
			$tempRow['s_phone'] = $row['s_phone'];
			$tempRow['s_name'] = $row['s_name'];
			$tempRow['s_category'] = $row['s_category'];
			$tempRow['s_vatamount'] = $row['s_vatamount'];
			$tempRow['s_remarks'] = $row['s_remarks'];
			$tempRow['s_userid'] = $row['s_userid'];
			$tempRow['s_status'] = $row['s_status'];
			$tempRow['s_isadded'] = $row['s_isadded'];
			$tempRow['s_isupdated'] = $row['s_isupdated'];
			$tempRow['s_userid'] = $row['s_userid'];
			$tempRow['s_isdeleted'] = '0';
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//13.  get_purchasebydate()
if(isset($_POST['access_key']) &&
   isset($_POST['get_purchasebydate']) &&
   isset($_POST['p_date1']) && 
   isset($_POST['p_date2']) && 
   isset($_POST['p_userid']))
{
	/*	Parameters to be passed
		1. accesp_key
		2. get_purchasebydate
		3. p_date1
		4. p_date2
		5. p_userid
	*/
	$date1 = $_POST['p_date1'];
	$date2 = $_POST['p_date2'];
	$userid = $_POST['p_userid'];


	if($accesp_key != $_POST['accesp_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT p_id, p_name, p_phone, p_billno, p_category, p_status, p_date, p_amount, p_vatamount, p_remarks, p_isadded, p_isupdated, p_isdeleted, p_userid, business.b_id FROM purchases JOIN users ON purchases.p_userid = users.u_id JOIN business ON users.business_id = business.b_id AND business.b_id = (SELECT business_id FROM users WHERE u_id ='$userid') AND p_date BETWEEN '$date1' AND '$date2'";
	
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			
			$tempRow['p_id'] = $row['p_id'];
			$tempRow['p_name'] = $row['p_name'];
			$tempRow['p_phone'] = $row['p_phone'];
			$tempRow['p_billno'] = $row['p_billno'];
			$tempRow['p_category'] = $row['p_category'];
			$tempRow['p_amount'] = $row['p_amount'];
			$tempRow['p_vatamount'] = $row['p_vatamount'];
			$tempRow['p_remarks'] = $row['p_remarks'];
			$tempRow['p_userid'] = $row['p_userid'];
			$tempRow['p_status'] = $row['p_status'];
			$tempRow['p_isadded'] = $row['p_isadded'];
			$tempRow['p_isupdated'] = $row['p_isupdated'];
			$tempRow['p_userid'] = $row['p_userid'];
			$tempRow['p_isdeleted'] = '0';
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//14. add_purchase

if(isset($_POST['access_key']) &&
   isset($_POST['add_purchase']) &&
   isset($_POST['p_name']) && 
   isset($_POST['p_phone']) && 
   isset($_POST['p_billno']) && 
   isset($_POST['p_category']) && 
   isset($_POST['p_status']) && 
   isset($_POST['p_date']) && 
   isset($_POST['p_amount']) && 
   isset($_POST['p_vatamount']) && 
   isset($_POST['p_remarks']) && 
   isset($_POST['p_userid']))
{
		/*
			1. accesp_key
			2. add_purchase
			3. p_name
			4. p_phone
			5. p_billno
			6. p_category
			7. p_status
			8. p_date
			9. p_amount
			10.p_vatamount
			11.p_remarks
			12.p_userid
		*/
		if($accesp_key != $_POST['accesp_key']){
			$response['error'] = "true";
			$response['message'] = "Invalid Access Key";
			print_r(json_encode($response));
			return false;
		}
		// Self Code
	
		$data = array(
			'p_name' => $_POST['p_name'],
			'p_phone' => $_POST['p_phone'],
			'p_billno' => $_POST['p_billno'],
			'p_category' => $_POST['p_category'],
			'p_status' => $_POST['p_status'],
			'p_date' => $_POST['p_date'],
			'p_amount' => $_POST['p_amount'],
			'p_vatamount' => $_POST['p_vatamount'],
			'p_remarks' => $_POST['p_remarks'],
			'p_userid' => $_POST['p_userid'],
			'p_isdeleted' => '0'
			
		);
		$result =  $db->insert('purchases',$data);
		if($result){
			$response['error'] = "false";
			$response['message'] = "Your Purchase is Added Successfully.";
			print_r(json_encode($response));
			return true;
		}else {
			$response['error'] = "true";
			$response['message'] = "Failed to add data";
			print_r(json_encode($response));
			return false;
		}
	
}

// 15. update_purchases()
if(isset($_POST['access_key']) &&
   isset($_POST['update_purchases']) &&
   isset($_POST['p_id']) && 
   isset($_POST['p_name']) && 
   isset($_POST['p_phone']) && 
   isset($_POST['p_billno']) && 
   isset($_POST['p_category']) && 
   isset($_POST['p_status']) && 
   isset($_POST['p_date']) && 
   isset($_POST['p_amount']) && 
   isset($_POST['p_vatamount']) && 
   isset($_POST['p_remarks'])
){
	/*	Parameters to be passed
		1. access_key
		2. update_purchases
		3. p_id
		4. p_name
		5. p_phone
		6. p_billno
		7. p_category
		8. p_status
		9. p_date
		10.p_amount
		11.p_vatamount
		12.p_remarks
	*/

	$p_id = $_POST['p_id'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	// Self Code
	$data = array(
		'p_name' => $_POST['p_name'],
		'p_phone' => $_POST['p_phone'],
		'p_billno' => $_POST['p_billno'],
		'p_category' => $_POST['p_category'],
		'p_status' => $_POST['p_status'],
		'p_date' => $_POST['p_date'],
		'p_amount' => $_POST['p_amount'],
		'p_vatamount' => $_POST['p_vatamount'],
		'p_remarks' => $_POST['p_remarks']
	);

	$result =  $db->update('purchases',$data,"p_id='$p_id'");
	if($result){
		$response['error'] = "false";
		$response['message'] = "Your Purchase is Updated Successfully.";
		print_r(json_encode($response));
		return true;
	}else {
		$response['error'] = "true";
		$response['message'] = "Failed to update data";
		print_r(json_encode($response));
		return false;
	}

}

//16.  get_sellsbybillno()
if(isset($_POST['access_key']) &&
   isset($_POST['get_sellsbybillno']) &&
   isset($_POST['p_billno']))
{
	/*	Parameters to be passed
		1. access_key
		2. get_sellsbybillno
		3. p_billno
	*/
	$billno = $_POST['s_billno'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT s_id, s_name, s_phone, s_billno, s_category, s_status, s_date, s_amount, s_vatamount, s_remarks, s_isadded, s_isupdated, s_isdeleted, s_userid FROM purchases WHERE s_billno = '$billno';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['s_id'] = $row['s_id'];
			$tempRow['s_name'] = $row['s_name'];
			$tempRow['s_phone'] = $row['s_phone'];
			$tempRow['s_billno'] = $row['s_billno'];
			$tempRow['s_category'] = $row['s_category'];
			$tempRow['s_vatamount'] = $row['s_vatamount'];
			$tempRow['s_remarks'] = $row['s_remarks'];
			$tempRow['s_userid'] = $row['s_userid'];
			$tempRow['s_status'] = $row['s_status'];
			$tempRow['s_isadded'] = $row['s_isadded'];
			$tempRow['s_isupdated'] = $row['s_isupdated'];
			$tempRow['s_userid'] = $row['s_userid'];
			$tempRow['s_isdeleted'] = '0';
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//17.  get_sellsbybillno()
if(isset($_POST['access_key']) &&
   isset($_POST['get_purchasebybillname']) &&
   isset($_POST['p_name']))
{
	/*	Parameters to be passed
		1. access_key
		2. get_purchasebybillname
		3. p_name
	*/
	$p_name = $_POST['p_name'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT p_id, p_name, p_phone, p_name, p_category, p_status, p_date, p_amount, p_vatamount, p_remarks, p_isadded, p_isupdated, p_isdeleted, p_userid FROM purchases WHERE p_name LIKE '%$p_name%';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['p_id'] = $row['p_id'];
			$tempRow['p_name'] = $row['p_name'];
			$tempRow['p_phone'] = $row['p_phone'];
			$tempRow['p_name'] = $row['p_name'];
			$tempRow['p_category'] = $row['p_category'];
			$tempRow['p_vatamount'] = $row['p_vatamount'];
			$tempRow['p_remarks'] = $row['p_remarks'];
			$tempRow['p_userid'] = $row['p_userid'];
			$tempRow['p_status'] = $row['p_status'];
			$tempRow['p_isadded'] = $row['p_isadded'];
			$tempRow['p_isupdated'] = $row['p_isupdated'];
			$tempRow['p_userid'] = $row['p_userid'];
			$tempRow['p_isdeleted'] = '0';
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//18.  get_purchaseandsalesbydate()
if(isset($_POST['access_key']) &&
   isset($_POST['get_purchaseandsalesbydate']) &&
   isset($_POST['s_date1']) && 
   isset($_POST['s_date2']) && 
   isset($_POST['s_userid']))
{
	/*	Parameters to be passed
		1. access_key
		2. get_purchaseandsalesbydate
		3. s_date1
		4. s_date2
		5. s_userid
	*/
	$date1 = $_POST['s_date1'];
	$date2 = $_POST['s_date2'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT s_id, s_name, s_phone, s_billno, s_category, s_status, s_date, s_amount, s_vatamount, s_remarks, s_isadded, s_isupdated, s_isdeleted, s_userid FROM sales WHERE s_date BETWEEN '$date1' AND '$date2';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['s_id'] = $row['s_id'];
			$tempRow['s_name'] = $row['s_name'];
			$tempRow['s_phone'] = $row['s_phone'];
			$tempRow['s_billno'] = $row['s_billno'];
			$tempRow['s_category'] = $row['s_category'];
			$tempRow['s_vatamount'] = $row['s_vatamount'];
			$tempRow['s_remarks'] = $row['s_remarks'];
			$tempRow['s_userid'] = $row['s_userid'];
			$tempRow['s_status'] = $row['s_status'];
			$tempRow['s_isadded'] = $row['s_isadded'];
			$tempRow['s_isupdated'] = $row['s_isupdated'];
			$tempRow['s_userid'] = $row['s_userid'];
			$tempRow['s_isdeleted'] = '0';
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//19. get_useridbybusinessid()

if(isset($_POST['access_key']) &&
   isset($_POST['get_useridbybusinessid']) &&
   isset($_POST['business_id'])){
	/*	Parameters to be passed
		1. access_key
		2. get_useridbybusinessid
		3. business_id
	*/
	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

	$b_id=$_POST['business_id'];

	$sql = "SELECT u_id, u_isdeleted FROM users WHERE business_id='$b_id' ;";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['u_id'] = $row['u_id'];
			$tempRow['u_isdeleted'] = $row['u_isdeleted'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}}

	//20.  get_salesofbusinessbydateanduserid()
if(isset($_POST['access_key']) &&
   isset($_POST['get_salesofbusinessbydateanduserid']) &&
   isset($_POST['s_date1']) && 
   isset($_POST['s_date2']) && 
   isset($_POST['s_userid']))
{
   /*	Parameters to be passed
	   1. access_key
	   2. get_salesofbusinessbydateanduserid
	   3. s_date1
	   4. s_date2
	   5. s_userid
   */
   $date1 = $_POST['s_date1'];
   $date2 = $_POST['s_date2'];
   $userid = $_POST['s_userid'];

   if($access_key != $_POST['access_key']){
	   $response['error'] = "true";
	   $response['message'] = "Invalid Access Key";
	   print_r(json_encode($response));
	   return false;
   }
   $sql = "SELECT SUM(sales.s_amount) AS total_sum FROM sales JOIN users ON sales.s_userid = users.u_id JOIN business ON users.business_id = business.b_id AND business.b_id = (SELECT business_id FROM users WHERE u_id ='$userid') AND s_date BETWEEN '$date1' AND '$date2' ";
   $db->sql($sql);
   $res = $db->getResult();
   if(empty($res)){
	   $response['error'] = "true";
	   $response['message'] = "No any data found!";
	   print_r(json_encode($response));
   }else{
	   $tempRow = array();
	   $rows = array();
	   foreach($res as $row){
		   $tempRow['total_sum'] = $row['total_sum'];
		   $rows[] = $tempRow;
	   }
	   $response['error'] = "false";
	   $response['data'] = $rows;
	   print_r(json_encode($response));
   }
}

//21.  get_totalsales()
if(isset($_POST['access_key']) &&
   isset($_POST['get_totalsales']) &&
   isset($_POST['p_userid']))
{
	/*	Parameters to be passed
		1. accesp_key
		2. get_totalsales
		3. p_userid
	*/
	$userid = $_POST['p_userid'];


	if($accesp_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT SUM(purchases.p_amount) AS total_sum FROM purchases JOIN users ON purchases.p_userid = users.u_id JOIN business ON users.business_id = business.b_id AND business.b_id = (SELECT business_id FROM users WHERE u_id ='$userid')";
	
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['total_sum'] = $row['total_sum'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//22.  add_history()
if(isset($_POST['access_key']) &&
   isset($_POST['add_history']) &&
   isset($_POST['h_body']) &&
   isset($_POST['h_category']) &&
   isset($_POST['h_isadded']) &&
   isset($_POST['h_userid'])
){
	/*	Parameters to be passed
		1. access_key
		2. add_history
		3. h_body
		4. h_category
		5. h_isadded
		6. h_userid
	*/
	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	// Self Code

	$data = array(
		'h_body' => $_POST['h_body'],
		'h_category' => $_POST['h_category'],
		'h_isadded' => $_POST['h_isadded'],
		'h_userid' => $_POST['h_userid'],
		'h_isdeleted' => '0'
	);
	$result =  $db->insert('history',$data);
	if($result){
		$response['error'] = "false";
		$response['message'] = "Data Added Successfully";
		print_r(json_encode($response));
		return true;
	}else {
		$response['error'] = "true";
		$response['message'] = "Failed to add data";
		print_r(json_encode($response));
		return false;
	}
}

// 23. get_history()
if(isset($_POST['access_key']) && isset($_POST['get_history']) && isset($_POST['h_userid'])){
	/*	Parameters to be passed
	1. access_key
	2. get_history
	2. h_userid
*/
if($access_key != $_POST['access_key']){
	$response['error'] = "true";
	$response['message'] = "Invalid Access Key";
	print_r(json_encode($response));
	return false;
}

$h_userid = $_POST['h_userid'];
$sql = "SELECT h_id, h_body, h_category, h_isadded, h_isupdated, h_userid FROM history WHERE history. h_userid='$h_userid' ;";
$db->sql($sql);
$res = $db->getResult();
if(empty($res)){
	$response['error'] = "true";
	$response['message'] = "No any data found!";
	print_r(json_encode($response));
}else{
	$tempRow = array();
	$rows = array();
	foreach($res as $row){
		$tempRow['h_id'] = $row['h_id'];
		$tempRow['h_body'] = $row['h_body'];
		$tempRow['h_category'] = $row['h_category'];
		$tempRow['h_isadded'] = $row['h_isadded'];
		$tempRow['h_isupdated'] = $row['h_isupdated'];
		$tempRow['h_userid'] = $row['h_userid'];

		$rows[] = $tempRow;
	}
	$response['error'] = "false";
	$response['data'] = $rows;
	print_r(json_encode($response));
}}

// 24. get_historyofbusinessfromadmin()
if(isset($_POST['access_key']) && isset($_POST['get_historyofbusinessfromadmin']) && isset($_POST['h_userid']))
{
	/*	Parameters to be passed
	1. access_key
	2. get_historyofbusinessfromadmin
	3. h_userid
*/
if($access_key != $_POST['access_key']){
	$response['error'] = "true";
	$response['message'] = "Invalid Access Key";
	print_r(json_encode($response));
	return false;
}

$h_userid = $_POST['h_userid'];

$sql = "SELECT h_id, h_body, h_category, h_isadded, h_isupdated, h_userid FROM history,  users WHERE users.u_id= '$u_id' = users.business_id;";
$db->sql($sql);
$res = $db->getResult();
if(empty($res)){
	$response['error'] = "true";
	$response['message'] = "No any data found!";
	print_r(json_encode($response));
}else{
	$tempRow = array();
	$rows = array();
	foreach($res as $row){
		$tempRow['h_id'] = $row['h_id'];
		$tempRow['h_body'] = $row['h_body'];
		$tempRow['h_category'] = $row['h_category'];
		$tempRow['h_isadded'] = $row['h_isadded'];
		$tempRow['h_isupdated'] = $row['h_isupdated'];
		$tempRow['h_userid'] = $row['h_userid'];
		$rows[] = $tempRow;
	}
	$response['error'] = "false";
	$response['data'] = $rows;
	print_r(json_encode($response));
	}

}

//25.  add_businesswithuser()
if(isset($_POST['access_key']) &&
   isset($_POST['add_businesswithuser1']) &&
   isset($_POST['b_name']) &&
   isset($_POST['b_phone']) &&
   isset($_POST['u_fname']) &&
   isset($_POST['u_lname']) &&
   isset($_POST['u_name']) &&
   isset($_POST['u_email']) &&
   isset($_POST['u_password'])

){
	/*	Parameters to be passed
		1. access_key
		2. add_businesswithuser
		3. b_name
		4. b_phone
		5. u_fname
		6. u_lname
		7. u_name
		8. u_email
		9. u_password
	*/
	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$u_name = $_POST['u_name'];

$sql = "SELECT u_id FROM users WHERE u_name='$u_name';";
$db->sql($sql);
$res = $db->getResult();
if(empty($res)){
		// Self Code
		$bname  = $_POST['b_name'];
		$bphone = $_POST['b_phone'];
	
	
	$sql = "INSERT INTO business(b_name, b_phone, b_website, b_establishengdate, b_address,  b_numberofstaff, b_isadded, b_logo, b_remarks) 
	VALUES ('$bname', '$bphone', 'N/A','N/A','N/A','2000-01-01','N/A','N/A','N/A'); ";
	$db->sql($sql);
	//$res = $db->getResult();
	$sql = "SELECT LAST_INSERT_ID() as b_id;";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$lastid = $row['b_id'];
			//echo $lastid;
	
			$data2 = array(
				'u_fname' => $_POST['u_fname'],
				'u_lname' => $_POST['u_lname'],
				'u_name' => $_POST['u_name'],
				'u_email' => $_POST['u_email'],
				'u_status' => 'Registered',
				'u_role' => 'Admin',
				'u_contact' => $bphone,
				'business_id' => $lastid,
				'u_password' => $_POST['u_password'],
				'u_image' => 'N/A',
				'u_password2' => 'N/A',
				'u_remarks' => 'N/A',
				'u_isdeleted' => '0',
				'u_isdeactivated' => '0'
			);
			$result =  $db->insert('users',$data2);
	
			if($result){
				$response['error'] = "false";
				$response['message'] = "Your Business is Successfully Registered. Now You Can Login.";
				print_r(json_encode($response));
				return true;
			}else {
				$response['error'] = "true";
				$response['message'] = "Failed to add data";
				print_r(json_encode($response));
				return false;
				}
			}
		}	
}else{
		$response['error'] = "true";
		$response['message'] = "Username is not available. Try using different username.";
		print_r(json_encode($response));

	}

}

// 26. check_login()
if(isset($_POST['access_key']) &&
   isset($_POST['check_login']) &&
   isset($_POST['u_name']) &&
   isset($_POST['u_password']))
 {
	/*	Parameters to be passed
		1. access_key
		2. check_login
		3. u_name
		4. u_password
	*/
	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}

	$u_name	=	$_POST['u_name'];
	$u_password=$_POST['u_password'];

	$sql = "SELECT u_id, business.b_name, u_name, u_fname, u_email, u_status, u_role, u_contact, business_id FROM users, business WHERE u_name='$u_name' AND u_password='$u_password' AND u_status ='Registered' AND u_isdeactivated='0' AND u_isdeleted ='0' AND users.business_id = business.b_id ;";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['u_id'] = $row['u_id'];
			$tempRow['u_name'] = $row['u_name'];
			$tempRow['u_fname'] = $row['u_fname'];
			$tempRow['u_email'] = $row['u_email'];
			$tempRow['u_role'] = $row['u_role'];
			$tempRow['business_id'] = $row['business_id'];
			$tempRow['b_name'] = $row['b_name'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

// 27. delete_user()

if(isset($_POST['access_key']) &&
   isset($_POST['delete_user']) &&
   isset($_POST['u_id']) &&
   isset($_POST['u_isdeleted']))
{
	/*	Parameters to be passed
		1. access_key
		2. delete_user
		3. u_id
		4.u_isdeleted
	*/

	$u_id = $_POST['u_id'];
	$u_isdeleted = $_POST['u_isdeleted'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	// Self Code
	$data = array(
		'u_isdeleted' => '$u_isdeleted'
	);

	$result =  $db->update('users',$data,"u_id='$u_id'");
	if($result){
		$response['error'] = "false";
		$response['message'] = "User Deleted Successfully.";

		print_r(json_encode($response));
		return true;
	}else {
		$response['error'] = "true";
		if($u_isdeleted='1')
		$response['message'] = "Can't Delete User.";
		print_r(json_encode($response));
		return false;
	}

}

// 28. get_userdetailbyuid()
if(isset($_POST['access_key']) && isset($_POST['get_userdetailbyuid']) && isset($_POST['u_id'])){
	/*	Parameters to be passed
	1. access_key
	2. get_userdetailbyuid
	3. u_id
*/
if($access_key != $_POST['access_key']){
	$response['error'] = "true";
	$response['message'] = "Invalid Access Key";
	print_r(json_encode($response));
	return false;
}

$u_id=$_POST['u_id'];

$sql = "SELECT u_id, u_fname, u_lname, u_name, u_email, u_status, u_regdate, u_lastlogin, u_role, u_contact, u_remarks, u_isadded, u_isupdated, u_isdeactivated FROM users WHERE u_id='$u_id' AND u_isdeleted = '0';";
$db->sql($sql);
$res = $db->getResult();
if(empty($res)){
	$response['error'] = "true";
	$response['message'] = "No any data found!";
	print_r(json_encode($response));
}else{
	$tempRow = array();
	$rows = array();
	foreach($res as $row){
		$tempRow['u_id'] = $row['u_id'];
		$tempRow['u_fname'] = $row['u_fname'];
		$tempRow['u_lname'] = $row['u_lname'];
		$tempRow['u_name'] = $row['u_name'];
		$tempRow['u_email'] = $row['u_email'];
		$tempRow['u_status'] = $row['u_status'];
		$tempRow['u_regdate'] = $row['u_regdate'];
		$tempRow['u_lastlogin'] = $row['u_lastlogin'];
		$tempRow['u_contact'] = $row['u_contact'];
		$tempRow['u_role'] = $row['u_role'];
		$tempRow['u_remarks'] = $row['u_remarks'];
		$tempRow['u_isadded'] = $row['u_isadded'];
		$tempRow['u_isupdated'] = $row['u_isupdated'];
		$tempRow['u_isdeactivated'] = $row['u_isdeactivated'];
		$rows[] = $tempRow;
	}
	$response['error'] = "false";
	$response['data'] = $rows;
	print_r(json_encode($response));
}
}

//29.  get_salesbydatebybusiness()
if(isset($_POST['access_key']) &&
   isset($_POST['get_salesbydatebybusiness']) &&
   isset($_POST['s_date1']) && 
   isset($_POST['s_date2']) && 
   isset($_POST['s_userid']))
{
	/*	Parameters to be passed
		1. access_key
		2. get_salesbydatebybusiness
		3. s_date1
		4. s_date2
		5. s_userid
	*/
	$date1 = $_POST['s_date1'];
	$date2 = $_POST['s_date2'];
	$userid = $_POST['s_userid'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	$sql = "SELECT s_id, s_name, s_phone, s_billno, s_category, s_status, s_amount, s_vatamount, s_remarks, s_date, s_isadded, s_isupdated, s_userid FROM sales JOIN users ON sales.s_userid = users.u_id JOIN business ON users.business_id = business.b_id AND business.b_id = (SELECT business_id FROM users WHERE u_id ='$userid') AND s_date BETWEEN '$date1' AND '$date2';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['s_id'] = $row['s_id'];
			$tempRow['s_name'] = $row['s_name'];
			$tempRow['s_phone'] = $row['s_phone'];
			$tempRow['s_billno'] = $row['s_billno'];
			$tempRow['s_category'] = $row['s_category'];
			$tempRow['s_status'] = $row['s_status'];
			$tempRow['s_amount'] = $row['s_amount'];
			$tempRow['s_vatamount'] = $row['s_vatamount'];
			$tempRow['s_remarks'] = $row['s_remarks'];
			$tempRow['s_date'] = $row['s_date'];
			$tempRow['s_isadded'] = $row['s_isadded'];
			$tempRow['s_isupdated'] = $row['s_isupdated'];
			$tempRow['s_userid'] = $row['s_userid'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//30.  get_salesbyid()
if(isset($_POST['access_key']) &&
   isset($_POST['get_salesbyid']) &&
   isset($_POST['s_id']))
{
	/*	Parameters to be passed
		1. access_key
		2. get_salesbyid
		3. s_id
	*/
	$s_id = $_POST['s_id'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT s_name, s_phone, s_billno, s_category, s_status, s_date, s_amount, s_vatamount, s_remarks, s_isadded, s_isupdated, s_userid FROM sales WHERE s_id = '$s_id';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['s_name'] = $row['s_name'];
			$tempRow['s_phone'] = $row['s_phone'];
			$tempRow['s_billno'] = $row['s_billno'];
			$tempRow['s_category'] = $row['s_category'];
			$tempRow['s_status'] = $row['s_status'];
			$tempRow['s_date'] = $row['s_date'];
			$tempRow['s_amount'] = $row['s_amount'];
			$tempRow['s_vatamount'] = $row['s_vatamount'];
			$tempRow['s_remarks'] = $row['s_remarks'];
			$tempRow['s_isadded'] = $row['s_isadded'];
			$tempRow['s_isupdated'] = $row['s_isudated'];
			$tempRow['s_userid'] = $row['s_userid'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//31.  get_purchasebyid()
if(isset($_POST['access_key']) &&
   isset($_POST['get_purchasebyid']) &&
   isset($_POST['p_id']))
{
	/*	Parameters to be passed
		1. access_key
		2. get_purchasebyid
		3. p_id
	*/
	$p_id = $_POST['p_id'];

	if($access_key != $_POST['access_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT p_id, p_name, p_phone, p_name, p_category, p_status, p_date, p_amount, p_vatamount, p_remarks, p_isadded, p_billno, p_isdeleted, p_userid FROM purchases WHERE p_id='$p_id';";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['p_id'] = $row['p_id'];
			$tempRow['p_name'] = $row['p_name'];
			$tempRow['p_phone'] = $row['p_phone'];
			$tempRow['p_billno'] = $row['p_billno'];
			$tempRow['p_name'] = $row['p_name'];
			$tempRow['p_category'] = $row['p_category'];
			$tempRow['p_userid'] = $row['p_userid'];
			$tempRow['p_status'] = $row['p_status'];
			$tempRow['p_date'] = $row['p_date'];
			$tempRow['p_amount'] = $row['p_amount'];
			$tempRow['p_vatamount'] = $row['p_vatamount'];
			$tempRow['p_remarks'] = $row['p_remarks'];
			$tempRow['p_userid'] = $row['p_userid'];
			$tempRow['p_isdeleted'] = '0';
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}

//32.  get_salesbycatrgory()
if(isset($_POST['access_key']) &&
   isset($_POST['get_salesbycatrgory']) &&
   isset($_POST['u_id']) 
  )
{
	/*	Parameters to be passed
		1. access_key
		2. get_salesbycatrgory
		3. u_id
	*/
	$u_id = $_POST['u_id'];

	if($accesp_key != $_POST['accesp_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT DISTINCT s_category FROM sales JOIN users ON sales.s_userid = users.u_id JOIN business ON users.business_id = business.b_id 
	AND business.b_id = (SELECT business_id FROM users WHERE u_id ='$u_id') ;";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['s_category'] = $row['s_category'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}
//33.  get_purchasebycategory()
if(isset($_POST['access_key']) &&
   isset($_POST['get_purchasebycategory']) &&
   isset($_POST['u_id']) 
  )
  
{
	/*	Parameters to be passed
		1. access_key
		2. get_purchasebycategory
		3. u_id
	*/
	$u_id = $_POST['u_id'];

	if($accesp_key != $_POST['accesp_key']){
		$response['error'] = "true";
		$response['message'] = "Invalid Access Key";
		print_r(json_encode($response));
		return false;
	}
	
	$sql = "SELECT DISTINCT p_category FROM purchases JOIN users ON purchases.p_userid = users.u_id JOIN business ON users.business_id = business.b_id 
	AND business.b_id = (SELECT business_id FROM users WHERE u_id ='$u_id') ;";
	$db->sql($sql);
	$res = $db->getResult();
	if(empty($res)){
		$response['error'] = "true";
		$response['message'] = "No any data found!";
		print_r(json_encode($response));
	}else{
		$tempRow = array();
		$rows = array();
		foreach($res as $row){
			$tempRow['p_category'] = $row['p_category'];
			$rows[] = $tempRow;
		}
		$response['error'] = "false";
		$response['data'] = $rows;
		print_r(json_encode($response));
	}
}


?>