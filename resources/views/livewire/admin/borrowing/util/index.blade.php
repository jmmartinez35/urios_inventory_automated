<div>
    <div class="ms-md-auto pe-md-3 p-2 card mb-0 d-flex justify-content-end align-items-end">
        <div class="d-flex gap-2 mb-0">
            <button class="btn btn-primary rounded-0 mb-0" wire:navigate href="{{ route('borrowing.return') }}">
                BORROWING RETURN
            </button>
            <button class="btn btn-primary rounded-0 mb-0" wire:navigate href="{{ route('borrowing.online') }}">
                BORROWING ONLINE
            </button>
            <button class="btn btn-primary rounded-0 mb-0 d-none" wire:navigate href="{{ route('borrowing.walk-in') }}">
                BORROWING WALK-IN
            </button>
            <button class="btn btn-primary rounded-0 mb-0 " wire:navigate href="{{ route('dashboard') }}">
                INVENTORY
            </button>
        </div>
    </div>

    <hr class="mt-0">
</div>
