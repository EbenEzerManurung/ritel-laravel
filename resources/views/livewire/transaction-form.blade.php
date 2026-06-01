<div x-data="transactionForm()" x-init="init()" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column - Form -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Informasi Transaksi</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Customer</label>
                    <select x-model="selectedCustomer" class="input-field">
                        <option value="">Pilih Customer</option>
                        <template x-for="customer in customers" :key="customer.custcd">
                            <option :value="customer.custcd" x-text="customer.nama_customer + ' (' + customer.custcd + ')'"></option>
                        </template>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                    <select x-model="paymentMethod" class="input-field">
                        <option value="cash">Cash</option>
                        <option value="qris">QRIS</option>
                        <option value="transfer">Transfer Bank</option>
                    </select>
                </div>
            </div>

            <div class="border-t mt-6 pt-6">
                <h3 class="text-lg font-semibold mb-4">Tambah Produk</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Produk</label>
                        <select x-model="selectedProduct" class="input-field">
                            <option value="">Pilih Produk</option>
                            <template x-for="product in products" :key="product.id_produk">
                                <option :value="product.id_produk" x-text="product.nama_produk + ' (Stok: ' + product.stok_produk + ')'"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Harga</label>
                        <select x-model="selectedPriceType" class="input-field">
                            <option value="R">Regular</option>
                            <option value="SW">Special Weekday (Diskon 25%)</option>
                            <option value="D">Discount (Diskon 35%)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                        <input type="number" x-model="quantity" class="input-field" min="1">
                    </div>

                    <div class="flex items-end">
                        <button type="button" @click="addToCart" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 flex items-center justify-center space-x-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Tambah ke Keranjang</span>
                        </button>
                    </div>
                </div>

                <div x-show="selectedProduct" class="mt-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <p class="text-sm text-blue-800">
                        Harga: <span class="font-bold" x-text="'Rp ' + getProductPrice().toLocaleString('id-ID')"></span> / unit
                    </p>
                    <p class="text-sm text-blue-800 mt-1" x-text="'Stok tersedia: ' + getMaxStock() + ' unit'"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column - Cart -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-lg shadow p-6 sticky top-4">
            <h3 class="text-lg font-semibold mb-4">Keranjang Belanja</h3>
            
            <template x-if="cart.length === 0">
                <p class="text-gray-500 text-center py-8">Belum ada produk</p>
            </template>
            
            <template x-if="cart.length > 0">
                <div>
                    <div class="space-y-3 max-h-96 overflow-y-auto">
                        <template x-for="(item, index) in cart" :key="index">
                            <div class="border rounded-lg p-3">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800" x-text="item.nama_produk"></p>
                                        <p class="text-xs" :class="getPriceTypeColor(item.jenis_harga)" x-text="getPriceTypeLabel(item.jenis_harga)"></p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-sm text-gray-600" x-text="'Rp ' + item.harga_satuan.toLocaleString('id-ID')"></span>
                                            <span class="text-gray-400">x</span>
                                            <input type="number" x-model="item.qty" @change="updateCartQuantity(index, $event.target.value)" class="w-16 px-1 py-0 border border-gray-300 rounded text-center" min="1">
                                            <span class="text-gray-400">=</span>
                                            <span class="text-sm font-semibold text-blue-600" x-text="'Rp ' + item.subtotal.toLocaleString('id-ID')"></span>
                                        </div>
                                    </div>
                                    <button @click="removeFromCart(index)" class="text-red-600 hover:text-red-800">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                    
                    <div class="border-t mt-4 pt-4">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-lg font-semibold">Total:</span>
                            <span class="text-2xl font-bold text-blue-600" x-text="'Rp ' + totalHarga.toLocaleString('id-ID')"></span>
                        </div>
                        
                        <button @click="submitTransaction" :disabled="loading || cart.length === 0 || !selectedCustomer" class="w-full btn-primary py-3 text-lg disabled:opacity-50">
                            <span x-show="!loading" x-text="'Bayar Rp ' + totalHarga.toLocaleString('id-ID')"></span>
                            <span x-show="loading">Memproses...</span>
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

