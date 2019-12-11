<?php

namespace Bulkly\Http\Controllers;

use Bulkly\BufferPosting;
use Bulkly\SocialPostGroups;

use Illuminate\Http\Request;

class AbdullahController extends Controller
{
    public function index(){
        $posts = BufferPosting::paginate(10);
        $groups = SocialPostGroups::distinct()->get(['type']);
        return view('pages.abdullah')-> with(compact('posts', 'groups'));
    }

    public function search(Request $request) {
        $keyword = '';
        $date = '';
        $groups = '';

        if(isset($request['search'])){
            $keyword = $request['search'];
        }
        if(isset($request['date_filter'])){
            $date = $request['date_filter'];
        }
        
        if(isset($request['group_filter'])){
            $group = $request['group_filter'];
        }

        // $posts = BufferPosting::where('post_text', 'like', '%'.$keyword.'%')
        //             ->where('sent_at', 'like', '%'.$date.'%')
        //             ->where('group_id', 'like', '%'.$groups->id.'%')
        //             ->orderBy('id', 'desc')
        //             ->paginate(10);

        $posts = BufferPosting::where('post_text', 'like', '%'.$keyword.'%')
                ->where('sent_at', 'like', '%'.$date.'%')
                ->whereHas('groupInfo', function ($query) use ($group) {
                    $query->where('type', 'like', "%{$group}%");
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        

        $groups = SocialPostGroups::distinct()->get(['type']);

        return view('pages.abdullah')-> with(compact('posts', 'keyword', 'groups'));  
         
    }
}
