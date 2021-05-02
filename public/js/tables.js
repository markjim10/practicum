$('.table').DataTable({
    "aLengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
    "iDisplayLength": 5,
    "order": [[1, "desc"]]
});

$('.dataTables_filter input[type="search"]').css({ 'width': '120px', 'display': 'inline-block' });
