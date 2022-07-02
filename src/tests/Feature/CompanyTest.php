<?php

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);

beforeEach(function () {
    Storage::fake('s3');
    $user = User::factory()->create();
    $this->actingAs($user);
});

it('has company index page', function () {
    $this->get(route('admin.company.index'))
         ->assertOk()->assertViewIs('admin.company.index');
});

it('has company create page', function () {
    $this->get(route('admin.company.create'))
         ->assertOk()->assertViewIs('admin.company.create');
});

it('can show company edit page', function () {
    $company = Company::factory()->create();
    $this->get(route('admin.company.edit', $company))
         ->assertOk()->assertViewIs('admin.company.edit');
});

it('can show company detail page', function () {
    $company = Company::factory()->create();
    $this->get(route('admin.company.show', $company))
         ->assertOk()->assertViewIs('admin.company.show');
});

it('can create a new company', function () {
    $email         = 'test_company_email@example.com';
    $requestParams = [
        'name'    => 'test_company_name',
        'email'   => $email,
        'logo'    => UploadedFile::fake()->image('img.jpg', 100, 100)->size(100),
        'website' => 'https://example.com',
    ];
    $this->call('POST', route('admin.company.store'), $requestParams)
         ->assertRedirect(route('admin.company.create'))
         ->assertSessionHas('success');
    $this->assertDatabaseHas(Company::class, compact('email'));
});

it('can update a company', function () {
    $company       = Company::factory()->create();
    $email         = 'test_company_email@example.com';
    $requestParams = [
        '_method' => 'put',
        'name'    => 'test_company_name',
        'email'   => $email,
        'logo'    => UploadedFile::fake()->image('img.jpg', 100, 100)->size(100),
        'website' => 'https://example.com',
    ];
    $this->call('POST', route('admin.company.update', $company), $requestParams)
         ->assertRedirect(route('admin.company.edit', $company))
         ->assertSessionHas('success');
    $this->assertDatabaseHas(Company::class, compact('email'));
});

it('will throw an error on failure company update', function () {
    $company       = Company::factory()->create();
    $email         = $company->email;
    $requestParams = [
        'name'  => 'test_company_name',
        'email' => 'test_company_email@example.com',
    ];
    Company::updating(static function () {
        return false;
    });
    $this->withHeaders(['HTTP_REFERER' => route('admin.company.edit', $company)])
         ->put(route('admin.company.update', $company), $requestParams)
         ->assertRedirect(route('admin.company.edit', $company))
         ->assertSessionHas('failure');
    $this->assertDatabaseHas(Company::class, compact('email'));
});

it('can delete a company that have no employee', function () {
    $company = Company::factory()->create();
    $email   = $company->email;
    $this->delete(route('admin.company.destroy', $company))
         ->assertRedirect(route('admin.company.index'))
         ->assertSessionHas('success');
    $this->assertDatabaseMissing(Company::class, compact('email'));
});

it('can not delete a company that has employee', function () {
    $company = Company::factory()->create();
    $email   = $company->email;
    $company->employee()->save(Employee::factory()->make());
    $this->delete(route('admin.company.destroy', $company))
         ->assertRedirect(route('admin.company.index'))
         ->assertSessionHas('failure');
    $this->assertDatabaseHas(Company::class, compact('email'));
});
