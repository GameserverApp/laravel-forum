<div class="list-group-item {{ $thread->pinned ? 'pinned' : '' }} {{ $thread->locked ? 'locked' : '' }} {{ $thread->trashed() ? 'deleted' : '' }}" :class="{ 'border-primary': selectedThreads.includes({{ $thread->id }}) }">
    <div class="row align-items-center text-center">
        <div class="col-sm text-md-left">
            <span class="lead">
                <a href="{{ Forum::route('thread.show', $thread) }}" @if (isset($category))style="color: {{ $category->color }};"@endif>{{ $thread->title }}</a>
            </span>
            <br>
            {{ $thread->authorName }} <span class="text-muted">@include ('forum::partials.timestamp', ['carbon' => $thread->created_at])</span>

            @if (! isset($category))
                <br>
                <a href="{{ Forum::route('category.show', $thread->category) }}" style="color: {{ $thread->category->color }};">{{ $thread->category->title }}</a>
            @endif
        </div>
        <div class="col-sm text-md-right">
            @if ($thread->pinned)
                <span class="badge badge-pill badge-info">{{ trans('forum::threads.pinned') }}</span>
            @endif
            @if ($thread->locked)
                <span class="badge badge-pill badge-warning">{{ trans('forum::threads.locked') }}</span>
            @endif
            @if ($thread->userReadStatus != null && ! $thread->trashed())
                <span class="badge badge-pill badge-success">{{ trans($thread->userReadStatus) }}</span>
            @endif
            @if ($thread->trashed())
                <span class="badge badge-pill badge-danger">{{ trans('forum::general.deleted') }}</span>
            @endif
            <span class="badge badge-pill badge-primary" @if (isset($category))style="background: {{ $category->color }};"@endif>
                {{ trans('forum::general.replies') }}: 
                {{ $thread->reply_count }}
            </span>
        </div>
        <div class="col-sm text-md-right text-muted">
            <a href="{{ Forum::route('thread.show', $thread->lastPost) }}">{{ trans('forum::posts.view') }} &raquo;</a>
            <br>
            {{ $thread->lastPost->authorName }}
            <span class="text-muted">@include ('forum::partials.timestamp', ['carbon' => $thread->lastPost->created_at])</span>
        </div>

        @if (isset($category))
            @can ('manageThreads', $category)
                <div class="col-sm" style="flex: 0;">
                    <input type="checkbox" name="threads[]" :value="{{ $thread->id }}" v-model="selectedThreads">
                </div>
            @endcan
        @endif
    </div>
</div>