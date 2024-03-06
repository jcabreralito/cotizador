<div class="modal fade fullscreen-modal" id="AddCotizador" tabindex="-1" role="dialog" data-backdrop="static"
    data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: #00000096">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formAddCotizador">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header bg-gray row text-center" id="headerCotizacion">
                    <input type="hidden" id="idCotizaciones">
                    <input type="hidden" id="solventeH">
                    <h4 class="modal-title ml-2 col-12" id="titleCotizacion" style="margin-top: -12px"></h4>
                </div>
                <div class="modal-body p-2 ml-2 row" style="font-size: 10pt">
                    <div class="col-sm-9">
                        <div id="divDatos" class="panel panel-default col-sm-12" style="height: auto;">
                            <h4 class="bs-titulo"><span>Datos</span></h4>
                            <div class="panel-body pt-1">
                                <div class="row">
                                    <div class="col-sm-4 input-group">
                                        <div class="row col-sm-12">
                                            <div class="col-sm-4">
                                                <label class="float-right pr-3" for="fecha">Fecha</label>
                                            </div>
                                            <div class="col-sm-8 p-0">
                                                <input id="fecha" name="fecha" type="text"
                                                    class="form-control border-0 font-weight-bold text-left pt-0"
                                                    readonly
                                                    style="font-size: 18px !important; margin-bottom: -5px; color: #283593 !important">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 input-group">
                                        <div class="row col-sm-12">
                                            <div class="col-sm-9">
                                                <label class="float-right" for="folio2">N° Cotización</label>
                                            </div>
                                            <div class="col-sm-3 p-0">
                                                <input id="folio2" name="folio2" type="text"
                                                    class="form-control float-right border-0 font-weight-bold text-right pt-0"
                                                    readonly
                                                    style="font-size: 18px !important; margin-bottom: -5px; color: #B71C1C !important">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 input-group">
                                        <div class="row col-sm-12">
                                            <div class="col-sm-1">
                                                <label class="float-right" for="cliente">Cliente</label>
                                            </div>
                                            <div class="col-sm-11 p-0 pl-4">
                                                <input id="cliente" name="cliente" type="text" class="form-control"
                                                    autocomplete="off" placeholder="Seleccionar Cliente...">
                                                <input id="cliente2" type="hidden">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 input-group">
                                        <div class="row col-sm-12">
                                            <div class="col-sm-1">
                                                <label class="float-right" for="trabajo">Trabajo</label>
                                            </div>
                                            <div class="col-sm-11 p-0 pl-4">
                                                <input type="hidden" id="trabajoTMP">
                                                <input id="trabajo" name="trabajo" type="text"
                                                    class="form-control text-uppercase" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="divCantidades" class="panel panel-default col-sm-12" style="height: auto;">
                            <h4 class="bs-titulo"><span>Cantidades</span></h4>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="input-group row col-sm-12">
                                            <div class="col-sm-4">
                                                <label for="cantidad">Cantidad</label>
                                            </div>
                                            <div class="col-sm-4 pl-1 pr-1">
                                                <input type="hidden" id="cantidadTMP">
                                                <input class="form-control text-right" type="number" name="cantidad"
                                                    id="cantidad">
                                            </div>
                                            <div class="col-sm-4 p-0">
                                                <label class="float-left" for="cantidad">Piezas</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group row col-sm-12">
                                            <div class="col-sm-7">
                                                <label for="ancho">Ancho</label>
                                            </div>
                                            <div class="col-sm-4 pl-1 pr-1">
                                                <input type="hidden" id="anchoTMP">
                                                <input class="form-control text-right" type="number" name="ancho"
                                                    id="ancho">
                                            </div>
                                            <div class="col-sm-1 p-0">
                                                <label class="float-left" for="ancho">cm.</label>
                                            </div>
                                        </div>
                                        <div class="input-group row col-sm-12">
                                            <div class="col-sm-7">
                                                <label for="medancho">Med. Ancho</label>
                                            </div>
                                            <div class="col-sm-4 pl-1 pr-1">
                                                <input type="hidden" id="medanchoTMP">
                                                <input class="form-control text-right" type="number" name="medancho"
                                                    id="medancho">
                                            </div>
                                            <div class="col-sm-1 p-0">
                                                <label class="float-left" for="medancho">cm.</label>
                                            </div>
                                        </div>
                                        <div class="input-group row col-sm-12">
                                            <div class="col-sm-7">
                                                <label for="tancho">T. Ancho</label>
                                            </div>
                                            <div class="col-sm-4 pl-1 pr-1">
                                                <input class="form-control text-right" type="number" name="tancho"
                                                    id="tancho" readonly>
                                            </div>
                                            <div class="col-sm-1 p-0">
                                                <label class="float-left" for="tancho">cm.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group row col-sm-12">
                                            <div class="col-sm-7">
                                                <label for="alto">Alto</label>
                                            </div>
                                            <div class="col-sm-4 pl-1 pr-1">
                                                <input type="hidden" id="altoTMP">
                                                <input class="form-control text-right" type="number" name="alto"
                                                    id="alto">
                                            </div>
                                            <div class="col-sm-1 p-0">
                                                <label class="float-left" for="alto">cm.</label>
                                            </div>
                                        </div>
                                        <div class="input-group row col-sm-12">
                                            <div class="col-sm-7">
                                                <label for="medalto">Med. Alto</label>
                                            </div>
                                            <div class="col-sm-4 pl-1 pr-1">
                                                <input type="hidden" id="medaltoTMP">
                                                <input class="form-control text-right" type="number" name="medalto"
                                                    id="medalto">
                                            </div>
                                            <div class="col-sm-1 p-0">
                                                <label class="float-left" for="medalto">cm.</label>
                                            </div>
                                        </div>
                                        <div class="input-group row col-sm-12">
                                            <div class="col-sm-7">
                                                <label for="talto">T. Alto</label>
                                            </div>
                                            <div class="col-sm-4 pl-1 pr-1">
                                                <input class="form-control text-right" type="number" name="talto"
                                                    id="talto" readonly>
                                            </div>
                                            <div class="col-sm-1 p-0">
                                                <label class="float-left" for="talto">cm.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default" style="height: auto; width: 100%">
                            <h4 class="bs-titulo"><span>Detalle</span></h4>
                            <div id="datosCotizacion" class="panel-body overflow-auto">
                                <div class="container-fluid">
                                    <input type="hidden" id="countMaterial">
                                    <table id="tblMaterial" class="hover stripe compact nowrap tblnombre"
                                        style="width: 100% !important">
                                        <thead>
                                            <tr class="bg-blue-table">
                                                <th style="wdith: 25%"></th>
                                                <th style="wdith: 10%"></th>
                                                <th style="wdith: 10%"></th>
                                                <th style="wdith: 5%"></th>
                                                <th style="wdith: 10%"></th>
                                                <th style="wdith: 10%"></th>
                                                <th style="wdith: 10%"></th>
                                                <th style="text-align: center; width: 10%"></th>
                                                <th style="text-align: right; width: 10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="7">Sin datos...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="container-fluid">
                                    <table id="tblTintas" class="hover stripe compact nowrap tblnombre"
                                        style="width: 100% !important">
                                        <thead>
                                            <tr class="bg-blue-table">
                                                <th style="wdith: 40%"></th>
                                                <th style="wdith: 20%"></th>
                                                <th style="wdith: 20%"></th>
                                                <th style="text-align: center; width: 10%"></th>
                                                <th style="text-align: right; width: 10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5">Sin datos...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="container-fluid">
                                    <table id="tblAcabados" class="compact nowrap tblnombre"
                                        style="width: 100% !important">
                                        <thead>
                                            <tr class="bg-blue-table">
                                                <th style="wdith: 80%"></th>
                                                <th style="text-align: center; width: 10%"></th>
                                                <th style="text-align: right; width: 10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3">Sin datos...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="container-fluid">
                                    <table id="tblAdicionales" class="compact nowrap tblnombre"
                                        style="width: 100% !important">
                                        <thead>
                                            <tr class="bg-blue-table">
                                                <th style="wdith: 60%"></th>
                                                <th style="text-align: center; width: 20%"></th>
                                                <th style="text-align: center; width: 10%"></th>
                                                <th style="text-align: right; width: 10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">Sin datos...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="divObservaciones" class="panel panel-default col-sm-12" style="height: auto;">
                            <h4 class="bs-titulo"><span>Observaciones</span></h4>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="observacionesTMP" cols="30" rows="2" hidden></textarea>
                                        <textarea class="form-control" name="observaciones" id="observaciones" cols="30" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="fixed text-bold">
                                        <div class="panel panel-default" style="height: auto;">
                                            <h4 class="bs-titulo"><span>Totales</span></h4>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-3">Subtotal</div>
                                                    <div class="col-sm-5">
                                                        <input type="hidden" id="resSubtotalTMP">
                                                        <input id="resSubtotal" name="resSubtotal" type="text"
                                                            class="form-control"
                                                            style="font-weight: bold; text-align: right; font-weight: bold;"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">Margen</div>
                                                    <div class="col-sm-5">
                                                        <input id="resMargen" name="resMargen" type="text"
                                                        class="form-control" value="0"
                                                        style="font-weight: bold; text-align: right; font-weight: bold;"
                                                        readonly>
                                                    </div>
                                                    <div class="col-sm-2 pr-2">
                                                        <input type="hidden" id="margenTMP">
                                                        <input id="porcientoMargen" name="porcientoMargen"
                                                            type="text" class="form-control p-0 pr-1"
                                                            value="30"
                                                            style="width: 35px; text-align: right; font-weight: bold;">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <label style="font-size: 11px">%</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">Comision</div>
                                                    <div class="col-sm-5">
                                                        <input id="resComision" name="resComision" type="text"
                                                            class="form-control" value="0"
                                                            style="text-align: right; font-weight: bold;" readonly>
                                                    </div>
                                                    <div class="col-sm-2 pr-2">
                                                        <input type="hidden" id="comisionTMP">
                                                        <input id="porcientoComision" name="porcientoComision"
                                                            type="text" class="form-control p-0 pr-1"
                                                            value="10"
                                                            style="width: 35px; text-align: right; font-weight: bold;">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <label style="font-size: 11px">%</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">P.Unitario</div>
                                                    <div class="col-sm-5">
                                                        <input id="resPreUnit" name="resPreUnit" type="text"
                                                            class="form-control" value="0"
                                                            style="text-align: right; font-weight: bold;" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">Total</div>
                                                    <div class="col-sm-5">
                                                        <input id="resTotal" name="resTotal" type="text"
                                                            class="form-control" value="0"
                                                            style="text-align: right; font-weight: bold;" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">T.Anterior</div>
                                                    <div class="col-sm-5">
                                                        <input id="resTotal2" name="resTotal2" type="text"
                                                            class="form-control" value="0"
                                                            style="text-align: right; font-weight: bold;" readonly>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-sm-3">Tiempo</div>
                                                    <div class="col-sm-5">
                                                        <input id="tiempoproduccion" name="tiempoproduccion"
                                                            type="text" class="form-control" value="0"
                                                            style="text-align: right; font-weight: bold;" readonly>
                                                    </div>
                                                    <div class="col-sm-4">Horas</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="fixed text-bold">
                                        <div class="panel panel-default" style="height: auto;">
                                            <h4 class="bs-titulo"><span>Formación</span></h4>
                                            <div id="divFormacion" class="panel-body overflow-auto">
                                                {{-- <label id="lblNombreMaterial"></label>
                                                <img id="imgFormacion" height="230" style="width: 100%; border-radius: 10px; padding: 1px; border: #999 solid; background-color: #fff"> --}}
                                                <div>
                                                    <table id="tblFormacion" class="table" style="border-radius: 0 !important; width: 100%">
                                                        {{-- <thead>
                                                            <tr>
                                                                <th>Materiales</th>
                                                            </tr>
                                                        </thead> --}}
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer" style="position: fixed; bottom: 0; right: 0;">
                <button type="button" class="btn btn-primary rounded-btn btn-md" id="btnsaveCotizacion"
                    onclick="generarCotizacion()">Guardar</button>
                <button type="button" class="btn btn-primary rounded-btn btn-md" id="btnImprimirCotizacion"
                    onclick="imprimirCotizacion()">Imprimir</button>
                <button type="button" class="btn btn-secondary rounded-btn btn-md" id="btnCloseCotizacion">Cerrar</button>
            </div>
        </div>
    </div>
</div>
