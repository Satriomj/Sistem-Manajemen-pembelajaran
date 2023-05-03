<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Module\StoreModuleRequest;
use App\Http\Requests\Module\UpdateModuleRequest;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleListController extends Controller
{
    //

    public function index(Course $course)
    {
        $modules = $course->modules()->paginate(10);
        $modules->loadCount('sessions');
        return view('viewsuser.courselist', compact('course', 'modules'));
    }

 
}
