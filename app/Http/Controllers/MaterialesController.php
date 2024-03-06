<?php

namespace App\Http\Controllers;

use App\Traits\PermisosTrait;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Yajra\DataTables\DataTables;

class MaterialesController extends Controller
{
    use PermisosTrait;

    public $modulo = 'Materiales';
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

            $titulo = 'Materiales';

            $fecha = new DateTime();
            $año = $fecha->format('Y');

            $fechainicio = date('Y-m-d', strtotime('first day of january ' . $año));
            $fechafin = date('Y-m-d', strtotime('last day of december ' . $año));
            $materiales_combo = DB::table('v_materiales_combo')->orderBy('NOMBRE_MATERIAL')->get();

            if ($permiso != 0) {
                return view('materiales.index', compact('titulo', 'create', 'permiso', 'nombre', 'materiales_combo'));
            } else {
                return view('inicio');
            }
        }
    }

    public function apiMaterialesIndex()
    {
        $materiale_index = DB::table('v_materiales_index');

        return DataTables::of($materiale_index)
            ->make(true);
    }

    public function obtenerMaterialIndex(Request $request)
    {
        $material_index = DB::table('v_materiales_index')->where('ID_MATERIAL', $request->id)->get();
        return $material_index;
    }

    public function guardarMaterialIndex(Request $request)
    {
        if ($request->TRASLUCIDO == 'on') {
            $TRASLUCIDO = 1;
        } else {
            $TRASLUCIDO = 0;
        }

        if ($request->SOLVENTE == 'on') {
            $SOLVENTE = 1;
        } else {
            $SOLVENTE = 0;
        }

        if ($request->ACTIVO == 'on') {
            $ACTIVO = 1;
        } else {
            $ACTIVO = 0;
        }

        if ($request->ANCHO2 == '') {
            $ANCHO2 = 0;
        } else {
            $ANCHO2 = $request->ANCHO2;
        }

        if ($request->ALTO2 == '') {
            $ALTO2 = 0;
        } else {
            $ALTO2 = $request->ALTO2;
        }

        if ($request->ANCHO3 == '') {
            $ANCHO3 = 0;
        } else {
            $ANCHO3 = $request->ANCHO3;
        }

        if ($request->ALTO3 == '') {
            $ALTO3 = 0;
        } else {
            $ALTO3 = $request->ALTO3;
        }

        if ($request->ANCHO4 == '') {
            $ANCHO4 = 0;
        } else {
            $ANCHO4 = $request->ANCHO4;
        }

        if ($request->ALTO4 == '') {
            $ALTO4 = 0;
        } else {
            $ALTO4 = $request->ALTO4;
        }

        if ($request->ANCHO5 == '') {
            $ANCHO5 = 0;
        } else {
            $ANCHO5 = $request->ANCHO5;
        }

        if ($request->ALTO5 == '') {
            $ALTO5 = 0;
        } else {
            $ALTO5 = $request->ALTO5;
        }

        if ($request->ID_MATERIAL == null || $request->ID_MATERIAL == '') {
            $ID_MAX = Db::table('materiales_cotizador')->max('ID_MATERIAL');
            $ID_MATERIAL = $ID_MAX + 1;
            DB::statement('exec sp_insert_material_index ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', [
                strtoupper($request->NOMBRE_MATERIAL),
                $request->ANCHO1,
                $request->ALTO1,
                $ANCHO2,
                $ALTO2,
                $ANCHO3,
                $ALTO3,
                $ANCHO4,
                $ALTO4,
                $ANCHO5,
                $ALTO5,
                $request->TIPO,
                $request->IMPORTE,
                strtoupper($request->PROVEEDOR),
                $request->CORTE,
                $TRASLUCIDO,
                $SOLVENTE,
                $ID_MATERIAL,
            ]);
        } else {
            DB::statement('exec sp_update_material_index ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?', [
                strtoupper($request->NOMBRE_MATERIAL),
                $request->ANCHO1,
                $request->ALTO1,
                $ANCHO2,
                $ALTO2,
                $ANCHO3,
                $ALTO3,
                $ANCHO4,
                $ALTO4,
                $ANCHO5,
                $ALTO5,
                $request->TIPO,
                $request->IMPORTE,
                strtoupper($request->PROVEEDOR),
                $request->CORTE,
                $TRASLUCIDO,
                $SOLVENTE,
                $ACTIVO,
                $request->ID_MATERIAL,
            ]);
        }
        return $request;
    }

    public function activarMaterialIndex(Request $request)
    {
        if ($request->ACTIVO == 'true') {
            $ACTIVO = 1;
        } else {
            $ACTIVO = 0;
        }

        DB::statement('exec sp_activar_material_index ?, ?', [
            $ACTIVO,
            $request->id,
        ]);

        return $request;
    }

    public function apiTintasIndex()
    {
        $tintas_index = DB::table('v_tintas_index');

        return DataTables::of($tintas_index)
            ->make(true);
    }

    public function obtenerTintaIndex(Request $request)
    {
        $tinta_index = DB::table('v_tintas_index')->where('idTintas', $request->id)->get();
        return $tinta_index;
    }

    public function guardarTintaIndex(Request $request)
    {
        if ($request->Estatus == 'on') {
            $ACTIVO = 1;
        } else {
            $ACTIVO = 0;
        }

        if ($request->idTintas == null || $request->idTintas == '') {
            $ID_MAX = Db::table('Tintas')->max('idTintas');
            $ID_TINTA = $ID_MAX + 1;
            DB::statement('exec sp_insert_tinta_index ?, ?, ?, ?, ?', [
                strtoupper($request->Nombre),
                $request->PrecioTinta,
                $request->PrecioMOFlexible,
                $request->PrecioMORigido,
                $ID_TINTA,
            ]);
        } else {
            DB::statement('exec sp_update_tinta_index ?, ?, ?, ?, ?, ?', [
                strtoupper($request->Nombre),
                $request->PrecioTinta,
                $request->PrecioMOFlexible,
                $request->PrecioMORigido,
                $ACTIVO,
                $request->idTintas,
            ]);
        }
        return $request;
    }

    public function activarTintaIndex(Request $request)
    {
        if ($request->ACTIVO == 'true') {
            $ACTIVO = 1;
        } else {
            $ACTIVO = 0;
        }

        DB::statement('exec sp_activar_tinta_index ?, ?', [
            $ACTIVO,
            $request->id,
        ]);

        return $request;
    }

    public function apiAcabadosIndex()
    {
        $acabados_index = DB::table('v_acabados_index');

        return DataTables::of($acabados_index)
            ->make(true);
    }

    public function obtenerAcabadoIndex(Request $request)
    {
        $acabado_index = DB::table('v_acabados_index')->where('ID_ACABADO', $request->id)->get();
        return $acabado_index;
    }

    public function guardarAcabadoIndex(Request $request)
    {
        if ($request->ACTIVO == 'on') {
            $ACTIVO = 1;
        } else {
            $ACTIVO = 0;
        }

        if ($request->ID_ACABADO == null || $request->ID_ACABADO == '') {
            $ID_MAX = Db::table('Acabados')->max('ID_ACABADO');
            $ID_ACABADO = $ID_MAX + 1;
            DB::statement('exec sp_insert_acabado_index ?, ?, ?, ?', [
                strtoupper($request->DESCRIPCION),
                $request->IMPORTE,
                strtoupper($request->UNIDAD),
                $ID_ACABADO,
            ]);
        } else {
            DB::statement('exec sp_update_acabado_index ?, ?, ?, ?, ?', [
                strtoupper($request->DESCRIPCION),
                $request->IMPORTE,
                strtoupper($request->UNIDAD),
                $ACTIVO,
                $request->ID_ACABADO,
            ]);
        }
        return $request;
    }

    public function activarAcabadoIndex(Request $request)
    {
        if ($request->ACTIVO == 'true') {
            $ACTIVO = 1;
        } else {
            $ACTIVO = 0;
        }

        DB::statement('exec sp_activar_acabado_index ?, ?', [
            $ACTIVO,
            $request->id,
        ]);

        return $request;
    }

}
