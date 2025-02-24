@props(['name' => 'skills_input', 'user' => null])
<x-form.form-feild>
    <x-form.form-label>Skills</x-form.form-label>
    <div class="mt-2 space-y-2" id="skills-container">
        @php
        $skillsArray = old($name, []);

        if (empty($skillsArray) && $user && !empty($user->skills_input)) {
        $skillsArray = explode(',', $user->skills_input);
        }
        @endphp

        @if(count($skillsArray) > 0)
        @foreach($skillsArray as $index => $skill)
        <div class="skill-input-group flex gap-2">
            <x-form.form-input
                type="text"
                name="{{ $name }}[]"
                placeholder="Enter a skill (e.g., PHP)"
                value="{{ trim($skill) }}" />
            @if($index > 0)
            <button type="button" class="remove-skill-btn text-red-500">×</button>
            @endif
        </div>
        @endforeach
        @else
        <div class="skill-input-group flex gap-2">
            <x-form.form-input
                type="text"
                name="{{ $name }}[]"
                placeholder="Enter a skill (e.g., PHP)" />
        </div>
        @endif
    </div>
    <button type="button" id="add-skill-btn" class="mt-3 text-blue-500 hover:text-blue-700 text-sm">
        + Add Skill
    </button>
    <x-form.form-error name="{{ $name }}.*" />
</x-form.form-feild>
<script>
    document.getElementById('add-skill-btn').addEventListener('click', function() {
        const container = document.getElementById('skills-container');
        const newInputGroup = document.createElement('div');
        newInputGroup.className = 'skill-input-group flex gap-2 mt-2';

        const inputField = document.createElement('input');
        inputField.type = 'text';
        inputField.name = '{{ $name }}[]';
        inputField.placeholder = 'Enter a skill (e.g., PHP)';
        inputField.className = 'block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6';

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'remove-skill-btn text-red-500';
        removeBtn.textContent = '×';

        newInputGroup.appendChild(inputField);
        newInputGroup.appendChild(removeBtn);
        container.appendChild(newInputGroup);
    });

    document.getElementById('skills-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-skill-btn')) {
            e.target.closest('.skill-input-group').remove();
        }
    });
</script>