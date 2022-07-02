<?php

use App\Services\LogFormatService;
use Tests\TestCase;

uses(TestCase::class);

test('format() return proper string', function () {
    $string   = LogFormatService::format('data', ['key' => 'value']);
    $expected = '{"message":"data","data":{"key":"value"}}';
    expect($string)->toBe($expected);
});

test('format() throw error due to recursion', function () {
    $a   = array();
    $a[] = &$a;
    Log::shouldReceive('warning')->once()
       ->with('LogFormatService: Recursion detected');
    $string = LogFormatService::format('data', $a);
    expect($string)->toBeNull();
});
