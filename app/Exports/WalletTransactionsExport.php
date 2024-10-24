<?php

namespace App\Exports;

use App\Models\UserWalletTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

class WalletTransactionsExport implements FromCollection
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user = Auth::user();
        return UserWalletTransaction::where('user_id', $user->id)->whereBetween('date', [$this->startDate, $this->endDate])->get();
    }
}

