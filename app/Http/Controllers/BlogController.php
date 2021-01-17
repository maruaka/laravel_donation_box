<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Validator;
use App\Models\Blog;
use App\Models\Donation;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //  $points = Donation::selectRaw('sum(point) as blog_id')
        //           ->groupByRaw('blog_id')
        //           ->get();
        
            $points = DB::table('donations')
                     ->select('blog_id',DB::raw('SUM(point) as points'))
                     ->groupBy('blog_id');
                    //  ->get();
        //  ddd($points);
        //  
        //  $points = Donation::where('blog_id','24')->sum('point');
        
         $blogs = DB::table('blogs')
                    ->leftJoinSub($points,'points',function($join){
                        $join->on('blogs.id','=','points.blog_id')
                        ->orderBy('blogs.created_at','desc');
                    })->get(); 
                    // ->get();
        // $blogs = DB::table('blogs')->get();
        //  ddd($blogs);
         
        return view('blog.index',[
            'blogs'=> $blogs
            ]);
           
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
         // バリデーション
    $validator = Validator::make($request->all(), [
        'title' => 'required | max:191',
        'text' => 'required',
    ]);
    // バリデーション:エラー
    if ($validator->fails()) {
        return redirect()
        ->route('blog.create')
        ->withInput()
        ->withErrors($validator);
        }
        
        $image = request()->file('image')->getClientOriginalName();
    
        $image_path = request()->file('image')->storeAs('public/storage/images/blog',$image);
        // ddd($image_path);
        
        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        
        // ddd($user_id);
        
        
        $blog = Blog::create([
            'user_id'=>$user_id,
            'user_name'=>$user_name,
            'title'=>$request['title'],
            'text'=>$request['text'],
            'file_name'=>$image,
            'file_path'=>$image_path,
            'point'=>'0'
        ]);
        // ddd($image_path);
  
    // ルーティング「todo.index」にリクエスト送信（一覧ページに移動）
    return redirect()->route('blog.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $blog = Blog::find($id);
        // $point = $blog->select('', 'email as user_email')->get();
        return view('blog.show',['blog'=>$blog]);
        
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
