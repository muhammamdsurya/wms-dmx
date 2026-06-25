<?php

namespace App\Http\Livewire\Receiving\Pages;

use App\Models\GoodsTransaction;
use App\Services\PrintService;
use Livewire\Component;

class DetailReceivingPage extends Component
{
    public $transactionId;
    public $transaction;

    public function mount($id)
    {
        $this->transactionId = $id;
        $this->loadTransaction();
    }

    public function loadTransaction()
    {
        // Eager load category dan relasi lain yang diperlukan (seperti items)
        $this->transaction = GoodsTransaction::with(['category', 'items.goods', 'supplier'])
            ->where('id', $this->transactionId)
            ->first();

        // Jika transaksi tidak ditemukan, arahkan kembali
        if (!$this->transaction) {
            return redirect()->route('receiving.index');
        }
    }

    public function printPDF()
    {
        $pdfContent = PrintService::printReceivingDetail($this->transaction)->output();
        $filename = __('receiving') . '-' . gmdate("Ymd", $this->transaction->transaction_at) . '.pdf';

        $this->dispatchBrowserEvent('toast', [
            'type' => 'success',
            'message' => __('PDF is ready')
        ]);

        return response()->streamDownload(
            fn() => print($pdfContent),
            $filename
        );
    }

    public function render()
    {
        return view('livewire.receiving.pages.detail-receiving-page');
    }
}
