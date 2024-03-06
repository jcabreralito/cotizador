serve = base_path;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
const FROM_PATTERN = "YYYY-MM-DD HH:mm:ss.SSS";
const TO_PATTERN = "DD-MM-YYYY HH:mm";

const FROM_PATTERN_SHORT = "YYYY-MM-DD";
const TO_PATTERN_SHORT = "DD-MM-YYYY";
editar_material = 0;
editar_cotizacion = 0;
id_cotizaciones_material = 0;
dominio = document.domain;
precios_mat = null;

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    collapsedGroups = {};

    dateToday = new Date();
    cliente = document.getElementById('cliente');
    trabajo = document.getElementById('trabajo');
    cantidad = document.getElementById('cantidad');
    ancho = document.getElementById('ancho');
    medancho = document.getElementById('medancho');
    tancho = document.getElementById('tancho');
    alto = document.getElementById('alto');
    medalto = document.getElementById('medalto');
    talto = document.getElementById('talto');
    resSubtotal = document.getElementById('resSubtotal');
    resMargen = document.getElementById('resMargen');
    porcientoMargen = document.getElementById('porcientoMargen');
    resComision = document.getElementById('resComision');
    porcientoComision = document.getElementById('porcientoComision');
    resPreUnit = document.getElementById('resPreUnit');
    resTotal = document.getElementById('resTotal');
    resTotal2 = document.getElementById('resTotal2');
    tiempoproduccion = document.getElementById('tiempoproduccion');
    observaciones = document.getElementById('observaciones');
    btnsaveCotizacion = document.getElementById('btnsaveCotizacion');
    btnCloseCotizacion = document.getElementById('btnCloseCotizacion');
    folio2 = document.getElementById('folio2');
    fecha = document.getElementById('fecha');
    btnAddMaterial = document.getElementById('btnAddMaterial');
    medH = document.getElementById('medH');
    anchoH = document.getElementById('anchoH');
    altoH = document.getElementById('altoH');
    entranH = document.getElementById('entranH');
    orientacionH = document.getElementById('orientacionH');
    aprovechaminetoH = document.getElementById('aprovechaminetoH');
    cantidadH = document.getElementById('cantidadH');
    importeH = document.getElementById('importeH');
    titCantMat = document.getElementById('titCantMat');
    divMaterialEspecial = document.getElementById('divMaterialEspecial');
    nombre_material = document.getElementById('NOMBRE_MATERIAL');
    matancho = document.getElementById('MATANCHO');
    matalto = document.getElementById('MATALTO');
    tipo_material = document.getElementById('TIPO_MATERIAL');
    tipo_corte = document.getElementById('TIPO_CORTE');
    importe = document.getElementById('IMPORTE');
    proveedor = document.getElementById('PROVEEDOR');
    translucido = document.getElementById('TRANSLUCIDO');
    id_material_2 = document.getElementById('ID_MATERIAL_2');
    material_especial = document.getElementById('MATERIAL_ESPECIAL');
    titleVisor = document.getElementById('titleVisor');
    imgVisor = document.getElementById('imgVisor');
    countMaterial = document.getElementById('countMaterial');

    homeHeigth = document.getElementById("home-section");
    cardGeneral = document.getElementById("card_general");
    cardGeneral.style.height = (homeHeigth.clientHeight - 70).toString() + "px";
    heightTable = (cardGeneral.clientHeight - 130).toString() + "px";
    ajustarTablas('tblCotizador', heightTable);

    tblCotizador = $('#tblCotizador').DataTable({
        destroy: true,
        pageResize: false,
        searchable: true,
        processing: false,
        serverSide: true,
        rowId: "ID_COTIZACIONES",
        select: false,
        scrollY: false,
        scrollX: true,
        scrollCollapse: false,
        paginate: true,
        stateSave: false,
        deferRender: false,
        order: [
            [0, "DESC"],
        ],
        ajax: {
            url: serve + "apiCotizaciones",
            type: "GET",
            dataType: "json",
            // data: {
            //     texto: texto,
            //     check_mios: check_mios,
            //     abiertos: abiertos,
            //     is_movil: is_movil,
            // },
        },
        language: {
            url: serve + "js/spanish-DT.json",
        },
        dom: '<"top">rt<"bottom"lp><"clear"i>',
        columnDefs: [
            // {
            //     targets: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
            //     orderable: false,
            // },
            {
                targets: [1],
                render: $.fn.dataTable.render.moment(FROM_PATTERN, TO_PATTERN_SHORT),
            },
            // {
            //     targets: [0, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
            //     className: "dt-body-center text-center",
            // },
            {
                targets: [4],
                render: $.fn.dataTable.render.number(",", ".", 0, ""),
                className: 'text-right text-bold',
            }
        ],
        columns: [
            {
                data: 'FOLIO', // 0
                render: function (data, type, row) {
                    return '<a class="cursor-pointer" id="btnEditCotizacion" onclick="editarCotizacion(' + row.ID_COTIZACIONES + '), openModalCotizacion()" class="text-uppercase box-table btn_editar_oportunidad">' + data + '</a>';
                },
                title: "N°",
                className: 'text-bold dt-body-center text-center',
            },
            {
                data: 'FECHA_HORA', // 1
                title: "Fecha",
                // visible: visible,
            },
            {
                data: 'CLIENTE', // 2
                title: "Cliente",
                // width: '10%',
            },
            {
                data: 'TRABAJO', // 3
                render: function (data, type, row) {
                    return '<a class="cursor-pointer" id="btnEditCotizacion" onclick="editarCotizacion(' + row.ID_COTIZACIONES + '), openModalCotizacion()" class="text-uppercase box-table btn_editar_oportunidad">' + data + '</a>';
                },
                title: "Trabajo",
                // width: '7%',
                // visible: visible,
            },
            {
                data: 'CANTIDAD', // 4
                // render: function (data, type, tow) {
                //     return '<b>' + data.number(",", ".", 0, "") + '</b>'
                // },
                title: "Cantidad",
                className: 'dt-body-center',
                // width: '7%',
                // visible: visible,
            },
            {
                data: 'OBSERVACIONES', // 5
                // render: function (data, type, row) {
                //     if (row.Estado == 'CANCELADO') {
                //         return '<div class="bg-cancel-ticket">CANCELADO</div>';
                //     } else {
                //         if (row.Situacion_2 == 'ATRASADO') {
                //             return '<div class="bg-danger-ticket">' + moment(data).format(TO_PATTERN_ESTR_SHORT) + '</div>';
                //         } else {
                //             return '<div class="bg-success-ticket">' + moment(data).format(TO_PATTERN_ESTR_SHORT) + '</div>';
                //         }
                //     }
                // },
                title: "Observaciones",
                // width: '7%',
                // visible: visible,
            },
        ],
        pageLength: 50,
        lengthMenu: [
            [50, 100, 200, 500, -1],
            [50, 100, 200, 500, "TODOS"],
        ],
        initComplete: function (settings, json) {
            ajustarTablas('tblCotizador', heightTable);
            loaderOut();
        },
        infoCallback: function (settings, start, end, max, total, pre) {
            if (total == 0) return "<strong class='ml-2'>Sin Cotizaciones</strong>";
            if (total == 1) return "<strong class='ml-2'>1 Cotización</strong>";
            return '<strong class="ml-2">' + end + ' de ' + total + ' Cotizaciones</strong>';
        },
    });

    tblAddMaterialLoad(0, 0, 0, 0);
});

$('#tblMedidasMaterial tbody').on('click', 'tr', function (e) {
    e.preventDefault();
    let data = tblMedidasMaterial.row(this).data();
    btnAddMaterial.disabled = false;

    medH.value = data.med;
    anchoH.value = data.ancho;
    altoH.value = data.alto;
    entranH.value = data.entran;
    orientacionH.value = data.textoEntran;
    aprovechamientoH.value = data.aprovechamiento;
    cantidadH.value = data.rescantidad;
    importeH.value = data.resimporte;
    titCantMat.value = data.titCantMat;
    material_especial.checked = false;
});

selectRowCotizaciones("tblCotizador");
selectRowAdicionales("tblMedidasMaterial");

$(window).resize(function () {
    aplicarHeightModal();
    aplicarHeightIndex();
});

function openModalCotizacion() {
    let modalCotizador = document.querySelector("#AddCotizador");
    let sidebar = document.querySelector(".sidebar");
    sidebar.style.zIndex = 0;
    modalCotizador.classList.add("showModal");
}

function openModalAddMaterial() {
    let modalAddMaterial = document.querySelector("#AddMaterial");
    modalAddMaterial.classList.add("showModal");
}

$("#AddCotizador").on("shown.bs.modal", function () {
    $("#cliente").trigger("focus");
    aplicarHeightModal();
});

function aplicarHeightModal() {
    let modalCotizador = document.querySelector("#AddCotizador");
    let headerCotizacion = document.querySelector("#headerCotizacion");
    let divDatos = document.querySelector("#divDatos");
    let divCantidades = document.querySelector("#divCantidades");
    let divObservaciones = document.querySelector("#divObservaciones");
    let datosCotizacion = document.querySelector("#datosCotizacion");

    datosCotizacion.style.height = (modalCotizador.clientHeight - (headerCotizacion.clientHeight + divDatos.clientHeight + divCantidades.clientHeight + divObservaciones.clientHeight + 120)).toString() + "px";
    divFormacion.style.height = (modalCotizador.clientHeight - (headerCotizacion.clientHeight + divDatos.clientHeight + divCantidades.clientHeight + divObservaciones.clientHeight + 100)).toString() + "px";
}

function aplicarHeightIndex() {

    alto_ = $(window).height();
    heightTable_ = (alto_ - 203).toString() + "px";
    ajustarTablas('tblCotizador', heightTable_);
}

// // <!-- Función para obtener el Ancho(Width) -->
// function obtenerAncho(obj, ancho) {
//     alert("El ancho de la " + obj + " es " + ancho + "px. (Width)");
// }

// // <!-- Función para obtener el Alto(Height) -->
// function obtenerAlto(obj, alto) {
//     alert("El alto de la " + obj + " es " + alto + "px. (Height)");
//     heightTable_ = alto + "px";
//     // ajustarTablas('tblCotizador', heightTable_);
// }
// obtenerAlto("ventana", $(window).height());
// obtenerAncho("ventana", $(window).width());

