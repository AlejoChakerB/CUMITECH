<li>
    <a href="{{ route('home') }}" class="nav-link-inside {{ Request::is('home*') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
</li>

@can('roles')
<li>
    <a href="{{ route('admin.roles.index') }}"
        class="nav-link-inside {{ Request::is('admin/roles*') ? 'active' : '' }}">
        <i class="fas fa-user-astronaut"></i>
        <span>Roles</span>
    </a>
</li>
@endcan

@can('view_user')
<li>
    <a href="{{ route('admin.users.index') }}"
        class="nav-link-inside {{ Request::is('admin/users*') ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        <span>Usuarios</span>
    </a>
</li>
@endcan

@can('view_userEmployees')
<li>
    <a href="{{ route('userEmployees.index') }}" class="nav-link-inside {{ Request::is('userEmployees*') ? 'active' : '' }}">
        <i class="fas fa-user-friends"></i>
        <span>Usuario-Empleado</span>
    </a>
</li>
@endcan

<!-- Sidebar -->
@canany(['view_employes', 'view_contracts'])
<li class="list_item" style="display: block">
    <div class="list_button_click">
        <a href="#">
            <i class="fas fa-user-tie"></i>
            <span>Personal</span>
            <i class="fas fa-angle-left right"></i>
        </a>
    </div>
    <ul class="list_show">
        <li class="list_inside">
            @can('view_employes')
            <a href="{{ route('employes.index') }}"
                class="nav-link-inside {{ Request::is('employes*') ? 'active' : '' }}">
                <i class="fas fa-id-badge"></i>
                <span>Empleados</span>
            </a>
            @endcan
        </li>
        <li class="list_inside">
            @can('view_contracts')
            <a href="{{ route('contracts.index') }}"
                class="nav-link-inside {{ Request::is('contracts*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Contratos</span>
            </a>
            @endcan
        </li>
    </ul>
</li>
@endcanany
<!-- Fin Sidebar -->

<!-- Sidebar -->
@canany(['view_calendars', 'view_attendances', 'view_logistic'])
<li class="list_item" style="display: block">
    <div class="list_button_click">
        <a>
            <i class="fas fa-hourglass-half"></i>
            <span>Horario Laboral</span>
            <i class="fas fa-angle-left right"></i>
        </a>
    </div>
    <ul class="list_show">
        <li class="list_inside">
            @can('view_calendars')
            <a href="{{ route('calendars.index') }}"
                class="nav-link-inside {{ Request::is('calendars*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Calendarios</span>
            </a>
            @endcan
        </li>
        <li class="list_inside">
            @can('view_attendances')
            <a href="{{ route('attendances.index') }}"
                class="nav-link-inside {{ Request::is('attendances*') ? 'active' : '' }}">
                <i class="fas fa-fingerprint"></i>
                <span>Asistencias</span>
            </a>
            @endcan
        </li>
        <li class="list_inside">
            @can('view_logistic')
            <a href="{{ route('attendanceReport.logistic') }}"
                class="nav-link-inside {{ Route::currentRouteName() === 'attendanceReport.logistic' ? 'active' : '' }}">
                <i class="fas fa-tree"></i>
                <span>Logistica</span>
            </a>
            @endcan
        </li>
        <li class="list_inside">
            @can('view_user')
            <a href="{{ route('control.index') }}"
                class="nav-link-inside {{ Request::is('control*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Control</span>
            </a>
            @endcan
        </li>
        <li class="list_inside">
            @can('view_user')
            <a href="{{ route('attendances.count') }}"
                class="nav-link-inside {{ Route::currentRouteName() === 'attendances.count' ? 'active' : '' }}">
                <i class="fas fa-info"></i>
                <span>Contadores</span>
            </a>
            @endcan
        </li>
    </ul>
</li>
@endcanany
<!-- Fin Sidebar -->

