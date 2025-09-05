@php
    $toastType = session('success')
        ? 'success'
        : (session('error')
            ? 'danger'
            : (session('warning')
                ? 'warning'
                : (session('info')
                    ? 'info'
                    : null)));

    $toastMessage = session($toastType === 'danger' ? 'error' : $toastType);
@endphp

@if ($toastType && $toastMessage)
    <div class="position-fixed top-0 end-0 p-3" style="top: 80px; z-index: 1080">
        <div id="liveToast" class="toast align-items-center text-white bg-{{ $toastType }} border-0 show" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ $toastMessage }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif
