@extends('admin.__layout')
@section('title', "$company->name | " . __('company.action.show'))
@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">{{ __('company.label.company') }}</div>
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

                        <div class="form-group row justify-content-center">
                            @if($company->logo_url)
                                <img class="img-thumbnail w-50" src="{{ $company->logo_url }}">
                            @else
                                <img class="img-thumbnail w-50" src="{{ asset('img/placeholder.png') }}">
                                <p class="text-muted text-center">{{ __('company.error.no_logo') }}</p>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3 col-form-label">
                                {{ __('company.label.name') }}
                            </label>
                            <div class="col">
                                <p class="form-control-plaintext">
                                    {{ $company->name }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3 col-form-label">
                                {{ __('company.label.email') }}
                            </label>
                            <div class="col">
                                <p class="form-control-plaintext">
                                    {{ $company->email }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="form-label col-3 col-form-label">
                                {{ __('company.label.website') }}
                            </label>
                            <div class="col">
                                <p class="form-control-plaintext">
                                    {{ $company->website }}
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <a class="btn btn-link" href="{{ route('admin.company.index') }}">
                                {{ __('common.form.back') }}
                            </a>
                            <a class="btn btn-link ms-auto" href="{{ route('admin.company.edit', $company) }}">
                                {{ __('common.link.edit') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection
