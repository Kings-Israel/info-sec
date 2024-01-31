<?php

namespace App\Http\Livewire;

use App\Models\Session;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SessionGuestList extends Component
{
    use WithPagination;

    public $session;

    public function mount(Session $session)
    {
        $this->session = $session;
    }
    public function render()
    {
        $visitors_ids = DB::table('visitor_session')->where('session_id', $this->session->id)->pluck('visitor_id');

        $visitors = Visitor::whereIn('id', $visitors_ids)->paginate(20);

        return view('livewire.session-guest-list', compact('visitors'));
    }
}
