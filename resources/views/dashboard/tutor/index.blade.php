@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Manajemen Data Penutor') }}</h1>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTutor">
                            Tambah Penutor
                        </button>
                        <div class="modal fade" id="addTutor" tabindex="-1" role="dialog"
                            aria-labelledby="addTutorLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('dashboard.tutor.store') }}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addTutorLabel">Add Tutor Form</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="course_id">Course</label>
                                                <select name="course_id" class="form-control select2bs4" required
                                                    style="width: 100%;">
                                                    <option selected="selected" disabled>Choose...</option>
                                                    @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="user_id">Tutor</label>
                                                <select name="user_id" class="form-control select2bs4" required
                                                    style="width: 100%;">
                                                    <option selected="selected" disabled>Choose...</option>
                                                    @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
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
                            <caption>Tabel Data Penutor</caption>
                            <thead>
                                <tr>
                                    <th>Nama Penutor</th>
                                    <th>Email</th>
                                    <th>Kelas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tutors as $tutor)
                                <tr>
                                    <td>{{ $tutor->name }}</td>
                                    <td>{{ $tutor->email }}</td>
                                    <td>
                                        <ul>
                                            @forelse ($tutor->courses as $course)
                                            <li>{{ $course->name }}</li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#seeDetails{{ $loop->index }}">
                                        Detail 
                                        </button>
                                        <div class="modal fade" id="seeDetails{{ $loop->index }}" tabindex="-1"
                                            role="dialog" aria-labelledby="seeDetails{{ $loop->index }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="seeDetails{{ $loop->index }}Label">
                                                            Add Tutor Form
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                                <th>Course Name</th>
                                                                <th>Actions</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($tutor->courses as $course)
                                                                <tr>
                                                                    <td>{{ $course->name }}</td>
                                                                    <td>
                                                                        <form
                                                                            action="{{ route('dashboard.tutor.detach-course', [$tutor->id, $course->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn btn-danger">
                                                                                Hapus
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
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
                        {{ $tutors->links() }}
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