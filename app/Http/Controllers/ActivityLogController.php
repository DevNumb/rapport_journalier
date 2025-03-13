<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::latest()->get();
        return view('activity-logs.index', compact('logs'));
    }
}
