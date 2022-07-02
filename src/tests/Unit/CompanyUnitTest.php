<?php

use App\Services\CompanyService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    Storage::fake('s3');
});

test('can upload logo', function () {
    $image = UploadedFile::fake()->image('img.jpg', 100, 100)->size(100);
    $path  = (new CompanyService())->uploadLogo($image);
    Storage::disk('s3')->assertExists($path);
});

test('can delete existing logo', function () {
    $image = UploadedFile::fake()->image('img.jpg', 100, 100)->size(100);
    $cs    = new CompanyService();
    $path  = $cs->uploadLogo($image);
    $cs->deleteLogo($path);
    Storage::disk('s3')->assertMissing($path);
});
