@extends('layouts.master')

@section('title')
@parent
:: Home
@stop

@section('content')


<div class="row">

  <div class="col-md-8" id="logo-bloc">
    <!--div id="logo-circle"><img src="../css/images/logo-animate.gif" alt="logo pandasub" /></div-->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="../css/images/slide/slide1.png" alt="...">
          <div class="carousel-caption">
            Bienvenu sur Panda sub
          </div>
        </div>
        <div class="item">
          <img src="../css/images/slide/slide2.png" alt="...">
          <div class="carousel-caption">
            Dernière sortie de 
          </div>
        </div>
        <div class="item">
          <img src="../css/images/slide/slide3.png" alt="...">
          <div class="carousel-caption">
            Nouveau film de 
          </div>
        </div>
        ...
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev" id="arrow-top">
        <span class="fa fa-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next" id="arrow-top">
        <span class="fa fa-chevron-right"></span>
      </a>
    </div>
  </div>
  <div id="txt-actu">en ce moment</div>
  <div class="col-md-2 text-center" id="btn-serie"><div id="txt-serie">séries</div><img src="../css/images/en ce moment/serie.png"></img></div>
  <div class="col-md-2 text-center" id="btn-anim"><div id="txt-serie">animes</div><img src="../css/images/en ce moment/anime.png"></img></div>
  <div class="col-md-2 text-center" id="btn-film"><div id="txt-serie">films</div><img src="../css/images/en ce moment/film.png"></img></div>
  <div class="col-md-2 text-center" id="btn-manga"><div id="txt-serie">manga</div><img src="../css/images/en ce moment/manga.png"></img></div>
</div>
<div class="row">
  <div class="col-md-2" id="team-1"><span class="txt-team">team 1</span><img id="rotate-1" src="../css/images/logo-team/dead.png"></img></div>
  <div class="col-md-2" id="team-2"><span class="txt-team">team 1</span><img id="rotate-2" src="../css/images/logo-team/bird.png"></img></div>
  <div class="col-md-4" id="team-gold">.col-md-4</div>
  <div class="col-md-2" id="team-1"><span class="txt-team">team 1</span><img id="rotate-3" src="../css/images/logo-team/bear.png"></img></div>
  <div class="col-md-2" id="team-2"><span class="txt-team">team 1</span><img id="rotate-4" src="../css/images/logo-team/eye.png"></img></div>
</div>
<div class="row">
  <div class="col-md-2" id="team-2"><span class="txt-team">team 1</span><img id="rotate-5" src="../css/images/logo-team/fox.png"></img></div>
  <div class="col-md-2" id="team-1"><span class="txt-team">team 1</span><img id="rotate-6" src="../css/images/logo-team/nowhere.png"></img></div>
  <div class="col-md-2" id="team-2"><span class="txt-team">team 1</span><img id="rotate-7" src="../css/images/logo-team/rocket.png"></img></div>
  <div class="col-md-2" id="team-1"><span class="txt-team">team 1</span><img id="rotate-8" src="../css/images/logo-team/shift.png"></img></div>
  <div class="col-md-2" id="team-2"><span class="txt-team">team 1</span><img id="rotate-9" src="../css/images/logo-team/yoda.png"></img></div>
  <div class="col-md-2" id="team-1"><span class="txt-team">team 1</span><img id="rotate-10" src="../css/images/logo-team/zebre.png"></img></div>
</div>
<div class="row">
  <div class="col-md-7" id="last-release">.col-md-7</div>
  <div class="col-md-1" id="filter-film">.col-md-2</div>
  <div class="col-md-1" id="filter-serie">.col-md-2</div>
  <div class="col-md-1" id="filter-anim">.col-md-2</div>
  <div class="col-md-1" id="filter-manga">.col-md-2</div>
  <div class="col-md-1" id="filter-more"><i class="fa fa-cog fa-spin fa-2x"></i><span class="caret"></span></div>
</div>
<div class="row">


</div>
<div class="row">
  <div class="col-md-12" id="footer">
 En ligne: 
    @foreach ($registered as $online)

    {{ $online->user->username }}

    @endforeach
  </div>
</div>


@stop