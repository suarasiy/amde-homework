{{-- <div class="main-card" wire:poll."{{ $ex }}"="get_refreshed_data"> --}}
<div class="main-card" wire:poll.{{ $auto_update_options['interval'] }}="get_refreshed_data">
    {{-- testing purposes --}}
    {{-- <pre style="color: white;">
        {{ print_r($pagination_options) }}
    </pre>
    <pre style="color: white">
        {{ print_r($data) }}
    </pre> --}}
    {{-- <p style="color: white;">{{ now() }}</p> --}}
    {{-- <button type="button" wire:click="$emit('testing')">Add increment</button>
    <p style="color: white;">{{ $count }}</p> --}}
    {{-- <p style="color: white;">{{ dd($data) }}</p> --}}
    @foreach ($data as $data)
        <div class="card">
            {{-- card banner / thumbnail --}}
            <div class="card__img-container">
                <img src="https://static.zerochan.net/Shiina.Mashiro.full.1607930.jpg" alt="sample image">
            </div>
            {{-- basic information: card title, label, subtitle, avatar_list, etc... --}}
            <div class="card__metadata">
                <span class="tag on-broadcast">Broadcast started: 28 mins ago.</span>
                <h1>{{ $data['title'] }}</h1>
                <time datetime="2022-12-15 08:00">{{ $data['time'] }}</time>
                <div class="avatar-list">
                    <img src="https://static.zerochan.net/Shiina.Mashiro.full.1607930.jpg" alt="sample image">
                    <img src="https://static.zerochan.net/Shiina.Mashiro.full.1607930.jpg" alt="sample image">
                    <img src="https://static.zerochan.net/Shiina.Mashiro.full.1607930.jpg" alt="sample image">
                    <p class="summary">+ {{ $data['total_spectators'] }} spectators</p>
                </div>
            </div>
            {{-- card action --}}
            <div class="card__action">
                <button class="primary" type="button">REQUEST JOIN</button>
                <button class="secondary" type="button">SCHEDULE</button>
            </div>
        </div>
    @endforeach
</div>

{{-- @push('custom-scripts')
    <script>
        Livewire.on('testing', () => {
            alert('Increment has fired!');
        })
    </script>
@endpush --}}
