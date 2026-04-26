<x-app-layout>

<div class="relative min-h-screen flex items-start justify-center pt-24 pb-12 overflow-hidden">
     <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-800 to-indigo-900"></div>
    
    <div class="absolute w-[700px] h-[700px] bg-white opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute w-[900px] h-[900px] bg-white opacity-10 rounded-full blur-3xl"></div>

    <div class="relative z-10 w-full max-w-3xl px-4 space-y-6">
        
        <h1 class="text-4xl font-bold text-white text-center mb-6">
            Payroll History
        </h1>
                <form method="GET" class="p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex flex-wrap gap-3 shadow-xl">
                <select name="month" 
                class="flex-1 min-w-[120px] bg-white/20 border border-white/20 rounded-xl p-2 text-white focus:ring-2 focus:ring-white/50 outline-none transition appearance-none">
            <option value="" class="text-black">Month</option>
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" class="text-black" {{ request('month') == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
            @endforeach
        </select>    
            <select name="year"
            class="flex-1 min-w-[100px] bg-white/20 border border-white/20 rounded-xl p-2 text-white 
                focus:ring-2 focus:ring-white/50 outline-none transition">

            <option value="" class="text-black">Year</option>

            @for ($y = now()->year; $y >= now()->year - 10; $y--)
                <option value="{{ $y }}" class="text-black"
                    {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor

        </select>
            <select name="department_id" 
                    class="flex-[2] min-w-[150px] bg-white/20 border border-white/20 rounded-xl p-2 text-white focus:ring-2 focus:ring-white/50 outline-none transition appearance-none">
                <option value="" class="text-black">All Departments</option>
                @foreach($departments as $d)
                    <option value="{{ $d->id }}" class="text-black"
                        {{ request('department_id') == $d->id ? 'selected' : '' }}>
                        {{ $d->name }}
                    </option>
                @endforeach
            </select>

            <div class="flex gap-2 w-full md:w-auto">
                <button class="flex-1 md:flex-none bg-purple-600 hover:bg-purple-500 text-white px-6 py-2 rounded-xl transition font-semibold shadow-lg">
                    Filter
                </button>
                <a href="/payroll/history" class="flex-1 md:flex-none bg-white/10 hover:bg-white/20 text-white px-6 py-2 rounded-xl border border-white/20 text-center transition">
                    Reset
                </a>
            </div>
        </form>

        <div class="space-y-4">
            @forelse($records as $r)
                <a href="/payroll/{{ $r->id }}" 
                   class="group block p-5 rounded-2xl bg-white/15 backdrop-blur-md border border-white/25 shadow-lg hover:bg-white/25 transition-all transform hover:-translate-y-1">
                    
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="font-bold text-xl text-white group-hover:text-purple-300 transition-colors">
                                {{ $r->employee->name }}
                            </div>
                            <div class="text-white/60 text-sm mt-1">
                                <span class="bg-white/10 px-2 py-0.5 rounded border border-white/10 mr-2">
                                Dept:{{ $r->employee->department->name }}
                                </span>
                               🗓️ Period: {{ \Carbon\Carbon::create()->month($r->month)->format('F') }} {{ $r->year }}
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <div class="text-xs text-white/50 uppercase tracking-widest mb-1">Net Pay</div>
                            <div class="text-2xl font-black text-green-400">
                                RM {{ number_format($r->net_pay, 2) }}
                            </div>
                            <div class="text-[10px] text-white/40 mt-1 italic group-hover:text-white/70">
                                Click to view details →
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-12 text-center bg-white/5 border border-dashed border-white/20 rounded-2xl">
                    <p class="text-white/40 italic">No payroll records found for this period.</p>
                </div>
            @endforelse
        </div>
      @if($records->hasPages())
    <div class="mt-8 flex justify-center items-center gap-4">

        <!-- PREVIOUS -->
        @if ($records->onFirstPage())
            <span class="px-4 py-2 rounded-xl bg-white/10 text-white/40 border border-white/10 cursor-not-allowed">
                Previous
            </span>
        @else
            <a href="{{ $records->previousPageUrl() }}"
               class="px-4 py-2 rounded-xl bg-white/20 backdrop-blur-md border border-white/30
                      text-white hover:bg-white/30 transition">
                Previous
            </a>
        @endif

        <!-- CURRENT PAGE -->
        <div class="px-5 py-2 rounded-xl bg-white/20 backdrop-blur-md border border-white/30 text-white font-semibold">
            Page {{ $records->currentPage() }} of {{ $records->lastPage() }}
        </div>

        <!-- NEXT -->
        @if ($records->hasMorePages())
            <a href="{{ $records->nextPageUrl() }}"
               class="px-4 py-2 rounded-xl bg-white/20 backdrop-blur-md border border-white/30
                      text-white hover:bg-white/30 transition">
                Next
            </a>
        @else
            <span class="px-4 py-2 rounded-xl bg-white/10 text-white/40 border border-white/10 cursor-not-allowed">
                Next
            </span>
        @endif

    </div>
@endif
    </div>
</div>

</x-app-layout>