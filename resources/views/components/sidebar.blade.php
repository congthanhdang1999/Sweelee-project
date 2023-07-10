<div class="section" id="category-product-wp">
    <div class="section-head">
        <h3 class="section-title">Danh mục sản phẩm</h3>
    </div>
    <div class="secion-detail">

        <ul class="list-item">
            @foreach($category_limit as $categoryParent)
            <li>
                <a href="{{route('product.show',$categoryParent->id)}}" title="">{{$categoryParent->name}}</a>
                    @include('components.categoryChild',['categoryParent' => $categoryParent])
            </li>
            @endforeach
        </ul>

    </div>
</div>