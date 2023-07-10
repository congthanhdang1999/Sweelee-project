@if($categoryParent->catProductChild->count())
<ul class="sub-menu">
    @foreach($categoryParent->catProductChild as $categoryChild)
    <li>
        <a href="{{route('product.show',$categoryChild->id)}}" title="">{{$categoryChild->name}}</a>
    </li>
    @endforeach
</ul>
@endif