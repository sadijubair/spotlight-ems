<!-- Service & Notices Layout -->
<section class="py-12 md:py-16 relative overflow-hidden bg-[#f7f6f2]">
    <div class="absolute inset-0">
        <div class="absolute -top-20 -left-16 h-72 w-72 rounded-full bg-amber-200/45 blur-3xl"></div>
        <div class="absolute top-10 right-10 h-64 w-64 rounded-full bg-emerald-200/40 blur-3xl"></div>
        <div class="absolute -bottom-24 left-1/2 h-80 w-80 -translate-x-1/2 rounded-full bg-sky-200/45 blur-3xl"></div>
        <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(15,118,110,0.08)_0%,transparent_40%,rgba(217,119,6,0.08)_70%,transparent_100%)]"></div>
        <div class="absolute inset-0 opacity-30 [background-image:repeating-linear-gradient(45deg,rgba(16,185,129,0.12)_0,rgba(16,185,129,0.12)_1px,transparent_1px,transparent_12px)]"></div>
    </div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">
            <!-- Left: Tabs + Notice List -->
            <div class="bg-white rounded-2xl shadow-sm border border-emerald-100">
                <div class="flex flex-wrap gap-2 border-b border-emerald-100 px-4 pt-4">
                    <button class="tab-btn px-4 py-2 text-sm font-semibold rounded-t-lg bg-emerald-600 text-white" data-tab-target="notices" aria-selected="true">Notice</button>
                    <button class="tab-btn px-4 py-2 text-sm font-semibold rounded-t-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100" data-tab-target="news" aria-selected="false">News</button>
                    <button class="tab-btn px-4 py-2 text-sm font-semibold rounded-t-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100" data-tab-target="events" aria-selected="false">Events</button>
                </div>
                <div class="px-4 py-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-emerald-900" data-tab-title>Latest Notices</h3>
                        <div class="relative">
                            <input type="text" placeholder="Search..." class="w-56 rounded-lg border border-emerald-100 bg-emerald-50/40 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-200">
                            <i class="fa-solid fa-magnifying-glass absolute right-3 top-2.5 text-emerald-500 text-sm"></i>
                        </div>
                    </div>

                    <div class="space-y-3 max-h-[420px] overflow-y-auto pr-2" data-tab-panel="notices">
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-play text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">Inter-school debate competition registration open</p>
                                <p class="text-xs text-emerald-600 mt-1">Updated: Feb 03, 2026</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-play text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">Annual cultural program rehearsal schedule</p>
                                <p class="text-xs text-emerald-600 mt-1">Updated: Feb 02, 2026</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-play text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">Sports week participation guidelines</p>
                                <p class="text-xs text-emerald-600 mt-1">Updated: Feb 01, 2026</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-play text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">Parent-teacher meeting notice</p>
                                <p class="text-xs text-emerald-600 mt-1">Updated: Jan 30, 2026</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-play text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">Science fair project submission window</p>
                                <p class="text-xs text-emerald-600 mt-1">Updated: Jan 28, 2026</p>
                            </div>
                        </a>
                    </div>

                    <div class="space-y-3 max-h-[420px] overflow-y-auto pr-2 hidden" data-tab-panel="news">
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-newspaper text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">School wins regional science fair</p>
                                <p class="text-xs text-emerald-600 mt-1">Published: Feb 05, 2026</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-newspaper text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">New library wing inaugurated</p>
                                <p class="text-xs text-emerald-600 mt-1">Published: Feb 01, 2026</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-newspaper text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">Debate team qualifies for nationals</p>
                                <p class="text-xs text-emerald-600 mt-1">Published: Jan 29, 2026</p>
                            </div>
                        </a>
                    </div>

                    <div class="space-y-3 max-h-[420px] overflow-y-auto pr-2 hidden" data-tab-panel="events">
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-calendar-day text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">Annual cultural night</p>
                                <p class="text-xs text-emerald-600 mt-1">Feb 20, 2026</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-calendar-day text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">Parents meeting</p>
                                <p class="text-xs text-emerald-600 mt-1">Feb 25, 2026</p>
                            </div>
                        </a>
                        <a href="#" class="flex items-start gap-3 rounded-xl border border-emerald-100 bg-white p-3 hover:bg-emerald-50 transition-colors">
                            <i class="fa-solid fa-calendar-day text-emerald-600 mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-emerald-900">Sports week opening ceremony</p>
                                <p class="text-xs text-emerald-600 mt-1">Mar 01, 2026</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Service Cards -->
            <div class="bg-emerald-50/70 rounded-2xl border border-emerald-100 p-6">
                <div class="mb-6">
                    <h2 class="text-xl md:text-2xl font-bold text-emerald-900">Student Services</h2>
                    <p class="text-emerald-700 text-sm mt-1">Quick access to important actions and resources.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="#" class="group bg-white rounded-2xl border border-emerald-100 p-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="w-11 h-11 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center">
                                <i class="fa-regular fa-file-lines text-lg"></i>
                            </div>
                            <i class="fa-solid fa-arrow-up-right text-emerald-600 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                        </div>
                        <h4 class="mt-4 font-semibold text-emerald-900">Apply Now</h4>
                        <p class="text-sm text-emerald-700 mt-1">Admission application and info sheet.</p>
                    </a>
                    <a href="#" class="group bg-white rounded-2xl border border-emerald-100 p-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="w-11 h-11 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                                <i class="fa-regular fa-id-card text-lg"></i>
                            </div>
                            <i class="fa-solid fa-arrow-up-right text-emerald-600 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                        </div>
                        <h4 class="mt-4 font-semibold text-emerald-900">Student Portal</h4>
                        <p class="text-sm text-emerald-700 mt-1">Check profile, results, and notices.</p>
                    </a>
                    <a href="#" class="group bg-white rounded-2xl border border-emerald-100 p-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="w-11 h-11 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                                <i class="fa-regular fa-heart text-lg"></i>
                            </div>
                            <i class="fa-solid fa-arrow-up-right text-emerald-600 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                        </div>
                        <h4 class="mt-4 font-semibold text-emerald-900">Scholarships</h4>
                        <p class="text-sm text-emerald-700 mt-1">Explore merit and need-based support.</p>
                    </a>
                    <a href="#" class="group bg-white rounded-2xl border border-emerald-100 p-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between">
                            <div class="w-11 h-11 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                                <i class="fa-solid fa-chart-column text-lg"></i>
                            </div>
                            <i class="fa-solid fa-arrow-up-right text-emerald-600 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></i>
                        </div>
                        <h4 class="mt-4 font-semibold text-emerald-900">Results & Reports</h4>
                        <p class="text-sm text-emerald-700 mt-1">Latest results, reports, and analytics.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>