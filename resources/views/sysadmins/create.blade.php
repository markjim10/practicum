<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Register a new Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form action="/sysadmins/register_user" method="POST">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Username</label>
                        </div>
                        <div class="col-md-8">
                            <input required class="form-control" type="text" name="username">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Name</label>
                        </div>
                        <div class="col-md-8">
                            <input required class="form-control" type="text" name="name">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Email Address</label>
                        </div>
                        <div class="col-md-8">
                            <input required class="form-control" type="text" name="email">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Password</label>
                        </div>
                        <div class="col-md-8">
                            <input required class="form-control" type="password" name="password" minlength="4">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Confirm Password</label>
                        </div>
                        <div class="col-md-8">
                            <input required class="form-control" type="password" name="confirm_password" minlength="4">
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
                                <option value="admin">Administrator</option>
                                <option value="sysadmin">System Administrator</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </form>

        </div>
      </div>
    </div>
  </div>
