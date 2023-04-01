<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tutor\DetachCourseRequest;
use App\Http\Requests\Tutor\StoreTutorRequest;
use App\Http\Requests\Tutor\UpdateTutorRequest;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tutors = User::query()
            ->roleIs('tutor')
            ->with(
                [
                    'courses'
                ],
            )->paginate(10);
        $courses = Course::query()
            ->orderBy('name')
            ->get();
        $users = User::all();
        return view('dashboard.tutor.index', compact('tutors', 'courses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTutorRequest $request)
    {
        //
        $validated = $request->validated();
        $user = User::find($validated['user_id']);
        $user->roles()->syncWithoutDetaching(Role::where('name', 'tutor')->first());
        $user->courses()->syncWithoutDetaching($validated['course_id']);
        if (Tutor::where('user_id', $validated['user_id'])->where('course_id', $validated['course_id'])->exists()) {
            return back()->with(
                [
                    'success'   =>  'Data berhasil ditambahkan',
                ],
            );
        }

        return back()->with(
            [
                'failed'   =>  'Data gagal ditambahkan',
            ],
        );
    }

    public function detachCourse(User $tutor, Course $course)
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
