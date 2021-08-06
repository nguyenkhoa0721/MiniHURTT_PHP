<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\repo;

class repoController extends Controller
{
    public function all(Request $request)
    {
        if ($request->query('q') == null) {
            $repo = repo::orderBy('name')->get();
        } else {
            $repo = repo::where('name', 'ilike', '%' . trim($request->query('q')) . '%')
                ->orderBy('name')
                ->get();
        }
        return $repo;
    }
    public function detail($id)
    {
        $repo = repo::where('id', $id)->get();

        $score = array();
        $listName = repo::where('id', '!=', $id)->pluck('name');
        $listID = repo::where('id', '!=', $id)->pluck('id');
        $target = "0" . $repo[0]["name"];
        for ($i = 0; $i < sizeof($listName); $i++) {
            $comp = "0" . $listName[$i];
            $a = [[]];
            for ($h = 0; $h < strlen($target); $h++) {
                $a[$h][0] = 0;
            }
            for ($j = 0; $j < strlen($comp); $j++) {
                $a[0][$j] = 0;
            }
            for ($h = 1; $h < strlen($target); $h++) {
                for ($j = 1; $j < strlen($comp); $j++) {
                    if ($target[$h] == $comp[$j]) {
                        $a[$h][$j] = $a[$h - 1][$j - 1] + 1;
                    } else {
                        $a[$h][$j] = max($a[$h - 1][$j], $a[$h][$j - 1]);
                    }
                }
            }
            $score[] = (object) array('id' => $listID[$i], 'name' => $listName[$i], 'score' => $a[strlen($target) - 1][strlen($comp) - 1]);
        }
        usort($score, function($a, $b) {
            return $a->{"score"} < $b->{"score"} ? 1 : -1;
        });
        $score = array_slice($score,0,3);
        $repo[0]["rec"] = json_encode($score);
        return $repo;
    }
    public function create(Request $request)
    {
        return repo::firstOrCreate($request->all());
    }
    public function update($id, Request $request)
    {
        $repo = repo::findOrFail($id);
        $repo->update($request->all());

        return $request;
    }
    public function delete($id, Request $request)
    {
        $repo = repo::findOrFail($id)->delete();
        return 204;
    }
}
