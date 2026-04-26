{{-- <a href="{{ route('conv', ['conversation' => $conversationKey]) }}"> --}}
{{-- The issue is that <a> wrapping a <tr> is invalid HTML — browsers strip the <a> tag because it's not a valid child of <tbody>. The <tr> renders but the link is gone. --}}
<tr onclick="window.location='{{ route('conv', ['conversation' => $conversationKey]) }}'"
    class="text-gold-dim hover:bg-gold transition-all duration-400 cursor-pointer hover:text-black">
    <td>{{ $userName }}</td>
    <td>#{{ substr($userId, 0, 8) }}</td>
    <td class="{{ $userStatus ? 'text-sage' : 'text-error' }}">
        {{ $userStatus ? 'Online' : 'Offline' }}
    </td>
</tr>
{{-- </a> --}}
