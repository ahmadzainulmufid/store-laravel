<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransactionDetail;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        $allTransactions = TransactionDetail::all();
    
        $totalTransactionCount = $allTransactions->count();
        $totalRevenue = $allTransactions->sum('price');
    
        $paginatedTransactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('pages.dashboard', [
            'transaction_count' => $totalTransactionCount,
            'transaction_data' => $paginatedTransactions,
            'revenue' => $totalRevenue,
            'customer' => User::count(),
        ]);
    }
}
