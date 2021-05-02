@extends('layouts.app')
@extends('sidebars.sidebar')
@section('admin')
<div class="container-fluid mt-3">
    <h2>Applicants Module</h2>
    <hr class="site_hr">

    <div class="row">
        <div class="col-md-4">
          <div class="list-group" id="list-tab" role="tablist" style="border-radius: 0%">
            <a class="list-group-item list-group-item-light list-group-item-action" id="list-total-list" data-toggle="list" href="#list-total" role="tab" aria-controls="home">
            Home</a>
            <a class="list-group-item list-group-item-light list-group-item-action" id="list-pending-list" data-toggle="list" href="#list-pending" role="tab" aria-controls="profile">Pending</a>
            <a class="list-group-item list-group-item-light list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Approved</a>
            <a class="list-group-item list-group-item-light list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Denied</a>
          </div>

        </div>
        <div class="col-md-8">
          <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="list-total" role="tabpanel" aria-labelledby="list-total-list">
                @include('admins.applicants.components.total') <br>
            </div>

            <div class="tab-pane fade" id="list-pending" role="tabpanel" aria-labelledby="list-pending-list">
                @include('admins.applicants.components.pending') <br>
            </div>

            <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                @include('admins.applicants.components.approved') <br>
            </div>

            <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                @include('admins.applicants.components.denied') <br>
            </div>

          </div>
        </div>
      </div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.applicants').DataTable({
            "autoWidth": false,
    });
});
</script>

{{-- <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script> --}}

@endsection
