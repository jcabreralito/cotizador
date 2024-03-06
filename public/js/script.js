let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let navIndex = document.querySelector("#nav-index");
let textMenu = document.querySelector("#text-menu");
let sidebarSalir = document.querySelector('#sidebar_salir');

$(document).ajaxStart(function () {
    loaderON();
});

$(document).ajaxStop(function () {
    loaderOut();
});

$(document).ready(function () {
    var detectorInicio = new MobileDetect(window.navigator.userAgent);
    header_title = $("#header-title");
    home_section = $("#home-section");
    // header_title[0].textContent = "Cotizaciones";
    div_salir_movil = document.getElementById("div_salir_movil");

    if (detectorInicio.mobile() == null) {
        // header_title[0].style.marginLeft = '0';
        sidebar.style.display = 'block';
        // home_section[0].style.left = '50px';
        if (div_salir_movil != null) {
            div_salir_movil.style.display = 'none';
        }
    } else {
        // header_title[0].style.marginLeft = '-45px';
        // sidebar.style.display = 'none';
        // home_section[0].style.width = 'auto';
        // home_section[0].style.left = '0';
        if (div_salir_movil != null) {
            div_salir_movil.style.display = 'block';
        }
        // navIndex.style.width = '-webkit-fill-available';
        window.onorientationchange = reorient;
        window.setTimeout(reorient, 0);
    }

});

function reorient(e) {
    // console.log(divTitulo.childNodes[1].innerHTML);
    if (divTitulo.childNodes[1].innerHTML == 'Mantenimiento') {
        var landscape = (window.orientation % 180 == 0);
        $("#landscape").css("display", !landscape ? "block" : "none");
        $("#landscape_hidden").css("display", !landscape ? "none" : "block");
    }
}

$(function () {
    $(document).tooltip();
});

closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
    // navbarChange();
});

function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
        sidebarSalir.classList.replace("sidebar_li_salir", "sidebar_li_salir_open"); //replacing the iocns class
        $('#text-menu').text("Contraer");
    } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
        sidebarSalir.classList.replace("sidebar_li_salir_open", "sidebar_li_salir"); //replacing the iocns class
        $('#text-menu').text("Expandir");
    }
}

// function navbarChange() {
//     if (sidebar.classList.contains("open")) {
//         navIndex.classList.replace("navbar", "navbar-index"); //replacing the iocns class
//     } else {
//         navIndex.classList.replace("navbar-index", "navbar"); //replacing the iocns class
//     }
// }

function loaderON() {
    $(".loanding").fadeIn("slow");
}

function loaderOut() {
    $(".loanding").fadeOut("slow");
}

function ajustarTablas(table, heightTable) {
    $('#' + table).closest('.dataTables_scrollBody').css('height', heightTable);
}

serve = base_path;
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

var lazyLoadInstance = new LazyLoad({
    // Your custom settings go here
});

$.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: 'Anterior',
    nextText: 'Siguiente',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 7,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);

function selectRow(tabla) {
    $('#' + tabla).on('click', 'tr', function () {
        var row = $(this);
        var td = document.getElementsByTagName('tr');

        for (var i = 0; i < td.length; i++) {
            td[i].classList.remove('selected');
        }

        row[0].classList = 'selected';
    });

}

function selectRowCotizaciones(tabla) {
    $('#' + tabla).on('click', 'tr', function () {
        var row = $(this);
        var td = document.getElementsByTagName('tr');

        for (var i = 0; i < td.length; i++) {
            td[i].classList.remove('selectedCotizaciones');
        }

        row[0].classList = 'selectedCotizaciones';
    });
}

function selectRowMaterial(tabla) {
    $('#' + tabla).on('click', 'tr', function () {
        var row = $(this);
        var td = document.getElementsByTagName('tr');

        for (var i = 0; i < td.length; i++) {
            td[i].classList.remove('selectedMaterial');
        }

        row[0].classList = 'selectedMaterial';
    });

}

function selectRowAcabados(tabla) {
    $('#' + tabla).on('click', 'tr', function () {
        var row = $(this);
        var td = document.getElementsByTagName('tr');

        for (var i = 0; i < td.length; i++) {
            td[i].classList.remove('selectedAcabados');
        }

        row[0].classList = 'selectedAcabados';
    });

}

