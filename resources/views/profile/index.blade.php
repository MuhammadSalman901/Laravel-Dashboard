<x-layout>
    <x-headerfooter.section-heading class="mt-[15vh]">Profile</x-headerfooter.section-heading>
    <div class="mt-10 flex items-center p-4 rounded-xl border border-black bg-black/10 hover:border-blue-800 transition-colors duration-300 group">
        <div class="h-64 flex gap-x-[5vw]">
            <div class="h-[300px] w-[300px]">
                <img class="rounded-full h-full w-full" src="{{ asset('storage/' . Auth::user()['image_path']) }}" alt="">
            </div>
            <div class="border-r border-black/25 h-full"></div>
        </div>
        <div class="px-10">
            <div class="py-3">
                <h1 class="group-hover:text-blue-800 transition-colors duration-300">
                    {{ Auth::user()->name }}
                </h1>
            </div>
            <div class="py-3">
                <h3 class="text-lg font-bold">
                    Occupation:
                </h3>
                <p class="text-sm">
                    {{ Auth::user()->title }}
                </p>
            </div>
            <div class="py-6 flex gap-x-32">
                <div>
                    <h3 class="text-lg font-bold">Skills:</h3>
                    @php
                    $displayUser = isset($user) ? $user : Auth::user();
                    $skills = !empty($displayUser->skills_input)
                    ? explode(',', $displayUser->skills_input)
                    : [];
                    @endphp
                    @if(count($skills) > 0)
                    @foreach ($skills as $skill)
                    <x-tag.tag>
                        {{ trim($skill) }}
                    </x-tag.tag>
                    @if(!$loop->last) @endif
                    @endforeach
                    @else
                    <p>No skills listed.</p>
                    @endif
                </div>
                <div>
                    <h3 class="text-lg font-bold">
                        Experience:
                    </h3>
                    <p class="text-sm">
                        {{ Auth::user()->experience }} years
                    </p>
                </div>

            </div>
            <div class="py-3">
                <h3 class="text-lg font-bold">
                    Bio:
                </h3>
                <p class="text-sm">
                    {{ Auth::user()->bio }}
                </p>
            </div>
        </div>
    </div>
</x-layout>