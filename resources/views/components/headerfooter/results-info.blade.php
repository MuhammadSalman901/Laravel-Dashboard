@props(['resultInfo'])

@if($resultInfo['total'] > 0)
<div class="mt-5 text-sm text-gray-600">
    @if($resultInfo['searchTerm'])
    Found {{ $resultInfo['total'] }} results for
    <span class="font-semibold">"{{ $resultInfo['searchTerm'] }}"</span>
    @endif

    <div class="mt-1">
        Showing {{ $resultInfo['end'] }} of
        {{ $resultInfo['total'] }} results
    </div>
</div>
@endif