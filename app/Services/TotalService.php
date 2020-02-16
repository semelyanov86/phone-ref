<?php


namespace App\Services;


use App\Transaction;

class TotalService
{
    public function calcTotal(int $operator_id, string $type, int $user_id)
    {
        return Transaction::where('operator_id', '=', $operator_id)
            ->where('user_id', '=', $user_id)
            ->where('type', '=', $type)
            ->get()
            ->sum(function ($item) {
                return $item->amount;
            });
    }
}