function selectRowAdicionales(tabla) {
    $('#' + tabla).on('click', 'tr', function () {
        var row = $(this);
        var td = document.getElementsByTagName('tr');

        for (var i = 0; i < td.length; i++) {
            td[i].classList.remove('selectedAdicionales');
        }

        row[0].classList = 'selectedAdicionales';
    });

}

function selectRowTintas(tabla) {
    $('#' + tabla).on('click', 'tr', function () {
        var row = $(this);
        var td = document.getElementsByTagName('tr');

        for (var i = 0; i < td.length; i++) {
            td[i].classList.remove('selectedTintas');
        }

        row[0].classList = 'selectedTintas';
    });

}

function selectRowFocus(tabla) {
    $('#' + tabla).on('focus', 'tr', function () {
        var row = $(this);
        var td = document.getElementsByTagName('tr');

        for (var i = 0; i < td.length; i++) {
            td[i].classList.remove('selected');
        }

        row[0].classList = 'selected';
    });

}

(function (e) { function t() { var e = document.createElement("input"), t = "onpaste"; return e.setAttribute(t, ""), "function" == typeof e[t] ? "paste" : "input" } var n, a = t() + ".mask", r = navigator.userAgent, i = /iphone/i.test(r), o = /android/i.test(r); e.mask = { definitions: { 9: "[0-9]", a: "[A-Za-z]", "*": "[A-Za-z0-9]" }, dataName: "rawMaskFn", placeholder: "_" }, e.fn.extend({ caret: function (e, t) { var n; if (0 !== this.length && !this.is(":hidden")) return "number" == typeof e ? (t = "number" == typeof t ? t : e, this.each(function () { this.setSelectionRange ? this.setSelectionRange(e, t) : this.createTextRange && (n = this.createTextRange(), n.collapse(!0), n.moveEnd("character", t), n.moveStart("character", e), n.select()) })) : (this[0].setSelectionRange ? (e = this[0].selectionStart, t = this[0].selectionEnd) : document.selection && document.selection.createRange && (n = document.selection.createRange(), e = 0 - n.duplicate().moveStart("character", -1e5), t = e + n.text.length), { begin: e, end: t }) }, unmask: function () { return this.trigger("unmask") }, mask: function (t, r) { var c, l, s, u, f, h; return !t && this.length > 0 ? (c = e(this[0]), c.data(e.mask.dataName)()) : (r = e.extend({ placeholder: e.mask.placeholder, completed: null }, r), l = e.mask.definitions, s = [], u = h = t.length, f = null, e.each(t.split(""), function (e, t) { "?" == t ? (h--, u = e) : l[t] ? (s.push(RegExp(l[t])), null === f && (f = s.length - 1)) : s.push(null) }), this.trigger("unmask").each(function () { function c(e) { for (; h > ++e && !s[e];); return e } function d(e) { for (; --e >= 0 && !s[e];); return e } function m(e, t) { var n, a; if (!(0 > e)) { for (n = e, a = c(t); h > n; n++)if (s[n]) { if (!(h > a && s[n].test(R[a]))) break; R[n] = R[a], R[a] = r.placeholder, a = c(a) } b(), x.caret(Math.max(f, e)) } } function p(e) { var t, n, a, i; for (t = e, n = r.placeholder; h > t; t++)if (s[t]) { if (a = c(t), i = R[t], R[t] = n, !(h > a && s[a].test(i))) break; n = i } } function g(e) { var t, n, a, r = e.which; 8 === r || 46 === r || i && 127 === r ? (t = x.caret(), n = t.begin, a = t.end, 0 === a - n && (n = 46 !== r ? d(n) : a = c(n - 1), a = 46 === r ? c(a) : a), k(n, a), m(n, a - 1), e.preventDefault()) : 27 == r && (x.val(S), x.caret(0, y()), e.preventDefault()) } function v(t) { var n, a, i, l = t.which, u = x.caret(); t.ctrlKey || t.altKey || t.metaKey || 32 > l || l && (0 !== u.end - u.begin && (k(u.begin, u.end), m(u.begin, u.end - 1)), n = c(u.begin - 1), h > n && (a = String.fromCharCode(l), s[n].test(a) && (p(n), R[n] = a, b(), i = c(n), o ? setTimeout(e.proxy(e.fn.caret, x, i), 0) : x.caret(i), r.completed && i >= h && r.completed.call(x))), t.preventDefault()) } function k(e, t) { var n; for (n = e; t > n && h > n; n++)s[n] && (R[n] = r.placeholder) } function b() { x.val(R.join("")) } function y(e) { var t, n, a = x.val(), i = -1; for (t = 0, pos = 0; h > t; t++)if (s[t]) { for (R[t] = r.placeholder; pos++ < a.length;)if (n = a.charAt(pos - 1), s[t].test(n)) { R[t] = n, i = t; break } if (pos > a.length) break } else R[t] === a.charAt(pos) && t !== u && (pos++, i = t); return e ? b() : u > i + 1 ? (x.val(""), k(0, h)) : (b(), x.val(x.val().substring(0, i + 1))), u ? t : f } var x = e(this), R = e.map(t.split(""), function (e) { return "?" != e ? l[e] ? r.placeholder : e : void 0 }), S = x.val(); x.data(e.mask.dataName, function () { return e.map(R, function (e, t) { return s[t] && e != r.placeholder ? e : null }).join("") }), x.attr("readonly") || x.one("unmask", function () { x.unbind(".mask").removeData(e.mask.dataName) }).bind("focus.mask", function () { clearTimeout(n); var e; S = x.val(), e = y(), n = setTimeout(function () { b(), e == t.length ? x.caret(0, e) : x.caret(e) }, 10) }).bind("blur.mask", function () { y(), x.val() != S && x.change() }).bind("keydown.mask", g).bind("keypress.mask", v).bind(a, function () { setTimeout(function () { var e = y(!0); x.caret(e), r.completed && e == x.val().length && r.completed.call(x) }, 0) }), y() })) } }) })(jQuery);

