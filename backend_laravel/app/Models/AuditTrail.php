<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;


    /**
     * Create Audit Trail for product Action
     */
    public static function addToAudit($subject, $queryRequest, $queryType)
    {
        if ($queryRequest != null) {
            $queryRequest = json_encode($queryRequest);
        }

        static::create([
            'subject' => $subject,
            'query_request' => $queryRequest,
            'query_type' => $queryType,
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'ip' => request()->ip(),
            'agent' => request()->header('user-agent'),
            'user_id' => auth()->check() ? auth()->user()->id : 0
        ]);

        return true;
    }
}
