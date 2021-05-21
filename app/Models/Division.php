<?php

namespace App\Models;

use App\Http\Controllers\DataClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class Division extends Model
{
    use Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'label', 'is_active','deleted_at', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function getDivisions($column = '*')
    {
        return Division::all();
    }

    public function getDivisionList()
    {
        return $this->getDivisions()->pluck('label', 'id');
    }

    public function returnDivisions()
    {
        $conditions[] = ['div.is_active', '=', DataClass::ACTIVE];

        return DB::table('divisions as div')
            ->select('div.id', DB::raw("CONCAT(div.label) AS text"))
            ->where($conditions)
            ->orderByDesc('div.id')
            ->limit(20)
            ->get();

    }


}
