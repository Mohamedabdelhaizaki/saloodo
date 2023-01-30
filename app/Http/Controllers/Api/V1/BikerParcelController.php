<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParcelRequest;
use App\Http\Resources\Api\ParcelResource;
use App\Models\Parcel;
use Illuminate\Http\Request;

class BikerParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = (int)($request->per_page ?? config("globals.per_page"));
        $parcels = Parcel::where('biker_id', auth()->id())->orWhere('status', 0)->paginate($perPage);

        return (new API)
            ->isOk('Parcels')
            ->setData(ParcelResource::collection($parcels)->response()->getData(true))
            ->build();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Parcel $parcel)
    {
        return (new API)
            ->isOk(__('Parcel'))
            ->setData(ParcelResource::make($parcel))
            ->build();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePick(Parcel $parcel)
    {
        if ($parcel->status != 0) {
            return (new API)
                ->isOk('Parcel Already Picked')
                ->build();
        }
        $data['biker_id'] = auth()->id();
        $data['status'] = 1;
        $data['picked_at'] = date('Y-m-d H:i:s');

        $parcel->fill($data)->save();
        return (new API)
            ->isOk(__('Parcels'))
            ->setData(ParcelResource::make($parcel))
            ->build();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDeliver(Parcel $parcel)
    {
        if ($parcel->status != 1) {
            return (new API)
                ->isOk('Parcel Already Picked')
                ->build();
        }
        $data['status'] = 2;
        $data['delivered_at'] = date('Y-m-d H:i:s');

        $parcel->fill($data)->save();
        return (new API)
            ->isOk(__('Parcels'))
            ->setData(ParcelResource::make($parcel))
            ->build();
    }
}
