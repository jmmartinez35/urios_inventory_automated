<div class="table-responsived">
    <style>
        .bg-success,
        .btn-success {
            background: #3F8E4E !important;
        }

        .bg-warning,
        .btn-warning {
            background: #F39C12 !important;
        }

        .restricted-badge {
            background-color: #D9534F;
            /* Red color for restricted */
            color: white;
            padding: 2px 5px;
            font-size: 12px;
            border-radius: 3px;
        }
    </style>

    @include('livewire.admin.user.managementModal')

    <table id="datatable" class="table table-borderless">
        <thead class="bg-gradient-primary text-white">
            <tr>
                <th style="width:50px">#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>User Type</th>
                <th style="width:160px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usersList as $list)
                <tr>
                    <td>{{ $list->id }}</td>
                    <td>{{ $list->username }}</td>
                    <td>{{ $list->email }}</td>
                    <td>
                        @if ($editingStatus === $list->id)
                            <select wire:model="itemStatus" class="form-select form-select-sm"
                                wire:change="updateStatus({{ $list->id }})">
                                <!-- Only allow Granted (0) and Restricted (2) for editing -->
                                <option value="0" @if ($list->user_status == 0) selected @endif>Granted</option>
                                <option value="2" @if ($list->user_status == 2) selected @endif>Restricted
                                </option>
                            </select>
                        @else
                            <span
                                class="badge 
                                @if ($list->user_status == 0) bg-success 
                                @elseif($list->user_status == 1) bg-warning 
                                @elseif($list->user_status == 2) bg-danger @endif"
                                wire:click="editStatus({{ $list->id }})" style="cursor: pointer;">
                                @if ($list->user_status == 0)
                                    Granted
                                @elseif($list->user_status == 1)
                                    Pending
                                @elseif($list->user_status == 2)
                                    Restricted
                                @endif
                            </span>
                        @endif

                        @if ($list->user_status == 2)
                            @if ($list->restricted_until && \Carbon\Carbon::parse($list->restricted_until)->isFuture())
                                <span class="restricted-badge">Restricted Until:
                                    {{ \Carbon\Carbon::parse($list->restricted_until)->format('Y-m-d') }}</span>
                            @elseif ($list->restricted_until && \Carbon\Carbon::parse($list->restricted_until)->isPast())
                                <span class="restricted-badge">Restriction Expired On:
                                    {{ \Carbon\Carbon::parse($list->restricted_until)->format('Y-m-d') }}</span>
                            @else
                                <span class="restricted-badge">Permanently Restricted</span>
                            @endif
                        @endif

                    </td>
                    <td>{{ $list->userDetail?->position }}</td>
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
                                        <button data-bs-toggle="modal"
                                            wire:click="editLoginDetails({{ $list->id }})"
                                            data-bs-target="#userEditModal" type="button"
                                            class="btn btn-sm btn-success">
                                            Edit
                                        </button>
                                        <button data-bs-toggle="modal" wire:click="userID({{ $list->id }})"
                                            data-bs-target="#userDeleteModal" type="button"
                                            class="btn btn-sm btn-danger">
                                            Delete
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