// $(window).resize(function () {
//     obtenerAlto("ventana", $(window).height());
//     obtenerAncho("ventana", $(window).width());
// });

$("#AddCotizador").on("hidden.bs.modal", function (e) {
    $("#AddCotizador").find("#formAddCotizador")[0].reset();
    let mCotizacion = document.querySelector("#AddCotizador");
    let sidebar = document.querySelector(".sidebar");
    sidebar.style.zIndex = 3;
    mCotizacion.classList.remove("showModal");
    tblFormacionLoad(0);
});

function nuevaCotizacion(tipo, accion) {

    $("#AddCotizador").modal("show");
    $("#AddCotizador").find("#formAddCotizador")[0].reset();
    let modalCotizador = document.querySelector("#AddCotizador");
    modalCotizador.classList.add("showModal");
    $('#cliente').prop('disabled', false);
    $('#cliente').trigger('focus');
    $('#fecha').val(dateFormat(dateToday, 'dd-mm-yyyy'));
    $("#titleCotizacion").text("NUEVA COTIZACION");
    $("#cantidad").val(0);
    $("#ancho").val(0);
    $("#alto").val(0);
    $("#medancho").val(0);
    $("#medalto").val(0);
    $("#tancho").val(0);
    $("#talto").val(0);
    btnCloseCotizacion.innerHTML = 'Cancelar';

    $.ajax({
        url: serve + 'obtenerFolio',
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            folio2.value = data;
            $.ajax({
                url: serve + 'cotizacionTMP',
                type: 'GET',
                data: {
                    folio: folio2.value,
                },
                success: function (data_tmp) {
                    $("#idCotizaciones").val(data_tmp);
                },
            });
            cargarDetalleMaterial(0);
            cargarDetalleTintas(0);
            cargarDetalleAcabados(0);
            cargarDetalleAdicionales(0);
            validarRequeridos();
        },
        error: function () {
            Swal.fire('No se pudo obtener el Folio...')
        },
    });
}

function updateCotizacionTMP() {
    clientetmp = $('#cliente').val();
    trabajotmp = $('#trabajo').val();
    cantidadtmp = $('#cantidad').val();
    anchotmp = $('#ancho').val();
    altotmp = $('#alto').val();
    med_anchotmp = $('#medancho').val();
    med_altotmp = $('#medalto').val();
    observacionestmp = $('#observaciones').val();
    subtotaltmp = $('#resSubtotal').val();
    pormargentmp = $('#porcientoMargen').val();
    margentmp = $('#resMargen').val();
    porcomisiontmp = $('#porcientoComision').val();
    comisiontmp = $('#resComision').val();
    punitariotmp = $('#resPreUnit').val();
    totaltmp = $('#resTotal').val();
    tiempo_producciontmp = $('#tiempoproduccion').val();

    $.ajax({
        url: serve + 'updateCotizacionTMP',
        type: 'GET',
        data: {
            cliente: clientetmp,
            trabajo: trabajotmp,
            cantidad: cantidadtmp,
            ancho: anchotmp,
            alto: altotmp,
            med_ancho: med_anchotmp,
            med_alto: med_altotmp,
            observaciones: observacionestmp,
            subtotal: subtotaltmp,
            pormargen: pormargentmp,
            margen: margentmp,
            porcomision: porcomisiontmp,
            comision: comisiontmp,
            punitario: punitariotmp,
            total: totaltmp,
            tiempo_produccion: tiempo_producciontmp,
            id_cotizaciones: $('#idCotizaciones').val(),
        }
    })
}

function validarRequeridos() {
    if (cliente.value == '' || trabajo.value == '' || cantidad.value == '' || ancho.value == '' || alto.value == '' || cantidad.value == 0 || ancho.value == 0 || alto.value == 0) {
        btnsaveCotizacion.disabled = true;
    } else {
        btnsaveCotizacion.disabled = false;
    }

    if (cliente.value == '') {
        $('#cliente').addClass('border-red');
        $('#cliente').removeClass('border-green');
    } else {
        $('#cliente').removeClass('border-red');
        $('#cliente').addClass('border-green');
    }

    if (trabajo.value == '') {
        $('#trabajo').addClass('border-red');
        $('#trabajo').removeClass('border-green');
    } else {
        $('#trabajo').removeClass('border-red');
        $('#trabajo').addClass('border-green');
    }

    if (cantidad.value == '' || cantidad.value <= 0) {
        $('#cantidad').addClass('border-red');
        $('#cantidad').removeClass('border-green');
    } else {
        $('#cantidad').removeClass('border-red');
        $('#cantidad').addClass('border-green');
    }

    if (ancho.value == '' || ancho.value <= 0) {
        $('#ancho').addClass('border-red');
        $('#ancho').removeClass('border-green');
    } else {
        $('#ancho').removeClass('border-red');
        $('#ancho').addClass('border-green');
    }

    if (alto.value == '' || alto.value <= 0) {
        $('#alto').addClass('border-red');
        $('#alto').removeClass('border-green');
    } else {
        $('#alto').removeClass('border-red');
        $('#alto').addClass('border-green');
    }

}

$("#cliente").change(function (e) {
    if ($('#cliente2').val() == '') {
        Swal.fire('¡Tienes que Seleccionar un Cliente!')
        $('#cliente').trigger('focus');
    } else {
        validarRequeridos();
        updateCotizacionTMP();
    }
})

$("#cliente").keypress(function (e) {
    $('#cliente2').val('');
    $("#cliente").autocomplete({
        delay: 0,
        minLength: 4,
        source: function (request, response) {
            $.ajax({
                url: serve + 'obtenerClientes',
                type: 'GET',
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                    search: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            event.preventDefault();
            $('#cliente2').val(ui.item.value);
            $('#cliente').val(ui.item.value);
            $('#trabajo').trigger('focus');
        },
        close: function (event, ui) {
            event.preventDefault();
            if ($('#cliente2').val() == '') {
                Swal.fire('¡Tienes que Seleccionar un Cliente!')
                $('#cliente').trigger('focus');
            }
        }
    });
    // if ($('#cliente2').val() == '') {
    //     Swal.fire('¡Tienes que Seleccionar un Cliente!')
    // }

    // validarRequeridosSistemas();

});

$("#trabajo").change(function (e) {
    validarRequeridos();
    updateCotizacionTMP();
})

$("#cantidad").change(function (e) {
    cambiarMedidas();
    updateCotizacionTMP();
})

$("#ancho").change(function (e) {
    cambiarMedidas();
    updateCotizacionTMP();
})

$("#alto").change(function (e) {
    cambiarMedidas();
    updateCotizacionTMP();
})

$("#medancho").change(function (e) {
    cambiarMedidas();
    updateCotizacionTMP();
})

$("#medalto").change(function (e) {
    cambiarMedidas();
    updateCotizacionTMP();
})

$("#porcientoMargen").change(function (e) {
    validarRequeridos();
    calcularTotales();
    updateCotizacionTMP();
})

$("#porcientoComision").change(function (e) {
    validarRequeridos();
    calcularTotales();
    updateCotizacionTMP();
})

$("#observaciones").change(function (e) {
    validarRequeridos();
    calcularTotales();
    updateCotizacionTMP();
})

$("#btnCloseCotizacion").on('click', function (e) {
    e.preventDefault();
    trabajo_anterior = $('#trabajoTMP').val();
    trabajo_actual = $('#trabajo').val();
    cantidad_anterior = $('#cantidadTMP').val();
    cantidad_actual = $('#cantidad').val();
    ancho_anterior = $('#anchoTMP').val();
    ancho_actual = $('#ancho').val();
    alto_anterior = $('#altoTMP').val();
    alto_actual = $('#alto').val();
    medancho_anterior = $('#medanchoTMP').val();
    medancho_actual = $('#medancho').val();
    medalto_anterior = $('#medaltoTMP').val();
    medalto_actual = $('#medalto').val();
    subtotal_anterior = $('#resSubtotalTMP').val();
    subtotal_actual = $('#resSubtotal').val();
    porcientoMargen_anterior = $('#margenTMP').val();
    porcientoMargen_actual = $('#porcientoMargen').val();
    porcientoComision_anterior = $('#comisionTMP').val();
    porcientoComision_actual = $('#porcientoComision').val();
    observaciones_anterior = $('#observacionesTMP').val();
    observaciones_actual = $('#observaciones').val();

    if ((subtotal_anterior == subtotal_actual) &&
        (trabajo_anterior == trabajo_actual) &&
        (cantidad_anterior == cantidad_actual) &&
        (ancho_anterior == ancho_actual) &&
        (alto_anterior == alto_actual) &&
        (medancho_anterior == medancho_actual) &&
        (medalto_anterior == medalto_actual) &&
        (porcientoMargen_anterior == porcientoMargen_actual) &&
        (porcientoComision_anterior == porcientoComision_actual) &&
        (observaciones_anterior == observaciones_actual)) {
        $.ajax({
            url: serve + 'sinCambiosCotizacion',
            type: 'GET',
            data: {
                id: $('#idCotizaciones').val(),
            },
            success: function () {
                $('#AddCotizador').modal('hide');
            },
            error: function () {
                $('#AddCotizador').modal('hide');
            },
        })
    } else {
        // if (btnCloseCotizacion.innerHTML == 'Cancelar') {
        Swal.fire({
            title: "Cancelar Cotización",
            text: "¡Se perderan los cambios de esta Cotización! ",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#999",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            allowEnterKey: false,
            stopKeydownPropagation: true,
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                loaderON();
                $.ajax({
                    url: serve + 'eliminarCotizacionTMP',
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        id: $('#idCotizaciones').val(),
                    },
                    success: function (data) {
                        loaderOut();
                        const Msg = Swal.mixin({
                            toast: true,
                            position: "center",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 3000,
                        });

                        Msg.fire({
                            title: "¡Cotización No Guardada!",
                        });
                    },
                    error: function () {
                        loaderOut();
                        const Msg = Swal.mixin({
                            toast: true,
                            position: "center",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 3000,
                        });

                        Msg.fire({
                            title: "¡Cotización No Guardada!",
                        });
                    },
                });
                $('#AddCotizador').modal('hide');
            } else {
                loaderOut();
            }
        });
        // } else {
        //     $('#AddCotizador').modal('hide');
        //     loaderOut();
        // }
    }

})

