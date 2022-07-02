<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogFormatService
{
    public static function format(string $message, mixed $data = null): ?string
    {
        try {
            $text = json_encode([
                'message' => $message,
                'data'    => $data,
            ], JSON_THROW_ON_ERROR);
        } catch (\Exception $e) {
            Log::warning("LogFormatService: {$e->getMessage()}");
            return null;
        }

        return $text;
    }
}
