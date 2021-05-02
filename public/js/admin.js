// $(document).ready(function () {
//     $('.table').DataTable({
//         "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
//         "iDisplayLength": 5,
//         "order": [[1, "desc"]]
// });

// });


var i;
var c = document.getElementsByClassName("programs").length

var arrProgram = [];
var arrProgramCount = [];
var colors=[];
var colors2=[];

for(let i=0;i<c;i++)
{
    var num = Math.round(0xffffff * Math.random());
    var r = num >> 16;
    var g = num >> 8 & 255;
    var b = num & 255;
    colors.push('rgba(' + r + ', ' + g + ', ' + b + ')');
    colors2.push('rgba(' + r + ', ' + g + ', ' + b + ',0.5)');
}

for (i = 0; i < c; i++)
{
    var d = document.getElementsByClassName("programs")[i].value;
    arrProgram.push(d);

    var count = document.getElementsByClassName("programscount")[i].value;
    arrProgramCount.push(count);
}

var ctx = document.getElementById('myChartCourses').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: arrProgram,
        datasets: [{
            label: '# of Examinees',
            data: arrProgramCount,
            backgroundColor: colors2,
            borderColor: colors,
            borderWidth: 1
        }]
    },
});
