<?php if($navigation->layout=="3"){
        $xwidth = "3";
    } else {
        $xwidth = "4";
    }?>

<div class="line-big padding-big-top clearfix inside-album">
@foreach($albums as $album)
    <div class="xm{{$xwidth}} xb{{$xwidth}} xl6 xs6">
        <a href="/album-view-{{$album->id}}.html" title="{{$album->name}}"><div class="inside-album-item">
            <div class="inside-album-cover" style="background-image:url('{{$album->cover}}')"></div>
            <div class="inside-album-title"><div><h4>{{$album->name}}</h4><p class="clearfix"><span class="icon-file-image-o"> {{$album->getpics->count()}}</span><span class="icon-eye album-right"> {{$album->getviews->weihao}}</span></p></div></div>
        </div>
        </a>
    </div>
@endforeach
    <div class="x12 text-center">
        {!!$albums->links()!!}
    </div>
</div>