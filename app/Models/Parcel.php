<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Parcel extends Model
{
    use HasFactory;
    protected $table = 'saloodo_parcels';
    protected $guarded = ['id', 'updated_at'];
    private $sortableColumns = ["address_from", "address_to", "created_at", "picked_at", "delivered_at"];

    function getCreatedAtAttribute($value)
    {
        return date('d-m-Y g:i A', strtotime($value));
    }

    function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y g:i A', strtotime($value));
    }

    function getDeliveredAtAttribute($value)
    {
        $date = !empty($value) ? date('d-m-Y g:i A', strtotime($value)) : null;
        return $date;
    }

    function getPickedAtAttribute($value)
    {
        $date = !empty($value) ? date('d-m-Y g:i A', strtotime($value)) : null;
        return $date;
    }

    public function scopeSortBy(Builder $query, $request)
    {
        if (!isset($request->sort["column"]) || !isset($request->sort["dir"])) return $query->latest('created_at');

        if (
            !in_array(Str::lower($request->sort["column"]), $this->sortableColumns) ||
            !in_array(Str::lower($request->sort["dir"]), ["asc", "desc"])
        ) {
            return $query->latest('created_at');
        } else {
            return $query->orderBy($request->sort["column"], $request->sort["dir"]);
        }
    }

    public function scopeSearch(Builder $query, $request)
    {

        if (!isset($request->search["value"])) return $query;

        return $query->where('address_from', 'like', '%' . $request->search["value"] . '%')
            ->orWhere('address_to', 'like', '%' . $request->search["value"] . '%')
            ->orWhereDate('created_at', 'like', '%' . $request->search["value"] . '%')
            ->orWhereDate('picked_at', 'like', '%' . $request->search["value"] . '%')
            ->orWhereDate('delivered_at', 'like', '%' . $request->search["value"] . '%');
    }

    ####### Relations #######
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function biker()
    {
        return $this->belongsTo(User::class, 'biker_id');
    }
}
