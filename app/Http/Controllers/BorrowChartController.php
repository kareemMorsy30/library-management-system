<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Charts\BorrowChart;
use App\Book;

class BorrowChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profits = [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $books = Book::all();

        foreach($books as $book){
            for($i = 1; $i <= 12; $i++){
                $profits[$i - 1] = $profits[$i - 1] + $book->price * count($book->users_borrows()->whereMonth('borrows.return_back', $i)->get());
            }
        }

        $borrowChart = new BorrowChart;
        $borrowChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $borrowChart->dataset('Users borrow', 'line', $profits)
            ->color("#34C1DA")
            ->backgroundcolor("#34C1DA");
        return view('Admin.landing', [ 'borrowChart' => $borrowChart ] );
    }
}
