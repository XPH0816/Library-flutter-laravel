<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $borrow = Borrow::all();

        return response()->json($borrow);
    }

    /**
     * Display a listing of the Borrowable Book.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBorrowable()
    {
        //
        $borrow = Borrow::select('books.id', 'books.nameBook', 'books.type', 'books.author', 'books.publisher')
                         ->rightJoin('books', 'borrows.idBook', '=', 'books.id')
                         ->where('borrows.idBook', NULL)
                         ->get();

        return response()->json($borrow);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created Borrow Record in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->missing('idReader')) {
            //Get Current User id
            $request['idReader'] = Auth::id();
        } 

        if ($request->missing('lendDate')){
            //Get Current Date
            $request['lendDate'] = date('Y-m-d');

        } 

        if ($request->missing('dueDate')){
            //AutoFill endDate
            $request['dueDate'] = date('Y-m-d', strtotime("+2 week"));
        }
        
        $validator = Validator::make($request->all(),[
            'idReader' => 'required',
            'idBook' => 'required',
            'lendDate' => 'required|before:dueDate',
            'dueDate' => 'required|after:lendDate'
        ]);

        if ($validator->fails()) {
            return response([
                "message" => "The Content is not completed"
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        //Check the Book
        $borrow = Borrow::where('idBook', $request->get('idBook'))->get();

        if (!$borrow->isEmpty()) {
            return response([
                "message" => "Book has been borrowed"
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        $newBorrow = new Borrow([
            'idReader' => $request->get('idReader'),
            'idBook' => $request->get('idBook'),
            'lendDate' => $request->get('lendDate'),
            'dueDate' => $request->get('dueDate'),
        ]);

        $newBorrow->save();

        return response([
            "message" => "Successfully Borrow a Book"
        ]);
    }

    /**
     * Display the specified Reader Borrow Record.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $borrow = Borrow::where('idReader', $id)->get();

        if ($borrow->isEmpty()) {
            return response([
                "message" => "This Reader does not borrow Book"
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json($borrow);
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
    }

    /**
     * Delete the specified Borrow Record from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function adminDestory(Request $request)
    {
        //

        $validator = Validator::make($request->all(),[
            'idReader' => 'required',
            'idBook' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response([
                "message" => "The Content is not completed"
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        $bookid = $request->get('idBook');
        $userid = $request->get('idReader');

        $borrow = Borrow::where('idReader', $userid)->where('idBook', $bookid);

        if ($borrow->get()->isEmpty()) {
            return response([
                "message" => "This Reader Doesn't Borrow the Book"
            ], Response::HTTP_NOT_FOUND);
        }

        $borrow->delete();
        
        return response()->json(Borrow::where('idReader', $userid)->get());

    }
    

    /**
     * Remove the specified Borrow Record from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $userid = Auth::id();

        $borrow = Borrow::where('idReader', $userid)->where('idBook', $id);

        if ($borrow->get()->isEmpty()) {
            return response([
                "message" => "This Reader Doesn't Borrow the Book"
            ], Response::HTTP_NOT_FOUND);
        }

        $borrow->delete();

        return response()->json(Borrow::where('idReader', $userid)->get());

    }
}
