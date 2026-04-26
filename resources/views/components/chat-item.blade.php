<a href="#">
    {{-- <a href="{{ route('chat', ['conversation_key' => $conversationKey]) }}"> --}}
    {{-- <a href="{{ route('chat', ['id' => $userId]) }}"> --}}
    <tr class="text-gold-dim hover:bg-gold transition-all duration-400 cursor-pointer hover:text-black">
        <td>{{ $userName }}</td>
        <td>#{{ substr($userId, 0, 8) }}</td>
        <td class="{{ $userStatus === 1 ? 'text-sage' : 'text-error' }}">{{ $userStatus === 1 ? 'Online' : 'Offline' }}</td>
    </tr>
</a>
