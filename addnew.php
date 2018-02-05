<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<title>Welcome</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
	body{ font: 14px sans-serif; text-align: center; }
</style>
</head>
<body>
<div class="page-header">
	<h1>Create a new post</h1>
</div>
<div id="page-body" style="text-align: center; margin: auto;">
	<br>
	<form action="newpost.php" method="post">
		<p>
			<label for="title">Title:</label>
			<input type="text" name="title" id="title">
		</p>
		<p>
			<label for="isQuote">Quote?</label>
			<input type="checkbox" name="isQuote" id="isQuote">
		</p>
		<p>
			<label for="img">Image:</label>
			<input type="file" name="img" id="img" accept="image/*">
		</p>
		<p>
			<label for="clickable">Clickable?</label>
			<input type="checkbox" name="clickable" id="clickable">
		</p>
		<p>
			<label for="postdate">Date:</label>
			<input type="date" name="date" id="postdate">
		</p>
		<p>
			<label for="content">Body:</label>
			<input type="text" aria-colcount="20" aria-rowcount="20" id="content" name="content">
		</p>
		<p>
			<label for="tag">Tag:</label>
			<select id="tag" name="tag">
				<option value="cursus">Cursus</option>
				<option value="development">Development</option>
				<option value="grafisch">Grafisch</option>
			</select>
		</p>
		<input type="submit" class="btn btn-primary" value="Submit" name="addnew">
	</form>
	<br>
	<p><a href="admin.php">Go back</a> </p>
</div>
<p><a href="logout.php" class="btn btn-danger">Uitloggen</a></p>
</body>
</html>