<div class="modal fade" id="AddAdicionales" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"
        style="box-shadow: rgba(0, 0, 0, 0.7) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; border-radius: 20px"
        role="document">
        <div class="modal-content">
            <form id="formAddAdicionales">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header bg-gray row text-center" id="headerAddAdicionales" style="cursor: move">
                    <input type="hidden" id="ID_MATERIAL_2">
                    <input type="hidden" id="idCotizacionesAdicionales">
                    <input type="hidden" id="importeAdicionalesH">
                    <h4 class="modal-title ml-2 col-12" id="titleAddAdicionales" style="margin-top: -12px">Adicionales
                    </h4>
                </div>
                <div class="modal-body p-2 ml-2 row" style="font-size: 10pt">
                    <div class="col-sm-12"
                        style="border: 1px #999 solid; border-radius: 10px; margin-left: -12px; padding: 10px 0 0 0;">
                        <div class="row col-sm-12">
                            <div class="col-sm-2" style="height: 35px">
                                <label for="DESCRIPCION_ADICIONALES">ADICIONAL &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="hidden" id="NOMBRE_MATERIAL2" class="text-uppercase">
                                <input class="form-control text-uppercase" type="text" name="DESCRIPCION_ADICIONALES"
                                    id="DESCRIPCION_ADICIONALES" placeholder="DESCRIPCIÓN">
                            </div>
                            <div class="col-sm-1" style="height: 35px">
                                <label for="PRECIO_ADICIONALES" style="padding-top: 3px">PRECIO
                                    &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <input class="form-control" type="number" name="PRECIO_ADICIONALES"
                                    id="PRECIO_ADICIONALES" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer d-flex">
                <div class="col-sm-6 float-right text-right">
                    <button type="button" class="btn btn-primary rounded-btn btn-md" id="btnAddAdicionales" disabled
                        onclick="guardarAddAdicionales()">Aceptar</button>
                    <button type="button" class="btn btn-secondary rounded-btn btn-md" id="btnCloseAddAdicionales"
                        data-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
