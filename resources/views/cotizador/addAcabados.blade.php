<div class="modal fade" id="AddAcabados" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"
        style="box-shadow: rgba(0, 0, 0, 0.7) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; border-radius: 20px" role="document">
        <div class="modal-content">
            <form id="formAddAcabados">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-header bg-gray row text-center" id="headerAddAcabados" style="cursor: move">
                    <h4 class="modal-title ml-2 col-12" id="titleAddAcabados" style="margin-top: -12px">Acabados</h4>
                </div>
                <div class="modal-body p-2 ml-2 row" style="font-size: 10pt">
                    <div class="row col-sm-12 mt-2">
                        <input type="hidden" id="descripcionAcabadoH">
                        <input type="hidden" id="importeAcabadoH">
                        <input type="hidden" id="unidadAcabadoH">
                        <input type="hidden" id="totalPreH">
                        <input type="hidden" id="totalPreAcabadoH">
                        <input type="hidden" id="idAcabado">
                        <input type="hidden" id="idCotizacionesAcabados">
                        <table id="tblAcabadosMaterial" class="compact nowrap cell-border"
                            style="text-align: center; font-size:8pt !important; width: 100%;">
                            <thead>
                                <tr class="bg-blue-table">
                                    <th class="text-center" style="width: 70% !important">ACABADO</th>
                                    <th class="text-center" style="width: 15% !important">IMPORTE</th>
                                    <th class="text-center" style="width: 15% !important">UNIDAD</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </form>
            <div class="modal-footer d-flex">
                <!-- <div class="col-sm-5 float-left text-left p-0">
                    <label id="lblTipo" style="font-weight: bold">TIPO MATERIAL</label>
                </div> -->
                <div class="col-sm-6 float-right text-right">
                    <button type="button" class="btn btn-primary rounded-btn btn-md" id="btnAddAcabados" disabled
                        onclick="guardarAddAcabados()">Aceptar</button>
                    <button type="button" class="btn btn-secondary rounded-btn btn-md" id="btnCloseAddAcabados"
                        data-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
