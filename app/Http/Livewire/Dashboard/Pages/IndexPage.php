<?php

namespace App\Http\Livewire\Dashboard\Pages;

use App\Models\Goods;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IndexPage extends Component
{
    public $countOutOfStock;
    public $countAvailableStock;
    public $countLowStock;

    // Properti untuk data Chart
    public $supplierNames = [];
    public $supplierTotalGoods = [];

    public $shipperNames = [];
    public $shipperTotalDispatches = [];

    public function mount() {
        // 1. Query Stok Barang
        $this->countAvailableStock = Goods::availableStock()->count();
        $this->countOutOfStock = Goods::outOfStock()->count();
        $this->countLowStock = Goods::lowStock()->count();

        // 2. QUERY RECEIVING DARI SUPPLIER
        // Menghitung total quantity barang masuk berdasarkan supplier_id yang tidak null
        $receivingData = DB::table('wms_goods_transaction_goods')
            ->join('wms_goods_transaction', 'wms_goods_transaction_goods.transaction_id', '=', 'wms_goods_transaction.id')
            ->join('wms_supplier', 'wms_goods_transaction.supplier_id', '=', 'wms_supplier.id')
            ->select('wms_supplier.name', DB::raw('SUM(wms_goods_transaction_goods.quantity) as total_qty'))
            ->whereNotNull('wms_goods_transaction.supplier_id') // Memastikan hanya transaksi yang ada suppliernya
            ->groupBy('wms_supplier.id', 'wms_supplier.name')
            ->orderBy('total_qty', 'desc')
            ->take(5)
            ->get();

        $this->supplierNames = $receivingData->pluck('name')->toArray();
        $this->supplierTotalGoods = $receivingData->pluck('total_qty')->toArray();


        // 3. QUERY DISPATCHING KE SHIPPER
        // Menghitung total quantity barang keluar berdasarkan shipper_id yang tidak null
        $dispatchingData = DB::table('wms_goods_transaction_goods')
            ->join('wms_goods_transaction', 'wms_goods_transaction_goods.transaction_id', '=', 'wms_goods_transaction.id')
            ->join('wms_shipper', 'wms_goods_transaction.shipper_id', '=', 'wms_shipper.id')
            ->select('wms_shipper.name', DB::raw('SUM(wms_goods_transaction_goods.quantity) as total_qty'))
            ->whereNotNull('wms_goods_transaction.shipper_id') // Memastikan hanya transaksi yang ada shipppernya
            ->groupBy('wms_shipper.id', 'wms_shipper.name')
            ->orderBy('total_qty', 'desc')
            ->take(5)
            ->get();

        $this->shipperNames = $dispatchingData->pluck('name')->toArray();
        $this->shipperTotalDispatches = $dispatchingData->pluck('total_qty')->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.pages.index-page');
    }
}
