<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PrestadorController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\LaravelExcelController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\DictamenController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\DocumentoController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::post('consultaCreditos', [AlumnoController::class, 'consulta'])->name('consultaCredito');
Route::get('descargarDocumento/{id}', [CreditoController::class, 'descargarDocumento'])->name('descargarDocumento');
Route::get('descargarDocumentos', [CreditoController::class, 'descargarDocumentos'])->name('descargarDocumentos');

Route::get('/dashboard', function () {
    return view('principal');
})->name('dashboard')->middleware('auth');

/* Rutas de administrador */
Route::group(['middleware' => 'auth', 'middleware' => 'admin'], function(){
    Route::resource('alumnos', AlumnoController::class);
    Route::delete('destroyAlumnos', [AlumnoController::class, 'destroyAll'])->name('destroyAll');
    Route::resource('departamentos', DepartamentoController::class);
    Route::post('import', [LaravelExcelController::class, 'import'])->name('import'); // Import Alumnos
    Route::resource('documento', DocumentoController::class);
    Route::get('Formato', [DocumentoController::class, 'showFormato'])->name('showFormato');
});

/* Rutas de Jefe departamento */
Route::group(['middleware' => 'auth', 'middleware' => 'jefedepto'],function () {
    Route::resource('actividades', ActividadController::class);
    Route::resource('disctamens', DictamenController::class);
    Route::resource('participantes', ParticipanteController::class);
    Route::get('actividadesrevision', [ActividadController::class, 'actividadesrevision'])->name('actividadesrevision');
    Route::get('evaluacionrevision/{noControl}/{idAct}', [EvaluacionController::class, 'show'])->name('evaluacionrevision');
    Route::patch('updateConstancia/{idAct}/{idEva}/{noControl}', [CreditoController::class, 'update'])->name('updateConstancia');
});

/** Rutas de prestador */
Route::group(['middleware' => 'auth', 'middleware' => 'prestador'], function(){
    Route::get('misactividades', [ActividadController::class, 'misActividades'])->name('misactividades');
});

/** Rutas de Servicios Escolares */
Route::group(['middleware' => 'auth', 'middleware' => 'departamento'], function(){
    Route::resource('creditos', CreditoController::class);
    Route::get('historialcreditos', [CreditoController::class, 'historial'])->name('historial');
    Route::get('liberarConstancia/{noControl}/{idAct}', [CreditoController::class, 'liberarConstancia'])->name('liberarConstancia');
    Route::get('regresarConstancia/{noControl}/{idAct}', [CreditoController::class, 'regresarConstancia'])->name('regresarConstancia');
    Route::get('verConstancia/{noControl}/{idAct}', [CreditoController::class, 'verConstancia'])->name('verConstancia');
});

/** Rutas compartidas */
Route::group(['middleware' => 'auth'], function(){
    Route::resource('usuarios', UsuariosController::class);
    Route::resource('actividades', ActividadController::class);
    Route::resource('evaluaciones', EvaluacionController::class);
    Route::resource('participantes', ParticipanteController::class);
    Route::delete('deleteParticipanes/{idAct}', [ParticipanteController::class, 'destroyParticipantes'])->name('deleteParticipantes');
    Route::patch('password/{id}', [UsuariosController::class, 'passwordEdit'])->name('passwordedit');
    Route::get('perfil', [UsuariosController::class, 'showProfile'])->name('perfil');
    Route::patch('updateActividad/{idAct}', [ActividadController::class, 'update'])->name('updateActividad');
    Route::post('crearParticipante/{idAct}', [ParticipanteController::class, 'store'])->name('crearParticipante');
    Route::get('descargarConstancia/{noControl}/{idAct}', [CreditoController::class, 'descargarConstancia'])->name('descargarConstancia');
    Route::patch('updatePrestador/{idAct}', [ActividadController::class, 'updatePrestador'])->name('updatePrestador'); // Modal
    ROUTE::get('updateStatus', [ParticipanteController::class, 'updateStatus'])->name('updateStatus'); // Modal
    Route::post('importParticipantes/{idAct}', [LaravelExcelController::class, 'importParticipantes'])->name('importParticipantes'); // Import Participantes
    Route::get('exportUsuarios', [UsuariosController::class, 'export'])->name('exportUsuarios'); //  Exportar Usuarios
    Route::get('exportConstancia', [EvaluacionController::class, 'export'])->name('exportConstancia'); // Exportar Constancia de creditos PDF
    Route::get('exportParticipantes', [ParticipanteController::class, 'export'])->name('exportParticipantes'); // Exportar lista de participantes PDF
    Route::get('mailConstancia', [MailController::class, 'sendEmail'])->name('mailConstancia'); // Envio de email
    Route::post('importSemestre', [LaravelExcelController::class, 'importSemestre'])->name('importSemestre'); // Import del semestre (Formato de TEAMS)
});

require __DIR__.'/auth.php';