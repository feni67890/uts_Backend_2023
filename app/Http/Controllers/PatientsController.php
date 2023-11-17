<?php

namespace App\Http\Controllers;

use App\Models\patients;
use Illuminate\Http\Request;

class PatientsController extends Controller
{

    public function index()
    {
        $patients = Patients::all();

        if (!empty($patients)) {
            $data = [
                'message' => 'Get All patients',
                'data' => $patients,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data not found',
                'data' => [],
            ];

            return response()->json($data, 404);
        }
    }

    public function show($id)
    {
        $patients = Patients::find($id);

        if ($patients) {
            $data = [
                'message' => 'Get detail patient',
                'data' => $patients,
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Patient not found',
            ];
            return response()->json($data, 404);
        }
    }

    public function store(Request $request)
    {
        $input = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'in_date_at' => $request->in_date_at,
            'out_date_at' => $request->out_date_at,
        ];

        $patients = Patients::create($input);

        $response = [
            'message' => 'Data patients berhasil dibuat',
            'data' => $patients,
        ];

        return response()->json($response, 201);
    }

    public function update(Request $request, $id)
    {
        $patients = Patients::find($id);

        if (!$patients) {
            $data = [
                'message' => 'Patient not found',
            ];

            return response()->json($data, 404);
        }

        $input = [
            'name' => $request->name ?? $patients->name,
            'phone' => $request->phone ?? $patients->phone,
            'address' => $request->address ?? $patients->address,
            'status' => $request->status ?? $patients->status,
            'in_date_at' => $request->in_date_at ?? $patients->in_date_at,
            'out_date_at' => $request->out_date_at ?? $patients->out_date_at,
        ];

        $patients->update($input);

        $data = [
            'message' => 'Patients successfully edited',
            'data' => $patients,
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $patients = Patients::find($id);

        if ($patients) {
            $patients->delete();
            $response = [
                'message' => 'Patients is deleted',
                'data' => $patients,
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'message' => 'Data not found',
            ];

            return response()->json($response, 404);
        }
    }

    // mencari pasien berdasarkan nama
    public function search(Request $request)
    {
        $name = $request->input('name');
        $patients = Patients::where('name', 'like', "%{$name}%")->get();
        return response()->json(['data' => $patients], 200);
    }

    // mendapatkan pasien dengan status positif
    public function positive()
    {
        $patients = Patients::where('status', 'Positive')
            ->get();
        return response()->json(['data' => $patients], 200);
    }

    // mendapatkan pasien dengan status negatif
    public function recovered()
    {
        $patients = Patients::where('status', 'Recovered')
            ->get();
        return response()->json(['data' => $patients], 200);
    }

    // mendapatakan status pasien yang sudah mati
    public function dead()
    {
        $patients = Patients::where('status', 'Dead')
            ->get();
        return response()->json(['data' => $patients], 200);
    }
}