function cambiarMedidas() {
    totalAnchoAlto();
    if (countMaterial.value > 0) {
        let cantidad = $('#cantidad').val();
        let tancho = $('#tancho').val();
        let talto = $('#talto').val();
        $.ajax({
            url: serve + 'apiMateriales',
            type: 'GET',
            dataType: 'JSON',
            data: {
                id: $('#idCotizaciones').val(),
                editar: editar_cotizacion,
            },
            success: function (data) {
                datos = data.data;
                datos.forEach(element => {
                    // console.log(element);
                    let valor = calcular_material(cantidad, tancho, talto, element.MATANCHO, element.MATALTO, element.T, element.IMPORTE, element.ID_COTIZACIONES_MATERIAL);
                    // let valor = tblAddMaterialLoad(element.ID_MATERIAL, cantidad, tancho, talto);
                    // console.log(valor);
                    actualizarMedidasMaterial(valor.mat_cotId_r, valor.entranH_r, valor.importeH_r, valor.aprovechamientoH_r, valor.orientacionH_r, valor.cantidadH_r, valor.titCantMat_r);
                    calcularTotales();
                    // valores.push(valor);
                });

                // cargarDetalleMaterial($('#idCotizaciones').val());
                // tblMaterial.ajax.reload();
                // console.log(valores);
            },
        })


        $('#tblMaterial').DataTable({
            destroy: true,
            pageResize: false,
            searchable: false,
            processing: false,
            serverSide: true,
            select: false,
            scrollY: false,
            scrollX: false,
            scrollCollapse: false,
            paginate: false,
            stateSave: false,
            deferRender: false,
            language: {
                url: serve + "js/spanish-DT.json",
            },
            dom: '<"top">rt<"bottom"><"clear">',
            ajax: {
                url: serve + 'apiMateriales',
                type: 'GET',
                dataType: "json",
                data: {
                    id: $('#idCotizaciones').val(),
                    editar: editar_cotizacion,
                }
            },
            columnDefs: [
                {
                    targets: [0, 1, 2, 3, 4, 5, 6],
                    orderable: false,
                },
                {
                    targets: [2],
                    render: $.fn.dataTable.render.number(',', '.', 0, ''),
                    // type: "numeric-comma",
                },
                {
                    targets: [4, 5],
                    render: $.fn.dataTable.render.number(',', '.', 2, ''),
                    // type: "numeric-comma",
                }
            ],
            columns: [
                {
                    data: 'NOMBRE_MATERIAL', // 0
                    render: function (data, type, row) {
                        return '<span>' + data + '</span>';
                        // return '<span>' + data + '</span><span style="width: 10%">' + parseInt(row.MATANCHO) + ' X ' + parseInt(row.MATALTO) + ' CM. ' + '</span><b style="color: #1E3A8A !important; font-size: 18px; padding-left: 25%; text-shadow: 5px 4px 3px #999">' + row.TIPO + '</b>';
                    },
                    title: 'MATERIAL',
                    className: 'dt-body-left',
                    width: '40%',
                },
                {
                    data: 'MATANCHO', // 1
                    render: function (data, type, row) {
                        return '<span>' + parseInt(row.MATANCHO) + ' X ' + parseInt(row.MATALTO) + ' CM. ' + '</span>';
                    },
                    title: 'ANCHO/ALTO',
                    className: 'dt-body-center text-center',
                    width: '10%',
                },
                {
                    data: 'MATENTRAN', // 2
                    title: 'ENTRAN',
                    className: 'dt-body-center text-center',
                    width: '10%',
                },
                {
                    data: 'ORIENTA', // 3
                    title: 'ORIENTACION',
                    className: 'dt-body-center text-center',
                    width: '10%',
                },
                {
                    data: 'APROVECHAMIENTO', // 4
                    title: 'APROVECHAMIENTO',
                    className: 'dt-body-center text-center',
                    width: '10%',
                },
                {
                    data: 'PRECIO_MAT', // 5
                    title: 'PRECIO',
                    className: 'dt-body-right text-bold',
                    width: '10%',
                },
                {
                    data: 'ID_COTIZACIONES_MATERIAL', // 6
                    render: function (data, type, row) {
                        return '<span title="Editar"><i class="fas fa-pencil-alt cursor-pointer" style="font-size: 18px" onclick="editarAddMaterial(' + data + ')"></i></span>&nbsp;&nbsp;&nbsp;<span title="Eliminar"><i class="fas fa-trash cursor-pointer" onclick="eliminarAddMaterial(' + data + ')" style="font-size: 18px"></i></span>'
                    },
                    className: 'dt-body-center',
                    width: '10%',
                },
            ],
            headerCallback: function (head, data, start, end, display) {
                countMaterial.value = data.length;
                if ((cantidad.value == 0 || cantidad.value == '') || (tancho.value == 0 || tancho.value == '') || (talto.value == 0 || talto.value == '')) {
                    head.getElementsByTagName('th')[6].innerHTML = '<i class="fas fa-plus-circle" style="font-size: 18px !important; color: #999 !important; text-align: right"></i>';
                } else {
                    head.getElementsByTagName('th')[6].innerHTML = '<a class="cursor-pointer" title="Agregar" onclick="openAddMaterial(), openModalAddMaterial()" ><i class="fas fa-plus-circle" style="font-size: 18px !important; color: #fff !important; text-align: right"></i></a>';
                }
            },
            // initComplete: function (settings, json) {
            //     // ajustarTablas('tblSistemas', heightTable);
            //     loaderOut();
            // },
            // rowCallback: function (row, data) {
            //     if (data.T == 'TMP') {
            //         $('td', row).css('color', '#598ACA');
            //     } else {

            //     }
            // },
        })


        // Swal.fire({
        //     title: "Cotizador",
        //     html: "<div>¿Cambiar este Valor?</div><br><div class='text-info'><i class='fas fa-exclamation-triangle'> </i> ¡Al cambiar esta medida se eliminarán los Materiales registrados y tendrás que volver a seleccionarlos!.</div>",
        //     // text: "Eliminar el Material Seleccionado?",
        //     showCancelButton: true,
        //     confirmButtonColor: "#3085d6",
        //     cancelButtonColor: "#999",
        //     confirmButtonText: "Si",
        //     cancelButtonText: "No",
        //     allowEnterKey: false,
        //     stopKeydownPropagation: true,
        //     reverseButtons: true,
        // }).then((result) => {
        //     if (result.isConfirmed) {
        //         loaderON();
        //         $.ajax({
        //             url: serve + 'eliminarMaterialesCotizador',
        //             type: 'GET',
        //             dataType: 'JSON',
        //             data: {
        //                 id: $('#idCotizaciones').val(),
        //                 editar: editar_cotizacion,
        //             },
        //             success: function (data) {
        //                 loaderOut();
        //                 const Msg = Swal.mixin({
        //                     toast: true,
        //                     position: "center",
        //                     icon: "success",
        //                     showConfirmButton: false,
        //                     timer: 3000,
        //                 });

        //                 Msg.fire({
        //                     title: "¡Materiales Eliminados!",
        //                 });
        //                 tblMaterial.draw(false);
        //                 tblFormacionLoad($('#idCotizaciones').val());
        //             },
        //             error: function () {
        //                 loaderOut();
        //                 const Msg = Swal.mixin({
        //                     toast: true,
        //                     position: "center",
        //                     icon: "success",
        //                     showConfirmButton: false,
        //                     timer: 3000,
        //                 });

        //                 Msg.fire({
        //                     title: "¡Materiales Eliminados!",
        //                 });
        //                 tblMaterial.draw(false);
        //                 tblFormacionLoad($('#idCotizaciones').val());
        //             },
        //         });
        //     } else {
        //         loaderOut();
        //         $('#cantidad').val(cantidad_anterior);
        //         $('#ancho').val(ancho_anterior);
        //         $('#alto').val(alto_anterior);
        //         $('#medancho').val(medancho_anterior);
        //         $('#medalto').val(medalto_anterior);
        //         $(this).trigger('focus');
        //         validarRequeridos();
        //         totalAnchoAlto();
        //     }
        // });
    }
    validarRequeridos();
}

