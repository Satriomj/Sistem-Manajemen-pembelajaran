<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    //

    public function index()
    {
        $courses = Course::query()
            ->withCount(['users', 'modules'])
            ->paginate(10);

        
    }
}
