<div class="modal fade" id="AddAcabadoIndex" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"
        style="box-shadow: rgba(0, 0, 0, 0.7) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; border-radius: 20px"
        role="document">
        <div class="modal-content">
            <form id="formAddAcabadoIndex">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header bg-gray row text-center" id="headerAddAcabadoIndex" style="cursor: move">
                    <h4 class="modal-title ml-2 col-12" id="titleAddAcabadoIndex" style="margin-top: -12px">Acabado
                    </h4>
                </div>
                <div class="modal-body p-2 ml-2 row" style="font-size: 10pt">
                    <div class="row col-sm-12">
                        <div class="col-sm-2" style="height: 35px">
                            <label for="DESCRIPCION" style="margin-top: 7px">Descripción &nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="hidden" id="ID_ACABADO" name="ID_ACABADO">
                            <input class="form-control text-uppercase" type="text" name="DESCRIPCION"
                                id="DESCRIPCION" placeholder="DESCRIPCION" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-1" style="border: solid 1px #999; border-radius: 10px; padding: 10px 10px 5px; width: 97%">
                        <div class="row col-sm-12">
                            <div class="col-sm-2" style="height: 35px">
                                <label for="UNIDAD" style="margin-top: 7px">Unidad &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-3">
                                <input class="form-control text-uppercase" type="text" name="UNIDAD" id="UNIDAD"
                                    placeholder="UNIDAD">
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="IMPORTE" style="margin-top: 7px">Importe &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-3">
                                <input class="form-control text-uppercase" type="number" name="IMPORTE" id="IMPORTE_ACABADO"
                                    placeholder="IMPORTE_ACABADO">
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <div class="custom-switch" style="margin-left: 20px">
                                    <input type="checkbox" class="custom-control-input" name="ACTIVO"
                                        id="ACTIVO_ACABADO" checked>
                                    <label class="custom-control-label" style="margin-top: -20px"
                                        for="ACTIVO_ACABADO">ACTIVO</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer d-flex">
                <!-- <div class="col-sm-5 float-left text-left p-0">
                    <label id="lblTipo" style="font-weight: bold">TIPO Acabado</label>
                </div> -->
                <div class="col-sm-6 float-right text-right">
                    <button type="button" class="btn btn-primary rounded-btn btn-md" id="btnAddAcabadoIndex"
                        disabled onclick="guardarAddAcabadoIndex()">Aceptar</button>
                    <button type="button" class="btn btn-secondary rounded-btn btn-md" id="btnCloseAddAcabadoIndex"
                        data-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
