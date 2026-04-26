<x-app-layout>

<div class="relative min-h-screen flex items-center justify-center overflow-hidden">

    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-800 to-indigo-900"></div>

    <!-- Wave Light Effect (center glow) -->
    <div class="absolute w-[700px] h-[700px] bg-white opacity-20 rounded-full blur-3xl"></div>

    <!-- Extra soft wave -->
    <div class="absolute w-[900px] h-[900px] bg-white opacity-10 rounded-full blur-3xl"></div>

    <!-- CONTENT -->
    <div class="relative z-10 w-full max-w-md space-y-4">

        <h1 class="text-6xl font-bold text-center text-white mb-20">
            Dashboard
        </h1>

              <a href="/departments" 
           class="block w-full p-5 rounded-xl text-center text-white
                  bg-white/20 backdrop-blur-md
                  border border-white/30
                  shadow-lg hover:bg-white/30 hover:scale-105
                  transition duration-300">
            Departments 🏢
        </a>

        <a href="/employees" 
           class="block w-full p-5 rounded-xl text-center text-white
                  bg-white/20 backdrop-blur-md
                  border border-white/30
                  shadow-lg hover:bg-white/30 hover:scale-105
                  transition duration-300">
            Employees 👥
        </a>

        <a href="/payroll/run" 
           class="block w-full p-5 rounded-xl text-center text-white
                  bg-white/20 backdrop-blur-md
                  border border-white/30
                  shadow-lg hover:bg-white/30 hover:scale-105
                  transition duration-300">
            Run Payroll 💰
        </a>

        <a href="/payroll/history" 
           class="block w-full p-5 rounded-xl text-center text-white
                  bg-white/20 backdrop-blur-md
                  border border-white/30
                  shadow-lg hover:bg-white/30 hover:scale-105
                  transition duration-300">
            Payroll History 📊
        </a>

    </div>

</div>

</x-app-layout>