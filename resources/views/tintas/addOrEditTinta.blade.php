<div class="modal fade" id="AddTintaIndex" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"
        style="box-shadow: rgba(0, 0, 0, 0.7) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; border-radius: 20px"
        role="document">
        <div class="modal-content">
            <form id="formAddTintaIndex">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header bg-gray row text-center" id="headerAddTintaIndex" style="cursor: move">
                    <h4 class="modal-title ml-2 col-12" id="titleAddTintaIndex" style="margin-top: -12px">Tinta
                    </h4>
                </div>
                <div class="modal-body p-2 ml-2 row" style="font-size: 10pt">
                    <div class="row col-sm-12">
                        <div class="col-sm-2" style="height: 35px">
                            <label for="Nombre" style="margin-top: 7px">Nombre &nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="hidden" id="idTintas" name="idTintas">
                            <input class="form-control text-uppercase" type="text" name="Nombre"
                                id="Nombre" placeholder="Nombre" autocomplete="off">
                        </div>
                    </div>
                    <div class="mb-1" style="border: solid 1px #999; border-radius: 10px; padding: 5px; width: 97%">
                        {{-- <span>PRECIOS</span> --}}
                        <h4 class="bs-titulo" style="margin-top: -13px !important"><span>PRECIOS</span></h4>
                        <div class="row col-sm-12">
                            <div class="col-sm-2" style="height: 35px">
                                <label for="PrecioTinta" style="margin-top: 7px">Tinta &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-2">
                                <input class="form-control text-uppercase" type="number" name="PrecioTinta" id="PrecioTinta"
                                    placeholder="TINTA">
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="PrecioMOFlexible" style="margin-top: 7px">MO Flexible &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-2">
                                <input class="form-control text-uppercase" type="number" name="PrecioMOFlexible" id="PrecioMOFlexible"
                                    placeholder="MO FLEXIBLE">
                            </div>
                            <div class="col-sm-2" style="height: 35px">
                                <label for="PrecioMORigido" style="margin-top: 7px">MO Rigido &nbsp;&nbsp;&nbsp;</label>
                            </div>
                            <div class="col-sm-2">
                                <input class="form-control text-uppercase" type="number" name="PrecioMORigido" id="PrecioMORigido"
                                    placeholder="MO RIGIDO">
                            </div>
                        </div>
                    </div>
                    <div class="mb-2" style="border: solid 1px #999; border-radius: 10px; padding: 20px 5px 0 5px; width: 97%">
                        <div class="row col-sm-12">
                            <div class="col-sm-4 offset-sm-4" style="height: 35px">
                                <div class="custom-switch" style="margin-left: 50px">
                                    <input type="checkbox" class="custom-control-input" name="Estatus"
                                        id="Estatus" checked>
                                    <label class="custom-control-label" style="margin-top: -3px"
                                        for="Estatus">ACTIVO</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer d-flex">
                <!-- <div class="col-sm-5 float-left text-left p-0">
                    <label id="lblTipo" style="font-weight: bold">TIPO Tinta</label>
                </div> -->
                <div class="col-sm-6 float-right text-right">
                    <button type="button" class="btn btn-primary rounded-btn btn-md" id="btnAddTintaIndex"
                        disabled onclick="guardarAddTintaIndex()">Aceptar</button>
                    <button type="button" class="btn btn-secondary rounded-btn btn-md" id="btnCloseAddTintaIndex"
                        data-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
