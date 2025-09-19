<div class="col-sm-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0">{{ $title ?? 'Data Table' }}</h4>
                @isset($subtitle)
                    <small>{{ $subtitle }}</small>
                @endisset
            </div>
            <div>
                {{ $plotActions ?? '' }}
                {{ $headerActions ?? '' }} {{-- Slot tambahan untuk tombol --}}
            </div>
        </div>

        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="{{ $id ?? 'datatable' }}" class="table table-striped table-hover table-bordered nowrap">
                    <thead>
                        <tr>
                            @foreach ($columns as $col)
                                <th>{{ $col }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{ $slot }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
