<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('date','desc')->get();
        $featuredProject = Project::latest()->first();
        $totalProjects = $projects->count();
        $projectsHistory = $projects;

        $chart = Project::selectRaw('YEAR(date) as year, COUNT(*) as total')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $chartLabels = $chart->pluck('year');
        $chartData = $chart->pluck('total');

        return view('admin.projects', compact(
            'projects',
            'featuredProject',
            'totalProjects',
            'projectsHistory',
            'chartLabels',
            'chartData'
        ));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'technos'     => 'required|string|max:255',
            'date'        => 'required|date',
            'status'      => 'required|string|max:50',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        Project::create([
            'name'        => $request->name,
            'technos'     => $request->technos,
            'date'        => $request->date,
            'status'      => $request->status,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.projects')
            ->with('success','Projet ajouté avec succès');
    }

    public function destroyByDate(Request $request)
    {
        $request->validate(['date' => 'required|date']);

        $project = Project::where('date', $request->date)->first();

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Projet non trouvé'
            ]);
        }

        // 🔥 supprimer l’image si existe
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        $totalProjects = Project::count();

        $chart = Project::selectRaw('YEAR(date) as year, COUNT(*) as total')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Projet supprimé avec succès',
            'totalProjects' => $totalProjects,
            'chartLabels' => $chart->pluck('year'),
            'chartData' => $chart->pluck('total'),
        ]);
    }
}
