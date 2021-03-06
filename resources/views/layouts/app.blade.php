<!DOCTYPE html>


    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Added Font awesome -->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="background: rgba(179,226,232,0.58)">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><i class="fa fa-user-circle" aria-hidden="true"></i>Login</a></li>
                            <li><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                        @else
                            <li><a href="{{ route('companies.indexAll') }}"><i class="fa fa-users" aria-hidden="true"></i> Companies</a></li>
                            <li><a href="{{ route('projects.indexAll') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> Projects</a></li>
                            <li><a href="{{ route('tasks.index') }}"><i class="fa fa-tasks" aria-hidden="true"></i> Tasks</a></li>



            {{--Drop Down of admin ######################################################################################################--}}
                            @if(Auth::user()->role_id == 1 )
                                <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    Admin <span class="caret"></span>
                                </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('projects.index') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> All Projects</a></li>
                                        <li><a href="{{ route('users.index') }}"><i class="fa fa-user" aria-hidden="true"></i> All Users</a></li>
                                        <li><a href="{{ route('tasks.index') }}"><i class="fa fa-tasks" aria-hidden="true"></i> All Tasks</a></li>
                                        <li><a href="{{ route('companies.index') }}"><i class="fa fa-building" aria-hidden="true"></i> All Companies</a></li>
                                        <li><a href="{{ route('roles.index') }}"><i class="fa fa-envelope" aria-hidden="true"></i> All Roles</a></li>

                                    </ul>
                                </li>
                            @endif

            {{--EOF Drop Down of admin ######################################################################################################--}}

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="fa fa-eye" aria-hidden="true"></i> Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>


                                        </li>

                                        <li>
                                            <a href="{{ route('companies.index')}}">
                                                <i class="fa fa-eye" aria-hidden="true"></i> Companies I worked
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('projects.index')}}">
                                                <i class="fa fa-eye" aria-hidden="true"></i> My Projects
                                            </a>
                                        </li>



                                    </ul>
                                </li>

                                {{--Drop down##############################################################################--}}

                            {{--Drop down##############################################################################--}}

                            @endguest




                    </ul>
                </div>
            </div>
        </nav>







        <div class="container">


                @include('partials.errors')
                @include('partials.success')
                <div class="row">
                    @yield('content')
                </div>

        </div>

    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/vue"></script>

    <script>
        new Vue({
            el: '#app',
        });
    </script>
</body>

</html>
