<x-app-layout>

<div class="relative min-h-screen flex items-start justify-center pt-24 overflow-hidden">

    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-800 to-indigo-900"></div>

    <!--  Glow -->
    <div class="absolute w-[700px] h-[700px] bg-white opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute w-[900px] h-[900px] bg-white opacity-10 rounded-full blur-3xl"></div>

    <!-- CONTENT -->
    <div class="relative z-10 w-full max-w-md">

        <!-- Title -->
        <h1 class="text-3xl font-bold text-white text-center mb-8">
            Edit Department
        </h1>

        <!-- FORM -->
        <form method="POST" action="{{ route('departments.update', $department->id) }}"
              class="space-y-6 p-6 rounded-xl
                     bg-white/20 backdrop-blur-md
                     border border-white/30 shadow-lg">

            @csrf
            @method('PUT')

            <!-- Input -->
            <div>
                <label class="block text-white mb-2">Department Name</label>

                <input type="text" name="name"
                       value="{{ $department->name }}"
                       class="w-full p-3 rounded-lg bg-white/30 text-white
                              placeholder-white/70 border border-white/40
                              focus:outline-none focus:ring-2 focus:ring-white/50">
            </div>

           
             <div class="pt-4 flex gap-3">
                    <a href="/departments" 
                       class="flex-1 text-center p-3 rounded-xl border border-white/30 text-white hover:bg-white/10 transition">
                        Cancel
                    </a>
                     <!-- Button -->
                    <button type="submit"
                            class="flex-1 bg-blue-600 text-white hover:bg-blue-700 transition font-bold py-3 rounded-xl">
                        Update
                    </button>
                </div>

        </form>

    </div>

</div>

</x-app-layout>