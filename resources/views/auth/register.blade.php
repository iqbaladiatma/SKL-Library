@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-emerald-900 to-teal-900 min-h-screen flex items-center">
        <div class="max-w-md w-full mx-auto p-6 bg-white/5 backdrop-blur-lg rounded-2xl border border-white/10 shadow-xl">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <!-- Logo -->
                <div class="text-center mb-8">
                    <x-application-logo class="w-20 h-20 mx-auto text-white" />
                    <h2 class="mt-4 text-3xl font-bold text-white">Create Account</h2>
                </div>

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-white" />
                    <div class="relative mt-1">
                        <x-text-input 
                            id="name" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            class="w-full pl-12 bg-white/5 border-white/10 text-white"
                            placeholder="John Doe"
                            required 
                            autofocus 
                        />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-300" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <div class="relative mt-1">
                        <x-text-input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            class="w-full pl-12 bg-white/5 border-white/10 text-white"
                            placeholder="user@example.com"
                            required 
                        />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-white" />
                    <div class="relative mt-1">
                        <x-text-input 
                            id="password" 
                            type="password" 
                            name="password" 
                            class="w-full pl-12 bg-white/5 border-white/10 text-white"
                            placeholder="••••••••"
                            required 
                        />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
                    <div class="relative mt-1">
                        <x-text-input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            class="w-full pl-12 bg-white/5 border-white/10 text-white"
                            placeholder="••••••••"
                            required 
                        />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-300" />
                </div>

                <!-- Register Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white py-3 px-4 rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all shadow-lg">
                    {{ __('Register') }}
                </button>

                <!-- Login Link -->
                <p class="text-center text-emerald-300 text-sm mt-6">
                    Already registered? 
                    <a href="{{ route('login') }}" class="text-white hover:text-emerald-400 font-semibold underline">
                        {{ __('Login here') }}
                    </a>
                </p>
            </form>
        </div>
    </div>
@endsection
