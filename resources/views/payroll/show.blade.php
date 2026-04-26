<x-app-layout>

<div class="relative min-h-screen flex items-start justify-center pt-24 pb-12 overflow-hidden">
     <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-800 to-indigo-900"></div>
    
    <div class="absolute w-[700px] h-[700px] bg-white opacity-20 rounded-full blur-3xl"></div>
    <div class="absolute w-[900px] h-[900px] bg-white opacity-10 rounded-full blur-3xl"></div>

    <div class="relative z-10 w-full max-w-2xl px-4">
        
        <div class="mb-6">
            <a href="/payroll/history" class="text-white/70 hover:text-white flex items-center gap-2 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to History
            </a>
        </div>

        <div class="p-8 rounded-3xl bg-white/10 backdrop-blur-2xl border border-white/20 shadow-2xl text-white">
            
            <div class="flex justify-between items-start border-b border-white/10 pb-6 mb-6">
                <div>
                    <h2 class="text-3xl font-black tracking-tight">PAYSLIP</h2>
                    <p class="text-white/50 text-sm uppercase tracking-widest mt-1">Official Earnings Statement</p>
                </div>
               <div class="text-right">
                <div class="text-xl font-bold text-purple-300">
                    {{ \Carbon\Carbon::create()->month($record->month)->format('F') }} {{ $record->year }}
                </div>
                <div class="text-xs text-white/40">Payroll ID: #{{ $record->id }}</div>
            </div>
            </div>

            <div class="grid grid-cols-2 gap-8 mb-8">
                <div>
                    <span class="text-xs text-white/40 uppercase font-bold">Employee Name</span>
                    <p class="text-lg font-semibold">{{ $record->employee->name }}</p>
                </div>
                <div>
                    <span class="text-xs text-white/40 uppercase font-bold">Department</span>
                    <p class="text-lg font-semibold">{{ $record->employee->department->name }}</p>
                </div>
            </div>

            <div class="space-y-4 bg-white/5 p-6 rounded-2xl border border-white/10 mb-6">
                <h3 class="text-sm font-bold text-purple-300 uppercase tracking-wider mb-2">Earnings</h3>
                <div class="flex justify-between">
                    <span class="text-white/70">Basic Salary</span>
                    <span class="font-mono">RM {{ number_format($record->employee->basic_salary, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-white/70">Allowance</span>
                    <span class="font-mono">RM {{ number_format($record->employee->allowance, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-white/70">Overtime Pay</span>
                    <span class="font-mono">RM {{ number_format($record->overtime_pay, 2) }}</span>
                </div>
                <div class="flex justify-between pt-3 border-t border-white/10 text-lg font-bold">
                    <span>Gross Pay</span>
                    <span class="text-indigo-300 font-mono">RM {{ number_format($record->gross_pay, 2) }}</span>
                </div>
            </div>

            <div class="space-y-4 bg-red-500/5 p-6 rounded-2xl border border-red-500/10 mb-8">
                <h3 class="text-sm font-bold text-red-400 uppercase tracking-wider mb-2">Deductions & Contributions</h3>
                <div class="flex justify-between">
                    <span class="text-white/70">Income Tax (8%)</span>
                    <span class="font-mono text-red-300">- RM {{ number_format($record->tax, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-white/70">EPF (Employee)</span>
                    <span class="font-mono text-red-300">- RM {{ number_format($record->epf_employee, 2) }}</span>
                </div>
                <div class="flex justify-between pt-3 border-t border-white/10 text-xs italic text-white/40">
                    <span>EPF Employer Contribution (Paid by Company)</span>
                    <span>RM {{ number_format($record->epf_employer, 2) }}</span>
                </div>
            </div>

            <div class="flex justify-between items-center bg-gradient-to-r from-green-500/20 to-emerald-500/20 p-6 rounded-2xl border border-green-500/30">
                <div>
                    <p class="text-xs text-green-400 uppercase font-black">Net Salary Received</p>
                    <p class="text-white/50 text-[10px]">Transferred to registered bank account</p>
                </div>
                <div class="text-4xl font-black text-green-400 font-mono">
                    RM {{ number_format($record->net_pay, 2) }}
                </div>
            </div>

            <button onclick="window.print()" 
                    class="mt-8 w-full py-3 rounded-xl border border-white/20 bg-white/5 hover:bg-white/10 text-white/60 hover:text-white transition flex justify-center items-center gap-2 text-sm no-print shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Download as PDF / Print
            </button>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print { display: none; }
        body { background: white !important; }
        .backdrop-blur-2xl { backdrop-filter: none !important; }
        .bg-white\/10 { background: white !important; color: black !important; border: 1px solid #eee !important; }
        .text-white { color: black !important; }
        .text-white\/70, .text-white\/50, .text-white\/40 { color: #666 !important; }
        .bg-gradient-to-br { display: none; }
    }
</style>

</x-app-layout>