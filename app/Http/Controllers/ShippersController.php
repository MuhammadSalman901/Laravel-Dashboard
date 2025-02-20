<?php

namespace App\Http\Controllers;

use App\Models\Shippers;
use App\Services\ShipperService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShippersController extends Controller
{
    protected $shipperService;

    public function __construct(ShipperService $shipperService)
    {
        $this->shipperService = $shipperService;
    }
    public function index()
    {
        $shippers = $this->shipperService->getAllshippers();
        return view('shipper.index', ['shippers' => $shippers]);
    }

    public function show($id)
    {
        $shipper = $this->shipperService->getshipperById($id);

        return view('shipper.show', [
            'shippers' => $shipper
        ]);
    }

    public function create()
    {
        $userId = Auth::user()->id;

        return view('shipper.create', [
            'userId' => $userId
        ]);
    }

    public function store()
    {
        $validateAttributes = request()->validate([
            'company_name' => ['required', 'min:3'],
            'phone' => ['required'],
            'user_id' => ['required', 'integer']
        ]);

        $this->shipperService->createShipper($validateAttributes);

        return redirect()->route('shipper.index')
            ->with('success', 'shipper created successfully');
    }

    public function edit($id)
    {
        $shippers = $this->shipperService->getShipperById($id);

        return view('shipper.edit', [
            'shippers' => $shippers
        ]);
    }

    public function update(Request $request, $id)
    {
        $validateAttributes = $request->validate([
            'company_name' => ['required', 'min:3'],
            'phone' => ['required'],
        ]);

        $this->shipperService->updateShipper($id, $validateAttributes);

        return redirect()->route('shipper.index')
            ->with('success', 'Shipper updated successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $shippers = Shippers::query()
            ->where(function ($query) use ($search) {
                $query->where('company_name', 'iLIKE', "%{$search}%")
                    ->orWhere('phone', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        if ($shippers->isEmpty()) {
            abort(403, 'Record Not Found!!');
        }

        return view('shipper.index', ['shippers' => $shippers]);
    }

    public function destroy($id)
    {
        $this->shipperService->deleteShipper($id);

        return redirect()->route('shipper.index')
            ->with('success', 'Shipper deleted successfully');
    }
}
