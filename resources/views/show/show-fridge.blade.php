<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Fridges') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @foreach ($userFridges as $fridge)
                <div class="py-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <p><strong>Name:</strong> {{ $fridge->name }}</p>
                            <p><strong>City/County:</strong> {{ $fridge->city }}</p>
                            <p><strong>District:</strong> {{ $fridge->dist }}</p>
                            <p><strong>Address:</strong> {{ $fridge->address }}</p>
                            <p><strong>Company:</strong> {{ $fridge->company }}</p>
                            <p><strong>Telephone:</strong> {{ $fridge->telephone }}</p>
                            <p><strong>Email:</strong> {{ $fridge->email }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>

</x-app-layout>
