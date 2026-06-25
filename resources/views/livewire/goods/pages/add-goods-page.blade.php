<div class="mx-auto py-1">
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('goods.index') }}" class="p-2 bg-white rounded-full shadow border border-gray-100 hover:bg-gray-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ __('Add New Items') }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form wire:submit.prevent="submit" class="p-8">
            <div class="space-y-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-600">{{ __('Code') }}</label>
                        <input type="text" wire:model.defer="code" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="e.g. GD-001">
                        @error('code') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-600">{{ __('Name') }}</label>
                        <input type="text" wire:model.defer="name" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="e.g. Wooden Pallet">
                        @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-600">{{ __('Unit') }}</label>
                        <select wire:model.defer="unitId" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                            <option>-- {{ __('Select unit') }} --</option>
                            @foreach($unitOptions as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }} ({{ $unit->symbol }})</option>
                            @endforeach
                        </select>
                        @error('unitId') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-600">{{ __('Price') }}</label>
                        <input type="number" wire:model.defer="price" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="0.00">
                        @error('price') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-600">{{ __('Stock Limit') }}</label>
                        <input type="number" wire:model.defer="stockLimit" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="10">
                        @error('stockLimit') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                      <div class="space-y-1">
                        <label class="text-sm font-semibold text-slate-600">{{ __('Categories') }}</label>
                        <x-select-search wire:model.defer="categoryIds" :data="$categoryOptions" multiple="true" />
                        @error('categoryIds') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-1 md:col-span-2 space-y-1">
                        <label class="text-sm font-semibold text-slate-600">{{ __('Description') }}</label>
                        <textarea wire:model.defer="description" rows="3" class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="Add some details..."></textarea>
                        @error('description') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10 flex items-center justify-end gap-4 border-t pt-6">
                <a href="{{ route('goods.index') }}" class="px-6 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-800 transition">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all transform active:scale-95">
                    {{ __('Save Goods') }}
                </button>
            </div>
        </form>
    </div>
</div>
