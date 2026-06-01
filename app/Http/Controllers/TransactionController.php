<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction');
    }

    public function history()
    {
        return view('history');
    }

    public function getTransactions(Request $request)
    {
        $role = Session::get('user_role');
        
        try {
            $response = Http::withHeaders(['X-User-Role' => $role])
                ->get('http://localhost:8080/api/transaksi', [
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

    public function export(Request $request)
    {
        $role = Session::get('user_role');
        
        try {
            $response = Http::withHeaders(['X-User-Role' => $role])
                ->get('http://localhost:8080/api/transaksi', [
                    'page' => 1,
                    'limit' => 1000
                ]);

            $transactions = collect($response->json('data', []))->map(function($transaction) {
                return [
                    'id_transaksi' => $transaction['id_transaksi'],
                    'produk' => $transaction['nama_produk'],
                    'customer' => $transaction['nama_customer'],
                    'quantity' => $transaction['qty'],
                    'total_harga' => $transaction['total_harga'],
                    'metode_pembayaran' => strtoupper($transaction['metode_pembayaran']),
                    'tanggal' => date('d/m/Y H:i:s', strtotime($transaction['created_at']))
                ];
            });
            
            return response()->json([
                'success' => true,
                'data' => $transactions,
                'total' => count($transactions)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Connection error: ' . $e->getMessage()
            ]);
        }
    }

    public function storeBulk(Request $request)
    {
        $role = Session::get('user_role');
        $results = [];
        $totalAmount = 0;
        
        try {
            foreach ($request->items as $item) {
                $response = Http::withHeaders(['X-User-Role' => $role])
                    ->post('http://localhost:8080/api/transaksi', [
                        'id_produk' => $item['id_produk'],
                        'qty' => $item['qty'],
                        'custcd' => $request->custcd,
                        'metode_pembayaran' => $request->metode_pembayaran,
                        'jenis_harga' => $item['jenis_harga'],
                    ]);
                
                if ($response->successful()) {
                    $results[] = $response->json();
                    $totalAmount += $response->json('total_harga', 0);
                }
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil',
                'total_amount' => $totalAmount,
                'count' => count($results)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection error: ' . $e->getMessage()
            ]);
        }
    }
}
