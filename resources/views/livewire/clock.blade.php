<time datetime="{{ now() }}"
    wire:poll.1s>{{ \Carbon\Carbon::parse(now())->isoFormat('dddd ● MMM D, Y ● hh:mm:ss A') }}
</time>
