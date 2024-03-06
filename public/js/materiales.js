serve = base_path;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
const FROM_PATTERN = "YYYY-MM-DD HH:mm:ss.SSS";
const TO_PATTERN = "DD-MM-YYYY HH:mm";

const FROM_PATTERN_SHORT = "YYYY-MM-DD";
const TO_PATTERN_SHORT = "DD-MM-YYYY";

$(document).ready(function () {
    $ID_MATERIAL = document.getElementById('ID_MATERIAL_INDEX');
    $NOMBRE_MATERIAL = document.getElementById('NOMBRE_MATERIAL');
    $ANCHO1 = document.getElementById('ANCHO1');
    $ALTO1 = document.getElementById('ALTO1');
    $ANCHO2 = document.getElementById('ANCHO2');
    $ALTO2 = document.getElementById('ALTO2');
    $ANCHO3 = document.getElementById('ANCHO3');
    $ALTO3 = document.getElementById('ALTO3');
    $ANCHO4 = document.getElementById('ANCHO4');
    $ALTO4 = document.getElementById('ALTO4');
    $ANCHO5 = document.getElementById('ANCHO5');
    $ALTO5 = document.getElementById('ALTO5');
    $TIPO = document.getElementById('TIPO');
    $IMPORTE = document.getElementById('IMPORTE');
    $PROVEEDOR = document.getElementById('PROVEEDOR');
    $CORTE = document.getElementById('CORTE');
    $ACTIVO = document.getElementById('ACTIVO');
    $TRASLUCIDO = document.getElementById('TRASLUCIDO');
    $SOLVENTE = document.getElementById('SOLVENTE');
    btnAddMaterialIndex = document.getElementById('btnAddMaterialIndex');

    idTintas = document.getElementById('idTintas');
    Nombre = document.getElementById('Nombre');
    PrecioTinta = document.getElementById('PrecioTinta');
    PrecioMOFlexible = document.getElementById('PrecioMOFlexible');
    PrecioMORigido = document.getElementById('PrecioMORigido');
    Estatus = document.getElementById('Estatus');
    btnAddTintaIndex = document.getElementById('btnAddTintaIndex');

    $ID_ACABADO = document.getElementById('ID_ACABADO');
    $DESCRIPCION = document.getElementById('DESCRIPCION');
    $UNIDAD = document.getElementById('UNIDAD');
    $IMPORTE_ACABADO = document.getElementById('IMPORTE_ACABADO');
    $ACTIVO_ACABADO = document.getElementById('ACTIVO_ACABADO');
    btnAddAcabadoIndex = document.getElementById('btnAddAcabadoIndex');

    homeHeigth = document.getElementById("home-section");
    cardGeneral = document.getElementById("card_general");
    cardGeneral.style.height = (homeHeigth.clientHeight - 70).toString() + "px";
    heightTable = (cardGeneral.clientHeight - 130).toString() + "px";
    heightTableTintas = (cardGeneral.clientHeight - 135).toString() + "px";
    heightTableAcabados = (cardGeneral.clientHeight - 135).toString() + "px";

    ajustarTablas('tblMaterialesIndex', heightTable);
    ajustarTablas('tblTintasIndex', heightTableTintas);
    ajustarTablas('tblAcabadosIndex', heightTableAcabados);

    mostrarMateriales();
});

function mostrarMateriales() {
    $('#div_materiales')[0].style.display = 'block';
    $('#div_tintas')[0].style.display = 'none';
    $('#div_acabados')[0].style.display = 'none';

    tblMaterialesIndexLoad();
}

function mostrarTintas() {
    $('#div_materiales')[0].style.display = 'none';
    $('#div_tintas')[0].style.display = 'block';
    $('#div_acabados')[0].style.display = 'none';

    tblTintasIndexLoad();
}

function mostrarAcabados() {
    $('#div_materiales')[0].style.display = 'none';
    $('#div_tintas')[0].style.display = 'none';
    $('#div_acabados')[0].style.display = 'block';

    tblAcabadosIndexLoad();
}

// ======================================================= MATERIALES =================================================

