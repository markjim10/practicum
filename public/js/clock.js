function getDateTime() {
    const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"];
    var date = new Date();
    var month = monthNames[date.getMonth()];
    var day = date.getDate();
    var year = date.getFullYear();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;

    return month + " " + day + " " + year + " " + strTime;
}
setInterval(function(){
    currentTime = getDateTime();
    document.querySelector(".digital-clock").innerHTML ="<i class='fa fa-clock-o fa-lg' aria-hidden='true'></i> " + currentTime;
}, 1000);
