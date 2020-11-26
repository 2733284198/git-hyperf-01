<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;
/**
 */
class Wmshop extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wm_shop';
    protected $primaryKey = 'id';

    public $timestamps = false;

//    const CREATED_AT = 'creation_date';
    const CREATED_AT = null;
//    const UPDATED_AT = 'last_update';
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'shop_id', 'shopname','address'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];


    protected $attributes = [
        'password' => 'pass123',
    ];

    /* soft delete */
//    use SoftDeletes;

    /**
     * @return array
     */
    public static function getShopList()
    {
//        $data = self::all()->toArray();
        $data = self::all();

        return $data;
    }

    public static function getbyid($id)
    {
        $id = (int)$id;
        $data = self::query()->where('id', $id)->firstOrFail();

        return $data;
    }

    public static function getshopname()
    {
//        $data = self::query()->pluck('id', 'shopname');
        $data = self::query()->pluck('shopname', 'id');

        return $data;
    }

    public static function getshopnum()
    {
        $data = self::query()->count();

        return $data;
    }
}