<div class="table-responsived">
    <style>
        .bg-success, .btn-success {
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
                        <div class="dropdown d-flex justify-content-center">
                            <button class="btn btn-secondary btn-custom btn-sm dropdown-toggle" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <div class="dropdown-item">
                                    <div class="d-flex align-items-center gap-3">
                                        <button data-bs-toggle="modal" wire:click="userID({{ $list->id }})"
                                            data-bs-target="#userAModal" type="button" class="btn btn-sm btn-success">
                                            Approved
                                        </button>
                                        <button data-bs-toggle="modal" wire:click="userID({{ $list->id }})"
                                            data-bs-target="#userDModal" type="button" class="btn btn-sm btn-danger">
                                            Declined
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
