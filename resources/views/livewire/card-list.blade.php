<div class="main-wrapper">
    {{-- sticky top: navigation --}}
    <nav>
        <div class="flex-row">
            {{-- cta: toggle on-off auto-refresh data --}}
            <button wire:click="$emit('set_auto_update')" type="button" class="menu timer">Auto-refresh in:
                {{ $auto_update_options['interval'] }}
                <strong>
                    @if ($auto_update_options['refetch_data'])
                        (Toggle On)
                    @else
                        (Toggle Off)
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
        @foreach ($paginated_data as $data)
            <x-card :thumbnail="$data['thumbnail']" :title="$data['title']" :type="$data['type']" :totalspectators="$data['total_spectators']" :timestamp="$data['time']"
                :spectators="$data['spectators']" :isdummy="$data['is_dummy']" />
        @endforeach
    </div>

    {{-- action float: add dummy --}}
    <div class="float-actions">
        <button wire:click="push_dummy_data(false)" type="button">Push Dummy</button>
        <button wire:click="shuffle_current_data" type="button">Shuffle</button>
        <button wire:click="push_dummy_data(true)" type="button">Push & Shuffle</button>
    </div>

    @push('custom-scripts')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const toast = document.querySelector('[role=toast]');
                Livewire.hook('element.updated', (el, component) => {
                    // console.log(component)
                });
                Livewire.hook('message.processed', (message, component) => {
                    // console.log(component)
                })
                window.addEventListener('is_refreshed', (event) => {
                    if (event.detail.data.refetch_data) {
                        toast.classList.add('animate')
                        setTimeout(() => {
                            toast.classList.remove('animate')

                            // 2500 is the duration of css animation
                        }, 2500);
                    }
                })
            })
        </script>
    @endpush
</div>
