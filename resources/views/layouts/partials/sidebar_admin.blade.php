<li @if(Request::is('admin/user*'))class="active"@endif>
    <a href="{{route('admin.user')}}">
        <i class="pe-7s-graph"></i>
        <p>User</p>
    </a>
</li>

<li @if(Request::is('admin/koperasi*'))class="active"@endif>
    <a href="{{route('admin.koperasi')}}">
        <i class="pe-7s-graph"></i>
        <p>Koperasi</p>
    </a>
</li>

<li @if(Request::is('admin/report*'))class="active"@endif>
    <a href="{{route('admin.report')}}">
        <i class="pe-7s-graph"></i>
        <p>Report</p>
    </a>
</li>