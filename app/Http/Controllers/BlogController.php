<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;
use App\Models\Faq;
use DB;
 
class BlogController extends Controller
{
    public function index(Request $request)
    {
        $data = $requestdata = array(); 
        if (!empty($request->input('search_txt'))) {
            $requestdata['search_txt'] = $request->input('search_txt');
        }
        $requestdata['page_no'] = 1;
        $requestdata['per_page'] = 10;
        
        $response_data = Http::post(config('app.api_base') . 'bloglist', $requestdata);
        $data = json_decode($response_data);

        $requestd['page_no'] = 1;
        $requestd['per_page'] = 10;

        $response = Http::post(config('app.api_base') . 'bloglist', $requestd);
        $recent_blog = json_decode($response);
       
        return view('blog.index', compact('data','recent_blog' ));
    }
    public function detail($id)
    {
        $blog = DB::table('blogs')->where(['id' => $id, 'status' => 0, 'delete' => 0])->first();
        $blogImages = DB::table('blog_images')->where(['blog_id' => $id])->get();
        return view('blog.details', compact('blog', 'blogImages'));
    }

    public function list(){
        $blogs = DB::table('blogs')
        ->where(['status' => 0, 'delete' => 0])
        ->orderBy('id','desc')
        ->get();
        return view('blog.bloglist', compact('blogs'));
    }
    public function load_more(Request $request){
        $input=$request->all();
        $page_no= $input['page_no'];
     
        $page_no= $page_no +1;


        if (!empty($request->input('page_no'))) {
            $requestdata['page_no'] =  $page_no;
            $requestdata['per_page'] = 10;
        }

    $other_response_data = Http::post(config('app.api_base') . 'bloglist',$requestdata);
    $blog_data = json_decode($other_response_data);
   
  
       $html= view('blog.pagination_data', compact('blog_data'));
       $data['html']=(string)$html;
       $data['success']=1;
       $data['page_no']=$page_no;
       return json_encode($data);

      
      
    }
}
