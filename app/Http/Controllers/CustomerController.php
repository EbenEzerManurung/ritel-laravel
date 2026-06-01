<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers');
    }

    public function getCustomers(Request $request)
    {
        $role = Session::get('user_role');
        
        try {
            $response = Http::withHeaders(['X-User-Role' => $role])
                ->get('http://localhost:8080/api/customers', [
                    'page' => $request->get('page', 1),
                    'limit' => $request->get('limit', 100)
                ]);

            return response()->json([
                'success' => true,
                'data' => $response->json('data', []),
                'total' => $response->json('total', 0)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Connection error'
            ]);
        }
    }

    public function export()
    {
        $role = Session::get('user_role');
        
        try {
            $response = Http::withHeaders(['X-User-Role' => $role])
                ->get('http://localhost:8080/api/customers', [
                    'page' => 1,
                    'limit' => 1000
                ]);

            $customers = $response->json('data', []);
            
            return response()->json([
                'success' => true,
                'data' => $customers,
                'total' => count($customers)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Connection error: ' . $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        $role = Session::get('user_role');
        
        try {
            $response = Http::withHeaders(['X-User-Role' => $role])
                ->post('http://localhost:8080/api/customers', $request->all());

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Customer berhasil ditambahkan'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan customer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection error'
            ]);
        }
    }

    public function update(Request $request, $custcd)
    {
        $role = Session::get('user_role');
        
        try {
            $response = Http::withHeaders(['X-User-Role' => $role])
                ->put("http://localhost:8080/api/customers/{$custcd}", $request->all());

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Customer berhasil diupdate'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate customer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection error'
            ]);
        }
    }

    public function destroy($custcd)
    {
        $role = Session::get('user_role');
        
        try {
            $response = Http::withHeaders(['X-User-Role' => $role])
                ->delete("http://localhost:8080/api/customers/{$custcd}");

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Customer berhasil dihapus'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus customer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection error'
            ]);
        }
    }
}
