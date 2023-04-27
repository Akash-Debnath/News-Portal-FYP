<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewNews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NewsViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $device_mac = shell_exec("cat /sys/class/net/*/address | grep -v '00:00:00:00:00:00' | head -n 1");
        // dd(shell_exec('ifconfig -a | grep ether | head -n 1 | awk \'{print $2}\''));
        $id = $request->get('id');
        $request->validate([
            'id'   => 'required'
        ]);
        $views = new ViewNews();
        $views->views = 1;
        $views->post_id =  $request->get('id');
        // $views->author_id = Auth::user()->id;
        if (!Auth::user()== null) {
            $views->author_id = Auth::user()->id;
        } else {
            // $views->author_id = $_SERVER['REMOTE_ADDR']; // Use IP address
            // $views->author_id = exec('getmac'); // Use MAC address on Windows
            $views->author_id = shell_exec('ifconfig -a | grep ether | head -n 1 | awk \'{print $2}\''); // Use MAC address on Unix/Linux
        }
        $views->save();
        return Redirect::to('dashboard/posts/'.$id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd(123);
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
