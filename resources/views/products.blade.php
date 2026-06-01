@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
<div class="flex h-screen bg-gray-100" x-data="productApp()" x-init="init()">
    @include('components.sidebar')
    
    <main class="flex-1 overflow-y-auto p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h2 class="text-2xl font-bold">Data Produk</h2>
            <div class="flex gap-2">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" x-model="search" @input="filterProducts" placeholder="Cari produk..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-64">
                </div>
                
                <!-- Tombol Export Excel -->
                <button @click="exportToExcel" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center space-x-2 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span>Export Excel</span>
                </button>
                
                <!-- Tombol Tambah -->
                <button @click="openModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center space-x-2 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Tambah Produk</span>
                </button>
            </div>
        </div>

        <div x-show="loading" class="flex justify-center items-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
        </div>

        <div x-show="!loading" class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Regular</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga SW</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga D</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="product in paginatedProducts" :key="product.id_produk">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="product.id_produk"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="product.nama_produk"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="product.stok_produk"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="'Rp ' + (product.price_r || 0).toLocaleString('id-ID')"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-medium" x-text="'Rp ' + (product.price_sw || 0).toLocaleString('id-ID')"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-red-600 font-medium" x-text="'Rp ' + (product.price_d || 0).toLocaleString('id-ID')"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button @click="editProduct(product)" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </button>
                                    <button @click="deleteProduct(product.id_produk)" class="text-red-600 hover:text-red-900">
                                        <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="!loading && totalPages > 1" class="flex justify-center items-center space-x-2 mt-6">
            <button @click="prevPage" :disabled="currentPage === 1" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg disabled:opacity-50 hover:bg-gray-300">Previous</button>
            <span class="text-gray-700" x-text="'Halaman ' + currentPage + ' dari ' + totalPages"></span>
            <button @click="nextPage" :disabled="currentPage === totalPages" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg disabled:opacity-50 hover:bg-gray-300">Next</button>
        </div>
    </main>

    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;" x-cloak>
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-xl font-bold mb-4" x-text="editingProduct ? 'Edit Produk' : 'Tambah Produk'"></h3>
            <form @submit.prevent="saveProduct">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" x-model="form.nama_produk" class="input-field" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                        <input type="number" x-model="form.stok_produk" class="input-field" min="0" required>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function productApp() {
    return {
        products: [],
        filteredProducts: [],
        search: '',
        loading: false,
        showModal: false,
        editingProduct: null,
        form: { nama_produk: '', stok_produk: 0 },
        currentPage: 1,
        itemsPerPage: 10,
        
        async init() { await this.fetchProducts(); },
        
        async fetchProducts() {
            this.loading = true;
            try {
                const response = await fetch('/products/data');
                const data = await response.json();
                this.products = data.data || [];
                this.filteredProducts = this.products;
            } catch (error) {
                Swal.fire('Error', 'Gagal mengambil data produk', 'error');
            } finally { this.loading = false; }
        },
        
        filterProducts() {
            if (!this.search) { this.filteredProducts = this.products; }
            else {
                const searchLower = this.search.toLowerCase();
                this.filteredProducts = this.products.filter(p => p.nama_produk.toLowerCase().includes(searchLower));
            }
            this.currentPage = 1;
        },
        
        get paginatedProducts() { return this.filteredProducts.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage); },
        get totalPages() { return Math.ceil(this.filteredProducts.length / this.itemsPerPage); },
        prevPage() { if (this.currentPage > 1) this.currentPage--; },
        nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
        
        openModal(product = null) {
            if (product) { this.editingProduct = product; this.form = { nama_produk: product.nama_produk, stok_produk: product.stok_produk }; }
            else { this.editingProduct = null; this.form = { nama_produk: '', stok_produk: 0 }; }
            this.showModal = true;
        },
        editProduct(product) { this.openModal(product); },
        closeModal() { this.showModal = false; },
        
        async saveProduct() {
            try {
                const url = this.editingProduct ? `/products/${this.editingProduct.id_produk}` : '/products';
                const method = this.editingProduct ? 'PUT' : 'POST';
                const response = await fetch(url, {
                    method, headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify(this.form)
                });
                const result = await response.json();
                if (result.success) { Swal.fire('Sukses', result.message, 'success'); this.closeModal(); await this.fetchProducts(); }
                else { Swal.fire('Error', result.message, 'error'); }
            } catch (error) { Swal.fire('Error', 'Terjadi kesalahan', 'error'); }
        },
        
        async deleteProduct(id) {
            const result = await Swal.fire({ title: 'Yakin?', text: "Data produk akan dihapus!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Ya, hapus!' });
            if (result.isConfirmed) {
                const response = await fetch(`/products/${id}`, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } });
                const data = await response.json();
                if (data.success) { Swal.fire('Terhapus!', data.message, 'success'); await this.fetchProducts(); }
            }
        },
        
        async exportToExcel() {
            try {
                Swal.fire({ title: 'Loading', text: 'Mengambil data untuk export...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                
                const response = await fetch('/products/export');
                const data = await response.json();
                
                Swal.close();
                
                if (data.success && data.data.length > 0) {
                    const wsData = data.data.map(product => ({
                        'ID Produk': product.id_produk,
                        'Nama Produk': product.nama_produk,
                        'Stok': product.stok_produk,
                        'Harga Regular': `Rp ${(product.harga_regular || 0).toLocaleString('id-ID')}`,
                        'Harga SW (25%)': `Rp ${(product.harga_sw || 0).toLocaleString('id-ID')}`,
                        'Harga D (35%)': `Rp ${(product.harga_d || 0).toLocaleString('id-ID')}`
                    }));
                    
                    const ws = XLSX.utils.json_to_sheet(wsData);
                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Products');
                    XLSX.writeFile(wb, `products_${new Date().toISOString().split('T')[0]}.xlsx`);
                    Swal.fire('Sukses', `Berhasil export ${data.data.length} data produk`, 'success');
                } else {
                    Swal.fire('Info', 'Tidak ada data untuk diexport', 'info');
                }
            } catch (error) {
                Swal.close();
                Swal.fire('Error', 'Gagal mengexport data: ' + error.message, 'error');
            }
        }
    }
}
</script>
@endsection
