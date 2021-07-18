<div class="sidebar-wrapper">
    <div class="user">
        <div class="photo">
            <img src="{{asset('assets/img/faces/ayo-ogunseinde-2.jpg')}}" />
        </div>
        <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span>
                {{Auth::guard('admin')->user()->name}}
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
            <a href="{{route('admin.dashboard')}}">
                <i class="nc-icon nc-bank"></i>
                <p>Dashboard</p>
            </a>
        </li>


        <li>
            <a href="{{url('admin/doctor/index')}}">
                <i class="nc-icon nc-box"></i>
                <p>Doctors</p>
            </a>
        </li>

        <li>
            <a href="{{url('admin/speciality/index')}}">
                <i class="nc-icon nc-box"></i>
                <p>Speciality</p>
            </a>
        </li>

        <li>
            <a href="{{url('admin/patient/index')}}">
                <i class="nc-icon nc-box"></i>
                <p>Patient</p>
            </a>
        </li>

    </ul>
</div>
