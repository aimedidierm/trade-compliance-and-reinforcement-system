<?php

namespace App\Http\Controllers;

use App\Enums\SaleStatus;
use App\Enums\ShipmentStatus;
use App\Enums\UserRole;
use App\Http\Requests\ShipmentRequest;
use App\Models\Sale;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == UserRole::MINICOM->value) {
            $shipments = Shipment::paginate(10);
            return view('minicom.product.shipment', compact('shipments'));
        } elseif (Auth::user()->role == UserRole::EXPORTER->value) {
            $sales = Sale::where('status', SaleStatus::PENDING->value)->get();
            $shipments = Shipment::paginate(10);
            $shipments->load('sale.product');
            return view('exporter.product.shipment', compact('sales', 'shipments'));
        } else {
            $shipments = Shipment::whereHas(
                'sale.product',
                function (Builder $query) {
                    $query->where('user_id', Auth::id());
                }
            )->latest()->paginate(10);

            $shipments->load('sale.product');

            return view('seller.product.shipment', compact('shipments'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShipmentRequest $request)
    {
        $sale = Sale::find($request->input('sale'));
        $sale->status = SaleStatus::SHIPPED->value;
        $sale->update();

        Shipment::create([
            "packaging_number" => $request->input('packaging_number'),
            "currier" => $request->input('courier'),
            "ship_via" => $request->input('ship_via'),
            "date" => $request->input('date'),
            "address" => $request->input('address'),
            "tracking_number" => $request->input('tracking'),
            "status" => ShipmentStatus::NOTPAYED->value,
            "sale_id" => $request->input('sale'),
        ]);

        return redirect('/exporter/products')->with('success', 'Shipment created successfully.');
    }

    public function pay(string $id)
    {
        $shipment = Shipment::find($id);
        if (!$shipment) {
            return redirect('/seller/products/shipment')->withErrors('Shipment not found');
        }

        $shipment->status = ShipmentStatus::PAYED->value;
        $shipment->update();

        return redirect('/seller/products/shipment')->with('success', 'Shipment payed successfully.');
    }
}
