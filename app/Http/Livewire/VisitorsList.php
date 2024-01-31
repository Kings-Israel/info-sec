<?php

namespace App\Http\Livewire;

use App\Models\Visitor;
use Livewire\Component;
use Livewire\WithPagination;

class VisitorsList extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $guests = Visitor::when($this->search && $this->search != '', function ($query) {
                            $query->where('name', 'LIKE', '%'.$this->search.'%');
                        })
                        ->paginate(15);

        return view('livewire.visitors-list', compact('guests'));
    }
}
