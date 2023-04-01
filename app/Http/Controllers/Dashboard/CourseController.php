<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Tutor;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;

class CourseController extends Controller
{
    //
    public function index()
    {
        $courses = Course::query()
            ->with('users')
            ->withCount('users')
            ->paginate(10);
        return view('dashboard.course.index', compact('courses'));
    }

    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();
        if (Course::create($validated)) {
            return back()->with(
                [
                    'success'   =>  'Data berhasil dibuat',
                ],
            );
        }
        return back()->with(
            [
                'failed'   =>  'Data gagal dibuat',
            ],
        );
    }

    public function update(Course $course, UpdateCourseRequest $request)
    {
        $validated = $request->validated();
        $course->update($validated);

        if ($course->wasChanged()) {
            return back()->with(
                [
                    'success'   =>  'Data berhasil diperbarui',
                ],
            );
        }
        return back()->with(
            [
                'failed'   =>  'Data gagal diperbarui',
            ],
        );
    }

    public function show(Course $course)
    {
        $course->load('users');

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $course->users->slice(($currentPage - 1) * $perPage, $perPage);
        $paginatedTutors = new LengthAwarePaginator($currentPageItems, $course->users->count(), $perPage);
        return view('dashboard.course.show', compact('course'), ['tutors' =>    $paginatedTutors]);
    }

    public function detachTutor(Course $course, User $tutor)
    {
        $tutor->courses()->detach($course);

        if (!Tutor::where('user_id', $tutor->id)->where('course_id', $course->id)->exists()) {
            return back()->with(
                [
                    'success'   =>  'Data berhasil dihapus',
                ],
            );
        }

        return back()->with(
            [
                'failed'   =>  'Data gagal dihapus',
            ],
        );
    }
}
