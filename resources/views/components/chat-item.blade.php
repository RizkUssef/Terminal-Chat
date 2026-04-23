<a href="#">
{{-- <a href="{{ route('chat', ['id' => $userId]) }}"> --}}
    <tr class="text-gold-dim hover:bg-gold transition-all duration-400 cursor-pointer hover:text-black">
        <td>{{ $userName }}</td>
        <td>{{ $userId }}</td>
        <td class="{{ $userStatus === 'online' ? 'text-sage' : 'text-error' }}">{{ $userStatus }}</td>
    </tr>
</a>
