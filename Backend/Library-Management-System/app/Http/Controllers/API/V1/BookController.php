<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/books",
     *     tags={"books"},
     *     summary="index",
     *     description="Returns all books",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *          description="Successful Operation",
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'nameBook' => 'required|max:255',
            'price' => 'required',
            'type' => 'required',
            'author' => 'required',
            'publisher' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                "message" => "The Content is not completed"
            ], Response::HTTP_NOT_ACCEPTABLE);
        }
        
        $newBook = new Book([
            'nameBook' => $request->get('nameBook'),
            'price' => $request->get('price'),
            'type' => $request->get('type'),
            'author' => $request->get('author'),
            'publisher' => $request->get('publisher')
        ]);
      
        $newBook->save();
      
        return response()->json($newBook);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *     path="/books/{id}",
     *     tags={"books"},
     *     summary="show",
     *     description="Show specific books",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             maximum=10,
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful Operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book Not Exist",
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function show($id)
    {
        //
        $book = Book::find($id);
        if (!$book){
            return response([
                'message' => 'Book Not Exist'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json($book);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $book = Book::find($id);

        if(!$book){
            return response([
                "message" => "Book Not Found"
            ], Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(),[
            'nameBook' => 'required|max:255',
            'price' => 'required',
            'type' => 'required',
            'author' => 'required',
            'publisher' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                "message" => "The Content is not completed"
            ], Response::HTTP_NOT_ACCEPTABLE);
        }
    
        $book->nameBook = $request->get('nameBook');
        $book->price = $request->get('price');
        $book->type = $request->get('type');
        $book->author = $request->get('author');
        $book->publisher = $request->get('publisher');
        
    
        $book->save();
    
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $book = Book::find($id);

        $borrow = Borrow::where('idBook', $id)->get();

        if (!$book) {
            return response([
                "message" => "Book Not Found"
            ], Response::HTTP_NOT_FOUND);
        }

        if (!$borrow->isEmpty()) {
            return response([
                "message" => "Book has been borrowed"
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        $book->delete();
    
        return response()->json($book::all());
    }
}