<!-- Sidebar -->
@canany(['view_endowments', 'view_cards'])
<li class="list_item" style="display: block">
    <div class="list_button_click">
        <a class="nav-link-inside">
            <i class="fas fa-clipboard-check"></i>
            <span>Entrega</span>
            <i class="fas fa-angle-left right"></i>
        </a>
    </div>
    <ul class="list_show">
        <li class="list_inside">
            @can('view_endowments')
            <a href="{{ route('endowments.index') }}"
                class="nav-link-inside {{ Request::is('endowments*') ? 'active' : '' }}">
                <i class="fas fa-tshirt"></i>
                <span>Dotacion</span>
            </a>
            @endcan
        </li>
        <li class="list_inside">
            @can('view_cards')
            <a href="{{ route('cards.index') }}" class="nav-link-inside {{ Request::is('cards*') ? 'active' : '' }}">
                <i class="fas fa-address-card"></i>
                <span>Carnet</span>
            </a>
            @endcan
        </li>
    </ul>
</li>
@endcanany
<!-- Fin Sidebar -->


@can('view_medicines')
<li class="list_item" style="display: block">
    <div class="list_button_click">
        <a class="nav-link-inside">
            <i class="fas fa-clinic-medical"></i>
            <span>Farmacia</span>
            <i class="fas fa-angle-left right"></i>
        </a>
    </div>
    <ul class="list_show">
        <li class="nav-item">
            <a href="{{ route('medicines.index') }}"
                class="nav-link-inside {{ Request::is('medicines*') ? 'active' : '' }}">
                <i class="fas fa-capsules"></i>
                <span>Recepcion tecnica</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('medicationTemplates.index') }}"
                class="nav-link-inside {{ Request::is('medicationTemplates*') ? 'active' : '' }}">
                <i class="fas fa-file-medical"></i>
                <span>Plantilla</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('invimaRegistrations.index') }}"
                class="nav-link-inside {{ Request::is('invimaRegistrations*') ? 'active' : '' }}">
                <i class="fas fa-check"></i>
                <span>Registro invima</span>
            </a>
        </li>
    </ul>
</li>
@endcan


@can('view_costos')
<li>
    <a href="{{ route('costs.index') }}" class="nav-link-inside {{ Request::is('costs*') ? 'active' : '' }}">
        <i class="fas fa-coins"></i>
        <span>Costos</span>
    </a>
</li>
@endcan

@can('view_reportsbi')
<li>
    <a href="{{ route('reportsbi.index') }}" class="nav-link-inside {{ Request::is('reports_bi*') ? 'active' : '' }}">
        <i class="fas fa-file-contract"></i>
        <span>Reportes power bi</span>
    </a>
</li>
@endcan

@can('view_presenters')
<li>
    <a href="{{ route('presenters.index') }}" class="nav-link-inside {{ Request::is('presenters*') ? 'active' : '' }}">
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Presentadores</span>
    </a>
</li>
@endcan

@can('list_pending')
<li>
    <a href="{{ route('pending.approved') }}" class="nav-link-inside {{ Request::is('pending*') ? 'active' : '' }}">
        <i class="fas fa-user-clock"></i>
        <span>Pendientes</span>
    </a>
</li>
@endcan

@can('view_standAssistances')
<li>
    <a href="{{ route('standAssistances.index') }}" class="nav-link-inside {{ Request::is('standAssistances*') ? 'active' : '' }}">
        <i class="fas fa-user-check"></i>
        <span>Asistencias stand</span>
    </a>
</li>
@endcan

@can('scan_code')
<li>
    <a href="{{ route('qrcode_scan.index') }}" class="nav-link-inside {{ Request::is('qrcode_scan*') ? 'active' : '' }}">
        <i class="fas fa-qrcode"></i>
        <span>Escaner QR</span>
    </a>
</li>
@endcan

@can('view_viewer')
<li>
    <a href="{{ route('viewer.index') }}" class="nav-link-inside {{ Request::is('viewer*') ? 'active' : '' }}">
        <i class="fas fa-globe"></i>
        <span>Pasaporte</span>
    </a>
</li>
@endcan

<li class="nav-item">
    <a href="#" class="nav-link-inside"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>
        <span>Cerrar sesion</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>
{{-- @can('view_user')
<li class="nav-item">
    <a href="{{ route('imagingProductions.index') }}"
        class="nav-link {{ Request::is('imagingProductions*') ? 'active' : '' }}">
        <p>Imaging Productions</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('cumiLabHistorics.index') }}"
       class="nav-link {{ Request::is('cumiLabHistorics*') ? 'active' : '' }}">
       <p>Cumi Lab Historics</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('doctorsChanges.index') }}"
    class="nav-link {{ Request::is('doctorsChanges*') ? 'active' : '' }}">
    <p>Doctors Changes</p>
