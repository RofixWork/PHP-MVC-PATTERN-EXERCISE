<?php

namespace App\Controllers;

use App\Models\Transaction;
use App\View;

class HomeController
{
    public function index() : View
    {
        $transaction = new Transaction();
        $transactions = $transaction->get();
        $totalIncome = array_sum(array_column(array_filter($transactions, function($transaction) {
            return $transaction->amount > 0;
        }), 'amount'));

        $totalExpense = array_sum(array_column(array_filter($transactions, function($transaction) {
            return $transaction->amount < 0;
        }), 'amount'));

        return View::make("home/index", [
            "transactions" => $transactions,
            "totalIncome" => number_format(round($totalIncome, 2), 2),
            "totalExpense" => number_format(round($totalExpense, 2), 2),
            "netTotal" => number_format($totalIncome - abs($totalExpense), 2)
        ]);
    }
}