
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 summoner-content-wrapper">
            <!--Page-Container-->
            @include('flash::message')
            @include('template.partials.errors')
            <section>
                @yield('content')
            </section>
            <!--End Page Container-->
        </div>
      </div>
    </div>
