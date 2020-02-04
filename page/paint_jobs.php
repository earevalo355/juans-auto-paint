<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Paint Jobs</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="../assets/main-style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<h1 class="text-center my-5">Paint Jobs</h1>
		<div id="paint">
			<div class="my-5 col-lg-8">
			<h2>Paint Jobs in Progress</h2>
				<table class="table table-bordered text-center">
					<thead class="table-secondary">
						<tr>
							<th scope="col">Plate No.</th>
							<th scope="col">Current Color</th>
							<th scope="col">Target Color</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody id="tbody">
					</tbody>
				</table>
			</div>
			<div class="col-lg-4">
				<div class="card mx-auto" style="width: 50vh;">
					<div class="card-header">
						<h6>SHOP PERFORMANCE</h6>
					</div>
					<div class="card-body">
						<span id="message"></span>
						<div class="card-text">
							<div class="d-flex justify-content-between" >
								<p class="mb-0">Total cars Painted:</p>
								<span id="totalCarsPainted"></span>
							</div>
							<div>
								<p class="mb-0">Breakdown:</p>
							</div>
							<div class="ml-4">
								<div class="d-flex justify-content-between" id="allBlue">
									<p class="mb-0">BLUE</p>
									<span id="totalBlueCarsPainted"></span>
								</div>
								<div class="d-flex justify-content-between">
									<p class="mb-0">RED</p>
									<span id="totalRedCarsPainted"></span>
								</div>
								<div class="d-flex justify-content-between">
									<p class="mb-0">GREEN</p>
									<span id="totalGreenCarsPainted"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mb-5 col-lg-8">
			<h2>Paint Queue</h2>
			<table class="table table-bordered text-center">
				<thead class="table-secondary">
					<tr>
						<th scope="col">Plate No.</th>
						<th scope="col">Current Color</th>
						<th scope="col">Target Color</th>
					</tr>
				</thead>
				<tbody id="tbody2">
				</tbody>
			</table>
		</div>
	</div>
<script src="../function/function.js"></script> 
<script>
	loadPaintJobs();
	loadTotalJobsPainted();
	loadTotalPaintedRedCars();
	loadTotalPaintedGreenCars();
	loadTotalPaintedBlueCars();
	function updatePaintJobStatus(){
    	let ID = document.querySelector('input[type="hidden"]').value;
        let completed = "1";

    	fetch('../api/paint_job/update.php', {
        method:'PUT',
        headers : new Headers(),
        body:JSON.stringify({id:ID,completed:completed})
        })
        .then((res) => res.json())
        .then((body) =>	alert(body.message))
        .then((data) => {
        	loadPaintJobs(data)
        	loadTotalJobsPainted(data)
        	loadTotalPaintedRedCars(data)
        	loadTotalPaintedGreenCars(data)
        	loadTotalPaintedBlueCars(data)
        })
	}
</script>
</body>
</html>
