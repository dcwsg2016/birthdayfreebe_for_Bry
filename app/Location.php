<?php

namespace BirthdayFreebe;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    public $table = "locations";

    //found this online, this code automatically updates created_at and updated_at:
    public $timestamps = true;

    protected $fillable = [
        'city',
        'state',
        'zip_code',
        'number_of_businesses'
    ];
}
