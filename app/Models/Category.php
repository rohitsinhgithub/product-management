<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_type',
        'category_name',
        'sub_category',
        'status',
        'unique_id',
        'is_main',
        'image_id',
    ];
    // Method to generate a unique 8-digit integer ID
    public static function generateUniqueId()
    {
        do {
            // Generate a random 8-digit integer
            $uniqueId = random_int(10000000, 99999999);
        } while (self::where('id', $uniqueId)->exists());

        return $uniqueId;
    }
}
