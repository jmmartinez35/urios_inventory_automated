<div wire:ignore.self class="modal fade" id="confirmMarkDoneModal" tabindex="-1" aria-labelledby="markModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <form wire:submit.prevent="completeBorrowing">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Returned Borrowing - Check Damages</h1>
                </div>
                <div class="modal-body">

                    <div class="mt-2">
                        <h6>Specify damaged/defective quantity for each item:</h6>
                        @foreach ($cartList as $cart)
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ $cart->item->name }} (Borrowed: {{ $cart->quantity }})
                                </label>
                                <input type="number" wire:model.defer="damagedQuantities.{{ $cart->item->id }}"
                                    min="0" max="{{ $cart->quantity }}" class="form-control"
                                    oninput="this.value = Math.min(this.max, Math.max(this.min, this.value));"
                                    placeholder="Enter damaged quantity (0 if none)">

                                <input type="text" wire:model.defer="damageNotes.{{ $cart->item->id }}"
                                    class="form-control mt-1"
                                    placeholder="Optional note about the damage (e.g. broken screen)">
                            </div>
                        @endforeach
                    </div>


                </div>
                <div class="modal-footer">

                    @if ($users?->user_status == 2)
                        <button type="submit" class="btn btn-secondary" wire:click="continueWithRestriction">
                            leave the restriction
                        </button>
                        <button type="submit" class="btn btn-primary" wire:click="continueRemoveRestriction">
                            remove the restriction
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    @endif

                </div>
            </div>
        </form>
    </div>
</div>
