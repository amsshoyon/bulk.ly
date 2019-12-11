@extends('layouts.app')
@section('content')

<style>
.ams-box{
    border: 1px solid rgba(0,0,0,.5);
}
.ams-header{
    border-bottom: 1px solid rgba(0,0,0,.5);
    padding: 15px 10px;
}
.ams-body{
    padding: 15px 10px;
}
.ams-body form input,.ams-body form select{
    height: 50px !important;
}

.ams-body thead{
    background-color: rgba(0,0,0,.05);
}

</style>

<div class="container-fluid app-body settings-page">
	
    <div class="row">
        <div class="ams-box">
            <div class="ams-header">
                <h3><strong>Recent Post Sent To Buffer </strong>: @if(!isset($keyword)) <span>Showing {{ count($posts) }} of {{ $posts->total()}} Posts</span> @else Showing results for '{{$keyword}}' @endif</h3>
            </div>
            <div class="ams-body">
                <div class="hor-menu">
                    <form method="post" action="{{ action('AbdullahController@search') }}" accept-charset="UTF-8">
                    {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="search" id="ams_search" class="form-control" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="date" name="date_filter" id="date_filter" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="group_filter" id="group_filter" class="form-control">
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn brn-sm btn-info">
                                Search
                            </button>
                        </div>
                        
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Group Name</th>
                        <th scope="col">Group Type</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">Post Text</th>
                        <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody id="search_result">
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->groupInfo->name }}</th>
                            <td>{{ $post->groupInfo->type }}</th>
                            <td>{{ $post->accountInfo->name }}</th>
                            <td>{{ $post->post_text }}</th>
                            <td>{{ $post->sent_at }}</th>
                        </tr>
                    @endforeach
                    </tbody>
                    
                </table>
                <div class="ams-paginate pull-right">
                    {{ $posts->links() }}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    // fetch_post_data();

    // function fetch_post_data(query = '') {
    //     $.ajax({
    //         url: "/abdullah/search",
    //         method: 'post',
    //         data: {
    //             query: query
    //         },
    //         dataType: 'json',
    //         success: function (data) {
    //             $('#search_result').html(data.table_data);
    //             $('#total_records').text(data.total_data);
    //         }
    //     })
    // }

    // $(document).on('change keyup paste', '#ams_search', function () {
    //     var query = $(this).val();
    //     fetch_post_data(query);
    // });

</script>