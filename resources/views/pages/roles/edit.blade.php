@extends('layouts.app')

@section('title', 'Edit Role')

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
                                <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Edit Role</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('user-management.roles.update', ['role' => $role->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <x-input id="name" type="text" name="name" value="{{ $role->name }}" label="Role Name"
                            placeholder="Role Name" required />
                        <x-textarea id="description" name="description" value="{{ $role->description }}" label="Description"
                            placeholder="Description..." rows="5">
                            {{ old('description', $user->description ?? '') }}
                        </x-textarea>

                        @if ($permissions->isNotEmpty())
                            <div class="mb-3">
                                <label class="form-label">Permissions</label>

                                <div class="row">
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-4">
                                            <x-checkbox name="permissions" :value="$permission->name" :label="ucwords(str_replace('_', ' ', $permission->name))"
                                                :checked="in_array(
                                                    $permission->name,
                                                    old(
                                                        'permissions',
                                                        $role->permissions->pluck('name')->toArray() ?? [],
                                                    ),
                                                )" />
                                        </div>
                                    @endforeach
                                </div>
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
