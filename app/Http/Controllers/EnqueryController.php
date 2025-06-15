<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Enquery;

class EnqueryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        function get_random($length){
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $randomString = '';
            $max = strlen($characters) - 1;
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[mt_rand(0, $max)];
            }
            return $randomString;
        }    
            $captcha= get_random(6);

            session()->put('captcha', $captcha);
        
        return view('enquery.index', compact('captcha'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
          ]);
          Enquery::create($request->all());
          return redirect()->back()->with('success','Enquery Created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function captcha(Request $request)
    {
        $input = $request->all();
        $value= $input['captcha'];
        $data='';
        $session_value = session('captcha');
        
         if ($session_value==$value){
            echo 1;
            
         }else {
            echo 0;
         }
       
    }
}
