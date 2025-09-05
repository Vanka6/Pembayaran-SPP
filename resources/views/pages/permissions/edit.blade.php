@extends('layouts.app')

@section('title', 'Edit Permission')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('user-management.permissions.index') }}">Manajemen Users</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Permission</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('user-management.permissions.update', ['permission' => $permission->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <x-input id="name" type="text" name="name" value="{{ $permission->name }}"
                            label="Permission Name" placeholder="Permission Name" required />
                        <x-textarea id="description" name="description" value="{{ $permission->description }}"
                            label="Description" placeholder="Description..." rows="5">
                            {{ old('description', $user->description ?? '') }}
                        </x-textarea>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('user-management.permissions.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
