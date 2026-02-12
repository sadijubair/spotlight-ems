@extends('frontend.layouts.app')

@section('title', 'Home - ' . config('app.name'))

@section('content')

@include('frontend.section.home.hero')
@include('frontend.section.home.quick-info')
@include('frontend.section.home.notice')
@include('frontend.section.home.faculty')
@include('frontend.section.home.features')


<!-- Programs/Department Section -->
<section class="py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Academic Programs
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Comprehensive curriculum designed for excellence
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Program 1 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Science</h3>
                        <p class="text-gray-600 text-sm mb-3">Physics, Chemistry, Biology, Mathematics</p>
                        <a href="#" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">Learn More →</a>
                    </div>
                </div>
            </div>

            <!-- Program 2 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Arts</h3>
                        <p class="text-gray-600 text-sm mb-3">Literature, History, Philosophy, Languages</p>
                        <a href="#" class="text-purple-600 hover:text-purple-700 font-medium text-sm">Learn More →</a>
                    </div>
                </div>
            </div>

            <!-- Program 3 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Commerce</h3>
                        <p class="text-gray-600 text-sm mb-3">Accounting, Economics, Business Studies</p>
                        <a href="#" class="text-pink-600 hover:text-pink-700 font-medium text-sm">Learn More →</a>
                    </div>
                </div>
            </div>

            <!-- Program 4 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Computer Science</h3>
                        <p class="text-gray-600 text-sm mb-3">Programming, Web Development, AI</p>
                        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">Learn More →</a>
                    </div>
                </div>
            </div>

            <!-- Program 5 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Sports</h3>
                        <p class="text-gray-600 text-sm mb-3">Cricket, Football, Athletics, Indoor Games</p>
                        <a href="#" class="text-green-600 hover:text-green-700 font-medium text-sm">Learn More →</a>
                    </div>
                </div>
            </div>

            <!-- Program 6 -->
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-lg transition-shadow">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2 font-bengali">বিজ্ঞান ও প্রযুক্তি</h3>
                        <p class="text-gray-600 text-sm mb-3 font-bengali">আধুনিক শিক্ষা ও গবেষণা সুবিধা</p>
                        <a href="#" class="text-yellow-600 hover:text-yellow-700 font-medium text-sm">বিস্তারিত →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 md:py-24 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Ready to Join Our Community?
        </h2>
        <p class="text-xl mb-8 text-indigo-100 max-w-2xl mx-auto">
            Take the first step towards a brighter future. Apply now for admission 2026
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="inline-flex items-center justify-center px-8 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Apply Now
            </a>
            <a href="#" class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-indigo-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Schedule Campus Visit
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-indigo-600 mb-2">5000+</div>
                <div class="text-gray-600 font-medium">Students Enrolled</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-purple-600 mb-2">200+</div>
                <div class="text-gray-600 font-medium">Qualified Teachers</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-pink-600 mb-2">95%</div>
                <div class="text-gray-600 font-medium">Success Rate</div>
            </div>
            <div class="text-center">
                <div class="text-4xl md:text-5xl font-bold text-indigo-600 mb-2">50+</div>
                <div class="text-gray-600 font-medium">Years Legacy</div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) translateX(0);
        }
        25% {
            transform: translateY(-20px) translateX(10px);
        }
        50% {
            transform: translateY(-10px) translateX(-10px);
        }
        75% {
            transform: translateY(-30px) translateX(5px);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }
    
    .animation-delay-100 {
        animation-delay: 0.1s;
        opacity: 0;
        animation-fill-mode: forwards;
    }

    .animation-delay-200 {
        animation-delay: 0.2s;
        opacity: 0;
        animation-fill-mode: forwards;
    }

    .animation-delay-300 {
        animation-delay: 0.3s;
        opacity: 0;
        animation-fill-mode: forwards;
    }
    
    .animation-delay-400 {
        animation-delay: 0.4s;
        opacity: 0;
        animation-fill-mode: forwards;
    }

    .animation-delay-500 {
        animation-delay: 0.5s;
        opacity: 0;
        animation-fill-mode: forwards;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-float-delay-1 {
        animation: float 8s ease-in-out infinite;
        animation-delay: 2s;
    }

    .animate-float-delay-2 {
        animation: float 7s ease-in-out infinite;
        animation-delay: 4s;
    }
    
    .slide.active {
        opacity: 1 !important;
    }
    
    .indicator.active {
        background-color: white;
        width: 2rem;
    }

    /* Gradient Text Animation */
    @keyframes gradient-shift {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    .bg-gradient-to-r {
        background-size: 200% 200%;
        animation: gradient-shift 3s ease infinite;
    }
</style>
@endpush

@push('scripts')
<script>
    let currentSlide = 0;
    let slideInterval;
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');
    const totalSlides = slides.length;

    function showSlide(index) {
        // Remove active class from all slides and indicators
        slides.forEach(slide => {
            slide.classList.remove('active');
            slide.style.opacity = '0';
        });
        indicators.forEach(indicator => {
            indicator.classList.remove('active');
        });

        // Add active class to current slide and indicator
        slides[index].classList.add('active');
        slides[index].style.opacity = '1';
        indicators[index].classList.add('active');
        
        currentSlide = index;
    }

    function nextSlide() {
        let next = (currentSlide + 1) % totalSlides;
        showSlide(next);
        resetInterval();
    }

    function previousSlide() {
        let prev = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(prev);
        resetInterval();
    }

    function goToSlide(index) {
        showSlide(index);
        resetInterval();
    }

    function resetInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5000);
    }

    // Auto-play slider
    slideInterval = setInterval(nextSlide, 5000);

    // Pause on hover
    const sliderContainer = document.querySelector('.slider-container');
    sliderContainer?.addEventListener('mouseenter', () => {
        clearInterval(slideInterval);
    });
    sliderContainer?.addEventListener('mouseleave', () => {
        slideInterval = setInterval(nextSlide, 5000);
    });

    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('[data-tab-panel]');
    const tabTitle = document.querySelector('[data-tab-title]');
    const tabTitles = {
        notices: 'Latest Notices',
        news: 'Latest News',
        events: 'Upcoming Events',
    };

    function setActiveTab(target) {
        tabButtons.forEach(button => {
            const isActive = button.getAttribute('data-tab-target') === target;
            button.setAttribute('aria-selected', isActive ? 'true' : 'false');
            button.classList.toggle('bg-emerald-600', isActive);
            button.classList.toggle('text-white', isActive);
            button.classList.toggle('bg-emerald-50', !isActive);
            button.classList.toggle('text-emerald-700', !isActive);
        });

        tabPanels.forEach(panel => {
            const isActive = panel.getAttribute('data-tab-panel') === target;
            panel.classList.toggle('hidden', !isActive);
        });

        if (tabTitle && tabTitles[target]) {
            tabTitle.textContent = tabTitles[target];
        }
    }

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const target = button.getAttribute('data-tab-target');
            if (target) {
                setActiveTab(target);
            }
        });
    });
</script>
@endpush