function editarCotizacion(id) {

    editar_cotizacion = 1;

    $("#AddCotizador").modal("show");
    $("#AddCotizador").find("#formAddCotizador")[0].reset();
    let modalCotizador = document.querySelector("#AddCotizador");
    modalCotizador.classList.add("showModal");
    // cargarDetalle(id);

    $.ajax({
        url: serve + 'obtenerCotizacion',
        type: 'GET',
        dataType: 'JSON',
        data: {
            id: id,
        },
        success: function (data) {
            // console.log(data);
            $('#idCotizaciones').val(data[0].ID_COTIZACIONES);
            $('#folio2').val(data[0].FOLIO);
            $('#fecha').val(dateFormat(data[0].FECHA_HORA, 'dd-mm-yyyy'));
            $('#cliente').prop('disabled', true);
            $('#cliente').val(data[0].CLIENTE);
            $('#trabajo').val(data[0].TRABAJO);
            $('#trabajoTMP').val(data[0].TRABAJO);
            $('#trabajo').trigger('focus');
            $('#cantidad').val(Number(data[0].CANTIDAD).toFixed(0));
            $('#cantidadTMP').val(Number(data[0].CANTIDAD).toFixed(0));
            $('#ancho').val(Number(data[0].ANCHO).toFixed(2));
            $('#anchoTMP').val(Number(data[0].ANCHO).toFixed(2));
            $('#medancho').val(Number(data[0].MEDIANIL_ANCHO).toFixed(2));
            $('#medanchoTMP').val(Number(data[0].MEDIANIL_ANCHO).toFixed(2));
            t_ancho = parseFloat(data[0].ANCHO) + parseFloat(data[0].MEDIANIL_ANCHO);
            $('#tancho').val(Number(t_ancho).toFixed(2));
            $('#alto').val(Number(data[0].ALTO).toFixed(2));
            $('#altoTMP').val(Number(data[0].ALTO).toFixed(2));
            $('#medalto').val(Number(data[0].MEDIANIL_ALTO).toFixed(2));
            $('#medaltoTMP').val(Number(data[0].MEDIANIL_ALTO).toFixed(2));
            t_alto = parseFloat(data[0].ALTO) + parseFloat(data[0].MEDIANIL_ALTO);
            $('#talto').val(Number(t_alto).toFixed(2));
            $('#resSubtotal').val(new Intl.NumberFormat('en-US', { minimumFractionDigits: data[0].SUBTOTAL < 100 ? 2 : 0 }).format(data[0].SUBTOTAL));
            $('#resSubtotalTMP').val(new Intl.NumberFormat('en-US', { minimumFractionDigits: data[0].SUBTOTAL < 100 ? 2 : 0 }).format(data[0].SUBTOTAL));
            $('#resMargen').val(new Intl.NumberFormat('en-US', { minimumFractionDigits: data[0].MARGEN < 100 ? 2 : 0 }).format(data[0].MARGEN));
            $('#resComision').val(new Intl.NumberFormat('en-US', { minimumFractionDigits: data[0].COMISION < 100 ? 2 : 0 }).format(data[0].COMISION));
            $('#porcientoMargen').val(Number(data[0].PORMARGEN).toFixed(0));
            $('#margenTMP').val(Number(data[0].PORMARGEN).toFixed(0));
            $('#porcientoComision').val(Number(data[0].PORCOMISION).toFixed(0));
            $('#comisionTMP').val(Number(data[0].PORCOMISION).toFixed(0));
            $('#resPreUnit').val(new Intl.NumberFormat('en-US', { minimumFractionDigits: data[0].PUNITARIO < 100 ? 2 : 0 }).format(data[0].PUNITARIO));
            $('#resTotal').val(new Intl.NumberFormat('en-US', { minimumFractionDigits: data[0].TOTAL < 100 ? 2 : 0 }).format(data[0].TOTAL));
            $('#tiempoproduccion').val(data[0].TIEMPO_PRODUCCION === "In,fin,ity" ? 0 : Number(data[0].TIEMPO_PRODUCCION).toFixed(2));
            $('#observaciones').val(data[0].OBSERVACIONES);
            $('#observacionesTMP').val(data[0].OBSERVACIONES);
            btnCloseCotizacion.innerHTML = 'Cerrar';

            $.ajax({
                url: serve + 'clonarDetalle',
                type: 'GET',
                data: {
                    id: id,
                }
            });

            cantidad_anterior = data[0].CANTIDAD;
            ancho_anterior = data[0].ANCHO;
            alto_anterior = data[0].ALTO;
            medancho_anterior = data[0].MEDIANIL_ANCHO;
            medalto_anterior = data[0].MEDIANIL_ALTO;

            tblFormacionLoad(id);


            cargarDetalleMaterial(id);
            cargarDetalleTintas(id);
            cargarDetalleAcabados(id);
            cargarDetalleAdicionales(id);
            validarRequeridos();
            btnsaveCotizacion.disabled = true;

        },
        error: function () {
            Swal.fire('Ocurrio un error en el servidor...');
        },
    });

    $("#titleCotizacion").text("EDITAR COTIZACION");

    // validarRequeridosSistemas();

}

function tblFormacionLoad(id) {
    $('#tblFormacion').DataTable({
        destroy: true,
        pageResize: false,
        searchable: false,
        orderable: false,
        processing: false,
        serverSide: true,
        select: false,
        scrollY: false,
        scrollX: true,
        scrollCollapse: false,
        paginate: false,
        stateSave: false,
        deferRender: true,
        order: [
            [0, "ASC"],
        ],
        language: {
            url: serve + "js/spanish-DT.json",
        },
        dom: '<"top">rt<"bottom"><"clear">',
        ajax: {
            async: true,
            url: serve + 'apiMateriales',
            type: 'GET',
            dataType: 'JSON',
            data: {
                id: id,
                editar: editar_cotizacion,
            },
        },
        columnDefs: [
            {
                targets: [0],
                orderable: false,
            },
        ],
        columns: [
            {
                data: 'ID_COTIZACIONES_MATERIAL', // 2
                render: function (data, type, row) {
                    if (dominio == "127.0.0.1") {
                        $src = 'http://192.168.2.222/cama/api/impresion/' + data + '';
                    } else {
                        $src = '/cama/api/impresion/' + data + '';
                    }
                    return '<div><label>' + row.NOMBRE_MATERIAL + ' <i class="fas fa-search fa-2x cursor-pointer" style="color: blue" onclick="openVisor(' + data + ', ' + "'" + row.NOMBRE_MATERIAL + "'" + ')"></i></label></div><div><img id="imgFormacion" src="' + $src + '" height="230" style="width: 100%; border-radius: 10px; padding: 1px; border: #999 solid; background-color: #fff"></div>'
                },
                className: 'w-100 dt-body-center text-center',
            },
        ],
        // headerCallback: function (head, data, start, end, display) {
        //     console.log(data);
        //     head.getElementsByTagName('th')[0].innerHTML = '<label>Materiales</label>';
        // },
    });


}

function cargarDetalleMaterial(id) {
    // console.log('Editar Cortización ' + editar_cotizacion);
    tblMaterial = $('#tblMaterial').DataTable({
        destroy: true,
        pageResize: false,
        searchable: false,
        processing: false,
        serverSide: true,
        select: false,
        scrollY: false,
        scrollX: false,
        scrollCollapse: false,
        paginate: false,
        stateSave: false,
        deferRender: false,
        language: {
            url: serve + "js/spanish-DT.json",
        },
        dom: '<"top">rt<"bottom"><"clear">',
        ajax: {
            url: serve + 'apiMateriales',
            type: 'GET',
            dataType: "json",
            data: {
                id: id,
                editar: editar_cotizacion,
            }
        },
        columnDefs: [
            {
                targets: [0, 1, 2, 3, 4, 5, 6],
                orderable: false,
            },
            {
                targets: [2],
                render: $.fn.dataTable.render.number(',', '.', 0, ''),
                // type: "numeric-comma",
            },
            {
                targets: [4, 5],
                render: $.fn.dataTable.render.number(',', '.', 2, ''),
                // type: "numeric-comma",
            }
        ],
        columns: [
            {
                data: 'NOMBRE_MATERIAL', // 0
                render: function (data, type, row) {
                    return '<span>' + data + '</span>';
                    // return '<span>' + data + '</span><span style="width: 10%">' + parseInt(row.MATANCHO) + ' X ' + parseInt(row.MATALTO) + ' CM. ' + '</span><b style="color: #1E3A8A !important; font-size: 18px; padding-left: 25%; text-shadow: 5px 4px 3px #999">' + row.TIPO + '</b>';
                },
                title: 'MATERIAL',
                className: 'dt-body-left',
                width: '40%',
            },
            {
                data: 'MATANCHO', // 1
                render: function (data, type, row) {
                    return '<span>' + parseInt(row.MATANCHO) + ' X ' + parseInt(row.MATALTO) + ' CM. ' + '</span>';
                },
                title: 'ANCHO/ALTO',
                className: 'dt-body-center text-center',
                width: '10%',
            },
            {
                data: 'MATENTRAN', // 2
                title: 'ENTRAN',
                className: 'dt-body-center text-center',
                width: '10%',
            },
            {
                data: 'ORIENTA', // 3
                title: 'ORIENTACION',
                className: 'dt-body-center text-center',
                width: '10%',
            },
            {
                data: 'APROVECHAMIENTO', // 4
                title: 'APROVECHAMIENTO',
                className: 'dt-body-center text-center',
                width: '10%',
            },
            {
                data: 'PRECIO_MAT', // 5
                title: 'PRECIO',
                className: 'dt-body-right text-bold',
                width: '10%',
            },
            {
                data: 'ID_COTIZACIONES_MATERIAL', // 6
                render: function (data, type, row) {
                    return '<span title="Editar"><i class="fas fa-pencil-alt cursor-pointer" style="font-size: 18px" onclick="editarAddMaterial(' + data + ')"></i></span>&nbsp;&nbsp;&nbsp;<span title="Eliminar"><i class="fas fa-trash cursor-pointer" onclick="eliminarAddMaterial(' + data + ')" style="font-size: 18px"></i></span>'
                },
                className: 'dt-body-center',
                width: '10%',
            },
        ],
        headerCallback: function (head, data, start, end, display) {
            countMaterial.value = data.length;
            if ((cantidad.value == 0 || cantidad.value == '') || (tancho.value == 0 || tancho.value == '') || (talto.value == 0 || talto.value == '')) {
                head.getElementsByTagName('th')[6].innerHTML = '<i class="fas fa-plus-circle" style="font-size: 18px !important; color: #999 !important; text-align: right"></i>';
            } else {
                head.getElementsByTagName('th')[6].innerHTML = '<a class="cursor-pointer" title="Agregar" onclick="openAddMaterial(), openModalAddMaterial()" ><i class="fas fa-plus-circle" style="font-size: 18px !important; color: #fff !important; text-align: right"></i></a>';
            }
        },
        // initComplete: function (settings, json) {
        //     // ajustarTablas('tblSistemas', heightTable);
        //     loaderOut();
        // },
        // rowCallback: function (row, data) {
        //     if (data.T == 'TMP') {
        //         $('td', row).css('color', '#598ACA');
        //     } else {

        //     }
        // },
    })
    precios_mat = tblMaterial.data();
}

