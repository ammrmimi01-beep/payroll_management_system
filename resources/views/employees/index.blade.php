<x-app-layout>

{{-- SUCCESS/ERROR MESSAGES (Floating) --}}
@if(session('success'))
    <div id="successMessage"
         class="fixed top-24 left-1/2 -translate-x-1/2 z-50 w-full max-w-md p-4 rounded-lg bg-green-500/40 backdrop-blur-md text-white border border-green-300 shadow-2xl transition duration-500">
        <div class="flex items-center justify-center">
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

@if(session('error'))
    <div id="errorMessage"
         class="fixed top-24 left-1/2 -translate-x-1/2 z-50 w-full max-w-md p-4 rounded-lg bg-red-500/40 backdrop-blur-md text-white border border-red-300 shadow-2xl transition duration-500">
        <div class="flex items-center justify-center">
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif

<div class="relative min-h-screen flex items-start justify-center pt-24 overflow-hidden">
     <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-800 to-indigo-900"></div>
    <div class="absolute w-[700px] h-[700px] bg-white opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute w-[900px] h-[900px] bg-white opacity-10 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 w-full max-w-2xl px-4 space-y-6 pb-12">
    
        <h1 class="text-4xl font-bold text-white text-center mb-4">
            Employees
        </h1>

        <a href="/employees/create"
           class="block w-full text-center p-4 rounded-xl text-white
                  bg-white/20 backdrop-blur-md border border-white/30
                  shadow-lg hover:bg-white/30 transition">
            + Add New Employee
        </a>

        <form method="GET" action="/employees" class="flex gap-2 p-3 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20">
            <select name="department_id" 
                     class="w-full bg-white/15 rounded-xl p-3 text-white
                              placeholder-white/70 border border-white/40
                              focus:outline-none focus:ring-2 focus:ring-white/50">
                <option value="" class="text-black">All Departments</option>
                @foreach($departments as $d)
                    <option value="{{ $d->id }}" class="text-black"
                        {{ request('department_id') == $d->id ? 'selected' : '' }}>
                        {{ $d->name }}
                    </option>
                @endforeach
            </select>
            <button class="px-6 py-2 rounded-lg bg-purple-600/80 hover:bg-purple-500 text-white transition font-semibold">
                Filter
            </button>
        </form>

        <div class="space-y-4">
            @foreach($employees as $e)
                <div class="p-5 rounded-xl flex justify-between items-center
                            bg-white/20 backdrop-blur-md border border-white/30
                            shadow-lg text-white">
                    <div>
                        <div class="font-bold text-lg">{{ $e->name }}</div>
                        <div class="text-white/80 text-sm">{{ $e->position }}</div>
                        <div class="mt-1 inline-block px-2 py-0.5 text-xs rounded bg-white/10 border border-white/20">
                             Dept: {{ $e->department->name }}
                        </div>
                    </div>

                    <div class="space-x-2 flex items-center">
                        <a href="/employees/{{ $e->id }}/edit" 
                           class="px-3 py-1 rounded bg-blue-500/70 hover:bg-blue-600 text-white text-sm transition">
                            Edit
                        </a>

                        <form method="POST" action="/employees/{{ $e->id }}" 
                            class="inline" 
                            onsubmit="return confirmDelete('{{ $e->name }}')">
                            @csrf
                            @method('DELETE')

                            <button class="px-3 py-1 rounded bg-red-500/70 hover:bg-red-600 text-white text-sm transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                        @endforeach
                    </div>
                    @if($employees->hasPages())
                <div class="mt-8 flex justify-center items-center gap-4">

                    <!-- PREVIOUS -->
                    @if ($employees->onFirstPage())
                        <span class="px-4 py-2 rounded-xl bg-white/10 text-white/40 border border-white/10 cursor-not-allowed">
                            Previous
                        </span>
                    @else
                        <a href="{{ $employees->previousPageUrl() }}"
                        class="px-4 py-2 rounded-xl bg-white/20 backdrop-blur-md border border-white/30
                                text-white hover:bg-white/30 hover:scale-105 transition">
                            Previous
                        </a>
                    @endif

                    <!-- CURRENT PAGE -->
                    <div class="px-5 py-2 rounded-xl bg-white/20 backdrop-blur-md border border-white/30 text-white font-semibold">
                        Page {{ $employees->currentPage() }} of {{ $employees->lastPage() }}
                    </div>

                    <!-- NEXT -->
                    @if ($employees->hasMorePages())
                        <a href="{{ $employees->nextPageUrl() }}"
                        class="px-4 py-2 rounded-xl bg-white/20 backdrop-blur-md border border-white/30
                                text-white hover:bg-white/30 hover:scale-105 transition">
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

<script>
function confirmDelete(name) {
    return confirm(`Are you sure you want to delete ${name}?`);
}

// Fade out messages
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