<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initail-scale=1.0">
    <meta http-equiv="X-UA-compatible" content="ie=edge">
    <title>DECO & CADO</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/style.css') }} " >
</head>
<body class="overflow-y-auto overflow-x-auto" style="background-color: #d3e5f3;">

    <header>
    <div class="container">
        <input type="checkbox" name="" id="check">

        <div class="logo-container">
            <a href="{{route('home')}}">
            <h3 class="logo">Deco<span class="logo"> & cado</span></h3>
            </a>
        </div>

        <div class="nav-btn">
            <div class="nav-links">
                <ul>
                    <li class="nav-link" style="--i: .6s">
                        <a href="{{route('home')}}">Accueil</a>
                    </li>
                    <li class="nav-link" style="--i: .85s">
                        <a href="#">Catégoré<i class="fas fa-caret-down"></i></a>
                        <div class="dropdown">
                            <ul>
                                <li class="dropdown-link">
                                    <a href="{{route( 'article',['category' => 'All','sort' => 'partinence'] )}}"> tout les catégorés<i class="fas fa-caret-down"></i></a>
                                </li>
                                <li class="dropdown-link">
                                    <a href="{{route('article',['category' =>'cuissine','sort' => 'partinence'])}}">cuissine <i class="fas fa-caret-down"></i></a>
                                </li>
                                <li class="dropdown-link">
                                    <a href="{{route('article',['category' =>'salle de bain','sort' => 'partinence'])}}">Salle de bain <i class="fas fa-caret-down"></i></a>
                                </li>
                                <li class="dropdown-link">
                                    <a href="{{ route('article',['category' =>'chambre','sort' => 'partinence']) }}">chambre <i class="fas fa-caret-down"></i></a>
                                </li>
                                <li class="dropdown-link">
                                    <a href="{{ route('article',['category' =>'decoration','sort' => 'partinence']) }}">décoration <i class="fas fa-caret-down"></i></a>
                                </li>
                                <div class="arrow"></div>
                            </ul>
                        </div>
                    </li>
                    @if(auth()->user())
                    @if(auth()->user()->type =="admin")
                    <li class="nav-link" style="--i: 1.1s">
                        <a href="#">Admin<i class="fas fa-caret-down"></i></a>
                        <div class="dropdown">
                            <ul>

                                <li class="dropdown-link">
                                    <a href="{{route('addarticle') }}">AddArticle</a>
                                </li>


                                <!--<li class="dropdown-link">
                                    <a href="#">Link 3<i class="fas fa-caret-down"></i></a>
                                    <div class="dropdown second">
                                        <ul>
                                            <li class="dropdown-link">
                                                <a href="#">Link 1</a>
                                            </li>
                                            <li class="dropdown-link">
                                                <a href="#">Link 2</a>
                                            </li>
                                            <li class="dropdown-link">
                                                <a href="#">Link 3</a>
                                            </li>
                                            <li class="dropdown-link">
                                                <a href="#">More<i class="fas fa-caret-down"></i></a>
                                                <div class="dropdown second">
                                                    <ul>
                                                        <li class="dropdown-link">
                                                            <a href="#">Link 1</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="#">Link 2</a>
                                                        </li>
                                                        <li class="dropdown-link">
                                                            <a href="#">Link 3</a>
                                                        </li>
                                                        <div class="arrow"></div>
                                                    </ul>
                                                </div>
                                            </li>
                                            <div class="arrow"></div>
                                        </ul>
                                    </div>
                                </li>-->
                                <div class="arrow"></div>
                            </ul>

                        </div>
                    </li>
                    @endif
                    @endif





                    <li class="nav-link" style="--i: 1.35s">
                        <a href="#">About</a>
                    </li>
                </ul>
            </div>
            @if (!auth()->user())
            @guest
            <div class="log-sign" style="--i: 1.8s">
                <a href="{{ route('login') }}" class="btn transparent">Log in</a>
                <a href="{{ route('register') }}" class="btn solid">Sign up</a>
            </div>
            @endguest
            @else
            <div class="log-sign" style="--i: 1.8s">

            <li class="block nav-link  border border-gray-500 rounded shadow-md" style="--i: .85s">
                <a href="#">{{ auth()->user()->username }}<i class="fas fa-caret-down"></i></a>
                <div class="dropdown">
                    <ul>
                        <li class="dropdown-link">
                            <a href="#">
                            <form action="{{ route('logout') }}"  method="POST" >
                                @csrf
                                <button type="submit" > déconnection <i class="fas fa-caret-down"></i></button>
                            </form>
                            </a>
                        </li>
                        <li class="dropdown-link">
                            <a href="#"></a>
                        </li>
                        <div class="arrow"></div>
                    </ul>
                </div>
            </li>
            <!--- cart button   --->
@endif
        </div>

        <div class="hamburger-menu-container">
            <div class="hamburger-menu">
                <div></div>
            </div>
        </div>
    </div>
</header>


    <!--
    <nav class="p-4 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li> <a href="/" class="p-3"> Home </a> </li>
            <li> <a href=" {{ route('dashboard') }}" class="p-3"> dashboard </a> </li>
            <li> <a href=" {{ route('posts') }} " class="p-3"> Posts </a> </li>
            <li> <a href="{{ route('article') }}" class="p-3"> article </a> </li>
        </ul>

        <ul class="flex items-center">
            @if (auth()->user())
            <li> <a href="" class="p-3"> {{ auth()->user()->username}} </a> </li>
            <li> <form action="{{ route('logout') }}" method="POST" class="p-3 inline">
            @csrf
            <button type="submit" > Logout</button>
            </form>  </li>
            @else
            <li> <a href="{{ route('login') }}" class="p-3"> login </a> </li>
            <li> <a href="{{ route('register') }}" class="p-3"> Register </a> </li>

            @endif




        </ul>
    </nav>-->
@yield('content')

<div class="my-8"></div>
<!--footer section --->
<div class="bg-white border-t-2 border-gray-300 flex flex-col md:flex-row md:justify-between text-center mt-24 py-6 text-sm">
    <div>
        <a href="#" class="mx-2.5">About</a>
        <a href="#" class="mx-2.5">Privicy Policy</a>
        <a href="#" class="mx-2.5">Terms Of Service</a>
    </div>

    <div class="flex justify-center mt-4 lg:mt-0">
        <a>
          <svg
            fill="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            class="w-6 h-6 text-blue-600"
            viewBox="0 0 24 24"
          >
            <path
              d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"
            ></path>
          </svg>
        </a>
        <a class="ml-3">
          <svg
            fill="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            class="w-6 h-6 text-blue-300"
            viewBox="0 0 24 24"
          >
            <path
              d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"
            ></path>
          </svg>
        </a>
        <a class="ml-3">
          <svg
            fill="none"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            class="w-6 h-6 text-pink-400"
            viewBox="0 0 24 24"
          >
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
            <path
              d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"
            ></path>
          </svg>
        </a>
      </div>
    <p>&copy; Copyright reserved 2021</p>
</div>
<!--footer section end --->
</body>
</html>
