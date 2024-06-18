<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Userdata;
use Illuminate\Support\Facades\Log;


class AppointmentController extends Controller
{
    public function index()
{
    $appointments = Appointment::get();
    return response()->json($appointments);
}

    public function store(Request $request)
    {
        $request->validate([
            'patient' => 'required|integer',
            'medic' => 'required|integer',
            'time' => 'required|date',
            'done' => 'required',
        ]);

        Appointment::create($request->all());
        return response()->json(['message' => 'Consulta enviada com sucesso!'], 200);
    }

    public function show()
    {
        $appointments = Appointment::get();
        return response()->json($appointments);
    }

    /**
     * Retorna todas as consultas futuras do paciente de id fornecido.
     */
    public function show_future_patient_appointments($id) {
        $now = Carbon::now();
        $appointments = Appointment::where('patient', $id)
                                    ->where('time', '>', $now)
                                    ->get();
        $appointments->transform(function ($appointment) {
        if ($appointment->medic) {
            // Substituir 'medic' pelo nome do médico
            $name = Userdata::where('id', $appointment->medic)->value('name');
            $appointment->medic = $name;
        }
        return $appointment;
        });
        return response()->json($appointments);
    }
    /**
     * Retorna todas as consultas passadas do paciente de id fornecido.
     */
    public function show_past_patient_appointments($id) {
        $now = Carbon::now();
        $appointments = Appointment::where('patient', $id)
                                    ->where('time', '<', $now)
                                    ->get();
        $appointments->transform(function ($appointment) {
        if ($appointment->medic) {
            // Substituir 'medic' pelo nome do médico
            $name = Userdata::where('id', $appointment->medic)->value('name');
            $appointment->medic = $name;
        }
        if (is_null($appointment->therapeutics_used)) {
            $appointment->therapeutics_used = 'Nenhuma anotação disponível';
        }
        if (is_null($appointment->professional)) {
            $appointment->professional = 'Nenhuma anotação disponível';
        }
        if (is_null($appointment->referrals_made)) {
            $appointment->referrals_made = 'Nenhuma anotação disponível';
        }
        return $appointment;
        });
        return response()->json($appointments);
    }


    /**
     * Função para a secretaria. Mostra todas as consultas do dia.
     */
    public function show_today_appointments() {
        $todayStart = Carbon::today();
        $todayEnd = Carbon::today()->endOfDay();
        $appointments = Appointment::where('time', '>=', $todayStart)
                               ->where('time', '<=', $todayEnd)
                               ->get();
        return response()->json($appointments);
    }
    /**
     * Função para a psicologa. Mostra todas as consultas dela do dia.
     */
    public function show_today_appointments_psychologist($id) {
        $todayStart = Carbon::today();
        $todayEnd = Carbon::today()->endOfDay();
        $appointments = Appointment::where('medic', $id)
                               ->where('time', '>=', $todayStart)
                               ->where('time', '<=', $todayEnd)
                               ->get();
        return response()->json($appointments);
    }

    /**
     * Atualiza a consulta como 'done'
     */
    public function update($id)
    {
        try {
        $appointment = Appointment::findOrFail($id);
        $appointment->done = true;
        $appointment->save();
        return response()->json(['message'=> 'Consulta atualizada.'],200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=> 'Consulta não encontrada'],404);
        }
    }

    public function setObservation(Request $request, $id) { // nao sei se esta funcionando 100%
        try {
            $validated = $request->validate([
                'id' => 'required',
                'patient' => 'required|integer',
                'medic' => 'required|integer',
                'time' => 'required|date',
                'professional' => 'nullable',
                'referrals_made' => 'nullable',
                'therapeutics_used' => 'nullable',
                'done' => 'required',
            ]);

            // $appointment = Appointment::findOrFail($id);
            // $validated->save();
            $appointment = Appointment::updateOrCreate(
                [
                    'patient' => $validated['patient'],
                    'medic' => $validated['medic'],
                    'time' => $validated['time']
                ],
                [
                    'professional' => $validated['professional'],
                    'referrals_made' => $validated['referrals_made'],
                    'therapeutics_used' => $validated['therapeutics_used'],
                    'done' => $validated['done'],
                ]
            );
            return response()->json(['message'=> 'Consulta atualizada.'],200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=> 'Consulta não encontrada'],404);
        }
    }
}
