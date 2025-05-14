<?php

namespace App\Livewire\Admin\Items;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithFileUploads;
use Milon\Barcode\DNS1D;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;

    public $imageBarcode, $imagePath, $item_name, $item_image, $item_imageu, $item_imageu_tmp, $item_price, $item_warranty, $item_purchase, $item_qty, $item_description, $category_id, $i_id;
    public $editingStatus = null;
    public $itemStatus;
    public function render()
    {
        $items = Item::orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.items.index', compact('categories', 'items'));
    }

    // Add these methods
    public function editStatus($itemId)
    {
        $this->editingStatus = $itemId;
        $item = Item::find($itemId);
        $this->itemStatus = $item->status;
    }

    public function updateStatus($itemId)
    {
        $validated = $this->validate([
            'itemStatus' => 'required|in:0,1,2',
        ]);

        $item = Item::findOrFail($itemId);
        $item->update(['status' => $this->itemStatus]);

        $this->editingStatus = null;
        $this->itemStatus = null;

        $this->dispatch('saveModal', status: 'success',  position: 'top', message: 'Item status update successfully.');
    }

    public function updatedItemImageu()
    {
        if ($this->item_imageu) {
            $this->item_imageu_tmp = null;
        }
    }
    public function saveItem()
    {
        // Validate input fields
        $validatedData = $this->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'category_id' => 'required|integer',
            'item_qty' => 'required|integer|min:1',
            'item_purchase' => 'required|date',
            'item_warranty' => 'nullable|date',
            'item_price' => 'required|numeric|min:0',
            'item_image' => 'nullable|image|max:2048',
        ]);

        // Check if item already exists in the database (prevent duplicates)
        $existingItem = Item::where('name', $this->item_name)
            ->where('category_id', $this->category_id)
            ->first();

        if ($existingItem) {
            $this->dispatch('saveModal', status: 'warning', position: 'top', message: 'Item already exists!.');
            return;
        }

        // Handle image upload
        if ($this->item_image) {
            $imagePath = $this->item_image->store('items', 'public');
        } else {
            $imagePath = null;
        }

        Item::create([
            'name' => $validatedData['item_name'],
            'description' => $validatedData['item_description'],
            'category_id' => $validatedData['category_id'],
            'quantity' => $validatedData['item_qty'],
            'purchase_date' => $validatedData['item_purchase'],
            'warranty_expiry' => $validatedData['item_warranty'],
            'purchase_price' => $validatedData['item_price'],
            'image_path' => $imagePath,
        ]);

        $this->resetInput();
        $this->dispatch('saveModal', status: 'success',  position: 'top', message: 'Item save successfully.');
    }

    public function editItem(int $id)
    {

        $item = Item::find($id);
        if ($item) {
            $this->i_id = $item->id;
            $this->item_name = $item->name;
            $this->item_description = $item->description;
            $this->category_id = $item->category_id;
            $this->item_qty = $item->quantity;
            $this->item_purchase = $item->purchase_date;
            $this->item_warranty = $item->warranty_expiry;
            $this->item_price = $item->purchase_price;
            $this->item_imageu_tmp = $item->image_path;
            $this->item_imageu = null;
            $this->imageBarcode = $item->barcode;
            $this->dispatch('editModal');
        } else {
            $this->redirect('/admin/item');
        }
    }

    public function updateItem()
    {
        $validatedData = $this->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'item_qty' => 'required|integer|min:1',
            'item_purchase' => 'nullable|date',
            'item_warranty' => 'nullable|date',
            'item_price' => 'nullable|numeric|min:0',
            'item_imageu' => 'sometimes|nullable',
        ]);

        $item = Item::find($this->i_id);
        if (!$item) {
            $this->dispatch('saveModal', status: 'warning', position: 'top', message: 'Item not found.');
            return;
        }

        $imagePath = $item->image_path;

        if ($this->item_imageu) {
            // Delete the old image if it exists
            if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
                Storage::disk('public')->delete($item->image_path);
            }

            // Upload the new image
            $imagePath = $this->item_imageu->store('items', 'public');
        }

        $item->update([
            'name' => $validatedData['item_name'],
            'description' => $validatedData['item_description'],
            'category_id' => $validatedData['category_id'],
            'quantity' => $validatedData['item_qty'],
            'purchase_date' => $validatedData['item_purchase'],
            'warranty_expiry' => $validatedData['item_warranty'],
            'purchase_price' => $validatedData['item_price'],
            'image_path' =>  $imagePath,
        ]);
        $this->dispatch('updateModal', status: 'success',  position: 'top', message: 'Item update successfully.');
    }

    public function deleteItem(int $id)
    {
        $this->i_id = $id;
        $this->dispatch('deleteItemModal');
    }


    public function destroyItem()
    {
        $item = Item::find($this->i_id);

        if (!$item) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'Item not found!', modal: '#deleteItemModal');
            return;
        }

        if ($item->image_path && Storage::disk('public')->exists($item->image_path)) {
            Storage::disk('public')->delete($item->image_path);
        }

        $item->delete();

        $this->i_id = null;
        $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Item deleted successfully.', modal: '#deleteItemModal');
    }



    public function closeModal()
    {
        $this->resetInput();
        $this->dispatch('closeModal');
    }

    private function resetInput()
    {
        $this->reset(['item_name', 'item_image', 'item_price', 'item_warranty', 'item_purchase', 'item_qty', 'item_description', 'category_id']);
    }

    public function downloadBarcode()
    {
        if (!$this->imageBarcode || !$this->item_name) {
            $this->dispatch('saveModal', status: 'warning', position: 'top', message: 'No barcode available to download.');
            return;
        }

        $barcode = new DNS1D();
        $barcodeData = base64_decode($barcode->getBarcodePNG($this->imageBarcode, 'C39'));

        $width = 400;
        $height = 200;
        $image = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);


        imagefilledrectangle($image, 0, 0, $width, $height, $white);

        // Load Barcode Image
        $barcodeImage = imagecreatefromstring($barcodeData);
        $barcodeWidth = imagesx($barcodeImage);
        $barcodeHeight = imagesy($barcodeImage);


        $barcodeX = ($width - $barcodeWidth) / 2;
        $barcodeY = ($height - $barcodeHeight) / 3;

        // Draw Border Around Barcode
        $borderPadding = 5;
        imagerectangle(
            $image,
            $barcodeX - $borderPadding,
            $barcodeY - $borderPadding,
            $barcodeX + $barcodeWidth + $borderPadding,
            $barcodeY + $barcodeHeight + $borderPadding,
            $black
        );


        imagecopy($image, $barcodeImage, $barcodeX, $barcodeY, 0, 0, $barcodeWidth, $barcodeHeight);

        // Add Item Name at Bottom
        $fontSize = 5;
        $textWidth = imagefontwidth($fontSize) * strlen($this->item_name);
        $textX = ($width - $textWidth) / 2;
        $textY = $height - 25;

        imagestring($image, $fontSize, $textX, $textY, $this->item_name, $black);

        // Output Image as a Download
        $fileName = 'barcode_' . $this->imageBarcode . '.png';
        $filePath = storage_path('app/public/' . $fileName);
        imagepng($image, $filePath);
        imagedestroy($image);

        return response()->download($filePath)->deleteFileAfterSend();
    }
}
