<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
            Swal.fire({
                title: 'Éxito',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 12000 // Tiempo en milisegundos para que la alerta desaparezca automáticamente
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error',
                text: '{{ session('error') }}',
                icon: 'error',
                timer: 12000 // Tiempo en milisegundos para que la alerta desaparezca automáticamente
            });
        @endif 
    });
</script>