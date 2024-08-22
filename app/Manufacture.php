<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuids;

class Manufacture extends Model
{
    use SoftDeletes;
    use Uuids;

    protected $table = 'manufactures';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','slug'];
    public $incrementing = false;

    public function cars()
    {
        return $this->hasMany(Car::class, 'manufacture_id');
    }
}
