@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')

<input id="responseId" type="hidden" value="{{$response->id}}">

<div class="container-fluid mt-3 mb-5">
    <h2>Chat Bot Module - Words</h2>
    <hr class="site_hr">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">Create a Bot Response</div>
                <div class="card-body">
                    <div class="form-group">
                        <label><strong>Response</strong></label>
                    <textarea spellcheck="false" class="form-control" id="response" rows="3" required>{{$response->response}}</textarea>
                        <small id="err"></small>
                    </div>
                    <div class="form-group">
                        <button id="btnResponse" class="btn btn-primary" >Update</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Add a word to the Response</div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">
                                <label><strong>Word</strong></label>
                            </div>
                            <div class="col-md-6">
                                <input id="word" type="text" class=" form-control form-control-sm">
                            </div>
                            <div class="col-md-4">
                                <button style="margin-top:0%" class="btnWord btn btn-primary form-control btn-sm">Add</button>
                            </div>
                        </div>
                        <div id="msgWordSuccess"></div>
                        <small id="msgWordErr"></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">List of saved Words</div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th style="width:80%">Saved Words</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($words as $item)
                            <tr>
                                <th>
                                <div class="row">
                                    <div class="col-8">
                                        {{$item->word}}
                                    </div>
                                    <div class="col-4">
                                        <a
                                        id="{{$item->id}}"
                                        class="btnRemove btn btn-danger btn-sm">Remove</a>
                                    </div>
                                </div>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>

btnWord = document.querySelector('.btnWord');
btnWord.onclick = e =>{
    document.querySelector('#msgWordSuccess').textContent = "";
    document.querySelector('#msgWordErr').textContent  = "";

    var responseId = document.querySelector('#responseId').value;
    var word = document.querySelector('#word');
    var msgWordErr = document.querySelector('#msgWordErr');

    if(word.value == "") {
        msgWordErr.textContent = `Enter a Word to trigger the Response`;
        msgWordErr.style.color = "red";
        msgWordErr.style.fontWeight = "Bold";
        word.classList.add("response-submit-err");
        return false;
    } else {
        msgWordErr.textContent = ``;
        word.classList.remove("response-submit-err");
    }

    var token = $('meta[name="csrf-token"]').attr('content');
    data = {
                "responseId":responseId,
                "word": word.value
        }

    $.ajax({
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Access-Control-Allow-Methods' : 'POST',
                    'Access-Control-Allow-Headers' : 'X-Requested-With, Content-Type, X-Auth-Token, Origin, Authorization'
        },
        type: "POST",
        url: "/create_word",
        data: data,

        success: function (response) {
            var table = document.querySelector(".table");
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            cell1.innerHTML = `

                    <div class="row">
                        <div class="col-8">
                            ${response.word}
                        </div>
                        <div class="col-4">
                            <a
                            href="/remove_word/${response.id}"
                            class="btnRemove btn btn-danger btn-sm">Remove</a>
                        </div>
                    </div>
            `;
            document.querySelector('#word').value=""
            var msg = document.querySelector('#msgWordSuccess');
            msg.textContent = `Added a Response`;
            msg.style.color = "green";
            msg.style.fontWeight = "Bold";

            console.log(response);

            },
            error: function (request, status, error) {
                alert(error.responseText);
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
        remove.parent().parent().parent().remove();
        data = { "id": remove.attr('id') }

        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        url: "/remove_word",
        data: data,
        success: function (response) {
            console.log(response);
        },
    });
    }
    });

});


</script>

<script>

btn = document.querySelector("#btnResponse");
btn.onclick = e => {

    resID = document.querySelector("#response")
    response = resID.value;
    var error = document.querySelector("#response");
    var msg = document.querySelector("#err");

    var id = document.querySelector("#responseId")
    id = id.value;

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

    data = { "response": response, "id": id }

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST",
        url: "/update_response",
        data: data,

        success: function (response) {
            console.log(response);

            var msg = document.querySelector("#err");
            msg.textContent = `Response has been Updated`;
            msg.style.color = "green";
            msg.style.fontWeight = "Bold";
        },
    });

}



</script>


@endsection
