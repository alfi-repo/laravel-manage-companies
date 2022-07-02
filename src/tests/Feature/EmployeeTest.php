<?php

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('has employee index page', function () {
    $this->get(route('admin.employee.index'))
         ->assertOk()->assertViewIs('admin.employee.index');
});

it('has employee create page', function () {
    $this->get(route('admin.employee.create'))
         ->assertOk()->assertViewIs('admin.employee.create');
});

it('can show employee edit page', function () {
    $employee = Company::factory()
                       ->create()
                       ->employee()
                       ->save(Employee::factory()->make());
    $this->get(route('admin.employee.edit', $employee))
         ->assertOk()->assertViewIs('admin.employee.edit');
});

it('can show employee detail page', function () {
    $employee = Company::factory()
                       ->create()
                       ->employee()
                       ->save(Employee::factory()->make());
    $this->get(route('admin.employee.show', $employee))
         ->assertOk()->assertViewIs('admin.employee.show');
});

it('can create a new employee', function () {
    $company = Company::factory()->create();
    $params  = Employee::factory()
                       ->make(['company_id' => $company->id])
                       ->toArray();
    $this->post(route('admin.employee.store', $params))
         ->assertRedirect(route('admin.employee.create'))
         ->assertSessionHas('success');
    $this->assertDatabaseHas(Employee::class, ['email' => data_get($params, 'email')]);
});

it('can update an employee', function () {
    $company  = Company::factory()->create();
    $employee = $company->employee()
                        ->save(Employee::factory()->make());
    $params   = [
        'first_name' => 'test first name',
        'last_name'  => 'test last name',
        'email'      => 'test_employee_email@example.com',
        'phone'      => '123000',
        'company_id' => $company->id,
    ];
    $this->put(route('admin.employee.update', $employee), $params)
         ->assertRedirect(route('admin.employee.edit', $employee))
         ->assertSessionHas('success');
    $this->assertDatabaseHas(Employee::class, ['email' => data_get($params, 'email')]);
});

it('will throw an error on failure employee update', function () {
    $company      = Company::factory()->create();
    $employeeData = Employee::factory()->make();
    $employee     = $company->employee()
                            ->save($employeeData);
    $params       = [
        'first_name' => 'test first name',
        'last_name'  => 'test last name',
        'email'      => 'test_employee_email@example.com',
        'phone'      => '123000',
        'company_id' => $company->id,
    ];

    Employee::updating(static function () {
        return false;
    });
    $this->withHeaders(['HTTP_REFERER' => route('admin.employee.edit', $employee)])
         ->put(route('admin.employee.update', $employee), $params)
         ->assertRedirect(route('admin.employee.edit', $company))
         ->assertSessionHas('failure');
    $this->assertDatabaseHas(Employee::class, ['email' => $employeeData->email]);
});

it('can delete an employee', function () {
    $employee = Company::factory()
                       ->create()
                       ->employee()
                       ->save(Employee::factory()->make());
    $this->delete(route('admin.employee.destroy', $employee))
         ->assertRedirect(route('admin.employee.index'))
         ->assertSessionHas('success');
    $this->assertDatabaseMissing(Employee::class, ['email' => data_get($employee, 'email')]);
});

it('will throw an error on failure employee deletion', function () {
    $company      = Company::factory()->create();
    $employeeData = Employee::factory()->make();
    $employee     = $company->employee()
                            ->save($employeeData);

    Employee::deleting(static function () {
        return false;
    });
    $this->withHeaders(['HTTP_REFERER' => route('admin.employee.index')])
         ->delete(route('admin.employee.destroy', $employee))
         ->assertRedirect(route('admin.employee.index'))
         ->assertSessionHas('failure');
    $this->assertDatabaseHas(Employee::class, ['email' => $employeeData->email]);
});
