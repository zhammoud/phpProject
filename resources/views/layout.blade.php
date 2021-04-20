<html xmlns="http://www.w3.org/1999/html" lang="en">
<head>
    <title>{{__('Zeinab Hammoud')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

    @yield('top_styles')
    @yield('top_scripts')
</head>
<body class="bg-light bg-gradient bg-no-repeat">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">Zeinab Hammoud</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="mx-1 btn @if(Route::getCurrentRoute()->getName()=='home') btn-primary @else btn-outline-primary @endif"
                       aria-current="page" href="{{route('home')}}">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="companyDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Company
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="companyDropdown">
                        <li><a class="dropdown-item" href="{{route('company.create')}}">Create</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{route('company.index')}}">Index</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="branchDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Branch
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="branchDropdown">
                        <li><a class="dropdown-item" href="{{route('branch.create')}}">Create</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{route('branch.index')}}">Index</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="departmentDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Department
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="departmentDropdown">
                        <li><a class="dropdown-item" href="{{route('department.create')}}">Create</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{route('department.index')}}">Index</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<section class="d-block">
    @if(isset($success)  || $success = \Illuminate\Support\Facades\Session::get('success'))
        <div class="alert alert-success">{{$success}}</div>
    @endif
    @if(isset($error))
        <div class="alert alert-danger">{{$error}}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</section>


</body>
</html>
