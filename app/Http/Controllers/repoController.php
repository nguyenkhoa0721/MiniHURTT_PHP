<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\repo;

class repoController extends Controller
{ 
    public function all(){
        $repo = repo::orderBy('name')->get();
        return $repo;
    }
    public function find($q){
        return repo::find($q);
    }
    public function create(Request $request){
        // echo json_encode($request->all()); 
        return repo::firstOrCreate($request->all());
    } 
    public function update($id, Request $request){
        $repo = repo::findOrFail($id);
        $repo->update($request->all());

        return $request;
    }
    public function delete($id, Request $request){
        $repo = repo::findOrFail($id)->delete();
        return 204;
    }
}
