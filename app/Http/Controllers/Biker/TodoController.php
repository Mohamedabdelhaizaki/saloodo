<?php

namespace App\Http\Controllers\Biker;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParcelRequest;
use App\Http\Resources\Client\Parcels\ParcelsCollection;
use App\Models\Parcel;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $parcels = Parcel::query();
            $parcels->select('id', 'address_from', 'address_to', 'created_at', 'status', 'picked_at', 'delivered_at')->where('biker_id', auth()->id())->orWhere('status', 0);

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


        return view('biker.parcels.index');
    }


    public function show(Parcel $parcel)
    {
        return view('biker.parcels.show', compact('parcel'));
    }

    public function update(Request $request, Parcel $parcel)
    {
        if (request()->ajax()) {
            if (!empty($parcel->biker_id) && $parcel->biker_id != auth()->id()) {
                $message = __('parcel Not Available');
                $messageStatus = 'success';
            } else {
                $message = __('Edit Success');
                $messageStatus = 'success';
                $data['biker_id'] = auth()->id();
                $data['status'] = $request->status;
                $request->status == 1 ? $data['picked_at'] = date('Y-m-d H:i:s') : $data['delivered_at'] = date('Y-m-d H:i:s');

                $parcel->fill($data)->save();
            }

            return response()->json([
                'status' => true,
                'messageStatus' => $messageStatus,
                'message' => $message
            ]);
        }
    }
}
