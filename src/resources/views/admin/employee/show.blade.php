@extends('admin.__layout')
@section('title', "$employee->first_name | " . __('employee.action.show'))
@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">{{ __('employee.label.employee') }}</div>
                    <h2 class="page-title">{{ __('common.heading.view') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-narrow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="form-label col-3 col-form-label">
                                {{ __('employee.label.first_name') }}
                            </label>
                            <div class="col">
                                <p class="form-control-plaintext">
                                    {{ $employee->first_name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3 col-form-label">
                                {{ __('employee.label.last_name') }}
                            </label>
                            <div class="col">
                                <p class="form-control-plaintext">
                                    {{ $employee->last_name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3 col-form-label">
                                {{ __('employee.label.company') }}
                            </label>
                            <div class="col">
                                <p class="form-control-plaintext">
                                    <a href="{{ route('admin.company.show', [$employee->company]) }}">
                                        {{ $employee->company->name }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3 col-form-label">
                                {{ __('employee.label.email') }}
                            </label>
                            <div class="col">
                                <p class="form-control-plaintext">
                                    {{ $employee->email }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3 col-form-label">
                                {{ __('employee.label.phone') }}
                            </label>
                            <div class="col">
                                <p class="form-control-plaintext">
                                    {{ $employee->phone }}
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <a class="btn btn-link" href="{{ route('admin.company.index') }}">
                                {{ __('common.form.back') }}
                            </a>
                            <a class="btn btn-link ms-auto" href="{{ route('admin.employee.edit', $employee) }}">
                                {{ __('common.link.edit') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection
