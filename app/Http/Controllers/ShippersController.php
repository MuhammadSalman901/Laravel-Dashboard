<?php

namespace App\Http\Controllers;

use App\Models\Shippers;
use App\Services\ShipperService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShippersController extends Controller
{
    protected $shipperService;

    // Constructor for dependency injection of ShipperService
    public function __construct(ShipperService $shipperService)
    {
        $this->shipperService = $shipperService;
    }

    // Rendering the shipper listing page
    public function index()
    {
        $shippers = $this->shipperService->getAllshippers();
        $noRecordsFound = false;

        return view('shipper.index', [
            'shippers' => $shippers,
            'noRecordsFound' => $noRecordsFound,
        ]);
    }

    // Rendering the specific shipper details page
    public function show($id)
    {
        $shipper = $this->shipperService->getshipperById($id);

        return view('shipper.show', [
            'shippers' => $shipper
        ]);
    }

    // Initiating the create process and Rendering the shipper creation form
    public function create()
    {
        $userId = Auth::user()->id;

        return view('shipper.create', [
            'userId' => $userId
        ]);
    }

    // Storing incoming shipper data from the form to the database
    public function store()
    {
        // Backend validation of shipper attributes
        $validateAttributes = request()->validate([
            'company_name' => ['required', 'min:3'],
            'phone' => ['required'],
            'user_id' => ['required', 'integer']
        ]);

        // Creating the shipper using the service layer
        $this->shipperService->createShipper($validateAttributes);

        // Session Message
        session()->flash('success', 'Shippers Created Successfully');

        // Redirecting upon successful storage
        return redirect()->route('shipper.index');
    }

    // Initiating the edit process and Rendering the shipper edit form
    public function edit($id)
    {
        $shippers = $this->shipperService->getShipperById($id);

        return view('shipper.edit', [
            'shippers' => $shippers
        ]);
    }

    // Updating incoming shipper data from the form to the database
    public function update(Request $request, $id)
    {
        // Backend validation of updated shipper attributes
        $validateAttributes = $request->validate([
            'company_name' => ['required', 'min:3'],
            'phone' => ['required'],
        ]);

        // Updating the shipper using the service layer
        $this->shipperService->updateShipper($id, $validateAttributes);

        // Session Message
        session()->flash('success', 'Shipper Updated Successfully');

        // Redirecting upon successful update
        return redirect()->route('shipper.index');
    }

    // Searching shipper records based on input query
    public function search(Request $request)
    {
        // Fetching the search input field
        $search = $request->input('search');

        // Querying the database for matching shipper records
        $shippers = Shippers::query()
            ->where(function ($query) use ($search) {
                $query->where('company_name', 'iLIKE', "%{$search}%")
                    ->orWhere('phone', 'iLIKE', "%{$search}%");
            })
            ->paginate(10);

        // Check if no records are found
        $noRecordsFound = $shippers->isEmpty();

        // Rendering the shipper index page with search results
        return view('shipper.index', [
            'shippers' => $shippers,
            'noRecordsFound' => $noRecordsFound, // Pass this flag to the view to append no records found
        ]);
    }

    // Deleting a shipper record
    public function destroy($id)
    {
        // Deleting the shipper using the service layer
        $this->shipperService->deleteShipper($id);

        // Redirecting upon successful deletion
        return redirect()->route('shipper.index')
            ->with('success', 'Shipper deleted successfully');
    }
}
