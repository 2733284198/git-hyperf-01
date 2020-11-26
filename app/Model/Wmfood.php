<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 */
class Wmfood extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wm_food';
    protected $primaryKey = 'id';

    public $timestamps = false;

    const CREATED_AT = null;
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}