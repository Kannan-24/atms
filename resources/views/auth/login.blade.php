<x-guest-layout>
    <x-slot name="title">
        {{ __('Login') }} - {{ config('app.name', 'ATMS') }}
    </x-slot>

    <div class="flex items-center justify-center min-h-screen px-6">
        <div class="grid w-full max-w-6xl grid-cols-1 overflow-hidden bg-white rounded-lg shadow-lg md:grid-cols-2">

            <!-- Left Section: Branding & Info -->
            <div class="flex-col justify-center hidden px-10 py-16 text-white bg-blue-700 md:flex">

                <h2 class="text-3xl font-extrabold">Automated Transport Management System</h2>
                <p class="mt-4 text-lg leading-relaxed">
                    Secure and efficient transport management for students, parents, and staff .
                </p>
                <div class="mt-6 space-y-4 text-left">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.75 6.75h4.5M9.75 9.75h4.5m-4.5 3h4.5m0 3h-4.5m-4.5 0h.007m.993 0h3.5m5.5 0h.007m.993 0h3.5m-10-6H9m5 0h.007m.993 0h3.5">
                            </path>
                        </svg>
                        <span> Live Bus Tracking for safety and convenience</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-2.485 0-4.5 2.015-4.5 4.5h9c0-2.485-2.015-4.5-4.5-4.5z">
                            </path>
                        </svg>
                        <span> Automated Attendance for better record-keeping</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.232 5.232a2 2 0 012.828 0l.707.707a2 2 0 010 2.828l-5.657 5.657a2 2 0 01-2.828 0l-.707-.707a2 2 0 010-2.828l5.657-5.657zM6.343 15.657a2 2 0 010 2.828l-.707.707a2 2 0 01-2.828 0l-.707-.707a2 2 0 010-2.828l.707-.707a2 2 0 012.828 0z">
                            </path>
                        </svg>
                        <span> Personalized Dashboard for users & admins</span>
                    </div>
                </div>
            </div>

            <!-- Right Section: Login Form -->
            <div class="max-w-md p-8 mx-auto">
                <div class="mb-8 ">
                    <h3 class="text-3xl font-bold text-gray-800">Welcome Back</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Log in to access your transport details, schedules, and attendance records .
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label class="block mb-2 text-sm text-gray-800">Email</label>
                        <div class="relative flex items-center">
                            <input id="email" name="email" type="email" required
                                class="w-full py-3 pl-4 pr-10 text-sm text-gray-800 border border-gray-300 rounded-lg outline-blue-600"
                                placeholder="Enter your email" value="{{ old('email') }}" autofocus
                                autocomplete="username" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="relative mt-4" x-data="{ show: false }">
                        <label class="block text-sm font-medium text-gray-700" for="password">Password</label>
                        <input
                            class="w-full py-3 pl-4 pr-10 text-sm text-gray-800 border border-gray-300 rounded-lg outline-blue-600"
                            id="password" x-bind:type="show ? 'text' : 'password'" name="password" required="required"
                            autocomplete="current-password" placeholder="Enter your password">
                        <span class="absolute w-5 h-5" id="password-toggle" @click="show = !show"
                            style="top: 50%; right: 15px;">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                :class="{ 'hidden': show }">
                                <path
                                    d="M3 14C3 9.02944 7.02944 5 12 5C16.9706 5 21 9.02944 21 14M17 14C17 16.7614 14.7614 19 12 19C9.23858 19 7 16.7614 7 14C7 11.2386 9.23858 9 12 9C14.7614 9 17 11.2386 17 14Z"
                                    stroke="#959595" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                :class="{ 'hidden': !show }">
                                <path
                                    d="M9.60997 9.60714C8.05503 10.4549 7 12.1043 7 14C7 16.7614 9.23858 19 12 19C13.8966 19 15.5466 17.944 16.3941 16.3878M21 14C21 9.02944 16.9706 5 12 5C11.5582 5 11.1238 5.03184 10.699 5.09334M3 14C3 11.0069 4.46104 8.35513 6.70883 6.71886M3 3L21 21"
                                    stroke="#959595" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded shrink-0 focus:ring-blue-500"
                                name="remember">
                            <label for="remember_me" class="block ml-3 text-sm text-gray-800">Remember me</label>
                        </div>

                        <div class="text-sm">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="font-semibold text-blue-600 hover:underline">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="!mt-8">
                        <button type="submit"
                            class="w-full shadow-xl py-2.5 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
