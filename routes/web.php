<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataJabatanController;
use App\Http\Controllers\Admin\DataPegawaiController;
use App\Http\Controllers\Admin\DataKehadiranController;
use App\Http\Controllers\Admin\DataGajiController;
use App\Http\Controllers\Admin\LaporanGajiController;
use App\Http\Controllers\Admin\LaporanKehadiranController;
use App\Http\Controllers\Admin\SlipGajiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [DashboardController::class, 'index'])
->name('admin.dashboard');

Route::get('/admin/data-pegawai', [DataPegawaiController::class, 'index'])
    ->name('admin.data_pegawai');
Route::get('/admin/data-pegawai/create', [DataPegawaiController::class, 'create'])
    ->name('admin.data_pegawai.create');
Route::post('/admin/data-pegawai', [DataPegawaiController::class, 'store'])
    ->name('admin.data_pegawai.store');
Route::get('/admin/data-pegawai/{dataPegawai}/edit', [DataPegawaiController::class, 'edit'])
    ->name('admin.data_pegawai.edit');
Route::put('/admin/data-pegawai/{dataPegawai}', [DataPegawaiController::class, 'update'])
    ->name('admin.data_pegawai.update');
Route::delete('/admin/data-pegawai/{dataPegawai}', [DataPegawaiController::class, 'destroy'])
    ->name('admin.data_pegawai.destroy');

Route::get('/admin/data-jabatan', [DataJabatanController::class, 'index'])
    ->name('admin.data_jabatan');
Route::get('/admin/data-jabatan/create', [DataJabatanController::class, 'create'])
    ->name('admin.data_jabatan.create');
Route::post('/admin/data-jabatan', [DataJabatanController::class, 'store'])
    ->name('admin.data_jabatan.store');
Route::get('/admin/data-jabatan/{dataJabatan}/edit', [DataJabatanController::class, 'edit'])
    ->name('admin.data_jabatan.edit');
Route::put('/admin/data-jabatan/{dataJabatan}', [DataJabatanController::class, 'update'])
    ->name('admin.data_jabatan.update');
Route::delete('/admin/data-jabatan/{dataJabatan}', [DataJabatanController::class, 'destroy'])
    ->name('admin.data_jabatan.destroy');


Route::get('/admin/data-kehadiran', [DataKehadiranController::class, 'index'])
    ->name('admin.data_kehadiran');

Route::get('/admin/data-gaji', [DataGajiController::class, 'index'])
    ->name('admin.data_gaji');

Route::get('/admin/laporan-gaji', [LaporanGajiController::class, 'index'])
    ->name('admin.laporan_gaji');

Route::get('/admin/laporan-kehadiran', [LaporanKehadiranController::class, 'index'])
    ->name('admin.laporan_kehadiran');

Route::get('/admin/slip-gaji', [SlipGajiController::class, 'index'])
    ->name('admin.slip_gaji');