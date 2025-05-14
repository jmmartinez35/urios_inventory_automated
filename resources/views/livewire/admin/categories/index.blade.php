<div class="col-xl-12 col-md-12 col-sm-6 mb-xl-0 mb-4">
    @include('shared.offline')
    <div class="card">
        @include('livewire.admin.categories.modal')
        <div class="card-body p-3">
            <h4 class="card-title">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-muted">CATEGORY MANAGEMENT</h5>
                    <button class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i
                            class="fa fa-plus-square"></i>&nbsp;ADD NEW CATEGORY</button>
                </div>
            </h4>
            <div class="table-responsived">
                <table id="datatable" class="table table-borderless">
                    <thead class="bg-gradient-primary text-white">
                        <tr>
                            <th style="width:50px">#</th>
                            <th>Name</th>
                            <th style="width:160px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $items)
                            <tr>
                                <td>{{ $items->id }}</td>
                                <td>{{ $items->name }}</td>

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
                                                    <button type="button"
                                                        wire:click="editCategory({{ $items->id }})"
                                                        data-bs-toggle="modal" data-bs-target="#updateCategoryModal"
                                                        class="btn btn-sm btn-warning "><i
                                                            class="fa fa-pencil-square-o"></i></button>
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#deleteCategoryModal"
                                                        wire:click="deleteCategory({{ $items->id }})"
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
