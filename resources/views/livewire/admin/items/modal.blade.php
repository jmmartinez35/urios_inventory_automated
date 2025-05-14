<div wire:ignore.self class="modal fade " role="dialog" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form wire:submit.prevent="saveItem" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addItemModalLabel">Add Item</h1>
                </div>
                <div class="modal-body">
                    @include('shared.success')
                    <div class="row">
                        <div class="col-lg-12 row mb-0">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" wire:model="item_name" class="form-control" id="item_name">
                                    @error('item_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Description</label>
                                    <textarea class="form-control" wire:model="item_description" id="item_description" cols="5" rows="1"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12 row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Category</label>
                                    <select wire:model="category_id" class="form-control" id="category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Quantity</label>
                                    <input type="number" min="1" wire:model="item_qty" class="form-control"
                                        id="item_qty">
                                    @error('item_qty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Purchase Date</label>
                                    <input type="date" wire:model="item_purchase" class="form-control"
                                        id="item_purchase">
                                    @error('item_purchase')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Warranty Expired</label>
                                    <input type="date" wire:model="item_warranty" class="form-control"
                                        id="item_warranty">
                                    @error('item_warranty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Purchase Price</label>
                                    <input type="number" step="0.01" min="0" wire:model="item_price"
                                        class="form-control" id="item_price">
                                    @error('item_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="item_image" class="form-label">Image</label>

                                <input type="file" class="form-control" id="fileInput" wire:model="item_image"
                                    accept="image/*">

                                <!-- Show Preview with Livewire -->
                                @if ($item_image)
                                    <img id="imagePreview" class="img-thumbnail" src="{{ $item_image->temporaryUrl() }}"
                                        alt="Image Preview" style="max-width: 100px; margin-top: 10px;">
                                @endif
                            </div>

                            @error('item_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div wire:ignore.self class="modal fade" role="dialog" id="updateItemModal" tabindex="-1"
    aria-labelledby="updateCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form wire:submit.prevent="updateItem" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateCategoryModalLabel">Show / Update Item</h1>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 d-flex align-items-center gap-3">
                            <label for="" class="form-label">BARCODE: </label>
                            <img class="border p-2" id="barcodeImage"
                                src="data:image/png;base64,{{ DNS1D::getBarcodePNG($imageBarcode, 'C39') }}"
                                alt="barcode" />
                            <button type="button" class="btn btn-success btn-sm mt-3"
                                wire:click="downloadBarcode">Save
                                Barcode</button>
                            <hr>
                        </div>
                        <div class="col-lg-12 row mb-0">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" wire:model="item_name" class="form-control"
                                        id="item_name">
                                    @error('item_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Description</label>
                                    <textarea class="form-control" wire:model="item_description" id="item_description" cols="5" rows="1"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12 row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Category</label>
                                    <select wire:model="category_id" class="form-control" id="category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Quantity</label>
                                    <input type="number" min="1" wire:model="item_qty" class="form-control"
                                        id="item_qty">
                                    @error('item_qty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Purchase Date</label>
                                    <input type="date" wire:model="item_purchase" class="form-control"
                                        id="item_purchase">
                                    @error('item_purchase')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Warranty Expired</label>
                                    <input type="date" wire:model="item_warranty" class="form-control"
                                        id="item_warranty">
                                    @error('item_warranty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Purchase Price</label>
                                    <input type="number" step="0.01" min="0" wire:model="item_price"
                                        class="form-control" id="item_price">
                                    @error('item_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label for="category_name" class="form-label">Image</label>

                            <input type="file" wire:model="item_imageu" class="form-control" accept="image/*">
                            <div wire:loading wire:target="item_imageu">
                                <p>Uploading...</p>
                            </div>


                            @if ($item_imageu)
                                <img class="img-thumbnail" src="{{ $item_imageu->temporaryUrl() }}"
                                    alt="Image Preview" style="max-width: 100px; margin-top: 10px;">
                            @elseif ($item_imageu_tmp)
                                <img class="img-thumbnail" src="{{ asset('storage/' . $item_imageu_tmp) }}"
                                    alt="Existing Image" style="max-width: 100px; margin-top: 10px;">
                            @else
                                <img class="img-thumbnail" src="{{ asset('images/not_available.jpg') }}"
                                    alt="No Image Available" style="max-width: 100px; margin-top: 10px;">
                            @endif

                            @error('item_imageu')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Item Modal -->
<div wire:ignore.self class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteItemModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header  ">
                <h5 class="modal-title" id="deleteItemModalLabel">Delete Item</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button wire:click="destroyItem" type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    function downloadBarcode() {
        var barcode = document.getElementById("barcodeImage").src;
        var link = document.createElement("a");
        link.href = barcode;
        link.download = "barcode.png";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
