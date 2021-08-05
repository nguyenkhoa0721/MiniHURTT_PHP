<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\repo;

class repoController extends Controller
{ 
    public function all(Request $request){
        if ($request->query('q')==null){
            $repo = repo::orderBy('name')->get();
        }
        else{
            $repo = repo::where('name','ilike','%'.trim($request->query('q')).'%')
                        ->orderBy('name')
                        ->get();
        }
        return $repo;
    }
    public function detail($id){
        $repo = repo::where('id',$id)->get();
        if ($repo->count())
            return $repo;
        return 404;
    }
    public function create(Request $request){
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
