<div class="mx-auto py-1">
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('receiving.index') }}" class="p-2 bg-white rounded-full shadow hover:bg-gray-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h3 class="text-2xl font-bold text-slate-800">{{ __('Add Receiving') }}</h3>
        </div>
    </div>

    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-5">
                    <h4 class="font-semibold text-slate-700 border-b pb-2">{{ __('Receiving Info') }}</h4>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">{{ __('Supplier') }}</label>
                        <x-select-search :data="$supplierOptions" wire:model.defer="supplierId"
                            placeholder="-- Select Supplier --" />
                        @error('supplierId')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-slate-600 mb-1">{{ __('Transactions Category') }}</label>
                        <x-select-search :data="$transactionCategoryOptions" wire:model.defer="transactionCategoryId"
                            placeholder="-- Select Transactions --" />
                        @error('transactionCategoryId')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">{{ __('Receive At') }}</label>
                        <x-datepicker wire:model.defer="receiveAt" dateFormat="YYYY-MM-DD" class="w-full" />
                        @error('receiveAt')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-600 mb-1">{{ __('Description') }}</label>
                        <textarea wire:model.defer="description" rows="3"
                            class="w-full rounded-lg border-slate-300 focus:ring-emerald-500 focus:border-emerald-500"
                            placeholder="Catatan tambahan..."></textarea>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <div class="flex justify-between items-center mb-4 border-b pb-2">
                        <h4 class="font-semibold text-slate-700">{{ __('Receiving Items') }}</h4>
                    </div>

                    <div class="space-y-4">
                        @include('livewire.components.goods-selection')
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4 bg-white p-4 rounded-xl shadow-sm border border-slate-200">
            <a href="{{ route('receiving.index') }}"
                class="px-6 py-2.5 rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50 font-medium">
                {{ __('Cancel') }}
            </a>
            <button type="submit" wire:loading.attr="disabled"
                class="px-6 py-2.5 rounded-lg bg-slate-900 text-white hover:bg-slate-800 font-medium transition flex items-center gap-2">
                <span wire:loading.remove wire:target="submit">Save Receiving</span>
                <span wire:loading wire:target="submit">Processing...</span>
            </button>
        </div>
    </form>
</div>