function tblMaterialesIndexLoad() {
    tblMaterialesIndex = $('#tblMaterialesIndex').DataTable({
        destroy: true,
        pageResize: false,
        searchable: true,
        processing: false,
        serverSide: true,
        rowId: "ID_MATERIAL",
        select: false,
        scrollY: false,
        scrollX: false,
        scrollCollapse: false,
        paginate: true,
        stateSave: false,
        deferRender: false,
        autoWidth: false,
        order: [
            [0, "DESC"],
        ],
        language: {
            url: serve + "js/spanish-DT.json",
        },
        dom: '<"top">rt<"bottom"lp><"clear"i>',
        ajax: {
            url: serve + 'apiMaterialesIndex',
            type: 'GET',
            dataType: "json",
        },
        columnDefs: [
            {
                targets: [1, 2, 3, 4, 5, 6, 7, 8, 9],
                orderable: false,
            },
            {
                targets: [2],
                render: $.fn.dataTable.render.number(',', '.', 2, ''),
                // type: "numeric-comma",
            }
        ],
        columns: [
            {
                data: 'ID_MATERIAL', // 0
                render: function (data, type, row) {
                    return '<a class="cursor-pointer" id="btnEditMaterialIndex" onclick="editarMaterialIndex(' + data + '), openModalMaterialIndex()" class="text-uppercase box-table btn_editar_oportunidad">' + data + '</a>';
                },
                title: 'ID',
                className: 'dt-body-center',
                width: '5% !important',
            },
            {
                data: 'NOMBRE_MATERIAL', // 1
                render: function (data, type, row) {
                    return '<a class="cursor-pointer text-uppercase" id="btnEditMaterialIndex" onclick="editarMaterialIndex(' + row.ID_MATERIAL + '), openModalMaterialIndex()" class="text-uppercase box-table btn_editar_oportunidad">' + data + '</a>';
                },
                title: 'MATERIAL',
                className: 'dt-body-left',
                width: '35% !important',
            },
            {
                data: 'IMPORTE', // 2
                title: 'PRECIO',
                className: 'dt-body-right text-right',
                width: '5% !important',
            },
            {
                data: 'MONEDA', // 3
                title: 'MONEDA',
                className: 'dt-body-center text-center',
                width: '5% !important',
            },
            {
                data: 'PROVEEDOR', // 4
                title: 'PROVEEDOR',
                className: 'dt-body-left',
                width: '15% !important',
            },
            {
                data: 'ACTIVO', // 5
                render: function (data, type, row) {
                    if (data == 0) {
                        $checked = '';
                    } else {
                        $checked = 'checked';
                    }
                    return '<div class="custom-switch" style="padding-left: 20px !important"><input id="activo-' + row.ID_MATERIAL + '" type="checkbox" class="custom-control-input" style="height: 10px"' + $checked + ' onclick="activarMaterialIndex(' + row.ID_MATERIAL + ')"><label class="custom-control-label ml-3" style="margin-top: -3px"></label></div>';

                },
                className: 'dt-body-center',
                // width: '5% !important',
            },
            {
                data: 'TRASLUCIDO', // 6
                render: function (data, type, row) {
                    if (data == 0) {
                        $activo = 'fas fa-times-circle fa-2x text-danger';
                    } else {
                        $activo = 'fas fa-check-circle fa-2x text-success';
                    }
                    // return '<div class="custom-switch" style="padding-left: 20px !important"><input type="checkbox" class="custom-control-input" style="height: 10px"' + $activo + '><label class="custom-control-label ml-3" style="margin-top: -3px"></label></div>';
                    return '<span><i class="' + $activo + '"></i></span>';

                },
                title: 'TRASLUCIDO',
                className: 'dt-body-center',
                // width: '5% !important',
            },
            {
                data: 'CORTE', // 7
                render: function(data, type, row){
                    if (data === 'N') {
                        return '<span>NAVAJA</span>'
                    } else if(data === 'B') {
                        return '<span>BROCA</span>'
                    } else {
                        return '<span>SIN CORTE</span>'
                    }
                },
                title: 'CORTE',
                className: 'dt-body-left',
                // width: '5% !important',
            },
            {
                data: 'SOLVENTE', // 8
                render: function (data, type, row) {
                    if (data == 0 || data == '') {
                        $activo = 'fas fa-times-circle fa-2x text-danger';
                    } else {
                        $activo = 'fas fa-check-circle fa-2x text-success';
                    }
                    // return '<div class="custom-switch" style="padding-left: 20px !important"><input type="checkbox" class="custom-control-input" style="height: 10px"' + $activo + '><label class="custom-control-label ml-3" style="margin-top: -3px"></label></div>';
                    return '<span><i class="' + $activo + '"></i></span>';

                },
                title: 'SOLVENTE',
                className: 'dt-body-center',
                // width: '5% !important',
            },
            {
                data: 'TIPO_TEXTO', // 9
                title: 'TIPO',
                className: 'dt-body-left',
                // width: '15% !important',
            },
        ],
        // headerCallback: function (head, data, start, end, display) {
        //     countMaterial.value = data.length;
        //     if ((cantidad.value == 0 || cantidad.value == '') || (tancho.value == 0 || tancho.value == '') || (talto.value == 0 || talto.value == '')) {
        //         head.getElementsByTagName('th')[6].innerHTML = '<i class="fas fa-plus-circle" style="font-size: 18px !important; color: #999 !important; text-align: right"></i>';
        //     } else {
        //         head.getElementsByTagName('th')[6].innerHTML = '<a class="cursor-pointer" title="Agregar" onclick="openAddMaterial(), openModalAddMaterial()" ><i class="fas fa-plus-circle" style="font-size: 18px !important; color: #fff !important; text-align: right"></i></a>';
        //     }
        // },
        pageLength: 50,
        lengthMenu: [
            [50, 100, 200, 500, -1],
            [50, 100, 200, 500, "TODOS"],
        ],
        initComplete: function (settings, json) {
            ajustarTablas('tblMaterialesIndex', heightTable);
            loaderOut();
        },
        // rowCallback: function (row, data) {
        //     if (data.T == 'TMP') {
        //         $('td', row).css('color', '#598ACA');
        //     } else {

        //     }
        // },
    });
}

