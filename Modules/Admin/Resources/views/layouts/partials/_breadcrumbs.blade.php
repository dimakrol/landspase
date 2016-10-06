@if(View::hasSection('crumbs') || View::hasSection('actions'))
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
        <h2>@yield('title')</h2>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin') }}">Admin Home</a></li>
            @if(View::hasSection('crumbs'))
              @foreach(View::getSections()['crumbs'] as $i => $item)
                @if(isset($item['url']) && isset($item['title']))
                  <li><a href='{{ $item['url'] }}'>{{ $item['title'] }}</a></li>
                @endif
              @endforeach
            @endif
        </ol>
    </div>
    @if(View::hasSection('actions'))
    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
      <div class="title-action">
        @foreach(View::getSections()['actions'] as $i => $item)
          @if(isset($item['url']) && isset($item['title']))
              <a href='{{ $item['url'] }}' class="btn btn-success">{{ $item['title'] }}</a>
          @endif
        @endforeach
      </div>
    </div>
    @endif
</div>
@endif