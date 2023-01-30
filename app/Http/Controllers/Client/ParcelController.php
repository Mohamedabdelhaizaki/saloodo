<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParcelRequest;
use App\Http\Resources\Client\Parcels\ParcelsCollection;
use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $parcels = Parcel::query();
            $parcels->select('id', 'address_from', 'address_to', 'created_at', 'status', 'picked_at', 'delivered_at')->where('owner_id', auth()->id());

            if (isset($request->order[0]['column'])) {
                $request['sort'] = ['column' => $request['columns'][$request['order'][0]['column']]['name'], 'dir' => $request['order'][0]['dir']];
                $parcels->sortBy($request);
            }

            if (isset($request->search['value']))  $parcels->search($request);

            $parcelCount = $parcels->count();
            $allParcels = $parcels->skip($request->start)
                ->take(($request['length'] == '-1') ? $parcelCount : $request->length)
                ->get();
            return ParcelsCollection::make($allParcels)
                ->additional(['total_count' => $parcelCount]);
        }


        return view('client.parcels.index');
    }


    public function show(Parcel $parcel)
    {
        return view('client.parcels.show', compact('parcel'));
    }

    public function create()
    {
        return view('client.parcels.create');
    }

    public function edit(Parcel $parcel)
    {
        if ($parcel->status == 0 && $parcel->owner_id == auth()->id())
            return view('client.parcels.edit', compact('parcel'));
        return redirect()->route('client.parcels.index');
    }

    public function store(ParcelRequest $request, Parcel $parcel)
    {
        if (request()->ajax()) {

            $parcel->fill($request->validated() + ['owner_id' => auth()->id()])->save();

            session()->put(['alert-message' => __('Add Success'), 'alert-type' => 'success']);
            return response()->json([
                'status' => true,
            ]);
        }
    }

    public function update(ParcelRequest $request, Parcel $parcel)
    {
        if (request()->ajax()) {
            if ($parcel->status != 0) {
                session()->put(['alert-message' => __('Parcel Already Picked'), 'alert-type' => 'error']);
                return response()->json([
                    'status' => true,
                ]);
            }
            $parcel->fill($request->validated())->save();
            session()->put(['alert-message' => __('Edit Success'), 'alert-type' => 'success']);

            return response()->json([
                'status' => true,
            ]);
        }
    }
}
