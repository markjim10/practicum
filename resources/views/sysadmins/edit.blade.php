<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/sysadmins/update" method="POST">
                <input type="hidden" id="editId" name="id" value="">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Email Address</label>
                        </div>
                        <div class="col-md-8">
                            <input disabled class="form-control" type="text" id="email">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Username</label>
                        </div>
                        <div class="col-md-8">
                            <input id="username" disabled class="form-control" type="text" value="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Role</label>
                        </div>
                        <div class="col-md-8">
                            <select required class="form-control" name="role">
                                <option id="admin" value="admin">Administrator</option>
                                <option id="sysadmin" value="sysadmin">System Administrator</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="div">
                    <button type="submit" class="btn btn-primary ">
                        Update</button>
                </form>

                <form action="/sysadmins/delete" method="POST">
                    @csrf
                    <input type="hidden" id="deleteId" name="id" value="">
                    <button
                    onclick="return confirm('Are you sure?')"
                    type="submit"
                    href="/remove_user/" class="btn btn-danger ">
                    Remove
                    </button>
                </form>

            </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<script>
    function getUser(e) {

        $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "GET",
        dataType: 'JSON',
        url: "http://127.0.0.1:8000/sysadmins/edit/"+e.value,
        success: function(response) {
            console.log(response);
            document.querySelector("#editId").value = response.id;
            document.querySelector("#deleteId").value = response.id;
            document.querySelector("#email").value = response.email;
            document.querySelector("#username").value = response.username;
            if(response.role === "admin") {
                document.querySelector("#admin").setAttribute('selected', true);
            } else {
                document.querySelector("#sysadmin").setAttribute('selected', true);
            }
        }
      });
    }
</script>

