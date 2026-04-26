<x-app-layout>

<div class="relative min-h-screen flex items-start justify-center pt-24 pb-12 overflow-hidden">
     <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-800 to-indigo-900"></div>
    
    <div class="absolute w-[700px] h-[700px] bg-white opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute w-[900px] h-[900px] bg-white opacity-10 rounded-full blur-3xl"></div>

    <div class="relative z-10 w-full max-w-xl px-4">
        
        <h1 class="text-4xl font-bold text-white text-center mb-8">
            Edit Employee
        </h1>

        <div class="p-8 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 shadow-2xl">
            <form method="POST" action="/employees/{{ $employee->id }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-white/70 text-sm mb-1 ml-1">Full Name</label>
                    <input name="name" value="{{ $employee->name }}" 
                            class="w-full bg-white/30 rounded-xl p-3 text-white
                              placeholder-white/70 border border-white/40
                              focus:outline-none focus:ring-2 focus:ring-white/50">
                </div>

                <div>
                    <label class="block text-white/70 text-sm mb-1 ml-1">Position</label>
                    <input name="position" value="{{ $employee->position }}" 
                            class="w-full bg-white/30 rounded-xl p-3 text-white
                              placeholder-white/70 border border-white/40
                              focus:outline-none focus:ring-2 focus:ring-white/50">
                </div>

                <div>
                    <label class="block text-white/70 text-sm mb-1 ml-1">Department</label>
                    <select name="department_id" 
                             class="w-full bg-white/30 rounded-xl p-3 text-white
                              placeholder-white/70 border border-white/40
                              focus:outline-none focus:ring-2 focus:ring-white/50">
                        @foreach($departments as $d)
                            <option value="{{ $d->id }}" class="text-black"
                                {{ $employee->department_id == $d->id ? 'selected' : '' }}>
                                {{ $d->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-white/70 text-sm mb-1 ml-1">Basic Salary</label>
                        <input name="basic_salary" value="{{ $employee->basic_salary }}" 
                                class="w-full bg-white/30 rounded-xl p-3 text-white
                              placeholder-white/70 border border-white/40
                              focus:outline-none focus:ring-2 focus:ring-white/50">
                    </div>
                    <div>
                        <label class="block text-white/70 text-sm mb-1 ml-1">Allowance</label>
                        <input name="allowance" value="{{ $employee->allowance }}" 
                                class="w-full bg-white/30 rounded-xl p-3 text-white
                              placeholder-white/70 border border-white/40
                              focus:outline-none focus:ring-2 focus:ring-white/50">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-white/70 text-sm mb-1 ml-1">OT Hours</label>
                        <input name="overtime_hours" value="{{ $employee->overtime_hours }}" 
                                class="w-full bg-white/30 rounded-xl p-3 text-white
                              placeholder-white/70 border border-white/40
                              focus:outline-none focus:ring-2 focus:ring-white/50">
                    </div>
                    <div>
                        <label class="block text-white/70 text-sm mb-1 ml-1">Hourly Rate</label>
                        <input name="hourly_rate" value="{{ $employee->hourly_rate }}" 
                                class="w-full bg-white/30 rounded-xl p-3 text-white
                              placeholder-white/70 border border-white/40
                              focus:outline-none focus:ring-2 focus:ring-white/50">
                    </div>
                </div>

                <div class="pt-4 flex gap-3">
                    <a href="/employees" 
                       class="flex-1 text-center p-3 rounded-xl border border-white/30 text-white hover:bg-white/10 transition">
                        Cancel
                    </a>
                    <button class="flex-1 bg-blue-600 text-white hover:bg-blue-700 transition font-bold py-3 rounded-xl">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

</x-app-layout>