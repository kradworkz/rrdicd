<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="/home"  class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                @if(Auth::user()->type == "Administrator")
                
                <li>
                    <a href="/researches" class="waves-effect">
                    <i class='bx bxs-book'></i>
                        <span key="t-chat">Researches</span>
                    </a>
                </li>
                <li>
                    <a href="/events" class="waves-effect">
                    <i class='bx bxs-calendar-event'></i>
                        <span key="t-chat">Events</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect">
                    <i class='bx bxs-user-circle'></i>
                        <span key="t-chat">Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/researchers" key="t-login"><i class='bx bx-glasses-alt'></i>Researchers</a></li>
                        <li><a href="/staffs" key="t-login-2"><i class='bx bx-user-circle'></i>Staffs</a></li>
                    </ul>
                </li>
                <li class="menu-title" key="t-apps">Apps</li>
                <li>
                    <a class="waves-effect">
                    <i class='bx bxs-school'></i>
                        <span key="t-chat">Organizations</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="/member-committees" key="t-login" class="font-size-11"><i class='bx bx-notepad'></i>Member Committees</a></li>
                        <li><a href="/monitoring-agencies" key="t-login-2" class="font-size-11"><i class='bx bxs-tv'></i>Monitoring Agencies</a></li>
                        <li><a href="/funding-agencies" key="t-register" class="font-size-11"><i class='bx bx-money' ></i>Funding Agencies</a></li>
                    </ul>
                </li>
             
                <li>
                    <a href="/dropdowns" class="waves-effect">
                    <i class='bx bx-list-ul'></i>
                        <span key="t-chat">Dropdowns</span>
                    </a>
                </li>
                @elseif(Auth::user()->type == "Researcher" || Auth::user()->type == "Secretariat")
                <li>
                    <a href="/researchers" class="waves-effect">
                    <i class='bx bxs-user-rectangle' ></i>
                        <span key="t-chat">Researchers</span>
                    </a>
                </li>
                <li>
                    <a href="/researches" class="waves-effect">
                    <i class='bx bxs-book'></i>
                        <span key="t-chat">Researches</span>
                    </a>
                </li>
                <li>
                    <a href="/staffs" class="waves-effect">
                    <i class='bx bx-user-circle'></i>
                        <span key="t-chat">Staffs</span>
                    </a>
                </li>
                @elseif(Auth::user()->type == "Laboratory Coordinator")
                <li>
                    <a href="/laboratory/basic" class="waves-effect">
                    <i class='bx bxs-box'></i>
                        <span key="t-chat">Basic Laboratories</span>
                    </a>
                </li>
                <li>
                    <a href="/laboratory/specialized" class="waves-effect">
                    <i class='bx bxs-cabinet'></i>
                        <span key="t-chat">Specialized Laboratories</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>