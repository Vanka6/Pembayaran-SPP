<dl class="row">
    <dt class="col-sm-4">Nama Lengkap</dt>
    <dd class="col-sm-8">{{ $studentGuardian->fullname }}</dd>

    <dt class="col-sm-4">No. HP</dt>
    <dd class="col-sm-8">{{ $studentGuardian->phone_number ?? '-' }}</dd>

    <dt class="col-sm-4">Hubungan</dt>
    <dd class="col-sm-8">{{ $studentGuardian->relation_type->label() ?? '-' }}</dd>

    <dt class="col-sm-4">Alamat</dt>
    <dd class="col-sm-8">{{ $studentGuardian->address ?? '-' }}</dd>
</dl>

<hr>

<h6>Siswa yang Diwalikan</h6>

@if ($studentGuardian->student)
    <dl class="row">
        <dt class="col-sm-4">NIS</dt>
        <dd class="col-sm-8">{{ $studentGuardian->student->nis }}</dd>

        <dt class="col-sm-4">Nama Lengkap</dt>
        <dd class="col-sm-8">{{ $studentGuardian->student->fullname }}</dd>

        <dt class="col-sm-4">Tanggal Lahir</dt>
        <dd class="col-sm-8">{{ $studentGuardian->student->formatted_date_of_birth }}</dd>

        <dt class="col-sm-4">Jenis Kelamin</dt>
        <dd class="col-sm-8">{{ $studentGuardian->student->gender->label() }}</dd>

        <dt class="col-sm-4">No. HP</dt>
        <dd class="col-sm-8">{{ $studentGuardian->student->phone_number }}</dd>

        <dt class="col-sm-4">Alamat</dt>
        <dd class="col-sm-8">{{ $studentGuardian->student->address }}</dd>
    </dl>
@else
    <p class="text-muted">Belum terhubung dengan siswa manapun.</p>
@endif
