<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Spotlight Academy'))</title>

    <!-- Fonts & Styles -->
    <link href="{{ asset('frontend/assets/css/pace.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script>
        window.paceOptions = {
            showSpinner: false,
        };
    </script>
    <script src="{{ asset('frontend/assets/js/pace.min.js') }}"></script>
    @vite(['resources/frontend/css/app.css', 'resources/frontend/js/app.js'])

    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <!-- Topbar -->
    <div class="bg-gray-900 text-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-2 py-3 text-xs sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                    <span>@bn(now()->translatedFormat('l, d F Y'))</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <a href="#" class="p-1.5 rounded-full hover:bg-white/10 transition-colors" aria-label="{{ __('frontend.topbar.facebook') }}">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2.1V12h2.1V9.7c0-2.1 1.3-3.3 3.2-3.3.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.2l-.4 2.9h-1.8v7A10 10 0 0 0 22 12z" />
                            </svg>
                        </a>
                        <a href="#" class="p-1.5 rounded-full hover:bg-white/10 transition-colors" aria-label="{{ __('frontend.topbar.linkedin') }}">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M19 3A2 2 0 0 1 21 5v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14zM8.3 18.3v-7H6v7h2.3zM7.1 10.4a1.3 1.3 0 1 0 0-2.6 1.3 1.3 0 0 0 0 2.6zM18 18.3v-4.1c0-2.2-1.2-3.3-2.8-3.3-1.3 0-1.9.7-2.2 1.2v-1H10.8v7H13v-3.5c0-.9.2-1.9 1.3-1.9s1.2 1.1 1.2 1.9v3.5H18z" />
                            </svg>
                        </a>
                        <a href="#" class="p-1.5 rounded-full hover:bg-white/10 transition-colors" aria-label="{{ __('frontend.topbar.youtube') }}">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M23 12s0-3.3-.4-4.7a3 3 0 0 0-2.1-2.1C18.9 4.8 12 4.8 12 4.8s-6.9 0-8.5.4A3 3 0 0 0 1.4 7.3C1 8.7 1 12 1 12s0 3.3.4 4.7a3 3 0 0 0 2.1 2.1c1.6.4 8.5.4 8.5.4s6.9 0 8.5-.4a3 3 0 0 0 2.1-2.1c.4-1.4.4-4.7.4-4.7zM10 15.2V8.8l5.8 3.2L10 15.2z" />
                            </svg>
                        </a>
                    </div>
                    <div class="hidden sm:block h-4 w-px bg-white/40"></div>
                    <div class="inline-flex rounded-full bg-white/10 p-0.5">
                        <a href="{{ route('locale.switch', ['locale' => 'bn']) }}" class="px-3 py-1 rounded-full transition-colors {{ app()->getLocale() === 'bn' ? 'bg-white text-gray-900' : 'text-white/80 hover:text-white' }}">{{ __('frontend.topbar.lang_bn') }}</a>
                        <a href="{{ route('locale.switch', ['locale' => 'en']) }}" class="px-3 py-1 rounded-full transition-colors {{ app()->getLocale() === 'en' ? 'bg-white text-gray-900' : 'text-white/80 hover:text-white' }}">{{ __('frontend.topbar.lang_en') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header/Navigation - Sticky Top -->
    <header class="sticky top-0 left-0 right-0 bg-white/95 backdrop-blur-sm shadow-md z-50">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        {{ config('app.name', 'Spotlight Academy') }}
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        {{ __('frontend.nav.home') }}
                    </a>
                    
                    <!-- About Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                            {{ __('frontend.nav.about') }}
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 -translate-y-2 whitespace-nowrap">
                            <div class="py-2">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.about_glance') }}</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.about_history') }}</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.about_vision') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Administration Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                            {{ __('frontend.nav.administration') }}
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 -translate-y-2 whitespace-nowrap">
                            <div class="py-2">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.admin_president') }}</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.admin_headmaster') }}</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.admin_teachers') }}</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.admin_adhocs') }}</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.admin_staffs') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Academics Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                            {{ __('frontend.nav.academics') }}
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 -translate-y-2 whitespace-nowrap">
                            <div class="py-2">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.academics_admission') }}</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.academics_students') }}</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.academics_results') }}</a>
                            </div>
                        </div>
                    </div>

                    <!-- Information Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                            {{ __('frontend.nav.information') }}
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 -translate-y-2 whitespace-nowrap">
                            <div class="py-2">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.info_notices') }}</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.info_news') }}</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">{{ __('frontend.nav.info_events') }}</a>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        {{ __('frontend.nav.contact') }}
                    </a>
                </div>

                <!-- Auth & Mobile Menu Button -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden lg:inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden lg:inline-flex items-center justify-center px-4 py-2 border border-indigo-600 text-sm font-medium rounded-lg text-indigo-600 hover:bg-indigo-50 transition-colors">
                            Login
                        </a>
                    @endauth

                    <!-- Mobile menu button -->
                    <button type="button" class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 transition-colors" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="menu-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Mobile Offcanvas Menu -->
    <div id="mobile-offcanvas" class="fixed inset-0 z-50 lg:hidden hidden">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" id="offcanvas-backdrop"></div>
        
        <!-- Offcanvas Panel -->
        <div class="fixed inset-y-0 right-0 w-full max-w-sm bg-white shadow-xl transform translate-x-full transition-transform duration-300" id="offcanvas-panel">
            <div class="flex flex-col h-full">
                <!-- Header -->
                <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200">
                    <a href="#" class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        {{ __('frontend.nav.menu') }}
                    </a>
                    <button type="button" class="p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors" id="close-offcanvas">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Menu Items -->
                <div class="flex-1 overflow-y-auto px-4 py-6">
                    <div class="space-y-1">
                        <a href="{{ route('home') }}" class="block px-4 py-3 text-base font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                            {{ __('frontend.nav.home') }}
                        </a>

                        <!-- About Dropdown -->
                        <div class="space-y-1">
                            <button class="w-full flex items-center justify-between px-4 py-3 text-base font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors" onclick="toggleMobileDropdown('about-dropdown')">
                                {{ __('frontend.nav.about') }}
                                <svg class="w-5 h-5 transition-transform" id="about-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="hidden pl-4 space-y-1 border-l border-gray-200 ml-2" id="about-dropdown">
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.about_glance') }}</a>
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.about_history') }}</a>
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.about_vision') }}</a>
                            </div>
                        </div>

                        <!-- Administration Dropdown -->
                        <div class="space-y-1">
                            <button class="w-full flex items-center justify-between px-4 py-3 text-base font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors" onclick="toggleMobileDropdown('administration-dropdown')">
                                {{ __('frontend.nav.administration') }}
                                <svg class="w-5 h-5 transition-transform" id="administration-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="hidden pl-4 space-y-1 border-l border-gray-200 ml-2" id="administration-dropdown">
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.admin_president') }}</a>
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.admin_headmaster') }}</a>
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.admin_teachers') }}</a>
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.admin_adhocs') }}</a>
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.admin_staffs') }}</a>
                            </div>
                        </div>

                        <!-- Academics Dropdown -->
                        <div class="space-y-1">
                            <button class="w-full flex items-center justify-between px-4 py-3 text-base font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors" onclick="toggleMobileDropdown('academics-dropdown')">
                                {{ __('frontend.nav.academics') }}
                                <svg class="w-5 h-5 transition-transform" id="academics-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="hidden pl-4 space-y-1 border-l border-gray-200 ml-2" id="academics-dropdown">
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.academics_admission') }}</a>
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.academics_students') }}</a>
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.academics_results') }}</a>
                            </div>
                        </div>

                        <!-- Information Dropdown -->
                        <div class="space-y-1">
                            <button class="w-full flex items-center justify-between px-4 py-3 text-base font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors" onclick="toggleMobileDropdown('information-dropdown')">
                                {{ __('frontend.nav.information') }}
                                <svg class="w-5 h-5 transition-transform" id="information-dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="hidden pl-4 space-y-1 border-l border-gray-200 ml-2" id="information-dropdown">
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.info_notices') }}</a>
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.info_news') }}</a>
                                <a href="#" class="relative block px-4 py-2 pl-6 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors before:content-[''] before:absolute before:left-2 before:top-1/2 before:h-px before:w-3 before:bg-gray-300">{{ __('frontend.nav.info_events') }}</a>
                            </div>
                        </div>

                        <a href="#" class="block px-4 py-3 text-base font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 rounded-lg transition-colors">
                            {{ __('frontend.nav.contact') }}
                        </a>
                    </div>
                </div>

                <!-- Auth Buttons -->
                <div class="px-4 py-4 border-t border-gray-200">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 border-2 border-indigo-600 text-indigo-600 font-medium rounded-lg hover:bg-indigo-50 transition-colors">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-16 bg-gradient-to-b from-gray-950 via-gray-900 to-gray-950 text-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Site Logo -->
                <div class="relative">
                    <div class="absolute -top-6 left-0 h-16 w-16 rounded-full bg-indigo-500/10 blur-2xl"></div>
                    <a href="{{ route('home') }}" class="inline-flex items-center text-2xl font-bold bg-gradient-to-r from-indigo-400 to-purple-400 bg-clip-text text-transparent">
                        {{ config('app.name', 'Spotlight Academy') }}
                    </a>
                    <p class="mt-4 text-sm text-gray-400 leading-relaxed">
                        Building a brighter future through education, discipline, and community.
                    </p>
                    <div class="mt-5 flex items-center gap-3">
                        <a href="#" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white/5 text-gray-300 hover:text-white hover:bg-indigo-500/20 transition-colors" aria-label="{{ __('frontend.topbar.facebook') }}">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2.1V12h2.1V9.7c0-2.1 1.3-3.3 3.2-3.3.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2V12h2.2l-.4 2.9h-1.8v7A10 10 0 0 0 22 12z" />
                            </svg>
                        </a>
                        <a href="#" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white/5 text-gray-300 hover:text-white hover:bg-indigo-500/20 transition-colors" aria-label="{{ __('frontend.topbar.linkedin') }}">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M19 3A2 2 0 0 1 21 5v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14zM8.3 18.3v-7H6v7h2.3zM7.1 10.4a1.3 1.3 0 1 0 0-2.6 1.3 1.3 0 0 0 0 2.6zM18 18.3v-4.1c0-2.2-1.2-3.3-2.8-3.3-1.3 0-1.9.7-2.2 1.2v-1H10.8v7H13v-3.5c0-.9.2-1.9 1.3-1.9s1.2 1.1 1.2 1.9v3.5H18z" />
                            </svg>
                        </a>
                        <a href="#" class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white/5 text-gray-300 hover:text-white hover:bg-indigo-500/20 transition-colors" aria-label="{{ __('frontend.topbar.youtube') }}">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M23 12s0-3.3-.4-4.7a3 3 0 0 0-2.1-2.1C18.9 4.8 12 4.8 12 4.8s-6.9 0-8.5.4A3 3 0 0 0 1.4 7.3C1 8.7 1 12 1 12s0 3.3.4 4.7a3 3 0 0 0 2.1 2.1c1.6.4 8.5.4 8.5.4s6.9 0 8.5-.4a3 3 0 0 0 2.1-2.1c.4-1.4.4-4.7.4-4.7zM10 15.2V8.8l5.8 3.2L10 15.2z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Links Column 1 -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-widest text-gray-300">Links</h3>
                    <ul class="mt-4 space-y-2">
                        <li>
                            <a href="#" class="group inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-white/5 group-hover:bg-indigo-500/20">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                                {{ __('frontend.nav.about') }}
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-white/5 group-hover:bg-indigo-500/20">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                                {{ __('frontend.nav.academics') }}
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-white/5 group-hover:bg-indigo-500/20">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                                {{ __('frontend.nav.information') }}
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-white/5 group-hover:bg-indigo-500/20">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                                {{ __('frontend.nav.contact') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Links Column 2 -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-widest text-gray-300">Resources</h3>
                    <ul class="mt-4 space-y-2">
                        <li>
                            <a href="#" class="group inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-white/5 group-hover:bg-indigo-500/20">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                                Admissions
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-white/5 group-hover:bg-indigo-500/20">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                                Notice Board
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-white/5 group-hover:bg-indigo-500/20">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                                Events
                            </a>
                        </li>
                        <li>
                            <a href="#" class="group inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors">
                                <span class="inline-flex h-5 w-5 items-center justify-center rounded-full bg-white/5 group-hover:bg-indigo-500/20">
                                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                                News
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Column -->
                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-widest text-gray-300">Contact</h3>
                    <ul class="mt-4 space-y-3 text-sm text-gray-400">
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-full bg-white/5">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.8 7.1a2 2 0 0 0-1.7-1.1H3.9A2 2 0 0 0 2 7.9l10 6.1 10-6.9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2 7.9V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V7.1" />
                                </svg>
                            </span>
                            <span>info@example.com</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-full bg-white/5">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.5 5.5c0 9.4 6.6 16 16 16l2-2a2 2 0 0 0 0-2.8l-3.1-3.1a2 2 0 0 0-2.8 0l-1.3 1.3a12.2 12.2 0 0 1-5.2-5.2l1.3-1.3a2 2 0 0 0 0-2.8L7.3 2.5a2 2 0 0 0-2.8 0l-2 3z" />
                                </svg>
                            </span>
                            <span>+880 123 456 7890</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 inline-flex h-7 w-7 items-center justify-center rounded-full bg-white/5">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-6.1 7-11a7 7 0 1 0-14 0c0 4.9 7 11 7 11z" />
                                    <circle cx="12" cy="10" r="2.5" />
                                </svg>
                            </span>
                            <span>Dhaka, Bangladesh</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-10 border-t border-white/10 pt-6 flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                <p class="text-xs text-gray-400">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                </p>
                <p class="text-xs text-gray-500">
                    Created with <i class="fas fa-heart text-red-500"></i> by <a href="https://github.com/sadijubair" class="text-gray-300 hover:text-white transition-colors">Sadi Jubair</a>
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <script>
        // Offcanvas Menu Functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const offcanvas = document.getElementById('mobile-offcanvas');
        const offcanvasPanel = document.getElementById('offcanvas-panel');
        const closeOffcanvas = document.getElementById('close-offcanvas');
        const offcanvasBackdrop = document.getElementById('offcanvas-backdrop');

        function openOffcanvas() {
            offcanvas.classList.remove('hidden');
            setTimeout(() => {
                offcanvasPanel.classList.remove('translate-x-full');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeOffcanvasMenu() {
            offcanvasPanel.classList.add('translate-x-full');
            setTimeout(() => {
                offcanvas.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }

        mobileMenuButton?.addEventListener('click', openOffcanvas);
        closeOffcanvas?.addEventListener('click', closeOffcanvasMenu);
        offcanvasBackdrop?.addEventListener('click', closeOffcanvasMenu);

        // Mobile Dropdown Toggle
        function toggleMobileDropdown(id) {
            const dropdown = document.getElementById(id);
            const icon = document.getElementById(id + '-icon');
            
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                dropdown.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Close offcanvas on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !offcanvas.classList.contains('hidden')) {
                closeOffcanvasMenu();
            }
        });
    </script>
</body>
</html>
