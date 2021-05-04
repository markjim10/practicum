$.ajax({
    type: "GET",
    dataType: 'JSON',
    url: "http://127.0.0.1:8000/getApplicantsPassingRate",
    success: function(response) {

        let fail = response[0].count;
        let pass = response[1].count;

        var ctx = document.getElementById("passing").getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
            labels: ["Passed","Failed"],
            datasets: [{
                backgroundColor: ["rgba(46,204,113,0.5)","rgba(231,76,60,0.5)",],
                borderColor: ["#2ecc71","#e74c3c",],
                data: [pass, fail],
                borderWidth: 3
            }]
            }
        });
    }
});