selectRowCotizaciones("tblMaterialesIndex");

$("#AddMaterialIndex").on("shown.bs.modal", function () {
    $("#NOMBRE_MATERIAL").trigger("focus");
});

$("#AddMaterialIndex").draggable({
    handle: "#headerAddMaterialIndex",
});

$("#AddMaterialIndex").on("hidden.bs.modal", function (e) {
    // e.preventDefault();
    $("#AddMaterialIndex").find("#formAddMaterialIndex")[0].reset();
    let mMaterial = document.querySelector("#AddMaterialIndex");
    mMaterial.classList.remove("showModal");
});

function openModalMaterialIndex() {
    let modalMaterialIndex = document.querySelector("#AddMaterialIndex");
    let sidebar = document.querySelector(".sidebar");
    sidebar.style.zIndex = 0;
    modalMaterialIndex.classList.add("showModal");
}

function nuevoMaterialIndex() {
    $("#AddMaterialIndex").modal('show');
    $ID_MATERIAL.value = '';
    $("#titleAddMaterialIndex").text('NUEVO MATERIAL');
    validarRequeridosMateriales();
    $ACTIVO.disabled = true;

}

function editarMaterialIndex(id) {
    $.ajax({
        url: serve + 'obtenerMaterialIndex',
        type: 'GET',
        dataType: 'JSON',
        data: {
            id: id,
        },
        success: function(data){
            console.log(data);
            $("#AddMaterialIndex").modal('show');
            $("#titleAddMaterialIndex").text('EDITAR MATERIAL');
            $ID_MATERIAL.value = data[0].ID_MATERIAL;
            $NOMBRE_MATERIAL.value = data[0].NOMBRE_MATERIAL;
            $ANCHO1.value = data[0].ANCHO1;
            $ANCHO2.value = data[0].ANCHO2;
            $ANCHO3.value = data[0].ANCHO3;
            $ANCHO4.value = data[0].ANCHO4;
            $ANCHO5.value = data[0].ANCHO5;
            $ALTO1.value = data[0].ALTO1;
            $ALTO2.value = data[0].ALTO2;
            $ALTO3.value = data[0].ALTO3;
            $ALTO4.value = data[0].ALTO4;
            $ALTO5.value = data[0].ALTO5;
            $CORTE.value = data[0].CORTE;
            $IMPORTE.value = data[0].IMPORTE;
            $PROVEEDOR.value = data[0].PROVEEDOR;
            $TIPO.value = data[0].TIPO;

            if (data[0].ACTIVO == 1) {
                $ACTIVO.checked = true;
            } else {
                $ACTIVO.checked = false;
            }

            if (data[0].TRASLUCIDO == 1) {
                $TRASLUCIDO.checked = true;
            } else {
                $TRASLUCIDO.checked = false;
            }

            if (data[0].SOLVENTE == 1) {
                $SOLVENTE.checked = true;
            } else {
                $SOLVENTE.checked = false;
            }

            validarRequeridosMateriales();
        },
        error: function(){
            Swal.fire('Erroe al obtener los datos...');
        }
    });
}

