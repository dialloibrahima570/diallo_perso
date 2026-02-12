<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        // On récupère l'historique du plus récent au plus ancien
        $histories = History::latest()->paginate(10);

        return view('admin.history.index', compact('histories'));
    }
}
