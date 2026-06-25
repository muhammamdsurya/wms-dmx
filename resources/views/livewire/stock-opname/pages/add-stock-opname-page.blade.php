<div class="mx-auto py-1">
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('stock-opname.index') }}" class="p-2 bg-white rounded-full shadow-sm border border-slate-200 hover:bg-slate-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ __('Add Stock Opname') }}</h3>
        </div>
    </div>

    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-6 sticky top-6">
                    <h4 class="font-bold text-slate-700 flex items-center gap-2">
                        {{ __('Opname Information') }}
                    </h4>

                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Category') }}</label>
                        <x-select-search :data="$categoryOptions" wire:model.defer="categoryId" placeholder="-- Select category --" />
                        @error('categoryId') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Stock Opname Date') }}</label>
                        <x-datepicker wire:model.defer="stockOpnameAt" dateFormat="YYYY-MM-DD" class="w-full" />
                        @error('stockOpnameAt') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Description') }}</label>
                        <textarea wire:model.defer="description" rows="3" class="w-full rounded-xl border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="Enter details..."></textarea>
                        @error('description') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h4 class="font-bold text-slate-700 mb-6 flex items-center gap-2">
                        {{ __('Stock Opname Items') }}
                    </h4>

                    <div class="min-h-[300px]">
                        @include('livewire.components.goods-selection')
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4 items-center p-4 bg-white rounded-2xl border border-slate-200 shadow-sm">
            <a href="{{ route('stock-opname.index') }}" class="px-6 py-2.5 text-slate-600 font-medium hover:text-slate-900 transition">
                {{ __('Cancel') }}
            </a>
            <button type="submit" class="px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl shadow-lg transition-all active:scale-95">
                {{ __('Save Record') }}
            </button>
        </div>
    </form>
</div>
