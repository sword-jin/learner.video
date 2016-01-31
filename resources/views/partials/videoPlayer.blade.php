@inject('player', 'Learner\Services\Layouts\Videos\Video')

<div class="video-wrapper">
    {!! $player->setType($video->resource_type)
              ->getIFrame($video->resource_id) !!}
</div>
