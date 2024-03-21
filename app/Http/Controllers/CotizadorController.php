<?php

namespace App\Http\Controllers;

use App\Traits\PermisosTrait;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CotizadorController extends Controller
{
    use PermisosTrait;

    public $modulo = 'Cotizador';
    public $msg = 0;

    public function index(Request $request)
    {
        $usuario = base64_decode($request->usuario);
        $user = base64_decode($request->usuario);

        if ($usuario != '') {
            session(['usuario' => $user]);
        }

        $user = session('usuario');

        if ($user == '') {
            $datos_usuario = 'Usuario';
            session(['nombre' => 'Usuario']);
            return view('inicio');
        } else {

            $this->permiso();
            $datos_usuario = DB::select('exec GetPermisos @Login=' . $user);
            if ($datos_usuario == null) {
                return view('inicio');
            }

            session(['nombre' => $datos_usuario[0]->Nombre]);

            $nombre = session('nombre');
            $create = session('privilegios');

            $permiso = $datos_usuario[0]->Permiso;

            $titulo = 'Cotizaciones';

            $fecha = new DateTime();
            $año = $fecha->format('Y');

            $fechainicio = date('Y-m-d', strtotime('first day of january ' . $año));
            $fechafin = date('Y-m-d', strtotime('last day of december ' . $año));
            $materiales_combo = DB::table('v_materiales_combo')->orderBy('NOMBRE_MATERIAL')->get();

            if ($permiso != 0) {
                return view('cotizador.index', compact('titulo', 'create', 'permiso', 'nombre', 'materiales_combo'));
            } else {
                return view('inicio');
            }
        }
    }

    public function apiCotizaciones(Request $request)
    {
        $texto = $request->texto;
        $cotizaciones = DB::table('v_cotizaciones')->where('FOLIO', 'LIKE', '%' . $texto . '%')
            ->orWhere('CLIENTE', 'LIKE', '%' . $texto . '%')
            ->orWhere('TRABAJO', 'LIKE', '%' . $texto . '%')
            ->orWhere('OBSERVACIONES', 'LIKE', '%' . $texto . '%');
        return DataTables::of($cotizaciones)
            ->make(true);
    }

    public function obtenerCotizacion(Request $request)
    {
        $id = $request->id;
        $cotizacion = DB::table('v_abrircotizaciones')->where('ID_COTIZACIONES', $id)->get();

        return $cotizacion;
    }

    public function obtenerClientes(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $combo_clientes = DB::table('v_catClientesActivosCombo')->orderBy('razonsocial', 'asc')->select('razonsocial')->get();
        } else {
            $combo_clientes = DB::table('v_catClientesActivosCombo')->orderBy('razonsocial', 'asc')->where('razonsocial', 'like', '%' . $search . '%')->get();
        }

        $response = array();
        foreach ($combo_clientes as $combo_clientes) {
            $response[] = array("value" => $combo_clientes->razonsocial, "label" => $combo_clientes->razonsocial);
        }

        echo json_encode($response);
        exit;
    }

    public function apiMateriales(Request $request)
    {
        if ($request->editar == 0) {
            $materiales = DB::table('v_cotizaciones_material_tmp')->where('ID_COTIZACIONES', $request->id)->orderBy('ID_COTIZACIONES_MATERIAL')->get();
        } else {
            $materiales = DB::table('v_cotizaciones_material_tmp')->where('ID_COTIZACIONES', $request->id)->orderBy('ID_COTIZACIONES_MATERIAL')->get();
            // $materiales = DB::table('v_cotisp_editar_cotizacionzaciones_material')->where('ID_COTIZACIONES', $request->id)->orderBy('ID_COTIZACIONES_MATERIAL')->get();
        }

        return DataTables::of($materiales)
            ->make(true);
    }

    public function apiMaterialesImg($id)
    {
        $materiales = DB::table('v_cotizaciones_material_img_tmp')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_MATERIAL')->get();

        return DataTables::of($materiales)
            ->make(true);
    }

    public function modalMateriales(Request $request)
    {
        $materiales = DB::table('v_materiales')->where('ID_MATERIAL', $request->id)->get();
        $cantidad = $request->cantidad;
        $tancho = $request->t_ancho;
        $talto = $request->t_alto;

        // return $materiales;

        if (count($materiales) > 0) {
            $ancho_mat = $materiales[0]->ANCHO;
            $alto_mat = $materiales[0]->ALTO;
            $tipo_material = $materiales[0]->TIPO;

            if ($tipo_material == 'F') {
                return DataTables::of($materiales)
                    ->addColumn('med', function ($row) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            $med = $row->MEDIDA;
                            return $med;
                        }
                    })
                    ->addColumn('ancho', function ($row) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            $ancho = $row->ANCHO;
                            return $ancho;
                        }
                    })
                    ->addColumn('alto', function ($row) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            $alto = $row->ALTO;
                            return $alto;
                        }
                    })
                    ->addColumn('entran', function ($row) use ($tancho, $talto, $cantidad, $tipo_material) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {

                            $entran = $this->calcularMaterial($cantidad, $tancho, $talto, $row->ANCHO, $row->ALTO, $tipo_material, $row->IMPORTE, 'entran');
                            return $entran;
                        }
                    })
                    ->addColumn('textoEntran', function ($row) use ($tancho, $talto, $cantidad, $tipo_material) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {

                            $textoEntran = $this->calcularMaterial($cantidad, $tancho, $talto, $row->ANCHO, $row->ALTO, $tipo_material, $row->IMPORTE, 'textoentran');
                            return $textoEntran;

                        }
                    })
                    ->addColumn('aprovechamiento', function ($row) use ($tancho, $talto, $cantidad, $tipo_material) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {

                            $aprovechamiento = $this->calcularMaterial($cantidad, $tancho, $talto, $row->ANCHO, $row->ALTO, $tipo_material, $row->IMPORTE, 'aprovechamiento');
                            return $aprovechamiento;

                        }
                    })
                    ->addColumn('rescantidad', function ($row) use ($tancho, $talto, $cantidad, $tipo_material) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {

                            $rescantidad = $this->calcularMaterial($cantidad, $tancho, $talto, $row->ANCHO, $row->ALTO, $tipo_material, $row->IMPORTE, 'rescantidad');
                            return $rescantidad;

                        }
                    })
                    ->addColumn('resimporte', function ($row) use ($tancho, $talto, $cantidad, $tipo_material) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {

                            $resimporte = $this->calcularMaterial($cantidad, $tancho, $talto, $row->ANCHO, $row->ALTO, $tipo_material, $row->IMPORTE, 'resimporte');
                            return $resimporte;

                        }
                    })
                    ->addColumn('titCantMat', function ($row) use ($tancho, $talto, $cantidad) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            $titCantMat = 'm.';
                            return $titCantMat;
                        }
                    })
                    ->make(true);
            } else if ($tipo_material == 'R') {
                return DataTables::of($materiales)
                    ->addColumn('med', function ($row) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            $med = $row->MEDIDA;
                            return $med;
                        }
                    })
                    ->addColumn('ancho', function ($row) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            $ancho = $row->ANCHO;
                            return $ancho;
                        }
                    })
                    ->addColumn('alto', function ($row) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            $alto = $row->ALTO;
                            return $alto;
                        }
                    })
                    ->addColumn('entran', function ($row) use ($tancho, $talto, $cantidad, $tipo_material) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            //Calcular a lo ancho/ancho...

                            $entran = $this->calcularMaterial($cantidad, $tancho, $talto, $row->ANCHO, $row->ALTO, $tipo_material, $row->IMPORTE, 'entran');
                            return $entran;
                        }
                    })
                    ->addColumn('textoEntran', function ($row) use ($tancho, $talto, $cantidad, $tipo_material) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            //Calcular a lo ancho/ancho...

                            $textoEntran = $this->calcularMaterial($cantidad, $tancho, $talto, $row->ANCHO, $row->ALTO, $tipo_material, $row->IMPORTE, 'textoentran');
                            return $textoEntran;
                        }
                    })
                    ->addColumn('aprovechamiento', function ($row) use ($tancho, $talto, $cantidad, $tipo_material) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            //Calcular a lo ancho/ancho...

                            $aprovechamiento = $this->calcularMaterial($cantidad, $tancho, $talto, $row->ANCHO, $row->ALTO, $tipo_material, $row->IMPORTE, 'aprovechamiento');
                            return $aprovechamiento;
                        }
                    })
                    ->addColumn('rescantidad', function ($row) use ($tancho, $talto, $cantidad, $tipo_material) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            //Calcular a lo ancho/ancho...

                            $rescantidad = $this->calcularMaterial($cantidad, $tancho, $talto, $row->ANCHO, $row->ALTO, $tipo_material, $row->IMPORTE, 'rescantidad');
                            return ceil($rescantidad);
                        }
                    })
                    ->addColumn('resimporte', function ($row) use ($tancho, $talto, $cantidad, $tipo_material) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            //Calcular a lo ancho/ancho...

                            $resimporte = $this->calcularMaterial($cantidad, $tancho, $talto, $row->ANCHO, $row->ALTO, $tipo_material, $row->IMPORTE, 'resimporte');
                            return $resimporte;
                        }
                    })
                    ->addColumn('titCantMat', function ($row) use ($tancho, $talto, $cantidad) {
                        if ($row->ANCHO != 0 && $row->ALTO != 0) {
                            $titCantMat = 'Pzas.';
                            return $titCantMat;
                        }
                    })
                    ->make(true);
            }

        } else {
            return DataTables::of($materiales)
                ->addColumn('med', function () {
                    return null;
                })
                ->addColumn('ancho', function () {
                    return null;
                })
                ->addColumn('alto', function () {
                    return null;
                })
                ->addColumn('entran', function () {
                    return null;
                })
                ->addColumn('textoEntran', function () {
                    return null;
                })
                ->addColumn('aprovechamiento', function () {
                    return null;
                })
                ->addColumn('rescantidad', function () {
                    return null;
                })
                ->addColumn('resimporte', function () {
                    return null;
                })
                ->addColumn('titCantMat', function () {
                    return null;
                })
                ->make(true);
        }
    }

    public function modalTintas(Request $request)
    {
        $tintas_material = DB::table('v_tintas_index')->where('Estatus', 1)->get();

        return DataTables::of($tintas_material)
            ->make(true);
    }

    public function modalAcabados(Request $request)
    {
        $acabados_material = DB::table('v_acabados_index')->where('ACTIVO', 1)->get();

        return DataTables::of($acabados_material)
            ->make(true);
    }

    public function obtenerPrimerMaterial(Request $request)
    {
        $primer_material = DB::table('v_primer_material')->where('ID_COTIZACIONES', $request->id)->get();
        return $primer_material;
    }

    public function apiTintas(Request $request)
    {
        $tintas = DB::table('v_cotizaciones_tintas')->where('ID_COTIZACIONES', $request->id)->orderBy('ID_COTIZACIONES')->orderBy('NUMERO')->get();
        return DataTables::of($tintas)
            ->make(true);
    }

    public function apiAcabados(Request $request)
    {
        $acabados = DB::table('v_cotizaciones_acabados')->where('ID_COTIZACIONES', $request->id)->get();
        return DataTables::of($acabados)
            ->make(true);
    }

    public function obtenerImpresionVuelta(Request $request)
    {
        $acabados = DB::table('v_cotizaciones_acabados')->where('ID_COTIZACIONES', $request->id)->where('DESCRIPCION', 'IMPRESION VUELTA')->get();
        if (count($acabados) > 0) {
            $acabados_iv = $acabados[0]->DESCRIPCION;
        } else {
            $acabados_iv = null;
        }
        return $acabados_iv;
    }

    public function apiAdicionales(Request $request)
    {
        $adicionales = DB::table('v_cotizaciones_adicionales')->where('ID_COTIZACIONES', $request->id)->get();
        return DataTables::of($adicionales)
            ->make(true);
    }

    public function obtenerFolio()
    {
        $folio_max = Db::table('cotizaciones_tmp')->max('FOLIO');
        return $folio_max + 1;
    }

    public function cotizacionTMP(Request $request)
    {
        $folio = $request->folio;
        $id_usuario = (int)$this->idUsuario();
        DB::statement('exec sp_insert_cotizacion_tmp ?, ?', [
            $folio,
            $id_usuario,
        ]);

        $id_cotizaciones = Db::table('cotizaciones_t')->max('ID_COTIZACIONES');
        return $id_cotizaciones;
    }

    public function updateCotizacionTMP(Request $request)
    {
        $cliente = $request->cliente;
        $trabajo = strtoupper($request->trabajo);
        $cantidad = (float)$request->cantidad;
        $ancho = (float)$request->ancho;
        $alto = (float)$request->alto;
        $med_ancho = (float)$request->med_ancho;
        $med_alto = (float)$request->med_alto;
        $observaciones = strtoupper($request->observaciones);
        $subtotal = (float)$request->subtotal;
        $pormargen = (float)$request->pormargen;
        $margen = (float)$request->margen;
        $porcomision = (float)$request->porcomision;
        $comision = (float)$request->comision;
        $punitario = (float)$request->punitario;
        $total = (float)$request->total;
        $tiempo_produccion = $request->tiempo_produccion;
        $id_cotizaciones = (int)$request->id_cotizaciones;

        DB::statement('exec sp_update_cotizacion_tmp ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', [
            $cliente,
            $trabajo,
            $cantidad,
            $ancho,
            $alto,
            $med_ancho,
            $med_alto,
            $observaciones,
            $subtotal,
            $pormargen,
            $margen,
            $porcomision,
            $comision,
            $punitario,
            $total,
            $tiempo_produccion,
            $id_cotizaciones,
        ]);
    }

    public function eliminarCotizacionTMP(Request $request)
    {
        DB::statement('exec sp_eliminar_cotizacion_tmp ?', [
            $request->id
        ]);
    }

    public function obtenerMaterial(Request $request)
    {
        $material = DB::table('v_cotizaciones_material')->where('ID_COTIZACIONES_MATERIAL', $request->id_material)->get();
        return $material;
    }

    public function obtenerTinta(Request $request)
    {
        $tinta = DB::table('v_cotizaciones_tintas')->where('ID_COTIZACIONES_TINTAS', $request->id_tinta)->get();
        return $tinta;
    }

    public function obtenerAcabado(Request $request)
    {
        $acabado = DB::table('v_cotizaciones_acabados')->where('ID_COTIZACIONES_ACABADOS', $request->id_acabado)->get();
        return $acabado;
    }

    public function obtenerAdicional(Request $request)
    {
        $acabado = DB::table('v_cotizaciones_adicionales')->where('ID_COTIZACIONES_ADICIONALES', $request->id_adicional)->get();
        return $acabado;
    }

    public function obtenerTintaAcabado(Request $request)
    {
        $tinta = DB::table('cotizaciones_tintas_tmp')->where('ID_COTIZACIONES', $request->id_cotizaciones)->get();
        $tinta_acabado = ((float)$tinta[0]->BLANCO + (float)$tinta[0]->PRECIO_IMP) * 1.15;
        return $tinta_acabado;
    }

    public function obtenerTintaTP(Request $request)
    {
        $tinta = DB::table('cotizaciones_tintas_tmp')->where('ID_COTIZACIONES', $request->id_cotizaciones)->get();
        return $tinta;
    }

    public function addMaterialCotizador(Request $request)
    {
        // return $request;

        $ID_COTIZACIONES = $request->idCotizaciones;
        $id_material = $request->id_material;
        $MEDIDA = $request->medH;
        $MATANCHO = $request->anchoH;
        $MATALTO = $request->altoH;
        $MATENTRAN = $request->entranH;
        $ORIENTA = $request->orientacionH;
        $APROVECHAMIENTO = $request->aprovechamientoH;
        $CANT_MAT = $request->cantidadH;
        $PRECIO_MAT = $request->importeH;
        $TIPO_CANT_MAT = $request->titCantMat;
        $NOMBRE_MATERIAL = strtoupper($request->nombre_material);
        $TIPO_MATERIAL = $request->tipo_material;
        $TIPO_CORTE = $request->tipo_corte;
        $IMPORTE = $request->importe;
        $PROVEEDOR = strtoupper($request->proveedor);

        if ($request->material_especial == 'true') {
            $ESPECIAL = 1;
            if ($request->traslucido == 'true') {
                $TRASLUCIDO = 1;
            } else {
                $TRASLUCIDO = 0;
            }

            if ($id_material == 0) {
                DB::statement('exec sp_agregar_material_especial ?, ?, ?, ?, ?, ?, ?, ?', [
                    $NOMBRE_MATERIAL,
                    $MATANCHO,
                    $MATALTO,
                    $TIPO_MATERIAL,
                    $IMPORTE,
                    $PROVEEDOR,
                    $TRASLUCIDO,
                    $TIPO_CORTE,
                ]);
                $id_material = DB::table('materiales_especiales')->max('ID_MAT_ESPECIAL');
            }
        } else {
            $ESPECIAL = 0;
        }

        $id_usuario = $this->idUsuario();

        DB::statement('exec sp_agregar_material_cotizador ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', [
            $ID_COTIZACIONES,
            $id_material,
            $MEDIDA,
            $MATANCHO,
            $MATALTO,
            $MATENTRAN,
            $ORIENTA,
            $APROVECHAMIENTO,
            $CANT_MAT,
            $PRECIO_MAT,
            $TIPO_CANT_MAT,
            $ESPECIAL,
            $id_usuario,
        ]);
    }

    public function addTintaCotizador(Request $request)
    {
        // return $request;

        $ID_COTIZACIONES = $request->idCotizaciones;
        $RESOLUCION = $request->nombreTintaH;
        $PRE_TINTA = $request->valorTintaH;
        $BLANCO = $request->blancoH;
        $IMPORTE_TINTA = $request->importeTintaH;
        $IMPORTE_MO = $request->importeMOH;
        $id_usuario = $this->idUsuario();

        DB::statement('exec sp_agregar_tinta_cotizador ?, ?, ?, ?, ?, ?, ?', [
            $ID_COTIZACIONES,
            $RESOLUCION,
            $PRE_TINTA,
            $BLANCO,
            $IMPORTE_TINTA,
            $IMPORTE_MO,
            $id_usuario,
        ]);
    }

    public function addAcabadoCotizador(Request $request)
    {
        // return $request;

        $ID_COTIZACIONES = $request->idCotizaciones;
        $PRECIO = $request->precioAcabadoH;
        $DESCRIPCION = strtoupper($request->descripcionAcabadoH);
        $id_usuario = $this->idUsuario();

        DB::statement('exec sp_agregar_acabado_cotizador ?, ?, ?, ?', [
            $ID_COTIZACIONES,
            $PRECIO,
            $DESCRIPCION,
            $id_usuario,
        ]);
    }

    public function addAdicionalCotizador(Request $request)
    {
        // return $request;

        $ID_COTIZACIONES = $request->idCotizaciones;
        $PRECIO = $request->precioAdicionalH;
        $IMPORTE = $request->importeAdicionalH;
        $DESCRIPCION = strtoupper($request->descripcionAdicionalH);
        $id_usuario = $this->idUsuario();

        DB::statement('exec sp_agregar_adicional_cotizador ?, ?, ?, ?, ?', [
            $ID_COTIZACIONES,
            $DESCRIPCION,
            $PRECIO,
            $IMPORTE,
            $id_usuario,
        ]);
    }

    public function editarMaterialCotizaciones(Request $request)
    {
        // return $request;

        $id_cotizaciones_material = (int)$request->idCotizacionesMaterial;
        $id_material = (int)$request->id_material;
        $MEDIDA = (int)$request->medH;
        $MATANCHO = (float)$request->anchoH;
        $MATALTO = (float)$request->altoH;
        $MATENTRAN = (float)$request->entranH;
        $ORIENTA = $request->orientacionH;
        $APROVECHAMIENTO = (float)$request->aprovechamientoH;
        $CANT_MAT = (float)$request->cantidadH;
        $PRECIO_MAT = (float)$request->importeH;
        $TIPO_CANT_MAT = $request->titCantMat;
        $NOMBRE_MATERIAL = strtoupper($request->nombre_material);
        $TIPO_MATERIAL = $request->tipo_material;
        $TIPO_CORTE = $request->tipo_corte;
        $IMPORTE = (float)$request->importe;
        $PROVEEDOR = strtoupper($request->proveedor);
        $id_usuario = (int)$this->idUsuario();

        if ($request->material_especial == 'true') {
            $ESPECIAL = 1;
            if ($request->traslucido == 'true') {
                $TRASLUCIDO = 1;
            } else {
                $TRASLUCIDO = 0;
            }
            DB::statement('exec sp_editar_material_especial ?, ?, ?, ?, ?, ?, ?, ?, ?', [
                $NOMBRE_MATERIAL,
                $MATANCHO,
                $MATALTO,
                $TIPO_MATERIAL,
                $IMPORTE,
                $PROVEEDOR,
                $TRASLUCIDO,
                $TIPO_CORTE,
                $id_material
            ]);
            // $id_material = DB::table('materiales_especiales')->max('ID_MAT_ESPECIAL');
        } else {
            $ESPECIAL = 0;
        }

        DB::statement('exec sp_editar_material_cotizador ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', [
            $MEDIDA,
            $MATANCHO,
            $MATALTO,
            $MATENTRAN,
            $ORIENTA,
            $APROVECHAMIENTO,
            $CANT_MAT,
            $PRECIO_MAT,
            $TIPO_CANT_MAT,
            $ESPECIAL,
            $id_usuario,
            $id_cotizaciones_material,
            $request->editar,
        ]);
    }

    public function editarTintaCotizaciones(Request $request)
    {
        // return $request;

        $id_cotizaciones_tinta = (int)$request->idCotizacionestinta;
        $RESOLUCION = $request->nombreTintaH;
        $PRE_TINTA = $request->valorTintaH;
        $BLANCO = $request->blancoH;
        $IMPORTE_TINTA = $request->importeTintaH;
        $IMPORTE_MO = $request->importeMOH;
        $id_usuario = $this->idUsuario();

        DB::statement('exec sp_editar_tinta_cotizador ?, ?, ?, ?, ?, ?, ?, ?', [
            $RESOLUCION,
            $PRE_TINTA,
            $BLANCO,
            $IMPORTE_TINTA,
            $IMPORTE_MO,
            $id_usuario,
            $id_cotizaciones_tinta,
            $request->editar,
        ]);
    }

    public function editarAcabadoCotizaciones(Request $request)
    {
        // return $request;

        $id_cotizaciones_acabado = (int)$request->idCotizacionesAcabado;
        $PRECIO = $request->precioAcabadoH;
        $DESCRIPCION = strtoupper($request->descripcionAcabadoH);
        $id_usuario = $this->idUsuario();

        DB::statement('exec sp_editar_acabado_cotizador ?, ?, ?, ?, ?', [
            $id_cotizaciones_acabado,
            $PRECIO,
            $DESCRIPCION,
            $id_usuario,
            $request->editar,
        ]);
    }

    public function editarAdicionalCotizaciones(Request $request)
    {
        // return $request;

        $id_cotizaciones_adicional = (int)$request->idCotizacionesAdicional;
        $PRECIO = $request->precioAdicionalH;
        $IMPORTE = $request->importeAdicionalH;
        $DESCRIPCION = strtoupper($request->descripcionAdicionalH);
        $id_usuario = $this->idUsuario();

        DB::statement('exec sp_editar_adicional_cotizador ?, ?, ?, ?, ?, ?', [
            $id_cotizaciones_adicional,
            $DESCRIPCION,
            $PRECIO,
            $IMPORTE,
            $id_usuario,
            $request->editar,
        ]);
    }

    public function eliminarTintaCotizador(Request $request)
    {
        DB::statement('exec sp_eliminar_tinta_cotizador ?', [$request->id]);
    }

    public function eliminarAcabadoCotizador(Request $request)
    {
        DB::statement('exec sp_eliminar_acabado_cotizador ?', [$request->id]);
    }

    public function eliminarAdicionalCotizador(Request $request)
    {
        DB::statement('exec sp_eliminar_adicional_cotizador ?', [$request->id]);
    }

    public function eliminarMaterialCotizador(Request $request)
    {
        $primer_material = DB::table('v_primer_material')->where('ID_COTIZACIONES', $request->id_cotizaciones)->get();

        if ($primer_material[0]->ID_COTIZACIONES_MATERIAL == $request->id) {
            DB::statement('exec sp_eliminar_tintas_cotizador ?', [$request->id_cotizaciones]);
        }

        DB::statement('exec sp_eliminar_material_cotizador ?', [$request->id]);
    }

    public function eliminarTintasCotizador(Request $request)
    {
        $id_usuario = (int)$this->idUsuario();
        DB::statement('exec sp_eliminar_tintas_cotizador ?,?,?', [
            $request->id,
            $id_usuario,
            $request->editar,
        ]);
    }

    public function eliminarMaterialesCotizador(Request $request)
    {
        $id_usuario = (int)$this->idUsuario();
        DB::statement('exec sp_eliminar_materiales_cotizador ?,?,?', [
            $request->id,
            $id_usuario,
            $request->editar,
        ]);
    }

    public function generarCotizacion(Request $request)
    {
        // return $request;
        $ID = (int)$request->id;
        $CLIENTE = strtoupper($request->CLIENTE);
        $TRABAJO = strtoupper($request->TRABAJO);
        $CANTIDAD = (float)$request->CANTIDAD;
        $ANCHO = (float)$request->ANCHO;
        $ALTO = (float)$request->ALTO;
        $MEDIANIL_ANCHO = (float)$request->MEDIANIL_ANCHO;
        $MEDIANIL_ALTO = (float)$request->MEDIANIL_ALTO;
        $OBSERVACIONES = strtoupper($request->OBSERVACIONES);
        $SUBTOTAL = (float)$request->SUBTOTAL;
        $PORMARGEN = (float)$request->PORMARGEN;
        $MARGEN = (float)$request->MARGEN;
        $PORCOMISION = (float)$request->PORCOMISION;
        $COMISION = (float)$request->COMISION;
        $PUNITARIO = (float)$request->PUNITARIO;
        $TOTAL = (float)$request->TOTAL;
        $TIEMPO_PRODUCCION = $request->TIEMPO_PRODUCCION;
        $ID_USUARIO_CAMBIO = (int)$this->idUsuario();
        $EDITAR = $request->EDITAR;

        if ($EDITAR == 1) {
            DB::statement('exec sp_actualizar_cotizacion ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', [
                $ID,
                $CLIENTE,
                $TRABAJO,
                $CANTIDAD,
                $ANCHO,
                $ALTO,
                $MEDIANIL_ANCHO,
                $MEDIANIL_ALTO,
                $OBSERVACIONES,
                $SUBTOTAL,
                $PORMARGEN,
                $MARGEN,
                $PORCOMISION,
                $COMISION,
                $PUNITARIO,
                $TOTAL,
                $TIEMPO_PRODUCCION,
                $ID_USUARIO_CAMBIO,
            ]);
        } else {
            DB::statement('exec sp_generar_cotizacion ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', [
                $ID,
                $CLIENTE,
                $TRABAJO,
                $CANTIDAD,
                $ANCHO,
                $ALTO,
                $MEDIANIL_ANCHO,
                $MEDIANIL_ALTO,
                $OBSERVACIONES,
                $SUBTOTAL,
                $PORMARGEN,
                $MARGEN,
                $PORCOMISION,
                $COMISION,
                $PUNITARIO,
                $TOTAL,
                $TIEMPO_PRODUCCION,
                $ID_USUARIO_CAMBIO,
            ]);
        }


        // $cotizacion = DB::table('cotizaciones')->max('FOLIO');
        // return $cotizacion;
    }

    public function obtenerMatEspCombo(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $combo_materiales_especiales = DB::table('v_materiales_especiales_combo')->orderBy('NOMBRE_MATERIAL', 'asc')->get();
        } else {
            $combo_materiales_especiales = DB::table('v_materiales_especiales_combo')->orderBy('NOMBRE_MATERIAL', 'asc')->where('NOMBRE_MATERIAL', 'like', '%' . $search . '%')->get();
        }

        $response = array();
        foreach ($combo_materiales_especiales as $combo_materiales_especiales) {
            $response[] = array("value" => $combo_materiales_especiales->ID_MAT_ESPECIAL, "label" => $combo_materiales_especiales->MATERIAL, "label2" => $combo_materiales_especiales->NOMBRE_MATERIAL);
        }

        echo json_encode($response);
        exit;
    }

    public function obtenerMaterialesE(Request $request)
    {
        $id_mat_esp = $request->id_mat_esp;
        $materiales_especiales = DB::table('v_materiales_especiales')->where('ID_MAT_ESPECIAL', $id_mat_esp)->get();
        return $materiales_especiales;
    }

    public function obtenerTotalDetalle(Request $request)
    {
        $id_cotizacion = $request->id;
        $total_detalle = DB::table('v_total_detalle')->where('ID_COTIZACIONES', $id_cotizacion)->get();
        return $total_detalle;
    }

    public function clonarDetalle(Request $request)
    {
        $id_cotizacion = $request->id;
        DB::statement('exec sp_editar_cotizacion ?', [$id_cotizacion]);
    }

    public function sinCambiosCotizacion(Request $request)
    {
        $id_cotizacion = $request->id;
        DB::statement('exec sp_sin_cambios_cotizacion ?', [$id_cotizacion]);
    }

    public function sinCambiosNuevaCotizacion(Request $request)
    {
        $ID_USUARIO = (int)$this->idUsuario();
        DB::statement('exec sp_sin_cambios_nueva_cotizacion ?', [$ID_USUARIO]);
    }

    public function actualizarMedidasMaterial(Request $request)
    {
        // return $request;
        DB::statement('exec sp_update_cotizacion__material_tmp ?,?,?,?,?,?,?', [
            $request->entranH_r,
            $request->orientacionH_r,
            $request->aprovechamientoH_r,
            $request->importeH_r,
            $request->cantidadH_r,
            $request->titCantMat_r,
            $request->mat_cotId_r,
        ]);
    }

    public function actualizarMedidasTinta(Request $request)
    {
        // return $request;
        DB::statement('exec sp_update_cotizacion__tinta_tmp ?,?,?,?,?', [
            $request->id_cotizaciones,
            $request->blanco,
            $request->precio_imp,
            $request->importe_tinta,
            $request->importe_mo,
        ]);
    }

    public function imprimirCotizacionGrid($id, Request $request)
    {

        set_time_limit(0);

        $cotizacion = DB::table('v_imprimir_cotizacion_grid')->where('ID_COTIZACIONES', $id)->get();
        $cotizacion_materiales = DB::table('v_cotizaciones_materiales_grid')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_MATERIAL', 'ASC')->get();
        $cotizacion_tintas = DB::table('v_cotizaciones_tintas_grid')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_TINTAS', 'ASC')->get();
        $cotizacion_acabados = DB::table('v_cotizaciones_acabados_grid')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_ACABADOS', 'ASC')->get();
        $cotizacion_adicionales = DB::table('v_cotizaciones_adicionales_grid')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_ADICIONALES', 'ASC')->get();
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView("cotizador/imprimirCotizacion", ['dto' => $cotizacion, 'dto_mat' => $cotizacion_materiales, 'dto_tinta' => $cotizacion_tintas, 'dto_aca' => $cotizacion_acabados, 'dto_adi' => $cotizacion_adicionales, 'url' => $request->getHost()]);

        return $dompdf->stream(); //Para visualizar en el navegador

    }

    public function imprimirCotizacionOP($id, Request $request)
    {

        set_time_limit(0);

        $cotizacion = DB::table('v_imprimir_cotizacion_grid')->where('ID_COTIZACIONES', $id)->get();
        $cotizacion_materiales = DB::table('v_cotizaciones_materiales_grid')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_MATERIAL', 'ASC')->get();
        $cotizacion_tintas = DB::table('v_cotizaciones_tintas_grid')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_TINTAS', 'ASC')->get();
        $cotizacion_acabados = DB::table('v_cotizaciones_acabados_grid')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_ACABADOS', 'ASC')->get();
        $cotizacion_adicionales = DB::table('v_cotizaciones_adicionales_grid')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_ADICIONALES', 'ASC')->get();
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView("cotizador/imprimirCotizacionOP", ['dto' => $cotizacion, 'dto_mat' => $cotizacion_materiales, 'dto_tinta' => $cotizacion_tintas, 'dto_aca' => $cotizacion_acabados, 'dto_adi' => $cotizacion_adicionales, 'url' => $request->getHost()]);
        // $dompdf->loadView("cotizador/imprimirCotizacionOP", ['dto' => $cotizacion, 'dto_aca' => $cotizacion_acabados, 'dto_adi' => $cotizacion_adicionales, 'url' => $request->getHost()]);

        return $dompdf->stream(); //Para visualizar en el navegador

    }

    public function imprimirCotizacion($id, Request $request)
    {

        set_time_limit(0);

        $cotizacion = DB::table('v_imprimir_cotizacion')->where('ID_COTIZACIONES', $id)->get();
        $cotizacion_materiales = DB::table('v_cotizaciones_material_tmp')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_MATERIAL', 'ASC')->get();
        $cotizacion_tintas = DB::table('v_cotizaciones_tintas_tmp')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_TINTAS', 'ASC')->get();
        $cotizacion_acabados = DB::table('v_cotizaciones_acabados')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_ACABADOS', 'ASC')->get();
        $cotizacion_adicionales = DB::table('v_cotizaciones_adicionales')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_ADICIONALES', 'ASC')->get();
        $dompdf = App::make("dompdf.wrapper");
        $dompdf->loadView("cotizador/imprimirCotizacion", ['dto' => $cotizacion, 'dto_mat' => $cotizacion_materiales, 'dto_tinta' => $cotizacion_tintas, 'dto_aca' => $cotizacion_acabados, 'dto_adi' => $cotizacion_adicionales, 'url' => $request->getHost()]);

        return $dompdf->stream(); //Para visualizar en el navegador

    }

    public function imprimirCotizacionAcabados($id)
    {

        $cotizacion_acabados = DB::table('v_cotizaciones_acabados')->where('ID_COTIZACIONES', $id)->orderBy('ID_COTIZACIONES_ACABADOS', 'ASC')->get();
        return $cotizacion_acabados;
    }

    private function calcularMaterial($cant_gral, $tancho_gral, $talto_gral, $material_ancho, $material_alto, $material_tipo, $material_importe, $tipo_resultado)
    {

        if ($material_tipo === "R") {
            //Calcular a lo ancho/ancho...
            $resAncho = ($material_ancho / $tancho_gral);
            $resAlto = ($material_alto / $talto_gral);

            //Calcular a lo alto/alto...
            $resAncho2 = ($material_ancho / $talto_gral);
            $resAlto2 = ($material_alto / $tancho_gral);

            //Calcular cuantas piezas entran a lo ancho y a lo alto...
            $orientacionAncho = (int)($resAncho) * (int)($resAlto);
            $orientacionAlto = (int)($resAncho2) * (int)($resAlto2);

            if ($orientacionAncho > $orientacionAlto) {
                $entran = $orientacionAncho;
                $textoEntran = "A lo ancho";
            } else if ($orientacionAncho < $orientacionAlto) {
                $entran = $orientacionAlto;
                $textoEntran = "A lo alto";
            } else if ($orientacionAncho == $orientacionAlto) {
                $entran = $orientacionAlto;
                $textoEntran = "A lo alto";
            }
            //Obtener el porcentaje de Aprovechamiento...
            $aprovech = (($tancho_gral * $talto_gral * $entran) / ($material_ancho * $material_alto)) * 100;
            $porcentaje = $aprovech;
            $titCantMate = 'Pzas.';

            $entran == 0 ? $cantidad2 = 0 : $cantidad2 = ($cant_gral / $entran);
            $rescantidad = $cantidad2;

            $anchom = $material_ancho / 100;
            $altom = $material_alto / 100;

            $valor = $anchom * $altom * $rescantidad * $material_importe * 1.1;
            $resimporte = $valor;

            // return $entran;
        } else if ($material_tipo === "F" || $material_tipo === "P") {

            $entranAncho = (int)($material_ancho / $tancho_gral); // 1
            $entranAlto = (int)($material_ancho / $talto_gral); // 0

            $entranAncho == 0 ? $a_lo_ancho = ceil($cant_gral / 1) * $tancho_gral : $a_lo_ancho = ceil($cant_gral / (int)($material_ancho / $tancho_gral)) * $talto_gral;
            $entranAlto == 0 ? $a_lo_alto = $a_lo_ancho = ceil($cant_gral / 1) * $talto_gral : $a_lo_alto = ceil($cant_gral / (int)($material_ancho / $talto_gral)) * $tancho_gral;

            //Obtiene la cantidad menor de material...
            if ($a_lo_ancho < $a_lo_alto) {
                $aprovech = (($talto_gral * $tancho_gral * $cant_gral) / ($material_ancho * $a_lo_ancho)) * 100;
                $porcentaje = $aprovech;
                $entran = floor($entranAncho);
                $textoEntran = 'A lo ancho';

                $anchoMat = $material_ancho / 100;
                $aloancho = $a_lo_ancho / 100;
                $cantidad1 = $anchoMat * $aloancho;
            } else if ($a_lo_ancho > $a_lo_alto) {
                $aprovech = (($talto_gral * $tancho_gral * $cant_gral) / ($material_ancho * $a_lo_alto)) * 100;
                $porcentaje = $aprovech;
                $entran = floor($entranAlto);
                $textoEntran = 'A lo alto';


                $anchoMat = $material_ancho / 100;
                $aloalto = $a_lo_alto / 100;
                $cantidad1 = $anchoMat * $aloalto;
            } else if ($a_lo_ancho == $a_lo_alto) {
                $aprovech = (($talto_gral * $tancho_gral * $cant_gral) / ($material_ancho * $a_lo_alto)) * 100;
                $porcentaje = $aprovech;
                $entran = floor($entranAncho);
                $textoEntran = 'A lo ancho';

                $anchoMat = $material_ancho / 100;
                $aloalto = $a_lo_alto / 100;
                $cantidad1 = $anchoMat * $aloalto;
            } else {
                //no hay otra condicion...
            }

            $cantidad2 = $cantidad1 / $anchoMat;

            $titCantMate = 'm.';
            $rescantidad = $cantidad2;

            $valor = $material_importe * $cantidad2;
            $valor = ($valor * $material_ancho / 100) * 1.1;
            $resimporte = $valor;
        }

        switch ($tipo_resultado) {
            case 'entran':
                return $entran;
                break;
            case 'textoentran':
                return $textoEntran;
                break;
            case 'aprovechamiento':
                return $porcentaje;
                break;
            case 'resimporte':
                return $resimporte;
                break;
            case 'rescantidad':
                return $rescantidad;
                break;
            default:
                return $titCantMate;
                break;
        }
    }
}
