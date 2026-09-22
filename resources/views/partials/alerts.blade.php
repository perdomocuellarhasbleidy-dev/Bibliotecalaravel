<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .swal2-popup {
        font-family: "Segoe UI", Arial, sans-serif !important;
        border-radius: 18px !important;
        padding: 24px !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.18) !important;
    }
    .swal2-title {
        color: #2e2118 !important;
        font-weight: 700 !important;
        font-size: 24px !important;
    }
    .swal2-html-container {
        color: #524339 !important;
        font-size: 16px !important;
        margin-top: 10px !important;
    }
    .swal2-styled.swal2-confirm {
        background-color: #75461f !important;
        color: #ffffff !important;
        border-radius: 10px !important;
        padding: 12px 28px !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 12px rgba(117, 70, 31, 0.3) !important;
        transition: all 0.2s ease !important;
    }
    .swal2-styled.swal2-confirm:hover {
        background-color: #5c3a21 !important;
        transform: translateY(-1px);
    }
    .swal2-styled.swal2-cancel {
        background-color: #8c98a9 !important;
        color: #ffffff !important;
        border-radius: 10px !important;
        padding: 12px 24px !important;
        font-size: 15px !important;
        font-weight: 600 !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Aceptado!',
                text: {!! json_encode(session('success')) !!},
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#75461f',
                background: '#ffffff'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Atención',
                text: {!! json_encode(session('error')) !!},
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#c5252b',
                background: '#ffffff'
            });
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: {!! json_encode(session('warning')) !!},
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#d97706',
                background: '#ffffff'
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Información',
                text: {!! json_encode(session('info')) !!},
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#2563eb',
                background: '#ffffff'
            });
        @endif

        @if(session('account_created'))
            Swal.fire({
                icon: 'success',
                title: '¡Aceptado!',
                text: 'Tu cuenta ha sido creada exitosamente. Inicia sesión para continuar.',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#75461f',
                background: '#ffffff'
            });
        @endif

        @if(request('mensaje') === 'eliminado')
            Swal.fire({
                icon: 'success',
                title: '¡Aceptado!',
                text: 'Registro eliminado con éxito.',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#75461f',
                background: '#ffffff'
            });
        @endif

        // Intercept native submit confirm dialogs across forms
        document.querySelectorAll('form').forEach(function(form) {
            const onsubmitAttr = form.getAttribute('onsubmit');
            if (onsubmitAttr && onsubmitAttr.includes('confirm(')) {
                form.removeAttribute('onsubmit');
                let match = onsubmitAttr.match(/confirm\(['"](.*?)['"]\)/);
                let confirmMsg = match ? match[1] : '¿Estás seguro de realizar esta acción?';

                form.addEventListener('submit', function(e) {
                    if (form.dataset.swalApproved === 'true') return true;
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Confirmar Acción?',
                        text: confirmMsg,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#75461f',
                        cancelButtonColor: '#8c98a9',
                        confirmButtonText: 'Sí, aceptar',
                        cancelButtonText: 'Cancelar',
                        background: '#ffffff'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            form.dataset.swalApproved = 'true';
                            form.submit();
                        }
                    });
                });
            }
        });
    });
</script>
