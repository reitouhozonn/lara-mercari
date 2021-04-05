<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    use HasFactory;

         // 出品中
        const STATE_SELLING = 'selling';
         // 購入済み
        const STATE_BOUGHT = 'bought';

    public function SecondaryCategory(): BelongsTo
    {
        return $this->belongsTo(SecondaryCategory::class);
    }
    
    public function getIsStateSellingAttribute(): String
    {
        return $this->state === self::STATE_SELLING;
    }

    // public function solditems(): BelongsToMany
    // {
    //     return $this->belongsToMany('App\Models\Item',
    //         'secondary_categories',
    //         'primary_category_id',
    //         'primary_category_id',
    //     )->withTimestamps();
    // }

        // public function solditems()
        // {
        //     return $this->belongsTo(User::class);
        // }

}
