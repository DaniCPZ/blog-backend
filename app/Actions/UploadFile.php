<?php

namespace App\Actions;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class UploadFile
{
    private $file;
    private $uploadPath;

    public function setFile(?UploadedFile $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setUploadPath(string $uploadPath): self
    {
        $this->uploadPath = $uploadPath;

        return $this;
    }

    public function execute(): ?string
    {
        if (!$this->file) {
            return null;
        }

        $imageName = (string) Str::of($this->file->getClientOriginalName())
                ->beforeLast('.')
                ->slug()
                ->append('.')
                ->append($this->file->getClientOriginalExtension());

        $this->file->storeAs($this->uploadPath, $imageName, 'public');

        return $imageName;
    }
}