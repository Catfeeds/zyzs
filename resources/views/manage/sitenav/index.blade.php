@extends('manage.site')

@section('main')
<form method="POST" action="/manage/sitenav">
<div class="container bg-white margin-large-top">
    <div class="padding-large">
        <div class="line-big margin-large-bottom">
            <div class="x6">
                <ul class="bread">
                    <li><a href="/manage/main" class="icon-home"> 管理后台</a> </li>
                    <li>导航管理</li>
                </ul>
            </div>
            <div class="x6 text-right">
                <a href="/manage/sitenav/insert" class="button icon-file-o bg-yellow margin-right"> 新增导航</a>
                <a href="/manage/sitenav/deleted" class="button bg-blue icon-trash-o margin-right" title=""> 回收站</a>
                @if($navigations->count()<=0)
                @else
                <button class="button bg-green icon-save" type="submit"> 保存修改</button>
                @endif
                
            </div>
        </div>

        @if($navigations->count()<= 0)
        <div class="x12 text-center padding-large"><span class="icon-info"> </span>没有导航数据，请点击右上角“新增导航”开始制作。</div>
        @else

        @foreach($navigations as $key => $navigation)
        <div class="x12 padding-large-bottom margin-large-bottom">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr><td align="center" width="60">序号</td><td align="center" width="200">导航标题</td><td align="center">导航类型</td><td align="center" width="90">排序</td><td align="center" width="130">侧边栏位置</td><td width="130">侧边栏</td><td align="center" width="100">是否显示</td><td align="center" width="100">内容管理</td><td align="center" width="80">删除</td><td align="center" width="80">修改</td></tr>

                <tr class="bg-yellow-light"><td align="center"><strong>{{ $key+1 }}</strong><input type="hidden" name="id[]" value="{{ $navigation->id }}"></td>
                <td>{{$navigation->name}}</td>
                
                <td align="center">
                @if(isset($types[$navigation->type])){{$types[$navigation->type]}}@else 未知类型 @endif
                </td>
                <td><input name="weihao[]" value = "{{ $navigation->weihao }}" class="input input-small"></td>
                <td align="center">
                    <input type="hidden" name="layout[]" value="{{ $navigation->layout }}">
                    <div class="button-group button-group-little border-blue radio viewradio">
                        <label class="button @if($navigation->layout==1) active @endif">
                            <input name="layouts[]" value="1" @if($navigation->layout==1) checked="checked" @endif type="radio"> 左侧
                        </label>
                        <label class="button @if($navigation->layout==3) active @endif">
                            <input name="layouts[]" value="3" @if($navigation->layout==3) checked="checked" @endif type="radio"> 隐藏
                        </label>
                        <label class="button @if($navigation->layout==2) active @endif">
                            <input name="layouts[]" value="2" @if($navigation->layout==2) checked="checked" @endif type="radio"> 右侧
                        </label>
                    </div>
                </td>
                <td>
                    <select name="sectionid[]" class="input input-small">
                        @foreach($sections as $section)
                        <option value="{{$section->id}}" @if($navigation->section->id ==$section->id )selected="selected" @endif>{{$section->title}}</option>
                        @endforeach
                    </select>
                </td>

                <td align="center">
                    <input type="hidden" name="showsnot[]" value="{{ $navigation->showsnot }}">
                    <div class="button-group button-group-little border-blue radio viewradio">
                        <label class="button @if($navigation->showsnot==1) active @endif">
                            <input name="showsnots[]" value="1" @if($navigation->showsnot==1) checked="checked" @endif type="radio"> 显示
                        </label>
                        <label class="button @if($navigation->showsnot==0) active @endif">
                            <input name="showsnots[]" value="0" @if($navigation->showsnot==0) checked="checked" @endif type="radio"> 隐藏
                        </label>
                    </div>
                </td>
                
                <td align="center">
                <?php switch ($navigation->type) {
                    case 'mainmenu':?>
                        <span class="icon-lock text-gray"> 无内容 </span>
                        
                    <?php break;
                    case 'menudetails':?>
                        <a href='/manage/sitenav/edit/{{ $navigation->id }}' ><span class='icon-edit'> 编辑</span></a>
                    <?php break;
                    case 'article':?>
                        <a href='/manage/sitenav/article/{{ $navigation->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 文章管理</span></a>
                    <?php break;
                    case 'recruit':?>
                        <a href='/manage/sitenav/jobs/{{ $navigation->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 招聘管理</span></a>
                    <?php break;
                    case 'product':?>
                        <a href='/manage/sitenav/products/{{ $navigation->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 产品管理</span></a>
                    <?php break;
                    case 'album':?>
                        <a href='/manage/albums/{{ $navigation->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 相册管理</span></a>
                    <?php break;
                    case 'team':?>
                        <a href='/manage/teams/{{ $navigation->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 团队管理</span></a>
                    <?php
                        break;
                    case 'case':?>
                        <a href='/manage/case/{{ $navigation->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 案例管理</span></a>
                    <?php
                        break;
                    case 'alonepage':?>
                        <a href='/manage/sitenav/{{$navigation->id}}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 编辑</span></a>
                    <?php
                        # code...
                        break;
                    default:
                    echo "未知，请联系管理员";
                    break;
                } ?>
                </td>
                <td align="center"><a onclick="{if(confirm('请谨慎操作：如果删除导航，那么导航中的子菜单、子菜单中包含的数据也将一并被删除，请确认：')){return true;}return false;}" href="/manage/sitenav/delete/{{ $navigation->id }}" class="button button-little bg-main"> <span class="icon-trash-o"> 删除</span></a></td>
                <td align="center"><a href="/manage/sitenav/edit/{{ $navigation->id }}" class="button button-little bg-yellow"> <span class="icon-edit"> 修改</span></a></td>
                </tr>
                
                @if(true)
                @if($navigation->children->count()>0 || $navigation->type !== "mainmenu")
                @foreach($navigation->children as $child)
                <tr><td><input type="hidden" name="id[]" value="{{ $child->id }}"></td><td><span class="text-gray">├</span> {{ $child->name }}</td>
                <td align="center">
                {{$types[$child->type]}}
                </td>
                <td><input name="weihao[]" value = "{{ $child->weihao }}" class="input input-small"></td>
                <td align="center">
                <input type="hidden" name="layout[]" value="{{ $child->layout }}">
                    <div class="button-group button-group-little border-blue radio viewradio">
                        <label class="button @if($child->layout==1) active @endif">
                            <input name="layouts[]" value="1" @if($child->layout==1) checked="checked" @endif type="radio"> 左侧
                        </label>
                        <label class="button @if($child->layout==3) active @endif">
                            <input name="layouts[]" value="3" @if($child->layout==3) checked="checked" @endif type="radio"> 隐藏
                        </label>
                        <label class="button @if($child->layout==2) active @endif">
                            <input name="layouts[]" value="2" @if($child->layout==2) checked="checked" @endif type="radio"> 右侧
                        </label>
                    </div>
                </td>
                <td>
                    <select name="sectionid[]" class="input input-small">
                        @foreach($sections as $section)
                        <option value="{{$section->id}}" @if($child->section->id==$section->id) selected="selected" @endif>{{$section->title}}</option>
                        @endforeach
                    </select>
                </td>
                <td align="center">
                	<input type="hidden" name="showsnot[]" value="{{ $child->showsnot }}">
                	<div class="button-group button-group-little border-blue radio viewradio">
                        <label class="button @if($child->showsnot==1) active @endif">
                            <input name="showsnots[]" value="1" @if($child->showsnot==1) checked="checked" @endif type="radio"> 显示
                        </label>
                        <label class="button @if($child->showsnot==0) active @endif">
                            <input name="showsnots[]" value="0" @if($child->showsnot==0) checked="checked" @endif type="radio"> 隐藏
                        </label>
                    </div>
                </td>
                <td align="center">
                <?php switch ($child->type) {
                    case 'mainmenu':?>
                        <span class="icon-lock text-gray"> 无内容 </span>
                        
                    <?php break;
                    case 'menudetails':?>
                        <a href='/manage/sitenav/edit/{{ $child->id }}' ><span class='icon-edit'> 编辑</span></a>
                    <?php break;
                    case 'article':?>
                        <a href='/manage/sitenav/article/{{ $child->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 文章管理</span></a>
                     <?php break;
                    case 'alonepage':?>
                        <a href='/manage/sitenav/edit/{{ $child->id }}' ><span class='icon-edit'> 编辑</span></a>
                    <?php break;
                    case 'recruit':?>
                        <a href='/manage/sitenav/jobs/{{ $child->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 招聘管理</span></a>
                    <?php break;
                    case 'product':?>
                        <a href='/manage/sitenav/products/{{ $child->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 产品管理</span></a>
                    <?php break;
                    case 'album':?>
                        <a href='/manage/albums/{{ $child->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 相册管理</span></a>
                    <?php break;
                    case 'team':?>
                        <a href='/manage/teams/{{ $child->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 团队管理</span></a>
                    <?php
                        break;
                        case 'alonepage':?>
                        <a href='/manage/sitenav/{{$navigation->id}}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 编辑</span></a>
                    <?php
                    break;
                    case 'case':
                        ?>
                        <a href='/manage/case/{{ $child->id }}' class='button button-little bg-green text-white'><span class='icon-sign-in'> 案例管理</span></a>
                        <?php
                        break;
                    default:
                    echo "未知，请联系管理员";
                    break;
                } ?>
                </td>
                <td align="center"><a onclick="{if(confirm('删除子菜单时，菜单中的所有数据也将一并被删除，请确认：')){return true;}return false;}" href="/manage/sitenav/delete/{{ $child->id }}" class="button button-little bg-main"> <span class="icon-trash-o"> 删除</span></a></td>
                <td align="center"><a href="/manage/sitenav/sub/edit/{{ $child->id }}" class="button button-little bg-yellow"> <span class="icon-edit"> 修改</span></a></td>
                </tr
                @endforeach
                @else
                <tr><td colspan="10" align="center"><span class="text-main icon-warning "> </span>本栏目为菜单形式，但未设置子菜单,可能无法访问</td></tr>
                @endif
                <tr><td colspan="10"><a href="/manage/sitenav/sub/insert/{{ $navigation->id }}" class="button bg-main">增加子菜单</a></td></tr>
                @endif
            </table>
        </div>
        </div>
        
        @endforeach

        <div class="x12 margin-large-bottom padding-large-bottom">
            <div class="x4 x2-move text-center"><button class="button bg-gray button-big win-refresh icon-refresh" type="button"> 重新载入</button></div>
            <div class="x4 text-center"><button class="button bg-green button-big icon-save" type="submit"> 保存修改</button></div>
        </div>
        @endif

    </div>
</div>

{!! csrf_field() !!}
</form>

@stop

@section('extrajs')
<script type="text/javascript">
$(function(){
    $(".viewradio label input").click(function(){
        tthis = $(this);
        thisval = $(this).val();
        tthis.closest("div").prev().val(thisval);
    })
})
</script>
@stop