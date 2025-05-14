<div wire:ignore.self class="modal fade" role="dialog" id="userAModal" tabindex="-1"
    aria-labelledby="deleteCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog ">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteCategoryModalLabel">Approved User?</h1>
            </div>
            <div class="modal-body">
                <h6 class="text-danger">Are you sure you want to approved this user?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary"
                    data-bs-dismiss="modal">No</button>
                <button type="button" wire:click="userApproved" class="btn btn-info">

                    <div wire:loading.remove>Approved</div>
                    <span wire:loading wire:target="userApproved">Approving...</span>

                </button>
            </div>
        </div>

    </div>
</div>

<div wire:ignore.self class="modal fade" role="dialog" id="userDModal" tabindex="-1"
    aria-labelledby="deleteCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog ">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteCategoryModalLabel">Declined User?</h1>
            </div>
            <div class="modal-body">
                <h6 class="text-danger">Are you sure you want to declined this user?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary"
                    data-bs-dismiss="modal">No</button>
                <button type="button" wire:click=userDeclined" class="btn btn-danger">

                    <div wire:loading.remove>Declined</div>
                    <span wire:loading wire:target="userDeclined">Declined...</span>

                </button>
            </div>
        </div>

    </div>
</div>
