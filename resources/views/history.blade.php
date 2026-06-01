@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="flex h-screen bg-gray-100" x-data="historyApp()" x-init="init()">
    @include('components.sidebar')
    
    <main class="flex-1 overflow-y-auto p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h2 class="text-2xl font-bold">Riwayat Transaksi</h2>
            <div class="flex gap-2">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" x-model="search" @input="filterTransactions" placeholder="Cari transaksi..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-64">
                </div>
                
                <!-- Tombol Export Excel -->
                <button @click="exportToExcel" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center space-x-2 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span>Export Excel</span>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pembayaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="transaction in paginatedTransactions" :key="transaction.id_transaksi">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="transaction.id_transaksi"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="transaction.nama_produk"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="transaction.nama_customer"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="transaction.qty"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 font-medium" x-text="'Rp ' + (transaction.total_harga || 0).toLocaleString('id-ID')"></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium" 
                                        :class="{'bg-green-100 text-green-800': transaction.metode_pembayaran === 'cash', 
                                                 'bg-blue-100 text-blue-800': transaction.metode_pembayaran === 'qris', 
                                                 'bg-purple-100 text-purple-800': transaction.metode_pembayaran === 'transfer'}" 
                                        x-text="transaction.metode_pembayaran ? transaction.metode_pembayaran.toUpperCase() : '-'">
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" x-text="transaction.created_at ? new Date(transaction.created_at).toLocaleString('id-ID') : '-'"></td>
                            </tr>
                        </template>
                        <tr x-show="filteredTransactions.length === 0">
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">Tidak ada data transaksi</td>
                        </tr>
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
</div>

<script>
function historyApp() {
    return {
        transactions: [],
        filteredTransactions: [],
        search: '',
        loading: false,
        currentPage: 1,
        itemsPerPage: 10,
        
        async init() { await this.fetchTransactions(); },
        
        async fetchTransactions() {
            this.loading = true;
            try {
                const response = await fetch('/transactions/data');
                const data = await response.json();
                this.transactions = data.data || [];
                this.filteredTransactions = this.transactions;
            } catch (error) {
                Swal.fire('Error', 'Gagal mengambil data transaksi', 'error');
            } finally { this.loading = false; }
        },
        
        filterTransactions() {
            if (!this.search) { this.filteredTransactions = this.transactions; }
            else {
                const searchLower = this.search.toLowerCase();
                this.filteredTransactions = this.transactions.filter(t => 
                    (t.nama_produk && t.nama_produk.toLowerCase().includes(searchLower)) ||
                    (t.nama_customer && t.nama_customer.toLowerCase().includes(searchLower))
                );
            }
            this.currentPage = 1;
        },
        
        get paginatedTransactions() { return this.filteredTransactions.slice((this.currentPage - 1) * this.itemsPerPage, this.currentPage * this.itemsPerPage); },
        get totalPages() { return Math.ceil(this.filteredTransactions.length / this.itemsPerPage); },
        prevPage() { if (this.currentPage > 1) this.currentPage--; },
        nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
        
        async exportToExcel() {
            try {
                Swal.fire({ title: 'Loading', text: 'Mengambil data transaksi...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                
                const response = await fetch('/transactions/export');
                const data = await response.json();
                
                Swal.close();
                
                if (data.success && data.data.length > 0) {
                    const wsData = data.data.map(transaction => ({
                        'ID Transaksi': transaction.id_transaksi,
                        'Produk': transaction.produk,
                        'Customer': transaction.customer,
                        'Quantity': transaction.quantity,
                        'Total Harga': `Rp ${(transaction.total_harga || 0).toLocaleString('id-ID')}`,
                        'Metode Pembayaran': transaction.metode_pembayaran,
                        'Tanggal': transaction.tanggal
                    }));
                    
                    const ws = XLSX.utils.json_to_sheet(wsData);
                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Transactions');
                    XLSX.writeFile(wb, `transactions_${new Date().toISOString().split('T')[0]}.xlsx`);
                    Swal.fire('Sukses', `Berhasil export ${data.data.length} data transaksi`, 'success');
                } else {
                    Swal.fire('Info', 'Tidak ada data transaksi untuk diexport', 'info');
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
