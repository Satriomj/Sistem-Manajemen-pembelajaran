@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Course') }} {{ $course->name . " " . __('Modules') }}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModule">
                            Add Module
                        </button>
                        <div class="modal fade" id="addModule" tabindex="-1" role="dialog"
                            aria-labelledby="addModuleLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('dashboard.course.module.store', $course) }}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModuleLabel">Add Module Form</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">

                        <table class="table">
                            <caption>Table of Courses</caption>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total Session</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($modules as $module)
                                <tr>
                                    <td>{{ $module->name }}</td>
                                    <td>{{ $module->sessions_count }}</td>
                                    <td>
                                        <a role="button" class="btn btn-primary"
                                            href="{{ route('dashboard.course.module.index', $course) }}">
                                            Session Details
                                        </a>

                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#updateModule">
                                            Edit
                                        </button>


                                        <div class="modal fade" id="updateModule" tabindex="-1" role="dialog"
                                            aria-labelledby="updateModuleLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ route('dashboard.course.module.update', [$course,$module]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="updateModuleLabel">Update module
                                                                Form
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" id="name"
                                                                    class="form-control" value="{{ $module->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer clearfix">
                        {{ $modules->links() }}
                    </div>
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@section('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function(){
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    })
</script>
@endsection