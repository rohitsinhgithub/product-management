<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false; // Prevent auto-incrementing
    protected $keyType = 'string'; // Set ID as string

    protected $fillable = [
        'name',
        'item_type',
        'hsn_sac_code',
        'category_id',
        'sub_category_id',
        'mrp',
        'barcode',
        'purchase_price',
        'unit_of_measure',
        'sku',
        'sales_cost',
        'is_tax_included',
        'cgst',
        'sgst',
        'igst',
        'is_available',
    ]; // Specify fillable fields

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->id = self::generateRandomId();
        });
    }

    private static function generateRandomId()
    {
        do {
            $randomId = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        } while (self::where('id', $randomId)->exists()); // Check for uniqueness
        return $randomId;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sub_category()
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }
}
