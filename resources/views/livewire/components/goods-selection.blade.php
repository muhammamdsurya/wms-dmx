<div class="space-y-4">
    <div class="grid grid-cols-12 gap-4 px-2 text-xs font-bold text-slate-500 uppercase tracking-wider">
        <div class="col-span-8">{{ __('Item') }}</div>
        <div class="col-span-4">{{ __('Quantity') }}</div>
    </div>

    <div class="space-y-3">
        @foreach($goodsItems as $index => $item)
            <div class="grid grid-cols-12 gap-4 items-start" wire:key="item-{{ $index }}">

                <div class="col-span-8">
                    <x-select-search
                        :data="$goodsOptions"
                        wire:model="goodsItems.{{ $index }}.goodsId"
                        placeholder="-- {{ __('Select Items') }} --"
                    />
                    @error("goodsItems.$index.goodsId")
                        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-4 flex gap-2">
                    <div class="flex-grow">
                        <input
                            wire:model.defer="goodsItems.{{ $index }}.quantity"
                            type="number"
                            class="w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            placeholder="Qty"
                        >
                    </div>

                    <button
                        wire:click.prevent="deleteItem({{ $index }})"
                        wire:loading.attr="disabled"
                        type="button"
                        class="p-2.5 bg-white border border-slate-300 text-slate-500 hover:text-red-600 hover:border-red-300 hover:bg-red-50 rounded-lg transition-all"
                    >
                        <div wire:loading wire:target="deleteItem({{ $index }})">
                            <svg class="w-5 h-5 animate-spin text-slate-400" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/></svg>
                        </div>
                        <div wire:loading.remove wire:target="deleteItem({{ $index }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                    </button>
                </div>

                @error("goodsItems.$index.quantity")
                    <div class="col-span-12 -mt-2">
                        <span class="text-xs text-red-500">{{ $message }}</span>
                    </div>
                @enderror
            </div>
        @endforeach
    </div>

    <div class="pt-2">
        <button
            wire:click.prevent="addItem()"
            wire:loading.attr="disabled"
            type="button"
            class="flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-lg text-sm transition-all"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            {{ __('Add New Item') }}
        </button>
    </div>
</div>
