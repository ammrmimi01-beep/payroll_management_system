<x-app-layout>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div id="successMessage"
         class="fixed top-24 left-1/2 -translate-x-1/2 z-50 w-full max-w-md p-4 rounded-lg bg-green-500/40 backdrop-blur-md text-white border border-green-300 shadow-2xl transition duration-500">
        <div class="flex items-center justify-center">
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

{{-- ERROR MESSAGE --}}
@if(session('error'))
    <div id="errorMessage"
         class="fixed top-24 left-1/2 -translate-x-1/2 z-50 w-full max-w-md p-4 rounded-lg bg-red-500/40 backdrop-blur-md text-white border border-red-300 shadow-2xl transition duration-500">
        <div class="flex items-center justify-center">
            <span>{{ session('error') }}</span>
        </div>
    </div>
@endif

<div class="relative min-h-screen flex items-start justify-center pt-24 overflow-hidden">

     <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-800 to-indigo-900"></div>

    <!-- Wave Light Effect (center glow) -->
    <div class="absolute w-[700px] h-[700px] bg-white opacity-20 rounded-full blur-3xl"></div>

    <!-- Extra soft wave -->
    <div class="absolute w-[900px] h-[900px] bg-white opacity-10 rounded-full blur-3xl"></div>

    

    <!-- CONTENT -->
    <div class="relative z-10 w-full max-w-2xl space-y-6">

    

        <!-- Title -->
        <h1 class="text-4xl font-bold text-white text-center mb-4">
            Departments
        </h1>

        <!-- ➕ Add Button -->
        <a href="{{ route('departments.create') }}"
           class="block w-full text-center p-4 rounded-xl text-white
                  bg-white/20 backdrop-blur-md border border-white/30
                  shadow-lg hover:bg-white/30 transition">
            + Add New Department
        </a>

        <!-- List -->
        <div class="space-y-4">

            @foreach($departments as $d)
                <div class="p-4 rounded-xl flex justify-between items-center
                            bg-white/20 backdrop-blur-md border border-white/30
                            shadow-lg text-white">

                    <div class="font-semibold">
                        {{ $d->name }}
                    </div>

                    <div class="space-x-3">

                        <a href="{{ route('departments.edit', $d->id) }}"
                           class="px-3 py-1 rounded bg-blue-500/70 hover:bg-blue-600 text-white text-sm">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('departments.destroy', $d->id) }}" 
                            class="inline"
                            onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')

                            <button class="px-3 py-1 rounded bg-red-500/70 hover:bg-red-600 text-white text-sm">
                                Delete
                            </button>
                        </form>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

</div>

<script>
function confirmDelete() {
    return confirm("Are you sure want to delete this department?");
}
</script>

<script>
    setTimeout(() => {
        const success = document.getElementById('successMessage');
        const error = document.getElementById('errorMessage');

        if (success) {
            success.style.opacity = '0';
            setTimeout(() => success.remove(), 500); // smooth fade out
        }

        if (error) {
            error.style.opacity = '0';
            setTimeout(() => error.remove(), 500);
        }
    }, 3000); // 3 seconds
</script>

</x-app-layout>