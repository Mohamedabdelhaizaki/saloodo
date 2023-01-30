<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParcelRequest;
use App\Http\Resources\Api\ParcelResource;
use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = (int)($request->per_page ?? config("globals.per_page"));
        $parcels = Parcel::where('owner_id', auth()->id())->paginate($perPage);

        return (new API)
            ->isOk('Parcels')
            ->setData(ParcelResource::collection($parcels)->response()->getData(true))
            ->build();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParcelRequest $request, Parcel $parcel)
    {
        $parcel->fill($request->validated() + ['user_id' => auth()->id()])->save();

        return (new API)
            ->isOk(__('parcel'))
            ->setData(ParcelResource::make($parcel))
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
    public function update(ParcelRequest $request, Parcel $parcel)
    {
        if ($parcel->status != 0) {
            return (new API)
                ->isOk('Parcel Already Picked')
                ->build();
        }
        $parcel->fill($request->validated())->save();
        return (new API)
            ->isOk(__('Parcels'))
            ->setData(ParcelResource::make($parcel))
            ->build();
    }
}
