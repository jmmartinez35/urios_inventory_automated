<div class="table-responsived">
    <style>
        .bg-success,
        .btn-success {
            background: #3F8E4E !important;
        }
    </style>
    @include('livewire.admin.user.pendingModal')
    <table id="datatable" class="table table-borderless">
        <thead class="bg-gradient-primary text-white">
            <tr>
                <th style="width:50px">#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th style="width:160px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usersList as $list)
                <tr>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->username }}</td>
                    <td>{{ $list->email }}</td>
                    <td><span
                            class="badge bg-{{ $list->user_status == 1 ? 'warning' : 'success' }} ">{{ $list->user_status == 1 ? 'Pending' : 'Granted' }}
                    </td>

                    <td>
                        <button data-bs-toggle="modal"
                        wire:click="editLoginDetails({{ $list->id }})"
                        data-bs-target="#userEditModal" type="button"
                        class="btn btn-sm btn-success">
                        Edit
                    </button>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

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
                            <label for="firstname" class="form-label">Username <span
                                    class="text-danger">*</span></label>
                            <input type="text" wire:model="username" class="form-control" id="username">
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Email</label>
                            <input type="text" wire:model="email" class="form-control" id="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <hr>
                        Change Password
                        <hr>
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" wire:model="old_password" class="form-control" id="old_password">
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

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

</div>
