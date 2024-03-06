@extends('layouts.master')
@section('content')
    @include('partials.loading')
    {{-- @include('partials.navbar') --}}
    <div class="container-fluid">

        <div class="content-header">
            <div class="row">
                <div class="col-sm-4" id="divTitulo">
                    <h1 id="tituloCotizador">{{ $titulo }}</h1>
                </div>
                <div class="col-sm-7" id="divBuscar" style="display: block">
                    <input type="hidden" id="permiso" value="{{ $permiso }}">
                    {{-- <input type="hidden" id="departamento" value="{{ $departamento }}"> --}}
                    <div id="divBuscarGroup" class="col-lg-12 input-group input-group-sm" style="margin-top: 12px">
                        <input type="text" id="search" class="form-control text-uppercase" placeholder="Buscar ..."
                            autocomplete="off">
                        <span class="input-group-append" style="margin-top: -3px">
                            <button type="button" onclick="aplicarFiltro()" id="btn-search"
                                class="box-table box_filtro btn btn-primary btn-flat ml-2 rounded-btn">
                                <i class="nav-icon fas fa-search"></i>
                            </button>
                            <button type="button" onclick="LimpiarFiltro()" id="btn-cleanEstr"
                                class="box-table box_limpiar btn btn-danger btn-flat ml-2 rounded-btn">
                                <i class="nav-icon fas fa-search-minus"></i>
                            </button>
                        </span>
                    </div>
                </div>
                {{-- <div class="col-lg-3" id="divOpciones" style="display: none">
                    <div id="divOpcionesDiv" class="row mt-3" style="font-size: 85%">
                        <div id="divActivos" class="custom-control custom-radio col-lg-4">
                            <input class="custom-control-input" type="radio" id="opcionActivos"
                                name="activos_inactivos_todos" value="ACTIVOS">
                            <label id="activosLabel" for="opcionActivos" class="custom-control-label cursor-pointer"
                                style="color: #696969">ACTIVOS</label>
                        </div>
                        <div id="divInactivos" class="custom-control custom-radio col-lg-4">
                            <input class="custom-control-input" type="radio" id="opcionInactivos"
                                name="activos_inactivos_todos" value="INACTIVOS">
                            <label id="inactivosLabel" for="opcionIncativos" class="custom-control-label cursor-pointer"
                                style="color: #696969">INACTIVOS</label>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        <div id="card_general" class="card" style="margin-top: 0; display: block">
            <input type="hidden" id="conteo_activo">
            <input type="hidden" id="Gestion_Id">
            <input type="hidden" id="cerrado">
            <input type="hidden" id="ajustes">
            <input type="hidden" id="nombre" value="{{ $nombre }}">
            <div id="card_body" class="card-body">
                <div class="box_tooltip">
                    <button class="box btn_round_gl flecha_down" alt="NUEVA COTIZACIÓN" id="btnNuevaCotizacion"
                        onclick="nuevaCotizacion(), openModalCotizacion()" type="button">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
                <div id="gestion">
                    <table id="tblCotizador" class="hover stripe compact nowrap tblnombre"
                        style="font-size: 70% !important; width: 100%;">
                        <thead>
                            <tr class="bg-blue-table">
                                <th style="text-align: center">N°</th>
                                <th style="text-align: center">Fecha</th>
                                <th>Cliente</th>
                                <th>Trabajo</th>
                                <th>Cantidad</th>
                                <th>Observaciones</th>
                                <th>Imprimir</th>
                                <th>Imprimir OP</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr class="bg-blue-table">
                                <th colspan="8"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>

    </div>
    <script src="js/cotizador.js" defer></script>
    @include('cotizador.addOrEdit')
    @include('cotizador.addMaterial')
    @include('cotizador.addTintas')
    @include('cotizador.addAcabados')
    @include('cotizador.addAdicionales')
    @include('cotizador.visor')
    {{-- @include('sistemas.modal_Bitacora') --}}
    {{-- @include('sistemas.visorDocumentosSistemas') --}}
@endsection
