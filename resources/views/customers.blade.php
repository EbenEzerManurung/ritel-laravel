@extends('layouts.app')

@section('title', 'Data Customer')

@section('content')
<div class="flex h-screen bg-gray-100" x-data="customerApp()" x-init="init()">
    @include('components.sidebar')
    
    <main class="flex-1 overflow-y-auto p-8">
        <!-- Header dengan Tombol Export -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <h2 class="text-2xl font-bold">Data Customer</h2>
            <div class="flex gap-2 w-full sm:w-auto">
                <!-- Search Box -->
                <div class="relative flex-1 sm:flex-initial">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" x-model="search" @input="filterCustomers" placeholder="Cari customer..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-64">
                </div>
                
                <!-- Tombol Export Excel -->
                <button @click="exportToExcel" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center space-x-2 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span>Export Excel</span>
                </button>
                
                <!-- Tombol Tambah (Admin only) -->
                @if(session('user_role') === 'admin')
                    <button @click="openModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center space-x-2 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Tambah Customer</span>
                    </button>
                @endif
            </div>
        </div>

        <!-- Loading Spinner -->
        <div x-show="loading" class="flex justify-center items-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
        </div>

        <!-- Tabel Data -->
        <div x-show="!loading" class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telepon</th>
                            @if(session('user_role') === 'admin')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="customer in paginatedCustomers" :key="customer.custcd">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="customer.custcd"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="customer.nama_customer"></td>
                                <td class="px-6 py-4 text-sm text-gray-900 max-w-md break-words" x-text="customer.address ? customer.address.substring(0, 50) : '-'"></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" x-text="customer.phone || '-'"></td>
                                @if(session('user_role') === 'admin')
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button @click="editCustomer(customer)" class="text-blue-600 hover:text-blue-900 mr-3">
                                            <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </button>
                                        <button @click="deleteCustomer(customer.custcd)" class="text-red-600 hover:text-red-900">
                                            <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        </template>
                        <tr x-show="filteredCustomers.length === 0">
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">Tidak ada data customer</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div x-show="!loading && totalPages > 1" class="flex justify-center items-center space-x-2 mt-6">
            <button @click="prevPage" :disabled="currentPage === 1" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg disabled:opacity-50 hover:bg-gray-300 transition-colors">Previous</button>
            <span class="text-gray-700" x-text="'Halaman ' + currentPage + ' dari ' + totalPages"></span>
            <button @click="nextPage" :disabled="currentPage === totalPages" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg disabled:opacity-50 hover:bg-gray-300 transition-colors">Next</button>
        </div>
    </main>

    <!-- Modal Form Tambah/Edit -->
    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" style="display: none;" x-cloak>
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-xl font-bold mb-4" x-text="editingCustomer ? 'Edit Customer' : 'Tambah Customer'"></h3>
            <form @submit.prevent="saveCustomer">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kode Customer</label>
                        <input type="text" x-model="form.custcd" class="input-field" :disabled="editingCustomer" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Customer</label>
                        <input type="text" x-model="form.nama_customer" class="input-field" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea x-model="form.address" class="input-field" rows="3"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                        <input type="tel" x-model="form.phone" class="input-field">
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function customerApp() {
    return {
        customers: [],
        filteredCustomers: [],
        search: '',
        loading: false,
        showModal: false,
        editingCustomer: null,
        form: { custcd: '', nama_customer: '', address: '', phone: '' },
        currentPage: 1,
        itemsPerPage: 10,
        
        async init() {
            await this.fetchCustomers();
        },
        
        async fetchCustomers() {
            this.loading = true;
            try {
                const response = await fetch('/customers/data');
                const data = await response.json();
                this.customers = data.data || [];
                this.filteredCustomers = this.customers;
            } catch (error) {
                Swal.fire('Error', 'Gagal mengambil data customer', 'error');
            } finally {
                this.loading = false;
            }
        },
        
        filterCustomers() {
            if (!this.search) {
                this.filteredCustomers = this.customers;
            } else {
                const searchLower = this.search.toLowerCase();
                this.filteredCustomers = this.customers.filter(c => 
                    c.nama_customer.toLowerCase().includes(searchLower) ||
                    c.custcd.toLowerCase().includes(searchLower)
                );
            }
            this.currentPage = 1;
        },
        
        get paginatedCustomers() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            return this.filteredCustomers.slice(start, start + this.itemsPerPage);
        },
        
        get totalPages() {
            return Math.ceil(this.filteredCustomers.length / this.itemsPerPage);
        },
        
        prevPage() { if (this.currentPage > 1) this.currentPage--; },
        nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
        
        openModal(customer = null) {
            if (customer) {
                this.editingCustomer = customer;
                this.form = { ...customer };
            } else {
                this.editingCustomer = null;
                this.form = { custcd: '', nama_customer: '', address: '', phone: '' };
            }
            this.showModal = true;
        },
        
        editCustomer(customer) { this.openModal(customer); },
        closeModal() { this.showModal = false; },
        
        async saveCustomer() {
            try {
                const url = this.editingCustomer ? `/customers/${this.editingCustomer.custcd}` : '/customers';
                const method = this.editingCustomer ? 'PUT' : 'POST';
                
                const response = await fetch(url, {
                    method: method,
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify(this.form)
                });
                
                const result = await response.json();
                if (result.success) {
                    Swal.fire('Sukses', result.message, 'success');
                    this.closeModal();
                    await this.fetchCustomers();
                } else {
                    Swal.fire('Error', result.message || 'Gagal menyimpan data', 'error');
                }
            } catch (error) {
                Swal.fire('Error', 'Terjadi kesalahan', 'error');
            }
        },
        
        async deleteCustomer(custcd) {
            const result = await Swal.fire({
                title: 'Yakin?', 
                text: "Data customer akan dihapus permanen!", 
                icon: 'warning',
                showCancelButton: true, 
                confirmButtonColor: '#d33', 
                confirmButtonText: 'Ya, hapus!', 
                cancelButtonText: 'Batal'
            });
            if (result.isConfirmed) {
                const response = await fetch(`/customers/${custcd}`, {
                    method: 'DELETE', 
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                });
                const data = await response.json();
                if (data.success) {
                    Swal.fire('Terhapus!', data.message, 'success');
                    await this.fetchCustomers();
                }
            }
        },
        
        async exportToExcel() {
            try {
                Swal.fire({ title: 'Loading', text: 'Mengambil data untuk export...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                
                const response = await fetch('/customers/export');
                const data = await response.json();
                
                Swal.close();
                
                if (data.success && data.data.length > 0) {
                    const wsData = data.data.map(customer => ({
                        'Kode Customer': customer.custcd,
                        'Nama Customer': customer.nama_customer,
                        'Alamat': customer.address || '-',
                        'Telepon': customer.phone || '-'
                    }));
                    
                    const ws = XLSX.utils.json_to_sheet(wsData);
                    const wb = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(wb, ws, 'Customers');
                    XLSX.writeFile(wb, `customers_${new Date().toISOString().split('T')[0]}.xlsx`);
                    Swal.fire('Sukses', `Berhasil export ${data.data.length} data customer`, 'success');
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
