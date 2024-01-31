<?php

namespace App\Http\Controllers;

use App\Exports\GuestsReport;
use Carbon\Carbon;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::with('visitors')->get();

        if (request()->wantsJson()) {
            return response()->json(['sessions' => $sessions], 200);
        }

        // return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        # code...
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required',
            'date' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'
        ]);

        $session = Session::create([
            'topic' => $request->topic,
            'description' => $request->has('description') && $request->description != '' ? $request->description : NULL,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'duration' => Carbon::parse($request->start_at)->diffInMinutes(Carbon::parse($request->end_at)),
            'host' => $request->has('host') && $request->host != '' ? $request->host : NULL,
            'speakers' => $request->has('speakers') && $request->speakers != '' ? $request->speakers : NULL,
            'session_date' => $request->date,
        ]);

        return redirect()->route('view-session', $session->id)->with('success', 'Session created.');
    }

    public function show($id)
    {
        $session = Session::find($id);

        if (request()->wantsJson()) {
            return response()->json(['session' => $session], 200);
        }

         return view('sessions', compact('session'));
    }

    public function edit(Session $session)
    {
        return view('edit-session', compact('session'));
    }

    public function update(Request $request, Session $session)
    {
        $request->validate([
            'topic' => 'required',
            'date' => 'required',
            'start_at' => 'required',
            'end_at' => 'required'
        ]);

        $session->update([
            'topic' => $request->topic,
            'description' => $request->has('description') && $request->description != '' ? $request->description : NULL,
            'session_date' => $request->date,
            'duration' => Carbon::parse($request->start_at)->diffInMinutes(Carbon::parse($request->end_at)),
            'host' => $request->has('host') && $request->host != '' ? $request->host : NULL,
            'speakers' => $request->has('speakers') && $request->speakers != '' ? $request->speakers : NULL,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);

        return view('view-session', compact('session'));
    }

    public function delete($id)
    {
        $session = Session::find($id);

        $session->delete();

        $sessions = Session::all();

        return view('sessions', compact('sessions'));
    }

    public function report()
    {
        $query = request()->query();

        if (count(request()->query()) > 1) {
            $query = [];
            $query[array_keys(request()->query())[1]] = request()->query()[array_keys(request()->query())[1]];
        }

        return Excel::download(new GuestsReport($query), 'guest-report.xlsx');
    }
}
