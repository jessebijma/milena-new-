<?php
// Initialize the session
session_start();
require_once "Classes/DB.php";

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['uid']) || empty($_SESSION['uid'])){
	header("location: login.php");
	exit;
} else {
    $db = new DB;
    $db->query('SELECT `username` FROM `admins` WHERE `id` = :id');
    $db->bind(':id', $_SESSION['uid']);
    $user = $db->single();

    $db->query('SELECT * FROM `posts`');
    $posts = $db->single();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <script>

        function showPosts() {
            var e = document.getElementById("postType");
            var str = e.options[e.selectedIndex].value;
            var url = 'getposts.php?q=' + str;
            console.log('STR', str);
            console.log('URL', url);

            if (str = "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log('RES', this.responseText);
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
            }
            xmlhttp.open("GET", url,true);
            xmlhttp.send();
        }


    </script>

	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<style type="text/css">
		body{ font: 14px sans-serif; text-align: center; }
	</style>
</head>
<body>
<div class="page-header">
	<h1>Hi, <b><?php echo $user["username"]; ?></b>. Welcome to our site.</h1>
</div>
<div id="page-body">

    <form>
        <select id="postType" name="tags" onchange="showPosts()">
            <option value="">Selecteer een tag</option>
            <option value="cursus">Cursus</option>
            <option value="development">Grafisch</option>
            <option value="interactief">Interactief</option>
        </select>
    </form>
    <br>
    <div id="txtHint">Test</div>
    <br>
    <br>
    <p><a href="addnew.php">New Post</a> </p>
</div>
<p><a href="logout.php" class="btn btn-danger">Uitloggen</a></p>
</body>
</html>