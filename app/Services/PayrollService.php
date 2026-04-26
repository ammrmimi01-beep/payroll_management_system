<?php

namespace App\Services;

class PayrollService
{
    public function calculate($employee)
    {
        $overtimePay = $employee->overtime_hours * $employee->hourly_rate;

        $grossPay = $employee->basic_salary + 
                    $employee->allowance + 
                    $overtimePay;

        $tax = $grossPay * 0.08;
        $epfEmployee = $grossPay * 0.11;
        $epfEmployer = $grossPay * 0.13;

        $netPay = $grossPay - $tax - $epfEmployee;

        return [
            'overtime_pay' => $overtimePay,
            'gross_pay' => $grossPay,
            'tax' => $tax,
            'epf_employee' => $epfEmployee,
            'epf_employer' => $epfEmployer,
            'net_pay' => $netPay,
        ];
    }
}