function cargarDetalleTintas(id) {
    tblTintas = $('#tblTintas').DataTable({
        destroy: true,
        pageResize: false,
        searchable: true,
        processing: false,
        serverSide: true,
        select: false,
        scrollY: false,
        scrollX: true,
        scrollCollapse: false,
        paginate: false,
        stateSave: false,
        deferRender: false,
        language: {
            url: serve + "js/spanish-DT.json",
        },
        dom: '<"top">rt<"bottom"><"clear">',
        ajax: {
            url: serve + 'apiTintas',
            type: 'GET',
            dataType: "json",
            data: {
                id: id,
                editar: editar_cotizacion,
            }
        },
        columnDefs: [
            {
                targets: [0, 1, 2],
                orderable: false,
            },
            {
                targets: [1],
                render: $.fn.dataTable.render.number(',', '.', 2, ''),
                // type: "numeric-comma",
            }
        ],
        columns: [
            {
                data: 'TINTAS', // 0
                render: function (data, type, row) {
                    if (row.NUMERO == 2) {
                        if (row.PRECIO_IMP > 0) {
                            checked = 'checked';
                        } else {
                            checked = '';
                        }
                        return '<div class="custom-switch" style="padding-left: 20px !important">Blanco <input type="checkbox" class="custom-control-input" style="height: 10px"' + checked + ' disabled><label class="custom-control-label ml-3" style="margin-top: -3px"></label></div>';
                    } else if (row.NUMERO == 3 || row.NUMERO == 4) {
                        return '<span style="padding-left: 90%">' + data + '</span>';
                    } else {
                        return data;
                    }
                },
                title: 'TINTAS',
                width: '80%',
            },
            {
                data: 'PRECIO_IMP', // 1
                render: function (data, type, row) {
                    var numFormat = $.fn.dataTable.render.number(",", ".", 2, "").display;

                    if (row.NUMERO == 3) {
                        return '<span style="font-weight: normal">' + numFormat(data) + '</span>';
                    } else if (row.NUMERO == 4) {
                        return '<span style="font-weight: normal">' + numFormat(data) + ' </span>';
                    } else {
                        return numFormat(data);
                    }
                },
                title: 'PRECIO',
                className: 'dt-body-right text-bold',
                width: '10%',
            },
            {
                data: 'ID_COTIZACIONES_TINTAS', // 2
                render: function (data, type, row) {
                    if (row.NUMERO == 1) {
                        return '<span title="Editar"><i class="fas fa-pencil-alt cursor-pointer" style="font-size: 18px"></i></span>&nbsp;&nbsp;&nbsp;<span title="Eliminar"><i class="fas fa-trash cursor-pointer" style="font-size: 18px"></i></span>'
                    } else if (row.NUMERO == 3) {
                        return '(20%)';
                    } else if (row.NUMERO == 4) {
                        return '(80%)';
                    } else {
                        return '';
                    }
                },
                className: 'dt-body-center',
                width: '10%',
            },
        ],
        headerCallback: function (head, data, start, end, display) {
            if (data.length > 0) {
                head.getElementsByTagName('th')[2].innerHTML = '<i class="fas fa-plus-circle" style="font-size: 18px !important; color: #BBBDBF !important; text-align: right"></i>';
            } else {
                if ((cantidad.value == 0 || cantidad.value == '') || (tancho.value == 0 || tancho.value == '') || (talto.value == 0 || talto.value == '')) {
                    head.getElementsByTagName('th')[2].innerHTML = '<i class="fas fa-plus-circle" style="font-size: 18px !important; color: #BBBDBF !important; text-align: right"></i>';
                } else {
                    head.getElementsByTagName('th')[2].innerHTML = '<a class="cursor-pointer" title="Agregar"><i class="fas fa-plus-circle" style="font-size: 18px !important; color: #fff !important; text-align: right"></i></a>';
                }
            }
        },
        // footerCallback: function (foot, data, start, end, display) {
        //     var numFormat = $.fn.dataTable.render.number(",", ".", 2, "").display;
        //     if (data.length > 0) {
        //         if (data[0].EsBlanco == 1) {
        //             foot.getElementsByTagName('th')[0].innerHTML = '<div class="custom-switch" style="padding-left: 20px !important">Blanco <input type="checkbox" class="custom-control-input" style="height: 10px" checked disabled><label class="custom-control-label ml-3" style="margin-top: -3px"></label></div>';
        //             foot.getElementsByTagName('th')[1].innerHTML = numFormat(data[0].BLANCO);
        //         } else {
        //             foot.getElementsByTagName('th')[0].innerHTML = '<div class="custom-switch" style="padding-left: 20px !important">Blanco <input type="checkbox" class="custom-control-input" style="height: 10px" disabled><label class="custom-control-label ml-3" style="margin-top: -3px"></label></div>';
        //             foot.getElementsByTagName('th')[1].innerHTML = numFormat(data[0].BLANCO);
        //         }
        //     }
        // },
    })
}

function cargarDetalleAcabados(id) {
    tblAcabados = $('#tblAcabados').DataTable({
        destroy: true,
        pageResize: false,
        searchable: true,
        processing: false,
        serverSide: true,
        select: false,
        scrollY: false,
        scrollX: true,
        scrollCollapse: false,
        paginate: false,
        stateSave: false,
        deferRender: false,
        language: {
            url: serve + "js/spanish-DT.json",
        },
        dom: '<"top">rt<"bottom"><"clear">',
        ajax: {
            url: serve + 'apiAcabados',
            type: 'GET',
            dataType: "json",
            data: {
                id: id,
                editar: editar_cotizacion,
            }
        },
        columnDefs: [
            {
                targets: [0, 1, 2],
                orderable: false,
            },
            {
                targets: [1],
                render: $.fn.dataTable.render.number(',', '.', 2, ''),
                // type: "numeric-comma",
            }
        ],
        columns: [
            {
                data: 'ID_COTIZACIONES_ACABADOS', // 0
                render: function (data, type, row) {
                    return row.DESCRIPCION;
                },
                title: 'ACABADOS',
                className: 'dt-body-left',
                width: '80%',
            },
            {
                data: 'PRECIO', // 1
                title: 'PRECIO',
                className: 'dt-body-right text-bold',
                width: '10%',
            },
            {
                data: 'ID_COTIZACIONES_ACABADOS', // 2
                render: function (data, type, row) {
                    return '<span title="Editar"><i class="fas fa-pencil-alt cursor-pointer" style="font-size: 18px"></i></span>&nbsp;&nbsp;&nbsp;<span title="Eliminar"><i class="fas fa-trash cursor-pointer" style="font-size: 18px"></i></span>'
                },
                className: 'dt-body-center',
                width: '10%',
            },
        ],
        headerCallback: function (head, data, start, end, display) {
            if (data.length > 0) {
                head.getElementsByTagName('th')[2].innerHTML = '<i class="fas fa-plus-circle" style="font-size: 18px !important; color: #BBBDBF !important; text-align: right"></i>';
            } else {
                if ((cantidad.value == 0 || cantidad.value == '') || (tancho.value == 0 || tancho.value == '') || (talto.value == 0 || talto.value == '')) {
                    head.getElementsByTagName('th')[2].innerHTML = '<i class="fas fa-plus-circle" style="font-size: 18px !important; color: #BBBDBF !important; text-align: right"></i>';
                } else {
                    head.getElementsByTagName('th')[2].innerHTML = '<a class="cursor-pointer" title="Agregar"><i class="fas fa-plus-circle" style="font-size: 18px !important; color: #fff !important; text-align: right"></i></a>';
                }
            }
        },
    })
}

function cargarDetalleAdicionales(id) {
    tblAdicionales = $('#tblAdicionales').DataTable({
        destroy: true,
        pageResize: false,
        searchable: true,
        processing: false,
        serverSide: true,
        select: false,
        scrollY: false,
        scrollX: true,
        scrollCollapse: false,
        paginate: false,
        stateSave: false,
        deferRender: false,
        language: {
            url: serve + "js/spanish-DT.json",
        },
        dom: '<"top">rt<"bottom"><"clear">',
        ajax: {
            url: serve + 'apiAdicionales',
            type: 'GET',
            dataType: "json",
            data: {
                id: id,
                editar: editar_cotizacion,
            }
        },
        columnDefs: [
            {
                targets: [0, 1, 2],
                orderable: false,
            },
            {
                targets: [1],
                render: $.fn.dataTable.render.number(',', '.', 2, ''),
                // type: "numeric-comma",
            }
        ],
        columns: [
            {
                data: 'ID_COTIZACIONES_ADICIONALES', // 0
                render: function (data, type, row) {
                    return row.DESCRIPCION;
                },
                title: 'ADICIONALES',
                className: 'dt-body-left',
                width: '80%',
            },
            {
                data: 'PRECIO', // 1
                title: 'PRECIO',
                className: 'dt-body-right text-bold',
                width: '10%',
            },
            {
                data: 'ID_COTIZACIONES_ADICIONALES', // 2
                render: function (data, type, row) {
                    return '<span title="Editar"><i class="fas fa-pencil-alt cursor-pointer" style="font-size: 18px"></i></span>&nbsp;&nbsp;&nbsp;<span title="Eliminar"><i class="fas fa-trash cursor-pointer" style="font-size: 18px"></i></span>'
                },
                className: 'dt-body-center',
                width: '10%',
            },
        ],
        headerCallback: function (head, data, start, end, display) {
            if (data.length > 0) {
                head.getElementsByTagName('th')[2].innerHTML = '<i class="fas fa-plus-circle" style="font-size: 18px !important; color: #BBBDBF !important; text-align: right"></i>';
            } else {
                if ((cantidad.value == 0 || cantidad.value == '') || (tancho.value == 0 || tancho.value == '') || (talto.value == 0 || talto.value == '')) {
                    head.getElementsByTagName('th')[2].innerHTML = '<i class="fas fa-plus-circle" style="font-size: 18px !important; color: #BBBDBF !important; text-align: right"></i>';
                } else {
                    head.getElementsByTagName('th')[2].innerHTML = '<a class="cursor-pointer" title="Agregar"><i class="fas fa-plus-circle" style="font-size: 18px !important; color: #fff !important; text-align: right"></i></a>';
                }
            }
        },
    })
}

function openVisor(id, nommaterial) {
    $('#visorIMG').modal('show');
    titleVisor.innerHTML = nommaterial;
    if (dominio == "127.0.0.1") {
        imgVisor.src = 'http://192.168.2.222/cama/api/impresion/' + id;
    } else {
        imgVisor.src = '/cama/api/impresion/' + id;
    }

}

