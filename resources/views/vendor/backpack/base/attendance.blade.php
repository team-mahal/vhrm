@extends(backpack_view('blank'))
@section('content')
<form action="{{ url('checkin') }}" method="POST">
    @csrf
    <div class="box-body w-50 m-auto card p-5">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Employee Name</label>
            <div class="col-sm-12">
                <select class="form-control" disabled tabindex="-1" aria-hidden="true">
                    <option>Select Member</option>
                    @foreach($user as $u)
                        <option {{ Auth::id()==$u->id ? 'selected':'' }} value="{{ $u->id }}">{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Todays Date</label>
            <div class="col-sm-12">
                <input type="text" name="date" value="{{ date("Y-m-d") }}" readonly class="form-control" id="start" placeholder="Today Date">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}"  class="form-control" id="start" placeholder="Today Date">
                <input type="hidden" name="in_time" value="{{ date("h:i a") }}" class="form-control" id="start" placeholder="Today Date">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Remarks</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" name="remark" id="remarks" placeholder="Remarks...">
            </div>
        </div>
        <div class="form-group text-center">
            <label for="inputEmail3" id="day_year" class="col-sm-6 control-label col-md-offset-3" style="font-size: 22px;">{{ Carbon\Carbon::now()->toRfc850String() }}</label>
            <div class="col-sm-12 col-md-offset-3">

                <span id="demo" style="font-size:72px;">7:20:59 AM</span>
                @if($attendance)
                    <h3>Today's Check In : {{ $attendance->in_time }}</h3>
                @endif
                @if($attendance && $attendance->out_time)
                    <h3>Today's Check out : {{ $attendance->out_time }}</h3>
                @endif
            </div>
        </div>
        <div class="box-footer">
            <center>
                <div class="col-sm-22">
                    @if($attendance)
                        @if(!$attendance->out_time)
                            <a href="{{ url("attendances/update/".$attendance->id) }}" class="btn btn-warning btn-sm" id="submit_btn"><i class="fa fa-check"></i> Check Out</a>
                        @endif
                    @else
                        <button type="submit" class="btn btn-warning btn-sm" id="submit_btn"><i class="fa fa-check"></i> Check In</button>
                    @endif
                </div>
            </center>
        </div>
    </div>
</form>
<script>
    var myVar = setInterval(myTimer, 1000);

    function myTimer() 
    {
        var d = new Date();
        document.getElementById("demo").innerHTML = d.toLocaleTimeString();
    }
</script>
@endsection