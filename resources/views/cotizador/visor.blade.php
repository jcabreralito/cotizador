<div class="modal fade" id="visorIMG" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"
        style="box-shadow: rgba(0, 0, 0, 0.7) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; border-radius: 20px">
        <div class="modal-content">
            <div class="modal-header row text-center" id="headerVisor" style="cursor: move; background-color: #EFEFEF !important; border: none">
                {{-- <input type="hidden" id="ID_MATERIAL_2"> --}}
                <h4 class="modal-title ml-2 col-12" id="titleVisor" style="margin-top: -12px; color:#000;"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: -2rem 0rem -1rem auto !important">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-2 ml-2 row" style="font-size: 10pt">
                <div class="row col-sm-12">
                    <img id="imgVisor" style="width: 100%; height: 80vh; border: solid transparent 2px; border-radius: 10px; background-color: #fff; padding: 10px">
                </div>
            </div>
            {{-- <div class="modal-footer d-flex">
                <div class="col-sm-6 float-right text-right">
                    <button type="button" class="btn btn-secondary rounded-btn btn-md" id="btnCloseVisor"
                        data-dismiss="modal" aria-label="Close">Cerrar</button>
                </div>
            </div> --}}
        </div>
    </div>
</div>
