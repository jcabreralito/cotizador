@extends('layouts.master')
@section('content')
    {{-- @include('partials.loading') --}}
    <div class="container-fluid">

        <div class="content-header">

            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist" style="width: 100%;">

                <li class="nav-item">
                    <a class="dashboard nav-link active cursor-pointer" id="materiales-tab" data-toggle="pill"
                        onclick="mostrarMateriales()" role="tab" aria-controls="materiales" aria-selected="true">Materiales
                        &nbsp;&nbsp;
                        <img class="text-center" src="img/materiales_blanco.png"
                        style="height: 20px; width: 20px !important; margin-top: -5px">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="dashboard nav-link cursor-pointer" id="tintas-tab" data-toggle="pill"
                        onclick="mostrarTintas()" role="tab" aria-controls="tintas" aria-selected="false">Tintas
                        &nbsp;&nbsp;
                        <img class="text-center" src="img/tinta.png"
                        style="height: 20px; width: 20px !important; margin-top: -5px">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="dashboard nav-link cursor-pointer" id="acabados-tab" data-toggle="pill"
                        onclick="mostrarAcabados()" role="tab" aria-controls="acabados" aria-selected="false">Acabados
                        &nbsp;&nbsp;
                        <img class="text-center" src="img/acabados.png"
                        style="height: 20px; width: 20px !important; margin-top: -5px">
                    </a>
                </li>

            </ul>
        </div>

        <div id="div_materiales" style="display: block">
            <div id="card_general" class="card" style="margin-top: 0; display: block">
                <input type="hidden" id="nombre" value="{{ $nombre }}">

                <div id="card_body" class="card-body">
                    <div class="box_tooltip">
                        <button class="box btn_round_gl_material flecha_down" alt="NUEVO MATERIAL" id="btnNuevoMaterial"
                            onclick="nuevoMaterialIndex(), openModalMaterialIndex()" type="button">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                    <div id="gestion">
                        <table id="tblMaterialesIndex" class="hover stripe compact nowrap tblnombre"
                            style="font-size: 70% !important; width: 100%;">
                            <thead>
                                <tr class="bg-blue-table">
                                    <th style="text-align: center; width: 5% !important">ID</th>
                                    <th style="text-align: center; width: 35% !important">MATERIAL</th>
                                    <th style="text-align: center; width: 5% !important">PRECIO</th>
                                    <th style="text-align: center; width: 5% !important">MONEDA</th>
                                    <th style="text-align: center; width: 15% !important">PROVEEDOR</th>
                                    <th style="text-align: center;">ACTIVO</th>
                                    <th style="text-align: center;">TRASLUCIDO</th>
                                    <th style="text-align: center;">CORTE</th>
                                    <th style="text-align: center;">SOLVENTE</th>
                                    <th style="text-align: center;">TIPO</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr class="bg-blue-table">
                                    <th colspan="10"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div id="div_tintas" style="display: none">
            <div id="card_general" class="card" style="margin-top: 0; display: block">

                <div id="card_body" class="card-body">
                    <div class="box_tooltip">
                        <button class="box btn_round_gl_tinta flecha_down" alt="NUEVA TINTA" id="btnNuevaTinta"
                            onclick="nuevaTintaIndex(), openModalTintaIndex()" type="button">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                    <div id="gestion">
                        <table id="tblTintasIndex" class="hover stripe compact nowrap tblnombre"
                            style="font-size: 70% !important; width: 100%;">
                            <thead>
                                <tr class="bg-blue-table">
                                    <th style="text-align: center">ID</th>
                                    <th style="text-align: center">NOMBRE</th>
                                    <th>PRECIO TINTA</th>
                                    <th>PRECIO MO FLEXIBLE</th>
                                    <th>PRECIO MO RIGIDO</th>
                                    <th>ESTATUS</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr class="bg-blue-table">
                                    <th colspan="6"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div id="div_acabados" style="display: none">
            <div id="card_general" class="card" style="margin-top: 0; display: block">

                <div id="card_body" class="card-body">
                    <div class="box_tooltip">
                        <button class="box btn_round_gl_acabado flecha_down" alt="NUEVO ACABADO" id="btnNuevoAcabado"
                            onclick="nuevoAcabadoIndex(), openModalAcabadoIndex()" type="button">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                    <div id="gestion">
                        <table id="tblAcabadosIndex" class="hover stripe compact nowrap tblnombre"
                            style="font-size: 70% !important; width: 100%;">
                            <thead>
                                <tr class="bg-blue-table">
                                    <th style="text-align: center">ID</th>
                                    <th style="text-align: center">DESCRIPCION</th>
                                    <th style="text-align: center">UNIDAD</th>
                                    <th style="text-align: center">IMPORTE</th>
                                    <th style="text-align: center">ACTIVO</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr class="bg-blue-table">
                                    <th colspan="5"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script src="js/materiales.js" defer></script>
    @include('materiales.addOrEditMaterial')
    @include('tintas.addOrEditTinta')
    @include('acabados.addOrEditAcabado')
    {{-- @include('sistemas.modal_Bitacora') --}}
    {{-- @include('sistemas.visorDocumentosSistemas') --}}
@endsection
