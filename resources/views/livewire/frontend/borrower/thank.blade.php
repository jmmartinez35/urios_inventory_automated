<div>
    <div class="d-flex flex-column flex-md-row align-items-center gap-2 mt-3">
        @if ($details->status == 0)
            <button type="button" data-bs-toggle="modal" data-bs-target="#frontCancel"
                class="btn btn-sm bg-warning text-white w-100 w-md-auto">
                Cancel Borrow
            </button>
        @endif
        <a href="{{ route('myaccount.borrowed') }}" class="btn btn-sm btn-outline-secondary w-100 w-md-auto">
            Go Back
        </a>
    </div>
    

    <div wire:ignore.self class="modal fade" role="dialog" id="frontCancel" tabindex="-1"
        aria-labelledby="cancelBorrowModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cancelBorrowModalLabel">Cancel Borrow Request?</h1>
                </div>
                <div class="modal-body">
                    <h6 class="text-danger">Are you sure you want to cancel this borrowing request?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" wire:click="cancelBorrow" class="btn btn-danger">
                        Yes
                        <span wire:loading wire:target="cancelBorrow">Canceling...</span>
                    </button>
                </div>
            </div>

        </div>
    </div>

</div>
