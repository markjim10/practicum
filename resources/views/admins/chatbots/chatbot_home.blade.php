@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')

<style>
    a.home_response {
    color: #007bff !important;
    }

    a.home_response:hover {
        color: #087830 !important;
    }
</style>

<div class="container-fluid mt-3 mb-5">
    <h2>Chat Bot Module - Responses</h2>
    <hr class="site_hr">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Create a Bot Response</div>
                <div class="card-body">
                    <div class="form-group">
                        <label><strong>Response</strong></label>
                        <textarea spellcheck="false" class="form-control" id="response" rows="3" required></textarea>
                        <small id="err"></small>
                    </div>
                    <div class="form-group">
                        <button id="btnResponse" class="btn btn-success" >Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Current Responses</div>
                <div class="card-body">
                    <table class=" table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th style="width:10%;">ID</th>
                                <th style="width:60%;">Responses</th>
                                <th style="width:15%;">Words</th>
                                <th style="width:15%;">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($responses as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>
                                        <a class="" href="/admins/chatbots/chatbot_response/{{$item->id}}">
                                        {{$item->response}}
                                        </a>
                                    </td>
                                    <td>
                                        {{$item->getWordCount()}}

                                    </td>
                                    <td>
                                        <a id="{{$item->id}}"
                                        class="btnRemove btn btn-danger btn-sm">Remove
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>

btn = document.querySelector("#btnResponse");
btn.onclick = e => {
    resID = document.querySelector("#response")
    response = resID.value;
    var error = document.querySelector("#response");
    var msg = document.querySelector("#err");

    if(response=="") {
        error.classList.add("response-submit-err");

        msg.textContent = `Enter a response`;
        msg.style.color = "red";
        msg.style.fontWeight = "Bold";

        console.log(error);
        return false;
    } else {
        msg.textContent = ``;
        error.classList.remove("response-submit-err");
    }

    var token = $('meta[name="csrf-token"]').attr('content');

    data =
        {
            "response": response
        }

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        url: "/create_response",
        data: data,

        success: function (response) {

            var table = document.querySelector(".table");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);

             cell1.innerHTML = `
                ${response.id}
            `;

            cell2.innerHTML = `
                <a href='/admins/chatbots/chatbot_response/${response.id}'>${response.response}</a>
            `;

            cell3.innerHTML = `

            `;

            cell4.innerHTML = `
            <a href="/${response.id}/" class="btnRemove btn btn-danger btn-sm">Remove</a>
            `;

            document.querySelector("#response").value = "";

            var msg = document.querySelector("#err");
            msg.textContent = `Added a Response`;
            msg.style.color = "green";
            msg.style.fontWeight = "Bold";

            console.log(response);

            },
            error: function (request, status, error) {
                alert(request.responseText);
            },
    });

}

$(".btnRemove").click(function() {

var remove = $(this);

bootbox.confirm({
message: "Are you sure you want to delete this word?",
buttons: {
    confirm: {
        label: 'Yes',
        className: 'btn-success'
    },
    cancel: {
        label: 'No',
        className: 'btn-danger'
    }
},
callback: function (result) {
    // remove.parent().parent().parent().remove();
    remove.parent().parent().remove();
    data = { "id": remove.attr('id') }

    $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    type: "POST",
    url: "/remove_response",
    data: data,
    success: function (response) {
        console.log(response);
    },
});
}
});
});







</script>





@endsection
