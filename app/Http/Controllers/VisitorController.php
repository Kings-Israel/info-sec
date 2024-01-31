<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Jobs\SendMail;
use App\Models\Visitor;
use Milon\Barcode\DNS2D;
use Milon\Barcode\QRcode;
use Illuminate\Http\Request;
use App\Imports\VisitorsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::all();

        return view('visitors.index', compact('visitors'));
    }

    public function import(Request $request)
    {
        Excel::import(new VisitorsImport, $request->visitors);

        return redirect()->route('guest');
    }

    public function store(Request $request)
    {
        $visitor_details = [
            'salutation' => $request->has('salutation') && $request->salutation != '' ? $request->salutation : NULL,
            'name' => $request->name,
            'Company' => $request->has('company') && $request->company != '' ? $request->company : NULL,
            // 'category' => $request->category,
            'Role' => $request->has('role') && $request->role != '' ? $request->role : NULL,
            // 'country' => $request->has('country') && $request->country != '' ? $request->country : NULL,
        ];

        $visitor = Visitor::create($visitor_details);

        if ($request->wantsJson()) {
            return response()->json(['success' => 'Guest added.', 'visitor' => $visitor->load('sessions')], 200);
        }

        return redirect()->route('guest')->with('success', 'Guest added successfully');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $guests = Visitor::where('name', 'like', '%'.$search.'%')
                                ->orWhere('Company', 'like', '%'.$search.'%')
                                ->orWhere('category', 'like', '%'.$search.'%')
                                ->orWhere('role', 'like', '%'.$search.'%')
                                ->orWhere('Country', 'like', '%'.$search.'%')
                                ->get();
        return view('guest', compact('guests'));
    }

    public function download($id)
    {
        $visitor = Visitor::findOrFail($id);

        $image = DNS2D::getBarcodePNG((string) $visitor->id. " ".$visitor->name, 'QRCODE');

        return response($image)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="' . $visitor->name . '.png"');
    }

    public function edit(Visitor $visitor)
    {
        return view('edit-guest')->with(['guest' => $visitor]);
    }

    public function update(Request $request, Visitor $visitor)
    {
        $visitor->update([
            'name' => $request->name,
            'Company' => $request->has('company') && $request->company != '' ? $request->company : NULL,
            'category' => $request->category,
            'Role' => $request->has('role') && $request->role != '' ? $request->role : NULL,
            'Country' => $request->has('country') && $request->country != '' ? $request->country : NULL,
        ]);

        return view('view-guest', compact('visitor'));
    }

    public function show($id)
    {
        $visitor = Visitor::with('sessions')->where('id', $id)->first();

        if (request()->wantsJson()) {
            return response()->json($visitor);
        }

        return view('view-guest', compact('visitor'));
    }

    public function registerToSession(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visitor_id' => 'required',
            'session_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $visitor = Visitor::find($request->visitor_id);

        $visitor->sessions()->attach([
            'session_id' => $request->session_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => 'Visitor added to session', 'visitor' => $visitor->load('sessions')], 200);
        }

        return back()->with('success', 'Visitor added to session.');
    }

    public function delete($id)
    {
        $guest = Visitor::find($id);

        $guest->delete();

        $guests = Visitor::all();

        return view('guest', compact('guests'));
    }

    public function guestPdf($id)
    {
        $visitor = Visitor::find($id);

        // $pdf = Pdf::loadView('guest-pdf', compact('visitor'));
        $pdf = Pdf::loadView('pdfs.world-bank-climate.index', compact('visitor'));

        return $pdf->stream($visitor->name.'.pdf');

        // return view('pdfs.world-bank-climate.index', compact('visitor'));
    }
}
