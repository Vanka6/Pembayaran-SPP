@extends('layouts.app')

@section('title', 'Tambah Role')

@section('content')
    <section class="pc-container">
        <div class="pc-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('user-management.roles.index') }}">Manajemen
                                        Users</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tambah Role</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Tambah Role</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('user-management.roles.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <x-input id="name" type="text" name="name" label="Role Name" placeholder="Role Name"
                            required />
                        <x-textarea id="description" name="description" label="Description" placeholder="Description..."
                            rows="5">
                            {{ old('description', $user->description ?? '') }}
                        </x-textarea>

                        @if ($permissions->isNotEmpty())
                            <div class="mb-3">
                                <label class="form-label">Permissions</label>

                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-4">
                                            <x-checkbox name="permissions" :value="$permission->name" :label="ucwords(str_replace('_', ' ', $permission->name))"
                                                :checked="in_array($permission->name, old('permissions', []))" />
                                        </div>
                                    @endforeach
                                </div>

                                @error('permissions')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('user-management.roles.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
