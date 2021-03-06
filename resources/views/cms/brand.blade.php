@extends('cms.banner')

@section('content')
<div class="page_title">
    <h2 class="fl">品牌商信息列表</h2>
    <form action="/cms/brandList" id="baseInfoForm" method="post">
        <?php echo csrf_field(); ?>
        <input class="fr top_rt_btn" style="float:right; margin-top: 8px;" id="saveSubmit" name="commit" type="submit" value="查找"/>
        <input type="text" name="name" class="textboxsearch"
               @if ($name != 'all')
               value="{{ $name }}"
               @endif
               placeholder="按姓名查找"/>
        <select class="select" name="category" style="float:right; margin-top: 8px; margin-right: 8px;">
            @if ($category != 'all')
            <option value="{{ $category }}">{{ $category }}</option>
            @endif
            <option value="">选择类目</option>
            <option value="女装">女装</option>
            <option value="男装">男装</option>
            <option value="内衣">内衣</option>
            <option value="鞋靴">鞋靴</option>
            <option value="帽子">帽子</option>
            <option value="食品">食品</option>
            <option value="数码家电">数码家电</option>
            <option value="家居家纺">家居家纺</option>
            <option value="家具建材">家具建材</option>
            <option value="珠宝饰品">珠宝饰品</option>
            <option value="户外运动">户外运动</option>
            <option value="母婴">母婴</option>
            <option value="美妆">美妆</option>
            <option value="箱包">箱包</option>
            <option value="汽车">汽车</option>
            <option value="百货">百货</option>
            <option value="情趣用品">情趣用品</option>
            <option value="其他">其他</option>
        </select>
    </form>
</div>
<div style="margin-left: 100px; margin-top: 20px;width: 1000px;">
    <div style="margin-bottom: 20px;">
        <p>总{{ $total }}条，合作商户{{ $cooperation }}条</p>
    </div>
    @foreach ($brands as $item)
        <div style="position: relative;float: left;margin-right: 20px; margin-bottom: 20px;">
            <div style="display: table; margin-bottom: 20px;">
                <a href="{{URL::action('CMSController@brand_info', ['id' => $item->brand_id]) }}">
                    @if (count($item->pictures) > 0)
                        <img src="{{$item->pictures[0]->url}}" width="200px" height="200px">
                    @else
                        <img src="http://image.weipai.cn/honglema/default.gif"  width="200px" height="200px">
                    @endif
                </a>
            </div>
            <div style="text-align: center;">
                <span>{{$item->company }}</span>
            </div>
        </div>
    @endforeach

</div>
<aside class="paging" style="clear:both;">
    <a href="{{ url('/cms/brand_export') }}" style="float: left;" >导出Excel</a>
    <a href="/cms/brand_create" style="float: left;margin-left: 10px;" >添加品牌商</a>

    <a class="{{ ($brands->currentPage() == 1) ? ' disabled' : '' }}" href="{{ $brands->url(1) }}">首页</a>

    @if ($brands->currentPage() == 1)
    <a class="" href="#">前一页</a>
    @else
    <a class="" href="{{ $brands->url($brands->currentPage() - 1) }}">前一页</a>
    @endif

    @if ($brands->lastPage() <= 9)
    @for ($i = 1; $i <= $brands->lastPage(); $i++)
    <a class="{{ ($brands->currentPage() == $i) ? ' active' : '' }}" href="{{ $brands->url($i) }}">{{ $i }}</a>
    @endfor
    @elseif ($brands->currentPage() > 4 && $brands->currentPage() < $brands->lastPage() - 4)
    @for ($i = $brands->currentPage() - 4; $i <= $brands->currentPage() + 4; $i++)
    <a class="{{ ($brands->currentPage() == $i) ? ' active' : '' }}" href="{{ $brands->url($i) }}">{{ $i }}</a>
    @endfor
    @elseif ($brands->currentPage() > 4)
    @for ($i = $brands->lastPage() - 8; $i <= $brands->lastPage(); $i++)
    <a class="{{ ($brands->currentPage() == $i) ? ' active' : '' }}" href="{{ $brands->url($i) }}">{{ $i }}</a>
    @endfor
    @else
    @for ($i = 1; $i <= 9; $i++)
    <a class="{{ ($brands->currentPage() == $i) ? ' active' : '' }}" href="{{ $brands->url($i) }}">{{ $i }}</a>
    @endfor
    @endif

    @if ($brands->currentPage() == $brands->lastPage())
    <a class="{{ ($brands->currentPage() == $brands->lastPage()) ? ' disabled' : '' }}" href="#" >后一页</a>
    @else
    <a class="{{ ($brands->currentPage() == $brands->lastPage()) ? ' disabled' : '' }}" href="{{ $brands->url($brands->currentPage()+1) }}" >后一页</a>
    @endif

    <a class="{{ ($brands->currentPage() == $brands->lastPage()) ? ' disabled' : '' }}" href="{{ $brands->url($brands->lastPage()) }}" >尾页</a>
</aside>
@endsection