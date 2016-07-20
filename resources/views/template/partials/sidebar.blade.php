
    <div class="container-fluid">
        <div class="row row-eq-height">
            <div class="col-md-3 col-lg-2 viewport-height sidebar">
                <div class="row">
                    <div class="col-md-12">
                        <!-- SIDEBAR USERPIC -->
                        <img class="center-block" src="{{ $iconURL }}">
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="text-center summoner-name">
                        {{ $summoner[0]->playerName }}
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR BUTTONS -->
                        <div class="summoner-button-wrapper text-center">
                            <span class="summoner-button">
                                <a href="#" class="glyphicon glyphicon-heart"></a>
                                {{ $summoner[0]->likes }}
                            </span>
                            <span class="summoner-button">
                                <span class="glyphicon glyphicon-comment"></span>
                                {{ $summoner[0]->comments }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-4 col-md-12 summoner-data">
                        <h6>Region</h6>
                        <p>{{ $summoner[0]->region }}</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-12 summoner-data">
                        <h6>Popularity</h6>
                        <p>{{ $summoner[0]->playerId }}</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-12 summoner-data">
                        <h6>Current League</h6>
                        <p>{{ $summoner[0]->tier }} {{ $summoner[0]->division }}</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-12 summoner-data">
                        <h6>League Points</h6>
                        <p>{{ $summoner[0]->leaguePoints }}</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-12 summoner-data">
                        <h6>Max League</h6>
                        <p>{{ $summoner[0]->maxTier }} {{ $summoner[0]->maxDivision }}</p>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-12 summoner-data">
                        <h6>Win / Loss</h6>
                        <p>{{ $summoner[0]->wins }} / {{ $summoner[0]->losses }}</p>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <!-- END MENU -->
                </div>
            </div>
            <div class="col-md-9 col-lg-10 summoner-content-wrapper">
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