$('#NOMBRE_MATERIAL').change(function(){
    validarRequeridosMateriales();
})

$('#ANCHO1').change(function(){
    validarRequeridosMateriales();
})

$('#ALTO1').change(function(){
    validarRequeridosMateriales();
})

$('#TIPO').change(function(){
    validarRequeridosMateriales();
})

$('#IMPORTE').change(function(){
    validarRequeridosMateriales();
})

$('#PROVEEDOR').change(function(){
    validarRequeridosMateriales();
})

$('#CORTE').change(function(){
    validarRequeridosMateriales();
})

function validarRequeridosMateriales(){
    if ($NOMBRE_MATERIAL.value == '' || $ANCHO1.value == '' || $ALTO1.value == '' || $ANCHO1.value <= 0 || $ALTO1.value <= 0 || $TIPO == '' || $IMPORTE.value == '' || $IMPORTE.value <= 0 || $PROVEEDOR == '' ||  $CORTE == '' ) {
        btnAddMaterialIndex.disabled = true;
    } else {
        btnAddMaterialIndex.disabled = false;
    }

    if ($NOMBRE_MATERIAL.value == '') {
        $('#NOMBRE_MATERIAL').addClass('border-red');
        $('#NOMBRE_MATERIAL').removeClass('border-green');
    } else {
        $('#NOMBRE_MATERIAL').removeClass('border-red');
        $('#NOMBRE_MATERIAL').addClass('border-green');
    }

    if ($ANCHO1.value == '' || $ANCHO1.value <= 0) {
        $('#ANCHO1').addClass('border-red');
        $('#ANCHO1').removeClass('border-green');
    } else {
        $('#ANCHO1').removeClass('border-red');
        $('#ANCHO1').addClass('border-green');
    }

    if ($ALTO1.value == '' || $ALTO1.value <= 0) {
        $('#ALTO1').addClass('border-red');
        $('#ALTO1').removeClass('border-green');
    } else {
        $('#ALTO1').removeClass('border-red');
        $('#ALTO1').addClass('border-green');
    }

    if ($TIPO.value == '' || $TIPO.value <= 0) {
        $('#TIPO').addClass('border-red');
        $('#TIPO').removeClass('border-green');
    } else {
        $('#TIPO').removeClass('border-red');
        $('#TIPO').addClass('border-green');
    }

    if ($IMPORTE.value == '' || $IMPORTE.value <= 0) {
        $('#IMPORTE').addClass('border-red');
        $('#IMPORTE').removeClass('border-green');
    } else {
        $('#IMPORTE').removeClass('border-red');
        $('#IMPORTE').addClass('border-green');
    }

    if ($PROVEEDOR.value == '') {
        $('#PROVEEDOR').addClass('border-red');
        $('#PROVEEDOR').removeClass('border-green');
    } else {
        $('#PROVEEDOR').removeClass('border-red');
        $('#PROVEEDOR').addClass('border-green');
    }

    if ($CORTE.value == '' || $CORTE.value <= 0) {
        $('#CORTE').addClass('border-red');
        $('#CORTE').removeClass('border-green');
    } else {
        $('#CORTE').removeClass('border-red');
        $('#CORTE').addClass('border-green');
    }

}

function guardarAddMaterialIndex(){
    let id = $('#ID_MATERIAL_INDEX').val();
    if (id == '') {
        url = serve + 'guardarMaterialIndex';
        mensaje = 'Material Guardado';
        mensaje_error = 'Material no se pudo Guardar';
    } else {
        url = serve + 'guardarMaterialIndex';
        mensaje = 'Material Actualizado';
        mensaje_error = 'Material no se pudo Actualizar';
    }

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        data: $("#AddMaterialIndex form").serialize(),
        success: function(data){
            Swal.fire(mensaje)
        },
        error: function(){
            Swal.fire(mensaje_error)
        },
    });
    $("#AddMaterialIndex").modal('hide');
    tblMaterialesIndex.ajax.reload();
}

