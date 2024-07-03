<!DOCTYPE html>
<html lang="fr" class=" bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/alpine.min.js'])
</head>

<body class="antialiased ">
    <div class="flex items-center  flex-col  py-12 sm:px-6 lg:px-8">
        <div class="">
            <a href="{{ route('index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-12 h-12 text-slate-900">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                </svg>
            </a>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class=" px-6 py-4 shadow sm:rounded-lg sm:px-12">
                <form action="" method="POST" novalidate>
                    @csrf
                    <div class="space-y-6" x-data="{ agreed: false }">
                        <x-input name="name" label="Fullname" type="text" />
                        <x-input name="login" label="Login" type="text" />
                        <x-input name="email" label="E-mail" type="email" />
                        <x-input name="password" label="Password" type="password" />
                        <x-input name="password_confirmation" label="Confirm Password" type="password" />
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input @click="agreed = !agreed" id="agree" name="agree" type="checkbox"
                                    class="form-checkbox h-4 w-4 rounded border-gray-300 text-indigo-500 focus:ring-indigo-400">
                                <label for="agree" class="ml-3 block text-sm leading-6 text-indigo-700">Agree
                                    terms</label>
                            </div>
                        </div>
                        <div>
                            <button type="submit" :disabled="!agreed"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:bg-indigo-400">Sign
                                up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
