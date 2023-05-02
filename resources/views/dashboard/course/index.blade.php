@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Manajemen Mata Kuliah ') }}</h1>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#course">
                            Tambah Mata Kuliah
                        </button>
                        <div class="modal fade" id="course" tabindex="-1" role="dialog" aria-labelledby="courseLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('dashboard.course.store') }}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="courseLabel">Add Course Form</h5>
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
                            <caption>Tabel Kelas </caption>
                            <thead>
                                <tr>
                                    <th>Name Kelas</th>
                                    <th>Jumlah Penutor</th>
                                    <th>Nama Penutor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($courses as $course)
                                <tr>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->users_count }}</td>
                                    <td>
                                        <ul>
                                            @forelse ($course->users as $user)
                                            <li>{{ $user->name }}</li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>
                                        <a role="button" class="btn btn-primary"
                                            href="{{ route('dashboard.course.module.index', $course) }}">
                                            List Modul
                                        </a>

                                        <a role="button" class="btn btn-secondary"
                                            href="{{ route('dashboard.course.show', $course) }}">
                                            List Penutor
                                        </a>

                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#updateCourse">
                                            Ubah Data
                                        </button>


                                        <div class="modal fade" id="updateCourse" tabindex="-1" role="dialog"
                                            aria-labelledby="updateCourseLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('dashboard.course.update', $course) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="updateCourseLabel">Update Course
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
                                                                    class="form-control" value="{{ $course->name }}">
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
                        {{ $courses->links() }}
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