<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreInstrumentGradeRequest;
use App\Http\Requests\UpdateInstrumentGradeRequest;
use App\Models\Comment;
use App\Models\Instrument;
use App\Http\Requests\StoreInstrumentRequest;
use App\Http\Requests\UpdateInstrumentRequest;
use App\Models\InstrumentGrade;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse{

        if(request('category_id')){
            $category = ['instrument_category_id','=',request('category_id')];
        }
        else $category = 0;
        if(request('instrument_name')){
            $name = ['name','like','%'.request('instrument_name').'%'];
        }
        else {$name = 0;}
        if($name && $category) {
            $instruments = Instrument::where([$name, $category])->paginate($perPage = 4, $columns = ['*'], $pageName = 'page');
        }
        elseif ($name){
            $instruments = Instrument::where([$name])->paginate($perPage = 4, $columns = ['*'], $pageName = 'page');
        }
        elseif ($category) {
            $instruments = Instrument::where([$category])->paginate($perPage = 4, $columns = ['*'], $pageName = 'page');
        }
        else{
            $instruments = Instrument::paginate($perPage = 4, $columns = ['*'], $pageName = 'page');
        }
        return response()->json([
            'success' => true,
            'message' => 'All instruments received!',
            'data' => $instruments,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreInstrumentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstrumentRequest $request): JsonResponse
    {
        $instrument = new Instrument();

        $instrument->name = $request->name;
        $instrument->description = $request->description;
        $instrument->quantity = $request->quantity;
        $instrument->price = $request->price;

        $picture = $request->photo->store('public/files');
        $picture = str_replace('public','storage',$picture);

        $instrument->photo = url($picture);
        $instrument->instrument_category_id = $request->instrument_category_id;
        $instrument->dimensions = $request->dimensions;
        $instrument->weight = $request->weight;
        $instrument->color = $request->color;

        $instrument->save();

        return response()->json([
            'success' => true,
            'message' => 'Instrument saved!',
            'data' => $instrument,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Instrument $instrument
     * @return \Illuminate\Http\Response
     */
    public function show(Instrument $instrument): JsonResponse
    {
        $id = $instrument->id;
        $rate = InstrumentGrade::where('instruments_id','=',$id)->avg('grade');
        $instrument->rate = $rate;
        $instrument->save();
        $totalVotes = InstrumentGrade::totalVotesForSingleInstrument($id);
        $comments = Comment::with('belongsToUser:id,first_name,last_name')->where('instruments_id','=',$id)->paginate(10,['id','comment','users_id']);
        return response()->json([
            'success' => true,
            'message' => 'Instrument received!',
            'data' => $instrument->with('belongsToInstrumentCategory:id,name')->where('id', $instrument->id)->get(),
            'rate' => $rate,
            'totalVotes' => $totalVotes,
            'comments'=>$comments,
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateInstrumentRequest $request
     * @param \App\Models\Instrument $instrument
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstrumentRequest $request, Instrument $instrument): JsonResponse
    {

        if($request->photo){
            $link = explode('storage',$instrument->photo);
            if(count($link)!==1){
                if(Storage::exists('public'.$link[1]))Storage::delete('public'.$link[1]);
            }
            $picture = $request->photo->store('public/files');
            $picture = str_replace('public','storage',$picture);
            $instrument->photo = url($picture);
        }
        $instrument->name = $request->name;
        $instrument->description = $request->description;
        $instrument->quantity = $request->quantity;
        $instrument->price = $request->price;

        $instrument->instrument_category_id = $request->instrument_category_id;
        $instrument->dimensions = $request->dimensions;
        $instrument->weight = $request->weight;
        $instrument->color = $request->color;
        $instrument->save();

        return response()->json([
            'success' => true,
            'message' => 'Instrument updated!',
            'data' => $instrument,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Instrument $instrument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instrument $instrument): JsonResponse
    {
        //
        if(!Auth::user()->admin){
            return response()->json([
                    'success' => false,
                    'message' => 'unauthorized']
            );
        }

        $instrument->delete();

        return response()->json([
            'success' => true,
            'message' => 'Instrument deleted successfully!',
            'data' => $instrument,
        ], 200);
    }

    public function makeComment(StoreCommentRequest $request): JsonResponse
    {
        Instrument::findOrFail($request->instrument);
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->users_id = Auth::id();
        $comment->instruments_id = $request->instrument;
        $comment->save();

        return response()->json([
            'success' => true,
            'message' => 'Comment saved successfully!',
            'data' => $comment,
        ], 200);
    }

    public function rateInstrument(StoreInstrumentGradeRequest $request): JsonResponse
    {
        Instrument::findOrFail($request->instrument);
        $rate = InstrumentGrade::query()->where([['instruments_id','=',$request->instrument],['users_id','=',Auth::id()]])->first();
        if($rate){
            $rate->grade = $request->grade;
        }
        else{
            $rate = new InstrumentGrade();
            $rate->grade = $request->grade;
            $rate->users_id = Auth::id();
            $rate->instruments_id = $request->instrument;
        }

        $rate->save();

        return response()->json([
            'success' => true,
            'message' => 'Grade saved successfully!',
            'data' => $rate,
        ], 200);
    }

    public function updateRate(UpdateInstrumentGradeRequest $request): JsonResponse
    {
        Instrument::findOrFail($request->instrument);
        $rate = InstrumentGrade::findOrFail();
        $rate->grade = $request->grade;
        return response()->json([
            'success' => true,
            'message' => 'Grade updated successfully!',
            'data' => $rate,
        ], 200);
    }

    public function showAllInstrumentsAdmin(){
        $instruments = Instrument::all();

        return response()->json([
            'success' => true,
            'message' => 'All instruments received!',
            'data' => $instruments,
        ], 200);
    }
}
