@section('title-page', 'Форма обратной связи')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Форма обратной связи') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <div class="mt-4">
                <form method="POST" action="{{ route('statement.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- User name --}}
                    <div>
                        <x-label for="user-name" :value="__('Ваше имя')" />
                        <x-input id="user-name" class="block mt-1 w-full"
                                 type="text"
                                 name="user-name"
                                 value="{{ Auth::user()->name }}"
                                 required
                        />
                    </div>

                    {{-- User phone --}}
                    <div class="mt-4">
                        <x-label for="user-phone" :value="__('Номер телефона')" />
                        <x-input id="user-phone" class="block mt-1 w-full"
                                 type="tel"
                                 name="user-phone"
                                 pattern="[0-9]{10}"
                                 required
                        />
                    </div>

                    {{-- User company --}}
                    <div class="mt-4">
                        <x-label for="user-company" :value="__('Компания')" />
                        <x-input id="user-company" class="block mt-1 w-full"
                                 type="text"
                                 name="user-company"
                                 required
                        />
                    </div>

                    {{-- Statement name --}}
                    <div class="mt-4">
                        <x-label for="statement-name" :value="__('Название заявки')" />
                        <x-input id="statement-name" class="block mt-1 w-full"
                                 type="text"
                                 name="statement-name"
                                 required
                        />
                    </div>

                    {{-- Statement message --}}
                    <div class="mt-4">
                        <x-label for="statement-message" :value="__('Сообщение')" />
                        <textarea id="statement-message" class="block mt-1 w-full rounded-md shadow-sm border-gray-300"
                                  name="statement-message"
                                  required
                        >
                        </textarea>
                    </div>

                    {{-- Statement file --}}
                    <div class="mt-4">
                        <x-label for="statement-file" :value="__('Прикрепить файл')" />
                        <input id="statement-file" class="block mt-1 w-full"
                                 type="file"
                                 name="statement-file"
                        />
                    </div>

                    <x-button class="send-statement">
                        {{ __('Отправить заявку') }}
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


