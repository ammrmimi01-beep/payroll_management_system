<x-app-layout>

{{-- SUCCESS MESSAGE (Floating) --}}
@if(session('success'))
    <div id="successMessage"
         class="fixed top-24 left-1/2 -translate-x-1/2 z-50 w-full max-w-md p-4 rounded-lg bg-green-500/40 backdrop-blur-md text-white border border-green-300 shadow-2xl transition duration-500">
        <div class="flex items-center justify-center">
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

{{-- ERROR MESSAGE (Floating) --}}
@if(session('error'))
    <div id="errorMessage"
         class="fixed top-24 left-1/2 -translate-x-1/2 z-50 w-full max-w-md p-4 rounded-lg bg-red-500/40 backdrop-blur-md text-white border border-red-300 shadow-2xl transition duration-500">
        <div class="flex items-center justify-center text-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif

<div class="relative min-h-screen flex items-start justify-center pt-24 overflow-hidden">
     <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-800 to-indigo-900"></div>
    
    <div class="absolute w-[700px] h-[700px] bg-white opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute w-[900px] h-[900px] bg-white opacity-10 rounded-full blur-3xl"></div>

    <div class="relative z-10 w-full max-w-lg px-4">
        
        <h1 class="text-4xl font-bold text-white text-center mb-4">
            Run Payroll
        </h1>
        <p class="text-white/60 text-center mb-8">Generate salary records for the selected period</p>

        <div class="p-8 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 shadow-2xl">
            <form method="POST" action="/payroll/run" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-white/70 text-sm mb-1 ml-1">Month</label>

                        <select name="month" required
                                class="w-full bg-white/30 rounded-xl p-3 text-white
                                    border border-white/40
                                    focus:outline-none focus:ring-2 focus:ring-white/50
                                    appearance-none">

                                <option value="" class="text-black">Select Month</option>

                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" class="text-black"
                                        {{ request('month') == $m ? 'selected' : '' }}>
                                        
                                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                    
                                    </option>
                                @endfor

                            </select>
                    </div>

                    <div>
                        <label class="block text-white/70 text-sm mb-1 ml-1">Year</label>
                        <select name="year" required
                            class="w-full bg-white/30 rounded-xl p-3 text-white
                                border border-white/40
                                focus:outline-none focus:ring-2 focus:ring-white/50">

                            <option value="" class="text-black">Select Year</option>

                            @for ($y = now()->year; $y >= now()->year - 10; $y--)
                                <option value="{{ $y }}" class="text-black"
                                    {{ request('year') == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endfor

                        </select>
                    </div>
                </div>

                <button class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:scale-[1.02] active:scale-95">
                    Run
                </button>

                <p class="text-[10px] text-white/40 text-center uppercase tracking-widest">
                    Ensure all employee data is updated before running
                </p>
            </form>
        </div>
    </div>
</div>

<script>
    // Fade out both success and error messages
    setTimeout(() => {
        const success = document.getElementById('successMessage');
        const error = document.getElementById('errorMessage');

        if (success) {
            success.style.opacity = '0';
            setTimeout(() => success.remove(), 500);
        }

        if (error) {
            error.style.opacity = '0';
            setTimeout(() => error.remove(), 500);
        }
    }, 3000);
</script>

</x-app-layout>