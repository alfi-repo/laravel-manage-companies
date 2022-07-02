@extends('admin.__layout')
@section('title',  __('employee.action.create'))
@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">{{ __('employee.label.employee') }}</div>
                    <h2 class="page-title">{{ __('common.heading.create') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-narrow">
            <form action="{{ route('admin.employee.store') }}" method="post">
                @csrf
                <div class="col-12">
                    <div class="card">
                        <div>
                            @if ($errors->any())
                                <x-alerts.danger class="mb-0"
                                                 important
                                                 :message="__('common.form.failure')" />
                            @endif

                            @if (session('success'))
                                <x-alerts.success class="mb-0"
                                                  important
                                                  :message="session('success')" />
                            @endisset
                            @if (session('failure'))
                                <x-alerts.danger class="mb-0"
                                                 important
                                                 :message="session('failure')" />
                            @endisset
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <x-forms.input.text :label="__('employee.label.first_name')"
                                                    name="first_name"
                                                    required />
                            </div>

                            <div class="form-group mb-3">
                                <x-forms.input.text :label="__('employee.label.last_name')"
                                                    name="last_name"
                                                    required />
                            </div>

                            <div class="form-group mb-3">
                                <div class="form-label required">{{ __('employee.label.company') }}</div>
                                <select class="form-select @error('company_id') is-invalid @enderror"
                                        name="company_id"
                                        required>
                                    <option value="" disabled selected>{{ __('employee.label.company') }}</option>
                                    @foreach ($company as $atom)
                                        <option value="{{ $atom->id }}" @selected(old('company_id') == $atom->id)>
                                            {{ $atom->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <x-forms.input.text :label="__('employee.label.email')"
                                                    name="email" />
                            </div>

                            <div class="form-group mb-3">
                                <x-forms.input.text :label="__('employee.label.phone')"
                                                    name="phone" />
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a class="btn btn-link" href="{{ route('admin.employee.index') }}">
                                    {{ __('common.form.cancel') }}
                                </a>
                                <button class="btn btn-primary ms-auto" type="submit">
                                    {{ __('common.form.save') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