@push('scripts')
<script>
function transactionForm() {
    return {
        products: [],
        customers: [],
        prices: [],
        selectedCustomer: '',
        paymentMethod: 'cash',
        loading: false,
        cart: [],
        selectedProduct: '',
        selectedPriceType: 'R',
        quantity: 1,
        
        async init() {
            await this.fetchData();
        },
        
        async fetchData() {
            try {
                const role = '{{ session('user_role') }}';
                const [productsRes, customersRes, pricesRes] = await Promise.all([
                    fetch('/products/data?limit=100').then(r => r.json()),
                    fetch('/customers/data?limit=100').then(r => r.json()),
                    fetch('http://localhost:8080/api/harga', { headers: { 'X-User-Role': role } }).then(r => r.json())
                ]);
                
                this.products = productsRes.data || [];
                this.customers = customersRes.data || [];
                this.prices = pricesRes;
            } catch (error) {
                console.error('Error fetching data:', error);
                Swal.fire('Error', 'Gagal mengambil data', 'error');
            }
        },
        
        getProductPrice() {
            const price = this.prices.find(p => p.id_produk === parseInt(this.selectedProduct) && p.jenis_harga === this.selectedPriceType);
            return price ? price.harga_produk : 0;
        },
        
        getProductStock() {
            const product = this.products.find(p => p.id_produk === parseInt(this.selectedProduct));
            return product ? product.stok_produk : 0;
        },
        
        getProductName() {
            const product = this.products.find(p => p.id_produk === parseInt(this.selectedProduct));
            return product ? product.nama_produk : '';
        },
        
        getMaxStock() {
            if (!this.selectedProduct) return 0;
            const stock = this.getProductStock();
            const existingItem = this.cart.find(item => item.id_produk === parseInt(this.selectedProduct) && item.jenis_harga === this.selectedPriceType);
            return stock - (existingItem?.qty || 0);
        },
        
        addToCart() {
            if (!this.selectedProduct) {
                Swal.fire('Peringatan', 'Pilih produk terlebih dahulu', 'warning');
                return;
            }
            
            const productId = parseInt(this.selectedProduct);
            const price = this.getProductPrice();
            const maxStock = this.getMaxStock();
            
            if (this.quantity < 1) {
                Swal.fire('Peringatan', 'Quantity minimal 1', 'warning');
                return;
            }
            
            if (this.quantity > maxStock) {
                Swal.fire('Error', `Stok tidak mencukupi. Tersisa ${maxStock} unit`, 'error');
                return;
            }
            
            const existingIndex = this.cart.findIndex(item => item.id_produk === productId && item.jenis_harga === this.selectedPriceType);
            
            if (existingIndex !== -1) {
                this.cart[existingIndex].qty += this.quantity;
                this.cart[existingIndex].subtotal = this.cart[existingIndex].qty * this.cart[existingIndex].harga_satuan;
            } else {
                this.cart.push({
                    id_produk: productId,
                    nama_produk: this.getProductName(),
                    qty: this.quantity,
                    harga_satuan: price,
                    jenis_harga: this.selectedPriceType,
                    subtotal: price * this.quantity
                });
            }
            
            this.selectedProduct = '';
            this.selectedPriceType = 'R';
            this.quantity = 1;
            Swal.fire('Sukses', 'Produk ditambahkan ke keranjang', 'success');
        },
        
        removeFromCart(index) {
            this.cart.splice(index, 1);
            Swal.fire('Sukses', 'Produk dihapus dari keranjang', 'success');
        },
        
        updateCartQuantity(index, newQty) {
            newQty = parseInt(newQty);
            if (newQty < 1) {
                Swal.fire('Peringatan', 'Quantity minimal 1', 'warning');
                return;
            }
            
            const item = this.cart[index];
            const maxStock = this.getProductStockFromId(item.id_produk);
            
            if (newQty > maxStock) {
                Swal.fire('Error', `Stok tidak mencukupi. Maksimal ${maxStock} unit`, 'error');
                return;
            }
            
            this.cart[index].qty = newQty;
            this.cart[index].subtotal = newQty * this.cart[index].harga_satuan;
        },
        
        getProductStockFromId(productId) {
            const product = this.products.find(p => p.id_produk === productId);
            return product ? product.stok_produk : 0;
        },
        
        getPriceTypeLabel(type) {
            const labels = { 'R': 'Regular', 'SW': 'Special Weekday (25% off)', 'D': 'Discount (35% off)' };
            return labels[type] || type;
        },
        
        getPriceTypeColor(type) {
            const colors = { 'R': 'text-gray-600', 'SW': 'text-green-600', 'D': 'text-red-600' };
            return colors[type] || 'text-gray-600';
        },
        
        get totalHarga() {
            return this.cart.reduce((sum, item) => sum + item.subtotal, 0);
        },
        
        async submitTransaction() {
            if (!this.selectedCustomer) {
                Swal.fire('Peringatan', 'Pilih customer terlebih dahulu', 'warning');
                return;
            }
            
            if (this.cart.length === 0) {
                Swal.fire('Peringatan', 'Tambahkan produk ke keranjang terlebih dahulu', 'warning');
                return;
            }
            
            this.loading = true;
            
            try {
                const response = await fetch('/transactions/bulk', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        items: this.cart.map(item => ({
                            id_produk: item.id_produk,
                            qty: item.qty,
                            jenis_harga: item.jenis_harga
                        })),
                        custcd: this.selectedCustomer,
                        metode_pembayaran: this.paymentMethod
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    Swal.fire('Sukses', `Transaksi berhasil! Total: Rp ${result.total_amount.toLocaleString('id-ID')}`, 'success');
                    this.cart = [];
                    this.selectedCustomer = '';
                    this.paymentMethod = 'cash';
                    await this.fetchData();
                } else {
                    Swal.fire('Error', result.message || 'Gagal melakukan transaksi', 'error');
                }
            } catch (error) {
                Swal.fire('Error', 'Terjadi kesalahan pada server', 'error');
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
@endpush