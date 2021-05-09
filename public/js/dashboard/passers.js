$.ajax({
    type: "GET",
    dataType: 'JSON',
    url: "http://127.0.0.1:8000/getListPassers",
    success: function(response) {
        console.log(response);
    }
});


