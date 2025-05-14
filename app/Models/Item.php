<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'barcode',
        'name',
        'status',
        'quantity',
        'category_id',
        'purchase_date',
        'purchase_price',
        'warranty_expiry',
        'description',
        'assigned_to',
        'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function damagedLogs()
    {
        return $this->hasMany(DamagedItem::class);
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            // Generate a UUID before creating the item
            $item->uuid = Str::uuid();

            $item->barcode = IdGenerator::generate([
                'table' => 'items',
                'field' => 'barcode',
                'length' => 6,
                'prefix' => 'I',
            ]);
        });
    }
}
