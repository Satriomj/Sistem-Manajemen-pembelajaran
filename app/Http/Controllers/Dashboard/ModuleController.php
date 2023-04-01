<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    //

    public function index()
    {
        $modules = Module::query()
            ->with(
                [
                    'tutor',
                ],
            )->paginate(10);
    }
}
