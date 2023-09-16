<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header class="mb-6"> <!-- Add margin-bottom -->
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('冰箱資料') }}
                            </h2>
                        </header>
                        <form method="POST" action="{{ route('fridgeedit.update', ['fridgeId' => $fridge->id]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-6">
                                <x-input-label for="name" :value="__('name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $fridge->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div> 
                            <div class="mb-6">
                                <x-input-label for="city" :value="__('city')" />
                                <input id="city" name="city" type="text" class="mt-1 block w-full bg-gray-100" value="{{ $fridge->city }}" readonly>
                            </div>
                            <div class="mb-6">
                                <x-input-label for="dist" :value="__('dist')" />
                                <input id="dist" name="dist" type="text" class="mt-1 block w-full bg-gray-100" value="{{ $fridge->dist }}" readonly>
                            </div>
                            <div class="mb-6">
                                <x-input-label for="address" :value="__('address')" />
                                <input id="address" name="address" type="text" class="mt-1 block w-full bg-gray-100" value="{{ $fridge->address }}" readonly>
                            </div>
                            <div class="mb-6">
                                <x-input-label for="company" :value="__('company')" />
                                <input id="company" name="company" type="text" class="mt-1 block w-full bg-gray-100" value="{{ $fridge->company }}" readonly>
                            </div>
                            <div class="mb-6">
                                <x-input-label for="telephone" :value="__('telephone')" />
                                <x-text-input id="telephone" name="telephone" type="text" class="mt-1 block w-full" :value="old('telephone', $fridge->telephone)" required autofocus autocomplete="telephone" />
                                <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
                            </div> 
                            <div class="mb-6">
                                <x-input-label for="email" :value="__('email')" />
                                <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email', $fridge->email)" required autofocus autocomplete="email" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>                                                    
                            <div class="flex items-center gap-4 mt-6">
                                <x-primary-button>{{ __('儲 存') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
