@if(count($children) > 0)
    <div class="list-group mt-2" id="object-{{ $object->id }}">
        @foreach($children as $child)
            <x-watcher-object :object="$child" :watcher="$watcher"></x-watcher-object>
        @endforeach
    </div>
@endif
