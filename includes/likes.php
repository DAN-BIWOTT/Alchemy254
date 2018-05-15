<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/clothing_store/core/init.php'; 
	
   $product_liked = (int)$_POST['id'];
   $product_liked = sanitize($product_liked);
   $decision = (int)$_POST['decision'];
   $decision = sanitize($decision);
   $product_likedQ = $db->query("SELECT * FROM products WHERE id = '$product_liked' ");
   $product_likedC = mysqli_fetch_assoc($product_likedQ);
//cookies will not work if the domain remains as local host.hence the tunery operation
   //if the domain equals local host the we simply set the domain to false, if its another
   //computer, then we concatinate the its HTTP_HOST (at the back) with a period
   //this is for compatability with older browsers
   $domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);
   //check if cookie exists
   if ($student_id != '') {
   	 if ($decision == 1) {
	 $i = $product_likedC['likes']; 
	 $i++;
	 $a = 'likes';
	   }else{
	   	$i = $product_likedC['dislikes']; 
	   	$i++;
	   	$a = 'dislikes';
	   }
   }else{
   	if ($decision == 1) {
   		 $i = $product_likedC['likes']; 
   		 $i++;
   		 $a = 'likes';
   	   }else{
   	   	$i = $product_likedC['dislikes']; 
   	   	$i++;
   	   	$a = 'dislikes';
   	   }
   		//set cookie name,value, expire time,path ('/' means root) domain and finaly we turn of security in local host computer
   	setcookie(STUDENT_COOKIE,$student_id,STUDENT_COOKIE_EXPIRE,'/',$domain,false);
   }
   $db->query("UPDATE products SET $a = '$i' WHERE id = '$product_liked' ");




  
?>
