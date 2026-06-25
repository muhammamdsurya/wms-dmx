<div class="mx-auto py-1">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('transaction-category.index') }}"
            class="p-2 bg-white rounded-full shadow-sm border border-slate-200 hover:bg-slate-50 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">
            {{ $transactionCategory ? __('Edit Category') : __('Add Transaction Category') }}
        </h3>
    </div>

    <form wire:submit.prevent="submit">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 sm:p-8 space-y-6">

                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Category Name') }}</label>
                    <input wire:model.defer="name" type="text"
                        class="w-full rounded-xl border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                        placeholder="e.g. Office Supplies">
                    @error('name')
                        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-3">{{ __('Operation Type') }}</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($operationOptions as $opt)
                            <label
                                class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:bg-slate-50 transition-all duration-200">
                                <input wire:model.defer="operation" type="radio" name="operation_type"
                                    value="{{ $opt['value'] }}" class="peer sr-only">
                                <div
                                    class="w-5 h-5 border-2 border-slate-300 rounded-full mr-3 flex items-center justify-center peer-checked:border-indigo-600 peer-checked:bg-indigo-600 transition">
                                    <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                </div>
                                <span class="font-medium text-slate-700">{{ $opt['text'] }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('operation')
                        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Description') }}</label>
                    <textarea wire:model.defer="description" rows="3"
                        class="w-full rounded-xl border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                        placeholder="Optional description"></textarea>
                </div>
            </div>

            <div class="bg-slate-50 px-6 py-4 flex justify-end gap-4 border-t border-slate-100">
                <a href="{{ route('transaction-category.index') }}"
                    class="px-6 py-2.5 text-slate-600 font-medium hover:text-slate-900 transition">
                    {{ __('Cancel') }}
                </a>
                <button type="submit"
                    class="px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl shadow-lg transition-all active:scale-95">
                    {{ __('Save Changes') }}
                </button>
            </div>
        </div>
    </form>
</div>
