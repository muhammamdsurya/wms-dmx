<?php

namespace App\Http\Livewire\Goods\Components;

use App\Models\Goods;
use App\Services\ExportService;
use App\Services\PrintService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class GoodsTable extends DataTableComponent
{
    protected $model = Goods::class;
    protected $listeners = [
        'deleteConfirmed'
    ];

    public $selectedId = null;

    public function configure(): void
    {
        $configurationAreas = [
            'toolbar-right-start' => [
                'livewire.livewire-datatable.export-pdf-action-button',
            ],
        ];
        $this->setPrimaryKey('id');
        $this->setColumnSelectStatus(false);
        $this->setPerPageAccepted([10, 25, 50, 100, -1]);
        $this->setSearchDebounce(500);

        if (Auth::user()->hasPermissionTo('goods.create')) {
            $configurationAreas['toolbar-left-start'] = [
                'livewire.livewire-datatable.add-action-button',
                [
                    'route' => route('goods.add')
                ],
            ];
        }
        $this->setConfigurableAreas($configurationAreas);
    }

    public function builder(): Builder
    {
        // PERBAIKAN: Memastikan semua kolom tabel utama ikut terpilih dan eager loading relasi unit
        return Goods::query()
            ->with('unit')
            ->select('wms_goods.*')
            ->selectRaw('(stock * price) as total_price');
    }

    public function columns(): array
    {
        return [
            Column::make(__('Code'), 'code')
                ->sortable()
                ->searchable(),
            Column::make(__('Name'), 'name')
                ->sortable()
                ->searchable(),

            // SINKRONISASI KONDISI DENGAN SCOPE MODEL GOODS
            Column::make(__('Stock'), 'stock')
                ->sortable()
                ->format(function ($value, $row, $column) {
                    // Paksakan menjadi integer murni untuk menghindari kesalahan perbandingan PHP
                    $stock = (int) $value;
                    $minStock = (int) $row->minimum_stock;

                    $formattedValue = number_format($stock);

                    // 1. KONDISI MERAH (Out of Stock): Jika stok saat ini di bawah atau pas sama dengan batas minimum
                    if ($stock <= $minStock) {
                        return '<span class="text-red-600 font-bold" style="color: #dc2626; font-weight: bold;">' . $formattedValue . '</span>';
                    }

                    // 2. KONDISI KUNING (Low Stock): Jika stok di antara min_stock dan 2x min_stock
                    if ($stock > $minStock && $stock < ($minStock * 2)) {
                        return '<span class="text-amber-500 font-bold" style="color: #ff8800; font-weight: bold;">' . $formattedValue . '</span>';
                    }

                    // 3. KONDISI HIJAU (Available Stock): Jika stok melimpah (>= 2x min_stock)
                    return '<span class="text-green-600" style="color: #16a34a;">' . $formattedValue . '</span>';
                })
                ->html(),

            Column::make(__('Stock Limit'), 'minimum_stock')
                ->format(fn($value, $row, $column) => number_format($value))
                ->sortable(),
            Column::make(__('Unit'), 'unit.symbol')
                ->sortable(),
            Column::make(__('Price'), 'price')
                ->sortable()
                ->format(fn($value, $row, $column) => number_format($value)),
            Column::make(__('Total Price'), 'id')
                ->format(
                    fn($value, $row, $column) => number_format($row->total_price)
                )
                ->sortable(
                    fn($builder, $direction) => $builder->orderBy('total_price', $direction)
                ),
            Column::make(__('Actions'), 'id')
                ->view('livewire.goods.components.goods-action-menu'),
        ];
    }

    public function exportPDF()
    {
        $goods = $this->getRows()->getCollection();
        $pdfContent = PrintService::printGoodsList($goods)->output();
        $filename = __('goods-list') . '-' . date("Ymd") . '.pdf';

        return response()->streamDownload(
            fn() => print($pdfContent),
            $filename
        );
    }

    public function exportCSV()
    {
        $goods = $this->getRows()->getCollection();
        $filename = __('goods-list') . '-' . date("Ymd") . '.csv';

        return response()->streamDownload(
            ExportService::exportGoodsListCSV($goods),
            $filename
        );
    }

    public function actionDelete($id)
    {
        $this->emitTo('components.delete-confirm-modal', 'deleteConfirmation', 'goods.components.goods-table', $id);
    }

    public function deleteConfirmed($itemId)
    {
        if ($itemId) {
            Goods::where('id', $itemId)->delete();
        }
    }
}
