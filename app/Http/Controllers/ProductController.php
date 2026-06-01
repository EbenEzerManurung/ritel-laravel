<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        return view('products');
    }

    public function getProducts(Request $request)
    {
        $role = Session::get('user_role');
        
        try {
            $response = Http::withHeaders(['X-User-Role' => $role])
                ->get('http://localhost:8080/api/produk', [
                    'page' => $request->get('page', 1),
                    'limit' => $request->get('limit', 100)
                ]);

            // Get prices
            $pricesResponse = Http::withHeaders(['X-User-Role' => $role])
                ->get('http://localhost:8080/api/harga');
            
            $prices = collect($pricesResponse->json());
            
            $products = collect($response->json('data', []))->map(function($product) use ($prices) {
                $productPrices = $prices->where('id_produk', $product['id_produk']);
                $product['price_r'] = $productPrices->where('jenis_harga', 'R')->first()['harga_produk'] ?? 0;
                $product['price_sw'] = $productPrices->where('jenis_harga', 'SW')->first()['harga_produk'] ?? 0;
                $product['price_d'] = $productPrices->where('jenis_harga', 'D')->first()['harga_produk'] ?? 0;
                return $product;
            });

            return response()->json([
                'success' => true,
                'data' => $products,
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
                ->get('http://localhost:8080/api/produk', [
                    'page' => 1,
                    'limit' => 1000
                ]);

            // Get prices
            $pricesResponse = Http::withHeaders(['X-User-Role' => $role])
                ->get('http://localhost:8080/api/harga');
            
            $prices = collect($pricesResponse->json());
            
            $products = collect($response->json('data', []))->map(function($product) use ($prices) {
                $productPrices = $prices->where('id_produk', $product['id_produk']);
                return [
                    'id_produk' => $product['id_produk'],
                    'nama_produk' => $product['nama_produk'],
                    'stok_produk' => $product['stok_produk'],
                    'harga_regular' => $productPrices->where('jenis_harga', 'R')->first()['harga_produk'] ?? 0,
                    'harga_sw' => $productPrices->where('jenis_harga', 'SW')->first()['harga_produk'] ?? 0,
                    'harga_d' => $productPrices->where('jenis_harga', 'D')->first()['harga_produk'] ?? 0,
                ];
            });
            
            return response()->json([
                'success' => true,
                'data' => $products,
                'total' => count($products)
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
                ->post('http://localhost:8080/api/produk', $request->only(['nama_produk', 'stok_produk']));

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Produk berhasil ditambahkan'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection error'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $role = Session::get('user_role');
        
        try {
            $response = Http::withHeaders(['X-User-Role' => $role])
                ->put("http://localhost:8080/api/produk/{$id}", $request->only(['nama_produk', 'stok_produk']));

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Produk berhasil diupdate'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate produk'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection error'
            ]);
        }
    }

    public function destroy($id)
    {
        $role = Session::get('user_role');
        
        try {
            $response = Http::withHeaders(['X-User-Role' => $role])
                ->delete("http://localhost:8080/api/produk/{$id}");

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Produk berhasil dihapus'
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus produk'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection error'
            ]);
        }
    }
}