function generarCotizacion() {
    $CLIENTE = $('#cliente').val();
    $TRABAJO = $('#trabajo').val();
    $CANTIDAD = $('#cantidad').val();
    $ANCHO = $('#ancho').val();
    $ALTO = $('#alto').val();
    $MEDIANIL_ANCHO = $('#medancho').val();
    $MEDIANIL_ALTO = $('#medalto').val();
    $OBSERVACIONES = $('#observaciones').val();
    $SUBTOTAL = $('#resSubtotal').val();
    $PORMARGEN = $('#porcientoMargen').val();
    $MARGEN = $('#resMargen').val();
    $PORCOMISION = $('#porcientoComision').val();
    $COMISION = $('#resComision').val();
    $PUNITARIO = $('#resPreUnit').val();
    $TOTAL = $('#resTotal').val();
    $TIEMPO_PRODUCCION = $('#tiempoproduccion').val();

    if (editar_cotizacion == 1) {
        mensaje = 'Cotización Editada';
        mensaje_error = 'No se pudo actualizar la Cotización...';
    } else {
        mensaje = 'Cotización Generada';
        mensaje_error = 'No se pudo generar la Cotización...';
    }

    $.ajax({
        url: serve + 'generarCotizacion',
        type: 'GET',
        dataType: "json",
        data: {
            id: $('#idCotizaciones').val(),

            CLIENTE: $CLIENTE,
            TRABAJO: $TRABAJO,
            CANTIDAD: $CANTIDAD,
            ANCHO: $ANCHO,
            ALTO: $ALTO,
            MEDIANIL_ANCHO: $MEDIANIL_ANCHO,
            MEDIANIL_ALTO: $MEDIANIL_ALTO,
            OBSERVACIONES: $OBSERVACIONES,
            SUBTOTAL: $SUBTOTAL,
            PORMARGEN: $PORMARGEN,
            MARGEN: $MARGEN,
            PORCOMISION: $PORCOMISION,
            COMISION: $COMISION,
            PUNITARIO: $PUNITARIO,
            TOTAL: $TOTAL,
            TIEMPO_PRODUCCION: $TIEMPO_PRODUCCION,
            EDITAR: editar_cotizacion,
        },
        success: function (data) {
            $("#AddCotizador").modal("hide");
            const Msg = Swal.mixin({
                toast: true,
                position: "center",
                icon: "success",
                showConfirmButton: false,
                timer: 3000,
            });
            Msg.fire({
                title: mensaje,
            });
            tblCotizador.draw(false);
        },
        error: function () {
            // $("#AddCoti").modal("hide");
            const Msg = Swal.mixin({
                toast: true,
                position: "center",
                icon: "success",
                showConfirmButton: false,
                timer: 3000,
            });
            Msg.fire({
                title: mensaje_error,
            });
            // tblSistemas.draw(false);
        },
    });

    // }
}

function closeMCotizacion() {
    $("#AddCotizador").find("#formAddCotizador")[0].reset();
    let mSistemas = document.querySelector("#AddCotizador");
    let sidebar = document.querySelector(".sidebar");
    sidebar.style.zIndex = 3;
    mSistemas.classList.remove("showModal");
    cargarDetalleMaterial(0);
    cargarDetalleTintas(0);
    cargarDetalleAcabados(0);
    cargarDetalleAdicionales(0);
}

$("#AddMaterial").on("hidden.bs.modal", function (e) {
    // e.preventDefault();
    $("#AddMaterial").find("#formAddMaterial")[0].reset();
    let mMaterial = document.querySelector("#AddMaterial");
    mMaterial.classList.remove("showModal");
    tblAddMaterialLoad(0, 0, 0, 0);
    divMaterialEspecial.style.display = 'none';
    $('#ID_MATERIAL')[0].disabled = false;
});

function totalAnchoAlto() {
    tancho.value = Number(parseFloat(ancho.value) + parseFloat(medancho.value)).toFixed(2);
    talto.value = Number(parseFloat(alto.value) + parseFloat(medalto.value)).toFixed(2);
    tblMaterial.ajax.reload();
}

function calcularTotales() {
    tot_detalle = 0;
    $.ajax({
        url: serve + 'obtenerTotalDetalle',
        type: 'GET',
        data: {
            id: $('#idCotizaciones').val(),
        },
        success: function (data) {
            // console.log(data);
            tot_detalle = data[0].TOT_DETALLE;
            resSubtotal.value = Number(parseFloat(tot_detalle)).toFixed(2);
            resMargen.value = Number(parseFloat(resSubtotal.value) * (parseFloat(porcientoMargen.value) / 100)).toFixed(2);
            resComision.value = Number(parseFloat(resSubtotal.value) * (parseFloat(porcientoComision.value) / 100)).toFixed(2);
            resTotal.value = Number(parseFloat(resSubtotal.value) + parseFloat(resMargen.value) + parseFloat(resComision.value)).toFixed(2);
            resPreUnit.value = Number(parseFloat(resTotal.value) / parseFloat($('#cantidad').val())).toFixed(2);
        },
    });
    // tblMaterial.ajax.reload();
    // precios_mat = tblMaterial.data();
    // console.log(precios_mat);
    // if (precios_mat.length == 0) {
    //     tot_mat = 0;
    // } else {
    //     tot_mat = precios_mat[0].TOT_MAT;
    // }

    // precios_tintas = tblTintas.data();
    // if (precios_tintas.length == 0) {
    //     tot_tintas = 0;
    // } else {
    //     tot_tintas = precios_tintas[0].TOT_PRE;
    // }

    // precios_acabados = tblAcabados.data();
    // if (precios_acabados.length == 0) {
    //     tot_acabados = 0;
    // } else {
    //     tot_acabados = precios_acabados[0].TOT_PRE;
    // }

    // precios_adicionales = tblAdicionales.data();
    // if (precios_adicionales.length == 0) {
    //     tot_adicionales = 0;
    // } else {
    //     tot_adicionales = precios_adicionales[0].TOT_PRE;
    // }

    // tot_detalle = parseFloat(tot_mat) + parseFloat(tot_tintas) + parseFloat(tot_acabados) + parseFloat(tot_adicionales);
    // resSubtotal.value = Number(parseFloat(tot_detalle)).toFixed(2);
    // resMargen.value = Number(parseFloat(resSubtotal.value) * (parseFloat(porcientoMargen.value) / 100)).toFixed(2);
    // resComision.value = Number(parseFloat(resSubtotal.value) * (parseFloat(porcientoComision.value) / 100)).toFixed(2);
    // resTotal.value = Number(parseFloat(resSubtotal.value) + parseFloat(resMargen.value) + parseFloat(resComision.value)).toFixed(2);
    // resPreUnit.value = Number(parseFloat(resTotal.value) / parseFloat($('#cantidad').val())).toFixed(2);

}

function openAddMaterial() {
    $('#AddMaterial').modal('show');
}

$('#ID_MATERIAL').change(function () {
    id_material_2.value = $(this).val();
    cantidad = parseFloat($("#cantidad").val());
    t_ancho = parseFloat($("#tancho").val());
    t_alto = parseFloat($("#talto").val());

    btnAddMaterial.disabled = true;
    tblAddMaterialLoad(id_material_2.value, cantidad, t_ancho, t_alto);
})

function tblAddMaterialLoad(id_material, cantidad, t_ancho, t_alto) {
    tblMedidasMaterial = $("#tblMedidasMaterial").DataTable({
        destroy: true,
        pageResize: false,
        searchable: false,
        processing: false,
        serverSide: true,
        select: false,
        scrollCollapse: false,
        paginate: false,
        stateSave: false,
        deferRender: true,
        language: {
            url: serve + "js/spanish-DT.json",
        },
        dom: '<"top"><"bottom"><"clear">',
        ajax: {
            url: serve + 'modalMateriales',
            type: 'GET',
            dataType: "json",
            data: {
                id: id_material,
                cantidad: cantidad,
                t_ancho: t_ancho,
                t_alto: t_alto,
            },
        },
        columnDefs: [
            {
                targets: [5],
                render: $.fn.dataTable.render.number('', '.', 2, ''),
            },
            {
                targets: [6, 7],
                render: $.fn.dataTable.render.number(',', '.', 2, ''),
            }
        ],
        columns: [
            {
                data: 'med', // 0
                title: 'Med.',
                className: 'dt-body-center text-center',
            },
            {
                data: 'ancho', // 1
                title: 'Ancho',
                className: 'dt-body-center text-center',
            },
            {
                data: 'alto', // 2
                title: 'Alto',
                className: 'dt-body-center text-center',
            },
            {
                data: 'entran', // 3
                title: 'Entran',
                className: 'dt-body-center text-center',
            },
            {
                data: 'textoEntran', // 4
                title: 'Orientación',
                className: 'dt-body-center text-center',
            },
            {
                data: 'aprovechamiento', // 5
                title: '% Aprov.',
                className: 'dt-body-center',
            },
            {
                data: 'rescantidad', // 6
                visible: false,
            },
            {
                data: 'resimporte', // 7
                visible: false,
            },
            {
                data: 'titCantMat', // 8
                visible: false,
            },
        ],
        initComplete: function (settings, json) {
            if (json.data.length > 0) {
                $('#lblTipo').text(json.data[0].TIPO_TEXTO);
            }
            loaderOut();
        },
        rowCallback: function (row, data) {
            if (data.ANCHO == "0" && data.ALTO == "0") {
                row.style.display = 'none';
            }
        },
    });

    $('#tblMedidasMaterial').closest('.dataTables_scrollBody').css('height', '10vh');

}

$("#AddMaterial").draggable({
    handle: "#headerAddMaterial",
});

$("#visorIMG").draggable({
    handle: "#headerVisor",
});

