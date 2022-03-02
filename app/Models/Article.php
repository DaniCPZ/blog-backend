<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function uploadFolder(): string
    {
        return "articles";
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault();
    }

    public function imageUrl(string $column = 'image'): ?string
    {
        $imageName = $this->{$column};

        return empty($imageName)
            ? "https://ui-avatars.com/api/?name={$column}&color=7F9CF5&background=EBF4FF"
            : Storage::disk('public')->url("{$this->uploadFolder()}/{$imageName}");
    }

    public function deleteImage(string $column = 'image'): void
    {
        $imageName = $this->{$column};

        if ($imageName !== null) {
            Storage::disk('public')->delete("{$this->uploadFolder()}/{$imageName}");
        }
    }
}