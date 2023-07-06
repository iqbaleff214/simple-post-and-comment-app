<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        return \view('users.index', [
            'filters' => $request->all('search', 'order'),
            'users' => User::filter($request->only('search', 'order'))
                ->user()
                ->paginate(5)
                ->withQueryString(),
        ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        try {
            $user->delete();
            return back();
        } catch (\Exception $exception) {
            return back()->with('message', $exception->getMessage());
        }
    }
}
