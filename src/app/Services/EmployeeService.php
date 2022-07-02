<?php
declare(strict_types=1);

namespace App\Services;

use App\Events\EmployeeCreated;
use App\Models\Employee;
use Illuminate\Contracts\Pagination\CursorPaginator;

class EmployeeService
{
    public function allCursorPaginate(int $perPage = 10): CursorPaginator
    {
        return Employee::with('company')
                       ->orderBy('id')
                       ->cursorPaginate($perPage);
    }

    public function create(array $data): Employee
    {
        $result = Employee::create($data);
        event(new EmployeeCreated($result));
        return $result;
    }

    public function update(Employee $employee, array $data): bool
    {
        return $employee->update($data);
    }

    public function delete(Employee $employee): bool
    {
        return $employee->delete() !== false;
    }
}
