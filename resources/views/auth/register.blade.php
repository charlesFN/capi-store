<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="curso" :value="__('Curso')" />
            <select name="curso" id="curso" class="form-control">
                <option value="Sistemas de Infromação" selected>Sistemas de Infromação</option>
                <option value="Administração">Administração</option>
                <option value="Artes Visuais">Artes Visuais</option>
                <option value="Ciências Biológicas (Bacharelado)">Ciências Biológicas (Bacharelado)</option>
                <option value="Ciências Biológicas (Licenciatura)">Ciências Biológicas (Licenciatura)</option>
                <option value="Ciências Contábeis">Ciências Contábeis</option>
                <option value="Ciências da Religião">Ciências da Religião</option>
                <option value="Ciências Econômicas">Ciências Econômicas</option>
                <option value="Ciências Sociais">Ciências Sociais</option>
                <option value="Direito">Direito</option>
                <option value="Educação Física (Bacharelado)">Educação Física (Bacharelado)</option>
                <option value="Educação Física (Licenciatura)">Educação Física (Licenciatura)</option>
                <option value="Enfermagem">Enfermagem</option>
                <option value="Engenharia Civil">Engenharia Civil</option>
                <option value="Engenharia de Sistemas">Engenharia de Sistemas</option>
                <option value="Filosofia">Filosofia</option>
                <option value="Física Licenciatura">Física Licenciatura</option>
                <option value="Geografia (Bacharelado)">Geografia (Bacharelado)</option>
                <option value="Geografia (Licenciatura)">Geografia (Licenciatura)</option>
                <option value="História">História</option>
                <option value="Letras Espanhol">Letras Espanhol</option>
                <option value="Letras Inglês">Letras Inglês</option>
                <option value="Letras Português">Letras Português</option>
                <option value="Matemática">Matemática</option>
                <option value="Medicina">Medicina</option>
                <option value="Música">Música</option>
                <option value="Odontologia">Odontologia</option>
                <option value="Pedagogia">Pedagogia</option>
                <option value="Psicologia">Psicologia</option>
                <option value="Serviço Social">Serviço Social</option>
                <option value="Teatro">Teatro</option>
                <option value="Tecnologia em Gestão Pública">Tecnologia em Gestão Pública</option>
            </select>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Já possui cadastro?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Cadastrar-se') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
