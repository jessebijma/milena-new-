<?php

require_once "Classes/DB.php";

$db = new DB();

if(isset($_GET['q'])) {
	$db->query("SELECT * FROM posts WHERE tag = :q");
	$db->bind(':q', $_GET['q']);
} else {
	$db->query("SELECT * FROM posts");
}

	$posts = $db->resultset();


	foreach ( $posts as $post ) {
		echo "<table>";
		echo "<tr>";
		echo "<td>" . $post['id'] . "</td>";
		echo "<td>" . $post['title'] . "</td>";
		echo "<td>" . $post['isQuote'] . "</td>";
		echo "<td>" . $post['img'] . "</td>";
		echo "<td>" . $post['isClickable'] . "</td>";
		echo "<td>" . $post['date'] . "</td>";
		echo "<td>" . $post['content'] . "</td>";
		echo "<td>" . $post['tag'] . "</td>";
		echo "</table>";
	}
?>