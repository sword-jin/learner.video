@inject('parsedown', 'Parsedown')

@if ($obj->description)
    <div class="description">
        {!! $parsedown->text($obj->description) !!}
    </div>
@endif
