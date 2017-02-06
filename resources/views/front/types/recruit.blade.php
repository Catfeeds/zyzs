<div class="line-big padding-big-top clearfix inside-recruit">
@foreach($recruits as $job)
    <div class="xm4 xb4 xl12 xs12">
        <div class="inside-recruit-item">
            <div class="inside-recruit-title">
                职位名：{{$job->jobname}}
            </div>
            <div class="inside-recruit-footer">
                <span class="icon-user"> 招聘人数：@if($job->jobcount == 0) 若干 @else {{$job->jobcount}} 名 @endif</span>　<span class="icon-map-marker"> 工作地点：{{$job->jobplace}}</span>
            </div>

            <div class="inside-recruit-view">
                <a href="/recruit-view-{{$job->id}}.html" title="" class="button bg-main">了解更多 <span class="icon-angle-double-right"></span></a>
            </div>
        </div>
    </div>
@endforeach
   

</div>