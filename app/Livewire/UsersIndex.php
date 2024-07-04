<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    public $searchTerm;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $roleName = request()->query('role'); // Replace with the desired role name

        $users = User::where(function ($query) use ($searchTerm) {
            $query->where('name', 'like', $searchTerm)->orWhere('email', 'like', $searchTerm);
        });
        if($roleName){
            $users =  $users->whereHas('roles', function ($query) use ($roleName) {
                $query->where('name', $roleName);
            });
        }
            
        $users =  $users->orderBy('id', 'desc')
            ->with(['permissions', 'roles', 'providers'])
            ->paginate();
        return view('livewire.users-index', compact('users','roleName'));
    }
}
