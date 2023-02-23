<?php

namespace DinandMentink\Markdown\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use DinandMentink\Markdown\Http\Requests\UploadStoreRequest;
use Illuminate\Http\UploadedFile;
use Spatie\Image\Image;
use Storage;
use Str;

class UploadController extends Controller
{
    public function store(UploadStoreRequest $request)
    {
        $path = $this->storeFile($request->file('image'));

        return [
            'url' => $this->url($path),
        ];
    }

    private function directory(): string
    {
        if (is_string(config('nova-markdown.directory'))) {
            return config('nova-markdown.directory');
        }

        return config('nova-markdown.directory')(Auth::user());
    }

    private function disk(): string
    {
        return config('nova-markdown.disk');
    }

    private function fileVisibility(): string
    {
        return config('nova-markdown.file-visibility');
    }

    private function maxWidth(): ?int
    {
        return config('nova-markdown.max-width');
    }

    private function quality(): ?int
    {
        return config('nova-markdown.quality');
    }

    private function url(string $path): string
    {
        return Storage::disk($this->disk())->url($path);
    }

    private function storeFile(UploadedFile $file): string
    {
        if ($this->isImage($file->getClientOriginalName())) {
            $this->resize($file->path());
        }

        return $file->storeAs(
            $this->directory(),
            $this->safeFilename($file->getClientOriginalName()),
            [
                'disk' => $this->disk(),
                'visibility' => $this->fileVisibility(),
            ],
        );
    }

    private function resize(string $path): void
    {
        $image = Image::load($path);

        if ($this->quality()) {
            $image->quality($this->quality());
        }

        if ($this->maxWidth() && $image->getWidth() > $this->maxWidth()) {
            $image->width($this->maxWidth());
        }

        $image->save();
    }

    private function isImage(string $filename): bool
    {
        return $this->hasExtension(
            $filename,
            [
                'bmp',
                'gif',
                'heif',
                'ico',
                'jpeg',
                'jpg',
                'png',
                'svg',
                'tiff',
                'webp',
            ]
        );
    }

    private function safeFilename(string $path): string
    {
        $pathinfo = pathinfo($path);

        return
            Str::slug(config('nova-markdown.random_filename') ? Str::random(32) : $pathinfo['filename']).
            '.'.
            $pathinfo['extension'];
    }

    private function hasExtension(string $filename, $extensions): bool
    {
        $extensions = (array) $extensions;

        return in_array(
            pathinfo($filename, PATHINFO_EXTENSION),
            $extensions
        );
    }
}
