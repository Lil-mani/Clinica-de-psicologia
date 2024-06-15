<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function notify(Request $request) {
        $notification = Notification::create([
            'psicologo' => $request->psicologo,
            'consulta' => $request->consulta,
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Notificação enviada com sucesso.']);
    }

    public function show($id) {
        $notification = Notification::where('psicologo', $id)
                                    ->where('read', false)
                                    ->get();
        return response()->json($notification);
    }

    public function markRead($id) {
        $notification = Notification::find('', $id);
        $notification->update(['read' => true]);
        return response()->json(['message'=> 'Notificação marcada como lida.']);
    }
}
