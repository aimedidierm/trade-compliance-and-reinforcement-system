<?php

namespace App\Http\Controllers;

use App\Enums\DeclarationStatus;
use App\Enums\UserRole;
use App\Http\Requests\DeclarationRequest;
use App\Models\Declaration;
use App\Models\Shipment;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeclarationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::user()->role == UserRole::EXPORTER->value) {
            $declarations = Declaration::paginate(10);
            $shipments = Shipment::latest()->get();
            return view('exporter.product.declaration', compact('declarations', 'shipments'));
        } else if (Auth::user()->role == UserRole::MINICOM->value) {
            $declarations = Declaration::paginate(10);
            return view('minicom.product.declaration', compact('declarations'));
        } else {
            $declarations = Declaration::whereHas('sale.product', function (Builder $query) {
                $query->where('user_id', Auth::id());
            })
                ->with('sale')
                ->latest()
                ->paginate(10);
            return view('seller.product.declaration', compact('declarations'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeclarationRequest $request)
    {
        Declaration::create([
            "address" => $request->input('address'),
            "quantity" => $request->input('quantity'),
            "price" => $request->input('price'),
            "weight" => $request->input('weight'),
            "status" => DeclarationStatus::PENDING->value,
            "shipment_id" => $request->input('shipment'),
        ]);

        return redirect('/exporter/products/declaration')->with('success', 'Declaration created successfully.');
    }

    public function confirmShip(string $id)
    {
        $declaration = Declaration::find($id);
        $declaration->status = DeclarationStatus::SHIPPED->value;
        $declaration->update();

        return redirect('/exporter/products/declaration')->with('success', 'Declaration updated successfully.');
    }

    public function confirmDelivered(string $id)
    {
        $declaration = Declaration::find($id);
        $declaration->status = DeclarationStatus::DELIVERED->value;
        $declaration->update();

        return redirect('/exporter/products/declaration')->with('success', 'Declaration updated successfully.');
    }
}
