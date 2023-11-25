@extends('layouts.master.app')

@section('body')
    <main class="app">
        <img class="logo" src="{{ asset('images/universal-constellations.png') }}" alt="Universal Constellation Logo">
        <div class="heading">
            <h1 class="title">Universal Constellations</h1>
            <p class="subtitle">You're doing great! take a break on your personal galaxy and enjoy the show~ ^^</p>
        </div>
        <div class="main-wrapper">
            <nav>
                <div class="flex-row">
                    <span class="menu timer">Auto-refresh in: 7</span>
                </div>
                <div class="flex-row">
                    <button type="button" class="menu paginate left not-has-page">Previous</button>
                    <button type="button" class="menu paginate">Next</button>
                </div>
            </nav>
            <div class="main-card">
                @foreach ($dummy as $data)
                    <x-card :message="$data['message']" />
                @endforeach
            </div>
        </div>
    </main>
@endsection
