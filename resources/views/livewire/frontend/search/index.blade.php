<div class="search-full">
    <form wire:submit.prevent="search" class="search-full">
        <div class="input-group">
            <span class="input-group-text">
                <i data-feather="search" class="font-light"></i>
            </span>
            <input type="text" wire:model="query" class="form-control search-type"
                placeholder="Search here..">
            <span class="input-group-text close-search" wire:click="$set('query', '')">
                <i data-feather="x" class="font-light"></i>
            </span>
        </div>
    </form>
</div>
