<x-guest-layout>
            <!-- Title -->
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">
                Sign Up
            </h2>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input
                        id="name"
                        name="name"
                        type="text"
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        name="email"
                        type="email"
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        :value="old('email')"
                        required
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                        autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Role -->
                <div class="mb-6">
                    <x-input-label for="role" :value="__('Role')" />
                    <select
                        id="role"
                        name="role"
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required
                    >
                        <option value="Admin">Admin</option>
                        <option value="Manager">Manager</option>
                        <option value="User" selected>User</option>
                        <option value="Stock Keeper">Stock Keeper</option>
                        <option value="Technician">Technician</option>
                        <option value="Management Assistance">Management Assistance</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Footer: Already registered + Button -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.login') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                        {{ __('Already registered?') }}
                    </a>
                    <x-primary-button class="px-6 py-2">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
</x-guest-layout>
