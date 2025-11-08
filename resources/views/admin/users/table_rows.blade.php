@forelse($users as $user)
    <tr>
        <td>
            <div class="user-info">
                <img src="{{ asset($user->profile_picture ?? 'assets/images/no-image.png') }}" class="user-avatar" alt="">
                <div>
                    <strong>{{ $user->first_name }} {{ $user->last_name }}</strong><br>
                    <small class="text-muted">{{ $user->city ?? '—' }}, {{ $user->country ?? '' }}</small>
                </div>
            </div>
        </td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone ?? '—' }}</td>
        <td>
            <span class="role-badge role-admin">
                @if ($user->is_admin === 'yes') Admin @else Normal User @endif
            </span>
        </td>
        <td>{{ $user->orders()->count() }}</td>
        <td>
            <div class="rating-stars" title="Platform rating: {{ $user->platform_rating }}">
                @for($i = 1; $i <= 5; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                        fill="{{ $i <= $user->platform_rating ? '#ffb400' : '#ddd' }}" viewBox="0 0 16 16">
                        <path
                            d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.39 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.118l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73z" />
                    </svg>
                @endfor
            </div>
        </td>
        <td>{{ $user->created_at->format('d M Y') }}</td>
        <td class="text-center">
            <div class="action-buttons">
                <a href="{{ route('admin.users.show', $user->id) }}" class="btn-action view" title="View User">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-action edit" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <button type="button" class="btn-action delete"
                    onclick="confirmDeleteUser({{ $user->id }}, '{{ $user->first_name }}')" title="Delete">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center text-muted py-4"><i>No users found.</i></td>
    </tr>
@endforelse