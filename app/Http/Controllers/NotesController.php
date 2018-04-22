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
            return ['' => 'Note Created'];
        } 
        else{
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
        $currentUser = JWTAuth::parseToken()->authenticate();

        $note = $currentUser->notes()->find($id);
    
        if(!$note)
             return ['' => 'Note not found'];
    
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
        $currentUser = JWTAuth::parseToken()->authenticate();

        $note = $currentUser->notes()->find($id);
        if(!$note)
             return ['' => 'Could not find note'];
    
        $note->fill($request->all());
    
        if($note->save())
            return ['' => 'Note Updated'];
        else
            return ['' => 'Could not update note, Error 500'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $currentUser = JWTAuth::parseToken()->authenticate();

        $note = $currentUser->notes()->find($id);
    
        if(!$note)
            return ['' => 'Could not find note'];
    
        if($note->delete())
            return ['' => 'Note Deleted'];
        else
            return ['' => 'Could not delete note, Error 500'];
    }
}