</a>
</li>


<li class="nav-item">
    <a href="{{ route('imagingProductionMonths.index') }}"
    class="nav-link {{ Request::is('imagingProductionMonths*') ? 'active' : '' }}">
    <p>Imaging Production Months</p>
</a>
</li>


<li class="nav-item">
    <a href="{{ route('imagingProductionDetails.index') }}"
    class="nav-link {{ Request::is('imagingProductionDetails*') ? 'active' : '' }}">
    <p>Imaging Production Details</p>
</a>
</li>


<li class="nav-item">
    <a href="{{ route('imagingProductionHourcosts.index') }}"
    class="nav-link {{ Request::is('imagingProductionHourcosts*') ? 'active' : '' }}">
    <p>Imaging Production Hourcosts</p>
</a>
</li>


<li class="nav-item">
    <a href="{{ route('imagingProductionSupplies.index') }}"
    class="nav-link {{ Request::is('imagingProductionSupplies*') ? 'active' : '' }}">
    <p>Imaging Production Supplies</p>
</a>
</li>





<li class="nav-item">
    <a href="{{ route('accommodationCosts.index') }}"
       class="nav-link {{ Request::is('accommodationCosts*') ? 'active' : '' }}">
        <p>Accommodation Costs</p>
    </a>
</li>
@endcan


<li class="nav-item">
    <a href="{{ route('cextDetails.index') }}"
       class="nav-link {{ Request::is('cextDetails*') ? 'active' : '' }}">
        <p>Cext Details</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cextHourcosts.index') }}"
       class="nav-link {{ Request::is('cextHourcosts*') ? 'active' : '' }}">
        <p>Cext Hourcosts</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('cextProductionMonths.index') }}"
       class="nav-link {{ Request::is('cextProductionMonths*') ? 'active' : '' }}">
        <p>Cext Production Months</p>
    </a>
</li> --}}

{{-- <li class="nav-item">
    <a href="{{ route('imagingProductionCupsxitems.index') }}"
    class="nav-link {{ Request::is('imagingProductionCupsxitems*') ? 'active' : '' }}">
    <p>Imaging Production Cupsxitems</p>
</a>
</li> --}}

{{-- @can('view_user')
<li class="nav-item">
    <a href="{{ route('proceduresHomologators.index') }}"
       class="nav-link {{ Request::is('proceduresHomologators*') ? 'active' : '' }}">
        <p>Procedures Homologators</p>
    </a>
</li>
@endcan --}}


{{-- <li class="nav-item">
    <a href="{{ route('logDiferentialRates.index') }}"
       class="nav-link {{ Request::is('logDiferentialRates*') ? 'active' : '' }}">
        <p>Log Diferential Rates</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('logUnitCosts.index') }}"
       class="nav-link {{ Request::is('logUnitCosts*') ? 'active' : '' }}">
        <p>Log Unit Costs</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('logDetailsUnitCosts.index') }}"
       class="nav-link {{ Request::is('logDetailsUnitCosts*') ? 'active' : '' }}">
        <p>Log Details Unit Costs</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('logImagingProductionDetails.index') }}"
       class="nav-link {{ Request::is('logImagingProductionDetails*') ? 'active' : '' }}">
        <p>Log Imaging Production Details</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('logCextDetails.index') }}"
       class="nav-link {{ Request::is('logCextDetails*') ? 'active' : '' }}">
        <p>Log Cext Details</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('logAccommodationCosts.index') }}"
       class="nav-link {{ Request::is('logAccommodationCosts*') ? 'active' : '' }}">
        <p>Log Accommodation Costs</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('logCumiLabRates.index') }}"
       class="nav-link {{ Request::is('logCumiLabRates*') ? 'active' : '' }}">
        <p>Log Cumi Lab Rates</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('logPatologies.index') }}"
       class="nav-link {{ Request::is('logPatologies*') ? 'active' : '' }}">
        <p>Log Patologies</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('logBloodBanks.index') }}"
       class="nav-link {{ Request::is('logBloodBanks*') ? 'active' : '' }}">
        <p>Log Blood Banks</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('logAmbulanceCosts.index') }}"
       class="nav-link {{ Request::is('logAmbulanceCosts*') ? 'active' : '' }}">
        <p>Log Ambulance Costs</p>
    </a>
</li>
 --}}






