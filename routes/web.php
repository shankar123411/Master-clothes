<?php

use Illuminate\Support\Facades\Route;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders/{id}/print', function ($id) {
    $order = Order::findOrFail($id);
    return view('orders.print', compact('order'));
})->name('orders.print');

Route::get('/orders/{id}/pdf', function ($id) {
    $order = Order::findOrFail($id);
    $pdf = Pdf::loadView('orders.pdf', compact('order'));
    $fileName = 'MasterClothes_Order_Slip_' . $order->order_id . '.pdf';
    
    if (request()->has('download')) {
        return $pdf->download($fileName);
    }
    
    return $pdf->stream($fileName);
})->name('orders.pdf');
