<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Donation;
use App\Models\Blog;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
           
         return view('donation.thx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // ddd($id);
        $blog_id=$id;
        // ddd($blog_id);
        return view('donation.donate',compact('blog_id'));
        //  ,['blog_id'=>$blog_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //   ddd($request);
    // ddd($request->blog_id)
    //  ddd($request->donation);
    
          // バリデーション
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required',
        'donation' => 'required'
    ]);
    // バリデーション:エラー
    if ($validator->fails()) {
        return redirect()
        ->route('donation.create')
        ->withInput()
        ->withErrors($validator);
        }
        
        
        $donation = Donation::create([
            'blog_id'=>$request['blog_id'],
            'name'=>$request['name'],
            'email'=>$request['email'],
            'point'=>$request['donation']
            
        ]);
        
        return redirect()->route('donation.index');
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $donation = Donation::find($id);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