function guardarAddMaterial() {
    if (editar_material == 0) {
        $.ajax({
            url: serve + 'addMaterialCotizador',
            type: 'GET',
            data: {
                idCotizaciones: idCotizaciones.value,
                id_material: id_material_2.value,
                medH: medH.value,
                anchoH: anchoH.value,
                altoH: altoH.value,
                entranH: entranH.value,
                orientacionH: orientacionH.value,
                aprovechamientoH: aprovechamientoH.value,
                cantidadH: cantidadH.value,
                importeH: importeH.value,
                titCantMat: titCantMat.value,
                material_especial: material_especial.checked,
                nombre_material: nombre_material.value,
                tipo_material: tipo_material.value,
                tipo_corte: tipo_corte.value,
                importe: importe.value,
                proveedor: proveedor.value,
                traslucido: translucido.checked,
                editar: editar_cotizacion,
                // _token: CSRF_TOKEN,
            },
            success: function (data) {
                const Msg = Swal.mixin({
                    toast: true,
                    position: "center",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 3000,
                });

                Msg.fire({
                    title: '¡Material agregado!',
                });

                cargarDetalleMaterial($('#idCotizaciones').val());
                $('#ID_MATERIAL')[0].disabled = false;
                if ($('#idCotizaciones').val() == null) {
                    tblFormacionLoad(0);
                } else {
                    tblFormacionLoad($('#idCotizaciones').val());
                }

                // tblMaterial.ajax.reload();
                precios_mat = tblMaterial.data();
                calcularTotales();
            },
            error: function () {
                Swal.fire('¡El Material no se pudo agregar!')
            },
        });
    } else {
        $.ajax({
            url: serve + 'editarMaterialCotizaciones',
            type: 'GET',
            data: {
                idCotizacionesMaterial: id_cotizaciones_material,
                id_material: id_material_2.value,
                medH: medH.value,
                anchoH: anchoH.value,
                altoH: altoH.value,
                entranH: entranH.value,
                orientacionH: orientacionH.value,
                aprovechamientoH: aprovechamientoH.value,
                cantidadH: cantidadH.value,
                importeH: importeH.value,
                titCantMat: titCantMat.value,
                material_especial: material_especial.checked,
                nombre_material: nombre_material.value,
                tipo_material: tipo_material.value,
                tipo_corte: tipo_corte.value,
                importe: importe.value,
                proveedor: proveedor.value,
                traslucido: translucido.checked,
                editar: editar_cotizacion,
            },
            success: function (data) {
                const Msg = Swal.mixin({
                    toast: true,
                    position: "center",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 3000,
                });

                Msg.fire({
                    title: '¡Material actualizado!',
                });

                // tblMaterial.draw();
                // tblMaterial.ajax.reload();
                $('#ID_MATERIAL')[0].disabled = false;
                tblFormacionLoad($('#idCotizaciones').val());
                calcularTotales();
                editar_material = 0;
            }
        });

        $('#tblMaterial').DataTable({
            destroy: true,
            pageResize: false,
            searchable: false,
            processing: false,
            serverSide: true,
            select: false,
            scrollY: false,
            scrollX: false,
            scrollCollapse: false,
            paginate: false,
            stateSave: false,
            deferRender: false,
            language: {
                url: serve + "js/spanish-DT.json",
            },
            dom: '<"top">rt<"bottom"><"clear">',
            ajax: {
                url: serve + 'apiMateriales',
                type: 'GET',
                dataType: "json",
                data: {
                    id: $('#idCotizaciones').val(),
                    editar: editar_cotizacion,
                }
            },
            columnDefs: [
                {
                    targets: [0, 1, 2, 3, 4, 5, 6],
                    orderable: false,
                },
                {
                    targets: [2],
                    render: $.fn.dataTable.render.number(',', '.', 0, ''),
                    // type: "numeric-comma",
                },
                {
                    targets: [4, 5],
                    render: $.fn.dataTable.render.number(',', '.', 2, ''),
                    // type: "numeric-comma",
                }
            ],
            columns: [
                {
                    data: 'NOMBRE_MATERIAL', // 0
                    render: function (data, type, row) {
                        return '<span>' + data + '</span>';
                        // return '<span>' + data + '</span><span style="width: 10%">' + parseInt(row.MATANCHO) + ' X ' + parseInt(row.MATALTO) + ' CM. ' + '</span><b style="color: #1E3A8A !important; font-size: 18px; padding-left: 25%; text-shadow: 5px 4px 3px #999">' + row.TIPO + '</b>';
                    },
                    title: 'MATERIAL',
                    className: 'dt-body-left',
                    width: '40%',
                },
                {
                    data: 'MATANCHO', // 1
                    render: function (data, type, row) {
                        return '<span>' + parseInt(row.MATANCHO) + ' X ' + parseInt(row.MATALTO) + ' CM. ' + '</span>';
                    },
                    title: 'ANCHO/ALTO',
                    className: 'dt-body-center text-center',
                    width: '10%',
                },
                {
                    data: 'MATENTRAN', // 2
                    title: 'ENTRAN',
                    className: 'dt-body-center text-center',
                    width: '10%',
                },
                {
                    data: 'ORIENTA', // 3
                    title: 'ORIENTACION',
                    className: 'dt-body-center text-center',
                    width: '10%',
                },
                {
                    data: 'APROVECHAMIENTO', // 4
                    title: 'APROVECHAMIENTO',
                    className: 'dt-body-center text-center',
                    width: '10%',
                },
                {
                    data: 'PRECIO_MAT', // 5
                    title: 'PRECIO',
                    className: 'dt-body-right text-bold',
                    width: '10%',
                },
                {
                    data: 'ID_COTIZACIONES_MATERIAL', // 6
                    render: function (data, type, row) {
                        return '<span title="Editar"><i class="fas fa-pencil-alt cursor-pointer" style="font-size: 18px" onclick="editarAddMaterial(' + data + ')"></i></span>&nbsp;&nbsp;&nbsp;<span title="Eliminar"><i class="fas fa-trash cursor-pointer" onclick="eliminarAddMaterial(' + data + ')" style="font-size: 18px"></i></span>'
                    },
                    className: 'dt-body-center',
                    width: '10%',
                },
            ],
            headerCallback: function (head, data, start, end, display) {
                countMaterial.value = data.length;
                if ((cantidad.value == 0 || cantidad.value == '') || (tancho.value == 0 || tancho.value == '') || (talto.value == 0 || talto.value == '')) {
                    head.getElementsByTagName('th')[6].innerHTML = '<i class="fas fa-plus-circle" style="font-size: 18px !important; color: #999 !important; text-align: right"></i>';
                } else {
                    head.getElementsByTagName('th')[6].innerHTML = '<a class="cursor-pointer" title="Agregar" onclick="openAddMaterial(), openModalAddMaterial()" ><i class="fas fa-plus-circle" style="font-size: 18px !important; color: #fff !important; text-align: right"></i></a>';
                }
            },
            // initComplete: function (settings, json) {
            //     // ajustarTablas('tblSistemas', heightTable);
            //     loaderOut();
            // },
            // rowCallback: function (row, data) {
            //     if (data.T == 'TMP') {
            //         $('td', row).css('color', '#598ACA');
            //     } else {

            //     }
            // },
        })

    }

    $('#AddMaterial').modal('hide');
    ID_MATERIAL.value = '0';
    btnsaveCotizacion.disabled = false;
}

function editarAddMaterial(id) {
    editar_material = 1;
    id_cotizaciones_material = id;
    $.ajax({
        url: serve + 'obtenerMaterial',
        type: 'GET',
        dataType: 'JSON',
        data: {
            id_material: id,
        },
        success: function (data) {
            $('#AddMaterial').modal('show');
            $('#ID_MATERIAL').val(data[0].ID_MATERIAL);
            $('#ID_MATERIAL_2').val(data[0].ID_MATERIAL);
            $('#ID_MATERIAL')[0].disabled = true;
            material_especial.disabled = true;
            if (data[0].ESPECIAL == 1) {
                divMaterialEspecial.style.display = 'block';
                material_especial.checked = true;
                nombre_material.value = data[0].NOMBRE_MATERIAL;
                matancho.value = data[0].MATANCHO;
                matalto.value = data[0].MATALTO;
                if (data[0].TIPO == "MATERIAL RIGIDO") {
                    tipo_material.value = "R";
                } else if (data[0].TIPO == "MATERIAL FLEXIBLE") {
                    tipo_material.value = "F";
                } else {
                    tipo_material.value = "P";
                }
                tipo_corte.value = data[0].CORTE;
                importe.value = data[0].IMPORTE;
                proveedor.value = data[0].PROVEEDOR;
                translucido.checked = data[0].TRASLUCIDO;
                $('#tblMedidasMaterial')[0].hidden = true;

            } else {
                divMaterialEspecial.style.display = 'none';
                $('#tblMedidasMaterial')[0].hidden = false;
                tblAddMaterialLoad(data[0].ID_MATERIAL, $('#cantidad').val(), $('#tancho').val(), $('#talto').val());
            }
        }
    });
}

function eliminarAddMaterial(id) {

    Swal.fire({
        title: "Materiales",
        text: "Eliminar el Material Seleccionado?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#999",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        allowEnterKey: false,
        stopKeydownPropagation: true,
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            loaderON();
            $.ajax({
                url: serve + 'eliminarMaterialCotizador',
                type: 'GET',
                dataType: 'JSON',
                data: {
                    id: id,
                },
                success: function (data) {
                    loaderOut();
                    const Msg = Swal.mixin({
                        toast: true,
                        position: "center",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000,
                    });

                    Msg.fire({
                        title: "¡Material Eliminado!",
                    });
                    tblMaterial.draw(false);
                    calcularTotales();
                    tblFormacionLoad(idCotizaciones.value);
                    btnsaveCotizacion.disabled = false;
                },
                error: function () {
                    loaderOut();
                    const Msg = Swal.mixin({
                        toast: true,
                        position: "center",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000,
                    });

                    Msg.fire({
                        title: "¡Material Eliminado!",
                    });
                    tblMaterial.draw(false);
                    calcularTotales();
                    tblFormacionLoad(idCotizaciones.value);
                    btnsaveCotizacion.disabled = false;
                },
            });
        } else {
            loaderOut();
        }
    });

}

$('#MATERIAL_ESPECIAL').change(function () {
    checked = $(this)[0].checked;
    $('#ID_MATERIAL').val('0');

    medH.value = '';
    anchoH.value = '';
    altoH.value = '';
    entranH.value = '';
    orientacionH.value = '';
    aprovechamientoH.value = '';
    cantidadH.value = '';
    importeH.value = '';
    titCantMat.value = '';

    btnAddMaterial.disabled = true;

    if (checked == true) {
        divMaterialEspecial.style.display = 'block';
        $('#ID_MATERIAL')[0].disabled = true;
        $('#tblMedidasMaterial')[0].hidden = true;
        tblAddMaterialLoad(0, 0, 0, 0);
        $("#NOMBRE_MATERIAL").trigger("focus");
        $('#lblTipo').text('');
        matancho.value = 0;
        matalto.value = 0;
        tipo_material.value = '0';
        tipo_corte.value = '0';
        importe.value = 0;
        proveedor.value = '';
        translucido.checked = false;
    } else {
        divMaterialEspecial.style.display = 'none';
        nombre_material.value = '';
        matancho.value = 0;
        matalto.value = 0;
        tipo_material.value = '0';
        tipo_corte.value = '0';
        importe.value = 0;
        proveedor.value = '';
        translucido.checked = false;
        $('#ID_MATERIAL')[0].disabled = false;
        $('#tblMedidasMaterial')[0].hidden = false;
        tblAddMaterialLoad(0, 0, 0, 0);
        $('#lblTipo').text('TIPO MATERIAL');

    }
})

