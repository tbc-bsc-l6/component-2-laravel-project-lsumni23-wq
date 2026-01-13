<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ModuleResource;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Get list of modules
     * 
     * Returns a paginated list of modules.
     * Optionally filter by 'search' query parameter.
     */
    public function index(Request $request)
    {
        $query = Module::withCount(['activeStudents', 'teachers'])
            ->where('is_available', true); // Only show available modules to public API? Or all? Let's show all but mark status.
            // Actually, for public API, usually you only show what's available or give a status. 
            // Let's remove the where clause and let the Resource handle the status display.
        
        $query = Module::withCount(['activeStudents', 'teachers'])
            ->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $query->where('module', 'like', '%' . $request->search . '%');
        }

        $modules = $query->paginate(10);

        return ModuleResource::collection($modules);
    }

    /**
     * Get single module details
     */
    public function show($id)
    {
        $module = Module::withCount(['activeStudents', 'teachers'])->findOrFail($id);
        
        return new ModuleResource($module);
    }
}
