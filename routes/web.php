<?php

use App\Http\Controllers\DataSetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\AhspController;
use App\Http\Controllers\AhspDetailController;
use App\Http\Controllers\SupportCostController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\RabDetailController;
use App\Http\Controllers\ExcelTestController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->get('/search', function (\Illuminate\Http\Request $request) {
    $q = trim((string) $request->query('q', ''));
    $buildings = collect();
    $audits = collect();
    $rabs = collect();

    if ($q !== '') {
        $like = '%' . addcslashes($q, '%_\\') . '%';

        $buildings = \App\Models\Building::query()
            ->where(function ($query) use ($like) {
                $query->where('nama_bangunan', 'like', $like)
                    ->orWhere('kode_bangunan', 'like', $like)
                    ->orWhere('alamat', 'like', $like);
            })->latest()->limit(12)->get();

        $audits = \App\Models\Audit::with('building')
            ->where(function ($query) use ($like) {
                $query->where('nomor_audit', 'like', $like)
                    ->orWhere('hasil_knn', 'like', $like)
                    ->orWhereHas('building', fn ($building) => $building->where('nama_bangunan', 'like', $like));
            })->latest()->limit(12)->get();

        $rabs = \App\Models\Rab::with('audit.building')
            ->where(function ($query) use ($like) {
                $query->where('nomor_rab', 'like', $like)
                    ->orWhereHas('audit', function ($audit) use ($like) {
                        $audit->where('nomor_audit', 'like', $like)
                            ->orWhereHas('building', fn ($building) => $building->where('nama_bangunan', 'like', $like));
                    });
            })->latest()->limit(12)->get();
    }

    return view('search.index', compact('q', 'buildings', 'audits', 'rabs'));
})->name('search');

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {

        Route::post(
            '/data-set/import',
            [DataSetController::class, 'import']
        )->name('data-set.import');

        Route::resource('materials', MaterialController::class);


        Route::resource('labors', LaborController::class);

        Route::resource('equipments', EquipmentController::class);

        Route::resource('support-costs', SupportCostController::class);

        Route::resource('data-set', DataSetController::class);

        Route::resource('ahsps', AhspController::class);

        Route::resource('ahsp-details', AhspDetailController::class);

        Route::get(
            '/ahsps/{ahsp}/details/create',
            [AhspDetailController::class, 'createByAhsp']
        )->name('ahsp-details.create-by-ahsp');

        Route::post(
            '/buildings/import',
            [BuildingController::class, 'import']
        )
            ->name('buildings.import');

        Route::post(
            '/materials/import',
            [MaterialController::class, 'import']
        )
            ->name('materials.import');

        Route::post(
            '/equipments/import',
            [EquipmentController::class, 'import']
        )
            ->name('equipments.import');

        Route::post(
            '/labors/import',
            [LaborController::class, 'import']
        )
            ->name('labors.import');

        Route::post(
            '/support-costs/import',
            [SupportCostController::class, 'import']
        )
            ->name('support-costs.import');

    });

    Route::middleware(['auth', 'role:admin,pengurus_pu'])->group(function () {

        Route::resource('buildings', BuildingController::class);

        Route::resource('audits', AuditController::class);

        Route::resource('rabs', RabController::class);

        Route::get(
            '/audits/{audit}/pdf',
            [AuditController::class, 'pdf']
        )->name('audits.pdf');

        Route::post(
            '/audits/{audit}/create-rab',
            [RabController::class, 'createFromAudit']
        )->name('rabs.create-from-audit');

        Route::post(
            '/rab-details',
            [RabDetailController::class, 'store']
        )->name('rab-details.store');

    });

    Route::middleware(['auth', 'role:admin,pimpinan,pengurus_pu'])->group(function () {

        Route::get(
            '/audits/{audit}/pdf',
            [AuditController::class, 'pdf']
        )->name('audits.pdf');

    });
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';

