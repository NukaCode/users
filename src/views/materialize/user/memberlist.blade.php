<div class="row">
    <div class="col offset-s2 s8">
        <ul class="collection">
            @foreach ($users as $user)
                <li class="collection-item avatar">
                    <img src="{{ $user->present()->gravatar }}" alt="" class="circle">
                    <span class="title">{{ HTML::link('user/view/'. $user->id, $user->username) }}</span>
                    <p>
                        {{ $user->present()->emailLink }}
                        <br />
                        Last Active: {{ $user->present()->lastActiveReadable }}
                    </p>
                    <a href="#!" class="secondary-content">{{ $user->present()->onlineMaterialize }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>