function activarMaterialIndex(id){
    activo = $('#activo-' + id)[0].checked;
    if (activo == true) {
        mensaje = 'Activado';
    } else {
        mensaje = 'Desactivado';
    }

    $.ajax({
        url: serve + 'activarMaterialIndex',
        type: 'GET',
        dataType: 'JSON',
        data: {
            id: id,
            ACTIVO: activo,
        },
        success: function(data){
            Swal.fire('Material ' + mensaje)
        },
    });
}

// ========================================== TINTAS ============================================

function tblTintasIndexLoad() {
    tblTintasIndex = $('#tblTintasIndex').DataTable({
        destroy: true,
        pageResize: false,
        searchable: true,
        processing: false,
        serverSide: true,
        rowId: "idTintas",
        select: false,
        scrollY: false,
        scrollX: false,
        scrollCollapse: false,
        paginate: true,
        stateSave: false,
        deferRender: false,
        autoWidth: false,
        order: [
            [0, "DESC"],
        ],
        language: {
            url: serve + "js/spanish-DT.json",
        },
        dom: '<"top">rt<"bottom"lp><"clear"i>',
        ajax: {
            url: serve + 'apiTintasIndex',
            type: 'GET',
            dataType: "json",
        },
        columnDefs: [
            {
                targets: [1, 2, 3, 4, 5],
                orderable: false,
            },
            {
                targets: [2, 3, 4],
                render: $.fn.dataTable.render.number(',', '.', 2, ''),
                // type: "numeric-comma",
            }
        ],
        columns: [
            {
                data: 'idTintas', // 0
                render: function (data, type, row) {
                    return '<a class="cursor-pointer" id="btnEditTintaIndex" onclick="editarTintaIndex(' + data + '), openModalTintaIndex()" class="text-uppercase box-table btn_editar_oportunidad">' + data + '</a>';
                },
                title: 'ID',
                className: 'dt-body-center',
                width: '5% !important',
            },
            {
                data: 'Nombre', // 1
                render: function (data, type, row) {
                    return '<a class="cursor-pointer text-uppercase" id="btnEditTintaIndex" onclick="editarTintaIndex(' + row.idTintas + '), openModalTintaIndex()" class="text-uppercase box-table btn_editar_oportunidad">' + data + '</a>';
                },
                title: 'NOMBRE',
                className: 'dt-body-left',
                width: '35% !important',
            },
            {
                data: 'PrecioTinta', // 2
                title: 'PRECIO TINTA',
                className: 'dt-body-left text-left',
                width: '5% !important',
            },
            {
                data: 'PrecioMOFlexible', // 3
                title: 'PRECIO MO FLEXIBLE',
                className: 'dt-body-left text-left',
                width: '5% !important',
            },
            {
                data: 'PrecioMORigido', // 4
                title: 'PRECIO MO RIGIDO',
                className: 'dt-body-left',
                width: '15% !important',
            },
            {
                data: 'Estatus', // 5
                render: function (data, type, row) {
                    if (data == 0) {
                        $checked = '';
                    } else {
                        $checked = 'checked';
                    }
                    return '<div class="custom-switch" style="padding-left: 20px !important"><input id="estatus-' + row.idTintas + '" type="checkbox" class="custom-control-input" style="height: 10px"' + $checked + ' onclick="activarTintaIndex(' + row.idTintas + ')"><label class="custom-control-label ml-3" style="margin-top: -3px"></label></div>';
                },
                className: 'dt-body-center',
                // width: '5% !important',
            },
        ],
        pageLength: 50,
        lengthMenu: [
            [50, 100, 200, 500, -1],
            [50, 100, 200, 500, "TODOS"],
        ],
        initComplete: function (settings, json) {
            ajustarTablas('tblTintasIndex', heightTableTintas);
            loaderOut();
        },
    });
}

selectRowCotizaciones("tblTintasIndex");

$("#AddTintaIndex").on("shown.bs.modal", function () {
    $("#Nombre").trigger("focus");
});

$("#AddTintaIndex").draggable({
    handle: "#headerAddTintaIndex",
});

$("#AddTintaIndex").on("hidden.bs.modal", function (e) {
    // e.preventDefault();
    $("#AddTintaIndex").find("#formAddTintaIndex")[0].reset();
    let mTinta = document.querySelector("#AddTintaIndex");
    mTinta.classList.remove("showModal");
});

