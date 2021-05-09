var dataTable = $('.applicants').DataTable({
    columnDefs: [
      {
        //   targets: -1,
        //   className: 'dt-body-right',
          "order": [[ 1, "desc" ]]
      },
    ]
});
function selectedStatus() {
    let status = document.getElementById("status").value;
    $.ajax({
        type: "GET",
        dataType: 'JSON',
        url: "http://127.0.0.1:8000/selectApplicantsByStatus/"+status,
        success: function(response) {
            console.log(response);
            dataTable.clear();
            $("#applicantsBody").empty();
            for (i = 0; i < response.length; i++) {
                console.log(response[i]);
              dataTable.row.add([
                  response[i].id,
                  `<a href="/admins/applicants/edit/${response[i].id}">
                  ${response[i].last_name}, ${response[i].first_name}
                  </a>`,
                  response[i].application,
                  response[i].status
                ]).draw();
            }
        }
    });
}
