<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Http\Response;
use symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Book;

class BookController extends Controller
{
    // /**
    //  * Display a listing of item.
    //  * 
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {
        return Book::get();
    }

    // /**
    //  * Dtore a newly created item in storage.
    //  * 
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(Request $request)
    {
        try{
            $book = new Book;
            $book->fill($request->validated())->save();

            return $book;
        
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
    
        }
    }
    // /**
    //  * Display the specified item.
    //  * 
    //  * @param int $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function show($id)
    {
        $book = Book::findOrfail($id);

        return $book;
    }

    // /**
    //  * Update the specidied item in storage.
    //  * 
    //  * @param \Illuminate\Http\Request $request
    //  * @param int $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        if(!$id){
            throw new HttpException(400, "Invalid id");
        }

        try {
            $book = Book::find($id);
            $book->fill($request->validated())->save();
            
            return $book;

        } catch(\Exception $exception){
            throw new HttpException(400, "invalid data - {$exception->getMessage()}");
        }
        }

        // /**
        //  * Remove the specified item from storage.
        //  * 
        //  * @param int $id
        //  * @return \Illuminate\Http\Response
        //  */
        public function destroy($id)
        {
            $book = Book::findOrfail($id);
            $book->delete();
        }
}