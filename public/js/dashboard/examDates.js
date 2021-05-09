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



$.ajax({
    type: "GET",
    dataType: 'JSON',
    url: "http://127.0.0.1:8000/getExamDates",
    success: function(response) {

        console.log(response);

        var dates = response.map(function(dates) {
            return dates.exam_date;
        });

        var total = response.map(function(total) {
            return total.total_examinees;
        });

        console.log(dates);
        console.log(total);

        var ctx = document.getElementById('datesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: '# of Examinees',
                    data: total,
                    backgroundColor: [
                        'rgba(0,33,78,0.5)'
                    ],
                    borderColor: [
                        '#00214E'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            precision: 0,
                        }
                    }]
                }
            }
        });



    }
});


