$.ajax({
  type: "GET",
  dataType: 'JSON',
  url: "http://127.0.0.1:8000/getPreferredPrograms",
  success: function(response) {

    var programs = response.map(function(program) {
        return program.program_id;
    });

    var counts = response.map(function(program) {
        return program.count;
    });

    var colors=[];
    var colors2=[];

    for(let i = 0; i < response.length ; i++)
    {
        var num = Math.round(0xffffff * Math.random());
        var r = num >> 16;
        var g = num >> 8 & 255;
        var b = num & 255;
        colors.push('rgba(' + r + ', ' + g + ', ' + b + ')');
        colors2.push('rgba(' + r + ', ' + g + ', ' + b + ',0.5)');
    }

    var ctx = document.getElementById('myChartCourses').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: programs,
            datasets: [{
                label: '# of Examinees',
                data: counts,
                borderColor: colors,
                backgroundColor: colors2,
                borderWidth: 1
            }]
        },
    });
  }
});
