<div class="w-100">
    <form method="get" action="{{route('events.search')}}">
        <div class="input-group">
            <input type="text" name="q" class="search form-control form-control-dark rounded-0 py-3"
                   placeholder="Search for your events here eg. adventure, dance or cooking."
                   value="{{session()->has('q') ? session('q') : ''}}">
            <div class="input-group-append d-none d-md-flex">
                <button class="btn btn-danger rounded-0" id="basic-addon" style="min-width: 100px"><i
                            class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
</div>