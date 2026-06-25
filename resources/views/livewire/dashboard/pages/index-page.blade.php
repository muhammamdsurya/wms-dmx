<div class="p-1 max-w-7xl mx-auto min-h-screen">
    <div class="border-b border-gray-200 pb-5 text-center">
        <h3 class="text-3xl text-black font-bold tracking-tight">Dashboard Overview</h3>
    </div>

    <div class="mb-10">
        <div class="mb-5">
            <h3 class="text-xl font-bold text-gray-800 tracking-tight">Status Stock</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="shadow-sm bg-white flex p-5 rounded-xl items-center border border-gray-100 transition duration-300 hover:shadow-md">
                <div class="p-3 rounded-xl bg-green-50 text-green-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="font-bold text-2xl text-green-600 tracking-tight">{{ number_format($countAvailableStock) }} items</h3>
                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider mt-0.5">{{ __('Available Stock') }}</p>
                </div>
            </div>

            <div class="shadow-sm bg-white flex p-5 rounded-xl items-center border border-gray-100 transition duration-300 hover:shadow-md">
                <div class="p-3 rounded-xl bg-amber-50 text-amber-500 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="font-bold text-2xl text-amber-500 tracking-tight">{{ number_format($countLowStock) }} items</h3>
                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider mt-0.5">{{ __('Low Stock') }}</p>
                </div>
            </div>

            <div class="shadow-sm bg-white flex p-5 rounded-xl items-center border border-gray-100 transition duration-300 hover:shadow-md">
                <div class="p-3 rounded-xl bg-red-50 text-red-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <h3 class="font-bold text-2xl text-red-600 tracking-tight">{{ number_format($countOutOfStock) }} items</h3>
                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider mt-0.5">{{ __('Out of Stock') }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-10 pb-16" wire:ignore>
            <div class="shadow-sm border border-gray-100 bg-white p-6 rounded-2xl transition duration-300 hover:shadow-md">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="font-bold text-lg text-gray-800 tracking-tight">Receiving From Supplier</h4>
                    <span class="px-2.5 py-1 text-xs font-semibold bg-green-50 text-green-700 rounded-md">Incoming</span>
                </div>
                <div class="relative w-full h-96">
                    <canvas id="receivingChart"></canvas>
                </div>
            </div>

            <div class="shadow-sm border border-gray-100 bg-white p-6 rounded-2xl transition duration-300 hover:shadow-md">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="font-bold text-lg text-gray-800 tracking-tight">Dispatching To Shipper</h4>
                    <span class="px-2.5 py-1 text-xs font-semibold bg-blue-50 text-blue-700 rounded-md">Outgoing</span>
                </div>
                <div class="relative w-full h-96">
                    <canvas id="dispatchingChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pengaturan Font Global ChartJS agar selaras dengan Tailwind
            Chart.defaults.font.family = "system-ui, -apple-system, sans-serif";
            Chart.defaults.font.color = "#64748b";

            // 1. Inisialisasi Chart Receiving (Supplier)
            const ctxReceiving = document.getElementById('receivingChart').getContext('2d');
            new Chart(ctxReceiving, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($supplierNames) !!},
                    datasets: [{
                        label: 'Total Incoming',
                        data: {!! json_encode($supplierTotalGoods) !!},
                        backgroundColor: 'rgba(34, 197, 94, 0.65)',
                        borderColor: 'rgb(34, 197, 94)',
                        borderWidth: 1.5,
                        borderRadius: 6,
                        borderSkipped: false,
                        maxBarThickness: 100,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { usePointStyle: true, boxWidth: 10 }
                        }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(226, 232, 240, 0.6)' },
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });

            // 2. Inisialisasi Chart Dispatching (Shipper)
            const ctxDispatching = document.getElementById('dispatchingChart').getContext('2d');
            new Chart(ctxDispatching, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($shipperNames) !!},
                    datasets: [{
                        label: 'Total Outgoing',
                        data: {!! json_encode($shipperTotalDispatches) !!},
                        backgroundColor: 'rgba(59, 130, 246, 0.65)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 1.5,
                        borderRadius: 6,
                        borderSkipped: false,
                        maxBarThickness: 100,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { usePointStyle: true, boxWidth: 10 }
                        }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(226, 232, 240, 0.6)' },
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        });
    </script>
</div>
