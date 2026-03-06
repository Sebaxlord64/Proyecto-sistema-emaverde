<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Panel Principal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="shortcut icon" href="{{ asset('assets/images/logo_emaverde.png') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Solución definitiva para ocultar texto en sidebar contraído */
        body[data-leftbar-size=condensed] .left-side-menu .menu-title,
        body[data-leftbar-size=condensed] .left-side-menu .metismenu li a span {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
            overflow: hidden !important;
            opacity: 0 !important;
            visibility: hidden !important;
            position: absolute !important;
        }
        
        body[data-leftbar-size=condensed] .left-side-menu .metismenu li a {
            padding: 15px 20px !important;
            justify-content: center !important;
            text-align: center !important;
        }
        
        body[data-leftbar-size=condensed] .left-side-menu .metismenu li a i {
            margin-right: 0 !important;
            font-size: 20px !important;
            display: block !important;
            margin: 0 auto !important;
            float: none !important;
        }
        
        /* Asegurar que no haya desbordamiento */
        .left-side-menu {
            overflow: hidden !important;
        }
        
        body[data-leftbar-size=condensed] .left-side-menu .metismenu li {
            position: relative;
            overflow: hidden;
        }
        
        /* Tooltip para mostrar texto al pasar el mouse */
        .menu-tooltip {
            position: absolute;
            left: 100%;
            top: 0;
            background: #38414a;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            white-space: nowrap;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            font-size: 13px;
            margin-left: 5px;
            pointer-events: none;
        }
        
        body[data-leftbar-size=condensed] .left-side-menu .metismenu li:hover .menu-tooltip {
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body>

<div id="wrapper">
    <!-- Barra superior -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <!-- Botón cerrar sesión -->
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn text-danger" style="margin-top: 18px;">
                        <i class="fe-log-out"></i> Cerrar sesión
                    </button>
                </form>
            </li>
        </ul>

        <!-- Logo y botón hamburguesa -->
        <div class="logo-box">
            <a href="{{ route('dashboard') }}" class="logo text-center">
                <span class="logo-lg">
                    <img src="/images/logo_emaverde.png" alt="" height="16">
                </span>
                <span class="logo-sm">
                    <img src="/images/logo_emaverde.png" alt="" height="18">
                </span>
            </a> 
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </li>
        </ul>
    </div>
    <!-- Fin barra superior -->

    <!-- Sidebar lateral -->
    <div class="left-side-menu">
        <div class="slimscroll-menu">
            <div id="sidebar-menu">
                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Navegación</li>

                    {{-- ================= SUPER ADMINISTRADOR ================= --}}
                    @if(Auth::user()->id_rol == 1)
                        <li>
                            <a href="{{ route('superadmin.perfil.index') }}">
                                <i class="fas fa-user-gear"></i>
                                <span>Mi perfil - Super Administrador</span>
                                <div class="menu-tooltip">Mi perfil - Super Administrador</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('administradores.index') }}">
                                <i class="fas fa-user-tie"></i>
                                <span>Agregar administradores</span>
                                <div class="menu-tooltip">Agregar administradores</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.panel') }}">
                                <i class="la la-cogs"></i>
                                <span>Admin. de canchas</span>
                                <div class="menu-tooltip">Admin. de canchas</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reservas-pendientes.index') }}">
                                <i class="fas fa-hourglass-half"></i>
                                <span>Reservas pendientes</span>
                                <div class="menu-tooltip">Reservas pendientes</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('historial-solicitudes.index') }}">
                                <i class="fas fa-history"></i>
                                <span>Historial de solicitudes de reservas</span>
                                <div class="menu-tooltip">Historial de solicitudes</div>
                            </a>
                        </li>
                    @endif

                    {{-- ================= ADMINISTRADOR ================= --}}
                    @if(Auth::user()->id_rol == 2)
                        <li>
                            <a href="{{ route('admin.perfil.index') }}">
                                <i class="fas fa-user-cog"></i>
                                <span>Mi perfil - Administrador</span>
                                <div class="menu-tooltip">Mi perfil - Administrador</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.panel') }}">
                                <i class="la la-cogs"></i>
                                <span>Admin. de canchas</span>
                                <div class="menu-tooltip">Admin. de canchas</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('analisis-reservas.index') }}">
                                <i class="fas fa-chart-bar"></i>
                                <span>Análisis estadístico</span>
                                <div class="menu-tooltip">Análisis estadístico</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reservas-pendientes.index') }}">
                                <i class="fas fa-hourglass-half"></i>
                                <span>Reservas pendientes</span>
                                <div class="menu-tooltip">Reservas pendientes</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('historial-solicitudes.index') }}">
                                <i class="fas fa-history"></i>
                                <span>Historial de solicitudes de reservas</span>
                                <div class="menu-tooltip">Historial de solicitudes</div>
                            </a>
                        </li>
                    @endif

                    {{-- ================= USUARIO ================= --}}
                    @if(Auth::user()->id_rol == 3)
                        <li>
                            <a href="{{ route('usuario.perfil.index') }}">
                                <i class="fas fa-user"></i>
                                <span>Mi perfil - Usuario</span>
                                <div class="menu-tooltip">Mi perfil - Usuario</div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reservas.index') }}">
                                <i class="fas fa-calendar-check"></i>
                                <span>Mis reservas</span>
                                <div class="menu-tooltip">Mis reservas</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Fin sidebar -->

    <!-- Contenido principal -->
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        &copy; {{ date('Y') }} Sistema Ema Verde
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- Fin contenido -->

</div>

<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>

<!-- Script adicional para forzar el ocultamiento del texto -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Función para verificar y forzar el ocultamiento del texto
        function checkSidebarState() {
            if (document.body.getAttribute('data-leftbar-size') === 'condensed') {
                const menuItems = document.querySelectorAll('.left-side-menu .metismenu li a span');
                menuItems.forEach(item => {
                    item.style.display = 'none';
                    item.style.width = '0';
                    item.style.height = '0';
                    item.style.overflow = 'hidden';
                    item.style.opacity = '0';
                    item.style.visibility = 'hidden';
                    item.style.position = 'absolute';
                });
                
                const menuTitles = document.querySelectorAll('.left-side-menu .menu-title');
                menuTitles.forEach(title => {
                    title.style.display = 'none';
                });
            }
        }
        
        // Verificar inicialmente
        checkSidebarState();
        
        // Verificar periódicamente por si cambia el estado
        setInterval(checkSidebarState, 1000);
        
        // También verificar después de redimensionar la ventana
        window.addEventListener('resize', checkSidebarState);
    });
</script>

<!-- Otros scripts... -->
@stack('scripts')
</body>
</html>