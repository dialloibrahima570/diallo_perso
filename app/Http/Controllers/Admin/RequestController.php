<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestProcessedMail;
use App\Models\Contact;

class RequestController extends Controller
{
    // Page liste des demandes
    public function index()
    {
         $totalRequests   = RequestItem::count();
        $totalRequests = RequestItem::count();
        $cvRequests = RequestItem::where('type', 'cv')->count();
        $projectRequests = RequestItem::where('type', 'project')->count();
        $pendingRequests = RequestItem::where('status', 'pending')->count();
        $requestItems = RequestItem::latest()->paginate(10);
         $totalContacts   = Contact::count();
    $readContacts    = Contact::where('status', 'read')->count();
    $unreadContacts  = Contact::where('status', 'unread')->count();

        return view('admin.project_requests.index', compact(
            'totalRequests',
            'cvRequests',
            'projectRequests',
            'pendingRequests',
            'totalContacts',
        'readContacts',
        'unreadContacts',
            'requestItems'
        ));
    }


}

