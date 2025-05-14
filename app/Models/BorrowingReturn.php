<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class BorrowingReturn extends Model
{
    use HasFactory;

    protected $table = 'borrowing_return';

    protected $fillable = [
        'barcode_return',
        'borrowing_id',
        'returned_at',
        'notes',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'returned_at',
        'created_at',
        'updated_at'
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
       }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->barcode_return = IdGenerator::generate([
                'table' => 'borrowing_return',
                'field' => 'barcode_return',
                'length' => 6,
                'prefix' => 'C',
            ]);
            
            // Set returned_at if not set
            if (empty($model->returned_at)) {
                $model->returned_at = now();
            }
        });
    }
}