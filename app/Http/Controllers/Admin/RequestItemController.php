<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestItem;
use App\Models\History;
use App\Mail\RequestApprovedMail;
use App\Mail\RequestRejectedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RequestItemController extends Controller
{
    // Page détail d'une demande
    public function show(RequestItem $requestItem)
    {
        return view('admin.request_items.show', compact('requestItem'));
    }


}
