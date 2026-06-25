<div class="mx-auto py-1">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('goods-category.index') }}"
           class="p-2 bg-white rounded-full shadow-sm border border-slate-200 hover:bg-slate-50 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ __('Add Items Category') }}</h3>
    </div>

    <form wire:submit.prevent="submit">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 sm:p-8 space-y-6">

                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Category Name') }}</label>
                    <input
                        wire:model.defer="name"
                        type="text"
                        class="w-full rounded-xl border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                        placeholder="e.g. Electronics"
                    >
                    @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Description') }}</label>
                    <textarea
                        wire:model.defer="description"
                        rows="4"
                        class="w-full rounded-xl border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                        placeholder="Briefly describe this category..."
                    ></textarea>
                    @error('description') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="bg-slate-50 px-6 py-4 flex justify-end gap-4 border-t border-slate-100">
                <a href="{{ route('goods-category.index') }}"
                   class="px-6 py-2.5 text-slate-600 font-medium hover:text-slate-900 transition">
                    {{ __('Cancel') }}
                </a>
                <button type="submit"
                        class="px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl shadow-lg transition-all active:scale-95">
                    {{ __('Save Category') }}
                </button>
            </div>
        </div>
    </form>
</div>
