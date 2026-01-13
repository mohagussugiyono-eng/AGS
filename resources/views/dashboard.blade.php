@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-4">Dashboard</h3>

        <div class="row">
            {{-- Profil User --}}
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white">
                        Profil User
                    </div>
                    <div class="card-body">
                        <p><strong>Nama</strong> : {{ $user->name }}</p>
                        <p><strong>Email</strong> : {{ $user->email }}</p>
                        <p><strong>Bergabung</strong> : {{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            {{-- Poin User --}}
            <div class="col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        Poin & Level
                    </div>
                    <div class="card-body text-center">
                        <h1 class="fw-bold">{{ number_format($user->points) }}</h1>
                        <p>Total Poin</p>

                        <span class="badge bg-{{ $user->point_badge }} px-4 py-2">
                            {{ $user->point_class }}
                        </span>

                        <hr>

                        <small class="text-muted">
                            Bronze (0–10K) |
                            Silver (10K–50K) |
                            Gold (50K–100K) |
                            Platinum (&gt;100K)
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
