<div class="main-wrapper">
    <nav>
        <div class="flex-row">
            {{-- cta: toggle on-off auto-refresh data --}}
            <button wire:click="$emit('set_auto_update')" type="button" class="menu timer">Auto-refresh in:
                {{ $auto_update_options['interval'] }}
                <strong>
                    @if ($auto_update_options['refetch_data'])
                        (On)
                    @else
                        (Off)
                    @endif
                </strong>
            </button>
        </div>

        {{-- info: current page (eg. 1 of 3) --}}
        <span class="menu">Page {{ $pagination_options['current_page'] }} of
            {{ $pagination_options['total_page'] }}</span>

        {{-- cta: paginate-previous & paginate-next --}}
        <div class="flex-row">
            <button wire:click="paginate_previous" type="button" class="menu paginate left"
                {{ !$pagination_options['has_previous'] ? 'disabled' : '' }}>Previous</button>
            <button wire:click="paginate_next" type="button" class="menu paginate"
                {{ !$pagination_options['has_next'] ? 'disabled' : '' }}>Next</button>
        </div>

        {{-- ui: progress indicator (shown when auto-refresh is on) --}}
        <span class="progress {{ $auto_update_options['refetch_data'] ? 'animate' : '' }}"
            role="interval-progress"></span>
    </nav>

    {{-- container: list of card --}}
    <div class="main-card" wire:poll.{{ $auto_update_options['interval'] }}="get_refreshed_data">

        {{-- component: populate the card with dummy data --}}
        @foreach ($data as $data)
            <x-card :title="$data['title']" :type="$data['type']" :totalspectators="$data['total_spectators']" :timestamp="$data['time']" />
        @endforeach
    </div>

    @push('custom-scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('element.updated', (el, component) => {
                    // console.log(component)
                });
                Livewire.hook('message.processed', (message, component) => {
                    // console.log(component)
                })
            })
            Livewire.on('is_refreshed', () => {
                // will invoked after the data refreshed from wire:poll
            })
        </script>
    @endpush
</div>
