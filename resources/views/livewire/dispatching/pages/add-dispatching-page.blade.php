<div class="mx-auto py-1">
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('dispatching.index') }}"
                class="p-2 bg-white rounded-full shadow border border-slate-200 hover:bg-slate-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h3 class="text-3xl font-extrabold text-slate-800">{{ __('Add Dispatching') }}</h3>
        </div>
    </div>

    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-6 sticky top-6">
                    <h4 class="font-bold text-slate-700 flex items-center gap-2">
                        {{ __('Dispatching Details') }}
                    </h4>

                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Shipper') }}</label>
                        <x-select-search :data="$shipperOptions" wire:model.defer="shipperId"
                            placeholder="-- Select Shipper --" />
                        @error('shipperId')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
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
                        <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Dispatch Date') }}</label>
                        <x-datepicker wire:model.defer="dispatchAt" dateFormat="YYYY-MM-DD" class="w-full" />
                        @error('dispatchAt')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Description') }}</label>
                        <textarea wire:model.defer="description" rows="3"
                            class="w-full rounded-xl border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                            placeholder="Add notes here..."></textarea>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h4 class="font-bold text-slate-700">{{ __('Dispatching Items') }}</h4>
                    </div>

                    <div class="min-h-[300px] flex flex-col items-end">
                        <div class="w-full"> @include('livewire.components.goods-selection')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="mt-5 bg-white p-4 rounded-2xl shadow-sm border border-slate-200 flex justify-end gap-4 items-center">
            <a href="{{ route('dispatching.index') }}"
                class="px-6 py-2.5 text-slate-600 font-medium hover:text-slate-900 transition">
                {{ __('Cancel') }}
            </a>
            <button type="submit" wire:loading.attr="disabled"
                class="px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl shadow-lg transition-all active:scale-95 flex items-center gap-2">
                <span wire:loading.remove wire:target="submit">Save Dispatching</span>
                <span wire:loading wire:target="submit">Saving...</span>
            </button>
        </div>
    </form>
</div>
