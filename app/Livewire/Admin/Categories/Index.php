<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public $category_name, $c_id;

    protected function rules()
    {
        return [
            'category_name' => 'required|unique:categories,name|min:3',
        ];
    }

    public function render()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.categories.index', ['categories' => $categories]);
    }

    public function saveCategory()
    {
        $validatedData = $this->validate();

        $existingDepartment = Category::where('name', $validatedData['category_name'])->exists();

        if ($existingDepartment) {
            //  already exists, show an error message or handle it as needed
            $this->dispatch('saveModal', status: 'warning', position: 'top', message: 'Category already exist.');
            return;
        }

        Category::create([
            'name' => $validatedData['category_name'],
        ]);
        // Reset the input fields
        $this->resetInput();
        $this->dispatch('saveModal', status: 'success',  position: 'top', message: 'Category save successfully.');
    }

    public function updateCategory()
    {
        $validatedData = $this->validate();

        Category::where('id', $this->c_id)->update([
            'name' => $validatedData['category_name']
        ]);
        $this->dispatch('updateModal', status: 'success',  position: 'top', message: 'Category updated successfully.');
    }

    public function editCategory(int $id)
    {
        $category = Category::find($id);
        if ($category) {
            $this->c_id = $category->id;
            $this->category_name = $category->name;
            $this->dispatch('editModal');
        } else {
            $this->redirect('/admin/category');
        }
    }

    public function deleteCategory(int $id)
    {
        $this->c_id = $id;
        $this->dispatch('editModal');
    }

    public function destroyCategory()
    {

        $checker = Category::find($this->c_id);

        if (!$checker) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'Category not found!', modal: '#deleteCategoryModal');
            return;
        }

        $count = Category::count();
        if ($count === 1) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'You can only edit, but you cannot delete the only remaining category.', modal: '#deleteCategoryModal');
            return;
        }

        // Delete the category
        $checker->delete();

        $this->dispatch('destroyModal', status: 'warning',  position: 'top', message: 'Category delete successfully.', modal: '#deleteCategoryModal');
    }

    public function closeModal()
    {
        $this->resetInput();
        $this->dispatch('closeModal');
    }

    private function resetInput()
    {
        $this->reset(['category_name']);
    }
}
