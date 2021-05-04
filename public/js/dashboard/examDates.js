// var i;
// var c = document.getElementsByClassName("dates").length

// var arrDate = [];
// var arrCount = [];

// for (i = 0; i < c; i++)
// {
//     var d = document.getElementsByClassName("dates")[i].value;
//     arrDate.push(d);

//     var count = document.getElementsByClassName("counts")[i].value;
//     arrCount.push(count);
// }

// console.log(arrCount);

// var ctx = document.getElementById('datesChart').getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: arrDate,
//         datasets: [{
//             label: '# of Examinees',
//             data: arrCount,
//             backgroundColor: [
//                 'rgba(0,33,78,0.5)'
//             ],
//             borderColor: [
//                 '#00214E'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     precision: 0,
//                 }
//             }]
//         }
//     }
// });

$.ajax({
    type: "GET",
    dataType: 'JSON',
    url: "http://127.0.0.1:8000/getExamDates",
    success: function(response) {

        console.log(response);

    }
});


