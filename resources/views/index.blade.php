@extends('parent')

@section('title', 'Home')

@section('content')
    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active" {{ $image = Storage::url($lastThreeNews[0]->image) }}
                    style="background-image: url({{ $image }})">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{ $lastThreeNews[0]->title }}</h3>
                        <p>{{ $lastThreeNews[0]->short_info }}</p>
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item" {{ $image2 = Storage::url($lastThreeNews[1]->image) }}
                    style="background-image: url({{ $image2 }})">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{ $lastThreeNews[1]->title }}</h3>
                        <p>{{ $lastThreeNews[1]->short_info }}</p>
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item" {{ $image3 = Storage::url($lastThreeNews[2]->image) }}
                    style="background-image: url({{ $image3 }})">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{ $lastThreeNews[2]->title }}</h3>
                        <p>{{ $lastThreeNews[2]->short_info }}</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </header>

    <!-- Page Content -->

    <section>
        <div class="container">

            <h3 class="my-4">last news</h3>

            <!-- Marketing Icons Section -->
            <div class="row">
                @foreach ($lastThreeNews as $new)
                    <div class="col-lg-4 mb-4">
                        <div class="card h-100">
                            <h4 class="card-header">{{ $new->title }}</h4>
                            <div class="card-body">
                                <p class="card-text">{{ $new->short_info }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('articles', $new->slug) }}" class="btn btn-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.row -->
        </div>
    </section>
    <section class="gray-sec">
        <div class="container">
            <!-- category Section -->
            <h3 class="my-4">local news</h3>

            <div class="row">
                @foreach ($lastThreeLocalNews as $lastThreeLocalNew)
                    <div class="col-lg-4 col-sm-6 portfolio-item">
                        <div class="card h-100">
                            <a href="{{ route('articles', $lastThreeLocalNew->slug) }}"><img class="card-img-top"
                                    src="{{ Storage::url($lastThreeLocalNew->image) }}" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a
                                        href="{{ route('articles', $lastThreeLocalNew->slug) }}">{{ $lastThreeLocalNew->title }}</a>
                                </h4>
                                <p class="card-text">{{ $lastThreeLocalNew->short_info }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('articles', $lastThreeLocalNew->slug) }}" class="btn btn-primary">Learn
                                    More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div align="center"><a class="btn btn-success" href="{{ route('categories', $categories[0]->slug) }}">more
                    news</a></div>
        </div>
    </section>
    <section>
        <div class="container">

            <h3 class="my-4">sports news</h3>
            <div class="row">

                @foreach ($lastThreeSportNews as $lastThreeSportNew)
                    <div class="col-lg-3  portfolio-item">
                        <div class="card h-100">
                            <a href="{{ route('articles', $lastThreeSportNew->slug) }}"><img class="card-img-top"
                                    src="{{ Storage::url($lastThreeSportNew->image) }}" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a
                                        href="{{ route('articles', $lastThreeSportNew->slug) }}">{{ $lastThreeSportNew->title }}</a>
                                </h4>
                                <p class="card-text">{{ $lastThreeSportNew->short_info }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('articles', $lastThreeSportNew->slug) }}" class="btn btn-primary">Learn
                                    More</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <!-- /.row -->
            <div align="center"><a class="btn btn-success" href="{{ route('categories', $categories[1]->slug) }}">more
                    news</a></div>
            <br>
            <br>
        </div>
    </section>
    <section class="gray-sec">
        <div class="container">
            <!-- category Section -->
            <h3 class="my-4">International news</h3>
            <div class="row">
                @foreach ($lastThreeInternationalNews as $lastThreeInternationalNew)
                    <div class="col-lg-4 col-sm-6 portfolio-item">
                        <div class="card h-100">
                            <a href="{{ route('articles', $lastThreeInternationalNew->slug) }}"><img class="card-img-top"
                                    src="{{ Storage::url($lastThreeInternationalNew->image) }}" alt=""></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a
                                        href="{{ route('articles', $lastThreeInternationalNew->slug) }}">{{ $lastThreeInternationalNew->title }}</a>
                                </h4>
                                <p class="card-text">{{ $lastThreeInternationalNew->short_info }}</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('articles', $lastThreeInternationalNew->slug) }}"
                                    class="btn btn-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div align="center"><a class="btn btn-success" href="{{ route('categories', $categories[2]->slug) }}">more
                    news</a></div>
        </div>
    </section>
    <section>
        <div class="container">
            <!--  Section -->
            <div class="row">
                <div class="col-lg-6">
                    <h3>main news title</h3>
                    <p>The Modern Business template by Start Bootstrap includes:</p>
                    <ul>
                        <li>
                            <strong>Bootstrap v4</strong>
                        </li>
                        <li>jQuery</li>
                        <li>Font Awesome</li>
                        <li>Working contact form with validation</li>
                        <li>Unstyled page elements for easy customization</li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id
                        reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis
                        quia
                        dolorum ducimus unde.</p>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid rounded full-width" src="{{ asset('assets/img/6.jpeg') }}" alt="">
                </div>
            </div>
            <!-- /.row -->

            <hr>

            <!-- Call to Action Section -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias, expedita, saepe, vero rerum
                        deleniti
                        beatae veniam harum neque nemo praesentium cum alias asperiores commodi.</p>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-lg btn-secondary btn-block" href="{{ route('contact') }}">contact us</a>
                </div>
            </div>
        </div>
        <!-- /.container -->

    </section>
@endsection
