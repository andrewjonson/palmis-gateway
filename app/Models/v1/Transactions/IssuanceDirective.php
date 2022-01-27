<?php

namespace App\Models\v1\Transactions;

use App\Models\BaseModel;
use App\Models\v1\References\Fpao;
use App\Models\v1\References\Fssu;
use App\Models\v1\Transactions\Iar;
use App\Models\v1\Transactions\Ris;
use App\Models\v1\References\FpaoUnit;
use Illuminate\Database\Eloquent\Model;
use App\Models\v1\Transactions\IssuanceDirectiveItem;
use App\Models\v1\References\IssuanceDirectivePurpose;
use App\Models\v1\References\IssuanceDirectiveCondition;

class IssuanceDirective extends Model
{
    protected $fillable = [
        'issuance_directive_nr',
        'authority',
        'pamu_id',
        'cognizant_fpao_id',
        'cognizant_fssu_id',
        'servicing_fpao_id',
        'date',
        'end_user_id',
        'issuance_directive_purpose_id',
        'issuance_directive_condition_id',
        'is_released',
        'iar_id'
    ];
    protected $table = 'tr_issuance_directives';

    public function cognizantFpao()
    {
        return $this->belongsTo(Fpao::class, 'cognizant_fpao_id', 'id');
    }

    public function servicingFpao()
    {
        return $this->belongsTo(Fpao::class, 'servicing_fpao_id', 'id');
    }
    
    public function fssu()
    {
        return $this->belongsTo(Fssu::class, 'cognizant_fssu_id', 'id');
    }

    public function issuancePurpose()
    {
        return $this->belongsTo(IssuanceDirectivePurpose::class, 'issuance_directive_purpose_id', 'id');
    }

    public function issuanceCondition()
    {
        return $this->belongsTo(IssuanceDirectiveCondition::class, 'issuance_directive_condition_id', 'id');
    }

    public function issuanceDirectiveItem()
    {
        return $this->hasMany(IssuanceDirectiveItem::class, 'issuance_directive_id', 'id');
    }

    public function pamuFpaoUnit()
    {
        return $this->belongsTo(FpaoUnit::class, 'pamu_id', 'id');
    }

    public function endUserFpaoUnit()
    {
        return $this->belongsTo(FpaoUnit::class, 'end_user_id', 'id');
    }

    public function ris()
    {
        return $this->hasMany(Ris::class, 'issuance_directive_id');
    }

    public function iar()
    {
        return $this->belongsTo(Iar::class, 'iar_id');
    }
}