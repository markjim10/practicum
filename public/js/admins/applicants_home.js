$('.applicants').DataTable({
    "autoWidth": false,
});

function selectedStatus() {
    let status = document.getElementById("status").value;

    $.ajax({
        type: "GET",
        dataType: 'JSON',
        url: "http://127.0.0.1:8000/selectApplicantsByStatus/"+status,
        success: function(response) {
            console.log(response);
        }
    });

}
