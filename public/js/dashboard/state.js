const ctx1 = document.getElementById('myChart1').getContext('2d');
const ctx2 = document.getElementById('myChart2').getContext('2d');
const ctx3 = document.getElementById('myChart3').getContext('2d');
const ctx4 = document.getElementById('myChart4').getContext('2d');

const chart = new Chart(ctx1, {
	type: 'doughnut',
	data: {
		labels: [ 'Accepted', 'Rejected', 'Waiting list', 'Not viewed yet' ],
		datasets: [
			{
				label: 'My First Dataset',
				data: decisionData,
				backgroundColor: [ '#006d18', '#810016', '#004a9e', '#f7b633' ]
			}
		]
	},
	options: {
		maintainAspectRatio: false,
		legend: {
			display: false
		},
		animation: {
			animateScale: true,
			animateRotate: true
		}
	}
});

const chart2 = new Chart(ctx2, {
	type: 'pie',
	data: {
		labels: [ 'XL', 'L', 'M', 'S' ],
		datasets: [
			{
				data: tshirtData,
				backgroundColor: [ '#f7de1c', '#2c3848', '#706381', '#45b7b8' ]
			}
		]
	},
	options: {
		maintainAspectRatio: false,
		legend: {
			display: false
		},
		animation: {
			animateScale: true,
			animateRotate: true
		}
	}
});

const chart3 = new Chart(ctx3, {
	type: 'pie',
	data: {
		labels: [ 'Male', 'Female' ],
		datasets: [
			{
				data: genderData,
				backgroundColor: [ '#3476f9', '#ff5baa' ]
			}
		]
	},
	options: {
		maintainAspectRatio: false,
		legend: {
			display: false
		},
		animation: {
			animateScale: true,
			animateRotate: true
		}
	}
});

const chart4 = new Chart(ctx4, {
	type: 'line',
	data: {
		labels: registrationLabels,
		datasets: [
			{
				label: 'Inscription per day',
				backgroundColor: 'transparent',
				borderColor: '#004a9e',
				data: registrationData
			}
		]
	},
	options: {
		maintainAspectRatio: false,
		responsive: true,
		legend: {
			display: false
		},
		animation: {
			animateScale: true,
			animateRotate: true
		}
	}
});
