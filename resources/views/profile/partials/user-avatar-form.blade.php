<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            User Avatar
        </h2>
        {{-- @php
        dd($user->avatar)
        @endphp --}}

        <img src={{ "storage/$user->avatar" }} alt="user-avatar" class="rounded-full" width="50" height="50">
        <form method="post" action={{ route('profile.avatar.ai') }} class="mt-4">
            @csrf
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Generate Avatar From AI
            </p>
            <x-primary-button>Generate Avatar </x-primary-button>
        </form>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            OR
        </p>

    </header>

    @if(session('message'))
    <div>
        {{ session('message')}}
    </div>
    @endif

    <form method="post" action={{route('profile.avatar')}} enctype="multipart/form-data">
        {{-- method spoofing --}}

        {{-- @method('patch') actually this is a helper to make the same line below this one, but with more flexibility,
        and if you try to inspect in the browser, it will show you the same line in both ways, which is the line
        below--}}
        {{-- @csrf this is the alternative of the second line below--}}
        <input type="hidden" name="_method" value="patch">
        <input type="hidden" name="_token" value={{ csrf_token()}}>

        {{-- @csrf --}}
        {{-- @method('patch') --}}
        {{-- remove required attr from the file input --}}
        <div>
            <x-input-label for="name" :value="__('Upload Avatar From Computer')" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full"
                :value="old('avatar', $user->name)" autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

</section>