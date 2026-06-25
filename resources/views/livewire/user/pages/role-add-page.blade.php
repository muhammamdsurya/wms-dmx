<div class="mx-auto py-1">
    <div class="mb-8 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('role.index') }}" class="p-2 bg-white rounded-full shadow-sm border border-slate-200 hover:bg-slate-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                {{ $role ? __('Edit Role') : __('Add Role') }}
            </h3>
        </div>
    </div>

    <form wire:submit.prevent="submit">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 sm:p-8 space-y-8">

                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-2">{{ __('Role Name') }}</label>
                    <input
                        wire:model.defer="name"
                        type="text"
                        class="w-full rounded-xl border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                        placeholder="e.g. Administrator"
                    >
                    @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-600 mb-4">{{ __('Assign Permissions') }}</label>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        @foreach($permissionOptions as $opt)
                            <label class="flex items-center gap-3 p-2 hover:bg-white rounded-lg cursor-pointer transition">
                                <input
                                    wire:model.defer="permissions"
                                    type="checkbox"
                                    value="{{ $opt['name'] }}"
                                    class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                >
                                <span class="text-sm text-slate-700 font-medium">{{ $opt['name'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="bg-slate-50 px-6 py-4 flex justify-end gap-4 border-t border-slate-100">
                <a href="{{ route('role.index') }}" class="px-6 py-2.5 text-slate-600 font-medium hover:text-slate-900 transition">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl shadow-lg transition-all active:scale-95">
                    {{ __('Save Role') }}
                </button>
            </div>
        </div>
    </form>
</div>
