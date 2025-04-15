<?php

namespace App\Http\Controllers;

use App\Enums\SaleStatus;
use App\Enums\UserRole;
use App\Http\Requests\ReportRequest;
use App\Http\Requests\SaleRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::user()->role == UserRole::MINICOM->value) {
            $sales = Sale::latest()->paginate(10);
            return view('minicom.product.sales', compact('sales'));
        } else {
            $products = Product::latest()->where('user_id', Auth::id())->get();
            $sales = Sale::whereHas('product', function (Builder $query) {
                $query->where('user_id', Auth::id());
            })->latest()->paginate(10);
            $sales->load('product');
            return view('seller.product.sales', compact('sales', 'products'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleRequest $request)
    {
        $product = Product::find($request->input('product'));
        if (!$product) {
            return redirect('/seller/products/sales')->withErrors('Product not found');
        }

        Sale::create([
            'name' => $request->input('name'),
            'status' => SaleStatus::PENDING->value,
            'product_id' => $request->input('product'),
        ]);

        return redirect('/seller/products/sales')->with('success', 'Sale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function report(ReportRequest $request)
    {
        $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
        $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

        $sales = Sale::latest()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with('product.user')
            ->get();

        $data = [
            'sales' => $sales,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
            'printed_date' => now()->format('Y-m-d H:i:s'),
        ];

        $pdf = Pdf::loadView('reports.sales', $data)
            ->setPaper('a4', 'landscape');

        return $pdf->download("sale_report.pdf");
    }
}
