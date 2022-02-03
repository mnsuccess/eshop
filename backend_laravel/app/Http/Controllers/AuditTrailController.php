<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditTrail;

class AuditTrailController extends Controller
{
    /**
     * Listing of the resource
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audits = AuditTrail::orderBy('created_at', 'desc')->select(
            'id',
            'subject',
            'query_request',
            'query_type',
            'transaction_id',
            'url',
            'method',
            'ip',
            'agent',
            'user_id',
            'created_at'
        )->paginate(10);
        return view('admin.audit.index', compact('audits'));
    }
}
