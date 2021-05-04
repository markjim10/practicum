@section('content')

{{-- <script src="{{ secure_asset('js/toggle.js') }}" defer></script> --}}
<script src="{{ asset('js/toggle.js') }}" defer></script>

  <div class="d-flex" id="wrapper">
    <!-- ADMIN SIDEBAR -->
    @if(Auth::user()->role=='admin')
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">IT199R-2 Project</div>
      <div class="list-group list-group-flush">

        <a href="/"
        class="side list-group-item list-group-item-light list-group-item-action {{ Request::is('admins') ? 'active' : '' }}">
        <i class="fas fa-home fa-2x auth" aria-hidden="true"></i> Dashboard </a>

        <a href="/admins/applicants"
        class="side list-group-item list-group-item-light list-group-item-action
        {{ Request::is('admins/applicants') ? 'active' : '' }}">
        <i class="fas fa-user-circle fa-2x auth" aria-hidden="true"></i> Applicants </a>

        <a href="/admins/examination" class="side list-group-item list-group-item-light list-group-item-action {{ Request::is('admins/examination') ? 'active' : '' }}"  >
            Examinations<i class='fas fa-laptop fa-2x auth'></i>
        </a>

        <a href="/admins/chatbots/chatbot_home" class="side list-group-item list-group-item-light list-group-item-action  {{ Request::is('admins/chatbots/chatbot_home') ? 'active' : '' }}">Chat Bot
            <i class='fas fa-robot fa-2x auth'></i></a>

        <a href="/adminsfeedback" class="side list-group-item list-group-item-light list-group-item-action  {{ Request::is('adminsfeedback') ? 'active' : '' }}">Feedbacks
            <i class='fas fa-envelope fa-2x auth'></i></a>
      </div>
    </div>
    @endif

    <!-- SYSTEM ADMIN SIDEBAR -->
    @if(Auth::user()->role=='sysadmin')
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">System Administrator </div>
      <div class="list-group list-group-flush">

        <a href="/"
        class="side list-group-item list-group-item-light list-group-item-action
        {{ Request::is('sysadmins') ? 'active' : '' }}">
        <i class="fas fa-home fa-2x auth"></i> Dashboard </a>

        <a href="/view_users"
        class="side list-group-item list-group-item-light list-group-item-action
        {{ Request::is('view_users') ? 'active' : '' }}">
        <i class="fas fa-user fa-2x auth"></i> Register User</a>

        <a href="/view_database"
        class="side list-group-item list-group-item-light list-group-item-action
        {{ Request::is('view_database') ? 'active' : '' }}">
        <i class='fas fa-database fa-2x auth'></i>Database</a>

        <a href="/view_trails"
        class="side list-group-item list-group-item-light list-group-item-action
        {{ Request::is('view_trails') ? 'active' : '' }}">
        <i class='fas fa-sticky-note fa-2x auth'></i>Trail Logs</a>
      </div>
    </div>
    @endif
    <!-- APPLICANT SIDEBAR -->
    @if(Auth::user()->role=='applicant')
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">OJT 2 Project </div>
      <div class="list-group list-group-flush">

        <a href="/"
        class="side list-group-item list-group-item-light list-group-item-action
        {{ Request::is('applicants') ? 'active' : '' }}">
        <i class="fas fa-home fa-2x auth" aria-hidden="true"></i> Home</a>

        <a href="/applicants/exam_results"
        class="side list-group-item list-group-item-light list-group-item-action
        {{ Request::is('applicants/exam_results') ? 'active' : '' }}">
        <i class="fa fa-book fa-2x auth" aria-hidden="true"></i> Exam Results</a>

        <a href="/applicants/profile"
        class="side list-group-item list-group-item-light list-group-item-action
        {{ Request::is('applicants/profile') ? 'active' : '' }}">
        <i class="fas fa-user-circle fa-2x auth" aria-hidden="true"></i> Applicant Profile</a>

        <a href="/applicants/send_feedback"
        class="side list-group-item list-group-item-light list-group-item-action
        {{ Request::is('applicants/send_feedback') ? 'active' : '' }}">
        <i class="fas fa-envelope fa-2x auth" aria-hidden="true"></i> Send Feedbacks</a>

      </div>
    </div>
    @endif

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-dark site_bg border-bottom">
        <button class="btn btn-secondary btn-sm" id="menu-toggle">Sidebar</button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(Auth::user()->photo != null)
                <img class="rounded-circle" src="data:image;base64,{{Auth::user()->photo}}" width="30" height="30"/>
                @else
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                @endif
                Logged in as {{ Auth::user()->username }}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/editProfile/{{ Auth::user()->id }}">Edit Profile</a>

                <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
              </div>
            </li>
          </ul>
        </div>
        </nav>
        <div class="container-fluid">
            @yield('admin')
        </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

@endsection
