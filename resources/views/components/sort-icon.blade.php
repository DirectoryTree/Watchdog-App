@if($current == $field)
    @if($direction == 'desc')
        <i class="fas fa-sort-up"></i>
    @else
        <i class="fas fa-sort-down"></i>
    @endif
@else
    <i class="fas fa-sort"></i>
@endif
