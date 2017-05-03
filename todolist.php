<!DOCTYPE html>
<html>
<head>
	<title>TODO SQL</title>
</head>
<body style="text-align: center;">
<p style="padding: 10px;"><strong>TODO LIST WITH SQL</strong></p>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?> 
<?php
$host = 'localhost';
	$db   = 'scotchbox';
	$user = 'root';
	$pass = 'root';
	$charset = 'utf8';
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	$pdo = new PDO($dsn, $user, $pass);
	$query = $pdo->query("SELECT * FROM `todolist`");
	$result = $query->fetchAll();
// var_dump($_GET);

if (array_key_exists('submit', $_POST)) {
	$op = $_GET['op'];

	if($op == 'delete') {
  		
  		$deleted = $_GET["id"];


  		$sql = $pdo->prepare("DELETE FROM `todolist` WHERE `id`=:deleted"); 
  		$deleteresult=$sql->execute([
  				'deleted'=>$deleted
  			]);
  		echo "<p>Deleted</p>";
  		echo '<a href="?">Back to list</a>';
	}
	
	if ($op == 'insert') {

			$title = $_POST['title'];
			$content = $_POST['text'];
			$day = $_POST['day'];
			$month = $_POST['month'];
			$year = $_POST['year'];
			$d = mktime(0, 0, 0, $month, $day, $year);
			$deadline = date("Y-m-d h:i:s", $d);
			$priority = $_POST['priority'];
			
			if (strlen($title) == 0 && $content == 0) {
				echo 'Neuzpidyti laukai!';
				echo '<a href="?">Back</a>';
			}else {

				$insert = $pdo->prepare("INSERT INTO `todolist` SET `title`=:title, `text`=:content, `deadline`=:deadline , `priority`=:priority");
				$insertresult = $insert->execute([
					'title'=> $title,
					'content'=> $content,
					'deadline'=> $deadline,
					'priority'=> $priority
				]);
				echo '<a href="?">Back</a>';
		
		} 
			
	}
} else {

?>
<form action="todolist.php?op=insert" method="post">
		<div style="padding: 10px;">
			<label for="title">Title</label>
			<input type="text" id="title" name="title">
		</div>
		<div style="padding: 10px;">
			<label for="text">Text</label>
			<textarea name="text" id="text" cols="30" rows="10"></textarea>
		</div>
		<div style="padding: 10px;">
			<label for="deadline">Deadline</label>
			<select name="day">
									<option value="1">
													01											</option>
									<option value="2">
													02											</option>
									<option value="3">
													03											</option>
									<option value="4">
													04											</option>
									<option value="5">
													05											</option>
									<option value="6">
													06											</option>
									<option value="7">
													07											</option>
									<option value="8">
													08											</option>
									<option value="9">
													09											</option>
									<option value="10">
													10											</option>
									<option value="11">
													11											</option>
									<option value="12">
													12											</option>
									<option value="13">
													13											</option>
									<option value="14">
													14											</option>
									<option value="15">
													15											</option>
									<option value="16">
													16											</option>
									<option value="17">
													17											</option>
									<option value="18">
													18											</option>
									<option value="19">
													19											</option>
									<option value="20">
													20											</option>
									<option value="21">
													21											</option>
									<option value="22">
													22											</option>
									<option value="23">
													23											</option>
									<option value="24">
													24											</option>
									<option value="25">
													25											</option>
									<option value="26">
													26											</option>
									<option value="27">
													27											</option>
									<option value="28">
													28											</option>
									<option value="29">
													29											</option>
									<option value="30">
													30											</option>
									<option value="31">
													31											</option>
							</select>
			/
			<select name="month">
									<option value="1">
						January					</option>
									<option value="2">
						February					</option>
									<option value="3">
						March					</option>
									<option value="4">
						April					</option>
									<option value="5">
						May					</option>
									<option value="6">
						June					</option>
									<option value="7">
						July					</option>
									<option value="8">
						August					</option>
									<option value="9">
						September					</option>
									<option value="10">
						October					</option>
									<option value="11">
						November					</option>
									<option value="12">
						December					</option>
							</select>
			/
			<select name="year">
									<option value="2017">
						2017					</option>
									<option value="2018">
						2018					</option>
									<option value="2019">
						2019					</option>
									<option value="2020">
						2020					</option>
									<option value="2021">
						2021					</option>
									<option value="2022">
						2022					</option>
							</select>
		</div>
		<div style="padding: 10px;">
			<label for="priority">Priority</label>
			<label for="priority_low">
				<input type="radio" id="priority_low" name="priority" value="low"> Low
			</label>
			<label for="priority_normal">
				<input type="radio" id="priority_normal" name="priority" value="normal" checked=""> Normal
			</label>
			<label for="priority_high">
				<input type="radio" id="priority_high" name="priority" value="high"> High
			</label>
		</div>
		<input type="submit" name="submit" value="submit">
	</form>
<?php

	foreach ($result as $value) :
		echo "<h3>".$value["title"]. '</h3><p>' .$value["text"].$value["deadline"].$value["priority"]."</p>"; 
		echo '<a href="todolist.php?"></a>';
		echo '<a href="todolist.php?op=delete&id='.$value["id"].'">Delete </a></br>';
		echo '<a href="todolist.php?op=edit&id='.$value["id"].'">Edit </a>';
		echo '<a href="todolist.php?op=insert&id='.$value["id"].'"></a>';
	endforeach;
}

?>
</body>
</html>