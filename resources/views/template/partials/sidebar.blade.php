
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 summoner-content-wrapper">
            <!--Page-Container-->
            @include('flash::message')
            @include('template.partials.errors')
            <section>
                @yield('content')
            </section>
            <div class="sticky-footer">
                @include('template.partials.foot')
            </div>
            <!--End Page Container-->
        </div>
      </div>
    </div>
