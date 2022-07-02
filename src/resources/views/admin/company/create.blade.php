@extends('admin.__layout')
@section('title',  __('company.action.create'))
@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">{{ __('company.label.company') }}</div>
                    <h2 class="page-title">{{ __('common.heading.create') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-narrow">
            <form action="{{ route('admin.company.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="col-12">
                    <div class="card">
                        <div>
                            @if ($errors->any())
                                <x-alerts.danger class="mb-0"
                                                 important
                                                 :message="__('common.form.failure')" />

                                @if(old('logo_xdummy') === 'logo_xdummy')
                                    <x-alerts.info class="mb-0"
                                                   important
                                                   :message="__('company.form.reupload_logo')" />
                                @endif
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
                                <x-forms.input.text :label="__('company.label.name')"
                                                    name="name"
                                                    required />
                            </div>

                            <div class="form-group mb-3">
                                <x-forms.input.text :label="__('company.label.email')"
                                                    name="email" />
                            </div>

                            <div class="form-group mb-3">
                                <x-forms.input.file :hint="__('company.hint.logo')"
                                                    :label="__('company.label.logo')"
                                                    name="logo" />
                            </div>

                            <div class="form-group mb-3">
                                <x-forms.input.text :hint="__('company.hint.website')"
                                                    :label="__('company.label.website')"
                                                    name="website" />
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a class="btn btn-link" href="{{ route('admin.company.index') }}">
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