year = new Date().getFullYear();

const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre", "Todos"
];

const monthNumbers = ["-01-", "-02-", "-03-", "-04-", "-05-", "-06-",
    "-07-", "-08-", "-09-", "-10-", "-11-", "-12-", -year
];

getLongMonthName = function (date, valor_mes) {
    return monthNames[date.getMonth() + valor_mes];
}

getMonthNumber = function (date, valor_mes) {
    return monthNumbers[date.getMonth() + valor_mes];
}

function getMonthFromString(mon) {
    if (mon == "Enero") {
        return 1;
    } else if (mon == "Febrero") {
        return 2;
    } else if (mon == "Marzo") {
        return 3;
    } else if (mon == "Abril") {
        return 4;
    } else if (mon == "Mayo") {
        return 5;
    } else if (mon == "Junio") {
        return 6;
    } else if (mon == "Julio") {
        return 7;
    } else if (mon == "Agosto") {
        return 8;
    } else if (mon == "Septiembre") {
        return 9;
    } else if (mon == "Octubre") {
        return 10;
    } else if (mon == "Noviembre") {
        return 11;
    } else if (mon == "Diciembre") {
        return 12;
    } else if (mon == "Todos") {
        return 'Todos';
    }
}

URLactual = window.location;
if (URLactual.hostname == '127.0.0.1') {
    base_path = "/";
} else {
    base_path = `/${URLactual.pathname.split("/")[1]}/`;
}

home = document.getElementById('href_home');
home.href = base_path;
// panel = document.getElementById('href_panel');
// panel.href = base_path;
materiales = document.getElementById('href_materiales');

function menu_materiales() {
    materiales.href = base_path + 'materiales';
}

// if (materiales != null) {
//     materiales.href = base_path + 'materiales';
// }
// mensajeria = document.getElementById('href_mensajeria');
// mensajeria.href = base_path + 'Mensajeria';

cotizador = document.getElementById('href_cotizador');

function menu_cotizaciones() {
    // window.location.href =  base_path;
    cotizador.href = base_path;
}

// if (cotizador != null) {
//     cotizador.href = base_path;
// }

salir = document.getElementById('href_salir');
// salir.href = base_path + 'logout';
// salir.href = '/litoapps/';

function menu_salir() {
    salir.href = '/litoapps/';
}

salir_movil = document.getElementById('href_salir_movil');
if (salir_movil != null) {
    salir_movil.href = '/litoapps/';
}

// materiales_p = document.getElementById('href_materiales_p');
// materiales_p != null ? materiales_p.href = base_path + 'materiales' : null;
// // mensajeria_p = document.getElementById('href_mensajeria_p');
// // mensajeria_p != null ? mensajeria_p.href = base_path + 'Mensajeria' : null;
// sistemas_p = document.getElementById('href_sistemas_p');
// sistemas_p != null ? sistemas_p.href = base_path + 'Sistemas' : null;

function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}
