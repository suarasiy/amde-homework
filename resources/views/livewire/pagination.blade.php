<div class="flex-row">
    <button wire:click="$emit('paginate_previous')" type="button"
        class="menu paginate left not-has-page">Previous</button>
    <button wire:click="$emit('paginate_next')" type="button" class="menu paginate">Next</button>
</div>