$("#MATANCHO").change(function (e) {
    validarRequeridosMatEsp()
})

$("#MATALTO").change(function (e) {
    validarRequeridosMatEsp()
})

$("#TIPO_MATERIAL").change(function (e) {
    validarRequeridosMatEsp()
})

$("#TIPO_CORTE").change(function (e) {
    validarRequeridosMatEsp()
})

$("#IMPORTE").change(function (e) {
    validarRequeridosMatEsp()
})

$("#PROVEEDOR").change(function (e) {
    validarRequeridosMatEsp()
})

$("#TRANSLUCIDO").change(function (e) {
    validarRequeridosMatEsp()
})

$("#NOMBRE_MATERIAL").change(function (e) {
    if ($('#NOMBRE_MATERIAL2').val() == '') {

        const Msg = Swal.mixin({
            toast: true,
            position: "center",
            icon: "info",
            showConfirmButton: false,
            timer: 3000,
        });

        Msg.fire({
            title: "¡Vas a agregar un nuevo Material!",
        });

        matancho.readOnly = false;
        matalto.readOnly = false;
        tipo_material.disabled = false;
        tipo_corte.disabled = false;
        importe.readOnly = false;
        proveedor.readOnly = false;
        translucido.disabled = false;
        id_material_2.value = 0;
        $('#lblTipo').text('');

        $('#MATANCHO').trigger('focus');
        matancho.value = 0;
        matalto.value = 0;
        tipo_material.value = '0';
        tipo_corte.value = '0';
        importe.value = 0;
        proveedor.value = '';
        translucido.checked = 0;
        calcular_material(cantidad.value, tancho.value, talto.value, matancho.value, matalto.value, tipo_material.value);
    }
    validarRequeridosMatEsp();
})

$("#NOMBRE_MATERIAL").keypress(function (e) {
    $('#NOMBRE_MATERIAL2').val('');
    $("#NOMBRE_MATERIAL").autocomplete({
        delay: 0,
        minLength: 4,
        source: function (request, response) {
            $.ajax({
                url: serve + 'obtenerMatEspCombo',
                type: 'GET',
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                    search: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            event.preventDefault();
            $('#NOMBRE_MATERIAL2').val(ui.item.label);
            $('#NOMBRE_MATERIAL').val(ui.item.label2);
            $('#MATANCHO').trigger('focus');

            id_mat_esp = ui.item.value;
            $.ajax({
                url: serve + 'obtenerMaterialesE',
                dataType: "json",
                data: {
                    id_mat_esp: id_mat_esp
                },
                success: function (data) {
                    console.log(data);

                    matancho.readOnly = true;
                    matalto.readOnly = true;
                    tipo_material.disabled = true;
                    tipo_corte.disabled = true;
                    importe.readOnly = true;
                    proveedor.readOnly = true;
                    translucido.disabled = true;

                    id_material_2.value = id_mat_esp;
                    // id_material = id_mat_esp;
                    matancho.value = data[0].ANCHO;
                    matalto.value = data[0].ALTO;
                    tipo_material.value = data[0].TIPO;
                    tipo_corte.value = data[0].CORTE;
                    importe.value = data[0].IMPORTE;
                    proveedor.value = data[0].PROVEEDOR;
                    if (data[0].TRASLUCIDO == 0) {
                        checked_tr = false;
                    } else {
                        checked_tr = true;
                    }
                    translucido.checked = checked_tr;
                    $('#lblTipo').text(data[0].TIPO_TEXTO);
                    validarRequeridosMatEsp();
                },
                error: function (data) {
                    id_material_2.value = '';
                    matancho.value = '';
                    matalto.value = '';
                    tipo_material.value = '';
                    tipo_corte.value = '';
                    importe.value = '';
                    proveedor.value = '';
                    translucido.checked = 0;
                    $('#lblTipo').text('');
                }
            });
            return false;
        },
        close: function (event, ui) {
            event.preventDefault();
            if ($('#NOMBRE_MATERIAL2').val() == '') {
                // Swal.fire('¡Tienes que Seleccionar un Material!')
                $('#MATANCHO').trigger('focus');
            }
        }
    });
    // if ($('#cliente2').val() == '') {
    //     Swal.fire('¡Tienes que Seleccionar un Cliente!')
    // }

    // validarRequeridosSistemas();

});

function validarRequeridosMatEsp() {
    if ((matancho.value <= 0 || matancho.value == '') || (matalto.value <= 0 || matalto.value == '') || tipo_material.value == '0' || tipo_corte.value == '0' || (importe.value <= 0 || importe.value == '') || proveedor.value == '') {
        btnAddMaterial.disabled = true;
    } else {
        calcular_material(cantidad.value, tancho.value, talto.value, matancho.value, matalto.value, tipo_material.value, importe.value);
        btnAddMaterial.disabled = false;
    }
}

function calcular_material(cant_gral, tancho_gral, talto_gral, material_ancho, material_alto, material_tipo, material_importe, material_cot_id) {
    // console.log('cant ' + cant_gral + ' tancho ' + tancho_gral + ' talto ' + talto_gral + ' matancho ' + material_ancho + ' matalto ' + material_alto + ' tipo ' + material_tipo);
    if (material_ancho !== "0" && material_alto !== "0") {
        if (material_tipo === "R") {
            //Calcular a lo ancho/ancho...
            resAncho = (material_ancho / tancho_gral);
            resAlto = (material_alto / talto_gral);

            //Calcular a lo alto/alto...
            resAncho2 = (material_ancho / talto_gral);
            resAlto2 = (material_alto / tancho_gral);

            //Calcular cuantas piezas entran a lo ancho y a lo alto...
            orientacionAncho = parseInt(resAncho) * parseInt(resAlto);
            orientacionAlto = parseInt(resAncho2) * parseInt(resAlto2);

            if (orientacionAncho > orientacionAlto) {
                entran = orientacionAncho;
                textoEntran = "A lo ancho";
            } else if (orientacionAncho < orientacionAlto) {
                entran = orientacionAlto;
                textoEntran = "A lo alto";
            } else if (orientacionAncho == orientacionAlto) {
                entran = orientacionAlto;
                textoEntran = "A lo alto";
            }
            //Obtener el porcentaje de Aprovechamiento...
            aprovech = ((tancho_gral * talto_gral * entran) / (material_ancho * material_alto)) * 100;
            porcentaje = aprovech;
            titCantMate = 'Pzas.';

            cantidad2 = (cant_gral / entran);
            rescantidad = cantidad2;

            anchom = material_ancho / 100;
            altom = material_alto / 100;

            valor = anchom * altom * rescantidad * material_importe * 1.1;
            resimporte = valor;

            // return $entran;
        } else if (material_tipo === "F" || material_tipo === "P") {
            //Calcula largo de material a lo ancho y a lo alto de las piezas.
            entranAncho = material_ancho / tancho_gral;
            entranAlto = material_ancho / talto_gral;

            a_lo_ancho = Math.ceil(cant_gral / parseInt(material_ancho / tancho_gral)) * talto_gral;
            a_lo_alto = Math.ceil(cant_gral / parseInt(material_ancho / talto_gral)) * tancho_gral;

            //Obtiene la cantidad menor de material...
            if (a_lo_ancho < a_lo_alto) {
                aprovech = ((talto_gral * tancho_gral * cant_gral) / (material_ancho * a_lo_ancho)) * 100;
                porcentaje = aprovech;
                entran = Math.floor(entranAncho);
                textoEntran = 'A lo ancho';

                anchoMat = material_ancho / 100;
                aloancho = a_lo_ancho / 100;
                cantidad1 = anchoMat * aloancho;

            } else if (a_lo_ancho > a_lo_alto) {
                aprovech = ((talto_gral * tancho_gral * cant_gral) / (material_ancho * a_lo_alto)) * 100;
                porcentaje = aprovech;
                entran = Math.floor(entranAlto);
                textoEntran = 'A lo alto';


                anchoMat = material_ancho / 100;
                aloalto = a_lo_alto / 100;
                cantidad1 = anchoMat * aloalto;

            } else if (a_lo_ancho == a_lo_alto) {
                aprovech = ((talto_gral * tancho_gral * cant_gral) / (material_ancho * a_lo_alto)) * 100;
                porcentaje = aprovech;
                entran = Math.floor(entranAlto);
                textoEntran = 'A lo alto';

                anchoMat = material_ancho / 100;
                aloalto = a_lo_alto / 100;
                cantidad1 = anchoMat * aloalto;

            } else {
                //no hay otra condicion...
            }

            cantidad2 = cantidad1 / anchoMat;

            titCantMate = 'm.';
            rescantidad = cantidad2;

            valor = material_importe * cantidad2;
            valor = (valor * material_ancho / 100) * 1.1;
            resimporte = valor;

        }

        medH.value = 1;
        anchoH.value = material_ancho;
        altoH.value = material_alto;
        entranH.value = entran;
        orientacionH.value = textoEntran;
        aprovechamientoH.value = porcentaje;
        cantidadH.value = rescantidad;
        importeH.value = resimporte;
        titCantMat.value = titCantMate;

        response = {
            medH_r: 1,
            anchoH_r: material_ancho,
            altoH_r: material_alto,
            entranH_r: entran,
            orientacionH_r: textoEntran,
            aprovechamientoH_r: porcentaje,
            cantidadH_r: rescantidad,
            importeH_r: resimporte,
            titCantMat_r: titCantMate,
            mat_cotId_r: material_cot_id,
        }

        // console.log('entran ' + entran + ' orienta ' + textoEntran + ' aprovechamiento ' + porcentaje + ' cant ' + rescantidad + ' importe ' + resimporte + ' tit cant ' + titCantMat.value);
        return response;
    }
}

function actualizarMedidasMaterial(mat_cotId_r, entranH_r, importeH_r, aprovechamientoH_r, orientacionH_r, cantidadH_r, titCantMat_r) {
    $.ajax({
        url: serve + 'actualizarMedidasMaterial',
        type: 'GET',
        data: {
            mat_cotId_r: mat_cotId_r,
            entranH_r: entranH_r,
            importeH_r: importeH_r,
            aprovechamientoH_r: aprovechamientoH_r,
            orientacionH_r: orientacionH_r,
            cantidadH_r: cantidadH_r,
            titCantMat_r: titCantMat_r,
        },
    });
}
