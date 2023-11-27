<div class="card {{ $isdummy ? 'dummy' : '' }}">
    {{-- card banner / thumbnail --}}
    <div class="card__img-container">
        <img src="{{ $thumbnail }}" alt="sample image">
    </div>
    {{-- basic information: card title, label, subtitle, avatar_list, etc... --}}
    <div class="card__metadata">

        {{-- render status type: 'started' | 'ended' | 'soon' --}}
        @switch($type)
            @case('started')
                <span class="tag on-broadcast">Broadcast started 28 mins ago.</span>
            @break

            @case('ended')
                <span class="tag on-ended">Ended 5 mins ago.</span>
            @break

            @default
                <span class="tag on-soon">Begin in 5 mins.</span>
        @endswitch

        {{-- info: title --}}
        <h1>{{ $title }}</h1>

        {{-- info: timestamp --}}
        <time datetime="{{ $timestamp }}">{{ $timestamp }}</time>

        {{-- avatar-list: spectators --}}
        <div class="avatar-list">
            @foreach ($spectators as $spectator)
                <img src="{{ $spectator }}" alt="sample image">
            @endforeach
            <p class="summary">+ {{ $totalspectators }} spectators</p>
        </div>
    </div>

    {{-- action: 'request join' | 'schedule' --}}
    <div class="card__action">
        <button class="primary" type="button">REQUEST JOIN</button>
        <button class="secondary" type="button">SCHEDULE</button>
    </div>
</div>
