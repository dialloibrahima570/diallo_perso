<?php

/*


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestItem;
use App\Models\History;
use App\Mail\RequestApprovedMail;
use App\Mail\RequestRejectedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use App\Models\ProjectRequest;


class RequestItemController extends Controller
{
    public function updateStatus(RequestItem $requestItem, $status)
    {
        if (!in_array($status, ['approved', 'rejected'])) {
            return response()->json(['success' => false, 'message' => 'Status invalide'], 400);
        }

        // Mettre à jour le status
        $requestItem->status = $status;
        $requestItem->save();

        // Enregistrer dans l'historique
        History::create([
            'action' => $status,
            'email' => $requestItem->email,
            'request_item_id' => $requestItem->id,
            'type' => $requestItem->type,
            'message' => $requestItem->message,

        ]);
        // Envoi du mail
        try {
            if ($requestItem->email) {
                if ($status === 'approved') {
                    Mail::to($requestItem->email)->send(new RequestApprovedMail($requestItem));
                } elseif ($status === 'rejected') {
                    Mail::to($requestItem->email)->send(new RequestRejectedMail($requestItem));
                }
            }
        } catch (\Exception $e) {
            Log::error("Erreur envoi mail pour RequestItem {$requestItem->id} : ".$e->getMessage());
        }

        return response()->json(['success' => true, 'status' => $status]);
    }

    public function show(RequestItem $requestItem)
    {
        return view('admin.request_items.show', compact('requestItem'));
    }
}
*/
