@extends('admin.__layout')
@section('title', __('employee.action.index'))
@section('content')
    <div class="container-xl">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-pretitle">{{ __('employee.label.employee') }}</div>
                    <h2 class="page-title">{{ __('common.heading.index') }}</h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.employee.create') }}" class="btn btn-primary d-sm-inline-block">
                            <i class="ti ti-plus"></i> {{ __('employee.action.create') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('employee.label.employee') }}</h3>
                        </div>

                        @if (session('success'))
                            <x-alerts.success important :message="session('success')" />
                        @endisset
                        @if (session('failure'))
                            <x-alerts.danger important :message="session('failure')" />
                        @endisset

                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                <tr>
                                    <th>{{ __('employee.label.first_name') }}</th>
                                    <th>{{ __('employee.label.last_name') }}</th>
                                    <th>{{ __('employee.label.company') }}</th>
                                    <th>{{ __('employee.label.email') }}</th>
                                    <th>{{ __('employee.label.phone') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($paginated as $row)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.employee.show', [$row]) }}">
                                                {{ $row->first_name }}
                                            </a>
                                        </td>
                                        <td>{{ $row->last_name }}</td>
                                        <td>{{ $row->company->name }}</td>
                                        <td>{{ $row->email ?? '-' }}</td>
                                        <td>{{ $row->phone ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-link"
                                                   href="{{ route('admin.employee.edit', [$row]) }}">
                                                    {{ __('common.link.edit') }}
                                                </a>

                                                <form action="{{ route('admin.employee.destroy', [$row]) }}"
                                                      method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-link"
                                                            onclick="return confirm('{{ __('common.link.delete_confirm') }}');"
                                                            type="submit">{{ __('common.link.delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-muted text-center">
                                            {{ __('common.error.not_found') }}
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">
                                {{ __('pagination.entries', ['entries' => $paginated->count()]) }}
                            </p>
                            <ul class="pagination m-0 ms-auto">
                                <li class="page-item @if($paginated->onFirstPage()) disabled @endif">
                                    <a class="page-link"
                                       href="{{ $paginated->previousPageUrl() }}">
                                        {!! __('pagination.previous') !!}
                                    </a>
                                </li>
                                <li class="page-item @if(!$paginated->hasMorePages()) disabled @endif">
                                    <a class="page-link" href="{{ $paginated->nextPageUrl() }}">
                                        {!! __('pagination.next') !!}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
