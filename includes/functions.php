<?php
    function create_hash($string)
	{
		return sha1($string);
	}

	function get_action_attr_value_for_current_page($query="")
	{
		$query = $query === "" ? $query : "?$query";
		return preg_replace("/index\.php|index|\.php$/", "", htmlspecialchars($_SERVER["PHP_SELF"])) . $query;
	}

	function redirect_to_current_page($query="")
	{
		echo "<script>window.location='".preg_replace("/index\.php|index|\.php$/", "", htmlspecialchars($_SERVER["PHP_SELF"]))."?$query';</script>";
		exit(0);
	}

	function create_token()
	{
		return md5(uniqid(rand(), true));
	}

    function include_view_messages_file()
	{
		require_once($_SERVER["DOCUMENT_ROOT"]."/includes/view_messages_and_errors.php");
	}

	function is_email_address_available_in_users_table($email_address){
		global $db;
		$sql = "SELECT COUNT(1) AS 'count' FROM users WHERE email_address = :email_address";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":email_address", $email_address, PDO::PARAM_STR);
		if($stmt->execute()){
			return $stmt->fetch(PDO::FETCH_ASSOC)["count"] > 0 ? true : false;
		}
		return false;
	}

	function registration($data){
		global $db;
		extract($data);
		$email_address = htmlspecialchars(trim($email_address));

		if(filter_var($email_address, FILTER_VALIDATE_EMAIL) === false)
		{
			$_SESSION["error_messages"][] = "Invalid email address, Please enter vaild email address.";
		}

		if(is_email_address_available_in_users_table($email_address) === true)
		{
			$_SESSION["error_messages"][] = "This email address is already registered.";	
		}

		if($password !== $confirm_password)
		{
			$_SESSION["error_messages"][] = "Password and Confirm Password does not match.";	
		}

		if(!isset($_SESSION["error_messages"])){
			$password = create_hash($password);
			$token = create_token();
			$sql = "INSERT INTO users (email_address, password, email_address_verified, token) VALUES (:email_address, :password, '1', :token)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":email_address", $email_address, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":token", $token, PDO::PARAM_STR);

			if($stmt->execute()){
				$user_id = $db->lastInsertId();
				$sql = "INSERT INTO user_details (user_id, email_address) VALUES (:user_id, :email_address)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
				$stmt->bindParam(":email_address", $email_address, PDO::PARAM_STR);
				$stmt->execute();
				return true;
			}
			else
			{
				$_SESSION["error_messages"][] = "Sorry, something went wrong creating your account, Please try again soon.";	
			}
		}
		return false;
	}

	function login($data){
		global $db;
		extract($data);
		$email_address = htmlspecialchars(trim($email_address));
		$password = create_hash($password);

		$sql = "SELECT user_id , role FROM users WHERE email_address = :email_address AND password = :password";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':email_address', $email_address, PDO::PARAM_STR);
		$stmt->bindParam(':password', $password, PDO::PARAM_STR);

		if($stmt->execute())
		{
			if ($stmt->rowCount() > 0)
			{
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				$_SESSION["user_id"] = $result["user_id"];
				$_SESSION["role"] = $result["role"];
				return true;
			}
		}
		$_SESSION["error_messages"][] = "Invalid Email or Password";
		return false;
	}

	function get_user_details_using_id()
	{
		global $db;
		$user_id = $_SESSION["user_id"];

		$sql = "SELECT * FROM user_details WHERE user_id = :user_id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

		if ($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			return false;
		}
	}

	function update_user_profile_detail($data)
	{
		global $db;
		extract($data);

		if (!isset($_SESSION["error_messages"]))
		{
		    $user_id = $_SESSION["user_id"];
		    $sql = "UPDATE user_details SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name, dob = :dob, gender = :gender, contact_number = :contact_number, modified_timestamp = NOW() WHERE user_id = :user_id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
			$stmt->bindParam(':middle_name', $middle_name, PDO::PARAM_STR);
			$stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
			$stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
			$stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
			$stmt->bindParam(':contact_number', $contact_number, PDO::PARAM_INT);
			//$stmt->bindParam(':photo_url', $photo_url, PDO::PARAM_STR);
			  
			  
		   if($stmt->execute())
			{
			   $_SESSION["success_messages"][] = "Profile Details updated";
			   
			}
			else
			{
			   $_SESSION["error_messages"][] = "Sorry, something went wrong while updating your account, Please try again soon.";
			}
		}
		return false;
	}

	function update_user_address_detail($data){
		global $db;
		extract($data);

		if (!isset($_SESSION["error_messages"]))
		{
			$user_id = $_SESSION["user_id"];
			$sql = "UPDATE user_details SET street_address = :street_address, city = :city, state = :state, postal_code = :postal_code, modified_timestamp = NOW() WHERE user_id = :user_id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':street_address', $street_address, PDO::PARAM_STR);
			$stmt->bindParam(':city', $city, PDO::PARAM_STR);
			$stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
			$stmt->bindParam(':state', $state, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Address Details Updated";
			}
			else
			{
				$_SESSION["error_messages"][] = "Sorry, something went wrong while updating your account, Please try again soon.";
			}
		}
		return false;
	}

	function get_user_using_id(){
		global $db;
		$user_id = $_SESSION["user_id"];

		$sql = "SELECT * FROM users WHERE user_id = :user_id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

		if ($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			return false;
		}
	}

	function get_user_by_passing_id($id){
		global $db;
		$sql = "SELECT * FROM users WHERE user_id = $id";
		$stmt = $db->prepare($sql);
		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function get_category_names()
 	{
  		global $db;
  		$sql = "SELECT * FROM category WHERE deleted = '0'";
 	 	$stmt = $db->prepare($sql);
  		
		if($stmt->execute())
  		{
   			return $stmt->fetchAll(PDO::FETCH_ASSOC);
  		}
  		return false;
 	}

	function is_category_name_available_in_category_table($category_name)
	{
		global $db;
		$sql = "SELECT COUNT(1) as 'count' FROM category WHERE name = :category_name AND deleted = '0'";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);

		if($stmt->execute())
		{
			$result=$stmt->fetch(PDO::FETCH_ASSOC)["count"];
			return $result> 0 ? true : false;
		}
		return false;
	}

	function add_category_name($data)
	{
		global $db;
		extract($data);

		if (is_category_name_available_in_category_table($category_name) === true)
		{
			$_SESSION["error_messages"][] = "This record already exists.";
		}
		
		if (!isset($_SESSION["error_messages"]))
		{
			$sql = "INSERT INTO category (name,disabled,deleted) VALUES (:category_name,'0','0')";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);
			
			if ($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Category added Successfully.";
				return true;
			}
		}
		return false;
	}

	function get_category_by_id($id)
	{
		global $db;
		$sql = "SELECT * FROM category WHERE id = $id";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}
	
	function delete_category_by_id($id)
	{
		global $db;
		$sql = "UPDATE category SET deleted = '1', deleted_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$_SESSION["success_messages"][] = "Deleted Successfully.";
			return true;
		}
		return false;
	}

	function edit_category_by_id($category_name, $id)
	{
		global $db;
		$sql = "UPDATE category SET name = :category_name, modified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':category_name', $category_name, PDO::PARAM_STR);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}

	function enable_disable_category($disabled, $id)
	{
		global $db;
		$sql = "UPDATE category SET disabled = '$disabled', modified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}

	function change_password($data)
	{
		global $db;
		extract($data);

		if($new_password !== $confirm_password)
		{
			$_SESSION["error_messages"][] = "New password and Confirm Password does not match.";	
		}

		if(!isset($_SESSION["error_messages"]))
		{
			$new_password = create_hash($new_password);
			$user_id = $_SESSION["user_id"];
			$sql = "UPDATE users SET password=:new_password, last_reset_password_timestamp = NOW() WHERE user_id = $user_id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':new_password', $new_password,PDO::PARAM_STR);
			
			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Congratulation, password successfully changed";
    			return true;
   			}
   			else
   			{
    			$_SESSION["error_messages"][] = "Sorry, password didn't changed.";
   			}
		}
		else
		{
			return false;
		}
	}
	
	function get_user_list_from_users()
	{
		global $db;

		$sql = "SELECT * FROM users WHERE role = 'user'";
		$stmt = $db->prepare($sql);

		if ($stmt->execute())
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function enable_disable_user($disabled, $id)
	{
		global $db;
		$sql = "UPDATE users SET disabled = '$disabled' WHERE user_id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}

	function pending_approve_disapprove_user($account_verified, $id)
	{
		global $db;
		$sql = "UPDATE users SET account_verified = '$account_verified' WHERE user_id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			$_SESSION["success_messages"][] = "Updated successfully.";
			return true;
		}

		return false;
	}

	function get_user_details_by_passing_id($id)
	{
		global $db;
		$sql = "SELECT * FROM user_details WHERE user_id = $id";
		$stmt = $db->prepare($sql);
		
		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function add_book_request($data)
	{
		global $db;
		extract($data);
		$user_id = $_SESSION["user_id"];
		$sql = "INSERT INTO book_request (user_id, name, author, isbn, publisher, edition) VALUES (:user_id, :book_name, :author, :isbn, :publisher, :edition)";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->bindParam(':book_name', $book_name, PDO::PARAM_STR);
		$stmt->bindParam(':author', $author, PDO::PARAM_STR);
		$stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
		$stmt->bindParam(':publisher', $publisher, PDO::PARAM_STR);
		$stmt->bindParam(':edition', $edition, PDO::PARAM_STR);

		if($stmt->execute())
		{
			$_SESSION["success_messages"][] = "Your Request has been recieved. You will get an email regarding the action taken on your request in 2 to 3 days!";
			return true;
		}
		return false;
	}

	function get_book_request_detail(){
		global $db;
		$sql = "SELECT * FROM book_request";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function get_book_request_detail_using_id($id)
	{
		global $db;
		$sql = "SELECT * FROM book_request WHERE id = $id";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;	
	}

	function accept_book_request($data,$id)
	{
		global $db;
		extract($data);
		$sql = "UPDATE book_request SET status = '1', status_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$sql = "INSERT INTO book_request_achieved (request_id, description) VALUES (:id, :accept_description)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':accept_description', $accept_description, PDO::PARAM_STR);
			
			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Description related to book request has been Added";
				return true;
			}
			return false;
		}
	}

	function reject_book_request($data,$id)
	{
		global $db;
		extract($data);
		$sql = "UPDATE book_request SET status = '2', status_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$sql = "INSERT INTO book_request_achieved (request_id, description) VALUES (:id, :reject_description)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':reject_description', $reject_description, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Description related to book request has been Added";
				return true;
			}
			return false;
		}
	}

	// function upload_file($file, $targetDirectory, $allowedExtensions) {
	// 	$fileName = basename($file["name"]);
	// 	$targetFile = $targetDirectory . $fileName;
	// 	$fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
	  
	// 	// Check if the file has a valid extension
	// 	if (!in_array($fileExtension, $allowedExtensions)) {
	// 	  return ""; // Return an empty string if the file has an invalid extension
	// 	}
	  
	// 	// Move the uploaded file to the target directory
	// 	if (move_uploaded_file($file["tmp_name"], $targetFile)) {
	// 	  return $targetFile; // Return the URL of the uploaded file
	// 	}
	  
	// 	return ""; // Return an empty string if there was an error during file upload
	// }

	function perform_book_selling($data)
	{
		global $db;
		extract($data);
		//$cover_url = isset($_FILES['cover_url']) ? upload_file($_FILES['cover_url'], "assets/img/Sell_Request_Book_Images/", ["jpg", "jpeg", "png", "gif"]) : "";

		if(!isset($_SESSION["error_messages"]))
		{
			$user_id = $_SESSION["user_id"];
			$sql = "INSERT INTO book_selling (user_id, title, category_id, language_id, price, author, isbn, department_id, description, cover_url, index_url, verified, uploaded) VALUES (:user_id, :title, :book_type, :language, :price, :author, :isbn, :department, :description, :cover_url, :index_url, '0', '0')";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':title', $title, PDO::PARAM_STR);
			$stmt->bindParam(':book_type', $book_type, PDO::PARAM_STR);
			$stmt->bindParam(':language', $language, PDO::PARAM_STR);
			$stmt->bindParam(':price', $price, PDO::PARAM_STR);
			$stmt->bindParam(':author', $author, PDO::PARAM_STR);
			$stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
			$stmt->bindParam(':department', $department, PDO::PARAM_STR);
			$stmt->bindParam(':description', $description, PDO::PARAM_STR);
			$stmt->bindParam(':cover_url', $cover_url, PDO::PARAM_STR);
			$stmt->bindParam(':index_url', $index_url, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Thank you for becoming a seller. Your product will be verified at our end and the details regarding it will be provided to you sooner!";
			}
			else
			{
				$_SESSION["error_messages"][] = "Sorry, Something went wrong try again after sometimes";
			}
		}
		return false;
	}

	function perform_accessory_selling($data)
	{
		global $db;
		extract($data);
		// $photo_url = isset($_FILES['photo_url']) ? upload_file($_FILES['photo_url'], "assets/img/Sell_Request_Book_Images/", ["jpg", "jpeg", "png", "gif"]) : "";
		// $photo_url2 = isset($_FILES['photo_url2']) ? upload_file($_FILES['photo_url2'], "assets/img/Sell_Request_Book_Images/", ["jpg", "jpeg", "png", "gif"]) : "";

		if(!isset($_SESSION["error_messages"]))
		{
			$user_id = $_SESSION["user_id"];
			$sql = "INSERT INTO accessory_selling (user_id, title, sub_category_id, brand, processor, screen_size, price, description, photo_url, photo_url2, verified, uploaded) VALUES (:user_id, :title, :accessory_type, :brand, :processor, :screen_size, :price, :description, :photo_url, :photo_url2, '0', '0')";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':title', $title, PDO::PARAM_STR);
			$stmt->bindParam(':accessory_type', $accessory_type, PDO::PARAM_STR);
			$stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
			$stmt->bindParam(':processor', $processor, PDO::PARAM_STR);
			$stmt->bindParam(':screen_size', $screen_size, PDO::PARAM_STR);
			$stmt->bindParam(':price', $price, PDO::PARAM_STR);
			$stmt->bindParam(':description', $description, PDO::PARAM_STR);
			$stmt->bindParam(':photo_url', $photo_url, PDO::PARAM_STR);
			$stmt->bindParam(':photo_url2', $photo_url2, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Thank you for becoming a seller. Your product will be verified at our end and the details regarding it will be provided to you sooner!";
			}
			else
			{
				$_SESSION["error_messages"][] = "Sorry, Something went wrong try again after sometimes";
			}
		}
		return false;
	}

	function get_book_sell_request_detail()
	{
		global $db;
		$sql = "SELECT * FROM book_selling WHERE verified = '0'";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function get_book_sell_request_detail_using_id($id)
	{
		global $db;
		$sql = "SELECT * FROM book_selling WHERE id = $id";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function get_accessory_sell_request_detail()
	{
		global $db;
		$sql = "SELECT * FROM accessory_selling WHERE verified = '0'";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function get_accessory_sell_request_detail_using_id($id)
	{
		global $db;
		$sql = "SELECT * FROM accessory_selling WHERE id = $id";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function is_department_name_available_in_department_table($department_name)
	{
		global $db;
		$sql = "SELECT COUNT(1) as 'count' FROM department WHERE name = :department_name AND deleted = '0'";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':department_name', $department_name, PDO::PARAM_STR);

		if($stmt->execute())
		{
			$result=$stmt->fetch(PDO::FETCH_ASSOC)["count"];
			return $result> 0 ? true : false;
		}
		return false;
	}

	function get_department_names()
 	{
  		global $db;
  		$sql = "SELECT * FROM department WHERE deleted = '0'";
 	 	$stmt = $db->prepare($sql);
  		
		if($stmt->execute())
  		{
   			return $stmt->fetchAll(PDO::FETCH_ASSOC);
  		}
  		return false;
 	}

	function add_department_name($data)
	{
		global $db;
		extract($data);

		if (is_department_name_available_in_department_table($department_name) === true)
		{
			$_SESSION["error_messages"][] = "This record already exists.";
		}
		
		if (!isset($_SESSION["error_messages"]))
		{
			$sql = "INSERT INTO department (name,disabled,deleted) VALUES (:department_name,'0','0')";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':department_name', $department_name, PDO::PARAM_STR);
			
			if ($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Department added Successfully.";
				return true;
			}
		}
		return false;
	}

	function get_department_by_id($id)
	{
		global $db;
		$sql = "SELECT * FROM department WHERE id = $id";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}
	
	function delete_department_by_id($id)
	{
		global $db;
		$sql = "UPDATE department SET deleted = '1', deleted_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$_SESSION["success_messages"][] = "Deleted Successfully.";
			return true;
		}
		return false;
	}

	function edit_department_by_id($department_name, $id)
	{
		global $db;
		$sql = "UPDATE department SET name = :department_name, modified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':department_name', $department_name, PDO::PARAM_STR);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}

	function enable_disable_department($disabled, $id)
	{
		global $db;
		$sql = "UPDATE department SET disabled = '$disabled', modified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}

	function is_language_name_available_in_language_table($language_name)
	{
		global $db;
		$sql = "SELECT COUNT(1) as 'count' FROM language WHERE name = :language_name AND deleted = '0'";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':language_name', $language_name, PDO::PARAM_STR);

		if($stmt->execute())
		{
			$result=$stmt->fetch(PDO::FETCH_ASSOC)["count"];
			return $result> 0 ? true : false;
		}
		return false;
	}

	function get_language_names()
 	{
  		global $db;
  		$sql = "SELECT * FROM language WHERE deleted = '0'";
 	 	$stmt = $db->prepare($sql);
  		
		if($stmt->execute())
  		{
   			return $stmt->fetchAll(PDO::FETCH_ASSOC);
  		}
  		return false;
 	}

	function add_language_name($data)
	{
		global $db;
		extract($data);

		if (is_language_name_available_in_language_table($language_name) === true)
		{
			$_SESSION["error_messages"][] = "This record already exists.";
		}
		
		if (!isset($_SESSION["error_messages"]))
		{
			$sql = "INSERT INTO language (name,disabled,deleted) VALUES (:language_name,'0','0')";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':language_name', $language_name, PDO::PARAM_STR);
			
			if ($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Language added Successfully.";
				return true;
			}
		}
		return false;
	}

	function get_language_by_id($id)
	{
		global $db;
		$sql = "SELECT * FROM language WHERE id = $id";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}
	
	function delete_language_by_id($id)
	{
		global $db;
		$sql = "UPDATE language SET deleted = '1', deleted_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$_SESSION["success_messages"][] = "Deleted Successfully.";
			return true;
		}
		return false;
	}

	function edit_language_by_id($language_name, $id)
	{
		global $db;
		$sql = "UPDATE language SET name = :language_name, modified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':language_name', $language_name, PDO::PARAM_STR);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}

	function enable_disable_language($disabled, $id)
	{
		global $db;
		$sql = "UPDATE language SET disabled = '$disabled', modified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}

	function get_subcategory_names()
	{
		 global $db;
		 $sql = "SELECT * FROM subcategory WHERE deleted = '0'";
		 $stmt = $db->prepare($sql);
		 
	   if($stmt->execute())
		 {
			  return $stmt->fetchAll(PDO::FETCH_ASSOC);
		 }
		 return false;
	}
	
	function is_subcategory_name_available_in_subcategory_table($subcategory_name)
	{
		global $db;
		$sql = "SELECT COUNT(1) as 'count' FROM subcategory WHERE name = :subcategory_name AND deleted = '0'";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':subcategory_name', $subcategory_name, PDO::PARAM_STR);

		if($stmt->execute())
		{
			$result=$stmt->fetch(PDO::FETCH_ASSOC)["count"];
			return $result> 0 ? true : false;
		}
		return false;
	}

	function add_subcategory_name($data)
	{
		global $db;
		extract($data);

		if (is_subcategory_name_available_in_subcategory_table($subcategory_name) === true)
		{
			$_SESSION["error_messages"][] = "This record already exists.";
		}
		
		if (!isset($_SESSION["error_messages"]))
		{
			$sql = "INSERT INTO subcategory (name,disabled,deleted) VALUES (:subcategory_name,'0','0')";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':subcategory_name', $subcategory_name, PDO::PARAM_STR);
			
			if ($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Subcategory added Successfully.";
				return true;
			}
		}
		return false;
	}
	function get_subcategory_by_id($id)
	{
		global $db;
		$sql = "SELECT * FROM subcategory WHERE id = $id";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}
	
	function delete_subcategory_by_id($id)
	{
		global $db;
		$sql = "UPDATE subcategory SET deleted = '1', deleted_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$_SESSION["success_messages"][] = "Deleted Successfully.";
			return true;
		}
		return false;
	}

	function edit_subcategory_by_id($subcategory_name, $id)
	{
		global $db;
		$sql = "UPDATE subcategory SET name = :subcategory_name, modified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->bindParam(':subcategory_name', $subcategory_name, PDO::PARAM_STR);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}

	function enable_disable_subcategory($disabled, $id)
	{
		global $db;
		$sql = "UPDATE subcategory SET disabled = '$disabled', modified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}
	
	function accept_book_selling_request($data,$id)
	{
		global $db;
		extract($data);
		$sql = "UPDATE book_selling SET verified = '1', verified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$sql = "INSERT INTO book_selling_achieved (selling_id, description) VALUES (:id, :accept_description)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':accept_description', $accept_description, PDO::PARAM_STR);
			
			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Description related to book selling request has been Added";
				return true;
			}
			return false;
		}
	}

	function reject_book_selling_request($data,$id)
	{
		global $db;
		extract($data);
		$sql = "UPDATE book_selling SET verified = '2', verified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$sql = "INSERT INTO book_selling_achieved (selling_id, description) VALUES (:id, :reject_description)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':reject_description', $reject_description, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Description related to book selling request has been Added";
				return true;
			}
			return false;
		}
	}

	function accept_accessory_selling_request($data,$id)
	{
		global $db;
		extract($data);
		$sql = "UPDATE accessory_selling SET verified = '1', verified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$sql = "INSERT INTO accessory_selling_achieved (selling_id, description) VALUES (:id, :accept_description)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':accept_description', $accept_description, PDO::PARAM_STR);
			
			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Description related to accessory selling request has been Added";
				return true;
			}
			return false;
		}
	}

	function reject_accessory_selling_request($data,$id)
	{
		global $db;
		extract($data);
		$sql = "UPDATE accessory_selling SET verified = '2', verified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$sql = "INSERT INTO accessory_selling_achieved (selling_id, description) VALUES (:id, :reject_description)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':reject_description', $reject_description, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Description related to accessory selling request has been Added";
				return true;
			}
			return false;
		}
	}

	function get_accepted_books()
	{
		global $db;
		$sql = "SELECT * FROM book_selling WHERE verified = '1' AND uploaded = '0'";
		$stmt = $db->prepare($sql);

		if( $stmt->execute() )
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function upload_book($data)
	{
		global $db;
		extract($data);
		if(!isset($_SESSION["error_messages"]))
		{
			$sql = "INSERT INTO books (title, category_id, language_id, price, author, isbn, department_id, description, cover_url, index_url, disabled, deleted) VALUES (:title, :book_type, :language, :price, :author, :isbn, :department, :description, :cover_url, :index_url, '0', '0')";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':title', $title, PDO::PARAM_STR);
			$stmt->bindParam(':book_type', $book_type, PDO::PARAM_STR);
			$stmt->bindParam(':language', $language, PDO::PARAM_STR);
			$stmt->bindParam(':price', $price, PDO::PARAM_STR);
			$stmt->bindParam(':author', $author, PDO::PARAM_STR);
			$stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
			$stmt->bindParam(':department', $department, PDO::PARAM_STR);
			$stmt->bindParam(':description', $description, PDO::PARAM_STR);
			$stmt->bindParam(':cover_url', $cover_url, PDO::PARAM_STR);
			$stmt->bindParam(':index_url', $index_url, PDO::PARAM_STR);
			
			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Book Uploaded Successfully.";
				return true;
			}
		}
		return false;
	}

	function uploaded_not_uploaded_book($uploaded,$id)
	{
		global $db;
		$sql = "UPDATE book_selling SET uploaded = '$uploaded', uploaded_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$_SESSION["success_messages"][] = "Done!";
			return true;
		}
		return false;
	}

	function get_uploaded_books()
	{
		global $db;
		$sql = "SELECT * FROM books WHERE deleted = '0'";
		$stmt = $db->prepare($sql);

		if( $stmt->execute() )
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function get_uploaded_books_by_id($id)
	{
		global $db;
		$sql = "SELECT * FROM books WHERE id = $id";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function enable_disable_book($disabled, $id)
	{
		global $db;
		$sql = "UPDATE books SET disabled = '$disabled', modified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}

	function delete_book_by_id($id)
	{
		global $db;
		$sql = "UPDATE books SET deleted = '1', deleted_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$_SESSION["success_messages"][] = "Deleted Successfully.";
			return true;
		}
		return false;
	}

	function get_accepted_accessories()
	{
		global $db;
		$sql = "SELECT * FROM accessory_selling WHERE verified = '1' AND uploaded = '0'";
		$stmt = $db->prepare($sql);

		if( $stmt->execute() )
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function get_uploaded_accessories()
	{
		global $db;
		$sql = "SELECT * FROM accessories WHERE deleted = '0'";
		$stmt = $db->prepare($sql);

		if( $stmt->execute() )
		{
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function upload_accessory($data)
	{
		global $db;
		extract($data);
		//$photo_url_url = isset($_FILES['photo_url']) ? upload_file($_FILES['photo_url'], "assets/img/Sell_Request_Book_Images/", ["jpg", "jpeg", "png", "gif"]) : "";

		if(!isset($_SESSION["error_messages"]))
		{
			$sql = "INSERT INTO accessories (title, sub_category_id, brand, processor, screen_size, price, description, photo_url, photo_url2, disabled, deleted) VALUES (:title, :accessory_type, :brand, :processor, :screen_size, :price, :description, :photo_url, :photo_url2, '0', '0')";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':title', $title, PDO::PARAM_STR);
			$stmt->bindParam(':accessory_type', $accessory_type, PDO::PARAM_STR);
			$stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
			$stmt->bindParam(':processor', $processor, PDO::PARAM_STR);
			$stmt->bindParam(':screen_size', $screen_size, PDO::PARAM_STR);
			$stmt->bindParam(':price', $price, PDO::PARAM_STR);
			$stmt->bindParam(':description', $description, PDO::PARAM_STR);
			$stmt->bindParam(':photo_url', $photo_url, PDO::PARAM_STR);
			$stmt->bindParam(':photo_url2', $photo_url2, PDO::PARAM_STR);

			if($stmt->execute())
			{
				$_SESSION["success_messages"][] = "Accessory Uploaded Successfully.";
			}
			else
			{
				$_SESSION["error_messages"][] = "Sorry, Something went wrong try again after sometimes.";
			}
		}
		return false;
	}

	function uploaded_not_uploaded_accessory($uploaded,$id)
	{
		global $db;
		$sql = "UPDATE accessory_selling SET uploaded = '$uploaded', uploaded_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$_SESSION["success_messages"][] = "Done!";
			return true;
		}
		return false;
	}

	function get_uploaded_accessories_by_id($id)
	{
		global $db;
		$sql = "SELECT * FROM accessories WHERE id = $id";
		$stmt = $db->prepare($sql);

		if($stmt->execute())
		{
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return false;
	}

	function enable_disable_accessory($disabled, $id)
	{
		global $db;
		$sql = "UPDATE accessories SET disabled = '$disabled', modified_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{	
			$_SESSION["success_messages"][] = "Updated Successfully.";
			return true;
		}
		return false;
	}

	function delete_accessory_by_id($id)
	{
		global $db;
		$sql = "UPDATE accessories SET deleted = '1', deleted_timestamp = NOW() WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			$_SESSION["success_messages"][] = "Deleted Successfully.";
			return true;
		}
		return false;
	}

	function number_of_user_list_from_users()
	{
		global $db;

		$sql = "SELECT COUNT(user_id) AS user_count FROM users WHERE role = 'user'";
		$stmt = $db->prepare($sql);

		if ($stmt->execute())
		{
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
        	return $result['user_count'];
		}
		return false;
	}

	function number_of_accessories_uploaded()
	{
		global $db;

		$sql = "SELECT COUNT(id) AS accessory_count FROM accessories";
		$stmt = $db->prepare($sql);

		if ($stmt->execute())
		{
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
        	return $result['accessory_count'];
		}
		return false;
	}

	function number_of_books_uploaded()
	{
		global $db;

		$sql = "SELECT COUNT(id) AS book_count FROM books";
		$stmt = $db->prepare($sql);

		if ($stmt->execute())
		{
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
        	return $result['book_count'];
		}
		return false;
	}

	function number_of_book_requested()
	{
		global $db;

		$sql = "SELECT COUNT(id) AS book_request_count FROM book_request";
		$stmt = $db->prepare($sql);

		if ($stmt->execute())
		{
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
        	return $result['book_request_count'];
		}
		return false;
	}

	function number_of_selling_books()
	{
		global $db;
		$user_id = $_SESSION["user_id"];
		$sql = "SELECT COUNT(id) AS book_count FROM book_selling WHERE user_id = :user_id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		if ($stmt->execute())
		{
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
        	return $result['book_count'];
		}
		return false;
	}

	function number_of_selling_accessories()
	{
		global $db;
		$user_id = $_SESSION["user_id"];
		$sql = "SELECT COUNT(id) AS accessory_count FROM accessory_selling WHERE user_id = :user_id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		if ($stmt->execute())
		{
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
        	return $result['accessory_count'];
		}
		return false;
	}

	function number_of_book_requested_by_user()
	{
		global $db;
		$user_id = $_SESSION["user_id"];
		$sql = "SELECT COUNT(id) AS book_request_count FROM book_request WHERE user_id = :user_id";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		if ($stmt->execute())
		{
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
        	return $result['book_request_count'];
		}
		return false;
	}
?>