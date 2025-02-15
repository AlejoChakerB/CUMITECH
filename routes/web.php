<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
{
	Route::resource('users', App\Http\Controllers\Admin\UsersController::class, ['as' => 'admin']);

    Route::resource('roles', App\Http\Controllers\Admin\RolesController::class, ['except' => 'show', 'as' => 'admin']);
    Route::resource('permissions', App\Http\Controllers\Admin\PermissionsController::class, ['only' => ['index', 'edit', 'update'], 'as' => 'admin']);

    Route::middleware('role:Admin')
    	->put('users/{user}/roles', 'App\Http\Controllers\Admin\UsersRolesController@update')
    	->name('admin.users.roles.update');

    Route::middleware('role:Admin')
        ->put('users/{user}/permissions', 'App\Http\Controllers\Admin\UsersPermissionsController@update')
        ->name('admin.users.permissions.update');

});

Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);

Route::get('/change-password', [App\Http\Controllers\PasswordChangeController::class, 'showChangeForm'])->name('password.change');
Route::post('/change-password', [App\Http\Controllers\PasswordChangeController::class, 'changePassword'])->name('password.change.post');

Route::group(['middleware' => ['auth', 'check.password.change', 'log.activity']], function()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('employes', App\Http\Controllers\employeController::class);
    Route::resource('calendars', App\Http\Controllers\calendarController::class);

    Route::resource('attendances', App\Http\Controllers\attendanceController::class);
    Route::resource('control', App\Http\Controllers\controlController::class);

    //Ruta Reportes
    Route::get('/attendanceReport/attendanceToday', [App\Http\Controllers\AttendanceReportController::class, 'attendanceToday'])->name('attendanceReport.attendanceToday');
    Route::get('/attendanceReport/workingAndFinished', [App\Http\Controllers\AttendanceReportController::class, 'getWorkingAndFinished'])->name('attendanceReport.workingAndFinished');
    Route::get('/attendanceReport/finished', [App\Http\Controllers\AttendanceReportController::class, 'getFinished'])->name('attendanceReport.finished');
    Route::get('/attendanceTime/attendanceNot', [App\Http\Controllers\AttendanceTimeController::class, 'attendanceNot'])->name('attendanceTime.attendanceNot');
    Route::view('/counts', 'attendances.count')->name('attendances.count');
    Route::get('/attendanceReport/logistic', [App\Http\Controllers\AttendanceReportController::class, 'logistics'])->name('attendanceReport.logistic');

    //Generar calendarios
    Route::get('/generar-calendarios', [App\Http\Controllers\CalendarController::class, 'calendarGenerator'])->name('calendars.generate');

    //Importar tarifas diferenciales
    Route::post('import', [App\Http\Controllers\diferential_ratesController::class, 'import'])->name('import');

    //Importar ambulancia
    Route::post('importAmbulance', [App\Http\Controllers\ambulance_costController::class, 'importAmbulance'])->name('importAmbulance');

    //Importar laboratorio
    Route::post('importlab', [App\Http\Controllers\cumiLab_rateController::class, 'importlab'])->name('importlab');

    //Importar produccion imagenes
    Route::post('importImagingdetail', [App\Http\Controllers\imaging_production_detailsController::class, 'importImagingdetail'])->name('importImagingdetail');

    //Importar patologia
    Route::post('importPatology', [App\Http\Controllers\patologyController::class, 'importPatology'])->name('importPatology');

    //Exportar excel
    Route::post('importEmployees', [App\Http\Controllers\employeController::class, 'importEmployees'])->name('importEmployees');

    //Exportar excel
    Route::post('export', [App\Http\Controllers\endowmentController::class, 'export'])->name('export');

    //Exportar excel
    Route::post('exportCext', [App\Http\Controllers\cext_detailsController::class, 'exportCext'])->name('exportCext');

    //Exportar excel
    Route::post('exportProcedure', [App\Http\Controllers\unit_costsController::class, 'exportProcedure'])->name('exportProcedure');

    //Exportar excel
    Route::post('exportCumiLab', [App\Http\Controllers\cumiLab_rateController::class, 'exportCumiLab'])->name('exportCumiLab');

    //Exportar excel
    Route::post('exportImaging', [App\Http\Controllers\imaging_production_detailsController::class, 'exportImaging'])->name('exportImaging');

    //Exportar excel
    Route::post('exportAccomodation', [App\Http\Controllers\accommodation_costController::class, 'exportAccomodation'])->name('exportAccomodation');

    Route::resource('contracts', App\Http\Controllers\contractsController::class);


    Route::resource('endowments', App\Http\Controllers\endowmentController::class);

    //Generar PDF
    Route::get('/generar-acta-entrega/{id}', [App\Http\Controllers\endowmentController::class, 'generarActaEntrega'])->name('generar.acta.entrega');

    //Generar PDF
    Route::get('/generar-acta-entrega-card/{id}', [App\Http\Controllers\cardController::class, 'generarActaEntregaCard'])->name('generar.acta.entrega.card');

    Route::resource('cards', App\Http\Controllers\cardController::class);

    Route::get('/cards/employe/{id}', [App\Http\Controllers\CardController::class, 'showEmploye'])->name('cards.employe');
    Route::get('/endowments/employe/{id}', [App\Http\Controllers\EndowmentController::class, 'showEmploye'])->name('endowment.employe');

    Route::resource('medicines', App\Http\Controllers\MedicineController::class);

    Route::get('/employees', [App\Http\Controllers\EmployeController::class, 'getEmployees'])->name('get.employee');
    Route::get('/updateemployees', [App\Http\Controllers\EmployeController::class, 'updateEmployees'])->name('update.employee');

    //Contracts
    Route::get('/getContracts', [App\Http\Controllers\contractsController::class, 'getContracts'])->name('get.contracts');

    //Procedures
    Route::get('/getProcedures', [App\Http\Controllers\proceduresController::class, 'getProcedures'])->name('get.procedures');
    Route::get('/searchProcedures', [App\Http\Controllers\proceduresController::class, 'searchProcedures'])->name('search.procedures');

    Route::get('/getsCups', [App\Http\Controllers\proceduresController::class, 'getsCups'])->name('cups.procedures');
    Route::get('/getsCode', [App\Http\Controllers\proceduresController::class, 'getsCode'])->name('code.procedures');
    Route::get('/getsCode2', [App\Http\Controllers\proceduresController::class, 'getsCode2'])->name('code2.procedures');

    //Articles
    Route::get('/getArticles', [App\Http\Controllers\articlesController::class, 'getArticles'])->name('get.articles');
    Route::get('/searchArticles', [App\Http\Controllers\articlesController::class, 'searchArticles'])->name('search.articles');

    //Medical_fees
    Route::get('/getFees', [App\Http\Controllers\medical_feesController::class, 'getFees'])->name('get.fees');

    //Doctors
    Route::get('/getDoctors', [App\Http\Controllers\doctorsController::class, 'getDoctors'])->name('get.doctors');
    Route::get('/searchDoctors', [App\Http\Controllers\doctorsController::class, 'searchDoctors'])->name('search.doctor');

    //surgeries
    Route::get('/getSurgery', [App\Http\Controllers\surgeryController::class, 'getSurgery'])->name('get.surgeries');

    //Multiple surgeries
    Route::get('/getmsurgeries', [App\Http\Controllers\multiple_surgeryController::class, 'getmsurgeries'])->name('get.msurgeries');

    Route::resource('invimaRegistrations', App\Http\Controllers\invima_registrationController::class);

    Route::resource('medicationTemplates', App\Http\Controllers\medicationTemplateController::class);


    Route::resource('articles', App\Http\Controllers\articlesController::class);


    Route::resource('labours', App\Http\Controllers\labourController::class);


    Route::resource('procedures', App\Http\Controllers\proceduresController::class);


    Route::resource('baskets', App\Http\Controllers\basketController::class);
    Route::get('/showBasket{id}', [App\Http\Controllers\basketController::class, 'showBasket'])->name('basket.showBasket');

    Route::resource('consumables', App\Http\Controllers\consumableController::class);


    Route::resource('medicalFees', App\Http\Controllers\medical_feesController::class);

    Route::view('/costs', 'costs.index')->name('costs.index');
    Route::view('/costsAccomodance', 'costs.accomodance')->name('costs.accomodance');

    Route::resource('diferentialRates', App\Http\Controllers\diferential_ratesController::class);


    Route::resource('doctors', App\Http\Controllers\doctorsController::class);
    Route::get('/searchSpecialty', [App\Http\Controllers\doctorsController::class, 'searchSpecialty'])->name('search.searchSpecialty');

    Route::resource('surgeries', App\Http\Controllers\surgeryController::class);


    Route::resource('unitCosts', App\Http\Controllers\unit_costsController::class);
    Route::get('/report', [App\Http\Controllers\unit_costsController::class, 'report'])->name('unitCosts.report');

    Route::resource('generalCosts', App\Http\Controllers\general_costsController::class);


    Route::get('/unitCosts/{id}/calculate', [App\Http\Controllers\unit_costsController::class, 'calculate'])->name('costUnit.calculate');

    Route::get('/costSurgeries', [App\Http\Controllers\unit_costsController::class, 'costSurgeries'])->name('costUnit.costSurgeries');



    Route::resource('soatGroups', App\Http\Controllers\soat_groupController::class);


    Route::resource('multipleSurgeries', App\Http\Controllers\multiple_surgeryController::class);


    Route::resource('msurgeryProcedures', App\Http\Controllers\msurgery_procedureController::class);
    Route::get('/surgeries/msurgery_procedures/{id}', [App\Http\Controllers\msurgery_procedureController::class, 'showProcedure'])->name('surgery.procedure');

    Route::resource('logOperationCosts', App\Http\Controllers\log_operation_costController::class);
    Route::get('/searchCupsSurgery', [App\Http\Controllers\log_operation_costController::class, 'searchCupsSurgery'])->name('search.searchCupsSurgery');

    Route::resource('rentedEquipments', App\Http\Controllers\rented_equipmentController::class);

    Route::resource('cumiLabRates', App\Http\Controllers\cumiLab_rateController::class);

    Route::get('/calculateLab', [App\Http\Controllers\cumiLab_rateController::class, 'calculateLab'])->name('cumilab.calculateLab');
    Route::view('/reportLab', 'cumi_lab_rates.report')->name('cumi_lab_rates.report');
    Route::get('/endPeriod', [App\Http\Controllers\cumiLab_rateController::class, 'endPeriod'])->name('cumilab.endPeriod');

    Route::post('/python', [App\Http\Controllers\PythonController::class, 'ejecutarPython'])->name('python');

    Route::resource('imagingProductions', App\Http\Controllers\imaging_productionController::class);

    Route::get('ProcedureNotFound', [App\Http\Controllers\msurgery_procedureController::class, 'ProcedureNotFound'])->name('msurgeryProcedures.ProcedureNotFound');

    Route::resource('cumiLabHistorics', App\Http\Controllers\cumi_lab_historicController::class);


    Route::resource('doctorsChanges', App\Http\Controllers\doctors_changesController::class);

    Route::resource('imagingProductionMonths', App\Http\Controllers\imaging_production_monthController::class);
    Route::get('countImg', [App\Http\Controllers\imaging_production_monthController::class, 'countImg'])->name('imagingProductionMonths.count');

    Route::resource('imagingProductionDetails', App\Http\Controllers\imaging_production_detailsController::class);
    Route::get('calculateImg', [App\Http\Controllers\imaging_production_detailsController::class, 'calculateImg'])->name('imagingProductionDetails.calculate');
    Route::view('/reportImaging', 'imaging_production_details.report')->name('imaging_production_details.report');

    Route::resource('imagingProductionHourcosts', App\Http\Controllers\imaging_production_hourcostController::class);


    Route::resource('imagingProductionSupplies', App\Http\Controllers\imaging_production_suppliesController::class);
    Route::get('/getSupplies', [App\Http\Controllers\imaging_production_suppliesController::class, 'getSupplies'])->name('imaging.supplies');

    Route::resource('imagingProductionCupsxitems', App\Http\Controllers\imaging_production_cupsxitemsController::class);


    Route::resource('accommodationCosts', App\Http\Controllers\accommodation_costController::class);
    Route::get('/service', [App\Http\Controllers\accommodation_costController::class, 'service'])->name('accommodationCosts.service');
    Route::get('/showCostCenter', [App\Http\Controllers\accommodation_costController::class, 'showCostCenter'])->name('accommodationCosts.showCostCenter');
    Route::view('/reportAccomodation', 'accommodation_costs.report')->name('accomodation.report');
    Route::get('/searchAccommodationService', [App\Http\Controllers\accommodation_costController::class, 'searchAccommodationService'])->name('search.searchAccommodationService');
    Route::get('/searchAccommodationCostCenter', [App\Http\Controllers\accommodation_costController::class, 'searchAccommodationCostCenter'])->name('search.searchAccommodationCostCenter');


    Route::resource('cextDetails', App\Http\Controllers\cext_detailsController::class);
    Route::view('/reportCext', 'cext_details.report')->name('cext_details.report');
    Route::get('/searchCextSpecialty', [App\Http\Controllers\cext_detailsController::class, 'searchCextSpecialty'])->name('search.searchCextSpecialty');

    Route::resource('cextHourcosts', App\Http\Controllers\cext_hourcostController::class);
    Route::get('/editHour', [App\Http\Controllers\cext_hourcostController::class, 'editHour'])->name('cextHourcosts.editHour');

    Route::resource('cextProductionMonths', App\Http\Controllers\cext_production_monthController::class);
    Route::get('count', [App\Http\Controllers\cext_production_monthController::class, 'count'])->name('cext.count');
    Route::get('calculate', [App\Http\Controllers\cext_detailsController::class, 'calculate'])->name('cext.calculate');

    Route::resource('bloodBankMonths', App\Http\Controllers\blood_bank_monthController::class);


    Route::resource('bloodBankMonths', App\Http\Controllers\blood_bank_monthController::class);
    Route::get('countBlood', [App\Http\Controllers\blood_bank_monthController::class, 'countBlood'])->name('blood.count');
    Route::get('/calculateBlood', [App\Http\Controllers\blood_bank_monthController::class, 'calculateBlood'])->name('blood.calculateBlood');
    Route::view('/reportBlood', 'blood_bank_months.report')->name('blood_bank_months.report');

    Route::resource('ambulanceCosts', App\Http\Controllers\ambulance_costController::class);
    Route::view('/reportAmbulance', 'ambulance_costs.report')->name('ambulance_costs.report');

    Route::resource('patologies', App\Http\Controllers\patologyController::class);
    Route::view('/reportPatologies', 'patologies.report')->name('patologies.report');

    #Plantillas
    //Ambulancia
    Route::get('/downloadAmbulance', [App\Http\Controllers\ambulance_costController::class, 'downloadAmbulance'])->name('download.ambulance');

    //Patologias
    Route::get('/downloadPatologies', [App\Http\Controllers\patologyController::class, 'downloadPatologies'])->name('download.patologies');

    //Detalles imagenes
    Route::get('/downloadDetailImaging', [App\Http\Controllers\imaging_production_detailsController::class, 'downloadDetailImaging'])->name('download.imagingDetail');

    //Tarifas diferenciales
    Route::get('/downloadDiferentialRates', [App\Http\Controllers\diferential_ratesController::class, 'downloadDiferentialRates'])->name('download.rates');

    Route::get('/searchService', [App\Http\Controllers\imaging_production_detailsController::class, 'searchService'])->name('search.searchService');
    Route::get('/searchCategory', [App\Http\Controllers\imaging_production_detailsController::class, 'searchCategory'])->name('search.searchCategory');

    Route::resource('distPackages', App\Http\Controllers\dist_packageController::class);

    Route::resource('detailPackages', App\Http\Controllers\detail_packageController::class);

    Route::resource('detailPackagesTemps', App\Http\Controllers\detail_packages_tempController::class);

    Route::resource('proceduresHomologators', App\Http\Controllers\procedures_homologatorController::class);
    Route::view('/prueba', 'procedures_homologators.prueba')->name('procedures_homologators.prueba');

    Route::get('/productions', [App\Http\Controllers\ProductionController::class, 'index'])->name('production.index');
    Route::get('/cextProduction', [App\Http\Controllers\ProductionController::class, 'cextProduction'])->name('production.cextProduction');
    Route::get('/imagingProduction', [App\Http\Controllers\ProductionController::class, 'imagingProduction'])->name('production.imagingProduction');
    Route::get('/surgeryProduction', [App\Http\Controllers\ProductionController::class, 'surgeryProduction'])->name('production.surgeryProduction');
    Route::get('/urgencyProduction', [App\Http\Controllers\ProductionController::class, 'urgencyProduction'])->name('production.urgencyProduction');
    Route::get('/billingStatistic', [App\Http\Controllers\Reports_biController::class, 'billingStatistic'])->name('production.billingStatistic');
    Route::get('/endoscopyProduction', [App\Http\Controllers\ProductionController::class, 'endoscopyProduction'])->name('production.endoscopyProduction');
    Route::get('/utriocumiProduction', [App\Http\Controllers\ProductionController::class, 'utriocumiProduction'])->name('production.utriocumiProduction');

    Route::get('/reports_bi', [App\Http\Controllers\Reports_biController::class, 'index'])->name('reportsbi.index');
    Route::get('/financial_report', [App\Http\Controllers\Reports_biController::class, 'financial_report'])->name('financialReport.index');
    Route::get('/financial_execution', [App\Http\Controllers\Reports_biController::class, 'financial_execution'])->name('financialExecution.index');
    Route::get('/pgp_ut_riocumi_projection', [App\Http\Controllers\Reports_biController::class, 'pgp_ut_riocumi_projection'])->name('pgpUtriocumiProjection.index');
    Route::get('/Pgp_ut_riocumi_planning', [App\Http\Controllers\Reports_biController::class, 'Pgp_ut_riocumi_planning'])->name('PgpUtRiocumiPlanning.index');
    Route::get('/occupation', [App\Http\Controllers\Reports_biController::class, 'occupation'])->name('occupation.index');
    Route::get('/reportCost', [App\Http\Controllers\Reports_biController::class, 'reportCost'])->name('reportCost.index');
    Route::get('/ponal_contract_cardiovascular', [App\Http\Controllers\Reports_biController::class, 'ponal_contract_cardiovascular'])->name('ponalContractCardiovascular.index');
    Route::get('/ut_ponal_hospital_emergency_contract', [App\Http\Controllers\Reports_biController::class, 'ut_ponal_hospital_emergency_contract'])->name('utPonalHospitalEmergencyContract.index');

    Route::get('/decrypt/{encryptedUrl}', [App\Http\Controllers\EncryptionController::class, 'decrypt'])->name('decrypt');
    
    Route::resource('logDiferentialRates', App\Http\Controllers\log_diferential_ratesController::class);
    
    
    Route::resource('logUnitCosts', App\Http\Controllers\log_unit_costController::class);
    
    
    Route::resource('logUnitCosts', App\Http\Controllers\log_unit_costController::class);
    
    
    Route::resource('logUnitCosts', App\Http\Controllers\log_unit_costController::class);
    
    
    Route::resource('logDetailsUnitCosts', App\Http\Controllers\log_details_unitCostController::class);
    
    
    Route::resource('logImagingProductionDetails', App\Http\Controllers\log_imaging_production_detailController::class);
    
    
    Route::resource('logCextDetails', App\Http\Controllers\log_cext_detailsController::class);
    
    
    Route::resource('logAccommodationCosts', App\Http\Controllers\log_accommodation_costController::class);
    
    
    Route::resource('logCumiLabRates', App\Http\Controllers\log_cumi_lab_rateController::class);
    
    
    Route::resource('logPatologies', App\Http\Controllers\log_patologyController::class);
    
    
    Route::resource('logBloodBanks', App\Http\Controllers\log_blood_bankController::class);
    
    
    Route::resource('logAmbulanceCosts', App\Http\Controllers\log_ambulance_costController::class);

    Route::resource('userEmployees', App\Http\Controllers\user_employeeController::class);
    Route::get('/createUsers', [App\Http\Controllers\user_employeeController::class, 'createUsers'])->name('get.createUsers');
    
    Route::resource('presenters', App\Http\Controllers\presenterController::class);
    Route::get('/pending', [App\Http\Controllers\presenterController::class, 'pending'])->name('pending.approved');
    
    Route::resource('standAssistances', App\Http\Controllers\stand_assistanceController::class);
    Route::get('/qrcode_scan', [App\Http\Controllers\stand_assistanceController::class, 'qrcode_scan'])->name('qrcode_scan.index');
    Route::get('/viewer', [App\Http\Controllers\stand_assistanceController::class, 'viewer'])->name('viewer.index');
});








