{{-- some of the components of this page is using livewire, so we need to use @livewire in here --}}

{{-- extend master template --}}
@extends('layouts.master.app')

{{-- push @livewireStyles into master head --}}
@push('livewire-styles')
    @livewireStyles
@endpush

@section('body')
    <main class="app">
        <img class="logo" src="{{ asset('images/universal-constellations.png') }}" alt="Universal Constellation Logo">
        <div class="heading">
            <h1 class="title">Universal Constellations</h1>
            <p class="subtitle">You're doing great! take a break on your personal galaxy and enjoy the show~ ^^</p>
            <livewire:clock />
        </div>
        <livewire:card-list />
    </main>
@endsection

{{-- push livewire scripts into master body --}}
@push('livewire-scripts')
    @livewireScripts
    <script>
        // Livewire.on('testing', () => {
        //     alert('Increment has fired!');
        // })
    </script>
@endpush
