<div class="modal fade" id="AddMaterialIndex" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"
        style="box-shadow: rgba(0, 0, 0, 0.7) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; border-radius: 20px"
        role="document">
        <div class="modal-content">
            <form id="formAddMaterialIndex">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header bg-gray row text-center" id="headerAddMaterialIndex" style="cursor: move">
                    <h4 class="modal-title ml-2 col-12" id="titleAddMaterialIndex" style="margin-top: -12px">Material
                    </h4>
                </div>
                <div class="modal-body p-2 ml-2 row" style="font-size: 10pt">
                    <div class="row col-sm-12">
                        <div class="col-sm-2" style="height: 35px">
                            <label for="NOMBRE_MATERIAL" style="margin-top: 7px">Nombre &nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="hidden" id="ID_MATERIAL_INDEX" name="ID_MATERIAL">
                            <input class="form-control text-uppercase" type="text" name="NOMBRE_MATERIAL"
                                id="NOMBRE_MATERIAL" placeholder="NOMBRE MATERIAL" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-1" style="border: solid 1px #999; border-radius: 10px; padding: 5px; width: 97%">
                        <div class="row col-sm-12">
                            <div class="col-sm-2" style="height: 35px">
                                <label for="ANCHO1" style="margin-top: 7px">Ancho 1 &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="ANCHO1" id="ANCHO1"
                                    placeholder="ANCHO 1">
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="ALTO1" style="margin-top: 7px">Alto 1 &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="ALTO1" id="ALTO1"
                                    placeholder="ALTO 1">
                            </div>
                        </div>
                        <div class="row col-sm-12">
                            <div class="col-sm-2" style="height: 35px">
                                <label for="ANCHO2" style="margin-top: 7px">Ancho 2 &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="ANCHO2" id="ANCHO2"
                                    placeholder="ANCHO 2">
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="ALTO2" style="margin-top: 7px">Alto 2 &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="ALTO2" id="ALTO2"
                                    placeholder="ALTO 2">
                            </div>
                        </div>
                        <div class="row col-sm-12">
                            <div class="col-sm-2" style="height: 35px">
                                <label for="ANCHO3" style="margin-top: 7px">Ancho 3 &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="ANCHO3" id="ANCHO3"
                                    placeholder="ANCHO 3">
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="ALTO3" style="margin-top: 7px">Alto 3 &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="ALTO3" id="ALTO3"
                                    placeholder="ALTO 3">
                            </div>
                        </div>
                        <div class="row col-sm-12">
                            <div class="col-sm-2" style="height: 35px">
                                <label for="ANCHO4" style="margin-top: 7px">Ancho 4 &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="ANCHO4"
                                    id="ANCHO4" placeholder="ANCHO 4">
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="ALTO4" style="margin-top: 7px">Alto 4 &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="ALTO4"
                                    id="ALTO4" placeholder="ALTO 4">
                            </div>
                        </div>
                        <div class="row col-sm-12">
                            <div class="col-sm-2" style="height: 35px">
                                <label for="ANCHO5" style="margin-top: 7px">Ancho 5 &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="ANCHO5"
                                    id="ANCHO5" placeholder="ANCHO 5">
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="ALTO5" style="margin-top: 7px">Alto 5 &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="ALTO5"
                                    id="ALTO5" placeholder="ALTO 5">
                            </div>
                        </div>
                    </div>
                    <div class="mb-1" style="border: solid 1px #999; border-radius: 10px; padding: 5px; width: 97%">
                        <div class="row col-sm-12">
                            <div class="col-sm-2" style="height: 35px">
                                <label for="TIPO" style="margin-top: 7px">Tipo &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control text-uppercase" name="TIPO" id="TIPO">
                                    <option class="text-uppercase" value="0" selected disabled>Seleccionar
                                        Tipo...
                                    </option>
                                    <option value="R">RIGIDO</option>
                                    <option value="F">FLEXIBLE</option>
                                    <option value="P">FOTOGRAFICO</option>
                                </select>
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="IMPORTE" style="margin-top: 7px">Precio &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="number" name="IMPORTE"
                                    id="IMPORTE" placeholder="PRECIO">
                            </div>
                        </div>
                        <div class="row col-sm-12">
                            <div class="col-sm-2" style="height: 35px">
                                <label for="PROVEEDOR" style="margin-top: 7px">Proveedor &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-5">
                                <input class="form-control text-uppercase" type="text" name="PROVEEDOR"
                                    id="PROVEEDOR" placeholder="PROVEEDOR" autocomplete="off">
                            </div>
                            <div class="col-sm-1" style="height: 35px">
                                <label for="CORTE" style="margin-top: 7px">Corte &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control text-uppercase" name="CORTE" id="CORTE">
                                    <option class="text-uppercase" value="0" selected disabled>Seleccionar
                                        Corte...
                                    </option>
                                    <option value="B">BROCA</option>
                                    <option value="N">NAVAJA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2" style="border: solid 1px #999; border-radius: 10px; padding: 20px 5px 0 5px; width: 97%">
                        <div class="row col-sm-12">
                            <div class="col-sm-4" style="height: 35px">
                                <div class="custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="ACTIVO"
                                        id="ACTIVO" checked>
                                    <label class="custom-control-label" style="margin-top: -3px"
                                        for="ACTIVO">ACTIVO</label>
                                </div>
                            </div>
                            <div class="col-sm-4" style="height: 35px">
                                <div class="custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="TRASLUCIDO"
                                        id="TRASLUCIDO">
                                    <label class="custom-control-label" style="margin-top: -3px"
                                        for="TRASLUCIDO">TRASLUCIDO</label>
                                </div>
                            </div>
                            <div class="col-sm-4" style="height: 35px">
                                <div class="custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="SOLVENTE"
                                        id="SOLVENTE">
                                    <label class="custom-control-label" style="margin-top: -3px"
                                        for="SOLVENTE">SOLVENTE</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row col-sm-12">
                        <div class="col-sm-9">
                            <select class="form-control text-uppercase" name="ID_MATERIAL" id="ID_MATERIAL">
                                <option class="text-uppercase" value="0" selected disabled>Seleccionar Material...
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-3 mt-2">
                            <div class="custom-switch">
                                <input type="checkbox" class="custom-control-input" name="MATERIAL_ESPECIAL" id="MATERIAL_ESPECIAL">
                                <label class="custom-control-label" style="margin-top: -3px"
                                    for="MATERIAL_ESPECIAL">Mat. Especial</label>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="row col-sm-12 mt-2">
                        <input type="hidden" id="medH">
                        <input type="hidden" id="anchoH">
                        <input type="hidden" id="altoH">
                        <input type="hidden" id="entranH">
                        <input type="hidden" id="orientacionH">
                        <input type="hidden" id="aprovechamientoH">
                        <input type="hidden" id="cantidadH">
                        <input type="hidden" id="importeH">
                        <input type="hidden" id="titCantMat">
                        <table id="tblMedidasMaterial" class="compact cell-border tblnombre"
                            style="text-align: center; font-size:8pt !important; width: 100%;">
                            <thead>
                                <tr class="bg-blue-table">
                                    <th class="text-center">Med.</th>
                                    <th class="text-center">Ancho</th>
                                    <th class="text-center">Alto</th>
                                    <th class="text-center">Entran</th>
                                    <th class="text-center">Orientación</th>
                                    <th class="text-center">% Aprovechamiento</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Importe</th>
                                    <th class="text-center">Titulo</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div> -->
                    <!-- <div class="col-sm-12" id="divMaterialEspecial"
                        style="border: 1px #999 solid; border-radius: 10px; margin-left: -12px; padding: 10px 0 0 0; display: none">
                        <div class="row col-sm-12">
                            <div class="col-sm-3" style="height: 35px">
                                <label for="NOMBRE_MATERIAL">Nombre Material &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="hidden" id="NOMBRE_MATERIAL2" class="text-uppercase">
                                <input class="form-control text-uppercase" type="text" name="NOMBRE_MATERIAL" id="NOMBRE_MATERIAL" placeholder="NOMBRE MATERIAL">
                            </div>
                            <div class="col-sm-3" style="height: 35px">
                                <label for="MATANCHO" style="padding-top: 3px">Ancho &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4" style="height: 35px">
                                <input class="form-control" type="number" name="MATANCHO" id="MATANCHO">
                            </div>
                            <div class="col-sm-1" style="height: 35px">
                                <label for="MATALTO" style="padding-top: 3px">Alto &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control" type="number" name="MATALTO" id="MATALTO">
                            </div>
                            <div class="col-sm-3" style="height: 35px">
                                <label for="TIPO_MATERIAL" style="padding-top: 3px">Tipo Material
                                    &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control" name="TIPO_MATERIAL" id="TIPO_MATERIAL">
                                    <option value="0">Tipo Material...</option>
                                    <option value="F">Flexible</option>
                                    <option value="R">Rigido</option>
                                    <option value="P">Fotografico</option>
                                </select>
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="TIPO_CORTE" style="padding-top: 3px">Tipo de Corte
                                    &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="TIPO_CORTE" id="TIPO_CORTE">
                                    <option value="0">Tipo de Corte...</option>
                                    <option value="B">Broca</option>
                                    <option value="N">Navaja</option>
                                </select>
                            </div>
                            <div class="col-sm-3" style="height: 35px">
                                <label for="IMPORTE" style="padding-top: 3px">Importe &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-3" style="height: 35px">
                                <input class="form-control" type="number" name="IMPORTE" id="IMPORTE">
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="PROVEEDOR" style="padding-top: 3px">Proveedor &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="text" name="PROVEEDOR" id="PROVEEDOR" placeholder="PROVEEDOR">
                            </div>
                            <div class="col-sm-12 text-center mt-3" style="height: 35px">
                                <div class="custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="TRANSLUCIDO"
                                        id="TRANSLUCIDO">
                                    <label class="custom-control-label" style="margin-top: -3px"
                                        for="TRANSLUCIDO">Traslucido</label>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </form>
            <div class="modal-footer d-flex">
                <!-- <div class="col-sm-5 float-left text-left p-0">
                    <label id="lblTipo" style="font-weight: bold">TIPO MATERIAL</label>
                </div> -->
                <div class="col-sm-6 float-right text-right">
                    <button type="button" class="btn btn-primary rounded-btn btn-md" id="btnAddMaterialIndex"
                        disabled onclick="guardarAddMaterialIndex()">Aceptar</button>
                    <button type="button" class="btn btn-secondary rounded-btn btn-md" id="btnCloseAddMaterialIndex"
                        data-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
