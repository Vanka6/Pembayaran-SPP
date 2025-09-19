@props([
    'id', // id modal (harus unik per record)
    'title' => '', // judul modal
    'buttonClass' => 'btn btn-sm btn-success me-1',
    'buttonText' => 'Detail',
])

<!-- Modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot }} {{-- isi detail dipanggil dari luar --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Trigger Button -->
<button type="button" class="{{ $buttonClass }}" data-bs-toggle="modal" data-bs-target="#{{ $id }}">
    {{ $buttonText }}
</button>
