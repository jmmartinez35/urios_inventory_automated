<div class="col-xl-12 col-md-12 col-sm-6 mb-xl-0 mb-4">
    @include('shared.offline')
    <div class="card">
        @include('livewire.admin.items.modal')
        <div class="card-body p-3">
            <h4 class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-muted">ITEMS MANAGEMENT</h5>
                    <button class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addItemModal"><i
                            class="fa fa-plus-square"></i>&nbsp;ADD NEW ITEM</button>
                </div>
            </h4>
            <div class="table-responsived">
                <table id="datatable" class="table table-borderless">
                    <thead class="bg-gradient-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Timestamp</th>
                            <th style="width:160px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td> {{ $loop->index + 1 }}</td>
                                <td>
                                    <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : asset('images/not_available.jpg') }}"
                                        alt="{{ $item->name }}" class="img-thumbnail" style="max-width: 100px;">
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 120px;"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $item->name }}">
                                        {{ Str::limit($item->name, 30) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 120px;"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ $item->description }}">
                                        {{ Str::limit($item->description, 30) }}
                                    </span>
                                </td>


                                <td>
                                    {{ $item->quantity }}
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="{{ $item->category->name }}">
                                        {{ Str::limit($item->category->name, 20) }}
                                    </span>
                                </td>


                                <td>
                                    @if($editingStatus === $item->id)
                                        <select wire:model="itemStatus" class="form-select form-select-sm" wire:change="updateStatus({{ $item->id }})">
                                            <option value="0" @if($item->status == 0) selected @endif>Available</option>
                                            <option value="1" @if($item->status == 1) selected @endif>Borrowed</option>
                                            <option value="2" @if($item->status == 2) selected @endif>Damaged</option>
                                        </select>
                                    @else
                                        <span class="badge 
                                            @if ($item->status == 0) bg-success 
                                            @elseif($item->status == 1) bg-warning 
                                            @elseif($item->status == 2) bg-danger @endif"
                                            wire:click="editStatus({{ $item->id }})"
                                            style="cursor: pointer;">
                                            @if ($item->status == 0)
                                                Available
                                            @elseif($item->status == 1)
                                                Borrowed
                                            @elseif($item->status == 2)
                                                Damaged
                                            @endif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at->format('F j, Y g:i A') }}

                                </td>
                                <td>
                                    <div class="dropdown d-flex justify-content-center">
                                        <button class="btn btn-secondary btn-custom btn-sm dropdown-toggle"
                                            type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <div class="dropdown-item">
                                                <div class="d-flex align-items-center gap-3">
                                                    <button type="button" wire:click="editItem({{ $item->id }})"
                                                        data-bs-toggle="modal" data-bs-target="#updateItemModal"
                                                        class="btn btn-sm btn-warning "><i
                                                            class="fa fa-pencil-square-o"></i></button>
                                                    <button data-bs-toggle="modal" data-bs-target="#deleteItemModal"
                                                        wire:click="deleteItem({{ $item->id }})"
                                                        class="btn btn-sm btn-danger"><i
                                                            class="fa fa-trash-o"></i></button>
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
        </div>
    </div>
</div>