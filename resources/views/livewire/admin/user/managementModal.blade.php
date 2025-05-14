

<div wire:ignore.self class="modal fade" role="dialog" id="userDeleteModal" tabindex="-1"
    aria-labelledby="deleteCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog ">

        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteCategoryModalLabel">Delete User?</h1>
            </div>
            <div class="modal-body">
                <h6 class="text-danger">Deleting this account will permanently remove the profile, personal settings,
                    and all other related information. Once this account is deleted, it cannot
                    be unable to log back in.


                    If you understand and agree to the above statement and would still like to delete this account,
                    than click below.</h6>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click="userDelete" class="btn btn-danger">

                    <div wire:loading.remove>Delete</div>
                    <span wire:loading wire:target="userDelete">Delete...</span>

                </button>
            </div>
        </div>

    </div>
</div>

<div wire:ignore.self class="modal fade" role="dialog" id="userEditModal" tabindex="-1"
    aria-labelledby="deleteCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog ">
        <form wire:submit.prevent="saveLogindetails">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteCategoryModalLabel">Edit User?</h1>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Username <span class="text-danger">*</span></label>
                        <input type="text" wire:model="username" class="form-control" id="username">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Email</label>
                        <input type="text" wire:model="email" class="form-control" id="email" >
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                    <hr>
                    Change Password
                  
                    <div class="mb-3">
                        <label for="firstname" class="form-label">New Password <span
                                class="text-danger">*</span></label>
                        <input type="password" wire:model="password" class="form-control" id="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">

                        <div wire:loading.remove>Save Change</div>
                        <span wire:loading wire:target="saveLogindetails">Save Change...</span>

                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
