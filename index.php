<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>JUAN'S AUTO PAINT</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/main-style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
</head>
<body>
	<div>
		<div class="jumbotron jumbotron-fluid pb-0">
			<div class="container text-center">
				<h1>JUAN'S AUTO PAINT</h1>
			</div>
			<div class="mt-5">
				<div class="bg-danger">
		  			<ul>
		  				<div class="d-flex">
		  					<li class="nav-item-active mr-3">
					    		<a class="nav-link" href="#">NEW PAINT JOB</a>
						    </li>
							<li class="nav-item">
								<a class="nav-link" href="page/paint_jobs.php">PAINT JOBS</a>
							</li>
		  				</div>
		  			</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center">
	<h2>New Paint Job</h2>
	</div>
	<div class="container col-lg-8 text-center mx-auto mt-5 d-flex justify-content-around">
		<div class="responsive col-5" id="current_color_img">
			<img id="currentColorImg" src="assets/images/defaultCar.svg" alt="defaultCar" class="w-100">
		</div>
		<div class="responsive my-auto">
			<img src="assets/images/shape_1.png" alt="shape_1" class="w-100">
		</div>
		<div class="responsive col-5">
			<img id="targetColorImg" src="assets/images/defaultCar.svg" alt="default_car" class="w-100">
		</div>
	</div>
	<div class="container col-lg-5 mx-auto">
		<div class="card my-5">
			<h3 class="card-header text-center bg-warning">Car Details</h3>
			<div class="card-body text-left">
				<div class="text-center" id="message">
				</div>
				<div class="form-group d-flex">
					<label class="col-sm-4">Plate Number:</label>
					<input type="text" class="form-control col-sm-8 text-center" required="required" id="plateNumber" placeholder="Enter your Plate Number" autocomplete="off">
				</div>
				<div class="form-group d-flex">
					<label class="col-sm-4">Current Color:</label>
					<select class="form-control col-sm-8" id="currentColorSelect">
						<option value="GREY" selected></option>
						<option value="BLUE">BLUE</option>
						<option value="GREEN">GREEN</option>
						<option value="RED">RED</option>
					</select>
				</div>
				<div class="form-group d-flex">
					<label class="col-sm-4">Target Color:</label>
					<select class="form-control col-sm-8" id="targetColorSelect">
						<option value="GREY" selected></option>
						<option value="BLUE">BLUE</option>
						<option value="GREEN">GREEN</option>
						<option value="RED">RED</option>
					</select>
				</div>
				<div class="d-flex justify-content-end">
					<button id="submit" class="btn btn-primary col-4 rounded">Submit</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="function/function.js"></script> 
<script>
$(document).ready(function(){
	document.getElementById('submit').addEventListener('click', addPaintJob);
	currentColorImgValue();
	targetColorImgValue();
});
</script>
</html>
