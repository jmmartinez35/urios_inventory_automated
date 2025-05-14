{{-- Modal Category --}}
<div wire:ignore.self class="modal fade" role="dialog" id="addCategoryModal" tabindex="-1"
    aria-labelledby="addCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <form wire:submit.prevent="saveCategory">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCategoryModalLabel">Add Category</h1>
                </div>
                <div class="modal-body">
                    @include('shared.success')
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Name</label>
                        <input type="text" wire:model="category_name" class="form-control" id="category_name">
                        @error('category_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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

<div wire:ignore.self class="modal fade" role="dialog" id="updateCategoryModal" tabindex="-1"
    aria-labelledby="updateCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog ">
        <form wire:submit.prevent="updateCategory">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateCategoryModalLabel">Update Category</h1>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="category_name_u" class="form-label">Name</label>
                        <input type="text" wire:model="category_name" class="form-control" id="category_name">
                        @error('category_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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

<div wire:ignore.self class="modal fade" role="dialog" id="deleteCategoryModal" tabindex="-1"
    aria-labelledby="deleteCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog ">
        <form wire:submit.prevent="destroyCategory">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteCategorytModalLabel">Category</h1>
                </div>
                <div class="modal-body">
                    <h6 class="text-danger">Are you sure you want to delete this category?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- Department end --}}
