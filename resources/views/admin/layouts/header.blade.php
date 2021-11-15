<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
        </button>
        <!-- search form -->
        <div class="search-form d-none d-lg-inline-block">
            <div class="input-group">
                <button type="button" name="search" id="search-btn" class="btn btn-flat">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <input type="text" name="query" id="search-input" class="form-control"
                    placeholder="'button', 'chart' etc." autofocus autocomplete="off" />
            </div>
            <div id="search-results-container">
                <ul id="search-results"></ul>
            </div>
        </div>

        <div class="navbar-right ">
            <ul class="nav navbar-nav">

                @if ($count = count($notifications))

                    <li class="dropdown notifications-menu">
                        <button class="dropdown-toggle" data-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-header">You have {{ $count }}
                                {{ Str::plural('notification', $count) }}</li>
                            @foreach ($notifications as $notification)
                                <li>
                                    <a href="{{ $notification->data['link'] }}">
                                        <i class="mdi mdi-email"></i> {{ $notification->data['message'] }}
                                        <span class=" font-size-12 d-inline-block float-right"><i
                                                class="mdi mdi-clock-outline"></i>
                                            {{ $notification->created_at->format('H:i a') }}</span>
                                    </a>
                                </li>
                            @endforeach
                            {{-- <li class="dropdown-footer">
                                <a class="text-center" href="#"> View All </a>
                            </li> --}}
                        </ul>
                    </li>
                @endif


                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <img src="{{ Auth::user()->profile_photo_url }}" class="user-image d-inline-block"
                            alt="User Image" />
                        <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <!-- User image -->
                        <li class="dropdown-header">
                            <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle"
                                alt="User Image" />
                            <div class="d-inline-block">
                                {{ Auth::user()->name }} <small
                                    class="pt-1 font-smal">{{ Auth::user()->email }}</small>
                            </div>
                        </li>

                        <li>
                            <a href="{{ route('profile.show') }}">
                                <i class="mdi mdi-account"></i> My Profile
                            </a>
                        </li>
                        {{-- <li>
                            <a href="email-inbox.html">
                                <i class="mdi mdi-email"></i> Message
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="mdi mdi-diamond-stone"></i> Projects </a>
                        </li>
                        <li>
                            <a href="#"> <i class="mdi mdi-settings"></i> Account Setting </a>
                        </li> --}}

                        <li class="dropdown-footer">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="mdi mdi-logout"></i>
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>


                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>


</header>
