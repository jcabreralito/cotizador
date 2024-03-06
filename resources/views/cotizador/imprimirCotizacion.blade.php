<!DOCTYPE html>
<html>

<head>
    <title>COTIZACIÓN CAMA PLANA/ PLOTTER</title>
    <style>
        @font-face {
            font-family: 'Hero';
            src: url('../../../public/fonts/Hero.otf') format('opentype');
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8pt !important;
        }

        .divTable {
            display: table;
            width: 100%;
        }

        .divTableRow {
            display: table-row;
        }

        .divTableHeading {
            background-color: #eee;
            display: table-header-group;
        }

        .divTableCell,
        .divTableHead {
            border: 1px solid #999999;
            display: table-cell;
            padding: 3px 10px;
        }

        .divTableHeading {
            background-color: #eee;
            display: table-header-group;
            font-weight: bold;
        }

        .divTableFoot {
            background-color: #eee;
            display: table-footer-group;
            font-weight: bold;
        }

        .divTableBody {
            display: table-row-group;
        }

        .w-25 {
            width: 25% !important;
        }

        .w-50 {
            width: 50% !important;
        }

        .w-75 {
            width: 75% !important;
        }

        .w-100 {
            width: 100% !important;
        }

        div.flex {
            display: flex !important;
        }

        #page-wrap {
            width: 700px;
            margin: 0 auto;
        }

        .center-justified {
            text-align: justify;
            margin: 0 auto;
            width: 30em;
        }

        table.border {
            border-collapse: collapse;
        }

        table.center {
            text-align: center;
        }

        table.border,
        table.border td,
        table.border th {
            border: 1px solid black;
        }

        td.border,
        th.border {
            border: 1px solid;
        }

        td.bottom,
        th.bottom {
            border-bottom: 1px solid;
        }

        tr.center td,
        td.center {
            text-align: center;
            vertical-align: text-top;
        }

        tr.right td,
        td.right {
            text-align: right;
        }

        .grey {
            background: grey;
        }

        li {
            text-align: justify;
        }

        .cantidades {
            text-align: center;
            border-bottom: solid 1px #000;
        }

        .titulo {
            font-weight: bold;
            font-size: 13px;
            color: #686868;
        }

        .border {
            border-radius: 10px;
        }

        @page {
            margin: 10px 15px;
        }

        #header {
            position: fixed;
            top: -40px;
            text-align: right;
            font-family: 'Times';
            font-size: 8pt;
            font-style: italic;
        }

        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 50px;

            color: black;
            text-align: center;
            line-height: 35px;
        }

        #footer {
            position: fixed;
            bottom: -40px;
            text-align: right;
            font-family: 'Times';
            font-size: 10pt;
            font-weight: bold;
            font-style: italic;
        }

        #footer .page:after {
            content: counter(page, upper-roman);
        }

        .pagenum:after {
            content: counter(page);
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cotización</title>

</head>

<body>
    <header>
        <table id="table-head" width="100%">
            <tbody>
                <tr>
                    <td width="50%" colspan="2" rowspan="3" style="text-align: left;">
                        {{-- <img src="{{ asset('img/Logo Lito impresos+soluciones 2.svg') }}" style="width: 250px;"> --}}
                        @component('sections/logoLito')
                        @endcomponent
                    </td>
                    <td width="50%" colspan="2"
                        style="text-align: right; font-size: 20px !important; color: #14237F">
                        COTIZACIÓN CAMA PLANA / PLOTTER
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2" style="text-align: right; font-size: 11pt;">No.Cot.:
                        <strong>{{ $dto[0]->FOLIO }}</strong>
                </tr>
                <tr>
                    <td width="50%" colspan="2" style="text-align: right; font-size: 11pt;">Fecha
                        Emisión:
                        <strong>{{ $dto[0]->FECHA_CAMBIO == null ? \Carbon\Carbon::parse($dto[0]->FECHA_HORA)->format('d/m/Y') : \Carbon\Carbon::parse($dto[0]->FECHA_CAMBIO)->format('d/m/Y') }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <table width="100%" style="border-radius: 10px; padding: 10px; border: #14237F solid 1px">
            <tbody>
                <tr>
                    <td width="15%" style="color: #14237F"><b>TRABAJO : </b></td>
                    <td width="85%" class="bottom" style="text-transform: uppercase">{{ $dto[0]->TRABAJO }}</td>
                </tr>
                <tr>
                    <td width="15%" style="color: #14237F"><b>CLIENTE : </b></td>
                    <td width="95%" class="bottom" style="text-transform: uppercase">{{ $dto[0]->CLIENTE }}</td>
                </tr>
            </tbody>
        </table>
        <table width="100%" style="border-radius: 10px; padding: 10px; border: #14237F solid 1px; margin-top: 5px">
            <tbody>
                <tr>
                    <td colspan="2" width="100%" style="color: #14237F"><b>ESPECIFICACIONES :</b></td>
                </tr>
                <tr>
                    <th style="border-bottom: #000 1px solid; font-weight: normal">Cantidad :
                        <strong>{{ number_format($dto[0]->CANTIDAD, 0) }}</strong>
                    </th>
                    <th style="border-bottom: #000 1px solid; font-weight: normal">Ancho :
                        <strong>{{ number_format($dto[0]->ANCHO, 2) }} cm.</strong>
                    </th>
                    <th style="border-bottom: #000 1px solid; font-weight: normal">Alto :
                        <strong>{{ number_format($dto[0]->ALTO, 2) }} cm.</strong>
                    </th>
                    <th style="border-bottom: #000 1px solid; font-weight: normal">Med.Ancho :
                        <strong>{{ number_format($dto[0]->MEDIANIL_ANCHO, 2) }} cm.</strong>
                    </th>
                    <th style="border-bottom: #000 1px solid; font-weight: normal">Med.Alto :
                        <strong>{{ number_format($dto[0]->MEDIANIL_ALTO, 2) }} cm.</strong>
                    </th>
                    <th style="border-bottom: #000 1px solid; font-weight: normal">Total Ancho :
                        <strong>{{ number_format($dto[0]->ANCHO + $dto[0]->MEDIANIL_ANCHO, 2) }} cm.</strong>
                    </th>
                    <th style="border-bottom: #000 1px solid; font-weight: normal">Total Alto :
                        <strong>{{ number_format($dto[0]->ALTO + $dto[0]->MEDIANIL_ALTO, 2) }} cm.</strong>
                    </th>
                </tr>
            </tbody>
        </table>
        <br>
    </header>
    {{-- <footer>
        <strong class="pagenum"></strong>
    </footer> --}}
    <main>

        <div class="container-fluid">
            <div style="border: solid 1px #14237f; border-radius: 10px; padding: 10px; margin-top: -5px">
                <table width="100%" class="compact nowrap border">
                    <thead>
                        <tr style="background-color: #e0e0e0">
                            <th style="width: 30% !important">MATERIAL</th>
                            <th>MEDIDA CM</th>
                            <th>ENTRAN</th>
                            <th>% APROV.</th>
                            <th>ORIENTACIÓN</th>
                            <th>TIPO</th>
                            <th>PROVEEDOR</th>
                            <th>METROS / LAMINAS</th>
                            <th style="width: 10% !important">COSTO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dto_mat as $item)
                            <tr>
                                <th
                                    style="font-weight: normal; border: #e0e0e0 solid 1px; text-align: left !important; padding-left: 10px; text-transform: uppercase">
                                    {{ $item->NOMBRE_MATERIAL }}</th>
                                <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="center">
                                    {{ number_format($item->MATANCHO, 0) }}X{{ number_format($item->MATALTO, 0) }}
                                </th>
                                <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="center">
                                    {{ number_format($item->MATENTRAN, 0) }}</th>
                                <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="center">
                                    {{ number_format($item->APROVECHAMIENTO, 2) }}
                                </th>
                                <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="center">
                                    {{ $item->ORIENTA }}
                                </th>
                                <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="center">
                                    {{ $item->TIPO }}
                                </th>
                                <th style="font-weight: normal; border: #e0e0e0 solid 1px">{{ $item->PROVEEDOR }}</th>
                                <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="center">
                                    @if ($item->TIPO == 'MATERIAL RIGIDO')
                                    {{ number_format($item->CANT_MAT, 0) }}</th>
                                    @else
                                    {{ number_format($item->CANT_MAT, 2) }}</th>
                                    @endif
                                <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="right">$
                                    {{ number_format($item->PRECIO_MAT, 2) }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div style="border: solid 1px #14237f; border-radius: 10px; padding: 10px; margin-top: -5px">
                <table width="100%" class="compact nowrap border">
                    <thead>
                        <tr style="background-color: #e0e0e0; border-radius: 10px !important">
                            <th style="width: 30% !important">TINTA</th>
                            <th>COSTO</th>
                            <th>BLANCO</th>
                            <th>COSTO</th>
                            <th style="width: 10% !important">IMPORTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th
                                style="font-weight: normal; text-align: left !important; padding-left: 10px; border: #e0e0e0 solid 1px">
                                {{ $dto_tinta[0]->RESOLUCION }}</th>
                            <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="center">$
                                {{ number_format($dto_tinta[0]->PRECIO_IMP, 2) }}</th>
                            <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="center">
                                @if ($dto_tinta[0]->BLANCO > 0)
                                    <img src="{{ asset('img/Check.png') }}" width="10px" height="10px"
                                        alt="SI">
                                @else
                                    <img src="{{ asset('img/prohibido.png') }}" width="10px" height="10px"
                                        alt="NO">
                                    {{-- <i class="fas fa-times"></i> --}}
                                @endif
                            </th>
                            <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="center">
                                {{ number_format($dto_tinta[0]->BLANCO, 2) }}</th>
                            <th style="font-weight: normal; border: #e0e0e0 solid 1px" class="right">$
                                {{ number_format($dto_tinta[0]->BLANCO + $dto_tinta[0]->PRECIO_IMP, 2) }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRow">
                        <div style="border: solid 1px #14237f; border-radius: 10px; padding: 10px; margin-top: -5px; width: 50%"
                            class="divTableCell">
                            <table class="compact nowrap border w-100">
                                <thead>
                                    <tr style="background-color: #e0e0e0; border-radius: 10px !important">
                                        <th style="width: 60% !important">ACABADO</th>
                                        <th style="width: 20% !important">COSTO UNITARIO</th>
                                        <th style="width: 20% !important">COSTO ACABADO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($dto_aca) == 0)
                                        <tr>
                                            <td colspan="3"></td>
                                        </tr>
                                    @else
                                        @foreach ($dto_aca as $item_aca)
                                            <tr>
                                                <th
                                                    style="font-weight: normal; text-align: left !important; padding-left: 10px; border: #e0e0e0 solid 1px">
                                                    {{ $item_aca->DESCRIPCION }}</th>
                                                <th style="font-weight: normal; border: #e0e0e0 solid 1px"
                                                    class="center">
                                                    $
                                                    {{ number_format($item_aca->PRECIO_UNITARIO, 2) }}</th>
                                                <th style="font-weight: normal; border: #e0e0e0 solid 1px"
                                                    class="center">
                                                    $
                                                    {{ number_format($item_aca->PRECIO, 2) }}</th>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div style="border: solid 1px #14237f; border-radius: 10px; padding: 10px; margin-top: -5px; width: 50%"
                            class="divTableCell">
                            <table class="compact nowrap border w-100">
                                <thead>
                                    <tr style="background-color: #e0e0e0; border-radius: 10px !important">
                                        <th style="width: 60% !important">ADICIONAL</th>
                                        <th style="width: 20% !important">COSTO UNITARIO</th>
                                        <th style="width: 20% !important">COSTO ADICIONAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($dto_adi) == 0)
                                        <tr>
                                            <td colspan="3"></td>
                                        </tr>
                                    @else
                                        @foreach ($dto_adi as $item_adi)
                                            <tr>
                                                <th
                                                    style="font-weight: normal; text-align: left !important; padding-left: 10px; border: #e0e0e0 solid 1px">
                                                    {{ $item_adi->DESCRIPCION }}</th>
                                                <th style="font-weight: normal; border: #e0e0e0 solid 1px"
                                                    class="center">
                                                    $
                                                    {{ number_format($item_adi->PRECIO, 2) }}</th>
                                                <th style="font-weight: normal; border: #e0e0e0 solid 1px"
                                                    class="center">
                                                    $
                                                    {{ number_format($item_adi->IMPORTE, 2) }}</th>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="divTable">
                <div class="divTableBody">
                    <div class="divTableRow">
                        <div style="border: solid 1px #14237f; border-radius: 10px; padding: 10px; margin-top: -5px; width: 75%"
                            class="divTableCell">
                            <table width="100%" class="table">
                                <tbody>
                                    <tr>
                                        @foreach ($dto_mat as $item)
                                            <th style="width: 25%">
                                                <div>
                                                    <label
                                                        style="text-transform: uppercase; font-size: 10px !important">{{ $item->NOMBRE_MATERIAL }}</label>
                                                </div>
                                                <div>
                                                    @if ($url === '127.0.0.1')
                                                        <img src="http://192.168.2.222{{ $item->RUTA }}"
                                                            height="140"
                                                            style="width: 80%; border-radius: 10px; padding: 10px; border: #999 solid; background-color: #fff">
                                                    @else
                                                        <img src="https://servicios.litoprocess.com{{ $item->RUTA }}"
                                                            height="140"
                                                            style="width: 80%; border-radius: 10px; padding: 10px; border: #999 solid; background-color: #fff">
                                                    @endif
                                                </div>
                                            </th>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="border: solid 1px #14237f; border-radius: 10px; padding: 10px; margin-top: -5px; width: 25%"
                            class="divTableCell">
                            <table width="100%" class="table compact nowrap border" style="font-size: 10px">
                                <tbody>
                                    <tr>
                                        <th style="background-color: #e0e0e0">
                                            <div>
                                                <label>SUBTOTAL $</label>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: right !important;">
                                            {{ number_format($dto[0]->SUBTOTAL, 2) }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #e0e0e0">
                                            <div>
                                                <label>( {{ number_format($dto[0]->PORMARGEN, 0) }}%) MARGEN $</label>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: right !important;">
                                            {{ number_format($dto[0]->MARGEN, 2) }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #e0e0e0">
                                            <div>
                                                <label>( {{ number_format($dto[0]->PORCOMISION, 0) }}%) COMISIÓN
                                                    $</label>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: right !important;">
                                            {{ number_format($dto[0]->COMISION, 2) }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #e0e0e0;">
                                            <div>
                                                <label>COSTO TOTAL $</label>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: right !important;">
                                            {{ number_format($dto[0]->TOTAL, 2) }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #e0e0e0">
                                            <div>
                                                <label>COSTO UNITARIO $</label>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="text-align: right !important;">
                                            {{ number_format($dto[0]->PUNITARIO, 2) }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <table width="100%" class="table compact nowrap border" style="font-size: 10px">
                                <thead>
                                    <tr>
                                        <th style="background-color: #e0e0e0">
                                            <div>
                                                <label>TIEMPO DE PRODUCCIÓN</label>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>{{ $dto[0]->TIEMPO_PRODUCCION }} </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div style="border: solid 1px #14237f; border-radius: 10px; padding: 10px; margin-top: -5px">
                <table width="100%" class="compact nowrap">
                    <tbody>
                        <tr>
                            <td>OBSERVACIONES : </td>
                            <td style="text-align: left !important">{{ $dto[0]->OBSERVACIONES }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>
