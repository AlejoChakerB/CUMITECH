
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <div class="menu">
        <i class="fas fa-bars"></i>
        <i class="fas fa-times"></i>
    </div>
    <div class="sidebar">
        <div>
            <div class="pagename">
                <i class="fas fa-hospital-alt" id="cloud" style="color: #A2C61E;"></i>
                <span class="mt-3"><span style="color: #A2C61E;">CUMI</span><span style="color: #14ABE3; margin-left: 0">TECH</span></span>
            </div>
            <div class="space mt-0"></div>
        </div>
            <nav class="navegation">
                <ul>
                    @include('layouts.menu')
                    {{-- <li><a href="#">Inicio</a></li>
                    
                    <li class="list_item" style="display: block">
                        <div class="list_button_click">
                            <a href="#" class="desplegable">
                                <span>Categoria</span>
                                <i class="fas fa-angle-left right "></i>
                            </a>
                        </div>
                    <ul class="list_show">
                        <li class="list_inside"><a href="#" class="nav-link-inside">Sub opción 1</a></li>
                        <li class="list_inside"><a href="#" class="nav-link-inside">Sub opción 2</a></li>  
                    </ul>
                    </li> --}}
                    
                </ul> 
            </nav>
        <div>
            <div class="space"></div>
            <div class="mode-dark">
                <div class="info">
                    <i class="far fa-moon"></i>
                    <span>Modo oscuro</span>
                </div>
                <div class="switch">
                    <div class="base">
                        <div class="circle">             
                        </div>
                    </div>
                </div>
            </div>
            <div class="user">
                <img src="{{ asset('images/icono_Mesa-de-trabajo-1.png') }}" 
                alt="{{ config('app.name') }}">
                <div class="info-user">
                    <div class="name-email">
                        <span class="name">{{ Auth::user()->name }}</span>
                        <span class="email">{{ Auth::user()->email }}</span>  
                    </div>
                    <i class="fas fa-ellipsis-v"></i>
                </div>    
            </div>
        </div>
    </div>
    <main>
        <div>
            <section class="content">
                @yield('content')
            </section>
        </div>
    </main>
<script src="{{ asset('js/sidebar.js') }}"></script>
