<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Session;
use App\Models\Visitor;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use function GuzzleHttp\Promise\all;

class GuestsReport implements FromView
{
    public $export_params;

    public function __construct($params)
    {
        $this->export_params = $params;
    }

    public function view(): View
    {
        $visitors = [];
        switch (array_keys($this->export_params)[0]):
            case 'full_report':
                $visitors = Visitor::all();
                break;
            case 'attendees_report':
                $visitors_ids = DB::table('visitor_session')->get()->pluck('visitor_id');
                $visitors = Visitor::whereIn('id', $visitors_ids)->get();
                break;
            case 'walk_ins':
                $visitors = Visitor::whereDate('updated_at', '2023-11-17')->get();
                break;
            case 'session_report':
                $session = Session::with('visitors')->find($this->export_params['session_report']);
                $visitors = $session->visitors;
                break;
            case 'day_attendance_report':
                $sessions = Session::with('visitors')->whereDay('session_date', Carbon::parse($this->export_params['day_attendance_report'])->format('d'))->get();
                foreach ($sessions as $session) {
                    foreach ($session->visitors as $visitor) {
                        array_push($visitors, $visitor);
                    }
                }
                $visitors = collect($visitors)->unique('id');
                break;
            case 'day_non_attendance_report':
                $sessions = Session::with('visitors')->whereDay('session_date', Carbon::parse($this->export_params['day_non_attendance_report'])->format('d'))->get();
                $session_visitors = [];
                foreach ($sessions as $session) {
                    foreach ($session->visitors as $visitor) {
                        array_push($session_visitors, $visitor);
                    }
                }
                $session_visitors = collect($session_visitors)->unique('id')->pluck('id');
                $all_visitors = Visitor::all();
                $visitors = $all_visitors->whereNotIn('id', $session_visitors);
                break;
            default:
                $visitors = Visitor::all();

        endswitch;

        return view('exports.visitors-report', ['guests' => $visitors]);
    }
}