function openModalTintaIndex() {
    let modalTintaIndex = document.querySelector("#AddTintaIndex");
    let sidebar = document.querySelector(".sidebar");
    sidebar.style.zIndex = 0;
    modalTintaIndex.classList.add("showModal");
}

function nuevaTintaIndex() {
    $("#AddTintaIndex").modal('show');
    $('#idTintas').val('');
    $("#titleAddTintaIndex").text('NUEVA TINTA');
    validarRequeridosTintas();
    Estatus.disabled = true;
}

function editarTintaIndex(id_tintas) {
    $.ajax({
        url: serve + 'obtenerTintaIndex',
        type: 'GET',
        dataType: 'JSON',
        data: {
            id: id_tintas,
        },
        success: function(data){
            $("#AddTintaIndex").modal('show');
            $("#titleAddTintaIndex").text('EDITAR TINTA');
            idTintas.value = data[0].idTintas;
            Nombre.value = data[0].Nombre;
            PrecioTinta.value = data[0].PrecioTinta;
            PrecioMOFlexible.value = data[0].PrecioMOFlexible;
            PrecioMORigido.value = data[0].PrecioMORigido;

            if (data[0].Estatus == 1) {
                Estatus.checked = true;
            } else {
                Estatus.checked = false;
            }

            validarRequeridosTintas();
        },
        error: function(){
            Swal.fire('Erroe al obtener los datos...');
        }
    });
}

$('#Nombre').change(function(){
    validarRequeridosTintas();
})

$('#PrecioTinta').change(function(){
    validarRequeridosTintas();
})

$('#PrecioMOFlexible').change(function(){
    validarRequeridosTintas();
})

$('#PrecioMORigido').change(function(){
    validarRequeridosTintas();
})

function validarRequeridosTintas(){
    if (Nombre.value == '' || PrecioTinta.value == '' || PrecioTinta.value <= 0 || PrecioMOFlexible.value == '' || PrecioMOFlexible.value <= 0 || PrecioMORigido.value == '' || PrecioMORigido.value <= 0 ) {
        btnAddTintaIndex.disabled = true;
    } else {
        btnAddTintaIndex.disabled = false;
    }

    if (Nombre.value == '') {
        $('#Nombre').addClass('border-red');
        $('#Nombre').removeClass('border-green');
    } else {
        $('#Nombre').removeClass('border-red');
        $('#Nombre').addClass('border-green');
    }

    if (PrecioTinta.value == '' || PrecioTinta.value <= 0) {
        $('#PrecioTinta').addClass('border-red');
        $('#PrecioTinta').removeClass('border-green');
    } else {
        $('#PrecioTinta').removeClass('border-red');
        $('#PrecioTinta').addClass('border-green');
    }

    if (PrecioMOFlexible.value == '' || PrecioMOFlexible.value <= 0) {
        $('#PrecioMOFlexible').addClass('border-red');
        $('#PrecioMOFlexible').removeClass('border-green');
    } else {
        $('#PrecioMOFlexible').removeClass('border-red');
        $('#PrecioMOFlexible').addClass('border-green');
    }

    if (PrecioMORigido.value == '' || PrecioMORigido.value <= 0) {
        $('#PrecioMORigido').addClass('border-red');
        $('#PrecioMORigido').removeClass('border-green');
    } else {
        $('#PrecioMORigido').removeClass('border-red');
        $('#PrecioMORigido').addClass('border-green');
    }
}

function guardarAddTintaIndex(){
    let id = $('#idTintas').val();
    if (id == '') {
        url = serve + 'guardarTintaIndex';
        mensaje = 'Tinta Guardada';
        mensaje_error = 'Tinta no se pudo Guardar';
    } else {
        url = serve + 'guardarTintaIndex';
        mensaje = 'Tinta Actualizada';
        mensaje_error = 'Tinta no se pudo Actualizar';
    }

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        data: $("#AddTintaIndex form").serialize(),
        success: function(data){
            Swal.fire(mensaje)
        },
        error: function(){
            Swal.fire(mensaje_error)
        },
    });
    $("#AddTintaIndex").modal('hide');
    tblTintasIndex.ajax.reload();
}

