@extends('wali.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <img src="{{ Auth::user()->foto ? asset('storage/profiles/' . Auth::user()->foto) : asset('storage/uploads/profiles/avatar.png') }}"
                             class="rounded-circle border shadow-sm" width="150" height="150" alt="Foto Profil">
                    </div>
                    <h4 class="fw-bold">{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between px-4">
                            <div class="text-center">
                                <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                                <p class="mt-2">{{ $user->alamat ?? 'Belum diisi' }}</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-phone fa-2x text-success"></i>
                                <p class="mt-2">{{ $user->telepon ?? 'Belum diisi' }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('wali.profiles.edit') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
