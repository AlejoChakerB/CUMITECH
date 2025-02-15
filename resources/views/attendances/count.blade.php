@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <h3 class="page__heading"></h3>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none border-0">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-4 col-xl-3">
                                    <a href="{{ route('employes.index') }}" style="color: black;">
                                        <div class="card card-outline card-green order-card text-center">
                                            <div class="card-block">
                                                <h5>Total empleados</h5>
                                                @php
                                                use App\Models\Employe;
                                                $cant_emplo = Employe::where('unit', '!=', 'Deshabilitado')->count();
                                                @endphp
                                                <h2 class="text-center"><i
                                                        class="fa fa-users f-left"></i><span>{{$cant_emplo}}</span></h2>
                                                <br>
                                            </div>
                                        </div>
                                    </a>
                                </div>
    
                                <div class="col-md-4 col-xl-3">
                                    <div class="card card-outline card-info order-card text-center">
                                        <div class="card-block">
                                            <h5>Administrativos</h5>
                                            @php
    
                                            $cant_employes = Employe::where(function($query) {
                                                $query->where('employes.unit', '=','Administrativo')
                                                    ->orWhere('employes.unit', '=','Administrativo asistencial');
                                            })->count();
                                            @endphp
                                            <h2 class="text-center"><i
                                                    class="fa fa-user-tie f-left"></i><span>{{$cant_employes}}</span>
                                            </h2>
                                            <br>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-4 col-xl-3">
                                    <div class="card card-outline card-green order-card text-center">
                                        <div class="card-block">
                                            <h5>Asistenciales</h5>
                                            @php
                                            $cant_employe = Employe::where('unit', 'Asistencial')->count();
                                            @endphp
                                            <h2 class="text-center"><i
                                                    class="fa fa-user-nurse f-left"></i><span>{{$cant_employe}}</span></h2>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-4 col-xl-3">
                                    <a href="{{ route('attendanceReport.attendanceToday') }}" style="color: black;">
                                        <div class="card card-outline card-info order-card text-center">
                                            <div class="card-block">
                                                <h5>Asistencias hoy</h5>
                                                @php
                                                use App\Models\Attendance;
                                                use Carbon\Carbon;
                                                $today = Carbon::now();
                                                $cant_attendances = Attendance::where('workday',
                                                $today->format('Y-m-d'))
                                                ->where('aentry_time', '!=', '00:00:00')->count();
                                                @endphp
                                                <h2 class="text-center"><i
                                                        class="fa fa-user-clock f-left"></i><span>{{$cant_attendances}}</span>
                                                </h2>
                                                <br>
                                            </div>
                                        </div>
                                    </a>
                                </div>
    
                                <div class="col-md-4 col-xl-3">
                                    <div class="card card-outline card-green order-card text-center">
                                        <div class="card-block">
                                            <a href="{{ route('attendanceReport.workingAndFinished') }}" style="color: black;">
                                                <h5>Trabajando</h5>
                                                @php
                                                $today = Carbon::now();
                                                $cant_attendance = Attendance::where('adeparture_time', null)
                                                ->where('workday', $today->format('Y-m-d'))->count();
                                                @endphp
                                                <h2 class="text-center"><i
                                                        class="fa fa-user-clock f-left"></i><span>{{$cant_attendance}}</span>
                                                </h2>
                                                <br>
                                            </a>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-4 col-xl-3">
                                    <div class="card card-outline card-info   order-card text-center">
                                        <div class="card-block">
                                            <a href="{{ route('attendanceReport.finished') }}" style="color: black;">
                                                <h5>Turno acabado</h5>
                                                @php
                                                $cant_attendance = Attendance::whereNotNull('adeparture_time')
                                                ->where('workday', $today->format('Y-m-d'))
                                                ->where('adeparture_time', '!=', '00:00:00')->count();
                                                @endphp
                                                <h2 class="text-center"><i
                                                        class="fa fa-user-clock f-left"></i><span>{{$cant_attendance}}</span>
                                                </h2>
                                                <br>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-4 col-xl-3">
                                    <div class="card card-outline card-danger order-card text-center mx-auto">
                                        <div class="card-block">
                                            <h5>Llegada tarde</h5>
                                           
                                            <br>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-4 col-xl-3">
                                    <div class="card card-outline card-danger   order-card text-center mx-auto">
                                        <div class="card-block">
                                            <h5>Salida temprano</h5>
                                            
                                            <br>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-4 col-xl-3">
                                    <div class="card card-outline card-danger   order-card text-center mx-auto">
                                        <div class="card-block">
                                            <a href="{{ route('attendanceTime.attendanceNot') }}" style="color: black">
                                                <h5>Sin asistencia</h5>
                                                @php
                                                $today = Carbon::now();
                                                    $cant_no_attendances = Attendance::where('workday',
                                                    $today->format('Y-m-d'))
                                                    ->where('aentry_time', '00:00:00')
                                                    ->where('adeparture_time', '00:00:00')
                                                    ->whereColumn('aentry_time', '=', 'adeparture_time')->count();
                                                @endphp
                                                <h2 class="text-center"><i
                                                        class="fa fa-calendar-times f-left"></i><span>{{$cant_no_attendances}}</span>
                                                </h2>
                                                <br>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
</section>
@endsection