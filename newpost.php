<?php
	require_once "Classes/DB.php";

	$db = new DB();


	//get data
	$title = $_POST['title'];
	$isQuote = $_POST['isQuote'];
	$image = $_POST['img'];
	$clickable = $_POST['clickable'];
	$postdate = $_POST['postdate'];
	$body = $_POST['content'];

	//clean data
	$title = mysqli_real_escape_string($conn, $title);
	$isQuote = mysqli_real_escape_string($conn, $isQuote);
	$image = mysqli_real_escape_string($conn, $image);
	$clickable = mysqli_real_escape_string($conn, $clickable);
	$postdate = mysqli_real_escape_string($conn, $postdate);
	$body = mysqli_real_escape_string($conn, $body);


	if (isset($_GET['addnew'])) {
		$db->query("INSERT INTO  posts (title, isQuote, img, isClickable, date, content, tag)
 		VALUES ('".$_POST["title"]. "','".$_POST["isQuote"]. "','" .$_POST["img"]. "','" .$_POST["clickable"]. "','" .$_POST["postdate"]. "','" .$_POST["content"]. "','" .$_POST["tag"]. "') ");

	} else {
		echo "something went wrong";
	}

	$newpost = $db->resultset();



?>