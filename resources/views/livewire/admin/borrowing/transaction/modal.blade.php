<div wire:ignore.self class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <form wire:submit.prevent="declinedBorrowing"> <!-- Change to declinedBorrowing -->
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Decline Borrowing</h1>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="remarks_msg" class="form-label">Remarks (Optional)</label>
                        <textarea class="form-control" wire:model.defer="remarks_msg" id="remarks_msg" cols="5" rows="2" placeholder="Enter reason for decline (optional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetData">Close</button>
                    <button type="submit" class="btn btn-danger">Decline Borrowing</button>
                </div>
            </div>
        </form>
    </div>
</div>
