<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const CATEGORIES = [
        'food' => 'Food Grade',
        'feed' => 'Feed Grade',
        'industrial' => 'Industrial Grade',
    ];

    protected $fillable = [
        'name_id', 'name_en', 'name_zh', 'slug', 'category', 'sku', 'grade', 'packaging', 'application',
        'summary_id', 'summary_en', 'summary_zh', 'image_path', 'is_published', 'sort_order',
    ];

    protected function casts(): array
    {
        return ['is_published' => 'boolean', 'sort_order' => 'integer'];
    }

    public function localized(string $field, string $locale): ?string
    {
        return $this->{$field.'_'.$locale} ?: $this->{$field.'_id'};
    }
}
