<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Company;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    public function allCursorPaginate(int $perPage = 10): CursorPaginator
    {
        return Company::orderBy('id')->cursorPaginate($perPage);
    }

    public function create(array $data): Company
    {
        $data['logo'] = $this->uploadLogo(data_get($data, 'logo'));
        // observer created send email notification to admin.
        return Company::create($data);
    }

    public function update(Company $company, array $data): bool
    {
        $oldLogo = null;
        if ($logo = $this->uploadLogo(data_get($data, 'logo'))) {
            $data['logo'] = $logo;
            $oldLogo      = $company->logo;
        }

        if (!$company->update($data)) {
            return false;
        }

        $this->deleteLogo($oldLogo);
        return true;
    }

    public function delete(Company $company): bool
    {
        // observer deleting checks for employee existence.
        if ($company->delete() === false) {
            return false;
        }

        $this->deleteLogo($company->logo);
        return true;
    }

    public function uploadLogo(?UploadedFile $image): ?string
    {
        if ($image === null) {
            return null;
        }

        if (!$path = Storage::disk('s3')->putFile('logo', $image)) {
            Log::channel('s3')->alert(
                LogFormatService::format('Company logo upload failed.')
            );
            return null;
        }

        return $path;
    }

    public function deleteLogo(?string $imagePath): void
    {
        if ($imagePath === null) {
            return;
        }

        if (!Storage::cloud()->delete($imagePath)) {
            Log::channel('s3')->info(
                LogFormatService::format(
                    'Company logo deletion failed.',
                    $imagePath
                )
            );
        }
    }
}