function activarTintaIndex(id){
    estatus = $('#estatus-' + id)[0].checked;
    if (estatus == true) {
        mensaje = 'Activada';
    } else {
        mensaje = 'Desactivada';
    }

    $.ajax({
        url: serve + 'activarTintaIndex',
        type: 'GET',
        dataType: 'JSON',
        data: {
            id: id,
            ACTIVO: estatus,
        },
        success: function(data){
            Swal.fire('Tinta ' + mensaje)
        },
    });
}

// ========================================== ACABADOS ============================================

function tblAcabadosIndexLoad() {
    tblAcabadosIndex = $('#tblAcabadosIndex').DataTable({
        destroy: true,
        pageResize: false,
        searchable: true,
        processing: false,
        serverSide: true,
        rowId: "ID_ACABADO",
        select: false,
        scrollY: false,
        scrollX: false,
        scrollCollapse: false,
        paginate: true,
        stateSave: false,
        deferRender: false,
        autoWidth: false,
        order: [
            [0, "DESC"],
        ],
        language: {
            url: serve + "js/spanish-DT.json",
        },
        dom: '<"top">rt<"bottom"lp><"clear"i>',
        ajax: {
            url: serve + 'apiAcabadosIndex',
            type: 'GET',
            dataType: "json",
        },
        columnDefs: [
            {
                targets: [1, 2, 3, 4],
                orderable: false,
            },
            {
                targets: [3],
                render: $.fn.dataTable.render.number(',', '.', 2, ''),
                // type: "numeric-comma",
            }
        ],
        columns: [
            {
                data: 'ID_ACABADO', // 0
                render: function (data, type, row) {
                    return '<a class="cursor-pointer" id="btnEditAcabadoIndex" onclick="editarAcabadoIndex(' + data + '), openModalAcabadoIndex()" class="text-uppercase box-table btn_editar_oportunidad">' + data + '</a>';
                },
                title: 'ID',
                className: 'dt-body-center',
                width: '5% !important',
            },
            {
                data: 'DESCRIPCION', // 1
                render: function (data, type, row) {
                    return '<a class="cursor-pointer text-uppercase" id="btnEditAcabadoIndex" onclick="editarAcabadoIndex(' + row.ID_ACABADO + '), openModalAcabadoIndex()" class="text-uppercase box-table btn_editar_oportunidad">' + data + '</a>';
                },
                title: 'DESCRIPCION',
                className: 'dt-body-left',
                width: '35% !important',
            },
            {
                data: 'UNIDAD', // 2
                title: 'UNIDAD',
                className: 'dt-body-center text-center',
                width: '5% !important',
            },
            {
                data: 'IMPORTE', // 3
                title: 'IMPORTE',
                className: 'dt-body-right text-right',
                width: '5% !important',
            },
            {
                data: 'ACTIVO', // 4
                render: function (data, type, row) {
                    if (data == 0) {
                        $checked = '';
                    } else {
                        $checked = 'checked';
                    }
                    return '<div class="custom-switch" style="padding-left: 20px !important"><input id="activo_acabado-' + row.ID_ACABADO + '" type="checkbox" class="custom-control-input" style="height: 10px"' + $checked + ' onclick="activarAcabadoIndex(' + row.ID_ACABADO + ')"><label class="custom-control-label ml-3" style="margin-top: -3px"></label></div>';
                },
                className: 'dt-body-center',
                // width: '5% !important',
            },
        ],
        pageLength: 50,
        lengthMenu: [
            [50, 100, 200, 500, -1],
            [50, 100, 200, 500, "TODOS"],
        ],
        initComplete: function (settings, json) {
            ajustarTablas('tblAcabadosIndex', heightTableAcabados);
            loaderOut();
        },
    });
}

selectRowCotizaciones("tblAcabadosIndex");

$("#AddAcabadoIndex").on("shown.bs.modal", function () {
    $("#DESCRIPCION").trigger("focus");
});

$("#AddAcabadoIndex").draggable({
    handle: "#headerAddAcabadoIndex",
});

$("#AddAcabadoIndex").on("hidden.bs.modal", function (e) {
    $("#AddAcabadoIndex").find("#formAddAcabadoIndex")[0].reset();
    let mAcabado = document.querySelector("#AddAcabadoIndex");
    mAcabado.classList.remove("showModal");
});

