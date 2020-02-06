function currentColorImgValue(){
	$("#currentColorSelect").change(function(){
		if ((this.value) =="BLUE") {
			$("#currentColorImg").attr("src",'assets/images/blueCar.svg');
		}
		else if ((this.value) =="GREEN") {
			$("#currentColorImg").attr("src",'assets/images/greenCar.svg');
		}
		else if ((this.value) =="RED") {
			$("#currentColorImg").attr("src",'assets/images/redCar.svg');
		}
		else if ((this.value) =="GREY") {
			$("#currentColorImg").attr("src",'assets/images/defaultCar.svg');
		}
	})
}

function targetColorImgValue(){
	$("#targetColorSelect").change(function(){
		if ((this.value) =="BLUE") {
			$("#targetColorImg").attr("src",'assets/images/blueCar.svg');
		}
		else if ((this.value) =="GREEN") {
			$("#targetColorImg").attr("src",'assets/images/greenCar.svg');
		}
		else if ((this.value) =="RED") {
			$("#targetColorImg").attr("src",'assets/images/redCar.svg');
		}
		else if ((this.value) =="GREY") {
			$("#targetColorImg").attr("src",'assets/images/defaultCar.svg');
		}
	})
}

function Clear(){
	document.getElementById('plateNumber').value = "";
	document.getElementById('currentColorSelect').value = "";
	document.getElementById('targetColorSelect').value = "";
	document.getElementById('message').innerHTML = "";
}

function addPaintJob(e){
	e.preventDefault();
	let plate_number = document.getElementById('plateNumber').value;
	let message = document.getElementById('message');
	let current_color = document.getElementById('currentColorSelect').value;
	let target_color = document.getElementById('targetColorSelect').value;
	let completed = "0";

	if (plate_number == "") {
		let output = '';
		output +=`
			<p class="py-2" style="border: 2px solid;color:red;font-weight:bold;">Plate Number field is Required!</p>
		`;
		message.innerHTML = output;
	} else {
		fetch('api/paint_job/create.php', {
		    method:'POST',
		    headers : new Headers(),
		    body:JSON.stringify({plate_number:plate_number, current_color:current_color,target_color:target_color,completed:completed})
		    })
	    .then((res) => res.json())
		.then((data) =>{
			alert(data.message)
			$("#currentColorImg").attr("src",'assets/images/defaultCar.svg');
			$("#targetColorImg").attr("src",'assets/images/defaultCar.svg');
	    	Clear()
		})
	    .catch((err) => console.log(err))
	}
} 

function loadPaintJobs(){
	let paintJobsTable = document.getElementById('tbody');
	let paintQueueTable = document.getElementById('tbody2');
	fetch('../api/paint_job/read.php')
	.then((res) => res.json())
	.then((data) =>	{ 
			console.log(data)
		if (data['paint_jobs_arr'] == 0) {
			let message = "No Paint Job Found!"
			let output = '';
			output += `
			<td colspan="4" style="color: red; font-size: 1.5rem;">${message}</td>
			`;
			paintJobsTable.innerHTML = output;

			let message1 = "No Paint Queue Found!"
			let output1 = '';
			output1 += `
			<td colspan="4" style="color: red; font-size: 1.5rem;">${message1}</td>
			`;
			paintQueueTable.innerHTML = output1;
		}else if (data['paint_jobs_arr1'] == 0) {
			let output = '';
			data['paint_jobs_arr'].forEach(function(user){
				output += `
				<tr>
					<td>${user.plate_number}</td>
					<td>${user.current_color}</td>
					<td>${user.target_color}</td>
					<td><input type="submit" class="btn btn-outline-danger" style="border: none; font-weight: bold;" value="Mark as Completed" onclick="updatePaintJobStatus()">
					<input type="hidden" class="col-2" value="${user.id}">
	                </td>
			    </tr>
				`; 
			});
			paintJobsTable.innerHTML = output;

			let message = "No Paint Queue Found!"
			let output2 = '';
			output2 += `
			<td colspan="4" style="color: red; font-size: 1.5rem;">${message}</td>
			`;
			paintQueueTable.innerHTML = output2;
		}else {
			let output = '';
			data['paint_jobs_arr'].forEach(function(user){
				output += `
				<tr>
					<td>${user.plate_number}</td>
					<td>${user.current_color}</td>
					<td>${user.target_color}</td>
					<td><input type="submit" class="btn btn-outline-danger" style="border: none; font-weight: bold;" value="Mark as Completed" onclick="updatePaintJobStatus()"><input type="hidden" class="col-2" value="${user.id}">
	                </td>
			    </tr>
				`; 
			});
		paintJobsTable.innerHTML = output;
			let output2 = '';
			data['paint_jobs_arr1'].forEach(function(user){
				output2 += `
				<tr>
			      <td>${user.plate_number}</td>
			      <td>${user.current_color}</td>
			      <td>${user.target_color}</td>
			    </tr>
				`; 
			});
		paintQueueTable.innerHTML = output2;
		}
	})
	.catch((err) => console.log(err))
}
	
function loadTotalJobsPainted(){
	fetch('../api/paint_job/read_total_cars.php')
	.then((res) => res.json())
	.then((data) =>
	{
		let output1 = ''; 
		let output2 = '';
		data['data'].forEach(function(user){
		output1 = `<h5>${user.all_painted_cars}</h5>`;
		output2 = `<h5 style="color: red;">${user.message}</h5>`;
		});
		document.getElementById('totalCarsPainted').innerHTML = output1;
		document.getElementById('message').innerHTML = output2;
	})		
}

function loadTotalPaintedRedCars(){
	fetch('../api/paint_job/read_total_red_cars.php')
	.then((res) => res.json())
	.then((data) =>
	{
		let output1 = ''; 
		data['data'].forEach(function(user){
		output1 += `<h5>${user.all_painted_red_cars}</h5>`;
		});
		document.getElementById('totalRedCarsPainted').innerHTML = output1;
	})		
}

function loadTotalPaintedGreenCars(){
	fetch('../api/paint_job/read_total_green_cars.php')
	.then((res) => res.json())
	.then((data) =>
	{
		let output1 = ''; 
		data['data'].forEach(function(user){
		output1 += `<h5>${user.all_painted_green_cars}</h5>`;
		});
		document.getElementById('totalGreenCarsPainted').innerHTML = output1;
	})		
}

function loadTotalPaintedBlueCars(){
	fetch('../api/paint_job/read_total_blue_cars.php')
	.then((res) => res.json())
	.then((data) =>
	{
		let output1 = ''; 
		data['data'].forEach(function(user){
		output1 += `<h5>${user.all_painted_blue_cars}</h5>`;
		});
		document.getElementById('totalBlueCarsPainted').innerHTML = output1;
	})		
}