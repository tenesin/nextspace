<?php
namespace App\Exports;

use App\Models\Nextspace;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NextspacesExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        $month = Carbon::now()->format('F Y');
        $totalSpaces = Nextspace::count();
        $totalUsers = User::count();
        $totalBookings = Booking::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $totalRevenue = Booking::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('price');

        return [
            ['Report Month', $month],
            ['Total Spaces', $totalSpaces],
            ['Total Users', $totalUsers],
            ['Total Bookings This Month', $totalBookings],
            ['Total Revenue This Month', $totalRevenue],
        ];
    }

    public function headings(): array
    {
        return ['Metric', 'Value'];
    }
}