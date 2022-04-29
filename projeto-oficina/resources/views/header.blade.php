<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between mb-4">
        <a class="navbar-brand ml-5" href="/series">Home</a>
        @auth()
            <a class="text-danger mr-5" href="/sair">Sair</a>
        @endauth
        @guest()
            <a class="text-dark mr-5" href="/entrar">Entrar</a>
        @endguest
    </nav>
</header>
