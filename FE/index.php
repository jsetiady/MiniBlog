<?php
include("connector.php");
?>
<html>
<head>
	<title>Simple Blog</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
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
			<form method="post" action="index.php">
				<input type="text" name="username">
				<input type="text" name="name">
				<input type="password" name="password">	
				<input type="email" name="email">
				<input type="hidden" name="code" value="adduser">		
				<input type="submit" value="register">	
			</form>
		</div>
	</div>
</body>
</html>