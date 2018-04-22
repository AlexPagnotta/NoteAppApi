<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use JWTAuth;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = JWTAuth::parseToken()->authenticate();
        return $currentUser
        ->notes()
        ->orderBy('created_at', 'DESC')
        ->get()
        ->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentUser = JWTAuth::parseToken()->authenticate();

        $note = new Note;

        $note->title = $request->get('title');
        $note->text = $request->get('text');

        if($currentUser->notes()->save($note)){
            //return $this->response->created();
            return ['' => 'Note Created'];
        } 
        else{
            //return $this->response->error('could_not_create_note', 500);
            return ['' => 'Could Not Create Note, Error 500'];
        }
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $note;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note->update($request->all());

        return response()->json($note, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $note->delete();

        return response()->json(null, 204);
    }
}
