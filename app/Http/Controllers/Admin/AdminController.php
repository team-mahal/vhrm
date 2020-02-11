<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Attendance;
use Auth;
class AdminController extends Controller
{
    public function dashboard()
    {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin')     => backpack_url('dashboard'),
            trans('backpack::base.dashboard') => false,
        ];

        return view(backpack_view('dashboard'), $this->data);
    }

    public function attendances($value='')
    {
    	$this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin')     => backpack_url('dashboard'),
            trans('backpack::base.dashboard') => false,
        ];
        $user=User::all();
        $attendance=Attendance::where('date',date("Y-m-d"))->where('user_id',Auth::id())->get()->first();
        return view(backpack_view('attendance'), $this->data)->with('user',$user)->with('attendance',$attendance);
    }

    public function checkin(Request $r)
    {
    	Attendance::create($r->all());
    	return redirect()->back();
    }

    public function attendancesupdate($id)
    {
    	$attendance=Attendance::find($id);
    	$attendance->out_time=date("h:i a");
    	$attendance->update();
    	return redirect()->back();
    }
}
