<div class="modal fade" id="AddTintas" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"
        style="box-shadow: rgba(0, 0, 0, 0.7) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; border-radius: 20px" role="document">
        <div class="modal-content">
            <form id="formAddTintas" style="margin-bottom: -10px">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header bg-gray row text-center" id="headerAddTintas" style="cursor: move">
                    <input type="hidden" id="ID_MATERIAL_2">
                    <h4 class="modal-title ml-2 col-12" id="titleAddTintas" style="margin-top: -12px">Tintas</h4>
                </div>
                <div class="modal-body p-2 ml-2 row" style="font-size: 10pt">
                    <div class="row col-sm-12 mt-2">
                        <input type="hidden" id="nombreTintaH">
                        <input type="hidden" id="precioTintaH">
                        <input type="hidden" id="precioMOFlexibleH">
                        <input type="hidden" id="precioMORigidoH">
                        <input type="hidden" id="idTintaH">
                        <input type="hidden" id="blancoH">
                        <input type="hidden" id="valorTintaH">
                        <input type="hidden" id="importeTintaH">
                        <input type="hidden" id="importeMOH">
                        <input type="hidden" id="idCotizacionesTintas">
                        <table id="tblTintasMaterial" class="compact nowrap cell-border tblnombre"
                            style="text-align: center; font-size:8pt !important; width: 100% !important;">
                            <thead>
                                <tr class="bg-blue-table">
                                    <th style="text-align: center">ID</th>
                                    <th style="text-align: center; width: 45%">NOMBRE</th>
                                    <th style="text-align: center; width: 15%">PRECIO TINTA</th>
                                    <th style="text-align: center; width: 20%">PRECIO MO FLEXIBLE</th>
                                    <th style="text-align: center; width: 20%">PRECIO MO RIGIDO</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="row col-sm-4 offset-sm-4 mt-2">
                        <div class="custom-switch" style="margin-left: 50px">
                            <input type="checkbox" class="custom-control-input" name="Blanco"
                                id="Blanco">
                            <label class="custom-control-label" style="margin-top: -3px"
                                for="Estatus">BLANCO</label>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer d-flex p-0">
                <div class="col-sm-6 float-right text-right">
                    <button type="button" class="btn btn-primary rounded-btn btn-md" id="btnAddTintas" disabled
                        onclick="guardarAddTintas()">Aceptar</button>
                    <button type="button" class="btn btn-secondary rounded-btn btn-md" id="btnCloseAddTintas"
                        data-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
