<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('employes', App\Http\Controllers\API\employeAPIController::class);


Route::resource('calendars', App\Http\Controllers\API\calendarAPIController::class);


Route::resource('attendances', App\Http\Controllers\API\attendanceAPIController::class);

Route::post('updateEntrance', [App\Http\Controllers\API\attendanceAPIController::class, 'updateEntrance']);

Route::resource('contracts', App\Http\Controllers\API\contractsAPIController::class);


Route::resource('endowments', App\Http\Controllers\API\endowmentAPIController::class);


Route::resource('cards', App\Http\Controllers\API\cardAPIController::class);


Route::resource('medicines', App\Http\Controllers\API\MedicineAPIController::class);



Route::resource('invima_registrations', App\Http\Controllers\API\invima_registrationAPIController::class);


Route::resource('medication_templates', App\Http\Controllers\API\medicationTemplateAPIController::class);


Route::resource('articles', App\Http\Controllers\API\articlesAPIController::class);
Route::get('/articles/showCode/{id}', [App\Http\Controllers\API\articlesAPIController::class, 'showCode'])->name('articles.showCode');

Route::resource('labours', App\Http\Controllers\API\labourAPIController::class);


Route::resource('procedures', App\Http\Controllers\API\proceduresAPIController::class);


Route::resource('baskets', App\Http\Controllers\API\basketAPIController::class);


Route::resource('consumables', App\Http\Controllers\API\consumableAPIController::class);


Route::resource('medical_fees', App\Http\Controllers\API\medical_feesAPIController::class);


Route::resource('diferential_rates', App\Http\Controllers\API\diferential_ratesAPIController::class);


Route::resource('doctors', App\Http\Controllers\API\doctorsAPIController::class);


Route::resource('surgeries', App\Http\Controllers\API\surgeryAPIController::class);


Route::resource('unit_costs', App\Http\Controllers\API\unit_costsAPIController::class);


Route::resource('general_costs', App\Http\Controllers\API\general_costsAPIController::class);


Route::resource('soat_groups', App\Http\Controllers\API\soat_groupAPIController::class);


Route::resource('multiple_surgeries', App\Http\Controllers\API\multiple_surgeryAPIController::class);


Route::resource('msurgery_procedures', App\Http\Controllers\API\msurgery_procedureAPIController::class);
Route::get('/msurgery_procedures/{codSurgery}/procedures', [App\Http\Controllers\API\msurgery_procedureAPIController::class, 'fetchProcedures']);




Route::resource('log_operation_costs', App\Http\Controllers\API\log_operation_costAPIController::class);


Route::resource('rented_equipments', App\Http\Controllers\API\rented_equipmentAPIController::class);


Route::resource('cumi_lab_rates', App\Http\Controllers\API\cumiLab_rateAPIController::class);


Route::resource('imaging_productions', App\Http\Controllers\API\imaging_productionAPIController::class);


Route::resource('cumi_lab_historics', App\Http\Controllers\API\cumi_lab_historicAPIController::class);


Route::resource('doctors_changes', App\Http\Controllers\API\doctors_changesAPIController::class);


Route::resource('imaging_production_months', App\Http\Controllers\API\imaging_production_monthAPIController::class);


Route::resource('imaging_production_details', App\Http\Controllers\API\imaging_production_detailsAPIController::class);


Route::resource('imaging_production_hourcosts', App\Http\Controllers\API\imaging_production_hourcostAPIController::class);


Route::resource('imaging_production_supplies', App\Http\Controllers\API\imaging_production_suppliesAPIController::class);


Route::resource('imaging_production_cupsxitems', App\Http\Controllers\API\imaging_production_cupsxitemsAPIController::class);


Route::resource('accommodation_costs', App\Http\Controllers\API\accommodation_costAPIController::class);


Route::resource('cext_details', App\Http\Controllers\API\cext_detailsAPIController::class);


Route::resource('cext_hourcosts', App\Http\Controllers\API\cext_hourcostAPIController::class);


Route::resource('cext_production_months', App\Http\Controllers\API\cext_production_monthAPIController::class);


Route::resource('blood_bank_months', App\Http\Controllers\API\blood_bank_monthAPIController::class);


Route::resource('ambulance_costs', App\Http\Controllers\API\ambulance_costAPIController::class);


Route::resource('patologies', App\Http\Controllers\API\patologyAPIController::class);


Route::resource('dist_packages', App\Http\Controllers\API\dist_packageAPIController::class);


Route::resource('detail_packages', App\Http\Controllers\API\detail_packageAPIController::class);


Route::resource('detail_packages_temps', App\Http\Controllers\API\detail_packages_tempAPIController::class);


Route::resource('procedures_homologators', App\Http\Controllers\API\procedures_homologatorAPIController::class);


Route::resource('log_diferential_rates', App\Http\Controllers\API\log_diferential_ratesAPIController::class);


Route::resource('log_unit_costs', App\Http\Controllers\API\log_unit_costAPIController::class);


Route::resource('log_details_unit_costs', App\Http\Controllers\API\log_details_unitCostAPIController::class);


Route::resource('log_imaging_production_details', App\Http\Controllers\API\log_imaging_production_detailAPIController::class);


Route::resource('log_cext_details', App\Http\Controllers\API\log_cext_detailsAPIController::class);


Route::resource('log_accommodation_costs', App\Http\Controllers\API\log_accommodation_costAPIController::class);


Route::resource('log_cumi_lab_rates', App\Http\Controllers\API\log_cumi_lab_rateAPIController::class);


Route::resource('log_patologies', App\Http\Controllers\API\log_patologyAPIController::class);


Route::resource('log_blood_banks', App\Http\Controllers\API\log_blood_bankAPIController::class);


Route::resource('log_ambulance_costs', App\Http\Controllers\API\log_ambulance_costAPIController::class);


Route::resource('user_employees', App\Http\Controllers\API\user_employeeAPIController::class);


Route::resource('presenters', App\Http\Controllers\API\presenterAPIController::class);
Route::get('/showPending/{userid}', [App\Http\Controllers\API\presenterAPIController::class, 'showPending']);
Route::get('/showApproved/{userid}', [App\Http\Controllers\API\presenterAPIController::class, 'showApproved']);
Route::get('/showPresenter/{userid}', [App\Http\Controllers\API\presenterAPIController::class, 'showPresenter']);
Route::post('/approveAttendance', [App\Http\Controllers\API\presenterAPIController::class, 'approveAttendance']);

Route::resource('stand_assistances', App\Http\Controllers\API\stand_assistanceAPIController::class);
Route::get('/viewer/{userid}', [App\Http\Controllers\API\stand_assistanceAPIController::class, 'viewer']);
