<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property ?string $logo_url Absolute url to logo image.
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    protected $appends = [
        'logo_url',
    ];

    public function employee(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Employee::class);
    }

    protected function logoUrl(): Attribute
    {
        return new Attribute (
            get: function () {
                if (!$logo = data_get($this->attributes, 'logo')) {
                    return null;
                }
                return Storage::disk('s3')->url($logo);
            }
        );
    }
}
