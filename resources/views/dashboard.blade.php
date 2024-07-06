<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Salon Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Today's Appointments -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Today's Appointments</h2>
                        <div class="border-t border-gray-200">
                            <ul class="divide-y divide-gray-200">
                                <li class="py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-gray-600">John Doe</div>
                                        <div class="text-xs text-gray-400">10:00 AM</div>
                                    </div>
                                    <div class="text-xs text-gray-500">Haircut</div>
                                </li>
                                <li class="py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-gray-600">Jane Smith</div>
                                        <div class="text-xs text-gray-400">11:30 AM</div>
                                    </div>
                                    <div class="text-xs text-gray-500">Manicure</div>
                                </li>
                                <!-- Add more appointments as needed -->
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Recent Customers -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Recent Customers</h2>
                        <div class="border-t border-gray-200">
                            <ul class="divide-y divide-gray-200">
                                <li class="py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-gray-600">Emily Brown</div>
                                        <div class="text-xs text-gray-400">July 5, 2024</div>
                                    </div>
                                    <div class="text-xs text-gray-500">New customer</div>
                                </li>
                                <li class="py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-gray-600">Michael Johnson</div>
                                        <div class="text-xs text-gray-400">July 4, 2024</div>
                                    </div>
                                    <div class="text-xs text-gray-500">Returning customer</div>
                                </li>
                                <!-- Add more customers as needed -->
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Popular Services -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-2">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Popular Services</h2>
                        <div class="border-t border-gray-200">
                            <ul class="divide-y divide-gray-200">
                                <li class="py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-gray-600">Haircut</div>
                                        <div class="text-xs text-gray-400">45%</div>
                                    </div>
                                </li>
                                <li class="py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-gray-600">Manicure</div>
                                        <div class="text-xs text-gray-400">30%</div>
                                    </div>
                                </li>
                                <!-- Add more services as needed -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
