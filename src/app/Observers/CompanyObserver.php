<?php
declare(strict_types=1);

namespace App\Observers;

use App\Events\CompanyCreated;
use App\Models\Company;

class CompanyObserver
{
    public function created(Company $company): bool
    {
        event(new CompanyCreated($company));
        return true;
    }

    public function deleting(Company $company): bool
    {
        return !$company->employee()->exists();
    }
}