function openModalAcabadoIndex() {
    let modalAcabadoIndex = document.querySelector("#AddAcabadoIndex");
    let sidebar = document.querySelector(".sidebar");
    sidebar.style.zIndex = 0;
    modalAcabadoIndex.classList.add("showModal");
}

function nuevoAcabadoIndex() {
    $("#AddAcabadoIndex").modal('show');
    $('#idTintas').val('');
    $("#titleAddTintaIndex").text('NUEVA TINTA');
    validarRequeridosAcabados();
    Estatus.disabled = true;
}

function editarAcabadoIndex(id_acabados) {
    $.ajax({
        url: serve + 'obtenerAcabadoIndex',
        type: 'GET',
        dataType: 'JSON',
        data: {
            id: id_acabados,
        },
        success: function(data){
            console.log(data);
            $("#AddAcabadoIndex").modal('show');
            $("#titleAddAcabadoIndex").text('EDITAR ACABADO');
            $ID_ACABADO.value = data[0].ID_ACABADO;
            $DESCRIPCION.value = data[0].DESCRIPCION;
            $UNIDAD.value = data[0].UNIDAD;
            $IMPORTE_ACABADO.value = data[0].IMPORTE;

            if (data[0].ACTIVO == 1) {
                $ACTIVO_ACABADO.checked = true;
            } else {
                $ACTIVO_ACABADO.checked = false;
            }

            validarRequeridosAcabados();
        },
        error: function(){
            Swal.fire('Erroe al obtener los datos...');
        }
    });
}

$('#DESCRIPCION').change(function(){
    validarRequeridosAcabados();
})

$('#UNIDAD').change(function(){
    validarRequeridosAcabados();
})

$('#IMPORTE_ACABADO').change(function(){
    validarRequeridosAcabados();
})


function validarRequeridosAcabados(){
    if ($DESCRIPCION.value == '' || $UNIDAD.value == '' || $IMPORTE_ACABADO.value == '' || $IMPORTE_ACABADO.value <= 0) {
        btnAddAcabadoIndex.disabled = true;
    } else {
        btnAddAcabadoIndex.disabled = false;
    }

    if ($DESCRIPCION.value == '') {
        $('#DESCRIPCION').addClass('border-red');
        $('#DESCRIPCION').removeClass('border-green');
    } else {
        $('#DESCRIPCION').removeClass('border-red');
        $('#DESCRIPCION').addClass('border-green');
    }

    if ($UNIDAD.value == '') {
        $('#UNIDAD').addClass('border-red');
        $('#UNIDAD').removeClass('border-green');
    } else {
        $('#UNIDAD').removeClass('border-red');
        $('#UNIDAD').addClass('border-green');
    }

    if ($IMPORTE_ACABADO.value == '' || $IMPORTE_ACABADO.value <= 0) {
        $('#IMPORTE_ACABADO').addClass('border-red');
        $('#IMPORTE_ACABADO').removeClass('border-green');
    } else {
        $('#IMPORTE_ACABADO').removeClass('border-red');
        $('#IMPORTE_ACABADO').addClass('border-green');
    }
}

function guardarAddAcabadoIndex(){
    id_acabado = $('#ID_ACABADO').val();
    if (id_acabado == '') {
        url = serve + 'guardarAcabadoIndex';
        mensaje = 'Acabado Guardado';
        mensaje_error = 'Acabado no se pudo Guardar';
    } else {
        url = serve + 'guardarAcabadoIndex';
        mensaje = 'Acabado Actualizado';
        mensaje_error = 'Acabado no se pudo Actualizar';
    }

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        data: $("#AddAcabadoIndex form").serialize(),
        success: function(data){
            Swal.fire(mensaje)
        },
        error: function(){
            Swal.fire(mensaje_error)
        },
    });
    $("#AddAcabadoIndex").modal('hide');
    tblAcabadosIndex.ajax.reload();
}

function activarAcabadoIndex(id){
    estatus = $('#activo_acabado-' + id)[0].checked;
    if (estatus == true) {
        mensaje = 'Activado';
    } else {
        mensaje = 'Desactivado';
    }

    $.ajax({
        url: serve + 'activarAcabadoIndex',
        type: 'GET',
        dataType: 'JSON',
        data: {
            id: id,
            ACTIVO: estatus,
        },
        success: function(data){
            Swal.fire('Acabado ' + mensaje)
        },
    });
}

