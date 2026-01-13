<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class TeacherModuleController extends Controller
{
    
    public function show(Request $request, Module $module)
    {
        $teacher = Auth::user();

        // Verify teacher is assigned to this module
        $isAssigned = $teacher->teacherModules()
            ->where('module_id', $module->id)
            ->exists();

        if (!$isAssigned) {
            abort(403, 'You are not assigned to this module');
        }

        $query = $module->enrollments()->with('user');

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->whereHas('user', function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        $students = $query->get();

        return view('teacher.modules.show', compact('module', 'students'));
    }
}
