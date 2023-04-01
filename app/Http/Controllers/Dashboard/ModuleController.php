<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Module\StoreModuleRequest;
use App\Http\Requests\Module\UpdateModuleRequest;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    //

    public function index(Course $course)
    {
        $modules = $course->modules()->paginate(10);
        $modules->loadCount('sessions');
        return view('dashboard.modules.index', compact('course', 'modules'));
    }

    public function store(Course $course, StoreModuleRequest $request)
    {
        $validated = $request->validated();
        if ($course->modules()->create($validated)) {
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

    public function update(Course $course, Module $module, UpdateModuleRequest $request)
    {
        $validated = $request->validated();
        $module->update($validated);

        if ($module->wasChanged()) {
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
}
