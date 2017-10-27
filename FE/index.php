<?php
include("connector.php");
?>
<html>
<head>
	<title>Simple Blog</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
</head>

<body>
	<header>
		<h1>Simple Blog</h1>
	</header>
	<nav>
		<div class="nav-wrapper">
			<ul>
				<li><a href=#>Home</a></li>
				<li><a href=#>Login</a></li>
				<li><a href=#>Register</a></li>
			</ul>
		</div>
	</nav>
	<div class="wrapper">
		
		<div class="content">
			<h1>List user</h1>
			<table>

			<?php
				$getuserdata = getuser('asdasdasdad',0);
				if(!empty($getuserdata) && is_array($getuserdata))
				{
					?>
					<tr>
						<th>Username</th>
						<th>Name</th>
						<th>Email</th>
						<th>Role</th>
					</tr>
					<?php
					foreach ($getuserdata as $i=>$row) {
						?>
							<tr>
								<td><?php echo $row['username']?></td>
								<td><?php echo $row['name']?></td>
								<td><?php echo $row['email']?></td>					
								<td><?php echo $row['role']?></td>					
							</tr>
						<?php
					} 
				}
			?>
			</table>

			<h1>Register</h1>
			<form method="post" action="index.php">
				<label>Username</label>
				<input type="text" name="username"><br>
				<label>Name</label>
				<input type="text" name="name"><br>
				<label>Password</label>
				<input type="password" name="password">	<br>
				<label>Email</label>
				<input type="email" name="email"><br>
				<input type="hidden" name="code" value="adduser">		
				<input type="submit" value="register">	
			</form>

			<h1>Add Comment</h1>
			<form method="post" id="form_comment">
				<label>Name</label>
				<input type="text" name="name"><br>
				<label>Email</label>
				<input type="text" name="email"><br>
				<input type="hidden" name="code" value="addcomment">			
			</form>
 			<textarea name="comment" form="form_comment">Write your comment....</textarea> 
			<input type="button" id="post_comment" value="submit">

			<script type="text/javascript">
				$(document).ready(function(){
					$("#post_comment").click(function(){
						var data = $('#form_comment').serialize();
						$.ajax({
							type: 'POST',
							url: "index.php",
							data: data,
							success: function() {
								$('#comment').load("viewComment.php");
							}
						});
					});
				});
				
				
			</script>
			<h1>View Comment</h1>
			<div id="comment"></div>

			<script type="text/javascript">
			$(document).ready(function(){
				$(function() {
					$('#comment').load("viewComment.php");
				});
			});
			</script>

		</div>
	</div>
</body>
</html>