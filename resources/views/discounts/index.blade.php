@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Diskon Tersedia</h1>

        <div class="row">
            @foreach ($discounts as $discount)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        @if ($discount->banner)
                            <img src="{{ asset('storage/' . $discount->banner) }}" class="card-img-top"
                                alt="{{ $discount->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $discount->title }}</h5>
                            <p class="card-text">{{ $discount->description }}</p>
                            <p>Minimal Level: <strong>{{ $discount->min_level }}</strong></p>

                            @if (in_array($discount->id, $userClaims))
                                <button class="btn btn-secondary" disabled>Sudah Diklaim</button>
                            @elseif($user->levelOrder($user->level) < $user->levelOrder($discount->min_level))
                                <button class="btn btn-warning" disabled>Level Belum Cukup</button>
                            @else
                                <form action="{{ route('discount.claim', $discount->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-primary">Klaim Diskon</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
