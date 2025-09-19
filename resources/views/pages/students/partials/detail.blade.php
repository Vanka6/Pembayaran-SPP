<dl class="row">
    <dt class="col-sm-4">NIS</dt>
    <dd class="col-sm-8">{{ $student->nis }}</dd>

    <dt class="col-sm-4">Nama Lengkap</dt>
    <dd class="col-sm-8">{{ $student->fullname }}</dd>

    <dt class="col-sm-4">Tanggal Lahir</dt>
    <dd class="col-sm-8">{{ $student->formatted_date_of_birth }}</dd>

    <dt class="col-sm-4">Jenis Kelamin</dt>
    <dd class="col-sm-8">{{ $student->gender->label() }}</dd>

    <dt class="col-sm-4">No. HP</dt>
    <dd class="col-sm-8">{{ $student->phone_number }}</dd>

    <dt class="col-sm-4">Alamat</dt>
    <dd class="col-sm-8">{{ $student->address }}</dd>
</dl>
