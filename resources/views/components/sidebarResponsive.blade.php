<div id="menu-respon">
    <a href="{{route('home')}}" title="" class="logo">SWEE LEE</a>
    <div id="menu-respon-wp">
        <ul class="" id="main-menu-respon">
            @foreach($category_limit as $categoryParent)
                <li>
                    <a href="{{route('product.show',$categoryParent->id)}}" title="">{{$categoryParent->name}}</a>
                    @include('components.categoryChild',['categoryParent' => $categoryParent])
                </li>
            @endforeach
        </ul>
    </div>
</div>
