<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 text-xl leading-tight flex justify-between items-center">
            {{ __('Edit User') }}
            <div class="text-right text-sm">
                {{ __('FUTURE IS OURS') }}
            </div>
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('user.update', [$user->id]) }} " method="POST">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div>
                    <label for="name" class="block font-bold text-slate-600">Name</label>
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
        
                <!-- Email Address -->
                <div class="mt-4">
                    <label for="username" class="block font-bold text-slate-600">Username</label>
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" value="{{ $user->username }}" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>
                <!-- Email Address -->
                <div class="mt-4">
                    <label for="role" class="block font-bold text-slate-600">Role</label>
                    <select name="role" class="block mt-1 rounded-md">
                        <option value="{{ $user->role }}">{{ ucfirst($user->role) }}</option>
                        <option value="user">User</option>
                        <option value="vp">VP</option>
                        <option value="avp">AVP</option>
                        <option value="svp_operation">SVP Operation</option>
                        <option value="vp_security">VP Security</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>
        
                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block font-bold text-slate-600">Password</label>
        
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
         
                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="block font-bold text-slate-600">Password Confirmation</label>
        
                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" autocomplete="new-password" />
        
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
        
                <div class="flex items-center justify-between mt-4">
                    <a href=" {{ route('user.index') }}"class="mt-5 w-1/5 inline-flex items-center justify-center px-4 py-2 bg-orange border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fa-solid fa-arrow-left mr-2"></i>
                        Back
                    </a>
                    <button type="submit" class="mt-5 w-1/5 inline-flex items-center justify-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fa-solid fa-pen-to-square mr-2"></i>
                        {{ 'update' }}
                    </button>
                </div>
                
               
            </form>
        </div>
    </div>
</x-app-layout>