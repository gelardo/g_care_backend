<div class="sidebar-wrapper">
    <div class="user">
        <div class="photo">
            <img src="{{asset('assets/img/faces/ayo-ogunseinde-2.jpg')}}" />
        </div>
        <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
                {{Auth::guard('doctorassistant')->user()->name}}
                <b class="caret"></b>
              </span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse" id="collapseExample">
                <ul class="nav">
                    <li>
                        <a href="#">
                            <span class="sidebar-mini-icon">MP</span>
                            <span class="sidebar-normal">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="sidebar-mini-icon">EP</span>
                            <span class="sidebar-normal">Edit Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="sidebar-mini-icon">S</span>
                            <span class="sidebar-normal">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <ul class="nav">
        <li class="active">
            <a href="{{route('doctorassistant.dashboard')}}">
                <i class="nc-icon nc-bank"></i>
                <p>Dashboard</p>
            </a>
        </li>





    </ul>
</div>
