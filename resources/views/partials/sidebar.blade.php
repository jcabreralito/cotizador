<div class="sidebar bg-blue">
    <div class="logo-details">
        <a id="href_home" onclick="menu_cotizaciones()" class="brand-link">
            <img src="img/presupuesto.png" height="40px">
            <span class="links_name">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <span class="tooltip">{{ config('app.name', 'Laravel') }}</span>
    </div>
    <ul class="nav-list">
        <li>
            <i class='bx bx-menu' id="btn" style="cursor: pointer"></i>
            <span class="tooltip" id="text-menu">Expandir</span>
        </li>
        <li>
            <a id="aUser">
                <i><img src="img/user.png" class="img-circle" alt="User Image" height="35px"></i>
                <span class="links_name text-center ml-4">{{ session('nombre') }}</span>
            </a>
            <span class="tooltip">{{ session('nombre') }}</span>
        </li>
        <li>
            <a id="href_cotizador" class="{{ request()->is('/') ? 'active' : '' }} cursor-pointer"
                onclick="menu_cotizaciones(), loaderON()">
                <img class="text-center" src="img/cotizador_blanco.png"
                    style="height: 30px; width: 30px !important; margin: 5px">
                <span class="links_name">Cotizaciones</span>
            </a>
            <span class="tooltip">Cotizaciones</span>
        </li>
        <li style="display: block">
            <a id="href_materiales" class="{{ request()->is('materiales*') ? 'active' : '' }} cursor-pointer"
                onclick="menu_materiales(), loaderON()">
                <img class="text-center" src="img/materiales_blanco.png"
                    style="height: 30px; width: 30px !important; margin: 5px">
                <span class="links_name">Materiales / Tintas / Acabados</span>
            </a>
            <span class="tooltip">Materiales / Tintas / Acabados</span>
        </li>
        <li id="sidebar_salir" class="sidebar_li_salir">
            <a id="href_salir" onclick="menu_salir()" class="cursor-pointer">
                <img class="text-center" src="img/cerrar-sesion.png"
                    style="height: 23px; width: 23px !important; margin: 10px; border-radius: 0">
                <span class="links_name">Salir</span>
            </a>
            <span class="tooltip">Salir</span>
        </li>
    </ul>
</div>
