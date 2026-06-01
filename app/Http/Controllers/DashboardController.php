<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Session::get('user_role');
        
        try {
            // Panggil API Golang untuk mendapatkan statistik
            $customers = Http::withHeaders(['X-User-Role' => $role])
                ->get('http://localhost:8080/api/customers?page=1&limit=1');
            
            $products = Http::withHeaders(['X-User-Role' => $role])
                ->get('http://localhost:8080/api/produk?page=1&limit=1');
            
            $transactions = Http::withHeaders(['X-User-Role' => $role])
                ->get('http://localhost:8080/api/transaksi?page=1&limit=100');

            $stats = [
                'customers' => $customers->json('total') ?? 0,
                'products' => $products->json('total') ?? 0,
                'transactions' => $transactions->json('total') ?? 0,
                'revenue' => collect($transactions->json('data') ?? [])->sum('total_harga'),
            ];

            return view('dashboard', compact('stats'));
        } catch (\Exception $e) {
            return view('dashboard', ['stats' => [
                'customers' => 0, 
                'products' => 0, 
                'transactions' => 0, 
                'revenue' => 0
            ]]);
        }
    }
}