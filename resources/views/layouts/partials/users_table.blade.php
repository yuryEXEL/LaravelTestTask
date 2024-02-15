@foreach ($users as $user)
    <tr class="user-row" data-id="{{ $user->id }}">
        <td>{{ $user->id }}</td>
        <td id="username_{{ $user->id }}" data-value="{{ $user->username }}">{{ $user->username }}
            @if(!empty($userStatus))
                @foreach ($userStatus as $id => $status)
                    @if($id == $user->id)
                        - {{ $status}}
                    @endif
                @endforeach
            @endif
        </td>
    </tr>
@endforeach
