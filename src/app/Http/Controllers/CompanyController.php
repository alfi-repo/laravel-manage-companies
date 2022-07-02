<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    public function __construct(
        private readonly CompanyService $companyService
    ) {}

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        $paginated = $this->companyService->allCursorPaginate();
        return view('admin.company.index', compact('paginated'));
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        return view('admin.company.create');
    }

    /**
     * @param  CompanyStoreRequest  $request
     * @return RedirectResponse
     */
    public function store(CompanyStoreRequest $request): RedirectResponse
    {
        $company = $this->companyService->create($request->validated());
        return redirect()
            ->route('admin.company.create')
            ->with(compact('company'))
            ->with('success', __('common.form.success'));
    }

    /**
     * @param  Company  $company
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Company $company): \Illuminate\Contracts\View\View
    {
        return view('admin.company.show', compact('company'));
    }

    /**
     * @param  Company  $company
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Company $company): \Illuminate\Contracts\View\View
    {
        return view('admin.company.edit', compact('company'));
    }

    /**
     * @param  Company  $company
     * @param  CompanyStoreRequest  $request
     * @return RedirectResponse
     */
    public function update(Company $company, CompanyStoreRequest $request): RedirectResponse
    {
        if (!$this->companyService->update(
            $company,
            $request->validated()
        )) {
            return redirect()
                ->back()
                ->withInput()
                ->with('failure', __('common.form.error'));
        }

        return redirect()
            ->route('admin.company.edit', $company)
            ->with('success', __('common.form.success'));
    }

    /**
     * @param  Company  $company
     * @return RedirectResponse
     */
    public function destroy(Company $company): RedirectResponse
    {
        if (!$this->companyService->delete($company)) {
            return redirect()
                ->route('admin.company.index')
                ->with('failure', $company->name.' - '.__('common.form.delete.failure'));
        }

        return redirect()
            ->route('admin.company.index')
            ->with('success', __('common.form.delete.success'));
    }
}
