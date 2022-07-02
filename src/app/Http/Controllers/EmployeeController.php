<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Company;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    public function __construct(
        private readonly EmployeeService $employeeService
    ) {}

    public function index()
    {
        $paginated = $this->employeeService->allCursorPaginate();
        return view('admin.employee.index', compact('paginated'));
    }

    public function create()
    {
        $company = Company::orderBy('name')->get(['id', 'name']);
        return view('admin.employee.create', compact('company'));
    }

    public function store(EmployeeStoreRequest $request): RedirectResponse
    {
        $employee = $this->employeeService->create($request->validated());
        return redirect()
            ->route('admin.employee.create')
            ->with(compact('employee'))
            ->with('success', __('common.form.success'));
    }

    public function show(Employee $employee)
    {
        $employee->load('company');
        return view('admin.employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $company = Company::orderBy('name')->get(['id', 'name']);
        return view('admin.employee.edit', compact('company', 'employee'));
    }

    public function update(EmployeeStoreRequest $request, Employee $employee): RedirectResponse
    {
        if (!$this->employeeService->update(
            $employee,
            $request->validated()
        )) {
            return redirect()
                ->back()
                ->withInput()
                ->with('failure', __('common.form.error'));
        }

        return redirect()
            ->route('admin.employee.edit', $employee)
            ->with('success', __('common.form.success'));
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        if (!$this->employeeService->delete($employee)) {
            return redirect()
                ->route('admin.employee.index')
                ->with('failure', __('common.form.delete.failure'));
        }

        return redirect()
            ->route('admin.employee.index')
            ->with('success', __('common.form.delete.success'));
    }
}
