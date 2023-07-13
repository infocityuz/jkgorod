<?php

namespace Modules\ForTheBuilder\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayStatus extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'pay_status';

    protected $fillable = [
        'deal_id',
        'installment_plan_id',
        'pay_date',
        'must_pay_date',
        'price',
        'price_to_pay',
        'status',
        'price_history',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(InstallmentPlan::class, 'installment_plan_id', 'id');
    }
    protected function notification()
    {
        return $this->hasOne(Notifications_::class, 'relation_id', 'id')->where('relation_type', 'installment_plan');
    }
    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class, 'deal_id', 'id');
    }
}