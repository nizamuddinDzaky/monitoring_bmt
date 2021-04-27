
<li @if(Request::is('user/neraca*'))class="active"@endif>
    <a href="{{route('user.report')}}">
        <i class="pe-7s-graph"></i>
        <p>REPORT NERACA</p>
    </a>
</li>

<li @if(Request::is('user/shu*'))class="active"@endif>
    <a href="{{route('user.shu')}}">
        <i class="pe-7s-graph"></i>
        <p>REPORT SHU</p>
    </a>
</li>