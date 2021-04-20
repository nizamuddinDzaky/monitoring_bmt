
<li @if(Request::is('admin/report*'))class="active"@endif>
    <a href="{{route('user.report')}}">
        <i class="pe-7s-graph"></i>
        <p>Report</p>
    </a>
</li>