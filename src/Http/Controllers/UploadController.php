<?php

namespace DinandMentink\Markdown\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use DinandMentink\Markdown\Http\Requests\UploadStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Spatie\Image\Image;
use Storage;
use Str;

class UploadController extends Controller
{

    public function store(UploadStoreRequest $request)
    {
        $path = $this->storeFile($request->file("image"));

        return [
            "url" => $this->url($path)
        ];
    }

    private function directory(): String
    {
        if(is_string(config("nova-markdown.directory"))) {
            return config("nova-markdown.directory");
        }

        return config("nova-markdown.directory")(Auth::user());
    }

    private function disk(): String
    {
        return config("nova-markdown.disk");
    }

    private function fileVisibility(): String
    {
        return config("nova-markdown.file-visibility");
    }

    private function maxWidth(): ?Int
    {
        return config("nova-markdown.max-width");
    }

    private function quality(): ?Int
    {
        return config("nova-markdown.quality");
    }

    private function url(String $path): String
    {
        return Storage::disk($this->disk())->url($path);
    }

    private function storeFile(UploadedFile $file): String
    {
        if($this->isImage($file->getClientOriginalName())) {
            $this->resize($file->path());
        }

        return $file->storeAs(
            $this->directory(),
            $this->safeFilename($file->getClientOriginalName()),
            [
                "disk" => $this->disk(),
                "visibility" => $this->fileVisibility(),
            ],
        );
    }

    private function resize(String $path): Void
    {
        $image = Image::load($path);

        if($this->quality()) {
            $image->quality($this->quality());
        }

        if($this->maxWidth() && $image->getWidth() > $this->maxWidth()) {
            $image->width($this->maxWidth());
        }

        $image->save();
    }

    private function isImage(String $filename): Bool
    {
        return $this->hasExtension(
            $filename,
            [
                "bmp",
                "gif",
                "heif",
                "ico",
                "jpeg",
                "jpg",
                "png",
                "svg",
                "tiff",
                "webp",
            ]
        );
    }

    private function safeFilename(String $path): String
    {
        $pathinfo = pathinfo($path);

        return
            Str::slug(config("nova-markdown.random_filename") ? Str::random(32) : $pathinfo["filename"]) .
            "." .
            $pathinfo["extension"];
    }

    private function hasExtension(String $filename, $extensions): Bool
    {
        $extensions = (Array) $extensions;

        return in_array(
            pathinfo($filename, PATHINFO_EXTENSION),
            $extensions
        );
    }
}
