<?php
include 'config.php';

session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
	header('location:login.php');
};
if(isset($_GET['logout'])){
	unset($user_id);
	session_destroy();
	header('location:login.php');
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>My Courses</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<header>
		<div class="container">
			<h1>
				<?php
						$select =mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$user_id'")or die('query fialed');
						if(mysqli_num_rows($select) > 0){
							$fetch = mysqli_fetch_assoc($select);
						}
						if($fetch['image'] ==''){
							echo '<img src="Images0/default-avatar.png" width=100vh>';
						}else{
							echo '<img src="uploaded_img/'.$fetch['image'].'"width=100vh>';
						}
					?>
				My Courses</h1>
			<nav>
				
				<ul>
					<li><a href="home.php" class="active">Home</a></li>
					<li><a href="course list page.html">Courses</a></li>
					<li><a href="contact page.html">Contact</a></li>
					<li><a href="update_profile.php" > update proflie</a></li>
					<li><a href="logout.php" > logout</a></li>

				</ul>
			</nav>

	</header>
	<main>
		
		<div class="container">
			<h2>Welcome <?php echo $fetch['name']; ?> to My Course Website</h2>
			<p>Here you can find information on all of the courses that I offer. Click on the Courses link above to get
				started.</p>
		</div>

		<h3></h3>
	</main>
	<div class="slider-wrapper">
		<div class="slider">
			<img id="slide-1" src="photo/img2.png" alt="img of slider">
			<img id="slide-2" src="photo/img3.png" alt="img of slider">
			<img id="slide-3" src="photo/img4.png" alt="img of slider">
			<img id="slide-4" src="photo/img5.png" alt="img of slider">

		</div>
		<div class="slider-nav">
			<a href="#slide-1"></a>
			<a href="#slide-2"></a>
			<a href="#slide-3"></a>
			<a href="#slide-4"></a>


		</div>
	</div>
	<br>
	<footer>
		<div class="container">
			<p>&copy; 2023 My Courses</p>
		</div>
		</div>
	</footer>
</body>

</html>