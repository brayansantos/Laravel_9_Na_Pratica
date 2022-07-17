<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('user.has.store')->only(['create', 'store']);
    }
    
    public function index() {
        $store = auth()->user()->store;
                        
        return view('admin.stores.index', compact('store'));
    }

    public function create() {        

        $users = User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request) {

        $data = $request->all();

        $user = auth()->user();
        $user->store()->create($data);
        
        /*$store = new Store;
        $store->name = $request->name;
        $store->description = $request->description;
        $store->phone = $request->phone;
        $store->mobile_phone = $request->mobile_phone;
        $store->slug = $request->slug;
        $store->user_id = $user->id;
        $store->save();*/

        flash('Loja criada com sucesso')->success(); 
        return redirect(route('admin.stores.index'));
    }

    public function edit($store) {

        $store = Store::find($store);

        return view('admin.stores.edit', compact('store'));

    }

    public function update(StoreRequest $request, $store) {

        $data = $request->all();

        $store = Store::find($store);
        $store->update($data);

        flash('Loja atualizada com sucesso')->success();        
        return redirect(route('admin.stores.index'));

    }

    public function destroy($store) {

        $store = Store::find($store);
        $store->delete();

        flash('Loja apagada com sucesso')->success(); 
        return redirect(route('admin.stores.index'));
    }
    
}
